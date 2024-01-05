<?php

namespace App\Http\Controllers\Superadmin;

use Illuminate\Http\Request;
use Auth;
use Session;
use DB;
use Crypt;
use Rule;
use Mail;
use jDate;    
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SuperadminController extends Controller
{



	 

public function demothemmelody(){ 
 return view('sup.demo'); 
}
	 

public function demopanel(){ 
 return view('sup.demopanel'); 
}
	  
	
	
	 

public function superadminlogin(){

$mngindexs = \DB::table('mngindex') ->where('id', '=', '1')->orderBy('id', 'desc')->first();
Session::set('ind_himglog', $mngindexs->ind_himglog);
Session::set('ind_himglogmini', $mngindexs->ind_himglogmini);
 return view('sup.login');
 
}
	
	
	
    public function superadminPosts(Request $request)
    {
    	$this->validate($request,[
    			'firstname' => 'required',
    			'lastname' => 'required'
    		],[
    			'firstname.required' => 'لطفا نام کاربری را وارد نمایید',
    			'lastname.required' => 'لطفا رمز ورود را وارد نمایید',
    			
    		]);
	//$output = false;
	//$key =  env('APP_KEY');
	//$iv = md5($key);
	//$output = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $request->lastname, MCRYPT_MODE_CBC, $iv);
	//$output = base64_encode($output);
	
//$encryptedPassword =  Crypt::encrypt($request->lastname);

$superadmins = DB::table('superadmins')->where([
    ['superadmin_username',  $request->firstname],
])->first();
if($superadmins){

$password_db= $superadmins->superadmin_userpassword; 
$decryptedPassword =  Crypt::decrypt($password_db);
$userscou = DB::table('superadmins')->where([
    ['superadmin_username',  $request->firstname],
])->count();
$id_db= $superadmins->id;
$username_db= $superadmins->superadmin_username; 
$password_db= $superadmins->superadmin_userpassword; 
$username_log = $request->firstname; 
if(($username_log == $username_db)&&( $decryptedPassword == $request->lastname)){
	
	Session::set('idsuperadmin', $id_db);
	Session::set('signsuperadmin', $username_db);	
$adminslp = \DB::table('superadmins')->where('id', '=', $id_db)  ->orderBy('id', 'desc')->first();
$logindatepas=$adminslp->superadmin_logindate;	
$supimg=$adminslp->superadmin_img;	
 
if(empty($supimg)){$supimg='user2x.png';}	
	Session::set('logindatepas', $logindatepas);
	Session::set('supimg', $supimg);
	
	
$mngindexs = \DB::table('mngindex') ->where('id', '=', '1')->orderBy('id', 'desc')->first();
Session::set('ind_himglog', $mngindexs->ind_himglog);
	
	$updatee = \DB::table('superadmins')->where('id', '=', Session::get('idsuperadmin'))  ->update(['superadmin_logindate' => date('Y-m-d H:i:s') ,    'superadmin_ip' => $request->ip()  ]); 
	
	

$dateshamsi=$request->dateshamsi;	
$bcodee = explode("/",$dateshamsi); $year=$bcodee['0'];   $month=$bcodee['1'];   $day=$bcodee['2']; 
$updatee = \DB::table('dateshamsi')->where('id', '=', 1)  ->update(['date' => $dateshamsi ,    'year' => $year  ,    'month' => $month  ,    'day' => $day   ]); 


	
	Session::set('flagpanel', '1');
			return redirect('superadmin/panel'); 
		} else 
			 $nametr = Session::flash('statust', 'اطلاعات را به درستی وارد نمایید.');
				return redirect('superadmin/sign-in'); 
		
			
}
		else if(empty($superadmins)) {
			 $nametr = Session::flash('statust', 'اطلاعات را به درستی وارد نمایید.');
				return redirect('superadmin/sign-in'); 
		}
		
		
		
    }



public function alertsup($iduser,$typ,$link,$req){ 


/* 
$typ==15  tiket sup  
*/

DB::table('alert')->insert([
    [ 'iduser' =>  $iduser , 'type' =>  $typ , 'show' =>  0  ,   'date' =>  date('Y-m-d H:i:s') , 'link' =>  $link, 'req' =>  $req ]
]);  
    	

}


public function showupdatealert($typ,$link,$req){ 
 

$updatee = \DB::table('alert')
->join('user', 'alert.iduser', '=', 'user.id')  ->where([
    ['alert.type', '=', $typ],
    ['alert.link', '=', $link],
    ['alert.req', '=', $req],
    ['alert.alert_id', '<>', 0], ])  ->update(['show' => 1   ]); 


$h = new SuperadminController();
$h->viewalertnot();

}

public function viewalertnot(){ 
 
$admins  = \DB::table('alert')
->join('user', 'alert.iduser', '=', 'user.id')  ->where([
    ['user.id', '<>',  0], 
    ['alert.type', '<>',  15], 
    ['alert.show', '=',  0],  ])
    ->orderBy('alert_id', 'desc')->limit(5)->get(); 
    
    
$countalert  = \DB::table('alert')
->join('user', 'alert.iduser', '=', 'user.id')  ->where([
    ['user.id', '<>',  0], 
    ['alert.type', '<>',  15], 
    ['alert.show', '=',  0],  ])
    ->orderBy('alert_id', 'desc')->count(); 
 
 Session::set('countalert', $countalert);  
 Session::set('alertnotf', $admins);  
 
 }
	 


public function panel(){
if (Session::has('signsuperadmin')){ 
 
Session::set('nav', 'panel'); 


$h = new SuperadminController();
$h->viewalertnot();



$mngindexs = \DB::table('mngindex') ->where('id', '=', '1')->orderBy('id', 'desc')->first();
Session::set('ind_himglog', $mngindexs->ind_himglog);

$admins =  DB::table('user')->where([['id', '<>',  '0'],])->count();
$listusers =  DB::table('user')->where([['id', '<>',  '0'],])->limit(5)->orderBy('id', 'desc')->get(); 
$useractives =  DB::table('user')->where([['id', '<>',  '0'],['user_active', '=',  '1'],])->count(); 

 

$havs = \DB::table('currencytransfer')->where([
    ['currencytransfer.ctrf_id', '<>', 0], 
    ['currencytransfer.ctrf_type', '=', 1], ])
    ->orderBy('ctrf_id', 'desc')->count();
    
$havsactive = \DB::table('currencytransfer')->where([
    ['currencytransfer.ctrf_id', '<>', 0], 
    ['currencytransfer.ctrf_type', '=', 1],
    ['currencytransfer.ctrf_active', '=', 1], ])
    ->orderBy('ctrf_id', 'desc')->count();

$servess = \DB::table('currencytransfer')->where([
    ['currencytransfer.ctrf_id', '<>', 0], 
    ['currencytransfer.ctrf_type', '=', 2], ])
    ->orderBy('ctrf_id', 'desc')->count();
    
$serviceactive = \DB::table('currencytransfer')->where([
    ['currencytransfer.ctrf_id', '<>', 0], 
    ['currencytransfer.ctrf_type', '=', 2],
    ['currencytransfer.ctrf_active', '=', 1], ])
    ->orderBy('ctrf_id', 'desc')->count();

 
 
$finicalscount  = \DB::table('currencytransfer')
->join('currency', 'currencytransfer.ctrf_cur', '=', 'currency.id') 
->join('productcurtrans', 'currencytransfer.ctrf_id', '=', 'productcurtrans.prcrtr_idcrtrf') ->where([ 
    ['currencytransfer.ctrf_id', '<>', 0],   ])
    ->orderBy('prcrtr_id', 'desc')->count(); 	

$finicalsactivecount  = \DB::table('currencytransfer')
->join('currency', 'currencytransfer.ctrf_cur', '=', 'currency.id') 
->join('productcurtrans', 'currencytransfer.ctrf_id', '=', 'productcurtrans.prcrtr_idcrtrf') ->where([ 
    ['currencytransfer.ctrf_id', '<>', 0], 
    ['productcurtrans.prcrtr_payment', '<>', 0],   ])
    ->orderBy('prcrtr_id', 'desc')->count(); 	 
	
	 
 

return view('sup/demopanel' , ['admins' => $admins , 'useractives' => $useractives , 'havs' => $havs , 'havsactive' => $havsactive , 'servess' => $servess , 'serviceactive' => $serviceactive   ,'finicalscount' => $finicalscount     ,'finicalsactivecount' => $finicalsactivecount  ,'listusers' => $listusers   ]); 

 

}	
else{ return redirect('superadmin/sign-in'); }
}
		
		
		
		
		
	public function superadminsignout(){	
	Session::forget('idsuperadmin');	
	Session::forget('signsuperadmin');
	Session::forget('logindatepas');
	Session::forget('supimg');
	Session::forget('idimg');
	Session::forget('tickreadprofessorsup');
		return redirect('superadmin/sign-in');
		}




	public function myprofile(){
if (Session::has('signsuperadmin')){ 

	Session::set('nav', 'panel'); 
$admins = \DB::table('superadmins')->where('id', '=', Session::get('idsuperadmin'))  ->orderBy('id', 'desc')->get();
return view('superadmin.myprofile', ['admins' => $admins]);
}	
else{ return redirect('superadmin/sign-in'); }
				}
				
		
		
			
	public function editmyprofilePost(  Request $request ){
if (Session::has('signsuperadmin')){ 

 
$this->validate($request,[
    			'username' => 'required|min:3|max:35',
    			'tell' => 'required|numeric',
    			'email' => 'required|email'
    		],[
    			'username.required' => 'نام کاربری را وارد نمایید',
    			'username.min' => 'نام کاربری کوتاه است',
    			'username.max' => 'نام کاربری غیرقابل قبول است',
    			'tell.required' => 'شماره تلفن را بصورت صحیح وارد کنید',
    			'tell.numeric' => 'شماره غیرقابل قبول است',
    			'email.required' => 'ایمیل را بصورت صحیح وارد کنید',
    			'email.email' => 'فرمت ایمیل غیرقابل قبول است',
    			
    		]);
 
$updatee = \DB::table('superadmins')->where('id', '=', Session::get('idsuperadmin'))  ->update(['superadmin_username' => $request->username ,  'superadmin_tell' => $request->tell ,  'superadmin_email' => $request->email ,  'superadmin_ip' => $request->ip()  ]); 

$admins = \DB::table('superadmins')->where('id', '=', Session::get('idsuperadmin'))  ->orderBy('id', 'desc')->get();

			 $nametr = Session::flash('statust', 'اطلاعات پروفایل من باموفقیت ویرایش شد.');
		  	$nametrt = Session::flash('sessurl', 'myprofile/edit/sup');


$admins = \DB::table('superadmins')->where('id', '=',  Session::get('idsuperadmin'))  ->orderBy('id', 'desc')->first();


	
$user = \DB::table('superadmins')->where('id', '=', Session::get('idsuperadmin'))  ->orderBy('id', 'desc')->first();

/*
 $usernamee = $user->superadmin_username; 
 $titmes='اطلاعات شما با موفقیت تغییر کرد';
 $mestt='نام کاربری جدید';
 $mesnot = $usernamee; 
 
  Mail::send('superadmin.mail', ['user' => $user , 'usernamee' => $usernamee, 'mesnot' => $mesnot, 'titmes' => $titmes , 'mestt' => $mestt], function ($m) use ($user) {      
$decryptedPassword =  Crypt::decrypt($user->superadmin_userpassword);
            $m->from('info@melatpay.com', 'تغییر نام کاربری');
            $m->to($user->superadmin_email, $user->superadmin_email)->subject('ویرایش اطلاعات');
        }); 	
         	*/
		 return view('superadmin.success');
 
}	
else{ return redirect('superadmin/sign-in'); }
				}




public function dropzoneStoredmyprofile(Request $request)
    {
        $image = $request->file('file');
        $imageName = time().$image->getClientOriginalName();
        $image->move(public_path('images'),$imageName);        
$updatee = \DB::table('superadmins')->where('id', '=', Session::get('idsuperadmin'))  ->update(['superadmin_img' => $imageName   ]); 
$adminslp = \DB::table('superadmins')->where('id', '=', Session::get('idsuperadmin'))  ->orderBy('id', 'desc')->first();
$supimg=$adminslp->superadmin_img;	
	Session::set('supimg', $supimg);
        return response()->json(['success'=>$imageName]);
    }		





		
		
	public function securityysup( Request $request ){
if (Session::has('signsuperadmin')){ 

  	$this->validate($request,[
    			'userpassword' => 'required|min:5|max:35|confirmed',
    			'tell' => 'required',
    			'email' => 'required',
    		],[
    			'userpassword.required' => 'لطفا رمز ورود را وارد نمایید',
    			'userpassword.min' => ' رمز کوتاه است',
    			'userpassword.max' => ' رمزعبور طولانی است ',
    			'userpassword.confirmed' => 'رمزعبور با تکرار آن مطابقت ندارد ',
    			'tell.required' => 'دقت نمایید تا زمانی که شماره تلفن شما ثبت نشده باشد شما نمی توانید رمز خود را تغییر دهید',
    			'email.required' => 'دقت نمایید تا زمانی که ایمیل شما ثبت نشده باشد شما نمی توانید رمز خود را تغییر دهید',
    		]);
    		
	
$encryptedPassword =  Crypt::encrypt($request->userpassword);
$decryptedPassword =  Crypt::decrypt($encryptedPassword);

$updatee = \DB::table('superadmins')->where('id', '=', Session::get('idsuperadmin'))  ->update(['superadmin_userpassword' => $encryptedPassword   ]); 

$admins = \DB::table('superadmins')->where('id', '=',  Session::get('idsuperadmin'))  ->orderBy('id', 'desc')->first();

			 $nametr = Session::flash('statust', 'رمز شما با موفقیت تغییر کرد.');
		  	$nametrt = Session::flash('sessurl', 'myprofile/edit/sup');	
		  	
 	
$user = \DB::table('superadmins')->where('id', '=', Session::get('idsuperadmin'))  ->orderBy('id', 'desc')->first();
/*
 	if ( $user->superadmin_email != '')  {
 	 $usernamee = $user->superadmin_username; 
 $titmes='رمز شما با موفقیت تغییر کرد';
 $mestt='رمزجدید';
 $mesnot = Crypt::decrypt($user->superadmin_userpassword); 
   Mail::send('superadmin.mail', ['user' => $user , 'usernamee' => $usernamee, 'mesnot' => $mesnot, 'titmes' => $titmes , 'mestt' => $mestt], function ($m) use ($user) {       
$decryptedPassword =  Crypt::decrypt($user->superadmin_userpassword);
            $m->from('info@melatpay.com', 'رمز جدید');
            $m->to($user->superadmin_email, $user->superadmin_email)->subject('امنیت اطلاعات');
        }); 	
 } 
 */
 
 /*
 	if ( $user->superadmin_tell != '')  {
 		
 $admins =  \DB::table('superadmins')->where('id', '=', Session::get('idsuperadmin'))  ->orderBy('id', 'desc')->first();
$panelsms = \DB::table('panelsms')->where('id', '=',  1)  ->orderBy('id', 'desc')->first();
include(app_path().'/../sms/api_send_sms.php');
$message='با عرض سلام. رمز شما با موفقیت تغییر کرد . رمز جدید : '.$decryptedPassword.' ';
$result = Send_SMS($panelsms->sms_username, $panelsms->sms_password, $panelsms->sms_fromnumber, $admins->superadmin_tell, $message , 0, false) ; 		
 		
 		} 
 		*/
 
 

        
        
        
          return view('superadmin.success');

}	
else{ return redirect('superadmin/sign-in'); }
				}
		


	public function createform(){
if (Session::has('signsuperadmin')){ 
	Session::set('nav', 'createform'); 
 
$admins = \DB::table('catform') ->orderBy('catf_id', 'desc')->get();

	return view('superadmin.createform', ['admins' => $admins  ]); }	
else{ return redirect('superadmin/sign-in'); }
				}
			


public function createformpost(Request $request){
if (Session::has('signsuperadmin')){    	    	
    	$this->validate($request,[
    			'cat' => 'required', 
    			'name' => 'required|min:3', 
    			'des' => 'required|min:3'
    		],[
    			'cat.required' => 'لطفا یک دسته بندی برای فرم خود ایجاد نمایید',
    			'name.required' => 'لطفا نام فرم را وارد نمایید',
    			'name.min' => 'نام کاربری شما باید بیشتر ازنام فرم کوتاه استکاراکتر باشد', 
    			'des.required' => 'لطفا توضیحات فرم را وارد نمایید',
    			'des.min' => ' توضیحات فرم کوتاه است', 
    		]);   
$imageName='';

 if( $request->hasFile('file')){ 
        $image = $request->file('file');
        $imageName = time().$image->getClientOriginalName();
        $image->move(public_path('images'),$imageName);  
	 
    } else {   }


$rnd=rand(1, 99999999); 

DB::table('form')->insert([
    [ 'form_rnd' => $rnd , 'form_cat' => $request->cat  ,  'form_name' => $request->name ,   'form_date' =>  date('Y-m-d H:i:s') , 'form_des' => $request->des  , 'form_img' => $imageName     ]
]);   

 
    		
$myCheckboxes = $request->input('field_name');  
 

$field_values_array = $_REQUEST['field_name'];	
$ii=count($field_values_array);	
$i=0;
while($i<$ii) {	
$checkBox = implode(' , ' , $_REQUEST['field_name']);
$checkBoxe = implode(' , ' , $_REQUEST['field_namee']);
$pieces = explode(" , ", $checkBox);
$piecese = explode(" , ", $checkBoxe);
$s0=$pieces[$i];
$s0e=$piecese[$i];

DB::table('list')->insert([
    [ 'list_rnd' => $rnd , 'list_name' => $s0 ,  'list_pan' => $s0e ,   'list_date' =>  date('Y-m-d H:i:s') , 'list_typ' => 0 ,'list_aro' => 0 , 'list_chk' => $i       ]
]);   
$i++;
}
  return redirect('superadmin/formtype/'.$rnd.'');
    		
} else{ return redirect('superadmin/sign-in'); }
				}
			
			
			
	public function formtypeid($id){
if (Session::has('signsuperadmin')){ 
	Session::set('nav', 'createform');


$form = \DB::table('form')  
->where([ 
    ['form.form_rnd', '=', $id], ])
    ->orderBy('form.form_id', 'asc')->first();
    
$admins = \DB::table('form') 
->join('list', 'form.form_rnd', '=', 'list.list_rnd')  
->where([
    ['list.list_aro', '=', 0],
    ['form.form_rnd', '=', $id], ])
    ->orderBy('list.list_id', 'asc')->get();

	return view('superadmin.formtypeid', ['admins' => $admins ,'form' => $form  ]);  }	
else{ return redirect('superadmin/sign-in'); }
				}
			


			
	public function formtypeidpost($id , Request $request){
if (Session::has('signsuperadmin')){ 
	Session::set('nav', 'createform');

 
$this->validate($request,[ 
    			'field_typ.*' => 'required',  
    		],[ 
    			'field_typ.required' => 'لطفا نوع فیلد را وارد نمایید ',      
    			
    		]);
    		
 

$myCheckboxes = $request->input('field_typ'); 

$i=0;
if($myCheckboxes != NULL)  {
foreach($myCheckboxes as $quan) {
	
	$updatee = \DB::table('list')->where([
    ['list.list_aro', '=', 0],
    ['list.list_rnd', '=', $id],
    ['list.list_chk', '=', $i], ])
    ->update(['list_typ' => $quan   ]); 
    
	
	$i++;	 
	
	} 
	}

   return redirect('superadmin/selectpriceform/'.$id.'');
 }	
else{ return redirect('superadmin/sign-in'); }
				}



			
	public function selectpriceformid($id){
if (Session::has('signsuperadmin')){ 
	Session::set('nav', 'createform');


$form = \DB::table('form')  
->where([ 
    ['form.form_rnd', '=', $id], ])
    ->orderBy('form.form_id', 'asc')->first();
    
$admins = \DB::table('form') 
->join('list', 'form.form_rnd', '=', 'list.list_rnd')  
->where([
    ['list.list_aro', '=', 0],
    ['form.form_rnd', '=', $id], ])
    ->orderBy('list.list_id', 'asc')->get();

	return view('superadmin.selectpriceformid', ['admins' => $admins ,'form' => $form  ]);  }	
else{ return redirect('superadmin/sign-in'); }
				}
			



			
	public function selectpriceformidpost($id , Request $request){
if (Session::has('signsuperadmin')){ 
	Session::set('nav', 'createform');

 
$this->validate($request,[ 
    			'price' => 'required',  
    		],[ 
    			'price.required' => 'لطفا فیلد هزینه را انتخاب نمایید ',      
    			
    		]);
 
 
$updatee = \DB::table('list')->where([
    ['list.list_aro', '=', 0],
    ['list.list_rnd', '=', $id],
    ['list.list_id', '=', $request->price], ])
    ->update(['list_price' => 1   ]); 

			 $nametr = Session::flash('statust', 'فرم مربوطه باموفقیت ایجاد شد.');
		  	$nametrt = Session::flash('sessurl', 'viewsforms');
		  return view('superadmin.success');
 
 }	
else{ return redirect('superadmin/sign-in'); }
				}



		
	public function viewsforms(){
if (Session::has('signsuperadmin')){ Session::set('nav', 'viewsforms'); 
$admins = \DB::table('form') ->where([
    ['form.form_id', '<>', 0],  ])
    ->orderBy('form_id', 'desc')->get();
return view('superadmin.viewsforms', ['admins' => $admins]);
}	
else{ return redirect('superadmin/sign-in'); }
}



			
	public function viewsformseditid($id){
if (Session::has('signsuperadmin')){ 
	Session::set('nav', 'viewsforms');


$form = \DB::table('form')  
->where([ 
    ['form.form_rnd', '=', $id], ])
    ->orderBy('form.form_id', 'asc')->first();
    
$admins = \DB::table('form') 
->join('list', 'form.form_rnd', '=', 'list.list_rnd')  
->where([
    ['list.list_aro', '=', 0],
    ['form.form_rnd', '=', $id], ])
    ->orderBy('list.list_chk', 'asc')->get();
    
$formselects=0;
    
$formchecks=0;
    
$deletes = \DB::table('sortfild')    
->where([  
    ['sort_id', '<>', 0], ])->delete(); 
$i=0;  
 foreach($admins as $admin){
 	
 	
DB::table('sortfild')->insert([
 [  'sort_rnd' => $id ,  'sort_listid' => $admin->list_id ,   'sort_listchk' => $admin->list_chk ,   'sort_number' => $i  ]
]);   



$updatee = \DB::table('form') 
->join('list', 'form.form_rnd', '=', 'list.list_rnd')  
->where([ 
    ['form.form_rnd', '=', $id], 
    ['list.list_chk', '=', $admin->list_chk], ])->update([  'list_n' => $admin->list_chk   ]);
     	
 $i++;	
 	
 if($admin->list_typ=='8'){
	

$formselects = \DB::table('formselect') 
->join('list', 'formselect.formselect_formilistd', '=', 'list.list_id') 
->where([
    ['list.list_aro', '=', 0],
    ['list.list_typ', '=', 8],
    ['formselect.formselect_rnd', '=', $id], ])
    ->orderBy('formselect.formselect_id', 'asc')->get();
    
    
 } 
 
 
 
 
 
    
 if($admin->list_typ=='9'){
	
$formchecks = \DB::table('formcheckbox') 
->join('list', 'formcheckbox.formcheckbox_formilistd', '=', 'list.list_id')
->join('form', 'list.list_rnd', '=', 'form.form_rnd')  
->where([
    ['list.list_aro', '=', 0], 
    ['list.list_typ', '=', 9],
    ['form.form_rnd', '=', $id], ])
    ->orderBy('formcheckbox.formcheckbox_id', 'asc')->get();
     
}
 
 
 
 
 
  }
    
    
$catforms = \DB::table('catform') ->orderBy('catf_id', 'desc')->get();

	return view('superadmin.editform', ['admins' => $admins ,'form' => $form ,'catforms' => $catforms  ,'formselects' => $formselects  ,'formchecks' => $formchecks  ]);  }	
else{ return redirect('superadmin/sign-in'); }
				}
			

	public function viewsformseditidpost($id , Request $request){
if (Session::has('signsuperadmin')){ 
	Session::set('nav', 'viewsforms');

 
$this->validate($request,[ 
    			'cat' => 'required', 
    			'name' => 'required',  
    			'des' => 'required',  
    		],[ 
    			'cat.required' => 'لطفا یک دسته بندی برای فرم خود ایجاد نمایید',
    			'name.required' => 'لطفا نام فرم را وارد نمایید ', 
    			'des.required' => 'لطفا توضیحات فرم را وارد نمایید ',      
    			
    		]);
 
$form = \DB::table('form')  
->where([ 
    ['form.form_rnd', '=', $id], ])
    ->orderBy('form.form_id', 'asc')->first();
    $imageName=$form->form_img;
    
 if( $request->hasFile('file')){ 
        $image = $request->file('file');
        $imageName = time().$image->getClientOriginalName();
        $image->move(public_path('images'),$imageName);  
	 
    }  

 
$updatee = \DB::table('form')->where([ ['form_rnd', '=', $id],  ]) ->update([  'form_name' => $request->name  ,  'form_cat' => $request->cat  ,  'form_des' => $request->des   ,  'form_img' => $imageName  ,  'form_linkname' => $request->form_linkname   ]); 

			 $nametr = Session::flash('statust', 'فرم مربوطه باموفقیت ویرایش شد.');
		  	$nametrt = Session::flash('sessurl', 'viewsforms');
		  return view('superadmin.success');
 
 }	
else{ return redirect('superadmin/sign-in'); }
				}







	
	public function addfeild($id , Request $request){
if (Session::has('signsuperadmin')){ 
 if(Session::get('idsuperadmin')!='1'){ return redirect('superadmin/accessadmin');   } 
	Session::set('nav', 'createform');

 
$this->validate($request,[ 
    			'field_name.*' => 'required',  
    		],[ 
    			'field_name.required' => 'لطفا نام فیلد را وارد نمایید ',      
    			
    		]);


$chkfirst = \DB::table('form') 
->join('list', 'form.form_rnd', '=', 'list.list_rnd')  
->where([ 
    ['form.form_rnd', '=', $id], 
    ['list.list_aro', '=', 0],])
    ->orderBy('list.list_chk', 'desc')->first();
    
    $chki=$chkfirst->list_chk;

$myCheckboxes = $request->input('field_name');  
  
$field_values_array = $_REQUEST['field_name'];	
$ii=count($field_values_array);	
$i=0;
while($i<$ii) {	
$checkBox = implode(' , ' , $_REQUEST['field_name']);
$checkBoxe = implode(' , ' , $_REQUEST['field_namee']);
$pieces = explode(" , ", $checkBox);
$piecese = explode(" , ", $checkBoxe);
$s0=$pieces[$i];
$s0e=$piecese[$i];
$chki++;

DB::table('list')->insert([
    [ 'list_rnd' => $id , 'list_name' => $s0 ,  'list_pan' => $s0e ,   'list_date' =>  date('Y-m-d H:i:s') , 'list_typ' => 1 ,'list_aro' => 0 , 'list_chk' => $chki       ]
]);   
$i++;
}
  
			 $nametr = Session::flash('statust', 'فیلد مربوطه به فرم اضافه گردید.');
		  	$nametrt = Session::flash('sessurl', 'viewsforms/edit/'.$id.'');
		  return view('superadmin.success');
 }	
else{ return redirect('superadmin/sign-in'); }
				}



	
	public function addselectfeild($id , Request $request){
if (Session::has('signsuperadmin')){ 
 if(Session::get('idsuperadmin')!='1'){ return redirect('superadmin/accessadmin');   } 
	Session::set('nav', 'createform');

 
$this->validate($request,[ 
    			'field_tit' => 'required',
    			'field_name.*' => 'required',  
    		],[ 
    			'field_tit.required' => 'لطفا عنوان اینپات را وارد نمایید ',    
    			'field_name.required' => 'لطفا نام گزینه را وارد نمایید ',      
    			
    		]);


$chkfirst = \DB::table('form') 
->join('list', 'form.form_rnd', '=', 'list.list_rnd')  
->where([ 
    ['form.form_rnd', '=', $id], 
    ['list.list_aro', '=', 0],])
    ->orderBy('list.list_chk', 'desc')->first();
    
    
    $chki=$chkfirst->list_chk; $chkii=$chki+1;
    
DB::table('list')->insert([
    [ 'list_rnd' => $id , 'list_name' => $request->field_tit , 'list_typ' => 8 ,'list_aro' => 0 , 'list_chk' => $chkii  ,   'list_date' =>  date('Y-m-d H:i:s')      ]
]);  


$formilistd = \DB::table('form') 
->join('list', 'form.form_rnd', '=', 'list.list_rnd')  
->where([ 
    ['form.form_rnd', '=', $id], 
    ['list.list_aro', '=', 0],
    ['list.list_typ', '=', 8],])
    ->orderBy('list.list_chk', 'desc')->first();

$formselect_formilistd = $formilistd->list_id;

 

$myCheckboxes = $request->input('field_name');  
  
$field_values_array = $_REQUEST['field_name'];	
$ii=count($field_values_array);	
$i=0;
while($i<$ii) {	
$checkBox = implode(' , ' , $_REQUEST['field_name']); 
$pieces = explode(" , ", $checkBox); 
$s0=$pieces[$i]; 
$chki++;

DB::table('formselect')->insert([
    [ 'formselect_rnd' => $id , 'formselect_name' => $s0 , 'formselect_formilistd' => $formselect_formilistd   , 'formselect_value' => $i       ]
]);   
$i++;
}
  
			 $nametr = Session::flash('statust', 'سلکت اینپات باموفقیت به فرم اضافه شد.');
		  	$nametrt = Session::flash('sessurl', 'viewsforms/edit/'.$id.'');
		  return view('superadmin.success');
 }	
else{ return redirect('superadmin/sign-in'); }
				}



	
	public function editfeldformid($id , Request $request){
if (Session::has('signsuperadmin')){ 
 if(Session::get('idsuperadmin')!='1'){ return redirect('superadmin/accessadmin');   } 
	Session::set('nav', 'createform');

 
$this->validate($request,[ 
    			'field_typ.*' => 'required',  
    		],[ 
    			'field_typ.required' => 'لطفا نوع فیلد را وارد نمایید ',      
    			
    		]);
    		
 

$myCheckboxes = $request->input('field_typ'); 

$i=0;
if($myCheckboxes != NULL)  {
foreach($myCheckboxes as $quan) {
	
	$updatee = \DB::table('list')->where([
    ['list.list_aro', '=', 0],
    ['list.list_rnd', '=', $id],
    ['list.list_chk', '=', $i], ])
    ->update(['list_typ' => $quan   ]); 
    
	
	$i++;	 
	
	} 
	}
			 $nametr = Session::flash('statust', 'فیلدهای فرم مربوطه با موفقیت ویرایش شد.');
		  	$nametrt = Session::flash('sessurl', 'viewsforms/edit/'.$id.'');
		  return view('superadmin.success');
 }	
else{ return redirect('superadmin/sign-in'); }
				}





		
	public function deletidfeild($id,$idfeild){
		if (Session::has('signsuperadmin')){ 
 if(Session::get('idsuperadmin')!='1'){ return redirect('superadmin/accessadmin');   } 
		  	$admins = \ DB::table('user')->where('id', $id)->get();
		  	
		  	
$admins = \DB::table('list')    
->where([ 
    ['list.list_rnd', '=', $id], 
    ['list.list_id', '=', $idfeild], ])
    ->orderBy('list.list_id', 'asc')->get();
		  	
		  	
$admins = \DB::table('list')    
->where([ 
    ['list.list_rnd', '=', $id], 
    ['list.list_id', '=', $idfeild], ])->delete(); 
		  	$nametr = Session::flash('statust', 'فیلد مربوطه باموفقیت حذف شد.');
		  	$nametrt = Session::flash('sessurl', 'viewsforms/edit/'.$id.'');
		  	
	return view('superadmin.success', ['admins' => $admins]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}
		
		



	
	public function sortfeild($id , Request $request){
if (Session::has('signsuperadmin')){ 
 if(Session::get('idsuperadmin')!='1'){ return redirect('superadmin/accessadmin');   } 
	Session::set('nav', 'createform');

 
$this->validate($request,[ 
    			'field_name.*' => 'required',  
    			'field_chk.*' => 'required',  
    		],[ 
    			'field_name.required' => 'فیلد نمی تواند خالی باشد ', 
    			'field_chk.required' => 'لطفا اولویت را مشخص نمایید ',      
    			
    		]);
    		
    		 
 
 
/*
$field_values_array = $_REQUEST['field_chk'];	
$ii=count($field_values_array);	
*/
$i=0;


$sortfilds = \DB::table('sortfild')    
->where([ 
    ['sort_rnd', '=', $id], 
    ['sort_id', '<>', 0], ])
    ->orderBy('sort_number', 'asc')->get();



foreach($sortfilds as $sortfild){
 
 
$fildsortid='field_chkhide'.$sortfild->sort_listid;
 $sort_listidhide=$request->$fildsortid;
 
$fildsortid='field_chk'.$sortfild->sort_listid; 
 $sort_listid=$request->$fildsortid;
	 
	$updatee = \DB::table('list')->where([ 
    ['list_rnd', '=', $id],  ['list_n', '=', $sortfild->sort_listchk]    ])
    ->update([  'list_chk' => $sort_listid   ]); 
	 
	//echo $sort_listid.'<br>';
	
 $i++;
}
  
 
 
 
 /*
 
$admins = \DB::table('form') 
->join('list', 'form.form_rnd', '=', 'list.list_rnd')  
->where([ 
    ['form.form_rnd', '=', $id],  ])
    ->orderBy('list.list_id', 'asc')->get();
    
    $j=0;
    
    foreach($admins as $admin){
	
	$updatee = \DB::table('list')->where([ 
    ['list_rnd', '=', $id],  ['list_id', '=', $admin->list_id],   ])
    ->update([ 'list_chk' => $j   ]); 
	
	$j++;
}

    */
     
			 $nametr = Session::flash('statust', 'فیلدهای فرم مربوطه با موفقیت ویرایش شد.');
		  	$nametrt = Session::flash('sessurl', 'viewsforms/edit/'.$id.'');
		  return view('superadmin.success');
		   
		 
 }	
else{ return redirect('superadmin/sign-in'); }
				}




		
	public function editselectbox($id){
if (Session::has('signsuperadmin')){ 
	Session::set('nav', 'viewsforms');
 
$formselects=0;
    
$formselects = \DB::table('formselect') 
->join('list', 'formselect.formselect_formilistd', '=', 'list.list_id')
->join('form', 'list.list_rnd', '=', 'form.form_rnd')  
->where([
    ['list.list_aro', '=', 0], 
    ['list.list_typ', '=', 8],
    ['list.list_id', '=', $id], ])
    ->orderBy('formselect.formselect_id', 'asc')->get();
    
$formselectfirst = \DB::table('formselect') 
->join('list', 'formselect.formselect_formilistd', '=', 'list.list_id')
->join('form', 'list.list_rnd', '=', 'form.form_rnd')  
->where([
    ['list.list_aro', '=', 0], 
    ['list.list_typ', '=', 8],
    ['list.list_id', '=', $id], ])
    ->orderBy('formselect.formselect_id', 'asc')->first();
     

$listfirst = \DB::table('list')  
->join('form', 'list.list_rnd', '=', 'form.form_rnd')  
->where([
    ['list.list_aro', '=', 0], 
    ['list.list_typ', '=', 8],
    ['list.list_id', '=', $id], ])
    ->orderBy('list.list_rnd', 'asc')->first();
     
	return view('superadmin.editselectbox', [ 'formselects' => $formselects ,  'formselectfirst' => $formselectfirst ,  'listfirst' => $listfirst  ]);  }	
else{ return redirect('superadmin/sign-in'); }
				}
			


	
	public function editselectboxpost($id , Request $request){
if (Session::has('signsuperadmin')){ 
 if(Session::get('idsuperadmin')!='1'){ return redirect('superadmin/accessadmin');   } 
	Session::set('nav', 'createform');

 
$this->validate($request,[ 
    			'name' => 'required', 
    		],[ 
    			'name.required' => 'لطفا عنوان اینپات را وارد نمایید ',          
    			
    		]);

 

$formselects = \DB::table('formselect') 
->join('list', 'formselect.formselect_formilistd', '=', 'list.list_id')
->join('form', 'list.list_rnd', '=', 'form.form_rnd')  
->where([
    ['list.list_aro', '=', 0],
    ['list.list_typ', '=', 8],
    ['list.list_id', '=', $id], ])
    ->orderBy('formselect.formselect_id', 'asc')->get();
$m=0;$plass=1;
if($formselects){
foreach($formselects as $formselect){

$checkBox = implode(' , ' , $_REQUEST['formselect_name']); 
$pieces = explode(" , ", $checkBox); 
$m0=$pieces[$m]; 



	$updatee = \DB::table('formselect')->where([ 
    ['formselect_value', '=', $m],  ])
    ->update(['formselect_name' => $m0   ]); 
    $m++;
$formselect_value = $formselect->formselect_value;


}
}
 

$formselectfirst = \DB::table('formselect') 
->join('list', 'formselect.formselect_formilistd', '=', 'list.list_id')
->join('form', 'list.list_rnd', '=', 'form.form_rnd')  
->where([
    ['list.list_aro', '=', 0],
    ['list.list_typ', '=', 8],
    ['list.list_id', '=', $id], ])
    ->orderBy('formselect.formselect_id', 'asc')->first();


$listfirst = \DB::table('list')  
->join('form', 'list.list_rnd', '=', 'form.form_rnd')  
->where([
    ['list.list_aro', '=', 0], 
    ['list.list_typ', '=', 8],
    ['list.list_id', '=', $id], ])
    ->orderBy('list.list_rnd', 'asc')->first();

$formselect_formilistd = $listfirst->list_id;
$formselect_rnd = $listfirst->form_rnd;  

 

$myCheckboxes = $request->input('field_name');  
  
$field_values_array = $_REQUEST['field_name'];	
$ii=count($field_values_array);	

if(empty($formselects)){ $formselect_value = 0; $plass = 0; }

$j=$formselect_value+$plass;
$i=0;
while($i<$ii) {	
$checkBox = implode(' , ' , $_REQUEST['field_name']); 
$pieces = explode(" , ", $checkBox); 
$s0=$pieces[$i]; 
 
if($s0!=''){
	
DB::table('formselect')->insert([
    [ 'formselect_rnd' => $formselect_rnd , 'formselect_name' => $s0 , 'formselect_formilistd' => $formselect_formilistd   , 'formselect_value' => $j       ]
]);   
}
$i++;
$j++;
}
  
			 $nametr = Session::flash('statust', 'گزینه ها با موفقیت به سلکت باکس اضافه شد.');
		  	$nametrt = Session::flash('sessurl', 'viewsforms/edit/'.$formselect_rnd.'');
		  return view('superadmin.success');
 }	
else{ return redirect('superadmin/sign-in'); }
				}

		


	
	public function editcheckboxpost($id , Request $request){
if (Session::has('signsuperadmin')){ 
 if(Session::get('idsuperadmin')!='1'){ return redirect('superadmin/accessadmin');   } 
	Session::set('nav', 'createform');

 
$this->validate($request,[ 
    			'name' => 'required', 
    		],[ 
    			'name.required' => 'لطفا عنوان اینپات را وارد نمایید ',          
    			
    		]);

 

$formselects =  \DB::table('formcheckbox') 
->join('list', 'formcheckbox.formcheckbox_formilistd', '=', 'list.list_id')
->join('form', 'list.list_rnd', '=', 'form.form_rnd')  
->where([
    ['list.list_aro', '=', 0],
    ['list.list_typ', '=', 9],
    ['list.list_id', '=', $id], ])
    ->orderBy('formcheckbox.formcheckbox_id', 'asc')->get();
$m=0;$plass=1;
if($formselects){
foreach($formselects as $formselect){

$checkBox = implode(' , ' , $_REQUEST['formselect_name']); 
$pieces = explode(" , ", $checkBox); 
$m0=$pieces[$m]; 
 
	$updatee = \DB::table('formcheckbox')->where([ 
    ['formcheckbox_value', '=', $m],  ])
    ->update(['formcheckbox_name' => $m0   ]); 
    $m++;
$formselect_value = $formselect->formcheckbox_value;

	
}
}
 

$formselectfirst = \DB::table('formcheckbox') 
->join('list', 'formcheckbox.formcheckbox_formilistd', '=', 'list.list_id')
->join('form', 'list.list_rnd', '=', 'form.form_rnd')  
->where([
    ['list.list_aro', '=', 0],
    ['list.list_typ', '=', 9],
    ['list.list_id', '=', $id], ])
    ->orderBy('formcheckbox.formcheckbox_id', 'asc')->first();
    
    
    
$listfirst = \DB::table('list')  
->join('form', 'list.list_rnd', '=', 'form.form_rnd')  
->where([
    ['list.list_aro', '=', 0], 
    ['list.list_typ', '=', 9],
    ['list.list_id', '=', $id], ])
    ->orderBy('list.list_rnd', 'asc')->first();

$formselect_formilistd = $listfirst->list_id;
$formselect_rnd = $listfirst->form_rnd;  

 

$myCheckboxes = $request->input('field_name');  
  
$field_values_array = $_REQUEST['field_name'];	
$ii=count($field_values_array);	


if(empty($formselects)){ $formselect_value = 0; $plass = 0; }

$j=$formselect_value+$plass;
$i=0;
while($i<$ii) {	
$checkBox = implode(' , ' , $_REQUEST['field_name']); 
$pieces = explode(" , ", $checkBox); 
$s0=$pieces[$i]; 
 
if($s0!=''){
	
DB::table('formcheckbox')->insert([
    [ 'formcheckbox_rnd' => $formselect_rnd , 'formcheckbox_name' => $s0 , 'formcheckbox_formilistd' => $formselect_formilistd   , 'formcheckbox_value' => $j       ]
]);   
}
$i++;
$j++;
}
  
			 $nametr = Session::flash('statust', 'گزینه ها با موفقیت به چک باکس اضافه شد.');
		  	$nametrt = Session::flash('sessurl', 'viewsforms/edit/'.$formselect_rnd.'');
		  return view('superadmin.success');
 }	
else{ return redirect('superadmin/sign-in'); }
				}



	public function deletselectbox($id){
		if (Session::has('signsuperadmin')){  
$formselectfirst = \DB::table('formselect') 
->join('list', 'formselect.formselect_formilistd', '=', 'list.list_id')
->join('form', 'list.list_rnd', '=', 'form.form_rnd')  
->where([
    ['list.list_aro', '=', 0],
    ['list.list_typ', '=', 8],
    ['formselect.formselect_id', '=', $id], ])
    ->orderBy('formselect.formselect_id', 'asc')->first();

$formselect_formilistd = $formselectfirst->list_id;
		  	$admins = \DB::table('formselect')->where('formselect_id', '=', $id)->delete(); 
		  	$nametr = Session::flash('statust', 'حذف فیلد با موفقیت انجام شد.');
		  	 
 $nametrt = Session::flash('sessurl', 'viewsforms/editselectbox/'.$formselect_formilistd.'');
		  	
	return view('superadmin.success', ['admins' => $admins]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}
		
	public function deletcheckbox($id){
		if (Session::has('signsuperadmin')){  
$formselectfirst = \DB::table('formcheckbox') 
->join('list', 'formcheckbox.formcheckbox_formilistd', '=', 'list.list_id')
->join('form', 'list.list_rnd', '=', 'form.form_rnd')  
->where([
    ['list.list_aro', '=', 0],
    ['list.list_typ', '=', 9],
    ['formcheckbox.formcheckbox_id', '=', $id], ])
    ->orderBy('formcheckbox.formselect_id', 'asc')->first();

$formselect_formilistd = $formselectfirst->list_id;
		  	$admins = \DB::table('formcheckbox')->where('formcheckbox_id', '=', $id)->delete(); 
		  	$nametr = Session::flash('statust', 'حذف فیلد با موفقیت انجام شد.');
		  	 
 $nametrt = Session::flash('sessurl', 'viewsforms/editcheckbox/'.$formselect_formilistd.'');
		  	
	return view('superadmin.success', ['admins' => $admins]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}
		

		
	public function editcheckbox($id){
if (Session::has('signsuperadmin')){ 
	Session::set('nav', 'viewsforms');
 
$formselects=0;
    
$formselects = \DB::table('formcheckbox') 
->join('list', 'formcheckbox.formcheckbox_formilistd', '=', 'list.list_id')
->join('form', 'list.list_rnd', '=', 'form.form_rnd')  
->where([
    ['list.list_aro', '=', 0], 
    ['list.list_typ', '=', 9],
    ['list.list_id', '=', $id], ])
    ->orderBy('formcheckbox.formcheckbox_id', 'asc')->get();
    
$formselectfirst = \DB::table('formcheckbox') 
->join('list', 'formcheckbox.formcheckbox_formilistd', '=', 'list.list_id')
->join('form', 'list.list_rnd', '=', 'form.form_rnd')  
->where([
    ['list.list_aro', '=', 0], 
    ['list.list_typ', '=', 9],
    ['list.list_id', '=', $id], ])
    ->orderBy('formcheckbox.formcheckbox_id', 'asc')->first();
    
    
$listfirst = \DB::table('list')  
->join('form', 'list.list_rnd', '=', 'form.form_rnd')  
->where([
    ['list.list_aro', '=', 0], 
    ['list.list_typ', '=', 9],
    ['list.list_id', '=', $id], ])
    ->orderBy('list.list_rnd', 'asc')->first();
     
	return view('superadmin.editcheckbox', [ 'formselects' => $formselects ,  'formselectfirst' => $formselectfirst  ,  'listfirst' => $listfirst  ]);  }	
else{ return redirect('superadmin/sign-in'); }
				}
			


			
	public function viewsformseditidstat($stat , $id){
if (Session::has('signsuperadmin')){ 
	Session::set('nav', 'viewsforms');

if($stat=='0'){$statee=1; 
			 $nametr = Session::flash('statust', 'فرم باموفقیت فعال شد.');} else {$statee=0;
			 
			 $nametr = Session::flash('statust', 'فرم باموفقیت غیرفعال شد.');}

	$updatee = \DB::table('form')->where([ 
    ['form_rnd', '=', $id],  ])
    ->update(['form_active' => $statee   ]); 
    
		  	$nametrt = Session::flash('sessurl', 'viewsforms');
		  return view('superadmin.success');

 }	
else{ return redirect('superadmin/sign-in'); }
				}
			




		
	public function createcatsform(){
if (Session::has('signsuperadmin')){ 
	Session::set('nav', 'createcatsform'); return view('superadmin.addcatform');}	
else{ return redirect('superadmin/sign-in'); }
				}
			
 

public function createcatsformPost(Request $request){
if (Session::has('signsuperadmin')){    	    	
    	$this->validate($request,[
    			'name' => 'required',  
    		],[
    			'name.required' => 'لطفا نام دسته بندی را وارد نمایید', 
    		]);   
    		 
DB::table('catform')->insert([
    [  'catf_name' => $request->name       ]
]);   
    	 
			 $nametr = Session::flash('statust', 'دسته بندی سایت باموفقیت انجام شد.');
		  	$nametrt = Session::flash('sessurl', 'viewscatsform');
		  return view('superadmin.success'); 
 }	
else{ return redirect('superadmin/sign-in'); }    	  
}
		



	public function viewscatsform(){
if (Session::has('signsuperadmin')){ Session::set('nav', 'viewscatsform'); 
$admins = \DB::table('catform') ->orderBy('catf_id', 'desc')->get();
return view('superadmin.viewscatsform', ['admins' => $admins]);
}	
else{ return redirect('superadmin/sign-in'); }
}



	public function viewscatsformeditid($id){
if (Session::has('signsuperadmin')){ Session::set('nav', 'viewscatsform'); 
$admins = \DB::table('catform') ->where([ 
    ['catf_id', '=', $id],  ])
    ->orderBy('catf_id', 'desc')->get();
return view('superadmin.editcatform', ['admins' => $admins]);
}	
else{ return redirect('superadmin/sign-in'); }
}



public function viewscatsformeditpostid(Request $request  , $id){
if (Session::has('signsuperadmin')){    	    	
    	$this->validate($request,[
    			'name' => 'required',  
    		],[
    			'name.required' => 'لطفا نام دسته بندی را وارد نمایید', 
    		]);   
    		  
 $updatee = \DB::table('catform')->where('catf_id', '=', $id)  ->update(['catf_name' => $request->name    ]); 

 $nametr = Session::flash('statust', 'دسته بندی باموفقیت ویرایش شد.');
 $nametrt = Session::flash('sessurl', 'viewscatsform/edit/'.$id.'');	
	 
return view('superadmin.success');  


 }	
else{ return redirect('superadmin/sign-in'); }    	  
}
		
		
		

	public function deletcatsformeditid($id){
		if (Session::has('signsuperadmin')){  
		  	$admins = \DB::table('catform')->where('catf_id', '=', $id)->delete(); 
		  	$nametr = Session::flash('statust', 'دسته بندی باموفقیت حذف شد.');
		  	$nametrt = Session::flash('sessurl', 'viewscatsform');
		  	
	return view('superadmin.success', ['admins' => $admins]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}
		




		
	public function addmak(){
if (Session::has('signsuperadmin')){ 
	Session::set('nav', 'addmak'); return view('sup.addmak');}	
else{ return redirect('superadmin/sign-in'); }
				}
				
				
				

public function addmakpost(Request $request){
if (Session::has('signsuperadmin')){    	    	
    	$this->validate($request,[
    			'name' => 'required', 
    			'price' => 'required|numeric'
    		],[
    			'name.required' => 'لطفا نام ماک را وارد نمایید', 
    			'price.required' => 'لطفا قیمت ماک را وارد نمایید', 
    			'price.numeric' => 'لطفا قیمت ماک را به فرمت صحیح وارد نمایید', 
    		]);   
    		 
 
DB::table('makcenter')->insert([
    [ 'mak_name'  => $request->name    , 'mak_price' => $request->price       ]
]);  
    		 
  $nametr = Session::flash('statust', 'ثبت ماک با موفقیت انجام شد.');
 $nametrt = Session::flash('sessurl', 'viewsmaks');
		  
    	 	 
    	 	return redirect('superadmin/viewsmaks'); 
    	 	 
 }	
else{ return redirect('superadmin/sign-in'); }    	  
}
		




		
		
	public function viewsmaks(){
if (Session::has('signsuperadmin')){ Session::set('nav', 'viewsmaks'); 
$admins = \DB::table('makcenter') ->orderBy('mak_id', 'desc')->get();
return view('sup.viewsmaks', ['admins' => $admins]);
}	
else{ return redirect('superadmin/sign-in'); }
}



		
	public function viewsmakspostid($id  , Request $request ){
if (Session::has('signsuperadmin')){ 
 
     	$this->validate($request,[ 
    			'price' => 'required|numeric'
    		],[ 
    			'price.required' => 'لطفا قیمت ماک را وارد نمایید', 
    			'price.numeric' => 'لطفا قیمت ماک را به فرمت صحیح وارد نمایید', 
    		]);   
    		 
 
 $updatee = \DB::table('makcenter')->where('mak_id', '=', $id)  ->update(['mak_price' => $request->price  ]); 	
  		 
$nametr = Session::flash('statust', 'هزینه ماک باموفقیت ویرایش شد.');
$nametrt = Session::flash('sessurl', 'viewsmaks');
return redirect('superadmin/viewsmaks'); 
}	else{ return redirect('superadmin/sign-in'); }
}
		



		
	public function deletmakid($id){
		if (Session::has('signsuperadmin')){ 
		  	$admins = \ DB::table('makcenter')->where('mak_id', $id)->get();
		  	$admins = \DB::table('makcenter')->where('mak_id', '=', $id)->delete(); 
		  	$nametr = Session::flash('statust', 'حذف ماک با موفقیت انجام شد.');
		  	$nametrt = Session::flash('sessurl', 'viewsmaks');
		  	
return redirect('superadmin/viewsmaks'); 
	}	
else{ return redirect('superadmin/sign-in'); }
				}
		
			
				
			
	public function settingrezervprice(){
if (Session::has('signsuperadmin')){ Session::set('nav', 'settingrezervprice'); 
$admin = \DB::table('superadmins') ->where('id', '=' , 1)->orderBy('id', 'desc')->first();
return view('sup.settingrezervprice', ['admin' => $admin]);
}	
else{ return redirect('superadmin/sign-in'); }
}





	public function settingrezervpricepost(  Request $request ){
if (Session::has('signsuperadmin')){ 
 
     	$this->validate($request,[ 
    			'price' => 'required|numeric'
    		],[ 
    			'price.required' => 'لطفا هزینه رزرو را وارد نمایید', 
    			'price.numeric' => 'لطفا هزینه رزرو را به فرمت صحیح وارد نمایید', 
    		]);   
    		 
 
 $updatee = \DB::table('superadmins')->where('id', '=', 1)  ->update(['superadmin_rezerv' => $request->price  ]); 	
  		 
$nametr = Session::flash('statust', 'هزینه رزرو باموفقیت ویرایش شد.');
$nametrt = Session::flash('sessurl', 'settingrezervprice');
return redirect('superadmin/settingrezervprice'); 
}	else{ return redirect('superadmin/sign-in'); }
}
		

		
	public function adddiscount(){
if (Session::has('signsuperadmin')){ 
	Session::set('nav', 'adddiscount');
	
$forms = \DB::table('form')  
->where([ 
    ['form.form_linkname', '<>', ''], ])
    ->orderBy('form.form_id', 'asc')->get();
    
    
    
return view('sup.adddiscount', ['forms' => $forms]);
     }	
else{ return redirect('superadmin/sign-in'); }
				}
			


public function adddiscountpost(Request $request){
if (Session::has('signsuperadmin')){    	    	
    	$this->validate($request,[
    			'formname' => 'required', 
    			'code' => 'required', 
    			'price' => 'required|numeric'
    		],[
    			'formname.required' => 'لطفا خدمات را وارد نمایید', 
    			'code.required' => 'لطفا کدتخفیف را وارد نمایید', 
    			'price.required' => 'لطفا هزینه تخفیف را وارد نمایید', 
    			'price.numeric' => 'لطفا هزینه تخفیف را به فرمت صحیح وارد نمایید', 
    		]);   
    		
    		
    		
    		
$myCheckboxes = $request->input('formname');


DB::table('discount')->insert([
    [ 'discount_code'  => $request->code    , 'discount_price' => $request->price , 'discount_createdatdate' => date('Y-m-d H:i:s')      ]
]);  
    	

$discounts=\DB::table('discount')  ->where('discount_id' , '<>' , '0')->orderBy('discount_id' , 'desc')->first(); 


if($myCheckboxes != NULL)  {
foreach($myCheckboxes as $quan) { 

DB::table('listdiscount')->insert([
    [ 'listdis_iddisc'  => $discounts->discount_id    , 'listdis_idform' =>$quan  ]
]);  

} }
    		 
 	 
  $nametr = Session::flash('statust', 'ثبت کد تخفیف با موفقیت انجام شد.');
 $nametrt = Session::flash('sessurl', 'mngdiscount');
 return redirect('superadmin/mngdiscount'); 
 }	 else{ return redirect('superadmin/sign-in'); }    	  
}
		


	public function mngdiscount(){
if (Session::has('signsuperadmin')){ Session::set('nav', 'mngdiscount'); 
$admins = \DB::table('discount') ->orderBy('discount_id', 'desc')->get();


$listdiscounts = \DB::table('listdiscount')
->join('discount', 'listdiscount.listdis_iddisc', '=', 'discount.discount_id') 
->join('form', 'listdiscount.listdis_idform', '=', 'form.form_rnd')  ->where([  
    ['discount.discount_active', '<>', 10],  ])
 ->orderBy('discount_id', 'desc')->get();

return view('sup.mngdiscount', ['admins' => $admins , 'listdiscounts' => $listdiscounts   ]);
}	
else{ return redirect('superadmin/sign-in'); }
}



	public function mngdiscountpostid(  Request $request , $id ){
if (Session::has('signsuperadmin')){ 

    	$this->validate($request,[ 
    			'code' => 'required', 
    			'price' => 'required|numeric'
    		],[ 
    			'code.required' => 'لطفا کدتخفیف را وارد نمایید', 
    			'price.required' => 'لطفا هزینه تخفیف را وارد نمایید', 
    			'price.numeric' => 'لطفا هزینه تخفیف را به فرمت صحیح وارد نمایید', 
    		]);   
    		 
 
 $updatee = \DB::table('discount')->where('discount_id', '=', $id)  ->update(['discount_price' => $request->price ,'discount_code' => $request->code  ]); 	
  		 
$nametr = Session::flash('statust', 'ویرایش تخفیف باموفقیت انجام شد.');
$nametrt = Session::flash('sessurl', 'mngdiscount');
return redirect('superadmin/mngdiscount'); 
}	else{ return redirect('superadmin/sign-in'); }
}
		
		
		
		

	public function mngdiscountstatid($stat , $id){
if (Session::has('signsuperadmin')){ Session::set('nav', 'mngdiscount'); 

 

if($stat=='0') {$discount_active='1';
$nametr = Session::flash('statust', 'کد تخفیف باموفقیت فعال شد.');
} else {$discount_active='0';
$nametr = Session::flash('statust', 'کد تخفیف باموفقیت غیرفعال شد.');}

 $updatee = \DB::table('discount')->where('discount_id', '=', $id)  ->update(['discount_active' => $discount_active  ]); 	
  		 

$nametrt = Session::flash('sessurl', 'mngdiscount');
return redirect('superadmin/mngdiscount'); 


}	
else{ return redirect('superadmin/sign-in'); }
}



		
	public function discountdeletid($id){
		if (Session::has('signsuperadmin')){ 
		  	$admins = \ DB::table('discount')->where('discount_id', '=', $id)  ->get();
		  	$admins = \DB::table('discount')->where('discount_id', '=', $id)  ->delete(); 
		  	$nametr = Session::flash('statust', 'حذف کدتخفیف با موفقیت انجام شد.');
		  	$nametrt = Session::flash('sessurl', 'mngdiscount');
		  	
return redirect('superadmin/mngdiscount'); 
	}	
else{ return redirect('superadmin/sign-in'); }
				}
		

		
	public function addusersup(){
if (Session::has('signsuperadmin')){ 
	Session::set('nav', 'adduser'); return view('sup.adduser');}	
else{ return redirect('superadmin/sign-in'); }
				}
			

public function addusertPost(Request $request){
if (Session::has('signsuperadmin')){    	    	
    	$this->validate($request,[
    			'username' => 'required|min:3|unique:user,user_username,$request->username', 
    			'userpassword' => 'required|min:5|max:35|confirmed'
    		],[
    			'username.required' => 'لطفا نام کاربری را وارد نمایید',
    			'username.min' => 'نام کاربری شما باید بیشتر از 3 کاراکتر باشد',
    			'username.unique' => 'این نام کاربری قبللا در سیستم ثبت شده است',
    			'userpassword.required' => 'لطفا رمز ورود را وارد نمایید',
    			'userpassword.min' => ' رمز کوتاه است',
    			'userpassword.max' => ' رمزعبور طولانی است ',
    			'userpassword.confirmed' => 'رمزعبور با تکرار آن مطابقت ندارد ',
    		]);   
    		
 

$encryptedPassword = \Crypt::encrypt($request->userpassword);
$decryptedPassword = \Crypt::decrypt($encryptedPassword);
$rnd=rand(1, 99999999); 

$user=\DB::table('user')  ->where('id' , '<>' , '0')->orderBy('id' , 'desc')->first();  
    		

DB::table('user')->insert([
    [ 'user_password' => $encryptedPassword ,   'user_createdatdate' =>  date('Y-m-d H:i:s') , 'user_active' => 0 , 'user_moaref' => $rnd   , 'user_username' => $request->username       ]
]);  
    		 

 
			 $nametr = Session::flash('statust', 'ثبت نام کاربر با موفقیت انجام شد.');
		  	$nametrt = Session::flash('sessurl', 'viewsusers');
		  
    	 	 
    	 	return redirect('superadmin/viewsusers'); 
    	 	 
 }	
else{ return redirect('superadmin/sign-in'); }    	  
}
		
		
	public function viewsuserssup(){
if (Session::has('signsuperadmin')){ Session::set('nav', 'viewsusers'); 


$h = new SuperadminController();
$h->viewalertnot();



$admins = \DB::table('user') ->orderBy('id', 'desc')->get();




Session::set('allusers', $admins);   

return view('sup.viewsusers', ['admins' => $admins]);
}	
else{ return redirect('superadmin/sign-in'); }
}






 
public function xls($list){

if (Session::has('signsuperadmin')){ Session::set('nav', 'viewsusers'); 


 

header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");
header("Content-Disposition: attachment; filename=output.xls");

 
header("Pragma: no-cache"); 
header("Expires: 0");

$i=1;

 
 
if($list=='allusers'){ 
$developer = Session::get('allusers');
 
echo '<table border="1">';
//make the column headers what you want in whatever order you want
echo ' <tr>
     				    <th>ردیف </th> 
                        <th>نام و نام خانوادگی</th>
                        <th>تلفن</th>  
                      </tr>'; 
foreach ($developer as $admin){
    echo " <tr>
 <td>".$i++."</td>
 <td>".$admin->user_name."  </td>  
 <td>".$admin->user_tell." </td>    ";
  
 echo"</tr>";
}
echo '</table>';

}







} 
else{ return redirect('superadmin/sign-in'); } 

 }



	public function editusersup($id){
if (Session::has('signsuperadmin')){ 
	Session::put('idimg', $id); Session::set('nav', 'viewsusers'); 
$admins = \DB::table('user')->where('id', '=', $id)  ->orderBy('id', 'desc')->get();

 	


//mycharge 
$charges = \DB::table('user') 
->join('charge', 'user.id', '=', 'charge.charge_iduser') 
->join('finicals', 'charge.charge_finical', '=', 'finicals.id') 
->where([
    ['charge.charge_arou', '=', 4],
    ['charge.charge_iduser', '=', $id],
    ['finicals.finical_payment', '=', 1],
    ['finicals.finical_inc', '=', 5],])
    ->orderBy('charge.charge_id', 'desc')->get();
$chargepaymy=0;
foreach($charges as $charge){ $chargepaymy=$charge->charge_pay+$chargepaymy; }




 //supcharge  
$charges = \DB::table('user') 
->join('charge', 'user.id', '=', 'charge.charge_iduser')  
->join('finicals', 'charge.charge_finical', '=', 'finicals.id') 
->where([
    ['charge.charge_arou', '=', 4],
    ['charge.charge_iduser', '=', $id],
    ['finicals.finical_payment', '=', 1],
    ['finicals.finical_inc', '=', 6],])
    ->orderBy('charge.charge_id', 'desc')->get();
$chargepaysup=0;
foreach($charges as $charge){ $chargepaysup=$charge->charge_pay+$chargepaysup; }



 //odat  
$charges = \DB::table('user') 
->join('charge', 'user.id', '=', 'charge.charge_iduser')  
->join('finicals', 'charge.charge_finical', '=', 'finicals.id') 
->where([
    ['charge.charge_arou', '=', 4],
    ['charge.charge_iduser', '=', $id],
    ['finicals.finical_payment', '=', 1],
    ['finicals.finical_inc', '=', 7],])
    ->orderBy('charge.charge_id', 'desc')->get();
$chargepayodat=0;
foreach($charges as $charge){ $chargepayodat=$charge->charge_pay+$chargepayodat; }




//pardakht 
$charges = \DB::table('user') 
->join('charge', 'user.id', '=', 'charge.charge_iduser')  
->join('finicals', 'charge.charge_finical', '=', 'finicals.id') 
->where([
    ['charge.charge_arou', '=', 4],
    ['charge.charge_iduser', '=', $id],
    ['finicals.finical_payment', '=', 1],
    ['finicals.finical_inc', '=', 3],])
    ->orderBy('charge.charge_id', 'desc')->get();
$chargepaypar=0;
foreach($charges as $charge){ $chargepaypar=$charge->charge_pay+$chargepaypar; }



 //bisinis  
$charges = \DB::table('user') 
->join('charge', 'user.id', '=', 'charge.charge_iduser')  
->join('finicals', 'charge.charge_finical', '=', 'finicals.id') 
->where([
    ['charge.charge_arou', '=', 4],
    ['charge.charge_iduser', '=', $id],
    ['finicals.finical_payment', '=', 1],
    ['finicals.finical_inc', '=', 8],])
    ->orderBy('charge.charge_id', 'desc')->get();
$chargepaybisi=0;
foreach($charges as $charge){ $chargepaybisi=$charge->charge_pay+$chargepaybisi; }


//jamkol
$chargepay= ($chargepaysup +  $chargepaymy  + $chargepaybisi ) -  ($chargepaypar + $chargepayodat) ; 

 

$chargeac=$chargepay;


$chargesas = \DB::table('user') 
->join('charge', 'user.id', '=', 'charge.charge_iduser')  
->join('finicals', 'charge.charge_finical', '=', 'finicals.id') 
->where([
    ['charge.charge_arou', '=', 4],
    ['charge.charge_iduser', '=', $id],
    ['finicals.finical_payment', '=', 1], 
    ['finicals.finical_pak', '<>', '2'] , 
    ['finicals.finical_inc', '<>', 0],])
    ->orderBy('charge.charge_id', 'desc')->get();






return view('sup.edituser', ['admins' => $admins ,'chargeac' => $chargeac , 'chargesas' => $chargesas  ]); }	
else{ return redirect('superadmin/sign-in'); }
}

		
	public function editusersupPost($id  , Request $request ){
if (Session::has('signsuperadmin')){ 

$nametr = Session::flash('err', '1');

$this->validate($request,[
    			'name' => 'required|min:3|max:35', 
    			'tell' => 'required|numeric',
    			'email' => 'required|email',
    			'adres' => 'required|min:3|max:555'
    		],[
    			'name.required' => 'نام و نام خانوادگی را وارد نمایید',
    			'name.min' => 'نام کوتاه است',
    			'name.max' => 'نام غیقابل قبول',
    			'tell.required' => 'شماره تلفن را بصورت صحیح وارد کنید',
    			'tell.numeric' => 'شماره غیرقابل قبول است',
    			'email.required' => 'ایمیل را بصورت صحیح وارد کنید',
    			'email.email' => 'فرمت ایمیل غیرقابل قبول است',
    			'adres.required' => 'آدرس را بصورت صحیح وارد کنید',
    			'adres.min' => 'دآدرس کوتاه است',
    			'adres.max' => 'آدرس خیلی بلند است',
    			
    		]);

 
 


$user = \DB::table('user')->where('id', '=', $id)  ->orderBy('id', 'desc')->first();

 		if ( $request->email ==  $user->user_email   ){  $activeemail =  $user->user_emailactive ; }
 else   if ( $request->email !=  $user->user_email   ){  $activeemail ='0';}

 		if ( $request->tell ==  $user->user_tell   ){  $activetell =  $user->user_tellactive ; }
 else   if ( $request->tell !=  $user->user_tell   ){  $activetell ='0';}
 
  
 
$updatee = \DB::table('user')->where('id', '=', $id)  ->update(['user_name' => $request->name    ,  'user_tell' => $request->tell ,  'user_email' => $request->email ,  'user_adres' => $request->adres ,  'user_emailactive' => $activeemail ,  'user_tellactive' => $activetell ]); 

$user = \DB::table('user')->where('id', '=', $id)  ->orderBy('id', 'desc')->first();
if ( ($user->user_emailactive == 1) &&  ($user->user_tellactive == 1)   ){  $active=1;}
if ( ($user->user_emailactive == 0) ||  ($user->user_tellactive == 0)   ){  $active=0;}
$updatee = \DB::table('user')->where('id', '=', $id)  ->update(['user_active' => $active   ]);

$admins = \DB::table('user')->where('id', '=', $id)  ->orderBy('id', 'desc')->get();
$nametr = Session::flash('statust', 'ویرایش اطلاعات کاربر با موفقیت انجام شد.');
$nametrt = Session::flash('sessurl', 'viewsusers/edituser/'.$id.''); 
	 
    	 	return redirect('superadmin/viewsusers/edituser/'.$id.''); 
}	else{ return redirect('superadmin/sign-in'); }
}
	




	public function editusersupincchargePost($id , Request $request){
if (Session::has('signsuperadmin')){ 

$nametr = Session::flash('err', '3');

    	$this->validate($request,[
    			'tit' => 'required|numeric' 
    		],[
    			'tit.required' => 'لطفا مبلغ شارژ را وارد نمایید',
    			'tit.numeric' => 'مبلغ شارژ نامعتبر است', 
    		]);
    	

DB::table('finicals')->insert([
    ['finical_pay' => $request->tit , 'finical_shenasepardakht' => $request->des ,     'finical_createdatdate' =>  date('Y-m-d H:i:s') , 'finical_inc' => 6 , 'finical_payment' => 1 ,  'finical_arou' => 4 ,  'finical_iduser' => $id  ]
]);

$chargefinical=\DB::table('finicals') ->where([['finical_inc', '=',  6 ],['finical_arou', '=',  4 ],['finical_iduser', '=',  $id],])->orderBy('id', 'desc')->first();	
		    	
DB::table('charge')->insert([
    ['charge_pay' => $request->tit ,     'charge_createdatdate' =>  date('Y-m-d H:i:s') , 'charge_arou' => 4 ,  'charge_iduser' => $id ,  'charge_finical' => $chargefinical->id  ]
]);	    	

 
  
$nametr = Session::flash('statust',  'افزایش شارژ کاربر با موفقیت انجام شد');
$nametrt = Session::flash('sessurl', 'viewsusers/edituser/'.$id.'');		  	
 return view('superadmin.success'); 
 
}	else{ return redirect('superadmin/sign-in'); }
}
 





	public function chargeuserincpostodat($id , Request $request){
if (Session::has('signsuperadmin')){ 
 
 
$nametr = Session::flash('err', '4');

    	$this->validate($request,[
    			'tit' => 'required|numeric' 
    		],[
    			'tit.required' => 'لطفا مبلغ را وارد نمایید',
    			'tit.numeric' => 'مبلغ نامعتبر است', 
    		]);
    	
if($request->jamekol < $request->tit) {
	$nametr = Session::flash('statust',  'مبلغ انتخاب شده جهت عودت بیشتر از شارژ اکانت کاربر می باشد');
$nametrt = Session::flash('sessurl', 'viewsusers/edituser/'.$id.'');			  	
 return view('superadmin.error');  	
}  else {


DB::table('finicals')->insert([
    ['finical_pay' => $request->tit ,  'finical_shenasepardakht' => $request->des ,     'finical_createdatdate' =>  date('Y-m-d H:i:s') , 'finical_inc' => 7 , 'finical_payment' => 1 ,  'finical_arou' => 4 ,  'finical_iduser' => $id  ]
]);

$chargefinical=\DB::table('finicals') ->where([['finical_inc', '=',  7 ],['finical_arou', '=',  4 ],['finical_iduser', '=',  $id],])->orderBy('id', 'desc')->first();	
		    	
DB::table('charge')->insert([
    ['charge_pay' => $request->tit ,     'charge_createdatdate' =>  date('Y-m-d H:i:s') , 'charge_arou' => 4 ,  'charge_iduser' => $id ,  'charge_finical' => $chargefinical->id  ]
]);	    	

 
  
$nametr = Session::flash('statust',  'عودت مبلغ شارژ از کاربر باموفقیت انجام شد');
$nametrt = Session::flash('sessurl', 'viewsusers/edituser/'.$id.'');		  	
 return view('superadmin.success');  	
}

 
}	else{ return redirect('superadmin/sign-in'); }
}
 









public function dropzoneStoreuser(Request $request)
    {
        $image = $request->file('file');
        $imageName = time().$image->getClientOriginalName();
        $image->move(public_path('images'),$imageName);        
$updatee = \DB::table('user')->where('id', '=', Session::get('idimg'))  ->update(['user_img' => $imageName   ]);
        return response()->json(['success'=>$imageName]);
    }
		
	public function securityystud(Request $request ){
if (Session::has('signsuperadmin')){ 
$nametr = Session::flash('err', '2');
 $id=Session::get('idimg');
  	$this->validate($request,[
    			'userpassword' => 'required|min:5|max:35|confirmed',
    			'tell' => 'required',
    			'email' => 'required',
    		],[
    			'userpassword.required' => 'لطفا رمز ورود را وارد نمایید',
    			'userpassword.min' => ' رمز کوتاه است',
    			'userpassword.max' => ' رمزعبور طولانی است ',
    			'userpassword.confirmed' => 'رمزعبور با تکرار آن مطابقت ندارد ',
    			'tell.required' => 'دقت نمایید تا زمانی که شماره تلفن شما ثبت نشده باشد شما نمی توانید رمز خود را تغییر دهید',
    			'email.required' => 'دقت نمایید تا زمانی که ایمیل شما ثبت نشده باشد شما نمی توانید رمز خود را تغییر دهید',
    		]);
$encryptedPassword =  Crypt::encrypt($request->userpassword);
$decryptedPassword =  Crypt::decrypt($encryptedPassword);
$updatee = \DB::table('user')->where('id', '=', Session::get('idimg'))  ->update(['user_password' => $encryptedPassword   ]); 
$admins = \DB::table('user')->where('id', '=',  Session::get('idimg'))  ->orderBy('id', 'desc')->first();
			 $nametr = Session::flash('statust', 'رمز شما با موفقیت تغییر کرد.');
		  	$nametrt = Session::flash('sessurl', 'viewsusers/edituser/'. Session::get('idimg').'');
	
		  	
$user = \DB::table('user')->where('id', '=', Session::get('idimg'))  ->orderBy('id', 'desc')->first();

$superadminselanats =  DB::table('superadminselanats')  ->orderBy('id', 'desc')->first(); 

 if($superadminselanats->supelan_emailstudent == '1'){
 	if ( $user->user_email != '')  {
 	 $usernamee = $user->user_username; 
 $titmes='رمز شما با موفقیت تغییر کرد';
 $mestt='رمزجدید';
 $mesnot = Crypt::decrypt($user->user_password); 
   Mail::send('superadmin.mail', ['user' => $user , 'usernamee' => $usernamee, 'mesnot' => $mesnot, 'titmes' => $titmes , 'mestt' => $mestt], function ($m) use ($user) {       
$decryptedPassword =  Crypt::decrypt($user->user_password);
            $m->from('info@melatpay.com', 'رمز جدید');
            $m->to($user->user_email, $user->user_email)->subject('امنیت اطلاعات');
        }); 	
 } }
 
 
 if($superadminselanats->supelan_smsstudent == '1'){
 	if ( $user->student_tell != '')  {
 		
 $admins =  \DB::table('user')->where('id', '=', Session::get('idimg'))  ->orderBy('id', 'desc')->first();
$panelsms = \DB::table('panelsms')->where('id', '=',  1)  ->orderBy('id', 'desc')->first();
include(app_path().'/../sms/api_send_sms.php');
$message='با عرض سلام '.$admins->user_name.' عزیز. رمز شما با موفقیت تغییر کرد . رمز جدید : '.$decryptedPassword.' ';
$result = Send_SMS($panelsms->sms_username, $panelsms->sms_password, $panelsms->sms_fromnumber, $admins->user_tell, $message , 0, false) ; 		
 		
 		} }
 
 
	
	
    	 	return redirect('superadmin/viewsusers/edituser/'.$id.''); 
}	
else{ return redirect('superadmin/sign-in'); }
				}
		
		
	public function deletusersup($id){
		if (Session::has('signsuperadmin')){ 
		  	$admins = \ DB::table('user')->where('id', $id)->get();
		  	$admins = \DB::table('user')->where('id', '=', $id)->delete(); 
		  	$nametr = Session::flash('statust', 'حذف کاربر با موفقیت انجام شد.');
		  	$nametrt = Session::flash('sessurl', 'viewsusers');
		  	
	return view('superadmin.success', ['admins' => $admins]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}
		
		
	public function accusersup($id){
		if (Session::has('signsuperadmin')){ 
			
$adminacc =  DB::table('user')->where('id', '=', $id) ->orderBy('id', 'desc')->first();	
 
						
$updatee = \DB::table('user')->where('id', '=', $id)  ->update(['user_active' => 1   ]); 
		  	$admins = \ DB::table('user')->where('id', $id)->get();				
		  	$nametr = Session::flash('statust', 'اکانت کاربر با موفقیت فعال شد .');
		  	$nametrt = Session::flash('sessurl', 'viewsusers/edituser/'.$id.'');			  	
		  			  	
		  	$user = \DB::table('user')->where('id', '=', $id)  ->orderBy('id', 'desc')->first();
$superadminselanats =  DB::table('superadminselanats')  ->orderBy('id', 'desc')->first();
 if($superadminselanats->supelan_emailaccstudent == '1'){
 	if ( $adminacc->user_email != '')  {
	
$usernamee = $user->user_username; 
 $titmes='اکانت شما با موفقیت فعال شد';
 $mestt='رمز شما';
 $mesnot = Crypt::decrypt($user->user_password); 
   Mail::send('superadmin.mail', ['user' => $user , 'usernamee' => $usernamee, 'mesnot' => $mesnot, 'titmes' => $titmes , 'mestt' => $mestt], function ($m) use ($user) {
        
$decryptedPassword =  Crypt::decrypt($user->user_password);

            $m->from('info@melatpay.com', 'فعالسازی اکانت');

            $m->to($user->user_email, $user->user_email)->subject('فعالسازی اکانت');
        }); 	
 }		}	  	
	
 if($superadminselanats->supelan_smsaccstudent == '1'){	
   
$admins = \DB::table('user')->where('id', '=',  $id)  ->orderBy('id', 'desc')->first();
$panelsms = \DB::table('panelsms')->where('id', '=',  1)  ->orderBy('id', 'desc')->first();
include(app_path().'/../sms/api_send_sms.php');
$message='با عرض سلام '.$admins->user_name.' عزیز.     اکانت شما با موفقیت فعال شد';
if (($result = Send_SMS($panelsms->sms_username, $panelsms->sms_password, $panelsms->sms_fromnumber, $admins->user_tell, $message , 0, false)) === '0')
{ 
		
    	 	return redirect('superadmin/viewsusers/edituser/'.$id.''); 
} else if ($result !== '') {   
		
    	 	return redirect('superadmin/viewsusers/edituser/'.$id.''); 
 }


 }
	 
	
    	 	return redirect('superadmin/viewsusers/edituser/'.$id.''); 
		
	

 /* 
	   if (($adminacc->student_email == '') &&($adminacc->student_tell == '')  ) {
	 	 	$nametr = Session::flash('statust', 'متاسفانه اکانت فعال نشد برای فعال شدن اکانت   شماره تلفن و ایمیل باید در سیستم ثبت شده باشد. لطفا پس از تکمیل اطلاعات نسبت به تاییدی اکانت اقدام نمایید.');
		  	$nametrt = Session::flash('sessurl', 'viewsusers/edituser/'.$id.'');
	 	return view('superadmin.error');
	 	
	 	 } 	*/
} else{ return redirect('superadmin/sign-in'); }
				}
		
		
		
		
		
	public function accdocusersup($id){
		if (Session::has('signsuperadmin')){ 
			
$adminacc =  DB::table('user')->where('id', '=', $id) ->orderBy('id', 'desc')->first();	
 
						
$updatee = \DB::table('user')->where('id', '=', $id)  ->update(['user_autactive' => 1   ]); 
		  	$admins = \ DB::table('user')->where('id', $id)->get();				
		  	$nametr = Session::flash('statust', 'مدارک کاربر باموفقیت به تایید مدیریت رسید .');
		  	$nametrt = Session::flash('sessurl', 'viewsusers/edituser/'.$id.'');		
		  	
		  	
	return view('superadmin.success');
		  	
		  	
		  	} else{ return redirect('superadmin/sign-in'); }
				}
		
		
		
	public function rejusersup($id){
		if (Session::has('signsuperadmin')){ 				
$updatee = \DB::table('user')->where('id', '=', $id)  ->update(['user_active' => 0   ]); 
		  	$admins = \ DB::table('user')->where('id', $id)->get();				
		  	$nametr = Session::flash('statust', 'اکانت کاربر باموفقیت غیرفعال شد.');
		  	$nametrt = Session::flash('sessurl', 'viewsusers/edituser/'.$id.'');		  	
	
    	 	return redirect('superadmin/viewsusers/edituser/'.$id.''); 
	}	
else{ return redirect('superadmin/sign-in'); }
				}
			
		
	public function loginusersup($id){
if (Session::has('signsuperadmin')){ 
	Session::put('idimg', $id);
$admins = \DB::table('user')->where('id', '=', $id)  ->orderBy('id', 'desc')->first();

if($admins){

$password_db= $admins->user_password; 
$decryptedPassword =  Crypt::decrypt($password_db);
$userscou = DB::table('user')->where([
    ['user_username',  $admins->user_username],
])->count();
$name_db= $admins->user_name;
$id_db= $admins->id;
$activeadmin= $admins->user_active; 
$name_db= $admins->user_name; 
$username_db= $admins->user_username; 
$password_db= $admins->user_password; 
$username_log = $admins->user_username; 
if(($username_log == $username_db)&&( $decryptedPassword == Crypt::decrypt($password_db))){
	Session::set('fullname', $name_db);
	Session::set('iduser', $id_db);
	Session::set('signname', $name_db);
	Session::set('signuser', $username_db);
	Session::set('activeuser', $activeadmin);
	Session::set('idlang', '3');

$adminslp = \DB::table('user')->where('id', '=', $id_db)  ->orderBy('id', 'desc')->first();
$logindatepas=$adminslp->user_loginatdate;	

$admimg=$adminslp->user_img;
if(empty($admimg)){$admimg='user2x.png';}	
	Session::set('logindatepasus', $logindatepas);
	Session::set('usimg', $admimg);
	$updatee = \DB::table('user')->where('id', '=', Session::get('iduser'))  ->update(['user_loginatdate' => date('Y-m-d H:i:s')    ]); 
			return redirect('user/panel'); 
		} else 
			 $nametr = Session::flash('statust',  'اخطار');
				return redirect('user/sign-in'); 	
			
}


 
 
}	
else{ return redirect('superadmin/sign-in'); }
}





		
	public function addcurrencytransfer(){
if (Session::has('signsuperadmin')){ 
	Session::set('nav', 'addcurrencytransfer'); 
	$currencys= \DB::table('currency')  ->where([['cur_active', '<>',  '0'] , ])->orderBy('id', 'asc')->get(); 
	return view('superadmin.addcurrencytransfer', ['currencys' => $currencys]); 
	}	
else{ return redirect('superadmin/sign-in'); }
				}


public function addcurrencytransferpost(Request $request){
if (Session::has('signsuperadmin')){    	    	
    	$this->validate($request,[
    			'name' => 'required',  
    			'cata' => 'required',  
    			'fixfee' => 'required|numeric',  
    			'varbfee' => 'required|numeric',  
    			'file'  => 'required|max:1000', 
    		],[
    			'name.required' => 'لطفا نام حواله ارزی را وارد نمایید',  
    			'cata.required' => 'لطفا کارنسی را وارد نمایید',  
    			'fixfee.required' => 'لطفا کارمزد ثابت را وارد نمایید', 
    			'fixfee.numeric' => 'لطفا فرمت کارمزد ثابت را به صورت صحیح وارد نمایید', 
    			'varbfee.required' => 'لطفا کارمزد متغیر را وارد نمایید', 
    			'varbfee.numeric' => 'لطفا فرمت کارمزد متغیر را به صورت صحیح وارد نمایید', 
    			'file.required' => 'لطفا نسبت به آپلود آیکن اقدام نمایید',  
    			'file.max' => 'حجم فایل آپلود شده بیشتر از حد مجاز می باشد. (حدمجاز 1مگابایت یا کمتر از این مقدار باید باشد)', 
    		]);   
    		
 
 

 if( $request->hasFile('file')){ 
        $image = $request->file('file');
        $imageName = time().$image->getClientOriginalName();
        $image->move(public_path('images'),$imageName);  
	 
    } else { 
     	$nametr = Session::flash('statusimg', 'عدم موفقیت');
 	return  redirect('superadmin/addcurrencytransfer');   }

    		

DB::table('currencytransfer')->insert([
    [ 'ctrf_name' =>  $request->name ,  'ctrf_cur' =>  $request->cata ,   'ctrf_createdatdate' =>  date('Y-m-d H:i:s') , 'ctrf_active' => 0  , 'ctrf_type' => 1   ,  'ctrf_fixfee' =>  $request->fixfee  ,  'ctrf_varebfee' =>  $request->varbfee  ,  'ctrf_img' =>  $imageName     ]
]);  

$nametr = Session::flash('statust', 'ثبت حواله ارزی باموفقیت انجام شد.');
$nametrt = Session::flash('sessurl', 'viewscurrencytransfer');
return view('superadmin.success');
    		
}	
else{ return redirect('superadmin/sign-in'); }
				}




	public function viewscurrencytransfer(){
if (Session::has('signsuperadmin')){ Session::set('nav', 'viewscurrencytransfer'); 
$admins = \DB::table('currencytransfer')->where([
    ['currencytransfer.ctrf_id', '<>', 0], 
    ['currencytransfer.ctrf_type', '=', 1], ])
    ->orderBy('ctrf_id', 'desc')->get();
return view('superadmin.viewscurrencytransfer', ['admins' => $admins]);
}	
else{ return redirect('superadmin/sign-in'); }
}


	public function currencytransferid($id){
if (Session::has('signsuperadmin')){ 
	Session::put('idimg', $id); Session::set('nav', 'viewscurrencytransfer'); 
 
$admins = \DB::table('currencytransfer')
->join('currency', 'currencytransfer.ctrf_cur', '=', 'currency.id') ->where([
    ['currencytransfer.ctrf_id', '<>', 0], 
    ['currencytransfer.ctrf_type', '=', 1], 
    ['currencytransfer.ctrf_id', '=', $id], ])
    ->orderBy('ctrf_id', 'desc')->get(); 
    
$currencys= \DB::table('currency')  ->where([['cur_active', '<>',  '0'] , ])->orderBy('id', 'asc')->get(); 

return view('superadmin.editcurrencytransfer', ['admins' => $admins , 'currencys' => $currencys  ]); 

}	
else{ return redirect('superadmin/sign-in'); }
}

 
		
	public function currencytransferidpost($id  , Request $request ){
if (Session::has('signsuperadmin')){ 
 

 	$this->validate($request,[
    			'name' => 'required',  
    			'cata' => 'required',  
    			'fixfee' => 'required|numeric',  
    			'varbfee' => 'required|numeric',  
    		],[
    			'name.required' => 'لطفا نام حواله ارزی را وارد نمایید',  
    			'cata.required' => 'لطفا کارنسی را وارد نمایید',  
    			'fixfee.required' => 'لطفا کارمزد ثابت را وارد نمایید', 
    			'fixfee.numeric' => 'لطفا فرمت کارمزد ثابت را به صورت صحیح وارد نمایید', 
    			'varbfee.required' => 'لطفا کارمزد متغیر را وارد نمایید', 
    			'varbfee.numeric' => 'لطفا فرمت کارمزد متغیر را به صورت صحیح وارد نمایید', 
    		]);   
    		
$admins = \DB::table('currencytransfer')
->join('currency', 'currencytransfer.ctrf_cur', '=', 'currency.id') ->where([
    ['currencytransfer.ctrf_id', '<>', 0], 
    ['currencytransfer.ctrf_type', '=', 1], 
    ['currencytransfer.ctrf_id', '=', $id], ])
    ->orderBy('ctrf_id', 'desc')->first(); 
    
$imageName=$admins->ctrf_img;

 if( $request->hasFile('file')){ 
        $image = $request->file('file');
        $imageName = time().$image->getClientOriginalName();
        $image->move(public_path('images'),$imageName);  
	 
    }


  
$updatee = \DB::table('currencytransfer')->where('ctrf_id', '=', $id)  ->update(['ctrf_name' => $request->name    ,   'ctrf_active' => 0   ,  'ctrf_fixfee' =>  $request->fixfee  ,  'ctrf_varebfee' =>  $request->varbfee ,  'ctrf_cur' =>  $request->cata ,  'ctrf_img' =>  $imageName ]); 

$nametr = Session::flash('statust', 'حواله ارزی باموفقیت ویرایش شد.');
		  	$nametrt = Session::flash('sessurl', 'viewscurrencytransfer/'.$id.'');	
	 
return view('superadmin.success');  
}	else{ return redirect('superadmin/sign-in'); }
}
	



		
	public function currencytransferidacc($id){
		if (Session::has('signsuperadmin')){  
$updatee = \DB::table('currencytransfer')->where('ctrf_id', '=', $id)  ->update(['ctrf_active' => 1   ]);  
		  	$nametr = Session::flash('statust', 'حواله ارزی باموفقیت فعال شد .');
		  	$nametrt = Session::flash('sessurl', 'viewscurrencytransfer/'.$id.'');		 
	return view('superadmin.success'); 
} else{ return redirect('superadmin/sign-in'); }
				}
		
		

		
	public function currencytransferidrej($id){
		if (Session::has('signsuperadmin')){  
$updatee = \DB::table('currencytransfer')->where('ctrf_id', '=', $id)  ->update(['ctrf_active' => 0   ]);  
		  	$nametr = Session::flash('statust', 'حواله ارزی غیرفعال شد .');
		  	$nametrt = Session::flash('sessurl', 'viewscurrencytransfer/'.$id.'');		 
	return view('superadmin.success'); 
} else{ return redirect('superadmin/sign-in'); }
				}
		
		

	public function currencytransferiddelet($id){
		if (Session::has('signsuperadmin')){  
		  	$admins = \DB::table('currencytransfer')->where('ctrf_id', '=', $id)->delete(); 
		  	$nametr = Session::flash('statust', 'حواله ارزی باموفقیت حذف شد.');
		  	$nametrt = Session::flash('sessurl', 'viewscurrencytransfer');
		  	
	return view('superadmin.success', ['admins' => $admins]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}
		


	public function addcurrency(){
if (Session::has('signsuperadmin')){ 
	Session::set('nav', 'addcurrency');  
	return view('superadmin.addcurrency');
 }	
else{ return redirect('superadmin/sign-in'); }
				}




public function addcurrencypost(Request $request){
if (Session::has('signsuperadmin')){    	    	
    	$this->validate($request,[
    			'name' => 'required',  
    			'nem' => 'required',  
    			'price' => 'required|numeric',  
    		],[
    			'name.required' => 'لطفا نام کارنسی را وارد نمایید',  
    			'nem.required' => 'لطفا نماد کارنسی را وارد نمایید',  
    			'price.required' => 'لطفا قیمت کارنسی را وارد نمایید',  
    			'price.numeric' => 'لطفا قیمت کارنسی را به صورت ریال وارد نمایید',  
    		]);   

DB::table('currency')->insert([
    [ 'cur_name' =>  $request->name , 'cur_nem' =>  $request->nem , 'cur_gh' =>  $request->price ,   'cur_createdatdate' =>  date('Y-m-d H:i:s') , 'cur_active' => 0       ]
]);  

$nametr = Session::flash('statust', 'ثبت کارنسی باموفقیت انجام شد.');
$nametrt = Session::flash('sessurl', 'viewscurrency');
return view('superadmin.success');
    		
}	
else{ return redirect('superadmin/sign-in'); }
				}







	public function viewscurrency(){
if (Session::has('signsuperadmin')){ Session::set('nav', 'viewscurrency'); 
$admins = \DB::table('currency') ->orderBy('id', 'desc')->get();
return view('superadmin.viewscurrency', ['admins' => $admins]);
}	
else{ return redirect('superadmin/sign-in'); }
}



	public function editcurrency($id){
if (Session::has('signsuperadmin')){ Session::set('nav', 'viewscurrency'); 
$admins = \DB::table('currency') ->where('id', '=', $id)  -> orderBy('id', 'desc')->get();
return view('superadmin.editcurrency', ['admins' => $admins]);
}	
else{ return redirect('superadmin/sign-in'); }
}




		
	public function editcurrencypost($id  , Request $request ){
if (Session::has('signsuperadmin')){ 
    	$this->validate($request,[
    			'cur_gh' => 'required',  
    		],[
    			'cur_gh.required' => 'لطفا قیمت کارنسی به ریال را وارد نمایید',  
    		]); 
 
  
$updatee = \DB::table('currency')->where('id', '=', $id)  ->update(['cur_gh' => $request->cur_gh    ,   'cur_active' => 0 ]); 

$nametr = Session::flash('statust', 'کارنسی باموفقیت ویرایش شد.');
		  	$nametrt = Session::flash('sessurl', 'viewscurrency/'.$id.'');	
	 
return view('superadmin.success');  
}	else{ return redirect('superadmin/sign-in'); }
}
	





		
	public function acccurrency($id){
		if (Session::has('signsuperadmin')){  
$updatee = \DB::table('currency')->where('id', '=', $id)  ->update(['cur_active' => 1   ]);  
		  	$nametr = Session::flash('statust', 'کارنسی باموفقیت فعال شد .');
		  	$nametrt = Session::flash('sessurl', 'viewscurrency/'.$id.'');		 
	return view('superadmin.success'); 
} else{ return redirect('superadmin/sign-in'); }
				}
		
		
	public function rejcurrency($id){
		if (Session::has('signsuperadmin')){  
$updatee = \DB::table('currency')->where('id', '=', $id)  ->update(['cur_active' => 0   ]);  
		  	$nametr = Session::flash('statust', 'کارنسی باموفقیت غیرفعال شد .');
		  	$nametrt = Session::flash('sessurl', 'viewscurrency/'.$id.'');		 
	return view('superadmin.success'); 
} else{ return redirect('superadmin/sign-in'); }
				}
		

		
	public function addservice(){
if (Session::has('signsuperadmin')){ 
	Session::set('nav', 'addservice'); 
$currencys= \DB::table('currency')  ->where([['cur_active', '<>',  '0'] , ])->orderBy('id', 'asc')->get(); 
	return view('superadmin.addservice', ['currencys' => $currencys]);
 }	
else{ return redirect('superadmin/sign-in'); }
				}


		
	public function form(){
if (Session::has('signsuperadmin')){ 
	Session::set('nav', 'addservice'); 
$currencys= \DB::table('currency')  ->where([['cur_active', '<>',  '0'] , ])->orderBy('id', 'asc')->get(); 
	return view('superadmin.form', ['currencys' => $currencys]);
 }	
else{ return redirect('superadmin/sign-in'); }
				}



		
	public function testsms(){
if (Session::has('signsuperadmin')){ 


	$APIKey = "fb3104e963922916e94500a8";
	$SecretKey = "!Mehdi1241368";
	$LineNumber = "30004747479829"; 
	$MobileNumbers = array('09384762155' ); 
	$Messages = array('تست مجدد'  );
	
include(app_path().'/../testsms/SendMessage.php');


echo 'shod'; 

 }	
else{ return redirect('superadmin/sign-in'); }
				}







			
	public function viewsuserticketssup(){
		if (Session::has('signsuperadmin')){ 
		
		
		

$h = new SuperadminController();
$h->viewalertnot();



	Session::set('nav', 'viewsuserticketssup'); 
$admins = \DB::table('user') 
->join('ticket', 'user.id', '=', 'ticket.tik_fromid')
->where([
    ['tik_fromarou', '=', 4],
    ['tik_toarou', '=', 2],
    ['tik_tosh', '=', 1],])
    ->orderBy('ticket.tik_date', 'desc')->get();


$tickread = DB::table('user') 
->join('ticket', 'user.id', '=', 'ticket.tik_fromid')->where([
    ['tik_fromarou', '=', 4],
    ['tik_toarou', '=', 2],
    ['tik_tosh', '=', 1],
    ['tik_toread', '=', 0],])
    ->orderBy('ticket.id', 'desc')->count();
	Session::set('tickreadstudentsup', $tickread);   
    
    
return view('sup.viewsuserticketssup', ['admins' => $admins]);
}	else{ return redirect('superadmin/sign-in'); }
}	




	public function ticketsup($id){
if (Session::has('signsuperadmin')){ 
	Session::put('idimg', $id);
	Session::set('nav', 'viewsuserticketssup'); 
$tickets = \DB::table('user') 
->join('ticket', 'user.id', '=', 'ticket.tik_fromid')->where([
    ['ticket.id', '=', $id],
    ['tik_fromarou', '=', 4],
    ['tik_toarou', '=', 2],
    ['tik_tosh', '=', 1],])  ->orderBy('ticket.id', 'desc')->get();
$messages = \DB::table('message')->where('mes_ticket', '=', $id)  ->orderBy('id')->get();

$updatee = \DB::table('user') 
->join('ticket', 'user.id', '=', 'ticket.tik_fromid')->where([
    ['ticket.id', '=', $id],
    ['tik_fromarou', '=', 4],
    ['tik_toarou', '=', 2],
    ['tik_tosh', '=', 1],])  ->update(['tik_toread' => 1   ]); 
    
$tickread = DB::table('user') 
->join('ticket', 'user.id', '=', 'ticket.tik_fromid')->where([
    ['tik_fromarou', '=', 4],
    ['tik_toarou', '=', 2],
    ['tik_tosh', '=', 1],
    ['tik_toread', '=', 0],])
    ->orderBy('ticket.id', 'desc')->count();
	Session::set('tickreadstudentsup', $tickread);  
	


$typ='14';
$link=$id;
$req=0;
$h = new SuperadminController();
$h->showupdatealert($typ,$link,$req);


 
return view('sup.ticket', ['tickets' => $tickets], ['messages' => $messages]); }	
else{ return redirect('superadmin/sign-in'); }
				}
	




		
	public function ticketusersupPost($id  , Request $request ){
if (Session::has('signsuperadmin')){ 
$this->validate($request,[
    			'des' => 'required|min:2|max:666',
    		],[
    			'des.required' => 'لطفا پیام خود را وارد نمایید',
    			'des.min' => 'پیام شما نا معتبر است',
    			'des.max' => 'پیام شما نا معتبر است',
    			
    		]);
    
    DB::table('message')->insert([
    ['mes_ticket' => $id ,  'mes_des' => $request->des   , 'mes_createdatdate' =>  date('Y-m-d H:i:s') , 'mes_flg' =>  2    ]
]);

 $updatee = \DB::table('user') 
->join('ticket', 'user.id', '=', 'ticket.tik_fromid')->where([
    ['ticket.id', '=', $id],
    ['tik_fromarou', '=', 4],
    ['tik_toarou', '=', 2],
    ['tik_tosh', '=', 1],])  ->update(['tik_fromread' => 0 , 'tik_active' => 2  ,     'tik_date' =>  date('Y-m-d H:i:s')   ]); 
    
 
    
    
$tickets = \DB::table('ticket') 
->join('user', 'ticket.tik_fromid', '=', 'user.id')->where([
    ['ticket.id', '=', $id], ])  ->orderBy('ticket.id', 'desc')->first(); 


$iduser=$tickets->id;     
$typ='15';
$link=$id;
$req='0';
$h = new SuperadminController();
$h->alertsup($iduser,$typ,$link,$req);

$nametr = Session::flash('statust', 'پیام شما با موفقیت ارسال شد.');
$nametrt = Session::flash('sessurl', 'viewsuserticketssup/ticket/'.$id.'');
//return view('superadmin.success');

    	 	return  redirect('superadmin/viewsuserticketssup/ticket/'.$id.'');

}	else{ return redirect('superadmin/sign-in'); }
}
		


	public function closeticketusersup($id){
if (Session::has('signsuperadmin')){ 
	
 $updatee = \DB::table('user') 
->join('ticket', 'user.id', '=', 'ticket.tik_fromid')->where([
    ['ticket.id', '=', $id],
    ['tik_fromarou', '=', 4],
    ['tik_toarou', '=', 2],
    ['tik_tosh', '=', 1],])  ->update(['tik_active' => 0   ]); 

$nametr = Session::flash('statust', 'تیکت با موفقیت بسته شد.');
$nametrt = Session::flash('sessurl', 'viewsuserticketssup');

    	 	return  redirect('superadmin/viewsuserticketssup');	

 }	else{ return redirect('superadmin/sign-in'); }
				}



			
	public function viewsuserticketssupactive(){
		if (Session::has('signsuperadmin')){ 
		
	Session::set('nav', 'viewsuserticketssupactive'); 
	
$admins = \DB::table('user') 
->join('ticket', 'user.id', '=', 'ticket.tik_fromid')
->where([
    ['tik_fromarou', '=', 4],
    ['tik_toarou', '=', 2],
    ['tik_active', '=', '1'],
    ['tik_tosh', '=', 1],])
    ->orderBy('ticket.tik_date', 'desc')->get();


$tickread = DB::table('user') 
->join('ticket', 'user.id', '=', 'ticket.tik_fromid')->where([
    ['tik_fromarou', '=', 4],
    ['tik_toarou', '=', 2],
    ['tik_tosh', '=', 1],
    ['tik_toread', '=', 0],])
    ->orderBy('ticket.id', 'desc')->count();
	Session::set('tickreadstudentsup', $tickread);   
    
    
return view('sup.viewsuserticketssup', ['admins' => $admins]);
}	else{ return redirect('superadmin/sign-in'); }
}	






	public function deletticketusersup($id){
if (Session::has('signsuperadmin')){ 
	
 $updatee = \DB::table('user') 
->join('ticket', 'user.id', '=', 'ticket.tik_fromid')->where([
    ['ticket.id', '=', $id],
    ['tik_fromarou', '=', 4],
    ['tik_toarou', '=', 2],
    ['tik_tosh', '=', 1],])  ->update(['tik_tosh' => 0   ]); 

$nametr = Session::flash('statust', 'تیکت شما با موفقیت حذف شد.');
$nametrt = Session::flash('sessurl', 'viewsuserticketssup');

    	 	return  redirect('superadmin/viewsuserticketssup');

 }	else{ return redirect('superadmin/sign-in'); }
				}
	


	
	public function addelanuser(){
if (Session::has('signsuperadmin')){
	
	Session::set('nav', 'addelanuser'); 
$students = \DB::table('user') ->orderBy('id', 'desc')->get();	
 return view('superadmin.addelanuser' , ['students' => $students    ]);
  }	else{ return redirect('superadmin/sign-in'); }
		}	





public function addelanuserPost(Request $request){
if (Session::has('signsuperadmin')){ 	
    	
    	$this->validate($request,[
    			'my_checkbox' => 'required',
    			'tit' => 'required|min:3|max:99',
    			'des' => 'required|min:5|max:4999'
    		],[
    			'my_checkbox.required' => 'گیرندگان اطلاعیه مشخص نشده است',
    			'tit.required' => 'لطفا عنوان تیکت را وارد نمایید',
    			'tit.min' => 'عنوان تیکت تایپ شده نامعتبر است',
    			'tit.max' => 'یوزرنیم شما باید کمتر ازعنوان تیکت تایپ شده نامعتبر استکارکتر باشد',
    			'des.required' => 'لطفا متن پیام خود را وارد نمایید',
    			'des.min' => 'متن پیام نامعتبر است',
    			'des.max' => 'متن پیام نامعتبر است',
    		]);
 

$panelsms = \DB::table('panelsms')->where('id', '=',  1)  ->orderBy('id', 'desc')->first();
include(config_path().'/../sms/api_send_sms.php');

$myCheckboxes = $request->input('my_checkbox');

if($myCheckboxes != NULL)  {
foreach($myCheckboxes as $quan) { 
	
DB::table('ticket')->insert([
    ['tik_tit' => $request->tit ,     'tik_createdatdate' =>  date('Y-m-d H:i:s') , 'tik_fromarou' => 1 , 'tik_toarou' => 4 , 'tik_toid' => $quan ,  'tik_fromsh' => 1 , 'tik_tosh' => 1 , 'tik_active' => 1 , 'tik_fromread' => 1 , 'tik_toread' => 0]
]);

$users = DB::table('ticket')->where('tik_tit', $request->tit)->orderBy('id', 'desc')->first(); 
$idtik= $users->id;   
DB::table('message')->insert([
    ['mes_ticket' => $idtik ,  'mes_des' => $request->des   , 'mes_createdatdate' =>  date('Y-m-d H:i:s') , 'mes_flg' =>  3    ]
]);


 	$user = \DB::table('user')->where('id', '=', $quan)  ->orderBy('id', 'desc')->first();
if($request->email=='1'){
if ( $user->user_email != '')  {
 $usernamee = $user->user_username; 
 $titmes= $request->tit;
 $mestt='متن اطلاعیه';
 $mesnot = $request->des; 
   Mail::send('superadmin.mail', ['user' => $user , 'usernamee' => $usernamee, 'mesnot' => $mesnot, 'titmes' => $titmes , 'mestt' => $mestt], function ($m) use ($user) {       
$m->from('info@kargo.biz', 'اطلاعیه جدید');
$m->to($user->user_email, $user->user_email)->subject('اطلاعیه جدید');
        }); 	
 }	}

if($request->tell=='1'){
if ( $user->user_tell != '')  {
	 
$message='با عرض سلام '.$user->user_name.' عزیز.  '.$request->des;
$result = Send_SMS($panelsms->sms_username, $panelsms->sms_password, $panelsms->sms_fromnumber, $user->user_tell, $message , 0, false) ; } }

	

 }
 	  }     		
    		
			 $nametr = Session::flash('statust', 'اطلاع رسانی به کاربران انتخابی با موفقیت انجام شد.');
		  	$nametrt = Session::flash('sessurl', 'viewselanats');
		  return view('superadmin.success'); 
 }	else{ return redirect('superadmin/sign-in'); }   
 }  






	public function viewselanatsusers(){
if (Session::has('signsuperadmin')){ 

	Session::set('nav', 'viewselanats'); 
$admins = \DB::table('user') 
->join('ticket', 'user.id', '=', 'ticket.tik_toid') 
->where([
    ['ticket.tik_fromarou', '=', 1],
    ['ticket.tik_toarou', '=', 4],
    ['ticket.tik_fromsh', '=', 1],])
    ->orderBy('ticket.id', 'desc')->get();
    
return view('superadmin.viewselanats', ['admins' => $admins]);
 }	else{ return redirect('superadmin/sign-in'); } 
}	




	public function elanattikuser($id){
if (Session::has('signsuperadmin')){
	Session::put('idimg', $id);
$tickets = \DB::table('user') 
->join('ticket', 'user.id', '=', 'ticket.tik_toid')->where([
    ['ticket.id', '=', $id],
    ['tik_fromarou', '=', 1],
    ['tik_toarou', '=', 4],
    ['tik_tosh', '=', 1],])  ->orderBy('ticket.id', 'desc')->get();
$messages = \DB::table('message')->where('mes_ticket', '=', $id)  ->orderBy('id')->get();

return view('superadmin.elanattik', ['tickets' => $tickets], ['messages' => $messages]); 
 }	else{ return redirect('superadmin/sign-in'); }
				}







	public function viewsgetwaypays(){
		if (Session::has('signsuperadmin')){ 
	Session::set('nav', 'viewsgetwaypays');
		$admins = \DB::table('getwaypay') ->where([
    ['getwaypay.id', '<', '9'],])
    ->orderBy('id', 'desc')->get();
return view('superadmin.viewsgetwaypays', ['admins' => $admins]);
}	else{ return redirect('superadmin/sign-in'); }
}




	public function editgetwaypay($id){
if (Session::has('signsuperadmin')){
	Session::set('nav', 'viewsgetwaypays');
$admins = \DB::table('getwaypay')->where('id', '=', $id)  ->orderBy('id', 'desc')->get();
return view('superadmin.getwaypay', ['admins' => $admins]); }	
else{ return redirect('superadmin/sign-in'); }
				}
	


		
	public function editgetwaypaypost($id  , Request $request ){
if (Session::has('signsuperadmin')){ 

 if($id==1||$id==11){
 $updatee = \DB::table('getwaypay')->where('id', '=', $id)  ->update(['getway_terminal' => $request->terminal ,  'getway_username' => $request->username ,  'getway_password' => $request->password ,  'getway_createdatdate' => date('Y-m-d H:i:s') ]); 	
 }
   if($id==2||$id==4||$id==12){
 $updatee = \DB::table('getwaypay')->where('id', '=', $id)  ->update(['getway_merchent' => $request->merchent  ,  'getway_createdatdate' => date('Y-m-d H:i:s') ]); 		
	}
 if($id==3||$id==13){
 $updatee = \DB::table('getwaypay')->where('id', '=', $id)  ->update(['getway_merchent' => $request->merchent  ,  'getway_createdatdate' => date('Y-m-d H:i:s') ]); 		
	}
	 
$nametr = Session::flash('statust', 'اطلاعات درگاه پرداخت با موفقیت ویرایش شد.');
$nametrt = Session::flash('sessurl', 'viewsgetwaypays/getwaypay/'.$id.'');

return view('superadmin.success');
}	else{ return redirect('superadmin/sign-in'); }
}
		

	public function accgetwaypay($id){
		if (Session::has('signsuperadmin')){ 				
$updatee = \DB::table('getwaypay')->where('id', '=', $id)  ->update(['getway_active' => 1   ]); 
		  	$nametr = Session::flash('statust', 'درگاه پرداخت با موفقیت فعال شد.');
		  	$nametrt = Session::flash('sessurl', 'viewsgetwaypays/getwaypay/'.$id.'');		  	
return view('superadmin.success');
	}	
else{ return redirect('superadmin/sign-in'); }
				}
				
		
		


	public function rejgetwaypay($id){
		if (Session::has('signsuperadmin')){ 				
$updatee = \DB::table('getwaypay')->where('id', '=', $id)  ->update(['getway_active' => 0   ]); 
		  	$nametr = Session::flash('statust', 'درگاه پرداخت با موفقیت غیرفعال شد.');
		  	$nametrt = Session::flash('sessurl', 'viewsgetwaypays/getwaypay/'.$id.'');		  	
return view('superadmin.success');
	}	
else{ return redirect('superadmin/sign-in'); }
				}
				



		
	public function mngprice(){
		if (Session::has('signsuperadmin')){ 
	Session::set('nav', 'mngprice');
$admins = \DB::table('form') ->where([
    ['form.form_id', '<>', 0], 
    ['form.form_linkname', '<>', ''], 
    ['form.form_linkname', '<>', 'buy_test'], 
    ['form.form_active', '=', '1'],  ])
    ->orderBy('form_id', 'desc')->get();
return view('sup.mngprice', ['admins' => $admins]);
}	else{ return redirect('superadmin/sign-in'); }
}




		
	public function mngpriceid($id  , Request $request ){
if (Session::has('signsuperadmin')){ 
 
 $updatee = \DB::table('form')->where('form_rnd', '=', $id)  ->update(['form_price' => $request->name  ]); 	
  		 
$nametr = Session::flash('statust', 'هزینه فرم باموفقیت ویرایش شد.');
$nametrt = Session::flash('sessurl', 'mngprice');
return redirect('superadmin/mngprice'); 
}	else{ return redirect('superadmin/sign-in'); }
}
		


	
	public function mngcurrency(){
		if (Session::has('signsuperadmin')){ 
	Session::set('nav', 'mngcurrency');
$admins = \DB::table('currency') ->where([
    ['currency.id', '<>', 0],   ])
    ->orderBy('id', 'asc')->get();
return view('sup.mngcurrency', ['admins' => $admins]);
}	else{ return redirect('superadmin/sign-in'); }
}



	public function mngcurrencyidpost($id  , Request $request ){
if (Session::has('signsuperadmin')){ 
 
 $updatee = \DB::table('currency')->where('id', '=', $id)  ->update(['cur_gh' => $request->name  ]); 	
  		 
$nametr = Session::flash('statust', ' هزینه کارنسی باموفقیت ویرایش شد.');
$nametrt = Session::flash('sessurl', 'mngcurrency');
return redirect('superadmin/mngcurrency'); 
}	else{ return redirect('superadmin/sign-in'); }
}
		


		
	public function viewspanelsms(){
		if (Session::has('signsuperadmin')){ 
	Session::set('nav', 'viewspanelsms');
$admins = \DB::table('panelsms') ->orderBy('id', 'desc')->get();
return view('superadmin.viewspanelsms', ['admins' => $admins]);
}	else{ return redirect('superadmin/sign-in'); }
}


		
	public function viewsrezervmakssup(){
		if (Session::has('signsuperadmin')){ 
	Session::set('nav', 'viewsrezervmaks');
	
	

$h = new SuperadminController();
$h->viewalertnot();



	
$admins  = \DB::table('listrezerv') 
->join('calendarrezerv', 'listrezerv.list_idcl', '=', 'calendarrezerv.cal_id')  
->join('user', 'listrezerv.list_iduser', '=', 'user.id')  
->leftJoin('makcenter', 'listrezerv.list_mak', '=', 'makcenter.mak_id') 
->where([
    ['calendarrezerv.cal_id', '<>', 0],  ])
    ->orderBy('listrezerv.list_id', 'desc')->get();
        
	
return view('sup.viewsrezervmaks', ['admins' => $admins]);
}	else{ return redirect('superadmin/sign-in'); }
}





public function rezervmaksupid($idrezerv , $id){

 if (Session::has('signsuperadmin')){ 

 Session::set('nav', 'viewsrezervmaks'); 
   

$typ='12';
$link=$idrezerv;
$req=$id;
$h = new SuperadminController();
$h->showupdatealert($typ,$link,$req);        
        
        
$month = DB::table('month')->where([
    ['month_id', '<>', 0], 
    ['month_month', '=', Session::get('month')],
    ['month_year', '=', Session::get('year')], ])
    ->orderBy('month_id', 'desc')->first(); 
    
    
$calendarrezervs = DB::table('calendarrezerv')->where([
    ['cal_id', '<>', 0], 
    ['cal_month', '=', Session::get('month')],
    ['cal_year', '=', Session::get('year')], ])
    ->orderBy('cal_id', 'desc')->get(); 
    
 $todayshamsi=  \DB::table('dateshamsi')  ->where([ ['id', '=',  1],   ])->orderBy('id', 'desc')->first(); 
 
 
if($idrezerv=='addrezerv'){
$listrezerv = \DB::table('listrezerv') 
->join('calendarrezerv', 'listrezerv.list_idcl', '=', 'calendarrezerv.cal_id')  
->join('user', 'listrezerv.list_iduser', '=', 'user.id')   
->where([
    ['calendarrezerv.cal_id', '<>', 0], ])
    ->orderBy('listrezerv.list_id', 'desc')->first();
	
}else{
	
$listrezerv = \DB::table('listrezerv') 
->join('calendarrezerv', 'listrezerv.list_idcl', '=', 'calendarrezerv.cal_id')  
->join('user', 'listrezerv.list_iduser', '=', 'user.id')   
->where([
    ['calendarrezerv.cal_id', '<>', 0],
    ['listrezerv.list_id', '=', $idrezerv],  ])
    ->orderBy('listrezerv.list_id', 'desc')->first();
}
 
 
$makcenters = \DB::table('makcenter')   
->where([
    ['makcenter.mak_id', '<>', 0], ])
    ->orderBy('makcenter.mak_id', 'asc')->get();
	    
	return view('sup.rezervmak', ['month' => $month , 'todayshamsi' => $todayshamsi , 'calendarrezervs' => $calendarrezervs , 'id' => $id  , 'listrezerv' => $listrezerv  , 'makcenters' => $makcenters  ,  'idrezerv' => $idrezerv ]);
     

		}	else{ return redirect('superadmin/sign-in'); }
}


	





	public function editpanelsms($id){
if (Session::has('signsuperadmin')){
	Session::set('nav', 'viewspanelsms');
$admins = \DB::table('panelsms')->where('id', '=', $id)  ->orderBy('id', 'desc')->get();
return view('superadmin.panelsms', ['admins' => $admins]); }	
else{ return redirect('superadmin/sign-in'); }
				}
	

		
	public function editpanelsmspost($id  , Request $request ){
if (Session::has('signsuperadmin')){ 
 
 $updatee = \DB::table('panelsms')->where('id', '=', $id)  ->update(['sms_panelname' => $request->panelname ,  'sms_fromnumber' => $request->fromnumber ,  'sms_username' => $request->username ,  'sms_password' => $request->password ,  'sms_createdatdate' => date('Y-m-d H:i:s') ]); 	
  		
 
	 
$nametr = Session::flash('statust', 'اطلاعات پنل اسمس با موفقیت ویرایش شد.');
$nametrt = Session::flash('sessurl', 'viewspanelsms/panelsms/'.$id.'');

return view('superadmin.success');
}	else{ return redirect('superadmin/sign-in'); }
}
		



public function addservicepost(Request $request){
if (Session::has('signsuperadmin')){    	    	
    	$this->validate($request,[
    			'name' => 'required', 
    			'cata' => 'required',  
    			'catam' => 'required|numeric',  
    			'fixfee' => 'required|numeric',  
    			'varbfee' => 'required|numeric', 
    			'file'  => 'required|max:1000',  
    		],[
    			'name.required' => 'لطفا نام سرویس را وارد نمایید', 
    			'cata.required' => 'لطفا کارنسی را وارد نمایید', 
    			'catam.required' => 'لطفا قیمت سرویس را به دلار وارد نمایید', 
    			'catam.numeric' => 'لطفا فرمت قیمت را به صورت صحیح وارد نمایید', 
    			'fixfee.required' => 'لطفا کارمزد ثابت را وارد نمایید', 
    			'fixfee.numeric' => 'لطفا فرمت کارمزد ثابت را به صورت صحیح وارد نمایید', 
    			'varbfee.required' => 'لطفا کارمزد متغیر را وارد نمایید', 
    			'varbfee.numeric' => 'لطفا فرمت کارمزد متغیر را به صورت صحیح وارد نمایید', 
    			'file.required' => 'لطفا نسبت به آپلود آیکن اقدام نمایید',  
    			'file.max' => 'حجم فایل آپلود شده بیشتر از حد مجاز می باشد. (حدمجاز 1مگابایت یا کمتر از این مقدار باید باشد)',  
    		]);   
    		

 if( $request->hasFile('file')){ 
        $image = $request->file('file');
        $imageName = time().$image->getClientOriginalName();
        $image->move(public_path('images'),$imageName);  
	 
    } else { 
     	$nametr = Session::flash('statusimg', 'عدم موفقیت');
 	return  redirect('superadmin/addservice');   }

    		
    		

DB::table('currencytransfer')->insert([
    [ 'ctrf_name' =>  $request->name ,  'ctrf_pay' =>  $request->catam ,   'ctrf_createdatdate' =>  date('Y-m-d H:i:s') , 'ctrf_active' => 1  , 'ctrf_type' => 2    , 'ctrf_cur' => $request->cata  ,  'ctrf_fixfee' =>  $request->fixfee  ,  'ctrf_varebfee' =>  $request->varbfee    ,  'ctrf_img' =>  $imageName       ]
]);  

$nametr = Session::flash('statust', 'ثبت سرویس باموفقیت انجام شد.');
$nametrt = Session::flash('sessurl', 'viewsservice');
return view('superadmin.success');
    		
}	
else{ return redirect('superadmin/sign-in'); }
				}




	public function viewsservice(){
if (Session::has('signsuperadmin')){ Session::set('nav', 'viewsservice'); 
$admins = \DB::table('currencytransfer')
->join('currency', 'currencytransfer.ctrf_cur', '=', 'currency.id') ->where([
    ['currencytransfer.ctrf_id', '<>', 0], 
    ['currencytransfer.ctrf_type', '=', 2], ])
    ->orderBy('ctrf_id', 'desc')->get();
return view('superadmin.viewsservice', ['admins' => $admins]);
}	
else{ return redirect('superadmin/sign-in'); }
}




	public function viewsserviceid($id){
if (Session::has('signsuperadmin')){ 
	Session::put('idimg', $id); Session::set('nav', 'viewsservice'); 
 
$admins = \DB::table('currencytransfer')
->join('currency', 'currencytransfer.ctrf_cur', '=', 'currency.id') ->where([
    ['currencytransfer.ctrf_id', '<>', 0], 
    ['currencytransfer.ctrf_type', '=', 2], 
    ['currencytransfer.ctrf_id', '=', $id], ])
    ->orderBy('ctrf_id', 'desc')->get(); 
    
$currencys= \DB::table('currency')  ->where([['cur_active', '<>',  '0'] , ])->orderBy('id', 'asc')->get(); 

return view('superadmin.editservice', ['admins' => $admins , 'currencys' => $currencys  ]); 

}	
else{ return redirect('superadmin/sign-in'); }
}

 

		
	public function viewsserviceidpost($id  , Request $request ){
if (Session::has('signsuperadmin')){ 
 
 
    	$this->validate($request,[
    			'name' => 'required', 
    			'cata' => 'required',  
    			'catam' => 'required|numeric',  
    			'fixfee' => 'required|numeric',  
    			'varbfee' => 'required|numeric',  
    		],[
    			'name.required' => 'لطفا نام سرویس را وارد نمایید', 
    			'cata.required' => 'لطفا کارنسی را وارد نمایید', 
    			'catam.required' => 'لطفا قیمت سرویس را به دلار وارد نمایید', 
    			'catam.numeric' => 'لطفا فرمت قیمت را به صورت صحیح وارد نمایید', 
    			'fixfee.required' => 'لطفا کارمزد ثابت را وارد نمایید', 
    			'fixfee.numeric' => 'لطفا فرمت کارمزد ثابت را به صورت صحیح وارد نمایید', 
    			'varbfee.required' => 'لطفا کارمزد متغیر را وارد نمایید', 
    			'varbfee.numeric' => 'لطفا فرمت کارمزد متغیر را به صورت صحیح وارد نمایید',  
    		]);  
    		 
$admins = \DB::table('currencytransfer')
->join('currency', 'currencytransfer.ctrf_cur', '=', 'currency.id') ->where([
    ['currencytransfer.ctrf_id', '<>', 0], 
    ['currencytransfer.ctrf_type', '=', 2], 
    ['currencytransfer.ctrf_id', '=', $id], ])
    ->orderBy('ctrf_id', 'desc')->first(); 
    
$imageName=$admins->ctrf_img;

 if( $request->hasFile('file')){ 
        $image = $request->file('file');
        $imageName = time().$image->getClientOriginalName();
        $image->move(public_path('images'),$imageName);  
	 
    }

  
$updatee = \DB::table('currencytransfer')->where('ctrf_id', '=', $id)  ->update(['ctrf_name' => $request->name    ,   'ctrf_active' => 0   ,  'ctrf_fixfee' =>  $request->fixfee  ,  'ctrf_varebfee' =>  $request->varbfee ,  'ctrf_cur' =>  $request->cata ,  'ctrf_pay' =>  $request->catam  ,  'ctrf_img' =>  $imageName  ]); 

$nametr = Session::flash('statust', 'سرویس باموفقیت ویرایش شد.');
		  	$nametrt = Session::flash('sessurl', 'viewsservice/'.$id.'');	
	 
return view('superadmin.success');  
}	else{ return redirect('superadmin/sign-in'); }
}
	



		
	public function accserviceid($id){
		if (Session::has('signsuperadmin')){  
$updatee = \DB::table('currencytransfer')->where('ctrf_id', '=', $id)  ->update(['ctrf_active' => 1   ]);  
		  	$nametr = Session::flash('statust', 'سرویس باموفقیت فعال شد .');
		  	$nametrt = Session::flash('sessurl', 'viewsservice/'.$id.'');		 
	return view('superadmin.success'); 
} else{ return redirect('superadmin/sign-in'); }
				}
		


		
	public function rejserviceid($id){
		if (Session::has('signsuperadmin')){  
$updatee = \DB::table('currencytransfer')->where('ctrf_id', '=', $id)  ->update(['ctrf_active' => 0   ]);  
		  	$nametr = Session::flash('statust', 'سرویس باموفقیت غیرفعال شد .');
		  	$nametrt = Session::flash('sessurl', 'viewsservice/'.$id.'');		 
	return view('superadmin.success'); 
} else{ return redirect('superadmin/sign-in'); }
				}
		


	public function delserviceid($id){
		if (Session::has('signsuperadmin')){  
		  	$admins = \DB::table('currencytransfer')->where('ctrf_id', '=', $id)->delete(); 
		  	$nametr = Session::flash('statust', 'سرویس باموفقیت حذف شد.');
		  	$nametrt = Session::flash('sessurl', 'viewsservice');
		  	
	return view('superadmin.success', ['admins' => $admins]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}
		


		
	public function manageindex(){
if (Session::has('signsuperadmin')){ 
	Session::set('nav', 'manageindex'); 
 $admin = \DB::table('mngindex') ->where('id', '=', '1')  ->orderBy('id', 'desc')->first();
 return view('superadmin.manageindex', ['admin' => $admin]); 
 }	
else{ return redirect('superadmin/sign-in'); }
				}


	public function manageindexpost( Request $request ){
if (Session::has('signsuperadmin')){ 



$updatee = \DB::table('mngindex')->where('id', '=', '1')  ->update([ 'ind_hregus' => $request->ind_hregus , 'ind_hlogus' => $request->ind_hlogus , 'ind_hfaq' => $request->ind_hfaq ,   'ind_hpage' => $request->ind_hpage ,   'ind_hnew' => $request->ind_hnew  ,    'ind_freg' => $request->ind_freg ,'ind_flog' => $request->ind_flog , 'ind_fnew' => $request->ind_fnew ,   'ind_fpage' => $request->ind_fpage  ,    'ind_ffaq' => $request->ind_ffaq  ,   'ind_createdatdate' =>  date('Y-m-d H:i:s')  ]); 
 

			 $nametr = Session::flash('statust', ' مدیریت صفحه اصلی با موفقیت ویرایش شد .');
		  	$nametrt = Session::flash('sessurl', 'manageindex');		  	

 return view('superadmin.success');

}	
else{ return redirect('superadmin/sign-in'); }
				}
		





	public function mngindexedit(){
if (Session::has('signsuperadmin')){ 
	Session::set('nav', 'mngindexedit'); 
$admins = \DB::table('mngindex') ->where('id', '=', '1')->orderBy('id', 'desc')->get();
return view('superadmin.mngindexedit', ['admins' => $admins]); }	
else{ return redirect('superadmin/sign-in'); }
}
 




	public function mngindexeditpost(Request $request){
if (Session::has('signsuperadmin')){ 
	
    	$this->validate($request,[
    			'tit' => 'required|min:4|max:999',
    			'cont' => 'required|min:1|max:999',
    			'key' => 'required', 
    			'fcopy' => 'required|min:1|max:999',  
    		],[
    			'tit.required' => 'لطفا عنوان سایت را وارد نمایید',
    			'tit.min' => 'عنوان وارد شده کوتاه است',
    			'tit.max' => 'عنوان وارد شده طولانی است',
    			'cont.required' => 'لطفا توضیحات سایت را وارد نمایید',
    			'cont.min' => 'توضیحات سایت کوتاه است',
    			'cont.max' => 'توضیحات طولانی است',
    			'key.required' => 'لطفا کلمات کلیدی را وارد نمایید', 
    			'fcopy.required' => 'متن زیر فوتر را وارد نمایید',
    			'fcopy.min' => 'متن زیر فوتر کوتاه است',
    			'fcopy.max' => 'متن زیر فوتر طولانی است',  
    			
    		]);




$admins = \DB::table('mngindex') ->where('id', '=', '1')->orderBy('id', 'desc')->first();

$imageName=$admins->ind_himglog;

 if( $request->hasFile('file')){ 
        $image = $request->file('file');
        $imageName = time().$image->getClientOriginalName();
        $image->move(public_path('images'),$imageName);  
	 
    }
    


$imageNamemini=$admins->ind_himglogmini;

 if( $request->hasFile('filemini')){ 
        $image = $request->file('filemini');
        $imageNamemini = time().$image->getClientOriginalName();
        $image->move(public_path('images'),$imageNamemini);  
	 
    }
 
    
$updatee = \DB::table('mngindex')->where('id', '=', '1')  ->update(['ind_ftitile' => $request->tit ,'ind_key' => $request->key ,'ind_cont' => $request->cont      , 'ind_fcopy' => $request->fcopy   , 'ind_createdatdate' =>  date('Y-m-d H:i:s') ,'ind_himglog' => $imageName   ,'ind_himglogmini' => $imageNamemini     ]); 	

$mngindexs = \DB::table('mngindex') ->where('id', '=', '1')->orderBy('id', 'desc')->first();
Session::set('ind_himglog', $mngindexs->ind_himglog);

			 $nametr = Session::flash('statust', ' جزییات صفحه اصلی با موفقیت ویرایش شد .');
		  	$nametrt = Session::flash('sessurl', 'mngindexedit');		  	

 return view('superadmin.success');

}	else{ return redirect('superadmin/sign-in'); }
}
 





public function viewsonlineshops(){
if (Session::has('signsuperadmin')){ 

 Session::set('nav', 'viewsonlineshops'); 

  

$h = new SuperadminController();
$h->viewalertnot();


$admins  = \DB::table('myrequest')
->join('user', 'myrequest.req_userid', '=', 'user.id')  ->where([
    ['user.id', '<>',  0],  ])
    ->orderBy('req_id', 'desc')->get(); 
        
    
return view('sup.viewsonlineshops', ['admins' => $admins]);

 }	
else{ return redirect('superadmin/sign-in'); }
				}




	
	
public function viewsonlineshopsid($id  , $req_id){
if (Session::has('signsuperadmin')){ 
 
	
$typ='13';
$link=$id;
$req=$req_id;
$h = new SuperadminController();
$h->showupdatealert($typ,$link,$req); 
 

 Session::set('nav', 'viewsonlineshops'); 
  
$myrequest  = \DB::table('myrequest')
->join('user', 'myrequest.req_userid', '=', 'user.id')  ->where([
    ['user.id', '<>',  0], 
    ['myrequest.req_rndform', '=',  $id],   
    ['myrequest.req_id', '=',  $req_id],  ])
    ->orderBy('req_id', 'desc')->first(); 


$form = \DB::table('form')  
->where([ 
    ['form.form_rnd', '=', $id], ])
    ->orderBy('form.form_id', 'asc')->first();
    
$admins = \DB::table('form') 
->join('list', 'form.form_rnd', '=', 'list.list_rnd')  
->where([
    ['list.list_aro', '=', 0], 
    ['form.form_rnd', '=', $id], ])
    ->orderBy('list.list_chk', 'asc')->get();
    
    
$lists = \DB::table('form') 
->join('list', 'form.form_rnd', '=', 'list.list_rnd') 
->join('myrequest', 'list.list_myreqid', '=', 'myrequest.req_id')  
->where([ 
    ['form.form_rnd', '=', $id],  
    ['myrequest.req_id', '=',  $req_id], 
    ['list.list_userid', '<>', 0], ])
    ->orderBy('list.list_chk', 'asc')->get();
    
    
$reqs = \DB::table('form') 
->join('list', 'form.form_rnd', '=', 'list.list_rnd') 
->join('myrequest', 'list.list_myreqid', '=', 'myrequest.req_id')  
->where([ 
    ['form.form_rnd', '=', $id],  
    ['myrequest.req_id', '=',  $req_id], 
    ['list.list_userid', '<>', 0], ])
    ->orderBy('list.list_id', 'asc')->first();
    

    
$formselects=0;
$formchecks=0;
$reqchecks=0;
    
 foreach($admins as $admin){
 if($admin->list_typ=='8'){
	

$formselects = \DB::table('formselect') 
->join('list', 'formselect.formselect_id', '=', 'list.list_name')
->join('myrequest', 'list.list_myreqid', '=', 'myrequest.req_id')  
->where([
    ['list.list_aro', '=', 1],
    ['list.list_typ', '=', 8],
    ['myrequest.req_id', '=',  $req_id],  
    ['formselect.formselect_rnd', '=', $id], ])
    ->orderBy('formselect.formselect_id', 'asc')->get();
    
    
 }
 
 
 
    
 if($admin->list_typ=='9'){
	
$formchecks = \DB::table('formcheckbox') 
->join('list', 'formcheckbox.formcheckbox_formilistd', '=', 'list.list_id')
->join('form', 'list.list_rnd', '=', 'form.form_rnd')  
->join('myrequest', 'list.list_myreqid', '=', 'myrequest.req_id')  
->where([
    ['list.list_aro', '=', 1], 
    ['list.list_typ', '=', 9],
    ['myrequest.req_id', '=',  $req_id],  
    ['form.form_rnd', '=', $id], ])
    ->orderBy('formcheckbox.formcheckbox_id', 'asc')->get();
    
    
 
$reqchecks = \DB::table('reqcheck') 
->join('formcheckbox', 'reqcheck.rchk_formchkid', '=', 'formcheckbox.formcheckbox_id')
->join('myrequest', 'reqcheck.rchk_reqid', '=', 'myrequest.req_id') 
->join('list', 'reqcheck.rchk_listid', '=', 'list.list_id')
->where([ 
    ['list.list_aro', '=', 1], 
    ['myrequest.req_id', '=',  $req_id],  
    ['reqcheck.rchk_rndform', '=', $id], ])
    ->orderBy('formcheckbox.formcheckbox_id', 'asc')->get();
    
     
}
  }
    

$typ='11';
$link=$id;
$req=$req_id;
$h = new SuperadminController();
$h->showupdatealert($typ,$link,$req);
    
 
return view('sup.onlineshopsid', ['admins' => $admins ,'form' => $form ,'myrequest' => $myrequest ,'lists' => $lists ,'reqs' => $reqs  ,'formselects' => $formselects  ,'formchecks' => $formchecks   ,'reqchecks' => $reqchecks ]);        
     
 }	
else{ return redirect('superadmin/sign-in'); }
				}






	public function addsocial(){
if (Session::has('signsuperadmin')){ 
	Session::set('nav', 'addsocial'); 
	return view('superadmin.addsocial');}	
else{ return redirect('superadmin/sign-in'); }
				}
				
				
				

public function addsocialpost(Request $request){
if (Session::has('signsuperadmin')){    	    	
    	$this->validate($request,[
    	    	'link' => 'required', 
    		],[
    			'link.required' => 'لطفا لینک شبکه اجتماعی را وارد نمایید', 
    			
    		]);   
 
 
 if( $request->hasFile('file')){ 
        $image = $request->file('file');
        $imageName = time().$image->getClientOriginalName();
        $image->move(public_path('images'),$imageName);  
	 
    } else { $imageName=''; }

    		
 
 DB::table('social')->insert([
    ['social_name' => $request->link ,    'social_icon' => $imageName   ]
]);   	
 
 
$nametr = Session::flash('statust', ' شبکه اجتماعی باموفقیت ثبت شد.');
$nametrt = Session::flash('sessurl', 'mngsocial');
		  return view('superadmin.success'); 	    	 }	
else{ return redirect('superadmin/sign-in'); }    	  
}
	



	
	public function mngsocial(){
if (Session::has('signsuperadmin')){ 
	Session::set('nav', 'mngsocial'); 
$admins = \DB::table('social') ->orderBy('social_id', 'desc')->get();
return view('superadmin.mngsocial', ['admins' => $admins]);
}	
else{ return redirect('superadmin/sign-in'); }
}



	
	public function editsocial($id){
if (Session::has('signsuperadmin')){ 
	Session::set('nav', 'mngsocial'); 
	Session::put('idimg', $id);
$admins = \DB::table('social')->where('social_id', '=', $id)  ->orderBy('social_id', 'desc')->get();
return view('superadmin.editsocial', ['admins' => $admins]); }	
else{ return redirect('superadmin/sign-in'); }
}





	public function editsocialpost($id  , Request $request ){
if (Session::has('signsuperadmin')){ 
    	$this->validate($request,[
    	    	'link' => 'required', 
    		],[
    			'link.required' => 'لطفا لینک شبکه اجتماعی را وارد نمایید', 
    			
    		]);   
 
 
    		
$admins = \DB::table('social')->where('social_id', '=', $id)  ->orderBy('social_id', 'desc')->first();
  
  $imageName=$admins->social_icon;  
  
  
 if( $request->hasFile('file')){ 
        $image = $request->file('file');
        $imageName = time().$image->getClientOriginalName();
        $image->move(public_path('images'),$imageName);  
	 
    }
		
    		  
$updatee = \DB::table('social')->where('social_id', '=', $id)  ->update(['social_name' => $request->link    , 'social_icon' => $imageName     ]); 
$admins = \DB::table('social')->where('social_id', '=', $id)  ->orderBy('social_id', 'desc')->get();
$nametr = Session::flash('statust', 'شبکه اجتماعی با موفقیت ویرایش شد.');
$nametrt = Session::flash('sessurl', 'mngsocial/editsocial/'.$id.'');
return view('superadmin.success');
}	else{ return redirect('superadmin/sign-in'); }
}





		
	public function accsocial($id){
		if (Session::has('signsuperadmin')){ 	
	Session::set('nav', 'mngsocial'); 			
$updatee = \DB::table('social')->where('social_id', '=', $id)  ->update(['social_active' => 1   ]); 
		  	$admins = \ DB::table('social')->where('social_id', $id)->get();				
		  	$nametr = Session::flash('statust', 'شبکه اجتماعی با موفقیت فعال شد.');
		  	$nametrt = Session::flash('sessurl', 'mngsocial/editsocial/'.$id.'');		  	
	return view('superadmin.success', ['admins' => $admins]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}
				
		
		
	public function rejsocial($id){
		if (Session::has('signsuperadmin')){ 	
	Session::set('nav', 'mngsocial'); 			
$updatee = \DB::table('social')->where('social_id', '=', $id)  ->update(['social_active' => 0   ]); 
		  	$admins = \ DB::table('social')->where('social_id', $id)->get();				
		  	$nametr = Session::flash('statust', 'شبکه اجتماعی باموفقیت غیرفعال شد.');
		  	$nametrt = Session::flash('sessurl', 'mngsocial/editsocial/'.$id.'');		  	
	return view('superadmin.success', ['admins' => $admins]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}
				


	
	public function deletsocial($id){
		if (Session::has('signsuperadmin')){ 
	Session::set('nav', 'mngsocial'); 
		  	$admins = \DB::table('social')->where('social_id', '=', $id)->delete(); 

		  	$nametr = Session::flash('statust', 'حذف شبکه اجتماعی با موفقیت انجام شد.');
		  	$nametrt = Session::flash('sessurl', 'mngsocial');
		  	
	return view('superadmin.success', ['admins' => $admins]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}				
		











	public function addpage(){
if (Session::has('signsuperadmin')){ 
	Session::set('nav', 'addpage'); 
	return view('superadmin.addpage');}	
else{ return redirect('superadmin/sign-in'); }
				}


public function addpagepost(Request $request){
if (Session::has('signsuperadmin')){    	    	
    	$this->validate($request,[
    	    	'tit' => 'required|min:3|unique:page,page_tit,$request->tit',
    			'kh' => 'required|min:3',
    			'des' => 'required|min:5',
    		],[
    			'tit.required' => 'لطفا عنوان خدمات را وارد نمایید',
    			'tit.min' => 'عنوان خدمات کوتاه است',
    			'tit.unique' => 'این خدمات قبلا ثبت شده است',
    			'kh.required' => 'لطفا خلاصه خدمات را وارد نمایید',
    			'kh.min' => 'خلاصه خدمات کوتاه است',
    			'des.required' => 'لطفا توضیحات خدمات را بصورت صحیح وارد نمایید',
    			'des.min' => 'توضیحات خدمات کوتاه است',
    			
    		]);   
 
 
 if( $request->hasFile('file')){ 
        $image = $request->file('file');
        $imageName = time().$image->getClientOriginalName();
        $image->move(public_path('images'),$imageName);  
	 
    } else { $imageName=''; }

    		
 
 DB::table('page')->insert([
    ['page_kh' => $request->kh , 'page_tit' => $request->tit , 'page_des' => $request->des ,   'page_createdatdate' =>  date('Y-m-d H:i:s')  ,  'page_active' => 0    ,   'page_img' => $imageName   ]
]);   	
 
 
$nametr = Session::flash('statust', 'خدمات با موفقیت ثبت شد.');
$nametrt = Session::flash('sessurl', 'viewspages');
		  return view('superadmin.success'); 	    	 }	
else{ return redirect('superadmin/sign-in'); }    	  
}
	

	

	
	public function viewspages(){
if (Session::has('signsuperadmin')){ 
	Session::set('nav', 'viewspages'); 
$admins = \DB::table('page') ->orderBy('id', 'desc')->get();
return view('superadmin.viewspages', ['admins' => $admins]);
}	
else{ return redirect('superadmin/sign-in'); }
}






	public function editpage($id){
if (Session::has('signsuperadmin')){ 
	Session::set('nav', 'viewspages'); 
	Session::put('idimg', $id);
$admins = \DB::table('page')->where('id', '=', $id)  ->orderBy('id', 'desc')->get();
return view('superadmin.editpage', ['admins' => $admins]); }	
else{ return redirect('superadmin/sign-in'); }
}



	public function editpagepost($id  , Request $request ){
if (Session::has('signsuperadmin')){ 
    	$this->validate($request,[
    	    	'tit' => 'required|min:3',
    			'kh' => 'required|min:3',
    			'des' => 'required|min:5',
    		],[
    			'tit.required' => 'لطفا عنوان خدمات را وارد نمایید',
    			'tit.min' => 'عنوان خدمات کوتاه است', 
    			'kh.required' => 'لطفا خلاصه خدمات را وارد نمایید',
    			'kh.min' => 'خلاصه خدمات کوتاه است',
    			'des.required' => 'لطفا توضیحات خدمات را بصورت صحیح وارد نمایید',
    			'des.min' => 'توضیحات خدمات کوتاه است',
    			
    		]);   
 
    		
$admins = \DB::table('page')->where('id', '=', $id)  ->orderBy('id', 'desc')->first();
  
  $imageName=$admins->page_img;  
  
  
 if( $request->hasFile('file')){ 
        $image = $request->file('file');
        $imageName = time().$image->getClientOriginalName();
        $image->move(public_path('images'),$imageName);  
	 
    }
		
    		  
$updatee = \DB::table('page')->where('id', '=', $id)  ->update(['page_kh' => $request->kh  , 'page_tit' => $request->tit , 'page_des' => $request->des  , 'page_img' => $imageName     ]); 
$admins = \DB::table('page')->where('id', '=', $id)  ->orderBy('id', 'desc')->get();
$nametr = Session::flash('statust', 'خدمات با موفقیت ویرایش شد.');
$nametrt = Session::flash('sessurl', 'viewspages/editpage/'.$id.'');
return view('superadmin.success');
}	else{ return redirect('superadmin/sign-in'); }
}




		
	public function accpage($id){
		if (Session::has('signsuperadmin')){ 	
	Session::set('nav', 'viewspages'); 			
$updatee = \DB::table('page')->where('id', '=', $id)  ->update(['page_active' => 1   ]); 
		  	$admins = \ DB::table('page')->where('id', $id)->get();				
		  	$nametr = Session::flash('statust', 'خدمات با موفقیت فعال شد.');
		  	$nametrt = Session::flash('sessurl', 'viewspages/editpage/'.$id.'');		  	
	return view('superadmin.success', ['admins' => $admins]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}
				
		
		
	public function rejpage($id){
		if (Session::has('signsuperadmin')){ 	
	Session::set('nav', 'viewspages'); 			
$updatee = \DB::table('page')->where('id', '=', $id)  ->update(['page_active' => 0   ]); 
		  	$admins = \ DB::table('page')->where('id', $id)->get();				
		  	$nametr = Session::flash('statust', 'خدمات باموفقیت غیرفعال شد.');
		  	$nametrt = Session::flash('sessurl', 'viewspages/editpage/'.$id.'');		  	
	return view('superadmin.success', ['admins' => $admins]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}
				


	
	public function deletpage($id){
		if (Session::has('signsuperadmin')){ 
	Session::set('nav', 'viewspages'); 
		  	$admins = \DB::table('page')->where('id', '=', $id)->delete(); 

		  	$nametr = Session::flash('statust', 'حذف خدمات با موفقیت انجام شد.');
		  	$nametrt = Session::flash('sessurl', 'viewspages');
		  	
	return view('superadmin.success', ['admins' => $admins]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}				
		



	
				public function deletcalendar($id){
					if (Session::has('signsuperadmin')){ 
				Session::set('nav', 'viewspages'); 
						  $admins = \DB::table('calendarrezerv')->where('cal_id', '=', $id)->delete(); 
			
						  $nametr = Session::flash('statust', 'حذف رزرو با موفقیت انجام شد.');
						  $nametrt = Session::flash('sessurl', 'settingrezerv');
						   return redirect('superadmin/settingrezerv'); 
				}	
			else{ return redirect('superadmin/sign-in'); }
							}				
					
			
	
	public function setting_getwaypayment(){
		if (Session::has('signsuperadmin')){ 
			
			Session::set('nav', 'setting_login'); 
			
 $admins = DB::table('setting')->where('id' , 1)->orderBy('id', 'desc')->orderBy('id', 'desc')->first();	
			return view('sup.setting_getwaypayment', ['admins' => $admins]);


	}	 else{ return redirect('superadmin/sign-in'); }
				}				
		

	public function setting_getwaypaymentpost( Request $request ){
		if (Session::has('signsuperadmin')){ 
		 
		 $updatee = \DB::table('setting')->where('id', '=', 1)  ->update(['getway_payment' => $request->getway_payment  ]); 	
				   
		$nametr = Session::flash('statust', ' تنظیمات درگاه پرداخت باموفقیت ویرایش شد.');
		$nametrt = Session::flash('sessurl', 'setting_getwaypayment');
		return redirect('superadmin/setting_getwaypayment'); 
		}	else{ return redirect('superadmin/sign-in'); }
		}
				
			
	
	public function setting_login(){
		if (Session::has('signsuperadmin')){ 
			
			Session::set('nav', 'setting_login'); 
			
 $admins = DB::table('setting')->where('id' , 1)->orderBy('id', 'desc')->orderBy('id', 'desc')->first();	
			return view('sup.setting-login', ['admins' => $admins]);


	}	 else{ return redirect('superadmin/sign-in'); }
				}				
		



				
	public function setting_loginpost( Request $request ){
		if (Session::has('signsuperadmin')){ 
		 
		 $updatee = \DB::table('setting')->where('id', '=', 1)  ->update(['login' => $request->login  ]); 	
				   
		$nametr = Session::flash('statust', ' تنظیمات لاگین باموفقیت ویرایش شد.');
		$nametrt = Session::flash('sessurl', 'setting_login');
		return redirect('superadmin/setting_login'); 
		}	else{ return redirect('superadmin/sign-in'); }
		}
				
			

	

	

	public function dateyearmonth($year,$month){
if (Session::has('signsuperadmin')){ 
	Session::set('nav', 'settingrezerv');
	
	// if($year!=1399){ $year=1399; }



 if(($year==1399)&&($month>4)) { $year=1399; $month=$month; }
 if(($year==1400)&&($month<10)){ $year=1400; $month=$month; }
	
	
	
 if(($year==1400)&&($month==10)){ $year=1400; $month=1; }
	
	/*
	 if($month < '12'){ $month=$month; } 
	 if(($month>'11')||($month<'4')){ $month=6; }
	 
	 */
	
	Session::set('year', $year);
	Session::set('month', $month); 

 return redirect('superadmin/settingrezerv'); 
 
	}	 else{ return redirect('superadmin/sign-in'); }
				}







	public function settingrezerveditid($id){
if (Session::has('signsuperadmin')){ 
	Session::set('nav', 'settingrezerv');  

$month = DB::table('month')->where([
    ['month_id', '<>', 0], 
    ['month_month', '=', Session::get('month')],
    ['month_year', '=', Session::get('year')], ])
    ->orderBy('month_id', 'desc')->first(); 
    
    
$calendarrezervs = DB::table('calendarrezerv')->where([
    ['cal_id', '<>', 0], 
    ['cal_id', '=', $id], 
    ['cal_month', '=', Session::get('month')],
    ['cal_year', '=', Session::get('year')], ])
    ->orderBy('cal_id', 'desc')->first(); 
    
 $todayshamsi=  \DB::table('dateshamsi')  ->where([ ['id', '=',  1],   ])->orderBy('id', 'desc')->first(); 
	    
	return view('sup.editsettingrezerv', ['month' => $month , 'todayshamsi' => $todayshamsi , 'calendarrezervs' => $calendarrezervs]);
	
	} else{ return redirect('superadmin/sign-in'); }
				}



public function settingrezerveditidpost(Request $request , $id){
if (Session::has('signsuperadmin')){    	    	
    	$this->validate($request,[
    	    	'cal_pes' => 'required', 
    		],[
    			'cal_pes.required' => 'لطفا ظرفیت را وارد نمایید', 
    			
    		]);   


    		  
$updatee = \DB::table('calendarrezerv')->where('cal_id', '=', $id)  ->update(['cal_pes' => $request->cal_pes ]); 

$nametr = Session::flash('statust', 'ظرفیت تاریخ مورد نظر باموفقیت ویرایش شد.');
$nametrt = Session::flash('sessurl', 'settingrezerv');
		 return redirect('superadmin/settingrezerv'); 	    	 }	
else{ return redirect('superadmin/sign-in'); }    	  
}
	





	public function addnew(){
if (Session::has('signsuperadmin')){ 
	Session::set('nav', 'addnew'); 
	return view('superadmin.addnew');}	
else{ return redirect('superadmin/sign-in'); }
				}


	




	public function settingrezerv(){
if (Session::has('signsuperadmin')){ 
	Session::set('nav', 'settingrezerv');  

$month = DB::table('month')->where([
    ['month_id', '<>', 0], 
    ['month_month', '=', Session::get('month')],
    ['month_year', '=', Session::get('year')], ])
    ->orderBy('month_id', 'desc')->first(); 
    
    
$calendarrezervs = DB::table('calendarrezerv')->where([
    ['cal_id', '<>', 0], 
    ['cal_month', '=', Session::get('month')],
    ['cal_year', '=', Session::get('year')], ])
    ->orderBy('cal_id', 'desc')->get(); 
    
 $todayshamsi=  \DB::table('dateshamsi')  ->where([ ['id', '=',  1],   ])->orderBy('id', 'desc')->first(); 
	    
	return view('sup.settingrezerv', ['month' => $month , 'todayshamsi' => $todayshamsi , 'calendarrezervs' => $calendarrezervs]);
	
	} else{ return redirect('superadmin/sign-in'); }
				}


	public function setrezerv(){
if (Session::has('signsuperadmin')){ 
	Session::set('nav', 'settingrezerv');  
 
    
 $todayshamsi=  \DB::table('dateshamsi')  ->where([ ['id', '=',  1],   ])->orderBy('id', 'desc')->first(); 
 
 
	Session::set('year', $todayshamsi->year);
	Session::set('month', $todayshamsi->month); 

 return redirect('superadmin/settingrezerv'); 
	    
	return view('sup.settingrezerv', ['month' => $month , 'todayshamsi' => $todayshamsi]);
	
	} else{ return redirect('superadmin/sign-in'); }
				}
				
				
				
public function settingrezervpost(Request $request){
if (Session::has('signsuperadmin')){  



 DB::table('calendarrezerv')->insert([
    ['cal_year' => $request->year , 'cal_month' => $request->month , 'cal_day' => $request->day ,   'cal_createdatdate' =>  date('Y-m-d H:i:s')  ,  'cal_hours' => $request->time  ,  'cal_pes' => $request->pes   ]
]);   	
 
 

$nametr = Session::flash('statust', 'رزرو جدید باموفقیت ایجاد شد.');
$nametrt = Session::flash('sessurl', 'settingrezerv');
		 return redirect('superadmin/settingrezerv'); 	    	 }	
else{ return redirect('superadmin/sign-in'); }    	  
}
	
 
 

public function addnewpost(Request $request){
if (Session::has('signsuperadmin')){    	    	
    	$this->validate($request,[
    	    	'tit' => 'required|min:3|unique:news,new_tit,$request->tit',
    			'kh' => 'required|min:3',
    			'des' => 'required|min:5',
    		],[
    			'tit.required' => 'لطفا عنوان خبر را وارد نمایید',
    			'tit.min' => 'عنوان خبر کوتاه است',
    			'tit.unique' => 'این خبر قبلا ثبت شده است',
    			'kh.required' => 'لطفا خلاصه خبر را وارد نمایید',
    			'kh.min' => 'خلاصه خبر کوتاه است',
    			'des.required' => 'لطفا متن خبر را بصورت صحیح وارد نمایید',
    			'des.min' => 'متن خبر کوتاه است',
    			
    		]);   
 
 
 if( $request->hasFile('file')){ 
        $image = $request->file('file');
        $imageName = time().$image->getClientOriginalName();
        $image->move(public_path('images'),$imageName);  
	 
    } else { $imageName=''; }

    		
 
 DB::table('news')->insert([
    ['new_kh' => $request->kh , 'new_tit' => $request->tit , 'new_des' => $request->des ,   'new_createdatdate' =>  date('Y-m-d H:i:s')  ,  'new_active' => 0    ,   'new_img' => $imageName   ]
]);   	
 


	

$nametr = Session::flash('statust', 'خبر با موفقیت ثبت شد.');
$nametrt = Session::flash('sessurl', 'viewsnews');
		  return view('superadmin.success'); 	    	 }	
else{ return redirect('superadmin/sign-in'); }    	  
}
	

	
	public function viewsnews(){
if (Session::has('signsuperadmin')){ 
	Session::set('nav', 'viewsnews'); 
$admins = \DB::table('news') ->orderBy('id', 'desc')->get();
return view('superadmin.viewsnews', ['admins' => $admins]);
}	
else{ return redirect('superadmin/sign-in'); }
}



	public function editnew($id){
if (Session::has('signsuperadmin')){ 
	Session::set('nav', 'viewsnews'); 
	Session::put('idimg', $id);
$admins = \DB::table('news')->where('id', '=', $id)  ->orderBy('id', 'desc')->get();
return view('superadmin.editnew', ['admins' => $admins]); }	
else{ return redirect('superadmin/sign-in'); }
}


	public function editnewpost($id  , Request $request ){
if (Session::has('signsuperadmin')){ 
    	$this->validate($request,[
    	    	'tit' => 'required|min:3',
    			'kh' => 'required|min:3',
    			'des' => 'required|min:5',
    		],[
    			'tit.required' => 'لطفا عنوان خبر را وارد نمایید',
    			'tit.min' => 'عنوان خبر کوتاه است',
    			'kh.required' => 'لطفا خلاصه خبر را وارد نمایید',
    			'kh.min' => 'خلاصه خبر کوتاه است',
    			'des.required' => 'لطفا متن خبر را بصورت صحیح وارد نمایید',
    			'des.min' => 'متن خبر کوتاه است',
    			
    		]);     
    		
    		
$admins = \DB::table('news')->where('id', '=', $id)  ->orderBy('id', 'desc')->first();
  
  $imageName=$admins->new_img;  
  
  
 if( $request->hasFile('file')){ 
        $image = $request->file('file');
        $imageName = time().$image->getClientOriginalName();
        $image->move(public_path('images'),$imageName);  
	 
    }
		
    		  
$updatee = \DB::table('news')->where('id', '=', $id)  ->update(['new_kh' => $request->kh  , 'new_tit' => $request->tit , 'new_des' => $request->des  , 'new_img' => $imageName     ]); 
$admins = \DB::table('news')->where('id', '=', $id)  ->orderBy('id', 'desc')->get();
$nametr = Session::flash('statust', 'خبر با موفقیت ویرایش شد.');
$nametrt = Session::flash('sessurl', 'viewsnews/editnew/'.$id.'');
return view('superadmin.success');
}	else{ return redirect('superadmin/sign-in'); }
}



		
	public function accnew($id){
		if (Session::has('signsuperadmin')){ 	
	Session::set('nav', 'viewsnews'); 			
$updatee = \DB::table('news')->where('id', '=', $id)  ->update(['new_active' => 1   ]); 
		  	$admins = \ DB::table('news')->where('id', $id)->get();				
		  	$nametr = Session::flash('statust', 'خبر با موفقیت فعال شد.');
		  	$nametrt = Session::flash('sessurl', 'viewsnews/editnew/'.$id.'');		  	
	return view('superadmin.success', ['admins' => $admins]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}
				
		
		
	public function rejnew($id){
		if (Session::has('signsuperadmin')){ 	
	Session::set('nav', 'viewsnews'); 			
$updatee = \DB::table('news')->where('id', '=', $id)  ->update(['new_active' => 0   ]); 
		  	$admins = \ DB::table('news')->where('id', $id)->get();				
		  	$nametr = Session::flash('statust', 'خبر باموفقیت غیرفعال شد.');
		  	$nametrt = Session::flash('sessurl', 'viewsnews/editnew/'.$id.'');		  	
	return view('superadmin.success', ['admins' => $admins]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}
				


	
	public function deletnew($id){
		if (Session::has('signsuperadmin')){ 
	Session::set('nav', 'viewsnews'); 
		  	$admins = \DB::table('news')->where('id', '=', $id)->delete(); 

		  	$nametr = Session::flash('statust', 'حذف خبر با موفقیت انجام شد.');
		  	$nametrt = Session::flash('sessurl', 'viewsnews');
		  	
	return view('superadmin.success', ['admins' => $admins]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}				
		




		
	public function finicals(){
if (Session::has('signsuperadmin')){ 

 Session::set('nav', 'finicalsmng'); 
  
$admins  = \DB::table('currencytransfer')
->join('currency', 'currencytransfer.ctrf_cur', '=', 'currency.id') 
->join('productcurtrans', 'currencytransfer.ctrf_id', '=', 'productcurtrans.prcrtr_idcrtrf')
->join('user', 'productcurtrans.prcrtr_iduser', '=', 'user.id') ->where([ 
    ['currencytransfer.ctrf_id', '<>', 0],   ])
    ->orderBy('prcrtr_id', 'desc')->get(); 
        
    
return view('superadmin.finicals', ['admins' => $admins]);
 }	
else{ return redirect('superadmin/sign-in'); }
				}







public function fechpost($id){  

$currencys= \DB::table('currency')  ->where([['cur_active', '<>',  '0'] , ['id', '=',  $id] , ])->orderBy('id', 'asc')->get();

foreach($currencys as $currency){ 

echo '<div class="form-group">
 <label class="col-sm-3 control-label">قیمت سرویس به '.$currency->cur_name.' </label>
<div class="col-sm-9"> <input type="text" class="form-control"   placeholder="قیمت سرویس به  '.$currency->cur_name.' "   name="catam" id="catam" value=""></div>
</div>  <div class="line-dashed"></div>';  
	
}	
 }


public function fechcurpost($id){  

$currencys= \DB::table('currency')  ->where([['cur_active', '<>',  '0'] , ['id', '=',  $id] , ])->orderBy('id', 'asc')->get();

foreach($currencys as $currency){ 

echo ' '.$currency->cur_name.' ';  
	
}	
 }






	public function success(){
if (Session::has('signsuperadmin')){ return view('superadmin.success');}	
else{ return redirect('superadmin/sign-in'); }
				}
	



		 
 
 
 
 }