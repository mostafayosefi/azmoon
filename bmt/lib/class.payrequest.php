<?php
include 'config_accont.php';

$client = new nusoap_client('https://bpm.shaparak.ir/pgwchannel/services/pgw?wsdl');
$namespace='http://interfaces.core.sw.bps.com/';
///////////////// PAY REQUEST
if(isset($_POST['PayRequestButton']) && isset($_POST['PayAmount'])!='0' && $_POST['name']!='' && $_POST['mobile']!='' && $_POST['email']!='' && $_POST['PayAmount']!='' && $_POST['additionalData']!='')
{
	// ترمینال ID
	//$terminalId = '';
	// نام کاربری درگاه اینترنتی
	//$userName = '';
	// رمز عبور درگاه اینترنتی
	//$userPassword = '';

	$orderId = rand();	
	$PayAmount=trim($_POST['PayAmount']);
	$Clear_PayAmount=str_replace(',','',$PayAmount);	
	$amount = $Clear_PayAmount;
	$localDate = date("Ymd");
	$localTime = date("His");
	//$additionalData = trim($_POST['additionalData']);
	$additionalData = trim($_POST['name']);//توضیحات جهت درج در سیستم بانک
	// آدرس فایل پس از پرداخت پول از بانک ملت به هاست شما
	$callBackUrl = $CallBack;
	$payerId = 0;
	// Check for an error
	$err = $client->getError();
	if($err)
	{
		echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
		die();
	}
	$parameters = array(
						'terminalId' => $terminalId,
						'userName' => $userName,
						'userPassword' => $userPassword,
						'orderId' => $orderId,
						'amount' => $amount,
						'localDate' => $localDate,
						'localTime' => $localTime,
						'additionalData' => $additionalData,
						'callBackUrl' => $callBackUrl,
						'payerId' => $payerId
						);
	// Call the SOAP method
	$result = $client->call('bpPayRequest', $parameters, $namespace);
	// Check for a fault
	if ($client->fault)
	{
		echo 'خطا';
		echo '<br>';
		echo 'اطلاعات ارسالی به سرور بانک نامعتبر میباشد';
		die();
	}
	else
	{
		// Check for errors
		$resultStr  = $result;
		$err = $client->getError();
		if($err)
		{
			// Display the error
			echo '<h2>Error</h2><pre>' . $err . '</pre>';
			die();
		} 
		else
		{
			//چک میکنه ببینه اگه نام و نام خانوادگی مقدار نداشت به آدرس دیگه ای منتقل میکنه
			if(!isset($_POST['name']))
			{
				print ("<script language='javascript'>window.navigate('index.php');</script>");
			}
			else
			{
				// Display the result
				$res = explode (',',$resultStr);
				$Clear_resultStr=$resultStr;
				$Clear_resultStr2=str_replace('0,','',$Clear_resultStr);
				if($resultStr=="23")
				{
					echo "<script>alert('خطای امنیتی رخ داده است');</script>";
				}
				elseif($Clear_resultStr2=="25")
				{
					echo "<script>alert('مبلغ نامعتبر است');</script>";
				}
				elseif($Clear_resultStr2=="32")
				{
					echo "<script>alert('فرمت اطلاعات وارد شده صحیح نیست');</script>";
				}
				elseif($Clear_resultStr2=="34")
				{
					echo "<script>alert('خطای سیستمی');</script>";
				}
				elseif($Clear_resultStr2=="41")
				{
					echo "<script>alert('شماره درخواست تکراری است');</script>";
				}
				else
				{
					echo '<center><img src="image/loading.gif"></center><span style="color:#060">درحال اتصال به سرور بانک<br>شناسه پرداخت شما: '.$Clear_resultStr2.'</span>';
					echo "<script>alert('" . $Clear_resultStr2 . " :شناسه پرداخت شما ');</script>";
				}		
				// اتصال به دیتابیس جهت ورود اطلاعات به بانک اطلاعاتی
				connect($username,$password,$database);
				mysql_query('SET NAMES \'utf8\'');
				if(isset($_POST['name']) && preg_match('/^09(1[0-9]|3[1-9]|2[1-9])-?[0-9]{3}-?[0-9]{4}$/', $_POST['mobile']) && isset($_POST['email']) && isset($_POST['PayAmount']) && isset($_POST['additionalData']))
				{
					$name=mysql_real_escape_string(trim($_POST['name']));
					$address=mysql_real_escape_string(trim($_POST['address']));
					$mobile=mysql_real_escape_string(trim($_POST['mobile']));
					$email=mysql_real_escape_string(trim($_POST['email']));
					$details=mysql_real_escape_string(trim($_POST['additionalData']));
					$price_rial=mysql_real_escape_string(trim($_POST['PayAmount']));
					$price=mysql_real_escape_string(str_replace(',','',$price_rial));
					$ShenaseMoshtari=$Clear_resultStr2;
					
					$select_database = mysql_query("INSERT INTO `ebanking_mellat` (`name`,`address`,`mobile`,`email`,`details`,`price`,`ShenaseMoshtari`,`clint_ip`) VALUES ('".$name."','".$address."','".$mobile."','".$email."','".$details."','".$price."','".$ShenaseMoshtari."','".mysql_real_escape_string($clint_ip)."')");
					echo mysql_affected_rows() > 0 ? '<br><span style="color:#00F">لطفا کمی صبر نمائید</span>' : '<br><span>دوباره سعی نمائید</span>'.mysql_error();
				}
				else
				{
					$massage_error="مقادیر خواسته شده را وارد نمایید";
				}
				$ResCode = $res[0];
				if ($ResCode == "0")
				{
					// Update table, Save RefId
					echo "<script language='javascript' type='text/javascript'>postRefId('" . $res[1] . "');</script>";
				} 
				else
				{
				// log error in app
					// Update table, log the error
					// Show proper message to user
				}
			}// end Display the result
		}// end Check for errors
	}
}
else// End if(isset($_POST['PayRequestButton']) && isset($_POST['PayAmount'])!='0' &&  .... 
{
	$massage_error="مقادیر خواسته شده را وارد نمایید";
}
?>