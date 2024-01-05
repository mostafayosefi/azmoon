
@extends('superadmin.layoutsuperadmin')

@section('title')
<title>مشاهده کاربر</title>
@stop

 
@section('superadmin')


  
    <script src="{{env('APP_URL')}}/build/style/uploadcssjs/jquery.js"></script> 
    <link href="{{env('APP_URL')}}/build/style/uploadcssjs/dropzone.min.css" rel="stylesheet">
     <script src="{{env('APP_URL')}}/build/style/uploadcssjs/dropzone.min.js"></script>



		@foreach($admins as $admin)
		<!-- Main content -->
		<div class="main-content" >
			<h1 class="page-title" >مشاهده کاربر</h1>
			
		 <ol class="breadcrumb breadcrumb-2"> 
				<li><a href="{{env('APP_URL')}}/superadmin/panel"><i class="fa fa-home"></i>پنل مدیریت</a></li> 
				<li><a href="{{env('APP_URL')}}/superadmin/viewsusers">مشاهده کاربران</a></li>  
				<li class="active"><strong>ویرایش اطلاعات کاربر</strong></li> 
			</ol>
			
			<div class="row">
		 
	  
	  
	   
				<div class="col-md-12 animatedParent animateOnce z-index-50">
					<div class="tabs-container animated fadeInUp">
						<ul class="nav nav-tabs">
							<li  @if(empty(Session::get('err'))) class="active"  @endif><a aria-expanded="true" href="#home" data-toggle="tab">مشاهده پروفایل</a></li>
							<li    @if(Session::get('err')=='1')  class="active"	@endif><a aria-expanded="false" href="#profile" data-toggle="tab">ویرایش پروفایل</a></li>
							<li><a aria-expanded="false" href="#upprofile" data-toggle="tab">ویرایش تصویر پروفایل</a></li>
							<li  @if(Session::get('err')=='2')  class="active" 	@endif><a aria-expanded="false" href="#secprofile" data-toggle="tab">ویرایش رمزعبور</a></li>
 <li><a aria-expanded="false" href="#accdoc" data-toggle="tab">تایید مدارک کارت ملی </a></li>
 <li @if(Session::get('err')=='3')  class="active" 	@endif><a aria-expanded="false" href="#inccharge" data-toggle="tab">افزایش شارژ حساب </a></li>
 <li @if(Session::get('err')=='4')  class="active" 	@endif><a aria-expanded="false" href="#odatcharge" data-toggle="tab">کسر شارژ حساب </a></li>
 <li><a aria-expanded="false" href="#viewtrac" data-toggle="tab">مشاهده تراکنشها </a></li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane  @if(empty(Session::get('err')))  active  @endif" id="home">
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
 

 <h4>مبلع شارژ حساب: <span class="label label-info" style="font-size: 16px">{{$chargeac}} ريال</span></h4>
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
                    <p>جهت غیرفعال کردن حساب کاربری روی دکمه زیر کلیک نمایید  </p>
<center><a href="rej/{{$admin->id}}"   ><span class="label label-warning">غیرفعال</span></a></center>
<br>
      @elseif($admin->user_active != '1') 
                    <p>حساب کاربری غیرفعال است</p>
                    <p>جهت فعال کردن روی دکمه زیر کلیک نمایید </p>
 <center><a href="acc/{{$admin->id}}"  ><span class="label label-success">فعال</span></a></center>                                     
 
<br>
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
							<div class="tab-pane    @if(Session::get('err')=='1')  active 	@endif" id="profile">
								<div class="panel-body">
		 
					   <div class="cards-box-view sidebar">
					   	  <div class="animatedParent animateOnce z-index-46">
							<div class="card profile-intro text-center hoverable animated fadeInUp">
	
 
 
	<div class="row">
			<div class="col-lg-12 animatedParent animateOnce z-index-47">
				<div class="panel panel-default animated fadeInUp">
				 
					
					<div class="panel-body">
					      <form class="form-horizontal" method="POST" action=""  >
                  
 
					 
@if(Session::get('err')=='1')		
@if(count($errors))
<div class="text-danger"  >
<strong  style="" >اخطار!</strong>
<li >	 لطفا اطلاعات را به درستی وارد نمایید. </li>
@foreach($errors->all() as $error)
<span class="badge badge-danger">{{$error}}</span> <br>
@endforeach
</div> 
@endif  
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

            <h2>آپلود تصویر پروفایل</h2>
            <center>
 @if ($admin->user_img)
<img src="{{env('APP_URL')}}/public/images/{{$admin->user_img}}" class="img-circle" alt="User Image" width="256"  height="256"  /> 
@else
<img src="{{env('APP_URL')}}/build/style/img/user2x.png" class="img-circle" alt="User Image" width="256"  height="256"  /> 
@endif
</center>

             {!! Form::open([ 'route' => [ 'dropzone.storeuser' ], 'files' => true, 'enctype' => 'multipart/form-data', 'class' => 'dropzone', 'id' => 'image-upload' ]) !!}
            <div>
                <h3>برای آپلود تصویر پروفایل کلیک نمایید</h3>
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
							
							
							<div class="tab-pane   @if(Session::get('err')=='2')  active 	@endif" id="secprofile">
								<div class="panel-body">
		 
					   <div class="cards-box-view sidebar">
					   	  <div class="animatedParent animateOnce z-index-46">
							<div class="card profile-intro text-center hoverable animated fadeInUp">
	
 
 
	<div class="row">
			<div class="col-lg-12 animatedParent animateOnce z-index-47">
				<div class="panel panel-default animated fadeInUp">
				 
					
					
					<div class="panel-body">

    {!! Form::open([ 'route' => [ 'securityystud' ], 'files' => true, 'enctype' => 'multipart/form-data' ]) !!}    
     

					 
@if(Session::get('err')=='2')			
@if(count($errors))
<div class="text-danger"  >
<strong  style="" >اخطار!</strong>
<li >	 لطفا اطلاعات را به درستی وارد نمایید. </li>
@foreach($errors->all() as $error)
<span class="badge badge-danger">{{$error}}</span> <br>
@endforeach
</div> 
@endif 
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



							<div class="tab-pane" id="accdoc">
								<div class="panel-body">
		 
					   <div class="cards-box-view sidebar">
					   	  <div class="animatedParent animateOnce z-index-46">
							<div class="card profile-intro text-center hoverable animated fadeInUp">
	
 
 
	<div class="row">
			<div class="col-lg-12 animatedParent animateOnce z-index-47">
				<div class="panel panel-default animated fadeInUp">
				 
					
					
					<div class="panel-body">

            <p>مشاهده مدارک کاربر</p>
            <center>
 @if ($admin->user_uploadpassport)
<img src="{{env('APP_URL')}}/public/images/{{$admin->user_uploadpassport}}" width="240"  height="160"  /> 

<br>


 @if ($admin->user_autactive=='0')
<div class="form-group"> 
<div class="col-lg-12"> 
<a href="{{env('APP_URL')}}/superadmin/viewsusers/edituser/accdoc/{{$admin->id}}"><button class="btn btn-primary btn-block btn-flat">تایید مدارک</button></a>
</div> 
</div>
@else

<div class="panel-title"><i class="icon fa fa-check"></i>مدارک کاربر قبلا تایید شده است</div> 

@endif


@else
<img src="{{env('APP_URL')}}/build/style/img/user2x.png" class="img-circle" alt="User Image" width="256"  height="256"  /> 
@endif
</center>

     
  
					</div>
				</div>
			</div>
		</div>
 

				 
							</div>
						  </div> 
				 </div>
				</div>
			 </div>
							




 <div class="tab-pane @if(Session::get('err')=='3')  active  	@endif" id="inccharge"> 
	<div class="row">
			<div class="col-lg-12 animatedParent animateOnce z-index-47">
				<div class="panel panel-default animated fadeInUp"> 
					<div class="panel-body"> 
 <h2>افزایش شارژ حساب</h2> 
 <div class="line-dashed"></div>

 <h4>مبلع شارژ حساب: <span class="label label-info" style="font-size: 16px">{{$chargeac}} ريال</span></h4>
<div class="line-dashed"></div>
					      <form class="form-horizontal" method="POST" action="{{env('APP_URL')}}/superadmin/viewsusers/edituser/{{$admin->id}}/inccharge"  >
                  
 
					 
@if(Session::get('err')=='3')				
@if(count($errors))
<div class="text-danger"  >
<strong  style="" >اخطار!</strong>
<li >	 لطفا اطلاعات را به درستی وارد نمایید. </li>
@foreach($errors->all() as $error)
<span class="badge badge-danger">{{$error}}</span> <br>
@endforeach
</div> 
@endif  
@endif  
		
		 
				  
						 
<div class="form-group {{ $errors->has('tit') ? 'has-error' : '' }}">   
 @if ($errors->has('tit'))   
 <label class="col-sm-2 control-label" for="inputError">قیمت بر اساس ریال</label> @else
 <label class="col-sm-2 control-label">قیمت بر اساس ریال</label> @endif
<div class="col-sm-10"> 
<input type="text" name="tit"  placeholder="قیمت بر اساس ریال" class="form-control"   value="{{old('tit')}}" > 
</div> 
</div>

<div class="line-dashed"></div>

					

<div class="form-group {{ $errors->has('des') ? 'has-error' : '' }}">   
 @if ($errors->has('des'))   
 <label class="col-sm-2 control-label" for="inputError">توضیحات تراکنش</label> @else
 <label class="col-sm-2 control-label">توضیحات تراکنش</label> @endif
<div class="col-sm-10"> 
<textarea  class="form-control"  name="des" placeholder="توضیحات تراکنش " rows="4">{{old('des')}}</textarea>
</div> 
</div> 
<div class="line-dashed"></div>
							
							
                     <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
							<div class="form-group"> 
								<div class="col-sm-offset-2 col-sm-10"> 
								       <button class="btn btn-primary btn-block btn-flat">افزایش شارژ</button>
								</div> 
							</div>
						</form>
            
						</div>
					</div>
				</div>
			 </div>
			 </div>

            


 <div class="tab-pane @if(Session::get('err')=='4')  active  	@endif" id="odatcharge"> 
	<div class="row">
			<div class="col-lg-12 animatedParent animateOnce z-index-47">
				<div class="panel panel-default animated fadeInUp"> 
					<div class="panel-body"> 
 
 <h2>کسر شارژ حساب</h2> 
 <div class="line-dashed"></div>

 <h4>مبلع شارژ حساب: <span class="label label-info" style="font-size: 16px">{{$chargeac}} ريال</span></h4>
<div class="line-dashed"></div>
					      <form class="form-horizontal" method="POST" action="{{env('APP_URL')}}/superadmin/viewsusers/edituser/{{$admin->id}}/odat"  >
                  
 
					 
@if(Session::get('err')=='4')				
@if(count($errors))
<div class="text-danger"  >
<strong  style="" >اخطار!</strong>
<li >	 لطفا اطلاعات را به درستی وارد نمایید. </li>
@foreach($errors->all() as $error)
<span class="badge badge-danger">{{$error}}</span> <br>
@endforeach
</div> 
@endif  
@endif  
		
		 
				  
						 
<div class="form-group {{ $errors->has('tit') ? 'has-error' : '' }}">   
 @if ($errors->has('tit'))   
 <label class="col-sm-2 control-label" for="inputError">قیمت بر اساس ریال</label> @else
 <label class="col-sm-2 control-label">قیمت بر اساس ریال</label> @endif
<div class="col-sm-10"> 
<input type="text" name="tit"  placeholder="قیمت بر اساس ریال" class="form-control"   value="{{old('tit')}}" > 
</div> 
</div>

<div class="line-dashed"></div>

					

<div class="form-group {{ $errors->has('des') ? 'has-error' : '' }}">   
 @if ($errors->has('des'))   
 <label class="col-sm-2 control-label" for="inputError">توضیحات تراکنش</label> @else
 <label class="col-sm-2 control-label">توضیحات تراکنش</label> @endif
<div class="col-sm-10"> 
<textarea  class="form-control"  name="des" placeholder="توضیحات تراکنش " rows="4">{{old('des')}}</textarea>
</div> 
</div> 
<div class="line-dashed"></div>
							

                     <input type="hidden" name="jamekol" value="{{$chargeac}}">
                     <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
							<div class="form-group"> 
								<div class="col-sm-offset-2 col-sm-10"> 
								       <button class="btn btn-primary btn-block btn-flat">کسرشارژ</button>
								</div> 
							</div>
						</form>
            
            
						</div>
					</div>
				</div>
			 </div>
			 </div>

            

 <div class="tab-pane" id="viewtrac"> 
	<div class="row">
			<div class="col-lg-12 animatedParent animateOnce z-index-47">
				<div class="panel panel-default animated fadeInUp"> 
					<div class="panel-body"> 
 <h2>مشاهده تراکنش ها</h2> 
 <div class="line-dashed"></div>

 <h4>مبلع شارژ حساب: <span class="label label-info" style="font-size: 16px">{{$chargeac}} ريال</span></h4>
<div class="line-dashed"></div>
            
						<div class="panel-body">
							<div class="table-responsive">
 <table class="table table-striped table-bordered table-hover dataTables-example" >
@if   (empty ($chargesas))                 
<tr>اطلاعاتی وجود ندارد<tr>
@elseif ($chargesas)        
                    <thead>
                      <tr>
                        <th>ردیف</th>
                        <th>تاریخ تراکنش</th>
                        <th>هزینه ها</th>
                        <th>وضعیت</th> 
                        <th>جزییات</th> 
                      </tr>
                    </thead>
                    <tbody>
             
                    
 <?php  $i=1;   ?>                   
@foreach ($chargesas as $charges)
<tr>
<td>{{$i++}} </td>
<td>  
{{jDate::forge($charges->charge_createdatdate)->format('l d F Y ساعت H:i a')}} </td>

<td> 

 @if($charges->finical_inc == '8')
<span class="label label-success"> + 
 @elseif ($charges->finical_inc == '7') 
<span class="label label-default"> - 
 @elseif ($charges->finical_inc == '6')
<span class="label label-success"> + 
 @elseif ($charges->finical_inc == '5')   
<span class="label label-info"> +
 @elseif ($charges->finical_inc == '4')
<span class="label label-default"> 
 @elseif ($charges->finical_inc == '3')
 <span class="label label-warning" > - 	 
 @endif    
 
 {{$charges->charge_pay}} ریال</span> </td>
 
 
<td>
 @if($charges->finical_inc == '8')
<span class="label label-success">  افزایش شارژ بازاریابی
 @elseif ($charges->finical_inc == '7') 
<span class="label label-default">  کسر شارژ
 @elseif ($charges->finical_inc == '6')
<span class="label label-success"> افزایش شارژ توسط مدیر 
 @elseif ($charges->finical_inc == '5')   
<span class="label label-info"> افزایش شارژ توسط کاربر 
 @elseif ($charges->finical_inc == '4')
<span class="label label-default"> خرید از درگاه پرداخت 
 @elseif ($charges->finical_inc == '3')
 <span class="label label-warning">برداشت وجه و  خرید 	 
 @endif  
</span> </td>

 <td>
 
 
@if($charges->finical_marpay=='1')   مبلغ خرید سفارش  
@elseif($charges->finical_marpay=='5')   {{$charges->finical_shenasepardakht}}
@elseif($charges->finical_marpay=='7') پرداخت در سایتهای خارجی (  {{$charges->finical_shenasepardakht}} )  
 

@elseif($charges->finical_marpay=='8')  هزینه پستی داخل ایران 
@else


@if($charges->finical_marid=='0')  

@if($charges->finical_inc=='8')    مبلغ بازاریابی 
@elseif($charges->finical_inc=='7')  {{$charges->finical_shenasepardakht}}  
@elseif($charges->finical_inc=='6')  {{$charges->finical_shenasepardakht}} 
@elseif($charges->finical_inc=='5')  شارژ توسط کاربر
@else  

 @if($charges->charge_status=='0')   خرید آدرس پستی 
 @elseif($charges->charge_status=='1')
هزینه پستی خرید محصول از فروشگاه کارگو
 @endif



@endif



@elseif($charges->finical_marid!='0')  مرسوله 
@endif

@endif
</td> 

 
</tr>
@endforeach
</tbody>
                    <tfoot>
                      <tr>
                        <th>ردیف</th>
                        <th>تاریخ تراکنش</th>
                        <th>هزینه ها</th>
                        <th>وضعیت</th> 
                        <th>جزییات</th> 
                      </tr>
                    </tfoot>
                    @endif
                  </table>
            
            
            
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
 
<script src="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/jquery.metisMenu.js"></script>
<script src="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/jquery-ui.js"></script>
<script src="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/jquery.blockUI.js"></script>
<script src="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/functions.js"></script>

<script src="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/jquery.dataTables.min.js"></script>
<script src="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/dataTables.bootstrap.min.js"></script> 
<script src="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/vfs_fonts.js"></script>
<script src="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/buttons.html5.js"></script>
<script src="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/buttons.colVis.js"></script>
<script>
	$(document).ready(function () {
		$('.dataTables-example').DataTable({
			dom: '<"html5buttons" B>lTfgitp',
			buttons: [
				{
					extend: 'copyHtml5',
					exportOptions: {
						columns: [ 0, ':visible' ]
					}
				},
				{
					extend: 'excelHtml5',
					exportOptions: {
						columns: ':visible'
					}
				},
				{
					extend: 'pdfHtml5',
					exportOptions: {
						columns: [ 0, 1, 2, 3, 4 ]
					}
				},
				'colvis'
			]
		});
	});
</script>

@stop

