
                  <form method="POST" action="" autocomplete="off">

	@if(count($errors))
			<div class="alert alert-danger" >
				<strong>اخطار!</strong> لطفا اطلاعات را به درستی وارد نمایید.
				<br/>
				<ul>
					@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif


<input class="form-control" type="text" name="name" placeholder="نام و نام خانوادگی" value="{{old('name')}}" > 
<input class="form-control" type="email" name="username" placeholder="ایمیل"  value="{{old('username')}}"   >
<input class="form-control" type="text" name="tell" placeholder="شماره همراه"  value="{{old('tell')}}"   >
 
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-button">
                                <button id="submit" type="submit" class="ibtn">عضویت</button>
                            </div>
                        </form>