
@extends('sup.layoutsuper')

@section('title')
<title>مشاهده تخفیف ها</title>
@stop

 
@section('superadmin')


      <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
        مشاهده تخفیف ها
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{env('APP_URL')}}/superadmin/panel">پنل</a></li>
                <li class="breadcrumb-item active" aria-current="page">مشاهده تخفیف ها</li>
              </ol>
            </nav>
          </div>
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">لیست تخفیف ها</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
     				    <th>ردیف</th> 
                        <th>کد تخفیف</th>
                        <th>هزینه تخفیف به ریال</th> 
                        <th>وضعیت</th>  
                        <th>حذف</th> 
                        </tr>
                      </thead>
                      <tbody>
       

 <?php  $i=1;  ?>                   
@foreach ($admins as $admin)
 
 										<tr>
					    <td>{{$i++}} </td>
                        <td>{{$admin->discount_code}} </td>  
                        <td>{{$admin->discount_price}} ريال</td>   
@if($admin->discount_active == '1')                       
<td> 
 
 	 
 <button type="button"  class="btn btn-success btn-lg" data-toggle="modal" data-target="#exampleModal-{{$admin->discount_id}}">فعال  <i class="far fa-check-square btn-icon-prepend"></i></button>
                

 	 
 	 
 </td>
@elseif($admin->discount_active != '1')
<td>


 <button type="button"  class="btn btn-warning btn-lg" data-toggle="modal" data-target="#exampleModal-{{$admin->discount_id}}">غیرفعال   <i class="fa fa-exclamation-triangle btn-icon-prepend"></i> </button>
                


</td>
@endif


<td>


 <button type="button"  class="btn btn-danger btn-lg" data-toggle="modal" data-target="#exampleModaltrash-{{$admin->discount_id}}">حذف   <i class="fa fa-trash btn-icon-prepend"></i> </button>
                


</td>
 
										</tr>
 
 @endforeach
                        
               
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div> 
        </div>
      </div>


      
@foreach ($admins as $admin) 

 <div class="modal fade" id="exampleModal-{{$admin->discount_id}}" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel-{{$admin->discount_id}}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                      
 <form method="post" action="{{env('APP_URL')}}/superadmin/mngdiscount/{{$admin->discount_id}}">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel-{{$admin->discount_id}}">{{$admin->discount_code}}</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body"> 
                        
@if($admin->discount_active=='0')
 <p> آیا می خواهید کدتخفیف را برای سیستم فعال کنید؟ 
 <a href="{{env('APP_URL')}}/superadmin/mngdiscount/{{$admin->discount_active}}/{{$admin->discount_id}}"  >
 	 <button type="button" class="btn btn-success btn-sm">   
 	  فعال کردن <i class="far fa-check-square btn-icon-prepend"></i>
 	 </button>
 </a>    
                           </p><br>  
                           @else                     

 <p> آیا می خواهید کدتخفیف را برای سیستم غیرفعال کنید؟ 
 <a href="{{env('APP_URL')}}/superadmin/mngdiscount/{{$admin->discount_active}}/{{$admin->discount_id}}"  >
 	 <button type="button" class="btn btn-warning btn-sm">   
 	  غیرفعال کردن <i class="far fa-check-square btn-icon-prepend"></i>
 	 </button>
 </a>
                           </p><br>   
                           @endif
                        <hr>

@foreach($listdiscounts as $listdiscount)
@if($listdiscount->listdis_iddisc == $admin->discount_id)
<p>{{$listdiscount->form_name}}</p>
@endif
@endforeach
                        
                        
                        <hr>
                          
 <div class="form-group {{ $errors->has('code') ? 'has-error' : '' }}">
  @if ($errors->has('code')) <label class="error mt-2 text-danger"  >کد تخفیف</label> @else 
 <label >کد تخفیف</label> @endif
 <input type="text" class="form-control" name="code"      value="{{$admin->discount_code}}"   placeholder=" کد تخفیف "     required    minlength="2"       >                
 </div> 
 
                          
 <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
  @if ($errors->has('price')) <label class="error mt-2 text-danger"  >هزینه به ریال</label> @else 
 <label >هزینه به ریال</label> @endif
 <input type="text" class="form-control" name="price"      value="{{$admin->discount_price}}"   placeholder="{{$admin->discount_price}} ريال"     required  pattern="\d+"   minlength="2"       >                
 </div>
                          
                          
                        </div>
                        <div class="modal-footer">
                     <input type="hidden" name="_token" value="{{ csrf_token() }}">
 <button type="submit" class="btn btn-primary">ویرایش اطلاعات</button>
 <button type="button" class="btn btn-light" data-dismiss="modal">لغو</button>
                        </div>
                        </form>
                        
                      </div>
                    </div>
                  </div>
             
 	 

 <div class="modal fade" id="exampleModaltrash-{{$admin->discount_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModaltrash-{{$admin->discount_id}}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                       
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModaltrash-{{$admin->discount_id}}">{{$admin->discount_code}}</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body"> 
                          
 <p>آیا مایل به حذف کد تخفیف "{{$admin->discount_code}}" از سیستم هستید؟    
                          

                           </p><br> 

                 
                          
                        </div>
                        <div class="modal-footer">

 <a href="discount/delet/{{$admin->discount_id}}"  >
 	 <button type="button" class="btn btn-danger btn-sm">   
 حذف	 <i class="fa fa-trash btn-icon-append"></i>
 	 </button>            
 </a>

<button type="button" class="btn btn-light" data-dismiss="modal">لغو</button>

                        </div> 
                        
                      </div>
                    </div>
                  </div>
             
 	 

 
@endforeach

          
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


