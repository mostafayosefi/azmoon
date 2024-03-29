
@extends('superadmin.layoutsuperadmin')

@section('title')
<title>مشاهده کاربران </title>
@stop

 
@section('superadmin')

		
 
	 <!-- Main content -->
	 <div class="main-content" >
			<h1 class="page-title" >مشاهده کاربران</h1>
			<!-- Breadcrumb -->
			<ol class="breadcrumb breadcrumb-2"> 
				<li><a href="{{env('APP_URL')}}/superadmin/panel"><i class="fa fa-home"></i>پنل مدیریت</a></li> 
				<li><a href="{{env('APP_URL')}}/superadmin/viewsusers">مشاهده کاربران</a></li> 
				<li class="active"><strong>مشاهده</strong></li> 
			</ol>
			<div class="row">
				<div class="col-lg-12 animatedParent animateOnce z-index-50">
					<div class="panel panel-default animated fadeInUp">
						<div class="panel-heading clearfix">
							<h3 class="panel-title" >لیست کاربران</h3>
						 
						</div>
						<div class="panel-body">
							<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover dataTables-example" >
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
 
										<tr class="gradeX">
										 <td>{{$i++}} </td>
                        <td>{{$admin->user_name}} </td> 
                        <td>{{jDate::forge($admin->user_createdatdate)->format('l d F Y ساعت H:i a')}}</td>
@if($admin->user_active == '1')                       
<td><a href="viewsusers/edituser/{{$admin->id}}" > <span class="label label-success">فعال</span></a></td>
@elseif($admin->user_active != '1')
<td><a href="viewsusers/edituser/{{$admin->id}}"   ><span class="label label-warning">غیرفعال</span></a></td>
@endif

 <td><a href="viewsusers/delet/{{$admin->id}}"  > <span class="label label-danger">حذف</span></a></td>
<td><a href="viewsusers/loginuser/{{$admin->id}}"  target="_blank"> <span class="label label-info">ورود به پنل</span></a></td>
										</tr>
@endforeach
									</tbody>
									<tfoot>
										<tr>
     				    <th>ردیف</th> 
                        <th>نام و نام خانوادگی</th>
                        <th>تاریخ ثبت نام</th>
                        <th>وضعیت</th>
                        <th>حذف</th>
                        <th>ورود</th>
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
