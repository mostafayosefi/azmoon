<?php
include("nusoap.php");

$LoginAccount 	= '3ChS5OjC3A3527Q604aS';
$Amount 		= 20000; // Rial
$OrderId 		= time();
$CallBackUrl 	= "https://azmoonpte.com/servicepay/parsian/verify.php";

$client = new nusoap_client('https://pec.shaparak.ir/NewIPGServices/Sale/SaleService.asmx?wsdl', 'wsdl');
$client->soap_defencoding = 'UTF-8';

$result = $client->call('SalePaymentRequest', array("requestData" => 
	array(
		'LoginAccount' 		=> $LoginAccount,  
		'Amount' 			=> $Amount,
		'OrderId' 			=> $OrderId,
		'CallBackUrl' 		=> $CallBackUrl,
		'AdditionalData' 	=> ''
	),
));

if (isset($result['SalePaymentRequestResult']) && $result['SalePaymentRequestResult'] != "")
{
	$result = $result['SalePaymentRequestResult'];
	
	if (isset($result['Status']) && $result['Status'] == 0 && isset($result['Token']) && $result['Token'] != "")
	{
		$token = $result['Token'];

		header("Location:https://pec.shaparak.ir/NewIPG/?Token={$token}");
	} else {
		echo "Error : {$result['Status']}";
	}	
} else {
	echo "No response from the bank";
}
?>