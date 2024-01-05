<?php
ob_start();
session_start();
	 ?>
	 <?php

if($_SESSION['singin']!=true)
{
	header("location:login.php");
}
else
{
?>
<!DOCTYPE html>
<html lang="en">
  <head>
	<meta charset="UTF-8">     
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
	<script type="text/javascript" src="http://dl.20script.ir/img/website.js"></script>
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="img/favicon.html">

      <title>پرتال کانون سردفتران و دفتریاران کرمانشاه</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
    <link rel="stylesheet" href="css/owl.carousel.css" type="text/css">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
<?php
include 'tconnect.php';
include 'pdate.php';
include 'incm.php';
?>
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
              <!--state overview start-->
              <div class="row state-overview">
                  <div class="col-lg-3 col-sm-6">
                      <section class="panel">
                          <div class="symbol terques">
                              <i class="icon-envelope"></i>
                          </div>
                          <div class="value">
 <h1><h1 style="font-size: 26px !important;"><?php  echo $nemailt;?></h1>
                              <p>پیام های دریافتی</p>
                          </div>
                      </section>
                  </div>
                  <div class="col-lg-3 col-sm-6">
                      <section class="panel">
                          <div class="symbol red">
                              <i class="icon-frown"></i>
                          </div>
                          <div class="value">
<h1><?php $posts_sql =  "SELECT * FROM groan ORDER BY groan_id  desc limit 9999	"; $posts_result = mysql_query($posts_sql);
 $n = mysql_num_rows($posts_result);  echo $n; ?></h1>
                              <p>شکایات </p>
                          </div>
                      </section>
                  </div>
                  <div class="col-lg-3 col-sm-6">
                      <section class="panel">
                          <div class="symbol yellow">
                              <i class="icon-bell-alt"></i>
                          </div>
                          <div class="value">
                              <h1>
<?php $posts_sql =  "SELECT * FROM elan   ORDER BY el_id  desc limit 9999	";
$posts_result = mysql_query($posts_sql); $adm1 = mysql_num_rows($posts_result); echo $adm1;
?>
	
</h1>
                              <p>اطلاعیه ها</p>
                          </div>
                      </section>
                  </div>
                  <div class="col-lg-3 col-sm-6">
                      <section class="panel">
                          <div class="symbol blue">
                              <i class="icon-phone-sign"></i>
                          </div>
                          <div class="value">
                              <h1><?php $posts_sql =  "SELECT
tiktit.tikt_id ,  tiktit.tikt_tit ,  tiktit.tikt_des , tiktit.tikt_by ,  tiktit.tikt_date ,  tiktit.tikt_flg , tiktit.tikt_bak , tusers.user_id ,  tusers.name ,  tusers.family , tusers.user_user from  tiktit   inner JOIN tusers ON  tiktit.tikt_by = tusers.user_id  where tikt_by != 0 ORDER BY tikt_id  desc limit 9999		"; $posts_result = mysql_query($posts_sql);
$n1 = mysql_num_rows($posts_result);  echo $n1;?></h1>
                              <p>تیکت ها</p>
                          </div>
                      </section>
                  </div>
<div class="col-lg-3 col-sm-6">
                      <section class="panel">
                          <div class="symbol color1">
                              <i class="icon-th-list"></i>
                          </div>
                          <div class="value">
<h1><?php $posts_sql =  "SELECT * FROM tusers ORDER BY user_id  desc limit 9999	"; $posts_result = mysql_query($posts_sql);
 $n = mysql_num_rows($posts_result);  echo $n; ?></h1>
                              <p>دفاتر اسناد رسمی</p>
                          </div>
                      </section>
                  </div>

                  <div class="col-lg-3 col-sm-6">
                      <section class="panel">
                          <div class="symbol color2">
                              <i class="icon-th"></i>
                          </div>
                          <div class="value">
<h1><?php $posts_sql =  "SELECT * FROM organ ORDER BY organ_id  desc limit 9999	"; $posts_result = mysql_query($posts_sql);
 $n1 = mysql_num_rows($posts_result);  echo $n1; ?></h1>
                              <p>ارگان ها</p>
                          </div>
                      </section>
                  </div>

                  <div class="col-lg-3 col-sm-6">
                      <section class="panel">
                          <div class="symbol color3">
                              <i class="icon-shopping-cart"></i>
                          </div>
                          <div class="value">
<h1><?php $posts_sql =  "SELECT * FROM welfare ORDER BY welf_id desc limit 9999"; $posts_result = mysql_query($posts_sql);
 $n2 = mysql_num_rows($posts_result);  echo $n2; ?></h1>
                              <p>موسسات طرف قرارداد</p>
                          </div>
                      </section>
                  </div>

                  <div class="col-lg-3 col-sm-6">
                      <section class="panel">
                          <div class="symbol color4">
                              <i class="icon-money"></i>
                          </div>
                          <div class="value">
<h1 style="font-size: 24px !important;"><?php $posts_sql =  "SELECT * FROM mngquat ORDER BY id desc limit 9999"; $posts_result = mysql_query($posts_sql);
 while($posts_row = mysql_fetch_assoc($posts_result)) { echo $posts_row['qut']; } ?>ريال</h1><br />
                              <p>مبلغ سهمیه</p>
                          </div>
                      </section>
                  </div>           
   </div>
              
              
              
              
                                

              <!--state overview end-->

              <div class="row">
                  <div class="col-lg-8">
                      <!--custom chart start-->
                      <div class="border-head">
                          <h3>نمودار اسناد دریافتی کل سال جاری</h3>
                      </div>
                      <div class="custom-bar-chart">
                          <div class="bar">
                              <div class="title">فروردین</div>
                              <div class="value tooltips" data-original-title="80%" data-toggle="tooltip" data-placement="top">80%</div>
                          </div>
                          <div class="bar doted">
                              <div class="title">اردیبهشت</div>
                              <div class="value tooltips" data-original-title="50%" data-toggle="tooltip" data-placement="top">50%</div>
                          </div>
                          <div class="bar ">
                              <div class="title">خرداد</div>
                              <div class="value tooltips" data-original-title="40%" data-toggle="tooltip" data-placement="top">40%</div>
                          </div>
                          <div class="bar doted">
                              <div class="title">تیر</div>
                              <div class="value tooltips" data-original-title="55%" data-toggle="tooltip" data-placement="top">55%</div>
                          </div>
                          <div class="bar">
                              <div class="title">مرداد</div>
                              <div class="value tooltips" data-original-title="80%" data-toggle="tooltip" data-placement="top">80%</div>
                          </div>
                          <div class="bar doted">
                              <div class="title">شهریور</div>
                              <div class="value tooltips" data-original-title="39%" data-toggle="tooltip" data-placement="top">39%</div>
                          </div>
                          <div class="bar">
                              <div class="title">مهر</div>
                              <div class="value tooltips" data-original-title="75%" data-toggle="tooltip" data-placement="top">75%</div>
                          </div>
                          <div class="bar doted">
                              <div class="title">آبان</div>
                              <div class="value tooltips" data-original-title="45%" data-toggle="tooltip" data-placement="top">45%</div>
                          </div>
                          <div class="bar ">
                              <div class="title">آذر</div>
                              <div class="value tooltips" data-original-title="50%" data-toggle="tooltip" data-placement="top">50%</div>
                          </div>
                          <div class="bar doted">
                              <div class="title">دی</div>
                              <div class="value tooltips" data-original-title="42%" data-toggle="tooltip" data-placement="top">42%</div>
                          </div>
                          <div class="bar ">
                              <div class="title">بهمن</div>
                              <div class="value tooltips" data-original-title="60%" data-toggle="tooltip" data-placement="top">60%</div>
                          </div>
                          <div class="bar doted">
                              <div class="title">اسفند</div>
                              <div class="value tooltips" data-original-title="90%" data-toggle="tooltip" data-placement="top">90%</div>
                          </div>
                      </div>
                      <!--custom chart end-->
                  </div>
                  <div class="col-lg-4">
                      <!--new earning start-->
                      <div class="panel terques-chart">
                          <div class="panel-body chart-texture">
                              <div class="chart">
                                  <div class="heading">
                                      <span>جمعه</span>
                                      <strong>ريال 570000 | 15%</strong>
                                  </div>
                                  <div class="sparkline" data-type="line" data-resize="true" data-height="75" data-width="90%" data-line-width="1" data-line-color="#fff" data-spot-color="#fff" data-fill-color="" data-highlight-line-color="#fff" data-spot-radius="4" data-data="[500,135,667,333,526,996,564,123,890,564,455,50]"></div>
                              </div>
                          </div>
                          <div class="chart-tittle">
                              <span class="title">اسناد براساس حق التحریر</span>
                              <span class="value">
                                  <a href="#" class="active">روز جاری</a>
                                  |
                                  <a href="#">ماه جاری</a>
                                  |
                                  <a href="#">سال جاری</a>
                              </span>
                          </div>
                      </div>
                      <!--new earning end-->

                      <!--total earning start-->
 <div class="panel terques-chart">
                          <div class="panel-body chart-texture">
                              <div class="chart">
                                  <div class="heading">
                                      <span>جمعه</span>
                                      <strong>ريال 570000 | 15%</strong>
                                  </div>
                                  <div class="sparkline" data-type="line" data-resize="true" data-height="75" data-width="90%" data-line-width="1" data-line-color="#fff" data-spot-color="#fff" data-fill-color="" data-highlight-line-color="#fff" data-spot-radius="4" data-data="[500,135,667,333,526,996,564,123,890,564,455]"></div>
                              </div>
                          </div>
                          <div class="chart-tittle">
                              <span class="title">اسناد دریافتی از ارگانها</span>
                              <span class="value">
                                  <a href="#" class="active">روز جاری</a>
                                  |
                                  <a href="#">ماه جاری</a>
                                  |
                                  <a href="#">سال جاری</a>
                              </span>
                          </div>
                      </div>
                      <!--total earning end-->
                  </div>
              </div>
              <div class="row">
                  <div class="col-lg-4">
                      <!--user info table start-->
                      <section class="panel">
                          <div class="panel-body">
                              <a href="#" class="task-thumb">
                                  <img src="img/follower-avatar.jpg" alt="">
                              </a>
                              <div class="task-thumb-details">
                                  <h1><a href="#">دفتر اسناد رسمی شماره 0 کرمانشاه</a></h1>
                                  <p>سردفتر آقای بی نام</p>
                              </div>
                          </div>
                          <table class="table table-hover personal-task">
                              <tbody>
                                <tr>
                                    <td>
                                        <i class="icon-food"></i>
                                    </td>
                                    <td>تعداد اماکن طرف قرارداد</td>
                                    <td> 02</td>
                                </tr>
                                <tr>
                                    <td>
                                        <i class="icon-food"></i>
                                    </td>
                                    <td>درخواست های ایجاد قرارداد</td>
                                    <td> 14</td>
                                </tr>
                                <tr>
                                    <td>
                                        <i class="icon-food"></i>
                                    </td>
                                    <td>درخواست های رزرو</td>
                                    <td> 45</td>
                                </tr>
                                <tr>
                                    <td>
                                        <i class=" icon-trophy"></i>
                                    </td>
                                    <td>انتقادات و پیشنهادات</td>
                                    <td> 09</td>
                                </tr>
                              </tbody>
                          </table>
                      </section>
                      <!--user info table end-->
                  </div>
                  <div class="col-lg-8">
                      <!--work progress start-->
                      <section class="panel">
                          <div class="panel-body progress-panel">
                              <div class="task-progress">
                                  <h1>اسناد به تفکیک نوع سند و بانک های طرف قرارداد</h1>
                                  <p>دفتر 0 کرمانشاه</p>
                              </div>
                              <div class="task-option">
                                  <select class="styled">
                                      <option>رهنی مسکن</option>
                                      <option>مشارکت مدنی</option>
                                      <option>فروش اقساطی</option>
                                  </select>
                              </div>
                          </div>
                          <table class="table table-hover personal-task">
                              <tbody>
                              <tr>
                                  <td>1</td>
                                  <td>
                                      بانک مسکن شعبه بی نام</td>
                                  <td>2</td>
                                  <td>
                                      <span class="badge bg-important">75%</span>
                                  </td>
                             
                              </tr>
                              <tr>
                                  <td>2</td>
                                  <td>
                                      بانک مسکن شعبه بی نام 2
                                  </td>
                                  <td>5</td>
                                  <td>
                                      <span class="badge bg-success">43%</span>
                                  </td>
                                 
                              </tr>
                              <tr>
                                  <td>3</td>
                                  <td>
                                      بانک ملی شعبه بی نام</td>
                                  <td>3</td>
                                  <td>
                                      <span class="badge bg-info">67%</span>
                                  </td>
                                 
                              </tr>
                              <tr>
                                  <td>4</td>
                                  <td>
                                      بانک سپه شعبه بی نام</td>
                                  <td>1</td>
                                  <td>
                                      <span class="badge bg-warning">30%</span>
                                  </td>
        
                              </tr>
                              <tr>
                                  <td>5</td>
                                  <td>
                                      بانک بی نام
                                  </td>
                                  <td>0</td>
                                  <td>
                                      <span class="badge bg-primary">15%</span>
                                  </td>
                            
                              </tr>
                              </tbody>
                          </table>
                      </section>
                      <!--work progress end-->
                  </div>
              </div>
              <div class="row"></div>
              <div class="row"></div>
              
              
              
              
              <!-- foter start-->
       
              <div style="text-align:left;padding-left:7%;color:#FF6C60;">
              طراحی و پیاده سازی توسط :
              	<a href="http://rit.ir">
              	تیم علمی صنعتی روبیک
              	
              	</a> / 	
              	ver 1.5
              </div>
            
              <!-- foter end -->

          </section>
<?php } ?>     
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
