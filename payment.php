<?php
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

// DB connection
$conn = new mysqli('127.0.0.1', 'root', '', 'grafino', 3307);

if ($conn->connect_error) {
    echo json_encode([
            "status" => "error",
            "message" => "Database connection failed"
    ]);
    exit;
}

$conn->set_charset("utf8mb4");

// ONLY POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["status" => "error", "message" => "Invalid request method"]);
    exit;
}

// INPUT
$username = $_POST['username'] ?? '';
$payment_method_input = $_POST['payment-method'] ?? '';

$amount = (float)($_POST['amount'] ?? 0);
$mpesa_amount = (float)($_POST['mpesa-amount'] ?? 0);

$transaction_id = $_POST['transaction-id'] ?? '';
$confirmation_code = $_POST['confirmation-code'] ?? '';
$phone_number = $_POST['mpesa-phone'] ?? '';
$bank_name = $_POST['bank-name'] ?? '';
$branch = $_POST['branch'] ?? '';
$account_number = $_POST['account-number'] ?? '';

// Prefer MPESA amount
if ($mpesa_amount > 0) {
    $amount = $mpesa_amount;
}

// MAP METHOD
$payment_mapping = [
        "mpesa" => "MPESA",
        "credit-card" => "Credit Card",
        "bank-transfer" => "Bank Transfer"
];

$payment_method = $payment_mapping[$payment_method_input] ?? null;

if (!$payment_method) {
    echo json_encode(["status" => "error", "message" => "Invalid payment method"]);
    exit;
}

// VALIDATION
if (empty($username) || $amount <= 0) {
    echo json_encode(["status" => "error", "message" => "Missing required fields"]);
    exit;
}

// MPESA VALIDATION
if ($payment_method === "MPESA" && empty($phone_number)) {
    echo json_encode(["status" => "error", "message" => "Phone number required"]);
    exit;
}

// INSERT
$stmt = $conn->prepare("
    INSERT INTO payments 
    (username, payment_method, bank_name, branch, account_number, amount, transaction_id, confirmation_code, phone_number, payment_status)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
");

if (!$stmt) {
    echo json_encode(["status" => "error", "message" => $conn->error]);
    exit;
}

$payment_status = "Pending";

// ✅ FIXED bind_param (ONLY ONCE, CORRECT FORMAT)
$stmt->bind_param(
        "sssssdssss",
        $username,
        $payment_method,
        $bank_name,
        $branch,
        $account_number,
        $amount,
        $transaction_id,
        $confirmation_code,
        $phone_number,
        $payment_status
);

if (!$stmt->execute()) {
    echo json_encode(["status" => "error", "message" => $stmt->error]);
    exit;
}

// FIXED insert ID
$payment_id = $conn->insert_id;

// MPESA CALL
if ($payment_method === "MPESA") {
    $response = initiateMpesaStkPush($phone_number, $amount, $payment_id);

    echo json_encode([
            "status" => "pending",
            "message" => "STK push initiated",
            "data" => $response
    ]);
    exit;
}

// SUCCESS
echo json_encode([
        "status" => "success",
        "message" => "Payment saved successfully"
]);

$stmt->close();
$conn->close();
exit;


// ================= MPESA FUNCTION =================
function initiateMpesaStkPush($phone, $amount, $payment_id) {

    $accessToken = generateAccessToken();

    if (!$accessToken) {
        return ["status" => "error", "message" => "Token generation failed"];
    }

    $shortcode = "174379";
    $passkey = "bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";

    $timestamp = date("YmdHis");
    $password = base64_encode($shortcode . $passkey . $timestamp);

    $callbackUrl = "https://yourdomain.com/callback.php";

    $data = [
            "BusinessShortCode" => $shortcode,
            "Password" => $password,
            "Timestamp" => $timestamp,
            "TransactionType" => "CustomerPayBillOnline",
            "Amount" => $amount,
            "PartyA" => $phone,
            "PartyB" => $shortcode,
            "PhoneNumber" => $phone,
            "CallBackURL" => $callbackUrl,
            "AccountReference" => "ClearancePayment",
            "TransactionDesc" => "University Payment"
    ];

    $ch = curl_init("https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest");

    curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer $accessToken",
            "Content-Type: application/json"
    ]);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response, true);
}


// ================= TOKEN GENERATOR =================
function generateAccessToken() {

    $consumerKey = "eYMFV0edp60ZazIgriNtsvkGxjhjxhPXqdSDpdve78X1b6r3";
    $consumerSecret = "N7QuU2nigGCSERt4GiRILU9dNRAPiTarTDzKSul5DbhYMtSU5nUbMqaAAZ88qtKG";

    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials');
    curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_USERPWD, $consumerKey . ":" . $consumerSecret);

    $result = curl_exec($curl);
    curl_close($curl);

    $response = json_decode($result);

    return $response->access_token ?? null;
}
echo json_encode([
        "status" => "success",
        "message" => "STK push sent. Please check your phone to complete payment."
]);
exit;
?>