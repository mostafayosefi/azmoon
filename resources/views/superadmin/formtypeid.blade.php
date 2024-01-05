
@extends('superadmin.layoutsuperadmin')

@section('title')
<title>نوع ورودی ها </title>
@stop

 
@section('superadmin')

		
		<!-- Main content -->
		<div class="main-content"  >
			<h1 class="page-title" >نوع ورودی ها</h1>


	<div class="row">

<div class="col-lg-12 animatedParent animateOnce z-index-47">
<div class="panel panel-default animated fadeInUp">
<div class="panel-body">
<ul class="list-unstyled multi-steps"> 
<li   class="is-actived"  >ایجاد فرم</li> 
<li   class="is-active"  >نوع ورودی ها</li> 
<li   class="is-active"  >انتخاب فیلد هزینه</li> 
</ul>
</div>
</div>
</div>
  
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

<div class="line-dashed"></div>
@endif  
		
		 
				  
			
			
@foreach($admins as $admin)
<div class="form-group {{ (($errors->has('field_typ'))||(Session::get('repeat')==1))  ? 'has-error' : '' }}"> 
@if($errors->has('field_typ')) <label  class="col-sm-2 control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{{$admin->list_name}}</label> @else <label class="col-sm-2 control-label">{{$admin->list_name}}</label>   @endif
									
 <div class="col-sm-4"> 
 <select class="select2-placeholer form-control  {{ (($errors->has('field_typ'))||(Session::get('repeat')==1))  ? 'has-error' : '' }}"    name="field_typ[]"  >
 
 
 
<option value="" @if($admin->list_typ=='0') selected @endif >لطفا نوع فیلد را انتخاب نمایید</option>
<option value="1" @if($admin->list_typ=='1') selected @endif >فیلد متنی کوچک</option>
<option value="2" @if($admin->list_typ=='2') selected @endif >فیلد متنی بزرگ</option>
<option value="3" @if($admin->list_typ=='3') selected @endif >فیلد رمزعبور</option>	
<option value="4" @if($admin->list_typ=='4') selected @endif >فیلد فایل</option> 
<option value="5" @if($admin->list_typ=='5') selected @endif >فیلد تاریخ شمسی</option> 
<option value="6" @if($admin->list_typ=='6') selected @endif >فیلد ساعت و دقیقه</option> 
<option value="7" @if($admin->list_typ=='7') selected @endif >فیلد تاریخ میلادی</option> 
<option value="8" @if($admin->list_typ=='8') selected @endif >سلکت اینپات</option>  
<option value="9" @if($admin->list_typ=='9') selected @endif >چک باکس</option> 
 
 </select>
									</div>
 
								</div>		

@endforeach
 	
							 
				   
							 
							
							
							
							
							
                     <input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="line-dashed"></div>
							<div class="form-group"> 
								<div class="col-sm-offset-2 col-sm-10"> 
								       <button class="btn btn-success btn-block btn-flat">ثبت ورودی ها</button>
								</div> 
							</div>
						</form>
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

