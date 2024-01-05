
@extends('cust.layoutuser')

@section('title')
<title>ثبت تیکت </title>
@stop

 
@section('superadmin')
 

      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              ثبت تیکت
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{env('APP_URL')}}/superadmin/panel">پنل</a></li>
                <li class="breadcrumb-item active" aria-current="page">ثبت تیکت</li>
              </ol>
            </nav>
          </div>
          <div class="row">
            <div class="col-md-3 grid-margin stretch-card">
            </div>
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">ثبت تیکت</h4>
                  <form class="forms-sample" action="" method="post">

				 
					
@if(count($errors))
 

@foreach($errors->all() as $error)
<div class="breadcrumb bg-inverse-danger" >
<span  style="color: #000000"  >{{$error}}</span>  
</div> 
@endforeach
 
@endif  
		
 
		
		

 <div class="form-group {{ $errors->has('tit') ? 'has-error' : '' }}">
  @if ($errors->has('tit')) <label class="error mt-2 text-danger"  >موضوع</label> @else 
 <label >موضوع</label> @endif
 <input type="text" class="form-control"  name="tit"  placeholder="موضوع"   value="{{ old('tit') }}"   >                
 </div>
 
 	
		<div class="form-group {{ $errors->has('des') ? 'has-error' : '' }}"> 
 <label class="control-label">متن تیکت</label> 
 <textarea placeholder="لطفا پیام خود را تایپ نمایید" name="des" class="form-control" rows="5"></textarea> 
 </div>

 
                    
							
                     <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    
                    <button type="submit" class="btn btn-primary mr-2">ثبت تیکت</button> 
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


