
@extends('cust.layoutuser')

@section('title')
<title>مشاهده درخواست های من </title>
@stop

 
@section('superadmin')


      <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
          مشاهده درخواست های من
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{env('APP_URL')}}/user/panel">پنل</a></li>
                <li class="breadcrumb-item active" aria-current="page">مشاهده درخواست های من</li>
              </ol>
            </nav>
          </div>
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">لیست درخواستهای من</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
     				    <th>ردیف</th> 
                        <th>عنوان درخواست</th>
                        <th>هزینه به ریال</th> 
                        <th>تاریخ ایجاد درخواست</th>
                        <th>وضعیت</th> 
                        </tr>
                      </thead>
                      <tbody>
       

 <?php  $i=1;  ?>                   
@foreach ($admins as $admin)
 
 										<tr>
					    <td>{{$i++}} </td>
                        <td>{{$admin->req_name}} </td>  
                        <td>{{$admin->req_price}} ريال</td>  
                        <td>{{jDate::forge($admin->req_date)->format('Y/m/d ساعت H:i a')}}</td>
@if($admin->req_flg == '1')                       
<td><a href="viewsonlineshops/{{$admin->req_rndform}}/{{$admin->req_id}}" >  
	 <button type="button" class="btn btn-success btn-lg"> پرداخت شده 
 	 <i class="far fa-check-square btn-icon-prepend"></i>
 	 </button>
</a></td>
@elseif($admin->req_flg != '1')
<td><a href="viewsonlineshops/{{$admin->req_rndform}}/{{$admin->req_id}}"   >
	
	 <button type="button" class="btn btn-warning btn-lg">  منتظرپرداخت 
 	 <i class="fa fa-exclamation-triangle btn-icon-prepend"></i> 
 	 </button>
	
</a></td>
@endif

 
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


          
@if(!empty(Session::get('statust')))
<script src="{{env('APP_URL')}}/build/servicepay/firealert/components.js.download"></script> 
 
    <script>
        $(document).ready(function () {
                        Swal.fire({
                text: '<?php echo Session::get('statust'); ?>',
                type: '<?php echo Session::get('status'); ?>',
                confirmButtonText: 'بستن'

            });
            
        });
    </script>
@endif


@stop


