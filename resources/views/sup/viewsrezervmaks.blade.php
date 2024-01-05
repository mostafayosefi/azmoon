
@extends('sup.layoutsuper')

@section('title')
<title>مشاهده سفارشات ماک </title>
@stop

 
@section('superadmin')


      <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
        مشاهده سفارشات ماک
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{env('APP_URL')}}/user/panel">پنل</a></li>
                <li class="breadcrumb-item active" aria-current="page">مشاهده سفارشات ماک</li>
              </ol>
            </nav>
          </div>
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">لیست سفارشات ماک من</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
     				    <th>ردیف</th> 
                        <th>عنوان درخواست</th>
                        <th>نام کاربر</th>
                        <th>تاریخ و زمان رزرو</th>
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
                       
 <td> شرکت در آزمون ماک پیرسون @if($admin->list_mak) و (خریداری {{$admin->mak_name}}) @else  @endif </td> 
 
 
 <td>   {{$admin->user_name}}     </td> 
 
 <td> {{$admin->cal_year}}/{{$admin->cal_month}}/{{$admin->cal_day}}  ساعت {{$admin->cal_hours}} </td> 
 
 <td>  <div class="badge badge-primary"> {{$admin->list_price}} ريال  </div>  </td> 
                          
  <td>{{jDate::forge($admin->list_createdatdate)->format('Y/m/d ساعت H:i a')}}</td>
@if($admin->list_flg == '1')                       
<td><a href="rezervmak/{{$admin->list_id}}/3" >  
	 <button type="button" class="btn btn-success btn-sm"> پرداخت شده 
 	 <i class="far fa-check-square btn-icon-prepend"></i>
 	 </button>
</a></td>
@elseif($admin->list_flg != '1')
<td><a href="rezervmak/{{$admin->list_id}}/3"   >
	
	 <button type="button" class="btn btn-warning btn-sm">  منتظرپرداخت 
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


