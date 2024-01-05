
@extends('superadmin.layoutsuperadmin')

@section('title')
<title>ثبت کاربر </title>
@stop

 
@section('superadmin')

		
		<!-- Main content -->
		<div class="main-content"  >
			<h1 class="page-title" >ثبت کاربر</h1>


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

<div class="line-dashed"></div>
@endif  
		
		 
				  
						 
<div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">   
 @if ($errors->has('username'))   
 <label class="col-sm-2 control-label" for="inputError">نام کاربری</label> @else
 <label class="col-sm-2 control-label">نام کاربری</label> @endif
<div class="col-sm-10"> 
<input type="text" name="username"  placeholder="نام کاربری" class="form-control"   value="{{ old('username') }}"   > 
</div> 
</div> 
<div class="line-dashed"></div>
 	
							 
				  
						 
<div class="form-group {{ $errors->has('userpassword') ? 'has-error' : '' }}">   
 @if ($errors->has('userpassword'))   
 <label class="col-sm-2 control-label" for="inputError">رمزعبور</label> @else
 <label class="col-sm-2 control-label">رمزعبور</label> @endif
<div class="col-sm-10"> 
<input type="password" name="userpassword"  placeholder="رمزعبور" class="form-control"   value="{{ old('userpassword') }}"   > 
</div> 
</div> 
<div class="line-dashed"></div>
 	
						 
<div class="form-group {{ $errors->has('userpassword') ? 'has-error' : '' }}">   
 @if ($errors->has('userpassword'))   
 <label class="col-sm-2 control-label" for="inputError">تکرار رمزعبور</label> @else
 <label class="col-sm-2 control-label">تکرار رمزعبور</label> @endif
<div class="col-sm-10"> 
<input type="password" name="userpassword_confirmation"  placeholder="تکرار رمزعبور" class="form-control"   value="{{ old('userpassword_confirmation') }}"   > 
</div> 
</div> 
<div class="line-dashed"></div>
 	
							 
							
							
							
							
							
                     <input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="line-dashed"></div>
							<div class="form-group"> 
								<div class="col-sm-offset-2 col-sm-10"> 
								       <button class="btn btn-success btn-block btn-flat">ثبت کاربر</button>
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


