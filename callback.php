<?php
error_log("MPESA Callback Received: " . file_get_contents("php://input"));

// Database Configuration
$host = 'localhost';
$db_username = 'root';
$db_password = 'kobifora';
$db_name = 'grafinho';

try {
    $dsn = "mysql:host=$host;dbname=$db_name;charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $pdo = new PDO($dsn, $db_username, $db_password, $options);

    // Get JSON response from MPESA
    $data = file_get_contents("php://input");
    $response = json_decode($data, true);

    if (isset($response['Body']['stkCallback'])) {
        $callback = $response['Body']['stkCallback'];

        $MerchantRequestID = $callback['MerchantRequestID'];
        $CheckoutRequestID = $callback['CheckoutRequestID'];
        $ResultCode = $callback['ResultCode'];
        $ResultDesc = $callback['ResultDesc'];

        // Log MPESA response
        error_log("STK Callback: " . print_r($callback, true));

        if ($ResultCode == 0) {
            // Extract Metadata dynamically
            $items = $callback['CallbackMetadata']['Item'];
            $amount = $mpesaReceipt = $transactionDate = $phoneNumber = null;

            foreach ($items as $item) {
                if ($item['Name'] == "Amount") $amount = $item['Value'];
                if ($item['Name'] == "MpesaReceiptNumber") $mpesaReceipt = $item['Value'];
                if ($item['Name'] == "TransactionDate") $transactionDate = $item['Value'];
                if ($item['Name'] == "PhoneNumber") $phoneNumber = $item['Value'];
            }

            // Convert transaction date to proper format
            $formattedTransactionDate = date('Y-m-d H:i:s', strtotime($transactionDate));

            // Fetch the last STK request with this CheckoutRequestID
            $stmt = $pdo->prepare("SELECT * FROM payments WHERE checkout_request_id = :checkout_request_id ORDER BY transaction_date DESC LIMIT 1");
            $stmt->execute([':checkout_request_id' => $CheckoutRequestID]);
            $existingPayment = $stmt->fetch();

            if ($existingPayment) {
                // Update last STK push request
                $updateStmt = $pdo->prepare("UPDATE payments 
                SET amount = :amount, mpesa_receipt = :mpesa_receipt, transaction_date = :transaction_date, phone_number = :phone_number, payment_status = 'Completed'
                WHERE checkout_request_id = :checkout_request_id
                ORDER BY transaction_date DESC LIMIT 1");

                $updateStmt->execute([
                    ':amount' => $amount,
                    ':mpesa_receipt' => $mpesaReceipt,
                    ':transaction_date' => $formattedTransactionDate,
                    ':phone_number' => $phoneNumber,
                    ':checkout_request_id' => $CheckoutRequestID
                ]);

                error_log("MPESA Payment Updated Successfully: Transaction ID $mpesaReceipt");
                echo json_encode(["status" => "success", "message" => "Payment Updated Successfully!"]);
            } else {
                // Insert a new payment record
                $stmt = $pdo->prepare("INSERT INTO payments 
                (merchant_request_id, checkout_request_id, amount, mpesa_receipt, transaction_date, phone_number, payment_status) 
                VALUES (:merchant_request_id, :checkout_request_id, :amount, :mpesa_receipt, :transaction_date, :phone_number, 'Completed')");

                $stmt->execute([
                    ':merchant_request_id' => $MerchantRequestID,
                    ':checkout_request_id' => $CheckoutRequestID,
                    ':amount' => $amount,
                    ':mpesa_receipt' => $mpesaReceipt,
                    ':transaction_date' => $formattedTransactionDate,
                    ':phone_number' => $phoneNumber
                ]);

                error_log("MPESA Payment Inserted: Transaction ID $mpesaReceipt");
                echo json_encode(["status" => "success", "message" => "Payment Inserted Successfully!"]);
            }
        } else {
            // Log failed transaction
            error_log("MPESA Payment Failed: " . $ResultDesc);

            // Update only the last STK push request with "Failed" status
            $stmt = $pdo->prepare("UPDATE payments 
            SET payment_status = 'Failed', mpesa_receipt = NULL 
            WHERE checkout_request_id = :checkout_request_id
            ORDER BY transaction_date DESC LIMIT 1");

            $stmt->execute([
                ':checkout_request_id' => $CheckoutRequestID
            ]);

            echo json_encode(["status" => "error", "message" => "Payment Failed: " . $ResultDesc]);
        }
    } else {
        error_log("No valid callback data received.");
        echo json_encode(["status" => "error", "message" => "No callback data received."]);
    }
} catch (PDOException $e) {
    error_log("Database Error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => "A database error occurred."]);
}
?>
