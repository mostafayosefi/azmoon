
@extends('cust.layoutuser')


@section('title')
<title>ویرایش پروفایل  </title>
@stop

 
@section('superadmin')
  

 @foreach($admins as $admin)
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
             مدیریت کاربر
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{env('APP_URL')}}/user/panel">پنل</a></li>
                 
                <li class="breadcrumb-item active" aria-current="page">ویرایش</li>
              </ol>
            </nav>
          </div>
          


          
                    <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">مشخصات کاربر</h4> 
                  <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link @if(empty(Session::get('err')))active	@endif " id="home-tab" data-toggle="tab" href="#home-1" role="tab"
                        aria-controls="home-1" aria-selected="true">
                        	
                        		مشاهده پروفایل
                        	<i class="fa fa-user text-info ml-2 mt-1 float-right"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link @if(Session::get('err')=='1')  active 	@endif" id="profile-tab" data-toggle="tab" href="#profile-1" role="tab"
                        aria-controls="profile-1" aria-selected="false">
                        	
                        		ویرایش پروفایل
                        	<i class="fa fa-edit text-info ml-2 mt-1 float-right"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact-1" role="tab"
                        aria-controls="contact-1" aria-selected="false">
                        		آپلود تصویر پروفایل
                        	<i class="fa fa-upload text-info ml-2 mt-1 float-right"></i></a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link @if(Session::get('err')=='2')  active 	@endif" id="secprofile-tab" data-toggle="tab" href="#secprofile-1" role="tab"
                        aria-controls="profile-1" aria-selected="false">
                        	ویرایش رمزعبور
                        	<i class="fa fa-ellipsis-h text-info ml-2 mt-1 float-right"></i>
                        </a>
                    </li>
                  </ul>
                  <div class="tab-content">
                    <div class="tab-pane fade @if(empty(Session::get('err')))   show active 	@endif " id="home-1" role="tabpanel" aria-labelledby="home-tab">
                      <div class="media">

                        <div class="media-body">
                          <h4 class="mt-0 mb-3"> {{$admin->user_name}}</h4>
                  <div class="border-bottom text-center pb-4">
                        <img src="{{env('APP_URL')}}/public/images/{{$admin->user_img}}"  alt="profile" class="img-lg rounded-circle mb-3" />
                        
                       
                      </div>




          <div class="row">
          
          
          
          
            <div class="col-md-6 grid-margin grid-margin-md-0 stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">مشخصات کاربر</h4>
                  <div class="preview-list">
                  
                  
                  

<div class="preview-item border-bottom px-0">

<div class="preview-thumbnail"> <i class="fa fa-user text-info ml-2 mt-1 float-right"></i> </div>

<div class="preview-item-content d-flex flex-grow">
<div class="flex-grow"><h6 class="preview-subject"><span class="float-right">  نام و نام خانوادگی </span>
<span class="float-left small"> <span class="text-muted pl-3"> {{$admin->user_name}}</span> </span> </h6> 
</div>
</div>
</div>
           

<div class="preview-item border-bottom px-0">

<div class="preview-thumbnail"> <i class="fa fa-phone text-info ml-2 mt-1 float-right"></i> </div>

<div class="preview-item-content d-flex flex-grow">
<div class="flex-grow"><h6 class="preview-subject"><span class="float-right">  تلفن </span>
<span class="float-left small"> <span class="text-muted pl-3"> {{$admin->user_tell}}</span> </span> </h6> 
</div>
</div>
</div>

            

<div class="preview-item border-bottom px-0">

<div class="preview-thumbnail"> <i class="fa fa-envelope text-info ml-2 mt-1 float-right"></i> </div>

<div class="preview-item-content d-flex flex-grow">
<div class="flex-grow"><h6 class="preview-subject"><span class="float-right">  ایمیل </span>
<span class="float-left small"> <span class="text-muted pl-3"> {{$admin->user_email}}</span> </span> </h6> 
</div>
</div>
</div>



            

<div class="preview-item border-bottom px-0">

<div class="preview-thumbnail"> <i class="fa fa-home text-info ml-2 mt-1 float-right"></i> </div>

<div class="preview-item-content d-flex flex-grow">
<div class="flex-grow"><h6 class="preview-subject"><span class="float-right">  آدرس </span>
<span class="float-left small"> <span class="text-muted pl-3"> {{$admin->user_adres}}</span> </span> </h6> 
</div>
</div>
</div>


            
 





</div>
</div>
</div>
</div>
        

 
           
  
                    


            <div class="col-md-6 grid-margin grid-margin-md-0 stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">وضعیت حساب کاربر</h4>
                  <div class="preview-list">


<div  @if($admin->user_active == '1')  class="bg-success" @else  class="bg-warning" @endif   style="padding:20px; 50px;">
 
					 
                    @if($admin->user_active == '1') 
                    <p><i class="far fa-check-square btn-icon-prepend"></i> حساب کاربری فعال است </p>
                    
  
      @elseif($admin->user_active != '1') 
                    <p><i class="fa fa-exclamation-triangle btn-icon-prepend"></i>حساب کاربری غیرفعال است</p>
                  
                                   
  
@endif
							    
             
                       
					</div> 
					
					
					
					
					

<div class="preview-item border-bottom px-0">

<div class="preview-thumbnail"> <i class="fa fa-calendar text-info ml-2 mt-1 float-right"></i> </div>

<div class="preview-item-content d-flex flex-grow">
<div class="flex-grow"><h6 class="preview-subject"><span class="float-right">تاریخ ثبت نام</span>
<span class="float-left small"> <span class="text-muted pl-3"> 
{{jDate::forge($admin->user_createdatdate)->format('l d F Y ساعت H:i a')}}
</span> </span> </h6> 
</div>
</div>
</div>

		
					
					
					
					

<div class="preview-item border-bottom px-0">

<div class="preview-thumbnail"> <i class="fa fa-desktop text-info ml-2 mt-1 float-right"></i> </div>

<div class="preview-item-content d-flex flex-grow">
<div class="flex-grow"><h6 class="preview-subject"><span class="float-right">آی پی کاربر</span>
<span class="float-left small"> <span class="text-muted pl-3"> {{$admin->user_ip}} </span> </span> </h6> 
</div>
</div>
</div>

		
					
					
					
					

<div class="preview-item border-bottom px-0">

<div class="preview-thumbnail"> <i class="fa fa-calendar text-info ml-2 mt-1 float-right"></i> </div>

<div class="preview-item-content d-flex flex-grow">
<div class="flex-grow"><h6 class="preview-subject"><span class="float-right">تاریخ آخرین ورود</span>
<span class="float-left small"> <span class="text-muted pl-3"> 
								@if($admin->user_loginatdate)
								{{jDate::forge($admin->user_loginatdate)->format('l d F Y ساعت H:i a')}}
								@elseif(empty($admin->user_loginatdate))
								کاربر هنوز وارد پنل کاربری خود نشده است
								@endif
</span> </span> </h6> 
</div>
</div>
</div>

		
					
					
					
					
					
					
					
					
                       
					</div> 
                       
					</div> 
					
					  
 
					 
					
					
                    </div>
                    
					
					
                          </div>
  
   
                    
                    
                    
                    
                    
                    
                        </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade @if(Session::get('err')=='1')  show active 	@endif" id="profile-1" role="tabpanel" aria-labelledby="profile-tab">
                      <div class="media"> 
                        <div class="media-body">
                         
  <div class="col-lg-6" >
                          <h4 class="mt-0 mb-3">ویرایش پروفایل</h4>
   <form class="form-horizontal" method="POST" action=""  >
                  
 
					 
@if(Session::get('err')=='2')		
@if(count($errors))
<div class="text-danger"  >
<strong  style="" >اخطار!</strong>
<li >	 لطفا اطلاعات را به درستی وارد نمایید. </li>
@foreach($errors->all() as $error)
<span class="badge badge-danger">{{$error}}</span> <br>
@endforeach
</div> 
<br>
@endif  
@endif  
		
 <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
  @if ($errors->has('name')) <label class="error mt-2 text-danger"  >نام و نام خانوادگی</label> @else 
 <label >نام و نام خانوادگی</label> @endif
 <input type="text" class="form-control"  name="name"  placeholder="نام و نام خانوادگی"  @if ($admin->user_name) value="{{$admin->user_name}}"@else value="{{old('name')}}" @endif  >                
 </div>
 
  
 <div class="form-group {{ $errors->has('tell') ? 'has-error' : '' }}">
  @if ($errors->has('tell')) <label class="error mt-2 text-danger"  >تلفن</label> @else 
 <label >تلفن</label> @endif
 <input type="text" class="form-control"  name="tell"  placeholder="تلفن"  @if ($admin->user_tell) value="{{$admin->user_tell}}"@else value="{{old('tell')}}" @endif  >                
 </div>
 
  
 <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
  @if ($errors->has('email')) <label class="error mt-2 text-danger"  >ایمیل</label> @else 
 <label >ایمیل</label> @endif
 <input type="text" class="form-control"  name="email"  placeholder="ایمیل"  @if ($admin->user_email) value="{{$admin->user_email}}"@else value="{{old('email')}}" @endif  >                
 </div>
 
 
  
 <div class="form-group {{ $errors->has('adres') ? 'has-error' : '' }}">
  @if ($errors->has('adres')) <label class="error mt-2 text-danger"  >آدرس</label> @else 
 <label >آدرس</label> @endif
<textarea  class="form-control"  name="adres" placeholder="آدرس " rows="4">@if($admin->user_adres){{$admin->user_adres}}@else{{old('adres')}}@endif 
</textarea> 
 </div>
 
 
                     <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <button type="submit" class="btn btn-primary mr-2">ویرایش اطلاعات</button> 
                
 </form>
 
                        </div>
 
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="contact-1" role="tabpanel" aria-labelledby="contact-tab">
                


  
    <script src="{{env('APP_URL')}}/build/style/uploadcssjs/jquery.js"></script> 
    <link href="{{env('APP_URL')}}/build/style/uploadcssjs/dropzone.min.css" rel="stylesheet">
     <script src="{{env('APP_URL')}}/build/style/uploadcssjs/dropzone.min.js"></script>
  
                                  <h4>آپلود تصویر پروفایل</h4>
            <center>
 @if ($admin->user_img)
<img src="{{env('APP_URL')}}/public/images/{{$admin->user_img}}" class="img-circle" alt="User Image" width="256"  height="256"  /> 
@else
<img src="{{env('APP_URL')}}/build/style/img/user2x.png" class="img-circle" alt="User Image" width="256"  height="256"  /> 
@endif
</center>
 
            {!! Form::open([ 'route' => [ 'dropzone.storeuserprofile' ], 'files' => true, 'enctype' => 'multipart/form-data', 'class' => 'dropzone', 'id' => 'image-upload' ]) !!}
             
             
            <div>
                <h3>برای آپلود تصویر پروفایل کلیک نمایید</h3>
            </div>
            {!! Form::close() !!}
                      
                      
                      
                      
                      
                    </div>
                    
                        <div class="tab-pane fade @if(Session::get('err')=='2')  show active 	@endif" id="secprofile-1" role="tabpanel" aria-labelledby="secprofile-tab">
                      <div class="media"> 
                        <div class="media-body">
                         
  <div class="col-lg-6" >
                          <h4 class="mt-0 mb-3">ویرایش رمزعبور</h4>


 {!! Form::open([ 'route' => [ 'securityuserprofile' ], 'files' => true, 'enctype' => 'multipart/form-data' ]) !!}   

				

					 
@if(Session::get('err')=='2')		
@if(count($errors))
<div class="text-danger"  >
<strong  style="" >اخطار!</strong>
<li >	 لطفا اطلاعات را به درستی وارد نمایید. </li>
@foreach($errors->all() as $error)
<span class="badge badge-danger">{{$error}}</span> <br>
@endforeach
</div> 
<br>
@endif  
@endif  
		
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
 
    
<input type="hidden" class="form-control" id="tell" name="tell" value="{{$admin->user_tell}}" >
<input type="hidden" class="form-control" id="email" name="email" value="{{$admin->user_email}}" >	
                     <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <button type="submit" class="btn btn-primary mr-2">ویرایش رمزعبور</button> 
                

            {!! Form::close() !!}
 
                        </div>
 
                        </div>
                      </div>
                    </div>
                    
                    
                    
                    
                  </div>
                </div>
              </div>
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


