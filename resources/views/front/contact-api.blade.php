<?php

$authKey = "SHYAMCATERESXX1D";

$mobileNumber = "918128737020"; //FOR MULTIPLE NUMBER USE Comma Separated , WITHOUT SPACEBAR

// Ex. $mobileNumber="91XXXXXXXXXX,91XXXXXXXXXX,91XXXXXXXXXX";

$url = "https://wapi.co.in/sendMessage.php";

$message = "New Contact Form Submission\n\n" .
    "Name: test\n" .
    "Contact: 1234567890\n";

$postData = array(
    'AUTH_KEY' => $authKey,
    'phone' => $mobileNumber,
    'message' => $message
);

$ch = curl_init();

curl_setopt_array($ch, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $postData
    //,CURLOPT_FOLLOWLOCATION => true
));

//Ignore SSL certificate verification

curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

//get response

$output = curl_exec($ch);

//Print error if any

if (curl_errno($ch)) {
    echo 'error:' . curl_error($ch);
}
curl_close($ch);

echo $output;
