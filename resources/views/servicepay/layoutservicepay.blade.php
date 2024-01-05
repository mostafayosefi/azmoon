<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    @yield('title')

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
 
    
    
 <!--   <link rel="stylesheet" href="../public{{ elixir("css/packege1.css") }}">   -->
    
   

    
  <link rel="stylesheet" href="{{env('APP_URL')}}/build/style/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{env('APP_URL')}}/build/style/bootstrap/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{env('APP_URL')}}/build/style/bootstrap/css/ionicons.min.css">
    
    <link rel="stylesheet" href="{{env('APP_URL')}}/build/style/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="{{env('APP_URL')}}/build/style/dist/css/bootstrap-rtl.min.css">
    
    <link rel="stylesheet" href="{{env('APP_URL')}}/build/style/dist/css/skins/_all-skins.min.css">
    
    <link rel="stylesheet" href="{{env('APP_URL')}}/build/style/dist/fonts/fonts-fa.css">
    
    <link rel="stylesheet" href="{{env('APP_URL')}}/build/style/plugins/iCheck/flat/blue.css">
    <link rel="stylesheet" href="{{env('APP_URL')}}/build/style/plugins/morris/morris.css">
    <link rel="stylesheet" href="{{env('APP_URL')}}/build/style/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <link rel="stylesheet" href="{{env('APP_URL')}}/build/style/plugins/datepicker/datepicker3.css">
    <link rel="stylesheet" href="{{env('APP_URL')}}/build/style/plugins/daterangepicker/daterangepicker-bs3.css">
       <link rel="stylesheet" href="{{env('APP_URL')}}/build/style/plugins/iCheck/all.css">
    <link rel="stylesheet" href="{{env('APP_URL')}}/build/style/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  
    <link rel="stylesheet" href="{{env('APP_URL')}}/build/style/plugins/datatables/dataTables.bootstrap.css">
 
 
    <link rel="stylesheet" href="{{env('APP_URL')}}/build/style/plugins/colorpicker/bootstrap-colorpicker.min.css">
    <link rel="stylesheet" href="{{env('APP_URL')}}/build/style/plugins/timepicker/bootstrap-timepicker.min.css">
    <link rel="stylesheet" href="{{env('APP_URL')}}/build/style/plugins/select2/select2.min.css"> 
 
		   <link rel="stylesheet" href="{{env('APP_URL')}}/build/style/bootstrap/pd/js-persian-cal.css">
	<script type="text/javascript" src="{{env('APP_URL')}}/build/style/bootstrap/pd/js-persian-cal.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">


  <link rel="stylesheet" href="{{env('APP_URL')}}/build/buyturkey/indexbuyturkey_files/custom.css">
  
  
  
  
  
  
  
  
  

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
 
 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
 
        
    <![endif]-->
    
    
  </head>
  <body class="skin-blue sidebar-mini"  dir="rtl">
    <div class="wrapper">

      <header class="main-header">



@if(Session::get('flagpanel')=='1')
        <a href="{{ url('/superadmin/panel') }}" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>P</b>KARGO</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>PANEL </b>KARGO</span>
        </a>
@else
        <a href="{{ url('/superadmin/panelshop') }}" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>P</b>SHOP</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>PANEL </b>SHOP</span>
        </a>
@endif
        
        
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          
          
          
          
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              
              
              

<a href="{{ url('/superadmin/panel') }}" class="logo">
 
          <span class="logo-lg"><b>کارگو</b></span>

</a>  
  
             

<a href="{{ url('/superadmin/panelshop') }}" class="logo">
 
          <span class="logo-lg"><b>فروشگاه</b></span>

</a>  
  
 
              
              
             
 <li class="dropdown user user-menu">
 <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="{{env('APP_URL')}}/public/images/{{ Session::get('supimg')}}" class="user-image" alt="User Image">
                  <span class="hidden-xs">سوپرادمین</span>
                </a>
                              
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="{{env('APP_URL')}}/public/images/{{ Session::get('supimg')}}" class="img-circle" alt="User Image">
                    
                    <!-- @if (Session::has('signsuperadmin'))   @endif -->
                      
                    <p>
                      سوپرادمین
                      {{ Session::get('signsuperadmin')}}
                      <small>
                      آخرین ورود:
                      {{jDate::forge(Session::get('logindatepas'))->format('l d F Y ساعت H:i a')}}
                      </small>
                    </p>
                  </li>
                
                  
                  <!-- Menu Body -->


                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="{{ url('/superadmin/myprofile/edit/sup') }}" class="btn btn-default btn-flat">پروفایل</a>
                    </div>
                    <div class="pull-right">
                      <a href="{{ url('/superadmin/sign-out') }}" class="btn btn-default btn-flat">خروج</a>
                    </div>
                  </li>
                </ul>
              </li>
              
              
                          
             
              
              
        
        
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="{{env('APP_URL')}}/public/images/{{ Session::get('supimg')}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p>سوپرادمین</p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
    
    
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
          
         

  			<li>
              <a href="{{ url('/superadmin/panel') }}">
                <i class="fa fa-envelope"></i> <span>پنل</span>
              </a>
            </li>
         
              
             <li class="treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>مدیران</span> <i class="fa fa-angle-left pull-left"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ url('/superadmin/viewsadmins') }}"><i class="fa fa-fw fa-users"></i>مشاهده مدیران</a></li>
                <li><a href="{{ url('/superadmin/addadmin') }}"><i class="fa fa-fw fa-user"></i>ثبت مدیر</a></li>   
              </ul>
            </li> 


             
             <li class="treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>کاربران</span> <i class="fa fa-angle-left pull-left"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ url('/superadmin/viewsusers') }}"><i class="fa fa-fw fa-users"></i>مشاهده کاربران </a></li>
                <li><a href="{{ url('/superadmin/adduser') }}"><i class="fa fa-fw fa-user"></i>ثبت کاربر</a></li>   
              </ul>
            </li>
            
            
@if(Session::get('flagpanel')=='1')
            
             <li class="treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>سفارشات</span> <i class="fa fa-angle-left pull-left"></i>
              </a>
              <ul class="treeview-menu">
                  
 <li><a href="{{ url('/superadmin/addsefaresh') }}"><i class="fa fa-fw fa-user"></i>ثبت سفارش</a></li> 
 <li><a href="{{ url('/superadmin/viewssefareshthreedaysago') }}"><i class="fa fa-fw fa-user"></i>مشاهده سفارشات سه روز اخیر</a></li>    
 <li><a href="{{ url('/superadmin/viewssefaresh') }}"><i class="fa fa-fw fa-user"></i>مشاهده همه سفارشات</a></li>    
 <li><a href="{{ url('/superadmin/viewssefaresharchive') }}"><i class="fa fa-fw fa-user"></i>آرشیو سفارشات</a></li>      
              </ul>
            </li>

             
             <li class="treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>دسته بندی سفارشات</span> <i class="fa fa-angle-left pull-left"></i>
              </a>
              <ul class="treeview-menu">
                  
 <li><a href="{{ url('/superadmin/viewssefaresh/waitacc') }}"><i class="fa fa-fw fa-user"></i>در انتظار تایید سفارش</a></li> 
 <li><a href="{{ url('/superadmin/viewssefaresh/waitpayord') }}"><i class="fa fa-fw fa-user"></i>در انتظار پرداخت مبلغ سفارش</a></li>  
 <li><a href="{{ url('/superadmin/viewssefaresh/waitbuy') }}"><i class="fa fa-fw fa-user"></i>در انتظار خرید کالا در ترکیه</a></li> 
 <li><a href="{{ url('/superadmin/viewssefaresh/cancelpay') }}"><i class="fa fa-fw fa-user"></i>خریدهای لغو شده</a></li>   
 <li><a href="{{ url('/superadmin/viewssefaresh/buyturk') }}"><i class="fa fa-fw fa-user"></i>کالا در ترکیه خریداری شد</a></li>   
 <li><a href="{{ url('/superadmin/viewssefaresh/waitpaykargo') }}"><i class="fa fa-fw fa-user"></i>در انتظار پرداخت مبلغ باربری</a></li>   
 <li><a href="{{ url('/superadmin/viewssefaresh/waitsendtoiran') }}"><i class="fa fa-fw fa-user"></i>در انتظار ارسال کالا به سمت ایران</a></li>   
 <li><a href="{{ url('/superadmin/viewssefaresh/waitreciniran') }}"><i class="fa fa-fw fa-user"></i>در انتظار دریافت کالا در ایران</a></li>   
 <li><a href="{{ url('/superadmin/viewssefaresh/waitpaypost') }}"><i class="fa fa-fw fa-user"></i>در انتظار پرداخت هزینه پستی در ایران</a></li>   
 <li><a href="{{ url('/superadmin/viewssefaresh/waitsenduser') }}"><i class="fa fa-fw fa-user"></i>در انتظار ارسال مرسوله به سمت کاربر</a></li>   
 <li><a href="{{ url('/superadmin/viewssefaresh/sentouser') }}"><i class="fa fa-fw fa-user"></i>مرسوله به سمت کاربر فرستاده شد</a></li>   
 <li><a href="{{ url('/superadmin/viewssefaresh/ordrec') }}"><i class="fa fa-fw fa-user"></i>مرسوله تحویل داده شد</a></li>    
     
              </ul>
            </li>

             
             

   <li class="treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>فاکتورها</span> <i class="fa fa-angle-left pull-left"></i>
              </a>
              <ul class="treeview-menu">
                   
 <li><a href="{{ url('/superadmin/viewsfinicalthreedaysago') }}"><i class="fa fa-fw fa-user"></i>مشاهده فاکتورهای سه روز اخیر</a></li>  
 <li><a href="{{ url('/superadmin/viewsfinical') }}"><i class="fa fa-fw fa-user"></i>مشاهده همه فاکتورها</a></li>  
 <li><a href="{{ url('/superadmin/searchfinical') }}"><i class="fa fa-fw fa-user"></i>جستجوی فاکتور</a></li> 
 <li><a href="{{ url('/superadmin/viewsfinicalcharge') }}"><i class="fa fa-fw fa-user"></i>تراکنشهای ناموفق</a></li> 
 <li><a href="{{ url('/superadmin/viewschargethreedaysago') }}"><i class="fa fa-fw fa-user"></i>مشاهده تراکنشهای سه روز اخیر</a></li>     
 <li><a href="{{ url('/superadmin/viewscharge') }}"><i class="fa fa-fw fa-user"></i>تراکنش کاربران</a></li>      
              </ul>
            </li>


             
             <li class="treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>کردیت کارت </span> <i class="fa fa-angle-left pull-left"></i>
              </a>
              <ul class="treeview-menu">
                  
 <li><a href="{{ url('/superadmin/addcreditcard') }}"><i class="fa fa-fw fa-user"></i>ثبت کردیت کارت</a></li>  
 <li><a href="{{ url('/superadmin/viewcriditcard') }}"><i class="fa fa-fw fa-user"></i>مشاهده کردیت کارت</a></li>   
              </ul>
            </li>
             
              
         
  
            
                <li class="treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>اطلاع رسانی</span> <i class="fa fa-angle-left pull-left"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ url('/superadmin/elanat') }}"><i class="fa fa-fw fa-users"></i>اکانت ها</a></li>
                <li><a href="{{ url('/superadmin/elanatorder') }}"><i class="fa fa-fw fa-user"></i>سفارشات</a></li>   
              </ul>
            </li>

            
                <li class="treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>صفحات سایت</span> <i class="fa fa-angle-left pull-left"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ url('/superadmin/viewspages') }}"><i class="fa fa-fw fa-users"></i>مشاهده صفحات</a></li>
                <li><a href="{{ url('/superadmin/addpage') }}"><i class="fa fa-fw fa-user"></i>ثبت صفحه</a></li>   
              </ul>
            </li>


            
                <li class="treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>اخبار</span> <i class="fa fa-angle-left pull-left"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ url('/superadmin/viewsnews') }}"><i class="fa fa-fw fa-users"></i>مشاهده اخبار</a></li>
                <li><a href="{{ url('/superadmin/addnew') }}"><i class="fa fa-fw fa-user"></i>ثبت خبر</a></li>   
              </ul>
            </li>


            
            
                <li class="treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>سوالات متداول</span> <i class="fa fa-angle-left pull-left"></i>
              </a>
              <ul class="treeview-menu">
<li><a href="{{ url('/superadmin/addgroupquestion') }}"><i class="fa fa-fw fa-users"></i>ثبت گروه سوالات متداول</a></li>
<li><a href="{{ url('/superadmin/question') }}"><i class="fa fa-fw fa-user"></i>سوالات متداول</a></li>   
              </ul>
            </li>



            

            
  			<li>
              <a href="{{ url('/superadmin/comodid') }}">
                <i class="fa fa-envelope"></i> <span>امکانات کارگو</span>
              </a>
            </li>
            
            
  			<li>
              <a href="{{ url('/superadmin/viewspanelsms') }}">
                <i class="fa fa-envelope"></i> <span>پنل اسمس </span>
              </a>
            </li>
            
            
            
                <li class="treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>گروههای کاربران</span> <i class="fa fa-angle-left pull-left"></i>
              </a>
              <ul class="treeview-menu">
            <li><a href="{{ url('/superadmin/viewsgroupuser') }}"><i class="fa fa-fw fa-users"></i>مشاهده گروهها</a></li>
                <li><a href="{{ url('/superadmin/addgroupuser') }}"><i class="fa fa-fw fa-user"></i>ثبت گروه</a></li>   
              </ul>
            </li>
            
              
             
 
<!--

                <li class="treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>گروههای نمایندگی</span> <i class="fa fa-angle-left pull-left"></i>
              </a>
              <ul class="treeview-menu">
            <li><a href="{{ url('/superadmin/viewsgroupprofessor') }}"><i class="fa fa-fw fa-users"></i>مشاهده گروهها</a></li>
                <li><a href="{{ url('/superadmin/addgroupprofessor') }}"><i class="fa fa-fw fa-user"></i>ثبت گروه</a></li>   
              </ul>
            </li>
            

            
            
            
            
            
             <li class="treeview">
              <a href="#">
                <i class="fa fa-envelope"></i> <span>اطلاعیه های نمایندگی</span> <i class="fa fa-angle-left pull-left"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ url('/superadmin/viewselanatsprofessor') }}"><i class="fa fa-envelope"></i>اطلاعیه های ارسالی
               </a> </li>
               
 <li><a href="{{ url('/superadmin/addelanprofessor') }}"><i class="fa fa-fw fa-user"></i>ثبت اطلاعیه تکی</a></li> 
 <li><a href="{{ url('/superadmin/addelanprofessorgroup') }}"><i class="fa fa-fw fa-user"></i>ثبت اطلاعیه گروهی</a></li>  
               
               
              </ul>
            </li>
            
            
            -->
            
              



          
          <!--    
             



             
                <li class="treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>پنل اسمس</span> <i class="fa fa-angle-left pull-left"></i>
              </a>
              <ul class="treeview-menu">
            <li><a href="{{ url('/superadmin/viewspanelsms') }}"><i class="fa fa-fw fa-users"></i>مدیریت پنل اسمس</a></li>  
              </ul>
            </li>
            
            -->
            
                <li class="treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>درگاه پرداخت</span> <i class="fa fa-angle-left pull-left"></i>
              </a>
              <ul class="treeview-menu">
            <li><a href="{{ url('/superadmin/viewsgetwaypays') }}"><i class="fa fa-fw fa-users"></i>مدیریت درگاه پرداخت</a></li>  
              </ul>
            </li>
            

            
             <li class="treeview">
              <a href="#">
                <i class="fa fa-envelope"></i> <span>تیکت ها</span> <i class="fa fa-angle-left pull-left"></i>
              </a>
              <ul class="treeview-menu">
 
               
                   <li><a href="{{ url('/superadmin/viewsuserticketssup') }}"><i class="fa fa-envelope"></i>تیکتهای کاربران 
 @if (Session::get('tickreadstudentsup')!=0)   
                        <span data-toggle="tooltip" title="پیام جدید" class="badge bg-blue">{{ Session::get('tickreadstudentsup')}}</span>
                        @endif
               </a> </li>
               
               
 <li><a href="{{ url('/superadmin/viewsuserticketssupactive') }}"><i class="fa fa-envelope"></i>تیکتهای منتظر پاسخ 
 
               </a> </li>
               
               
              </ul>
            </li>
            
            
            
             <li class="treeview">
              <a href="#">
                <i class="fa fa-envelope"></i> <span>اطلاعیه های کاربران</span> <i class="fa fa-angle-left pull-left"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ url('/superadmin/viewselanats') }}"><i class="fa fa-envelope"></i>اطلاعیه های ارسالی
               </a> </li>
               
 <li><a href="{{ url('/superadmin/addelanuser') }}"><i class="fa fa-fw fa-user"></i>ثبت اطلاعیه تکی</a></li> 
 <li><a href="{{ url('/superadmin/addelanusergroup') }}"><i class="fa fa-fw fa-user"></i>ثبت اطلاعیه گروهی</a></li>  
               
               
              </ul>
            </li>
            
            
            
            
             <li class="treeview">
              <a href="#">
                <i class="fa fa-envelope"></i> <span>مدیریت مالی</span> <i class="fa fa-angle-left pull-left"></i>
              </a>
              <ul class="treeview-menu">
 <li><a href="{{ url('/superadmin/editcost') }}"><i class="fa fa-envelope"></i>ویرایش هزینه ها </a> </li>  
               
               
              </ul>
            </li>
            

            
             
                <li class="treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>صفحه اصلی سایت</span> <i class="fa fa-angle-left pull-left"></i>
              </a>
              <ul class="treeview-menu">
 <li><a href="{{ url('/superadmin/manageindex') }}"><i class="fa fa-fw fa-users"></i>مدیریت نمایش</a></li> 
            <li><a href="{{ url('/superadmin/mngindexedit') }}"><i class="fa fa-fw fa-users"></i>مدیریت جزییات</a></li> 
            <li><a href="{{ url('/') }}" target="_blank" ><i class="fa fa-fw fa-users"></i>مشاهده صفحه اصلی سایت</a></li>  
              </ul>
            </li>



  			<li>
              <a href="{{ url('/superadmin/editrate') }}">
                <i class="fa fa-dashboard"></i> <span>نرخ روزانه لیر </span>
              </a>
            </li>

@else


             <li class="treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>فروشنده ها</span> <i class="fa fa-angle-left pull-left"></i>
              </a>

<ul class="treeview-menu">
<li><a href="{{ url('/superadmin/viewssellers') }}"><i class="fa fa-fw fa-users"></i>مشاهده فروشنده ها </a></li>
<li><a href="{{ url('/superadmin/addseller') }}"><i class="fa fa-fw fa-user"></i>ثبت فروشنده</a></li>   
<li><a href="{{ url('/superadmin/viewschargeseller') }}"><i class="fa fa-fw fa-user"></i>مشاهده تراکنش ها</a></li>   
</ul>
            </li>
            
            
             <li class="treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>بازاریاب ها</span> <i class="fa fa-angle-left pull-left"></i>
              </a>

<ul class="treeview-menu">
<li><a href="{{ url('/superadmin/viewsmarketers') }}"><i class="fa fa-fw fa-users"></i>مشاهده بازاریاب ها </a></li>
<li><a href="{{ url('/superadmin/addmarketer') }}"><i class="fa fa-fw fa-user"></i>ثبت بازاریاب</a></li>   
<li><a href="{{ url('/superadmin/viewschargemarketer') }}"><i class="fa fa-fw fa-user"></i>مشاهده تراکنش ها</a></li>   
</ul>
            </li>
            


                <li class="treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>قوانین</span> <i class="fa fa-angle-left pull-left"></i>
              </a>
              <ul class="treeview-menu"> 
<li><a href="{{ url('/superadmin/lawmarketer') }}"><i class="fa fa-fw fa-user"></i>قوانین بازاریاب</a></li>   
<li><a href="{{ url('/superadmin/lawseller') }}"><i class="fa fa-fw fa-user"></i>قوانین فروشنده</a></li>   
              </ul>
            </li>




                <li class="treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>هزینه ارسال</span> <i class="fa fa-angle-left pull-left"></i>
              </a>
              <ul class="treeview-menu">
            <li><a href="{{ url('/superadmin/costsendtoadres') }}"><i class="fa fa-fw fa-envelope"></i>هزینه ارسال مرسوله به سمت آدرس </a></li>   
              </ul>
            </li>
            
               

       
             <li class="treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>کتوگری محصول </span> <i class="fa fa-angle-left pull-left"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ url('/superadmin/viewscategory') }}"><i class="fa fa-fw fa-users"></i>مشاهده کتوگری </a></li>
                <li><a href="{{ url('/superadmin/addcategory') }}"><i class="fa fa-fw fa-user"></i>ثبت کتوگری</a></li>   
              </ul>
            </li>
             
             <li class="treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>گروه بندی محصولات</span> <i class="fa fa-angle-left pull-left"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ url('/superadmin/viewsgroupcat') }}"><i class="fa fa-fw fa-users"></i>مشاهده گروه بندی محصولات </a></li>
                <li><a href="{{ url('/superadmin/addgroupcat') }}"><i class="fa fa-fw fa-user"></i>ثبت گروه بندی محصولات</a></li>   
              </ul>
            </li>
            
                    
             <li class="treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>محصولات </span> <i class="fa fa-angle-left pull-left"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ url('/superadmin/viewsproducts') }}"><i class="fa fa-fw fa-users"></i>مشاهده محصولات </a></li>
                <li><a href="{{ url('/superadmin/addproduct') }}"><i class="fa fa-fw fa-user"></i>ثبت محصول</a></li>   
              </ul>
            </li>
            
            
             

                <li class="treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>درگاه پرداخت</span> <i class="fa fa-angle-left pull-left"></i>
              </a>
              <ul class="treeview-menu">
            <li><a href="{{ url('/superadmin/viewsgetwaypaysshop') }}"><i class="fa fa-fw fa-users"></i>مدیریت درگاه پرداخت</a></li>  
              </ul>
            </li>
            

                <li class="treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>فروشگاه</span> <i class="fa fa-angle-left pull-left"></i>
              </a>
              <ul class="treeview-menu">
              
              
 <li><a href="{{ url('/superadmin/viewsshoping') }}"><i class="fa fa-fw fa-envelope"></i>مشاهده همه خریدها</a></li> 
 
  <li><a href="{{ url('/superadmin/viewsshopsabad') }}"><i class="fa fa-fw fa-envelope"></i>سبد خرید کاربران</a></li> 
 
 
 <li><a href="{{ url('/superadmin/viewsshopbuy') }}"><i class="fa fa-fw fa-envelope"></i>خریدهای انجام شده(منتظر ارسال)</a></li> 
 <li><a href="{{ url('/superadmin/viewsshopsend') }}"><i class="fa fa-fw fa-envelope"></i>خریدهای ارسال شده</a></li> 
 <li><a href="{{ url('/superadmin/viewsshoprecv') }}"><i class="fa fa-fw fa-envelope"></i>خریدهای تحویل داده شده</a></li>     
              </ul>
            </li>
            
            
            
                <li class="treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>صفحات فروشگاه</span> <i class="fa fa-angle-left pull-left"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ url('/superadmin/viewspagesshop') }}"><i class="fa fa-fw fa-users"></i>مشاهده صفحات</a></li>
                <li><a href="{{ url('/superadmin/addpageshop') }}"><i class="fa fa-fw fa-user"></i>ثبت صفحه</a></li>   
              </ul>
            </li>


            
             
                <li class="treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>صفحه اصلی فروشگاه</span> <i class="fa fa-angle-left pull-left"></i>
              </a>
              <ul class="treeview-menu">
 <li><a href="{{ url('/superadmin/manageindexshop') }}"><i class="fa fa-fw fa-users"></i>مدیریت نمایش فروشگاه</a></li> 
<li><a href="{{ url('/superadmin/mngindexeditshop') }}"><i class="fa fa-fw fa-users"></i>مدیریت صفحه فروشگاه</a></li> 
<li><a href="{{ url('/superadmin/mngindexaffiliates') }}"><i class="fa fa-fw fa-users"></i>مدیریت صفحه همکاری در فروش</a></li> 
            
 <li><a href="{{ url('/superadmin/managesocialindex') }}"><i class="fa fa-fw fa-users"></i>مدیریت نمایش صفحات اجتماعی </a></li>  
            
            <li><a href="{{ url('/shop') }}" target="_blank" ><i class="fa fa-fw fa-users"></i>مشاهده صفحه فروشگاه</a></li>  
              </ul>
            </li>

            
             
                <li class="treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>شبکه های اجتماعی</span> <i class="fa fa-angle-left pull-left"></i>
              </a>
              <ul class="treeview-menu">
 <li><a href="{{ url('/superadmin/managesocial') }}"><i class="fa fa-fw fa-users"></i>مدیریت شبکه های اجتماعی</a></li> 
 <li><a href="{{ url('/superadmin/addsocial') }}"><i class="fa fa-fw fa-users"></i>ثبت شبکه اجتماعی</a></li> 
   
              </ul>
            </li>
            
             
                <li class="treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>تنظیمات ایمیل</span> <i class="fa fa-angle-left pull-left"></i>
              </a>
              <ul class="treeview-menu">
 <li><a href="{{ url('/superadmin/manageemail') }}"><i class="fa fa-fw fa-users"></i>مدیریت نمایش ایمیل </a></li>  
   
              </ul>
            </li>
            
            
             
                <li class="treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>اطلاع رسانی فروشگاه</span> <i class="fa fa-angle-left pull-left"></i>
              </a>
              <ul class="treeview-menu">
 <li><a href="{{ url('/superadmin/viewsnotices') }}"><i class="fa fa-fw fa-users"></i>فرمت اطلاع رسانی ها </a></li>  
   
              </ul>
            </li>
            
            
            

            
                

@endif

  			<li>
              <a href="{{ url('/superadmin/statics') }}">
                <i class="fa fa-envelope"></i> <span>مشاهده آمار بازدید سایت</span>
              </a>
            </li>
         
         
         
         
         
             


            


          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">

@yield('superadmin')
  
      </div>
      </div>
      
      <!-- /.content-wrapper -->
     <!--
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.2.0
        </div>
        <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights reserved.
      </footer>
      -->


      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->




    <!-- jQuery 2.1.4 -->
    <script src="{{env('APP_URL')}}/build/style/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="{{env('APP_URL')}}/build/style/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{env('APP_URL')}}/build/style/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{env('APP_URL')}}/build/style/plugins/datatables/dataTables.bootstrap.min.js"></script>

    <script src="{{env('APP_URL')}}/build/style/plugins/select2/select2.full.min.js"></script>
    <script src="{{env('APP_URL')}}/build/style/plugins/iCheck/icheck.min.js"></script>
    
    <script src="{{env('APP_URL')}}/build/style/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="{{env('APP_URL')}}/build/style/plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{env('APP_URL')}}/build/style/dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{env('APP_URL')}}/build/style/dist/js/demo.js"></script>
    <!-- page script -->
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
    @yield('scriptfooter')
  

    
  </body>
</html>

      
      
        
        