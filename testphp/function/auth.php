<?php
$apiUrl = "https://evaluation-technique.lundimatin.biz/api/auth";

$data = array(
    "username" => "test_api",
    "password" => "api123456",
    "password_type" => 0,
    "code_application" => "webservice_externe",
    "code_version" => "1"
);

$jsonData = json_encode($data);

$options = array(
    CURLOPT_URL => $apiUrl,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $jsonData,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($jsonData)
    )
);

$ch = curl_init();
curl_setopt_array($ch, $options);

$response = curl_exec($ch);

$responseData = json_decode($response, true);

// echo $response;
// curl_close($ch);
?> 