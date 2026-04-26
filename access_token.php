<?php
$consumerKey = "CQcsDms991z4SMXEVA59axVXBVPfSX6STldHmFjgbMh25Yqc";
$consumerSecret = "ZGbGer0hzUTFVhmFrizZS8lbel4GITpu5GafxNI05kA2n0kvkJzjfgSjABG46Wt6";

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials');
curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_USERPWD, $consumerKey . ":" . $consumerSecret);
$result = curl_exec($curl);
curl_close($curl);

$response = json_decode($result);
$accessToken = $response->access_token;

echo "Access Token: " . $accessToken;
?>
