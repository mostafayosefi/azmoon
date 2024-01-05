
@extends('superadmin.layoutsuperadmin')

@section('title')
<title>مشاهده کارنسی</title>
@stop

 
@section('superadmin')


  
    <script src="{{env('APP_URL')}}/build/style/uploadcssjs/jquery.js"></script> 
    <link href="{{env('APP_URL')}}/build/style/uploadcssjs/dropzone.min.css" rel="stylesheet">
     <script src="{{env('APP_URL')}}/build/style/uploadcssjs/dropzone.min.js"></script>



		@foreach($admins as $admin)
		<!-- Main content -->
		<div class="main-content" >
			<h1 class="page-title" >مشاهده کارنسی</h1>
			
			<ol class="breadcrumb breadcrumb-2"> 
				<li><a href="{{env('APP_URL')}}/superadmin/panel"><i class="fa fa-home"></i>پنل مدیریت</a></li> 
				<li><a href="{{env('APP_URL')}}/superadmin/viewscurrency">مشاهده کارنسی ها</a></li> 
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
									  <h3>کارنسی</h3><div class="line-dashed"></div>
 <p>نام کارنسی:{{$admin->cur_name}}</p>
<div class="line-dashed"></div>
 <p>نماد کارنسی:<span class="label label-success">{{$admin->cur_nem}}</span></p>
<div class="line-dashed"></div>

 <p>قیمت کارنسی به ریال:{{$admin->cur_gh}} ريال</p>
<div class="line-dashed"></div>
 
	
				  

								
								
								
								 </div>
								 </div>
								 </div>
								 
								 
								 
				<div class="col-lg-6">
					<div class="row">
 
 
 		<div class="col-md-12 animatedParent animateOnce z-index-45"> 
 		
                    @if($admin->cur_active == '1') 
					<div class="panel panel-success animated fadeInUp"> @else 
					<div class="panel panel-warning animated fadeInUp"> @endif
					
						<div class="panel-heading clearfix"> 
							<div class="panel-title"><i class="icon fa fa-check"></i>وضعیت </div> 
				
				
						</div> 
                    @if($admin->cur_active == '1') 
                    <p >فعال</p>
                    <p>جهت غیرفعال کردن روی دکمه زیر کلیک نمایید  </p>
<center><a href="rej/{{$admin->id}}"   ><span class="label label-warning">غیرفعال</span></a></center>
<br>
      @elseif($admin->cur_active != '1') 
                    <p>غیر فعال </p>
                    <p>جهت فعال کردن روی دکمه زیر کلیک نمایید </p>
 <center><a href="acc/{{$admin->id}}"  ><span class="label label-success">فعال</span></a></center>                                     
 
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
					      <form class="form-horizontal" method="POST" action=""  >
                  
 
					 
					
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
 <label class="col-sm-2 control-label" for="inputError">نام کارنسی</label> @else
 <label class="col-sm-2 control-label">نام کارنسی</label> @endif
<div class="col-sm-10"> 
<input type="text" name="name"  disabled=""  placeholder="نام کارنسی" class="form-control" @if ($admin->cur_name) value="{{$admin->cur_name}}"@else value="{{ old('name') }}" @endif > 
</div> 
</div>

<div class="line-dashed"></div>

				  
						 
<div class="form-group {{ $errors->has('nem') ? 'has-error' : '' }}">   
 @if ($errors->has('nem'))   
 <label class="col-sm-2 control-label" for="inputError">نماد کارنسی</label> @else
 <label class="col-sm-2 control-label">نماد کارنسی</label> @endif
<div class="col-sm-10"> 
<input type="text" name="nem" disabled="" placeholder="نماد کارنسی" class="form-control" @if ($admin->cur_nem) value="{{$admin->cur_nem}}"@else value="{{ old('nem') }}" @endif > 
</div> 
</div>

<div class="line-dashed"></div>
		  
						 
<div class="form-group {{ $errors->has('nem') ? 'has-error' : '' }}">   
 @if ($errors->has('cur_gh'))   
 <label class="col-sm-2 control-label" for="inputError">قیمت کارنسی به ریال</label> @else
 <label class="col-sm-2 control-label">قیمت کارنسی به ریال</label> @endif
<div class="col-sm-10"> 
<input type="text" name="cur_gh"   placeholder="قیمت کارنسی به ریال" class="form-control" @if ($admin->cur_gh) value="{{$admin->cur_gh}}"@else value="{{ old('cur_gh') }}" @endif > 
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


@stop

