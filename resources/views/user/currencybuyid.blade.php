

@extends('user.layoutuser')

@section('title')
<title>پرداخت ارزی </title>
@stop

 
@section('superadmin')


		<div class="main-content" >
			<h1 class="page-title" >{{$admin->ctrf_name}}</h1>

			<ol class="breadcrumb breadcrumb-2"> 
				<li><a href="{{env('APP_URL')}}/user/panel"><i class="fa fa-home"></i>پنل مدیریت</a></li> 
				<li><a href="{{env('APP_URL')}}/user/viewsprodbuy">مشاهده سفارشات حواله های ارزی</a></li> 
				<li class="active"><strong>مشاهده</strong></li> 
			</ol>

<div class="row">

	  


<div class="col-md-12 animatedParent animateOnce z-index-45"> 
					<div class="panel panel-success animated fadeInUp">
						<div class="panel-heading clearfix"> 
							<div class="panel-title">{{$admin->ctrf_name}}</div> 
							<ul class="panel-tool-options"> 
						 
								<li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li> 
								<li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
							</ul>  
						</div> 

<br>
 
<div class="form-group">   
<label class="control-label">نام و نام خانوادگی گیرنده  : </label> 
{{$admin->prcrtr_namerecv}} 
</div> 
 
<div class="form-group">   
<label class="control-label">مبلغ درخواستی  : </label> 
  <span class="label label-success" style="direction: ltr;">{{$admin->prcrtr_paycur}} {{$admin->cur_nem}}</span>
</div>  


<div class="form-group">   
<label class="control-label">کشور مقصد  : </label> 
{{$admin->prcrtr_country}} 
</div>  

<div class="form-group">   
<label class="control-label">توضیحات  : </label> 
{{$admin->prcrtr_des}} 
</div>  

<div class="form-group">   
<label class="control-label">تاریخ ثبت سفارش: </label> 
{{jDate::forge($admin->ctrf_createdatdate)->format('Y/m/d ساعت H:i a')}}
</div>  

<div class="form-group">   
<label class="control-label">کارمزد ثابت  : </label> 
  <span class="label label-success"  style="direction: ltr;">{{$admin->prcrtr_fixfee}} {{$admin->cur_nem}}</span>
</div>  


<div class="form-group">   
<label class="control-label">کارمزد متغیر  : </label> 
  <span class="label label-success"  style="direction: ltr;">{{$admin->prcrtr_varebfee}} {{$admin->cur_nem}}</span>
</div>  

<div class="form-group">   
<label class="control-label">کارمزد نهایی  : </label> 
  <span class="label label-success">{{$admin->prcrtr_finalfee}} ريال</span>
</div>  

<div class="form-group">   
<label class="control-label">قیمت حواله {{$admin->ctrf_name}} : </label> 
  <span class="label label-success">{{$admin->prcrtr_pay}} ريال</span>
</div>  

<div class="form-group">   
<label class="control-label">قیمت نهایی  : </label> 
  <span class="label label-success">{{$admin->prcrtr_payfinalirr}} ريال</span>
</div>  

<div class="form-group">   
<label class="control-label">وضعیت پرداخت  : </label> 

@if($admin->prcrtr_payment == '1')                       
 <span class="label label-success">پرداخت شده</span> 
@elseif($admin->prcrtr_payment != '1')
 <span class="label label-warning">منتظر پرداخت</span> 
@endif

</div>  


@if($admin->prcrtr_payment == '1')  

<div class="form-group">   
<label class="control-label">تاریخ پرداخت: </label> 
{{jDate::forge($admin->prcrtr_paymentdate)->format('Y/m/d ساعت H:i a')}}
</div>  

@endif


@if($admin->prcrtr_payment == '0')   

 
  <div class="line-dashed"></div>

 <h4>مبلع شارژ حساب: <span class="label label-info" style="font-size: 16px">{{$chargeac}} ريال</span></h4>
<div class="line-dashed"></div>

<div class="col-md-12"><div class="panel-footer"> 
 
<div class="col-md-6">
<div data-step="9" data-position="bottom" data-intro=" ">
<td><a href="delet/{{$admin->prcrtr_id}}"  > <span class="btn btn-danger btn-block" >حذف سفارش</span></a></td>
</div>
</div>  

 
@if($chargeac >= $admin->prcrtr_payfinalirr )
<form class="form-horizontal" method="POST" action="{{env('APP_URL')}}/user/viewsprodservice/{{$admin->prcrtr_id}}/pay"  >
          

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

</div>  
</div>
@endif
        

					</div> 
					</div> 
					</div> 
                   
 

					</div>  


 




@stop


 