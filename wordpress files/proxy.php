<?php
// Get the URL from the query string
$url = $_GET['url'];

// Use cURL to fetch the image from the external server
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, 0);
$response = curl_exec($ch);
curl_close($ch);

// Get the content type of the image
$info = getimagesizefromstring($response);
header('Content-Type: ' . $info['mime']);

// Output the image
echo $response;
