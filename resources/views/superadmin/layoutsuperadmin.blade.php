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
 
 
<link href="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/entypo.css" rel="stylesheet">
  
<link href="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/font-awesome.min.css" rel="stylesheet"> 
 
<link href="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/animations.css" rel="stylesheet">
 
 
<link href="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/bootstrap.min.css" rel="stylesheet">
 
 
<link href="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/mouldifi-core.css" rel="stylesheet">
 

<link href="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/mouldifi-forms.css" rel="stylesheet">

<link href="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/jquery.dataTables.css" rel="stylesheet">
<link href="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/buttons.dataTables.css" rel="stylesheet">
 
<link href="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/bootstrap-rtl.min.css" rel="stylesheet"> 
 
<link href="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/mouldifi-rtl-core.css" rel="stylesheet"> 
 
    <link rel="stylesheet" href="{{env('APP_URL')}}/build/servicepay/fonts/fonts-fa.css">
    
        <link rel="stylesheet" href="{{env('APP_URL')}}/build/style/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
 
</head>
<body>

<!-- Page container -->
<div class="page-container"  >

	<!-- Page Sidebar -->
	<div class="page-sidebar">
	
		<!-- Site header  -->
		<header class="site-header">
		  <div class="site-logo"><a href="#"><img  width="160"  height="28" src="{{env('APP_URL')}}/public/images/{{Session::get('ind_himglog')}}" alt="" title=""></a></div>
		  <div class="sidebar-collapse hidden-xs"><a class="sidebar-collapse-icon" href="##"><i class="icon-menu"></i></a></div>
		  <div class="sidebar-mobile-menu visible-xs"><a data-target="#side-nav" data-toggle="collapse" class="mobile-menu-icon" href="##"><i class="icon-menu"></i></a></div>
		</header>
		<!-- /site header -->
		
		<!-- Main navigation -->


<ul id="side-nav" class="main-menu navbar-collapse collapse">

<li class="has-sub @if(Session::get('nav')=='panel') active @endif"><a href="{{env('APP_URL')}}/superadmin/panel"><i class="icon-gauge"></i><span class="title" >پیشخوان</span></a>
<ul class="nav @if(Session::get('nav')!='panel') collapse @endif">
<li class="@if(Session::get('nav')=='panel') active @endif"><a href="{{env('APP_URL')}}/superadmin/panel"><span class="title">پنل </span></a></li></ul></li>
			
			
<li class="has-sub @if((Session::get('nav')=='adduser')||(Session::get('nav')=='viewsusers')) active @endif"><a href="{{env('APP_URL')}}/superadmin/viewsusers"><i class="icon-gauge"></i><span class="title" >کاربران </span></a>
				<ul class="nav @if(Session::get('nav')!='adduser') collapse @endif">
<li class="@if(Session::get('nav')=='viewsusers') active @endif"><a href="{{env('APP_URL')}}/superadmin/viewsusers"><span class="title">مشاهده کاربران</span></a></li>
<li class="@if(Session::get('nav')=='adduser') active @endif"><a href="{{env('APP_URL')}}/superadmin/adduser"><span class="title">ثبت کاربر</span></a></li>
					 
				</ul>
			</li>


			
<li class="has-sub @if((Session::get('nav')=='addcurrencytransfer')||(Session::get('nav')=='viewscurrencytransfer')) active @endif"><a href="{{env('APP_URL')}}/superadmin/viewscurrencytransfer"><i class="icon-gauge"></i><span class="title" >حواله های ارزی </span></a>
				<ul class="nav @if(Session::get('nav')!='addcurrencytransfer') collapse @endif">
<li class="@if(Session::get('nav')=='viewscurrencytransfer') active @endif"><a href="{{env('APP_URL')}}/superadmin/viewscurrencytransfer"><span class="title">مشاهده حواله های ارزی</span></a></li>
<li class="@if(Session::get('nav')=='addcurrencytransfer') active @endif"><a href="{{env('APP_URL')}}/superadmin/addcurrencytransfer"><span class="title">ثبت حواله ارزی</span></a></li> 
				</ul>
			</li>
			 
			
			
<li class="has-sub @if((Session::get('nav')=='addservice')||(Session::get('nav')=='viewsservice')) active @endif"><a href="{{env('APP_URL')}}/superadmin/viewscurrencytransfer"><i class="icon-gauge"></i><span class="title" >سرویس ها </span></a>
				<ul class="nav @if(Session::get('nav')!='addservice') collapse @endif">
<li class="@if(Session::get('nav')=='viewsservice') active @endif"><a href="{{env('APP_URL')}}/superadmin/viewsservice"><span class="title">مشاهده سرویس ها</span></a></li>
<li class="@if(Session::get('nav')=='addservice') active @endif"><a href="{{env('APP_URL')}}/superadmin/addservice"><span class="title">ثبت سرویس</span></a></li> 
				</ul>
			</li>
			 
			
			
<li class="has-sub @if((Session::get('nav')=='viewscurrency') ||(Session::get('nav')=='addcurrency') ||(Session::get('nav')=='finicalsmng')) active @endif"><a href="{{env('APP_URL')}}/superadmin/viewscurrency"><i class="icon-gauge"></i><span class="title" >مدیریت مالی </span></a>
				<ul class="nav @if(Session::get('nav')!='addcurrency') collapse @endif">
<li class="@if(Session::get('nav')=='viewscurrency') active @endif"><a href="{{env('APP_URL')}}/superadmin/viewscurrency"><span class="title">مدیریت کارنسی ها</span></a></li>
<li class="@if(Session::get('nav')=='addcurrency') active @endif"><a href="{{env('APP_URL')}}/superadmin/addcurrency"><span class="title">ثبت کارنسی</span></a></li> 
<li class="@if(Session::get('nav')=='finicalsmng') active @endif"><a href="{{env('APP_URL')}}/superadmin/finicals"><span class="title">مشاهده فاکتورها</span></a></li> 
 
					 
				</ul>
			</li>
			 
			
<li class="has-sub @if((Session::get('nav')=='viewsforms') ||(Session::get('nav')=='createform')) active @endif"><a href="{{env('APP_URL')}}/superadmin/viewsforms"><i class="icon-gauge"></i><span class="title" >مدیریت فرم ها </span></a>
				<ul class="nav @if(Session::get('nav')!='viewsforms') collapse @endif">
<li class="@if(Session::get('nav')=='createform') active @endif"><a href="{{env('APP_URL')}}/superadmin/createform"><span class="title">ایجاد فرم</span></a></li>
<li class="@if(Session::get('nav')=='viewsforms') active @endif"><a href="{{env('APP_URL')}}/superadmin/viewsforms"><span class="title">مشاهده فرم ها</span></a></li> 
    
				</ul>
			</li>
			 
			 
			
			
<li class="has-sub @if((Session::get('nav')=='viewscatsform') ||(Session::get('nav')=='createcatsform')) active @endif"><a href="{{env('APP_URL')}}/superadmin/viewscatsform"><i class="icon-gauge"></i><span class="title" >دسته بندی خدمات سایت </span></a>
				<ul class="nav @if(Session::get('nav')!='viewscatsform') collapse @endif">
<li class="@if(Session::get('nav')=='createcatsform') active @endif"><a href="{{env('APP_URL')}}/superadmin/createcatsform"><span class="title">ثبت دسته بندی</span></a></li>
<li class="@if(Session::get('nav')=='viewscatsform') active @endif"><a href="{{env('APP_URL')}}/superadmin/viewscatsform"><span class="title">مدیریت دسته بندی ها</span></a></li> 
    
				</ul>
			</li>
			 
			 
			
			
<li class="has-sub @if(Session::get('nav')=='viewsonlineshops') active @endif"><a href="{{env('APP_URL')}}/superadmin/viewsonlineshops"><i class="icon-gauge"></i><span class="title" >مدیریت درخواستها </span></a>
				<ul class="nav @if(Session::get('nav')!='viewsonlineshops') collapse @endif">
 
<li class="@if(Session::get('nav')=='viewsonlineshops') active @endif"><a href="{{env('APP_URL')}}/superadmin/viewsonlineshops"><span class="title">مشاهده درخواستهای کاربران</span></a></li> 
    
				</ul>
			</li>
			 

			 
			
<li class="has-sub @if((Session::get('nav')=='addnew')||(Session::get('nav')=='viewsnews')||(Session::get('nav')=='addpage')||(Session::get('nav')=='viewspages')) active @endif"><a href="{{env('APP_URL')}}/superadmin/viewsnews"><i class="icon-gauge"></i><span class="title" >مدیریت محتوا  </span></a>
				<ul class="nav @if(Session::get('nav')!='addnew') collapse @endif">
<li class="@if(Session::get('nav')=='addnew') active @endif"><a href="{{env('APP_URL')}}/superadmin/addnew"><span class="title">ثبت خبر</span></a></li>
<li class="@if(Session::get('nav')=='viewsnews') active @endif"><a href="{{env('APP_URL')}}/superadmin/viewsnews"><span class="title">مشاهده اخبار</span></a></li> 
   
<li class="@if(Session::get('nav')=='addpage') active @endif"><a href="{{env('APP_URL')}}/superadmin/addpage"><span class="title">ثبت خدمات</span></a></li>
<li class="@if(Session::get('nav')=='viewspages') active @endif"><a href="{{env('APP_URL')}}/superadmin/viewspages"><span class="title">مشاهده خدمات</span></a></li> 
   
				</ul>
			</li>
			 	 
			
<li class="has-sub @if((Session::get('nav')=='mngindexedit') ||(Session::get('nav')=='manageindex')||(Session::get('nav')=='viewsgetwaypays') ||(Session::get('nav')=='viewspanelsms')||(Session::get('nav')=='addsocial') ||(Session::get('nav')=='mngsocial')) active @endif"><a href="{{env('APP_URL')}}/superadmin/mngindexedit"><i class="icon-gauge"></i><span class="title" >تنظیمات سایت </span></a>
				<ul class="nav @if(Session::get('nav')!='mngindexedit') collapse @endif">
<li class="@if(Session::get('nav')=='manageindex') active @endif"><a href="{{env('APP_URL')}}/superadmin/manageindex"><span class="title">مدیریت نمایش صفحه اصلی</span></a></li>
<li class="@if(Session::get('nav')=='mngindexedit') active @endif"><a href="{{env('APP_URL')}}/superadmin/mngindexedit"><span class="title">مدیریت جزییات صفحه اصلی</span></a></li> 
<li class="@if(Session::get('nav')=='viewsgetwaypays') active @endif"><a href="{{env('APP_URL')}}/superadmin/viewsgetwaypays"><span class="title">مدیریت درگاه پرداخت</span></a></li> 
<li class="@if(Session::get('nav')=='viewspanelsms') active @endif"><a href="{{env('APP_URL')}}/superadmin/viewspanelsms"><span class="title">مدیریت پنل اسمس</span></a></li> 
<li class="@if(Session::get('nav')=='addsocial') active @endif"><a href="{{env('APP_URL')}}/superadmin/addsocial"><span class="title">ثبت شبکه های اجتماعی</span></a></li> 
<li class="@if(Session::get('nav')=='mngsocial') active @endif"><a href="{{env('APP_URL')}}/superadmin/mngsocial"><span class="title">مدیریت شبکه های اجتماعی</span></a></li> 
   
				</ul>
			</li>



<li class="has-sub @if((Session::get('nav')=='viewsuserticketssupactive') ||(Session::get('nav')=='viewsuserticketssup')||(Session::get('nav')=='addelanuser')||(Session::get('nav')=='viewselanats')) active @endif"><a href="{{env('APP_URL')}}/superadmin/viewsuserticketssupactive"><i class="icon-gauge"></i><span class="title" >پشتیبانی </span></a>
				<ul class="nav @if(Session::get('nav')!='viewsuserticketssupactive') collapse @endif">
<li class="@if(Session::get('nav')=='viewsuserticketssup') active @endif"><a href="{{env('APP_URL')}}/superadmin/viewsuserticketssup"><span class="title">مشاهده تیکتهای کاربران</span>@if (Session::get('tickreadstudentsup')!=0)   
<span class="label label-primary"  title="پیام جدید" > {{ Session::get('tickreadstudentsup')}}</span> @endif </a></li>
<li class="@if(Session::get('nav')=='viewsuserticketssupactive') active @endif"><a href="{{env('APP_URL')}}/superadmin/viewsuserticketssupactive"><span class="title">تیکتهای منتظر پاسخ</span></a></li> 
<li class="@if(Session::get('nav')=='addelanuser') active @endif"><a href="{{env('APP_URL')}}/superadmin/addelanuser"><span class="title">ثبت اطلاعیه تکی</span></a></li> 
<li class="@if(Session::get('nav')=='viewselanats') active @endif"><a href="{{env('APP_URL')}}/superadmin/viewselanats"><span class="title">مشاهده اطلاعیه ها</span></a></li> 
    
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
			  <li class="profile-info dropdown"><a data-toggle="dropdown" class="dropdown-toggle" href="##" aria-expanded="false"> <img width="44" class="img-circle avatar" alt="" src="{{env('APP_URL')}}/public/images/{{ Session::get('supimg')}}">  سوپرادمین
                      {{ Session::get('signsuperadmin')}}<span class="caret"></span></a>
			  
				<!-- User action menu -->
				<ul class="dropdown-menu">
				   
<li><a href="{{env('APP_URL')}}/superadmin/myprofile/edit/sup"><i class="icon-user"></i>پروفایل من</a></li> 
<li><a href="{{env('APP_URL')}}/superadmin/sign-out"><i class="icon-logout"></i>خروج</a></li>  
<li class="divider"></li>
    <p style="font-size: 10px">
                      آخرین ورود:
                      {{jDate::forge(Session::get('logindatepas'))->format('l d F Y ساعت H:i a')}}
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


  <script src="{{env('APP_URL')}}/build/style/js/ga.js"></script>
  <script src="{{env('APP_URL')}}/build/style/js/ckeditor/ckeditor.js"></script>
@yield('scriptfooter')



</body></html>  