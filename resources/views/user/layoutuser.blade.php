<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 
    <meta charset="UTF-8">

@yield('title')

<!DOCTYPE html> 


<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Mouldifi - A fully responsive, HTML5 based admin theme">
<meta name="keywords" content="Responsive, HTML5, admin theme, business, professional, Mouldifi, web design, CSS3">
 
    <link rel="stylesheet" type="text/css" href="{{env('APP_URL')}}/build/templogin/css/custom.css">
 
<!-- Entypo font stylesheet -->
<link href="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/entypo.css" rel="stylesheet">
<!-- /entypo font stylesheet -->

<!-- Font awesome stylesheet -->
<link href="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/font-awesome.min.css" rel="stylesheet">
<!-- /font awesome stylesheet -->

<!-- CSS3 Animate It Plugin Stylesheet -->
<link href="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/animations.css" rel="stylesheet">
<!-- /css3 animate it plugin stylesheet -->

<!-- Bootstrap stylesheet min version -->
<link href="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/bootstrap.min.css" rel="stylesheet">
<!-- /bootstrap stylesheet min version -->

<!-- Mouldifi core stylesheet -->
<link href="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/mouldifi-core.css" rel="stylesheet">
<!-- /mouldifi core stylesheet -->

<link href="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/mouldifi-forms.css" rel="stylesheet">

<link href="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/jquery.dataTables.css" rel="stylesheet">
<link href="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/buttons.dataTables.css" rel="stylesheet">

<!-- Bootstrap RTL stylesheet min version -->
<link href="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/bootstrap-rtl.min.css" rel="stylesheet">
<!-- /bootstrap rtl stylesheet min version -->

<!-- Mouldifi RTL core stylesheet -->
<link href="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/mouldifi-rtl-core.css" rel="stylesheet">
<!-- /mouldifi rtl core stylesheet -->
 
    <link rel="stylesheet" href="{{env('APP_URL')}}/build/servicepay/fonts/fonts-fa.css">
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
<![endif]-->

<!--[if lte IE 8]>
	<script src="js/plugins/flot/excanvas.min.js"></script>
<![endif]-->
</head>
<body>

<!-- Page container -->
<div class="page-container" >

	<!-- Page Sidebar -->
	<div class="page-sidebar">
	
		<!-- Site header  -->
		<header class="site-header">
		  <div class="site-logo"><a href="#"><img  width="160"  height="28" src="{{env('APP_URL')}}/public/images/{{Session::get('ind_himglog')}}" alt="Mouldifi" title="Mouldifi"></a></div>
		  <div class="sidebar-collapse hidden-xs"><a class="sidebar-collapse-icon" href="##"><i class="icon-menu"></i></a></div>
		  <div class="sidebar-mobile-menu visible-xs"><a data-target="#side-nav" data-toggle="collapse" class="mobile-menu-icon" href="##"><i class="icon-menu"></i></a></div>
		</header>
		<!-- /site header -->
		
		<!-- Main navigation -->


<ul id="side-nav" class="main-menu navbar-collapse collapse">

<li class="has-sub @if(Session::get('nav')=='paneluser') active @endif"><a href="{{env('APP_URL')}}/user/panel"><i class="icon-gauge"></i><span class="title" >پیشخوان</span></a>
<ul class="nav @if(Session::get('nav')!='paneluser') collapse @endif">
<li class="@if(Session::get('nav')=='paneluser') active @endif"><a href="{{env('APP_URL')}}/user/panel"><span class="title">پنل </span></a></li></ul></li>



			
<li class="has-sub @if((Session::get('nav')=='prodcurrencytransferid')||(Session::get('nav')=='viewscurrencytransfer')||(Session::get('nav')=='viewsprodbuy')) active @endif"><a href="{{env('APP_URL')}}/user/viewscurrencytransfer"><i class="icon-gauge"></i><span class="title" > پرداخت ارزی </span></a>
				<ul class="nav @if(Session::get('nav')!='prodcurrencytransferid') collapse @endif">

@foreach((Session::get('laycurs'))as $laycur)
<li class="@if(Session::get('nav')=='prodcurrencytransferid') active @endif"><a href="{{env('APP_URL')}}/user/currencytransfer/{{$laycur->ctrf_id}}"><span class="title">{{$laycur->ctrf_name}}</span><span class="label"><img  src="{{env('APP_URL')}}/public/images/{{$laycur->ctrf_img}}" class="img-circle" width="32"  height="32"   alt="" title=""></span></a></li>
@endforeach

<li class="@if(Session::get('nav')=='viewsprodbuy') active @endif"><a href="{{env('APP_URL')}}/user/viewsprodbuy"><span class="title">مشاهده سفارشات</span></a></li> 
					 
				</ul>
			</li>
			

			
<li class="has-sub @if((Session::get('nav')=='prodserviceid')||(Session::get('nav')=='viewsprodservice')) active @endif"><a href="{{env('APP_URL')}}/user/viewsprodservice"><i class="icon-gauge"></i><span class="title" > سرویس ها </span></a>
				<ul class="nav @if(Session::get('nav')!='prodserviceid') collapse @endif">

@foreach((Session::get('laycursservice'))as $laycur)
<li class="@if(Session::get('nav')=='prodserviceid') active @endif"><a href="{{env('APP_URL')}}/user/service/{{$laycur->ctrf_id}}"><span class="title">{{$laycur->ctrf_name}}</span><span class="label"><img  src="{{env('APP_URL')}}/public/images/{{$laycur->ctrf_img}}" class="img-circle" width="32"  height="32"   alt="" title=""></span></a></li>
@endforeach
<li class="@if(Session::get('nav')=='viewsprodservice') active @endif"><a href="{{env('APP_URL')}}/user/viewsprodservice"><span class="title">مشاهده سفارشات</span></a></li> 
					 
				</ul>
			</li>
			

			
<li class="has-sub @if((Session::get('nav')=='onlineshops')||(Session::get('nav')=='viewsonlineshops')) active @endif"><a href="{{env('APP_URL')}}/user/onlineshops"><i class="icon-gauge"></i><span class="title" >پرداخت در سایت خارجی</span></a>
				<ul class="nav @if(Session::get('nav')!='onlineshops') collapse @endif">
 
<li class="@if(Session::get('nav')=='onlineshops') active @endif"><a href="{{env('APP_URL')}}/user/onlineshops"><span class="title">ایجاد درخواست</span></a></li> 
<li class="@if(Session::get('nav')=='viewsonlineshops') active @endif"><a href="{{env('APP_URL')}}/user/viewsonlineshops"><span class="title">مشاهده درخواستهای من</span></a></li> 
					 
				</ul>
			</li>
			
			
<li class="has-sub @if((Session::get('nav')=='mali')||(Session::get('nav')=='trakings')) active @endif"><a href="{{env('APP_URL')}}/user/finicals"><i class="icon-gauge"></i><span class="title" > مدیریت مالی </span></a>
				<ul class="nav @if(Session::get('nav')!='mali') collapse @endif">
 
<li class="@if(Session::get('nav')=='mali') active @endif"><a href="{{env('APP_URL')}}/user/finicals"><span class="title">مشاهده فاکتورها</span></a></li> 

<li class="@if(Session::get('nav')=='trakings') active @endif"><a href="{{env('APP_URL')}}/user/trakings"><span class="title">مشاهده تراکنش ها</span></a></li> 
					 
				</ul>
			</li>
			

 
			
<li class="has-sub @if((Session::get('nav')=='addticket')||(Session::get('nav')=='viewstickets')||(Session::get('nav')=='viewselanatsuser')) active @endif"><a href="{{env('APP_URL')}}/user/viewstickets"><i class="icon-gauge"></i><span class="title" > پشتیبانی </span></a>
				<ul class="nav @if(Session::get('nav')!='viewstickets') collapse @endif">
 
<li class="@if(Session::get('nav')=='addticket') active @endif"><a href="{{env('APP_URL')}}/user/addticket"><span class="title">ثبت تیکت</span></a></li>
<li class="@if(Session::get('nav')=='viewstickets') active @endif"><a href="{{env('APP_URL')}}/user/viewstickets"><span class="title">مشاهده تیکتها</span> @if (Session::get('tickreaduser')!=0)   
<span class="label label-primary"  title="پیام جدید" > {{ Session::get('tickreaduser')}}</span> @endif </a></li>
<li class="@if(Session::get('nav')=='viewselanatsuser') active @endif"><a href="{{env('APP_URL')}}/user/viewselanats"><span class="title">مشاهده اطلاعیه ها</span>  @if (Session::get('elanreaduser')!=0)    
<span class="label label-primary"  title="اطلاعیه جدید" > {{ Session::get('elanreaduser')}}</span> @endif </a></li> 
					 
				</ul>
			</li>
			

 
 
 
 
			 
			 
 
			 
		</ul>
  
		 
			  
 
		
		<!-- /main navigation -->		
  </div>
  <!-- /page sidebar -->
  
  <!-- Main container -->
  
  
  <div class="main-container gray-bg">
  
		<!-- Main header -->
		<div class="main-header row">
		  <div class="col-sm-6 col-xs-7">

			<!-- User info -->
			<ul class="user-info pull-left">          
			  <li class="profile-info dropdown"><a data-toggle="dropdown" class="dropdown-toggle" href="##" aria-expanded="false"> <img width="44" class="img-circle avatar" alt="" src="{{env('APP_URL')}}/public/images/{{ Session::get('usimg')}}"> 
			  
			 
                      {{ Session::get('fullname')}}  
                       <span class="caret"></span></a>
			  
				<!-- User action menu -->
				<ul class="dropdown-menu">
				   
<li><a href="{{env('APP_URL')}}/user/myprofile/edit"><i class="icon-user"></i>پروفایل من</a></li>
<li><a href="{{env('APP_URL')}}/user/verificationdoc"><i class="fa fa-file-text"></i>تایید مدارک</a></li>
<li><a href="{{env('APP_URL')}}/user/sign-out"><i class="icon-logout"></i>خروج</a></li>  
<li class="divider"></li>
    <p style="font-size: 10px">
                      آخرین ورود:
                      {{jDate::forge(Session::get('logindatepasus'))->format('l d F Y ساعت H:i a')}}
                      </p>
				</ul>
				<!-- /user action menu -->
				
			  </li>
			</ul>
			<!-- /user info -->
			
		  </div>
		  
		  		  
		  <!--
		  <div class="col-sm-6 col-xs-5">
			<div class="pull-right">
			 
				<ul class="user-info pull-left">
				
			 
				  <li class="notifications dropdown">
					<a data-close-others="true" data-hover="dropdown" data-toggle="dropdown" class="dropdown-toggle" href="##"><i class="icon-attention"></i><span class="badge badge-info">6</span></a>
					<ul class="dropdown-menu pull-right">
						<li class="first">
							<div class="small"><a class="pull-right danger" href="http://www.g-axon.com/mouldifi-5.0/rtl/index.html#">Mark all Read</a> You have <strong>3</strong> new notifications.</div>
						</li>
						<li>
							<ul class="dropdown-list">
								<li class="unread notification-success"><a href="http://www.g-axon.com/mouldifi-5.0/rtl/index.html#"><i class="icon-user-add pull-right"></i><span class="block-line strong">New user registered</span><span class="block-line small">30 seconds ago</span></a></li>
								<li class="unread notification-secondary"><a href="http://www.g-axon.com/mouldifi-5.0/rtl/index.html#"><i class="icon-heart pull-right"></i><span class="block-line strong">Someone special liked this</span><span class="block-line small">60 seconds ago</span></a></li>
								<li class="unread notification-primary"><a href="http://www.g-axon.com/mouldifi-5.0/rtl/index.html#"><i class="icon-user pull-right"></i><span class="block-line strong">Privacy settings have been changed</span><span class="block-line small">2 hours ago</span></a></li>
								<li class="notification-danger"><a href="http://www.g-axon.com/mouldifi-5.0/rtl/index.html#"><i class="icon-cancel-circled pull-right"></i><span class="block-line strong">Someone special liked this</span><span class="block-line small">60 seconds ago</span></a></li>
								<li class="notification-info"><a href="http://www.g-axon.com/mouldifi-5.0/rtl/index.html#"><i class="icon-info pull-right"></i><span class="block-line strong">Someone special liked this</span><span class="block-line small">60 seconds ago</span></a></li>
								<li class="notification-warning"><a href="http://www.g-axon.com/mouldifi-5.0/rtl/index.html#"><i class="icon-rss pull-right"></i><span class="block-line strong">Someone special liked this</span><span class="block-line small">60 seconds ago</span></a></li>
							</ul>
						</li>
						<li class="external-last"> <a href="http://www.g-axon.com/mouldifi-5.0/rtl/index.html#" class="danger">View all notifications</a> </li>
					</ul>
				  </li>
				 
				  
				 
				  <li class="notifications dropdown">
					<a data-close-others="true" data-hover="dropdown" data-toggle="dropdown" class="dropdown-toggle" href="http://www.g-axon.com/mouldifi-5.0/rtl/index.html#"><i class="icon-mail"></i><span class="badge badge-secondary">12</span></a>
					<ul class="dropdown-menu pull-right">
						<li class="first">
							<div class="dropdown-content-header"><i class="fa fa-pencil-square-o pull-right"></i> Messages</div>
						</li>
						<li>
							<ul class="media-list">
								<li class="media">
									<div class="media-left"><img alt="" class="img-circle img-sm" src="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/domnic-brown.png"></div>
									<div class="media-body">
										<a class="media-heading" href="http://www.g-axon.com/mouldifi-5.0/rtl/index.html#">
											<span class="text-semibold">Domnic Brown</span>
											<span class="media-annotation pull-right">Tue</span>
										</a>
										<span class="text-muted">Your product sounds interesting I would love to check this ne...</span>
									</div>
								</li>
								<li class="media">
									<div class="media-left"><img alt="" class="img-circle img-sm" src="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/john-smith.png"></div>
									<div class="media-body">
										<a class="media-heading" href="http://www.g-axon.com/mouldifi-5.0/rtl/index.html#">
											<span class="text-semibold">John Smith</span>
											<span class="media-annotation pull-right">12:30</span>
										</a>
										<span class="text-muted">Thank you for posting such a wonderful content. The writing was outstanding...</span>
									</div>
								</li>
								<li class="media">
									<div class="media-left"><img alt="" class="img-circle img-sm" src="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/stella-johnson.png"></div>
									<div class="media-body">
										<a class="media-heading" href="http://www.g-axon.com/mouldifi-5.0/rtl/index.html#">
											<span class="text-semibold">Stella Johnson</span>
											<span class="media-annotation pull-right">2 days ago</span>
										</a>
										<span class="text-muted">Thank you for trusting us to be your source for top quality sporting goods...</span>
									</div>
								</li>
								<li class="media">
									<div class="media-left"><img alt="" class="img-circle img-sm" src="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/alex-dolgove.png"></div>
									<div class="media-body">
										<a class="media-heading" href="http://www.g-axon.com/mouldifi-5.0/rtl/index.html#">
											<span class="text-semibold">Alex Dolgove</span>
											<span class="media-annotation pull-right">10:45</span>
										</a>
										<span class="text-muted">After our Friday meeting I was thinking about our business relationship and how fortunate...</span>
									</div>
								</li>
								<li class="media">
									<div class="media-left"><img alt="" class="img-circle img-sm" src="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/domnic-brown.png"></div>
									<div class="media-body">
										<a class="media-heading" href="http://www.g-axon.com/mouldifi-5.0/rtl/index.html#">
											<span class="text-semibold">Domnic Brown</span>
											<span class="media-annotation pull-right">4:00</span>
										</a>
										<span class="text-muted">I would like to take this opportunity to thank you for your cooperation in recently completing...</span>
									</div>
								</li>
							</ul>
						</li>
						<li class="external-last"> <a class="danger" href="http://www.g-axon.com/mouldifi-5.0/rtl/index.html#">All Messages</a> </li>
					</ul>
				  </li>
				   
				  
				</ul>
				 
				
			</div>
		  </div>
-->

		</div>
		<!-- /main header -->
		
@if(Session::get('verfyemail')!='1')
  	<div class="alert alert-info alert-dismissible" role="alert" style="font-weight: 500;"  ><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  	<strong><b>فعالسازی ایمیل </b> !</strong>  <br>	  
  	 <span> جهت فعال کردن ایمل  <a href="{{env('APP_URL')}}/user/verificationdoc">لطفا کلیک نمایید</a></span><br>   </div>
@endif
		  
		  		  

@if(Session::get('verfytell')!='1')
<div class="alert alert-info alert-dismissible" role="alert" style="font-weight: 500;"  ><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  	<strong><b>فعالسازی تلفن</b> !</strong>    
  	 <span> جهت فعال کردن تلفن همراه  <a href="{{env('APP_URL')}}/user/verificationdoc">لطفا کلیک نمایید</a></span><br>  
   </div>
@endif
		  	  
@if(Session::get('verfydoc')!='1')
<div class="alert alert-info alert-dismissible" role="alert" style="font-weight: 500;"  ><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  	<strong><b>احرازهویت و تایید مدارک</b>!</strong>     
  	 <span><b>جهت احرازهویت و ارسال و تایید مدارک </b><a href="{{env('APP_URL')}}/user/verificationdoc">لطفا کلیک نمایید</a></span><br> 
   </div>
@endif
		  


@yield('superadmin')
  
  
  </div>
  <!-- /main container -->
  
</div>
<!-- /page container -->

<!--Load JQuery-->
<script src="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/jquery.min.js.download"></script>
<!-- Load CSS3 Animate It Plugin JS -->
<script src="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/css3-animate-it.js.download"></script>
<script src="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/bootstrap.min.js.download"></script>
<script src="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/jquery.metisMenu.js.download"></script>
<script src="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/jquery-ui.js.download"></script>
<script src="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/jquery.blockUI.js.download"></script>
<!--Float Charts-->
<script src="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/jquery.flot.min.js.download"></script>
<script src="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/jquery.flot.tooltip.min.js.download"></script>
<script src="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/jquery.flot.resize.min.js.download"></script>
<script src="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/jquery.flot.selection.min.js.download"></script>        
<script src="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/jquery.flot.pie.min.js.download"></script>
<script src="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/jquery.flot.time.min.js.download"></script>
<script src="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/functions.js.download"></script>

<!--ChartJs-->
<script src="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/Chart.min.js.download"></script>


@yield('scriptfooter')



</body></html>  