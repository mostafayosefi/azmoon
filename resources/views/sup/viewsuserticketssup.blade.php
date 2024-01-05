
@extends('sup.layoutsuper')

@section('title')
<title>مشاهده تیکتهای کاربران </title>
@stop

 
@section('superadmin')


      <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
            مشاهده تیکتهای کاربران
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{env('APP_URL')}}/superadmin/panel">پنل</a></li>
                <li class="breadcrumb-item"><a href="{{env('APP_URL')}}/superadmin/viewsuserticketssup">مشاهده تیکتهای کاربران</a></li>
                <li class="breadcrumb-item active" aria-current="page">مشاهده</li>
              </ol>
            </nav>
          </div>
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">لیست تیکتهای کاربران</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                      
     				    <th>ردیف</th> 
                        <th>فرستنده</th> 
                        <th>موضوع تیکت</th> 
                        <th>تاریخ تیکت</th>
                        <th>وضعیت</th> 
                        <th>حذف</th> 
                        </tr>
                      </thead>
                      <tbody>
       

 <?php  $i=1;  ?>                   
@foreach ($admins as $admin)
 

										<tr class="gradeX">
										 <td>{{$i++}} </td>
                        <td>{{$admin->user_name}}</td>
                        <td>{{$admin->tik_tit}}  @if($admin->tik_toread=='0')
                        <span class="btn btn-info  btn-rounded btn-sm"  title="پیام جدید" > 1</span>
                        @endif</td>   
                        <td>{{jDate::forge($admin->tik_date)->format('Y/m/d ساعت H:i a')}}</td>
@if($admin->tik_active == '2')                       
<td><a href="viewsuserticketssup/ticket/{{$admin->id}}" > <span class="btn btn-success btn-sm">پاسخ داده شده</span></a></td>
@elseif($admin->tik_active == '1') 
<td><a href="viewsuserticketssup/ticket/{{$admin->id}}"   ><span class="btn btn-warning btn-sm">منتظر پاسخ</span></a></td>
@elseif($admin->tik_active == '0') 
<td><a href="viewsuserticketssup/ticket/{{$admin->id}}"   ><span  class="btn btn-info btn-sm">بسته شده</span></a></td>

@endif

<td><a href="viewsuserticketssup/delet/{{$admin->id}}"   ><span class="btn btn-danger btn-sm">حذف</span></a></td>
 
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
                type: 'success',
                confirmButtonText: 'بستن'

            });
            
        });
    </script>
@endif


@stop


