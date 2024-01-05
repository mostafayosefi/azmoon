
@extends('user.layoutuser')

@section('title')
<title>پنل </title>
@stop

 
@section('superadmin')

		
		<!-- Main content -->
		<div class="main-content" >
			<h1 class="page-title" >پنل</h1>
 
	<div class="row">
			<div class="col-lg-12 animatedParent animateOnce z-index-47">
				<div class="panel panel-default animated fadeInUp"> 
					<div class="panel-body"> 
 <h2>مشاهده تراکنش ها</h2> 
 <div class="line-dashed"></div>

 <h4>مبلع شارژ حساب: <span class="label label-info" style="font-size: 16px">{{$chargeac}} ريال</span></h4>
<div class="line-dashed"></div>
            
						<div class="panel-body">
							<div class="table-responsive">
 <table class="table table-striped table-bordered table-hover dataTables-example" >
@if   (empty ($chargesas))                 
<tr>اطلاعاتی وجود ندارد<tr>
@elseif ($chargesas)        
                    <thead>
                      <tr>
                        <th>ردیف</th>
                        <th>تاریخ تراکنش</th>
                        <th>هزینه ها</th>
                        <th>وضعیت</th> 
                        <th>جزییات</th> 
                      </tr>
                    </thead>
                    <tbody>
             
                    
 <?php  $i=1;   ?>                   
@foreach ($chargesas as $charges)
<tr>
<td>{{$i++}} </td>
<td>  
{{jDate::forge($charges->charge_createdatdate)->format('l d F Y ساعت H:i a')}} </td>

<td> 

 @if($charges->finical_inc == '8')
<span class="label label-success"> + 
 @elseif ($charges->finical_inc == '7') 
<span class="label label-default"> - 
 @elseif ($charges->finical_inc == '6')
<span class="label label-success"> + 
 @elseif ($charges->finical_inc == '5')   
<span class="label label-info"> +
 @elseif ($charges->finical_inc == '4')
<span class="label label-default"> 
 @elseif ($charges->finical_inc == '3')
 <span class="label label-warning" > - 	 
 @endif    
 
 {{$charges->charge_pay}} ریال</span> </td>
 
 
<td>
 @if($charges->finical_inc == '8')
<span class="label label-success">  افزایش شارژ بازاریابی
 @elseif ($charges->finical_inc == '7') 
<span class="label label-default">  کسر شارژ
 @elseif ($charges->finical_inc == '6')
<span class="label label-success"> افزایش شارژ توسط مدیر 
 @elseif ($charges->finical_inc == '5')   
<span class="label label-info"> افزایش شارژ توسط کاربر 
 @elseif ($charges->finical_inc == '4')
<span class="label label-default"> خرید از درگاه پرداخت 
 @elseif ($charges->finical_inc == '3')
 <span class="label label-warning">برداشت وجه و  خرید 	 
 @endif  
</span> </td>

 <td>
 
 
@if($charges->finical_marpay=='1')   مبلغ خرید سفارش  
@elseif($charges->finical_marpay=='5')   {{$charges->finical_shenasepardakht}}
@elseif($charges->finical_marpay=='7') پرداخت در سایتهای خارجی (  {{$charges->finical_shenasepardakht}} )  
 

@elseif($charges->finical_marpay=='8')  هزینه پستی داخل ایران 
@else


@if($charges->finical_marid=='0')  

@if($charges->finical_inc=='8')    مبلغ بازاریابی 
@elseif($charges->finical_inc=='7')  {{$charges->finical_shenasepardakht}}  
@elseif($charges->finical_inc=='6')  {{$charges->finical_shenasepardakht}} 
@elseif($charges->finical_inc=='5')  شارژ توسط کاربر
@else  

 @if($charges->charge_status=='0')   خرید آدرس پستی 
 @elseif($charges->charge_status=='1')
هزینه پستی خرید محصول از فروشگاه کارگو
 @endif



@endif



@elseif($charges->finical_marid!='0')  مرسوله 
@endif

@endif
</td> 

 
</tr>
@endforeach
</tbody>
                    <tfoot>
                      <tr>
                        <th>ردیف</th>
                        <th>تاریخ تراکنش</th>
                        <th>هزینه ها</th>
                        <th>وضعیت</th> 
                        <th>جزییات</th> 
                      </tr>
                    </tfoot>
                    @endif
                  </table>
            
            
            
						</div>
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


