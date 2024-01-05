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
            <li><a href="../student/panel"><i class="fa fa-dashboard"></i>پنل</a></li>
            <li class="active"> پرداخت </li>
        </section>
  
  

 <div class="row">
            <div class="col-lg-3 col-xs-12"></div>
            <div class="col-lg-6 col-xs-12">
                   
          <div class="specification">
        
<form action="getwayok.php" name="form1" id="form1" method="post">
        
        
        
        
 <?php
    $Amount = $_SESSION['jam']; //Amount will be based on Toman  - Required
    $Authority = $_GET['Authority'];

    if ($_GET['Status'] == 'OK') {
        // URL also can be ir.zarinpal.com or de.zarinpal.com
        $client = new SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

        $result = $client->PaymentVerification([
            'MerchantID'     => $MerchantID,
            'Authority'      => $Authority,
            'Amount'         => $Amount,
        ]);
        
        ?>       
        
        
        
        
        
        
        
        <?php

        if ($result->Status == 100) {


	 $re=mysql_query("UPDATE `finicals` SET `finical_shenasepardakht` = '".$Authority."' , `finical_codmarjatarakonesh` = '".$result->RefID."'   , `finical_payment` = '1', `finical_paymentdate` = NOW()  WHERE `id` = '". $_SESSION['finicalid']."' LIMIT 1"); 
	 
	 
  ?>

<div class="col-lg-3 col-xs-12"><div class="headline BHoma">شماره درخواست:</div></div>
<div class="col-lg-9 col-xs-12"><div class="headline BTitrBold"><?php echo  $Authority;  ?></div></div>

<div class="col-lg-3 col-xs-12"><div class="headline BHoma">شماره تراکنش:</div></div>
<div class="col-lg-9 col-xs-12"><div class="headline BTitrBold"><?php echo  $result->RefID;  ?></div></div>
  
<div class="col-lg-3 col-xs-12"><div class="headline BHoma">مبلغ فاکتور:</div></div>
<div class="col-lg-9 col-xs-12"><div class="headline BTitrBold"><?php echo  $_SESSION['jam']; ?> ريال</div></div>
            
<div class="col-lg-3 col-xs-12"><div class="headline BHoma">وضعیت پرداخت:</div></div>
<div class="col-lg-9 col-xs-12">    <div class="headline BTitrBold">
<p style="color:#2ee61a; width: 220px">پرداخت فاکتور با موفقیت انجام شد</p>
 </div></div> 
            
         
            
            
          <?php   
            
            
        } else {
            echo $result->Status; ?>
            
  
<div class="col-lg-3 col-xs-12"><div class="headline BHoma">شماره درخواست:</div></div>
<div class="col-lg-9 col-xs-12"><div class="headline BTitrBold"><?php echo  $Authority;  ?></div></div>
  
<div class="col-lg-3 col-xs-12"><div class="headline BHoma">مبلغ فاکتور:</div></div>
<div class="col-lg-9 col-xs-12"><div class="headline BTitrBold"><?php echo  $_SESSION['jam']; ?> ريال</div></div>

            <div class="col-lg-3 col-xs-12"><div class="headline BHoma">وضعیت پرداخت:</div></div>
<div class="col-lg-9 col-xs-12">    <div class="headline BTitrBold">
<p style="color:#ff0000; width: 220px">پرداخت فاکتور انجام نشد</p>
 </div></div> 
            
            <?php
            
        		 $re=mysql_query("UPDATE `finicals` SET `finical_shomaredarkhast` = '".$Authority."'   , `finical_paymentdate` = NOW()  WHERE `id` = '". $_SESSION['finicalid']."' LIMIT 1");  
            
        }
    } else { ?>
    	
    	
    	
    	
    	 
            
  
<div class="col-lg-3 col-xs-12"><div class="headline BHoma">شماره درخواست:</div></div>
<div class="col-lg-9 col-xs-12"><div class="headline BTitrBold"><?php echo  $Authority;  ?></div></div>
  
<div class="col-lg-3 col-xs-12"><div class="headline BHoma">مبلغ فاکتور:</div></div>
<div class="col-lg-9 col-xs-12"><div class="headline BTitrBold"><?php echo  $_SESSION['jam']; ?> ريال</div></div>

            <div class="col-lg-3 col-xs-12"><div class="headline BHoma">وضعیت پرداخت:</div></div>
<div class="col-lg-9 col-xs-12">    <div class="headline BTitrBold">
<p style="color:#ff0000; width: 220px">پرداخت فاکتور انجام نشد</p>
 </div></div> 
            
            <?php
            
        		 $re=mysql_query("UPDATE `finicals` SET `finical_shomaredarkhast` = '".$Authority."'   , `finical_paymentdate` = NOW()  WHERE `id` = '". $_SESSION['finicalid']."' LIMIT 1");  
        
    }
    
    ?>
    
<input type="submit" class="BTitrBold" value="تائید" name="PayRequestButton">
 </div> 
 </form>
 <div class="col-lg-3 col-xs-12">	</div> </div>  </div>  </div>    </div> </div> 
 
 
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
 