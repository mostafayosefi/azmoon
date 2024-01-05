
@extends('sup.layoutsuper')

@section('title')
<title> تنظیمات درگاه پرداخت </title>
@stop

 
@section('superadmin')
 

      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              تنظیمات درگاه پرداخت 
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{env('APP_URL')}}/superadmin/panel">پنل</a></li>
                <li class="breadcrumb-item active" aria-current="page">تنظیمات درگاه پرداخت </li>
              </ol>
            </nav>
          </div>
          <div class="row">
            <div class="col-md-3 grid-margin stretch-card">
            </div>
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">تنظیمات درگاه پرداخت</h4>
                  <form class="forms-sample" action="" method="post">

				 
					
@if(count($errors))
 

@foreach($errors->all() as $error)
<div class="breadcrumb bg-inverse-danger" >
<span  style="color: #000000"  >{{$error}}</span>  
</div> 
@endforeach
 
@endif  
		


<p>لطفا درگاه پرداخت  سیستم را انتخاب نمایید</p>

<div class="form-group">
          
  <div class="form-check">
    <label class="form-check-label">
      <input type="radio" class="form-check-input" name="getway_payment" id="optionsRadios1"
        value="sms" @if($admins->getway_payment=='zarinpal') checked @endif >
        زرین پال
    </label>
  </div>

  <div class="form-check">
    <label class="form-check-label">
      <input type="radio" class="form-check-input" name="getway_payment" id="optionsRadios2"  
        value="pas" @if($admins->getway_payment=='payping') checked @endif >
     پی پینگ
    </label>
  </div>


</div>











  
                    
							
                     <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    
                    <button type="submit" class="btn btn-primary mr-2">ویرایش</button> 
                  </form>
                </div>
              </div>
            </div>
            
            <div class="col-md-3 grid-margin stretch-card">
            
            </div>
            
            
            </div>
            </div> 
            </div> 


          
            @if(!empty(Session::get('statust')))
            <script src="{{env('APP_URL')}}/build/servicepay/firealert/components.js.download"></script> 
             
                <script>
                    $(document).ready(function () {
                                    Swal.fire({
                            text: '<?php echo Session::get('statust'); ?>',
                            type: 'success',
                            confirmButtonText: 'بستن'
            
                        });
                        
                    });
                </script>
            @endif
            

            @stop


