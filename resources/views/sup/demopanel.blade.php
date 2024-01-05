
@extends('sup.layoutsuper')

@section('title')
<title>پنل مدیریت </title>
@stop

 
@section('superadmin')
 
       <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              پنل مدیریت
            </h3>
          </div>
     
          
          
          <div class="row">
            <div class="col-md-8 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">
                    <i class="fas fa-rocket"></i>
                    آخرین کاربران ثبت نامی
                  </h4>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>
                            نام و نام خانوادگی
                          </th>
                          <th>
                            تاریخ ثبت نام
                          </th>
                          <th>
                            وضعیت
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                      
                      @foreach($listusers as $listuser)
                        <tr>
                          <td class="py-1">
                            <img src="{{env('APP_URL')}}/build/melody/images/faces/face1.jpg" alt="profile" class="img-sm rounded-circle" />{{$listuser->user_name}}
                          </td>
                          <td>
                        {{jDate::forge($listuser->user_createdatdate)->format('Y/m/d ساعت H:i a')}} 
                          </td>
                          <td>
@if($listuser->user_active == '1') 
<a href="{{env('APP_URL')}}/superadmin/viewsusers/edituser/{{$listuser->id}}" >
<label class="btn badge-success badge-pill">فعال</label></a> 
@else
<a href="{{env('APP_URL')}}/superadmin/viewsusers/edituser/{{$listuser->id}}" >
<label class="btn badge-warning badge-pill">غیرفعال</label></a> 
@endif

                          </td>
                        </tr>
                        @endforeach
 
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div> 
            <div class="col-md-4 grid-margin stretch-card">
              <div class="card">
                <div class="card-body d-flex flex-column">
                  <h4 class="card-title">
                    <i class="fas fa-tachometer-alt"></i>
                   مدیریت کاربران
                  </h4>
                 
 
<hr>
                    <div class="statistics-item">
                      <p>
                        <i class="icon-lg  fa fa-user  text-info ml-2 "></i>
                       تعداد کل کاربران
                      </p>
                      <h2>{{$admins}} نفر</h2>
                       
                    </div>
<hr>
                    <div class="statistics-item">
                      <p>
                        <i class="icon-lg  fa fa-user text-success ml-2 "></i>
                       تعداد کاربران فعال
                      </p>
                      <h2>{{$useractives}} نفر</h2>
                       
                    </div>
 
                </div>
              </div>
            </div>

          </div>
          
          
         
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2018 . تمام حقوق
              محفوظ است.</span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->

@stop


