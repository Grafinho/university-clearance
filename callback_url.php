<?php
header('Content-Type: application/json');

// Read raw callback
$callbackJSON = file_get_contents('php://input');
$data = json_decode($callbackJSON, true);

// Validate structure
if (!isset($data['Body']['stkCallback'])) {
    http_response_code(400);
    echo json_encode(["status" => "error", "message" => "Invalid callback"]);
    exit;
}

$stk = $data['Body']['stkCallback'];

$resultCode = $stk['ResultCode'] ?? 1;
$resultDesc = $stk['ResultDesc'] ?? '';
$checkoutRequestID = $stk['CheckoutRequestID'] ?? '';

// Defaults
$amount = null;
$receipt = null;
$phone = null;

// Extract metadata safely
if ($resultCode == 0 && isset($stk['CallbackMetadata']['Item'])) {

    foreach ($stk['CallbackMetadata']['Item'] as $item) {

        switch ($item['Name']) {
            case 'Amount':
                $amount = $item['Value'];
                break;

            case 'MpesaReceiptNumber':
                $receipt = $item['Value'];
                break;

            case 'PhoneNumber':
                $phone = $item['Value'];
                break;
        }
    }
}

// DB connection
$conn = new mysqli('127.0.0.1', 'root', '', 'grafino', 3307);

if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => "DB connection failed"]);
    exit;
}

// Status
$status = ($resultCode == 0) ? "SUCCESS" : "FAILED";

// Insert safely
$stmt = $conn->prepare("
    INSERT INTO payments 
    (checkout_request_id, amount, mpesa_receipt, phone_number, status, result_desc)
    VALUES (?, ?, ?, ?, ?, ?)
");

if (!$stmt) {
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => $conn->error]);
    exit;
}

$stmt->bind_param(
    "sdssss",
    $checkoutRequestID,
    $amount,
    $receipt,
    $phone,
    $status,
    $resultDesc
);

$stmt->execute();

$stmt->close();
$conn->close();

// ALWAYS respond OK to Safaricom
echo json_encode(["status" => "success"]);
?>