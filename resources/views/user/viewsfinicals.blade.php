@extends('user.layoutuser')

@section('title')
<title>مشاهده فاکتورها </title>
@stop

 
@section('superadmin')

		
 
	 <!-- Main content -->
	 <div class="main-content" >
			<h1 class="page-title" >مشاهده فاکتورها</h1>
			<!-- Breadcrumb -->
			<ol class="breadcrumb breadcrumb-2"> 
				<li><a href="{{env('APP_URL')}}/user/panel"><i class="fa fa-home"></i>پنل مدیریت</a></li> 
				<li><a href="{{env('APP_URL')}}/user/finicals">مشاهده فاکتورها</a></li> 
				<li class="active"><strong>مشاهده</strong></li> 
			</ol>
			<div class="row">
				<div class="col-lg-12 animatedParent animateOnce z-index-50">
					<div class="panel panel-default animated fadeInUp">
						<div class="panel-heading clearfix">
							<h3 class="panel-title" >لیست فاکتورها</h3>
						 
						</div>
						<div class="panel-body">
							<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover dataTables-example" >
									<thead>
										<tr>
     				    <th>ردیف</th> 
                        <th>نام سرویس</th>
                        <th>هزینه سرویس (ريال)</th> 
                        <th>تاریخ خرید</th>
                        <th>وضعیت</th> 
										</tr>
									</thead>
									<tbody>

 <?php  $i=1;  ?>                   
@foreach ($admins as $admin)
 
										<tr class="gradeX">
										 <td>{{$i++}} </td>
                        <td>{{$admin->ctrf_name}} </td>  
                        <td>{{$admin->prcrtr_pay}} ريال</td>  
                        <td>{{jDate::forge($admin->prcrtr_createdatdate)->format('Y/m/d ساعت H:i a')}}</td>
                 
 
<td><a href="@if($admin->ctrf_type == '1')viewsprodbuy/{{$admin->prcrtr_id}}@else viewsprodservice/{{$admin->prcrtr_id}} @endif"   >@if($admin->prcrtr_payment == '1')<span class="label label-success">پرداخت شده</span> @else <span class="label label-warning">منتظر پرداخت</span> @endif</a></td>
 
 
										</tr>
@endforeach
									</tbody>
									<tfoot>
										<tr>
     				    <th>ردیف</th> 
                        <th>نام سرویس</th>
                        <th>هزینه سرویس (ريال)</th> 
                        <th>تاریخ خرید</th>
                        <th>وضعیت</th> 
										</tr>
									</tfoot>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			
 
		
	  </div>
	  <!-- /main content -->



@stop


@section('scriptfooter')
 
<script src="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/jquery.metisMenu.js"></script>
<script src="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/jquery-ui.js"></script>
<script src="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/jquery.blockUI.js"></script>
<script src="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/functions.js"></script>

<script src="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/jquery.dataTables.min.js"></script>
<script src="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/dataTables.bootstrap.min.js"></script> 
<script src="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/vfs_fonts.js"></script>
<script src="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/buttons.html5.js"></script>
<script src="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/buttons.colVis.js"></script>
<script>
	$(document).ready(function () {
		$('.dataTables-example').DataTable({
			dom: '<"html5buttons" B>lTfgitp',
			buttons: [
				{
					extend: 'copyHtml5',
					exportOptions: {
						columns: [ 0, ':visible' ]
					}
				},
				{
					extend: 'excelHtml5',
					exportOptions: {
						columns: ':visible'
					}
				},
				{
					extend: 'pdfHtml5',
					exportOptions: {
						columns: [ 0, 1, 2, 3, 4 ]
					}
				},
				'colvis'
			]
		});
	});
</script>

@stop
