
@extends('cust.layoutuser')

@section('title')
<title>{{$form->form_name}} </title>
@stop

 
@section('superadmin')
 
 
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              {{$form->form_name}}
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{env('APP_URL')}}/user/panel">پنل</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$form->form_name}}</li>
              </ol>
            </nav>
          </div>
          <div class="row">
            <div class="col-md-3 grid-margin stretch-card">
            </div>
            <div class="col-md-6 grid-margin stretch-card">
            
            
            
      
                
            
            
              <div class="card">
                <div class="card-body">
                
                
                
@if($form->form_img!='') 
              <div class="card text-center">
                <div class="card-body">
   <img src="{{env('APP_URL')}}/public/images/{{$form->form_img}}"  style="height: 200px; width: 200px; padding_right: 10px;" class="img-lg  "  />
                  <h4 class="text-center">{{$form->form_name}}</h4>
                   
                </div>
              </div>
              <br>
 @else
              
      
                  <h4 class="card-title">{{$form->form_name}}</h4>
              <br>
      
              
@endif    
                
                 
      
                
                
                  
                  
	<link rel="stylesheet" href="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/pd/js-persian-cal.css">
	<script type="text/javascript" src="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/pd/js-persian-cal.min.js"></script>
	
	
<script src="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/jquery.js"></script>
 
		
 <form class="forms-sample" method="POST" action="{{$form->form_rnd}}/post" enctype="multipart/form-data"  onsubmit="return Validate(this);"   >
 
              
				 
					
@if(count($errors))
 

@foreach($errors->all() as $error)
<div class="breadcrumb bg-inverse-danger" >
<span  style="color: #000000"  >{{$error}}</span>  
</div> 
@endforeach
 
@endif  
		
 
@foreach($admins as $admin)

@if($admin->list_typ=='1') 

@if(($admin->form_linkname=='hotelscom'))   

 <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
  @if ($errors->has('name')) <label class="error mt-2 text-danger"  >{{$admin->list_name}}</label> @else 
 <label >{{$admin->list_name}}</label> @endif
 <input type="text" class="form-control"  name="name{{$admin->list_id}}"     value="{{ old('name') }}"   placeholder="{{$admin->list_pan}}"    >                
 </div>
   
@else

 <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
  @if ($errors->has('name')) <label class="error mt-2 text-danger"  >{{$admin->list_name}}</label> @else 
 <label >{{$admin->list_name}}</label> @endif
 <input type="text" class="form-control"  name="name{{$admin->list_id}}" @if($admin->list_price=='1')      value="{{$form->form_price}}"   placeholder="{{$form->form_price}} ريال" disabled="" @else   value="{{ old('name') }}"   placeholder="{{$admin->list_pan}}"  @endif       >                
 </div>

@endif


@if($admin->list_typ=='2')  
 <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
  @if ($errors->has('name')) <label class="error mt-2 text-danger"  >{{$admin->list_name}}</label> @else 
 <label >{{$admin->list_name}}</label> @endif
 <textarea class="form-control"  name="name{{$admin->list_id}}"  placeholder="{{$admin->list_pan}}" rows="4">{{ old('name') }}</textarea>
 </div>
@endif

@if($admin->list_typ=='3')
 <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
  @if ($errors->has('name')) <label class="error mt-2 text-danger"  >{{$admin->list_name}}</label> @else 
 <label >{{$admin->list_name}}</label> @endif
 <input type="password" class="form-control"  name="name{{$admin->list_id}}"  placeholder=""   value="{{ old('name') }}"   >                
 </div>

@endif





@if($admin->list_typ=='4')


<script>
	var _validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png"];    
function Validate(oForm) {
    var arrInputs = oForm.getElementsByTagName("input");
    for (var i = 0; i < arrInputs.length; i++) {
        var oInput = arrInputs[i];
        if (oInput.type == "file") {
            var sFileName = oInput.value;
            if (sFileName.length > 0) {
                var blnValid = false;
                for (var j = 0; j < _validFileExtensions.length; j++) {
                    var sCurExtension = _validFileExtensions[j];
                    if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                        blnValid = true;
                        break;
                    }
                }
                
                if (!blnValid) {
                    alert("Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
                    return false;
                }
            }
        }
    }
  
    return true;
}
</script>


   <script type="text/javascript">
    $(document).ready(function(){
        $('#file').change(function(){
               var fp = $("#file");
               var lg = fp[0].files.length; // get length
               var items = fp[0].files;
               var fileSize = 0;
           
           if (lg > 0) {
               for (var i = 0; i < lg; i++) {
                   fileSize = fileSize+items[i].size; // get file size
               }
               if(fileSize > 1047152) {
                    alert('حجم فایل آپلود شده نمی تواند بیشتر از 1 مگابایت باشد!');
                    $('#file').val('');
               }
           }
        });
    });
    </script>

                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
  @if ($errors->has('name')) <label class="error mt-2 text-danger"  >{{$admin->list_name}}</label> @else 
 <label >{{$admin->list_name}}</label> @endif
 <input type="file" name="name{{$admin->list_id}}" id="file"  multiple="multiple"  class="file-upload-default">
                      <div class="input-group col-xs-12">
                        <input type="text" class="form-control file-upload-info" disabled
                          placeholder="{{$admin->list_pan}}">
                        <span class="input-group-append">
                          <button class="file-upload-browse btn btn-primary" type="button">{{$admin->list_name}}</button>
                        </span>
                      </div>
                    </div>



@endif



@if($admin->list_typ=='5') 


 <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
  @if ($errors->has('name')) <label class="error mt-2 text-danger"  >{{$admin->list_name}}</label> @else 
 <label >{{$admin->list_name}}</label> @endif
 <input type="text" class="form-control" id="pcal1{{$admin->list_id}}"    name="name{{$admin->list_id}}"  placeholder="{{$admin->list_pan}}"   value="{{ old('name') }}"   >                
 </div>


<script type="text/javascript">
		var objCal1 = new AMIB.persianCalendar( 'pcal1<?php echo $admin->list_id; ?>', {
				extraInputID: 'pcal1<?php echo $admin->list_id; ?>',
				extraInputFormat: 'yyyy-mm-dd'
			}
		);
		
		var objCal1 = new AMIB.persianCalendar( 'pcal2', {
				extraInputID: 'pcal2',
				extraInputFormat: 'yyyy-mm-dd'
			}
		);
		

	
		
		var objCal3 = new AMIB.persianCalendar( 'pcal3', {
				defaultDate: 'YYYY-MM-DD'
			}
		);
		
		var objCal4 = new AMIB.persianCalendar( 'pcal4', {
				onchange: function( pdate ){
					if( pdate ) {
						alert( pdate.join( '/' ) );
					} else {
						alert( 'تاریخ واردشده نادرست است' );
					}
				}
			}
		);

		var objCal5 = new AMIB.persianCalendar( 'pcal5', {
				extraInputID: 'extra',
				extraInputFormat: 'YYYY-MM-DD - yyyy-mm-dd - JD'
			}
		);
	</script>

 
@endif




@if($admin->list_typ=='6')


 
	
	 <div class="input-group date" id="timepicker-example" data-target-input="nearest"> <label >{{$admin->list_name}}</label> 
                        <div class="input-group" data-target="#timepicker-example" data-toggle="datetimepicker">
                          <input type="text" class="form-control datetimepicker-input"
                            data-target="#timepicker-example"  name="name{{$admin->list_id}}"  />
                          <div class="input-group-addon input-group-append"><i
                              class="far fa-clock input-group-text"></i>
                          </div>
                        </div>
                      </div>
 <br>
	  
 
@endif




@if($admin->list_typ=='7')
 
 
<script src="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/datepicker/bootstrap.min.js"></script>

<script src="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/datepicker/jasny-bootstrap.min.js"></script>

 
<link href="{{env('APP_URL')}}/build/servicepay/Mouldifi _ Dashboard_files/datepicker/bootstrap-datepicker.css" rel="stylesheet">
 
   
 
 						
	 


      <link rel="stylesheet" href="{{env('APP_URL')}}/build/gdspanel/datepick/css/pikaday.css"> 
      
  <div class="autocomplete"   ><label >{{$admin->list_name}}</label> 
 <span class="datepicker-wrapper dtp-wrap-from dtp-wrap-from-long"  style="  font-family:'WYekan','Helvetica Neue',Helvetica,Atahoma;" >
                 
 <input   type="text" class="form-control"  placeholder="{{$admin->list_pan}}"  id="start{{$admin->list_id}}"  name="name{{$admin->list_id}}"  data-format="D, dd MM yyyy"  >
              
  </span>
  </div> 
  <br>
  
  
  
  

      
    <script src="{{env('APP_URL')}}/build/gdspanel/datepick/pikaday.js"></script>
    <script>
    var startDate<?php echo $admin->list_id; ?>,
        endDate,
        updateStartDate = function() {
            startPicker.setStartRange(startDate<?php echo $admin->list_id; ?>);
            endPicker.setStartRange(startDate<?php echo $admin->list_id; ?>);
            endPicker.setMinDate(startDate<?php echo $admin->list_id; ?>);
        },
        updateEndDate = function() {
            startPicker.setEndRange(endDate);
            startPicker.setMaxDate(endDate);
            endPicker.setEndRange(endDate);
        },
        startPicker = new Pikaday({
            field: document.getElementById('start<?php echo $admin->list_id; ?>'),
            minDate: new Date(),
            maxDate: new Date(2000, 12, 31),
            onSelect: function() {
                startDate<?php echo $admin->list_id; ?> = this.getDate();
                updateStartDate();
            }
        }),
        endPicker = new Pikaday({
            field: document.getElementById('end'),
            minDate: new Date(),
            maxDate: new Date(2030, 12, 31),
            onSelect: function() {
                endDate = this.getDate();
                updateEndDate();
            }
        }),
        _startDate = startPicker.getDate(),
        _endDate = endPicker.getDate();

        if (_startDate) {
            startDate<?php echo $admin->list_id; ?> = _startDate;
            updateStartDate();
        }

        if (_endDate) {
            endDate = _endDate;
            updateEndDate();
        }
    </script>
       
        
            
        
  

    <script src="{{env('APP_URL')}}/build/style/bootstrap/js/bootstrap.min.js"></script> 
    
    
    



@endif



@if($admin->list_typ=='8')
 
<div class="form-group {{ (($errors->has('name'))||(Session::get('repeat')==1))  ? 'has-error' : '' }}"> 
@if($errors->has('name')) <label  class="col-sm-3 control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{{$admin->list_name}}</label> @else <label class="col-sm-3 control-label">{{$admin->list_name}}</label>   @endif
									
 <div class="col-sm-9"> 
 <select class="select2-placeholer form-control " data-placeholder="{{$admin->list_name}}"   name="name{{$admin->list_id}}" dir="rtl" >
<option value="">انتخاب کنید</option> 
@foreach ($formselects as $formselect)  @if($admin->list_id==$formselect->formselect_formilistd)    
<option value="{{$formselect->formselect_id}}">{{$formselect->formselect_name}}</option> 
@endif
@endforeach 
 </select>
 </div>
 </div>

 <div class="line-dashed"></div> 

@endif





@if($admin->list_typ=='9')<hr>
 <div class="row">
 
  <input type="hidden" name="name{{$admin->list_id}}" value="{{$admin->list_name}}">
 
                      <div class="col-md-12">
                        <div class="form-group">
 <label class="col-sm-12 control-label">{{$admin->list_name}}</label> 
                         
@foreach ($formchecks as $formselect) @if($admin->list_id==$formselect->formcheckbox_formilistd)  <br>    
                          <div class="form-check form-check-info">
                            <label class="form-check-label">
     <input type="checkbox" class="form-check-input" name="field_chck{{$admin->list_id}}[]" value="{{$formselect->formcheckbox_id}}"> {{$formselect->formcheckbox_name}}  
                            </label>
                          </div>

  @endif @endforeach  
                          
 
                        </div>
                      </div>
                  
                      </div>
<hr>
@endif


@endforeach
		
		 
                    
							
                     <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    
                    <button type="submit" class="btn btn-primary mr-2">ثبت و پرداخت</button> 
                  </form>
                </div>
              </div>
            </div>
            
            <div class="col-md-3 grid-margin stretch-card">
            
            </div>
            
            
            </div>
            </div> 
            </div> 

 

@stop


