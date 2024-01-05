@extends('superadmin.layoutsuperadmin')

@section('title')
<title>ثبت اطلاعیه </title>
@stop

 
@section('superadmin')

		
		<!-- Main content -->
		<div class="main-content" >
			<h1 class="page-title" >ثبت اطلاعیه</h1>
 
 
 			 

	<div class="row">
	 
	
			<div class="col-lg-12 animatedParent animateOnce z-index-47">
				<div class="panel panel-default animated fadeInUp">
				 
					
					<div class="panel-body">
					
					
						
<form class="form-horizontal" method="POST" action=""    >

			 
					
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
		
		 
		 
                
		 	  
						 
<div class="form-group {{ $errors->has('my_checkbox') ? 'has-error' : '' }}"  dir="rtl">   
 @if ($errors->has('my_checkbox'))   
 <label class="col-sm-3 control-label" for="inputError">گیرندگان</label> @else
 <label class="col-sm-3 control-label">گیرندگان</label> @endif
<div class="col-sm-9"> 
 
<select name="my_checkbox[]"  multiple class="form-control select2"   >
                      @foreach($students as $student)
<option  value="{{$student->id}}"  >{{$student->user_name}} </option>
                        @endforeach
</select>

</div> 
</div> 
<div class="line-dashed"></div>





	  
						 
<div class="form-group {{ $errors->has('tit') ? 'has-error' : '' }}">   
 @if ($errors->has('tit'))   
 <label class="col-sm-3 control-label" for="inputError">موضوع</label> @else
 <label class="col-sm-3 control-label">موضوع</label> @endif
<div class="col-sm-9"> 
<input type="text" name="tit"  placeholder="موضوع" class="form-control"   value="{{ old('tit') }}"   > 
</div> 
</div> 
<div class="line-dashed"></div>




   
<div class="form-group {{ $errors->has('des') ? 'has-error' : '' }}">               
 @if ($errors->has('des'))                 
<label class="col-sm-3 control-label" for="inputError">متن اطلاعیه</label>
@else 
 <label class="col-sm-3 control-label">متن اطلاعیه </label> 
@endif
<div class="col-sm-9"> 
<textarea  class="form-control"  id="des" name="des"    rows="5">{{old('des')}}</textarea>   </div>
 </div>  

<div class="line-dashed"></div>


						 
<div class="form-group">      
 <label class="col-sm-3 control-label" for="inputError"></label> 
<div class="col-sm-9"> 
 <div class="checkbox checkbox-replace checkbox-primary">
 <input  name="email" type="checkbox"  value="1"   >
 <label for="checkbox1" >اطلاع رسانی از طریق ایمیل</label>
 </div>
 <div class="checkbox checkbox-replace checkbox-primary">
 <input  name="tell" type="checkbox"  value="1"   >
 <label for="checkbox1" > اطلاع رسانی از طریق پیامک</label>
 </div>
</div> 
</div> 
<div class="line-dashed"></div>



 

							
							
                     <input type="hidden" name="_token" value="{{ csrf_token() }}">
                     
							<div class="form-group"> 
								<div class="col-sm-offset-3 col-sm-9"> 
								       <button class="btn btn-success btn-block btn-flat">ارسال</button>
								</div> 
							</div>
						</form>
           
					
					</div>
					</div>
					</div>
					</div>
					</div>

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

  