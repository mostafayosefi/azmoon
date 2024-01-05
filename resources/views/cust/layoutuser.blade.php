 <!DOCTYPE html>
<html lang="en">


<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
@yield('title') 

  <!-- plugins:css -->
  <link rel="stylesheet" href="{{env('APP_URL')}}/build/melody/vendors/iconfonts/font-awesome/css/all.min.css">
  <link rel="stylesheet" href="{{env('APP_URL')}}/build/melody/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="{{env('APP_URL')}}/build/melody/vendors/css/vendor.bundle.addons.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{env('APP_URL')}}/build/melody/css/style.css">
  <link rel="stylesheet" href="{{env('APP_URL')}}/build/melody/css/persian-datepicker-0.4.5.min.css">
  <link rel="stylesheet" href="{{env('APP_URL')}}/build/melody/vendors/chosen/chosen.min.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{env('APP_URL')}}/build/melody/images/favicon.png" />
</head>

<body class="rtl">

  <!-- Preloader -->
  
  <!--
  <div id="global-loader">
    <div class="loader-demo-box">
      <div class="square-box-loader">
        <div class="square-box-loader-container">
          <div class="square-box-loader-corner-top"></div>
          <div class="square-box-loader-corner-bottom"></div>
        </div>
        <div class="square-box-loader-square"></div>
      </div>
    </div>
  </div>
  -->
  <!-- End Preloader -->

  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row default-layout-navbar">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="{{env('APP_URL')}}/"><img src="{{env('APP_URL')}}/public/images/{{Session::get('ind_himglog')}}" alt="logo" /></a>
        <a class="navbar-brand brand-logo-mini" href="{{env('APP_URL')}}/"><img src="{{env('APP_URL')}}/public/images/{{Session::get('ind_himglogmini')}}" alt="logo" /></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-stretch">

 <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="fas fa-bars"></span>
        </button>
      
        <ul class="navbar-nav navbar-nav-right">
 
 
        
        
    <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#"
              data-toggle="dropdown">
              <i class="fas fa-bell mx-0"></i>
              <span class="count">{{Session::get('countalertuser')}}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
              aria-labelledby="notificationDropdown">
              <a class="dropdown-item">
 <p class="mb-0 font-weight-normal float-left">شما {{Session::get('countalertuser')}} اعلان جدید دارید
                </p> 
              </a>
 
               
              
              

@foreach(Session::get('alertnotfuser') as $notf)
 

@if($notf->type=='15')
 <div class="dropdown-divider"></div>
 <a class="dropdown-item preview-item" href="{{env('APP_URL')}}/user/viewstickets/ticket/{{$notf->link}}">
 <div class="preview-thumbnail">
 <div class="preview-icon bg-info">
 <i class="far fa-envelope mx-0"></i>
 </div>
 </div>
 <div class="preview-item-content">
 <h6 class="preview-subject font-weight-medium"> مدیریت به تیکت شما پاسخ داد </h6>
 <p class="sub-text text-muted"> {{jDate::forge($notf->date)->format('Y/m/d ساعت H:i a')}}</p>
 </div>
 </a> 
@endif

@endforeach
              
              
            </div>
          </li>
          
          
          
 
 
 
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img  src="{{env('APP_URL')}}/public/images/{{ Session::get('usimg')}}" alt="profile" />
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a href="{{env('APP_URL')}}/user/myprofile/edit" class="dropdown-item">
                <i class="fas fa-cog text-primary"></i>
                تنظیمات
              </a>
              <div class="dropdown-divider"></div>
              <a  href="{{env('APP_URL')}}/user/sign-out" class="dropdown-item">
                <i class="fas fa-power-off text-primary"></i>
                خروج
              </a>
            </div>
          </li>
 
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
          data-toggle="offcanvas">
          <span class="fas fa-bars"></span> مشاهده خدمات
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
 
   
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <div class="nav-link">
              <div class="profile-image">
                <img  src="{{env('APP_URL')}}/public/images/{{ Session::get('usimg')}}" alt="image" />
              </div>
              <div class="profile-name">
                <p class="name">
                  کاربر آنلاین
                </p>
                <p class="designation">
                 {{ Session::get('fullname')}}  
                </p>
              </div>
            </div>
          </li>
          <li class="nav-item  @if(Session::get('nav')=='panel') active @endif">
            <a class="nav-link" href="{{env('APP_URL')}}/user/panel">
              <i class="fa fa-home menu-icon"></i>
              <span class="menu-title">داشبورد</span>
            </a>
          </li>
  
          
           
          
          
          <li class="nav-item  @if((Session::get('nav')=='pteturkey')||(Session::get('nav')=='pteaz')||(Session::get('nav')=='pteem')||(Session::get('nav')=='pteirqs')) active @endif">
            <a class="nav-link" data-toggle="collapse" href="#page-pte" aria-expanded="false"  aria-controls="page-pte">
            <i class="fas fa-table menu-icon"></i>
              <span class="menu-title">ثبت نام آزمون PTE</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse @if((Session::get('nav')=='pteturkey')||(Session::get('nav')=='pteaz')||(Session::get('nav')=='pteem')||(Session::get('nav')=='pteirqs')) active @endif" id="page-pte">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item "> <a class="nav-link @if(Session::get('nav')=='pteturkey') active @endif"  href="{{env('APP_URL')}}/user/regord/pteturkey">ثبت نام PTE ترکیه</a>
                </li>
                <li class="nav-item "> <a class="nav-link @if(Session::get('nav')=='pteaz') active @endif"  href="{{env('APP_URL')}}/user/regord/pteaz">ثبت نام PTE آذربایجان</a></li>
                <li class="nav-item "> <a class="nav-link @if(Session::get('nav')=='pteem') active @endif"  href="{{env('APP_URL')}}/user/regord/pteem">ثبت نام PTE امارات</a></li>
                <li class="nav-item "> <a class="nav-link @if(Session::get('nav')=='pteirq') active @endif"  href="{{env('APP_URL')}}/user/regord/pteirqs">ثبت نام PTE عراق</a></li>
                <li class="nav-item "> <a class="nav-link @if(Session::get('nav')=='pteirq') active @endif"  href="{{env('APP_URL')}}/user/regord/ptearm">ثبت نام PTE ارمنستان</a></li>
              </ul>
            </div>
          </li>
          
 
          
          
          <li class="nav-item  @if((Session::get('nav')=='makplatinum')||(Session::get('nav')=='mskab')||(Session::get('nav')=='makbc')||(Session::get('nav')=='makac')||(Session::get('nav')=='maka')||(Session::get('nav')=='makb')||(Session::get('nav')=='makc')) active @endif">
 <a class="nav-link" data-toggle="collapse" href="#page-mak" aria-expanded="false"  aria-controls="page-mak">
            <i class="fas fa-table menu-icon"></i>
              <span class="menu-title"> خرید ماک   </span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse @if((Session::get('nav')=='makplatinum')||(Session::get('nav')=='mskab')||(Session::get('nav')=='makbc')||(Session::get('nav')=='makac')||(Session::get('nav')=='maka')||(Session::get('nav')=='makb')||(Session::get('nav')=='makc')) active @endif" id="page-mak">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item "> <a class="nav-link @if(Session::get('nav')=='makplatinum') active @endif"  href="{{env('APP_URL')}}/user/regord/makplatinum_new">ماک Platinum </a>
                </li>
                <li class="nav-item "> <a class="nav-link @if(Session::get('nav')=='mskab') active @endif"  href="{{env('APP_URL')}}/user/regord/makab_new"> (A+B) Gold ماک</a></li>
               
               <!--
                <li class="nav-item "> <a class="nav-link @if(Session::get('nav')=='makbc') active @endif"  href="{{env('APP_URL')}}/user/regord/makbc"> (B+C) Gold ماک</a></li>
                <li class="nav-item "> <a class="nav-link @if(Session::get('nav')=='makac') active @endif"  href="{{env('APP_URL')}}/user/regord/makac"> (A+C) Gold ماک</a></li>
                
                -->
              
                <li class="nav-item "> <a class="nav-link @if(Session::get('nav')=='maka') active @endif"  href="{{env('APP_URL')}}/user/regord/maka_new">ماک تکی A</a></li>
                <li class="nav-item "> <a class="nav-link @if(Session::get('nav')=='makb') active @endif"  href="{{env('APP_URL')}}/user/regord/makb_new">ماک تکی B </a></li>
                <li class="nav-item "> <a class="nav-link @if(Session::get('nav')=='makc') active @endif"  href="{{env('APP_URL')}}/user/regord/makc_new">ماک تکی C </a></li>
                
                 
                <li class="nav-item "> <a class="nav-link @if(Session::get('nav')=='makc') active @endif"  href="{{env('APP_URL')}}/user/regord/makd_new">ماک تکی D </a></li>
                <li class="nav-item "> <a class="nav-link @if(Session::get('nav')=='makc') active @endif"  href="{{env('APP_URL')}}/user/regord/make_new">ماک تکی E </a></li>
                 
                
              </ul>
            </div>
          </li>
          
          
          <li class="nav-item  @if((Session::get('nav')=='apeuni1')||(Session::get('nav')=='apeuni3')||(Session::get('nav')=='apeuni6')) active @endif">
            <a class="nav-link" data-toggle="collapse" href="#page-apeuni" aria-expanded="false"  aria-controls="page-apeuni">
            <i class="fas fa-table menu-icon"></i>
              <span class="menu-title">خرید اکانت Apeuni  </span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse @if((Session::get('nav')=='apeuni1')||(Session::get('nav')=='apeuni3')||(Session::get('nav')=='apeuni6')) active @endif" id="page-apeuni">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item "> <a class="nav-link @if(Session::get('nav')=='apeuni1') active @endif"  href="{{env('APP_URL')}}/user/regord/apeuni1">اکانت یک ماهه</a>
                </li>
                <li class="nav-item "> <a class="nav-link @if(Session::get('nav')=='apeuni3') active @endif"  href="{{env('APP_URL')}}/user/regord/apeuni3">اکانت سه ماهه</a>
                </li>
                <li class="nav-item "> <a class="nav-link @if(Session::get('nav')=='apeuni6') active @endif"  href="{{env('APP_URL')}}/user/regord/apeuni6">اکانت شش ماهه</a>
                </li>
 
              </ul>
            </div>
          </li>     
                    
          <li class="nav-item  @if((Session::get('nav')=='hotelscom')||(Session::get('nav')=='airbnb')) active @endif">
            <a class="nav-link" data-toggle="collapse" href="#page-hotel" aria-expanded="false"  aria-controls="page-hotel">
            <i class="fas fa-table menu-icon"></i>
              <span class="menu-title">  رزرو هتل و خانه  </span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse @if((Session::get('nav')=='hotelscom')||(Session::get('nav')=='airbnb')) active @endif" id="page-hotel">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item "> <a class="nav-link @if(Session::get('nav')=='hotelscom') active @endif"  href="{{env('APP_URL')}}/user/regord/hotelscom">رزرو هتل از Hotels.com</a>
                </li>
                <li class="nav-item "> <a class="nav-link @if(Session::get('nav')=='airbnb') active @endif"  href="{{env('APP_URL')}}/user/regord/airbnb">رزرو خانه از Airbnb </a>
                </li> 
 
              </ul>
            </div>
          </li>     
          
          <li class="nav-item  @if(Session::get('nav')=='naani') active @endif">
            <a class="nav-link" data-toggle="collapse" href="#page-naani" aria-expanded="false"  aria-controls="page-naani">
            <i class="fas fa-table menu-icon"></i>
              <span class="menu-title">  آزمون ناتی  </span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse @if(Session::get('nav')=='naani') active @endif" id="page-naani">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item "> <a class="nav-link @if(Session::get('nav')=='naati') active @endif"  href="{{env('APP_URL')}}/user/regord/naati"> ثبت نام آزمون NAATI  </a>
                </li>
        
 
              </ul>
            </div>
          </li>     
          
           
           
          
          
          
          
          <!--
          <li class="nav-item  @if((Session::get('nav')=='rezervmak')||(Session::get('nav')=='viewsrezervmaks')) active @endif">
            <a class="nav-link" data-toggle="collapse" href="#page-rzmak" aria-expanded="false"  aria-controls="page-rzmak">
            <i class="fas fa-table menu-icon"></i>
              <span class="menu-title">خرید و رزرو ماک حضوری  </span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse @if((Session::get('nav')=='rezervmak')||(Session::get('nav')=='viewsrezervmaks')) active @endif" id="page-rzmak">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item "> <a class="nav-link @if(Session::get('nav')=='rezervmak') active @endif"  href="{{env('APP_URL')}}/user/rezervdmak">خرید و رزرو ماک حضوری</a>
                </li>
                <li class="nav-item "> <a class="nav-link @if(Session::get('nav')=='viewsrezervmaks') active @endif"  href="{{env('APP_URL')}}/user/viewsrezervmaks"> مشاهده سفارشات ماک</a></li> 
              </ul>
            </div>
          </li>
          
          -->
 
          
          <li class="nav-item  @if(Session::get('nav')=='viewsonlineshops') active @endif">
            <a class="nav-link" href="{{env('APP_URL')}}/user/viewsonlineshops">
              <i class="fa fa-table menu-icon"></i>
              <span class="menu-title">مشاهده درخواستهای من</span>
            </a>
          </li>
  
          
          <li class="nav-item   @if((Session::get('nav')=='addticket')||(Session::get('nav')=='viewstickets')||(Session::get('nav')=='viewselanatsuser')) active @endif">
            <a class="nav-link" data-toggle="collapse" href="#page-ticket" aria-expanded="false"  aria-controls="page-ticket">
            <i class="fas fa-table menu-icon"></i>
              <span class="menu-title">پشتیبانی    </span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse  @if((Session::get('nav')=='addticket')||(Session::get('nav')=='viewstickets')||(Session::get('nav')=='viewselanatsuser')) active @endif" id="page-ticket">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item "> <a class="nav-link @if(Session::get('nav')=='addticket') active @endif"  href="{{env('APP_URL')}}/user/addticket">ثبت تیکت</a>
                </li>
                <li class="nav-item "> <a class="nav-link @if(Session::get('nav')=='apeuni3') active @endif"  href="{{env('APP_URL')}}/user/viewstickets">مشاهده تیکتها
               @if (Session::get('tickreaduser')!=0)   
<span  class="btn btn-info  btn-rounded btn-sm"  title="پیام جدید" > {{ Session::get('tickreaduser')}}</span> @endif 
                
                </a>
                </li>
   
 
              </ul>
            </div>
          </li>
               
          
 
          
        
        </ul>
      </nav>
      <!-- partial -->

@yield('superadmin')
 
@yield('scriptfooter')

 </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="{{env('APP_URL')}}/build/melody/vendors/js/vendor.bundle.base.js"></script>
  <script src="{{env('APP_URL')}}/build/melody/vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="{{env('APP_URL')}}/build/melody/js/off-canvas.js"></script>
  <script src="{{env('APP_URL')}}/build/melody/js/hoverable-collapse.js"></script>
  <script src="{{env('APP_URL')}}/build/melody/js/misc.js"></script>
  <script src="{{env('APP_URL')}}/build/melody/js/settings.js"></script>
  <script src="{{env('APP_URL')}}/build/melody/js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="{{env('APP_URL')}}/build/melody/js/dashboard.js"></script>
  <script src="{{env('APP_URL')}}/build/melody/vendors/chosen/chosen.jquery.min.js"></script>
  <script src="{{env('APP_URL')}}/build/melody/vendors/moment/min/moment.min.js"></script>
  <script src="{{env('APP_URL')}}/build/melody/js/persian-date-0.1.8.min.js"></script>
  <script src="{{env('APP_URL')}}/build/melody/js/persian-datepicker-0.4.5.min.js"></script>
  <!-- End custom js for this page-->

 @if((Session::get('nav')=='viewsusers')||(Session::get('nav')=='viewstickets')||(Session::get('nav')=='viewsrezervmaks'))  
  <script src="{{env('APP_URL')}}/build/melody/js/data-table.js"></script>
  @endif

 @if((Session::get('nav')=='viewsusers')||(Session::get('nav')=='viewstickets')||(Session::get('nav')=='viewsrezervmaks'))     
  <script src="{{env('APP_URL')}}/build/melody/js/tabs.js"></script>
  @endif


  <script src="{{env('APP_URL')}}/build/melody/js/file-upload.js"></script>
  <script src="{{env('APP_URL')}}/build/melody/js/typeahead.js"></script>
  <script src="{{env('APP_URL')}}/build/melody/js/select2.js"></script>
  
  
  
    <script src="{{env('APP_URL')}}/build/melody/js/formpickers.js"></script>
    <script src="{{env('APP_URL')}}/build/melody/js/form-repeater.js"></script>
  
 
 @if(Session::get('nav')=='viewsonlineshops')  
  <script src="{{env('APP_URL')}}/build/melody/js/data-table.js"></script>
  @endif
  
  <script>
    jQuery(document).ready(function () {
      jQuery("#taghvim").persianDatepicker({
        altFormat: "X",
        format: "D MMMM YYYY",
        observer: true
      });
    });
  </script>
</body>


</html>
 