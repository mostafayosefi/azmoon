<?php
//coded by payamsalami.ir

$idorder=$_GET['id'];
 

include 'connect.php';	
 
 
 $stmt = $pdo->query("SELECT * FROM myrequest  WHERE req_rnd != 0 && `req_rnd`='".$idorder."' ORDER BY  req_rnd DESC LIMIT 1");
while ($row = $stmt->fetch()) {
  

$status=$row['req_status']; ;
$token=$row['req_token']; ;

}

 
         
// header("location:../user/fetch/$idorder");
   
    
 
 
 
 /*
 echo $token.'<br>';
 echo $status;
 */
 
 
 

if (!isset($token) ||
    !isset($status)
) {
     
 
       // echo 'error in params';
        
         
 header("location:../user/error/$idorder");
   
    
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
    	 
       // echo 'payment successfully';
        
       
 header("location:../user/success/$idorder");
    } else {
    	
    	 /*
        echo 'error in verify payment';
        echo 'status = '.$status.'</br>';
        echo 'rn = '.$rrn;
       */
       
 header("location:../user/error/$idorder");
    }
}else{
 
    //echo 'payment failed';
    
    
 header("location:../user/error/$idorder");
}

 