
@extends('sup.layoutsuper')

@section('title')
<title>مشاهده ماک ها </title>
@stop

 
@section('superadmin')


      <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
            مشاهده ماک ها
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{env('APP_URL')}}/superadmin/panel">پنل</a></li>
                <li class="breadcrumb-item active" aria-current="page">مشاهده ماک ها</li>
              </ol>
            </nav>
          </div>
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">لیست ماک ها</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                      
     				    <th>ردیف</th> 
                        <th>نام ماک</th>
                        <th>قیمت به ریال</th>
                        <th>وضعیت</th>
                        <th>حذف</th> 
                        </tr>
                      </thead>
                      <tbody>
       

 <?php  $i=1;  ?>                   
@foreach ($admins as $admin)
 
 										<tr>
					 <td>{{$i++}} </td>
                        <td>{{$admin->mak_name}} </td>
                        <td>{{$admin->mak_price}} ريال </td> 
                       

<td>
	 	 
 <button type="button"  class="btn btn-success btn-sm" data-toggle="modal" data-target="#exampleModal-{{$admin->mak_id}}">فعال  <i class="far fa-check-square btn-icon-prepend"></i></button>
    
</td>

 <td><a href="viewsmaks/delet/{{$admin->mak_id}}"  >
 	 <button type="button" class="btn btn-danger btn-sm">   
 	 <i class="fa fa-trash btn-icon-append"></i>
 	 </button>
                         
                       
 </a></td>
 
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

 <div class="modal fade" id="exampleModal-{{$admin->mak_id}}" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel-{{$admin->mak_id}}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                      
                      <form method="post" action="{{env('APP_URL')}}/superadmin/viewsmaks/{{$admin->mak_id}}">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel-{{$admin->mak_id}}">{{$admin->mak_name}}</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body"> 
                          
 <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
  @if ($errors->has('price')) <label class="error mt-2 text-danger"  >هزینه به ریال</label> @else 
 <label >هزینه به ریال</label> @endif
 <input type="text" class="form-control" name="price"      value="{{$admin->mak_price}}"   placeholder="{{$admin->mak_price}} ريال"     required  pattern="\d+"   minlength="2"       >                
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


