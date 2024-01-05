
@extends('user.layoutuser')

@section('title')
<title>اطلاعیه </title>
@stop

 
@section('superadmin')

		
		<!-- Main content -->
		<div class="main-content" > 
 
 			<div class="row">

 			<h1 class="page-title" >اطلاعیه</h1>
			<!-- Breadcrumb -->
			<ol class="breadcrumb breadcrumb-2"> 
				<li><a href="{{env('APP_URL')}}/superadminsuperadmin/panel"><i class="fa fa-home"></i>پنل مدیریت</a></li> 
				<li><a href="{{env('APP_URL')}}/superadmin/viewselanats">مشاهده اطلاعیه ها</a></li> 
				<li class="active"><strong>تیکت</strong></li> 
			</ol>
		
		
@foreach ($tickets as $ticket)  
			<div class="col-md-12">

				<div class="col-md-12 animatedParent animateOnce z-index-50"> 
					<div class="panel panel-primary animated fadeInUp">
						<div class="panel-heading clearfix"> 
							<div class="panel-title">اطلاعیه</div> 
		 
						</div> 
						<!-- panel body --> 
						<div class="panel-body"> 

        <header class="panel-heading">
                            <div style="display:block">
<div style="width:40%; float:right">
<i class="icon-ticket"></i> <span style="color:#a9d86e">شماره اطلاعیه :</span><span>{{$ticket->id}} </span>
<hr>
<i class="icon-calendar"></i> <span style="color:#FF6C60">تاریخ ثبت : </span><span>
 
{{jDate::forge($ticket->tik_createdatdate)->format('l d F Y ساعت H:i a')}}   
</span>
</div>
                                                         
<div style="width:40%;float:right"> 
  
<i class="icon-tags"></i> <span style="color:#41cac0">عنوان : </span><span>{{$ticket->tik_tit}}  </span>
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
 @if($message->mes_flg=='3')
					<div class="timeline-entry animatedParent animateOnce z-index-48 ">
						<div class="timeline-circle timeline-icon"><img alt=""  width="48" height="48" class="img-circle img-sm" src="{{env('APP_URL')}}/build/style/img/user2x.png"></div>
						<div class="timeline-panel animated fadeInUp">
							<div class="timeline-heading">
							
 <div class="media-left"><img alt=""  width="48" height="48" class="img-circle img-sm" src="{{env('APP_URL')}}/build/style/img/user2x.png">  مدیریت </div>
 
 
							</div>
							<div class="timeline-body">
								<p>{{$message->mes_des}}</p>
								 <footer> <cite title="Source Title"  style="font-size: 12px;">
 	{{jDate::forge($message->mes_createdatdate)->format('l d F Y ساعت H:i a')}} 
 </cite></footer>
							</div>
						</div>
					</div>
@endif
@endforeach




 

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

