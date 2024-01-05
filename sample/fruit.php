<?php
//coded by payamsalami.ir
$idorder=$_GET['id'];  ?>

<?php

 $ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://localhost/melatpay/user/testcurl/".$idorder."/22222/2");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 5);
    curl_setopt($ch, CURLOPT_TIMEOUT, 59); 
$result = curl_exec($ch);
 
?>