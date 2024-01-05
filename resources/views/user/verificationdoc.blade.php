
@extends('user.layoutuser')

@section('title')
<title>پروفایل من</title>
@stop

 
@section('superadmin')


  
    <script src="{{env('APP_URL')}}/build/style/uploadcssjs/jquery.js"></script> 
    <link href="{{env('APP_URL')}}/build/style/uploadcssjs/dropzone.min.css" rel="stylesheet">
     <script src="{{env('APP_URL')}}/build/style/uploadcssjs/dropzone.min.js"></script>



		@foreach($admins as $admin)
		<!-- Main content -->
		<div class="main-content" >
			<h1 class="page-title" >تایید مدارک</h1>
			
		 <ol class="breadcrumb breadcrumb-2"> 
				<li><a href="{{env('APP_URL')}}/user/panel"><i class="fa fa-home"></i>پنل</a></li> 
				<li><a href="{{env('APP_URL')}}/user/verificationdoc">تایید مدارک</a></li>  
				<li class="active"><strong>ویرایش اطلاعات </strong></li> 
			</ol>
			
			@foreach($admins as $admin)
			<div class="row"> 
				<div class="col-md-12 animatedParent animateOnce z-index-50">
					<div class="tabs-container animated fadeInUp">
						<ul class="nav nav-tabs"> 
 <li class="active"><a aria-expanded="false" href="#profile" data-toggle="tab">وریفای ایمیل </a></li>
 <li><a aria-expanded="false" href="#verfytell" data-toggle="tab">وریفای تلفن همراه </a></li>
 <li><a aria-expanded="false" href="#upprofile" data-toggle="tab">تصویر کارت ملی </a></li>
 
						</ul>
						<div class="tab-content">
							


							<div class="tab-pane active" id="profile">
								<div class="panel-body">
		 
			 
	
				<div class="col-lg-12">

        
@if ($admin->user_emailactive == '0') 
<div class="box-body">
    <div class="col-lg-4 col-xs-12">             
ایمیل من:<b>{{$admin->user_email}}</b> </div>
  <div class="col-lg-4 col-xs-12">
  
  {!! Form::open([ 'route' => [ 'emailuseractivitionverfy' ], 'files' => true, 'enctype' => 'multipart/form-data' ]) !!}         
  
   
  <input  type="hidden" class="form-control" name="email" value="{{$admin->user_email}}" maxlength="44"    />
  <button  class="btn btn-flickr pull-right"><i class="fa fa-credit-card"></i>ارسال کد ورفای به ایمیل</button> 
               </br> </br>   
                  	@if(count($errors))
			<div class="alert alert-danger">
		
				<strong>اخطار!</strong> لطفا بررسی نمایید
				<br/>
				<ul>
					@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
  
  
  {!! Form::close() !!} 
  <div id="re"></div>
  </div>  
 <div class="col-lg-4 col-xs-12"> 
   
  {!! Form::open([ 'route' => [ 'emailuseractivition' ], 'files' => true, 'enctype' => 'multipart/form-data' ]) !!}         
   
<div class="input-group">
                    <div class="input-group-btn">
                      <button   class="btn btn-primary btn-block btn-flat">فعالسازی ایمیل</button>
                    </div><!-- /btn-group -->
 <input  type="text"  name="codemail"  class="form-control" placeholder="کدفعالسازی">
                  </div>
                  </br></br></br>
                              </br> </br>   
               	@if(count($errors))
			<div class="alert alert-danger">
		
				<strong>اخطار!</strong> لطفا بررسی نمایید
				<br/>
				<ul>
					@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
  
  {!! Form::close() !!} 
  <div id="rea"></div>
</div>
</div>
@elseif ($admin->user_emailactive == '1')  
 


		<div class="col-lg-12 animatedParent animateOnce z-index-47">
			<div class="panel panel-success animated fadeInUp"> 
					
					<div class="panel-body">


    <div class="col-lg-4 col-xs-12">             
ایمیل من:<b>{{$admin->user_email}}</b> </div>

  <div class="col-lg-8 col-xs-12"> 
  <div class="panel-title"><i class="icon fa fa-check"></i>{{$admin->user_email}}</div> 
ایمیل من قبلا فعال شده است

</div>
  
</div></div></div>


@endif 


				 </div>
								 </div>
				 
						  </div>

				
		 						


							<div class="tab-pane" id="verfytell">
								<div class="panel-body">
		  
	

<div class="col-lg-12">
  
            
@if ($admin->user_tellactive == '0')

<div class="box-body">
 <div class="col-lg-4 col-xs-12">             
تلفن من:<b>{{$admin->user_tell}}</b> </div>

  <div class="col-lg-4 col-xs-12"> 
   
  {!! Form::open([ 'route' => [ 'telluseractivitionverfy' ], 'files' => true, 'enctype' => 'multipart/form-data' ]) !!} 
  <input  type="hidden" class="form-control" name="tell" value="{{$admin->user_tell}}" maxlength="44"  placeholder=" " />
  <button  class="btn btn-microsoft pull-right"><i class="fa fa-credit-card"></i>ارسال کد ورفای به شماره همراه  </button>
  
   </br> </br>   
                          	@if(count($errors))
			<div class="alert alert-danger">
		
				<strong>اخطار!</strong> لطفا بررسی نمایید
				<br/>
				<ul>
					@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
  
  
  {!! Form::close() !!} 
  
  
  <div id="res"></div>
  </div>  
   
<div class="col-lg-4 col-xs-12">  

  {!! Form::open([ 'route' => [ 'telluseractivition' ], 'files' => true, 'enctype' => 'multipart/form-data' ]) !!}         
   
<div class="input-group">
                    <div class="input-group-btn">
                      <button  class="btn btn-primary btn-block btn-flat">فعالسازی تلفن همراه	</button>
                    </div><!-- /btn-group -->
 <input  type="text"  name="codtell"  class="form-control" placeholder="کدفعالسازی ">
                  </div><!-- /input-group -->
                  
   </br> </br>   
                       	@if(count($errors))
			<div class="alert alert-danger">
		
				<strong>اخطار!</strong> لطفا بررسی نمایید
				<br/>
				<ul>
					@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
  
  
  {!! Form::close() !!} 
  
  
  <div id="reas"></div>
</div>
<br>
 </div>
 
 @elseif ($admin->user_tellactive == '1')             


		<div class="col-lg-12 animatedParent animateOnce z-index-47">
			<div class="panel panel-success animated fadeInUp"> 
					
					<div class="panel-body">


    <div class="col-lg-4 col-xs-12">             
شماره همراه من:<b>{{$admin->user_tell}}</b> </div>

  <div class="col-lg-8 col-xs-12"> 
  <div class="panel-title"><i class="icon fa fa-check"></i>{{$admin->user_tell}}</div> 
 شماره همراه من قبلا فعال شده است

</div>
  
</div></div></div>
    @endif        


</div>
								 </div>
				 
						  </div>

				
	 
			 
							
							
							<div class="tab-pane" id="upprofile">
								<div class="panel-body">
	 
 
 
	<div class="row">
			<div class="col-lg-12 animatedParent animateOnce z-index-47">
				<div class="panel panel-default animated fadeInUp">
				 
					
					
					<div class="panel-body">

 
<div class="line-dashed"></div>
            <center>
 @if ($admin->user_uploadpassport)
<img src="{{env('APP_URL')}}/public/images/{{$admin->user_uploadpassport}}"  width="240"  height="160"  /> 
@else
<img src="{{env('APP_URL')}}/build/style/img/user2x.png"  width="240"  height="160"  /> 



@endif
</center>

<div class="line-dashed"></div>

 @if ($admin->user_autactive!='0')
<div class="panel-title"><i class="icon fa fa-check"></i>مدارک کاربر قبلا تایید شده است</div>
<div class="line-dashed"></div> 
@endif


<script>
	var _validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png", ".ico"];    
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

	
<form class="form-horizontal" method="POST" action="verificationdoc/post"   enctype="multipart/form-data"  onsubmit="return Validate(this);" >
                  
					 

@if(Session::get('filecard')=='1')				
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
@endif  
		
		 
      


 <div class="form-group {{ $errors->has('file') ? 'has-error' : '' }}">
							 @if ($errors->has('file'))   
							 	<label class="col-sm-3 control-label"  for="inputError">  <p>برای آپلود تصویر کارت ملی کلیک نمایید</p> </label> 
							 	@else 
							 	<label class="col-sm-3 control-label">  <p>برای آپلود تصویر کارت ملی کلیک نمایید</p></label>
							 	@endif
								<div class="col-sm-9"> 
 <input type="file" name="file" id="file"  multiple="multiple" class="form-control field-file"   >
								</div> 
 </div>

<div class="line-dashed"></div>
 	 
            

                     <input type="hidden" name="_token" value="{{ csrf_token() }}">
                     
							<div class="form-group"> 
								<div class="col-sm-offset-2 col-sm-10"> 
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
					</div>
				</div>

	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  </div>
	  @endforeach
	  </div>
	  <!-- /main content -->
@endforeach
@stop


@section('scriptfooter')


@stop

