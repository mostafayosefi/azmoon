
@extends('sup.layoutsuper')

@section('title')
<title>{{$form->form_name}} </title>
@stop

 
@section('superadmin')


      <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
         {{$form->form_name}}
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
 <li class="breadcrumb-item"><a href="{{env('APP_URL')}}/user/panel">پنل</a></li>
 <li class="breadcrumb-item"><a href="{{env('APP_URL')}}/user/viewsonlineshops">مشاهده درخواست های من</a></li>
 <li class="breadcrumb-item active" aria-current="page">{{$form->form_name}}</li>
              </ol>
            </nav>
          </div>
  
  
            
  <div class="row">
          
          
          
          
            <div class="col-md-6 grid-margin grid-margin-md-0 stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">مشخصات کاربر</h4>
                  <div class="preview-list">
                  
                  
                  

<div class="preview-item border-bottom px-0">

<div class="preview-thumbnail"> <i class="fa fa-user text-info ml-2 mt-1 float-right"></i> </div>

<div class="preview-item-content d-flex flex-grow">
<div class="flex-grow"><h6 class="preview-subject"><span class="float-right">   نام و نام خانوادگی کاربر ثبت کننده </span>
<span class="float-left small"> <span class="text-muted pl-3">{{$myrequest->user_name}}</span> </span> </h6> 
</div>
</div>
</div>
                
                        
                  

                
       
 @foreach($admins as $admin)
 

<div class="preview-item border-bottom px-0">

<div class="preview-thumbnail"> <i class="fa fa-check-square text-info ml-2 mt-1 float-right"></i> </div>

<div class="preview-item-content d-flex flex-grow">
<div class="flex-grow"><h6 class="preview-subject"><span class="float-right">   {{$admin->list_name}} </span>




<span class="float-left small"> <span class="text-muted pl-3">
  
  @foreach($lists as $list) @if($admin->list_chk==$list->list_chk)  
 @if($list->list_typ=='4')
 <a href="{{env('APP_URL')}}/public/images/{{$list->list_name}}" >مشاهده فایل</a><br>
 <img class="avatar-130 img-circle" src="{{env('APP_URL')}}/public/images/{{$list->list_name}}" alt="user image">
 @elseif($list->list_typ=='8')

@foreach ($formselects as $formselect) 
@if($formselect->formselect_id==$list->list_name)   
 {{$formselect->formselect_name}} 
 
 @endif
@endforeach 
 @elseif($list->list_typ=='9')

@foreach ($reqchecks as $formselect) 
 @if($list->list_id==$formselect->rchk_listid)  
 
 {{$formselect->formcheckbox_name}} 
 <br>
 @endif
@endforeach 

 @else 
 {{$list->list_name}} 
 @endif
 
 @endif @endforeach
	
</span> </span> 

</h6> 
</div>
</div>
</div>
 
 
  
	
 @endforeach
 
      
      
                

<div class="preview-item border-bottom px-0">

<div class="preview-thumbnail"> <i class="fa fa-calendar text-info ml-2 mt-1 float-right"></i> </div>

<div class="preview-item-content d-flex flex-grow">
<div class="flex-grow"><h6 class="preview-subject"><span class="float-right"> تاریخ درخواست  </span>
<span class="float-left small"> <span class="text-muted pl-3">{{jDate::forge($reqs->req_date)->format('Y/m/d ساعت H:i a')}}</span> </span> </h6> 
</div>
</div>
</div>
         
      
                
@if(($reqs->form_linkname=='hotelscom')||($reqs->form_linkname=='airbnb'))  
   
<div class="preview-item border-bottom px-0">

<div class="preview-thumbnail"> <i class="fa fa-credit-card text-info ml-2 mt-1 float-right"></i> </div>

<div class="preview-item-content d-flex flex-grow">
<div class="flex-grow"><h6 class="preview-subject"><span class="float-right"> مبلغ نهایی قابل پرداخت  </span>
<span class="float-left small"> <span class="text-muted pl-3">{{$reqs->req_price}} ريال</span> </span> </h6> 
</div>
</div>
</div>

@endif
         
      
      
                

<div class="preview-item border-bottom px-0">

<div class="preview-thumbnail"> <i class="fa fa-calendar text-info ml-2 mt-1 float-right"></i> </div>

<div class="preview-item-content d-flex flex-grow">
<div class="flex-grow"><h6 class="preview-subject"><span class="float-right"> وضعیت پرداخت  </span>
<span class="float-left small"> <span class="text-muted pl-3">
	
	@if($reqs->req_flg == '1')                       
<td><a href="#" > 
	 <button type="button" class="btn btn-success btn-sm">  پرداخت شده 
 	 <i class="far fa-check-square btn-icon-prepend"></i>
 	 </button>
</a></td>
@elseif($reqs->req_flg != '1')
<td><a href="#"   >
	
 <button type="button" class="btn btn-warning btn-sm">  منتظر پرداخت 
 	 <i class="fa fa-exclamation-triangle btn-icon-prepend"></i> 
 </button>
	
</a></td>
@endif
	
</span> </span> </h6> 
</div>
</div>
</div>
         
         
         

 
      
      
                
       			 </div>
     			 </div>
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


