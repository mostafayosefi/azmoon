<?php
ob_start();
session_start();
	 ?>
	 <?php



?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="img/favicon.html">

      <title>خبرخوان روزنو </title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
    <link rel="stylesheet" href="css/owl.carousel.css" type="text/css">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <link rel="shortcut icon" href="img/faviconrozno.ico" >

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<?php
include 'lib/config_accont.php';
?>
 
 
 

	
	     <section id="main-content">
            <section class="wrapper">	

 
      				<div class="row">
                    
                    <div class="col-lg-6">
                    
            <form class="" id="" method="post" action="">
                      
<div class="green box"><div class="form-group"><label class="col-lg-2 control-label">از خبر :</label>
<div class="col-lg-10"><input type="text" name="frombar" value=""  class="form-control"></input></div>
</div></div>  <br> <br>
                      
<div class="green box"><div class="form-group"><label class="col-lg-2 control-label">تا خبر : </label>
<div class="col-lg-10"><input type="text" name="tobar" value=""  class="form-control"></input></div>
</div></div>  <br> <br>
                      
<div class="green box"><div class="form-group"><label class="col-lg-2 control-label"></label>
<div class="col-lg-10"><input name="send" type="submit"  id="send" value="ثبت خبر" class="btn btn-shadow btn-success"></input></div>
</div></div>  <br> <br>
                     
                      
                      </form>
                                          
                    </div>
                    
                    <div class="col-lg-6">


 
<div class="alert alert-success fade in">
<button data-dismiss="alert" class="close close-sm" type="button">
<i class="icon-remove"></i>
</button>
خبر شما با موفقیت ثبت شد.  
<?php 

$from=(int)$_GET['from'];
$to=(int)$_GET['to'];
 
$b=$from; $e=$to; 

while ($b<$e) {
$tim=$b; $d=".html"; $c='news_detail_'.$b; $a='http://roozno.com/fa/news/'.$b;
		
$khoshnevis1 = file_get_contents($a);
preg_match('/<div style="direction: right;">.*?<div class="shareto"/s', $khoshnevis1, $matches1);
$idt=$matches1['0'];


$t = array("$idt");
$t1=$t[0];
$t2 = explode('<h1 style="padding: 0px;margin: 0px" class="title">', $t1);
$t3=$t2[1];
$t4 = explode('</h1>', $t3);
$t5=$t4[0];
$t6 = explode('">', $t5);
$t7=$t6[1];
$t8 = explode('</a>', $t7);
$t9=$t8[0];







$z = array("$idt");
$z1=$z[0];
$z2 = explode('<div class="body" style="text-align: justify;padding: 10px;"> 	<a class="roozeno_news" href="/"> روز نو : </a>', $z1);
$z3=$z2[1];

$z4 = explode('<div class="wrapper">', $z3);
$z5=$z4[0];


 









 ?>

<p><span style="color:#110000">کتوگری خبر:&nbsp;<span style="font-size:20px;color:#0d0df2"><?php echo 'ندارد'; ?></span></br> 

<p><span style="color:#110000">نوع خبر:&nbsp;<span style="font-size:20px;color:#0d0df2"><?php echo 'ندارد'; ?></span></br> 

<p><span style="color:#110000">تیتر خبر:&nbsp;<span style="font-size:20px;color:#0d0df2"><?php echo $t9; ?></span></br> 

<p><span style="color:#110000">خلاصه خبر:&nbsp;<span style="font-size:18px;color:#0d0df2"><?php echo 'ندارد'; ?></span></br>
  
<p><span style="color:#110000">متن خبر:&nbsp;<span style="font-size:16px;color:#0d0df2"><?php echo $z5; ?></span></br> 

<p><span style="color:#110000">تگ خبر:&nbsp;<span style="font-size:16px;color:#0d0df2"><?php echo $tg5.'،'.$tg8; ?></span></br>

<p><span style="color:#110000">آیدی خبر :&nbsp;<span style="font-size:16px;color:#0d0df2"><?php echo $b; ?></span></br> 
<hr>
<?php


$re=mysql_query("INSERT INTO new (`new_tit` , `new_des` , `new_mtn`  , new_mid , new_date ) VALUES ( '".$t9."' ,'0' ,'".$z5."' ,   '".$b."',  NOW()  )"); 



$b++;
} 

if($re){
	 header("location:../superadmin/rozno"); 
}
?>

</div> 

 
                           

 

</div> 
     
     
     
     
     
                    </div>
                    
                    </div>    	  
	  
	  
	  
	  
	  
	  
          </section> 
           </section>
     
      <!--main content end-->
  

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/jquery-1.8.3.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.scrollTo.min.js"></script>
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="js/jquery.sparkline.js" type="text/javascript"></script>
    <script src="assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
    <script src="js/owl.carousel.js" ></script>
    <script src="js/jquery.customSelect.min.js" ></script>

    <!--common script for all pages-->
    <script src="js/common-scripts.js"></script>

    <!--script for this page-->
    <script src="js/sparkline-chart.js"></script>
    <script src="js/easy-pie-chart.js"></script>

  <script>

      //owl carousel

      $(document).ready(function() {
          $("#owl-demo").owlCarousel({
              navigation : true,
              slideSpeed : 300,
              paginationSpeed : 400,
              singleItem : true

          });
      });

      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });

  </script>

  </body>
</html>
