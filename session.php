<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Assuming you receive 'captcha', 'messageId', and 'ipzebi' via POST
if(isset($_POST['captcha'])) {
    // Perform your captcha validation here
        $_SESSION["username"] = "JohnDoe";
        echo json_encode(["status" => "success"]);
    
} else {
    echo json_encode(["status" => "failure", "message" => "Captcha not set"]);
}
?>
