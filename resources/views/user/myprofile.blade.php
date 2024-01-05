
@extends('user.layoutuser')

@section('title')
<title>پروفایل من</title>
@stop

 
@section('superadmin')


  
    <script src="{{env('APP_URL')}}/build/style/uploadcssjs/jquery.js"></script> 
    <link href="{{env('APP_URL')}}/build/style/uploadcssjs/dropzone.min.css" rel="stylesheet">
     <script src="{{env('APP_URL')}}/build/style/uploadcssjs/dropzone.min.js"></script>



		@foreach($admins as $admin)
		<!-- Main content -->
		<div class="main-content" >
			<h1 class="page-title" >پروفایل من</h1>
			
		 <ol class="breadcrumb breadcrumb-2"> 
				<li><a href="{{env('APP_URL')}}/user/panel"><i class="fa fa-home"></i>پنل</a></li> 
				<li><a href="{{env('APP_URL')}}/user/myprofile/edit">مشاهده پروفایل من</a></li>  
				<li class="active"><strong>ویرایش اطلاعات </strong></li> 
			</ol>
			
			<div class="row">
		 
	  
	  
	   
				<div class="col-md-12 animatedParent animateOnce z-index-50">
					<div class="tabs-container animated fadeInUp">
						<ul class="nav nav-tabs">
							<li class="active"><a aria-expanded="true" href="#home" data-toggle="tab">مشاهده پروفایل</a></li>
							<li><a aria-expanded="false" href="#profile" data-toggle="tab">ویرایش پروفایل</a></li>
							<li><a aria-expanded="false" href="#upprofile" data-toggle="tab">ویرایش تصویر پروفایل</a></li>
							<li><a aria-expanded="false" href="#secprofile" data-toggle="tab">ویرایش رمزعبور</a></li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="home">
								<div class="panel-body">
		 
					   <div class="cards-box-view sidebar">
					   	  <div class="animatedParent animateOnce z-index-46">
							<div class="card profile-intro text-center hoverable animated fadeInUp">
	
	
				<div class="col-lg-6">
					<div class="row">
								 <!-- Card header -->
							<div class="well">
								 <div class="card-header">
									  <div class="card-image">
										   <img class="avatar-130 img-circle" src="{{env('APP_URL')}}/public/images/{{$admin->user_img}}" alt="user image">
									  </div>
								 </div>
								 <!-- /card header -->
	
 <div class="line-dashed"></div>
									  <h3>User</h3><div class="line-dashed"></div>

								<p>نام و نام خانوادگی:{{$admin->user_name}}</p>
<div class="line-dashed"></div>
								<p>تلفن:{{$admin->user_tell}}</p>
<div class="line-dashed"></div>
								<p>ایمیل:{{$admin->user_email}}</p>
<div class="line-dashed"></div>
								<p>آدرس:{{$admin->user_adres}}</p>
<div class="line-dashed"></div>

	
				  

								
								
								
								 </div>
								 </div>
								 </div>
								 
								 
								 
				<div class="col-lg-6">
					<div class="row">
 
 
 		<div class="col-md-12 animatedParent animateOnce z-index-45"> 
 		
                    @if($admin->user_active == '1') 
					<div class="panel panel-success animated fadeInUp"> @else 
					<div class="panel panel-warning animated fadeInUp"> @endif
					
						<div class="panel-heading clearfix"> 
							<div class="panel-title"><i class="icon fa fa-check"></i>وضعیت حساب کاربر</div> 
				
				
						</div> 
                    @if($admin->user_active == '1') 
                    <p >حساب کاربری فعال است</p>
 
      @elseif($admin->user_active != '1') 
                    <p>حساب کاربری غیرفعال است</p>
 
@endif
							    
             
                       
					</div> 
				</div> 
 
   

<div class="line-dashed"></div>




<p>تاریخ ثبت نام:<br>{{jDate::forge($admin->user_createdatdate)->format('l d F Y ساعت H:i a')}}</p>
<div class="line-dashed"></div>
<p>IP کاربر:<br>{{$admin->user_ip}}</p>
<div class="line-dashed"></div>
								<p>تاریخ آخرین ورود:<br>
								@if($admin->user_loginatdate)
								{{jDate::forge($admin->user_loginatdate)->format('l d F Y ساعت H:i a')}}
								@elseif(empty($admin->user_loginatdate))
								کاربر هنوز وارد پنل کاربری خود نشده است
								@endif
								</p>
								
<div class="line-dashed"></div>
								
						 
 
				 
								 </div>
								 </div>
 
							</div>
						  </div>

				
				
					</div>
								</div>
							</div>
							<div class="tab-pane" id="profile">
								<div class="panel-body">
		 
					   <div class="cards-box-view sidebar">
					   	  <div class="animatedParent animateOnce z-index-46">
							<div class="card profile-intro text-center hoverable animated fadeInUp">
	
 
 
	<div class="row">
			<div class="col-lg-12 animatedParent animateOnce z-index-47">
				<div class="panel panel-default animated fadeInUp">
				 
					
					<div class="panel-body">
					      <form class="form-horizontal" method="POST" action=""  >
                  
 
					 
					
@if(count($errors))
<div class="text-danger"  >
<strong  style="" >اخطار!</strong>
<li >	 لطفا اطلاعات را به درستی وارد نمایید. </li>
@foreach($errors->all() as $error)
<span class="badge badge-danger">{{$error}}</span> <br>
@endforeach
</div> 
@endif  
		
		
		 

		
		
		
		
		
				  
						 
<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">   
 @if ($errors->has('name'))   
 <label class="col-sm-2 control-label" for="inputError">نام و نام خانوادگی</label> @else
 <label class="col-sm-2 control-label">نام و نام خانوادگی</label> @endif
<div class="col-sm-10"> 
<input type="text" name="name"  placeholder="نام و نام خانوادگی" class="form-control" @if ($admin->user_name) value="{{$admin->user_name}}"@else value="{{ old('name') }}" @endif > 
</div> 
</div>

<div class="line-dashed"></div>

						 
<div class="form-group {{ $errors->has('tell') ? 'has-error' : '' }}">   
 @if ($errors->has('tell'))   
 <label class="col-sm-2 control-label" for="inputError">تلفن</label> @else
 <label class="col-sm-2 control-label">تلفن</label> @endif
<div class="col-sm-10"> 
<input type="text" name="tell"  placeholder="تلفن" class="form-control" @if ($admin->user_tell) value="{{$admin->user_tell}}"@else value="{{ old('tell') }}" @endif > 
</div> 
</div>

<div class="line-dashed"></div>
<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">   
 @if ($errors->has('email'))   
 <label class="col-sm-2 control-label" for="inputError">ایمیل</label> @else
 <label class="col-sm-2 control-label">ایمیل</label> @endif
<div class="col-sm-10"> 
<input type="email" name="email"  placeholder="ایمیل" class="form-control" @if ($admin->user_email) value="{{$admin->user_email}}"@else value="{{ old('email') }}" @endif > 
</div> 
</div>

<div class="line-dashed"></div>




<div class="line-dashed"></div>
<div class="form-group {{ $errors->has('adres') ? 'has-error' : '' }}">   
 @if ($errors->has('adres'))   
 <label class="col-sm-2 control-label" for="inputError">آدرس</label> @else
 <label class="col-sm-2 control-label">آدرس</label> @endif
<div class="col-sm-10"> 
<textarea  class="form-control"  name="adres" placeholder="آدرس " rows="4">@if ($admin->user_adres){{$admin->user_adres}}@else{{old('adres')}}@endif 
</textarea>
</div> 
</div>

<div class="line-dashed"></div>

							
							 
							
							
							
							
							
                     <input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="line-dashed"></div>
							<div class="form-group"> 
								<div class="col-sm-offset-2 col-sm-10"> 
								       <button class="btn btn-primary btn-block btn-flat">ویرایش اطلاعات</button>
								</div> 
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
 

				 
							</div>
						  </div>

				
				
					</div>
								</div>
							</div>
							
							
							<div class="tab-pane" id="upprofile">
								<div class="panel-body">
		 
					   <div class="cards-box-view sidebar">
					   	  <div class="animatedParent animateOnce z-index-46">
							<div class="card profile-intro text-center hoverable animated fadeInUp">
	
 
 
	<div class="row">
			<div class="col-lg-12 animatedParent animateOnce z-index-47">
				<div class="panel panel-default animated fadeInUp">
				 
					
					
					<div class="panel-body">

            <p>آپلود تصویر پروفایل</p>
            <center>
 @if ($admin->user_img)
<img src="{{env('APP_URL')}}/public/images/{{$admin->user_img}}" class="img-circle" alt="User Image" width="256"  height="256"  /> 
@else
<img src="{{env('APP_URL')}}/build/style/img/user2x.png" class="img-circle" alt="User Image" width="256"  height="256"  /> 
@endif
</center>

            {!! Form::open([ 'route' => [ 'dropzone.storeuserprofile' ], 'files' => true, 'enctype' => 'multipart/form-data', 'class' => 'dropzone', 'id' => 'image-upload' ]) !!}
            <div>
                <p>برای آپلود تصویر پروفایل کلیک نمایید</p>
            </div>
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
							
							
							<div class="tab-pane" id="secprofile">
								<div class="panel-body">
		 
					   <div class="cards-box-view sidebar">
					   	  <div class="animatedParent animateOnce z-index-46">
							<div class="card profile-intro text-center hoverable animated fadeInUp">
	
 
 
	<div class="row">
			<div class="col-lg-12 animatedParent animateOnce z-index-47">
				<div class="panel panel-default animated fadeInUp">
				 
					
					
					<div class="panel-body">

 {!! Form::open([ 'route' => [ 'securityuserprofile' ], 'files' => true, 'enctype' => 'multipart/form-data' ]) !!}   

					 
					
@if(count($errors))
<div class="text-danger"  >
<strong  style="" >اخطار!</strong>
<li >	 لطفا اطلاعات را به درستی وارد نمایید. </li>
@foreach($errors->all() as $error)
<span class="badge badge-danger">{{$error}}</span> <br>
@endforeach
</div> 
@endif  
		
		 
		
			 <br>	  
						 
<div class="form-group {{ $errors->has('userpassword') ? 'has-error' : '' }}">   
 @if ($errors->has('userpassword'))   
 <label class="col-sm-2 control-label" for="inputError">رمزعبور</label> @else
 <label class="col-sm-2 control-label">رمزعبور</label> @endif
<div class="col-sm-10"> 
<input type="password"   class="form-control"    name="userpassword" placeholder="رمزعبور"  value="{{ old('userpassword') }}" > 
</div> 
</div>
 <br> 
 <br> 
						 
<div class="form-group {{ $errors->has('userpassword') ? 'has-error' : '' }}">   
 @if ($errors->has('userpassword'))   
 <label class="col-sm-2 control-label" for="inputError">تکرار رمزعبور</label> @else
 <label class="col-sm-2 control-label">تکرار رمزعبور</label> @endif
<div class="col-sm-10"> 
<input type="password"   class="form-control"    name="userpassword_confirmation" placeholder="تکرار رمزعبور"  value="{{ old('userpassword_confirmation') }}" > 
</div> 
</div>
 <br>
<div class="line-dashed"></div>
 		 
							
							
									
<input type="hidden" class="form-control" id="tell" name="tell" value="{{$admin->user_tell}}" >
<input type="hidden" class="form-control" id="email" name="email" value="{{$admin->user_email}}" >	
                     <input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="line-dashed"></div>
							<div class="form-group"> 
								<div class="col-sm-offset-2 col-sm-10"> 
								       <button class="btn btn-primary btn-block btn-flat">ویرایش رمزعبور</button>
								</div> 
							</div>

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
				</div>

	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  </div>
	  </div>
	  <!-- /main content -->
@endforeach
@stop


@section('scriptfooter')


@stop

