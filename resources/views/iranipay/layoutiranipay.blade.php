 
<html> 
    @yield('title')
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="description" content="{{$mngindex->ind_cont}}">
    <meta name="keywords" content="{{$mngindex->ind_key}}">
    <!-- awesone fonts css-->
    <link href="{{env('APP_URL')}}/build/solution/fonts/custom.css" rel="stylesheet" type="text/css">
    <link href="{{env('APP_URL')}}/build/solution/css/font-awesome.css" rel="stylesheet" type="text/css">
    <!-- owl carousel css-->
    <link rel="stylesheet" href="{{env('APP_URL')}}/build/solution/owl-carousel/assets/owl.carousel.min.css" type="text/css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{env('APP_URL')}}/build/solution/css/bootstrap.min.css">
    <!-- custom CSS -->
    <link rel="stylesheet" href="{{env('APP_URL')}}/build/solution/css/style.css">
 
    <style>

    </style>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light bg-transparent" id="gtco-main-nav" > 
    <div class="container"><a class="navbar-brand"><img width="170" height="170" src="{{env('APP_URL')}}/public/images/{{$mngindex->ind_himglog}}" /></a>
        <button class="navbar-toggler" data-target="#my-nav" onclick="myFunction(this)" data-toggle="collapse"><span
                class="bar1"></span> <span class="bar2"></span> <span class="bar3"></span></button>
        <div id="my-nav" class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto"   dir="rtl" align="right" >
                <li class="nav-item"><a class="nav-link" href="{{env('APP_URL')}}/">خانه</a></li>
                <li class="nav-item"><a class="nav-link" href="#services">سرویسها</a></li>
                <li class="nav-item"><a class="nav-link" href="#about">درباره ما</a></li>
@if($mngindex->ind_hnew=='1') <li class="nav-item"><a class="nav-link" href="#news">اخبار</a></li>  @endif
                <li class="nav-item"><a class="nav-link" href="#contact">تماس با ما</a></li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
            <style>
            	.img-circle {
    border-radius: 70%;
}
            </style>
 @if(Session::has('signuser'))
            
 <a href="{{env('APP_URL')}}/user/panel" class="btn btn-outline-dark my-2 my-sm-0 mr-3 text-uppercase"  target="_blank"> {{ Session::get('fullname')}}</a>
 <img width="55" height="55"  class="img-circle" alt="" src="{{env('APP_URL')}}/public/images/{{ Session::get('usimg')}}">  
            @else
 @if($mngindex->ind_hlogus=='1')
 <a href="{{env('APP_URL')}}/user" class="btn btn-outline-dark my-2 my-sm-0 mr-3 text-uppercase">ورود</a> 
 @endif
@if($mngindex->ind_hregus=='1')
 <a href="{{env('APP_URL')}}/user/registeruser" class="btn btn-info my-2 my-sm-0 text-uppercase">ثبت نام</a>
 
 @endif
 @endif
            </form>
        </div>
    </div>
</nav>

  
  
 
@yield('superadmin')



 <br><br><br><br><hr><br>
<footer class="container-fluid" id="gtco-footer">
    <div class="container">
        <div class="row"   dir="rtl" align="right" >
            <div class="col-lg-6" id="contact">
                <h4> تماس با ما </h4>
  <!-- <label for="inputPassword" class="col-sm-2 col-form-label text-danger">Password</label> -->
 
                <input type="text" class="form-control" placeholder="نام و نام خانوادگی">
                <input type="email" class="form-control" placeholder="ایمیل">
                <textarea class="form-control" placeholder="متن پیام"></textarea>
                <button class="submit-button"> ثبت </button> 
 
                
            </div>
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-6">
                        <h4>شرکت</h4>
                        <ul class="nav flex-column company-nav">
                            <li class="nav-item"><a class="nav-link" href="#">خانه</a></li>

@if($mngindex->ind_flogus=='1')
 <li class="nav-item"><a class="nav-link" href="{{env('APP_URL')}}/user" target="_blank">ورود</a></li>
@endif
@if($mngindex->ind_fregus=='1')
 <li class="nav-item"><a class="nav-link" href="{{env('APP_URL')}}/user/registeruser" target="_blank">عضویت</a></li>
@endif
                            
                            <li class="nav-item"><a class="nav-link" href="{{env('APP_URL')}}/#services">سرویسها</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{env('APP_URL')}}/#about">درباره ما</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{env('APP_URL')}}/#news">اخبار</a></li> 
                            <li class="nav-item"><a class="nav-link" href="{{env('APP_URL')}}/#contact">تماس با ما</a></li>
                        </ul>
                        
@if($socials)
                        <h6 class="mt-5">ما را در شبکه های اجتماعی دنبال کنید</h6>
                        <ul class="nav follow-us-nav">
 @foreach($socials as $social)
 <li class="nav-item"><a class="nav-link pl-0" href="{{$social->social_name}}"><span class="label"><img  src="{{env('APP_URL')}}/public/images/{{$social->social_icon}}" class="img-circle" width="32"  height="32"   alt="" title=""></span></a></li>
@endforeach                                                                                    
                                                                                       
                        </ul>
                        
                        @endif
                        
                    </div>
                    <div class="col-6">
                        <h4>سرویسها</h4>
                        <ul class="nav flex-column services-nav">
                        
            @foreach($pages as $page)
                            <li class="nav-item"><a class="nav-link" href="{{env('APP_URL')}}/service/{{$page->id}}">{{$page->page_tit}}</a></li>  
            @endforeach
                        </ul>
                    </div>
                    <div class="col-12">
                        <p>&copy; {{$mngindex->ind_fcopy}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>


@yield('scriptfooter')
  


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="{{env('APP_URL')}}/build/solution/js/jquery-3.3.1.slim.min.js"></script>
<script src="{{env('APP_URL')}}/build/solution/js/popper.min.js"></script>
<script src="{{env('APP_URL')}}/build/solution/js/bootstrap.min.js"></script>
<!-- owl carousel js-->
<script src="{{env('APP_URL')}}/build/solution/owl-carousel/owl.carousel.min.js"></script>
<script src="{{env('APP_URL')}}/build/solution/js/main.js"></script>
</body>
</html>
      
        
        