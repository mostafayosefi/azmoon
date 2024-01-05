
@extends('superadmin.layoutsuperadmin')

@section('title')
<title>ویرایش فرم</title>
@stop

 
@section('superadmin')


  
    <script src="{{env('APP_URL')}}/build/style/uploadcssjs/jquery.js"></script> 
    <link href="{{env('APP_URL')}}/build/style/uploadcssjs/dropzone.min.css" rel="stylesheet">
     <script src="{{env('APP_URL')}}/build/style/uploadcssjs/dropzone.min.js"></script>


 
		<!-- Main content -->
		<div class="main-content" >
			<h1 class="page-title" >ویرایش فرم</h1>
			
			<ol class="breadcrumb breadcrumb-2"> 
				<li><a href="{{env('APP_URL')}}/superadmin/panel"><i class="fa fa-home"></i>پنل مدیریت</a></li> 
				<li><a href="{{env('APP_URL')}}/superadmin/viewsforms">مشاهده فرم ها</a></li> 
				<li class="active"><strong>ویرایش</strong></li> 
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
						<ul class="nav nav-tabs">
 <li class="active"><a aria-expanded="true" href="#home" data-toggle="tab">مشاهده اطلاعات </a></li>
 <li><a aria-expanded="false" href="#profile" data-toggle="tab">ویرایش اطلاعات</a></li>
 <li><a aria-expanded="false" href="#demo" data-toggle="tab">پیش نمایش فرم</a></li>
 
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
 <h3>{{$form->form_name}}</h3><div class="line-dashed"></div>  
 <p>آیکن:<span class="label"><img  src="{{env('APP_URL')}}/public/images/{{$form->form_img}}" class="img-circle" width="32"  height="32"   alt="" title=""></span></p> <div class="line-dashed"></div>
 
 <p>تاریخ ثبت فرم:{{jDate::forge($form->form_date)->format('l d F Y ساعت H:i a')}}</p>
<div class="line-dashed"></div>
								 

	
				  

								
								
								
								 </div>
								 </div>
								 </div>
								 
								 
								 
				<div class="col-lg-6">
					<div class="row">
 
 
 		<div class="col-md-12 animatedParent animateOnce z-index-45"> 
 		
                    @if($form->form_active == '1') 
					<div class="panel panel-success animated fadeInUp"> @else 
					<div class="panel panel-warning animated fadeInUp"> @endif
					
						<div class="panel-heading clearfix"> 
							<div class="panel-title"><i class="icon fa fa-check"></i>وضعیت </div> 
				
				
						</div> 
                    @if($form->form_active == '1') 
                    <p >فعال</p>
                    <p>جهت غیرفعال کردن روی دکمه زیر کلیک نمایید  </p>
<center><a href="{{$form->form_active}}/{{$form->form_rnd}}"   ><span class="label label-warning">غیرفعال</span></a></center>
<br>
      @elseif($form->form_active != '1') 
                    <p>غیر فعال </p>
                    <p>جهت فعال کردن روی دکمه زیر کلیک نمایید </p>
 <center><a href="{{$form->form_active}}/{{$form->form_rnd}}"  ><span class="label label-success">فعال</span></a></center>                                     
 
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
		

<div class="form-group {{ (($errors->has('cat'))||(Session::get('repeat')==1))  ? 'has-error' : '' }}"> 
@if($errors->has('cat')) <label  class="col-sm-3 control-label" for="inputError"><i class="fa fa-times-circle-o"></i>دسته</label> @else <label class="col-sm-3 control-label">دسته</label>   @endif
									
 <div class="col-sm-9"> 
 <select class="select2-placeholer form-control " data-placeholder="دسته"   name="cat" dir="rtl" >
<option value="">انتخاب کنید</option> 
@foreach ($catforms as $catform)   
<option   value="{{$catform->catf_id}}"  @if ($form->form_cat==$catform->catf_id)  selected="" @endif  >{{$catform->catf_name}}</option> 
@endforeach 
										</select>
									</div>
								</div>
		
		 
			 
<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">   
 @if ($errors->has('name'))   
 <label class="col-sm-3 control-label" for="inputError">نام فرم</label> @else
 <label class="col-sm-3 control-label">نام فرم</label> @endif
<div class="col-sm-9"> 
<input type="text" name="name"  placeholder="نام فرم" class="form-control" @if ($form->form_name) value="{{$form->form_name}}"@else value="{{ old('name') }}" @endif > 
</div> 
</div>

<div class="line-dashed"></div>

   
<div class="form-group {{ $errors->has('des') ? 'has-error' : '' }}">               
 @if ($errors->has('des'))                 
<label class="col-sm-3 control-label" for="inputError">توضیحات فرم</label>
@else 
 <label class="col-sm-3 control-label">توضیحات فرم </label> 
@endif
<div class="col-sm-9"> 
<textarea  class="form-control" id="des" name="des"    rows="5">{{$form->form_des}}</textarea>   </div>
 </div>  

<div class="line-dashed"></div>


 

 
 <div class="form-group {{ $errors->has('file') ? 'has-error' : '' }}">
 @if ($errors->has('file'))   
 <label class="col-sm-3 control-label"  for="inputError">آپلود آیکن </label> @else
 <label class="col-sm-3 control-label">آپلود آیکن <span class="label"><img  src="{{env('APP_URL')}}/public/images/{{$form->form_img}}" class="img-circle" width="32"  height="32"   alt="" title=""></span></label>
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
								       <button class="btn btn-primary btn-block btn-flat">ویرایش فرم</button>
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
							



							<div class="tab-pane" id="demo">
								<div class="panel-body">
		 
					   <div class="cards-box-view sidebar">
					   	  <div class="animatedParent animateOnce z-index-46">
							<div class="card profile-intro text-center hoverable animated fadeInUp">
	
 
 
	<div class="row">
			<div class="col-lg-12 animatedParent animateOnce z-index-47">
				<div class="panel panel-default animated fadeInUp">
				  
					<div class="panel-body">


	<link rel="stylesheet" href="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/pd/js-persian-cal.css">
	<script type="text/javascript" src="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/pd/js-persian-cal.min.js"></script>
	
	
<script src="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/jquery.js"></script>
 
		
 <form class="form-horizontal" method="POST" action="test" enctype="multipart/form-data"  onsubmit="return Validate(this);"   >
 

@foreach($admins as $admin)

@if($admin->list_typ=='1')
<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">   
 @if ($errors->has('name'))   
 <label class="col-sm-3 control-label" for="inputError">{{$admin->list_name}}</label> @else
 <label class="col-sm-3 control-label">{{$admin->list_name}}</label> @endif
<div class="col-sm-9"> 
<input type="text" name="name"  placeholder="{{$admin->list_pan}}" class="form-control"   value="{{ old('name') }}"  > 
</div> 
</div>
@endif


@if($admin->list_typ=='2')
   
<div class="form-group {{ $errors->has('des') ? 'has-error' : '' }}">               
 @if ($errors->has('des'))                 
<label class="col-sm-3 control-label" for="inputError">{{$admin->list_name}}</label>
@else 
 <label class="col-sm-3 control-label">{{$admin->list_name}} </label> 
@endif
<div class="col-sm-9"> 
<textarea  class="form-control" id="des" name="des"    rows="5">{{$admin->list_pan}}</textarea>   </div>
 </div>  
@endif

@if($admin->list_typ=='3')
<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">   
 @if ($errors->has('name'))   
 <label class="col-sm-3 control-label" for="inputError">{{$admin->list_name}}</label> @else
 <label class="col-sm-3 control-label">{{$admin->list_name}}</label> @endif
<div class="col-sm-9"> 
<input type="password" name="password"  placeholder="{{$admin->list_pan}}" class="form-control"   value="{{ old('name') }}"  > 
</div> 
</div>
@endif

@if($admin->list_typ=='4')
 <div class="form-group {{ $errors->has('file') ? 'has-error' : '' }}">
 @if ($errors->has('file'))   
 <label class="col-sm-3 control-label"  for="inputError">{{$admin->list_name}} </label> @else
 <label class="col-sm-3 control-label">{{$admin->list_name}}</label>
 @endif
 <div class="col-sm-9"> 
 <input type="file" name="file" id="file"  multiple="multiple" class="form-control field-file"   >
 </div> 
 </div>
@endif

@if($admin->list_typ=='5')
<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">   
 @if ($errors->has('name'))   
 <label class="col-sm-3 control-label" for="inputError">{{$admin->list_name}}</label> @else
 <label class="col-sm-3 control-label">{{$admin->list_name}}</label> @endif
<div class="col-sm-9"> 
<input type="text" name="date" id="pcal1"   placeholder="{{$admin->list_pan}}"   value="{{ old('name') }}"  > 
</div> 
</div>
 
@endif

<div class="line-dashed"></div>

@endforeach
 
</form>


<script type="text/javascript">
		var objCal1 = new AMIB.persianCalendar( 'pcal1', {
				extraInputID: 'pcal1',
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

