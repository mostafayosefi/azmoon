
@extends('superadmin.layoutsuperadmin')

@section('title')
<title>مشاهده فرم ها </title>
@stop

 
@section('superadmin')

		
 
	 <!-- Main content -->
	 <div class="main-content" >
			<h1 class="page-title" >مشاهده فرم ها</h1>
			<!-- Breadcrumb -->
			<ol class="breadcrumb breadcrumb-2"> 
				<li><a href="{{env('APP_URL')}}/superadmin/panel"><i class="fa fa-home"></i>پنل مدیریت</a></li> 
				<li><a href="{{env('APP_URL')}}/superadmin/viewsforms">مشاهده فرم ها</a></li> 
				<li class="active"><strong>مشاهده</strong></li> 
			</ol>
			<div class="row">
				<div class="col-lg-12 animatedParent animateOnce z-index-50">
					<div class="panel panel-default animated fadeInUp">
						<div class="panel-heading clearfix">
							<h3 class="panel-title" >لیست فرم ها</h3>
						 
						</div>
						<div class="panel-body">
							<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover dataTables-example" >
									<thead>
										<tr>
     				    <th>ردیف</th> 
                        <th>نام فرم</th>
                        <th>توضیحات فرم</th>
                        <th>تاریخ ایجاد فرم</th>
                        <th>وضعیت</th> 
                        <th>پیش نمایش فرم </th> 
										</tr>
									</thead>
									<tbody>

 <?php  $i=1;  ?>                   
@foreach ($admins as $admin)
 
										<tr class="gradeX">
										 <td>{{$i++}} </td>
                        <td>{{$admin->form_name}} </td> 
                        <td>{{$admin->form_des}} </td> 
                        <td>{{jDate::forge($admin->form_date)->format('l d F Y ساعت H:i a')}}</td>
@if($admin->form_active == '1')                       
<td><a href="viewsforms/edit/{{$admin->form_rnd}}" > <span class="label label-success">فعال</span></a></td>
@elseif($admin->form_active != '1')
<td><a href="viewsforms/edit/{{$admin->form_rnd}}"   ><span class="label label-warning">غیرفعال</span></a></td>
@endif
<td><a href="viewsforms/edit/{{$admin->form_rnd}}"   ><span class="label label-info">مشاهده</span></a></td>
										</tr>
@endforeach
									</tbody>
									<tfoot>
										<tr>
     				    <th>ردیف</th> 
                        <th>نام فرم</th>
                        <th>توضیحات فرم</th>
                        <th>تاریخ ایجاد فرم</th>
                        <th>وضعیت</th> 
                        <th>پیش نمایش فرم </th> 
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
