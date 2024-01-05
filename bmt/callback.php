<?php
ob_start();
session_start();
?>
	 <?php

$codrezerv=$_SESSION['codrezerv'];
	$_SESSION['RefId']= 10 ; 
?>
<?php
require_once 'lib/config_accont.php';
 

//================================================================================================================================================
//================================================================================================================================================
// شناسه پرداخت
$RefId = $_POST['RefId'];
// وضعیت پرداخت
$ResCode = $_POST['ResCode'];
// شماره درخواست
$SaleOrderId = $_POST['SaleOrderId'];
// کد مرجع تراکنش
$SaleReferenceId = $_POST['SaleReferenceId'];

 
//================================================================================================================================================
//================================================================================================================================================
// کلاس اتصال به بانک و بررسی اطلاعات
	require_once("lib/nusoap.php");
		
	//curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	//$page = curl_exec ($ch);
	$client = new nusoap_client('https://bpm.shaparak.ir/pgwchannel/services/pgw?wsdl');
	$namespace='http://interfaces.core.sw.bps.com/';
	
	///////////////// VERIFY REQUEST
		// ترمینال ID
		//$terminalId = '';
		// نام کاربری درگاه اینترنتی
		//$userName = '';
		// رمز عبور درگاه اینترنتی
		//$userPassword = '';
		$orderId = $SaleOrderId;
		$verifySaleOrderId = $SaleOrderId;
		$verifySaleReferenceId = $SaleReferenceId;

		// Check for an error
		$err = $client->getError();
		if ($err) {
			echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
			die();
		}
	  	  
		$parameters = array(
			'terminalId' => $terminalId,
			'userName' => $userName,
			'userPassword' => $userPassword,
			'orderId' => $orderId,
			'saleOrderId' => $verifySaleOrderId,
			'saleReferenceId' => $verifySaleReferenceId);

		// Call the SOAP method
		$result = $client->call('bpVerifyRequest', $parameters, $namespace);
//================================================================================================================================================
?>
<?php include ('scripts_style/scripts/date_time_shamsi.php'); ?>

<?php 
//================================================================================================================================================
// اتصال به دیتابیس جهت ورود اطلاعات به بانک اطلاعاتی
connect($username,$password,$database);
mysql_query('SET NAMES \'utf8\'');
//================================================================================================================================================
//================================================================================================================================================
// شناسه پرداخت
$ShenasePardakht=mysql_real_escape_string($_POST['RefId']);
// وضعیت پرداخت
$VazeiyatKharid=mysql_real_escape_string($_POST['ResCode']);
// شماره درخواست
$ShomareDarkhast=mysql_real_escape_string($_POST['SaleOrderId']);
// کد مرجع تراکنش
$CodeMarjaeTarakonesh=mysql_real_escape_string($_POST['SaleReferenceId']);
//================================================================================================================================================
//================================================================================================================================================
include ('lib/class.error.php');
//================================================================================================================================================
//================================================================================================================================================
// پیدا نمودن رکورد واریزی و انتخاب شناسه پرداخت و آدرس آی پی کاربر واریز کننده وجه
$read_db=mysql_query("SELECT * FROM `ebanking_mellat` WHERE (`ShenaseMoshtari`='" . $ShenasePardakht . "')");
$resalt=mysql_num_rows($read_db);
if($resalt==0){ 	$_SESSION['RefId']= 10 ; }
$id_user=mysql_fetch_array($read_db);
$userid=mysql_real_escape_string($id_user['id']);
$name=mysql_real_escape_string($id_user['name']);
$mobile=mysql_real_escape_string($id_user['mobile']);
$price=mysql_real_escape_string($id_user['price']);
$userip=mysql_real_escape_string($id_user['clint_ip']);
$date_save=mysql_real_escape_string($id_user['date']);
?>
<!DOCTYPE HTML>
<html>
<head>


    <meta charset="UTF-8">
    <title>درگاه پرداخت</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.4 -->
   
  <link rel="stylesheet" href="../build/style/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../build/style/bootstrap/css/font-awesome.min.css">
    <link rel="stylesheet" href="../build/style/bootstrap/css/ionicons.min.css">
    
    <link rel="stylesheet" href="../build/style/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../build/style/dist/css/bootstrap-rtl.min.css">
    
    <link rel="stylesheet" href="../build/style/dist/css/skins/_all-skins.min.css">
    
    <link rel="stylesheet" href="../build/style/dist/fonts/fonts-fa.css">
    
    <link rel="stylesheet" href="../build/style/plugins/iCheck/flat/blue.css">
    <link rel="stylesheet" href="../build/style/plugins/morris/morris.css">
    <link rel="stylesheet" href="../build/style/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <link rel="stylesheet" href="../build/style/plugins/datepicker/datepicker3.css">
    <link rel="stylesheet" href="../build/style/plugins/daterangepicker/daterangepicker-bs3.css">
       <link rel="stylesheet" href="../build/style/plugins/iCheck/all.css">
    <link rel="stylesheet" href="../build/style/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  
    <link rel="stylesheet" href="../build/style/plugins/datatables/dataTables.bootstrap.css">

 
    <link rel="stylesheet" href="../build/style/plugins/colorpicker/bootstrap-colorpicker.min.css">
    <link rel="stylesheet" href="../build/style/plugins/timepicker/bootstrap-timepicker.min.css">
    <link rel="stylesheet" href="../build/style/plugins/select2/select2.min.css"> 
 
		   <link rel="stylesheet" href="../build/style/bootstrap/pd/js-persian-cal.css">
	<script type="text/javascript" src="../build/style/bootstrap/pd/js-persian-cal.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

     <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

  <link href="scripts_style/css/main.css" rel="stylesheet" type="text/css">
</head>

 <body class="skin-blue sidebar-mini">
    <div class="wrapper">

<?php


?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
          تایید فاکتور 
            <small>وضعیت پرداخت</small>
          </h1>
          <ol class="breadcrumb">
            <li>
            
         <?php   if($_SESSION['finical_arou']=='3'){	?> <a href="../agency/panel">
          <?php  } if($_SESSION['finical_arou']=='4'){	?>     <a href="../user/panel"> <?php } ?>
            
            
            <i class="fa fa-dashboard"></i>پنل</a></li>
            <li class="active"> پرداخت </li>
        </section>
  
  

 <div class="row">
            <div class="col-lg-3 col-xs-12"></div>
            <div class="col-lg-6 col-xs-6">				
<?php
//================================================================================================================================================

		// Check for a fault  بررسی و چک نمودن و ذخیره اطلاعات در صورت هر گونه لغو عملیات پرداخت
		if ($client->fault)
		{
			//echo '<h2>Fault</h2><pre>';
			//print_r($result);
			//echo '</pre>';
			echo '<div class="alert alert-info alert-dismissable">';
			if($VazeiyatKharid=="0")
			{
				echo '<div class="alert alert-success alert-dismissable">'.VazeiyatKharid().'</div>';
			}
			else
			{
				echo '<div class="alert alert-danger alert-dismissable">'.VazeiyatKharid().'</div>';
				
			}
			$Date = "$join_today - $time";
			if($userip==$clint_ip)
			{
				if($resalt>0)
					{
						$select_database = mysql_query("update `ebanking_mellat` SET `ShenasePardakht`='{$ShenasePardakht}',`VazeiyatKharid`='{$VazeiyatKharid}',`ShomareDarkhast`='{$ShomareDarkhast}',`CodeMarjaeTarakonesh`='{$CodeMarjaeTarakonesh}',`date`='{$join_today}' where id='".$userid."' ");
						echo mysql_affected_rows() > 0 ? '<h3 align="center" class=\"BRoya\">اطلاعات پرداخت شما ثبت شد در ساعت '.$time.' تاریخ '.$join_today.'</h3>' : 'Error'.mysql_error();
					}
			}
			echo '</div>';
		  ?>
<form action="getwayok.php" name="form1" id="form1" method="post">


  
<?php if ($VazeiyatKharid == 0){  $_SESSION['VazeiyatKharid'] = 0 ;  $_SESSION['RefId'] = $CodeMarjaeTarakonesh ; } else if ($VazeiyatKharid != 0) {  $_SESSION['VazeiyatKharid'] = 1 ;  $_SESSION['RefId'] = 10 ; } ?>


  <div class="specification">

<div class="col-lg-3 col-xs-12"><div class="headline BHoma">شناسه پرداخت:</div></div>
<div class="col-lg-9 col-xs-12"><div class="headline BTitrBold"><?php echo $_POST['RefId'] ?></div></div>
  
<div class="col-lg-3 col-xs-12"><div class="headline BHoma">شماره درخواست:</div></div>
<div class="col-lg-9 col-xs-12"><div class="headline BTitrBold"><?php echo $ShomareDarkhast; ?></div></div>

 <?php if($VazeiyatKharid=="0") {  $_SESSION['RefId']=$CodeMarjaeTarakonesh;?>
    
<div class="col-lg-3 col-xs-12"><div class="headline BHoma">کد مرجع تراکنش:</div></div>
<div class="col-lg-9 col-xs-12"><div class="headline BTitrBold"><?php echo $CodeMarjaeTarakonesh; ?></div></div>

 <?php } ?>
        
<div class="col-lg-3 col-xs-12"><div class="headline BHoma">مبلغ واریزی:</div></div>
<div class="col-lg-9 col-xs-12"><div class="headline BTitrBold"><?php echo $_SESSION['jam']; ?> ریال</div></div>
    
<div class="col-lg-3 col-xs-12"><div class="headline BHoma">وضعیت پرداخت:</div></div>
<div class="col-lg-9 col-xs-12">    <div class="headline BTitrBold">
<?php if($VazeiyatKharid=="0")
{ echo '<p style="color:#063; width: 220px">'.VazeiyatKharid().'</p>';  ?> <input type="hidden" name="par" id="par" value="1" /> <?php 

	 $re=mysql_query("UPDATE `finicals` SET `finical_shenasepardakht` = '".$RefId."' , `finical_codmarjatarakonesh` = '".$SaleReferenceId."'  , `finical_shomaredarkhast` = '".$SaleOrderId."' , `finical_payment` = '1', `finical_paymentdate` = NOW()  WHERE `id` = '". $_SESSION['finicalid']."' LIMIT 1");  
	 $re=mysql_query("UPDATE `belitrezerv` SET `blr_status` = '2'     WHERE `blr_codrezerv` = '". $_SESSION['codrezerv']."' LIMIT 999");  
	 $re=mysql_query("UPDATE `belit` SET `bel_status` = '2'     WHERE `bel_codrezerv` = '". $_SESSION['codrezerv']."' LIMIT 999");   } else 
{ echo '<p style="color:#F00; width: 220px">'.VazeiyatKharid().'</p>'; ?> <input type="hidden" name="par" id="par" value="0" /> <?php  
	 $re=mysql_query("UPDATE `finicals` SET `finical_shenasepardakht` = '".$RefId."' , `finical_codmarjatarakonesh` = '".$SaleReferenceId."'  , `finical_shomaredarkhast` = '".$SaleOrderId."' , `finical_paymentdate` = NOW()   WHERE `id` = '". $_SESSION['finicalid']."' LIMIT 1"); 
  } ?>
    </div></div>  
    
<div class="col-lg-3 col-xs-12"></div>
<div class="col-lg-9 col-xs-12"></div>

<input type="submit" class="BTitrBold" value="تائید" name="PayRequestButton">

    </div>
    
    

</form> 	
			
			<?php
			die();
//================================================================================================================================================
//================================================================================================================================================
		} 
		else
		{

			$resultStr = $result;
			
			$err = $client->getError();
			if ($err) {
					///////////////// INQUIRY REQUEST
						// $terminalId = $_POST['TerminalId'];
						// $userName = $_POST['UserName'];
						// $userPassword = $_POST['UserPassword'];
						// $orderId = $_POST['InquiryOrderId'];
						$inquirySaleOrderId = $SaleOrderId;
						$inquirySaleReferenceId = $SaleReferenceId;

						// Check for an error
						$err = $client->getError();
						if ($err) {
							echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
							die();
						}
						  
						$parameters = array(
							'terminalId' => $terminalId,
							'userName' => $userName,
							'userPassword' => $userPassword,
							'orderId' => $orderId,
							'saleOrderId' => $inquirySaleOrderId,
							'saleReferenceId' => $inquirySaleReferenceId);

						// Call the SOAP method
						$result = $client->call('bpInquiryRequest', $parameters, $namespace);

						// Check for a fault
						if ($client->fault) {
							echo '<h2>Fault</h2><pre>';
							print_r($result);
							echo '</pre>';
							die();
						} 
						else {
							$resultStr = $result;
							
							$err = $client->getError();
							if ($err) {
									///////////////// REVERSAL REQUEST
										// $terminalId = $_POST['TerminalId'];
										// $userName = $_POST['UserName'];
										// $userPassword = $_POST['UserPassword'];
										// $orderId = $_POST['ReversalOrderId'];
										$reversalSaleOrderId = $SaleOrderId;
										$reversalSaleReferenceId = $SaleReferenceId;

										// Check for an error
										$err = $client->getError();
										if ($err) {
											echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
											die();
										}
										  
										$parameters = array(
											'terminalId' => $terminalId,
											'userName' => $userName,
											'userPassword' => $userPassword,
											'orderId' => $orderId,
											'saleOrderId' => $reversalSaleOrderId,
											'saleReferenceId' => $reversalSaleReferenceId);

										// Call the SOAP method
										$result = $client->call('bpReversalRequest', $parameters, $namespace);

										// Check for a fault
										if ($client->fault) {
											echo '<h2>Fault</h2><pre>';
											print_r($result);
											echo '</pre>';
											die();
										} 
										else {
											$resultStr = $result;
											
											$err = $client->getError();
											if ($err) {
												// Display the error
												echo '<h2>Error</h2><pre>' . $err . '</pre>';
												die();
											} 
											else {
												// Update Table, Save Reversal Status 
												// Note: Successful Reversal means that sale is reversed.
												echo "Reversal Response is EE : " . $resultStr . "";
												echo "Reversal Response is DD : " . $resultStr;
											}// end Display the result
										}// end Check for errors
						
							
								// Display the error
								echo '<h2>Error</h2><pre>' . $err . '</pre>';
								die();
							} 
							else {
								// Update Table, Save Inquiry Status 
								// Note: Successful Inquiry means complete successful sale was done.
								//echo "Inquiry Response is : " . $resultStr . "";
							///////////////// SETTLE REQUEST
								// $terminalId = $_POST['TerminalId'];
								// $userName = $_POST['UserName'];
								// $userPassword = $_POST['UserPassword'];
								// $orderId = $_POST['SettleOrderId'];
								$settleSaleOrderId = $SaleOrderId;
								$settleSaleReferenceId = $SaleReferenceId;


								// Check for an error
								$err = $client->getError();
								if ($err) {
									echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
									die();
								}
								  
								$parameters = array(
									'terminalId' => $terminalId,
									'userName' => $userName,
									'userPassword' => $userPassword,
									'orderId' => $orderId,
									'saleOrderId' => $settleSaleOrderId,
									'saleReferenceId' => $settleSaleReferenceId);

								// Call the SOAP method
								$result = $client->call('bpSettleRequest', $parameters, $namespace);

								// Check for a fault
								if ($client->fault) {
									echo '<h2>Fault</h2><pre>';
									print_r($result);
									echo '</pre>';
									die();
								} 
								else {
									$resultStr = $result;
									
									$err = $client->getError();
									if ($err) {
										// Display the error
										echo '<h2>Error</h2><pre>' . $err . '</pre>';
										die();
									} 
									else {
										// Update Table, Save Settle Status 
										// Note: Successful Settle means that sale is settled.
										//echo "Settle Response is : " . $VazeiyatKharid . "";
										echo "Settle Response is CC : " . $VazeiyatKharid;
									}// end Display the result
								}// end Check for errors									

								
								
								echo "Inquiry Response is BB : " . $VazeiyatKharid;
							}// end Display the result
						}// end Check for errors				
				
				
				// Display the error				
				echo '<h2>Error</h2><pre>' . $err . '</pre>';
				die();
			} 
			else {
				// Display the result
				// Update Table, Save Verify Status 
				// Note: Successful Verify means complete successful sale was done.
				//echo "Verify Response is : " . $VazeiyatKharid . "";
				//echo "Verify Response is FF : " . $VazeiyatKharid;
				
						///////////////// SETTLE REQUEST
							// $terminalId = $_POST['TerminalId'];
							// $userName = $_POST['UserName'];
							// $userPassword = $_POST['UserPassword'];
							// $orderId = $_POST['SettleOrderId'];
							$settleSaleOrderId = $SaleOrderId;
							$settleSaleReferenceId = $SaleReferenceId;


							// Check for an error
							$err = $client->getError();
							if ($err) {
								echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
								die();
							}
							  
							$parameters = array(
								'terminalId' => $terminalId,
								'userName' => $userName,
								'userPassword' => $userPassword,
								'orderId' => $orderId,
								'saleOrderId' => $settleSaleOrderId,
								'saleReferenceId' => $settleSaleReferenceId);

							// Call the SOAP method
							$result = $client->call('bpSettleRequest', $parameters, $namespace);

							// Check for a fault
							if ($client->fault) {
								echo '<h2>Fault</h2><pre>';
								print_r($result);
								echo '</pre>';
								die();
							} 
							else {
								$resultStr = $result;
								
								$err = $client->getError();
								if ($err) {
									// Display the error
									echo '<h2>Error</h2><pre>' . $err . '</pre>';
									die();
								} 
								else {
									// Update Table, Save Settle Status 
									// Note: Successful Settle means that sale is settled.
									//echo "Settle Response is : " . $VazeiyatKharid . "";
									//echo "Settle Response is AA : " . $VazeiyatKharid;
								}// end Display the result
							}// end Check for errors	
				
			}// end Display the result
		}// end Check for errors
//================================================================================================================================================
//================================================================================================================================================
?>
<?php
// در صورت نبودن مقدار ارسالی توسط بانک به صفحه اصلای انتقال داده میشود
if(!isset($_POST['RefId']))
  {
	 print ("<script language='javascript'>window.navigate('index.php');</script>");
  }
  else
  {
?>
<div class="alert alert-info alert-dismissable">
<?php
//   معنی مقدار های ارسال شده از بانک و نمایش پیغام های مناسب نسبت به آن
$result = $_POST['ResCode'];
$resultStr = $result;

			if($VazeiyatKharid=="0")
			{
				echo '<div class="alert alert-success alert-dismissable">'.VazeiyatKharid().'</div>';
			}
			else
			{
				echo '<div class="alert alert-danger alert-dismissable">'.VazeiyatKharid().'</div>';
	
}
?>
<?php
$Date = "$join_today - $time";
// چک می کند که آیا شخص واریز کننده مبلغ با شخصی که اطلاعات را دریافت میکند دارای آی پی یکسانی میباشد یا خیر
if($userip==$clint_ip)
{
	// چک می کند که آیا پرداختی با شناسه واریز مورد نظر در دیتابیس وجود دارد یا خیر
	if($resalt>0)
		{
			  
 if ($VazeiyatKharid == 0){  $_SESSION['VazeiyatKharid'] = 0 ; } else if ($VazeiyatKharid != 0) {  $_SESSION['VazeiyatKharid'] = 1 ; } 

			$select_database = mysql_query("update `ebanking_mellat` SET `ShenasePardakht`='{$ShenasePardakht}',`VazeiyatKharid`='{$VazeiyatKharid}',`ShomareDarkhast`='{$ShomareDarkhast}',`CodeMarjaeTarakonesh`='{$CodeMarjaeTarakonesh}',`date`='{$Date}' where id='".$userid."' ");
			echo mysql_affected_rows() > 0 ? '<h3 align="center" class=\"BRoya\">اطلاعات پرداخت شما ثبت شد در ساعت '.$time.' تاریخ '.$join_today.'</h3>' : 'Error'.mysql_error();
		}
		else
		{
						  
 if ($VazeiyatKharid == 0){  $_SESSION['VazeiyatKharid'] = 0 ; } else if ($VazeiyatKharid != 0) {  $_SESSION['VazeiyatKharid'] = 1 ; } 
 
			$select_database = mysql_query("INSERT INTO `ebanking_mellat` (`ShenasePardakht`,`VazeiyatKharid`,`ShomareDarkhast`,`CodeMarjaeTarakonesh`,`date`) VALUES ('{$ShenasePardakht}','{$VazeiyatKharid}','{$ShomareDarkhast}','{$CodeMarjaeTarakonesh}','{$Date}')");
			echo mysql_affected_rows() > 0 ? '<h3 align="center" class=\"BRoya\">اطلاعات پرداخت شما ثبت شد در ساعت '.$time.' تاریخ '.$join_today.'</h3>' : 'Error'.mysql_error();
		}
}

else
{
	echo "<center><h1>خطا</h1><br><h3>مشخصات کاربر واریز کننده وجه با مشخصات شما همخوانی ندارد</h3></center>";	
}
?></div>
<form action="getwayok.php" name="form1" id="form1" method="post">


  
<?php if ($VazeiyatKharid == 0){  $_SESSION['VazeiyatKharid'] = 0 ; $_SESSION['RefId'] = $CodeMarjaeTarakonesh ;} else if ($VazeiyatKharid != 0) {  $_SESSION['VazeiyatKharid'] = 1 ;  $_SESSION['RefId'] = 10 ; } ?>


  <div class="specification">



<div class="col-lg-3 col-xs-12"><div class="headline BHoma">شناسه پرداخت:</div></div>
<div class="col-lg-9 col-xs-12"><div class="headline BTitrBold"><?php echo $_POST['RefId'] ?></div></div>
  
<div class="col-lg-3 col-xs-12"><div class="headline BHoma">شماره درخواست:</div></div>
<div class="col-lg-9 col-xs-12"><div class="headline BTitrBold"><?php echo $ShomareDarkhast; ?></div></div>

 <?php if($VazeiyatKharid=="0") { $_SESSION['RefId']=$CodeMarjaeTarakonesh; ?>
    
<div class="col-lg-3 col-xs-12"><div class="headline BHoma">کد مرجع تراکنش:</div></div>
<div class="col-lg-9 col-xs-12"><div class="headline BTitrBold"><?php echo $CodeMarjaeTarakonesh; ?></div></div>

 <?php } ?>
        
<div class="col-lg-3 col-xs-12"><div class="headline BHoma">مبلغ واریزی:</div></div>
<div class="col-lg-9 col-xs-12"><div class="headline BTitrBold"><?php  echo $_SESSION['jam'];  ?> ریال</div></div>
    
<div class="col-lg-3 col-xs-12"><div class="headline BHoma">وضعیت پرداخت:</div></div>
<div class="col-lg-9 col-xs-12">    <div class="headline BTitrBold">
<?php if($VazeiyatKharid=="0")
{ echo '<p style="color:#063; width: 220px">'.VazeiyatKharid().'</p>';  ?> <input type="hidden" name="par" id="par" value="1" /> <?php
	 $re=mysql_query("UPDATE `finicals` SET `finical_shenasepardakht` = '".$RefId."' , `finical_codmarjatarakonesh` = '".$SaleReferenceId."'  , `finical_shomaredarkhast` = '".$SaleOrderId."' , `finical_payment` = '1', `finical_paymentdate` = NOW()  WHERE `id` = '". $_SESSION['finicalid']."' LIMIT 1"); 
  $re=mysql_query("UPDATE `belitrezerv` SET `blr_status` = '2'     WHERE `blr_codrezerv` = '". $_SESSION['codrezerv']."' LIMIT 999");  
	 $re=mysql_query("UPDATE `belit` SET `bel_status` = '2'     WHERE `bel_codrezerv` = '". $_SESSION['codrezerv']."' LIMIT 999");   } else 
{ echo '<p style="color:#F00; width: 220px">'.VazeiyatKharid().'</p>'; ?> <input type="hidden" name="par" id="par" value="0" /> <?php
	 $re=mysql_query("UPDATE `finicals` SET `finical_shenasepardakht` = '".$RefId."' , `finical_codmarjatarakonesh` = '".$SaleReferenceId."'  , `finical_shomaredarkhast` = '".$SaleOrderId."' , `finical_paymentdate` = NOW()   WHERE `id` = '". $_SESSION['finicalid']."' LIMIT 1"); 
 }   } ?>
    </div></div>  
    
<div class="col-lg-3 col-xs-12"></div>
<div class="col-lg-9 col-xs-12"></div>




    
    <input type="submit" class="BTitrBold" value="تائید پرداخت" name="PayRequestButton">
    
    </div>
    
 </div> <div class="col-lg-3 col-xs-12">	</div>
</div> 
 

  </div>
</div>

   <!-- jQuery 2.1.4 -->
    <script src="../build/style/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="../build/style/bootstrap/css/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.4 -->
    <script src="../build/style/bootstrap/js/bootstrap.min.js"></script>
    <!-- Morris.js charts -->
    <script src="../build/style/bootstrap/css/raphael-min.js"></script>
    <script src="../build/style/plugins/morris/morris.min.js"></script>
    <!-- Sparkline -->
    <script src="../build/style/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="../build/style/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="../build/style/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="../build/style/plugins/knob/jquery.knob.js"></script>
    <!-- daterangepicker -->
    <script src="../build/style/bootstrap/css/moment.min.js"></script>
    <script src="../build/style/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="../build/style/plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="../build/style/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
    <script src="../build/style/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
 
     <script src="../build/style/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../build/style/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- SlimScroll -->
  
    <!-- FastClick -->
    <script src="../build/style/plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../build/style/dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../build/style/dist/js/demo.js"></script>
 
</body>
</html>