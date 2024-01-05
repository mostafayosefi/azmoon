@extends('iranipay.layoutiranipay')

@section('title')
<title>صفحه اصلی</title>
@stop
 
@section('superadmin')

<div class="container-fluid gtco-banner-area">
    <div class="container">
        <div class="row">
            <div class="col-md-6"  dir="rtl" align="right">
                <h1>چرا ایران پی؟</h1>
                <p> ایران پی
                 با فراهم آوردن تیمی از جوان های با انگیزه به دنبال دور زدن تحریم ها و ساده سازی انجام پرداخت های بین المللی است.

بیش از ۲۰ سرویس و ابزار مختلف در اختیار شما خواهد بود تا با دور زدن تحریم ها،‌کسب و کار خود را بین المللی کنید و ارز آوری کنید. کلیه خدمات ما در وبسایت ما آمده است. میتوانید کاتالوگ ما را دانلود کنید و یا درخواست مشاوره دهید تا بتوانیم به شما کمک کنیم.   </p>
                <a href="#">تماس با ما <i class="fa fa-angle-left" aria-hidden="true"></i></a></div>
            <div class="col-md-6">
                <div class="card"><img class="card-img-top img-fluid" src="{{env('APP_URL')}}/build/solution/images/banner-img.png" alt=""></div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid gtco-features-list" id="services" >
    <div class="container">
        <div class="row"   dir="rtl" align="right" >
     
            
            @foreach($pages as $page)
            
            <div class="media col-md-6 col-lg-4">
                <div class="oval mr-4"><img class="align-self-start" src="{{env('APP_URL')}}/public/images/{{$page->page_img}}" alt=""></div>
                <div class="media-body">
                    <a href="{{env('APP_URL')}}/service/{{$page->id}}"><h5 class="mb-0">{{$page->page_tit}}</h5></a> 
                    {{$page->page_kh}}
                </div>
            </div>
            
            @endforeach
            
            
        </div>
    </div>
</div>


<div class="container-fluid gtco-news" id="news">
    <div class="container"  >
        <h2>آخرین اخبار</h2>
        <div class="owl-carousel owl-carousel2 owl-theme" >
        
@foreach($news as $new)
            <div>
                <div class="card text-center"><a href="{{env('APP_URL')}}/new/{{$new->id}}"><img class="card-img-top" height="256" src="{{env('APP_URL')}}/public/images/{{$new->new_img}}" alt=""></a>
                    <div class="card-body text-left pr-0 pl-0">
                        <h5  dir="rtl" align="right" >{{$new->new_tit}} </h5>
                        <p class="card-text"  dir="rtl" align="right" >{{$new->new_kh}}</p>
                        <a href="{{env('APP_URL')}}/new/{{$new->id}}"> <i class="fa fa-angle-left" aria-hidden="true"></i>ادامه</a></div>
                </div>
            </div>
            @endforeach
            
             
        </div>
    </div>
</div>

<!--
<div class="container-fluid gtco-feature" id="services">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="cover">
                    <div class="card">
                        <svg
                                class="back-bg"
                                width="100%" viewBox="0 0 900 700" style="position:absolute; z-index: -1">
                            <defs>
                                <linearGradient id="PSgrad_01" x1="64.279%" x2="0%" y1="76.604%" y2="0%">
                                    <stop offset="0%" stop-color="rgb(1,230,248)" stop-opacity="1"/>
                                    <stop offset="100%" stop-color="rgb(29,62,222)" stop-opacity="1"/>
                                </linearGradient>
                            </defs>
                            <path fill-rule="evenodd" opacity="0.102" fill="url(#PSgrad_01)"
                                  d="M616.656,2.494 L89.351,98.948 C19.867,111.658 -16.508,176.639 7.408,240.130 L122.755,546.348 C141.761,596.806 203.597,623.407 259.843,609.597 L697.535,502.126 C748.221,489.680 783.967,441.432 777.751,392.742 L739.837,95.775 C732.096,35.145 677.715,-8.675 616.656,2.494 Z"/>
                        </svg>
                   

                        <svg width="100%" viewBox="0 0 700 500">
                            <clipPath id="clip-path">
                                <path d="M89.479,0.180 L512.635,25.932 C568.395,29.326 603.115,76.927 590.357,129.078 L528.827,380.603 C518.688,422.048 472.661,448.814 427.190,443.300 L73.350,400.391 C32.374,395.422 -0.267,360.907 -0.002,322.064 L1.609,85.154 C1.938,36.786 40.481,-2.801 89.479,0.180 Z"></path>
                            </clipPath>
                 
                            <image clip-path="url(#clip-path)" xlink:href="{{env('APP_URL')}}/build/solution/images/learn-img.jpg" width="100%"
                                   height="465" class="svg__image"></image>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="col-md-5"  dir="rtl" align="right">
                <h2> صدور ویزا کارت در ایران
</h2>
                <p> همان طور که گفته شد امکان اخذ ویزا کارت در ایران وجود ندارد. این شرایط به دلیل تحریم های اعمال شده بر بانک های ایران می باشند. به این معنا که ایرانیانی که اقامت دائمی در کشور های دیگر دارند، با این مشکل مواجه نیستند. اما داخل ایران چگونه ویزا کارت دریافت کنیم؟ اما خرید ویزا کارت در ایران ممکن است؟</p>
                
                <a href="#">بیشتر بدانید <i class="fa fa-angle-right" aria-hidden="true"></i></a></div>
        </div>
    </div>
</div>

-->

<div class="container-fluid gtco-features" id="about">
    <div class="container">
        <div class="row">
            <div class="col-lg-4"  dir="rtl" align="right">
                <h2> ایرانیان می‌توانند بدون ویزا به کدام کشورها سفر کنند؟
       </h2>
                <p>  براساس رتبه بندی موسسه‌ی هنلی ( Henley & Partners Holdings ) در تاریخ ۹ اکتبر ۲۰۱۸ (۱۷ مهر ۱۳۹۷)، پاسپورت ایران در رتبه ۹۸ قرار دارد و شهروندان ایرانی می‌توانند به ۴۳ کشور بدون ویزا یا با ویزای فرودگاهی سفر کنند. با توجه به اینکه پس از انتشار این اطلاعات، برخی از کشورها دوباره ویزا را برقرار کرده‌اند، لازم به توضیح است که صربستان و تانزانیا سفر بدون ویزای شهروندان ایرانی را لغو کرده‌اند و ایرانیان برای سفر به این دو کشور باید ویزا دریافت کنند. همچنین در فهرست این ۴۳ کشور، نام سوریه نیز دیده می‌شود که با توجه به شرایط این کشور، امکان سفر، فعلا فراهم نیست. بنابراین در این مقاله، به مرور ۴۰ کشور باقی مانده خواهیم پرداخت.
  </p>
                
         
                
                <a href="#">تمام سرویس ها <i class="fa fa-angle-right" aria-hidden="true"></i></a></div>
            <div class="col-lg-8">
                <svg id="bg-services"
                     width="100%"
                     viewBox="0 0 1000 800">
                    <defs>
                        <linearGradient id="PSgrad_02" x1="64.279%" x2="0%" y1="76.604%" y2="0%">
                            <stop offset="0%" stop-color="rgb(1,230,248)" stop-opacity="1"/>
                            <stop offset="100%" stop-color="rgb(29,62,222)" stop-opacity="1"/>
                        </linearGradient>
                    </defs>
                    <path fill-rule="evenodd" opacity="0.102" fill="url(#PSgrad_02)"
                          d="M801.878,3.146 L116.381,128.537 C26.052,145.060 -21.235,229.535 9.856,312.073 L159.806,710.157 C184.515,775.753 264.901,810.334 338.020,792.380 L907.021,652.668 C972.912,636.489 1019.383,573.766 1011.301,510.470 L962.013,124.412 C951.950,45.594 881.254,-11.373 801.878,3.146 Z"/>
                </svg>
                <div class="row">
                    <div class="col">
                        <div class="card text-center">
                            <div class="oval"><img class="card-img-top" src="{{env('APP_URL')}}/build/solution/images/web-design.png" alt=""></div>
                            <div class="card-body">
                                <h3 class="card-title">دسترسی آسان</h3>
                                <p class="card-text"> ایران پی همیشه و همه جا در دسترس شماست</p>
                            </div>
                        </div>
                        <div class="card text-center">
                            <div class="oval"><img class="card-img-top" src="{{env('APP_URL')}}/build/solution/images/marketing.png" alt=""></div>
                            <div class="card-body">
                                <h3 class="card-title">خرید آسان</h3>
                                <p class="card-text"> ایران پی سفری آسان برای شما فراهم می کند</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card text-center">
                            <div class="oval"><img class="card-img-top" src="{{env('APP_URL')}}/build/solution/images/seo.png" alt=""></div>
                            <div class="card-body">
                                <h3 class="card-title">سفری سریع</h3>
                                <p class="card-text"> شما می توانید با ایران پی راحت سفر کنید</p>
                            </div>
                        </div>
                        <div class="card text-center">
                            <div class="oval"><img class="card-img-top" src="{{env('APP_URL')}}/build/solution/images/graphics-design.png" alt=""></div>
                            <div class="card-body">
                                <h3 class="card-title">اعتماد</h3>
                                <p class="card-text"> ایران پی با بیش از هزاران مشتری در سراسر جهان به خدمات خود تسریع بخشیده است. </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid gtco-numbers-block">
    <div class="container">
        <svg width="100%" viewBox="0 0 1600 400">
            <defs>
                <linearGradient id="PSgrad_03" x1="80.279%" x2="0%"  y2="0%">
                    <stop offset="0%" stop-color="rgb(1,230,248)" stop-opacity="1" />
                    <stop offset="100%" stop-color="rgb(29,62,222)" stop-opacity="1" />

                </linearGradient>

            </defs>
            <!-- <clipPath id="clip-path3">

                                      </clipPath> -->

            <path fill-rule="evenodd"  fill="url(#PSgrad_03)"
                  d="M98.891,386.002 L1527.942,380.805 C1581.806,380.610 1599.093,335.367 1570.005,284.353 L1480.254,126.948 C1458.704,89.153 1408.314,59.820 1366.025,57.550 L298.504,0.261 C238.784,-2.944 166.619,25.419 138.312,70.265 L16.944,262.546 C-24.214,327.750 12.103,386.317 98.891,386.002 Z"></path>

            <clipPath id="ctm" fill="none">
                <path
                        d="M98.891,386.002 L1527.942,380.805 C1581.806,380.610 1599.093,335.367 1570.005,284.353 L1480.254,126.948 C1458.704,89.153 1408.314,59.820 1366.025,57.550 L298.504,0.261 C238.784,-2.944 166.619,25.419 138.312,70.265 L16.944,262.546 C-24.214,327.750 12.103,386.317 98.891,386.002 Z"></path>
            </clipPath>

            <!-- xlink:href for modern browsers, src for IE8- -->
            <image  clip-path="url(#ctm)" xlink:href="{{env('APP_URL')}}/build/solution/images/word-map.png" height="800px" width="100%" class="svg__image">

            </image>

        </svg>
        <div class="row">
            <div class="col-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">125</h5>
                        <p class="card-text">صورتحساب فعال</p>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">200</h5>
                        <p class="card-text">صدور ویزا کارت</p>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">530</h5>
                        <p class="card-text">سرویسهای انجام شده</p>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">941</h5>
                        <p class="card-text">مشتری های فعال</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid gtco-testimonials">
    <div class="container"   dir="rtl" align="right">
        <h2> مشتری ها درباره ما چه می گویند؟</h2>
        <div class="owl-carousel owl-carousel1 owl-theme">
            <div>
                <div class="card text-center"><img class="card-img-top" src="{{env('APP_URL')}}/build/solution/images/customer1.jpg" alt="">
                    <div class="card-body">
                        <h5>زهرا جعفری<br/>
                            <span> مشتری ارشد </span></h5>
  <p class="card-text">“   از خدمات شبانه روزی سایت واقعا متشکرم ، انشالله در آینده خدمات بیشتری از ایران پی ببینیم. ” </p>
                    </div>
                </div>
            </div>
            <div>
                <div class="card text-center"><img class="card-img-top" src="{{env('APP_URL')}}/build/solution/images/customer2.jpg" alt="">
                    <div class="card-body">
                        <h5>مصطفی یوسفی<br/>
                            <span> مشتری </span></h5>
                        <p class="card-text">“ تلاش بی وقفه تیم ایران پی و همچنین سرعت عمل آنها در امر خدمت رسانی شایسته تقدیر است ” </p>
                    </div>
                </div>
            </div>
            <div>
                <div class="card text-center"><img class="card-img-top" src="{{env('APP_URL')}}/build/solution/images/customer3.jpg" alt="">
                    <div class="card-body">
                        <h5>الهام اسکندری<br/>
                            <span> مشتری </span></h5>
                        <p class="card-text">“ باعث افتخار بنده هست که با ایران پی همکاری میکنم ، خدمات این سامانه در امر خدمت رسانی واقعا تحسین برانگیز هست ” </p>
                    </div>
                </div>
            </div>
            <div>
                <div class="card text-center"><img class="card-img-top" src="{{env('APP_URL')}}/build/solution/images/customer3.jpg" alt="">
                    <div class="card-body">
                        <h5>مهدی مقتدری<br/>
                            <span> مشتری </span></h5>
                        <p class="card-text">“ این سامانه واقعا از هرنظر  خدماتی مطلوب ارائه می دهد نمونه های ایرانی آن می توانند از این سامانه الگو بگیرند ” </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid gtco-logo-area">
    <div class="container">
        <div class="row">
            <div class="col"><img src="{{env('APP_URL')}}/build/solution/images/logo1.png" class="img-fluid" alt=""></div>
            <div class="col"><img src="{{env('APP_URL')}}/build/solution/images/logo2.png" class="img-fluid" alt=""></div>
            <div class="col"><img src="{{env('APP_URL')}}/build/solution/images/logo3.png" class="img-fluid" alt=""></div>
            <div class="col"><img src="{{env('APP_URL')}}/build/solution/images/logo4.png" class="img-fluid" alt=""></div>
            <div class="col"><img src="{{env('APP_URL')}}/build/solution/images/logo5.png" class="img-fluid" alt=""></div>
        </div>
    </div>
</div>

       
@stop

    
