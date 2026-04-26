<?php
// Get Access Token
$accessToken = "cxtJ5yLrd1RW71tHp2sneuJPHxHA"; // Replace with your Access Token

// Set Business Shortcode and Passkey
$shortcode = "174379"; // MPESA Business Shortcode (Paybill or Till)
$passkey = "bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919"; // Replace with your actual Passkey

// Dynamic Input (PartyA and PartyB)
$phone = "254701526977"; // Customer's Phone Number (PartyA)
$amount = "1"; // Payment Amount
$partyB = "174379"; // Business Paybill/Till Number (PartyB)

// Timestamp & Password Generation
$timestamp = date("YmdHis");
$password = base64_encode($shortcode . $passkey . $timestamp);

// Callback URL (Make sure it's publicly accessible)
$callbackUrl = "https://your-ngrok-url.com/callback.php";


// API URL
$url = "https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest";

// STK Push Data
$stkPushData = [
    "BusinessShortCode" => $shortcode,
    "Password" => $password,
    "Timestamp" => $timestamp,
    "TransactionType" => "CustomerPayBillOnline",
    "Amount" => $amount,
    "PartyA" => $phone, // The customer phone number
    "PartyB" => $partyB, // The payee (Paybill or Till Number)
    "PhoneNumber" => $phone,
    "CallBackURL" => $callbackUrl,
    "AccountReference" => "University Clearance", // Change as needed
    "TransactionDesc" => "University Fees Payment" // Change as needed
];

// Initialize cURL
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer " . $accessToken,
    "Content-Type: application/json"
]);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($stkPushData));
$response = curl_exec($curl);
curl_close($curl);

// Display Response
echo $response;
?>
