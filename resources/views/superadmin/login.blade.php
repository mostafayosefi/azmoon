<!DOCTYPE html>
<html dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ورود مدیریت</title>
    <link rel="stylesheet" type="text/css" href="{{env('APP_URL')}}/build/templogin/css/farsi-font.css">
<link rel="stylesheet" type="text/css" href="{{env('APP_URL')}}/build/templogin/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="{{env('APP_URL')}}/build/templogin/css/fontawesome-all.min.css">
    <link rel="stylesheet" type="text/css" href="{{env('APP_URL')}}/build/templogin/css/iofrm-style.css">
    <link rel="stylesheet" type="text/css" href="{{env('APP_URL')}}/build/templogin/css/iofrm-theme3.css">
    <link rel="stylesheet" type="text/css" href="{{env('APP_URL')}}/build/templogin/css/custom.css">
    
</head>
<body>
    <div class="form-body" class="container-fluid">
        <div class="website-logo">
            <a href="">
                <div class="logo">
                    <img class="logo-size" src="{{env('APP_URL')}}/build/templogin/images/logo-light.svg" alt="">
                </div>
            </a>
        </div>
        <div class="row">
            <div class="img-holder">
                <div class="bg"></div>
                <div class="info-holder">

                </div>
            </div>
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <h3>انجام کلیه پرداخت های بین المللی </h3>
                        <p> ورود مدیریت </p>
                        <div class="page-links">
                            <a href="{{env('APP_URL')}}/superadmin/sign-in" class="active">ورود</a> 
                        </div>

<form method="POST" action="{{env('APP_URL')}}/superadmin/sign-in" autocomplete="off"> 



      @if(!empty(Session::get('statust')))
      <div class="alert alert-danger">
				<strong>اخطار!</strong>
				<ul><li>{{ Session::get('statust')}}</li></ul>
				</div>
        @endif
      
      
	@if(count($errors))
			<div class="alert alert-danger" >
				<strong>اخطار!</strong> لطفا اطلاعات را به درستی وارد نمایید.
				<br/>
				<ul>
					@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif

 
<input class="form-control" type="text" name="firstname" placeholder="نام کاربری"  value="{{old('firstname')}}" >
<input class="form-control" type="password" name="lastname" placeholder="رمز عبور" value="{{old('lastname')}}"  >
                            
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-button">
                                <button id="submit" type="submit" class="ibtn">ورود</button>
                            </div>
                        </form>
         
                    </div>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript" src="{{env('APP_URL')}}/build/templogin/js/jquery.min.js"></script>
<script type="text/javascript" src="{{env('APP_URL')}}/build/templogin/js/popper.min.js"></script>
<script type="text/javascript" src="{{env('APP_URL')}}/build/templogin/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{env('APP_URL')}}/build/templogin/js/main.js"></script>
</body>
</html>
