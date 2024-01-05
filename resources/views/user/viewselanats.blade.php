@extends('user.layoutuser')

@section('title')
<title>مشاهده اطلاعیه ها </title>
@stop

 
@section('superadmin')

		
 
	 <!-- Main content -->
	 <div class="main-content" >
			<h1 class="page-title" >مشاهده اطلاعیه ها</h1>
			<!-- Breadcrumb -->
			<ol class="breadcrumb breadcrumb-2"> 
				<li><a href="{{env('APP_URL')}}/user/panel"><i class="fa fa-home"></i>پنل کاربر</a></li> 
				<li><a href="{{env('APP_URL')}}/user/viewselanats">مشاهده اطلاعیه ها</a></li> 
				<li class="active"><strong>مشاهده</strong></li> 
			</ol>
			<div class="row">
				<div class="col-lg-12 animatedParent animateOnce z-index-50">
					<div class="panel panel-default animated fadeInUp">
						<div class="panel-heading clearfix">
							<h3 class="panel-title" >لیست اطلاعیه</h3>
						 
						</div>
						<div class="panel-body">
							<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover dataTables-example" >
									<thead>
										<tr>
     				    <th>ردیف</th>  
                        <th>موضوع اطلاعیه</th> 
                        <th>تاریخ اطلاعیه</th>
                        <th>وضعیت</th> 
                        <th>حذف</th> 
										</tr>
									</thead>
									<tbody>

 <?php  $i=1;  ?>                   
@foreach ($admins as $admin)
 
										<tr class="gradeX">
										 <td>{{$i++}} </td> 
 <td>{{$admin->tik_tit}} @if($admin->tik_toread=='0')
 <span  title="اطلاعیه هنوز توسط گیرنده خوانده نشده است"  class="label label-success" >1</span> @endif </td>  
                        <td>{{jDate::forge($admin->tik_date)->format('Y/m/d ساعت H:i a')}}</td>
@if($admin->tik_active == '2')                       
<td><a href="viewselanats/elanat/{{$admin->id}}" > <span class="label label-success">مشاهده</span></a></td>
@elseif($admin->tik_active == '1') 
<td><a href="viewselanats/elanat/{{$admin->id}}"   ><span class="label label-warning">مشاهده</span></a></td>
@elseif($admin->tik_active == '0') 
<td><a href="viewselanats/elanat/{{$admin->id}}"   ><span class="badge bg-blue">مشاهده</span></a></td>

@endif

<td><a href="viewselanats/delet/{{$admin->id}}"   ><span class="label label-danger">حذف</span></a></td>
 
										</tr>
@endforeach
									</tbody>
									<tfoot>
										<tr>
     				    <th>ردیف</th>  
                        <th>موضوع اطلاعیه</th> 
                        <th>تاریخ اطلاعیه</th>
                        <th>وضعیت</th> 
                        <th>حذف</th> 
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
