
@extends('superadmin.layoutsuperadmin')

@section('title')
<title>ویرایش درگاه پرداخت</title>
@stop

 
@section('superadmin')


   

		@foreach($admins as $admin)
		<!-- Main content -->
		<div class="main-content" > 
			<ol class="breadcrumb breadcrumb-2"> 
				<li><a href="{{env('APP_URL')}}/superadmin/panel"><i class="fa fa-home"></i>پنل مدیریت</a></li> 
            <li><a href="{{ url('/superadmin/viewsgetwaypays') }}">مشاهده درگاههای پرداخت</a></li>
				<li class="active"><strong>ویرایش</strong></li> 
			</ol>
			
			<div class="row">
		 
	  
	  
	   
				<div class="col-md-12 animatedParent animateOnce z-index-50">
					<div class="tabs-container animated fadeInUp">
						<ul class="nav nav-tabs">
							<li class="active"><a aria-expanded="true" href="#home" data-toggle="tab">مشاهده اطلاعات </a></li>
							<li><a aria-expanded="false" href="#profile" data-toggle="tab">ویرایش اطلاعات</a></li>
 
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="home">
								<div class="panel-body">
		 
					   <div class="cards-box-view sidebar">
					   	  <div class="animatedParent animateOnce z-index-46">
							<div class="card profile-intro text-center hoverable animated fadeInUp">
	
	
				<div class="col-lg-12">
					<div class="row">
								 <!-- Card header -->
							<div class="well">
						 
								 <!-- /card header -->
 
 <h3>{{$admin->getway_name}}</h3>    
								 

	
				  

								
								
								
								 </div>
								 </div>
								 </div>
								 
								 
								 
				<div class="col-lg-12">
					<div class="row">
 
 
 		<div class="col-md-12 animatedParent animateOnce z-index-45"> 
 		
                    @if($admin->getway_active == '1') 
					<div class="panel panel-success animated fadeInUp"> @else 
					<div class="panel panel-warning animated fadeInUp"> @endif
					
						<div class="panel-heading clearfix"> 
							<div class="panel-title"><i class="icon fa fa-check"></i>وضعیت </div> 
				
				
						</div> 
                    @if($admin->getway_active == '1') 
                    <p >فعال</p>
                    <p>جهت غیرفعال کردن روی دکمه زیر کلیک نمایید  </p>
<center><a href="rej/{{$admin->id}}"   ><span class="label label-warning">غیرفعال</span></a></center>
<br>
      @elseif($admin->getway_active != '1') 
                    <p>غیر فعال </p>
                    <p>جهت فعال کردن روی دکمه زیر کلیک نمایید </p>
 <center><a href="acc/{{$admin->id}}"  ><span class="label label-success">فعال</span></a></center>                                     
 
<br>
@endif
							    
             
                       
					</div> 
				</div> 
 
    
								
						 
 
				 
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
 

					
					      <form class="form-horizontal"   method="POST" action=""   >
 
					 
					
@if(count($errors))
<div class="text-danger"  >
<strong  style="" >اخطار!</strong>
<li >	 لطفا اطلاعات را به درستی وارد نمایید. </li>
@foreach($errors->all() as $error)
<span class="badge badge-danger">{{$error}}</span> <br>
@endforeach
</div> 

<div class="line-dashed"></div>
@endif  
		
		
		 

		
		
		
		

 @if($admin->id=='1'||$admin->id=='11') 		  
						 
<div class="form-group {{ $errors->has('terminal') ? 'has-error' : '' }}">   
 @if ($errors->has('terminal'))   
 <label class="col-sm-3 control-label" for="inputError">terminal</label> @else
 <label class="col-sm-3 control-label">terminal</label> @endif
<div class="col-sm-9"> 
<input type="text" name="terminal"  placeholder="terminal" class="form-control"   value="{{$admin->getway_terminal}}"  > 
</div> 
</div> 
<div class="line-dashed"></div>

<div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">   
 @if ($errors->has('username'))   
 <label class="col-sm-3 control-label" for="inputError">username</label> @else
 <label class="col-sm-3 control-label">username</label> @endif
<div class="col-sm-9"> 
<input type="text" name="username"  placeholder="username" class="form-control"   value="{{$admin->getway_username}}"  > 
</div> 
</div> 
<div class="line-dashed"></div>

 
<div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">   
 @if ($errors->has('password'))   
 <label class="col-sm-3 control-label" for="inputError">password</label> @else
 <label class="col-sm-3 control-label">password</label> @endif
<div class="col-sm-9"> 
<input type="password" name="password"  placeholder="password" class="form-control"   value="{{$admin->getway_password}}"  > 
</div> 
</div> 
<div class="line-dashed"></div>

 
 @endif
 
  

 @if($admin->id=='2'||$admin->id=='12'||$admin->id=='4')     	

<div class="form-group {{ $errors->has('merchent') ? 'has-error' : '' }}">   
 @if ($errors->has('merchent'))   
 <label class="col-sm-3 control-label" for="inputError">merchent</label> @else
 <label class="col-sm-3 control-label">merchent</label> @endif
<div class="col-sm-9"> 
<input type="text" name="merchent"  placeholder="merchent" class="form-control"   value="{{$admin->getway_merchent}}"  > 
</div> 
</div> 
<div class="line-dashed"></div>

 @endif
 

 @if($admin->id=='3'||$admin->id=='13') 					
							

<div class="form-group {{ $errors->has('merchent') ? 'has-error' : '' }}">   
 @if ($errors->has('merchent'))   
 <label class="col-sm-3 control-label" for="inputError">Api_Key</label> @else
 <label class="col-sm-3 control-label">Api_Key</label> @endif
<div class="col-sm-9"> 
<input type="text" name="merchent"  placeholder="Api_Key" class="form-control"   value="{{$admin->getway_merchent}}"  > 
</div> 
</div> 
<div class="line-dashed"></div>

 @endif
 						
							
                     <input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="line-dashed"></div>
							<div class="form-group"> 
								<div class="col-sm-offset-2 col-sm-10"> 
								       <button class="btn btn-primary btn-block btn-flat">ویرایش </button>
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
							
							
			
			
							
						</div>
					</div>
				</div>

	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  </div>
	  </div>
	  <!-- /main content -->
@endforeach
@stop



@section('scriptfooter')

 <link href="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/entypo.css" rel="stylesheet">
<link href="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/font-awesome.min.css" rel="stylesheet"> 
<link href="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/animations.css" rel="stylesheet"> 
<link href="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/bootstrap.min.css" rel="stylesheet">
<link href="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/mouldifi-core.css" rel="stylesheet">
<link href="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/bootstrap-datepicker.css" rel="stylesheet">
<link href="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/bootstrap-colorpicker.css" rel="stylesheet">
<link href="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/nouislider.css" rel="stylesheet">
<link href="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/select2.css" rel="stylesheet">
<link href="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/mouldifi-forms.css" rel="stylesheet" >
<link href="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/bootstrap-rtl.min.css" rel="stylesheet">
<link href="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/mouldifi-rtl-core.css" rel="stylesheet">
 
 
<script src="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/jquery.min.js"></script>
<!-- Load CSS3 Animate It Plugin JS -->
<script src="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/css3-animate-it.js"></script>
<script src="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/js/bootstrap.min.js"></script>
<script src="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/jquery.metisMenu.js"></script>
<script src="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/jquery-ui.js"></script>
<script src="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/jquery.blockUI.js"></script>
<!--nouiSlider-->
<script src="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/nouislider.min.js"></script>
<!-- Input Mask-->
<script src="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/jasny-bootstrap.min.js"></script>
<!-- Select2-->
<script src="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/select2.full.min.js"></script>
<!--Bootstrap ColorPicker-->
<script src="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/bootstrap-colorpicker.min.js"></script>
<!--Bootstrap DatePicker-->
<script src="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/bootstrap-datepicker.js"></script>
<script>
	$(document).ready(function () {
 

		$(".select2").select2();
		$(".select2-placeholer").select2({
			allowClear: true
		});

 

 
	});
</script>
<script src="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/functions.js"></script>
@stop

