
@extends('sup.layoutsuper')

@section('title')
<title>مدیریت هزینه رزرو </title>
@stop

 
@section('superadmin')
 

      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
             مدیریت هزینه رزرو
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{env('APP_URL')}}/superadmin/settingrezervprice">پنل</a></li>
                <li class="breadcrumb-item active" aria-current="page">مدیریت هزینه رزرو</li>
              </ol>
            </nav>
          </div>
          <div class="row">
            <div class="col-md-3 grid-margin stretch-card">
            </div>
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">مدیریت هزینه رزرو</h4>
                  <form class="forms-sample" action="" method="post">

				 
					
@if(count($errors))
 

@foreach($errors->all() as $error)
<div class="breadcrumb bg-inverse-danger" >
<span  style="color: #000000"  >{{$error}}</span>  
</div> 
@endforeach
 
@endif  
		
 
		
		
 
 	  
 <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
  @if ($errors->has('price')) <label class="error mt-2 text-danger"  >هزینه رزرو به ریال</label> @else 
 <label >هزینه رزرو به ریال</label> @endif
 <input type="text" class="form-control"  name="price"  placeholder="هزینه رزرو به ریال"  @if ($admin->superadmin_rezerv) value="{{$admin->superadmin_rezerv}}"@else value="{{old('price')}}" @endif  >                
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


