

@extends('user.layoutuser')

@section('title')
<title>پرداخت ارزی </title>
@stop

 
@section('superadmin')

<script> 
    function calculate() {
        var myBox1 = document.getElementById('box1').value; 
        var myBox2 = document.getElementById('box2').value;
        var myBox3 = document.getElementById('box3').value;
        var myBox4 = document.getElementById('box4').value;
        var result = document.getElementById('result'); 
        var resultt = document.getElementById('resultt'); 
        var resulttt = document.getElementById('resulttt');  
        var result5 = document.getElementById('resul5'); 
        

        
var myResult5 = ((myBox1 / (100/myBox2))+ parseFloat(document.getElementById('box3').value)) * myBox4  ;  
document.getElementById('result5').value = myResult5;


         
var myResult = myBox1 / (100/myBox2);
        
document.getElementById('result').value = myResult;


var myResultt = (parseFloat(document.getElementById('box1').value) + (myBox1 / (100/myBox2))+ parseFloat(document.getElementById('box3').value)) * myBox4  ; 
document.getElementById('resultt').value = myResultt; 



var myResulttt =  myBox1 * myBox4;
document.getElementById('resulttt').value = myResulttt; 

  
    } 
    
</script>
		
				
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
                   
 

		 

<div class="form-group {{ $errors->has('namelastname') ? 'has-error' : '' }}">   
 @if ($errors->has('namelastname'))   
 <label class="control-label" for="inputError">نام و نام خانوادگی گیرنده</label> @else
 <label class="control-label">نام و نام خانوادگی گیرنده</label> @endif
<input type="text" name="namelastname"    class="form-control"    value="{{ old('namelastname') }}"  > 
</div>  
 

	  		
<div class="form-group {{ $errors->has('pay') ? 'has-error' : '' }}">   
 @if ($errors->has('pay'))   
 <label class="control-label" for="inputError">مبلغ درخواستی ({{$admin->cur_name}})</label> @else
 <label class="control-label">مبلغ درخواستی به {{$admin->cur_name}} </label> @endif
<input id="box1" type="text" oninput="calculate();" name="pay"    class="form-control"    value="{{ old('pay') }}"  > 
</div>  
 
 
 				<div class="line-dashed"></div>
							<div class="form-group"> 
							 	<label class="control-label">انتخاب کشور مقصد</label> 
 
									<select  class="select2-placeholer form-control"  name="country"> 
									<option value=""  >انتخاب کنید</option>  
									@foreach($countrys as $country )
										<option value="{{$country->country_name}}">{{$country->country_name}}</option>  
										@endforeach
									</select>
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
                  

<input  id="box2" type="hidden" oninput="calculate();"   value="{{$admin->ctrf_varebfee}}"  >  
		 

<div class="form-group {{ $errors->has('fixfee') ? 'has-error' : '' }}">    
 <label class="control-label">کارمزد ثابت {{$admin->cur_name}} </label> 
<input   id="box3" type="text" oninput="calculate();"    name="fixfee" disabled=""   class="form-control" value="{{$admin->ctrf_fixfee}}"  > 
</div> 
 
 
 
<input  id="box4" type="hidden" oninput="calculate();"   value="{{$admin->cur_gh}}"  >  
 

<div class="form-group {{ $errors->has('varebfee') ? 'has-error' : '' }}">    
 <label class="control-label">کارمزد متغیر  {{$admin->cur_name}}  </label> 
<input   type="text" id="result"  oninput="calculate();"   name="varebfee" disabled=""   class="form-control" value="0"  > 
</div> 
 
<div class="form-group {{ $errors->has('finalfee') ? 'has-error' : '' }}">    
 <label class="control-label">کارمزد نهایی (ريال)</label> 
<input  type="text" id="result5"  oninput="calculate();"  name="finalfee" disabled=""   class="form-control"  > 
</div> 
 
 
			

<div class="form-group {{ $errors->has('payservirr') ? 'has-error' : '' }}">   
 @if ($errors->has('payservirr'))   
 <label class="control-label" for="inputError">قیمت حواله {{$admin->ctrf_name}} (ريال)</label> @else
 <label class="control-label">قیمت حواله {{$admin->ctrf_name}} (ريال)</label> @endif 
<input type="text"  id="resulttt"  oninput="calculate();"  name="payservirr" disabled=""   class="form-control" value="0"  > 
</div> 
 	
				

<div class="form-group {{ $errors->has('payfinalirr') ? 'has-error' : '' }}">   
 @if ($errors->has('payfinalirr'))   
 <label class="control-label" for="inputError">قیمت نهایی (ريال)</label> @else
 <label class="control-label">قیمت نهایی (ريال)</label> @endif 
<input type="text"  id="resultt"  oninput="calculate();"  name="payfinalirr" disabled=""   class="form-control" value="0"  > 
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

  
