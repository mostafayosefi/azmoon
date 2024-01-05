
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
 <li><a aria-expanded="false" href="#addfild" data-toggle="tab">ثبت فیلد</a></li>
 <li><a aria-expanded="false" href="#mngselectinput" data-toggle="tab">مدیریت سلکت باکس چک باکس</a></li>
 <li><a aria-expanded="false" href="#sortfild" data-toggle="tab">سورت فیلد</a></li>
 <li><a aria-expanded="false" href="#mngfeild" data-toggle="tab">مدیریت و ویرایش فیلدها</a></li>
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
 	

			 
<div class="form-group {{ $errors->has('form_linkname') ? 'has-error' : '' }}">   
 @if ($errors->has('form_linkname'))   
 <label class="col-sm-3 control-label" for="inputError">نام لینک</label> @else
 <label class="col-sm-3 control-label">نام لینک</label> @endif
<div class="col-sm-9"> 
<input type="text" name="form_linkname"  placeholder="نام لینک" class="form-control" @if ($form->form_linkname) value="{{$form->form_linkname}}"@else value="{{ old('form_linkname') }}" @endif > 
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
							

 

							<div class="tab-pane" id="addfild">
								<div class="panel-body">
		 
					   <div class="cards-box-view sidebar">
					   	  <div class="animatedParent animateOnce z-index-46">
							<div class="card profile-intro text-center hoverable animated fadeInUp">
	
 
 
	<div class="row">
			<div class="col-lg-12 animatedParent animateOnce z-index-47">
				<div class="panel panel-default animated fadeInUp">

					<div class="panel-body">
					      <form class="form-horizontal" method="POST" action="{{env('APP_URL')}}/superadmin/viewsforms/edit/{{$form->form_rnd}}/addfeild"  >
                  
 
					 
					
@if(count($errors))
<div class="text-danger"  >
<strong  style="" >اخطار!</strong>
<li >	 لطفا اطلاعات را به درستی وارد نمایید. </li>
@foreach($errors->all() as $error)
<span class="badge badge-danger">{{$error}}</span> <br>
@endforeach
</div> 

<div class="line-dashed" ></div>
@endif  
		
		 


<script src="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/jquery.js"></script>
	
<script type="text/javascript">
$(document).ready(function(){
	var maxField = 20; //Input fields increment limitation
	var addButton = $('.add_button'); //Add button selector
	var wrapper = $('.form-groupp'); //Input field wrapper
	var fieldHTML = '<span><div class="line-dashed"></div><div class="col-sm-5"><input type="text" name="field_name[]"  placeholder="نام فیلد" class="form-control"   value=""   ></div><div class="col-sm-5"><input type="text" name="field_namee[]"  placeholder="مقدار پیش فرض داخل فیلد" class="form-control" value=""   ></div><a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="{{env('APP_URL')}}/build/servicepay/images/remove-icon.png"/></a></span>'; //New input field html 
	var x = 1; //Initial field counter is 1
	$(addButton).click(function(){ //Once add button is clicked
		if(x < maxField){ //Check maximum number of input fields
			x++; //Increment field counter
			$(wrapper).append(fieldHTML); // Add field html
		}
	});
	$(wrapper).on('click', '.remove_button', function(e){ //Once remove button is clicked
		e.preventDefault();
		$(this).parent('span').remove(); //Remove field html
		x--; //Decrement field counter
	});
});
</script>


<div class="form-groupp">   
<div class="col-sm-5"> 
<input type="text" name="field_name[]"  placeholder="نام فیلد" class="form-control"   value=""   > 
</div>     
<div class="col-sm-5"> 
<input type="text" name="field_namee[]"  placeholder="مقدار پیش فرض داخل فیلد" class="form-control" value=""   > 
</div> 
 
<div class="col-sm-2">
 <a href="javascript:void(0);" class="add_button" title="Add field"><img src="{{env('APP_URL')}}/build/servicepay/images/add-icon.png"/></a>	 </div>
 <div class="line-dashed"></div><br>	
</div> 

			 				 
		 			  
							
                     <input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="line-dashed"></div>
							<div class="form-group"> 
								<div class=" col-sm-12"> 
								       <button class="btn btn-success btn-block btn-flat">ثبت فیلد</button>
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




 

							<div class="tab-pane" id="mngselectinput">
								<div class="panel-body">
		 
					   <div class="cards-box-view sidebar">
					   	  <div class="animatedParent animateOnce z-index-46">
							<div class="card profile-intro text-center hoverable animated fadeInUp">
	
 
 
	<div class="row">
			<div class="col-lg-12 animatedParent animateOnce z-index-47">
				<div class="panel panel-default animated fadeInUp">

					<div class="panel-body">
					
					

            <div class="card-body">
              <h4 class="card-title">لیست فیلدها </h4>
              <div class="row">
                <div class="col-12">
							<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover dataTables-example" >
                      <thead>
                        <tr>
                      
     				    <th>ردیف</th> 
                        <th>نام فیلد</th> 
                        <th>نوع فیلد</th> 
                        <th>مدیریت</th>
                        </tr>
                      </thead>
                      <tbody>
       

 <?php  $i=1;  ?>                   
@foreach ($admins as $admin)
@if(($admin->list_typ=='8')||($admin->list_typ=='9'))
 <tr>
 <td>{{$i++}} </td>
 <td>{{$admin->list_name}} </td> 
@if($admin->list_typ=='8')
 <td>سلکت باکس</td>
@elseif($admin->list_typ=='9')
 <td>چک باکس</td>
@endif
  
  
  @if($admin->list_typ=='8')
<td><a href="{{env('APP_URL')}}/superadmin/viewsforms/editselectbox/{{$admin->list_id}}" >  
	 <button type="button" class="btn btn-success btn-lg">مدیریت  
 	 </button>
</a></td>
@elseif($admin->list_typ=='9')
<td><a href="{{env('APP_URL')}}/superadmin/viewsforms/editcheckbox/{{$admin->list_id}}" >  
	 <button type="button" class="btn btn-success btn-lg">مدیریت  
 	 </button>
</a></td>
@endif

                   

 </tr>
@endif
 @endforeach
                        
               
                      </tbody>
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
</div>





							<div class="tab-pane" id="sortfild">
								<div class="panel-body">
		 
					   <div class="cards-box-view sidebar">
					   	  <div class="animatedParent animateOnce z-index-46">
							<div class="card profile-intro text-center hoverable animated fadeInUp">
	
 
 
	<div class="row">
			<div class="col-lg-12 animatedParent animateOnce z-index-47">
				<div class="panel panel-default animated fadeInUp">

					<div class="panel-body">
					      <form class="form-horizontal" method="POST" action="{{env('APP_URL')}}/superadmin/viewsforms/edit/{{$form->form_rnd}}/sortfeild"  >
       
       
       
					
@if(count($errors))
<div class="text-danger"  >
<strong  style="" >اخطار!</strong>
<li >	 لطفا اطلاعات را به درستی وارد نمایید. </li>
@foreach($errors->all() as $error)
<span class="badge badge-danger">{{$error}}</span> <br>
@endforeach
</div> 

<div class="line-dashed" ></div>
@endif  
		
	
	
		<div class="table-responsive">
					 <table class="table table-striped table-bordered table-hover dataTables-example" >
									<thead>
										<tr>
     				    <th>نام فیلد</th> 
                        <th>توضیحات فیلد</th> 
                        <th>ترتیب نمایش</th> 
										</tr>
									</thead>
									<tbody>
									@foreach($admins as $admin)
									<tr>
										<td>

 <div class="form-group">    
 
<div class="col-sm-12"> 
<input type="text" name="name{{$admin->list_id}}"  placeholder="نام فیلد" class="form-control"  value="{{$admin->list_name}}"   > 
</div> 
</div>

<div class="line-dashed"></div>
										</td>
										<td>
 <div class="form-group">   
 
<div class="col-sm-12"> 
<input type="text" name="pan{{$admin->list_id}}"  placeholder="توضیحات فیلد" class="form-control"  value="{{$admin->list_pan}}"   > 
</div> 
</div>

<div class="line-dashed"></div>
											
										</td>
										<td>
 <div class="form-group">   
 
<div class="col-sm-12"> 
<input type="hidden" name="field_chkhide{{$admin->list_id}}"  placeholder="اولویت" class="form-control"  value="{{$admin->list_chk}}"   > 
<input type="text" name="field_chk{{$admin->list_id}}"  placeholder="اولویت" class="form-control"  value="{{$admin->list_chk}}"   > 
</div> 
</div>

<div class="line-dashed"></div>
											
										</td>
									</tr>
									@endforeach
									</tbody>
									</table>
									</div>
		 	
 
							
                     <input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="line-dashed"></div>
							<div class="form-group"> 
								<div class=" col-sm-12"> 
								       <button class="btn btn-success btn-block btn-flat">ویرایش</button>
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



 

							<div class="tab-pane" id="mngfeild">
								<div class="panel-body">
		 
					   <div class="cards-box-view sidebar">
					   	  <div class="animatedParent animateOnce z-index-46">
							<div class="card profile-intro text-center hoverable animated fadeInUp">
	
 
 
	<div class="row">
			<div class="col-lg-12 animatedParent animateOnce z-index-47">
				<div class="panel panel-default animated fadeInUp">

					<div class="panel-body">
					      <form class="form-horizontal" method="POST" action="{{env('APP_URL')}}/superadmin/viewsforms/edit/{{$form->form_rnd}}/feild"  >
                  
 
					 
					
@if(count($errors))
<div class="text-danger"  >
<strong  style="" >اخطار!</strong>
<li >	 لطفا اطلاعات را به درستی وارد نمایید. </li>
@foreach($errors->all() as $error)
<span class="badge badge-danger">{{$error}}</span> <br>
@endforeach
</div> 

<div class="line-dashed" ></div>
@endif  
		
		 	
			
@foreach($admins as $admin)
<div class="form-group {{ (($errors->has('field_typ'))||(Session::get('repeat')==1))  ? 'has-error' : '' }}"> 
@if($errors->has('field_typ')) <label  class="col-sm-4 control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{{$admin->list_name}}</label> @else <label class="col-sm-4 control-label">{{$admin->list_name}}</label>   @endif
						
 <div class="col-sm-2"  > <a   @if($admin->list_price=='1')  onclick="return false;"  @else href="#"     data-toggle="modal" data-target="#modal-{{$admin->list_id}}"  @endif   > <span class="label label-danger">حذف</span></a></div>			
 <div class="col-sm-4"  > 
 <select  class="select2-placeholer form-control  {{ (($errors->has('field_typ'))||(Session::get('repeat')==1))  ? 'has-error' : '' }}"    name="field_typ[]"  style="width: 400px;"     >
 
 
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
								       <button class="btn btn-success btn-block btn-flat">ویرایش فیلدها</button>
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
									<div class="col-sm-9" > 
										<div  class="input-group date"> 
 <input  name="date" id="pcal1" placeholder="{{$admin->list_pan}}"    value="{{ old('name') }}" type="text"  > 
	  
										</div>
									</div> 
								</div>
								


 
@endif

@if($admin->list_typ=='6')





 
<link rel="stylesheet" type="text/css" href="{{env('APP_URL')}}/build/clock/dist/bootstrap-clockpicker.min.css">
<link rel="stylesheet" type="text/css" href="{{env('APP_URL')}}/build/clock/assets/css/github.min.css">
<style type="text/css">
.navbar h3 {
	color: #f5f5f5;
	margin-top: 14px;
}
.hljs-pre {
	background: #f8f8f8;
	padding: 3px;
}
.footer {
	border-top: 1px solid #eee;
	margin-top: 40px;
	padding: 40px 0;
}
.input-group {
	width: 200px;
	margin-bottom: 10px;
}
.pull-center {
	margin-left: auto;
	margin-right: auto;
}
@media (min-width: 768px) {
  .container {
    max-width: 730px;
  }
}
@media (max-width: 767px) {
  .pull-center {
    float: right;
  }
}
</style>




	<div class="form-group">
  @if ($errors->has('name')) <label class="col-sm-3 control-label" for="inputError">{{$admin->list_name}}</label> @else
 <label class="col-sm-3 control-label">{{$admin->list_name}}</label> @endif
 
  <div class="col-sm-1"> 
		<div class="clearfix">
<div class="input-group clockpicker pull-center" data-placement="left" data-align="top" data-autoclose="true" >
				<input type="text" class="form-control" value="00:00" name="time" >
				<span class="input-group-addon">
					<span class="glyphicon glyphicon-time"></span>
				</span>
			</div>
		</div> 
		</div> 
	</div>
	
 
	 
<script type="text/javascript" src="{{env('APP_URL')}}/build/clock/assets/js/jquery.min.js"></script>
<script type="text/javascript" src="{{env('APP_URL')}}/build/clock/assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{env('APP_URL')}}/build/clock/dist/bootstrap-clockpicker.min.js"></script>
<script type="text/javascript">
$('.clockpicker').clockpicker()
	.find('input').change(function(){
		console.log(this.value);
	});
var input = $('#single-input').clockpicker({
	placement: 'bottom',
	align: 'left',
	autoclose: true,
	'default': 'now'
});

$('.clockpicker-with-callbacks').clockpicker({
		donetext: 'Done',
		init: function() { 
			console.log("colorpicker initiated");
		},
		beforeShow: function() {
			console.log("before show");
		},
		afterShow: function() {
			console.log("after show");
		},
		beforeHide: function() {
			console.log("before hide");
		},
		afterHide: function() {
			console.log("after hide");
		},
		beforeHourSelect: function() {
			console.log("before hour selected");
		},
		afterHourSelect: function() {
			console.log("after hour selected");
		},
		beforeDone: function() {
			console.log("before done");
		},
		afterDone: function() {
			console.log("after done");
		}
	})
	.find('input').change(function(){
		console.log(this.value);
	});

// Manually toggle to the minutes view
$('#check-minutes').click(function(e){
	// Have to stop propagation here
	e.stopPropagation();
	input.clockpicker('show')
			.clockpicker('toggleView', 'minutes');
});
if (/mobile/i.test(navigator.userAgent)) {
	$('input').prop('readOnly', true);
}
</script>
<script type="text/javascript" src="{{env('APP_URL')}}/assets/js/highlight.min.js"></script>
<script type="text/javascript">
hljs.configure({tabReplace: '    '});
hljs.initHighlightingOnLoad();
</script>









 
@endif






@if($admin->list_typ=='8')
 
<div class="form-group {{ (($errors->has('cat'))||(Session::get('repeat')==1))  ? 'has-error' : '' }}"> 
@if($errors->has('cat')) <label  class="col-sm-3 control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{{$admin->list_name}}</label> @else <label class="col-sm-3 control-label">{{$admin->list_name}}</label>   @endif
									
 <div class="col-sm-9"> 
 <select class="select2-placeholer form-control " data-placeholder="{{$admin->list_name}}"   name="cat" dir="rtl"  style="width: 400px;"   >
<option value="">انتخاب کنید</option> 
@foreach ($formselects as $formselect) @if($admin->list_id==$formselect->formselect_formilistd)  
<option value="{{$formselect->formselect_value}}">{{$formselect->formselect_name}}</option> 
  @endif @endforeach 
 </select>
 </div>
 </div>

 <div class="line-dashed"></div> 

@endif

@if($admin->list_typ=='9')
   
 <div class="form-group">
 <div class="col-md-3">
 <label>{{$admin->list_name}}</label>
 </div>
 <div class="col-md-9">

 <div class="checkbox checkbox-replace checkbox-primary">
 
@foreach ($formchecks as $formselect) @if($admin->list_id==$formselect->formcheckbox_formilistd)  <br>    
 <input  name="{{$formselect->formcheckbox_id}}" type="checkbox"  value="1"  >
 <label for="checkbox1" >{{$formselect->formcheckbox_name}}</label>
 
  @endif @endforeach 
 </div>
 </div>
 </div>
 
 
 
 
 
 
 

 <div class="line-dashed"></div> 

@endif




@if($admin->list_typ=='7')
 
 
<script src="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/datepicker/bootstrap.min.js"></script>

<script src="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/datepicker/jasny-bootstrap.min.js"></script>

 
<link href="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/datepicker/bootstrap-datepicker.css" rel="stylesheet">
 
   
 
 <div class="form-group"> 
 @if ($errors->has('name'))   
 <label class="col-sm-3 control-label" for="inputError">{{$admin->list_name}}</label> @else
 <label class="col-sm-3 control-label">{{$admin->list_name}}</label> @endif
 <div class="col-sm-5" > 
	 <div id="date-popup" class="input-group date"> 
		 <input type="text" data-format="D, dd MM yyyy" class="form-control"> 
			 <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 
		 </div>
	 </div> 
 </div>
								
	 			 

<script src="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/datepicker/bootstrap-datepicker.js"></script>

<script>
	$(document).ready(function () {
		$('#datepicker').datepicker({
			keyboardNavigation: false,
			forceParse: false,
			todayHighlight: true
		});

		$('#date-popup').datepicker({
			keyboardNavigation: false,
			forceParse: false,
			todayHighlight: true,
			format: "yyyy/mm/dd"
		});

		$('#year-view').datepicker({
			startView: 2,
			keyboardNavigation: false,
			forceParse: false,
			format: "mm/dd/yyyy"
		});

		var dragFixed = document.getElementById('drag-fixed');
		noUiSlider.create(dragFixed, {
			start: [40, 60],
			behaviour: 'drag-fixed',
			connect: true,
			range: {
				'min': 20,
				'max': 80
			}
		});

		var basicSlider = document.getElementById('basic-slider');
		noUiSlider.create(basicSlider, {
			start: 40,
			behaviour: 'tap',
			connect: 'upper',
			range: {
				'min': 20,
				'max': 80
			}
		});

		var rangeSlider = document.getElementById('range-slider');
		noUiSlider.create(rangeSlider, {
			start: [40, 60],
			behaviour: 'drag',
			connect: true,
			range: {
				'min': 20,
				'max': 80
			}
		});

		$(".select2").select2();
		$(".select2-placeholer").select2({
			allowClear: true
		});

		//$('.colorpicker').colorpicker();

		// Colorpicker
		if ($.isFunction($.fn.colorpicker))
		{
			$(".colorpicker").each(function (i, el)
			{
				var $this = $(el);
				var  opts = {
							//format: attrDefault($this, 'format', false)
						};
				var $nextEle = $this.next();
				var $prevEle = $this.prev();
				var $colorPreview = $this.siblings('.input-group-addon').find('.icon-color-preview');

				$this.colorpicker(opts);

				if ($nextEle.is('.input-group-addon') && $nextEle.has('span'))
				{
					$nextEle.on('click', function (ev)
					{
						ev.preventDefault();
						$this.colorpicker('show');
					});
				}

				if ($prevEle.is('.input-group-addon') && $prevEle.has('span'))
				{
					$prevEle.on('click', function (ev)
					{
						ev.preventDefault();
						$this.colorpicker('show');
					});
				}

				if ($colorPreview.length)
				{
					$this.on('changeColor', function (ev) {

						$colorPreview.css('background-color', ev.color.toHex());
					});

					if ($this.val())
					{
						$colorPreview.css('background-color', $this.val());
					}
				}
			});
		}
	});
</script>






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
	  
	  
	  
	  
	  
	 
@foreach($admins as $admin) 
	  
<!--Basic Modal-->
<div id="modal-{{$admin->list_id}}" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
  <form method="post" action="">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"> {{$admin->list_name}}</h4>
      </div>
      <div class="modal-body">
        <p> آیا شما مایل به حذف فیلد  "{{$admin->list_name}}" از سیستم می باشید؟</p>
        <span>دقت نمایید در صورت حذف کلیه اطلاعات مربوطه از سیستم حذف خواهد شد</span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger"><a  href="{{env('APP_URL')}}/superadmin/viewsforms/delet/{{$admin->list_rnd}}/feild/{{$admin->list_id}}"   >حذف</a> </button>
        <button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
      </div>
      
      
    </div><!-- /.modal-content -->
    </form>
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--End Basic Modal-->
 
 
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

