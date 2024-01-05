
@extends('superadmin.layoutsuperadmin')

@section('title')
<title>ثبت سرویس </title>
@stop

 
@section('superadmin')


		<!-- Main content -->
		<div class="main-content" >
			<h1 class="page-title" >ثبت سرویس</h1>


	<div class="row">
	 
	
			<div class="col-lg-12 animatedParent animateOnce z-index-47">
				<div class="panel panel-default animated fadeInUp">
				 
					
					<div class="panel-body">

					
<script>
	var _validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png"];    
function Validate(oForm) {
    var arrInputs = oForm.getElementsByTagName("input");
    for (var i = 0; i < arrInputs.length; i++) {
        var oInput = arrInputs[i];
        if (oInput.type == "file") {
            var sFileName = oInput.value;
            if (sFileName.length > 0) {
                var blnValid = false;
                for (var j = 0; j < _validFileExtensions.length; j++) {
                    var sCurExtension = _validFileExtensions[j];
                    if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                        blnValid = true;
                        break;
                    }
                }
                
                if (!blnValid) {
                    alert("Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
                    return false;
                }
            }
        }
    }
  
    return true;
}
</script>

	
<form class="form-horizontal" method="POST" action=""   enctype="multipart/form-data"  onsubmit="return Validate(this);" >
                  
					 
					
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
		
		 
				  
						 
<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">   
 @if ($errors->has('name'))   
 <label class="col-sm-3 control-label" for="inputError">نام سرویس</label> @else
 <label class="col-sm-3 control-label">نام سرویس</label> @endif
<div class="col-sm-9"> 
<input type="text" name="name"  placeholder="نام سرویس" class="form-control"   value="{{ old('name') }}"   > 
</div> 
</div> 
<div class="line-dashed"></div>




 
<script type="text/javascript">
function fetch_select(val){var val = document.getElementById("cata").value;$.ajax({type: 'get',url: '{{env("APP_URL")}}/superadmin/fech/'+val,data: {get_option:val},success: function (response) {document.getElementById("catam").innerHTML=response;}});}
</script>
 
 


<div class="form-group {{ (($errors->has('cata'))||(Session::get('repeat')==1))  ? 'has-error' : '' }}"> 
@if($errors->has('cata')) <label  class="col-sm-3 control-label" for="inputError"><i class="fa fa-times-circle-o"></i>انتخاب کارنسی</label> @else <label class="col-sm-3 control-label">انتخاب کارنسی</label>   @endif
									
 <div class="col-sm-5"> 
 <select class="select2-placeholer form-control" data-placeholder="انتخاب کارنسی" onchange="fetch_select(this.value);" name="cata" id="cata">
<option value="">انتخاب کنید</option> 
@foreach ($currencys as $currency)   
<option value="{{$currency->id}}">{{$currency->cur_name}}</option> 
@endforeach 
										</select>
									</div>
								</div>


								<div class="line-dashed"></div>


               

 

            
 

<p id="catam"></p>


<div class="line-dashed"></div>



<div class="form-group {{ $errors->has('fixfee') ? 'has-error' : '' }}">   
 @if ($errors->has('fixfee'))   
 <label class="col-sm-3 control-label" for="inputError">کارمزد ثابت</label> @else
 <label class="col-sm-3 control-label">کارمزد ثابت  </label> @endif
<div class="col-sm-9"> 
<input type="text" name="fixfee"  placeholder="کارمزد ثابت" class="form-control"   value="{{ old('fixfee') }}"   > 
</div> 
</div> 
<div class="line-dashed"></div>
 	
							
				

<div class="form-group {{ $errors->has('varbfee') ? 'has-error' : '' }}">   
 @if ($errors->has('varbfee'))   
 <label class="col-sm-3 control-label" for="inputError">کارمزد متغیر (درصد)  </label> @else
 <label class="col-sm-3 control-label">کارمزد متغیر(درصد)  </label> @endif
<div class="col-sm-9"> 
<input type="text" name="varbfee"  placeholder="کارمزد متغیر(درصد)" class="form-control"   value="{{ old('varbfee') }}"   > 
</div> 
</div> 
	<div class="line-dashed"></div>
							<div class="form-group {{ $errors->has('file') ? 'has-error' : '' }}">
							 @if ($errors->has('file'))   
							 	<label class="col-sm-3 control-label"  for="inputError">آپلود آیکن </label> @else
							 	
							 	<label class="col-sm-3 control-label">آپلود آیکن</label>
							 	@endif
								<div class="col-sm-9"> 
 <input type="file" name="file" id="file"  multiple="multiple" class="form-control field-file"   >
								</div> 
							</div>
							<div class="line-dashed"></div>
 	
							 
			 				
							
							
							
							
                     <input type="hidden" name="_token" value="{{ csrf_token() }}">
                     
							<div class="form-group"> 
								<div class="col-sm-offset-2 col-sm-10"> 
								       <button class="btn btn-success btn-block btn-flat">ثبت سرویس</button>
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

  
