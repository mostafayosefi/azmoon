
@extends('sup.layoutsuper')

@section('title')
<title>ثبت کاربر </title>
@stop

 
@section('superadmin')
 

      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              ثبت ماک
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{env('APP_URL')}}/superadmin/addmak">پنل</a></li>
                <li class="breadcrumb-item active" aria-current="page">ثبت ماک</li>
              </ol>
            </nav>
          </div>
          <div class="row">
            <div class="col-md-3 grid-margin stretch-card">
            </div>
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">ثبت ماک</h4>
                  <form class="forms-sample" action="" method="post">

				 
					
@if(count($errors))
 

@foreach($errors->all() as $error)
<div class="breadcrumb bg-inverse-danger" >
<span  style="color: #000000"  >{{$error}}</span>  
</div> 
@endforeach
 
@endif  
		
 
		
		

 <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
  @if ($errors->has('name')) <label class="error mt-2 text-danger"  >نام ماک</label> @else 
 <label >نام ماک</label> @endif
 <input type="text" class="form-control"  name="name"  placeholder="نام ماک"   value="{{ old('name') }}"   >                
 </div>
 
 	 
		

 <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
  @if ($errors->has('price')) <label class="error mt-2 text-danger"  >قیمت ماک به ریال</label> @else 
 <label >قیمت ماک به ریال</label> @endif
 <input type="text" class="form-control"  name="price"  placeholder="قیمت ماک به ریال"   value="{{ old('price') }}"   >                
 </div>
 
 	 
                    
							
                     <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    
                    <button type="submit" class="btn btn-primary mr-2">ثبت</button> 
                  </form>
                </div>
              </div>
            </div>
            
            <div class="col-md-3 grid-margin stretch-card">
            
            </div>
            
            
            </div>
            </div> 
            </div> 
@stop


