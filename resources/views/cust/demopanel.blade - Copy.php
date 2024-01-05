
@extends('cust.layoutuser')

@section('title')
<title>دمو پنل </title>
@stop

 
@section('superadmin')
 
       <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              داشبورد
            </h3>
          </div>
          <div class="row grid-margin">
            <div class="col-12">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                    <div class="statistics-item">
                      <p>
                        <i class="icon-sm fa fa-user ml-2"></i>
                        کاربران جدید
                      </p>
                      <h2>54000</h2>
                      <label class="badge badge-outline-success badge-pill">2.7% افزایش</label>
                    </div>
                    <div class="statistics-item">
                      <p>
                        <i class="icon-sm fas fa-hourglass-half ml-2"></i>
                        میانگین زمانی
                      </p>
                      <h2>123.50</h2>
                      <label class="badge badge-outline-danger badge-pill">30% کاهش</label>
                    </div>
                    <div class="statistics-item">
                      <p>
                        <i class="icon-sm fas fa-cloud-download-alt ml-2"></i>
                        دانلود ها
                      </p>
                      <h2>3500</h2>
                      <label class="badge badge-outline-success badge-pill">12% افزایش</label>
                    </div>
                    <div class="statistics-item">
                      <p>
                        <i class="icon-sm fas fa-check-circle ml-2"></i>
                        به روز رسانی
                      </p>
                      <h2>7500</h2>
                      <label class="badge badge-outline-success badge-pill">57% افزایش</label>
                    </div>
                    <div class="statistics-item">
                      <p>
                        <i class="icon-sm fas fa-chart-line ml-2"></i>
                        فروش
                      </p>
                      <h2>9000</h2>
                      <label class="badge badge-outline-success badge-pill">10% افزایش</label>
                    </div>
                    <div class="statistics-item">
                      <p>
                        <i class="icon-sm fas fa-circle-notch ml-2"></i>
                        در انتظار پرداخت
                      </p>
                      <h2>7500</h2>
                      <label class="badge badge-outline-danger badge-pill">16% کاهش</label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">
                    <i class="fas fa-gift"></i>
                    سفارشات
                  </h4>
                  <canvas id="orders-chart"></canvas>
                  <div id="orders-chart-legend" class="orders-chart-legend"></div>
                </div>
              </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">
                    <i class="fas fa-chart-line"></i>
                    فروش
                  </h4>
                  <h2 class="mb-5">56000 <span class="text-muted h4 font-weight-normal">فروش</span></h2>
                  <canvas id="sales-chart"></canvas>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4 grid-margin stretch-card">
              <div class="card">
                <div class="card-body d-flex flex-column">
                  <h4 class="card-title">
                    <i class="fas fa-chart-pie"></i>
                    وضعیت فروش
                  </h4>
                  <div class="flex-grow-1 d-flex flex-column justify-content-between">
                    <canvas id="sales-status-chart" class="mt-3"></canvas>
                    <div class="pt-4">
                      <div id="sales-status-chart-legend" class="sales-status-chart-legend"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">
                    <i class="far fa-futbol"></i>
                    فعالیت
                  </h4>
                  <ul class="solid-bullet-list">
                    <li>
                      <h5>۴ نفر این پست را به اشتراک گذاشتند
                        <span class="float-left text-muted font-weight-normal small">8:30 AM</span>
                      </h5>
                      <p class="text-muted">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم!</p>
                      <div class="image-layers">
                        <div class="img-sm profile-image-text bg-warning rounded-circle image-layer-item">M</div>
                        <img class="img-sm rounded-circle image-layer-item" src="{{env('APP_URL')}}/build/melody/images/faces/face3.jpg"
                          alt="profile" />
                        <img class="img-sm rounded-circle image-layer-item" src="{{env('APP_URL')}}/build/melody/images/faces/face5.jpg"
                          alt="profile" />
                        <img class="img-sm rounded-circle image-layer-item" src="{{env('APP_URL')}}/build/melody/images/faces/face8.jpg"
                          alt="profile" />
                      </div>
                    </li>
                    <li>
                      <h5>نسترن پستی ارسال کرد
                        <span class="float-left text-muted font-weight-normal small">11:40 AM</span>
                      </h5>
                      <p class="text-muted">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم!</p>
                    </li>
                    <li>
                      <h5>مرتضی پستی ارسال کرد
                        <span class="float-left text-muted font-weight-normal small">4:30 PM</span>
                      </h5>
                      <p class="text-muted">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم!</p>
                    </li>
                  </ul>
                  <div class="border-top pt-3">
                    <div class="d-flex justify-content-between">
                      <button class="btn btn-outline-dark">بیشتر</button>
                      <button class="btn btn-primary btn-icon-text">
                        افزودن
                        <i class="btn-icon-append fas fa-plus mr-2 ml-0"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4 grid-margin stretch-card">
              <div class="card">
                <div class="card-body d-flex flex-column">
                  <h4 class="card-title">
                    <i class="fas fa-tachometer-alt"></i>
                    فروش روزانه
                  </h4>
                  <p class="card-description">میزان فروش روزانه در یک ماه اخیر</p>
                  <div class="flex-grow-1 d-flex flex-column justify-content-between">
                    <canvas id="daily-sales-chart" class="mt-3 mb-3 mb-md-0"></canvas>
                    <div id="daily-sales-chart-legend" class="daily-sales-chart-legend pt-4 border-top"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">
                    <i class="fas fa-envelope"></i>
                    صندوق دریافت (31)
                  </h4>
                  <div class="table-responsive">
                    <table class="table">
                      <tbody>
                        <tr>
                          <td>
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input">
                              </label>
                            </div>
                          </td>
                          <td class="py-1">
                            <img src="{{env('APP_URL')}}/build/melody/images/faces/face13.jpg" alt="profile" class="img-sm rounded-circle" />
                          </td>
                          <td class="font-weight-bold">
                            مرتضی محمد
                          </td>
                          <td>
                            <label class="badge badge-light badge-pill">برنامه نویس</label>
                          </td>
                          <td>
                            لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم!
                          </td>
                          <td>
                            <i class="fas fa-ellipsis-v"></i>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input">
                              </label>
                            </div>
                          </td>
                          <td class="py-1">
                            <img src="{{env('APP_URL')}}/build/melody/images/faces/face2.jpg" alt="profile" class="img-sm rounded-circle" />
                          </td>
                          <td class="font-weight-bold">
                            نسترن افشار
                          </td>
                          <td>
                            <label class="badge badge-light badge-pill">برنامه نویس</label>
                          </td>
                          <td>
                            لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم
                          </td>
                          <td>
                            <i class="fas fa-ellipsis-v"></i>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input">
                              </label>
                            </div>
                          </td>
                          <td class="py-1">
                            <div class="img-sm rounded-circle bg-warning profile-image-text">ز</div>
                          </td>
                          <td class="font-weight-bold">
                            زهرا رسولی
                          </td>
                          <td>
                            <label class="badge badge-light badge-pill">حسابدار</label>
                          </td>
                          <td>
                            لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم
                          </td>
                          <td>
                            <i class="fas fa-ellipsis-v"></i>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input">
                              </label>
                            </div>
                          </td>
                          <td class="py-1">
                            <img src="{{env('APP_URL')}}/build/melody/images/faces/face11.html" alt="profile" class="img-sm rounded-circle" />
                          </td>
                          <td class="font-weight-bold">
                            رضا کریمی
                          </td>
                          <td>
                            <label class="badge badge-light badge-pill">برنامه نویس</label>
                          </td>
                          <td>
                            لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم
                          </td>
                          <td>
                            <i class="fas fa-ellipsis-v"></i>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input">
                              </label>
                            </div>
                          </td>
                          <td class="py-1">
                            <div class="img-sm rounded-circle bg-info profile-image-text">ن</div>
                          </td>
                          <td class="font-weight-bold">
                            نیلوفر ستوده
                          </td>
                          <td>
                            <label class="badge badge-light badge-pill">طراح سایت</label>
                          </td>
                          <td>
                            لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم
                          </td>
                          <td>
                            <i class="fas fa-ellipsis-v"></i>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-8 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">
                    <i class="fas fa-table"></i>
                    اطلاعات فروش
                  </h4>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>مشتری</th>
                          <th>کد محصول</th>
                          <th>تعداد سفارش</th>
                          <th>وضعیت</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="font-weight-bold">
                            مرتضی کریمی
                          </td>
                          <td class="text-muted">
                            PT613
                          </td>
                          <td>
                            350
                          </td>
                          <td>
                            <label class="badge badge-success badge-pill">ارسال شده</label>
                          </td>
                        </tr>
                        <tr>
                          <td class="font-weight-bold">
                            نرگس کاشف
                          </td>
                          <td class="text-muted">
                            ST456
                          </td>
                          <td>
                            520
                          </td>
                          <td>
                            <label class="badge badge-warning badge-pill">در حال پردازش</label>
                          </td>
                        </tr>
                        <tr>
                          <td class="font-weight-bold">
                            اکبر رضایی
                          </td>
                          <td class="text-muted">
                            CS789
                          </td>
                          <td>
                            830
                          </td>
                          <td>
                            <label class="badge badge-danger badge-pill">نا موفق</label>
                          </td>
                        </tr>
                        <tr>
                          <td class="font-weight-bold">
                            نیلوفر افشار
                          </td>
                          <td class="text-muted">
                            LP908
                          </td>
                          <td>
                            579
                          </td>
                          <td>
                            <label class="badge badge-primary badge-pill">تحویل داده شده</label>
                          </td>
                        </tr>
                        <tr>
                          <td class="font-weight-bold">
                            سوسن کاشفی
                          </td>
                          <td class="text-muted">
                            HF675
                          </td>
                          <td>
                            790
                          </td>
                          <td>
                            <label class="badge badge-info badge-pill">در حال ارسال</label>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">تقویم</h4>
                  <div id="taghvim" class="datepicker mt-5"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-7 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">
                    <i class="fas fa-thumbtack"></i>
                    لیست انجام کارها
                  </h4>
                  <div class="add-items d-flex">
                    <input type="text" class="form-control todo-list-input"
                      placeholder="امروز چه کاری میخواهید انجام دهید؟">
                    <button class="add btn btn-primary font-weight-bold todo-list-add-btn" id="add-task">افزودن</button>
                  </div>
                  <div class="list-wrapper">
                    <ul class="d-flex flex-column-reverse todo-list">
                      <li>
                        <div class="form-check">
                          <label class="form-check-label">
                            <input class="checkbox" type="checkbox">
                            جلسه
                          </label>
                        </div>
                        <i class="remove fa fa-times-circle"></i>
                      </li>
                      <li class="completed">
                        <div class="form-check">
                          <label class="form-check-label">
                            <input class="checkbox" type="checkbox" checked>
                            کنفرانس تلفنی
                          </label>
                        </div>
                        <i class="remove fa fa-times-circle"></i>
                      </li>
                      <li>
                        <div class="form-check">
                          <label class="form-check-label">
                            <input class="checkbox" type="checkbox">
                            ارسال محصولات
                          </label>
                        </div>
                        <i class="remove fa fa-times-circle"></i>
                      </li>
                      <li>
                        <div class="form-check">
                          <label class="form-check-label">
                            <input class="checkbox" type="checkbox">
                            خرید منزل
                          </label>
                        </div>
                        <i class="remove fa fa-times-circle"></i>
                      </li>
                      <li class="completed">
                        <div class="form-check">
                          <label class="form-check-label">
                            <input class="checkbox" type="checkbox" checked>
                            آماده کردن متن جلسه
                          </label>
                        </div>
                        <i class="remove fa fa-times-circle"></i>
                      </li>
                      <li>
                        <div class="form-check">
                          <label class="form-check-label">
                            <input class="checkbox" type="checkbox">
                            بردن بچه ها به مدرسه
                          </label>
                        </div>
                        <i class="remove fa fa-times-circle"></i>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-5 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">
                    <i class="fas fa-rocket"></i>
                    پروژه ها
                  </h4>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>
                            مسئول پروژه
                          </th>
                          <th>
                            نام پروژه
                          </th>
                          <th>
                            اولویت
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="py-1">
                            <img src="{{env('APP_URL')}}/build/melody/images/faces/face1.jpg" alt="profile" class="img-sm rounded-circle" />
                          </td>
                          <td>
                            پروژه 1
                          </td>
                          <td>
                            <label class="badge badge-warning badge-pill">متوسط</label>
                          </td>
                        </tr>
                        <tr>
                          <td class="py-1">
                            <img src="{{env('APP_URL')}}/build/melody/images/faces/face2.jpg" alt="profile" class="img-sm rounded-circle" />
                          </td>
                          <td>
                            پروژه 2
                          </td>
                          <td>
                            <label class="badge badge-danger badge-pill">زیاد</label>
                          </td>
                        </tr>
                        <tr>
                          <td class="py-1">
                            <img src="{{env('APP_URL')}}/build/melody/images/faces/face3.jpg" alt="profile" class="img-sm rounded-circle" />
                          </td>
                          <td>
                            پروژه 3
                          </td>
                          <td>
                            <label class="badge badge-success badge-pill">کم</label>
                          </td>
                        </tr>
                        <tr>
                          <td class="py-1">
                            <img src="{{env('APP_URL')}}/build/melody/images/faces/face4.jpg" alt="profile" class="img-sm rounded-circle" />
                          </td>
                          <td>
                            پروژه 4
                          </td>
                          <td>
                            <label class="badge badge-warning badge-pill">متوسط</label>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <div class="d-md-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center mb-3 mb-md-0">
                      <button class="btn btn-social-icon btn-facebook btn-rounded">
                        <i class="fab fa-facebook-f"></i>
                      </button>
                      <div class="mr-3 mt-2">
                        <h5 class="mb-0">فیسبوک</h5>
                        <p class="mb-0">813 دوست</p>
                      </div>
                    </div>
                    <div class="d-flex align-items-center mb-3 mb-md-0">
                      <button class="btn btn-social-icon btn-twitter btn-rounded">
                        <i class="fab fa-twitter"></i>
                      </button>
                      <div class="mr-3 mt-2">
                        <h5 class="mb-0">توییتر</h5>
                        <p class="mb-0">9000 دنبال کننده</p>
                      </div>
                    </div>
                    <div class="d-flex align-items-center mb-3 mb-md-0">
                      <button class="btn btn-social-icon btn-google btn-rounded">
                        <i class="fab fa-google-plus-g"></i>
                      </button>
                      <div class="mr-3 mt-2">
                        <h5 class="mb-0">گوگل پلاس</h5>
                        <p class="mb-0">780 دوست</p>
                      </div>
                    </div>
                    <div class="d-flex align-items-center">
                      <button class="btn btn-social-icon btn-linkedin btn-rounded">
                        <i class="fab fa-linkedin-in"></i>
                      </button>
                      <div class="mr-3 mt-2">
                        <h5 class="mb-0">لینکدین</h5>
                        <p class="mb-0">1090 اتصال</p>
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


