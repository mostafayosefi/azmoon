
@extends('user.layoutuser')

@section('title')
<title>{{$form->form_name}}</title>
@stop

 
@section('superadmin')


  
    <script src="{{env('APP_URL')}}/build/style/uploadcssjs/jquery.js"></script> 
    <link href="{{env('APP_URL')}}/build/style/uploadcssjs/dropzone.min.css" rel="stylesheet">
     <script src="{{env('APP_URL')}}/build/style/uploadcssjs/dropzone.min.js"></script>


 
		<!-- Main content -->
		<div class="main-content" >
			<h1 class="page-title" >ویرایش فرم</h1>
			
			<ol class="breadcrumb breadcrumb-2"> 
				<li><a href="{{env('APP_URL')}}/user/panel"><i class="fa fa-home"></i>پنل کاربر</a></li> 
				<li><a href="{{env('APP_URL')}}/user/onlineshops">ایجاد درخواست</a></li> 
				<li class="active"><strong>{{$form->form_name}}</strong></li> 
			</ol>
			
			<div class="row">
		 
 <div class="col-lg-12 animatedParent animateOnce z-index-47">
 <div class="panel panel-default animated fadeInUp">
 <div class="panel-body">

 <div class="col-sm-8"> 
			<h1 class="page-title" >{{$form->form_name}}</h1>
			<h4>{{$form->form_des}}</h4>
</div>
 <div class="col-sm-4"> 
			<span class="label"><img  src="{{env('APP_URL')}}/public/images/{{$form->form_img}}" class="img-circle" width="64"  height="64"   alt="" title=""></span>
			</div>
 </div> 
 </div> 
 </div>  
	
	  
	   
				<div class="col-md-12 animatedParent animateOnce z-index-50">
					<div class="tabs-container animated fadeInUp">
 
				 
  
			<div class="col-lg-12 animatedParent animateOnce z-index-47">
				<div class="panel panel-default animated fadeInUp">
				  
					<div class="panel-body">


	<link rel="stylesheet" href="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/pd/js-persian-cal.css">
	<script type="text/javascript" src="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/pd/js-persian-cal.min.js"></script>
	
	
<script src="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/jquery.js"></script>
 
		
 <form class="form-horizontal" method="POST" action="{{$form->form_rnd}}/post" enctype="multipart/form-data"  onsubmit="return Validate(this);"   >
 

@foreach($admins as $admin)

@if($admin->list_typ=='1')
<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">   
 @if ($errors->has('name'))   
 <label class="col-sm-3 control-label" for="inputError">{{$admin->list_name}}</label> @else
 <label class="col-sm-3 control-label">{{$admin->list_name}}</label> @endif
<div class="col-sm-9"> 
<input type="text" name="name{{$admin->list_id}}"  placeholder="{{$admin->list_pan}}" class="form-control"   value="{{ old('name') }}"  > 
</div> 
</div>
@endif


@if($admin->list_typ=='2')
   
<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">               
 @if ($errors->has('name'))                 
<label class="col-sm-3 control-label" for="inputError">{{$admin->list_name}}</label>
@else 
 <label class="col-sm-3 control-label">{{$admin->list_name}} </label> 
@endif
<div class="col-sm-9"> 
<textarea  class="form-control" id="des" name="name{{$admin->list_id}}"    rows="5">{{$admin->list_pan}}</textarea>   </div>
 </div>  
@endif

@if($admin->list_typ=='3')
<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">   
 @if ($errors->has('name'))   
 <label class="col-sm-3 control-label" for="inputError">{{$admin->list_name}}</label> @else
 <label class="col-sm-3 control-label">{{$admin->list_name}}</label> @endif
<div class="col-sm-9"> 
<input type="password" name="name{{$admin->list_id}}"  placeholder="{{$admin->list_pan}}" class="form-control"   value="{{ old('name') }}"  > 
</div> 
</div>
@endif

@if($admin->list_typ=='4')
 <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
 @if ($errors->has('name'))   
 <label class="col-sm-3 control-label"  for="inputError">{{$admin->list_name}} </label> @else
 <label class="col-sm-3 control-label">{{$admin->list_name}}</label>
 @endif
 <div class="col-sm-9"> 
 <input type="file" name="name{{$admin->list_id}}" id="file"  multiple="multiple" class="form-control field-file"   >
 </div> 
 </div>
@endif

@if($admin->list_typ=='5')
<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">   
 @if ($errors->has('name'))   
 <label class="col-sm-3 control-label" for="inputError">{{$admin->list_name}}</label> @else
 <label class="col-sm-3 control-label">{{$admin->list_name}}</label> @endif
<div class="col-sm-9"> 
<input type="text" name="name{{$admin->list_id}}" id="pcal1{{$admin->list_id}}"   placeholder="{{$admin->list_pan}}"   value="{{ old('name') }}"  > 
</div> 
</div>


<script type="text/javascript">
		var objCal1 = new AMIB.persianCalendar( 'pcal1<?php echo $admin->list_id; ?>', {
				extraInputID: 'pcal1<?php echo $admin->list_id; ?>',
				extraInputFormat: 'yyyy-mm-dd'
			}
		);
		
		var objCal1 = new AMIB.persianCalendar( 'pcal2', {
				extraInputID: 'pcal2',
				extraInputFormat: 'yyyy-mm-dd'
			}
		);
		

	
		
		var objCal3 = new AMIB.persianCalendar( 'pcal3', {
				defaultDate: 'YYYY-MM-DD'
			}
		);
		
		var objCal4 = new AMIB.persianCalendar( 'pcal4', {
				onchange: function( pdate ){
					if( pdate ) {
						alert( pdate.join( '/' ) );
					} else {
						alert( 'تاریخ واردشده نادرست است' );
					}
				}
			}
		);

		var objCal5 = new AMIB.persianCalendar( 'pcal5', {
				extraInputID: 'extra',
				extraInputFormat: 'YYYY-MM-DD - yyyy-mm-dd - JD'
			}
		);
	</script>

 
@endif




@if($admin->list_typ=='8')
 
<div class="form-group {{ (($errors->has('name'))||(Session::get('repeat')==1))  ? 'has-error' : '' }}"> 
@if($errors->has('name')) <label  class="col-sm-3 control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{{$admin->list_name}}</label> @else <label class="col-sm-3 control-label">{{$admin->list_name}}</label>   @endif
									
 <div class="col-sm-9"> 
 <select class="select2-placeholer form-control " data-placeholder="{{$admin->list_name}}"   name="name{{$admin->list_id}}" dir="rtl" >
<option value="">انتخاب کنید</option> 
@foreach ($formselects as $formselect)   
<option value="{{$formselect->formselect_value}}">{{$formselect->formselect_name}}</option> 
@endforeach 
 </select>
 </div>
 </div>

 <div class="line-dashed"></div> 

@endif






<div class="line-dashed"></div>

@endforeach
 
                     <input type="hidden" name="_token" value="{{ csrf_token() }}">
                     
 <div class="form-group"> 
 <div class="col-sm-offset-3 col-sm-9"> 
 <button class="btn btn-success btn-block btn-flat">ثبت</button>
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
	  <!-- /main content -->
 
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

