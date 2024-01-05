<!DOCTYPE html>
<html dir="rtl">
<head>

 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ثبت نام کاربر</title>
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

            <a href="{{env('APP_URL')}}/user">
                 <img  src="{{env('APP_URL')}}/public/images/{{Session::get('ind_himglog')}}"  style="width: 200px;  height:60px" alt="logo">
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
                        <p>جهت ورود اقدام نمایید. </p>
                        
                        
                        
         <div class="page-links">
        <a href="{{env('APP_URL')}}/user/sign-in">ورود</a>
        <a href="{{env('APP_URL')}}/user/registeruser"  class="active">عضویت</a>
        <a href="{{env('APP_URL')}}/user/forgetpas"> فراموشی رمزعبور</a>

                        </div>

 
                  <form method="POST" action="{{env('APP_URL')}}/user/registeruser_pas" autocomplete="off">

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

 
 
      
        <div class="form-group">
            <label for="name">  نام و نام خانوادگی </label><i class="rq">*</i><br />
            <div class="input-group {{ $errors->has('name') ? 'has-error' : '' }}" >
                <div class="input-group-addon"><i class="fa fa-mail"></i></div>
                <input class="form-control" type="text" name="name" placeholder="نام و نام خانوادگی" value="{{old('name')}}" > 
            </div>
        </div>

        <div class="form-group">
            <label for="tell"> شماره همراه </label><i class="rq">*</i><br />
            <div class="input-group {{ $errors->has('tell') ? 'has-error' : '' }}" >
                <div class="input-group-addon"><i class="fa fa-mail"></i></div>
                <input class="form-control" type="text" name="tell" placeholder="09" value="{{old('tell')}}" > 
            </div>
        </div>
      
        <div class="form-group">
            <label for="email">   ایمیل </label><i class="rq">*</i><br />
            <div class="input-group {{ $errors->has('email') ? 'has-error' : '' }}" >
                <div class="input-group-addon"><i class="fa fa-mail"></i></div>
                <input class="form-control" type="email" name="email" placeholder="ایمیل"  value="{{old('email')}}"   >
            </div>
        </div>

        
        <div class="form-group">
            <label for="userpassword">  رمزعبور </label><i class="rq">*</i><br />
            <div class="input-group {{ $errors->has('userpassword') ? 'has-error' : '' }}" >
                <div class="input-group-addon"><i class="fa fa-mail"></i></div>
                <input class="form-control" type="password" name="userpassword"   value=""   > 
            </div>
        </div>
        
        <div class="form-group">
            <label for="userpassword">   تکرار رمزعبور </label><i class="rq">*</i><br />
            <div class="input-group {{ $errors->has('userpassword') ? 'has-error' : '' }}" >
                <div class="input-group-addon"><i class="fa fa-mail"></i></div>
                <input class="form-control" type="password" name="userpassword_confirmation"  placeholder="تکرار رمزعبور"  value=""    > 
            </div>
        </div>
      






 
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-button">
                                <button id="submit" type="submit" class="ibtn">عضویت</button>
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
