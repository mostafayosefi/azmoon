
@extends('cust.layoutuser')

@section('title')
<title> پنل </title>
@stop

 
@section('superadmin')
 
       <div class="main-panel">
        <div class="content-wrapper">




          <div class="page-header">
            <h5 class="page-title">
             ثبت نام آزمون PTE
            </h5>
          </div>
  

   <div class="row grid-margin"> 
              <div class="card  grid-margin stretch-card">
                <div class="card-body">
 <div class="row"> 

                                               
<div class="col-md-3 grid-margin stretch-card">
  <div class="statistics-item">
<div class="card text-center">
<div class="card-body">
<img   src="{{env('APP_URL')}}/build/icon/turkey.png" style="height: 198px; width: 205px; padding_right: 10px;" class="img-lg  " alt="profile image" /><br><br>
<h6 class="text-info text-center page-title" style="font-size: 18px!important;"><b> خرید ووچر آزمون PTE ترکیه</b></h6>



<a href="{{env('APP_URL')}}/user/regord/pte-voucher-turkey"> <button class="btn btn-info btn-md  btn-rounded btn-fw mt-3 mb-4"> <i class="fa fa-check-circle"></i> ثبت سفارش </button></a>


</div>
</div>
  </div>
</div>
                  
<div class="col-md-3 grid-margin stretch-card">
                    <div class="statistics-item">
              <div class="card text-center">
                <div class="card-body">
 <img   src="{{env('APP_URL')}}/build/icon/turkey.png" style="height: 198px; width: 205px; padding_right: 10px;" class="img-lg  " alt="profile image" /><br><br>
          <h6 class="text-info text-center page-title"><b>آزمون PTE ترکیه</b></h6>
 
                 

 <a href="{{env('APP_URL')}}/user/regord/pteturkey"> <button class="btn btn-info btn-md  btn-rounded btn-fw mt-3 mb-4"> <i class="fa fa-check-circle"></i> ثبت سفارش </button></a>
             
             
                </div>
              </div>
                    </div>
</div>
                    
<div class="col-md-3 grid-margin stretch-card">
                                        <div class="statistics-item">
     <div class="card text-center">
                <div class="card-body">
 <img   src="{{env('APP_URL')}}/build/icon/azerbaijan.png" style="height: 198px; width: 205px;  padding_right: 10px;" class="img-lg  " alt="profile image" /><br><br>
          <h6 class="text-info text-center page-title"><b>آزمون PTE آذربایجان</b></h6>
  
 <a href="{{env('APP_URL')}}/user/regord/pteaz"> <button class="btn btn-info btn-md  btn-rounded btn-fw mt-3 mb-4"> <i class="fa fa-check-circle"></i> ثبت سفارش </button></a>
             
             
                </div>
              </div>
                    </div>
                    </div>
<div class="col-md-3 grid-margin stretch-card">
                    <div class="statistics-item">
  <div class="card text-center">
                <div class="card-body">
 <img   src="{{env('APP_URL')}}/build/icon/uae.png" style="height: 198px; width: 205px;  padding_right: 10px;" class="img-lg  " alt="profile image" /><br><br>
          <h6 class="text-info text-center page-title"><b>آزمون PTE امارات</b></h6>
  
 <a href="{{env('APP_URL')}}/user/regord/pteem"> <button class="btn btn-info btn-md  btn-rounded btn-fw mt-3 mb-4"> <i class="fa fa-check-circle"></i> ثبت سفارش </button></a>
             
             
                </div>
              </div>
                    </div>
                    </div>

                    
                
                  </div>    
                    
 <div class="row">
                    
<div class="col-md-3 grid-margin stretch-card">
  <div class="statistics-item">
<div class="card text-center">
<div class="card-body">
<img   src="{{env('APP_URL')}}/build/icon/iraq.png" style="height: 198px; width: 205px;  padding_right: 10px;" class="img-lg  " alt="profile image" /><br><br>
<h6 class="text-info text-center page-title"><b>آزمون PTE عراق</b></h6>

<a href="{{env('APP_URL')}}/user/regord/pteirqs"> <button class="btn btn-info btn-md  btn-rounded btn-fw mt-3 mb-4"> <i class="fa fa-check-circle"></i> ثبت سفارش </button></a>


</div>
</div>
  </div>
  </div>
            
<div class="col-md-3 grid-margin stretch-card">
                    <div class="statistics-item">
     <div class="card text-center">
                <div class="card-body">
 <img   src="{{env('APP_URL')}}/build/icon/iraq.png" style="height: 198px; width: 205px;  padding_right: 10px;" class="img-lg  " alt="profile image" /><br><br>
          <h6 class="text-info text-center page-title"><b>آزمون PTE ارمنستان</b></h6>
  
 <a href="{{env('APP_URL')}}/user/regord/ptearm"> <button class="btn btn-info btn-md  btn-rounded btn-fw mt-3 mb-4"> <i class="fa fa-check-circle"></i> ثبت سفارش </button></a>
              
                </div>
              </div>
                    </div>
                    </div>
     @if($admins->user_tell=='09137775568')       
<div class="col-md-3 grid-margin stretch-card">
                    <div class="statistics-item">
     <div class="card text-center">
                <div class="card-body">
 <img   src="{{env('APP_URL')}}/build/icon/iraq.png" style="height: 198px; width: 205px;  padding_right: 10px;" class="img-lg  " alt="profile image" /><br><br>
          <h6 class="text-info text-center page-title"><b>     محصول تست</b></h6>
  
 <a href="{{env('APP_URL')}}/user/regord/buy_test"> <button class="btn btn-info btn-md  btn-rounded btn-fw mt-3 mb-4"> <i class="fa fa-check-circle"></i> ثبت سفارش </button></a>
              
                </div>
              </div>
                    </div>
                    </div>
                    @endif

           

             
                  </div>
                </div>
              </div> 
          </div>


 
  
  <br>

          <div class="page-header">
            <h5 class="page-title">
              خرید ماک PTE
            </h5>
          </div>
 

   <div class="row grid-margin">
            <div class="col-12">
              <div class="card  grid-margin stretch-card">
                <div class="card-body">
                  <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">

<!--
<div class="col-md-3 grid-margin stretch-card">
              <div class="card text-center">
                <div class="card-body">
 <img   src="{{env('APP_URL')}}/build/icon/ac.png" style="height: 198px; width: 205px; padding_right: 10px;" class="img-lg  " alt="profile image" /><br><br>
          <h6 class="text-info text-center page-title"><b>ماک گلد</b></h6>
 
                  <p class="text-info mt-4 card-text">  پکیج دوتایی با قابلیت انتخاب
                  </p>

 <a href="{{env('APP_URL')}}/user/regord/makac"> <button class="btn btn-info btn-md  btn-rounded btn-fw mt-3 mb-4"> <i class="fa fa-check-circle"></i> ثبت سفارش </button></a>
             
             
                </div>
              </div>
              </div>
-->

<div class="col-md-3 grid-margin stretch-card">
              <div class="card text-center">
                <div class="card-body">
 <img   src="{{env('APP_URL')}}/build/icon/new/Gold.png" style="height: 198px; width: 205px; padding_right: 10px;" class="img-lg  " alt="profile image" /><br><br>
          <h6 class="text-info text-center page-title"><b>ماک گلد</b></h6>
 
                  <p class="text-info mt-4 card-text">  پکیج دوتایی A و B به همراه سوالات اضافه
                  </p>
 <a href="{{env('APP_URL')}}/user/regord/makab_new"> <button class="btn btn-info btn-md  btn-rounded btn-fw mt-3 mb-4"> <i class="fa fa-check-circle"></i> ثبت سفارش </button></a>
              
                </div>
              </div>
              </div>
              
              
              <!--
<div class="col-md-3 grid-margin stretch-card">
              <div class="card text-center">
                <div class="card-body">
 <img   src="{{env('APP_URL')}}/build/icon/bc.png" style="height: 198px; width: 205px; padding_right: 10px;" class="img-lg  " alt="profile image" /><br><br>
          <h6 class="text-info text-center page-title"><b>ماک گلد</b></h6>
 
                  <p class="text-info mt-4 card-text">  پکیج دوتایی با قابلیت انتخاب
                  </p>
 <a href="{{env('APP_URL')}}/user/regord/makbc"> <button class="btn btn-info btn-md  btn-rounded btn-fw mt-3 mb-4"> <i class="fa fa-check-circle"></i> ثبت سفارش </button></a>
              
                </div>
              </div>
              </div>
-->
              
<div class="col-md-3 grid-margin stretch-card">
              <div class="card text-center">
                <div class="card-body">
 <img   src="{{env('APP_URL')}}/build/icon/new/platinum.png" style="height: 198px; width: 205px; padding_right: 10px;" class="img-lg  " alt="profile image" /><br><br>
          <h6 class="text-info text-center page-title"><b>ماک پلاتینیوم</b></h6>
 
                  <p class="text-info mt-4 card-text">  پکیج چهارتایی A و B و C و D به همراه سوالات اضافه
                  </p>
 <a href="{{env('APP_URL')}}/user/regord/makplatinum_new"> <button class="btn btn-info btn-md  btn-rounded btn-fw mt-3 mb-4"> <i class="fa fa-check-circle"></i> ثبت سفارش </button></a>
              
                </div>
              </div>
              </div>
              
              
              <!--
              <div class="col-md-3 grid-margin stretch-card">
              <div class="card text-center">
                <div class="card-body">
 <img   src="{{env('APP_URL')}}/build/icon/silvers.png"  style="height: 198px; width: 205px; padding_right: 10px;"  class="img-lg  " alt="profile image" /><br><br>
          <h6 class="text-info text-center page-title"><b>ماک سیلور</b></h6>
 
                  <p class="text-info mt-4 card-text"> پکیج تکی
                  </p>

 <a href="{{env('APP_URL')}}/user/regord/makac"> <button class="btn btn-info btn-md  btn-rounded btn-fw mt-3 mb-4"> <i class="fa fa-check-circle"></i> ثبت سفارش </button></a>
             
             
                </div>
              </div>
              </div>
              -->


<div class="col-md-3 grid-margin stretch-card">
              <div class="card text-center">
                <div class="card-body">
 <img   src="{{env('APP_URL')}}/build/icon/new/A.png" style="height: 198px; width: 205px; padding_right: 10px;" class="img-lg  " alt="profile image" /><br><br>
          <h6 class="text-info text-center page-title"><b>ماک تکی</b></h6>
 
                  <p class="text-info mt-4 card-text">  ماک تکی به همراه نمونه سوالات اضافه
                  </p>
 <a href="{{env('APP_URL')}}/user/regord/maka_new"> <button class="btn btn-info btn-md  btn-rounded btn-fw mt-3 mb-4"> <i class="fa fa-check-circle"></i> ثبت سفارش </button></a>
              
                </div>
              </div>
              </div>
              
              
              
<div class="col-md-3 grid-margin stretch-card">
              <div class="card text-center">
                <div class="card-body">
 <img   src="{{env('APP_URL')}}/build/icon/new/B.png" style="height: 198px; width: 205px; padding_right: 10px;" class="img-lg  " alt="profile image" /><br><br>
          <h6 class="text-info text-center page-title"><b>ماک تکی</b></h6>
 
                  <p class="text-info mt-4 card-text">  ماک تکی به همراه نمونه سوالات اضافه
                  </p>
 <a href="{{env('APP_URL')}}/user/regord/makb_new"> <button class="btn btn-info btn-md  btn-rounded btn-fw mt-3 mb-4"> <i class="fa fa-check-circle"></i> ثبت سفارش </button></a>
              
                </div>
              </div>
              </div>
              
              


            </div>
 
 

           <div class="row">


              
              
              
<div class="col-md-3 grid-margin stretch-card">
              <div class="card text-center">
                <div class="card-body">
 <img   src="{{env('APP_URL')}}/build/icon/new/C.png" style="height: 198px; width: 205px; padding_right: 10px;" class="img-lg  " alt="profile image" /><br><br>
          <h6 class="text-info text-center page-title"><b>ماک تکی</b></h6>
 
                  <p class="text-info mt-4 card-text">  ماک تکی به همراه نمونه سوالات اضافه
                  </p>
 <a href="{{env('APP_URL')}}/user/regord/makc_new"> <button class="btn btn-info btn-md  btn-rounded btn-fw mt-3 mb-4"> <i class="fa fa-check-circle"></i> ثبت سفارش </button></a>
              
                </div>
              </div>
              </div>
              
<div class="col-md-3 grid-margin stretch-card">
              <div class="card text-center">
                <div class="card-body">
 <img   src="{{env('APP_URL')}}/build/icon/new/D.png" style="height: 198px; width: 205px; padding_right: 10px;" class="img-lg  " alt="mak image" /><br><br>
          <h6 class="text-info text-center page-title"><b>ماک تکی</b></h6>
 
                  <p class="text-info mt-4 card-text">  ماک تکی به همراه نمونه سوالات اضافه
                  </p>
 <a href="{{env('APP_URL')}}/user/regord/makd_new"> <button class="btn btn-info btn-md  btn-rounded btn-fw mt-3 mb-4"> <i class="fa fa-check-circle"></i> ثبت سفارش </button></a>
              
                </div>
              </div>
              </div>
              
              
<div class="col-md-3 grid-margin stretch-card">
              <div class="card text-center">
                <div class="card-body">
 <img   src="{{env('APP_URL')}}/build/icon/new/E.png" style="height: 198px; width: 205px; padding_right: 10px;" class="img-lg  " alt="mak image" /><br><br>
          <h6 class="text-info text-center page-title"><b>ماک تکی</b></h6>
 
                  <p class="text-info mt-4 card-text">  ماک تکی به همراه نمونه سوالات اضافه
                  </p>
 <a href="{{env('APP_URL')}}/user/regord/make_new"> <button class="btn btn-info btn-md  btn-rounded btn-fw mt-3 mb-4"> <i class="fa fa-check-circle"></i> ثبت سفارش </button></a>
              
                </div>
              </div>
              </div>
              
 

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


