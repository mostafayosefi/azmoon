
@extends('sup.layoutsuper')

@section('title')
<title>تیکت </title>
@stop

 
@section('superadmin')


      <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
            مشاهده تیکت ها
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{env('APP_URL')}}/superadmin/panel">پنل</a></li>
                <li class="breadcrumb-item"><a href="{{env('APP_URL')}}/superadmin/viewsuserticketssup">مشاهده تیکت ها</a></li>
                <li class="breadcrumb-item active" aria-current="page">تیکت</li>
              </ol>
            </nav>
          </div>
      
               

                    
		
@foreach ($tickets as $ticket)  
 

          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">مشخصات تیکت</h4> 
                      @if($ticket->tik_active!='0')                     
<a href="{{env('APP_URL')}}/superadmin/viewsuserticketssup/close/{{$ticket->id}}">
<div class="badge badge-danger"><i class="icon-sm  fa fa-lock  text-warning ml-2   "></i>&nbsp;&nbsp;بستن تیکت</div> </a>  
@endif

                  
                    <div class="mt-4 py-2 border-top border-bottom">
                        <ul class="nav profile-navbar">
                          <li class="nav-item">
                            <a class="nav-link" href="#">
                              <i class="icon-sm  fa fa-microchip  text-info ml-2 "></i>
                          شماره تیکت  : {{$ticket->id}} 
                            </a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link active" href="#">
                              <i class="icon-sm  fa fa-calendar  text-info ml-2 "></i>
                          تاریخ ثبت :    {{jDate::forge($ticket->tik_createdatdate)->format('l d F Y ساعت H:i a')}}
                            </a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="#">
                             <i class="icon-sm  fa fa-user  text-info ml-2 "></i>
                         ایجاد کننده تیکت : {{$ticket->user_name}} 
                            </a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="#">
                             <i class="icon-sm  fa fa-check-square  text-info ml-2 "></i>
                         عنوان : {{$ticket->tik_tit}}
                            </a>
                          </li>
                          <li class="nav-item"> 
                                      <i class="icon-sm  fa fa-circle  text-info ml-2 "></i>
                         وضعیت تیکت : 
                         



                
@if($ticket->tik_active=='1')
 <a  class="badge badge-warning"  href="javascript:;">منتظر پاسخ </a>
 @elseif($ticket->tik_active=='2')
 <a  class="badge badge-success"  href="javascript:;">پاسخ داده شده  </a>   
  @elseif($ticket->tik_active=='0')
 <a  class="badge badge-danger"  href="javascript:;">تیکت بسته شده </a>  
 @endif    
                            
                          </li>
                       
                        </ul>
                      </div>
                  
                   
                </div>
              </div>
            </div>
            </div>



  <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">پیامها</h4>
                  <div class="mt-5">
                    <div class="timeline">
                    

@foreach ($messages as $message)  
@if($message->mes_flg=='1')
                      <div class="timeline-wrapper timeline-wrapper-success">
                        <div class="timeline-badge"></div>
                        <div class="timeline-panel">
                          <div class="timeline-heading">
                            <h6 class="timeline-title"><img alt=""  width="48" height="48" class="img-circle img-sm" src="{{env('APP_URL')}}/public/images/{{$ticket->user_img}}">{{$ticket->user_name}}</h6>
                          </div>
                          <div class="timeline-body">
<p>{{$message->mes_des}}</p>
                          </div>
                          <div class="timeline-footer d-flex align-items-center">
                           
                            <span class="mr-auto font-weight-bold">
       {{jDate::forge($message->mes_createdatdate)->format('l d F Y ساعت H:i a')}} 
                            </span>
                          </div>
                        </div>
                      </div>
 


@elseif($message->mes_flg=='2')
                      <div class="timeline-wrapper timeline-inverted timeline-wrapper-info">
                        <div class="timeline-badge"></div>
                        <div class="timeline-panel">
                          <div class="timeline-heading">
                            <h6 class="timeline-title"><img alt=""  width="48" height="48" class="img-circle img-sm" src="{{env('APP_URL')}}/build/style/img/user2x.png">  مدیریت </h6>
                          </div>
                          <div class="timeline-body">
                     <p>{{$message->mes_des}}</p>
                          </div>
                          <div class="timeline-footer d-flex align-items-center">
                             
                            <span class="mr-auto font-weight-bold">  
                            {{jDate::forge($message->mes_createdatdate)->format('l d F Y ساعت H:i a')}}</span>
                          </div>
                        </div>
                      </div>
@endif

@endforeach




                   
                    </div>
                  </div>
                  
                  
                  
                  
 <div class="timeline-entry animatedParent animateOnce z-index-49 right-aligned">
 
<form action="" method="post"> 
					 
 @if(count($errors))
 @foreach($errors->all() as $error)
<div class="breadcrumb bg-inverse-danger" >
<span  style="color: #000000"  >{{$error}}</span>  
</div> 
 @endforeach
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
              </div>
                </div>
              </div>












 
			</div>
			@endforeach
			
      
      
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


