<?php


//coded by payamsalami.ir
$idorder=$_GET['id'];
$price=$_GET['price'];
$parameters = array(
    'LoginAccount'		=> '3ChS5OjC3A3527Q604aS',
    'Amount' 			=> $price,
    'OrderId' 			=> $idorder,
    'CallBackUrl' 		=> 'https://servicepay.azmoonpte.com/samplemak/verify.php?id='.$idorder,
    'AdditionalData' 	=> ''
);
$client	= new SoapClient('https://pec.shaparak.ir/NewIPGServices/Sale/SaleService.asmx?wsdl',array('soap_version'=>'SOAP_1_1','cache_wsdl'=>WSDL_CACHE_NONE  ,'encoding'=>'UTF-8'));
$result	= $client->SalePaymentRequest(array("requestData" => $parameters));
$token = $result->SalePaymentRequestResult->Token;
$status = $result->SalePaymentRequestResult->Status;
 

if ($token > 0 && $status==0) { 
    header('location:https://servicepay.azmoonpte.com/user/makcurl/'.$idorder.'/'.$token.'/'.$status); 
    exit;
} else {
    echo 'error in payment request - status : '. $status;
}