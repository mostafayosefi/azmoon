<?php
ob_start();
session_start();

	 ?>
	 <?php

if($_SESSION['login']!=true)
{
	header("location:login.php");
}
else
{
	
if ( ($_SESSION['flgtell']==0) ||  ($_SESSION['flgemail']==0) ||  ($_SESSION['flgcard']==0) ||  ($_SESSION['flguser']==0) ) { header("location:activation.php"); }
	
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>پایان تراکنش</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.4 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="bootstrap/css/font-awesome.min.css">
    <!-- Ionicons 2.0.0 -->
    <link rel="stylesheet" href="bootstrap/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <link rel="stylesheet" href="dist/fonts/fonts-fa.css">
    <link rel="stylesheet" href="dist/css/bootstrap-rtl.min.css">
      <link rel="stylesheet" href="dist/css/bootstrap-rtl.min.css">
   
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="skin-blue sidebar-mini">
    <div class="wrapper">

<?php
include 'tconnect.php';
include 'pdate.php';
include 'incu.php';

?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            پیشخوان
            <small>پنل کاربری</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> خانه</a></li>
            <li class="active">پیشخوان</li>
          </ol>
        </section>




<div class="col-lg-4 col-xs-12">

</div>


<?php if ($_POST['par']==1) { ?>


<div class="col-lg-4 col-xs-12">

<?php if ($_SESSION['rezervation']==1){ ?>
<?php	
$reez=mysql_query("UPDATE `rezerv` SET `rezerv_flg` = '1' WHERE `rezerv_id` = '".$_SESSION['idreza']."'  && `rezerv_flg` = '0'  ORDER BY `rezerv_id`   LIMIT   1  ");		
$rz=mysql_query("UPDATE `financial` SET `financial_flg` = '1' ,`financial_sumre` = '".$_SESSION['jam']."' , `financial_refid` = '".$_SESSION['RefId']."', `financial_paydate` = NOW() WHERE `financial_rez` = '".$_SESSION['idreza']."'  && `financial_flg` = '0'  ORDER BY `financial_id`   LIMIT   1  ");


 $ref=mysql_query("INSERT INTO notification (`notification_by`,`notification_date`,`notification_rez`) VALUES ( '$_SESSION[user_id]',NOW(),'$_SESSION[idreza]')"); 



		?>
<div class="callout callout-success">
                    <h4>پرداخت مبلغ رزرو شما با موفقیت انجام شد.</h4>
                    <p>مبلغ پرداخت شده فاکتور شما: <?php echo $_SESSION['jam']; ?>تومان</p>
</div>
<?php ?>
<?php  } else if ($_SESSION['rezervation']==2){ ?>
<?php	
$reez=mysql_query("UPDATE `rezerv` SET `rezerv_flg` = '1' , `rezerv_as` = '1' , `rezerv_asdate` =  NOW() , `rezerv_onl` = '2' WHERE `rezerv_id` = '".$_SESSION['idreza']."'  && `rezerv_flg` = '0'  ORDER BY `rezerv_id`   LIMIT   1  ");


$pbcdj = "SELECT * FROM rezerv where`rezerv_cat` = " . htmlentities($_SESSION['catrez'])." && rezerv_flg='1' && rezerv_as='1' && rezerv_id = '".$_SESSION['idreza']."'  ORDER BY `rezerv_id` desc  LIMIT 1 ";
$rbcdj = mysql_query($pbcdj); while($posts_rowj = mysql_fetch_assoc($rbcdj)) { $mof=$posts_rowj['rezerv_num']; }


$ree=mysql_query("UPDATE `number` SET `num_flg` = '1' , `num_asdate` = NOW() ,    `num_rez` = '".$_SESSION['idreza']."' ,  `num_by` = '".$_SESSION['user_id']."' , `num_onl` ='2'   WHERE `num_cat` = '".$_SESSION['catrez']."'  && `num_flg` = '0'     ORDER BY `num_id`   LIMIT    ".$mof."  ");
		
$rz=mysql_query("UPDATE `financial` SET `financial_flg` = '1' , `financial_refid` = '".$_SESSION['RefId']."', `financial_paydate` = NOW() ,`financial_sumre` = '".$_SESSION['jam']."' WHERE `financial_rez` = '".$_SESSION['idreza']."'  && `financial_flg` = '0'  ORDER BY `financial_id`   LIMIT   1  ");	


 $ref=mysql_query("INSERT INTO notification (`notification_by`,`notification_date`,`notification_rez`) VALUES ( '$_SESSION[user_id]',NOW(),'$_SESSION[idreza]')"); 

	?>
<div class="callout callout-success">
                    <h4>پرداخت با موفقیت انجام شد.</h4>
                    <p>مبلغ پرداخت شده فاکتور شما: <?php echo $_SESSION['jam']; ?>تومان</p>
</div>
<?php ?>
<?php  } else if ($_SESSION['rezervation']==3){ ?>
<?php	

$reez=mysql_query("UPDATE `licence` SET `licence_flg` = '1' , `licence_as` = '1' ,  `licence_asdate` = NOW() , `licence_by` ='".$_SESSION['user_id']."' , `licence_refid` = '".$_SESSION['RefId']."'  WHERE `licence_cat` = '".$_SESSION['catid']."'  && `licence_flg` = '0'  && `licence_as` = '0'  ORDER BY `licence_id`   LIMIT   1  ");	




	?>
<div class="callout callout-success">
                    <h4>پرداخت هزینه لایسنس با موفقیت انجام شد.</h4>
                    <p>مبلغ پرداخت شده فاکتور شما: <?php echo $_SESSION['jam']; ?>تومان</p>
                    
                     <?php $posts_sql = "SELECT * FROM licence WHERE licence_cat=$_SESSION[catid] && licence_flg=1 && licence_as=1 ORDER BY `licence_id` desc LIMIT 1";	$posts_result = mysql_query($posts_sql);if(!$posts_result) {echo '<tr><td>The posts could not be displayed, please try again later.</tr></td></table>';} else 
 { echo '<table class="table table-hover"> <tr>
                      
                       <th>کد لایسنس</th></tr>';
  while($posts_row = mysql_fetch_assoc($posts_result)) { 
   echo '
   <tr> 

   <th><b style="font-size: 26px; color: #9204fb">' . $posts_row['licence_cod'] . '<b></th></tr>';
 
    }
    echo '<table>'; 
    } ?>
</div>
<?php } ?>

</div>

<?php  } else if ($_POST['par']==0) { ?>


<div class="col-lg-4 col-xs-12">
<div class="callout callout-danger">
                    <h4>خطا در پرداخت.</h4>
                    <p>متاسفانه مشکلی در پرداخت شما ایجاد شده است.</p>
                  
</div>
</div>


<?php } ?>




<div class="col-lg-4 col-xs-12"> 

</div>

<?php
 $_SESSION['idreza']=FALSE; 
 $_SESSION['rezervation']=0;
 $_SESSION['jam']=FALSE;
 $_SESSION['catrez']=FALSE;	
 $_SESSION['catid']=FALSE; 
 $_SESSION['RefId']=10;
 $_SESSION['VazeiyatKharid']=1; 
 ?>












      </div><!-- /.content-wrapper -->
  

    </div><!-- ./wrapper -->
<?php } ?>
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
     <script>
      $(function () {
        $("#example1").DataTable();
        
        
        
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
    </script>
  </body>
</html>
