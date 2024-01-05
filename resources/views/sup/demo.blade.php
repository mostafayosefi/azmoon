<!DOCTYPE html>
<html lang="en">


<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>قالب مدیریتی Melody </title>
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
  <!-- End Preloader -->

  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row default-layout-navbar">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="index-2.html"><img src="{{env('APP_URL')}}/build/melody/images/logo.svg" alt="logo" /></a>
        <a class="navbar-brand brand-logo-mini" href="index-2.html"><img src="{{env('APP_URL')}}/build/melody/images/logo-mini.svg" alt="logo" /></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-stretch">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="fas fa-bars"></span>
        </button>
        <ul class="navbar-nav">
          <li class="nav-item nav-search d-none d-md-flex">
            <div class="nav-link">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="fas fa-search"></i>
                  </span>
                </div>
                <input type="text" class="form-control" placeholder="جستجو ..." aria-label="Search">
              </div>
            </div>
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown d-none d-lg-flex">
            <div class="nav-link">
              <span class="dropdown-toggle btn btn-outline-dark" id="languageDropdown"
                data-toggle="dropdown">فارسی</span>
              <div class="dropdown-menu navbar-dropdown" aria-labelledby="languageDropdown">
                <a class="dropdown-item font-weight-medium" href="#">
                  انگلیسی
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item font-weight-medium" href="#">
                  اسپانیایی
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item font-weight-medium" href="#">
                  ترکی استانبولی
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item font-weight-medium" href="#">
                  عربی
                </a>
              </div>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#"
              data-toggle="dropdown">
              <i class="fas fa-bell mx-0"></i>
              <span class="count">16</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
              aria-labelledby="notificationDropdown">
              <a class="dropdown-item">
                <p class="mb-0 font-weight-normal float-left">شما 16 اعلان جدید دارید
                </p>
                <span class="badge badge-pill badge-warning float-right">مشاهده همه</span>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-danger">
                    <i class="fas fa-exclamation-circle mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-medium">خطایی رخ داده است</h6>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-warning">
                    <i class="fas fa-wrench mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-medium">به روز رسانی تنظیمات</h6>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-info">
                    <i class="far fa-envelope mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-medium">کاربر جدید ثبت نام کرد</h6>
                </div>
              </a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown"
              aria-expanded="false">
              <i class="fas fa-envelope mx-0"></i>
              <span class="count">25</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
              aria-labelledby="messageDropdown">
              <div class="dropdown-item">
                <p class="mb-0 font-weight-normal float-left">شما 7 پیام خوانده نشده دارید
                </p>
                <span class="badge badge-info badge-pill float-right">مشاهده همه</span>
              </div>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <img src="{{env('APP_URL')}}/build/melody/images/faces/face4.jpg" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-medium">رضا افشار
                    <span class="float-left font-weight-light small-text">1 دقیقه قبل</span>
                  </h6>
                  <p class="font-weight-light small-text">
                    جلسه کنسل شده است
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <img src="{{env('APP_URL')}}/build/melody/images/faces/face2.jpg" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-medium">نسترن کریمی
                    <span class="float-left font-weight-light small-text">15 دقیقه قبل</span>
                  </h6>
                  <p class="font-weight-light small-text">
                    محصولات جدید ارسال شد
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <img src="{{env('APP_URL')}}/build/melody/images/faces/face3.jpg" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-medium"> محمد رسولی
                    <span class="float-left font-weight-light small-text">18 دقیقه قبل</span>
                  </h6>
                  <p class="font-weight-light small-text">
                    تغییر زمان کنفرانس
                  </p>
                </div>
              </a>
            </div>
          </li>
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="{{env('APP_URL')}}/build/melody/images/faces/face5.jpg" alt="profile" />
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item">
                <i class="fas fa-cog text-primary"></i>
                تنظیمات
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item">
                <i class="fas fa-power-off text-primary"></i>
                خروج
              </a>
            </div>
          </li>
          <li class="nav-item nav-settings d-none d-lg-block">
            <a class="nav-link" href="#">
              <i class="fas fa-ellipsis-h"></i>
            </a>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
          data-toggle="offcanvas">
          <span class="fas fa-bars"></span>
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
          <li class="nav-item">
            <a class="nav-link" href="index-2.html">
              <i class="fa fa-home menu-icon"></i>
              <span class="menu-title">داشبورد</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/widgets.html">
              <i class="fa fa-puzzle-piece menu-icon"></i>
              <span class="menu-title">ویجت ها</span>
            </a>
          </li>
          <li class="nav-item d-none d-lg-block">
            <a class="nav-link" data-toggle="collapse" href="#page-layouts" aria-expanded="false"
              aria-controls="page-layouts">
              <i class="fab fa-trello menu-icon"></i>
              <span class="menu-title">لایه های صفحه</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="page-layouts">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item d-none d-lg-block"> <a class="nav-link"
                    href="pages/layout/boxed-layout.html">بسته</a></li>
                <li class="nav-item d-none d-lg-block"> <a class="nav-link"
                    href="pages/layout/horizontal-menu.html">منوی افقی</a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item d-none d-lg-block">
            <a class="nav-link" data-toggle="collapse" href="#sidebar-layouts" aria-expanded="false"
              aria-controls="sidebar-layouts">
              <i class="fas fa-columns menu-icon"></i>
              <span class="menu-title">لایه های سایدبار</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="sidebar-layouts">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/layout/compact-menu.html">منوی فشرده</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/layout/sidebar-collapsed.html">منو آیکون</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/layout/sidebar-hidden.html">سایدبار مخفی</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/layout/sidebar-hidden-overlay.html">سایدبار جمع
                    شده</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/layout/sidebar-fixed.html">سایدبار ثابت</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="far fa-compass menu-icon"></i>
              <span class="menu-title">عناصر UI</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/ui-features/accordions.html">آکاردئون</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/ui-features/buttons.html">دکمه ها</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/ui-features/badges.html">نشان ها</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/ui-features/breadcrumbs.html">مسیر راهنما</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/ui-features/dropdowns.html">منو کشویی</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/ui-features/modals.html">مدال ها</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/ui-features/progress.html">نوار پیشرفت</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/ui-features/pagination.html">صفحه بندی</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/ui-features/tabs.html">تب ها</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">تایپوگرافی</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/ui-features/tooltips.html">راهنما ابزار
                    (Tooltips)</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-advanced" aria-expanded="false"
              aria-controls="ui-advanced">
              <i class="fas fa-clipboard-list menu-icon"></i>
              <span class="menu-title">عناصر پیشرفته</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-advanced">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/ui-features/dragula.html">کشیدن و رها کردن</a>
                </li>
                <li class="nav-item"> <a class="nav-link" href="pages/ui-features/clipboard.html">کلیپ بورد</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/ui-features/context-menu.html">منوی متن</a>
                </li>
                <li class="nav-item"> <a class="nav-link" href="pages/ui-features/slider.html">اسلایدر نواری</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/ui-features/carousel.html">اسلایدر تصاویر</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/ui-features/grid.html">سیستم شبکه بندی</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/ui-features/loaders.html">لودینگ</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false"
              aria-controls="form-elements">
              <i class="fab fa-wpforms menu-icon"></i>
              <span class="menu-title">فرم ها</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="form-elements">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="pages/forms/basic_elements.html">عناصر ساده فرم</a></li>
                <li class="nav-item"><a class="nav-link" href="pages/forms/advanced_elements.html">عناصر پیشرفته فرم</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="pages/forms/validation.html">اعتبار سنجی فرم</a></li>
                <li class="nav-item"><a class="nav-link" href="pages/forms/wizard.html">فرم چند مرحله ای</a></li>
                <li class="nav-item"><a class="nav-link" href="pages/forms/dropify.html">بارگذاری فایل dropify</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#editors" aria-expanded="false" aria-controls="editors">
              <i class="fas fa-pen-square menu-icon"></i>
              <span class="menu-title">ویرایشگر ها</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="editors">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="pages/forms/ckeditor.html">ویرایشگر متن CkEditor</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="pages/forms/tinymce.html">ویرایشگر متن TinyEMC</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="pages/forms/summernote.html">ویرایشگر متن SummerNote</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="pages/forms/code_editor.html">ویرایشگر کد</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
              <i class="fas fa-chart-pie menu-icon"></i>
              <span class="menu-title">نمودار ها</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="charts">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/charts/chartjs.html">نمودار ChartJs</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/charts/morris.html">نمودار Morris</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/charts/flot-chart.html">نمودار Float</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/charts/sparkline.html">نمودار Sparkline js</a>
                </li>
                <li class="nav-item"> <a class="nav-link" href="pages/charts/c3.html">نمودار C3 charts</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/charts/chartist.html">نمودار Chartists</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/charts/justGage.html">نمودار JustGage</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
              <i class="fas fa-table menu-icon"></i>
              <span class="menu-title">جداول</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="tables">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/tables/basic-table.html">جدول پایه</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/tables/data-table.html">جدول داده</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/tables/js-grid.html">جدول Js-grid</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/tables/sortable-table.html">جدول با قابلیت مرتب
                    شدن</a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/ui-features/popups.html">
              <i class="fas fa-minus-square menu-icon"></i>
              <span class="menu-title">پنجره های پاپ آپ</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/ui-features/notifications.html">
              <i class="fas fa-bell menu-icon"></i>
              <span class="menu-title">اعلان ها</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
              <i class="fa fa-stop-circle menu-icon"></i>
              <span class="menu-title">آیکون ها</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="icons">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/icons/flag-icons.html">آیکون پرچم ها</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/icons/font-awesome.html">فونت آوسوم</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/icons/simple-line-icon.html">آیکون های Simple
                    line</a>
                </li>
                <li class="nav-item"> <a class="nav-link" href="pages/icons/themify.html">آیکون های Themify</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#maps" aria-expanded="false" aria-controls="maps">
              <i class="fas fa-map-marker-alt menu-icon"></i>
              <span class="menu-title">نقشه ها</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="maps">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/maps/mapeal.html">نقشه Mapeal</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/maps/vector-map.html">نقشه برداری</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/maps/google-maps.html">نقشه گوگل</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
              <i class="fas fa-window-restore menu-icon"></i>
              <span class="menu-title">صفحات کاربر</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> ورود </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/login-2.html"> ورود 2 </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> ثبت نام </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/register-2.html"> ثبت نام 2 </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/lock-screen.html"> صفحه قفل </a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#error" aria-expanded="false" aria-controls="error">
              <i class="fas fa-exclamation-circle menu-icon"></i>
              <span class="menu-title">صفحات خطا</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="error">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/samples/error-403.html"> 403 </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/error-404.html"> 404 </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html"> 500 </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/error-503.html"> 503 </a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#general-pages" aria-expanded="false"
              aria-controls="general-pages">
              <i class="fas fa-file menu-icon"></i>
              <span class="menu-title">صفحات عمومی</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="general-pages">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/samples/blank-page.html"> صفحه خالی </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/profile.html"> پروفایل </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/faq.html"> سوالات متداول </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/faq-2.html"> سوالات متداول 2 </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/news-grid.html"> اخبار </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/timeline.html"> تایم لاین </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/search-results.html"> نتایج جستجو </a>
                </li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/portfolio.html"> نمونه کارها </a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#apps" aria-expanded="false" aria-controls="apps">
              <i class="fas fa-briefcase menu-icon"></i>
              <span class="menu-title">برنامه ها</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="apps">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/apps/email.html"> ایمیل </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/apps/calendar.html"> تقویم </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/apps/todo.html"> لیست انجام دادن </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/apps/gallery.html"> گالری حرفه ای </a></li>
              </ul>`
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#e-commerce" aria-expanded="false"
              aria-controls="e-commerce">
              <i class="fas fa-shopping-cart menu-icon"></i>
              <span class="menu-title">فروشگاه</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="e-commerce">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/samples/invoice.html"> فاکتور </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/pricing-table.html"> جدول فروش </a>
                </li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/orders.html"> سفارشات </a></li>
              </ul>
            </div>
          </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              داشبورد
            </h3>
          </div>
          <div class="row grid-margin">
            <div class="col-12">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                    <div class="statistics-item">
                      <p>
                        <i class="icon-sm fa fa-user ml-2"></i>
                        کاربران جدید
                      </p>
                      <h2>54000</h2>
                      <label class="badge badge-outline-success badge-pill">2.7% افزایش</label>
                    </div>
                    <div class="statistics-item">
                      <p>
                        <i class="icon-sm fas fa-hourglass-half ml-2"></i>
                        میانگین زمانی
                      </p>
                      <h2>123.50</h2>
                      <label class="badge badge-outline-danger badge-pill">30% کاهش</label>
                    </div>
                    <div class="statistics-item">
                      <p>
                        <i class="icon-sm fas fa-cloud-download-alt ml-2"></i>
                        دانلود ها
                      </p>
                      <h2>3500</h2>
                      <label class="badge badge-outline-success badge-pill">12% افزایش</label>
                    </div>
                    <div class="statistics-item">
                      <p>
                        <i class="icon-sm fas fa-check-circle ml-2"></i>
                        به روز رسانی
                      </p>
                      <h2>7500</h2>
                      <label class="badge badge-outline-success badge-pill">57% افزایش</label>
                    </div>
                    <div class="statistics-item">
                      <p>
                        <i class="icon-sm fas fa-chart-line ml-2"></i>
                        فروش
                      </p>
                      <h2>9000</h2>
                      <label class="badge badge-outline-success badge-pill">10% افزایش</label>
                    </div>
                    <div class="statistics-item">
                      <p>
                        <i class="icon-sm fas fa-circle-notch ml-2"></i>
                        در انتظار پرداخت
                      </p>
                      <h2>7500</h2>
                      <label class="badge badge-outline-danger badge-pill">16% کاهش</label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">
                    <i class="fas fa-gift"></i>
                    سفارشات
                  </h4>
                  <canvas id="orders-chart"></canvas>
                  <div id="orders-chart-legend" class="orders-chart-legend"></div>
                </div>
              </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">
                    <i class="fas fa-chart-line"></i>
                    فروش
                  </h4>
                  <h2 class="mb-5">56000 <span class="text-muted h4 font-weight-normal">فروش</span></h2>
                  <canvas id="sales-chart"></canvas>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4 grid-margin stretch-card">
              <div class="card">
                <div class="card-body d-flex flex-column">
                  <h4 class="card-title">
                    <i class="fas fa-chart-pie"></i>
                    وضعیت فروش
                  </h4>
                  <div class="flex-grow-1 d-flex flex-column justify-content-between">
                    <canvas id="sales-status-chart" class="mt-3"></canvas>
                    <div class="pt-4">
                      <div id="sales-status-chart-legend" class="sales-status-chart-legend"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">
                    <i class="far fa-futbol"></i>
                    فعالیت
                  </h4>
                  <ul class="solid-bullet-list">
                    <li>
                      <h5>۴ نفر این پست را به اشتراک گذاشتند
                        <span class="float-left text-muted font-weight-normal small">8:30 AM</span>
                      </h5>
                      <p class="text-muted">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم!</p>
                      <div class="image-layers">
                        <div class="img-sm profile-image-text bg-warning rounded-circle image-layer-item">M</div>
                        <img class="img-sm rounded-circle image-layer-item" src="{{env('APP_URL')}}/build/melody/images/faces/face3.jpg"
                          alt="profile" />
                        <img class="img-sm rounded-circle image-layer-item" src="{{env('APP_URL')}}/build/melody/images/faces/face5.jpg"
                          alt="profile" />
                        <img class="img-sm rounded-circle image-layer-item" src="{{env('APP_URL')}}/build/melody/images/faces/face8.jpg"
                          alt="profile" />
                      </div>
                    </li>
                    <li>
                      <h5>نسترن پستی ارسال کرد
                        <span class="float-left text-muted font-weight-normal small">11:40 AM</span>
                      </h5>
                      <p class="text-muted">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم!</p>
                    </li>
                    <li>
                      <h5>مرتضی پستی ارسال کرد
                        <span class="float-left text-muted font-weight-normal small">4:30 PM</span>
                      </h5>
                      <p class="text-muted">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم!</p>
                    </li>
                  </ul>
                  <div class="border-top pt-3">
                    <div class="d-flex justify-content-between">
                      <button class="btn btn-outline-dark">بیشتر</button>
                      <button class="btn btn-primary btn-icon-text">
                        افزودن
                        <i class="btn-icon-append fas fa-plus mr-2 ml-0"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4 grid-margin stretch-card">
              <div class="card">
                <div class="card-body d-flex flex-column">
                  <h4 class="card-title">
                    <i class="fas fa-tachometer-alt"></i>
                    فروش روزانه
                  </h4>
                  <p class="card-description">میزان فروش روزانه در یک ماه اخیر</p>
                  <div class="flex-grow-1 d-flex flex-column justify-content-between">
                    <canvas id="daily-sales-chart" class="mt-3 mb-3 mb-md-0"></canvas>
                    <div id="daily-sales-chart-legend" class="daily-sales-chart-legend pt-4 border-top"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">
                    <i class="fas fa-envelope"></i>
                    صندوق دریافت (31)
                  </h4>
                  <div class="table-responsive">
                    <table class="table">
                      <tbody>
                        <tr>
                          <td>
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input">
                              </label>
                            </div>
                          </td>
                          <td class="py-1">
                            <img src="{{env('APP_URL')}}/build/melody/images/faces/face13.jpg" alt="profile" class="img-sm rounded-circle" />
                          </td>
                          <td class="font-weight-bold">
                            مرتضی محمد
                          </td>
                          <td>
                            <label class="badge badge-light badge-pill">برنامه نویس</label>
                          </td>
                          <td>
                            لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم!
                          </td>
                          <td>
                            <i class="fas fa-ellipsis-v"></i>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input">
                              </label>
                            </div>
                          </td>
                          <td class="py-1">
                            <img src="{{env('APP_URL')}}/build/melody/images/faces/face2.jpg" alt="profile" class="img-sm rounded-circle" />
                          </td>
                          <td class="font-weight-bold">
                            نسترن افشار
                          </td>
                          <td>
                            <label class="badge badge-light badge-pill">برنامه نویس</label>
                          </td>
                          <td>
                            لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم
                          </td>
                          <td>
                            <i class="fas fa-ellipsis-v"></i>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input">
                              </label>
                            </div>
                          </td>
                          <td class="py-1">
                            <div class="img-sm rounded-circle bg-warning profile-image-text">ز</div>
                          </td>
                          <td class="font-weight-bold">
                            زهرا رسولی
                          </td>
                          <td>
                            <label class="badge badge-light badge-pill">حسابدار</label>
                          </td>
                          <td>
                            لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم
                          </td>
                          <td>
                            <i class="fas fa-ellipsis-v"></i>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input">
                              </label>
                            </div>
                          </td>
                          <td class="py-1">
                            <img src="{{env('APP_URL')}}/build/melody/images/faces/face11.html" alt="profile" class="img-sm rounded-circle" />
                          </td>
                          <td class="font-weight-bold">
                            رضا کریمی
                          </td>
                          <td>
                            <label class="badge badge-light badge-pill">برنامه نویس</label>
                          </td>
                          <td>
                            لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم
                          </td>
                          <td>
                            <i class="fas fa-ellipsis-v"></i>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input">
                              </label>
                            </div>
                          </td>
                          <td class="py-1">
                            <div class="img-sm rounded-circle bg-info profile-image-text">ن</div>
                          </td>
                          <td class="font-weight-bold">
                            نیلوفر ستوده
                          </td>
                          <td>
                            <label class="badge badge-light badge-pill">طراح سایت</label>
                          </td>
                          <td>
                            لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم
                          </td>
                          <td>
                            <i class="fas fa-ellipsis-v"></i>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-8 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">
                    <i class="fas fa-table"></i>
                    اطلاعات فروش
                  </h4>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>مشتری</th>
                          <th>کد محصول</th>
                          <th>تعداد سفارش</th>
                          <th>وضعیت</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="font-weight-bold">
                            مرتضی کریمی
                          </td>
                          <td class="text-muted">
                            PT613
                          </td>
                          <td>
                            350
                          </td>
                          <td>
                            <label class="badge badge-success badge-pill">ارسال شده</label>
                          </td>
                        </tr>
                        <tr>
                          <td class="font-weight-bold">
                            نرگس کاشف
                          </td>
                          <td class="text-muted">
                            ST456
                          </td>
                          <td>
                            520
                          </td>
                          <td>
                            <label class="badge badge-warning badge-pill">در حال پردازش</label>
                          </td>
                        </tr>
                        <tr>
                          <td class="font-weight-bold">
                            اکبر رضایی
                          </td>
                          <td class="text-muted">
                            CS789
                          </td>
                          <td>
                            830
                          </td>
                          <td>
                            <label class="badge badge-danger badge-pill">نا موفق</label>
                          </td>
                        </tr>
                        <tr>
                          <td class="font-weight-bold">
                            نیلوفر افشار
                          </td>
                          <td class="text-muted">
                            LP908
                          </td>
                          <td>
                            579
                          </td>
                          <td>
                            <label class="badge badge-primary badge-pill">تحویل داده شده</label>
                          </td>
                        </tr>
                        <tr>
                          <td class="font-weight-bold">
                            سوسن کاشفی
                          </td>
                          <td class="text-muted">
                            HF675
                          </td>
                          <td>
                            790
                          </td>
                          <td>
                            <label class="badge badge-info badge-pill">در حال ارسال</label>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">تقویم</h4>
                  <div id="taghvim" class="datepicker mt-5"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-7 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">
                    <i class="fas fa-thumbtack"></i>
                    لیست انجام کارها
                  </h4>
                  <div class="add-items d-flex">
                    <input type="text" class="form-control todo-list-input"
                      placeholder="امروز چه کاری میخواهید انجام دهید؟">
                    <button class="add btn btn-primary font-weight-bold todo-list-add-btn" id="add-task">افزودن</button>
                  </div>
                  <div class="list-wrapper">
                    <ul class="d-flex flex-column-reverse todo-list">
                      <li>
                        <div class="form-check">
                          <label class="form-check-label">
                            <input class="checkbox" type="checkbox">
                            جلسه
                          </label>
                        </div>
                        <i class="remove fa fa-times-circle"></i>
                      </li>
                      <li class="completed">
                        <div class="form-check">
                          <label class="form-check-label">
                            <input class="checkbox" type="checkbox" checked>
                            کنفرانس تلفنی
                          </label>
                        </div>
                        <i class="remove fa fa-times-circle"></i>
                      </li>
                      <li>
                        <div class="form-check">
                          <label class="form-check-label">
                            <input class="checkbox" type="checkbox">
                            ارسال محصولات
                          </label>
                        </div>
                        <i class="remove fa fa-times-circle"></i>
                      </li>
                      <li>
                        <div class="form-check">
                          <label class="form-check-label">
                            <input class="checkbox" type="checkbox">
                            خرید منزل
                          </label>
                        </div>
                        <i class="remove fa fa-times-circle"></i>
                      </li>
                      <li class="completed">
                        <div class="form-check">
                          <label class="form-check-label">
                            <input class="checkbox" type="checkbox" checked>
                            آماده کردن متن جلسه
                          </label>
                        </div>
                        <i class="remove fa fa-times-circle"></i>
                      </li>
                      <li>
                        <div class="form-check">
                          <label class="form-check-label">
                            <input class="checkbox" type="checkbox">
                            بردن بچه ها به مدرسه
                          </label>
                        </div>
                        <i class="remove fa fa-times-circle"></i>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-5 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">
                    <i class="fas fa-rocket"></i>
                    پروژه ها
                  </h4>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>
                            مسئول پروژه
                          </th>
                          <th>
                            نام پروژه
                          </th>
                          <th>
                            اولویت
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="py-1">
                            <img src="{{env('APP_URL')}}/build/melody/images/faces/face1.jpg" alt="profile" class="img-sm rounded-circle" />
                          </td>
                          <td>
                            پروژه 1
                          </td>
                          <td>
                            <label class="badge badge-warning badge-pill">متوسط</label>
                          </td>
                        </tr>
                        <tr>
                          <td class="py-1">
                            <img src="{{env('APP_URL')}}/build/melody/images/faces/face2.jpg" alt="profile" class="img-sm rounded-circle" />
                          </td>
                          <td>
                            پروژه 2
                          </td>
                          <td>
                            <label class="badge badge-danger badge-pill">زیاد</label>
                          </td>
                        </tr>
                        <tr>
                          <td class="py-1">
                            <img src="{{env('APP_URL')}}/build/melody/images/faces/face3.jpg" alt="profile" class="img-sm rounded-circle" />
                          </td>
                          <td>
                            پروژه 3
                          </td>
                          <td>
                            <label class="badge badge-success badge-pill">کم</label>
                          </td>
                        </tr>
                        <tr>
                          <td class="py-1">
                            <img src="{{env('APP_URL')}}/build/melody/images/faces/face4.jpg" alt="profile" class="img-sm rounded-circle" />
                          </td>
                          <td>
                            پروژه 4
                          </td>
                          <td>
                            <label class="badge badge-warning badge-pill">متوسط</label>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <div class="d-md-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center mb-3 mb-md-0">
                      <button class="btn btn-social-icon btn-facebook btn-rounded">
                        <i class="fab fa-facebook-f"></i>
                      </button>
                      <div class="mr-3 mt-2">
                        <h5 class="mb-0">فیسبوک</h5>
                        <p class="mb-0">813 دوست</p>
                      </div>
                    </div>
                    <div class="d-flex align-items-center mb-3 mb-md-0">
                      <button class="btn btn-social-icon btn-twitter btn-rounded">
                        <i class="fab fa-twitter"></i>
                      </button>
                      <div class="mr-3 mt-2">
                        <h5 class="mb-0">توییتر</h5>
                        <p class="mb-0">9000 دنبال کننده</p>
                      </div>
                    </div>
                    <div class="d-flex align-items-center mb-3 mb-md-0">
                      <button class="btn btn-social-icon btn-google btn-rounded">
                        <i class="fab fa-google-plus-g"></i>
                      </button>
                      <div class="mr-3 mt-2">
                        <h5 class="mb-0">گوگل پلاس</h5>
                        <p class="mb-0">780 دوست</p>
                      </div>
                    </div>
                    <div class="d-flex align-items-center">
                      <button class="btn btn-social-icon btn-linkedin btn-rounded">
                        <i class="fab fa-linkedin-in"></i>
                      </button>
                      <div class="mr-3 mt-2">
                        <h5 class="mb-0">لینکدین</h5>
                        <p class="mb-0">1090 اتصال</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2018 . تمام حقوق
              محفوظ است.</span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
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
  <script src="{{env('APP_URL')}}/build/melody/js/chosen/chosen.jquery.min.js"></script>
  <script src="{{env('APP_URL')}}/build/melody/js/moment/min/moment.min.js"></script>
  <script src="{{env('APP_URL')}}/build/melody/js/persian-date-0.1.8.min.js"></script>
  <script src="{{env('APP_URL')}}/build/melody/js/persian-datepicker-0.4.5.min.js"></script>
  <!-- End custom js for this page-->

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