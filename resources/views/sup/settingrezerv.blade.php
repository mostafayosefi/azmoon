
@extends('sup.layoutsuper')

@section('title')
<title>تنظیمات رزرو </title>
@stop

 
@section('superadmin')
 

      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              تنظیمات رزرو
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{env('APP_URL')}}/superadmin/panel">پنل</a></li>
                <li class="breadcrumb-item active" aria-current="page">تنظیمات رزرو</li>
              </ol>
            </nav>
          </div>
          <div class="row">
          
          <!--
            <div class="col-md-3 grid-margin stretch-card">
            </div>
            <div class="col-md-6 grid-margin stretch-card">
            

 
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">تنظیمات رزرو</h4>
                  


  <link rel="stylesheet" href="{{env('APP_URL')}}/build/melody/custom/custom.css"> 
    <link rel="stylesheet" href="{{env('APP_URL')}}/build/melody/custom/fonts-fa.css">

			<div class="panel panel-transparent">
				 
 <div class="panel-body">

 <ul class="list-unstyled multi-steps"> 
<li  class="is-actived"   >انتخاب سرویس</li>
<li  class="is-active"   >در انتظار تایید سفارش</li>
<li   class="is-deactived "   >لغو شده</li>
 </ul>
 
 
 </div>
          </div>
                  
                  
                  <form class="forms-sample" action="" method="post">

				 
					
@if(count($errors))
 

@foreach($errors->all() as $error)
<div class="breadcrumb bg-inverse-danger" >
<span  style="color: #000000"  >{{$error}}</span>  
</div> 
@endforeach
 
@endif  
		
 
		
		

 <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
  @if ($errors->has('username')) <label class="error mt-2 text-danger"  >نام کاربری</label> @else 
 <label >نام کاربری</label> @endif
 <input type="text" class="form-control"  name="username"  placeholder="نام کاربری"   value="{{ old('username') }}"   >                
 </div>
 
 
 
           
 <script type="text/javascript">
            function show(str){
                document.getElementById('sh2').style.display = 'none';
                document.getElementById('sh1').style.display = 'block';
            }
            function show2(sign){
                document.getElementById('sh2').style.display = 'block';
                document.getElementById('sh1').style.display = 'none';
            }
        </script>
        
        
 
        
        
        
         <div class="col-md-12">
                        <div class="form-group row">
                        
                          <div class="col-sm-12">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input"  value=""  name="r1" id="e1" onchange="show2()"   checked="checked" >
                                ماک پیرسون دارم
                              </label>
                            </div>
                          </div>
                          <br>
                          <br>
                          <div class="col-sm-12">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input"  name="r1" onchange="show(this.value)" >
                               ماک پیرسون ندارم
                              </label>
                            </div>
                          </div>
                          
                        </div>
                        </div>
                        
                        
                        
        <div id="sh2"> </div>
        
        <div id="sh1"  style="display:none;">
        	
        	
                          <hr>
 <label class="col-sm-12 col-form-label">نوع ماک موردنظر را وارد نمایید</label>

                          <br>
                          <div class="col-sm-12">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input"  value=""  name="mak"       >
                               ماک A
                              </label>
                            </div>
                          </div>
                          <br>
                          <div class="col-sm-12">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input"  name="mak"   >
                              ماک B
                              </label>
                            </div>
                          </div>
                          <br>
                          <div class="col-sm-12">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input"  name="mak"   >
                              ماک C
                              </label>
                            </div>
                          </div>
                          
        	
        </div>
        <p>&nbsp;</p>
        
        
		

 <div class="form-group {{ $errors->has('userpassword') ? 'has-error' : '' }}">
  @if ($errors->has('userpassword')) <label class="error mt-2 text-danger"  >رمزعبور</label> @else 
 <label >رمزعبور</label> @endif
 <input type="password" class="form-control"  name="userpassword"  placeholder="رمزعبور"  value="{{ old('userpassword') }}"  >                   
 </div>
 

 <div class="form-group {{ $errors->has('userpassword') ? 'has-error' : '' }}">
  @if ($errors->has('userpassword')) <label class="error mt-2 text-danger"  >تکرار رمزعبور</label> @else 
 <label >تکرار رمزعبور</label> @endif
 <input type="password" class="form-control"  name="userpassword_confirmation"  placeholder="تکرار رمزعبور"  value="{{ old('userpassword_confirmation') }}"  >                   
 </div>
  
                    
							
                     <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    
                    <button type="submit" class="btn btn-primary mr-2">ثبت</button> 
                  </form>
                </div>
              </div>
            </div>
            
            <div class="col-md-3 grid-margin stretch-card">
            
            </div>
 
 		   
 -->
            
            
            
            
  <link rel="stylesheet" href="{{env('APP_URL')}}/build/melody/vendors/iconfonts/font-awesome/css/all.min.css">
  <link rel="stylesheet" href="{{env('APP_URL')}}/build/melody/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="{{env('APP_URL')}}/build/melody/vendors/css/vendor.bundle.addons.css">
  <!-- endinject -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{env('APP_URL')}}/build/melody/css/fullcalendar.min.css">
  <link rel="stylesheet" href="{{env('APP_URL')}}/build/melody/css/style.css">
            
             
  <script src="{{env('APP_URL')}}/build/melody/js/moment.js"></script>
  <script src="{{env('APP_URL')}}/build/melody/js/fullcalendar.min.js"></script>
  <script src="{{env('APP_URL')}}/build/melody/js/calendar-active.js"></script> 
  
  
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
  
  
  
  
  
             
   <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">تقویم</h4>
                  <p class="card-text">
                    برای ایجاد رویداد جدید کافیست روی روز مورد نظر کلیک کنید !
                  </p>
                  <div class="calendar--area">
                    <div class="row justify-content-end align-items-center">
                      <div class="col-lg-12 mt-3 text-right d-flex justify-content-space-between">
                        <div class="btn-group" role="group" aria-label="مثال">
                        
                        
@if(($month->month_year=='1399')&&($month->month_month=='12'))

                          <a href="{{env('APP_URL')}}/superadmin/date/1400/1" class="fullcalendar-btn-prev btn btn-sm btn-primary" title="ماه بعد">
                            <i class="fa fa-angle-right"></i>
                          </a>
                          

@else

                          <a href="{{env('APP_URL')}}/superadmin/date/{{$month->month_year}}/{{$month->month_month+1}}" class="fullcalendar-btn-prev btn btn-sm btn-primary" title="ماه بعد">
                            <i class="fa fa-angle-right"></i>
                          </a>
                          
@endif
                        
                        
                          
                          
<a href="#" class="fullcalendar-btn-next btn btn-sm btn-primary active" data-calendar-view="month">{{$month->month_namemonth}} {{$month->month_year}}</a>


@if(($month->month_year=='1400')&&($month->month_month=='1'))
                          <a href="{{env('APP_URL')}}/superadmin/date/1399/12" class="fullcalendar-btn-next btn btn-sm btn-primary" title="ماه قبل">
                            <i class="fa fa-angle-left"></i>
                          </a>
@else
                          <a href="{{env('APP_URL')}}/superadmin/date/{{$month->month_year}}/{{$month->month_month-1}}" class="fullcalendar-btn-next btn btn-sm btn-primary" title="ماه قبل">
                            <i class="fa fa-angle-left"></i>
                          </a>
@endif

                          
                          
                        </div>
                        <div class="btn-group" role="group" aria-label="مثال">

 
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="co-12">
                        <!-- Fullcalendar -->
                        <div class="calendar-area px-3">
                          <div class="calendar fc fc-unthemed fc-ltr" data-toggle="calendar" id="calendar"><div class="fc-toolbar fc-header-toolbar"><div class="fc-left"></div><div class="fc-right"></div><div class="fc-center"></div><div class="fc-clear"></div></div><div class="fc-view-container" style=""><div class="fc-view fc-month-view fc-basic-view" style="">
                          
                          
                          

<table class="">
<thead class="fc-head">
<tr><td class="fc-head-container fc-widget-header"><div class="fc-row fc-widget-header">

<table class="" ><thead>
<tr>
<th class="fc-day-header fc-widget-header "><span>جمعه</span></th>
<th class="fc-day-header fc-widget-header "><span>پنجشنبه</span></th>
<th class="fc-day-header fc-widget-header "><span>چهارشنبه</span></th>
<th class="fc-day-header fc-widget-header "><span>سه شنبه</span></th>
<th class="fc-day-header fc-widget-header "><span>دوشنبه</span></th>
<th class="fc-day-header fc-widget-header "><span>یکشنبه</span></th>
<th class="fc-day-header fc-widget-header "><span>شنبه</span></th>
</tr>
</thead></table>

</div></td></tr></thead>
                          
                          

<tbody class="fc-body">
                          
                          <tr><td class="fc-widget-content"><div class="fc-scroller fc-day-grid-container" style="overflow: hidden; height: 663px;"><div class="fc-day-grid fc-unselectable">
                          
 

<?php $m=0; ?>

@for ($i = 0; $i <= 5; $i++)  

 

<?php 

$weekfirst=$month->month_weekdayfirst;
$month_dayprev=$month->month_dayprev;
$month_daymonth=$month->month_daymonth;
 

	  if($weekfirst=='sat'){ $n=0; }
else  if($weekfirst=='sun'){ $n=-1;}
else  if($weekfirst=='mon'){ $n=-2;}
else  if($weekfirst=='tue'){ $n=-3;}
else  if($weekfirst=='wed'){ $n=-4;}
else  if($weekfirst=='thu'){ $n=-5;}
else  if($weekfirst=='fri'){ $n=-6;}
 ?>

<?php $m=($i*7);  
$j=$m+$n;
 ?>

<div class="fc-row fc-week fc-widget-content" style="height: 110px;">



<div class="fc-bg"><table class=""><tbody><tr> 

<td  @if(($month->month_year==$todayshamsi->year)&&($month->month_month==$todayshamsi->month)&&(($j+7)==$todayshamsi->day))  class="fc-day fc-widget-content  fc-other-month fc-today " @else class="fc-day-top fc-future" @endif  data-date="2020-07-09"></td> 

<td  @if(($month->month_year==$todayshamsi->year)&&($month->month_month==$todayshamsi->month)&&(($j+6)==$todayshamsi->day))  class="fc-day fc-widget-content  fc-other-month fc-today " @else class="fc-day-top fc-future" @endif  data-date="2020-07-09"></td> 

<td  @if(($month->month_year==$todayshamsi->year)&&($month->month_month==$todayshamsi->month)&&(($j+5)==$todayshamsi->day))  class="fc-day fc-widget-content  fc-other-month fc-today " @else class="fc-day-top fc-future" @endif  data-date="2020-07-09"></td> 

<td  @if(($month->month_year==$todayshamsi->year)&&($month->month_month==$todayshamsi->month)&&(($j+4)==$todayshamsi->day))  class="fc-day fc-widget-content  fc-other-month fc-today " @else class="fc-day-top fc-future" @endif  data-date="2020-07-09"></td> 

<td  @if(($month->month_year==$todayshamsi->year)&&($month->month_month==$todayshamsi->month)&&(($j+3)==$todayshamsi->day))  class="fc-day fc-widget-content  fc-other-month fc-today " @else class="fc-day-top fc-future" @endif  data-date="2020-07-09"></td> 

<td  @if(($month->month_year==$todayshamsi->year)&&($month->month_month==$todayshamsi->month)&&(($j+2)==$todayshamsi->day))  class="fc-day fc-widget-content  fc-other-month fc-today " @else class="fc-day-top fc-future" @endif  data-date="2020-07-09"></td> 

<td  @if(($month->month_year==$todayshamsi->year)&&($month->month_month==$todayshamsi->month)&&(($j+1)==$todayshamsi->day))  class="fc-day fc-widget-content  fc-other-month fc-today " @else class="fc-day-top fc-future" @endif  data-date="2020-07-09"></td> 
 
</tr></tbody></table></div>


<div class="fc-content-skeleton"><table><thead><tr>
 


<td  @if((($j+7)<1)||(($j+7)>$month_daymonth)) class="fc-day-top fc-other-month fc-past" @else class="fc-day-top fc-future"   @endif  data-date="2020-07-01">
 <span class="fc-day-number"> @if(($j+7)<1) {{$month_dayprev+$n+7}} @elseif(($j+7)>$month_daymonth) {{($j+7)-$month_daymonth}} @else {{$j+7}} @endif </span> 
 
 <a href="#"     data-toggle="modal" data-target="#exampleModal{{$j+7}}" class="fc-day fc-widget-content  fc-other-month fc-today "   >
 <button type="submit"  style="background-color: #1ae6bd; color: #ffffff;">افزودن رزرو</button> </a> 
 
 @foreach($calendarrezervs as $calendarrezerv) @if($calendarrezerv->cal_day==($j+7))
<?php $pes_over=$calendarrezerv->cal_pes - $calendarrezerv->cal_pesreg; ?>
@if($pes_over>0)
<a href="#"     data-toggle="modal" data-target="#rezervd{{$calendarrezerv->cal_id}}" class="fc-day fc-widget-content  fc-other-month fc-today "   >
 <button type="submit"  style="background-color: #cb34a9; color: #ffffff;  direction: rtl;">{{$calendarrezerv->cal_hours}}</button> </a> @else 
 <a href="#"     data-toggle="modal" data-target="#rezervd{{$calendarrezerv->cal_id}}" class="fc-day fc-widget-content  fc-other-month fc-today "   >
 <button type="submit"  style="background-color: #000000; color: #ffffff;  direction: rtl;">  تکمیل شد</button> </a>
 @endif   
@endif  @endforeach

</td>

<td  @if((($j+6)<1)||(($j+6)>$month_daymonth)) class="fc-day-top fc-other-month fc-past" @else class="fc-day-top fc-future"   @endif  data-date="2020-07-01"><span class="fc-day-number"> @if(($j+6)<1) {{$month_dayprev+$n+6}} @elseif(($j+6)>$month_daymonth) {{($j+6)-$month_daymonth}} @else {{$j+6}} @endif </span>

 <a href="#"     data-toggle="modal" data-target="#exampleModal{{$j+6}}" class="fc-day fc-widget-content  fc-other-month fc-today "   >
 <button type="submit"  style="background-color: #1ae6bd; color: #ffffff;">افزودن رزرو</button> </a> 
 
 @foreach($calendarrezervs as $calendarrezerv) @if($calendarrezerv->cal_day==($j+6))
<?php $pes_over=$calendarrezerv->cal_pes - $calendarrezerv->cal_pesreg; ?>
@if($pes_over>0)
<a href="#"     data-toggle="modal" data-target="#rezervd{{$calendarrezerv->cal_id}}" class="fc-day fc-widget-content  fc-other-month fc-today "   >
 <button type="submit"  style="background-color: #cb34a9; color: #ffffff;  direction: rtl;">{{$calendarrezerv->cal_hours}}</button> </a> @else 
 <a href="#"     data-toggle="modal" data-target="#rezervd{{$calendarrezerv->cal_id}}" class="fc-day fc-widget-content  fc-other-month fc-today "   >
 <button type="submit"  style="background-color: #000000; color: #ffffff;  direction: rtl;">  تکمیل شد</button> </a>
 @endif  
 @endif  @endforeach
 
</td>

 

<td  @if((($j+5)<1)||(($j+5)>$month_daymonth)) class="fc-day-top fc-other-month fc-past" @else class="fc-day-top fc-future"   @endif  data-date="2020-07-01"><span class="fc-day-number"> @if(($j+5)<1) {{$month_dayprev+$n+5}} @elseif(($j+5)>$month_daymonth) {{($j+5)-$month_daymonth}} @else {{$j+5}} @endif </span>

 <a href="#"     data-toggle="modal" data-target="#exampleModal{{$j+5}}" class="fc-day fc-widget-content  fc-other-month fc-today "   >
 <button type="submit"  style="background-color: #1ae6bd; color: #ffffff;">افزودن رزرو</button> </a> 
 
 @foreach($calendarrezervs as $calendarrezerv) @if($calendarrezerv->cal_day==($j+5))
<?php $pes_over=$calendarrezerv->cal_pes - $calendarrezerv->cal_pesreg; ?>
@if($pes_over>0)
<a href="#"     data-toggle="modal" data-target="#rezervd{{$calendarrezerv->cal_id}}" class="fc-day fc-widget-content  fc-other-month fc-today "   >
 <button type="submit"  style="background-color: #cb34a9; color: #ffffff;  direction: rtl;">{{$calendarrezerv->cal_hours}}</button> </a> @else 
 <a href="#"     data-toggle="modal" data-target="#rezervd{{$calendarrezerv->cal_id}}" class="fc-day fc-widget-content  fc-other-month fc-today "   >
 <button type="submit"  style="background-color: #000000; color: #ffffff;  direction: rtl;">  تکمیل شد</button> </a>
 @endif   
@endif  @endforeach
 
</td>

  

<td  @if((($j+4)<1)||(($j+4)>$month_daymonth)) class="fc-day-top fc-other-month fc-past" @else class="fc-day-top fc-future"   @endif  data-date="2020-07-01"><span class="fc-day-number"> @if(($j+4)<1) {{$month_dayprev+$n+4}} @elseif(($j+4)>$month_daymonth) {{($j+4)-$month_daymonth}} @else {{$j+4}} @endif </span>
 
 <a href="#"     data-toggle="modal" data-target="#exampleModal{{$j+4}}" class="fc-day fc-widget-content  fc-other-month fc-today "   >
 <button type="submit"  style="background-color: #1ae6bd; color: #ffffff;">افزودن رزرو</button> </a>  
 
 @foreach($calendarrezervs as $calendarrezerv) @if($calendarrezerv->cal_day==($j+4))
<?php $pes_over=$calendarrezerv->cal_pes - $calendarrezerv->cal_pesreg; ?>
@if($pes_over>0)
<a href="#"     data-toggle="modal" data-target="#rezervd{{$calendarrezerv->cal_id}}" class="fc-day fc-widget-content  fc-other-month fc-today "   >
 <button type="submit"  style="background-color: #cb34a9; color: #ffffff;  direction: rtl;">{{$calendarrezerv->cal_hours}}</button> </a> @else 
 <a href="#"     data-toggle="modal" data-target="#rezervd{{$calendarrezerv->cal_id}}" class="fc-day fc-widget-content  fc-other-month fc-today "   >
 <button type="submit"  style="background-color: #000000; color: #ffffff;  direction: rtl;">  تکمیل شد</button> </a>
 @endif  
@endif  @endforeach
 
</td>

 
 

<td  @if((($j+3)<1)||(($j+3)>$month_daymonth)) class="fc-day-top fc-other-month fc-past" @else class="fc-day-top fc-future"   @endif  data-date="2020-07-01"><span class="fc-day-number"> @if(($j+3)<1) {{$month_dayprev+$n+3}} @elseif(($j+3)>$month_daymonth) {{($j+3)-$month_daymonth}} @else {{$j+3}} @endif </span>

 <a href="#"     data-toggle="modal" data-target="#exampleModal{{$j+3}}" class="fc-day fc-widget-content  fc-other-month fc-today "   >
 <button type="submit"  style="background-color: #1ae6bd; color: #ffffff;">افزودن رزرو</button> </a> 
 
 @foreach($calendarrezervs as $calendarrezerv) @if($calendarrezerv->cal_day==($j+3))
<?php $pes_over=$calendarrezerv->cal_pes - $calendarrezerv->cal_pesreg; ?>
@if($pes_over>0)
<a href="#"     data-toggle="modal" data-target="#rezervd{{$calendarrezerv->cal_id}}" class="fc-day fc-widget-content  fc-other-month fc-today "   >
 <button type="submit"  style="background-color: #cb34a9; color: #ffffff;  direction: rtl;">{{$calendarrezerv->cal_hours}}</button> </a> @else 
 <a href="#"     data-toggle="modal" data-target="#rezervd{{$calendarrezerv->cal_id}}" class="fc-day fc-widget-content  fc-other-month fc-today "   >
 <button type="submit"  style="background-color: #000000; color: #ffffff;  direction: rtl;">  تکمیل شد</button> </a>
 @endif  
@endif  @endforeach
 
</td>

 
 

<td  @if((($j+2)<1)||(($j+2)>$month_daymonth)) class="fc-day-top fc-other-month fc-past" @else class="fc-day-top fc-future"   @endif  data-date="2020-07-01"><span class="fc-day-number"> @if(($j+2)<1) {{$month_dayprev+$n+2}} @elseif(($j+2)>$month_daymonth) {{($j+2)-$month_daymonth}} @else {{$j+2}} @endif </span>

 <a href="#"     data-toggle="modal" data-target="#exampleModal{{$j+2}}" class="fc-day fc-widget-content  fc-other-month fc-today "   >
 <button type="submit"  style="background-color: #1ae6bd; color: #ffffff;">افزودن رزرو</button> </a>
 
 @foreach($calendarrezervs as $calendarrezerv) @if($calendarrezerv->cal_day==($j+2))
<?php $pes_over=$calendarrezerv->cal_pes - $calendarrezerv->cal_pesreg; ?>
@if($pes_over>0)
<a href="#"     data-toggle="modal" data-target="#rezervd{{$calendarrezerv->cal_id}}" class="fc-day fc-widget-content  fc-other-month fc-today "   >
 <button type="submit"  style="background-color: #cb34a9; color: #ffffff;  direction: rtl;">{{$calendarrezerv->cal_hours}}</button> </a> @else 
 <a href="#"     data-toggle="modal" data-target="#rezervd{{$calendarrezerv->cal_id}}" class="fc-day fc-widget-content  fc-other-month fc-today "   >
 <button type="submit"  style="background-color: #000000; color: #ffffff;  direction: rtl;">  تکمیل شد</button> </a>
 @endif  
@endif  @endforeach 
 
</td>

 

<td  @if((($j+1)<1)||(($j+1)>$month_daymonth)) class="fc-day-top fc-other-month fc-past" @else class="fc-day-top fc-future"   @endif  data-date="2020-07-01"><span class="fc-day-number"> @if(($j+1)<1) {{$month_dayprev+$n+1}} @elseif(($j+1)>$month_daymonth) {{($j+1)-$month_daymonth}} @else {{$j+1}} @endif </span>

 <a href="#"     data-toggle="modal" data-target="#exampleModal{{$j+1}}" class="fc-day fc-widget-content  fc-other-month fc-today "   >
 <button type="submit"  style="background-color: #1ae6bd; color: #ffffff;">افزودن رزرو</button> </a> 
  
@foreach($calendarrezervs as $calendarrezerv) @if($calendarrezerv->cal_day==($j+1))
<?php $pes_over=$calendarrezerv->cal_pes - $calendarrezerv->cal_pesreg; ?>
@if($pes_over>0)
<a href="#"     data-toggle="modal" data-target="#rezervd{{$calendarrezerv->cal_id}}" class="fc-day fc-widget-content  fc-other-month fc-today "   >
 <button type="submit"  style="background-color: #cb34a9; color: #ffffff;  direction: rtl;">{{$calendarrezerv->cal_hours}}</button> </a> @else 
 <a href="#"     data-toggle="modal" data-target="#rezervd{{$calendarrezerv->cal_id}}" class="fc-day fc-widget-content  fc-other-month fc-today "   >
 <button type="submit"  style="background-color: #000000; color: #ffffff;  direction: rtl;">  تکمیل شد</button> </a>
 @endif  
@endif  @endforeach
 
</td>

 
   

</tr></thead><tbody><tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr></tbody></table></div>


</div>

 

@endfor
                          
                          
                          
                          
             
             
                          
                          
                          
                          
                          
                          </div></div></td></tr></tbody></table></div></div></div>
                        </div>
                        <!-- Modal - Add new event -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
 
            </div> 
            
            
            
            
            
            
            
            </div>
            </div> 
            </div> 
            





@for ($f = 1; $f <= $month_daymonth; $f++)              
<div class="modal fade" id="exampleModal{{$f}}" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
 
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel-2"> 
                          
                          {{$f}} {{$month->month_namemonth}} {{$month->month_year}}
                          
                          </h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <p>رزرو جدید</p>
                          
                          
 <form class="forms-sample" action="" method="post">
 

 <div class="form-group {{ $errors->has('time') ? 'has-error' : '' }}">
  @if ($errors->has('time')) <label class="error mt-2 text-danger"  >ساعت </label> @else 
 <label >ساعت</label> @endif
 <input type="text" class="form-control"  name="time"  placeholder="ساعت"   value="{{ old('time') }}"   >                
 </div>
 
 <div class="form-group {{ $errors->has('pes') ? 'has-error' : '' }}">
  @if ($errors->has('pes')) <label class="error mt-2 text-danger"  >ظرفیت  </label> @else 
 <label >ظرفیت</label> @endif
 <input type="number" class="form-control"  name="pes"  placeholder="ظرفیت"   value="{{ old('pes') }}"   >                
 </div>


 <input type="hidden" name="year" value="{{$month->month_year}}">
 <input type="hidden" name="month" value="{{$month->month_month}}">
 <input type="hidden" name="day" value="{{$f}}">

 <input type="hidden" name="_token" value="{{ csrf_token() }}">
 <button type="submit" class="btn btn-primary mr-2">افزودن رزرو</button> 
                  </form>       
                          
                        </div>
                        <div class="modal-footer"> 
                          <button type="button" class="btn btn-light" data-dismiss="modal">لغو</button>
                        </div>
                      </div>
                    </div>
                 




                  </div>
@endfor


  
@foreach($calendarrezervs as $calendarrezerv) 
<div class="modal fade" id="rezervd{{$calendarrezerv->cal_id}}" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
 
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel-2"> 
                          
 {{$calendarrezerv->cal_day}} {{$month->month_namemonth}} {{$month->month_year}}
                          
                          </h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <p>ساعت رزرو : {{$calendarrezerv->cal_hours}}</p><br>
                          <p>ظرفیت : {{$calendarrezerv->cal_pes}} نفر</p><br>              
                          <p>ظرفیت باقیمانده : {{$calendarrezerv->cal_pes - $calendarrezerv->cal_pesreg}} نفر</p><br>
                          <p> ویرایش ظرفیت رزرو    
                          
 <a href="settingrezerv/edit/{{$calendarrezerv->cal_id}}"  >
 	 <button type="button" class="btn btn-success btn-sm">   
 	 <i class="fa fa-edit btn-icon-append"></i>
 	 </button>
                         
                       
 </a>
                           </p><br> 
                          <p>آیا مایل به حذف این رزرو از سیستم هستید؟    
                          
 <a href="calendar/delet/{{$calendarrezerv->cal_id}}"  >
 	 <button type="button" class="btn btn-danger btn-sm">   
 	 <i class="fa fa-trash btn-icon-append"></i>
 	 </button>
                         
                       
 </a>
                           </p><br> 
                          
                          
     
                          
                        </div>
                        <div class="modal-footer"> 
                          <button type="button" class="btn btn-light" data-dismiss="modal">لغو</button>
                        </div>
                      </div>
                    </div>
                 




                  </div>
@endforeach



        
@if(!empty(Session::get('statust')))
<script src="{{env('APP_URL')}}/build/servicepay/firealert/components.js.download"></script> 
 
    <script>
        $(document).ready(function () {
                        Swal.fire({
                text: '<?php echo Session::get('statust'); ?>',
                type: 'success',
                confirmButtonText: 'بستن'

            });
            
        });
    </script>
@endif

            
@stop


