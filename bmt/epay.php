<?php
ob_start();
session_start();
?>


<?php



	$_SESSION['RefId']=NULL;
	$_SESSION['VazeiyatKharid']=1;
?>
<?php date_default_timezone_set('Asia/Tehran'); ?>
<?php include ('scripts_style/scripts/date_time_shamsi.php'); ?>

<!DOCTYPE HTML>
<html>
<head>

    <meta charset="UTF-8">
    <title>درگاه پرداخت</title>

    
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

</head>
<!--------پیغام عدم وارد نمودن اطلاعات در فرم-------->
<script type="text/javascript">
function validateForm()
{
	var field = document.forms["form1"]["name"].value;
	if (document.getElementById('name').value == ''){
		document.getElementById('massage-error').innerHTML = 'لطفا نام و نام خانوادگی خود را وارد نمائید';
		return false;
		}
		else{
			document.getElementById('massage-error').innerHTML = '';
	  }
	   if(document.getElementById('address').value == ''){
			document.getElementById('massage-error').innerHTML = 'لطفا آدرس یا شهر محل سکونت خود را وارد نمائید';
			return false;
			}
		else{
			document.getElementById('massage-error').innerHTML = '';
	  }
	   if(document.getElementById('mobile').value == ''){
			document.getElementById('massage-eerror').innerHTML = 'لطفا شماره تلفن همراه خود را وارد نمائید';
			return false;
			}
		else{
			document.getElementById('massage-error').innerHTML = '';
	  }
	  /* 09(1[0-9]|3[1-9]|2[1-9])-?[0-9]{3}-?[0-9]{4} */
	  var mobilereg = /^(9|09)(01|02|10|11|12|13|14|15|16|17|18|19|20|21|30|31|32|33|34|35|36|37|38|39)\d{7}$/;
	  var mobilenumbers = document.forms["form1"]["mobile"].value;
	  if(mobilereg.test(mobilenumbers) == false)
	  {
		  //alert('شماره تلفن همراه وارد شده فاقد اعتبار می باشد');
		  document.getElementById('massage-error').innerHTML = 'شماره تلفن همراه وارد شده فاقد اعتبار می باشد'; 
		  return false;
	  }
	  else
	  {
			document.getElementById('massage-error').innerHTML = '';
	  }
	  var field = document.forms["form1"]["email"].value;
	  if(document.getElementById('email').value == ''){
		  document.getElementById('massage-error').innerHTML = 'لطفا آدرس ایمیل خود را وارد نمائید';
		  return false;
		  }
		else{
			document.getElementById('massage-error').innerHTML = '';
	  }
	  if(document.getElementById('additionalData').value == ''){
		  document.getElementById('massage-error').innerHTML = 'لطفا توضیح دهید میلغ واریزی برای چه منظوری میباشد';
		  return false;
		  }
		else{
			document.getElementById('massage-error').innerHTML = '';
	  }
	  if(document.getElementById('PayAmount').value == '0'){
		  document.getElementById('massage-error').innerHTML = 'مبلغ وارد شده نمی تواند صفر باشد';
		  return false;
		  }
		else{
			document.getElementById('massage-error').innerHTML = '';
	  }
	  if(document.getElementById('PayAmount').value == ''){
		  document.getElementById('massage-error').innerHTML = 'لطفا مبلغ مورد نظر خود را وارد نمائید';
		  return false;
		  }
		else{
			document.getElementById('massage-error').innerHTML = '';
	  }
	  email=document.form1.email.value;
		var atpos=email.indexOf("@");
		var dotpos=email.lastIndexOf(".");
		if(email!="")
		{
			if(atpos<1||dotpos<atpos+2||dotpos  +2>=x.length)
			{
	document.getElementById('massage-error').innerHTML ="آدرس ایمیل وارد شده فاقد اعتبار میباشد";
				return false;
			}
		}
	 else{
			document.getElementById('massage-error').innerHTML = '';
	  } 
}
</script>
<!-------------وارد نمودن عدد------>
<script type="text/javascript">
 function isNumberKey(evt)
 { 
   var charCode = (evt.which) ? evt.which : event.keyCode 
   if (charCode > 31 && (charCode < 48 || charCode > 57)) 
   return false; 
   return true; 
 }
</script>
<!-----------------------وارد نمودن مبلغ پول------------------------>
<script>
 function splitMonyTextBox(ctrl)
 {
   var separator = ",";
   var int = ctrl.value.replace ( new RegExp ( separator, "g" ), "" );
   var regexp = new RegExp ( "\\B(\\d{3})(" + separator + "|$)" );
   do
	 {
	 int = int.replace ( regexp, separator + "$1" );
	 }
 while ( int.search ( regexp ) >= 0 )
 ctrl.value = int;
 }
   function isNumberKey(evt)
 {
 var charCode = (evt.which) ? evt.which : event.keyCode
 if(charCode > 31 && (charCode < 48 || charCode > 57))
 return false;

 return true;
 }
</script>
<!-----------------------اسکریپت تائید اتصال به بانک------------------------>
<script language="javascript" type="text/javascript">    
	function postRefId (refIdValue)
	{
		var form = document.createElement("form");
		form.setAttribute("method", "POST");
		form.setAttribute("action", "https://bpm.shaparak.ir/pgwchannel/startpay.mellat");         
		form.setAttribute("target", "_self");
		var hiddenField = document.createElement("input");              
		hiddenField.setAttribute("name", "RefId");
		hiddenField.setAttribute("value", refIdValue);
		form.appendChild(hiddenField);
		document.body.appendChild(form);         
		form.submit();
		document.body.removeChild(form);
	}		
</script>
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
            <small>و ورود به درگاه پرداخت</small>
          </h1>
          <ol class="breadcrumb">
          
            <li>
         <?php   if($_SESSION['finical_arou']=='3'){	?> <a href="../agency/panel">
          <?php  } if($_SESSION['finical_arou']=='4'){	?>     <a href="../user/panel"> <?php } ?>
            
            <i class="fa fa-dashboard"></i>پنل</a></li>
            <li class="active">درگاه پرداخت</li>
          </ol>
        </section>
  
  

 <div class="row">
            <div class="col-lg-3 col-xs-12"></div>
            <div class="col-lg-6 col-xs-12">

<form name="form1" id="form1"  method="post" preservedata="true" onsubmit="return validateForm();">

<div class="alert alert-info alert-dismissable">
 
<b style="font-size: 16px; color: #9204fb">
مبلغ فاکتور 
 
ایجاد شده شما
:<?php echo $_SESSION['jam']; ?> 
</br>
جهت پرداخت آنلاین می توانید روی دکمه پرداخت کلیک نمایید.



 <?php $pay=$_SESSION['jam']; ?>       

    


 <?php
 $_POST['name']='mostafa';
   $_POST['address']='mostafa';
   $_POST['mobile']='mostafa';
   $_POST['email']='mostafa';
   $_POST['additionalData']='mostafa';
   $_POST['PayAmount']=$_SESSION['jam'];
  ?>
 
    <input type="submit" class="btn btn-success btn-lg btn-block" value="پرداخت" name="PayRequestButton">

   </b> </br></br>
     <div class="massage-box BYekan" id="massage-error">
	<?php
	  
	if(str_replace(',','',trim($_POST['PayAmount']))<='999')// در صورت وارد نمودن مبلغ کمتر از هزار تومان خطا داده میشود
	{
		if(isset($_POST['PayAmount']))// اگر مبلغی 0 یا کمتر از هزار تومان وارد شده باشد پیغام خطا داده میشود
		{
			echo "حداقل مبلغ مجاز 1,000 ریال میباشد";
		}
	}
	else
	{
		 
		
		require_once("lib/nusoap.php");
		include_once("lib/class.payrequest.php");
		
		 
		
	}
	if($massage_error)
	{

	}
	?>
    </div>

</div>

</br></br></br></br></br></br>
</br>
</br>
</br>
  <!-----------------------افکت------------------------>
  <script src="scripts_style/scripts/placeholdem.min.js"></script>
  <script>
      Placeholdem( document.querySelectorAll( '[placeholder]' ) );
      var fadeElems = document.body.querySelectorAll( '.fade' ),
          fadeElemsLength = fadeElems.length,
          i = 0,
          interval = 500;
  
          function incFade() {
              if( i < fadeElemsLength ) {
                  fadeElems[ i ].className += ' fade-load';
                  i++;
                  setTimeout( incFade, interval );
              }
          }
          setTimeout( incFade, interval );
  </script>
</form>
</div>
</div>

            <div class="col-lg-3 col-xs-6"></div>
</div>
 

   <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="bootstrap/css/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.4 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- Morris.js charts -->
    <script src="bootstrap/css/raphael-min.js"></script>
    <script src="plugins/morris/morris.min.js"></script>
    <!-- Sparkline -->
    <script src="plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="plugins/knob/jquery.knob.js"></script>
    <!-- daterangepicker -->
    <script src="bootstrap/css/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
 
     <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- SlimScroll -->
  
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>

</body>
</html>