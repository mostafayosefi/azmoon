@extends('servicepay.layoutservicepay')

@section('title')
<title>صفحه اصلی</title>
@stop
 
@section('superadmin')

        <section class="content-header">
            <h1>
           {{$lngmenu->lng_wpanel}}
            <small>{{$lngmenu->lng_wsuperadmin}}</small>
          </h1>
          <ol class="breadcrumb">
   			<li><a href="{{ url('/superadmin/panel') }}"><i class="fa fa-dashboard"></i>{{$lngmenu->lng_wpanel}}</a></li>
            <li><a href="{{ url('/superadmin/addagency') }}">{{$lngmenu->lng_waddajency}}</a></li>
            <li class="active">{{$lngmenu->lng_wreg}}</li>
          </ol>
        </section>
        
        <section class="content">
          <div class="row">
         <div class="col-md-3"></div>
         <div class="col-md-6">
          <div class="box box-warning">
                <div class="box-header with-border">
                  <h3 class="box-title">{{$lngmenu->lng_waddajency}}</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <form method="POST" action="" autocomplete="off">
                  
                  
                  	@if(count($errors))
			<div class="alert alert-danger">
				<strong>{{$lngmenu->lng_werror}}!</strong> {{$lngmenu->lng_werrornot}}
				<br/>
				<ul>
					@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
                  
                  
                  
                    
                    


                    <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
 @if ($errors->has('username'))                 
<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{{$lngmenu->lng_wusername}}</label>
@endif
<input type="text" class="form-control" id="username" name="username" placeholder="{{$lngmenu->lng_wusername}} "  value="{{ old('username') }}">
                    </div> 


                    <div class="form-group {{ $errors->has('userpassword') ? 'has-error' : '' }}">
 @if ($errors->has('userpassword'))                 
<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{{$lngmenu->lng_wpassword}}</label>
@endif
<input type="password" class="form-control" id="userpassword" name="userpassword" placeholder="{{$lngmenu->lng_wpassword}}"  value="{{ old('userpassword') }}">
                    </div>




                    <div class="form-group {{ $errors->has('userpassword') ? 'has-error' : '' }}">
 @if ($errors->has('userpassword'))                 
<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{{$lngmenu->lng_wpassword}}</label>
@endif
<input type="password" class="form-control" id="userpassword_confirmation" name="userpassword_confirmation" placeholder="{{$lngmenu->lng_wpassword}}"  value="{{ old('userpassword_confirmation') }}">
                    </div>


                
                
                     <input type="hidden" name="_token" value="{{ csrf_token() }}">
   					<div class="row">
       					<div class="col-xs-12">
       <button class="btn btn-primary btn-block btn-flat">{{$lngmenu->lng_wreg}}</button>
       
            </div> 
          </div>






                  </form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              	
              </div>
              <div class="col-md-3"></div>
       
          </div>
          </section>

@stop

    
