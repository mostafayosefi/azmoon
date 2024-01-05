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
              <span class="count">{{Session::get('countalert')}}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
              aria-labelledby="notificationDropdown">
              <a class="dropdown-item">
 <p class="mb-0 font-weight-normal float-left">شما {{Session::get('countalert')}} اعلان جدید دارید
                </p> 
              </a>
 
               
              
              

@foreach(Session::get('alertnotf') as $notf)

@if($notf->type=='11')
 <div class="dropdown-divider"></div>
 <a class="dropdown-item preview-item"  href="{{env('APP_URL')}}/superadmin/viewsonlineshops/{{$notf->link}}/{{$notf->req}}">
 <div class="preview-thumbnail">
 <div class="preview-icon bg-warning">
 <i class="fa fa-gift mx-0"></i>
 </div>
 </div>
 <div class="preview-item-content">
 <h6 class="preview-subject font-weight-medium"> {{$notf->user_name}} درخواست جدید ایجاد کرد</h6>
 <p class="sub-text text-muted"> {{jDate::forge($notf->date)->format('Y/m/d ساعت H:i a')}}</p>
 </div>
 </a> 
@endif


@if($notf->type=='12')
 <div class="dropdown-divider"></div>
 <a class="dropdown-item preview-item"  href="{{env('APP_URL')}}/superadmin/rezervmak/{{$notf->link}}/{{$notf->req}}">
 <div class="preview-thumbnail">
 <div class="preview-icon bg-warning">
 <i class="far fa-calendar mx-0"></i>
 </div>
 </div>
 <div class="preview-item-content">
 <h6 class="preview-subject font-weight-medium"> {{$notf->user_name}} رزرو جدید ایجاد کرد</h6>
 <p class="sub-text text-muted"> {{jDate::forge($notf->date)->format('Y/m/d ساعت H:i a')}}</p>
 </div>
 </a> 
@endif


@if($notf->type=='13')
 <div class="dropdown-divider"></div>
 <a class="dropdown-item preview-item"  href="{{env('APP_URL')}}/superadmin/viewsonlineshops/{{$notf->link}}/{{$notf->req}}">
 <div class="preview-thumbnail">
 <div class="preview-icon bg-success">
 <i class="far fa-credit-card mx-0"></i>
 </div>
 </div>
 <div class="preview-item-content">
 <h6 class="preview-subject font-weight-medium"> {{$notf->user_name}} فاکتور را باموفقیت پرداخت کرد </h6>
 <p class="sub-text text-muted"> {{jDate::forge($notf->date)->format('Y/m/d ساعت H:i a')}}</p>
 </div>
 </a> 
@endif


@if($notf->type=='14')
 <div class="dropdown-divider"></div>
 <a class="dropdown-item preview-item" href="{{env('APP_URL')}}/superadmin/viewsuserticketssup/ticket/{{$notf->link}}">
 <div class="preview-thumbnail">
 <div class="preview-icon bg-info">
 <i class="far fa-envelope mx-0"></i>
 </div>
 </div>
 <div class="preview-item-content">
 <h6 class="preview-subject font-weight-medium"> {{$notf->user_name}} تیکت جدید ایجاد کرد</h6>
 <p class="sub-text text-muted"> {{jDate::forge($notf->date)->format('Y/m/d ساعت H:i a')}}</p>
 </div>
 </a> 
@endif

@endforeach
              
              
            </div>
          </li>
          
          
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="{{env('APP_URL')}}/build/melody/images/faces/face5.jpg" alt="profile" />
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a href="#" class="dropdown-item">
                <i class="fas fa-cog text-primary"></i>
                تنظیمات
              </a>
              <div class="dropdown-divider"></div>
              <a  href="{{env('APP_URL')}}/superadmin/sign-out" class="dropdown-item">
                <i class="fas fa-power-off text-primary"></i>
                خروج
              </a>
            </div>
          </li>
          
          
 
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
          data-toggle="offcanvas">
          <span class="fas fa-bars"></span>  مشاهده خدمات
        </button>
      </div>
    </nav>

    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      <div class="theme-setting-wrapper">
        <div id="settings-trigger"><i class="fas fa-fill-drip"></i></div>
        <div id="theme-settings" class="settings-panel">
          <i class="settings-close fa fa-times"></i>
          <p class="settings-heading">پوسته سایدبار</p>
          <div class="sidebar-bg-options selected" id="sidebar-light-theme">
            <div class="img-ss rounded-circle bg-light border mr-3"></div>روشن
          </div>
          <div class="sidebar-bg-options" id="sidebar-dark-theme">
            <div class="img-ss rounded-circle bg-dark border mr-3"></div>تیره
          </div>
          <p class="settings-heading mt-2">پوسته هدر</p>
          <div class="color-tiles mx-0 px-4">
            <div class="tiles primary"></div>
            <div class="tiles success"></div>
            <div class="tiles warning"></div>
            <div class="tiles danger"></div>
            <div class="tiles info"></div>
            <div class="tiles dark"></div>
            <div class="tiles default"></div>
          </div>
        </div>
      </div>
      <div id="right-sidebar" class="settings-panel">
        <i class="settings-close fa fa-times"></i>
        <ul class="nav nav-tabs" id="setting-panel" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="todo-tab" data-toggle="tab" href="#todo-section" role="tab"
              aria-controls="todo-section" aria-expanded="true">لیست انجام</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="chats-tab" data-toggle="tab" href="#chats-section" role="tab"
              aria-controls="chats-section">چت ها</a>
          </li>
        </ul>
        <div class="tab-content" id="setting-content">
          <div class="tab-pane fade show active scroll-wrapper" id="todo-section" role="tabpanel"
            aria-labelledby="todo-section">
            <div class="add-items d-flex px-3 mb-0">
              <form class="form w-100">
                <div class="form-group d-flex">
                  <input type="text" class="form-control todo-list-input" placeholder="کار جدید ...">
                  <button type="submit" class="add btn btn-primary todo-list-add-btn" id="add-task-todo">افزودن</button>
                </div>
              </form>
            </div>
            <div class="list-wrapper px-3">
              <ul class="d-flex flex-column-reverse todo-list">
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      جلسه با تیم پروژه در ساعت 3 بعد از ظهر
                    </label>
                  </div>
                  <i class="remove fa fa-times-circle"></i>
                </li>
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      آماده کردن متن سخنرانی کنفرانس
                    </label>
                  </div>
                  <i class="remove fa fa-times-circle"></i>
                </li>
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      خرید بلیط پرواز به پاریس
                    </label>
                  </div>
                  <i class="remove fa fa-times-circle"></i>
                </li>
                <li class="completed">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox" checked>
                      نوشتن برنامه ملاقات های هفته آینده
                    </label>
                  </div>
                  <i class="remove fa fa-times-circle"></i>
                </li>
                <li class="completed">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox" checked>
                      بازبینی پروژه
                    </label>
                  </div>
                  <i class="remove fa fa-times-circle"></i>
                </li>
              </ul>
            </div>
            <div class="events py-4 border-bottom px-3">
              <div class="wrapper d-flex mb-2">
                <i class="fa fa-times-circle text-primary mr-2"></i>
                <span>11 اسفند 98</span>
              </div>
              <p class="mb-0 font-weight-thin text-gray">ایجاد پروژه</p>
              <p class="text-gray mb-0">ساختن پارت های پروژه</p>
            </div>
            <div class="events pt-4 px-3">
              <div class="wrapper d-flex mb-2">
                <i class="fa fa-times-circle text-primary mr-2"></i>
                <span>18 اسفند 98</span>
              </div>
              <p class="mb-0 font-weight-thin text-gray">جلسه با مهندس افشار</p>
              <p class="text-gray mb-0 ">تماس با مهندس محمدی</p>
            </div>
          </div>
          <!-- To do section tab ends -->
          <div class="tab-pane fade" id="chats-section" role="tabpanel" aria-labelledby="chats-section">
            <div class="d-flex align-items-center justify-content-between border-bottom">
              <p class="settings-heading border-top-0 mb-3 pl-3 pt-0 border-bottom-0 pb-0">دوستان</p>
              <small class="settings-heading border-top-0 mb-3 pt-0 border-bottom-0 pb-0 pr-3 font-weight-normal">مشاهده
                همه</small>
            </div>
            <ul class="chat-list">
              <li class="list active">
                <div class="profile"><img src="{{env('APP_URL')}}/build/melody/images/faces/face1.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>رضا کریمی</p>
                  <p>آنلاین</p>
                </div>
                <small class="text-muted my-auto">19 دقیقه قبل</small>
              </li>
              <li class="list">
                <div class="profile"><img src="{{env('APP_URL')}}/build/melody/images/faces/face2.jpg" alt="image"><span class="offline"></span></div>
                <div class="info">
                  <div class="wrapper d-flex">
                    <p>نسترن</p>
                  </div>
                  <p>خیلی وقت پیش</p>
                </div>
                <div class="badge badge-success badge-pill my-auto mx-2">4</div>
                <small class="text-muted my-auto">23 دقیقه قبل</small>
              </li>
              <li class="list">
                <div class="profile"><img src="{{env('APP_URL')}}/build/melody/images/faces/face3.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>سعید توسلی</p>
                  <p>آنلاین</p>
                </div>
                <small class="text-muted my-auto">14 دقیقه قبل</small>
              </li>
              <li class="list">
                <div class="profile"><img src="{{env('APP_URL')}}/build/melody/images/faces/face4.jpg" alt="image"><span class="offline"></span></div>
                <div class="info">
                  <p>فرشاد</p>
                  <p>خیلی وقت پیش</p>
                </div>
                <small class="text-muted my-auto">2 دقیقه قبل</small>
              </li>
              <li class="list">
                <div class="profile"><img src="{{env('APP_URL')}}/build/melody/images/faces/face5.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>نیلوفر</p>
                  <p>آنلاین</p>
                </div>
                <small class="text-muted my-auto">5 دقیقه قبل</small>
              </li>
              <li class="list">
                <div class="profile"><img src="{{env('APP_URL')}}/build/melody/images/faces/face6.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>مرتضی نجفی</p>
                  <p>آنلاین</p>
                </div>
                <small class="text-muted my-auto">47 دقیقه قبل</small>
              </li>
            </ul>
          </div>
          <!-- chat tab ends -->
        </div>
      </div>
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <div class="nav-link">
              <div class="profile-image">
                <img src="{{env('APP_URL')}}/build/melody/images/faces/face5.jpg" alt="image" />
              </div>
              <div class="profile-name">
                <p class="name">
                  کاربر آنلاین
                </p>
                <p class="designation">
                  مدیر سایت
                </p>
              </div>
            </div>
          </li>
          <li class="nav-item  @if(Session::get('nav')=='panel') active @endif">
            <a class="nav-link" href="{{env('APP_URL')}}/superadmin/panel">
              <i class="fa fa-home menu-icon"></i>
              <span class="menu-title">داشبورد</span>
            </a>
          </li>
  
          
          
          <li class="nav-item   @if((Session::get('nav')=='adduser')||(Session::get('nav')=='viewsusers')) active @endif">
            <a class="nav-link" data-toggle="collapse" href="#page-user" aria-expanded="false"  aria-controls="page-user">
              <i class="far fa-user menu-icon"></i>
              <span class="menu-title">مدیریت کاربران</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse @if((Session::get('nav')=='adduser')||(Session::get('nav')=='viewsusers')) active @endif" id="page-user">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item "> <a class="nav-link @if(Session::get('nav')=='viewsusers') active @endif"
                    href="{{env('APP_URL')}}/superadmin/viewsusers">مشاهده کاربران</a>
                </li>
                <li class="nav-item "> <a class="nav-link @if(Session::get('nav')=='adduser') active @endif"
                    href="{{env('APP_URL')}}/superadmin/adduser">ثبت کاربر</a></li>
              </ul>
            </div>
          </li>     
          
          
          
          <li class="nav-item  @if((Session::get('nav')=='mngprice')||(Session::get('nav')=='mngcurrency')) active @endif">
            <a class="nav-link" data-toggle="collapse" href="#page-mngprice" aria-expanded="false"  aria-controls="page-mngprice">
            <i class="fas fa-table menu-icon"></i>
              <span class="menu-title">مدیریت هزینه ها</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse @if((Session::get('nav')=='mngprice')||(Session::get('nav')=='mngcurrency')) active @endif" id="page-mngprice">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item "> <a class="nav-link @if(Session::get('nav')=='mngprice') active @endif"  href="{{env('APP_URL')}}/superadmin/mngprice">ویرایش هزینه ها</a>
                </li> 
              
                <li class="nav-item "> <a class="nav-link @if(Session::get('nav')=='mngcurrency') active @endif"  href="{{env('APP_URL')}}/superadmin/mngcurrency">مدیریت کارنسی ها</a>
                </li> 
              
              </ul>
            </div>
          </li>
          
                    
          <li class="nav-item  @if(Session::get('nav')=='viewsonlineshops') active @endif">
            <a class="nav-link" data-toggle="collapse" href="#page-viewsonlineshops" aria-expanded="false"  aria-controls="page-viewsonlineshops">
            <i class="fas fa-table menu-icon"></i>
              <span class="menu-title">مدیریت درخواست ها</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse @if(Session::get('nav')=='viewsonlineshops') active @endif" id="page-viewsonlineshops">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item "> <a class="nav-link @if(Session::get('nav')=='viewsonlineshops') active @endif"
                    href="{{env('APP_URL')}}/superadmin/viewsonlineshops">مشاهده درخواستهای کاربران</a>
                </li> 
              </ul>
            </div>
          </li>
          
                    
          <li class="nav-item  @if(Session::get('nav')=='viewsrezervmaks') active @endif">
            <a class="nav-link" data-toggle="collapse" href="#page-viewsrezervmaks" aria-expanded="false"  aria-controls="page-viewsrezervmaks">
            <i class="fas fa-table menu-icon"></i>
              <span class="menu-title">مدیریت سفارشات ماک</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse @if(Session::get('nav')=='viewsrezervmaks') active @endif" id="page-viewsrezervmaks">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item "> <a class="nav-link @if(Session::get('nav')=='viewsrezervmaks') active @endif" href="{{env('APP_URL')}}/superadmin/viewsrezervmaks">مدیریت سفارشات ماک </a>
                </li> 
              </ul>
            </div>
          </li>
          
          
            <!--        
          <li class="nav-item  @if((Session::get('nav')=='settingrezerv')||(Session::get('nav')=='addmak')||(Session::get('nav')=='viewsmaks')||(Session::get('nav')=='settingrezervprice')) active @endif">
            <a class="nav-link" data-toggle="collapse" href="#page-settingrezerv" aria-expanded="false"  aria-controls="page-settingrezerv">
            <i class="fas fa-table menu-icon"></i>
              <span class="menu-title">تنظیمات رزرو</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse @if((Session::get('nav')=='settingrezerv')||(Session::get('nav')=='addmak')||(Session::get('nav')=='viewsmaks')||(Session::get('nav')=='settingrezervprice')) active @endif" id="page-settingrezerv">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item "> 
                <a class="nav-link @if(Session::get('nav')=='settingrezerv') active @endif" href="{{env('APP_URL')}}/superadmin/setrezerv">ثبت رزرو جدید</a>
                </li> 
                <li class="nav-item "> 
                <a class="nav-link @if(Session::get('nav')=='addmak') active @endif" href="{{env('APP_URL')}}/superadmin/addmak">ثبت ماک جدید</a>
                </li> 
                <li class="nav-item "> 
                <a class="nav-link @if(Session::get('nav')=='viewsmaks') active @endif" href="{{env('APP_URL')}}/superadmin/viewsmaks">مدیریت ماک ها</a>
                </li> 
                <li class="nav-item "> 
                <a class="nav-link @if(Session::get('nav')=='settingrezervprice') active @endif" href="{{env('APP_URL')}}/superadmin/settingrezervprice">مدیریت هزینه رزرو</a>
                </li> 
              </ul>
            </div>
          </li>
          -->

          
          <li class="nav-item   @if((Session::get('nav')=='adddiscount')||(Session::get('nav')=='mngdiscount')) active @endif">
            <a class="nav-link" data-toggle="collapse" href="#page-discount" aria-expanded="false"  aria-controls="page-discount">
              <i class="fa fa-table menu-icon"></i>
              <span class="menu-title">مدیریت تخفیف</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse @if((Session::get('nav')=='adddiscount')||(Session::get('nav')=='mngdiscount')) active @endif" id="page-discount">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item "> <a class="nav-link @if(Session::get('nav')=='mngdiscount') active @endif"
                    href="{{env('APP_URL')}}/superadmin/mngdiscount">مشاهده تخفیف ها</a>
                </li>
                <li class="nav-item "> <a class="nav-link @if(Session::get('nav')=='adddiscount') active @endif"
                    href="{{env('APP_URL')}}/superadmin/adddiscount">ثبت تخفیف </a></li>
              </ul>
            </div>
          </li>     
          
          
          
          
          <li class="nav-item  @if((Session::get('nav')=='viewsuserticketssupactive') ||(Session::get('nav')=='viewsuserticketssup')||(Session::get('nav')=='addelanuser')||(Session::get('nav')=='viewselanats'))  active @endif">
            <a class="nav-link" data-toggle="collapse" href="#page-ticket" aria-expanded="false"  aria-controls="page-ticket">
             <i class="fas fa-comments menu-icon"></i> 
              <span class="menu-title">پشتیبانی</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse @if((Session::get('nav')=='viewsuserticketssupactive') ||(Session::get('nav')=='viewsuserticketssup')||(Session::get('nav')=='addelanuser')||(Session::get('nav')=='viewselanats'))  active @endif" id="page-ticket">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item "> <a class="nav-link  @if(Session::get('nav')!='viewsuserticketssup') active @endif"  href="{{env('APP_URL')}}/superadmin/viewsuserticketssup">
            مشاهده تیکتهای کاربران
        
@if (Session::get('tickreadstudentsup')!=0)   
<span  class="btn btn-info  btn-rounded btn-sm"  title="پیام جدید" > {{ Session::get('tickreadstudentsup')}}</span> @endif
 </a>
                </li>
                <li class="nav-item "> <a class="nav-link  @if(Session::get('nav')!='viewsuserticketssupactive') active @endif"
                    href="{{env('APP_URL')}}/superadmin/viewsuserticketssupactive">تیکتهای منتظر پاسخ</a></li>
              </ul>
            </div>
          </li>    

          
          
 
          <li class="nav-item   @if((Session::get('nav')=='setting_login')||(Session::get('nav')=='setting_getwaypayment')) active @endif">
            <a class="nav-link" data-toggle="collapse" href="#setting" aria-expanded="false"  aria-controls="setting">
              <i class="fa fa-wrench menu-icon"></i>
              <span class="menu-title"> تنظیمات سایت  </span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse @if((Session::get('nav')=='setting_login')||(Session::get('nav')=='setting_login')) active @endif" id="setting">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item "> <a class="nav-link @if(Session::get('nav')=='setting_login') active @endif"
                    href="{{env('APP_URL')}}/superadmin/setting_login">تنظیمات لاگین</a>
                </li> 
              </ul>
            </div>
            <div class="collapse @if((Session::get('nav')=='setting_getwaypayment')||(Session::get('nav')=='setting_getwaypayment')) active @endif" id="setting">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item "> <a class="nav-link @if(Session::get('nav')=='setting_getwaypayment') active @endif"
                    href="{{env('APP_URL')}}/superadmin/setting_getwaypayment">تنظیمات درگاه پرداخت</a>
                </li> 
              </ul>
            </div>
          </li>     
          
          
          
          <!--
          
          <li class="nav-item d-none d-lg-block @if((Session::get('nav')=='addcurrencytransfer')||(Session::get('nav')=='viewscurrencytransfer')) active @endif">
            <a class="nav-link" data-toggle="collapse" href="#page-addcurrencytransfer" aria-expanded="false"  aria-controls="page-addcurrencytransfer">
            <i class="fas fa-table menu-icon"></i>
              <span class="menu-title">حواله های ارزی</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse @if((Session::get('nav')=='addcurrencytransfer')||(Session::get('nav')=='viewscurrencytransfer')) active @endif" id="page-addcurrencytransfer">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item d-none d-lg-block"> <a class="nav-link @if(Session::get('nav')=='viewscurrencytransfer') active @endif"
                    href="{{env('APP_URL')}}/superadmin/viewscurrencytransfer">مشاهده حواله های ارزی</a>
                </li>
                <li class="nav-item d-none d-lg-block"> <a class="nav-link @if(Session::get('nav')=='addcurrencytransfer') active @endif"
                    href="{{env('APP_URL')}}/superadmin/addcurrencytransfer">ثبت حواله ارزی</a></li>
              </ul>
            </div>
          </li>
          
          <li class="nav-item d-none d-lg-block @if((Session::get('nav')=='addservice')||(Session::get('nav')=='viewscurrencytransfer')) active @endif">
            <a class="nav-link" data-toggle="collapse" href="#page-addservice" aria-expanded="false"  aria-controls="page-addservice">
            <i class="fas fa-table menu-icon"></i>
              <span class="menu-title">سرویس ها</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse @if((Session::get('nav')=='addservice')||(Session::get('nav')=='viewsservice')) active @endif" id="page-addservice">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item d-none d-lg-block"> <a class="nav-link @if(Session::get('nav')=='viewsservice') active @endif"
                    href="{{env('APP_URL')}}/superadmin/viewsservice">مشاهده سرویس ها</a>
                </li>
                <li class="nav-item d-none d-lg-block"> <a class="nav-link @if(Session::get('nav')=='addservice') active @endif"
                    href="{{env('APP_URL')}}/superadmin/addservice">ثبت سرویس</a></li>
              </ul>
            </div>
          </li>
          
        
          <li class="nav-item d-none d-lg-block @if((Session::get('nav')=='viewscurrency')||(Session::get('nav')=='addcurrency')||(Session::get('nav')=='finicalsmng')) active @endif">
            <a class="nav-link" data-toggle="collapse" href="#page-viewscurrency" aria-expanded="false"  aria-controls="page-viewscurrency">
            <i class="fas fa-table menu-icon"></i>
              <span class="menu-title">مدیریت مالی</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse @if((Session::get('nav')=='viewscurrency')||(Session::get('nav')=='viewsservice')) active @endif" id="page-viewscurrency">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item d-none d-lg-block"> <a class="nav-link @if(Session::get('nav')=='viewscurrency') active @endif"
                    href="{{env('APP_URL')}}/superadmin/viewscurrency">مدیریت کارنسی ها</a>
                </li>
                <li class="nav-item d-none d-lg-block"> <a class="nav-link @if(Session::get('nav')=='addcurrency') active @endif"
                    href="{{env('APP_URL')}}/superadmin/addcurrency">ثبت کارنسی</a></li>
                <li class="nav-item d-none d-lg-block"> <a class="nav-link @if(Session::get('nav')=='finicalsmng') active @endif"
                    href="{{env('APP_URL')}}/superadmin/finicalsmng">مشاهده فاکتورها</a></li>
              </ul>
            </div>
          </li>
          
          
          <li class="nav-item d-none d-lg-block @if((Session::get('nav')=='viewsforms')||(Session::get('nav')=='createform')) active @endif">
            <a class="nav-link" data-toggle="collapse" href="#page-viewsforms" aria-expanded="false"  aria-controls="page-viewsforms">
            <i class="fas fa-table menu-icon"></i>
              <span class="menu-title">مدیریت فرم ها</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse @if((Session::get('nav')=='viewsforms')||(Session::get('nav')=='viewsservice')) active @endif" id="page-viewsforms">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item d-none d-lg-block"> <a class="nav-link @if(Session::get('nav')=='viewsforms') active @endif"
                    href="{{env('APP_URL')}}/superadmin/viewsforms">مشاهده فرم ها</a>
                </li>
                <li class="nav-item d-none d-lg-block"> <a class="nav-link @if(Session::get('nav')=='createform') active @endif"
                    href="{{env('APP_URL')}}/superadmin/createform">ایجاد فرم</a></li>
              </ul>
            </div>
          </li>
          
          <li class="nav-item d-none d-lg-block @if((Session::get('nav')=='viewsforms')||(Session::get('nav')=='createform')) active @endif">
            <a class="nav-link" data-toggle="collapse" href="#page-viewscatsform" aria-expanded="false"  aria-controls="page-viewscatsform">
            <i class="fas fa-table menu-icon"></i>
              <span class="menu-title">مدیریت دسته بندی</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse @if((Session::get('nav')=='viewsforms')||(Session::get('nav')=='viewsservice')) active @endif" id="page-viewscatsform">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item d-none d-lg-block"> <a class="nav-link @if(Session::get('nav')=='viewsforms') active @endif"
                    href="{{env('APP_URL')}}/superadmin/viewscatsform">مشاهده دسته بندی ها</a>
                </li>
                <li class="nav-item d-none d-lg-block"> <a class="nav-link @if(Session::get('nav')=='createform') active @endif"
                    href="{{env('APP_URL')}}/superadmin/createcatsform">ثبت دسته بندی</a></li>
              </ul>
            </div>
          </li>
        
          
              
          <li class="nav-item d-none d-lg-block @if((Session::get('nav')=='viewsforms')||(Session::get('nav')=='createform')) active @endif">
            <a class="nav-link" data-toggle="collapse" href="#page-addnew" aria-expanded="false"  aria-controls="page-addnew">
            <i class="fas fa-table menu-icon"></i>
              <span class="menu-title">مدیریت محتوا</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse @if((Session::get('nav')=='viewsforms')||(Session::get('nav')=='viewsservice')) active @endif" id="page-addnew">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item d-none d-lg-block"> <a class="nav-link @if(Session::get('nav')=='viewsforms') active @endif"
                    href="{{env('APP_URL')}}/superadmin/addnew">ثبت خبر</a>
                </li>
                <li class="nav-item d-none d-lg-block"> <a class="nav-link @if(Session::get('nav')=='createform') active @endif"
                    href="{{env('APP_URL')}}/superadmin/viewsnews">مشاهده اخبار</a></li>
                <li class="nav-item d-none d-lg-block"> <a class="nav-link @if(Session::get('nav')=='addpage') active @endif"
                    href="{{env('APP_URL')}}/superadmin/addpage">ثبت خدمات</a>
                </li>
                <li class="nav-item d-none d-lg-block"> <a class="nav-link @if(Session::get('nav')=='viewspages') active @endif"
                    href="{{env('APP_URL')}}/superadmin/viewspages">مشاهده خدمات</a></li>
              </ul>
            </div>
          </li>
        
          
              
          <li class="nav-item d-none d-lg-block @if((Session::get('nav')=='viewsforms')||(Session::get('nav')=='createform')) active @endif">
            <a class="nav-link" data-toggle="collapse" href="#page-manageindex" aria-expanded="false"  aria-controls="page-manageindex">
            <i class="fas fa-table menu-icon"></i>
              <span class="menu-title">تنظیمات سایت</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse @if((Session::get('nav')=='viewsforms')||(Session::get('nav')=='viewsservice')) active @endif" id="page-manageindex">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item d-none d-lg-block"> <a class="nav-link @if(Session::get('nav')=='viewsforms') active @endif"
                    href="{{env('APP_URL')}}/superadmin/manageindex">مدیریت نمایش صفحه اصلی</a>
                </li>
                <li class="nav-item d-none d-lg-block"> <a class="nav-link @if(Session::get('nav')=='mngindexedit') active @endif"
                    href="{{env('APP_URL')}}/superadmin/mngindexedit">مدیریت جزییات صفحه اصلی</a></li>
                <li class="nav-item d-none d-lg-block"> <a class="nav-link @if(Session::get('nav')=='viewsgetwaypays') active @endif"
                    href="{{env('APP_URL')}}/superadmin/viewsgetwaypays">مدیریت درگاه پرداخت</a>
                </li>
                <li class="nav-item d-none d-lg-block"> <a class="nav-link @if(Session::get('nav')=='viewspanelsms') active @endif"
                    href="{{env('APP_URL')}}/superadmin/viewspanelsms">مدیریت پنل اسمس</a></li>
                <li class="nav-item d-none d-lg-block"> <a class="nav-link @if(Session::get('nav')=='addsocial') active @endif"
                    href="{{env('APP_URL')}}/superadmin/addsocial">ثبت شبکه های اجتماعی</a>
                </li>
                <li class="nav-item d-none d-lg-block"> <a class="nav-link @if(Session::get('nav')=='mngsocial') active @endif"
                    href="{{env('APP_URL')}}/superadmin/mngsocial">مدیریت شبکه های اجتماعی</a></li>
              </ul>
            </div>
          </li>
        
              
          <li class="nav-item d-none d-lg-block @if((Session::get('nav')=='viewsforms')||(Session::get('nav')=='createform')) active @endif">
            <a class="nav-link" data-toggle="collapse" href="#page-viewsuserticketssupactive" aria-expanded="false"  aria-controls="page-viewsuserticketssupactive">
            <i class="fas fa-table menu-icon"></i>
              <span class="menu-title">پشتیبانی</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse @if((Session::get('nav')=='viewsforms')||(Session::get('nav')=='viewsservice')) active @endif" id="page-viewsuserticketssupactive">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item d-none d-lg-block"> <a class="nav-link @if(Session::get('nav')=='viewsuserticketssupactive') active @endif"
                    href="{{env('APP_URL')}}/superadmin/viewsuserticketssupactive">تیکتهای منتظر پاسخ</a>
                </li>
                <li class="nav-item d-none d-lg-block"> <a class="nav-link @if(Session::get('nav')=='addelanuser') active @endif"
                    href="{{env('APP_URL')}}/superadmin/addelanuser">ثبت اطلاعیه تکی</a></li>
                <li class="nav-item d-none d-lg-block"> <a class="nav-link @if(Session::get('nav')=='viewselanats') active @endif"
                    href="{{env('APP_URL')}}/superadmin/viewselanats">مشاهده اطلاعیه ها</a>
                </li> 
              </ul>
            </div>
          </li>
        
          -->
        
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

 @if((Session::get('nav')=='viewsusers')||(Session::get('nav')=='viewsonlineshops')||(Session::get('nav')=='viewsuserticketssup')||(Session::get('nav')=='viewsuserticketssupactive')||(Session::get('nav')=='viewsrezervmaks')||(Session::get('nav')=='viewsmaks')||(Session::get('nav')=='mngdiscount'))  
  <script src="{{env('APP_URL')}}/build/melody/js/data-table.js"></script>
  @endif

 @if((Session::get('nav')=='viewsusers')||(Session::get('nav')=='viewsonlineshops')||(Session::get('nav')=='viewsuserticketssup')||(Session::get('nav')=='viewsuserticketssupactive')||(Session::get('nav')=='viewsrezervmaks')||(Session::get('nav')=='viewsmaks')||(Session::get('nav')=='mngdiscount'))   
  <script src="{{env('APP_URL')}}/build/melody/js/tabs.js"></script>
  @endif


  <script src="{{env('APP_URL')}}/build/melody/js/select2.js"></script>


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
 