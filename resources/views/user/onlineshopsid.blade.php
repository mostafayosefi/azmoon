@extends('user.layoutuser')

@section('title')
<title>{{$form->form_name}} </title>
@stop

 
@section('superadmin')

		
 
	 <!-- Main content -->
	 <div class="main-content" >
			<h1 class="page-title" >{{$form->form_name}}</h1>
			<!-- Breadcrumb -->
			<ol class="breadcrumb breadcrumb-2"> 
				<li><a href="{{env('APP_URL')}}/user/panel"><i class="fa fa-home"></i>پنل مدیریت</a></li> 
				<li><a href="{{env('APP_URL')}}/user/viewsonlineshops">مشاهده درخواست های من</a></li> 
				<li class="active"><strong>{{$form->form_name}}</strong></li> 
			</ol>
			<div class="row">
				<div class="col-lg-12 animatedParent animateOnce z-index-50">
					<div class="panel panel-default animated fadeInUp">
						<div class="panel-heading clearfix">
							<h3 class="panel-title" >{{$form->form_name}}</h3>
						 
						</div>
						
						<div class="panel-body">
 
 
 <div class="col-lg-2"></div>
 <div class="col-lg-8">
 <div class="row"> 
 <p> نام و نام خانوادگی کاربر ثبت کننده :  {{$myrequest->user_name}}</p> </div>
<div class="line-dashed"></div> 
 
 @foreach($admins as $admin)
	 <div class="row"> 
 <p> {{$admin->list_name}} :  @foreach($lists as $list) @if($admin->list_chk==$list->list_chk) 
 
 @if($list->list_typ=='4')
 <a href="{{env('APP_URL')}}/public/images/{{$list->list_name}}" >مشاهده فایل</a><br>
 <img class="avatar-130 img-circle" src="{{env('APP_URL')}}/public/images/{{$list->list_name}}" alt="user image">
 @elseif($list->list_typ=='8')

@foreach ($formselects as $formselect)
@if($formselect->formselect_value==$list->list_name)   
 {{$formselect->formselect_name}} 
 @endif
@endforeach 

 @else
 {{$list->list_name}} 
 @endif
 
 @endif @endforeach</p>
<div class="line-dashed"></div> 
	 </div>
	
 @endforeach
 
 
	 <div class="row"> 
	  <p> تاریخ درخواست : {{jDate::forge($reqs->req_date)->format('Y/m/d ساعت H:i a')}} </p>
<div class="line-dashed"></div> 
	 </div>


	 <div class="row"> 
	 <p> وضعیت پرداخت : 
	 @if($reqs->req_flg == '1')                       
 <a href="#" > <span class="label label-success">پرداخت شده</span></a> 
@elseif($reqs->req_flg != '1')
 <a href="#"   ><span class="label label-warning">منتظر پرداخت</span></a> 
@endif
</p>

<div class="line-dashed"></div> 
	 </div>
	 
	 
 @if($reqs->req_flg == '0')  	
 
  <div class="line-dashed"></div>

 <h4>مبلع شارژ حساب: <span class="label label-info" style="font-size: 16px">{{$chargeac}} ريال</span></h4>
<div class="line-dashed"></div>
 		
	 <div class="row"> <div class="panel-footer"> 


@if($chargeac >= $reqs->req_price )
<form class="form-horizontal" method="POST" action=""  >
          

<div class="col-md-6">
<div class="form-group">  
<button class="btn btn-primary btn-block btn-flat">پرداخت فاکتور از شارژ حساب</button>
</div>
</div>  


                     <input type="hidden" name="jamekol" value="{{$chargeac}}">
                     
                     <input type="hidden" name="_token" value="{{ csrf_token() }}"> 

 </form>
 
 @else
 
 <div class="col-md-6">
<div class="form-group">  
<button class="btn btn-primary btn-block btn-flat">پرداخت از طریق درگاه پرداخت</button>
</div>
</div>  
 
 @endif

 </div>	</div>
@endif


		 
	</div><div class="col-lg-2"></div>			
 
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
