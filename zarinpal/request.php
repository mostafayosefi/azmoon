 <?php
   ob_start();
session_start();		
include '../bmt/lib/config_accont.php';	 	?>
<?php 

$posts_sql="select *  FROM getwaypay WHERE id = 2   ORDER BY id DESC LIMIT 1";
 $posts_result = mysql_query($posts_sql); $j=0; 
 while($posts_row = mysql_fetch_assoc($posts_result)){ 
 $MerchantID=$posts_row['getway_merchent']; 
 }

 ?>
<?php


    $Amount = $_SESSION['jam']/10; //Amount will be based on Toman  - Required
    $Description = 'توضیحات تراکنش تستی';  // Required
    $Email = 'UserEmail@Mail.Com'; // Optional
    $Mobile = '09123456789'; // Optional
    $CallbackURL = 'http://zaban724.com/zarinpal/verify.php';  // Required

    // URL also can be ir.zarinpal.com or de.zarinpal.com
    $client = new SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

    $result = $client->PaymentRequest([
        'MerchantID'     => $MerchantID,
        'Amount'         => $Amount,
        'Description'    => $Description,
        'Email'          => $Email,
        'Mobile'         => $Mobile,
        'CallbackURL'    => $CallbackURL,
    ]);

    //Redirect to URL You can do it also by creating a form
    if ($result->Status == 100) {
        header('Location: https://www.zarinpal.com/pg/StartPay/'.$result->Authority);
    } else {
        echo'ERR: '.$result->Status;
    }
