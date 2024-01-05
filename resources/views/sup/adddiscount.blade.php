
@extends('sup.layoutsuper')

@section('title')
<title>ثبت کد تخفیف </title>
@stop

 
@section('superadmin')
 

      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
             ثبت کد تخفیف
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{env('APP_URL')}}/superadmin/panel">پنل</a></li>
                <li class="breadcrumb-item active" aria-current="page">ثبت کد تخفیف</li>
              </ol>
            </nav>
          </div>
          <div class="row">
            <div class="col-md-3 grid-margin stretch-card">
            </div>
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">ثبت کد تخفیف</h4>
                  <form class="forms-sample" action="" method="post">

				 
					
@if(count($errors))
 

@foreach($errors->all() as $error)
<div class="breadcrumb bg-inverse-danger" >
<span  style="color: #000000"  >{{$error}}</span>  
</div> 
@endforeach
 
@endif  
		

 <div class="form-group"  {{ $errors->has('formname') ? 'has-error' : '' }}>
   @if ($errors->has('formname')) 
 <label  class="error mt-2 text-danger" >یک یا چند مورد از خدمات را جهت اعمال کد تخفیف انتخاب نمایید</label> @else
 <label >یک یا چند مورد از خدمات را جهت اعمال کد تخفیف انتخاب نمایید</label> @endif
 <select name="formname[]" class="js-example-basic-multiple w-100" multiple="multiple" dir="rtl">
 @foreach($forms as $form)
 <option value="{{$form->form_rnd}}"  >{{$form->form_name}}</option>
 @endforeach
 
 
 <option value="909090"  >ماک حضوری</option>
 
 </select>
 </div>
		
		

 <div class="form-group {{ $errors->has('code') ? 'has-error' : '' }}">
  @if ($errors->has('code')) <label class="error mt-2 text-danger"  >کد تخفیف</label> @else 
 <label >کد تخفیف</label> @endif
 <input type="text" class="form-control"  name="code"  placeholder="کد تخفیف"   value="{{ old('code') }}"   >                
 </div>
 
 			

 <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
  @if ($errors->has('price')) <label class="error mt-2 text-danger"  >مبلغ تخفیف به ریال</label> @else 
 <label >مبلغ تخفیف به ریال</label> @endif
 <input type="text" class="form-control"  name="price"  placeholder="مبلغ تخفیف به ریال"   value="{{ old('price') }}"   >                
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


