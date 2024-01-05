<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from www.example.com/melody/template/pages/samples/login-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 15 Sep 2018 06:08:53 GMT -->

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>  ورود مدیریت </title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{env('APP_URL')}}/build/melody/vendors/iconfonts/font-awesome/css/all.min.css">
  <link rel="stylesheet" href="{{env('APP_URL')}}/build/melody/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="{{env('APP_URL')}}/build/melody/vendors/css/vendor.bundle.addons.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{env('APP_URL')}}/build/melody/css/style.css">
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
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
        <div class="row flex-grow">
          <div class="col-lg-6 d-flex align-items-center justify-content-center">
            <div class="auth-form-transparent text-left p-3">
              <a href="#">
                <div class="brand-logo d-flex justify-content-center">
                  <img  src="{{env('APP_URL')}}/public/images/{{Session::get('ind_himglog')}}" alt="logo">
                </div>
              </a>
              <h4>ورود مدیریت</h4>
              <form class="pt-3"  method="POST" action="{{env('APP_URL')}}/superadmin/sign-in" autocomplete="off">
              
              
              
      @if(!empty(Session::get('statust')))
 
 <div class="breadcrumb bg-inverse-danger" >
<span  style="color: #000000"  >{{ Session::get('statust')}}</span>  
</div> 
        @endif
      
      
				
@if(count($errors))
 

@foreach($errors->all() as $error)
<div class="breadcrumb bg-inverse-danger" >
<span  style="color: #000000"  >{{$error}}</span>  
</div> 
@endforeach
 
@endif  
		
 
		

              
                <div class="form-group">
                  <label for="exampleInputEmail">نام کاربری</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-left-0">
                        <i class="fa fa-user text-primary"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control form-control-lg border-right-0"  name="firstname" placeholder="نام کاربری"  value="{{old('firstname')}}">
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword">رمز عبور</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-left-0">
                        <i class="fa fa-lock text-primary"></i>
                      </span>
                    </div>
                    <input type="password" class="form-control form-control-lg border-right-0"  name="lastname" placeholder="رمز عبور" value="{{old('lastname')}}" >
                  </div>
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      مرا به خاطر بسپار
                    </label>
                  </div>
                  <a href="#" class="auth-link text-black">رمز عبور خود را فراموش کرده اید ؟</a>
                </div>
                
                
    <input type="hidden" name="dateshamsi" value="{{jDate::forge()->format('Y/m/d')}}">
    
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                
                <div class="my-3">
                
                                <button id="submit" type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">ورود</button>
     
                </div>
 <!--
                <div class="text-center mt-4 font-weight-light">
                  حساب کاربری نداری ؟ <a href="register-2.html" class="text-primary">ثبت نام</a>
                </div>
                
                -->
              </form>
            </div>
          </div>
          <div class="col-lg-6 login-half-bg d-flex flex-row">
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="{{env('APP_URL')}}/build/melody/vendors/js/vendor.bundle.base.js"></script>
  <script src="{{env('APP_URL')}}/build/melody/vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="{{env('APP_URL')}}/build/melody/js/off-canvas.js"></script>
  <script src="{{env('APP_URL')}}/build/melody/js/hoverable-collapse.js"></script>
  <script src="{{env('APP_URL')}}/build/melody/js/misc.js"></script>
  <script src="{{env('APP_URL')}}/build/melody/js/settings.js"></script>
  <script src="{{env('APP_URL')}}/build/melody/js/todolist.js"></script>
  <!-- endinject -->
</body>


<!-- Mirrored from www.example.com/melody/template/pages/samples/login-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 15 Sep 2018 06:08:53 GMT -->

</html>