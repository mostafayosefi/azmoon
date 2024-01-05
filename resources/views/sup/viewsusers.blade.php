
@extends('sup.layoutsuper')

@section('title')
<title>مشاهده کاربران </title>
@stop

 
@section('superadmin')


      <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
            مشاهده کاربران
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{env('APP_URL')}}/superadmin/panel">پنل</a></li>
                <li class="breadcrumb-item active" aria-current="page">مشاهده کاربران</li>
              </ol>
            </nav>
          </div>
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">لیست کاربران</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                      
     				    <th>ردیف</th> 
                        <th>نام و نام خانوادگی</th>
                        <th>تاریخ ثبت نام</th>
                        <th>وضعیت</th>
                        <th>حذف</th>
                        <th>ورود</th>
                        </tr>
                      </thead>
                      <tbody>
       

 <?php  $i=1;  ?>                   
@foreach ($admins as $admin)
 
 										<tr>
					 <td>{{$i++}} </td>
                        <td>{{$admin->user_name}} </td> 
                        <td>{{jDate::forge($admin->user_createdatdate)->format('l d F Y ساعت H:i a')}}</td>
@if($admin->user_active == '1')                       
<td><a href="viewsusers/edituser/{{$admin->id}}" >  
	 <button type="button" class="btn btn-success btn-lg">  فعال 
 	 <i class="far fa-check-square btn-icon-prepend"></i>
 	 </button>
</a></td>
@elseif($admin->user_active != '1')
<td><a href="viewsusers/edituser/{{$admin->id}}"   >
	
	 <button type="button" class="btn btn-warning btn-lg">  غیرفعال 
 	 <i class="fa fa-exclamation-triangle btn-icon-prepend"></i> 
 	 </button>
	
</a></td>
@endif

 <td><a href="viewsusers/delet/{{$admin->id}}"  >
 	 <button type="button" class="btn btn-danger btn-lg">   
 	 <i class="fa fa-trash btn-icon-append"></i>
 	 </button>
                         
                       
 </a></td>
<td><a href="viewsusers/loginuser/{{$admin->id}}"  target="_blank">
	 <button type="button" class="btn btn-info btn-lg">  ورود 
 	 <i class="fa fa-unlock-alt btn-icon-prepend"></i>
 	 </button>
</a></td>
										</tr>
 
 @endforeach
                        
               
                      </tbody>
                    </table>
                  </div>
                </div>



                <div class="col-6">
 <td><a href="xls/allusers"  target="_blank">
	 <button type="button" class="btn btn-light btn-lg">  خروجی لیست کاربران 
 	 <i class="fa fa-arrow-down btn-icon-prepend"></i>
 	 </button>
</a></td>
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


