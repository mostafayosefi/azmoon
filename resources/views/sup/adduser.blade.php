
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
              ثبت کاربر
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{env('APP_URL')}}/superadmin/panel">پنل</a></li>
                <li class="breadcrumb-item active" aria-current="page">ثبت کاربر</li>
              </ol>
            </nav>
          </div>
          <div class="row">
            <div class="col-md-3 grid-margin stretch-card">
            </div>
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">ثبت کاربر</h4>
                  <form class="forms-sample" action="" method="post">

				 
					
@if(count($errors))
 

@foreach($errors->all() as $error)
<div class="breadcrumb bg-inverse-danger" >
<span  style="color: #000000"  >{{$error}}</span>  
</div> 
@endforeach
 
@endif  
		
 
		
		

 <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
  @if ($errors->has('username')) <label class="error mt-2 text-danger"  >نام کاربری</label> @else 
 <label >نام کاربری</label> @endif
 <input type="text" class="form-control"  name="username"  placeholder="نام کاربری"   value="{{ old('username') }}"   >                
 </div>
 
 	
		

 <div class="form-group {{ $errors->has('userpassword') ? 'has-error' : '' }}">
  @if ($errors->has('userpassword')) <label class="error mt-2 text-danger"  >رمزعبور</label> @else 
 <label >رمزعبور</label> @endif
 <input type="password" class="form-control"  name="userpassword"  placeholder="رمزعبور"  value="{{ old('userpassword') }}"  >                   
 </div>
 

 <div class="form-group {{ $errors->has('userpassword') ? 'has-error' : '' }}">
  @if ($errors->has('userpassword')) <label class="error mt-2 text-danger"  >تکرار رمزعبور</label> @else 
 <label >تکرار رمزعبور</label> @endif
 <input type="password" class="form-control"  name="userpassword_confirmation"  placeholder="تکرار رمزعبور"  value="{{ old('userpassword_confirmation') }}"  >                   
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


