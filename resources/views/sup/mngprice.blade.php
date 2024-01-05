
@extends('sup.layoutsuper')

@section('title')
<title>مدیریت هزینه ها</title>
@stop

 
@section('superadmin')


      <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
         مشاهده فرمها
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{env('APP_URL')}}/superadmin/panel">پنل</a></li>
                <li class="breadcrumb-item active" aria-current="page">مشاهده فرمها</li>
              </ol>
            </nav>
          </div>
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">لیست فرمها</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
     				    <th>ردیف</th> 
                        <th>نام فرم</th>
                        <th>هزینه به ریال</th> 
                        <th>وضعیت</th> 
                        </tr>
                      </thead>
                      <tbody>
       

 <?php  $i=1;  ?>                   
@foreach ($admins as $admin)
 
 
@if(($admin->form_linkname!='hotelscom')&&($admin->form_linkname!='airbnb'))  
 										<tr>
					    <td>{{$i++}} </td>
                        <td>{{$admin->form_name}} </td>  
                        <td>{{$admin->form_price}} ريال</td>   
@if($admin->form_active == '1')                       
<td> 
 
 	 
 <button type="button"  class="btn btn-success btn-lg" data-toggle="modal" data-target="#exampleModal-{{$admin->form_id}}">فعال  <i class="far fa-check-square btn-icon-prepend"></i></button>
                

 	 
 	 
 </td>
@elseif($admin->form_active != '1')
<td>


 <button type="button"  class="btn btn-warning btn-lg" data-toggle="modal" data-target="#exampleModal-{{$admin->form_id}}">غیرفعال   <i class="fa fa-exclamation-triangle btn-icon-prepend"></i> </button>
                


</td>
@endif

 
										</tr>
 @endif
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

 <div class="modal fade" id="exampleModal-{{$admin->form_id}}" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel-{{$admin->form_id}}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                      
                      <form method="post" action="{{env('APP_URL')}}/superadmin/mngprice/{{$admin->form_rnd}}">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel-{{$admin->form_id}}">{{$admin->form_name}}</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body"> 
                          
 <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
  @if ($errors->has('name')) <label class="error mt-2 text-danger"  >هزینه به ریال</label> @else 
 <label >هزینه به ریال</label> @endif
 <input type="text" class="form-control" name="name"      value="{{$admin->form_price}}"   placeholder="{{$admin->form_price}} ريال"     required  pattern="\d+"   minlength="2"       >                
 </div>
                          
                          
                        </div>
                        <div class="modal-footer">
                     <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          <button type="submit" class="btn btn-success">تایید</button>
                          <button type="button" class="btn btn-light" data-dismiss="modal">لغو</button>
                        </div>
                        </form>
                        
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


