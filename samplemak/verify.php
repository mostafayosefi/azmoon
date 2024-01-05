<?php
//coded by payamsalami.ir

$idorder=$_GET['id'];
 
  
include '../sample/connect.php';	
   
    
 $stmt = $pdo->query("SELECT * FROM listrezerv  WHERE list_rnd != 0 && `list_rnd`='".$idorder."' ORDER BY  list_rnd DESC LIMIT 1");
while ($row = $stmt->fetch()) {
  

$status=$row['list_status']; ;
$token=$row['list_token']; ;

}



// header("location:../user/fetchmak/$idorder");

 
 
 

if (!isset($token) ||
    !isset($status)
) {
     
   /*
        echo 'error in params';
        */
         
 header("location:../user/error/mak/$idorder");
   
    
}

if ($status == 0 && $token > 0){
    $client = new SoapClient('https://pec.shaparak.ir/NewIPGServices/Confirm/ConfirmService.asmx?WSDL',array('soap_version'=>'SOAP_1_1','cache_wsdl'=>WSDL_CACHE_NONE  ,'encoding'=>'UTF-8'));
    $params = [
        'LoginAccount'		=> '3ChS5OjC3A3527Q604aS',
        'Token' 			=> $token
    ];
    $result	= $client->ConfirmPayment(array("requestData" => $params));
    $status = $result->ConfirmPaymentResult->Status;
    $rrn = $result->ConfirmPaymentResult->RRN;
    $cardNumberMasked = isset($result->ConfirmPaymentResult->CardNumberMasked) ? $result->ConfirmPaymentResult->CardNumberMasked : '';
    if ($status == 0 && $rrn > 0) {
    	/*
        echo 'payment successfully';
        */
       
 header("location:../user/success/mak/$idorder");
    } else {
    	
    	/*
        echo 'error in verify payment';
        echo 'status = '.$status.'</br>';
        echo 'rn = '.$rrn;
       */
       
 header("location:../user/error/mak/$idorder");
    }
}else{
	/*
    echo 'payment failed';
    */
    
 header("location:../user/error/mak/$idorder");
}

 