
@extends('superadmin.layoutsuperadmin')

@section('title')
<title>مدیریت نمایش صفحه اصلی </title>
@stop

 
@section('superadmin')

		
		<!-- Main content -->
		<div class="main-content" >
			<h1 class="page-title" >مدیریت نمایش صفحه اصلی</h1>


	<div class="row">
	 
	
			<div class="col-lg-12 animatedParent animateOnce z-index-47">
				<div class="panel panel-default animated fadeInUp">
				 
					
					<div class="panel-body">
					      <form   method="POST" action=""  >
                  
 
					 
					
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
		
		  
								<div class="form-group">
									<div class="col-md-6">
										<label>هدر سایت</label>
 <div class="checkbox checkbox-replace checkbox-primary">
 <input name="ind_hregus" type="checkbox"  value="1"  @if($admin->ind_hregus == '1')  checked  @endif>
 <label for="checkbox1" >ثبت نام</label>
 </div>
 
 <div class="checkbox checkbox-replace checkbox-primary">
 <input  name="ind_hlogus" type="checkbox"  value="1"  @if($admin->ind_hlogus == '1')  checked  @endif>
 <label for="checkbox1" >ورودکاربر</label>
 </div>
 
 <div class="checkbox checkbox-replace checkbox-primary">
 <input  name="ind_hpage" type="checkbox"  value="1"  @if($admin->ind_hpage == '1')  checked  @endif>
 <label for="checkbox1" >نمایش صفحات سایت</label>
 </div>
 
 <div class="checkbox checkbox-replace checkbox-primary">
 <input  name="ind_hnew" type="checkbox"  value="1"  @if($admin->ind_hnew == '1')  checked  @endif>
 <label for="checkbox1" >نمایش اخبار</label>
 </div>
 
 <div class="checkbox checkbox-replace checkbox-primary">
 <input  name="ind_hfaq" type="checkbox"  value="1"  @if($admin->ind_hfaq == '1')  checked  @endif>
 <label for="checkbox1" >نمایش سوالات متداول</label>
 </div>
 
 </div>
 
 
 
									<div class="col-md-6">
										<label>فوتر سایت</label>

 <div class="checkbox checkbox-replace checkbox-primary">
 <input  name="ind_freg" type="checkbox"  value="1"  @if($admin->ind_freg == '1')  checked  @endif>  
 <label for="checkbox1" >ثبت نام</label>
 </div>
 
 <div class="checkbox checkbox-replace checkbox-primary">
 <input  name="ind_flog" type="checkbox"  value="1"  @if($admin->ind_flog == '1')  checked  @endif>
 <label for="checkbox1" >ورودکاربر</label>
 </div>
 
 <div class="checkbox checkbox-replace checkbox-primary">
 <input  name="ind_fpage" type="checkbox"  value="1"  @if($admin->ind_fpage == '1')  checked  @endif>
 <label for="checkbox1" >نمایش صفحات سایت</label> 
 </div>
 
 <div class="checkbox checkbox-replace checkbox-primary">
 <input  name="ind_fnew" type="checkbox"  value="1"  @if($admin->ind_fnew == '1')  checked  @endif>
 <label for="checkbox1" >اخبار</label> 
 </div>
 
 <div class="checkbox checkbox-replace checkbox-primary">
 <input  name="ind_ffaq" type="checkbox"  value="1"  @if($admin->ind_ffaq == '1')  checked  @endif>
 <label for="checkbox1" >نمایش سوالات متداول</label> 
 </div>
 
 
										</div>
										
										
										
										
										
										
										
										
										</div>
										
 		 
 
 			
							
							
							
                     <input type="hidden" name="_token" value="{{ csrf_token() }}">
							   
								<div class="col-md-6"> 	</div>
								<div class="col-md-6"> 
								       <button class="btn btn-primary btn-block btn-flat">ویرایش</button>
								</div>  
						</form>
					</div>
				</div>
			</div> 
		</div>
 
 
		
	  </div>
	  <!-- /main content -->

@stop


