
@extends('superadmin.layoutsuperadmin')

@section('title') 
<title>ویرایش سلکت باکس </title>
 
@stop

 
@section('superadmin')

		<!-- Main content -->
		<div class="main-content"  >
 <h1 class="page-title" >{{$listfirst->form_name}}</h1> 


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
		
		 
				  
						 
<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">   
 @if ($errors->has('name'))   
 <label class="col-sm-2 control-label" for="inputError">عنوان </label> @else
 <label class="col-sm-2 control-label">عنوان </label> @endif
<div class="col-sm-10"> 
<input type="text" name="name"  placeholder="عنوان " class="form-control"   value="{{$listfirst->list_name}}"    > 
</div> 
</div> 
<div class="line-dashed"></div>
 	
							 
		
@foreach($formselects as $formselect)
				  
						 
<div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">   
 @if ($errors->has('username'))   
 <label class="col-sm-2 control-label" for="inputError">{{$formselect->formselect_name}}</label> @else
 <label class="col-sm-2 control-label">{{$formselect->formselect_name}}</label> @endif
<div class="col-sm-8"> 
<input type="text" name="formselect_name[]"  placeholder="{{$formselect->formselect_name}}" class="form-control"   value="{{$formselect->formselect_name}}"   > 
</div> 
 <div class="col-sm-2"  > <a    href="{{env('APP_URL')}}/superadmin/viewsforms/editselectboxdelet/{{$formselect->formselect_id}}"        > <span class="label label-danger">حذف</span></a></div>	
</div> 
<div class="line-dashed"></div>
 	



@endforeach
 	
					 			





<script src="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/jquery.js"></script>
	
<script type="text/javascript">
$(document).ready(function(){
	var maxField = 20; //Input fields increment limitation
	var addButton = $('.add_buttonn'); //Add button selector
	var wrapper = $('.form-groupp'); //Input field wrapper
	var fieldHTML = '<span><div class="line-dashed"></div><div class="col-sm-5"><input type="text" name="field_name[]"  placeholder="نام گزینه" class="form-control"   value=""   ></div><a href="javascript:void(0);" class="remove_buttonn" title="Remove field"><img src="{{env('APP_URL')}}/build/servicepay/images/remove-icon.png"/></a></span>'; //New input field html 
	var x = 1; //Initial field counter is 1
	$(addButton).click(function(){ //Once add button is clicked
		if(x < maxField){ //Check maximum number of input fields
			x++; //Increment field counter
			$(wrapper).append(fieldHTML); // Add field html
		}
	});
	$(wrapper).on('click', '.remove_buttonn', function(e){ //Once remove button is clicked
		e.preventDefault();
		$(this).parent('span').remove(); //Remove field html
		x--; //Decrement field counter
	});
});
</script>


 
<br>

<div class="form-groupp">   
<div class="col-sm-5"> 
<input type="text" name="field_name[]"  placeholder="نام گزینه" class="form-control"   value=""   > 
</div>     
 
 
<div class="col-sm-2">
 <a href="javascript:void(0);" class="add_buttonn" title="Add field"><img src="{{env('APP_URL')}}/build/servicepay/images/add-icon.png"/></a>	 </div>
 <div class="line-dashed"></div><br>	
</div> 

			 			
							
							
							
                     <input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="line-dashed"></div>
							<div class="form-group"> 
								<div class="col-sm-offset-2 col-sm-10"> 
								 <button class="btn btn-success btn-block btn-flat">ویرایش</button>
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


