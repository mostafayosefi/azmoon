
@extends('layoutlogin')

@section('title')
<title> ورود سوپر ادمین </title>
@stop

@section('contentsignin')
 
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            
          </h1>
          
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="error-page">
            <h2 class="headline text-yellow"> 404</h2>
            <div class="error-content">
              <h3><i class="fa fa-warning text-yellow"></i>  متاسفانه صفحه مورد نظر وجود ندارد</h3>
              <p>
         جهت بازگشت به صفحه اصلی سایت کلیک نمایید <a href="{{env('APP_URL')}}"> صفحه اصلی سایت </a>  
              </p>
             
            </div><!-- /.error-content -->
          </div><!-- /.error-page -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

</body>



@stop
