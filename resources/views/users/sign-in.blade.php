
@extends('layoutlogin')

@section('title')
<title>{{$lngmenu->lng_wuser}}</title>
@stop

@section('contentsignin')



    <div class="login-box">
      <div class="login-logo">
    
      </div><!-- /.login-logo -->
      


      <div class="login-box-body">
            
  <div style="text-align: center;" class="alert alert-info">
            <img src="{{env('APP_URL')}}/build/style/dist/img/Teacher.png" alt="{{$lngmenu->lng_wuser}}" title="{{$lngmenu->lng_wuser}}" />
            <br />
           {{$lngmenu->lng_wuser}}
            </div>

      
        <p class="login-box-msg">{{$lngmenu->lng_wuserandpas}}</p>
        
        
        
<form method="POST" action="{{env('APP_URL')}}/user/sign-in" autocomplete="off">

      @if(!empty(Session::get('statust')))
      <div class="alert alert-danger">
				<strong>{{$lngmenu->lng_werror}}!</strong>
				<ul><li>{{ Session::get('statust')}}</li></ul>
				</div>
        @endif
      
      
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
      
      
      
       



          <div class="form-group has-feedback {{ $errors->has('firstname') ? 'has-error' : '' }}">
            <input type="text"  id="firstname" name="firstname" class="form-control" placeholder="{{$lngmenu->lng_wusername}}"  value="{{ old('firstname') }}">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback {{ $errors->has('lastname') ? 'has-error' : '' }}">
            <input type="password" id="lastname" name="lastname" class="form-control" placeholder="{{$lngmenu->lng_wpassword}}" value="{{ old('lastname') }}">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          
          
          <div class="row">
       
       <div class="col-xs-12">
       <button class="btn btn-primary btn-block btn-flat">{{$lngmenu->lng_wlogin}}</button>
       
            </div><!-- /.col -->
          </div>
          </br>
        			 <span id="msgbox" style="display:none; background:#f8f3a4;  font-size:14px;"> 
			                
               </span>
        </form>


 <!--
        <div class="social-auth-links text-center">
 <div class="col-xs-9">
          <a href="forgetpass.php" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-angellist"></i>فراموشی رمزعبور</a> </div> <div class="col-xs-9">
<a href="index.php" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-archive"></i> بازگشت به صفحه اصلی</a>
        </div> 
        <div class="col-xs-9">
<a href="register.php" class="btn btn-block btn-social btn-adn btn-flat"><i class="fa fa-list"></i>ثبت نام در سامانه</a>
        </div>
        </div>  -->

      </div>
      
      
      
      
      
      
      <!-- /.login-box-body -->
</div>


</body>



@stop
