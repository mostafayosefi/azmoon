<?php session_start();

 if(empty($_SESSION['Captcha'] ) || strcasecmp($_SESSION['Captcha'], $_POST['Captcha']) != 0)
 {
	die("no");
 } else 
	die("yes");

 ?>