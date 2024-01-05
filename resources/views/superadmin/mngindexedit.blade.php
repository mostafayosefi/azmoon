
@extends('superadmin.layoutsuperadmin')

@section('title')
<title>جزییات صفحه اصلی سایت </title>
@stop

 
@section('superadmin')


  
    <script src="{{env('APP_URL')}}/build/style/uploadcssjs/jquery.js"></script> 
    <link href="{{env('APP_URL')}}/build/style/uploadcssjs/dropzone.min.css" rel="stylesheet">
     <script src="{{env('APP_URL')}}/build/style/uploadcssjs/dropzone.min.js"></script>



		@foreach($admins as $admin)
		<!-- Main content -->
		<div class="main-content" >
			<h1 class="page-title" >جزییات صفحه اصلی سایت</h1>
			
			<ol class="breadcrumb breadcrumb-2"> 
				<li><a href="{{env('APP_URL')}}/superadmin/panel"><i class="fa fa-home"></i>پنل مدیریت</a></li> 
				<li><a href="{{env('APP_URL')}}/superadmin/mngindexedit">جزییات صفحه اصلی سایت
</a></li> 
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
	
	
				<div class="col-lg-6">
					<div class="row">
								 <!-- Card header -->
							<div class="well">
						 
								 <!-- /card header -->
	
 <div class="line-dashed"></div> 
 <p>عنوان سایت:{{$admin->ind_ftitile}}</p> <div class="line-dashed"></div> 
 <p>توضیحات سایت:{{$admin->ind_cont}}</p> <div class="line-dashed"></div>
 <p>متن آخر زیر فوتر:{{$admin->ind_fcopy}}</p> <div class="line-dashed"></div>
<div class="line-dashed"></div>
								 

	
				  

								
								
								
								 </div>
								 </div>
								 </div>
								 

				<div class="col-lg-6">
					<div class="row">

<span class="label"><img  src="{{env('APP_URL')}}/public/images/{{$admin->ind_himglog}}" class="img-circle" width="312"  height="312"   alt="" title=""></span>
					
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

					
					      <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data"  onsubmit="return Validate(this);"   >
 
					 
					
@if(count($errors))
<div class="text-danger"  >
<strong  style="" >اخطار!</strong>
<li >	 لطفا اطلاعات را به درستی وارد نمایید. </li>
@foreach($errors->all() as $error)
<span class="badge badge-danger">{{$error}}</span> <br>
@endforeach
</div> 
@endif  
		
		 

   
<div class="form-group {{ $errors->has('tit') ? 'has-error' : '' }}">               
 @if ($errors->has('tit'))                 
<label class="col-sm-3 control-label" for="inputError">عنوان سایت</label>
@else 
 <label class="col-sm-3 control-label">عنوان سایت </label> 
@endif
<div class="col-sm-9"> 
<textarea  class="form-control" id="tit" name="tit"    rows="5">{{$admin->ind_ftitile}}</textarea>   </div>
 </div>  

<div class="line-dashed"></div>




   
<div class="form-group {{ $errors->has('cont') ? 'has-error' : '' }}">               
 @if ($errors->has('cont'))                 
<label class="col-sm-3 control-label" for="inputError">توضیحات سایت</label>
@else 
 <label class="col-sm-3 control-label">توضیحات سایت </label> 
@endif
<div class="col-sm-9"> 
<textarea  class="form-control" id="cont" name="cont"    rows="5">{{$admin->ind_cont}}</textarea>   </div>
 </div>  

<div class="line-dashed"></div>



   
<div class="form-group {{ $errors->has('key') ? 'has-error' : '' }}">               
 @if ($errors->has('key'))                 
<label class="col-sm-3 control-label" for="inputError">کلمات کلیدی سایت</label>
@else 
 <label class="col-sm-3 control-label">کلمات کلیدی سایت </label> 
@endif
<div class="col-sm-9"> 
<textarea  class="form-control" id="key" name="key"    rows="5">{{$admin->ind_key}}</textarea>   </div>
 </div>  

<div class="line-dashed"></div>



   
<div class="form-group {{ $errors->has('fcopy') ? 'has-error' : '' }}">               
 @if ($errors->has('fcopy'))                 
<label class="col-sm-3 control-label" for="inputError">متن آخر زیر فوتر</label>
@else 
 <label class="col-sm-3 control-label">متن آخر زیر فوتر </label> 
@endif
<div class="col-sm-9"> 
<textarea  class="form-control" id="fcopy" name="fcopy"    rows="5">{{$admin->ind_fcopy}}</textarea>   </div>
 </div>  

<div class="line-dashed"></div>






 
							<div class="form-group {{ $errors->has('file') ? 'has-error' : '' }}">
							 @if ($errors->has('file'))   
							 	<label class="col-sm-3 control-label"  for="inputError">آپلود لوگو سایت </label> @else
							 	
							 	<label class="col-sm-3 control-label">آپلود لوگو سایت <span class="label"><img  src="{{env('APP_URL')}}/public/images/{{$admin->ind_himglog}}" class="img-circle" width="128"  height="128"   alt="" title=""></span></label>
							 	@endif
								<div class="col-sm-9"> 
 <input type="file" name="file" id="file"  multiple="multiple" class="form-control field-file"   >
								</div> 
							</div>
							<div class="line-dashed"></div>
 	
 

 
							<div class="form-group {{ $errors->has('filemini') ? 'has-error' : '' }}">
							 @if ($errors->has('filemini'))   
							 	<label class="col-sm-3 control-label"  for="inputError">آپلود لوگو سایت </label> @else
							 	
							 	<label class="col-sm-3 control-label">آپلود لوگو سایت (Mini) <span class="label"><img  src="{{env('APP_URL')}}/public/images/{{$admin->ind_himglogmini}}" class="img-circle" width="64"  height="64"   alt="" title=""></span></label>
							 	@endif
								<div class="col-sm-9"> 
 <input type="file" name="filemini" id="filemini"  multiple="multiple" class="form-control field-file"   >
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

				
				
					</div> </div> </div>
							

 
			
							
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

