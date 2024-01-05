<!DOCTYPE html>
<html dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ورود کاربر</title>
    <link rel="stylesheet" type="text/css" href="{{env('APP_URL')}}/build/templogin/css/farsi-font.css">
<link rel="stylesheet" type="text/css" href="{{env('APP_URL')}}/build/templogin/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="{{env('APP_URL')}}/build/templogin/css/fontawesome-all.min.css">
    <link rel="stylesheet" type="text/css" href="{{env('APP_URL')}}/build/templogin/css/iofrm-style.css">
    <link rel="stylesheet" type="text/css" href="{{env('APP_URL')}}/build/templogin/css/iofrm-theme3.css">
    <link rel="stylesheet" type="text/css" href="{{env('APP_URL')}}/build/templogin/css/custom.css">
    
</head>
<body>
    <div class="form-body" class="container-fluid">
        <div class="website-logo" style="width: 300px;  height:300px">
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
                            <a href="{{env('APP_URL')}}/user/sign-in" class="active">ورود</a><a href="{{env('APP_URL')}}/user/registeruser">عضویت</a>
                        </div>

<form method="POST" action="{{env('APP_URL')}}/user/verfylogin" autocomplete="off"> 



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

 <?php 
$now = strtotime("now") ;  ?>
 <?php
date_default_timezone_set('Asia/Tehran'); 
 
$noww        = time();
$date       = "2010";
$dater      = $now ;
$exp_date   = $admins->user_timeverfy+'60'; 
?>
 

<script type="text/javascript">
// Count down milliseconds = server_end - server_now = client_end - client_now
var server_end = <?php echo $exp_date; ?> * 1000;
var server_now = <?php echo $dater; ?> * 1000;
var client_now = new Date().getTime();
var end = server_end - server_now + client_now; // this is the real end time

var _second = 1000; 
var timer;

function showRemaining()
{
    var now = new Date();
    var distance = end - now;
    if (distance < 0 ) {
  clearInterval( timer );
  document.getElementById('countdownn').innerHTML = 'زمان وارد کردن کد وریفای به پایان رسید!'+'<br>'+'<button  id=  type="submit" class="ibtn">ارسال کد فعالسازی</button>';
  document.getElementById('countdownb').innerHTML = ''; 
  document.getElementById("mySubmit").disabled = true;
  document.getElementById("vefdi").disabled = true;
       return;
    } 
    var seconds = Math.floor(  distance  / 1000 );
    
 
    var countdown = document.getElementById('countdown');
    countdown.innerHTML = '';
 

 if(seconds<10) {
 if(seconds!=0) { countdown.innerHTML += '0' + seconds+ ' ثانیه '+ ' (زمان باقیمانده تا منقضی شدن کد وریفای) '; }      
 else if(seconds==0) {
 clearInterval( timer );
 
 countdown.innerHTML += '';
 document.getElementById('countdownb').innerHTML = ''; 
 document.getElementById('countdownn').innerHTML = 'زمان وارد کردن کد وریفای به پایان رسید!'+'<br>'+'<button  id=  type="submit" class="ibtn">ارسال کد فعالسازی</button>';
 document.getElementById('countdown').innerHTML = '';  
 document.getElementById("mySubmit").disabled = true;
 document.getElementById("vefdi").disabled = true;
       return; 
    }  
    } else {
        countdown.innerHTML += seconds+ ' ثانیه '+ ' (زمان باقیمانده تا منقضی شدن کد وریفای) ';
        countdownb.innerHTML  =  'یک کد تایید به شماره موبایل ارسال شده است، لطفا کد را وارد نمایید.';
    }
}

timer = setInterval(showRemaining, 1000);
</script>


 <div class="form-group">
 <label for="tell"> شماره همراه </label> 
 <div class="input-group {{ $errors->has('tell') ? 'has-error' : '' }}" > 
 <input class="form-control ltr" data-val="true"  id="tell" name="tell" type="text" value="{{$tell}}"  disabled=""  />
 </div>
 </div>


 
 <div class="form-group">
 <label for="tell">کد اعتبارسنجی</label> 
 <div id="countdownb" style="color: #22e21d; size:12px; "></div>
 <div class="input-group {{ $errors->has('verfy') ? 'has-error' : '' }}" > 
 <input class="form-control ltr" data-val="true"  id="vefdi" name="verfy" type="text" value=""   />
 </div>
 </div>

                            
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-button">
                                <button  id="mySubmit" type="submit" class="ibtn">ورود</button>
                            </div>
                            
                        </form>
 
 
 <div class="form-button">
 <div id="countdown" style="  background-color: #efffea"   ></div>
 </div>
 
 <form action="{{env('APP_URL')}}/user/repeatverify" method="post">
 <div id="countdownn" style="color: #ff0000; background-color: #efffea "></div> 
          <input type="hidden" name="tell" value="{{$tell}}">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
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
