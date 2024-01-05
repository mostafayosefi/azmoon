
@extends('superadmin.layoutsuperadmin')

@section('title')
<title>مشاهده حواله ارزی</title>
@stop

 
@section('superadmin')


  
    <script src="{{env('APP_URL')}}/build/style/uploadcssjs/jquery.js"></script> 
    <link href="{{env('APP_URL')}}/build/style/uploadcssjs/dropzone.min.css" rel="stylesheet">
     <script src="{{env('APP_URL')}}/build/style/uploadcssjs/dropzone.min.js"></script>



		@foreach($admins as $admin)
		<!-- Main content -->
		<div class="main-content" >
			<h1 class="page-title" >حواله ارزی</h1>
			
			<ol class="breadcrumb breadcrumb-2"> 
				<li><a href="{{env('APP_URL')}}/superadmin/panel"><i class="fa fa-home"></i>پنل مدیریت</a></li> 
				<li><a href="{{env('APP_URL')}}/superadmin/viewscurrencytransfer">مشاهده حواله های ارزی</a></li> 
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
 <h3>حواله ارزی</h3><div class="line-dashed"></div>
 <p>نام حواله ارزی:{{$admin->ctrf_name}}</p> <div class="line-dashed"></div>
 <p>آیکن:<span class="label"><img  src="{{env('APP_URL')}}/public/images/{{$admin->ctrf_img}}" class="img-circle" width="32"  height="32"   alt="" title=""></span></p> <div class="line-dashed"></div>
 <p>کارنسی:{{$admin->cur_name}}</p> <div class="line-dashed"></div>
 <p>کارمزد ثابت: <span class="label label-success">{{$admin->ctrf_fixfee}}{{$admin->cur_nem}}</span> </p> <div class="line-dashed"></div>
 <p>کارمزد متغیر: <span class="label label-success">{{$admin->ctrf_varebfee}} %</span> </p> <div class="line-dashed"></div>

 <p>تاریخ ثبت حواله ارزی:{{jDate::forge($admin->ctrf_createdatdate)->format('l d F Y ساعت H:i a')}}</p>
<div class="line-dashed"></div>
								 

	
				  

								
								
								
								 </div>
								 </div>
								 </div>
								 
								 
								 
				<div class="col-lg-6">
					<div class="row">
 
 
 		<div class="col-md-12 animatedParent animateOnce z-index-45"> 
 		
                    @if($admin->ctrf_active == '1') 
					<div class="panel panel-success animated fadeInUp"> @else 
					<div class="panel panel-warning animated fadeInUp"> @endif
					
						<div class="panel-heading clearfix"> 
							<div class="panel-title"><i class="icon fa fa-check"></i>وضعیت </div> 
				
				
						</div> 
                    @if($admin->ctrf_active == '1') 
                    <p >فعال</p>
                    <p>جهت غیرفعال کردن روی دکمه زیر کلیک نمایید  </p>
<center><a href="rej/{{$admin->ctrf_id}}"   ><span class="label label-warning">غیرفعال</span></a></center>
<br>
      @elseif($admin->ctrf_active != '1') 
                    <p>غیر فعال </p>
                    <p>جهت فعال کردن روی دکمه زیر کلیک نمایید </p>
 <center><a href="acc/{{$admin->ctrf_id}}"  ><span class="label label-success">فعال</span></a></center>                                     
 
<br>
@endif
							    
             
                       
					</div> 
				</div> 
 
   

<div class="line-dashed"></div>



 
								
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
		
		
		 

		
		
		
		
		
				  
						 
<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">   
 @if ($errors->has('name'))   
 <label class="col-sm-3 control-label" for="inputError">نام حواله ارزی</label> @else
 <label class="col-sm-3 control-label">نام حواله ارزی</label> @endif
<div class="col-sm-9"> 
<input type="text" name="name"  placeholder="نام حواله ارزی" class="form-control" @if ($admin->ctrf_name) value="{{$admin->ctrf_name}}"@else value="{{ old('name') }}" @endif > 
</div> 
</div>

<div class="line-dashed"></div>



<div class="form-group {{ (($errors->has('cata'))||(Session::get('repeat')==1))  ? 'has-error' : '' }}"> 
@if($errors->has('cata')) <label  class="col-sm-3 control-label" for="inputError"><i class="fa fa-times-circle-o"></i>انتخاب کارنسی</label> @else <label class="col-sm-3 control-label">انتخاب کارنسی</label>   @endif
									
 <div class="col-sm-5"> 
 <select class="select2-placeholer form-control" data-placeholder="انتخاب کارنسی" onchange="fetch_select(this.value);" name="cata" id="cata"> 
@foreach ($currencys as $currency)   
<option value="{{$currency->id}}" @if($admin->ctrf_cur==$currency->id) selected @endif>{{$currency->cur_name}}</option> 
@endforeach 
										</select>
									</div>
								</div>

 <div class="line-dashed"></div>


	
				  
						 
<div class="form-group {{ $errors->has('fixfee') ? 'has-error' : '' }}">   
 @if ($errors->has('fixfee'))   
 <label class="col-sm-3 control-label" for="inputError">کارمزد ثابت  </label> @else
 <label class="col-sm-3 control-label">کارمزد ثابت</label> @endif
<div class="col-sm-9"> 
<input type="text" name="fixfee"  placeholder="کارمزد ثابت" class="form-control" @if ($admin->ctrf_fixfee) value="{{$admin->ctrf_fixfee}}"@else value="{{ old('fixfee') }}" @endif > 
</div> 
</div>

<div class="line-dashed"></div>

			
<div class="form-group {{ $errors->has('varbfee') ? 'has-error' : '' }}">   
 @if ($errors->has('varbfee'))   
 <label class="col-sm-3 control-label" for="inputError">کارمزد متغیر(%)  </label> @else
 <label class="col-sm-3 control-label">کارمزد متغیر (%)  </label> @endif
<div class="col-sm-9"> 
<input type="text" name="varbfee"  placeholder=" " class="form-control" @if ($admin->ctrf_varebfee) value="{{$admin->ctrf_varebfee}}"@else value="{{ old('varbfee') }}" @endif > 
</div> 
</div>
	<div class="line-dashed"></div>
							<div class="form-group {{ $errors->has('file') ? 'has-error' : '' }}">
							 @if ($errors->has('file'))   
							 	<label class="col-sm-3 control-label"  for="inputError">آپلود آیکن </label> @else
							 	
							 	<label class="col-sm-3 control-label">آپلود آیکن <span class="label"><img  src="{{env('APP_URL')}}/public/images/{{$admin->ctrf_img}}" class="img-circle" width="32"  height="32"   alt="" title=""></span></label>
							 	@endif
								<div class="col-sm-9"> 
 <input type="file" name="file" id="file"  multiple="multiple" class="form-control field-file"   >
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

