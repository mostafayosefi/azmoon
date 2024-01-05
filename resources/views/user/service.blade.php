

@extends('user.layoutuser')

@section('title')
<title>سرویس </title>
@stop

 
@section('superadmin')

		
		<!-- Main content -->
		<div class="main-content" >
			<h1 class="page-title" >{{$admin->ctrf_name}}</h1>


	<div class="row">
	 
			<div class="col-lg-12 animatedParent animateOnce z-index-47">
				 
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
		




				<div class="panel panel-default animated fadeInUp">
					 
	<div class="col-lg-6">	
					<div class="panel-body">
                   
 
 

<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">    
 <label class="control-label">نام و نام خانوادگی  </label> 
<input type="text" name="name" disabled=""   class="form-control" value="{{$user->user_name}}"  > 
</div> 
 

<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">    
 <label class="control-label">تلفن  </label> 
<input type="text" name="name" disabled=""   class="form-control" value="{{$user->user_tell}}"  > 
</div> 
 

<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">    
 <label class="control-label">ایمیل  </label> 
<input type="text" name="name" disabled=""   class="form-control" value="{{$user->user_email}}"  > 
</div> 
 

		  
 
							<div class="line-dashed"></div>


 <div class="form-group"> 
 <label class="control-label">توضیحات</label> 
 <textarea placeholder="توضیحات" name="des" class="form-control" rows="5"></textarea> 
 </div>


							<div class="form-group"> 
 <div class="checkbox"> <label> <input type="checkbox">قوانین سایت را پذیرفته ام</label> </div> 
								  
 
							</div>

				 
				
							
							
                     <input type="hidden" name="_token" value="{{ csrf_token() }}">
	 
						
					
					</div>
				</div>


					 
	<div class="col-lg-6">	
					<div class="panel-body">
                  

		 

<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">    
 <label class="control-label">نوع سرویس  </label> 
<input type="text" name="name" disabled=""   class="form-control" value="{{$admin->ctrf_name}}"  > 
</div> 
 

<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">    
 <label class="control-label">  قیمت سرویس ( {{$admin->cur_nem}} )</label> 
<input type="text" name="name" disabled=""   class="form-control" value="{{$admin->ctrf_pay}} "  > 
</div> 
 
<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">    
 <label class="control-label"> قیمت واحد ارز ( ريال )</label> 
<input type="text" name="name" disabled=""   class="form-control" value="{{$admin->cur_gh}}"  > 
</div> 
 
 
<div class="form-group {{ $errors->has('paygh') ? 'has-error' : '' }}">    
 <label class="control-label"> قیمت سرویس به ریال </label> 
<input type="text" name="paygh" disabled=""   class="form-control" value="{{$admin->ctrf_pay*$admin->cur_gh}}"  > 
</div> 
 
 		
			
				
						
					</div>
				</div>
				
						<div class="form-group"> 
								<div class="col-sm-offset-2 col-sm-10"> 
								       <button class="btn btn-success btn-block btn-flat">پرداخت</button>
								</div> 
							</div>
				
			</div> 
					</form>
			</div> 
		</div>
 
 
		
	  </div>
	  <!-- /main content -->




@stop


