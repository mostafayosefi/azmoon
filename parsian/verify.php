<?php
include("nusoap.php");

$LoginAccount 	= 'xxxxxxxxxxxxxxxxxxxxx';

if (isset($_POST['status']) && $_POST['status'] == 0 && isset($_POST['Token']) && $_POST['Token'] != "")
{
	$client = new nusoap_client('https://pec.shaparak.ir/NewIPGServices/Confirm/ConfirmService.asmx?wsdl', 'wsdl');
	$client->soap_defencoding = 'UTF-8';
	
	$result = $client->call('ConfirmPayment', array("requestData" => 
		array(
			'LoginAccount' 		=> $LoginAccount,  
			'Token' 			=> $_POST['Token']
		),
	));

	if (isset($result['ConfirmPaymentResult']) && $result['ConfirmPaymentResult'] != "")
	{
		$result = $result['ConfirmPaymentResult'];

		if (isset($result['Status']) && $result['Status'] == 0 && isset($result['RRN']) && $result['RRN'] > 0)
		{
			$bankReference 		= (isset($result['RRN']) && $result['RRN'] > 0) 							? $result['RRN'] 				: "";
			$cardNumberMasked 	= (isset($result['CardNumberMasked']) && $result['CardNumberMasked'] != "") ? $result['CardNumberMasked'] 	: "";

			echo "Payment Successfully - bank Payment Reference Number : {$bankReference}";
		} else {
			echo "Error : {$result['Status']}";
		}	
	} else {
		echo "No response from the bank";
	}
} else {
	echo "Transaction canceled by user";
}
?>