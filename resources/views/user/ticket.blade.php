
@extends('user.layoutuser')

@section('title')
<title>تیکت </title>
@stop

 
@section('superadmin')

		
		<!-- Main content -->
		<div class="main-content" > 
 
 			<div class="row">

 			<h1 class="page-title" >تیکت</h1>
			<!-- Breadcrumb -->
			<ol class="breadcrumb breadcrumb-2"> 
				<li><a href="{{env('APP_URL')}}/user/panel"><i class="fa fa-home"></i>پنل کاربری</a></li> 
				<li><a href="{{env('APP_URL')}}/user/viewstickets">مشاهده تیکتها</a></li> 
				<li class="active"><strong>تیکت</strong></li> 
			</ol>
		
		
@foreach ($tickets as $ticket)  
			<div class="col-md-12">

				<div class="col-md-12 animatedParent animateOnce z-index-50"> 
					<div class="panel panel-primary animated fadeInUp">
						<div class="panel-heading clearfix"> 
							<div class="panel-title">پشتیبانی</div> 
		 
						</div> 
						<!-- panel body --> 
						<div class="panel-body"> 


        <header class="panel-heading">
                            <div style="display:block">
<div style="width:40%; float:right">
<i class="icon-ticket"></i> <span style="color:#a9d86e">شماره تیکت :</span><span>{{$ticket->id}} </span>
<hr>
<i class="icon-calendar"></i> <span style="color:#FF6C60">تاریخ ثبت : </span><span>
 
{{jDate::forge($ticket->tik_createdatdate)->format('l d F Y ساعت H:i a')}}   
</span>
</div>
                                                         
<div style="width:40%;float:right"> 
<i class="icon-bolt"></i> <span style="color:#f1c500">ایجاد کننده تیکت  : </span><span>{{$ticket->user_name}} </span>
<hr>
<i class="icon-tags"></i> <span style="color:#41cac0">عنوان : </span><span>{{$ticket->tik_tit}}  </span>
                           </div>
                                                                                    <div style="width:20%;float:right;text-align:center"> 
<td><a href="">
<!--<button type="button" class="btn btn-default "><i class="icon-lock"></i>&nbsp;&nbsp;بستن تیکت</button> </a> -->
                                                    <br><br>


                
@if($ticket->tik_active=='1')
 <a class="btn btn-round btn-warning"  href="javascript:;">منتظر پاسخ </a>
 @elseif($ticket->tik_active=='2')
 <a class="btn btn-round btn-success"  href="javascript:;">پاسخ داده شده  </a>   
  @elseif($ticket->tik_active=='0')
 <a class="btn btn-round btn-default"  href="javascript:;">بستن تیکت </a>  
 @endif                                           

 
                           </div>


                             </div>
                       <br>
                       <br>
                       <br>
                       <br>
<br>
                         

                            </header>

						</div> 
					</div> 
				</div>

 

 

				<!-- Timeline Basic -->
				<div class="timeline-basic timeline-center clearfix">
					
 
					
@foreach ($messages as $message)  
@if($message->mes_flg=='1')
					<div class="timeline-entry animatedParent animateOnce z-index-49 left-aligned">
						<div class="timeline-circle timeline-icon"><img alt=""  width="48" height="48" class="img-circle img-sm" src="{{env('APP_URL')}}/public/images/{{$ticket->user_img}}"></div>
						<div class="timeline-panel animated fadeInUp">
							<div class="timeline-heading">
							
							
 <div class="media-left"><img alt=""  width="48" height="48" class="img-circle img-sm" src="{{env('APP_URL')}}/public/images/{{$ticket->user_img}}">{{$ticket->user_name}}</div>
  
							</div>
							
							<br>
							<div class="timeline-body">
								<p>{{$message->mes_des}}</p>
 <footer> <cite title="Source Title"  style="font-size: 12px;">
 	{{jDate::forge($message->mes_createdatdate)->format('l d F Y ساعت H:i a')}} 
 </cite></footer>
							</div>
						</div>
					</div>

@elseif($message->mes_flg=='2')
					<div class="timeline-entry animatedParent animateOnce z-index-48">
						<div class="timeline-circle timeline-icon"><img alt=""  width="48" height="48" class="img-circle img-sm" src="{{env('APP_URL')}}/build/style/img/user2x.png"></div>
						<div class="timeline-panel animated fadeInUp">
							<div class="timeline-heading">
							
 <div class="media-left"><img alt=""  width="48" height="48" class="img-circle img-sm" src="{{env('APP_URL')}}/build/style/img/user2x.png">  مدیریت </div>
 
 
							</div>
							<div class="timeline-body">
								<p>{{$message->mes_des}}</p> <footer> <cite title="Source Title"  style="font-size: 12px;">
 	{{jDate::forge($message->mes_createdatdate)->format('l d F Y ساعت H:i a')}} 
 </cite></footer>
							</div>
						</div>
					</div>
@endif
@endforeach





 <div class="timeline-entry animatedParent animateOnce z-index-49 left-aligned">
 
<form action="" method="post"> 
					 
					 @if(count($errors))
<div class="text-danger"  >
<strong  style="" >اخطار!</strong>
<li >	 لطفا اطلاعات را به درستی وارد نمایید. </li>
@foreach($errors->all() as $error)
<span class="badge badge-danger">{{$error}}</span> <br>
@endforeach
</div> 
<div class="line-dashed"></div>
@endif  
		

<div class="col-md-12">  
<div class="form-group {{ $errors->has('des') ? 'has-error' : '' }}"> 
 <label class="control-label"></label> 
 <textarea placeholder="لطفا پیام خود را تایپ نمایید" name="des" class="form-control" rows="5"></textarea> 
 </div>
 </div>
  
                     <input type="hidden" name="_token" value="{{ csrf_token() }}">
                     
                     			
						<div class="form-group"> 
								<div class="col-sm-offset-9 col-sm-3"> 
								       <button class="btn btn-success btn-block btn-flat">ثبت پیام</button>
								</div> 
							</div>
							
							</form>
 
				</div>
 


				</div>
				<!-- /timeline basic -->
			</div>
			@endforeach
			
		</div>
		<!-- /card view -->


	      </div> 

@stop


@section('scriptfooter')
 

@stop

