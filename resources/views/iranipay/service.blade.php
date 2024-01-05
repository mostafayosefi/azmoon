@extends('iranipay.layoutiranipay')

@section('title')
<title>{{$service->page_tit}}</title>
@stop
 
@section('superadmin')

<div class="container-fluid gtco-banner-area">
    <div class="container">
        <div class="row">
            <div class="col-md-6"  dir="rtl" align="right">
                <h1>{{$service->page_tit}}</h1>
                <p>  {{$service->page_kh}} </p>
                </div>
            <div class="col-md-6">
                <div class="card"><img class="card-img-top img-fluid" src="{{env('APP_URL')}}/build/solution/images/banner-img.png" alt=""></div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid gtco-feature" id="services">
    <div class="container">
        <div class="row">
            <div class="col-md-12"  dir="rtl" align="right">
      <?php echo $service->page_des;?>
  </div>
        </div>
    </div>
</div>
 

 
       
@stop

    
