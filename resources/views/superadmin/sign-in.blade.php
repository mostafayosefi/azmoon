<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 
    <meta charset="UTF-8">

@yield('title')

<!DOCTYPE html>
<!-- saved from url=(0049)http://www.g-axon.com/mouldifi-5.0/rtl/index.html -->


<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Mouldifi - A fully responsive, HTML5 based admin theme">
<meta name="keywords" content="Responsive, HTML5, admin theme, business, professional, Mouldifi, web design, CSS3">
 
<!-- /site favicon -->

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

<!-- Bootstrap RTL stylesheet min version -->
<link href="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/bootstrap-rtl.min.css" rel="stylesheet">
<!-- /bootstrap rtl stylesheet min version -->

<!-- Mouldifi RTL core stylesheet -->
<link href="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/mouldifi-rtl-core.css" rel="stylesheet">


    <link rel="stylesheet" href="{{env('APP_URL')}}/build/servicepay/fonts/fonts-fa.css">

<!-- /mouldifi rtl core stylesheet -->

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
<body class="login-page">
	<div class="login-pag-inner"  >
		<div class="animatedParent animateOnce z-index-50">
			<div class="login-container animated growIn slower">
				<div class="login-branding">
					<a href="#"><img width="280"  height="48"  src="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/logo.png" alt="Mouldifi" title="Mouldifi"></a>
				</div>
				<div class="login-content">
					<center><h2><strong>ورود مدیر</strong> </h2></center>



      
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



<form method="POST" action="{{env('APP_URL')}}/superadmin/sign-in" autocomplete="off">                    


          <div class="form-group has-feedback {{ $errors->has('firstname') ? 'has-error' : '' }}">
            <input type="text"  id="firstname" name="firstname" class="form-control" placeholder="نام کاربری"  value="{{ old('firstname') }}">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback {{ $errors->has('lastname') ? 'has-error' : '' }}">
            <input type="password" id="lastname" name="lastname" class="form-control" placeholder="رمزعبور" value="{{ old('lastname') }}">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          
          
						<div class="form-group">
							 <div class="checkbox checkbox-replace">
								<input type="checkbox" id="remeber">
								<label for="remeber">مرا بخاطر بسپار</label>
							  </div>
						 </div>
						<div class="form-group">
							<button class="btn btn-primary btn-block">ورود</button>
						</div>
						<p class="text-center"><a href="forgot-password.html"> فراموشی رمزعبور؟</a></p>                        
					</form>
				</div>
			</div>
		</div>
	</div>
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

</body>
</html>
