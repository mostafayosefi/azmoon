
@extends('sup.layoutsuper')

@section('title')
<title>ویرایش رزرو </title>
@stop

 
@section('superadmin')
 

      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              ویرایش رزرو
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
 <li class="breadcrumb-item"><a href="{{env('APP_URL')}}/superadmin/panel">پنل</a></li>
 <li class="breadcrumb-item"><a href="{{env('APP_URL')}}/superadmin/settingrezervprice">تنظیمات رزرو</a></li>
                <li class="breadcrumb-item active" aria-current="page">ویرایش رزرو</li>
              </ol>
            </nav>
          </div>
          <div class="row">
            <div class="col-md-3 grid-margin stretch-card">
            </div>
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">ویرایش رزرو</h4> 
                  <form class="forms-sample" action="" method="post">

				 
					
@if(count($errors))
 

@foreach($errors->all() as $error)
<div class="breadcrumb bg-inverse-danger" >
<span  style="color: #000000"  >{{$error}}</span>  
</div> 
@endforeach
 
@endif  
		
 
		
		

 <div class="form-group {{ $errors->has('date') ? 'has-error' : '' }}">
  @if ($errors->has('date')) <label class="error mt-2 text-danger"  >تاریخ</label> @else 
 <label >تاریخ</label> @endif
 <input type="text" class="form-control"  name="date"  placeholder="تاریخ" disabled=""  value="{{$calendarrezervs->cal_year}}/{{$calendarrezervs->cal_month}}/{{$calendarrezervs->cal_day}}"   >                
 </div>
 
 			

 <div class="form-group {{ $errors->has('date') ? 'has-error' : '' }}">
  @if ($errors->has('date')) <label class="error mt-2 text-danger"  >ساعت</label> @else 
 <label >ساعت</label> @endif
 <input type="text" class="form-control"  name="date"  placeholder="ساعت" disabled=""  value="{{$calendarrezervs->cal_hours}}"   >                
 </div>
 
 		

 <div class="form-group {{ $errors->has('cal_pes') ? 'has-error' : '' }}">
  @if ($errors->has('cal_pes')) <label class="error mt-2 text-danger"  >ظرفیت</label> @else 
 <label >ظرفیت</label> @endif
 <input type="number" class="form-control"  name="cal_pes"  placeholder="ظرفیت"   value="{{$calendarrezervs->cal_pes}}"   >                
 </div>
 
 	
		        
							
                     <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    
                    <button type="submit" class="btn btn-primary mr-2">ویرایش</button> 
                  </form>
                </div>
              </div>
            </div>
            
            <div class="col-md-3 grid-margin stretch-card">
            
            </div>
            
            
            </div>
            </div> 
            </div> 
@stop


