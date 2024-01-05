<?php

namespace App\Http\Controllers\Servicepay;

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

class ServicepayController extends Controller
{

			
 
		
	public function aaa(){

 return view('superadmin/sign-in');
 
				}
		

			
 
		
	public function iranipayindex(){


$mngindex=  DB::table('mngindex')  ->where('id' , '=' , 1)->orderBy('id')->first();  

$news=\DB::table('news')  ->where('new_active' , '=' , 1)->limit(5)->orderBy('id' , 'desc')->get(); 
$pages=\DB::table('page')  ->where('page_active' , '=' , 1) ->orderBy('id' , 'desc')->get(); 
$socials=\DB::table('social')  ->where('social_active' , '=' , 1) ->orderBy('social_id' , 'desc')->get(); 


return view('iranipay.index', [ 'mngindex' => $mngindex ,  'news' => $news  ,  'pages' => $pages ,  'socials' => $socials  ]);
 
 
				}
		

		
	public function serviceid($id){


$mngindex=  DB::table('mngindex')  ->where('id' , '=' , 1)->orderBy('id')->first();  

$news=\DB::table('news')  ->where('new_active' , '=' , 1)->limit(5)->orderBy('id' , 'desc')->get(); 
$pages=\DB::table('page')  ->where('page_active' , '=' , 1) ->orderBy('id' , 'desc')->get(); 
$socials=\DB::table('social')  ->where('social_active' , '=' , 1) ->orderBy('social_id' , 'desc')->get(); 
 
$service=\DB::table('page') ->where([
    ['id', '=', $id], 
    ['page_active', '=', 1], ])
    ->orderBy('id', 'desc')->first(); 
 
return view('iranipay.service', [ 'mngindex' => $mngindex ,  'news' => $news  ,  'pages' => $pages ,  'socials' => $socials ,  'service' => $service  ]);
  
				}
		

		
	public function newid($id){


$mngindex=  DB::table('mngindex')  ->where('id' , '=' , 1)->orderBy('id')->first();  

$news=\DB::table('news')  ->where('new_active' , '=' , 1)->limit(5)->orderBy('id' , 'desc')->get(); 
$pages=\DB::table('page')  ->where('page_active' , '=' , 1) ->orderBy('id' , 'desc')->get(); 
$socials=\DB::table('social')  ->where('social_active' , '=' , 1) ->orderBy('social_id' , 'desc')->get(); 
 
$service=\DB::table('news') ->where([
    ['id', '=', $id], 
    ['new_active', '=', 1], ])
    ->orderBy('id', 'desc')->first(); 
 
return view('iranipay.new', [ 'mngindex' => $mngindex ,  'news' => $news  ,  'pages' => $pages ,  'socials' => $socials ,  'service' => $service  ]);
  
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
	$updatee = \DB::table('superadmins')->where('id', '=', Session::get('idsuperadmin'))  ->update(['superadmin_logindate' => date('Y-m-d H:i:s') ,    'superadmin_ip' => $request->ip()  ]); 
	
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

		

	public function myprofile(){
if (Session::has('signsuperadmin')){ 

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

			 $nametr = Session::flash('statust', 'اطلاعات من با موفقیت ویرایش شد.');
		  	$nametrt = Session::flash('sessurl', 'myprofile/edit/sup');


$admins = \DB::table('superadmins')->where('id', '=',  Session::get('idsuperadmin'))  ->orderBy('id', 'desc')->first();


	
$user = \DB::table('superadmins')->where('id', '=', Session::get('idsuperadmin'))  ->orderBy('id', 'desc')->first();
 $usernamee = $user->superadmin_username; 
 $titmes='اطلاعات شما با موفقیت تغییر کرد';
 $mestt='نام کاربری جدید';
 $mesnot = $usernamee; 
  Mail::send('superadmin.mail', ['user' => $user , 'usernamee' => $usernamee, 'mesnot' => $mesnot, 'titmes' => $titmes , 'mestt' => $mestt], function ($m) use ($user) {      
$decryptedPassword =  Crypt::decrypt($user->superadmin_userpassword);
            $m->from('info@kargo.biz', 'تغییر نام کاربری');
            $m->to($user->superadmin_email, $user->superadmin_email)->subject('ویرایش اطلاعات');
        }); 	  	
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

 	if ( $user->superadmin_email != '')  {
 	 $usernamee = $user->superadmin_username; 
 $titmes='رمز شما با موفقیت تغییر کرد';
 $mestt='رمزجدید';
 $mesnot = Crypt::decrypt($user->superadmin_password); 
   Mail::send('superadmin.mail', ['user' => $user , 'usernamee' => $usernamee, 'mesnot' => $mesnot, 'titmes' => $titmes , 'mestt' => $mestt], function ($m) use ($user) {       
$decryptedPassword =  Crypt::decrypt($user->superadmin_password);
            $m->from('info@kargo.biz', 'رمز جدید');
            $m->to($user->superadmin_email, $user->superadmin_email)->subject('امنیت اطلاعات');
        }); 	
 } 
 
 	if ( $user->superadmin_tell != '')  {
 		
 $admins =  \DB::table('superadmins')->where('id', '=', Session::get('idsuperadmin'))  ->orderBy('id', 'desc')->first();
$panelsms = \DB::table('panelsms')->where('id', '=',  1)  ->orderBy('id', 'desc')->first();
include(app_path().'/../sms/api_send_sms.php');
$message='با عرض سلام. رمز شما با موفقیت تغییر کرد . رمز جدید : '.$decryptedPassword.' ';
$result = Send_SMS($panelsms->sms_username, $panelsms->sms_password, $panelsms->sms_fromnumber, $admins->superadmin_tell, $message , 0, false) ; 		
 		
 		} 
 		
 
 

        
        
        
          return view('superadmin.success');

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



public function panelshop(){
if (Session::has('signsuperadmin')){ 


	Session::set('flagpanel', '2');



return view('superadmin/panelshop'  ); 

 

}	
else{ return redirect('superadmin/sign-in'); }
}


			
public function panel(){
if (Session::has('signsuperadmin')){ 


	Session::set('flagpanel', '1');

$tickread = DB::table('professors') 
->join('ticket', 'professors.id', '=', 'ticket.tik_fromid')->where([
    ['tik_fromarou', '=', 3],
    ['tik_toarou', '=', 2],
    ['tik_tosh', '=', 1],
    ['tik_toread', '=', 0],])
    ->orderBy('ticket.id', 'desc')->count();
	Session::set('tickreadprofessorsup', $tickread);   
	
$tickread = DB::table('user') 
->join('ticket', 'user.id', '=', 'ticket.tik_fromid')->where([
    ['tik_fromarou', '=', 4],
    ['tik_toarou', '=', 2],
    ['tik_tosh', '=', 1],
    ['tik_toread', '=', 0],])
    ->orderBy('ticket.id', 'desc')->count();
	Session::set('tickreadstudentsup', $tickread); 


$admins =  DB::table('admins')->where([['id', '<>',  '0'],])->count();
$professors =  DB::table('professors')->where([['id', '<>',  '0'],])->count();
$students =  DB::table('students')->where([['id', '<>',  '0'],])->count();

 

$page =  DB::table('page')->where([['id', '<>',  '0'],])->count();
$news =  DB::table('news')->where([['id', '<>',  '0'],])->count();
$question =  DB::table('question')->where([['id', '<>',  '0'],])->count();
$groupstudent =  DB::table('groupstudent')->where([['id', '<>',  '0'],])->count();

$tikprf = DB::table('ticket')->where([['tik_fromarou', '=',  '3'],['tik_toarou', '=',  '2'],])->count();
$tikstu = DB::table('ticket')->where([['tik_fromarou', '=',  '4'],['tik_toarou', '=',  '2'],])->count();
$elnprf = DB::table('ticket')->where([['tik_fromarou', '=',  '1'],['tik_toarou', '=',  '3'],])->count();
$elnstu = DB::table('ticket')->where([['tik_fromarou', '=',  '1'],['tik_toarou', '=',  '4'],])->count();

 


$finical = \DB::table('user') 
->join('marsole', 'user.user_ncode', '=', 'marsole.mar_codmoshtari')  
->join('finicals', 'marsole.id', '=', 'finicals.finical_marid')  
->where([  
    ['finicals.finical_arou', '=', '4'] , ])
    ->orderBy('finicals.id', 'desc')->count();


return view('superadmin/panel' , ['admins' => $admins , 'professors' => $professors, 'students' => $students  ,  'page' => $page , 'news' => $news , 'question' => $question , 'groupstudent' => $groupstudent  , 'tikprf' => $tikprf  , 'tikstu' => $tikstu  , 'elnprf' => $elnprf  , 'elnstu' => $elnstu  , 'finical' => $finical  ]); 

 

}	
else{ return redirect('superadmin/sign-in'); }
}
		
		
	public function table(){
if (Session::has('signsuperadmin')){ return view('superadmin.table');}	
else{ return redirect('superadmin/sign-in'); }
}
	
		
	public function success(){
if (Session::has('signsuperadmin')){ return view('superadmin.success');}	
else{ return redirect('superadmin/sign-in'); }
				}
	
		
	public function addadmin(){
		if (Session::has('signsuperadmin')){
 return view('superadmin.addadmin');}	
else{ return redirect('superadmin/sign-in'); }
 
				}
		

	public function editadmins($id){
if (Session::has('signsuperadmin')){ 
	Session::put('idimg', $id);
$admins = \DB::table('admins')->where('id', '=', $id)  ->orderBy('id', 'desc')->get();
return view('superadmin.edit', ['admins' => $admins]); }	
else{ return redirect('superadmin/sign-in'); }
				}


		
		
	public function editadminsPost($id  , Request $request ){
if (Session::has('signsuperadmin')){ 
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


$user = \DB::table('admins')->where('id', '=', $id)  ->orderBy('id', 'desc')->first();

 		if ( $request->email ==  $user->admin_email   ){  $activeemail =  $user->admin_emailactive ; }
 else   if ( $request->email !=  $user->admin_email   ){  $activeemail ='0';}

 		if ( $request->tell ==  $user->admin_tell   ){  $activetell =  $user->admin_tellactive ; }
 else   if ( $request->tell !=  $user->admin_tell   ){  $activetell ='0';}
 
 
$updatee = \DB::table('admins')->where('id', '=', $id)  ->update(['admin_name' => $request->name ,  'admin_tell' => $request->tell ,  'admin_email' => $request->email ,  'admin_adres' => $request->adres,  'admin_emailactive' => $activeemail ,  'admin_tellactive' => $activetell ]); 

$user = \DB::table('admins')->where('id', '=', $id)  ->orderBy('id', 'desc')->first();
if ( ($user->admin_emailactive == 1) &&  ($user->admin_tellactive == 1)   ){  $active=1;}
if ( ($user->admin_emailactive == 0) ||  ($user->admin_tellactive == 0)   ){  $active=0;}
$updatee = \DB::table('admins')->where('id', '=', $id)  ->update(['admin_active' => $active   ]);

$admins = \DB::table('admins')->where('id', '=', $id)  ->orderBy('id', 'desc')->get();
$nametr = Session::flash('statust', 'ویرایش اطلاعات مدیر با موفقیت انجام شد.');
$nametrt = Session::flash('sessurl', 'viewsadmins/edit/'.$id.'');
return view('superadmin.success');
}	else{ return redirect('superadmin/sign-in'); }
}
		
		
		
	public function viewsadmins(){
		if (Session::has('signsuperadmin')){ 
$admins = \DB::table('admins') ->orderBy('id', 'desc')->get();
return view('superadmin.viewsadmins', ['admins' => $admins]);
}	else{ return redirect('superadmin/sign-in'); }
}



public function addadminPost(Request $request)
    {
if (Session::has('signsuperadmin')){    	
    	
    	$this->validate($request,[
    			'username' => 'required|min:5|max:35|unique:admins,admin_username,$request->username',
    			'userpassword' => 'required|min:5|max:35|confirmed'
    		],[
    			'username.required' => 'لطفا نام کاربری را وارد نمایید',
    			'username.min' => 'نام کاربری شما باید بیشتر از 5 کاراکتر باشد',
    			'username.max' => 'یوزرنیم شما باید کمتر از 35 کارکتر باشد',
    			'username.unique' => 'این نام کاربری قبللا در سیستم ثبت شده است',
    			'userpassword.required' => 'لطفا رمز ورود را وارد نمایید',
    			'userpassword.min' => ' رمز کوتاه است',
    			'userpassword.max' => ' رمزعبور طولانی است ',
    			'userpassword.confirmed' => 'رمزعبور با تکرار آن مطابقت ندارد ',
    		]);
    		 
$encryptedPassword = \Crypt::encrypt($request->userpassword);
$decryptedPassword = \Crypt::decrypt($encryptedPassword);
		
DB::table('admins')->insert([
    ['admin_username' => $request->username , 'admin_password' => $encryptedPassword ,   'admin_createdatdate' =>  date('Y-m-d H:i:s') , 'admin_active' => 0]
]);

$users = DB::table('admins')->where('admin_username', $request->username)->first();
$userscou = DB::table('admins')->where('admin_username', $request->username)->count();

$id_db= $users->id; 
$password_db= $users->admin_password; 

DB::table('accessadmins')->insert([
    ['accessadmin_idadmin' => $id_db , 'accessadmin_elanat' => 1 , 'accessadmin_ticket' => 1     ]
]);
			 $nametr = Session::flash('statust', 'ثبت نام مدیر با موفقیت انجام شد.');
		  	$nametrt = Session::flash('sessurl', 'viewsadmins');
		  return view('superadmin.success');
 
    	 	 dd($users->admin_username);
    
  }	
else{ return redirect('superadmin/sign-in'); }    
    	
    }
	
	
	
	
	
	
		
		
	public function deletadmin($id){
		if (Session::has('signsuperadmin')){ 
		  	$admins = \ DB::table('admins')->where('id', $id)->get();
		  	$admins = \DB::table('admins')->where('id', '=', $id)->delete();
		  	$admins = \DB::table('accessadmins')->where('accessadmin_idadmin', '=', $id)->delete();
		  	$nametr = Session::flash('statust', 'حذف مدیر با موفقیت انجام شد.');
		  	$nametrt = Session::flash('sessurl', 'viewsadmins');
		  	
	return view('superadmin.success', ['admins' => $admins]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}
		
	
	
		
		
	public function accadmin($id){
		if (Session::has('signsuperadmin')){ 
		

$adminacc =  DB::table('admins')->where('id', '=', $id) ->orderBy('id', 'desc')->first();
					
$updatee = \DB::table('admins')->where('id', '=', $id)  ->update(['admin_active' => 1   ]); 
		  	$admins = \ DB::table('admins')->where('id', $id)->get();				
		  	$nametr = Session::flash('statust', 'اکانت مدیر با موفقیت فعال شد.');
		  	$nametrt = Session::flash('sessurl', 'viewsadmins/edit/'.$id.'');
		  	
		  	$user = \DB::table('admins')->where('id', '=', $id)  ->orderBy('id', 'desc')->first();
$superadminselanats =  DB::table('superadminselanats')  ->orderBy('id', 'desc')->first();
 if($superadminselanats->supelan_emailaccadmin == '1'){
 	if ( $adminacc->admin_email != '')  {
 $usernamee = $user->admin_username; 
 $titmes='اکانت شما با موفقیت فعال شد';
 $mestt='رمز شما';
 $mesnot = Crypt::decrypt($user->admin_password); 
   Mail::send('superadmin.mail', ['user' => $user , 'usernamee' => $usernamee, 'mesnot' => $mesnot, 'titmes' => $titmes , 'mestt' => $mestt], function ($m) use ($user) {
        
$decryptedPassword =  Crypt::decrypt($user->admin_password);

            $m->from('info@kargo.biz', 'فعالسازی اکانت');

            $m->to($user->admin_email, $user->admin_email)->subject('فعالسازی اکانت');
        }); 	
 }	 }	
 
 	
 if($superadminselanats->supelan_smsaccadmin == '1'){	
   
$admins = \DB::table('admins')->where('id', '=',  $id)  ->orderBy('id', 'desc')->first();
$panelsms = \DB::table('panelsms')->where('id', '=',  1)  ->orderBy('id', 'desc')->first();
include(app_path().'/../sms/api_send_sms.php');
$message='با عرض سلام '.$admins->admin_name.' عزیز.     اکانت شما با موفقیت فعال شد';
if (($result = Send_SMS($panelsms->sms_username, $panelsms->sms_password, $panelsms->sms_fromnumber, $admins->admin_tell, $message , 0, false)) === '0')
{ 
		
	return view('superadmin.success');
} else if ($result !== '') {   
		
	return view('superadmin.success');
 }


 }
 
 
 		  	
	return view('superadmin.success');
	 	
 } else{ return redirect('superadmin/sign-in'); }
				}
		
		
		
		
		
		
		
		
		
	public function rejadmin($id){
		if (Session::has('signsuperadmin')){ 				
$updatee = \DB::table('admins')->where('id', '=', $id)  ->update(['admin_active' => 0   ]); 
		  	$admins = \ DB::table('admins')->where('id', $id)->get();				
		  	$nametr = Session::flash('statust', 'اکانت مدیر با موفقیت غیرفعال شد.');
		  	$nametrt = Session::flash('sessurl', 'viewsadmins/edit/'.$id.'');		  	
	return view('superadmin.success', ['admins' => $admins]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}



	public function accessadmin($id){
if (Session::has('signsuperadmin')){ 
	Session::put('idimg', $id);
$admins = \DB::table('accessadmins')->where('accessadmin_idadmin', '=', $id)  ->orderBy('id', 'desc')->get();
$acadmins = \DB::table('admins')->where('id', '=', $id)  ->orderBy('id', 'desc')->get();
return view('superadmin.accessadmin', ['admins' => $admins , 'acadmins' => $acadmins]); }	
else{ return redirect('superadmin/sign-in'); }
				}




		
	public function accessadminpost( $id , Request $request ){
if (Session::has('signsuperadmin')){ 
$updatee = \DB::table('accessadmins')->where('accessadmin_idadmin', '=',$id)  ->update([ 'accessadmin_ticket' => $request->accessadmin_ticket   ,'accessadmin_elanat' => $request->accessadmin_elanat   , 'accessadmin_mahsol'=> $request->accessadmin_mahsol   ]); 
 

			 $nametr = Session::flash('statust', 'سطح دسترسی با موفقیت ویرایش شد.');
		  	$nametrt = Session::flash('sessurl', 'viewsadmins/edit/accessadmin/'.$id.'');		  	

 return view('superadmin.success');

}	
else{ return redirect('superadmin/sign-in'); }
				}
		




	public function accessadmingroupmahsol($id){
if (Session::has('signsuperadmin')){ 

 
$accessgroupscount = \DB::table('accessgroup')->where([
    ['acc_adminid', '=', $id], 
    ['acc_arou', '=', 0], ])
    ->orderBy('acc_id', 'desc')->count();
$groupcatscount = \DB::table('groupcat')->where('group_id', '<>', 0)  ->orderBy('group_id', 'desc')->count();


$accessgroups = \DB::table('accessgroup')->where([
    ['acc_adminid', '=', $id], 
    ['acc_arou', '=', 0], ])
    ->orderBy('acc_id', 'desc')->get();
$groupcats = \DB::table('groupcat')->where('group_id', '<>', 0)  ->orderBy('group_id', 'desc')->get();
 

if($accessgroupscount=='0'){
foreach($groupcats as $groupcat){  
DB::table('accessgroup')->insert([
    ['acc_adminid' => $id , 'acc_grid' => $groupcat->group_id , 'acc_arou' => 0  ]
]);  
}	
} 

if($accessgroupscount==$groupcatscount){ }


if($accessgroupscount!=$groupcatscount){  
foreach($groupcats as $groupcat){   
$accoun = \DB::table('accessgroup')->where([
    ['accessgroup.acc_adminid', '=', $id],
    ['accessgroup.acc_grid', '=', $groupcat->group_id], 
    ['acc_arou', '=', 0],  ])
    ->orderBy('acc_id', 'desc')->count(); 
if($accoun==0){
	\DB::table('accessgroup')->insert([
    ['acc_adminid' => $id , 'acc_grid' => $groupcat->group_id , 'acc_arou' => 0  ]
]);  
} 
}	 
}



$accessgroup = \DB::table('accessgroup') 
->join('groupcat', 'accessgroup.acc_grid', '=', 'groupcat.group_id')  
->where([
    ['accessgroup.acc_adminid', '=', $id], 
    ['acc_arou', '=', 0], 
    ['groupcat.group_active', '=', 1],  ])
    ->orderBy('groupcat.group_catid', 'asc')->get();


 
$admins = \DB::table('accessadmins')->where('accessadmin_idadmin', '=', $id)  ->orderBy('id', 'desc')->get();
$acadmins = \DB::table('admins')->where('id', '=', $id)  ->orderBy('id', 'desc')->get();
return view('superadmin.accessadmingroupmahsol', ['admins' => $admins , 'acadmins' => $acadmins , 'accessgroup'=> $accessgroup]);
 

 }	
else{ return redirect('superadmin/sign-in'); }
				}

		





		
	public function accessadmingroupmahsolpost($id , Request $request ){
if (Session::has('signsuperadmin')){ 



$accessgroup = \DB::table('accessgroup') 
->join('groupcat', 'accessgroup.acc_grid', '=', 'groupcat.group_id')  
->where([
    ['accessgroup.acc_adminid', '=', $id],  
    ['acc_arou', '=', 0], ])
    ->orderBy('groupcat.group_catid', 'asc')->get();
    
  foreach($accessgroup as $accessgro){ 
  	 $namefeild='a'.$accessgro->group_id; 
  	
  	
$bcodee = explode("a",$namefeild); $coname=$bcodee['1'];  
if($accessgro->group_id==$coname){
	 
  	 
$updatee = \DB::table('accessgroup')->where([
    ['accessgroup.acc_adminid', '=', $id],
    ['accessgroup.acc_grid', '=', $coname], 
    ['acc_arou', '=', 0],  ])
    ->update(['acc_flg' => $request->$namefeild   ]); 
  	
} 

 
  }  
			 $nametr = Session::flash('statust', 'دسترسی به گروه محصولات برای مدیر با موفقیت ویرایش شد.');
		  	$nametrt = Session::flash('sessurl', 'viewsadmins/edit/accessadmin/'.$id.'/groupmahsol');	


    
          return view('superadmin.success');

 }	
else{ return redirect('superadmin/sign-in'); }
				}










public function dropzoneStoreadm(Request $request)
    {
        $image = $request->file('file');
        $imageName = time().$image->getClientOriginalName();
        $image->move(public_path('images'),$imageName);        
$updatee = \DB::table('admins')->where('id', '=', Session::get('idimg'))  ->update(['admin_img' => $imageName   ]); 
        return response()->json(['success'=>$imageName]);
    }
		
	
	
	
		
		
	public function securityyadmin( Request $request ){
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

$updatee = \DB::table('admins')->where('id', '=', Session::get('idimg'))  ->update(['admin_password' => $encryptedPassword   ]); 

$admins = \DB::table('admins')->where('id', '=',  Session::get('idimg'))  ->orderBy('id', 'desc')->first();

			 $nametr = Session::flash('statust', 'رمز شما با موفقیت تغییر کرد.');
		  	$nametrt = Session::flash('sessurl', 'viewsadmins/edit/'. Session::get('idimg').'');	






	  	
$user = \DB::table('admins')->where('id', '=', Session::get('idimg'))  ->orderBy('id', 'desc')->first();

$superadminselanats =  DB::table('superadminselanats')  ->orderBy('id', 'desc')->first(); 

 if($superadminselanats->supelan_emailadmin == '1'){
 	if ( $user->admin_email != '')  {
 	 $usernamee = $user->admin_username; 
 $titmes='رمز شما با موفقیت تغییر کرد';
 $mestt='رمزجدید';
 $mesnot = Crypt::decrypt($user->admin_password); 
   Mail::send('superadmin.mail', ['user' => $user , 'usernamee' => $usernamee, 'mesnot' => $mesnot, 'titmes' => $titmes , 'mestt' => $mestt], function ($m) use ($user) {       
$decryptedPassword =  Crypt::decrypt($user->admin_password);
            $m->from('info@kargo.biz', 'رمز جدید');
            $m->to($user->admin_email, $user->admin_email)->subject('امنیت اطلاعات');
        }); 	
 } }
 
 
 if($superadminselanats->supelan_smsadmin == '1'){
 	if ( $user->admin_tell != '')  {
 		
 $admins =  \DB::table('admins')->where('id', '=', Session::get('idimg'))  ->orderBy('id', 'desc')->first();
$panelsms = \DB::table('panelsms')->where('id', '=',  1)  ->orderBy('id', 'desc')->first();
include(app_path().'/../sms/api_send_sms.php');
$message='با عرض سلام '.$admins->admin_name.' عزیز. رمز شما با موفقیت تغییر کرد . رمز جدید : '.$decryptedPassword.' ';
$result = Send_SMS($panelsms->sms_username, $panelsms->sms_password, $panelsms->sms_fromnumber, $admins->admin_tell, $message , 0, false) ; 		
 		
 		} }
 
 




          return view('superadmin.success');


}	
else{ return redirect('superadmin/sign-in'); }
				}
		










		
	public function addprofessor(){
if (Session::has('signsuperadmin')){ return view('superadmin.addprofessor');}	
else{ return redirect('superadmin/sign-in'); }
				}
			




public function addprofessorPost(Request $request){
if (Session::has('signsuperadmin')){    	    	
    	$this->validate($request,[
    			'username' => 'required|min:5|max:35|unique:professors,professor_username,$request->username',
    			'userpassword' => 'required|min:5|max:35|confirmed'
    		],[
    			'username.required' => 'لطفا نام کاربری را وارد نمایید',
    			'username.min' => 'نام کاربری شما باید بیشتر از 5 کاراکتر باشد',
    			'username.max' => 'یوزرنیم شما باید کمتر از 35 کارکتر باشد',
    			'username.unique' => 'این نام کاربری قبللا در سیستم ثبت شده است',
    			'userpassword.required' => 'لطفا رمز ورود را وارد نمایید',
    			'userpassword.min' => ' رمز کوتاه است',
    			'userpassword.max' => ' رمزعبور طولانی است ',
    			'userpassword.confirmed' => 'رمزعبور با تکرار آن مطابقت ندارد ',
    		]);   		 
$encryptedPassword = \Crypt::encrypt($request->userpassword);
$decryptedPassword = \Crypt::decrypt($encryptedPassword);
DB::table('professors')->insert([
    ['professor_username' => $request->username , 'professor_password' => $encryptedPassword ,   'professor_createdatdate' =>  date('Y-m-d H:i:s') , 'professor_active' => 0]
]); 
$users = DB::table('professors')->where('professor_username', $request->username)->first();
$userscou = DB::table('professors')->where('professor_username', $request->username)->count();
$id_db= $users->id; 
$password_db= $users->professor_password; 
			 $nametr = Session::flash('statust', 'ثبت نام استاد با موفقیت انجام شد.');
		  	$nametrt = Session::flash('sessurl', 'viewsprofessors');
		  return view('superadmin.success');
    	 	 dd($users->professor_username);
 }	
else{ return redirect('superadmin/sign-in'); }    	  
}
	
	
	
	
		
	public function viewsprofessors(){
if (Session::has('signsuperadmin')){ 
$admins = \DB::table('professors') ->orderBy('id', 'desc')->get();
return view('superadmin.viewsprofessors', ['admins' => $admins]);
}	
else{ return redirect('superadmin/sign-in'); }
}


		
	public function deletprofessor($id){
		if (Session::has('signsuperadmin')){ 
		  	$admins = \ DB::table('professors')->where('id', $id)->get();
		  	$admins = \DB::table('professors')->where('id', '=', $id)->delete();		  	
$updatee = \DB::table('clas')->where('clas_professor', '=', $id)  ->update(['clas_professor' => 0   ]);
		  	$nametr = Session::flash('statust', 'حذف استاد با موفقیت انجام شد.');
		  	$nametrt = Session::flash('sessurl', 'viewsprofessors');
		  	
	return view('superadmin.success', ['admins' => $admins]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}
		

			

	public function editprofessors($id){
if (Session::has('signsuperadmin')){ 
	Session::put('idimg', $id);
$admins = \DB::table('professors')->where('id', '=', $id)  ->orderBy('id', 'desc')->get();
return view('superadmin.editprofessor', ['admins' => $admins]);
}	
else{ return redirect('superadmin/sign-in'); }
				}



		
		
	public function accprofessor($id){
		if (Session::has('signsuperadmin')){ 
		
			
$adminacc =  DB::table('professors')->where('id', '=', $id) ->orderBy('id', 'desc')->first();	
 	
$updatee = \DB::table('professors')->where('id', '=', $id)  ->update(['professor_active' => 1   ]); 
		  	$admins = \ DB::table('professors')->where('id', $id)->get();				
		  	$nametr = Session::flash('statust', 'اکانت استاد با موفقیت فعال شد.');
		  	$nametrt = Session::flash('sessurl', 'viewsprofessors/editprofessor/'.$id.'');	
		  	
		  			  	
		  	$user = \DB::table('professors')->where('id', '=', $id)  ->orderBy('id', 'desc')->first();
$superadminselanats =  DB::table('superadminselanats')  ->orderBy('id', 'desc')->first();
 if($superadminselanats->supelan_emailaccprofessor == '1'){
 	if ( $adminacc->professor_email != '')  {
 		
 $usernamee = $user->professor_username; 
 $titmes='اکانت شما با موفقیت فعال شد';
 $mestt='رمز شما';
 $mesnot = Crypt::decrypt($user->professor_password); 
   Mail::send('superadmin.mail', ['user' => $user , 'usernamee' => $usernamee, 'mesnot' => $mesnot, 'titmes' => $titmes , 'mestt' => $mestt], function ($m) use ($user) {
        
$decryptedPassword =  Crypt::decrypt($user->professor_password);

            $m->from('info@kargo.biz', 'فعالسازی اکانت');

            $m->to($user->professor_email, $user->professor_email)->subject('فعالسازی اکانت');
        }); 	
 }	 }	
 
 	
 if($superadminselanats->supelan_smsaccprofessor == '1'){	
   
$admins = \DB::table('professors')->where('id', '=',  $id)  ->orderBy('id', 'desc')->first();
$panelsms = \DB::table('panelsms')->where('id', '=',  1)  ->orderBy('id', 'desc')->first();
include(app_path().'/../sms/api_send_sms.php');
$message='با عرض سلام '.$admins->professor_name.' عزیز.     اکانت شما با موفقیت فعال شد';
if (($result = Send_SMS($panelsms->sms_username, $panelsms->sms_password, $panelsms->sms_fromnumber, $admins->professor_tell, $message , 0, false)) === '0')
{ 
		
	return view('superadmin.success');
} else if ($result !== '') {   
		
	return view('superadmin.success');
 }


 }
 
 
 		  	
	return view('superadmin.success');
 
}   else{ return redirect('superadmin/sign-in'); }
				}
		
		
	public function rejprofessor($id){
		if (Session::has('signsuperadmin')){ 				
$updatee = \DB::table('professors')->where('id', '=', $id)  ->update(['professor_active' => 0   ]); 
		  	$admins = \ DB::table('admins')->where('id', $id)->get();				
		  	$nametr = Session::flash('statust', 'اکانت استاد با موفقیت غیرفعال شد.');
		  	$nametrt = Session::flash('sessurl', 'viewsprofessors/editprofessor/'.$id.'');		  	
	return view('superadmin.success', ['admins' => $admins]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}
			


		
		
	public function editprofessorsPost($id  , Request $request ){
if (Session::has('signsuperadmin')){ 

 
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
    		

$user = \DB::table('professors')->where('id', '=', $id)  ->orderBy('id', 'desc')->first();

 		if ( $request->email ==  $user->professor_email   ){  $activeemail =  $user->professor_emailactive ; }
 else   if ( $request->email !=  $user->professor_email   ){  $activeemail ='0';}

 		if ( $request->tell ==  $user->professor_tell   ){  $activetell =  $user->professor_tellactive ; }
 else   if ( $request->tell !=  $user->professor_tell   ){  $activetell ='0';}
 
  
$updatee = \DB::table('professors')->where('id', '=', $id)  ->update(['professor_name' => $request->name ,  'professor_tell' => $request->tell ,  'professor_email' => $request->email ,  'professor_adres' => $request->adres ,  'professor_emailactive' => $activeemail ,  'professor_tellactive' => $activetell ]); 

$user = \DB::table('professors')->where('id', '=', $id)  ->orderBy('id', 'desc')->first();
if ( ($user->professor_emailactive == 1) &&  ($user->professor_tellactive == 1)   ){  $active=1;}
if ( ($user->professor_emailactive == 0) ||  ($user->professor_tellactive == 0)   ){  $active=0;}
$updatee = \DB::table('professors')->where('id', '=', $id)  ->update(['professor_active' => $active   ]);

$admins = \DB::table('professors')->where('id', '=', $id)  ->orderBy('id', 'desc')->get();

			 $nametr = Session::flash('statust', 'ویرایش اطلاعات استاد با موفقیت انجام شد.');
		  	$nametrt = Session::flash('sessurl', 'viewsprofessors/editprofessor/'.$id.'');
		 return view('superadmin.success');
 
}	
else{ return redirect('superadmin/sign-in'); }
				}
		
				


public function dropzoneprofessorStored(Request $request)
    {
        $image = $request->file('file');
        $imageName = time().$image->getClientOriginalName();
        $image->move(public_path('images'),$imageName);        
$updatee = \DB::table('professors')->where('id', '=', Session::get('idimg'))  ->update(['professor_img' => $imageName   ]); 
        return response()->json(['success'=>$imageName]);
    }	
	



		
		
	public function securityyprofessor( Request $request ){
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

$updatee = \DB::table('professors')->where('id', '=', Session::get('idimg'))  ->update(['professor_password' => $encryptedPassword   ]); 

$admins = \DB::table('professors')->where('id', '=',  Session::get('idimg'))  ->orderBy('id', 'desc')->first();

			 $nametr = Session::flash('statust', 'رمز شما با موفقیت تغییر کرد.');
		  	$nametrt = Session::flash('sessurl', 'viewsprofessors/editprofessor/'. Session::get('idimg').'');	


	  	
$user = \DB::table('professors')->where('id', '=', Session::get('idimg'))  ->orderBy('id', 'desc')->first();

$superadminselanats =  DB::table('superadminselanats')  ->orderBy('id', 'desc')->first(); 

 if($superadminselanats->supelan_emailprofessor == '1'){
 	if ( $user->professor_email != '')  {
 	 $usernamee = $user->professor_username; 
 $titmes='رمز شما با موفقیت تغییر کرد';
 $mestt='رمزجدید';
 $mesnot = Crypt::decrypt($user->professor_password); 
   Mail::send('superadmin.mail', ['user' => $user , 'usernamee' => $usernamee, 'mesnot' => $mesnot, 'titmes' => $titmes , 'mestt' => $mestt], function ($m) use ($user) {       
$decryptedPassword =  Crypt::decrypt($user->professor_password);
            $m->from('info@kargo.biz', 'رمز جدید');
            $m->to($user->professor_email, $user->professor_email)->subject('امنیت اطلاعات');
        }); 	
 } }
 
 
 if($superadminselanats->supelan_smsprofessor == '1'){
 	if ( $user->professor_tell != '')  {
 		
 $admins =  \DB::table('professors')->where('id', '=', Session::get('idimg'))  ->orderBy('id', 'desc')->first();
$panelsms = \DB::table('panelsms')->where('id', '=',  1)  ->orderBy('id', 'desc')->first();
include(app_path().'/../sms/api_send_sms.php');
$message='با عرض سلام '.$admins->professor_name.' عزیز. رمز شما با موفقیت تغییر کرد . رمز جدید : '.$decryptedPassword.' ';
$result = Send_SMS($panelsms->sms_username, $panelsms->sms_password, $panelsms->sms_fromnumber, $admins->professor_tell, $message , 0, false) ; 		
 		
 		} }
 
 
		  	


          return view('superadmin.success');


}	
else{ return redirect('superadmin/sign-in'); }
				}
		



		
	public function addmarketersup(){
if (Session::has('signsuperadmin')){ return view('superadmin.addmarketer');}	
else{ return redirect('superadmin/sign-in'); }
				}
			


public function addmarketersupPost(Request $request){
if (Session::has('signsuperadmin')){    	    	
    	$this->validate($request,[
    			'username' => 'required|min:3|unique:marketer,mark_username,$request->username', 
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

 
    		

DB::table('marketer')->insert([
    [ 'mark_password' => $encryptedPassword ,   'mark_createdatdate' =>  date('Y-m-d H:i:s') , 'mark_active' => 0 ,   'mark_username' => $request->username  ,   'mark_apiactive' => $request->userpassword       ]
]);  
    		 

 
			 $nametr = Session::flash('statust', 'ثبت نام بازاریاب با موفقیت انجام شد.');
		  	$nametrt = Session::flash('sessurl', 'viewsmarketers');
		  return view('superadmin.success');
    	 	 dd($users->student_username);
 }	
else{ return redirect('superadmin/sign-in'); }    	  
}
	
	
		
	public function viewsmarketerssup(){
if (Session::has('signsuperadmin')){ 
$admins = \DB::table('marketer') ->orderBy('id', 'desc')->get();
return view('superadmin.viewsmarketers', ['admins' => $admins]);
}	
else{ return redirect('superadmin/sign-in'); }
}





	public function editmarketersup($id){
if (Session::has('signsuperadmin')){ 
	Session::put('idimg', $id);
$admins = \DB::table('marketer')->where('id', '=', $id)  ->orderBy('id', 'desc')->get();



//mycharge 
$charges = \DB::table('marketer') 
->join('charge', 'marketer.id', '=', 'charge.charge_iduser') 
->join('finicals', 'charge.charge_finical', '=', 'finicals.id') 
->where([
    ['charge.charge_arou', '=', 5],
    ['charge.charge_iduser', '=', $id],
    ['finicals.finical_payment', '=', 1],
    ['finicals.finical_inc', '=', 5],])
    ->orderBy('charge.charge_id', 'desc')->get();
$chargepaymy=0;
foreach($charges as $charge){ $chargepaymy=$charge->charge_pay+$chargepaymy; }




 //supcharge  
$charges = \DB::table('marketer') 
->join('charge', 'marketer.id', '=', 'charge.charge_iduser')  
->join('finicals', 'charge.charge_finical', '=', 'finicals.id') 
->where([
    ['charge.charge_arou', '=', 5],
    ['charge.charge_iduser', '=', $id],
    ['finicals.finical_payment', '=', 1],
    ['finicals.finical_inc', '=', 6],])
    ->orderBy('charge.charge_id', 'desc')->get();
$chargepaysup=0;
foreach($charges as $charge){ $chargepaysup=$charge->charge_pay+$chargepaysup; }



 //odat  
$charges = \DB::table('marketer') 
->join('charge', 'marketer.id', '=', 'charge.charge_iduser')  
->join('finicals', 'charge.charge_finical', '=', 'finicals.id') 
->where([
    ['charge.charge_arou', '=', 5],
    ['charge.charge_iduser', '=', $id],
    ['finicals.finical_payment', '=', 1],
    ['finicals.finical_inc', '=', 7],])
    ->orderBy('charge.charge_id', 'desc')->get();
$chargepayodat=0;
foreach($charges as $charge){ $chargepayodat=$charge->charge_pay+$chargepayodat; }



//pardakht 
$charges = \DB::table('marketer') 
->join('charge', 'marketer.id', '=', 'charge.charge_iduser')  
->join('finicals', 'charge.charge_finical', '=', 'finicals.id') 
->where([
    ['charge.charge_arou', '=', 5],
    ['charge.charge_iduser', '=', $id],
    ['finicals.finical_payment', '=', 1],
    ['finicals.finical_inc', '=', 3],])
    ->orderBy('charge.charge_id', 'desc')->get();
$chargepaypar=0;
foreach($charges as $charge){ $chargepaypar=$charge->charge_pay+$chargepaypar; }



 //bisinis  
$charges = \DB::table('marketer') 
->join('charge', 'marketer.id', '=', 'charge.charge_iduser')  
->join('finicals', 'charge.charge_finical', '=', 'finicals.id') 
->where([
    ['charge.charge_arou', '=', 5],
    ['charge.charge_iduser', '=', $id],
    ['finicals.finical_payment', '=', 1],
    ['finicals.finical_inc', '=', 8],])
    ->orderBy('charge.charge_id', 'desc')->get();
$chargepaybisi=0;
foreach($charges as $charge){ $chargepaybisi=$charge->charge_pay+$chargepaybisi; }


//jamkol
$chargepay= ($chargepaysup +  $chargepaymy  + $chargepaybisi ) -  ($chargepaypar + $chargepayodat) ;  

 

$chargeac=$chargepay;





return view('superadmin.editmarketer', ['admins' => $admins ,'chargeac' => $chargeac ]); }	
else{ return redirect('superadmin/sign-in'); }
}


	
	
	

		
	public function editmarketersupPost($id  , Request $request ){
if (Session::has('signsuperadmin')){ 
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

 
 


$user = \DB::table('marketer')->where('id', '=', $id)  ->orderBy('id', 'desc')->first();

 		if ( $request->email ==  $user->mark_email   ){  $activeemail =  $user->mark_emailactive ; }
 else   if ( $request->email !=  $user->mark_email   ){  $activeemail ='0';}

 		if ( $request->tell ==  $user->mark_tell   ){  $activetell =  $user->mark_tellactive ; }
 else   if ( $request->tell !=  $user->mark_tell   ){  $activetell ='0';}
 
  
 
$updatee = \DB::table('marketer')->where('id', '=', $id)  ->update(['mark_name' => $request->name    ,  'mark_tell' => $request->tell ,  'mark_email' => $request->email ,  'mark_adres' => $request->adres ,  'mark_emailactive' => $activeemail ,  'mark_tellactive' => $activetell ]); 

$user = \DB::table('marketer')->where('id', '=', $id)  ->orderBy('id', 'desc')->first();
if ( ($user->mark_emailactive == 1) &&  ($user->mark_tellactive == 1)   ){  $active=1;}
if ( ($user->mark_emailactive == 0) ||  ($user->mark_tellactive == 0)   ){  $active=0;}
$updatee = \DB::table('marketer')->where('id', '=', $id)  ->update(['mark_active' => $active   ]);

$admins = \DB::table('marketer')->where('id', '=', $id)  ->orderBy('id', 'desc')->get();
$nametr = Session::flash('statust', 'ویرایش اطلاعات بازاریاب باموفقیت انجام شد.');
$nametrt = Session::flash('sessurl', 'viewsmarketers/editmarketer/'.$id.''); 
	 
return view('superadmin.success');  
}	else{ return redirect('superadmin/sign-in'); }
}
	

	


public function dropzonestoremarketer(Request $request)
    {
        $image = $request->file('file');
        $imageName = time().$image->getClientOriginalName();
        $image->move(public_path('images'),$imageName);        
$updatee = \DB::table('marketer')->where('id', '=', Session::get('idimg'))  ->update(['mark_img' => $imageName   ]); 
        return response()->json(['success'=>$imageName]);
    }
		




		
	public function securityymarketer(Request $request ){
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
$updatee = \DB::table('marketer')->where('id', '=', Session::get('idimg'))  ->update(['mark_password' => $encryptedPassword   ]); 
$admins = \DB::table('marketer')->where('id', '=',  Session::get('idimg'))  ->orderBy('id', 'desc')->first();
			 $nametr = Session::flash('statust', 'رمز شما با موفقیت تغییر کرد.');
		  	$nametrt = Session::flash('sessurl', 'viewsmarketers/editmarketer/'. Session::get('idimg').'');
	
		  	
$user = \DB::table('marketer')->where('id', '=', Session::get('idimg'))  ->orderBy('id', 'desc')->first();

$superadminselanats =  DB::table('superadminselanats')  ->orderBy('id', 'desc')->first(); 

 if($superadminselanats->supelan_emailstudent == '1'){
 	if ( $user->mark_email != '')  {
 	 $usernamee = $user->mark_username; 
 $titmes='رمز شما با موفقیت تغییر کرد';
 $mestt='رمزجدید';
 $mesnot = Crypt::decrypt($user->mark_password); 
   Mail::send('superadmin.mail', ['user' => $user , 'usernamee' => $usernamee, 'mesnot' => $mesnot, 'titmes' => $titmes , 'mestt' => $mestt], function ($m) use ($user) {       
$decryptedPassword =  Crypt::decrypt($user->mark_password);
            $m->from('info@kargo.biz', 'رمز جدید');
            $m->to($user->mark_email, $user->mark_email)->subject('امنیت اطلاعات');
        }); 	
 } }
 
 
 if($superadminselanats->supelan_smsstudent == '1'){
 	if ( $user->student_tell != '')  {
 		
 $admins =  \DB::table('marketer')->where('id', '=', Session::get('idimg'))  ->orderBy('id', 'desc')->first();
$panelsms = \DB::table('panelsms')->where('id', '=',  1)  ->orderBy('id', 'desc')->first();
include(app_path().'/../sms/api_send_sms.php');
$message='با عرض سلام '.$admins->mark_name.' عزیز. رمز شما با موفقیت تغییر کرد . رمز جدید : '.$decryptedPassword.' ';
$result = Send_SMS($panelsms->sms_username, $panelsms->sms_password, $panelsms->sms_fromnumber, $admins->mark_tell, $message , 0, false) ; 		
 		
 		} }
 
 
	
	
return view('superadmin.success');
}	
else{ return redirect('superadmin/sign-in'); }
				}
		




		
	public function accmarketersup($id){
		if (Session::has('signsuperadmin')){ 
			
$adminacc =  DB::table('marketer')->where('id', '=', $id) ->orderBy('id', 'desc')->first();	
 
						
$updatee = \DB::table('marketer')->where('id', '=', $id)  ->update(['mark_active' => 1   ]); 
		  	$admins = \ DB::table('marketer')->where('id', $id)->get();				
		  	$nametr = Session::flash('statust', 'اکانت بازاریاب با موفقیت فعال شد .');
		  	$nametrt = Session::flash('sessurl', 'viewsmarketers/editmarketer/'.$id.'');			  	
		  			  	
		  	$user = \DB::table('marketer')->where('id', '=', $id)  ->orderBy('id', 'desc')->first();
$superadminselanats =  DB::table('superadminselanats')  ->orderBy('id', 'desc')->first();
 if($superadminselanats->supelan_emailaccstudent == '1'){
 	if ( $adminacc->mark_email != '')  {
	
$usernamee = $user->mark_username; 
 $titmes='اکانت شما با موفقیت فعال شد';
 $mestt='رمز شما';
 $mesnot = Crypt::decrypt($user->mark_password); 
   Mail::send('superadmin.mail', ['user' => $user , 'usernamee' => $usernamee, 'mesnot' => $mesnot, 'titmes' => $titmes , 'mestt' => $mestt], function ($m) use ($user) {
        
$decryptedPassword =  Crypt::decrypt($user->mark_password);

            $m->from('info@kargo.biz', 'فعالسازی اکانت');

            $m->to($user->mark_email, $user->mark_email)->subject('فعالسازی اکانت');
        }); 	
 }		}	  	
	
 if($superadminselanats->supelan_smsaccstudent == '1'){	
   
$admins = \DB::table('marketer')->where('id', '=',  $id)  ->orderBy('id', 'desc')->first();
$panelsms = \DB::table('panelsms')->where('id', '=',  1)  ->orderBy('id', 'desc')->first();
include(app_path().'/../sms/api_send_sms.php');
$message='با عرض سلام '.$admins->mark_name.' عزیز.     اکانت شما با موفقیت فعال شد';
if (($result = Send_SMS($panelsms->sms_username, $panelsms->sms_password, $panelsms->sms_fromnumber, $admins->mark_tell, $message , 0, false)) === '0')
{ 
		
	return view('superadmin.success');
} else if ($result !== '') {   
		
	return view('superadmin.success');
 }


 }
	 
	
	return view('superadmin.success');
		
 
} else{ return redirect('superadmin/sign-in'); }
				}
		





	public function rejmarketersup($id){
		if (Session::has('signsuperadmin')){ 				
$updatee = \DB::table('marketer')->where('id', '=', $id)  ->update(['mark_active' => 0   ]); 
		  	$admins = \ DB::table('marketer')->where('id', $id)->get();				
		  	$nametr = Session::flash('statust', 'اکانت بازاریاب با موفقیت غیرفعال شد.');
		  	$nametrt = Session::flash('sessurl', 'viewsmarketers/editmarketer/'.$id.'');		  	
	return view('superadmin.success', ['admins' => $admins]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}
			




	public function editmarketereditbankPost($id  , Request $request ){
if (Session::has('signsuperadmin')){ 



$lngmenus= \DB::table('language') ->where([['id', '<>',  '0'],['lng_active', '=',  '1'],])->orderBy('id', 'desc')->get();
$lngmenu=\DB::table('language') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first();
 
$this->validate($request,[
    			'mark_shcard' => 'required|min:15|max:26',
    			'mark_shhesab' => 'required',
    			'mark_namebank' => 'required' 
    		],[
    			'mark_shcard.required' => 'شماره کارت'.' ! '.$lngmenu->lng_wnotelq,
    			'mark_shcard.min' => 'شماره کارت'.' ! '.$lngmenu->lng_wshort,
    			'mark_shcard.max' =>'شماره کارت'.' ! '.$lngmenu->lng_wlong,
    			'mark_shhesab.required' => 'شماره حساب'.' ! '.$lngmenu->lng_wnotelq, 
    			'mark_namebank.required' => 'نام بانک'.' ! '.$lngmenu->lng_wnotelq, 
    			
    		]);

 


$user = \DB::table('marketer')->where('id', '=', $id)  ->orderBy('id', 'desc')->first();
$nametr = Session::flash('statust',  'اطلاعات بانکی بازاریاب باموفقیت ویرایش شد');
$nametrt = Session::flash('sessurl', 'viewsmarketers/editmarketer/'.$id.''); 
	 

$updatee = \DB::table('marketer')->where('id', '=', $id)  ->update(['mark_shcard' => $request->mark_shcard   ,  'mark_shhesab' => $request->mark_shhesab ,  'mark_namebank' => $request->mark_namebank ,  'mark_shpaya' => $request->mark_shpaya  ]); 


return view('superadmin.success');  


return view('superadmin.success');  
}	else{ return redirect('superadmin/sign-in'); }
}
	
	
	
	
	
		
	public function deletmarketersup($id){
		if (Session::has('signsuperadmin')){ 
		  	$admins = \ DB::table('marketer')->where('id', $id)->get();
		  	$admins = \DB::table('marketer')->where('id', '=', $id)->delete(); 
		  	$nametr = Session::flash('statust', 'حذف بازاریاب باموفقیت انجام شد.');
		  	$nametrt = Session::flash('sessurl', 'viewsmarketers');
		  	
	return view('superadmin.success', ['admins' => $admins]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}
		







	public function loginmarketersup($id){
if (Session::has('signsuperadmin')){ 
	Session::put('idimg', $id);
$admins = \DB::table('marketer')->where('id', '=', $id)  ->orderBy('id', 'desc')->first();

if($admins){

$password_db= $admins->mark_password; 
$decryptedPassword =  Crypt::decrypt($password_db);
$userscou = DB::table('marketer')->where([
    ['mark_username',  $admins->mark_username],
])->count();
$id_db= $admins->id;
$activeadmin= $admins->mark_active; 
$name_db= $admins->mark_name; 
$username_db= $admins->mark_username; 
$password_db= $admins->mark_password; 
$username_log = $admins->mark_username; 
if(($username_log == $username_db)&&( $decryptedPassword == Crypt::decrypt($password_db))){
	 
	
	Session::set('idmarketer', $id_db);
	Session::set('signnamemarketer', $name_db);
	Session::set('signusermarketer', $username_db);
	Session::set('activemarketer', $activeadmin);
	Session::set('idlang', '3');
	

$adminslp = \DB::table('marketer')->where('id', '=', $id_db)  ->orderBy('id', 'desc')->first();
$logindatepas=$adminslp->mark_loginatdate;	

$admimg=$adminslp->mark_img;
if(empty($admimg)){$admimg='user2x.png';}	 
	
	
	Session::set('logindatepasmarketer', $logindatepas);
	Session::set('marketerimg', $admimg);
	
	$updatee = \DB::table('marketer')->where('id', '=', Session::get('idmarketer'))  ->update(['mark_loginatdate' => date('Y-m-d H:i:s')    ]); 
			return redirect('marketer/panel'); 
		} else 
			 $nametr = Session::flash('statust',  $lngmenu->lng_werrornot);
				return redirect('marketer/sign-in'); 	
			
}


 
 
}	
else{ return redirect('superadmin/sign-in'); }
}









	public function viewschargemarketer(){
if (Session::has('signsuperadmin')){

  

$chargesas = \DB::table('marketer') 
->join('charge', 'marketer.id', '=', 'charge.charge_iduser')  
->join('finicals', 'charge.charge_finical', '=', 'finicals.id') 
->where([
    ['charge.charge_arou', '=', 5],
    ['charge.charge_iduser', '<>', '0'],
    ['finicals.finical_payment', '=', 1], 
    ['finicals.finical_inc', '<>', 0],])
    ->orderBy('charge.charge_id', 'desc')->get();
 


return view('superadmin.viewschargemarketer', [   'chargesas' => $chargesas  ]); }	
else{ return redirect('superadmin/sign-in'); }
				}


 








	public function addsellersup(){
if (Session::has('signsuperadmin')){ return view('superadmin.addseller');}	
else{ return redirect('superadmin/sign-in'); }
				}
			

	
public function addsellerPost(Request $request){
if (Session::has('signsuperadmin')){    	    	
    	$this->validate($request,[
    			'username' => 'required|min:3|unique:seller,sel_username,$request->username', 
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

 
    		

DB::table('seller')->insert([
    [ 'sel_password' => $encryptedPassword ,   'sel_createdatdate' =>  date('Y-m-d H:i:s') , 'sel_active' => 0 ,   'sel_username' => $request->username  ,   'sel_apiactive' => $request->userpassword       ]
]);  

$users = DB::table('seller')->where('sel_username', $request->username)->first(); 

$id_db= $users->id;  

DB::table('accesssellers')->insert([
    ['asc_idseller' => $id_db , 'asc_mahsol' => 1       ]
]);

    		 

 
			 $nametr = Session::flash('statust', 'ثبت نام فروشنده باموفقیت انجام شد.');
		  	$nametrt = Session::flash('sessurl', 'viewssellers');
		  return view('superadmin.success');
    	 	 dd($users->student_username);
 }	
else{ return redirect('superadmin/sign-in'); }    	  
}
	
	

		
	public function viewssellerssup(){
if (Session::has('signsuperadmin')){ 
$admins = \DB::table('seller') ->orderBy('id', 'desc')->get();
return view('superadmin.viewssellers', ['admins' => $admins]);
}	
else{ return redirect('superadmin/sign-in'); }
}






	public function rejdoc($id){
if (Session::has('signsuperadmin')){ 
	Session::put('idimg', $id); 

$updatee = \DB::table('seller')->where('id', '=', $id)  ->update(['sel_madarekactive' => '2'   ]);  
$nametr = Session::flash('statust', 'مدارک کاربر مورد تایید مدیریت قرار نگرفت.');
$nametrt = Session::flash('sessurl', 'viewssellers/editseller/'.$id.''); 
 
		  return view('superadmin.success');

}	
else{ return redirect('superadmin/sign-in'); }
}



	public function accdoc($id){
if (Session::has('signsuperadmin')){ 
	Session::put('idimg', $id); 

$updatee = \DB::table('seller')->where('id', '=', $id)  ->update(['sel_madarekactive' => '1'   ]);  
$nametr = Session::flash('statust', 'مدارک کاربر مورد تایید مدیریت قرار گرفت.');
$nametrt = Session::flash('sessurl', 'viewssellers/editseller/'.$id.''); 
 
		  return view('superadmin.success');

}	
else{ return redirect('superadmin/sign-in'); }
}




	public function editsellersup($id){
if (Session::has('signsuperadmin')){ 
	Session::put('idimg', $id);
$admins = \DB::table('seller')->where('id', '=', $id)  ->orderBy('id', 'desc')->get();



//mycharge 
$charges = \DB::table('seller') 
->join('charge', 'seller.id', '=', 'charge.charge_iduser') 
->join('finicals', 'charge.charge_finical', '=', 'finicals.id') 
->where([
    ['charge.charge_arou', '=', 6],
    ['charge.charge_iduser', '=', $id],
    ['finicals.finical_payment', '=', 1],
    ['finicals.finical_inc', '=', 5],])
    ->orderBy('charge.charge_id', 'desc')->get();
$chargepaymy=0;
foreach($charges as $charge){ $chargepaymy=$charge->charge_pay+$chargepaymy; }




 //supcharge  
$charges = \DB::table('seller') 
->join('charge', 'seller.id', '=', 'charge.charge_iduser')  
->join('finicals', 'charge.charge_finical', '=', 'finicals.id') 
->where([
    ['charge.charge_arou', '=', 6],
    ['charge.charge_iduser', '=', $id],
    ['finicals.finical_payment', '=', 1],
    ['finicals.finical_inc', '=', 6],])
    ->orderBy('charge.charge_id', 'desc')->get();
$chargepaysup=0;
foreach($charges as $charge){ $chargepaysup=$charge->charge_pay+$chargepaysup; }



 //odat  
$charges = \DB::table('seller') 
->join('charge', 'seller.id', '=', 'charge.charge_iduser')  
->join('finicals', 'charge.charge_finical', '=', 'finicals.id') 
->where([
    ['charge.charge_arou', '=', 6],
    ['charge.charge_iduser', '=', $id],
    ['finicals.finical_payment', '=', 1],
    ['finicals.finical_inc', '=', 7],])
    ->orderBy('charge.charge_id', 'desc')->get();
$chargepayodat=0;
foreach($charges as $charge){ $chargepayodat=$charge->charge_pay+$chargepayodat; }



//pardakht 
$charges = \DB::table('seller') 
->join('charge', 'seller.id', '=', 'charge.charge_iduser')  
->join('finicals', 'charge.charge_finical', '=', 'finicals.id') 
->where([
    ['charge.charge_arou', '=', 6],
    ['charge.charge_iduser', '=', $id],
    ['finicals.finical_payment', '=', 1],
    ['finicals.finical_inc', '=', 3],])
    ->orderBy('charge.charge_id', 'desc')->get();
$chargepaypar=0;
foreach($charges as $charge){ $chargepaypar=$charge->charge_pay+$chargepaypar; }



 //bisinis  
$charges = \DB::table('seller') 
->join('charge', 'seller.id', '=', 'charge.charge_iduser')  
->join('finicals', 'charge.charge_finical', '=', 'finicals.id') 
->where([
    ['charge.charge_arou', '=', 6],
    ['charge.charge_iduser', '=', $id],
    ['finicals.finical_payment', '=', 1],
    ['finicals.finical_inc', '=', 8],])
    ->orderBy('charge.charge_id', 'desc')->get();
$chargepaybisi=0;
foreach($charges as $charge){ $chargepaybisi=$charge->charge_pay+$chargepaybisi; }


//jamkol
$chargepay= ($chargepaysup +  $chargepaymy  + $chargepaybisi ) -  ($chargepaypar + $chargepayodat) ;  

 

$chargeac=$chargepay;


 
$images = \DB::table('image')  ->where([
    ['image.img_arou', '=', 6],
    ['image.img_iduser', '=', $id], ])
    ->orderBy('img_id', 'desc')->get();
 




return view('superadmin.editseller', ['admins' => $admins ,'chargeac' => $chargeac ,   'images' => $images ]); }	
else{ return redirect('superadmin/sign-in'); }
}


	




		
	public function editsellerPost($id  , Request $request ){
if (Session::has('signsuperadmin')){ 
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

 
 


$user = \DB::table('seller')->where('id', '=', $id)  ->orderBy('id', 'desc')->first();

 		if ( $request->email ==  $user->sel_email   ){  $activeemail =  $user->sel_emailactive ; }
 else   if ( $request->email !=  $user->sel_email   ){  $activeemail ='0';}

 		if ( $request->tell ==  $user->sel_tell   ){  $activetell =  $user->sel_tellactive ; }
 else   if ( $request->tell !=  $user->sel_tell   ){  $activetell ='0';}
 
  
 
$updatee = \DB::table('seller')->where('id', '=', $id)  ->update(['sel_name' => $request->name    ,  'sel_tell' => $request->tell ,  'sel_email' => $request->email ,  'sel_adres' => $request->adres ,  'sel_emailactive' => $activeemail ,  'sel_tellactive' => $activetell ]); 

$user = \DB::table('seller')->where('id', '=', $id)  ->orderBy('id', 'desc')->first();
if ( ($user->sel_emailactive == 1) &&  ($user->sel_tellactive == 1)   ){  $active=1;}
if ( ($user->sel_emailactive == 0) ||  ($user->sel_tellactive == 0)   ){  $active=0;}
$updatee = \DB::table('seller')->where('id', '=', $id)  ->update(['sel_active' => $active   ]);

$admins = \DB::table('seller')->where('id', '=', $id)  ->orderBy('id', 'desc')->get();
$nametr = Session::flash('statust', 'ویرایش اطلاعات فروشنده باموفقیت انجام شد.');
$nametrt = Session::flash('sessurl', 'viewssellers/editseller/'.$id.''); 
	 
return view('superadmin.success');  
}	else{ return redirect('superadmin/sign-in'); }
}
	

	public function editsellereditbankPost($id  , Request $request ){
if (Session::has('signsuperadmin')){ 



$lngmenus= \DB::table('language') ->where([['id', '<>',  '0'],['lng_active', '=',  '1'],])->orderBy('id', 'desc')->get();
$lngmenu=\DB::table('language') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first();
 
$this->validate($request,[
    			'sel_shcard' => 'required|min:15|max:26',
    			'sel_shhesab' => 'required',
    			'sel_namebank' => 'required' 
    		],[
    			'sel_shcard.required' => 'شماره کارت'.' ! '.$lngmenu->lng_wnotelq,
    			'sel_shcard.min' => 'شماره کارت'.' ! '.$lngmenu->lng_wshort,
    			'sel_shcard.max' =>'شماره کارت'.' ! '.$lngmenu->lng_wlong,
    			'sel_shhesab.required' => 'شماره حساب'.' ! '.$lngmenu->lng_wnotelq, 
    			'sel_namebank.required' => 'نام بانک'.' ! '.$lngmenu->lng_wnotelq, 
    			
    		]);

 


$user = \DB::table('seller')->where('id', '=', $id)  ->orderBy('id', 'desc')->first();
$nametr = Session::flash('statust',  'اطلاعات بانکی شما باموفقیت ویرایش شد');
$nametrt = Session::flash('sessurl', 'viewssellers/editseller/'.$id.''); 
	 

$updatee = \DB::table('seller')->where('id', '=', $id)  ->update(['sel_shcard' => $request->sel_shcard   ,  'sel_shhesab' => $request->sel_shhesab ,  'sel_namebank' => $request->sel_namebank ,  'sel_shpaya' => $request->sel_shpaya  ]); 


return view('superadmin.success');  


return view('superadmin.success');  
}	else{ return redirect('superadmin/sign-in'); }
}
	
	
	
	
	

	public function accinfobank($id){
if (Session::has('signsuperadmin')){ 
	Session::put('idimg', $id);
	
	
 
$updatee = \DB::table('seller')->where('id', '=', $id)  ->update(['sel_bankactive' => '1'   ]); 


$nametr = Session::flash('statust', 'اطلاعات بانکی باموفقیت تایید شد.');
$nametrt = Session::flash('sessurl', 'viewssellers/editseller/'.$id.''); 

	
return view('superadmin.success');  
}	else{ return redirect('superadmin/sign-in'); }
}
	
	
	
	
	
	
	


public function dropzonestoreseller(Request $request)
    {
        $image = $request->file('file');
        $imageName = time().$image->getClientOriginalName();
        $image->move(public_path('images'),$imageName);        
$updatee = \DB::table('seller')->where('id', '=', Session::get('idimg'))  ->update(['sel_img' => $imageName   ]); 
        return response()->json(['success'=>$imageName]);
    }
		




		
		
	public function securityysell(Request $request ){
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
$updatee = \DB::table('seller')->where('id', '=', Session::get('idimg'))  ->update(['sel_password' => $encryptedPassword   ]); 
$admins = \DB::table('seller')->where('id', '=',  Session::get('idimg'))  ->orderBy('id', 'desc')->first();
			 $nametr = Session::flash('statust', 'رمز شما با موفقیت تغییر کرد.');
		  	$nametrt = Session::flash('sessurl', 'viewssellers/editseller/'. Session::get('idimg').'');
	
		  	
$user = \DB::table('seller')->where('id', '=', Session::get('idimg'))  ->orderBy('id', 'desc')->first();

$superadminselanats =  DB::table('superadminselanats')  ->orderBy('id', 'desc')->first(); 

 if($superadminselanats->supelan_emailstudent == '1'){
 	if ( $user->sel_email != '')  {
 	 $usernamee = $user->sel_username; 
 $titmes='رمز شما با موفقیت تغییر کرد';
 $mestt='رمزجدید';
 $mesnot = Crypt::decrypt($user->sel_password); 
   Mail::send('superadmin.mail', ['user' => $user , 'usernamee' => $usernamee, 'mesnot' => $mesnot, 'titmes' => $titmes , 'mestt' => $mestt], function ($m) use ($user) {       
$decryptedPassword =  Crypt::decrypt($user->sel_password);
            $m->from('info@kargo.biz', 'رمز جدید');
            $m->to($user->sel_email, $user->sel_email)->subject('امنیت اطلاعات');
        }); 	
 } }
 
 
 if($superadminselanats->supelan_smsstudent == '1'){
 	if ( $user->student_tell != '')  {
 		
 $admins =  \DB::table('seller')->where('id', '=', Session::get('idimg'))  ->orderBy('id', 'desc')->first();
$panelsms = \DB::table('panelsms')->where('id', '=',  1)  ->orderBy('id', 'desc')->first();
include(app_path().'/../sms/api_send_sms.php');
$message='با عرض سلام '.$admins->sel_name.' عزیز. رمز شما با موفقیت تغییر کرد . رمز جدید : '.$decryptedPassword.' ';
$result = Send_SMS($panelsms->sms_username, $panelsms->sms_password, $panelsms->sms_fromnumber, $admins->sel_tell, $message , 0, false) ; 		
 		
 		} }
 
 
	
	
return view('superadmin.success');
}	
else{ return redirect('superadmin/sign-in'); }
				}
		






		
	public function accsellsup($id){
		if (Session::has('signsuperadmin')){ 
			
$adminacc =  DB::table('seller')->where('id', '=', $id) ->orderBy('id', 'desc')->first();	
 
						
$updatee = \DB::table('seller')->where('id', '=', $id)  ->update(['sel_active' => 1   ]); 
		  	$admins = \ DB::table('seller')->where('id', $id)->get();				
		  	$nametr = Session::flash('statust', 'اکانت فروشنده با موفقیت فعال شد .');
		  	$nametrt = Session::flash('sessurl', 'viewssellers/editseller/'.$id.'');			  	
		  			  	
		  	$user = \DB::table('seller')->where('id', '=', $id)  ->orderBy('id', 'desc')->first();
$superadminselanats =  DB::table('superadminselanats')  ->orderBy('id', 'desc')->first();
 if($superadminselanats->supelan_emailaccstudent == '1'){
 	if ( $adminacc->sel_email != '')  {
	
$usernamee = $user->sel_username; 
 $titmes='اکانت شما با موفقیت فعال شد';
 $mestt='رمز شما';
 $mesnot = Crypt::decrypt($user->sel_password); 
   Mail::send('superadmin.mail', ['user' => $user , 'usernamee' => $usernamee, 'mesnot' => $mesnot, 'titmes' => $titmes , 'mestt' => $mestt], function ($m) use ($user) {
        
$decryptedPassword =  Crypt::decrypt($user->sel_password);

            $m->from('info@kargo.biz', 'فعالسازی اکانت');

            $m->to($user->sel_email, $user->sel_email)->subject('فعالسازی اکانت');
        }); 	
 }		}	  	
	
 if($superadminselanats->supelan_smsaccstudent == '1'){	
   
$admins = \DB::table('seller')->where('id', '=',  $id)  ->orderBy('id', 'desc')->first();
$panelsms = \DB::table('panelsms')->where('id', '=',  1)  ->orderBy('id', 'desc')->first();
include(app_path().'/../sms/api_send_sms.php');
$message='با عرض سلام '.$admins->sel_name.' عزیز.     اکانت شما با موفقیت فعال شد';
if (($result = Send_SMS($panelsms->sms_username, $panelsms->sms_password, $panelsms->sms_fromnumber, $admins->sel_tell, $message , 0, false)) === '0')
{ 
		
	return view('superadmin.success');
} else if ($result !== '') {   
		
	return view('superadmin.success');
 }


 }
	 
	
	return view('superadmin.success');
		
 
} else{ return redirect('superadmin/sign-in'); }
				}
		
		
	public function rejsellersup($id){
		if (Session::has('signsuperadmin')){ 				
$updatee = \DB::table('seller')->where('id', '=', $id)  ->update(['sel_active' => 0   ]); 
		  	$admins = \ DB::table('user')->where('id', $id)->get();				
		  	$nametr = Session::flash('statust', 'اکانت فروشنده باموفقیت غیرفعال شد.');
		  	$nametrt = Session::flash('sessurl', 'viewssellers/editseller/'.$id.'');		  	
	return view('superadmin.success', ['admins' => $admins]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}
			


		
	public function deletsellersup($id){
		if (Session::has('signsuperadmin')){ 
		  	$admins = \ DB::table('seller')->where('id', $id)->get();
		  	$admins = \DB::table('seller')->where('id', '=', $id)->delete(); 
		  	$nametr = Session::flash('statust', 'حذف فروشنده با موفقیت انجام شد.');
		  	$nametrt = Session::flash('sessurl', 'viewssellers');
		  	
	return view('superadmin.success', ['admins' => $admins]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}
		


	public function accessseller($id){
if (Session::has('signsuperadmin')){ 
	Session::put('idimg', $id);
$admins = \DB::table('accesssellers')->where('asc_idseller', '=', $id)  ->orderBy('id', 'desc')->get();
$acadmins = \DB::table('seller')->where('id', '=', $id)  ->orderBy('id', 'desc')->get();
return view('superadmin.accessseller', ['admins' => $admins , 'acadmins' => $acadmins]); }	
else{ return redirect('superadmin/sign-in'); }
				}





		
	public function accesssellerpost( $id , Request $request ){
if (Session::has('signsuperadmin')){ 
$updatee = \DB::table('accesssellers')->where('asc_idseller', '=',$id)  ->update([ 'asc_mahsol' => $request->asc_mahsol   ]); 
 

			 $nametr = Session::flash('statust', 'سطح دسترسی با موفقیت ویرایش شد.');
		  	$nametrt = Session::flash('sessurl', 'viewssellers/editseller/accessseller/'.$id.'');		  	

 return view('superadmin.success');

}	
else{ return redirect('superadmin/sign-in'); }
				}
		





	public function accesssellergroupmahsol($id){
if (Session::has('signsuperadmin')){ 

 
 
$accessgroupscount = \DB::table('accessgroup')->where([
    ['acc_adminid', '=', $id], 
    ['acc_arou', '=', 6], ])
    ->orderBy('acc_id', 'desc')->count();
$groupcatscount = \DB::table('groupcat')->where('group_id', '<>', 0)  ->orderBy('group_id', 'desc')->count();


$accessgroups = \DB::table('accessgroup')->where([
    ['acc_adminid', '=', $id], 
    ['acc_arou', '=', 6], ])
    ->orderBy('acc_id', 'desc')->get();
$groupcats = \DB::table('groupcat')->where('group_id', '<>', 0)  ->orderBy('group_id', 'desc')->get();
 

if($accessgroupscount=='0'){
foreach($groupcats as $groupcat){  
DB::table('accessgroup')->insert([
    ['acc_adminid' => $id , 'acc_grid' => $groupcat->group_id , 'acc_arou' => 6  ]
]);  
}	
} 

if($accessgroupscount==$groupcatscount){ }


if($accessgroupscount!=$groupcatscount){  
foreach($groupcats as $groupcat){   
$accoun = \DB::table('accessgroup')->where([
    ['accessgroup.acc_adminid', '=', $id], 
    ['acc_arou', '=', 6], 
    ['accessgroup.acc_grid', '=', $groupcat->group_id], ])
    ->orderBy('acc_id', 'desc')->count(); 
if($accoun==0){
	\DB::table('accessgroup')->insert([
    ['acc_adminid' => $id , 'acc_grid' => $groupcat->group_id , 'acc_arou' => 6 ]
]);  
} 
}	 
}



$accessgroup = \DB::table('accessgroup') 
->join('groupcat', 'accessgroup.acc_grid', '=', 'groupcat.group_id')  
->where([
    ['accessgroup.acc_adminid', '=', $id], 
    ['acc_arou', '=', 6],   
    ['groupcat.group_active', '=', 1],  ])
    ->orderBy('groupcat.group_catid', 'asc')->get();


 
$admins = \DB::table('accesssellers')->where('asc_idseller', '=', $id)  ->orderBy('id', 'desc')->get();
$acadmins = \DB::table('seller')->where('id', '=', $id)  ->orderBy('id', 'desc')->get();
return view('superadmin.accesssellergroupmahsol', ['admins' => $admins , 'acadmins' => $acadmins , 'accessgroup'=> $accessgroup]);
 

 }	
else{ return redirect('superadmin/sign-in'); }
				}

		

		
	public function accesssellergroupmahsolpost($id , Request $request ){
if (Session::has('signsuperadmin')){ 



$accessgroup = \DB::table('accessgroup') 
->join('groupcat', 'accessgroup.acc_grid', '=', 'groupcat.group_id')  
->where([
    ['accessgroup.acc_adminid', '=', $id],  
    ['acc_arou', '=', 6],
    ['groupcat.group_active', '=', 1], ])
    ->orderBy('groupcat.group_catid', 'asc')->get();
    
  foreach($accessgroup as $accessgro){ 
  	 $namefeild='a'.$accessgro->group_id; 
  	
  	
$bcodee = explode("a",$namefeild); $coname=$bcodee['1'];  
if($accessgro->group_id==$coname){
	 
  	 
$updatee = \DB::table('accessgroup')->where([
    ['accessgroup.acc_adminid', '=', $id],
    ['accessgroup.acc_grid', '=', $coname], 
    ['acc_arou', '=', 6],  ])
    ->update(['acc_flg' => $request->$namefeild   ]); 
  	
} 

 
  }  
			 $nametr = Session::flash('statust', 'دسترسی به گروه محصولات برای فروشنده با موفقیت ویرایش شد.');
		  	$nametrt = Session::flash('sessurl', 'viewssellers/editseller/accessseller/'.$id.'/groupmahsol');	


    
          return view('superadmin.success');

 }	
else{ return redirect('superadmin/sign-in'); }
				}












	public function loginsellersup($id){
if (Session::has('signsuperadmin')){ 
	Session::put('idimg', $id);
$admins = \DB::table('seller')->where('id', '=', $id)  ->orderBy('id', 'desc')->first();

if($admins){

$password_db= $admins->sel_password; 
$decryptedPassword =  Crypt::decrypt($password_db);
$userscou = DB::table('seller')->where([
    ['sel_username',  $admins->sel_username],
])->count();
$id_db= $admins->id;
$activeadmin= $admins->sel_active; 
$name_db= $admins->sel_name; 
$username_db= $admins->sel_username; 
$password_db= $admins->sel_password; 
$username_log = $admins->sel_username; 
if(($username_log == $username_db)&&( $decryptedPassword == Crypt::decrypt($password_db))){
	 
		
	Session::set('idseller', $id_db);
	Session::set('signnameseller', $name_db);
	Session::set('signuserseller', $username_db);
	Session::set('activeseller', $activeadmin);
	Session::set('idlang', '3');
	
	

$adminslp = \DB::table('seller')->where('id', '=', $id_db)  ->orderBy('id', 'desc')->first();
$logindatepas=$adminslp->sel_loginatdate;	

$admimg=$adminslp->sel_img;
if(empty($admimg)){$admimg='user2x.png';}	
 
	
	Session::set('logindatepasseller', $logindatepas);
	Session::set('sellerimg', $admimg);
	
	$updatee = \DB::table('seller')->where('id', '=', Session::get('idseller'))  ->update(['sel_loginatdate' => date('Y-m-d H:i:s')    ]); 
			return redirect('seller/panel'); 
		} else 
			 $nametr = Session::flash('statust',  $lngmenu->lng_werrornot);
				return redirect('seller/sign-in'); 	
			
}


 
 
}	
else{ return redirect('superadmin/sign-in'); }
}










	public function viewschargeseller(){
if (Session::has('signsuperadmin')){

  

$chargesas = \DB::table('seller') 
->join('charge', 'seller.id', '=', 'charge.charge_iduser')  
->join('finicals', 'charge.charge_finical', '=', 'finicals.id') 
->where([
    ['charge.charge_arou', '=', 6],
    ['charge.charge_iduser', '<>', '0'],
    ['finicals.finical_payment', '=', 1], 
    ['finicals.finical_inc', '<>', 0],])
    ->orderBy('charge.charge_id', 'desc')->get();
 


return view('superadmin.viewschargeseller', [   'chargesas' => $chargesas  ]); }	
else{ return redirect('superadmin/sign-in'); }
				}
















		
	public function addusersup(){
if (Session::has('signsuperadmin')){ return view('superadmin.adduser');}	
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

$user=\DB::table('user')  ->where('id' , '<>' , '0')->orderBy('id' , 'desc')->first(); $ncode=$user->user_ncode; 
$ncodee = explode("u",$ncode); $ncode=$ncodee['1']; $ncode=$ncode+1; $ncode='u'.$ncode;
    		

DB::table('user')->insert([
    [ 'user_password' => $encryptedPassword ,   'user_createdatdate' =>  date('Y-m-d H:i:s') , 'user_active' => 0 , 'user_moaref' => $rnd  , 'user_ncode' => $ncode  , 'user_username' => $request->username       ]
]);  
    		 

 
			 $nametr = Session::flash('statust', 'ثبت نام کاربر با موفقیت انجام شد.');
		  	$nametrt = Session::flash('sessurl', 'viewsusers');
		  return view('superadmin.success');
    	 	 dd($users->student_username);
 }	
else{ return redirect('superadmin/sign-in'); }    	  
}
	
	
		
		
	public function viewsuserssup(){
if (Session::has('signsuperadmin')){ 
$admins = \DB::table('user') ->orderBy('id', 'desc')->get();
return view('superadmin.viewsusers', ['admins' => $admins]);
}	
else{ return redirect('superadmin/sign-in'); }
}


	public function editusersup($id){
if (Session::has('signsuperadmin')){ 
	Session::put('idimg', $id);
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





return view('superadmin.edituser', ['admins' => $admins ,'chargeac' => $chargeac ]); }	
else{ return redirect('superadmin/sign-in'); }
}



	public function chargeuserinc($id){
if (Session::has('signsuperadmin')){

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
    ['finicals.finical_inc', '<>', 0],])
    ->orderBy('charge.charge_id', 'desc')->get();





return view('superadmin.inccharge', ['admins' => $admins ,'chargeac' => $chargeac , 'charges' => $charges , 'id' => $id   , 'chargesas' => $chargesas  ]); }	
else{ return redirect('superadmin/sign-in'); }
				}





	public function chargeuserincodat($id){
if (Session::has('signsuperadmin')){

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
    ['finicals.finical_inc', '<>', 0],])
    ->orderBy('charge.charge_id', 'desc')->get();





return view('superadmin.odatcharge', ['admins' => $admins ,'chargeac' => $chargeac , 'charges' => $charges , 'id' => $id   , 'chargesas' => $chargesas  ]); }	
else{ return redirect('superadmin/sign-in'); }
				}








	public function chargeuserincpost($id , Request $request){
if (Session::has('signsuperadmin')){ 
 
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
$nametrt = Session::flash('sessurl', 'viewsusers/edituser/charge/'.$id.'');		  	
 return view('superadmin.success'); 
 
}	else{ return redirect('superadmin/sign-in'); }
}
 





	public function chargeuserincpostodat($id , Request $request){
if (Session::has('signsuperadmin')){ 
 
    	$this->validate($request,[
    			'tit' => 'required|numeric' 
    		],[
    			'tit.required' => 'لطفا مبلغ را وارد نمایید',
    			'tit.numeric' => 'مبلغ نامعتبر است', 
    		]);
    	
if($request->jamekol < $request->tit) {
	$nametr = Session::flash('statust',  'مبلغ انتخاب شده جهت عودت بیشتر از شارژ اکانت کاربر می باشد');
$nametrt = Session::flash('sessurl', 'viewsusers/edituser/charge/odat/'.$id.'');		  	
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
$nametrt = Session::flash('sessurl', 'viewsusers/edituser/charge/'.$id.'');		  	
 return view('superadmin.success');  	
}

 
}	else{ return redirect('superadmin/sign-in'); }
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
$id_db= $admins->id;
$activeadmin= $admins->user_active; 
$name_db= $admins->user_name; 
$username_db= $admins->user_username; 
$password_db= $admins->user_password; 
$username_log = $admins->user_username; 
if(($username_log == $username_db)&&( $decryptedPassword == Crypt::decrypt($password_db))){
	
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
			 $nametr = Session::flash('statust',  $lngmenu->lng_werrornot);
				return redirect('user/sign-in'); 	
			
}


 
 
}	
else{ return redirect('superadmin/sign-in'); }
}












	public function viewscharge(){
if (Session::has('signsuperadmin')){

 

//mycharge 
$charges = \DB::table('user') 
->join('charge', 'user.id', '=', 'charge.charge_iduser') 
->join('finicals', 'charge.charge_finical', '=', 'finicals.id') 
->where([
    ['charge.charge_arou', '=', 4],
    ['charge.charge_iduser', '<>', '0'],
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
    ['charge.charge_iduser', '<>', '0'],
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
    ['charge.charge_iduser', '<>', '0'],
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
    ['charge.charge_iduser', '<>', '0'],
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
    ['charge.charge_iduser', '<>', '0'],
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
    ['charge.charge_iduser', '<>', '0'],
    ['finicals.finical_payment', '=', 1], 
    ['finicals.finical_inc', '<>', 0],])
    ->orderBy('charge.charge_id', 'desc')->get();
 


return view('superadmin.viewscharge', [   'chargesas' => $chargesas  ]); }	
else{ return redirect('superadmin/sign-in'); }
				}






	public function viewschargethreedaysago(){
if (Session::has('signsuperadmin')){

 

//mycharge 
$charges = \DB::table('user') 
->join('charge', 'user.id', '=', 'charge.charge_iduser') 
->join('finicals', 'charge.charge_finical', '=', 'finicals.id') 
->where([
    ['charge.charge_arou', '=', 4],
    ['charge.charge_iduser', '<>', '0'],
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
    ['charge.charge_iduser', '<>', '0'],
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
    ['charge.charge_iduser', '<>', '0'],
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
    ['charge.charge_iduser', '<>', '0'],
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
    ['charge.charge_iduser', '<>', '0'],
    ['finicals.finical_payment', '=', 1],
    ['finicals.finical_inc', '=', 8],])
    ->orderBy('charge.charge_id', 'desc')->get();
$chargepaybisi=0;
foreach($charges as $charge){ $chargepaybisi=$charge->charge_pay+$chargepaybisi; }


//jamkol
$chargepay= ($chargepaysup +  $chargepaymy  + $chargepaybisi ) -  ($chargepaypar + $chargepayodat) ; 
 

$chargeac=$chargepay;





  $end_date = date("Y-m-d", strtotime("- 3 days")); 
 
 	 

$chargesas = \DB::table('user') 
->join('charge', 'user.id', '=', 'charge.charge_iduser')  
->join('finicals', 'charge.charge_finical', '=', 'finicals.id') 
->where([
    ['charge.charge_arou', '=', 4],
    ['charge.charge_iduser', '<>', '0'],
    ['finicals.finical_payment', '=', 1], 
    ['charge.charge_createdatdate', '>=', $end_date],
    ['finicals.finical_inc', '<>', 0],])
    ->orderBy('charge.charge_id', 'desc')->get();





return view('superadmin.viewschargethreedaysago', [   'chargesas' => $chargesas  ]); }	
else{ return redirect('superadmin/sign-in'); }
				}





	public function detcharge($id){
if (Session::has('signsuperadmin')){


$admins = \DB::table('user') 
->join('marsole', 'user.user_ncode', '=', 'marsole.mar_codmoshtari')  
->join('finicals', 'marsole.id', '=', 'finicals.finical_marid')  
->where([  
    ['finicals.id', '=', $id] ,  
    ['finicals.finical_arou', '=', '4'] , ])
    ->orderBy('finicals.id', 'desc')->get();


 

$getwaypays=\DB::table('getwaypay')->where('getway_active', '=', 1)   ->orderBy('id' )->get();
 
 return view('superadmin.detcharge' , [ 'admins' => $admins  , 'getwaypays' => $getwaypays     ]);
 }	else{ return redirect('superadmin/sign-in'); }
}
		





		
	public function editusersupPost($id  , Request $request ){
if (Session::has('signsuperadmin')){ 
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
	 
return view('superadmin.success');  
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
            $m->from('info@kargo.biz', 'رمز جدید');
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
 
 
	
	
return view('superadmin.success');
}	
else{ return redirect('superadmin/sign-in'); }
				}
		



		
		
	public function deletusersup($id){
		if (Session::has('signsuperadmin')){ 
		  	$admins = \ DB::table('user')->where('id', $id)->get();
		  	$admins = \DB::table('user')->where('id', '=', $id)->delete();
		  	$admins = \DB::table('listgroupstudent')->where('listgrst_studentid', '=', $id)->delete();
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

            $m->from('info@kargo.biz', 'فعالسازی اکانت');

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
		
	return view('superadmin.success');
} else if ($result !== '') {   
		
	return view('superadmin.success');
 }


 }
	 
	
	return view('superadmin.success');
		
	

 /* 
	   if (($adminacc->student_email == '') &&($adminacc->student_tell == '')  ) {
	 	 	$nametr = Session::flash('statust', 'متاسفانه اکانت فعال نشد برای فعال شدن اکانت   شماره تلفن و ایمیل باید در سیستم ثبت شده باشد. لطفا پس از تکمیل اطلاعات نسبت به تاییدی اکانت اقدام نمایید.');
		  	$nametrt = Session::flash('sessurl', 'viewsusers/edituser/'.$id.'');
	 	return view('superadmin.error');
	 	
	 	 } 	*/
} else{ return redirect('superadmin/sign-in'); }
				}
		
		
	public function rejusersup($id){
		if (Session::has('signsuperadmin')){ 				
$updatee = \DB::table('user')->where('id', '=', $id)  ->update(['user_active' => 0   ]); 
		  	$admins = \ DB::table('user')->where('id', $id)->get();				
		  	$nametr = Session::flash('statust', 'اکانت کاربر باموفقیت غیرفعال شد.');
		  	$nametrt = Session::flash('sessurl', 'viewsusers/edituser/'.$id.'');		  	
	return view('superadmin.success', ['admins' => $admins]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}
			
		
		 
		
		
	public function addsefaresh(){
if (Session::has('signsuperadmin')){ 

$admins = \DB::table('user') ->orderBy('id', 'desc')->get(); 

return view('superadmin.addsefaresh', ['admins' => $admins]);

}	
else{ return redirect('superadmin/sign-in'); }
				}
			

		
		
	public function faktor(){
if (Session::has('signsuperadmin')){ 

$admins = \DB::table('user') ->orderBy('id', 'desc')->get(); 

return view('superadmin.printedv', ['admins' => $admins]);

}	
else{ return redirect('superadmin/sign-in'); }
				}
			



public function addsefareshpost(Request $request){
if (Session::has('signsuperadmin')){    

 
 
$this->validate($request,[
    			'codmoshtari' => 'required|min:2',
    			'name' => 'required',
    			'vaznmarsole' => 'required',
    			'paypostturk' => 'required|numeric', 
    		],[
    			'codmoshtari.required' => 'لطفا کد مشتری را وارد نمایید', 
    			'codmoshtari.min' => 'لطفا کد مشتری را بصورت صحیح وارد نمایید',     
    			'name.required' => 'لطفا نام مرسوله را وارد نمایید',   
    			'vaznmarsole.required' => 'لطفا وزن مرسوله را وارد نمایید',   
    			'paypostturk.required' => 'لطفا هزینه ارسال مرسوله را وارد نمایید',  
    			'paypostturk.numeric' => 'لطفا هزینه ارسال مرسوله را بصورت عددی وارد نمایید',   
    			
    		]);

if($request->paypostturk=='0' ){ $status='6'; $payment='1'; $datepay=date('Y-m-d H:i:s'); } else {   $status='5'; $payment='0';  $datepay='';  }


 $codmoshtari=$request->codmoshtari;
 
 
$countuser = \DB::table('user')->where([
    [ 'user.user_ncode', '=', $codmoshtari ],  ])
    ->orderBy('id', 'desc')->count(); 
 
 if($countuser=='0'){
 	
$nametr = Session::flash('statust', ' کد مشتری وارد شده در سیستم وجود ندارد لطفا بررسی نمایید');
$nametrt = Session::flash('sessurl', 'addsefaresh');
		  return view('superadmin.error'); 
 } else{
 


 
DB::table('marsole')->insert([
    ['mar_name'  =>  $request->name ,'mar_vazn'  =>  $request->vaznmarsole ,'mar_codmoshtari'  =>   $request->codmoshtari ,'mar_paypostturk'  =>  $request->paypostturk   ,'mar_fiziki'  =>  '1' ,'mar_status'  =>  $status   , 'mar_createdatdate'  =>   date('Y-m-d H:i:s') ,'mar_arobuy'  =>  '1'   , 'mar_dateshamsi' => $request->dateshamsi   ]
]); 
 

$marsoles = \DB::table('marsole')  ->where([   
['mar_status', '=', $status ] ,
['mar_name', '=', $request->name ] ,
['mar_vazn', '=', $request->vaznmarsole ] ,
['mar_codmoshtari', '=', $request->codmoshtari ] ,
['mar_paypostturk', '=', $request->paypostturk  ] ,
['mar_fiziki', '=', '1'  ] ,
['mar_arobuy', '=', '1'  ] , 
    ]) ->orderBy('id', 'desc')->first();
$codmoshtari = $marsoles->mar_codmoshtari; $id = $marsoles->id;

$user = \DB::table('user')  ->where([   ['user_ncode', '=', $codmoshtari ] ,]) ->orderBy('id', 'desc')->first();
   $userid = $user->id;

DB::table('finicals')->insert([
    ['finical_marid' => $id ,  'finical_pay' => $request->paypostturk ,    'finical_createdatdate' => date('Y-m-d H:i:s') ,   'finical_inc' =>  '3' ,   'finical_iduser' =>  $userid ,   'finical_arou' =>  '4' ,   'finical_marpay' =>  '5' ,   'finical_payment' =>  $payment  ,   'finical_paymentdate' =>  $datepay   ]
]); 


 	




$nametr = Session::flash('statust', 'محصول رسیده با موفقیت ثبت سیستمی شد. ');
$nametrt = Session::flash('sessurl', 'viewssefareshthreedaysago');


		  	
$user = \DB::table('marsole')  ->where([   ['id', '=', $id ] ,]) ->orderBy('id', 'desc')->first();
$codmoshtari = $user->mar_codmoshtari;
$user = \DB::table('user')  ->where([   ['user_ncode', '=', $codmoshtari ] ,]) ->orderBy('id', 'desc')->first();	  	 
$elanatorders =  DB::table('elanatorders')  ->orderBy('id', 'desc')->first();
 if($elanatorders->elanord_recvturkmail == '1'){
 	if ( $user->user_email != '')  {
 $usernamee = $user->user_name; 
 $titmes='سفارش با موفقیت براورد قیمت باربری شد';
 $mestt='هزینه قابل پرداخت';
 $mesnot =  $request->paypostturk.' ريال '; 
   Mail::send('superadmin.mail', ['user' => $user , 'usernamee' => $usernamee, 'mesnot' => $mesnot, 'titmes' => $titmes , 'mestt' => $mestt], function ($m) use ($user) {
         

            $m->from('info@kargo.biz', 'کارگو');

            $m->to($user->user_email, $user->user_email)->subject('براورد قیمت باربری');
        }); 	
 }	 }	
 
 	
 if($elanatorders->elanord_recvturksms == '1'){	
    
$panelsms = \DB::table('panelsms')->where('id', '=',  1)  ->orderBy('id', 'desc')->first();
include(app_path().'/../sms/api_send_sms.php');
$message='با عرض سلام '.$user->user_name.' عزیز. سفارش با موفقیت براورد قیمت باربری شد';
if (($result = Send_SMS($panelsms->sms_username, $panelsms->sms_password, $panelsms->sms_fromnumber, $user->user_tell, $message , 0, false)) === '0')
{ 
		
	return view('superadmin.success');
} else if ($result !== '') {   
		
	return view('superadmin.success');
 }


 }
 

		  return view('superadmin.success'); 
 
 }
  
 
}	
else{ return redirect('superadmin/sign-in'); }
				}
			





		
	public function viewssefaresh(){
if (Session::has('signsuperadmin')){ 

 

$marsoles = \DB::table('user') 
->join('marsole', 'user.user_ncode', '=', 'marsole.mar_codmoshtari') 
->where([ 
    ['marsole.id', '<>', '0' ] ,])
    ->orderBy('marsole.id', 'desc')->get();
 
    
return view('superadmin.viewssefaresh', ['marsoles' => $marsoles  ]);
	
	}	
else{ return redirect('superadmin/sign-in'); }
				}
	



	public function viewssefareshthreedaysago(){
if (Session::has('signsuperadmin')){ 
 
  $end_date = date("Y-m-d", strtotime("- 3 days")); 

$marsoles = \DB::table('user') 
->join('marsole', 'user.user_ncode', '=', 'marsole.mar_codmoshtari') 
->where([ 
    ['marsole.id', '<>', '0' ] ,
    ['marsole.mar_createdatdate', '>=', $end_date], ])
    ->orderBy('marsole.id', 'desc')->get();
 
  
 return view('superadmin.viewssefareshthreedaysago', ['marsoles' => $marsoles  ]);
	
	}	
else{ return redirect('superadmin/sign-in'); }
				}
	



	public function viewssefareshwaitacc($statu){
if (Session::has('signsuperadmin')){  

		if($statu=='waitacc'){$status='0';}
else    if($statu=='waitpayord'){$status='1';}
else    if($statu=='waitbuy'){$status='2';}
else    if($statu=='cancelpay'){$status='3';}
else    if($statu=='buyturk'){$status='4';}
else    if($statu=='waitpaykargo'){$status='5';}
else    if($statu=='waitsendtoiran'){$status='6';}
else    if($statu=='waitreciniran'){$status='7';}
else    if($statu=='waitpaypost'){$status='8';}
else    if($statu=='waitsenduser'){$status='9';}
else    if($statu=='sentouser'){$status='10';}
else    if($statu=='ordrec'){$status='11';}
  
 

$marsoles = \DB::table('user')  ->join('marsole', 'user.user_ncode', '=', 'marsole.mar_codmoshtari')  ->where([   ['marsole.id', '<>', '0' ] , ['marsole.mar_status', '=', $status ] ,]) ->orderBy('marsole.id', 'desc')->get();   


$datesha = \DB::table('user')  ->join('marsole', 'user.user_ncode', '=', 'marsole.mar_codmoshtari')  ->where([   ['marsole.id', '<>', '0' ] , ['marsole.mar_status', '=', $status ] ,]) ->orderBy('marsole.id', 'desc')->get();   

foreach($datesha as $datesham){


$dateshammsii=jDate::forge($datesham->mar_createdatdate)->format('Y/m/d'); 

$updatee = \DB::table('user') 
->join('marsole', 'user.user_ncode', '=', 'marsole.mar_codmoshtari') 
->where([   ['marsole.id', '=', $datesham->id ] , ['marsole.mar_status', '=', $status ] , ['marsole.mar_dateshamsi', '=', '' ] ,]) ->update([  'mar_dateshamsi' => $dateshammsii       ]); 
	
	
}


return view('superadmin.viewssefareshstatus', ['marsoles' => $marsoles  ]);



  }	
else{ return redirect('superadmin/sign-in'); } }
		




	public function viewssefaresharchive(){
if (Session::has('signsuperadmin')){   
return view('superadmin.viewssefaresharchive');  
  }	
else{ return redirect('superadmin/sign-in'); } }
		



	public function viewssefaresharchivepost(Request $request){
if (Session::has('signsuperadmin')){   


$status = $request->TicketStatusFilter;
$fromdate = $request->fromdate;
$todate = $request->todate;  


if($fromdate==null){ $fromdate='1380/01/01'; }
if($todate==null){ $todate='1420/01/01'; }

 
 
 
if($status!='20'){ 

$marsoles = \DB::table('user')  ->join('marsole', 'user.user_ncode', '=', 'marsole.mar_codmoshtari')  
->where([ 
  ['marsole.id', '<>', '0' ] , 
    ['marsole.mar_dateshamsi', '>=', $fromdate], 
    ['marsole.mar_dateshamsi', '<=', $todate], 
  ['marsole.mar_status', '=', $status ] ,]) 
  ->orderBy('marsole.id', 'desc')->get(); 

} 
  if($status=='20'){ 

$marsoles = \DB::table('user')  ->join('marsole', 'user.user_ncode', '=', 'marsole.mar_codmoshtari')  
->where([ 
  ['marsole.id', '<>', '0' ] , 
    ['marsole.mar_dateshamsi', '>=', $fromdate], 
    ['marsole.mar_dateshamsi', '<=', $todate], 
  ['marsole.mar_status', '<>', $status ] ,]) 
  ->orderBy('marsole.id', 'desc')->get(); 

}  
 

 


return view('superadmin.viewssefaresharchive', ['marsoles' => $marsoles  ]);
 
 
  }	
else{ return redirect('superadmin/sign-in'); } }
		




	public function viewssefareshwaitaccpost($statu , Request $request){
if (Session::has('signsuperadmin')){  
 
 
 
  }	
else{ return redirect('superadmin/sign-in'); } }
		



	



		
	public function vieworderid($id){
if (Session::has('signsuperadmin')){ 
 
$marcount = \DB::table('user') 
->join('marsole', 'user.user_ncode', '=', 'marsole.mar_codmoshtari') 
->where([  
    ['marsole.id', '=', $id ] ,])
    ->orderBy('marsole.id', 'desc')->count();
    
 if($marcount=='0'){
	$marsoles='';	$creditcards='';
} else {   
$marsoles = \DB::table('user') 
->join('marsole', 'user.user_ncode', '=', 'marsole.mar_codmoshtari') 
->where([  
    ['marsole.id', '=', $id ] ,])
    ->orderBy('marsole.id', 'desc')->get();
 foreach($marsoles as $marsol){ $creditcards=$marsol->mar_credcard;  }     
$creditcards = \ DB::table('creditcard')->where([ 
    ['creditcard.id', '=', $creditcards] ,
    ['creditcard.id', '<>', '0' ] ,])
    ->orderBy('creditcard.id', 'desc')->first();
 }
      
return view('superadmin.sefaaresh', ['marsoles' => $marsoles , 'creditcards' => $creditcards  ]);
  	
	}	
else{ return redirect('superadmin/sign-in'); }
				}
	

		
	public function vieworderidinsfac($id){
if (Session::has('signsuperadmin')){ 
 
$marsoles = \DB::table('user') 
->join('marsole', 'user.user_ncode', '=', 'marsole.mar_codmoshtari') 
->where([  
    ['marsole.id', '=', $id ] ,])
    ->orderBy('marsole.id', 'desc')->get();
 foreach($marsoles as $marsol){ $creditcards=$marsol->mar_credcard;  }     
$creditcards = \ DB::table('creditcard')->where([ 
    ['creditcard.id', '=', $creditcards] ,
    ['creditcard.id', '<>', '0' ] ,])
    ->orderBy('creditcard.id', 'desc')->first();


$fincont = \DB::table('finicals')  ->where([   
['finical_marid', '=', $id ] ,
    ]) ->orderBy('id', 'desc')->count();

if($fincont=='0'){
$marsoles = \DB::table('marsole')  ->where([   
['mar_status', '=', '5' ] ,
['marsole.id', '=', $id ] ,
    ]) ->orderBy('id', 'desc')->first();
$codmoshtari = $marsoles->mar_codmoshtari; $id = $marsoles->id;

$user = \DB::table('user')  ->where([   ['user_ncode', '=', $codmoshtari ] ,]) ->orderBy('id', 'desc')->first();
   $userid = $user->id;

DB::table('finicals')->insert([
    ['finical_marid' => $marsoles->id ,  'finical_pay' => $marsoles->mar_paypostturk ,    'finical_createdatdate' => $marsoles->mar_createdatdate ,   'finical_inc' =>  '3' ,   'finical_iduser' =>  $userid ,   'finical_arou' =>  '4' ,   'finical_marpay' =>  '5' ]
]); 



 	
$user = \DB::table('marsole')  ->where([   ['id', '=', $id ] ,]) ->orderBy('id', 'desc')->first();
$codmoshtari = $user->mar_codmoshtari;
$user = \DB::table('user')  ->where([   ['user_ncode', '=', $codmoshtari ] ,]) ->orderBy('id', 'desc')->first();	  	 
$elanatorders =  DB::table('elanatorders')  ->orderBy('id', 'desc')->first();
 if($elanatorders->elanord_recvturkmail == '1'){
 	if ( $user->user_email != '')  {
 $usernamee = $user->user_name; 
 $titmes='سفارش با موفقیت براورد قیمت باربری شد';
 $mestt='هزینه قابل پرداخت';
 $mesnot =  $marsoles->mar_paypostturk.' ريال '; 
   Mail::send('superadmin.mail', ['user' => $user , 'usernamee' => $usernamee, 'mesnot' => $mesnot, 'titmes' => $titmes , 'mestt' => $mestt], function ($m) use ($user) {
         

            $m->from('info@kargo.biz', 'کارگو');

            $m->to($user->user_email, $user->user_email)->subject('براورد قیمت باربری');
        }); 	
 }	 }	
 
 	
 if($elanatorders->elanord_recvturksms == '1'){	
    
$panelsms = \DB::table('panelsms')->where('id', '=',  1)  ->orderBy('id', 'desc')->first();
include(app_path().'/../sms/api_send_sms.php');
$message='با عرض سلام '.$user->user_name.' عزیز. سفارش با موفقیت براورد قیمت باربری شد';
if (($result = Send_SMS($panelsms->sms_username, $panelsms->sms_password, $panelsms->sms_fromnumber, $user->user_tell, $message , 0, false)) === '0')
{ 
		
	return view('superadmin.success');
} else if ($result !== '') {   
		
	return view('superadmin.success');
 }


 }
 







	
}


		  	$nametr = Session::flash('statust', 'سفارش با موفقیت براورد قیمت باربری شد. ');
		  	$nametrt = Session::flash('sessurl', 'viewssefaresh/order/'.$id.'');	

		 

return view('superadmin.success');


 
  	
	}	
else{ return redirect('superadmin/sign-in'); }
				}
	

	public function editorderidsup($id){
if (Session::has('signsuperadmin')){ 
 

$marsoles = \DB::table('user') 
->join('marsole', 'user.user_ncode', '=', 'marsole.mar_codmoshtari') 
->where([ 
    ['user.id', '<>', '0'] ,
    ['marsole.mar_status', '=', '0'] ,
    ['marsole.id', '=', $id ] ,])
    ->orderBy('marsole.id', 'desc')->get();
 foreach($marsoles as $marsol){ $creditcards=$marsol->mar_credcard;  }     
 
   
return view('superadmin.editorder', ['marsoles' => $marsoles   ]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}



	public function recveditpost($id , Request $request){
if (Session::has('signsuperadmin')){ 
 
 
$this->validate($request,[
    			'name' => 'required',
    			'codmoshtari' => 'required',
    			'vazn' => 'required',
    			'paypostturk' => 'required|numeric', 
    		],[  
    			'name.required' => 'لطفا نام مرسوله را وارد نمایید',
    			'codmoshtari.required' => 'لطفا کد مشتری را وارد نمایید', 
    			'vazn.required' => 'لطفا وزن مرسوله را وارد نمایید', 
    			'paypostturk.required' => 'لطفا هزینه باربری را وارد نمایید',   
    			'paypostturk.numeric' => 'لطفا هزینه باربری را بصورت صحیح وارد نمایید',       
    			
    		]);
    		
///
   
 $codmoshtari=$request->codmoshtari;
 $countuser = \DB::table('user')->where([
    [ 'user.user_ncode', '=', $codmoshtari ],  ])
    ->orderBy('id', 'desc')->count(); 
  if($countuser=='0'){
 	
$nametr = Session::flash('statust', ' کد مشتری وارد شده در سیستم وجود ندارد لطفا بررسی نمایید');
$nametrt = Session::flash('sessurl', 'viewssefaresh/order/'.$id.'/recvedit');
		  return view('superadmin.error'); 
 } else{
 
  	
     		
    		
if($request->paypostturk=='0' ){ $status='6'; $payment='1'; $datepay=date('Y-m-d H:i:s'); } else {   $status='5'; $payment='0';  $datepay='';  }


$maredit = \DB::table('marsole')  ->where([   ['id', '=', $id ] ,]) ->orderBy('id', 'desc')->first();  

$updatee = \DB::table('user') 
->join('marsole', 'user.user_ncode', '=', 'marsole.mar_codmoshtari') 
->where([ 
    ['user.id', '<>', '0'] , 
    ['marsole.id', '=', $id ] ,])
    ->update(['mar_vazn' => $request->vazn , 'mar_paypostturk' => $request->paypostturk , 'mar_status' => $status  , 'mar_name' => $request->name  ,'mar_codmoshtari'  =>   $request->codmoshtari    ]); 

$user = \DB::table('marsole')  ->where([   ['id', '=', $id ] ,]) ->orderBy('id', 'desc')->first();
$codmoshtari = $user->mar_codmoshtari;

$user = \DB::table('user')  ->where([   ['user_ncode', '=', $codmoshtari ] ,]) ->orderBy('id', 'desc')->first();
   $userid = $user->id;




if($maredit->mar_status=='4') {  
DB::table('finicals')->insert([
    ['finical_marid' => $id ,  'finical_pay' => $request->paypostturk ,    'finical_createdatdate' => date('Y-m-d H:i:s') ,   'finical_inc' =>  '3' ,   'finical_iduser' =>  $userid ,   'finical_arou' =>  '4' ,   'finical_marpay' =>  '5'  ,   'finical_payment' =>  $payment  ,   'finical_paymentdate' =>  $datepay ]
]); 
 }  elseif($maredit->mar_status=='5') { 
$updatee = \DB::table('finicals')  
->where([ 
    ['finicals.finical_marid', '=', $id] , 
    ['finicals.finical_marpay', '=', '5'] ,])
    ->update(['finical_pay' => $request->paypostturk ,  'finical_createdatdate' => date('Y-m-d H:i:s') ,   'finical_payment' =>  $payment  ,   'finical_paymentdate' =>  $datepay  ,   'finical_iduser' =>  $userid      ]); 	
    
 
    
 }






    
		  	$nametr = Session::flash('statust', 'سفارش با موفقیت براورد قیمت باربری شد. ');
		  	$nametrt = Session::flash('sessurl', 'viewssefaresh/order/'.$id.'');	

  	
		  	
$user = \DB::table('marsole')  ->where([   ['id', '=', $id ] ,]) ->orderBy('id', 'desc')->first();
$codmoshtari = $user->mar_codmoshtari;
$user = \DB::table('user')  ->where([   ['user_ncode', '=', $codmoshtari ] ,]) ->orderBy('id', 'desc')->first();	  	 
$elanatorders =  DB::table('elanatorders')  ->orderBy('id', 'desc')->first();
 if($elanatorders->elanord_recvturkmail == '1'){
 	if ( $user->user_email != '')  {
 $usernamee = $user->user_name; 
 $titmes='سفارش با موفقیت براورد قیمت باربری شد';
 $mestt='هزینه قابل پرداخت';
 $mesnot =  $request->paypostturk.' ريال '; 
   Mail::send('superadmin.mail', ['user' => $user , 'usernamee' => $usernamee, 'mesnot' => $mesnot, 'titmes' => $titmes , 'mestt' => $mestt], function ($m) use ($user) {
         

            $m->from('info@kargo.biz', 'کارگو');

            $m->to($user->user_email, $user->user_email)->subject('براورد قیمت باربری');
        }); 	
 }	 }	
 
 	
 if($elanatorders->elanord_recvturksms == '1'){	
    
$panelsms = \DB::table('panelsms')->where('id', '=',  1)  ->orderBy('id', 'desc')->first();
include(app_path().'/../sms/api_send_sms.php');
$message='با عرض سلام '.$user->user_name.' عزیز. سفارش با موفقیت براورد قیمت باربری شد';
if (($result = Send_SMS($panelsms->sms_username, $panelsms->sms_password, $panelsms->sms_fromnumber, $user->user_tell, $message , 0, false)) === '0')
{ 
		
	return view('superadmin.success');
} else if ($result !== '') {   
		
	return view('superadmin.success');
 }


 }
 
		  	


return view('superadmin.success' ); 
	}	
	}	
else{ return redirect('superadmin/sign-in'); }
				}



	public function editorderidsuppost($id , Request $request){
if (Session::has('signsuperadmin')){ 
 



$marsoles = \DB::table('user') 
->join('marsole', 'user.user_ncode', '=', 'marsole.mar_codmoshtari') 
->where([ 
    ['user.id', '<>', '0'] ,
    ['marsole.mar_status', '=', '0'] ,
    ['marsole.id', '=', $id ] ,])
    ->orderBy('marsole.id', 'desc')->first();

if($marsoles->mar_status=='0'){
	

$this->validate($request,[
    			'name' => 'required',
    			'usernamee' => 'required',
    			'passwordd' => 'required',
    			'link' => 'required', 
    			'des' => 'required', 
    		],[  
    			'name.required' => 'لطفا نام مرسوله را وارد نمایید', 
    			'usernamee.required' => 'لطفا نام کاربری را وارد نمایید',   
    			'passwordd.required' => 'لطفا رمزعبور را وارد نمایید',   
    			'link.required' => 'لطفا لینک را وارد نمایید',     
    			'des.required' => 'لطفا توضیحات سفارش را وارد نمایید',      
    			
    		]);
  

$updatee = \DB::table('user') 
->join('marsole', 'user.user_ncode', '=', 'marsole.mar_codmoshtari') 
->where([ 
    ['user.id', '<>', '0'] ,
    ['marsole.id', '=', $id ] ,])
    ->update(['mar_name' => $request->name , 'mar_username' => $request->usernamee , 'mar_password' => $request->passwordd , 'mar_link' => $request->link , 'mar_des' => $request->des    ]); 
    
    
		  	$nametr = Session::flash('statust', 'سفارش با موفقیت ویرایش شد. ');
		  	$nametrt = Session::flash('sessurl', 'viewssefaresh/order/'.$id.'');	

return view('superadmin.success', [ 'marsoles' => $marsoles   ]);
  
  
}

 

	}	
else{ return redirect('superadmin/sign-in'); }
				}




	public function editpayordpost($id , Request $request){
if (Session::has('signsuperadmin')){ 
 


$maredit = \DB::table('marsole')  ->where([   ['id', '=', $id ] ,]) ->orderBy('id', 'desc')->first();

$updatee = \DB::table('user') 
->join('marsole', 'user.user_ncode', '=', 'marsole.mar_codmoshtari') 
->where([ 
    ['user.id', '<>', '0'] ,
    ['marsole.mar_status', '=', '0'] ,
    ['marsole.id', '=', $id ] ,])
    ->update(['mar_paymarsole' => $request->paymarsole ,  'mar_status' => '1'    ]); 



$user = \DB::table('marsole')  ->where([   ['id', '=', $id ] ,]) ->orderBy('id', 'desc')->first();
$codmoshtari = $user->mar_codmoshtari;

$user = \DB::table('user')  ->where([   ['user_ncode', '=', $codmoshtari ] ,]) ->orderBy('id', 'desc')->first();
   $userid = $user->id;


if($maredit->mar_status=='0') {
	
	
$this->validate($request,[
    			'paymarsole' => 'required|numeric', 
    		],[  
    			'paymarsole.required' => 'لطفا هزینه مرسوله را وارد نمایید',  
    			'paymarsole.numeric' => 'لطفا هزینه مرسوله را بصورت صحیح وارد نمایید',       
    			
    		]);
  
	
DB::table('finicals')->insert([
    ['finical_marid' => $id ,  'finical_pay' => $request->paymarsole ,    'finical_createdatdate' => date('Y-m-d H:i:s') ,   'finical_inc' =>  '3' ,   'finical_iduser' => $userid ,   'finical_arou' =>  '4' ,   'finical_marpay' =>  '1' ]
]); 
	
}
 elseif($maredit->mar_status=='1') {
 
 
	
$this->validate($request,[
    			'paymarsole' => 'required|numeric', 
    			'name' => 'required', 
    		],[  
    			'paymarsole.required' => 'لطفا هزینه مرسوله را وارد نمایید',  
    			'paymarsole.numeric' => 'لطفا هزینه مرسوله را بصورت صحیح وارد نمایید', 
    			'name.required' => 'لطفا عنوان سفارش را وارد نمایید',       
    			
    		]);
 
  
 
$updatee = \DB::table('finicals')  
->where([ 
    ['finicals.finical_marid', '=', $id] , 
    ['finicals.finical_iduser', '=', $userid] ,
    ['finicals.finical_marpay', '=', '1'] ,])
    ->update(['finical_pay' => $request->paymarsole ,  'finical_createdatdate' => date('Y-m-d H:i:s')     ]); 	
 
$updatee = \DB::table('marsole')  
->where([ 
    ['marsole.id', '=', $id]   ,])
    ->update(['mar_paymarsole' => $request->paymarsole ,  'mar_name' => $request->name ,  'mar_createdatdate' => date('Y-m-d H:i:s')     ]); 	
 }


    
		  	$nametr = Session::flash('statust', 'سفارش باموفقیت تایید و براورد قیمت شد. ');
		  	$nametrt = Session::flash('sessurl', 'viewssefaresh/order/'.$id.'');

		  	 
$elanatorders =  DB::table('elanatorders')  ->orderBy('id', 'desc')->first();
 if($elanatorders->elanord_accordermail == '1'){
 	if ( $user->user_email != '')  {
 $usernamee = $user->user_name; 
 $titmes='سفارش شما با موفقیت تایید و براورد قیمت شد';
 $mestt='هزینه قابل پرداخت';
 $mesnot = $request->paymarsole.' ريال '; 
   Mail::send('superadmin.mail', ['user' => $user , 'usernamee' => $usernamee, 'mesnot' => $mesnot, 'titmes' => $titmes , 'mestt' => $mestt], function ($m) use ($user) {
         

            $m->from('info@kargo.biz', 'کارگو');

            $m->to($user->user_email, $user->user_email)->subject('تایید سفارش');
        }); 	
 }	 }	
 
 	
 if($elanatorders->elanord_accordersms == '1'){	
    
$panelsms = \DB::table('panelsms')->where('id', '=',  1)  ->orderBy('id', 'desc')->first();
include(app_path().'/../sms/api_send_sms.php');
$message='با عرض سلام '.$user->user_name.' عزیز.    سفارش شما با موفقیت تایید و براورد قیمت شد';
if (($result = Send_SMS($panelsms->sms_username, $panelsms->sms_password, $panelsms->sms_fromnumber, $user->user_tell, $message , 0, false)) === '0')
{ 
		
	return view('superadmin.success');
} else if ($result !== '') {   
		
	return view('superadmin.success');
 }


 }
 
		  	
		  	
		  	
		  	
		  	
		  	
		  	
		  	
		  	
		  	
		  		

return view('superadmin.success');
 

	}	
else{ return redirect('superadmin/sign-in'); }
				}



	public function editpayord($id){
if (Session::has('signsuperadmin')){ 
 

$marsoles = \DB::table('user') 
->join('marsole', 'user.user_ncode', '=', 'marsole.mar_codmoshtari') 
->where([ 
    ['user.id', '<>', '0'] , 
    ['marsole.id', '=', $id ] ,])
    ->orderBy('marsole.id', 'desc')->get();
    $creditcards=0;
 foreach($marsoles as $marsol){ $creditcards=$marsol->mar_credcard;  }     
$creditcards = \ DB::table('creditcard')->where([ 
    ['creditcard.id', '=', $creditcards] ,
    ['creditcard.id', '<>', '0' ] ,])
    ->orderBy('creditcard.id', 'desc')->first();
 
   
return view('superadmin.editpayord', ['marsoles' => $marsoles , 'creditcards' => $creditcards  ]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}



	public function recvedit($id){
if (Session::has('signsuperadmin')){ 
 

$marsoles = \DB::table('user') 
->join('marsole', 'user.user_ncode', '=', 'marsole.mar_codmoshtari') 
->where([ 
    ['user.id', '<>', '0'] , 
    ['marsole.id', '=', $id ] ,])
    ->orderBy('marsole.id', 'desc')->get();
    $creditcards=0;
 foreach($marsoles as $marsol){ $creditcards=$marsol->mar_credcard;  }     
$creditcards = \ DB::table('creditcard')->where([ 
    ['creditcard.id', '=', $creditcards] ,
    ['creditcard.id', '<>', '0' ] ,])
    ->orderBy('creditcard.id', 'desc')->first();
 
   
return view('superadmin.editpayord', ['marsoles' => $marsoles , 'creditcards' => $creditcards  ]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}


	public function acceptbuymajazi($id){
if (Session::has('signsuperadmin')){ 
 

$marsoles = \DB::table('user') 
->join('marsole', 'user.user_ncode', '=', 'marsole.mar_codmoshtari') 
->where([ 
    ['user.id', '<>', '0'] ,
    ['marsole.mar_status', '=', '2'] ,
    ['marsole.mar_arobuy', '=', '3'] ,
    ['marsole.id', '=', $id ] ,])
    ->orderBy('marsole.id', 'desc')->get();
    $creditcards=0;
 foreach($marsoles as $marsol){ $creditcards=$marsol->mar_credcard;  }     
$creditcards = \ DB::table('creditcard')->where([ 
    ['creditcard.id', '=', $creditcards] ,
    ['creditcard.id', '<>', '0' ] ,])
    ->orderBy('creditcard.id', 'desc')->first();
 
   
return view('superadmin.buymajazi', ['marsoles' => $marsoles , 'creditcards' => $creditcards  ]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}






	public function acceptbuymajazipost($id , Request $request){
if (Session::has('signsuperadmin')){ 
 

$this->validate($request,[
    			'des' => 'required', 
    		],[  
    			'des.required' => 'لطفا اطلاعات کالای مجازی را جهت هر نو بهره برداری کاربر ، وارد نمایید',        
    			
    		]);
  

$updatee = \DB::table('user') 
->join('marsole', 'user.user_ncode', '=', 'marsole.mar_codmoshtari') 
->where([ 
    ['user.id', '<>', '0'] ,
    ['marsole.mar_status', '=', '2'] ,
    ['marsole.id', '=', $id ] ,])
    ->update(['mar_desmajazi' => $request->des ,  'mar_status' => '10'    ]); 
    
    
		  	$nametr = Session::flash('statust', 'کالای مجازی خریداری شد و اطلاعات جهت بهره برداری کاربر در اختیار آن قرار گرفته شد. ');
		  	$nametrt = Session::flash('sessurl', 'viewssefaresh/order/'.$id.'');	


$user = \DB::table('marsole')  ->where([   ['id', '=', $id ] ,]) ->orderBy('id', 'desc')->first();
$codmoshtari = $user->mar_codmoshtari;
$user = \DB::table('user')  ->where([   ['user_ncode', '=', $codmoshtari ] ,]) ->orderBy('id', 'desc')->first();	  	 
$elanatorders =  DB::table('elanatorders')  ->orderBy('id', 'desc')->first();
 if($elanatorders->elanord_buyturkmail == '1'){
 	if ( $user->user_email != '')  {
 $usernamee = $user->user_name; 
 $titmes='کالای مجازی شما خریداری شد و اطلاعات آن در اختیار شما قرار گرفت';
 $mestt='';
 $mesnot = ''; 
   Mail::send('superadmin.mail', ['user' => $user , 'usernamee' => $usernamee, 'mesnot' => $mesnot, 'titmes' => $titmes , 'mestt' => $mestt], function ($m) use ($user) {
         

            $m->from('info@kargo.biz', 'کارگو');

            $m->to($user->user_email, $user->user_email)->subject('خرید سفارش مجازی');
        }); 	
 }	 }	
 
 	
 if($elanatorders->elanord_buyturksms == '1'){	
    
$panelsms = \DB::table('panelsms')->where('id', '=',  1)  ->orderBy('id', 'desc')->first();
include(app_path().'/../sms/api_send_sms.php');
$message='با عرض سلام '.$user->user_name.' عزیز.  کالای مجازی شما خریداری شد و اطلاعات آن در اختیار شما قرار گرفت';
if (($result = Send_SMS($panelsms->sms_username, $panelsms->sms_password, $panelsms->sms_fromnumber, $user->user_tell, $message , 0, false)) === '0')
{ 
		
	return view('superadmin.success');
} else if ($result !== '') {   
		
	return view('superadmin.success');
 }


 }
 


return view('superadmin.success');
  

	}	
else{ return redirect('superadmin/sign-in'); }
				}











	public function sendordadres($id){
if (Session::has('signsuperadmin')){ 
 

$marsoles = \DB::table('user') 
->join('marsole', 'user.user_ncode', '=', 'marsole.mar_codmoshtari') 
->where([ 
    ['user.id', '<>', '0'] ,
    ['marsole.mar_status', '=', '7'] ,
    ['marsole.id', '=', $id ] ,])
    ->orderBy('marsole.id', 'desc')->get();
    $creditcards=0;
 foreach($marsoles as $marsol){ $creditcards=$marsol->mar_credcard;  }     
$creditcards = \ DB::table('creditcard')->where([ 
    ['creditcard.id', '=', $creditcards] ,
    ['creditcard.id', '<>', '0' ] ,])
    ->orderBy('creditcard.id', 'desc')->first();
 
   
return view('superadmin.editpayordiran', ['marsoles' => $marsoles , 'creditcards' => $creditcards  ]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}





	public function sendordadrespost($id , Request $request){
if (Session::has('signsuperadmin')){ 
 
 
$this->validate($request,[ 
    			'paypostiran' => 'required|numeric', 
    		],[   
    			'paypostiran.required' => 'لطفا هزینه را وارد نمایید',   
    			'paypostiran.numeric' => 'لطفا هزینه را بصورت صحیح وارد نمایید',       
    			
    		]);
if($request->paypostiran=='0' ){ $status='10'; 
 $nametr = Session::flash('statust', 'سفارش شما با پس کرایه به آدرس پستی شما ارسال شد '); } else {
 $nametr = Session::flash('statust', 'هزینه پستی سفارش برآورد قیمت شد.  ');
		  				  	 $status='8';
$user = \DB::table('marsole')  ->where([   ['id', '=', $id ] ,]) ->orderBy('id', 'desc')->first();
$codmoshtari = $user->mar_codmoshtari;

$user = \DB::table('user')  ->where([   ['user_ncode', '=', $codmoshtari ] ,]) ->orderBy('id', 'desc')->first();
   $userid = $user->id;


DB::table('finicals')->insert([
    ['finical_marid' => $id ,  'finical_pay' => $request->paypostiran ,    'finical_createdatdate' => date('Y-m-d H:i:s') ,   'finical_inc' =>  '3' ,   'finical_iduser' =>  $userid ,   'finical_arou' =>  '4' ,   'finical_marpay' =>  '8' ]
]);  }

$updatee = \DB::table('user') 
->join('marsole', 'user.user_ncode', '=', 'marsole.mar_codmoshtari') 
->where([ 
    ['user.id', '<>', '0'] ,
    ['marsole.mar_status', '=', '7'] ,
    ['marsole.id', '=', $id ] ,])
   ->update(['mar_paypostiran' => $request->paypostiran , 'mar_status' => $status     ]); 
    
    

		  	$nametrt = Session::flash('sessurl', 'viewssefaresh/order/'.$id.'');	

  	
$user = \DB::table('marsole')  ->where([   ['id', '=', $id ] ,]) ->orderBy('id', 'desc')->first();
$codmoshtari = $user->mar_codmoshtari;
$user = \DB::table('user')  ->where([   ['user_ncode', '=', $codmoshtari ] ,]) ->orderBy('id', 'desc')->first();	  	 
$elanatorders =  DB::table('elanatorders')  ->orderBy('id', 'desc')->first();
 if($elanatorders->elanord_recviranmail == '1'){
 	if ( $user->user_email != '')  {
 $usernamee = $user->user_name; 
 
if($request->paypostiran=='0' ){ 
 $titmes='سفارش شما با پس کرایه به آدرس پستی شما ارسال شد';
 $mestt='';
 $mesnot = '';  } else { 
  $titmes='هزینه پستی سفارش برآورد قیمت شد';
 $mestt='مبلغ قابل پرداخت به ریال';
 $mesnot = $request->paypostiran.' ريال ';  }
 

 
   Mail::send('superadmin.mail', ['user' => $user , 'usernamee' => $usernamee, 'mesnot' => $mesnot, 'titmes' => $titmes , 'mestt' => $mestt], function ($m) use ($user) {
         

            $m->from('info@kargo.biz', 'کارگو');

            $m->to($user->user_email, $user->user_email)->subject('ارسال مرسوله بصورت پستی');
        }); 	
 }	 }	
 
 	
 if($elanatorders->elanord_recviransms == '1'){	
    
$panelsms = \DB::table('panelsms')->where('id', '=',  1)  ->orderBy('id', 'desc')->first();
include(app_path().'/../sms/api_send_sms.php');

if($request->paypostiran=='0' ){ $message='با عرض سلام '.$user->user_name.' عزیز. سفارش شما با پس کرایه به آدرس پستی شما ارسال شد'; } else { $message='با عرض سلام '.$user->user_name.' عزیز. هزینه پستی سفارش برآورد قیمت شد';  }



if (($result = Send_SMS($panelsms->sms_username, $panelsms->sms_password, $panelsms->sms_fromnumber, $user->user_tell, $message , 0, false)) === '0')
{ 
		
	return view('superadmin.success');
} else if ($result !== '') {   
		
	return view('superadmin.success');
 }


 }
 


return view('superadmin.success' ); 
	}	
else{ return redirect('superadmin/sign-in'); }
				}







	public function cancellordpost($id  , Request $request){
if (Session::has('signsuperadmin')){ 



$updatee = \DB::table('user') 
->join('marsole', 'user.user_ncode', '=', 'marsole.mar_codmoshtari') 
->where([ 
    ['user.id', '<>', '0'] , 
    ['marsole.id', '=', $id ] ,])
    ->update(['mar_status' => '3' , 'mar_descancel' =>$request->descancel   ]); 
    
		  	$nametr = Session::flash('statust', 'سفارش باموفقیت لغو شد. ');
		  	$nametrt = Session::flash('sessurl', 'viewssefaresh/order/'.$id.'');	

return view('superadmin.success' );




	}	
else{ return redirect('superadmin/sign-in'); }
				}



	public function cancellord($id){
if (Session::has('signsuperadmin')){ 


$marsoles = \DB::table('user') 
->join('marsole', 'user.user_ncode', '=', 'marsole.mar_codmoshtari') 
->where([ 
    ['user.id', '<>', '0'] , 
    ['marsole.id', '=', $id ] ,])
    ->orderBy('marsole.id', 'desc')->get();
    
    
return view('superadmin.cancelord', ['marsoles' => $marsoles    ]);

/*
$updatee = \DB::table('user') 
->join('marsole', 'user.user_ncode', '=', 'marsole.mar_codmoshtari') 
->where([ 
    ['user.id', '<>', '0'] ,
    ['marsole.mar_status', '<', '2'] ,
    ['marsole.id', '=', $id ] ,])
    ->update(['mar_status' => '3'   ]); 
    
		  	$nametr = Session::flash('statust', 'سفارش باموفقیت لغو شد. ');
		  	$nametrt = Session::flash('sessurl', 'viewssefaresh/order/'.$id.'');	

return view('superadmin.success' );
*/



	}	
else{ return redirect('superadmin/sign-in'); }
				}




	public function acceptbuy($id){
if (Session::has('signsuperadmin')){ 

$updatee = \DB::table('user') 
->join('marsole', 'user.user_ncode', '=', 'marsole.mar_codmoshtari') 
->where([ 
    ['user.id', '<>', '0'] ,
    ['marsole.mar_status', '=', '2'] ,
    ['marsole.id', '=', $id ] ,])
    ->update(['mar_status' => '4'   ]); 
    
		  	$nametr = Session::flash('statust', 'سفارش با موفقیت در ترکیه خریداری شد. ');
		  	$nametrt = Session::flash('sessurl', 'viewssefaresh/order/'.$id.'');	

  	
$user = \DB::table('marsole')  ->where([   ['id', '=', $id ] ,]) ->orderBy('id', 'desc')->first();
$codmoshtari = $user->mar_codmoshtari;
$user = \DB::table('user')  ->where([   ['user_ncode', '=', $codmoshtari ] ,]) ->orderBy('id', 'desc')->first();	  	 
$elanatorders =  DB::table('elanatorders')  ->orderBy('id', 'desc')->first();
 if($elanatorders->elanord_buyturkmail == '1'){
 	if ( $user->user_email != '')  {
 $usernamee = $user->user_name; 
 $titmes='سفارش با موفقیت در ترکیه خریداری شد';
 $mestt='';
 $mesnot = ''; 
   Mail::send('superadmin.mail', ['user' => $user , 'usernamee' => $usernamee, 'mesnot' => $mesnot, 'titmes' => $titmes , 'mestt' => $mestt], function ($m) use ($user) {
         

            $m->from('info@kargo.biz', 'کارگو');

            $m->to($user->user_email, $user->user_email)->subject('خرید سفارش');
        }); 	
 }	 }	
 
 	
 if($elanatorders->elanord_buyturksms == '1'){	
    
$panelsms = \DB::table('panelsms')->where('id', '=',  1)  ->orderBy('id', 'desc')->first();
include(app_path().'/../sms/api_send_sms.php');
$message='با عرض سلام '.$user->user_name.' عزیز.    سفارش با موفقیت در ترکیه خریداری شد';
if (($result = Send_SMS($panelsms->sms_username, $panelsms->sms_password, $panelsms->sms_fromnumber, $user->user_tell, $message , 0, false)) === '0')
{ 
		
	return view('superadmin.success');
} else if ($result !== '') {   
		
	return view('superadmin.success');
 }


 }
 
		  	

return view('superadmin.success' );

	}	
else{ return redirect('superadmin/sign-in'); }
				}





	public function sendordiran($id){
if (Session::has('signsuperadmin')){ 


$updatee = \DB::table('user') 
->join('marsole', 'user.user_ncode', '=', 'marsole.mar_codmoshtari') 
->where([ 
    ['user.id', '<>','0'] ,
    ['marsole.mar_status', '=', '6'] ,
    ['marsole.id', '=', $id ] ,])
    ->update(['mar_status' => '7'   ]); 
    
    
    
		  	
		  	$nametr = Session::flash('statust', 'مرسوله با موفقیت به سمت ایران ارسال شد  ');
		  	$nametrt = Session::flash('sessurl', 'viewssefaresh/order/'.$id.'');	

		  	
$user = \DB::table('marsole')  ->where([   ['id', '=', $id ] ,]) ->orderBy('id', 'desc')->first();
$codmoshtari = $user->mar_codmoshtari;
$user = \DB::table('user')  ->where([   ['user_ncode', '=', $codmoshtari ] ,]) ->orderBy('id', 'desc')->first();	  	 
$elanatorders =  DB::table('elanatorders')  ->orderBy('id', 'desc')->first();
 if($elanatorders->elanord_sendiranmail == '1'){
 	if ( $user->user_email != '')  {
 $usernamee = $user->user_name; 
 $titmes='مرسوله با موفقیت به سمت ایران ارسال شد';
 $mestt='';
 $mesnot = ''; 
   Mail::send('superadmin.mail', ['user' => $user , 'usernamee' => $usernamee, 'mesnot' => $mesnot, 'titmes' => $titmes , 'mestt' => $mestt], function ($m) use ($user) {
         

            $m->from('info@kargo.biz', 'کارگو');

            $m->to($user->user_email, $user->user_email)->subject('ارسال مرسوله به سمت ایران');
        }); 	
 }	 }	
 
 	
 if($elanatorders->elanord_sendiransms == '1'){	
    
$panelsms = \DB::table('panelsms')->where('id', '=',  1)  ->orderBy('id', 'desc')->first();
include(app_path().'/../sms/api_send_sms.php');
$message='با عرض سلام '.$user->user_name.' عزیز. مرسوله با موفقیت به سمت ایران ارسال شد';
if (($result = Send_SMS($panelsms->sms_username, $panelsms->sms_password, $panelsms->sms_fromnumber, $user->user_tell, $message , 0, false)) === '0')
{ 
		
	return view('superadmin.success');
} else if ($result !== '') {   
		
	return view('superadmin.success');
 }


 }
 
		  	
		  	
return view('superadmin.success' );	 
	 
	}	
else{ return redirect('superadmin/sign-in'); }
				}
	




		
	public function recvordfinal($id){
if (Session::has('signsuperadmin')){ 

 	
$updatee = \DB::table('user') 
->join('marsole', 'user.user_ncode', '=', 'marsole.mar_codmoshtari') 
->where([ 
    ['user.id', '<>','0'] ,
    ['marsole.mar_status', '=', '10'] ,
    ['marsole.id', '=', $id ] ,])
    ->update(['mar_status' => '11' ,   'mar_daterecv' =>  date('Y-m-d H:i:s')   ]); 
    
    
		  	$nametr = Session::flash('statust', 'سفارش با موفقیت تحویل مشتری شد  ');
		  	$nametrt = Session::flash('sessurl', 'viewssefaresh/order/'.$id.'');	


$user = \DB::table('marsole')  ->where([   ['id', '=', $id ] ,]) ->orderBy('id', 'desc')->first();
$codmoshtari = $user->mar_codmoshtari;
$user = \DB::table('user')  ->where([   ['user_ncode', '=', $codmoshtari ] ,]) ->orderBy('id', 'desc')->first();	  	 
$elanatorders =  DB::table('elanatorders')  ->orderBy('id', 'desc')->first();
 if($elanatorders->elanord_recvordmail == '1'){
 	if ( $user->user_email != '')  {
 $usernamee = $user->user_name; 
 $titmes='سفارش با موفقیت تحویل شما گردید';
 $mestt='';
 $mesnot = ''; 
   Mail::send('superadmin.mail', ['user' => $user , 'usernamee' => $usernamee, 'mesnot' => $mesnot, 'titmes' => $titmes , 'mestt' => $mestt], function ($m) use ($user) {
         

            $m->from('info@kargo.biz', 'کارگو');

            $m->to($user->user_email, $user->user_email)->subject('تحویل مرسوله خدمت کاربر');
        }); 	
 }	 }	
 
 	
 if($elanatorders->elanord_recvordsms == '1'){	
    
$panelsms = \DB::table('panelsms')->where('id', '=',  1)  ->orderBy('id', 'desc')->first();
include(app_path().'/../sms/api_send_sms.php');
$message='با عرض سلام '.$user->user_name.' عزیز. سفارش با موفقیت تحویل شما گردید';
if (($result = Send_SMS($panelsms->sms_username, $panelsms->sms_password, $panelsms->sms_fromnumber, $user->user_tell, $message , 0, false)) === '0')
{ 
		
	return view('superadmin.success');
} else if ($result !== '') {   
		
	return view('superadmin.success');
 }


 }
 

	return view('superadmin.success' );
	 
	}	
else{ return redirect('superadmin/sign-in'); }
				}
	

 


	public function sendfinaly($id){
if (Session::has('signsuperadmin')){ 


$updatee = \DB::table('user') 
->join('marsole', 'user.user_ncode', '=', 'marsole.mar_codmoshtari') 
->where([ 
    ['user.id', '<>','0'] ,
    ['marsole.mar_status', '=', '9'] ,
    ['marsole.id', '=', $id ] ,])
    ->update(['mar_status' => '10'   ]); 
    
    
    
		  	
		  	$nametr = Session::flash('statust', 'مرسوله با موفقیت به سمت آدرس پستی ارسال شد  ');
		  	$nametrt = Session::flash('sessurl', 'viewssefaresh/order/'.$id.'');	
		  	
		  	
$user = \DB::table('marsole')  ->where([   ['id', '=', $id ] ,]) ->orderBy('id', 'desc')->first();
$codmoshtari = $user->mar_codmoshtari;
$user = \DB::table('user')  ->where([   ['user_ncode', '=', $codmoshtari ] ,]) ->orderBy('id', 'desc')->first();	  	 
$elanatorders =  DB::table('elanatorders')  ->orderBy('id', 'desc')->first();
 if($elanatorders->elanord_sendordmail == '1'){
 	if ( $user->user_email != '')  {
 $usernamee = $user->user_name; 
 $titmes='مرسوله با موفقیت به سمت آدرس پستی ارسال شد';
 $mestt='';
 $mesnot = ''; 
   Mail::send('superadmin.mail', ['user' => $user , 'usernamee' => $usernamee, 'mesnot' => $mesnot, 'titmes' => $titmes , 'mestt' => $mestt], function ($m) use ($user) {
         

            $m->from('info@kargo.biz', 'کارگو');

            $m->to($user->user_email, $user->user_email)->subject('ارسال مرسوله به سمت آدرس پستی');
        }); 	
 }	 }	
 
 	
 if($elanatorders->elanord_sendordsms == '1'){	
    
$panelsms = \DB::table('panelsms')->where('id', '=',  1)  ->orderBy('id', 'desc')->first();
include(app_path().'/../sms/api_send_sms.php');
$message='با عرض سلام '.$user->user_name.' عزیز. مرسوله با موفقیت به سمت آدرس پستی ارسال شد';
if (($result = Send_SMS($panelsms->sms_username, $panelsms->sms_password, $panelsms->sms_fromnumber, $user->user_tell, $message , 0, false)) === '0')
{ 
		
	return view('superadmin.success');
} else if ($result !== '') {   
		
	return view('superadmin.success');
 }


 }
 
		  	
		  	
return view('superadmin.success' );	 
	 
	}	
else{ return redirect('superadmin/sign-in'); }
				}
	


  
	 
	 


		
	public function addcreditcard(){
if (Session::has('signsuperadmin')){ return view('superadmin.addcreditcard');}	
else{ return redirect('superadmin/sign-in'); }
				}
			




public function addcreditcardpost(Request $request){
if (Session::has('signsuperadmin')){    	    	
    	$this->validate($request,[
    			'name' => 'required|min:3|max:99|unique:creditcard,crd_name,$request->name',
    			'price' => 'required|numeric'
    		],[
    			'name.required' => 'لطفا نام کریدت کارت را وارد نمایید ',
    			'name.min' => 'نام کریدت کارت کوتاه است',
    			'name.max' => ' نام کریدت کارت طولانی است',
    			'name.unique' => 'این نام قبلا انتخاب شده است',
    			'price.required' => 'لطفا قیمت را وارد نمایید',
    			'price.numeric' => 'لطفا قیمت را براساس ریال و بصورت عددی وارد نمایید ',
    			
    		]);   
     			
DB::table('creditcard')->insert([
    ['crd_name' => $request->name , 'crd_price' => $request->price ,  'crd_active' => 1 ,   'crd_createdatdate' =>  date('Y-m-d H:i:s')    ]
]); 
 

$nametr = Session::flash('statust', 'کردیت بانک باموفقیت ثبت شد.');
$nametrt = Session::flash('sessurl', 'viewcriditcard');
		  return view('superadmin.success'); 	    	 }	
else{ return redirect('superadmin/sign-in'); }    	  
}
	




		
	public function viewcriditcard(){
if (Session::has('signsuperadmin')){ 


$admins = \DB::table('creditcard') 
->where([
    ['creditcard.id', '<>', 0],  ])
    ->orderBy('creditcard.id', 'desc')->get();

 
    
return view('superadmin.viewcriditcard', ['admins' => $admins  ]);
	
	}	
else{ return redirect('superadmin/sign-in'); }
				}
	
	



		
	public function editcriditcard($id){
if (Session::has('signsuperadmin')){ 

$admins = \DB::table('creditcard') 
->where([
    ['creditcard.id', '=', $id],  ])
    ->orderBy('creditcard.id', 'desc')->get();

 
    
return view('superadmin.editcrcard', ['admins' => $admins  ]);
	
	}	
else{ return redirect('superadmin/sign-in'); }
				}
	
	
		
	public function editcriditcardpost($id, Request $request ){
if (Session::has('signsuperadmin')){ 



  	$this->validate($request,[
    			'name' => 'required',
    			'price' => 'required|numeric',
    		],[
    			'name.required' => 'لطفا نام را وارد نمایید',
    			'price.required' => 'لطفا قیمت را وارد نمایید',
    			'price.numeric' => 'فرمت قیمت را بصورت صحیح وارد نمایید', 
    			
    		]); 
 
 
$updatee = \DB::table('creditcard')->where('id', '=', $id)  ->update(['crd_name' => $request->name , 'crd_price' => $request->price , 'crd_createdatdate' =>   date('Y-m-d H:i:s') ]); 
 

 
		  	$nametr = Session::flash('statust', 'کردیت کارت باموفقیت ویرایش شد.');
		  	$nametrt = Session::flash('sessurl', 'viewcriditcard');
	return view('superadmin.success');	
	
	}	
else{ return redirect('superadmin/sign-in'); }
				}
	
	


	public function statuscriditcard($id){
		if (Session::has('signsuperadmin')){ 	
		

$admins = \ DB::table('creditcard')->where('id', $id)->first();			
if($admins->crd_active=='0'){
$updatee = \DB::table('creditcard')->where('id', '=', $id)  ->update(['crd_active' => 1   ]);  		
		  	$nametr = Session::flash('statust', 'کردیت بانک با موفقیت فعال شد.');
		  	$nametrt = Session::flash('sessurl', 'viewcriditcard');
} else {
$updatee = \DB::table('creditcard')->where('id', '=', $id)  ->update(['crd_active' => 0   ]);  		
		  	$nametr = Session::flash('statust', 'کردیت بانک با موفقیت غیرفعال شد ');
		  	$nametrt = Session::flash('sessurl', 'viewcriditcard');	
}		
		  	
	return view('superadmin.success', ['admins' => $admins]);	
	}	
else{ return redirect('superadmin/sign-in'); }
				}
					



	public function deletcreditcart($id){
		if (Session::has('signsuperadmin')){ 
		  	$admins = \ DB::table('creditcard')->where('id', $id)->get();
		  	$admins = \DB::table('creditcard')->where('id', '=', $id)->delete(); 
		  	$nametr = Session::flash('statust', 'حذف کردیت بانک با موفقیت انجام شد. ');
		  	$nametrt = Session::flash('sessurl', 'viewcriditcard');
		  	
	return view('superadmin.success', ['admins' => $admins]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}
		


	
	
 
		
	public function addlevel(){
if (Session::has('signsuperadmin')){ return view('superadmin.addlevel');}	
else{ return redirect('superadmin/sign-in'); }
				}




public function addlevelPost(Request $request){
if (Session::has('signsuperadmin')){    	    	
    	$this->validate($request,[
    			'name' => 'required|min:3|max:66|unique:level,level_name,$request->name'
    		],[
    			'name.required' => 'لطفا نام سطح را وارد نمایید',
    			'name.min' => 'نام سطح کوتاه است',
    			'name.max' => ' نام سطح معتبر نیست',
    			'name.unique' => 'نام سطح قبلا در سیستم ثبت شده است',
    			
    		]);   
     			
DB::table('level')->insert([
    ['level_name' => $request->name ,  'level_active' => 0    ]
]); 

$users = DB::table('level')->where('level_name', $request->name)->first();
$userscou = DB::table('level')->where('level_name', $request->name)->count();

$nametr = Session::flash('statust', 'سطح دسترسی با موفقیت ثبت شد.');
$nametrt = Session::flash('sessurl', 'viewslevels');
		  return view('superadmin.success'); 	    	 }	
else{ return redirect('superadmin/sign-in'); }    	  
}
	











		
		
	public function viewslevels(){
if (Session::has('signsuperadmin')){ 
$admins = \DB::table('level') ->orderBy('id', 'desc')->get();
return view('superadmin.viewslevels', ['admins' => $admins]);
}	
else{ return redirect('superadmin/sign-in'); }
}		






	public function editlevels($id){
if (Session::has('signsuperadmin')){ 
	Session::put('idimg', $id);
	
$admins = \DB::table('level')
->where('id', '=', $id)  ->orderBy('id', 'desc')->get();
	 
$levels = \DB::table('level')->where('id', '=', $id)  ->orderBy('id', 'desc')->get();
$periods = \DB::table('period')->where('period_level', '=', $id)   ->orderBy('id', 'desc')->get();

return view('superadmin.editlevel', ['admins' => $admins , 'levels' => $levels, 'periods' => $periods  ]);
 }	else{ return redirect('superadmin/sign-in'); }
}



		
	public function editlevelsPost($id  , Request $request ){
if (Session::has('signsuperadmin')){ 
$this->validate($request,[
    			'name' => 'required|min:3|max:35'
    		],[
    			'name.required' => 'لطفا نام سطح را وارد نمایید',
    			'name.min' => 'نام سطح کوتاه است',
    			'name.max' => 'نام سطح معتبر نیست',
    		]);   
$updatee = \DB::table('level')->where('id', '=', $id)  ->update(['level_name' => $request->name    ]); 
$nametr = Session::flash('statust', 'سطح با موفقیت ویرایش شد.');
$nametrt = Session::flash('sessurl', 'viewslevels/editlevel/'.$id.'');
return view('superadmin.success');
}	else{ return redirect('superadmin/sign-in'); }
}
	







	
	public function deletlevel($id){
		if (Session::has('signsuperadmin')){ 
		  	$admins = \ DB::table('level')->where('id', $id)->get();
		  	$admins = \DB::table('level')->where('id', '=', $id)->delete();
		  	$admins = \DB::table('period')->where('period_level', '=', $id)->delete();
		  	$admins = \DB::table('term')->where('term_level', '=', $id)->delete();
		  	$admins = \DB::table('clas')->where('clas_level', '=', $id)->delete();
		  	$admins = \DB::table('sision')->where('sision_level', '=', $id)->delete();
		  	$nametr = Session::flash('statust', 'حذف سطح دسترسی با موفقیت انجام شد.');
		  	$nametrt = Session::flash('sessurl', 'viewslevels');
		  	
	return view('superadmin.success', ['admins' => $admins]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}
		
			
	public function acclevel($id){
		if (Session::has('signsuperadmin')){ 				
$updatee = \DB::table('level')->where('id', '=', $id)  ->update(['level_active' => 1   ]); 
		  	$admins = \ DB::table('level')->where('id', $id)->get();				
		  	$nametr = Session::flash('statust', 'سطح دسترسی با موفقیت فعال شد.');
		  	$nametrt = Session::flash('sessurl', 'viewslevels');		  	
	return view('superadmin.success', ['admins' => $admins]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}
				
		
			
	public function rejlevel($id){
		if (Session::has('signsuperadmin')){ 				
$updatee = \DB::table('level')->where('id', '=', $id)  ->update(['level_active' => 0   ]); 
		  	$admins = \ DB::table('level')->where('id', $id)->get();				
		  	$nametr = Session::flash('statust', ' سطح دسترسی باموفقیت غیرفعال شد.');
		  	$nametrt = Session::flash('sessurl', 'viewslevels');		  	
	return view('superadmin.success', ['admins' => $admins]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}
					

		
	public function addperiod(){
if (Session::has('signsuperadmin')){
	
$admins = \DB::table('level') ->orderBy('id', 'desc')->get();
return view('superadmin.addperiod', ['admins' => $admins]);

	 }	
else{ return redirect('superadmin/sign-in'); }
				}




public function addperioddPost(Request $request){
if (Session::has('signsuperadmin')){    	    	
    	$this->validate($request,[
    			'name' => 'required|min:5|max:35|unique:period,period_name,$request->name',
    			'level' => 'required',
    			'pcal4' => 'required',
    			'extra4' => 'required|date',
    			'des' => 'required|min:5|max:333'
    		],[
    			'name.required' => 'لطفا نام دوره را وارد نمایید',
    			'name.min' => ' نام دوره کوتاه است',
    			'name.max' => ' نام دوره معتبر نیست',
    			'name.unique' => 'نام دوره قبلا در سیستم ثبت شده است',
    			'level.required' => 'سطح دسترسی را انتخاب نمایید',
    			'pcal4.required' => 'لطفا تاریخ را وارد نمایید',
    			'extra4.required' => 'پر کردن فیلد تاریخ اجباری است',
    			'extra4.date' => 'فرمت تاریخ اشتباه است',
    			'des.required' => 'جزییات دوره را وارد نمایید',
    			'des.min' => 'توضیحات دوره کوتاه است',
    			'des.mx' => 'توضیحات دوره طولانی است',
    		]);   

 
 if(date('Y-m-d H:i:s') > $request->extra4 ){
$nrepeatl = Session::flash('repeat', '1');
return redirect('superadmin/addperiod'); }else  {
	
	  			
DB::table('period')->insert([
    ['period_name' => $request->name ,  'period_des' => $request->des , 'period_startdate' => $request->extra4 ,'period_level' => $request->level ,   'period_createdatdate' =>  date('Y-m-d H:i:s')  ]
]); 

$users = DB::table('period')->where('period_name', $request->name)->first();
$userscou = DB::table('period')->where('period_name', $request->name)->count();

$nametr = Session::flash('statust', 'ثبت دوره با موفقیت انجام شد.');
$nametrt = Session::flash('sessurl', 'viewsperiods');
		  return view('superadmin.success'); 	   }	  
		   	 	
}else{ return redirect('superadmin/sign-in'); }    	  
}
	
	

		
		
	public function viewsperiods(){
if (Session::has('signsuperadmin')){ 
$admins = \DB::table('level')
->join('period', 'level.id', '=', 'period.period_level')
->orderBy('period.id', 'desc')->get();

return view('superadmin.viewsperiods', ['admins' => $admins ]);
}	
else{ return redirect('superadmin/sign-in'); }
}		



	public function editperiods($id){
if (Session::has('signsuperadmin')){ 
	Session::put('idimg', $id);
	
$admins = \DB::table('level')
->join('period', 'level.id', '=', 'period.period_level')
->where('period.id', '=', $id)  ->orderBy('period.id', 'desc')->get();
	 
$levels = \DB::table('level') ->orderBy('id', 'desc')->get();
$terms = \DB::table('term')->where('term_period', '=', $id)   ->orderBy('id', 'desc')->get();

return view('superadmin.editperiod', ['admins' => $admins , 'levels' => $levels, 'terms' => $terms  ]);
 }	else{ return redirect('superadmin/sign-in'); }
}



		
	public function editperiodPost($id  , Request $request ){
if (Session::has('signsuperadmin')){ 
    	$this->validate($request,[
    			'name' => 'required|min:5|max:35',
    			'level' => 'required',
    			'pcal4' => 'required',
    			'extra4' => 'required|date',
    			'des' => 'required|min:5|max:333'
    		],[
    			'name.required' => 'لطفا نام دوره را وارد نمایید',
    			'name.min' => ' نام دوره کوتاه است',
    			'name.max' => ' نام دوره معتبر نیست',
    			'name.unique' => 'نام دوره قبلا در سیستم ثبت شده است',
    			'level.required' => 'سطح دسترسی را انتخاب نمایید',
    			'pcal4.required' => 'لطفا تاریخ را وارد نمایید',
    			'extra4.required' => 'پر کردن فیلد تاریخ اجباری است',
    			'extra4.date' => 'فرمت تاریخ اشتباه است',
    			'des.required' => 'جزییات دوره را وارد نمایید',
    			'des.min' => 'توضیحات دوره کوتاه است',
    			'des.mx' => 'توضیحات دوره طولانی است',
    		]);   

 
 if(date('Y-m-d H:i:s') > $request->extra4 ){
$nrepeatl = Session::flash('repeat', '1');
return redirect('superadmin/viewsperiods/editperiod/'.$id.''); }else  {
	 
$updatee = \DB::table('period')->where('id', '=', $id)  ->update(['period_name' => $request->name , 'period_des' => $request->des , 'period_startdate' => $request->extra4 , 'period_level' => $request->level  ]); 
$admins = \DB::table('period')->where('id', '=', $id)  ->orderBy('id', 'desc')->get();
$nametr = Session::flash('statust', 'دوره با موفقیت ویرایش شد.'); }
$nametrt = Session::flash('sessurl', 'viewsperiods/editperiod/'.$id.'');
return view('superadmin.success');
}	else{ return redirect('superadmin/sign-in'); }
}
	


public function dropzoneStoreperid(Request $request)
    {
        $image = $request->file('file');
        $imageName = time().$image->getClientOriginalName();
        $image->move(public_path('images'),$imageName);        
$updatee = \DB::table('period')->where('id', '=', Session::get('idimg'))  ->update(['period_img' => $imageName   ]); 
        return response()->json(['success'=>$imageName]);
    }
		


	
	public function deletperiod($id){
		if (Session::has('signsuperadmin')){
			
		  	$admins = \DB::table('period')->where('id', '=', $id)->delete();
		  	$admins = \DB::table('term')->where('term_period', '=', $id)->delete();
		  	$admins = \DB::table('clas')->where('clas_period', '=', $id)->delete();
		  	$admins = \DB::table('sision')->where('sision_period', '=', $id)->delete();
		  	
		  	$nametr = Session::flash('statust', 'حذف دوره باموفقیت انجام شد.');
		  	$nametrt = Session::flash('sessurl', 'viewsperiods');
		  	
	return view('superadmin.success', ['admins' => $admins]);
	}	else{ return redirect('superadmin/sign-in'); }
				}
		
			
	public function accperiod($id){
		if (Session::has('signsuperadmin')){ 				
$updatee = \DB::table('period')->where('id', '=', $id)  ->update(['period_active' => 1   ]); 
		  	$admins = \ DB::table('period')->where('id', $id)->get();				
		  	$nametr = Session::flash('statust', 'دوره با موفقیت فعال شد.');
		  	$nametrt = Session::flash('sessurl', 'viewsperiods/editperiod/'.$id.'');		  	
	return view('superadmin.success', ['admins' => $admins]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}
				
		
			
	public function rejperiod($id){
		if (Session::has('signsuperadmin')){ 				
$updatee = \DB::table('period')->where('id', '=', $id)  ->update(['period_active' => 0   ]); 
		  	$admins = \ DB::table('period')->where('id', $id)->get();				
		  	$nametr = Session::flash('statust', 'دوره با موفقیت غیرفعال شد.');
		  	$nametrt = Session::flash('sessurl', 'viewsperiods/editperiod/'.$id.'');		  	
	return view('superadmin.success', ['admins' => $admins]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}



	public function addterm($id){
if (Session::has('signsuperadmin')){	

$admins = \ DB::table('period')->where('id', $id)->get();
$wlevel = \ DB::table('period')->where('id', $id)->first();
$termspsc = \ DB::table('term')->where('term_period', $id)->orderBy('id', 'desc')->count();
$termsps = \ DB::table('term')->where('term_period', $id)->orderBy('id', 'desc')->first();

return view('superadmin.addterm', ['admins' => $admins , 'termsps' => $termsps , 'termspsc' => $termspsc, 'wlevel' => $wlevel]);
	 }	
else{ return redirect('superadmin/sign-in'); }
				}





public function addtermpost($id , Request $request){
if (Session::has('signsuperadmin')){    	    	
    	$this->validate($request,[
    			'term' => 'required|numeric|max:10',
    			'pcal4' => 'required',
    			'extra4' => 'required|date',
    			'extra4' => 'date',
    		],[
    			'term.required' => 'لطفا ترم را وارد نمایید',
    			'term.numeric' => 'ترم را بصورت عددی وارد نمایید',
    			'term.max' => 'ترم وارد شده نامعتبر است',
    			'pcal4.required' => 'لطفا تاریخ را وارد نمایید',
    			'extra4.required' => 'پر کردن فیلد تاریخ اجباری است',
    			'extra4.date' => 'فرمت تاریخ اشتباه است',
    		]);   

 if($request->startperiod  > $request->extra4 ){
$nrepeatl = Session::flash('repeat', '1');
return redirect('superadmin/addterm/'.$id.''); }else  {    		
    			
    			
DB::table('term')->insert([
    ['term_number' => $request->term , 'term_level' => $request->wlevel ,  'term_period' => $id , 'term_startdate' => $request->extra4   ,   'term_createdatdate' =>  date('Y-m-d H:i:s')  ]
]); 
 

$nametr = Session::flash('statust', 'ترم با موفقیت ثبت شد.');
$nametrt = Session::flash('sessurl', 'viewsperiods/editperiod/'.$id.'');
		  return view('superadmin.success'); 	    	 }	
}else{ return redirect('superadmin/sign-in'); }    	  
}
	
	



	public function editterm($id){
if (Session::has('signsuperadmin')){ 
	Session::put('idimg', $id);
	
		
$admins = \DB::table('period')
->join('term', 'period.id', '=', 'term.term_period')
->where('term.id', '=', $id)  ->orderBy('term.id', 'desc')->get();

$plts = \DB::table('lesson')
->join('perslesonterm', 'lesson.id', '=', 'perslesonterm.plt_lesson')
->where('perslesonterm.plt_term', '=', $id)  ->orderBy('perslesonterm.id', 'desc')->get();

$clases = \DB::table('lesson')
->join('clas', 'lesson.id', '=', 'clas.clas_lesson')
->where('clas.clas_term', '=', $id)  ->orderBy('clas.id', 'desc')->get();
	 
$levels = \DB::table('period') ->orderBy('id', 'desc')->get();
$terms = \DB::table('term')->where('id', '=', $id)   ->orderBy('id', 'desc')->get();
$lessons=\DB::table('lesson')->where('lesson_active', '=', 1)   ->orderBy('id', 'desc')->get();

$wperiod = \ DB::table('term')->where('id', $id)->first();
$wlevel = \ DB::table('period')->where('id', $wperiod->term_period)->first();


return view('superadmin.editterm', ['admins' => $admins , 'levels' => $levels, 'terms' => $terms , 'lessons' => $lessons , 'plts' => $plts  , 'clases' => $clases  , 'wperiod' => $wperiod , 'wlevel' => $wlevel    ]); }	
else{ return redirect('superadmin/sign-in'); }
}



	
	public function deletplt($id){
		if (Session::has('signsuperadmin')){ 
		  	$admins = \ DB::table('perslesonterm')->where('id', $id)->get();
		  	$admins = \DB::table('perslesonterm')->where('id', '=', $id)->delete();
		  	$nametr = Session::flash('statust', 'درس ارائه شده با موفقیت حذف شد.');
		  	$nametrt = Session::flash('sessurl', 'viewsperiods');
		  	
	return view('superadmin.success', ['admins' => $admins]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}




public function edittermpersent($id , Request $request){
if (Session::has('signsuperadmin')){    	    	
    	$this->validate($request,[
    			'name' => 'required|max:10',
    		],[
    			'name.required' => 'لطفا درس را وارد نمایید',
    			'name.max' => 'درس وارد شده نامعتبر است',
    		]);   


$count = \ DB::table('perslesonterm')->where([['plt_lesson', '=',  $request->name ],['plt_term', '=', $id], ])  ->orderBy('id', 'desc')->count();

if($count!='0'){ 
$nrepeatl = Session::flash('repeat', '1');
return redirect('superadmin/viewsterm/editterm/'.$id.''); }else if($count=='0'){
    			
DB::table('perslesonterm')->insert([
    ['plt_lesson' => $request->name ,  'plt_term' => $id   ,   'plt_createdatdate' =>  date('Y-m-d H:i:s')  ]
]); 
 
$nametr = Session::flash('statust', 'درس با موفقیت ارائه شد.');
$nametrt = Session::flash('sessurl', 'viewsterm/editterm/'.$id.'');
		  return view('superadmin.success'); 	    	 }	
}else{ return redirect('superadmin/sign-in'); }    	  
}
	
	

public function addclasterm($id , Request $request){
if (Session::has('signsuperadmin')){    	    	
    	$this->validate($request,[
    			'name' => 'required|max:10',
    		],[
    			'name.required' => 'لطفا درس را وارد نمایید',
    			'name.max' => 'درس وارد شده نامعتبر است',
    		]);   


$count = \ DB::table('clas')->where([['clas_lesson', '=',  $request->name ],['clas_term', '=', $id],['clas_period', '=', $request->wperiod],['clas_level', '=', $request->wlevel], ])  ->orderBy('id', 'desc')->count();

if($count!='0'){ 
$nrepeatl = Session::flash('repeatb', '1');
return redirect('superadmin/viewsterm/editterm/'.$id.''); }else if($count=='0'){

$lesonname = \ DB::table('lesson')->where([['id', '=',  $request->name ], ])  ->orderBy('id', 'desc')->first();
    			
DB::table('clas')->insert([
    ['clas_lesson' => $request->name , 'clas_name' => $lesonname->lesson_name ,  'clas_period' => $request->wperiod ,  'clas_level' => $request->wlevel ,  'clas_term' => $id   ,   'clas_createdatdate' =>  date('Y-m-d H:i:s')  ]
]); 
 
$nametr = Session::flash('statust', 'کلاس با موفقیت ثبت شد.');
$nametrt = Session::flash('sessurl', 'viewsterm/editterm/'.$id.'');
		  return view('superadmin.success'); 	    	 }	
}else{ return redirect('superadmin/sign-in'); }    	  
}
	
	

	
	public function deletterm($id){
		if (Session::has('signsuperadmin')){ 
		
		  	$admins = \DB::table('term')->where('id', '=', $id)->delete();
		  	$admins = \DB::table('clas')->where('clas_term', '=', $id)->delete();
		  	$admins = \DB::table('sision')->where('sision_term', '=', $id)->delete();
		
		  	$nametr = Session::flash('statust', 'حذف ترم با موفقیت انجام شد.');
		  	$nametrt = Session::flash('sessurl', 'viewsperiods');
		  	
	return view('superadmin.success', ['admins' => $admins]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}


	public function accterm($id){
		if (Session::has('signsuperadmin')){ 				
$updatee = \DB::table('term')->where('id', '=', $id)  ->update(['term_active' => 1   ]); 
		  	$admins = \ DB::table('term')->where('id', $id)->get();				
		  	$nametr = Session::flash('statust', 'ترم با موفقیت فعال شد.');
		  	$nametrt = Session::flash('sessurl', 'viewsterm/editterm/'.$id.'');		  	
	return view('superadmin.success', ['admins' => $admins]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}
				

		
	


	public function rejterm($id){
		if (Session::has('signsuperadmin')){ 				
$updatee = \DB::table('term')->where('id', '=', $id)  ->update(['term_active' => 0   ]); 
		  	$admins = \ DB::table('term')->where('id', $id)->get();				
		  	$nametr = Session::flash('statust', 'ترم با موفقیت غیر فعال شد.');
		  	$nametrt = Session::flash('sessurl', 'viewsterm/editterm/'.$id.'');		  	
	return view('superadmin.success', ['admins' => $admins]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}
				

		
		
	public function addlesson(){
if (Session::has('signsuperadmin')){ return view('superadmin.addlesson');}	
else{ return redirect('superadmin/sign-in'); }
				}




public function addlessonPost(Request $request){
if (Session::has('signsuperadmin')){    	    	
    	$this->validate($request,[
    			'name' => 'required|min:3|max:66|unique:lesson,lesson_name,$request->name'
    		],[
    			'name.required' => 'لطفا نام درس را وارد نمایید',
    			'name.min' => 'نام درس کوتاه است',
    			'name.max' => 'نام درس نامعتبر است',
    			'name.unique' => 'نام درس قبلا در سیستم ثبت شده است',
    			
    		]);   
    		    			    			
DB::table('lesson')->insert([
    ['lesson_name' => $request->name ,  'lesson_active' => 0    ]
]); 

$nametr = Session::flash('statust', 'درس با موفقیت ثبت شد.');
$nametrt = Session::flash('sessurl', 'viewslessons');
		  return view('superadmin.success'); 	    	 }	
else{ return redirect('superadmin/sign-in'); }    	  
}
	




		
		
	public function viewslessons(){
if (Session::has('signsuperadmin')){ 
$admins = \DB::table('lesson') ->orderBy('id', 'desc')->get();
return view('superadmin.viewslessons', ['admins' => $admins]);
}	
else{ return redirect('superadmin/sign-in'); }
}		




	
	public function deletlesson($id){
		if (Session::has('signsuperadmin')){ 
		  	$admins = \ DB::table('lesson')->where('id', $id)->get();
		  	$admins = \DB::table('lesson')->where('id', '=', $id)->delete();
		  	$nametr = Session::flash('statust', 'حذف درس با موفقیت انجام شد.');
		  	$nametrt = Session::flash('sessurl', 'viewslessons');
		  	
	return view('superadmin.success', ['admins' => $admins]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}
		
			
	public function acclesson($id){
		if (Session::has('signsuperadmin')){ 				
$updatee = \DB::table('lesson')->where('id', '=', $id)  ->update(['lesson_active' => 1   ]); 
		  	$admins = \ DB::table('lesson')->where('id', $id)->get();				
		  	$nametr = Session::flash('statust', 'درس با موفقیت فعال شد.');
		  	$nametrt = Session::flash('sessurl', 'viewslessons');		  	
	return view('superadmin.success', ['admins' => $admins]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}
				
		
			
	public function rejlesson($id){
		if (Session::has('signsuperadmin')){ 				
$updatee = \DB::table('lesson')->where('id', '=', $id)  ->update(['lesson_active' => 0   ]); 
		  	$admins = \ DB::table('level')->where('id', $id)->get();				
		  	$nametr = Session::flash('statust', ' درس با موفقیت غیرفعال شد.');
		  	$nametrt = Session::flash('sessurl', 'viewslessons');		  	
	return view('superadmin.success', ['admins' => $admins]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}
					

		
	public function viewsclases(){
if (Session::has('signsuperadmin')){ 
 $clases= \DB::table('lesson')
->join('clas', 'lesson.id', '=', 'clas.clas_lesson')
->join('term', 'clas.clas_term', '=', 'term.id')
->join('period', 'term.term_period', '=', 'period.id')
->where('clas.clas_term', '<>', 0)  ->orderBy('clas.id', 'desc')->get();

 $admins= \DB::table('lesson')
->join('clas', 'lesson.id', '=', 'clas.clas_lesson')
->where('clas.clas_term', '<>', 0)  ->orderBy('clas.id', 'desc')->get();

return view('superadmin.viewsclases', ['admins' => $admins , 'clases' => $clases ]);
}	
else{ return redirect('superadmin/sign-in'); }
}		






	public function editclas($id){
if (Session::has('signsuperadmin')){ 
	Session::put('idimg', $id);
	
 $professors= \DB::table('professors')->where('professor_active', '=', 1)  ->orderBy('id', 'desc')->get();
 $admins= \DB::table('lesson')
->join('clas', 'lesson.id', '=', 'clas.clas_lesson')
->where('clas.id', '=', $id)  ->orderBy('clas.id', 'desc')->get();

 $adminsp= \DB::table('clas')->where('id', '=', $id)  ->orderBy('id', 'desc')->first();

 $terms= \DB::table('term')->where('id', '=', $adminsp->clas_term)  ->orderBy('id', 'desc')->get();

 $termds= \DB::table('term')->where('id', '=', $adminsp->clas_term)  ->orderBy('id', 'desc')->first();

 $sisions= \DB::table('sision')->where('sision_clas', '=', $id)  ->orderBy('id', 'desc')->get();

 $professorsselecs= \DB::table('professors')->where('id', '=', $adminsp->clas_professor)  ->orderBy('id', 'desc')->get();

$ways = \DB::table('period')
->join('term', 'period.id', '=', 'term.term_period')
->join('clas', 'term.id', '=', 'clas.clas_term')
->where('clas.id', '=', $id)  ->orderBy('term.id', 'desc')->get(); 



$liststudents = \DB::table('students')
->join('liststudentterm', 'students.id', '=', 'liststudentterm.liststud_idstudent')
->join('term', 'liststudentterm.liststud_term', '=', 'term.id')
->join('finicals', 'liststudentterm.liststud_finical', '=', 'finicals.id')
->where([['term.id', '=', $adminsp->clas_term],['finicals.finical_payment', '=', 1], ]) ->orderBy('finicals.id', 'desc')->get(); 




return view('superadmin.editclas', ['admins' => $admins , 'ways' => $ways   , 'professors' => $professors  , 'professorsselecs' => $professorsselecs  , 'terms' => $terms   , 'sisions' => $sisions   , 'termds' => $termds   , 'liststudents' => $liststudents  ]); }	
else{ return redirect('superadmin/sign-in'); }
}




		
	public function editclasstartdate($id  , Request $request ){
if (Session::has('signsuperadmin')){ 
$this->validate($request,[
    			'pcal4' => 'required',
    			'extra4' => 'required|date',
    		],[
    			'pcal4.required' => 'لطفا تاریخ را وارد نمایید',
    			'extra4.required' => 'پر کردن فیلد تاریخ اجباری است',
    			'extra4.date' => 'فرمت تاریخ اشتباه است',
    		]); 
    		
    	 
    		
 if($request->startterm  > $request->extra4 ){
$nrepeatl = Session::flash('repeat', '1');
return redirect('superadmin/viewsclases/editclas/'.$id.''); }else  {  
    		  
$updatee = \DB::table('clas')->where('id', '=', $id)  ->update(['clas_startdate' => $request->extra4   ]); 
$admins = \DB::table('clas')->where('id', '=', $id)  ->orderBy('id', 'desc')->get();
$nametr = Session::flash('statust', 'تاریخ شروع کلاسها با موفقیت ویرایش شد.');
$nametrt = Session::flash('sessurl', 'viewsclases/editclas/'.$id.''); }
return view('superadmin.success');
}	else{ return redirect('superadmin/sign-in'); }
}
	
	
			
	public function editclasprofessor($id  , Request $request ){
if (Session::has('signsuperadmin')){ 
$this->validate($request,[
    			'name' => 'required',
    		],[
    			'name.required' => 'لطفا استاد را انتخاب نمایید',
    		]);   
$updatee = \DB::table('clas')->where('id', '=', $id)  ->update(['clas_professor' => $request->name   ]); 
$admins = \DB::table('clas')->where('id', '=', $id)  ->orderBy('id', 'desc')->get();
$nametr = Session::flash('statust', 'برای کلاس مربوطه استاد انتخاب شد.');
$nametrt = Session::flash('sessurl', 'viewsclases/editclas/'.$id.'');
return view('superadmin.success');
}	else{ return redirect('superadmin/sign-in'); }
}
	





			
	public function accclas($id){
		if (Session::has('signsuperadmin')){ 				
$updatee = \DB::table('clas')->where('id', '=', $id)  ->update(['clas_active' => 1   ]); 
		  	$admins = \ DB::table('clas')->where('id', $id)->get();				
		  	$nametr = Session::flash('statust', 'کلاس با موفقیت فعال شد.');
		  	$nametrt = Session::flash('sessurl', 'viewsclases/editclas/'.$id.'');		  	
	return view('superadmin.success', ['admins' => $admins]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}
				




			
	public function rejclas($id){
		if (Session::has('signsuperadmin')){ 				
$updatee = \DB::table('clas')->where('id', '=', $id)  ->update(['clas_active' => 0   ]); 
		  	$admins = \ DB::table('clas')->where('id', $id)->get();				
		  	$nametr = Session::flash('statust', 'کلاس با موفقیت غیرفعال شد.');
		  	$nametrt = Session::flash('sessurl', 'viewsclases/editclas/'.$id.'');		  	
	return view('superadmin.success', ['admins' => $admins]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}




	
	public function delclas($id){
		if (Session::has('signsuperadmin')){ 

		  	$admins = \DB::table('clas')->where('id', '=', $id)->delete();
		  	$admins = \DB::table('sision')->where('sision_clas', '=', $id)->delete();

		  	$nametr = Session::flash('statust', 'حذف کلاس با موفقیت انجام شد.');
		  	$nametrt = Session::flash('sessurl', 'viewsclases');
		  	
	return view('superadmin.success', ['admins' => $admins]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}				



	public function addsision($id){
if (Session::has('signsuperadmin')){
	
$ways = \DB::table('period')
->join('term', 'period.id', '=', 'term.term_period')
->join('clas', 'term.id', '=', 'clas.clas_term')
->where('clas.id', '=', $id)  ->orderBy('term.id', 'desc')->get(); 
	

 $admins= \DB::table('lesson')
->join('clas', 'lesson.id', '=', 'clas.clas_lesson')
->where('clas.id', '=', $id)  ->orderBy('clas.id', 'desc')->first();


$terms = \DB::table('period')->join('term', 'period.id', '=', 'term.term_period')->where('term.id', '=', $admins->clas_term)  ->orderBy('term.id', 'desc')->get();

 $admins= \DB::table('lesson')
->join('clas', 'lesson.id', '=', 'clas.clas_lesson')
->where('clas.id', '=', $id)  ->orderBy('clas.id', 'desc')->get();

$termspsc = \ DB::table('sision')->where('sision_clas', $id)->orderBy('id', 'desc')->count();
$termsps = \ DB::table('sision')->where('sision_clas', $id)->orderBy('id', 'desc')->first();

$wterm = \ DB::table('clas')->where('id', $id)->first();
$wperiod = \ DB::table('term')->where('id', $wterm->clas_term)->first();
$wlevel = \ DB::table('period')->where('id', $wperiod->term_period)->first();

return view('superadmin.addsision', ['admins' => $admins ,  'termsps' => $termsps  , 'terms' => $terms  ,'termspsc' => $termspsc  , 'ways' => $ways , 'wterm' => $wterm , 'wperiod' => $wperiod , 'wlevel' => $wlevel]);
	 }	
else{ return redirect('superadmin/sign-in'); }
				}






public function addsisionpost($id , Request $request){
if (Session::has('signsuperadmin')){    	    	
    	$this->validate($request,[
    			'term' => 'required|numeric|max:10',
    			'pcal4' => 'required',
    			'extra4' => 'required|date',
    		],[
    			'term.required' => 'لطفا جلسه را وارد نمایید',
    			'term.numeric' => 'جلسه را بصورت عددی وارد نمایید',
    			'term.max' => 'جلسه وارد شده معتبر نیست',
    			'pcal4.required' => 'لطفا تاریخ را وارد نمایید',
    			'extra4.required' => 'پر کردن فیلد تاریخ اجباری است',
    			'extra4.date' => 'فرمت تاریخ اشتباه است',
    		]);   
    		
    		
 if($request->startclas  > $request->extra4 ){
$nrepeatl = Session::flash('repeat', '1');
return redirect('superadmin/addsision/'.$id.''); }else  {      			
    			
DB::table('sision')->insert([
    ['sision_number' => $request->term ,'sision_level' => $request->wlevel ,'sision_period' => $request->wperiod ,'sision_term' => $request->wterm ,  'sision_clas' => $id , 'sision_startdate' => $request->extra4  , 'sision_hour' => $request->hour  , 'sision_min' => $request->min     ]
]); 
 

$nametr = Session::flash('statust', 'جلسه با موفقیت ثبت شد.');
$nametrt = Session::flash('sessurl', 'viewsclases/editclas/'.$id.'');
		  return view('superadmin.success'); 	    	 }	
}else{ return redirect('superadmin/sign-in'); }    	  
}
	




	public function editsision($id){
if (Session::has('signsuperadmin')){ 
	Session::put('idimg', $id);
	

 $professors= \DB::table('professors')->where('professor_active', '=', 1)  ->orderBy('id', 'desc')->get();
 $admins= \DB::table('lesson')
->join('clas', 'lesson.id', '=', 'clas.clas_lesson')
->join('sision', 'clas.id', '=', 'sision.sision_clas')
->where('sision.id', '=', $id)  ->orderBy('sision.id', 'desc')->get();

 $adminsp= \DB::table('sision')->where('id', '=', $id)  ->orderBy('id', 'desc')->first(); 
 $terms= \DB::table('clas')->where('id', '=', $adminsp->sision_clas)  ->orderBy('id', 'desc')->get();
 $sisions= \DB::table('sision')->where('sision_clas', '=', $id)  ->orderBy('id', 'desc')->get();

$ways = \DB::table('period')
->join('term', 'period.id', '=', 'term.term_period')
->join('clas', 'term.id', '=', 'clas.clas_term')
->join('sision', 'clas.id', '=', 'sision.sision_clas')
->where('sision.id', '=', $id)  ->orderBy('term.id', 'desc')->get(); 

 $wsisions= \DB::table('sision')->where('id', '=', $id)  ->orderBy('id', 'desc')->first(); 
 $wasisions= \DB::table('sision')->where('id', '=', $id)  ->orderBy('id', 'desc')->get(); 
 
 $wclases= \DB::table('clas')->where('id', '=', $wsisions->sision_clas)   ->first();
 $waclases= \DB::table('clas')->where('id', '=', $wsisions->sision_clas)  ->orderBy('id', 'desc')->get();
 
 $wterms= \DB::table('term')->where('id', '=', $wclases->clas_term)  ->orderBy('id', 'desc')->first();
 $waterms= \DB::table('term')->where('id', '=', $wclases->clas_term)  ->orderBy('id', 'desc')->get();
 
 $wperiods= \DB::table('period')->where('id', '=', $wterms->term_period)  ->orderBy('id', 'desc')->first();
 $waperiods= \DB::table('period')->where('id', '=', $wterms->term_period)  ->orderBy('id', 'desc')->get();
 
 $professorsselecs= \DB::table('professors')->where('id', '=', $wclases->clas_professor)  ->orderBy('id', 'desc')->get();





$liststudents = \DB::table('liststudentterm')
->join('term', 'liststudentterm.liststud_term', '=', 'term.id')
->join('finicals', 'liststudentterm.liststud_finical', '=', 'finicals.id')
->where([['term.id', '=', $wclases->clas_term],['finicals.finical_payment', '=', 1], ]) ->orderBy('finicals.id', 'desc')->get(); 

 
foreach($liststudents as $liststudent) {
	

$countlist = \DB::table('liststudentsision')->where([['liststudentsision.listsis_idstudent', '=', $liststudent->finical_iduser ],['liststudentsision.listsis_sision', '=', $id], ]) ->orderBy('id', 'desc')->count(); 	
if($countlist!='0')	{ } else if($countlist=='0')	{
	
 DB::table('liststudentsision')->insert([
    ['listsis_idstudent' => $liststudent->finical_iduser ,     'listsis_period' => $wterms->term_period ,   'listsis_term' => $wclases->clas_term   ,   'listsis_clas' => $wsisions->sision_clas ,  'listsis_sision' => $id  ,   'listsis_createdatdate' =>  date('Y-m-d H:i:s') ,   'listsis_peresent' => 0  ,   'listsis_active' => 0     ]
]); 	
}

}
 
 

$liststudentts = \DB::table('liststudentsision')
->join('students', 'liststudentsision.listsis_idstudent', '=', 'students.id')
->where([['liststudentsision.listsis_sision', '=', $id],['students.id', '<>', 0], ]) ->orderBy('students.id', 'desc')->get();  
 
 




return view('superadmin.editsision', ['admins' => $admins , 'ways' => $ways   , 'professors' => $professors  , 'professorsselecs' => $professorsselecs  , 'terms' => $terms   , 'sisions' => $sisions   , 'wasisions' => $wasisions   , 'waclases' => $waclases   , 'waterms' => $waterms   , 'waperiods' => $waperiods , 'liststudentts' => $liststudentts , 'wclases' => $wclases   ]); }	
else{ return redirect('superadmin/sign-in'); }
}






	public function editsisionstartdate($id  , Request $request ){
if (Session::has('signsuperadmin')){ 
$this->validate($request,[
    			'pcal4' => 'required',
    			'extra4' => 'required|date',
    		],[
    			'pcal4.required' => 'لطفا تاریخ را وارد نمایید',
    			'extra4.required' => 'پر کردن فیلد تاریخ اجباری است',
    			'extra4.date' => 'فرمت تاریخ اشتباه است',
    		]);   
    		
    		    	 
    		
 if($request->startclas  > $request->extra4 ){
$nrepeatl = Session::flash('repeat', '1');
return redirect('superadmin/viewssision/editsision/'.$id.''); }else  {     
    		
$updatee = \DB::table('sision')->where('id', '=', $id)  ->update(['sision_startdate' => $request->extra4 , 'sision_hour' => $request->hour , 'sision_min' => $request->min   ]); 
$admins = \DB::table('sision')->where('id', '=', $id)  ->orderBy('id', 'desc')->get();
$nametr = Session::flash('statust', 'تاریخ و ساعت جلسه با موفقیت ویرایش شد.');
$nametrt = Session::flash('sessurl', 'viewssision/editsision/'.$id.'');
return view('superadmin.success'); }
}	else{ return redirect('superadmin/sign-in'); }
}
	



			
	public function accsision($id){
		if (Session::has('signsuperadmin')){ 				
$updatee = \DB::table('sision')->where('id', '=', $id)  ->update(['sision_active' => 1   ]); 
		  	$admins = \ DB::table('sision')->where('id', $id)->get();				
		  	$nametr = Session::flash('statust', 'جلسه با موفقیت فعال شد .');
		  	$nametrt = Session::flash('sessurl', 'viewssision/editsision/'.$id.'');		  	
	return view('superadmin.success', ['admins' => $admins]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}
				



			
	public function rejsision($id){
		if (Session::has('signsuperadmin')){ 				
$updatee = \DB::table('sision')->where('id', '=', $id)  ->update(['sision_active' => 0   ]); 
		  	$admins = \ DB::table('sision')->where('id', $id)->get();				
		  	$nametr = Session::flash('statust', 'جلسه باموفقیت غیرفعال شد .');
		  	$nametrt = Session::flash('sessurl', 'viewssision/editsision/'.$id.'');		  	
	return view('superadmin.success', ['admins' => $admins]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}
				




	
	public function delsision($id){
		if (Session::has('signsuperadmin')){ 
		  	$admins = \ DB::table('sision')->where('id', $id)->get();
		  	$admins = \DB::table('sision')->where('id', '=', $id)->delete();
		  	$nametr = Session::flash('statust', 'حذف جلسه با موفقیت ثبت شد.');
		  	$nametrt = Session::flash('sessurl', 'viewsclases');		
		  	
	return view('superadmin.success', ['admins' => $admins]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}				


		
		
	public function tuitions(){
if (Session::has('signsuperadmin')){ 
$admins = \DB::table('level')
->join('period', 'level.id', '=', 'period.period_level')
->orderBy('period.id', 'desc')->get();

return view('superadmin.tuitions', ['admins' => $admins ]);
}	
else{ return redirect('superadmin/sign-in'); }
}	







	public function edittuition($id){
if (Session::has('signsuperadmin')){ 
	Session::put('idimg', $id);
	
$admins = \DB::table('level')
->join('period', 'level.id', '=', 'period.period_level')
->where('period.id', '=', $id)  ->orderBy('period.id', 'desc')->get();
	 
$levels = \DB::table('level') ->orderBy('id', 'desc')->get();
$terms = \DB::table('term')->where('term_period', '=', $id)   ->orderBy('id', 'desc')->get();

return view('superadmin.edittuition', ['admins' => $admins , 'levels' => $levels, 'terms' => $terms  ]); }	
else{ return redirect('superadmin/sign-in'); }
}





	public function edittuitionpost($id  , Request $request ){
if (Session::has('signsuperadmin')){ 
$this->validate($request,[
    			'tuition' => 'required|numeric',
    		],[
    			'tuition.required' => 'لطفا شهریه را وارد نمایید',
    			'tuition.numeric' => 'لطفا شهریه را بصورت عددی وارد نمایید',
    		]);   
$updatee = \DB::table('period')->where('id', '=', $id)  ->update(['period_tuition' => $request->tuition   ]); 
$admins = \DB::table('period')->where('id', '=', $id)  ->orderBy('id', 'desc')->get();
$nametr = Session::flash('statust', 'مبلغ شهریه با موفقیت ثبت شد.');
$nametrt = Session::flash('sessurl', 'tuitions/edittuition/'.$id.'');
return view('superadmin.success');
}	else{ return redirect('superadmin/sign-in'); }
}
	


						
		
	public function elanatorder(){
		if (Session::has('signsuperadmin')){
			$admins = \DB::table('elanatorders') ->where('id', '=', '1')  ->orderBy('id', 'desc')->get();
return view('superadmin.elanatorder', ['admins' => $admins]);}	
else{ return redirect('superadmin/sign-in'); }
 
				}
				
				
				
		
	public function elanatorderpost( Request $request ){
if (Session::has('signsuperadmin')){ 
$updatee = \DB::table('elanatorders')->where('id', '=', '1')  ->update(['elanord_accordermail' => $request->accordermail ,  'elanord_payordermail' => $request->payordermail ,  'elanord_buyturkmail' => $request->buyturkmail ,  'elanord_recvturkmail' => $request->recvturkmail ,  'elanord_paykargomail' => $request->paykargomail ,  'elanord_sendiranmail' => $request->sendiranmail ,  'elanord_recviranmail' => $request->recviranmail ,  'elanord_paypostmail' => $request->paypostmail ,  'elanord_sendordmail' => $request->sendordmail ,  'elanord_recvordmail' => $request->recvordmail ,  'elanord_accordersms' => $request->accordersms ,  'elanord_payordersms' => $request->payordersms ,  'elanord_buyturksms' => $request->buyturksms ,  'elanord_recvturksms' => $request->recvturksms ,  'elanord_paykargosms' => $request->paykargosms ,  'elanord_sendiransms' => $request->sendiransms ,  'elanord_recviransms' => $request->recviransms ,  'elanord_paypostsms' => $request->paypostsms ,  'elanord_sendordsms' => $request->sendordsms ,  'elanord_recvordsms' => $request->recvordsms     ]); 



			 $nametr = Session::flash('statust', 'اطلاع رسانی مراحل سفارش از طریق پیامک و ایمیل با موفقیت ویرایش شد.');
		  	$nametrt = Session::flash('sessurl', 'elanatorder');		  	

 return view('superadmin.success');

}	
else{ return redirect('superadmin/sign-in'); }
				}
		



		

						
		
	public function elanat(){
		if (Session::has('signsuperadmin')){
			$admins = \DB::table('superadminselanats') ->where('id', '=', '1')  ->orderBy('id', 'desc')->get();
return view('superadmin.elanat', ['admins' => $admins]);}	
else{ return redirect('superadmin/sign-in'); }
 
				}

		
	public function elanemail( Request $request ){
if (Session::has('signsuperadmin')){ 
$updatee = \DB::table('superadminselanats')->where('id', '=', '1')  ->update(['supelan_emailaccadmin' => $request->emailaccadmin , 'supelan_emailaccstudent' => $request->emailaccstudent  ,'supelan_emailadmin' => $request->emailadmin  ,  'supelan_emailstudent' => $request->emailstudent , 'supelan_smsaccadmin' => $request->smsaccadmin , 'supelan_smsaccstudent' => $request->smsaccstudent  ,'supelan_smsadmin' => $request->smsadmin ,    'supelan_smsstudent' => $request->smsstudent , 'supelan_date' =>  date('Y-m-d H:i:s')   ]); 

$admins = \DB::table('admins')->where('id', '=',  Session::get('idimg'))  ->orderBy('id', 'desc')->first();

			 $nametr = Session::flash('statust', 'اطلاع رسانی از طریق ایمیل و پیامک با موفقیت انجام شد.');
		  	$nametrt = Session::flash('sessurl', 'elanat');		  	

 return view('superadmin.success');

}	
else{ return redirect('superadmin/sign-in'); }
				}
		





	
		
	public function addpage(){
if (Session::has('signsuperadmin')){ return view('superadmin.addpage');}	
else{ return redirect('superadmin/sign-in'); }
				}




public function addpagepost(Request $request){
if (Session::has('signsuperadmin')){    	    	
    	$this->validate($request,[
    			'header' => 'required|min:3|unique:page,page_header,$request->header',
    			'tit' => 'required|min:3|unique:page,page_tit,$request->tit',
    			'des' => 'required|min:5',
    		],[
    			'header.required' => 'لطفا نام هدر صفحه را وارد نمایید',
    			'header.min' => 'هدر صفحه کوتاه است',
    			'header.unique' => 'این صفحه قبلا ثبت شده است',
    			'tit.required' => 'لطفا عنوان صفحه را وارد نمایید',
    			'tit.min' => 'عنوان صفحه کوتاه است',
    			'tit.unique' => 'این صفحه قبلا ثبت شده است',
    			'des.required' => 'لطفا توضیحات صفحه را بصورت صحیح وارد نمایید',
    			'des.min' => 'متن صفحه کوتاه است',
    			
    		]);   
   if(Session::get('imgupload')==NULL ) { 
   DB::table('page')->insert([
    ['page_header' => $request->header , 'page_tit' => $request->tit , 'page_des' => $request->des ,   'page_createdatdate' =>  date('Y-m-d H:i:s') ,  'page_active' => 0   ,  'page_arou' => 0        ]
]); 
    } else    if(Session::get('imgupload')!=NULL ) { 
    DB::table('page')->insert([
    ['page_header' => $request->header , 'page_tit' => $request->tit , 'page_des' => $request->des ,   'page_createdatdate' =>  date('Y-m-d H:i:s') ,  'page_active' => 0   ,  'page_arou' => 0     ,  'page_img' => Session::get('imgupload')   ]
]); }   			


	Session::forget('imgupload');	

$nametr = Session::flash('statust', 'صفحه با موفقیت ثبت شد.');
$nametrt = Session::flash('sessurl', 'viewspages');
		  return view('superadmin.success'); 	    	 }	
else{ return redirect('superadmin/sign-in'); }    	  
}
	



public function dropzoneStorestur(Request $request)
    {
        $image = $request->file('file');
        $imageName = time().$image->getClientOriginalName();
        $image->move(public_path('images'),$imageName);    
 
             $nametr = Session::flash('imgupload', $imageName);

        return response()->json(['success'=>$imageName]);
    }
		

		
		
	public function viewspages(){
if (Session::has('signsuperadmin')){ 
$admins = \DB::table('page') ->where([['page_arou', '=', 0], ]) -> orderBy('id', 'desc')->get();
return view('superadmin.viewspages', ['admins' => $admins]);
}	
else{ return redirect('superadmin/sign-in'); }
}




	public function editpage($id){
if (Session::has('signsuperadmin')){ 
	Session::put('idimg', $id);
$admins = \DB::table('page')->where([['page_arou', '=', 0],['id', '=', $id], ]) ->orderBy('id', 'desc')->get();
return view('superadmin.editpage', ['admins' => $admins]); }	
else{ return redirect('superadmin/sign-in'); }
}




	public function editpagepost($id  , Request $request ){
if (Session::has('signsuperadmin')){ 
    	$this->validate($request,[
    			'header' => 'required|min:3',
    			'tit' => 'required|min:3',
    			'des' => 'required|min:5',
    		],[
    			'header.required' => 'لطفا نام هدر صفحه را وارد نمایید',
    			'header.min' => 'هدر صفحه کوتاه است',
    			'tit.required' => 'لطفا عنوان صفحه را وارد نمایید',
    			'tit.min' => 'عنوان صفحه کوتاه است',
    			'des.required' => 'لطفا توضیحات صفحه را بصورت صحیح وارد نمایید',
    			'des.min' => 'متن صفحه کوتاه است',
    			
    		]);   
    		  
$updatee = \DB::table('page')->where('id', '=', $id)  ->update(['page_header' => $request->header ,'page_tit' => $request->tit  ,'page_des' => $request->des     ]); 
$admins = \DB::table('page')->where('id', '=', $id)  ->orderBy('id', 'desc')->get();
$nametr = Session::flash('statust', 'صفحه با موفقیت ویرایش شد.');
$nametrt = Session::flash('sessurl', 'viewspages/editpage/'.$id.'');
return view('superadmin.success');
}	else{ return redirect('superadmin/sign-in'); }
}
		



public function dropzoneStorepage(Request $request)
    {
        $image = $request->file('file');
        $imageName = time().$image->getClientOriginalName();
        $image->move(public_path('images'),$imageName);        
$updatee = \DB::table('page')->where('id', '=', Session::get('idimg'))  ->update(['page_img' => $imageName   ]); 
        return response()->json(['success'=>$imageName]);
    }
		


		
	public function accpage($id){
		if (Session::has('signsuperadmin')){ 				
$updatee = \DB::table('page')->where('id', '=', $id)  ->update(['page_active' => 1   ]); 
		  	$admins = \ DB::table('page')->where('id', $id)->get();				
		  	$nametr = Session::flash('statust', 'صفحه با موفقیت فعال شد.');
		  	$nametrt = Session::flash('sessurl', 'viewspages/editpage/'.$id.'');		  	
	return view('superadmin.success', ['admins' => $admins]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}
				


		
	public function rejpage($id){
		if (Session::has('signsuperadmin')){ 				
$updatee = \DB::table('page')->where('id', '=', $id)  ->update(['page_active' => 0   ]); 
		  	$admins = \ DB::table('page')->where('id', $id)->get();				
		  	$nametr = Session::flash('statust', 'صفحه با موفقیت غیرفعال شد.');
		  	$nametrt = Session::flash('sessurl', 'viewspages/editpage/'.$id.'');		  	
	return view('superadmin.success', ['admins' => $admins]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}
					
	
	

	
	public function deletpage($id){
		if (Session::has('signsuperadmin')){ 
		  	$admins = \DB::table('page')->where('id', '=', $id)->delete(); 
		  	$nametr = Session::flash('statust', 'حذف صفحه با موفقیت انجام شد.');
		  	$nametrt = Session::flash('sessurl', 'viewspages');
	return view('superadmin.success', ['admins' => $admins]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}				



	
	
		
	public function addpageshop(){
if (Session::has('signsuperadmin')){ return view('superadmin.addpageshop');}	
else{ return redirect('superadmin/sign-in'); }
				}
	
	
	


public function addpageshoppost(Request $request){
if (Session::has('signsuperadmin')){    	    	
    	$this->validate($request,[
    			'header' => 'required|min:3|unique:page,page_header,$request->header',
    			'tit' => 'required|min:3|unique:page,page_tit,$request->tit',
    			'des' => 'required|min:5',
    		],[
    			'header.required' => 'لطفا نام هدر صفحه را وارد نمایید',
    			'header.min' => 'هدر صفحه کوتاه است',
    			'header.unique' => 'این صفحه قبلا ثبت شده است',
    			'tit.required' => 'لطفا عنوان صفحه را وارد نمایید',
    			'tit.min' => 'عنوان صفحه کوتاه است',
    			'tit.unique' => 'این صفحه قبلا ثبت شده است',
    			'des.required' => 'لطفا توضیحات صفحه را بصورت صحیح وارد نمایید',
    			'des.min' => 'متن صفحه کوتاه است',
    			
    		]);   
   if(Session::get('imgupload')==NULL ) { 
   DB::table('page')->insert([
    ['page_header' => $request->header , 'page_tit' => $request->tit , 'page_des' => $request->des ,   'page_createdatdate' =>  date('Y-m-d H:i:s') ,  'page_active' => 0   ,  'page_arou' => 1        ]
]); 
    } else    if(Session::get('imgupload')!=NULL ) { 
    DB::table('page')->insert([
    ['page_header' => $request->header , 'page_tit' => $request->tit , 'page_des' => $request->des ,   'page_createdatdate' =>  date('Y-m-d H:i:s') ,  'page_active' => 0   ,  'page_arou' => 1     ,  'page_img' => Session::get('imgupload')   ]
]); }   			


	Session::forget('imgupload');	

$nametr = Session::flash('statust', 'صفحه فروشگاه باموفقیت ثبت شد.');
$nametrt = Session::flash('sessurl', 'viewspagesshop');
		  return view('superadmin.success'); 	    	 }	
else{ return redirect('superadmin/sign-in'); }    	  
}
	


	
	
	
	
	
		
	public function viewspagesshop(){
if (Session::has('signsuperadmin')){ 
$admins = \DB::table('page') ->where([['page_arou', '=', 1], ]) -> orderBy('id', 'desc')->get();
return view('superadmin.viewspagesshop', ['admins' => $admins]);
}	
else{ return redirect('superadmin/sign-in'); }
}






	public function editpageshop($id){
if (Session::has('signsuperadmin')){ 
	Session::put('idimg', $id);
$admins = \DB::table('page')->where([['page_arou', '=', 1],['id', '=', $id], ]) ->orderBy('id', 'desc')->get();
return view('superadmin.editpage', ['admins' => $admins]); }	
else{ return redirect('superadmin/sign-in'); }
}






	public function editpageshoppost($id  , Request $request ){
if (Session::has('signsuperadmin')){ 
    	$this->validate($request,[
    			'header' => 'required|min:3',
    			'tit' => 'required|min:3',
    			'des' => 'required|min:5',
    		],[
    			'header.required' => 'لطفا نام هدر صفحه را وارد نمایید',
    			'header.min' => 'هدر صفحه کوتاه است',
    			'tit.required' => 'لطفا عنوان صفحه را وارد نمایید',
    			'tit.min' => 'عنوان صفحه کوتاه است',
    			'des.required' => 'لطفا توضیحات صفحه را بصورت صحیح وارد نمایید',
    			'des.min' => 'متن صفحه کوتاه است',
    			
    		]);   
    		  
$updatee = \DB::table('page')->where('id', '=', $id)  ->update(['page_header' => $request->header ,'page_tit' => $request->tit  ,'page_des' => $request->des     ]); 
$admins = \DB::table('page')->where('id', '=', $id)  ->orderBy('id', 'desc')->get();
$nametr = Session::flash('statust', 'صفحه فروشگاه باموفقیت ویرایش شد.');
$nametrt = Session::flash('sessurl', 'viewspagesshop/editpage/'.$id.'');
return view('superadmin.success');
}	else{ return redirect('superadmin/sign-in'); }
}
		


		
	public function accpageshop($id){
		if (Session::has('signsuperadmin')){ 				
$updatee = \DB::table('page')->where('id', '=', $id)  ->update(['page_active' => 1   ]); 
		  	$admins = \ DB::table('page')->where('id', $id)->get();				
		  	$nametr = Session::flash('statust', 'صفحه با موفقیت فعال شد.');
		  	$nametrt = Session::flash('sessurl', 'viewspagesshop/editpage/'.$id.'');		  	
	return view('superadmin.success', ['admins' => $admins]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}
				

		
	public function rejpageshop($id){
		if (Session::has('signsuperadmin')){ 				
$updatee = \DB::table('page')->where('id', '=', $id)  ->update(['page_active' => 0   ]); 
		  	$admins = \ DB::table('page')->where('id', $id)->get();				
		  	$nametr = Session::flash('statust', 'صفحه با موفقیت غیرفعال شد.');
		  	$nametrt = Session::flash('sessurl', 'viewspagesshop/editpage/'.$id.'');		  	
	return view('superadmin.success', ['admins' => $admins]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}
					

	
	public function deletpageshop($id){
		if (Session::has('signsuperadmin')){ 
		  	$admins = \DB::table('page')->where('id', '=', $id)->delete(); 
		  	$nametr = Session::flash('statust', 'حذف صفحه با موفقیت انجام شد.');
		  	$nametrt = Session::flash('sessurl', 'viewspagesshop');
	return view('superadmin.success', ['admins' => $admins]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}				






	public function addnew(){
if (Session::has('signsuperadmin')){ return view('superadmin.addnew');}	
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
   if(Session::get('imgupload')==NULL ) {
 DB::table('news')->insert([
    ['new_kh' => $request->kh , 'new_tit' => $request->tit , 'new_des' => $request->des ,   'new_createdatdate' =>  date('Y-m-d H:i:s')  ,  'new_active' => 0       ]
]);   	
   }			
else    if(Session::get('imgupload')!=NULL ) {
 DB::table('news')->insert([
    ['new_kh' => $request->kh , 'new_tit' => $request->tit , 'new_des' => $request->des ,   'new_createdatdate' =>  date('Y-m-d H:i:s')  ,  'new_active' => 0    ,   'new_img' => Session::get('imgupload')   ]
]);   	
   }			


	Session::forget('imgupload');	

$nametr = Session::flash('statust', 'خبر با موفقیت ثبت شد.');
$nametrt = Session::flash('sessurl', 'viewsnews');
		  return view('superadmin.success'); 	    	 }	
else{ return redirect('superadmin/sign-in'); }    	  
}
	



public function dropzoneStoresturn(Request $request)
    {
        $image = $request->file('file');
        $imageName = time().$image->getClientOriginalName();
        $image->move(public_path('images'),$imageName);    
 
             $nametr = Session::flash('imgupload', $imageName);

        return response()->json(['success'=>$imageName]);
    }
		
		
				
		
	public function viewsnews(){
if (Session::has('signsuperadmin')){ 
$admins = \DB::table('news') ->orderBy('id', 'desc')->get();
return view('superadmin.viewsnews', ['admins' => $admins]);
}	
else{ return redirect('superadmin/sign-in'); }
}




	public function editnew($id){
if (Session::has('signsuperadmin')){ 
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
    		  
$updatee = \DB::table('news')->where('id', '=', $id)  ->update(['new_kh' => $request->kh  , 'new_tit' => $request->tit , 'new_des' => $request->des     ]); 
$admins = \DB::table('news')->where('id', '=', $id)  ->orderBy('id', 'desc')->get();
$nametr = Session::flash('statust', 'خبر با موفقیت ویرایش شد.');
$nametrt = Session::flash('sessurl', 'viewsnews/editnew/'.$id.'');
return view('superadmin.success');
}	else{ return redirect('superadmin/sign-in'); }
}




public function dropzoneStorenew(Request $request)
    {
        $image = $request->file('file');
        $imageName = time().$image->getClientOriginalName();
        $image->move(public_path('images'),$imageName);        
$updatee = \DB::table('news')->where('id', '=', Session::get('idimg'))  ->update(['new_img' => $imageName   ]); 
        return response()->json(['success'=>$imageName]);
    }
		

		
	public function accnew($id){
		if (Session::has('signsuperadmin')){ 				
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
		  	$admins = \DB::table('news')->where('id', '=', $id)->delete(); 

		  	$nametr = Session::flash('statust', 'حذف خبر با موفقیت انجام شد.');
		  	$nametrt = Session::flash('sessurl', 'viewsnews');
		  	
	return view('superadmin.success', ['admins' => $admins]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}				
		



	public function editqstcat($id){
if (Session::has('signsuperadmin')){ 
 

$admins = \DB::table('qstcat') ->where([['id', '=', $id], ])  ->orderBy('id', 'desc')->first(); 
return view('superadmin.editqstcat', ['admins' => $admins   ]); }	
else{ return redirect('superadmin/sign-in'); }
}
 


	public function editqst($id){
if (Session::has('signsuperadmin')){ 
 

$admins = \DB::table('qstcat')
->join('question', 'qstcat.id', '=', 'question.qst_catid') ->where([['question.id', '=', $id], ])  ->orderBy('qstcat.id', 'desc')->first();
$qstcats = \DB::table('qstcat') ->orderBy('id', 'desc')->get();
return view('superadmin.editqst', ['admins' => $admins , 'qstcats' => $qstcats ]); }	
else{ return redirect('superadmin/sign-in'); }
}
 
	public function editqstpost($id , Request $request){
if (Session::has('signsuperadmin')){ 
 
    	$this->validate($request,[
    			'qst_pors' => 'required',
    			'qst_pas' => 'required', 
    		],[
    			'qst_pors.required' => 'لطفا پرسش را تایپ نمایید', 
    			'qst_pas.required' => 'لطفا پاسخ را تایپ نمایید', 
    			
    		]);   
    		
    		
    		
$updatee = \DB::table('question')->where('id', '=', $id)  ->update(['qst_pors' => $request->qst_pors , 'qst_pas' => $request->qst_pas   , 'qst_catid' => $request->name      ]);
    $nametr = Session::flash('statust', 'سوال و پاسخ باموفقیت ویرایش شد.');
$nametrt = Session::flash('sessurl', 'question');
return view('superadmin.success');		


 }	
else{ return redirect('superadmin/sign-in'); }
}
 
	public function editqstcatpost($id , Request $request){
if (Session::has('signsuperadmin')){ 
 
    	$this->validate($request,[
    			'qstcat_name' => 'required', 
    		],[
    			'qstcat_name.required' => 'لطفا نام گروه را وارد نمایید',  
    			
    		]);   
    		
    		
$updatee = \DB::table('qstcat')->where('id', '=', $id)  ->update(['qstcat_name' => $request->qstcat_name     ]);
    $nametr = Session::flash('statust', 'نام گروه با موفقیت ویرایش شد.');
$nametrt = Session::flash('sessurl', 'addgroupquestion');
return view('superadmin.success');		


 }	
else{ return redirect('superadmin/sign-in'); }
}
 
 
 
	
	
	public function deletquestioncat($id){
		if (Session::has('signsuperadmin')){ 
		  	$admins = \DB::table('question')->where('qst_catid', '=', $id)->delete(); 
		  	$admins = \DB::table('qstcat')->where('id', '=', $id)->delete(); 
 

		  	$nametr = Session::flash('statust', ' حذف گروه مربوطه با موفقیت انجام شد.');								 
		  	$nametrt = Session::flash('sessurl', 'addgroupquestion');
		  	
	return view('superadmin.success', ['admins' => $admins]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}				


 
 
 

	public function lawmarketer(){
if (Session::has('signsuperadmin')){  

$admins = \DB::table('laws') ->where([['law_arou', '=',  5 ],['id', '<>', 0], ])  ->orderBy('id', 'desc')->get();
return view('superadmin.lawmarketer', ['admins' => $admins  ]); }	
else{ return redirect('superadmin/sign-in'); }
}
 
 
 
 
public function lawmarketerpost(Request $request){
if (Session::has('signsuperadmin')){    	    	
    	$this->validate($request,[
    			'tit' => 'required',
    			'des' => 'required', 
    		],[
    			'tit.required' => 'لطفا عنوان را وارد نمایید', 
    			'des.required' => 'لطفا متن را وارد نمایید', 
    			
    		]);   
 
 DB::table('laws')->insert([
    ['law_tit' => $request->tit , 'law_des' => $request->des  ,    'law_arou' => 5   ,   'law_createdatdate' =>  date('Y-m-d H:i:s')     ]
]);   	
  		 
$nametr = Session::flash('statust', 'قانون با موفقیت ثبت شد.');
$nametrt = Session::flash('sessurl', 'lawmarketer');
		  return view('superadmin.success'); 	    	 }	
else{ return redirect('superadmin/sign-in'); }    	  
}
	
	
 
 
 
 
	
	public function deletlawmarketer($id){
		if (Session::has('signsuperadmin')){ 
		  	$admins = \DB::table('laws')->where('id', '=', $id)->delete(); 

		  	$nametr = Session::flash('statust', 'حذف قانون باموفقیت انجام شد.');
		  	$nametrt = Session::flash('sessurl', 'lawmarketer');
		  	
	return view('superadmin.success', ['admins' => $admins]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}				

 
 
 
 
 
	public function editlawmarketer($id){
if (Session::has('signsuperadmin')){ 
 

$admins = \DB::table('laws') ->where([['law_arou', '=',  5 ],['id', '=', $id], ])  ->orderBy('id', 'desc')->first();

return view('superadmin.editlawmarketer', ['admins' => $admins  ]); }	
else{ return redirect('superadmin/sign-in'); }
}
 
 
	public function editlawmarketerpost($id , Request $request){
if (Session::has('signsuperadmin')){ 
 
    	$this->validate($request,[
    			'law_tit' => 'required',
    			'law_des' => 'required', 
    		],[
    			'law_tit.required' => 'لطفا عنوان را وارد نمایید', 
    			'law_des.required' => 'لطفا متن را وارد نمایید', 
    			
    		]);   
    		
    		
    		
$updatee = \DB::table('laws')->where('id', '=', $id)  ->update(['law_tit' => $request->law_tit , 'law_des' => $request->law_des       ]);
    $nametr = Session::flash('statust', 'قانون با موفقیت ویرایش شد.');
$nametrt = Session::flash('sessurl', 'lawmarketer');
return view('superadmin.success');		


 }	
else{ return redirect('superadmin/sign-in'); }
}
 
 
 
 
 

	public function lawseller(){
if (Session::has('signsuperadmin')){  

$admins = \DB::table('laws') ->where([['law_arou', '=',  6 ],['id', '<>', 0], ])  ->orderBy('id', 'desc')->get();
return view('superadmin.lawseller', ['admins' => $admins  ]); }	
else{ return redirect('superadmin/sign-in'); }
}
 
 
 
public function lawsellerpost(Request $request){
if (Session::has('signsuperadmin')){    	    	
    	$this->validate($request,[
    			'tit' => 'required',
    			'des' => 'required', 
    		],[
    			'tit.required' => 'لطفا عنوان را وارد نمایید', 
    			'des.required' => 'لطفا متن را وارد نمایید', 
    			
    		]);   
 
 DB::table('laws')->insert([
    ['law_tit' => $request->tit , 'law_des' => $request->des  ,    'law_arou' => 6   ,   'law_createdatdate' =>  date('Y-m-d H:i:s')     ]
]);   	
  		 
$nametr = Session::flash('statust', 'قانون با موفقیت ثبت شد.');
$nametrt = Session::flash('sessurl', 'lawseller');
		  return view('superadmin.success'); 	    	 }	
else{ return redirect('superadmin/sign-in'); }    	  
}
	
	
 
	
	public function deletlawseller($id){
		if (Session::has('signsuperadmin')){ 
		  	$admins = \DB::table('laws')->where('id', '=', $id)->delete(); 

		  	$nametr = Session::flash('statust', 'حذف قانون باموفقیت انجام شد.');
		  	$nametrt = Session::flash('sessurl', 'lawseller');
		  	
	return view('superadmin.success', ['admins' => $admins]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}				

 
 
	public function editlawseller($id){
if (Session::has('signsuperadmin')){ 
 

$admins = \DB::table('laws') ->where([['law_arou', '=',  6 ],['id', '=', $id], ])  ->orderBy('id', 'desc')->first();

return view('superadmin.editlawseller', ['admins' => $admins  ]); }	
else{ return redirect('superadmin/sign-in'); }
}
 
 
 
	public function editlawsellerpost($id , Request $request){
if (Session::has('signsuperadmin')){ 
 
    	$this->validate($request,[
    			'law_tit' => 'required',
    			'law_des' => 'required', 
    		],[
    			'law_tit.required' => 'لطفا عنوان را وارد نمایید', 
    			'law_des.required' => 'لطفا متن را وارد نمایید', 
    			
    		]);   
    		
    		
    		
$updatee = \DB::table('laws')->where('id', '=', $id)  ->update(['law_tit' => $request->law_tit , 'law_des' => $request->law_des       ]);
    $nametr = Session::flash('statust', 'قانون با موفقیت ویرایش شد.');
$nametrt = Session::flash('sessurl', 'lawseller');
return view('superadmin.success');		


 }	
else{ return redirect('superadmin/sign-in'); }
}
 
 
 
 
 
 

	public function editquestion(){
if (Session::has('signsuperadmin')){ 
 

$admins = \DB::table('qstcat')
->join('question', 'qstcat.id', '=', 'question.qst_catid') ->orderBy('qstcat.id', 'desc')->get();
$qstcats = \DB::table('qstcat') ->orderBy('id', 'desc')->get();
return view('superadmin.editquestion', ['admins' => $admins , 'qstcats' => $qstcats ]); }	
else{ return redirect('superadmin/sign-in'); }
}
 

public function addquestionpost(Request $request){
if (Session::has('signsuperadmin')){    	    	
    	$this->validate($request,[
    			'pors' => 'required|min:10',
    			'pas' => 'required|min:10',
    			'name' => 'required',
    		],[
    			'pors.required' => 'لطفا پرسش را تایپ نمایید',
    			'pors.min' => 'پرسش کوتاه است',
    			'pas.required' => 'لطفا پاسخ را تایپ نمایید',
    			'pas.min' => 'پاسخ کوتاه است',
    			'name.required' => 'لطفا گروه را انتخاب نمایید',
    			
    		]);   
 
 DB::table('question')->insert([
    ['qst_pors' => $request->pors , 'qst_pas' => $request->pas  , 'qst_catid' => $request->name     ]
]);   	
  		 
$nametr = Session::flash('statust', 'پرسش و پاسخ جدید با موفقیت ثبت شد.');
$nametrt = Session::flash('sessurl', 'question');
		  return view('superadmin.success'); 	    	 }	
else{ return redirect('superadmin/sign-in'); }    	  
}
	
	
	
	
	
	public function deletquestion($id){
		if (Session::has('signsuperadmin')){ 
		  	$admins = \DB::table('question')->where('id', '=', $id)->delete(); 

		  	$nametr = Session::flash('statust', 'حذف پرسش پاسخ مربوطه با موفقیت انجام شد.');
		  	$nametrt = Session::flash('sessurl', 'question');
		  	
	return view('superadmin.success', ['admins' => $admins]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}				


public function demoedivence(){
if (Session::has('signsuperadmin')){ 

$admins = \DB::table('demoedivence') ->orderBy('id', 'desc')->get();
return view('superadmin.demoedivence', ['admins' => $admins]); }	
else{ return redirect('superadmin/sign-in'); }
}	
	




	public function demoedivencepost(  Request $request ){
if (Session::has('signsuperadmin')){ 
    	$this->validate($request,[
    	    	'pagename' => 'required',
    	    	'nameedv' => 'required',
    	    	'des1' => 'required',
    	    	'des2' => 'required',
    	    	'des3' => 'required',
    	    	'des4' => 'required',
    	    	'des5' => 'required',
    	    	'des6' => 'required',
    	    	'emz' => 'required',
    	    	'mnglab' => 'required',
    		],[
    			'pagename.required' => 'نام صفحه گواهی را وارد نمایید',
    			'nameedv.required' => 'نام گواهی را بصورت صحیح وارد نمایید',
    			'des1.required' => 'لطفا متن 1 را تایپ نمایید',
    			'des2.required' => 'لطفا متن 2 را تایپ نمایید',
    			'des3.required' => 'لطفا متن 3 را تایپ نمایید',
    			'des4.required' => 'لطفا متن 4 را تایپ نمایید',
    			'des5.required' => 'لطفا متن 5 را تایپ نمایید',
    			'des6.required' => 'لطفا متن 6 را تایپ نمایید',
    			'des7.required' => 'لطفا متن 7 را تایپ نمایید',
    			'emz.required' => 'نام امضا را بصورت صحیح وارد نمایید',
    			'mnglab.required' => 'نام مدیر آزمایشگاه را وارد نمایید',
    			
    		]);     
    		  
$updatee = \DB::table('demoedivence')->where('id', '=', 1)  ->update(['demedv_pagename' => $request->pagename , 'demedv_nameedv' => $request->nameedv  , 'demedv_des1' => $request->des1  , 'demedv_des2' => $request->des2  , 'demedv_des3' => $request->des3  , 'demedv_des4' => $request->des4  , 'demedv_des5' => $request->des5  , 'demedv_des6' => $request->des6  , 'demedv_des7' => $request->des7  , 'demedv_emz' => $request->emz   , 'demedv_mnglab' => $request->mnglab      ]); 
$admins = \DB::table('demoedivence')->where('id', '=', 1)  ->orderBy('id', 'desc')->get();
$nametr = Session::flash('statust', 'گواهی با موفقیت ویرایش شد.');
$nametrt = Session::flash('sessurl', 'demoedivence');
return view('superadmin.success');
}	else{ return redirect('superadmin/sign-in'); }
}



	
	public function demoprintt(){
if (Session::has('signsuperadmin')){ 
$admins = \DB::table('demoedivence') ->orderBy('id', 'desc')->get();
return view('superadmin.demoprint', ['admins' => $admins]);
}	
else{ return redirect('superadmin/sign-in'); }
}



		
		
	public function viewsperiodeedivence(){
if (Session::has('signsuperadmin')){ 
$admins = \DB::table('level')
->join('period', 'level.id', '=', 'period.period_level')->where([['period.period_active', '=', 1], ])  ->orderBy('period.id', 'desc')->get();

return view('superadmin.viewsperiodeedivence', ['admins' => $admins ]);
}	
else{ return redirect('superadmin/sign-in'); }
}		





	public function addedivence($id){
if (Session::has('signsuperadmin')){	

$admins = \ DB::table('period')->where('id', $id)->get();
$wlevel = \ DB::table('period')->where('id', $id)->first(); 

$liststudents = \DB::table('liststudentterm')
->join('finicals', 'liststudentterm.liststud_finical', '=', 'finicals.id')
->join('students', 'finicals.finical_iduser', '=', 'students.id')
->where([['liststudentterm.liststud_period', '=', $id ],['finicals.finical_payment', '=', 1], ]) ->orderBy('students.id', 'desc')->get(); 

$demoedivences = \DB::table('demoedivence') ->orderBy('id', 'desc')->get();

return view('superadmin.addedivence', ['admins' => $admins , 'wlevel' => $wlevel , 'liststudents' => $liststudents , 'demoedivences' => $demoedivences]);
}	else{ return redirect('superadmin/sign-in'); }
				}








public function addedivencepost($id , Request $request){
if (Session::has('signsuperadmin')){    

$this->validate($request,[
    			'name' => 'required|max:10',
    			'pcal4' => 'required',
    			'extra4' => 'required|date',
    			'extra4' => 'date',
    		],[
    			'name.required' => 'لطفا دانشجو را انتخاب نمایید',
    			'name.max' => 'دانشجویی انتخاب نشده است',
    			'pcal4.required' => 'لطفا تاریخ را وارد نمایید',
    			'extra4.required' => 'پر کردن فیلد تاریخ اجباری است',
    			'extra4.date' => 'فرمت تاریخ اشتباه است',
    		]);   

$rnd=rand(1, 99999); $num='11B403/'.$rnd;
$count = \ DB::table('listedivence')->where([['listedv_idstudent', '=',  $request->name ],['listedv_period', '=', $id], ])  ->orderBy('id', 'desc')->count();

if($count!='0'){ 
$nrepeatl = Session::flash('repeat', '1');
return redirect('superadmin/addedivence/'.$id.''); }else if($count=='0'){
    			
DB::table('listedivence')->insert([
    ['listedv_idstudent' => $request->name , 'listedv_level' => $request->wlevel ,  'listedv_des1' => $request->des1 ,  'listedv_des2' => $request->des2 ,  'listedv_des3' => $request->des3 ,  'listedv_des4' => $request->des4 ,  'listedv_des5' => $request->des5 ,  'listedv_des6' => $request->des6 ,  'listedv_des7' => $request->des7 ,  'listedv_pagename' => $request->pagename  ,  'listedv_nameedv' => $request->nameedv  ,  'listedv_emz' => $request->emz   ,    'listedv_mnglab' => $request->mnglab   ,  'listedv_extdate' => $request->extra4   ,     'listedv_period' => $id   ,     'listedv_number' => $num   ,     'listedv_active' => 1   ,    'listedv_arou' => 2   ,   'listedv_createdatdate' =>  date('Y-m-d H:i:s')  ]
]); 
 
 
$linkk= \DB::table('listedivence')->where([['listedivence.listedv_period', '=', $id ],['listedivence.listedv_idstudent', '=', $request->name], ]) ->orderBy('listedivence.id', 'desc')->first();
 
$nametr = Session::flash('statust', 'گواهی با موفقیت صادر شد.');
$nametrt = Session::flash('sessurl', 'viewslistedv/editlistedv/'.$linkk->id.'');
		  return view('superadmin.success'); 	    	 }	
}else{ return redirect('superadmin/sign-in'); }    	  
}
	
	

		
	public function viewslistedv(){
if (Session::has('signsuperadmin')){ 
$admins = \DB::table('students')
->join('listedivence', 'students.id', '=', 'listedivence.listedv_idstudent')
->where([['listedivence.id', '<>', 1 ],['listedivence.listedv_idstudent', '<>', 0], ]) ->orderBy('listedivence.id', 'desc')->get();

return view('superadmin.viewslistedv', ['admins' => $admins ]);
}	
else{ return redirect('superadmin/sign-in'); }
}		



		
	public function editlistedv($id){
if (Session::has('signsuperadmin')){ 
$admins = \DB::table('students')
->join('listedivence', 'students.id', '=', 'listedivence.listedv_idstudent')
->join('period', 'listedivence.listedv_period', '=', 'period.id')
->join('level', 'listedivence.listedv_level', '=', 'level.id')
->where([['listedivence.id', '=', $id ],['listedivence.listedv_idstudent', '<>', 0], ]) ->orderBy('listedivence.id', 'desc')->get();

$linkk= \DB::table('listedivence')->where([['listedivence.id', '=', $id ],['listedivence.listedv_idstudent', '<>', 0], ]) ->orderBy('listedivence.id', 'desc')->first();

return view('superadmin.editlistedv', ['admins' => $admins , 'linkk' => $linkk ]);
}	
else{ return redirect('superadmin/sign-in'); }
}		


	
	public function printedv($id){
if (Session::has('signsuperadmin')){ 
$admins = \DB::table('students')
->join('listedivence', 'students.id', '=', 'listedivence.listedv_idstudent')
->join('period', 'listedivence.listedv_period', '=', 'period.id')
->join('level', 'listedivence.listedv_level', '=', 'level.id')
->where([['listedivence.id', '=', $id ],['listedivence.listedv_idstudent', '<>', 0], ]) ->orderBy('listedivence.id', 'desc')->get();
return view('superadmin.printedv', ['admins' => $admins]);
}	
else{ return redirect('superadmin/sign-in'); }
}


	
	public function deletlistedv($id){
		if (Session::has('signsuperadmin')){  
		  	$admins = \DB::table('listedivence')->where('id', '=', $id)->get();
		  	$admins = \DB::table('listedivence')->where('id', '=', $id)->delete();
		  	$nametr = Session::flash('statust', 'گواهی صادر شده با موفقیت حذف شد.');
		  	$nametrt = Session::flash('sessurl', 'viewslistedv');
		  	
	return view('superadmin.success', ['admins' => $admins]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}
		



			
	public function acclistedv($id){
		if (Session::has('signsuperadmin')){ 				
$updatee = \DB::table('listedivence')->where('id', '=', $id)  ->update(['listedv_active' => 1   ]); 
		  	$admins = \ DB::table('listedivence')->where('id', $id)->get();				
		  	$nametr = Session::flash('statust', 'گواهی جهت نمایش به دانشجو فعال شد.');
		  	$nametrt = Session::flash('sessurl', 'viewslistedv');		  	
	return view('superadmin.success', ['admins' => $admins]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}
				


			
	public function rejlistedv($id){
		if (Session::has('signsuperadmin')){ 				
$updatee = \DB::table('listedivence')->where('id', '=', $id)  ->update(['listedv_active' => 0   ]); 
		  	$admins = \ DB::table('listedivence')->where('id', $id)->get();				
		  	$nametr = Session::flash('statust', 'گواهی با موفقیت غیرفعال شد.');
		  	$nametrt = Session::flash('sessurl', 'viewslistedv');		  	
	return view('superadmin.success', ['admins' => $admins]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}
				


	public function addgroupprofessor(){
if (Session::has('signsuperadmin')){ return view('superadmin.addgroupprofessor');}	
else{ return redirect('superadmin/sign-in'); }
				}




public function addgroupprofessorPost(Request $request){
if (Session::has('signsuperadmin')){    	    	
    	$this->validate($request,[
    			'name' => 'required|min:3|max:55|unique:groupprofessor,grpr_name,$request->name'
    		],[
    			'name.required' => 'لطفا نام گروه را وارد نمایید',
    			'name.min' => 'نام گروه کوتاه است',
    			'name.max' => ' نام گروه نامعتبر است',
    			'name.unique' => 'نام گروه قبلا در سیستم ثبت شده است',
    			
    		]);   
    		
DB::table('groupprofessor')->insert([
    ['grpr_name' => $request->name    ]
]); 

$users = DB::table('groupprofessor')->where('grpr_name', $request->name)->first();
$userscou = DB::table('groupprofessor')->where('grpr_name', $request->name)->count();

$nametr = Session::flash('statust', 'گروه با موفقیت ثبت شد.');
$nametrt = Session::flash('sessurl', 'viewsgroupprofessor');
		  return view('superadmin.success'); 	    	 }	
else{ return redirect('superadmin/sign-in'); }    	  
}




		
	public function viewsgroupprofessor(){
if (Session::has('signsuperadmin')){ 
$admins = \DB::table('groupprofessor') ->orderBy('id', 'desc')->get();
return view('superadmin.viewsgroupprofessor', ['admins' => $admins]);
}	
else{ return redirect('superadmin/sign-in'); }
}		




	public function editgroupprofessor($id){
if (Session::has('signsuperadmin')){ 
	Session::put('idimg', $id);
		
$admins = \DB::table('groupprofessor')->where('id', '=', $id)  ->orderBy('id', 'desc')->get();

$listgroupprofessors = \DB::table('professors')
->join('listgroupprofessor', 'professors.id', '=', 'listgroupprofessor.listgrpr_professorid')
->where('listgrpr_grprid', '=', $id)  ->orderBy('listgrpr_professorid', 'desc')->get();

$professors=\DB::table('professors')->where('professor_active', '=', 1)   ->orderBy('id', 'desc')->get();

return view('superadmin.editgroupprofessor', ['admins' => $admins ,  'professors' => $professors , 'listgroupprofessors' => $listgroupprofessors    ]); }	
else{ return redirect('superadmin/sign-in'); }
}


	



public function addprofessorlistgrouppost($id , Request $request){
if (Session::has('signsuperadmin')){    	    	
    	$this->validate($request,[
    			'name' => 'required|max:10',
    		],[
    			'name.required' => 'لطفا استاد را انتخاب نمایید',
    			'name.max' => 'استاد وارد شده نامعتبر است ',
    		]);   
 
 

$count = \ DB::table('listgroupprofessor')->where([['listgrpr_professorid', '=',  $request->name ],['listgrpr_grprid', '=', $id], ])  ->orderBy('id', 'desc')->count();

if($count!='0'){ 
$nrepeatl = Session::flash('repeat', '1');
return redirect('superadmin/viewsgroupprofessor/editgroupprofessor/'.$id.''); }else if($count=='0'){
 
DB::table('listgroupprofessor')->insert([
    ['listgrpr_professorid' => $request->name   ,  'listgrpr_grprid' => $id    ]
]); 
 
$nametr = Session::flash('statust', 'استاد با موفقیت به گروه اضافه شد .');
$nametrt = Session::flash('sessurl', 'viewsgroupprofessor/editgroupprofessor/'.$id.'');
		  return view('superadmin.success'); 	    	 }	
}else{ return redirect('superadmin/sign-in'); }    	  
}




	
	public function deletprofgroup( $id){
		if (Session::has('signsuperadmin')){ 
$admins = \DB::table('listgroupprofessor')->where('id', '=', $id)->delete(); 

		  	$nametr = Session::flash('statust', 'حذف  استاد از گروه با موفقیت انجام شد.');
		  	$nametrt = Session::flash('sessurl', 'viewsgroupprofessor');
		  	
	return view('superadmin.success', ['admins' => $admins]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}				
		


	
	public function deletgroupprof( $id){
		if (Session::has('signsuperadmin')){ 
 	
$admins = \DB::table('listgroupprofessor')->where('listgrpr_grprid', '=', $id)->delete();
$admins = \DB::table('groupprofessor')->where('id', '=', $id)->delete(); 

		  	$nametr = Session::flash('statust', 'حذف گروه اساتید با موفقیت انجام شد.');
		  	$nametrt = Session::flash('sessurl', 'viewsgroupprofessor');
		  	
	return view('superadmin.success', ['admins' => $admins]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}				
		


	

	public function addgroupquestion(){
if (Session::has('signsuperadmin')){ 

$qstcats = \DB::table('qstcat') ->orderBy('id', 'desc')->get();
return view('superadmin.addgroupquestion', ['qstcats' => $qstcats]);}	
else{ return redirect('superadmin/sign-in'); }
				}



public function addgroupquestionPost(Request $request){
if (Session::has('signsuperadmin')){    	    	
    	$this->validate($request,[
    			'name' => 'required|min:3|max:55|unique:qstcat,qstcat_name,$request->name'
    		],[
    			'name.required' => 'لطفا نام گروه را وارد نمایید',
    			'name.min' => 'نام گروه کوتاه است',
    			'name.max' => ' نام گروه نامعتبر است',
    			'name.unique' => 'نام گروه قبلا در سیستم ثبت شده است',
    			
    		]);   
    		
DB::table('qstcat')->insert([
    ['qstcat_name' => $request->name    ]
]); 

 
$nametr = Session::flash('statust', 'گروه با موفقیت ثبت شد.');
$nametrt = Session::flash('sessurl', 'question');
		  return view('superadmin.success'); 	    	 }	
else{ return redirect('superadmin/sign-in'); }    	  
}
	



	

	public function addgroupuser(){
if (Session::has('signsuperadmin')){ return view('superadmin.addgroupuser');}	
else{ return redirect('superadmin/sign-in'); }
				}



public function addgroupuserPost(Request $request){
if (Session::has('signsuperadmin')){    	    	
    	$this->validate($request,[
    			'name' => 'required|min:3|max:55|unique:groupuser,grus_name,$request->name'
    		],[
    			'name.required' => 'لطفا نام گروه را وارد نمایید',
    			'name.min' => 'نام گروه کوتاه است',
    			'name.max' => ' نام گروه نامعتبر است',
    			'name.unique' => 'نام گروه قبلا در سیستم ثبت شده است',
    			
    		]);   
    		
DB::table('groupuser')->insert([
    ['grus_name' => $request->name    ]
]); 

$users = DB::table('groupuser')->where('grus_name', $request->name)->first();
$userscou = DB::table('groupuser')->where('grus_name', $request->name)->count();

$nametr = Session::flash('statust', 'گروه با موفقیت ثبت شد.');
$nametrt = Session::flash('sessurl', 'viewsgroupuser');
		  return view('superadmin.success'); 	    	 }	
else{ return redirect('superadmin/sign-in'); }    	  
}
	

		
	public function viewsgroupuser(){
if (Session::has('signsuperadmin')){ 
$admins = \DB::table('groupuser') ->orderBy('id', 'desc')->get();
return view('superadmin.viewsgroupuser', ['admins' => $admins]);
}	
else{ return redirect('superadmin/sign-in'); }
}		





	public function editgroupuser($id){
if (Session::has('signsuperadmin')){ 
	Session::put('idimg', $id);
		
$admins = \DB::table('groupuser')->where('id', '=', $id)  ->orderBy('id', 'desc')->get();

$listgroupstudents = \DB::table('user')
->join('listgroupuser', 'user.id', '=', 'listgroupuser.listgrus_userid')
->where('listgrus_grusid', '=', $id)  ->orderBy('listgrus_grusid', 'desc')->get();

$students=\DB::table('user')->where('user_active', '=', 1)   ->orderBy('id', 'desc')->get();

return view('superadmin.editgroupuser', ['admins' => $admins ,  'students' => $students , 'listgroupstudents' => $listgroupstudents    ]); }	
else{ return redirect('superadmin/sign-in'); }
}




public function adduserlistgrouppost($id , Request $request){
if (Session::has('signsuperadmin')){    	    	
    	$this->validate($request,[
    			'name' => 'required|max:10',
    		],[
    			'name.required' => 'لطفا کاربر را انتخاب نمایید',
    			'name.max' => 'کاربر وارد شده نامعتبر است',
    		]);   
 
 

$count = \ DB::table('listgroupuser')->where([['listgrus_userid', '=',  $request->name ],['listgrus_grusid', '=', $id], ])  ->orderBy('id', 'desc')->count();

if($count!='0'){ 
$nrepeatl = Session::flash('repeat', '1');
return redirect('superadmin/viewsgroupuser/editgroupuser/'.$id.''); }else if($count=='0'){
 
DB::table('listgroupuser')->insert([
    ['listgrus_userid' => $request->name   ,  'listgrus_grusid' => $id    ]
]); 
 
$nametr = Session::flash('statust', ' کاربر با موفقیت به گروه اضافه شد.');
$nametrt = Session::flash('sessurl', 'viewsgroupuser/editgroupuser/'.$id.'');
		  return view('superadmin.success'); 	    	 }	
}else{ return redirect('superadmin/sign-in'); }    	  
}







	
	public function deletusergroup( $id){
		if (Session::has('signsuperadmin')){ 
$admins = \DB::table('listgroupuser')->where('id', '=', $id)->delete(); 

		  	$nametr = Session::flash('statust', 'حذف کاربر از گروه با موفقیت انجام شد.');
		  	$nametrt = Session::flash('sessurl', 'viewsgroupuser');
		  	
	return view('superadmin.success', ['admins' => $admins]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}				
		

	




	
	public function deletgroupuser( $id){
		if (Session::has('signsuperadmin')){ 
 	
$admins = \DB::table('listgroupuser')->where('listgrus_grusid', '=', $id)->delete();
$admins = \DB::table('groupuser')->where('id', '=', $id)->delete(); 

		  	$nametr = Session::flash('statust', 'حذف گروه کاربری با موفقیت انجام شد.');
		  	$nametrt = Session::flash('sessurl', 'viewsgroupuser');
		  	
	return view('superadmin.success', ['admins' => $admins]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}				
		
			
			
	public function viewsticketssup(){
		if (Session::has('signsuperadmin')){ 
$admins = \DB::table('professors') 
->join('ticket', 'professors.id', '=', 'ticket.tik_fromid')
->where([
    ['tik_fromarou', '=', 3],
    ['tik_toarou', '=', 2],
    ['tik_tosh', '=', 1],])
    ->orderBy('ticket.id', 'desc')->get();


$tickread = DB::table('professors') 
->join('ticket', 'professors.id', '=', 'ticket.tik_fromid')->where([
    ['tik_fromarou', '=', 3],
    ['tik_toarou', '=', 2],
    ['tik_tosh', '=', 1],
    ['tik_toread', '=', 0],])
    ->orderBy('ticket.id', 'desc')->count();
	Session::set('tickreadprofessorsup', $tickread);   
    
    
return view('superadmin.viewstickets', ['admins' => $admins]);
}	else{ return redirect('superadmin/sign-in'); }
}	


		

	public function ticketsup($id){
if (Session::has('signsuperadmin')){ 
	Session::put('idimg', $id);
$tickets = \DB::table('professors') 
->join('ticket', 'professors.id', '=', 'ticket.tik_fromid')->where([
    ['ticket.id', '=', $id],
    ['tik_fromarou', '=', 3],
    ['tik_toarou', '=', 2],
    ['tik_tosh', '=', 1],])  ->orderBy('ticket.id', 'desc')->get();
$messages = \DB::table('message')->where('mes_ticket', '=', $id)  ->orderBy('id')->get();

$updatee = \DB::table('professors') 
->join('ticket', 'professors.id', '=', 'ticket.tik_fromid')->where([
    ['ticket.id', '=', $id],
    ['tik_fromarou', '=', 3],
    ['tik_toarou', '=', 2],
    ['tik_tosh', '=', 1],])  ->update(['tik_toread' => 1   ]); 
    
$tickread = DB::table('professors') 
->join('ticket', 'professors.id', '=', 'ticket.tik_fromid')->where([
    ['tik_fromarou', '=', 3],
    ['tik_toarou', '=', 2],
    ['tik_tosh', '=', 1],
    ['tik_toread', '=', 0],])
    ->orderBy('ticket.id', 'desc')->count();
	Session::set('tickreadprofessorsup', $tickread); 
 
return view('superadmin.ticket', ['tickets' => $tickets], ['messages' => $messages]); }	
else{ return redirect('superadmin/sign-in'); }
				}
	
	
		
	public function ticketsupPost($id  , Request $request ){
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

 $updatee = \DB::table('professors') 
->join('ticket', 'professors.id', '=', 'ticket.tik_fromid')->where([
    ['ticket.id', '=', $id],
    ['tik_fromarou', '=', 3],
    ['tik_toarou', '=', 2],
    ['tik_tosh', '=', 1],])  ->update(['tik_fromread' => 0 , 'tik_active' => 2   ]); 

$nametr = Session::flash('statust', 'پیام شما با موفقیت ارسال شد.');
$nametrt = Session::flash('sessurl', 'viewstickets/ticket/'.$id.'');
return view('superadmin.success');
}	else{ return redirect('superadmin/sign-in'); }
}
		


	public function deletticketsup($id){
if (Session::has('signsuperadmin')){ 
	
 $updatee = \DB::table('professors') 
->join('ticket', 'professors.id', '=', 'ticket.tik_fromid')->where([
    ['ticket.id', '=', $id],
    ['tik_fromarou', '=', 3],
    ['tik_toarou', '=', 2],
    ['tik_tosh', '=', 1],])  ->update(['tik_tosh' => 0   ]); 

$nametr = Session::flash('statust', 'تیکت شما با موفقیت حذف شد.');
$nametrt = Session::flash('sessurl', 'viewstickets');
return view('superadmin.success');	

 }	else{ return redirect('superadmin/sign-in'); }
				}
	
		


	public function closeticket($id){
if (Session::has('signsuperadmin')){ 
	
 $updatee = \DB::table('professors') 
->join('ticket', 'professors.id', '=', 'ticket.tik_fromid')->where([
    ['ticket.id', '=', $id],
    ['tik_fromarou', '=', 3],
    ['tik_toarou', '=', 2],
    ['tik_tosh', '=', 1],])  ->update(['tik_active' => 0   ]); 

$nametr = Session::flash('statust', 'تیکت با موفقیت بسته شد.');
$nametrt = Session::flash('sessurl', 'viewstickets');
return view('superadmin.success');	

 }	else{ return redirect('superadmin/sign-in'); }
				}
	
		

			
	public function viewsuserticketssup(){
		if (Session::has('signsuperadmin')){ 
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
    
    
return view('superadmin.viewsuserticketssup', ['admins' => $admins]);
}	else{ return redirect('superadmin/sign-in'); }
}	



			
	public function viewsuserticketssupactive(){
		if (Session::has('signsuperadmin')){ 
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
    
    
return view('superadmin.viewsuserticketssup', ['admins' => $admins]);
}	else{ return redirect('superadmin/sign-in'); }
}	



	public function ticketusersup($id){
if (Session::has('signsuperadmin')){ 
	Session::put('idimg', $id);
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
 
return view('superadmin.ticketuser', ['tickets' => $tickets], ['messages' => $messages]); }	
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

$nametr = Session::flash('statust', 'پیام شما با موفقیت ارسال شد.');
$nametrt = Session::flash('sessurl', 'viewsuserticketssup/ticketuser/'.$id.'');
return view('superadmin.success');
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
return view('superadmin.success');	

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
return view('superadmin.success');	

 }	else{ return redirect('superadmin/sign-in'); }
				}


				
	public function editcost(){
if (Session::has('signsuperadmin')){

$mngindexs = \DB::table('mngindex') ->where('id', '=', '1')->orderBy('id', 'desc')->first();
 return view('superadmin.editcost' , ['mngindexs' => $mngindexs    ]);
  }	else{ return redirect('superadmin/sign-in'); }
		}	




public function editcostpost(Request $request){
if (Session::has('signsuperadmin')){ 	
    	
    	$this->validate($request,[
    			'taxp' => 'required|numeric',
    			'bis' => 'required|numeric', 
    		],[
    			'taxp.required' => 'هزینه مشاهده آدرس ترکیه را وارد نمایید',
    			'taxp.numeric' => 'هزینه مشاهده آدرس را بصورت صحیح وارد نمایید',
    			'bis.required' => 'هزینه بازاریابی را وارد نمایید',
    			'bis.numeric' => 'هزینه بازاریابی را بصورت صحیح وارد نمایید', 
    		]);
$updatee = \DB::table('mngindex')->where('id', '=', '1')  ->update(['ind_taxp' => $request->taxp ,   'ind_bis' => $request->bis ,     'ind_createdatdate' =>  date('Y-m-d H:i:s')   ]); 
 

			 $nametr = Session::flash('statust', ' ویرایش هزینه ها با موفقیت انجام شد .');
		  	$nametrt = Session::flash('sessurl', 'editcost');		  	

 return view('superadmin.success');

    		
    		
  }	else{ return redirect('superadmin/sign-in'); }
		}	

				
	public function addelanuser(){
if (Session::has('signsuperadmin')){
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




	public function addelanusergroup(){
if (Session::has('signsuperadmin')){
$groupstudents = \DB::table('groupuser') ->orderBy('id', 'desc')->get();	
 return view('superadmin.addelanusergroup' , ['groupstudents' => $groupstudents    ]);
  }	else{ return redirect('superadmin/sign-in'); }
		}	






public function addelanusergroupPost(Request $request){
if (Session::has('signsuperadmin')){ 	
    	
    	$this->validate($request,[
    			'name' => 'required',
    			'tit' => 'required|min:3|max:99',
    			'des' => 'required|min:5|max:4999'
    		],[
    			'name.required' => 'گیرندگان اطلاعیه مشخص نشده است',
    			'tit.required' => 'لطفا عنوان تیکت را وارد نمایید',
    			'tit.min' => 'عنوان تیکت تایپ شده نامعتبر است',
    			'tit.max' => 'یوزرنیم شما باید کمتر ازعنوان تیکت تایپ شده نامعتبر استکارکتر باشد',
    			'des.required' => 'لطفا متن پیام خود را وارد نمایید',
    			'des.min' => 'متن پیام نامعتبر است',
    			'des.max' => 'متن پیام نامعتبر است',
    		]);
 

$panelsms = \DB::table('panelsms')->where('id', '=',  1)  ->orderBy('id', 'desc')->first();
include(config_path().'/../sms/api_send_sms.php');

$quans = \DB::table('listgroupuser')->where([
    ['listgrus_grusid', '=', $request->name],])
    ->orderBy('id', 'desc')->get();	 

if($request->name != NULL)  {
foreach($quans as $quan) { 
	
DB::table('ticket')->insert([
    ['tik_tit' => $request->tit ,     'tik_createdatdate' =>  date('Y-m-d H:i:s') , 'tik_fromarou' => 1 , 'tik_toarou' => 4 , 'tik_toid' => $quan->listgrus_userid ,  'tik_fromsh' => 1 , 'tik_tosh' => 1 , 'tik_active' => 1 , 'tik_fromread' => 1 , 'tik_toread' => 0]
]);

$users = DB::table('ticket')->where('tik_tit', $request->tit)->orderBy('id', 'desc')->first(); 
$idtik= $users->id;   
DB::table('message')->insert([
    ['mes_ticket' => $idtik ,  'mes_des' => $request->des   , 'mes_createdatdate' =>  date('Y-m-d H:i:s') , 'mes_flg' =>  3    ]
]);


 	$user = \DB::table('user')->where('id', '=', $quan->listgrus_userid)  ->orderBy('id', 'desc')->first();
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



	public function elanattikdeluser($id){
if (Session::has('signsuperadmin')){
		
$message = \DB::table('message')->where([['message.mes_ticket', '=', $id], ])  ->delete();
$ticket = \DB::table('ticket')->where([['ticket.id', '=', $id], ])  ->delete();

$nametr = Session::flash('statust', 'اطلاعیه شما با موفقیت حذف شد.');
$nametrt = Session::flash('sessurl', 'viewselanats');
return view('superadmin.success');

 }	else{ return redirect('superadmin/sign-in'); }
}



				
	public function addelanprofessor(){
if (Session::has('signsuperadmin')){
$professors = \DB::table('professors') ->orderBy('id', 'desc')->get();	
 return view('superadmin.addelanprofessor' , ['professors' => $professors    ]);
  }	else{ return redirect('superadmin/sign-in'); }
		}	







public function addelanprofessorPost(Request $request){
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
    ['tik_tit' => $request->tit ,     'tik_createdatdate' =>  date('Y-m-d H:i:s') , 'tik_fromarou' => 1 , 'tik_toarou' => 3 , 'tik_toid' => $quan ,  'tik_fromsh' => 1 , 'tik_tosh' => 1 , 'tik_active' => 1 , 'tik_fromread' => 1 , 'tik_toread' => 0]
]);

$users = DB::table('ticket')->where('tik_tit', $request->tit)->orderBy('id', 'desc')->first(); 
$idtik= $users->id;   
DB::table('message')->insert([
    ['mes_ticket' => $idtik ,  'mes_des' => $request->des   , 'mes_createdatdate' =>  date('Y-m-d H:i:s') , 'mes_flg' =>  3    ]
]);



 	$user = \DB::table('professors')->where('id', '=', $quan)  ->orderBy('id', 'desc')->first();
if($request->email=='1'){
if ( $user->professor_email != '')  {
 $usernamee = $user->professor_username; 
 $titmes= $request->tit;
 $mestt='متن اطلاعیه';
 $mesnot = $request->des; 
   Mail::send('superadmin.mail', ['user' => $user , 'usernamee' => $usernamee, 'mesnot' => $mesnot, 'titmes' => $titmes , 'mestt' => $mestt], function ($m) use ($user) {       
$m->from('info@kargo.biz', 'اطلاعیه جدید');
$m->to($user->professor_email, $user->professor_email)->subject('اطلاعیه جدید');
        }); 	
 }	}

if($request->tell=='1'){
if ( $user->professor_tell != '')  {
	 
$message='با عرض سلام '.$user->professor_name.' عزیز.'.$request->des;
$result = Send_SMS($panelsms->sms_username, $panelsms->sms_password, $panelsms->sms_fromnumber, $user->professor_tell, $message , 0, false) ; } }

	






	

 }
 	  }     		
    		
			 $nametr = Session::flash('statust', 'اطلاع رسانی به کاربران انتخابی با موفقیت انجام شد.');
		  	$nametrt = Session::flash('sessurl', 'viewselanatsprofessor');
		  return view('superadmin.success'); 
 }	else{ return redirect('superadmin/sign-in'); }   
 }  




	public function addelanprofessorgroup(){
if (Session::has('signsuperadmin')){
$groupprofessors = \DB::table('groupprofessor') ->orderBy('id', 'desc')->get();	
 return view('superadmin.addelanprofessorgroup' , ['groupprofessors' => $groupprofessors    ]);
  }	else{ return redirect('superadmin/sign-in'); }
		}	






public function addelanprofessorgroupPost(Request $request){
if (Session::has('signsuperadmin')){ 	
    	
    	$this->validate($request,[
    			'name' => 'required',
    			'tit' => 'required|min:3|max:99',
    			'des' => 'required|min:5|max:4999'
    		],[
    			'name.required' => 'گیرندگان اطلاعیه مشخص نشده است',
    			'tit.required' => 'لطفا عنوان تیکت را وارد نمایید',
    			'tit.min' => 'عنوان تیکت تایپ شده نامعتبر است',
    			'tit.max' => 'یوزرنیم شما باید کمتر ازعنوان تیکت تایپ شده نامعتبر استکارکتر باشد',
    			'des.required' => 'لطفا متن پیام خود را وارد نمایید',
    			'des.min' => 'متن پیام نامعتبر است',
    			'des.max' => 'متن پیام نامعتبر است',
    		]);
 

$panelsms = \DB::table('panelsms')->where('id', '=',  1)  ->orderBy('id', 'desc')->first();
include(config_path().'/../sms/api_send_sms.php');
 
 
$quans = \DB::table('listgroupprofessor')->where([
    ['listgrpr_grprid', '=', $request->name],])
    ->orderBy('id', 'desc')->get();	 

if($request->name != NULL)  {
foreach($quans as $quan) { 
	
DB::table('ticket')->insert([
    ['tik_tit' => $request->tit ,     'tik_createdatdate' =>  date('Y-m-d H:i:s') , 'tik_fromarou' => 1 , 'tik_toarou' => 3 , 'tik_toid' => $quan->listgrpr_professorid ,  'tik_fromsh' => 1 , 'tik_tosh' => 1 , 'tik_active' => 1 , 'tik_fromread' => 1 , 'tik_toread' => 0]
]);

$users = DB::table('ticket')->where('tik_tit', $request->tit)->orderBy('id', 'desc')->first(); 
$idtik= $users->id;   
DB::table('message')->insert([
    ['mes_ticket' => $idtik ,  'mes_des' => $request->des   , 'mes_createdatdate' =>  date('Y-m-d H:i:s') , 'mes_flg' =>  3    ]
]);



 	$user = \DB::table('professors')->where('id', '=', $quan->listgrpr_professorid)  ->orderBy('id', 'desc')->first();
if($request->email=='1'){
if ( $user->professor_email != '')  {
 $usernamee = $user->professor_username; 
 $titmes= $request->tit;
 $mestt='متن اطلاعیه';
 $mesnot = $request->des; 
   Mail::send('superadmin.mail', ['user' => $user , 'usernamee' => $usernamee, 'mesnot' => $mesnot, 'titmes' => $titmes , 'mestt' => $mestt], function ($m) use ($user) {       
$m->from('info@kargo.biz', 'اطلاعیه جدید');
$m->to($user->professor_email, $user->professor_email)->subject('اطلاعیه جدید');
        }); 	
 }	}

if($request->tell=='1'){
if ( $user->professor_tell != '')  {
	 
$message='با عرض سلام '.$user->professor_name.' عزیز.'.$request->des;
$result = Send_SMS($panelsms->sms_username, $panelsms->sms_password, $panelsms->sms_fromnumber, $user->professor_tell, $message , 0, false) ; } }

 }
 	  }     		
    		
			 $nametr = Session::flash('statust', 'اطلاع رسانی به کاربران انتخابی با موفقیت انجام شد.');
		  	$nametrt = Session::flash('sessurl', 'viewselanatsprofessor');
		  return view('superadmin.success'); 
 }	else{ return redirect('superadmin/sign-in'); }   
 }  








	public function viewselanatsprofessors(){
if (Session::has('signsuperadmin')){ 
$admins = \DB::table('professors') 
->join('ticket', 'professors.id', '=', 'ticket.tik_toid') 
->where([
    ['ticket.tik_fromarou', '=', 1],
    ['ticket.tik_toarou', '=', 3],
    ['ticket.tik_fromsh', '=', 1],])
    ->orderBy('ticket.id', 'desc')->get();
  
return view('superadmin.viewselanatsprofessor', ['admins' => $admins]);
 }	else{ return redirect('superadmin/sign-in'); } 
}	



	public function elanattikprofessor($id){
if (Session::has('signsuperadmin')){
	Session::put('idimg', $id);
$tickets = \DB::table('professors') 
->join('ticket', 'professors.id', '=', 'ticket.tik_toid')->where([
    ['ticket.id', '=', $id],
    ['tik_fromarou', '=', 1],
    ['tik_toarou', '=', 3],
    ['tik_tosh', '=', 1],])  ->orderBy('ticket.id', 'desc')->get();
$messages = \DB::table('message')->where('mes_ticket', '=', $id)  ->orderBy('id')->get();

 
return view('superadmin.elanatprf', ['tickets' => $tickets], ['messages' => $messages]); 
 }	else{ return redirect('superadmin/sign-in'); }
				}




	public function elanattikdelprofessor($id){
if (Session::has('signsuperadmin')){
		
$message = \DB::table('message')->where([['message.mes_ticket', '=', $id], ])  ->delete();
$ticket = \DB::table('ticket')->where([['ticket.id', '=', $id], ])  ->delete();

$nametr = Session::flash('statust', 'اطلاعیه شما با موفقیت حذف شد.');
$nametrt = Session::flash('sessurl', 'viewselanatsprofessor');
return view('superadmin.success');

 }	else{ return redirect('superadmin/sign-in'); }
}




	public function viewsfinicals(){
if (Session::has('signsuperadmin')){
		
$admins = \DB::table('students')
->join('liststudentterm', 'students.id', '=', 'liststudentterm.liststud_idstudent')
->join('period', 'liststudentterm.liststud_period', '=', 'period.id')
->join('finicals', 'liststudentterm.liststud_finical', '=', 'finicals.id')
->where([['period.period_active', '=', 1], ])  ->orderBy('finicals.id', 'desc')->get();

return view('superadmin.viewsfinicals', ['admins' => $admins ]);
 }	else{ return redirect('superadmin/sign-in'); }
}



	public function searchfinical(){
if (Session::has('signsuperadmin')){
$lngmenus= \DB::table('language') ->where([['id', '<>',  '0'],['lng_active', '=',  '1'],])->orderBy('id', 'desc')->get();
$lngmenu=\DB::table('language') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first();
 	
$admins = \DB::table('user') 
->join('marsole', 'user.user_ncode', '=', 'marsole.mar_codmoshtari')  
->join('finicals', 'marsole.id', '=', 'finicals.finical_marid')  
->where([  
    ['finicals.finical_arou', '=', '4'] , ])
    ->orderBy('finicals.id', 'desc')->get();

return view('superadmin.searchfinical', ['lngmenus' => $lngmenus , 'lngmenu' => $lngmenu,'admins' => $admins ]);
 }	else{ return redirect('superadmin/sign-in'); }
}
		



	public function viewsfinicalthreedaysago(){
if (Session::has('signsuperadmin')){
$lngmenus= \DB::table('language') ->where([['id', '<>',  '0'],['lng_active', '=',  '1'],])->orderBy('id', 'desc')->get();
$lngmenu=\DB::table('language') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first();
 


  $end_date = date("Y-m-d", strtotime("- 3 days")); 
 
 	
$admins = \DB::table('user') 
->join('marsole', 'user.user_ncode', '=', 'marsole.mar_codmoshtari')  
->join('finicals', 'marsole.id', '=', 'finicals.finical_marid')  
->where([  
    ['finicals.finical_arou', '=', '4'] ,
    ['finicals.finical_createdatdate', '>=', $end_date] , ])
    ->orderBy('finicals.id', 'desc')->get();

return view('superadmin.viewsfinical', ['lngmenus' => $lngmenus , 'lngmenu' => $lngmenu,'admins' => $admins ]);
 }	else{ return redirect('superadmin/sign-in'); }
}
		





	public function viewsfinicalsup(){
if (Session::has('signsuperadmin')){
$lngmenus= \DB::table('language') ->where([['id', '<>',  '0'],['lng_active', '=',  '1'],])->orderBy('id', 'desc')->get();
$lngmenu=\DB::table('language') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first();
 	
$admins = \DB::table('user') 
->join('marsole', 'user.user_ncode', '=', 'marsole.mar_codmoshtari')  
->join('finicals', 'marsole.id', '=', 'finicals.finical_marid')  
->where([  
    ['finicals.finical_arou', '=', '4'] , ])
    ->orderBy('finicals.id', 'desc')->get();

return view('superadmin.viewsfinical', ['lngmenus' => $lngmenus , 'lngmenu' => $lngmenu,'admins' => $admins ]);
 }	else{ return redirect('superadmin/sign-in'); }
}
		




	public function viewsfinicalcharge(){
if (Session::has('signsuperadmin')){
$lngmenus= \DB::table('language') ->where([['id', '<>',  '0'],['lng_active', '=',  '1'],])->orderBy('id', 'desc')->get();
$lngmenu=\DB::table('language') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first();
 	
$admins = \DB::table('user') 
->join('marsole', 'user.user_ncode', '=', 'marsole.mar_codmoshtari')  
->join('finicals', 'marsole.id', '=', 'finicals.finical_marid')  
->where([  
    ['finicals.finical_arou', '=', '4'] ,  
    ['finicals.finical_marpay', '=', '5'],
    ['finicals.finical_payment', '=', '0'],
    ['finicals.finical_marid', '<>', 0],  
    ['finicals.finical_inc', '=', 4],])
    ->orderBy('finicals.id', 'desc')->get();
    
 

return view('superadmin.viewsfinicalcharge', ['lngmenus' => $lngmenus , 'lngmenu' => $lngmenu,'admins' => $admins ]);
 }	else{ return redirect('superadmin/sign-in'); }
}
		


	public function finicalsuperadmin($id){
if (Session::has('signsuperadmin')){


$admins = \DB::table('user') 
->join('marsole', 'user.user_ncode', '=', 'marsole.mar_codmoshtari')  
->join('finicals', 'marsole.id', '=', 'finicals.finical_marid')  
->where([  
    ['finicals.id', '=', $id] ,  
    ['finicals.finical_arou', '=', '4'] , ])
    ->orderBy('finicals.id', 'desc')->get();


 

$getwaypays=\DB::table('getwaypay')->where('getway_active', '=', 1)   ->orderBy('id' )->get();
 
 return view('superadmin.finicaluser' , [ 'admins' => $admins  , 'getwaypays' => $getwaypays     ]);
 }	else{ return redirect('superadmin/sign-in'); }
}
		


	public function finicalsup($id){
if (Session::has('signsuperadmin')){
$admins = \DB::table('students')
->join('liststudentterm', 'students.id', '=', 'liststudentterm.liststud_idstudent')
->join('period', 'liststudentterm.liststud_period', '=', 'period.id')
->join('finicals', 'liststudentterm.liststud_finical', '=', 'finicals.id')
->where([['finicals.id', '=', $id], ]) ->orderBy('finicals.id', 'desc')->get();
return view('superadmin.finical', ['admins' => $admins    ]); 
 }	else{ return redirect('superadmin/sign-in'); }
 }

 
 
	public function finicalsuppost($id , Request $request){
if (Session::has('signsuperadmin')){ 

$updatee = \DB::table('finicals')
->where([['finicals.id', '=', $id],['finicals.finical_iduser', '<>', 0], ])  ->
 update(['finical_payment' => 1 , 'finical_paymentdate' => date('Y-m-d H:i:s')   ]); 
 
$nametr = Session::flash('statust', 'مبلغ فاکتور از طرف مدیریت با موفقیت پرداخت شده است.');
$nametrt = Session::flash('sessurl', 'viewsfinicals/finical/'.$id.'');
return view('superadmin.success');

 }	else{ return redirect('superadmin/sign-in'); }
}


 
	


	public function deletfinical($id){
if (Session::has('signsuperadmin')){
		
$finicals = \DB::table('finicals')->where([['finicals.id', '=', $id], ])  ->delete();
$liststudentterm = \DB::table('liststudentterm')->where([['liststudentterm.liststud_finical', '=', $id], ])  ->delete();

$nametr = Session::flash('statust', 'فاکتور شما با موفقیت حذف شد.');
$nametrt = Session::flash('sessurl', 'viewsfinicals');
return view('superadmin.success');

 }	else{ return redirect('superadmin/sign-in'); }
}


	public function viewsgetwaypaysshop(){
		if (Session::has('signsuperadmin')){ 
		$admins = \DB::table('getwaypay') ->where([
    ['getwaypay.id', '>', '9'],])
    ->orderBy('id', 'desc')->get();
return view('superadmin.viewsgetwaypaysshop', ['admins' => $admins]);
}	else{ return redirect('superadmin/sign-in'); }
}

		
		
		
	public function viewsgetwaypays(){
		if (Session::has('signsuperadmin')){ 
		$admins = \DB::table('getwaypay') ->where([
    ['getwaypay.id', '<', '9'],])
    ->orderBy('id', 'desc')->get();
return view('superadmin.viewsgetwaypays', ['admins' => $admins]);
}	else{ return redirect('superadmin/sign-in'); }
}



	public function editgetwaypay($id){
if (Session::has('signsuperadmin')){
$admins = \DB::table('getwaypay')->where('id', '=', $id)  ->orderBy('id', 'desc')->get();
return view('superadmin.getwaypay', ['admins' => $admins]); }	
else{ return redirect('superadmin/sign-in'); }
				}
	




		
		
	public function editgetwaypaypost($id  , Request $request ){
if (Session::has('signsuperadmin')){ 

 if($id==1||$id==11){
 $updatee = \DB::table('getwaypay')->where('id', '=', $id)  ->update(['getway_terminal' => $request->terminal ,  'getway_username' => $request->username ,  'getway_password' => $request->password ,  'getway_createdatdate' => date('Y-m-d H:i:s') ]); 	
 }
   if($id==2||$id==12){
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
				



		
	public function viewspanelsms(){
		if (Session::has('signsuperadmin')){ 
$admins = \DB::table('panelsms') ->orderBy('id', 'desc')->get();
return view('superadmin.viewspanelsms', ['admins' => $admins]);
}	else{ return redirect('superadmin/sign-in'); }
}



	public function editpanelsms($id){
if (Session::has('signsuperadmin')){
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
		




	public function editcomod(){
if (Session::has('signsuperadmin')){ 

$admins = \DB::table('comodid') ->orderBy('id', 'desc')->get();
return view('superadmin.editcomod', ['admins' => $admins]); }	
else{ return redirect('superadmin/sign-in'); }
}
 		

public function editcomodpost(Request $request){
if (Session::has('signsuperadmin')){    	    	
    	$this->validate($request,[
    			'name' => 'required|min:10', 
    		],[
    			'name.required' => 'لطفا امکانات را تایپ نمایید',
    			'name.min' => 'امکانت کوتاه است', 
    			
    		]);   
 
 DB::table('comodid')->insert([
    ['comod_name' => $request->name      ]
]);   	
  		 
$nametr = Session::flash('statust', 'امکانات با موفقیت ثبت شد.');
$nametrt = Session::flash('sessurl', 'comodid');
		  return view('superadmin.success'); 	    	 }	
else{ return redirect('superadmin/sign-in'); }    	  
}
			

	
	
	public function deletcomod($id){
		if (Session::has('signsuperadmin')){ 
		  	$admins = \DB::table('comodid')->where('id', '=', $id)->delete(); 

		  	$nametr = Session::flash('statust', 'حذف امکانات با موفقیت انجام شد.');
		  	$nametrt = Session::flash('sessurl', 'comodid');
		  	
	return view('superadmin.success', ['admins' => $admins]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}				



	public function editcomodid($id){
if (Session::has('signsuperadmin')){ 

	Session::put('idimg', $id);
$admins = \DB::table('comodid') ->where('id', '=', $id)  ->orderBy('id', 'desc')->first();
return view('superadmin.editcomdid', ['admins' => $admins]); }	
else{ return redirect('superadmin/sign-in'); }
}
 	
		
	public function editcomodidpost($id  , Request $request ){
if (Session::has('signsuperadmin')){ 
 
 	$this->validate($request,[
    			'comod_name' => 'required', 
    		],[
    			'comod_name.required' => 'لطفا امکانات را تایپ نمایید', 
    			
    		]);   
 
 $updatee = \DB::table('comodid')->where('id', '=', $id)  ->update(['comod_name' => $request->comod_name   ]); 	 
	 
$nametr = Session::flash('statust', 'امکانات باموفقیت ویرایش شد.');
$nametrt = Session::flash('sessurl', 'comodid');

return view('superadmin.success');
}	else{ return redirect('superadmin/sign-in'); }
}
		
		
	public function addexamlevel(){
		if (Session::has('signsuperadmin')){ 
 return view('superadmin.addexamlevel');
	}	
else{ return redirect('superadmin/sign-in'); }
		}
		


public function addexamlevelPost(Request $request){
		if (Session::has('signsuperadmin')){ 	
    	
    	$this->validate($request,[
    			'tit' => 'required|min:5|max:99',
    			'des' => 'required|min:5|max:999'
    		],[
    			'tit.required' => 'لطفا نام آزمون را وارد نمایید',
    			'tit.min' => 'نام آزمون وارد شده نامعتبر است',
    			'tit.max' => 'نام آزمون وارد شده نامعتبر است',
    			'des.required' => 'لطفا توضیحات مربوط به آزمون را به درستی وارد نمایید',
    			'des.min' => 'متن توضیحات نامعتبر است',
    			'des.max' => 'متن توضیحات نامعتبر است',
    		]);
    	
DB::table('exam')->insert([
    ['exam_tit' => $request->tit ,   'exam_des' => $request->des ,     'exam_createdatdate' =>  date('Y-m-d H:i:s') , 'exam_arou' => 3    ]
]);
 
			 $nametr = Session::flash('statust', 'نام و توضیحات مربوط به آزمون تعیین سطح شما با موفقیت ثبت شد.');
		  	$nametrt = Session::flash('sessurl', 'viewsexamslevel');
		  return view('superadmin.success');
	}	
else{ return redirect('superadmin/sign-in'); }
 }
 



	public function viewsexamslevel(){
		if (Session::has('signsuperadmin')){ 
$admins = \DB::table('exam') 
->where([
    ['exam.exam_arou', '=', 3], ])
    ->orderBy('exam.id', 'desc')->get();

 
return view('superadmin.viewsexamslevel', ['admins' => $admins]);
} else{ return redirect('superadmin/sign-in'); }
}	


public function deletexamlevel($id , Request $request){
		if (Session::has('signsuperadmin')){ 	  	
    	
$admins = \DB::table('test')->where([
    ['test.test_exam', '=', $id],])
    ->delete();
    
$admins = \DB::table('exam')->where([
    ['exam.id', '=', $id],
    ['exam.exam_arou', '=', 3], ])
    ->delete();
    
			 $nametr = Session::flash('statust', 'آزمون با موفقیت حذف شد.');
		  	$nametrt = Session::flash('sessurl', 'viewsexamslevel');
		  return view('superadmin.success');
    
	}	
else{ return redirect('superadmin/sign-in'); }
}
	
	
	
	
	
	


	public function editexamlevel($id){
		if (Session::has('signsuperadmin')){  
	
 $exams= \DB::table('exam')  
->where([
    ['exam.id', '=', $id],
    ['exam.exam_arou', '=', 3], ])
    ->orderBy('exam.id', 'desc')->get();
    
 $examtests= \DB::table('examtest') 
->join('exam', 'examtest.examtest_idexam', '=', 'exam.id') 
->join('students', 'examtest.examtest_idstudent', '=', 'students.id') 
->where([
    ['exam.id', '=', $id],
    ['exam.exam_arou', '=', 3], ])
    ->orderBy('exam.id', 'desc')->get();
 
 $tests= \DB::table('exam') 
->join('test', 'exam.id', '=', 'test.test_exam') 
->where([
    ['exam.id', '=', $id],
    ['exam.exam_arou', '=', 3], ])
    ->orderBy('test.id')->get();
 
 $count= \DB::table('exam') 
->join('test', 'exam.id', '=', 'test.test_exam') 
->where([
    ['exam.id', '=', $id],
    ['exam.exam_arou', '=', 3], ])
    ->orderBy('test.id', 'desc')->count();
    
return view('superadmin.editexam', ['exams' => $exams , 'tests' => $tests   , 'count' => $count  , 'examtests' => $examtests    ]); 	

	}	
else{ return redirect('superadmin/sign-in'); }
}

	


public function editexamlevelPost($id , Request $request){

		if (Session::has('signsuperadmin')){  	
    	
    	$this->validate($request,[
    			'qst' => 'required|min:4|max:999',
    			'repa' => 'required|min:1|max:222',
    			'repb' => 'required|min:1|max:222',
    			'repc' => 'required|min:1|max:222',
    			'repd' => 'required|min:1|max:222',
    			'key' => 'required'
    		],[
    			'qst.required' => 'لطفا سوال را وارد نمایید',
    			'qst.min' => 'لطفا سوال را به درستی وارد نمایید',
    			'qst.max' => 'لطفا سوال را به درستی وارد نمایید',
    			'repa.required' => 'لطفا تست a را وارد نمایید',
    			'repa.min' => 'تست a کوتاه است',
    			'repa.max' => 'تست a طولانی است',
    			'repb.required' => 'لطفا تست b را وارد نمایید',
    			'repb.min' => 'تست b کوتاه است',
    			'repb.max' => 'تست b طولانی است',
    			'repc.required' => 'لطفا تست c را وارد نمایید',
    			'repc.min' => 'تست c کوتاه است',
    			'repc.max' => 'تست c طولانی است',
    			'repd.required' => 'لطفا تست d را وارد نمایید',
    			'repd.min' => 'تست d کوتاه است',
    			'repd.max' => 'تست d طولانی است',
    			'key.required' => 'علامت زدن کلید سوال اجباری است',
    		]);
    	
DB::table('test')->insert([
    ['test_qst' => $request->qst ,   'test_repa' => $request->repa ,   'test_repb' => $request->repb ,   'test_repc' => $request->repc ,   'test_repd' => $request->repd ,   'test_key' => $request->key ,   'test_exam' =>  $id  ]
]);
 
			 $nametr = Session::flash('statust', 'سوال با موفقیت به آزمون اضافه شد.');
		  	$nametrt = Session::flash('sessurl', 'viewsexamslevel/exam/'.$id.'');
		  return view('superadmin.success');
	}	
else{ return redirect('superadmin/sign-in'); }
 }
 	

	
	
					
public function delettestlevel($id , Request $request){
		if (Session::has('signsuperadmin')){  

 $testsf= \DB::table('test') 
->join('exam', 'test.test_exam', '=', 'exam.id') 
->where([
    ['test.id', '=', $id],
    ['exam.exam_arou', '=', 3], ])
    ->orderBy('test.id')->first();  
    
  $admins = \DB::table('test')->where([
    ['test.id', '=', $id],])
    ->delete();
    
$nametr = Session::flash('statust', 'سوال از آزمونن مربوطه با موفقیت حذف شد.');
$nametrt = Session::flash('sessurl', 'viewsexamslevel/exam/'.$testsf->id.'');
return view('superadmin.success');
    	}	
else{ return redirect('superadmin/sign-in'); }
}
	

		
	
		
	public function editlogosocial(){
		if (Session::has('signsuperadmin')){
			$admins = \DB::table('mngindex') ->where('id', '=', '1')  ->orderBy('id', 'desc')->get();
return view('superadmin.editlogosocial', ['admins' => $admins]);}	
else{ return redirect('superadmin/sign-in'); }
 
				}
 
		
	
		
	public function editlogosocialinsta(){
		if (Session::has('signsuperadmin')){
			$admins = \DB::table('mngindex') ->where('id', '=', '1')  ->orderBy('id', 'desc')->get();
return view('superadmin.editlogosocialinsta', ['admins' => $admins]);}	
else{ return redirect('superadmin/sign-in'); }
 
				}
 


	public function addcategory(){
		if (Session::has('signsuperadmin')){
 return view('superadmin.addcategory');}	
else{ return redirect('superadmin/sign-in'); }
 
				}
				
				
				

public function addcategoryPost(Request $request)
    {
if (Session::has('signsuperadmin')){    	
    	
    	$this->validate($request,[
    			'catname' => 'required|max:44' 
    		],[
    			'catname.required' => 'لطفا نام کتوگری را وارد نمایید', 
    			'catname.max' => 'نام کتوگری نمی تواند بیشتر از 44 کاراکتر باشد', 
    		]);
    		  
		
DB::table('catmahsol')->insert([
    ['cat_name' => $request->catname ]
]);

 $nametr = Session::flash('statust', 'ثبت کتوگری باموفقیت انجام شد.');
 $nametrt = Session::flash('sessurl', 'viewscategory');
		  return view('superadmin.success');
  
    
  }	
else{ return redirect('superadmin/sign-in'); }    
    	
    }
	
	
	
	public function viewscategory(){
		if (Session::has('signsuperadmin')){ 
$admins = \DB::table('catmahsol') ->orderBy('cat_id', 'desc')->get();
return view('superadmin.viewscategory', ['admins' => $admins]);
}	else{ return redirect('superadmin/sign-in'); }
}
	
	
	

	public function editcategory($id){
if (Session::has('signsuperadmin')){ 
	Session::put('idimg', $id);
$admins = \DB::table('catmahsol')->where('cat_id', '=', $id)  ->orderBy('cat_id', 'desc')->first();
return view('superadmin.editcategory', ['admins' => $admins]); }	
else{ return redirect('superadmin/sign-in'); }
				}


	public function editcategoryPost($id  , Request $request ){
if (Session::has('signsuperadmin')){ 
$this->validate($request,[
    			'catname' => 'required|max:44', 
    		],[
    			'catname.required' => 'نام کتوگری را وارد نمایید', 
    			'catname.max' => 'نام کتوگری غیرقابل قبول', 
    			
    		]);
 
 
$updatee = \DB::table('catmahsol')->where('cat_id', '=', $id)  ->update(['cat_name' => $request->catname  ]); 
  
$nametr = Session::flash('statust', 'ویرایش کتوگری باموفقیت انجام شد.');
$nametrt = Session::flash('sessurl', 'viewscategory');
return view('superadmin.success');
}	else{ return redirect('superadmin/sign-in'); }
}
		



		
	public function acccategory($id){
		if (Session::has('signsuperadmin')){ 				
$updatee = \DB::table('catmahsol')->where('cat_id', '=', $id)  ->update(['cat_active' => 1   ]);  	
		  	$nametr = Session::flash('statust', 'کتوگری محصول باموفقیت فعال شد.');
		  	$nametrt = Session::flash('sessurl', 'viewscategory');		  	
	return view('superadmin.success');
	}	
else{ return redirect('superadmin/sign-in'); }
				}
				


		
	public function rejcategory($id){
		if (Session::has('signsuperadmin')){ 				
$updatee = \DB::table('catmahsol')->where('cat_id', '=', $id)  ->update(['cat_active' => 0   ]);  		
		  	$nametr = Session::flash('statust', 'کتوگری محصول غیرفعال شد.');
		  	$nametrt = Session::flash('sessurl', 'viewscategory');		  	
	return view('superadmin.success');
	}	
else{ return redirect('superadmin/sign-in'); }
				}
				


	
		
	public function deletcategory($id){
		if (Session::has('signsuperadmin')){ 
		  	$admins = \ DB::table('catmahsol')->where('cat_id', $id)->get();
		  	$admins = \DB::table('catmahsol')->where('cat_id', '=', $id)->delete(); 
		  	$nametr = Session::flash('statust', 'حذف کتوگری باموفقیت انجام شد.');
		  	$nametrt = Session::flash('sessurl', 'viewscategory');
		  	
	return view('superadmin.success', ['admins' => $admins]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}
		
		
		
		

	public function addgroupcat(){
if (Session::has('signsuperadmin')){
$admins = \DB::table('catmahsol') ->orderBy('cat_id', 'desc')->get();
return view('superadmin.addgroupcat', ['admins' => $admins]); 
	 }	
else{ return redirect('superadmin/sign-in'); }
				}





public function addgroupcatpost(Request $request)
    {
if (Session::has('signsuperadmin')){    	
    	
    	$this->validate($request,[
    			'groupname' => 'required|max:44' ,
    			'category' => 'required' ,
    			'group_profit' => 'required|numeric', 
    		],[
    			'groupname.required' => 'لطفا زیرگروه کتوگری را وارد نمایید', 
    			'groupname.max' => 'زیرگروه کتوگری نمی تواند بیشتر از 44 کاراکتر باشد', 
    			'category.required' => 'لطفا کتو گری را انتخاب نمایید', 
    			'group_profit.required' => 'درصد سود مدیریت را وارد نمایید', 
    			'group_profit.numeric' => 'لطفا درصد سود مدیریت را به فرمت عددی وارد نمایید', 
    		]);
    		  
		
DB::table('groupcat')->insert([
    ['group_name' => $request->groupname , 'group_catid' => $request->category ,  'group_profit' => $request->group_profit ,    'group_createdatdate' =>  date('Y-m-d H:i:s')    ]
]);

 $nametr = Session::flash('statust', 'ثبت زیرگروه کتو گری با موفقیت انجام شد.');
 $nametrt = Session::flash('sessurl', 'viewsgroupcat');
		  return view('superadmin.success');
  
    
  }	
else{ return redirect('superadmin/sign-in'); }    
    	
    }
	
	

	public function viewsgroupcat(){
		if (Session::has('signsuperadmin')){  
$admins = \DB::table('catmahsol')
->join('groupcat', 'catmahsol.cat_id', '=', 'groupcat.group_catid')  ->orderBy('cat_id', 'desc')->get();
return view('superadmin.viewsgroupcat', ['admins' => $admins]);
}	else{ return redirect('superadmin/sign-in'); }
}
	

	public function editgropcat($id){
if (Session::has('signsuperadmin')){ 
	Session::put('idimg', $id);
$admins = \DB::table('groupcat')->where('group_id', '=', $id)  ->orderBy('group_id', 'desc')->first();
return view('superadmin.editgropcat', ['admins' => $admins]); }	
else{ return redirect('superadmin/sign-in'); }
				}




	
	public function editgropcatpost($id  , Request $request ){
if (Session::has('signsuperadmin')){ 
$this->validate($request,[
    			'groupname' => 'required|max:44', 
    			'group_profit' => 'required|numeric', 
    		],[
    			'groupname.required' => 'نام گروه محصول را وارد نمایید', 
    			'groupname.max' => 'نام گروه محصول طولانی می باشد', 
    			'group_profit.required' => 'درصد سود مدیریت را وارد نمایید', 
    			'group_profit.numeric' => 'لطفا درصد سود مدیریت را به فرمت عددی وارد نمایید', 
    			
    		]);
 
 
$updatee = \DB::table('groupcat')->where('group_id', '=', $id)  ->update(['group_name' => $request->groupname , 'group_profit' => $request->group_profit  ]); 
  
$nametr = Session::flash('statust', 'ویرایش گروه محصول با موفقیت انجام شد.');
$nametrt = Session::flash('sessurl', 'viewsgroupcat');
return view('superadmin.success');
}	else{ return redirect('superadmin/sign-in'); }
}
	
	
		
	public function accgropcat($id){
		if (Session::has('signsuperadmin')){ 				
$updatee = \DB::table('groupcat')->where('group_id', '=', $id)  ->update(['group_active' => 1   ]); 
 				
		  	$nametr = Session::flash('statust', 'گروه بندی محصول باموفقیت فعال شد.');
		  	$nametrt = Session::flash('sessurl', 'viewsgroupcat');		  	
	return view('superadmin.success');
	}	
else{ return redirect('superadmin/sign-in'); }
				}
				

		
	public function rejgropcat($id){
		if (Session::has('signsuperadmin')){ 				
$updatee = \DB::table('groupcat')->where('group_id', '=', $id)  ->update(['group_active' => 0   ]); 
 				
		  	$nametr = Session::flash('statust', 'گروه بندی محصول غیرفعال شد.');
		  	$nametrt = Session::flash('sessurl', 'viewsgroupcat');		  	
	return view('superadmin.success');
	}	
else{ return redirect('superadmin/sign-in'); }
				}
				

	
	
		
	public function deletgropcat($id){
		if (Session::has('signsuperadmin')){ 
		  	$admins = \ DB::table('groupcat')->where('group_id', $id)->get();
		  	$admins = \DB::table('groupcat')->where('group_id', '=', $id)->delete(); 
		  	$nametr = Session::flash('statust', 'حذف گروه محصول با موفقیت انجام شد.');
		  	$nametrt = Session::flash('sessurl', 'viewsgroupcat');
		  	
	return view('superadmin.success', ['admins' => $admins]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}



		
	public function viewsnotices(){
if (Session::has('signsuperadmin')){ 
 
$admins = \DB::table('formatnotif') ->orderBy('id', 'asc')->get();
return view('superadmin.viewsnotices', ['admins' => $admins]);
}	
else{ return redirect('superadmin/sign-in'); }
}



	
	public function editnoti($id){
if (Session::has('signsuperadmin')){ 

$admins = \DB::table('formatnotif')->where('id', '=', $id)  ->orderBy('id', 'desc')->get();
 
return view('superadmin.editnoti', ['admins' => $admins ]); }	
else{ return redirect('superadmin/sign-in'); }
}


	public function editnotipost($id  , Request $request ){
if (Session::has('signsuperadmin')){ 
$this->validate($request,[ 
    			'desem' => 'required|min:10|max:1900', 
    		],[  
    			'desem.required' => 'لطفا متن ایمیل را وارد نمایید',
    			'desem.min' => 'متن ایمیل نمی تواند کمتر از 10 کاراکتر باشد ',
    			'desem.max' => 'متن ایمیل نمی تواند بیشتر از 1900 کاراکتر باشد ', 
    			
    		]);


 
$updatee = \DB::table('formatnotif')->where('id', '=', $id)  ->update([  'form_desem' => $request->desem  ,   'form_des' => $request->des ]); 
 
$nametr = Session::flash('statust', 'فرمت پیامک و ایمیل باموفقیت ویرایش شد.');
$nametrt = Session::flash('sessurl', 'viewsnotices'); 
	 
return view('superadmin.success');  
 
 }
else{ return redirect('superadmin/sign-in'); }
}





	public function addsocial(){
if (Session::has('signsuperadmin')){
$admins = \DB::table('social') ->orderBy('id', 'desc')->get();
return view('superadmin.addsocial', ['admins' => $admins]); 
	 }	
else{ return redirect('superadmin/sign-in'); }
				}



	
	public function addsocialpost(  Request $request ){
if (Session::has('signsuperadmin')){ 
$this->validate($request,[
    			'soc_name' => 'required', 
    			'soc_link' => 'required|min:8', 
    		],[
    			'soc_name.required' => 'نام شبکه جتماعی را وارد نمایید',  
    			'soc_link.required' => 'لینک شبکه اجتماعی را وارد نمایید', 
    			'soc_link.min' => 'فرمت لینک شبکه اجتماعی کوتاه و غیرقابل قبول می باشد', 
    			
    		]);
 


 DB::table('social')->insert([
    ['soc_name' => $request->soc_name , 'soc_link' => $request->soc_link     ]
]);   	


  
$nametr = Session::flash('statust', 'شبکه اجتماعی باموفقیت ثبت شد.');
$nametrt = Session::flash('sessurl', 'managesocial');
return view('superadmin.success');
}	else{ return redirect('superadmin/sign-in'); }
}
	
	



	public function managesocial(){
		if (Session::has('signsuperadmin')){   
$admins = \DB::table('social') ->orderBy('id', 'desc')->get();
return view('superadmin.managesocial', ['admins' => $admins]);
}	else{ return redirect('superadmin/sign-in'); }
}
	
	
	
	
	
	

	
	public function managesocialpost($id  , Request $request ){
if (Session::has('signsuperadmin')){ 
$this->validate($request,[
    			'soc_name' => 'required', 
    			'soc_link' => 'required|min:8', 
    		],[
    			'soc_name.required' => 'نام شبکه جتماعی را وارد نمایید',  
    			'soc_link.required' => 'لینک شبکه اجتماعی را وارد نمایید', 
    			'soc_link.min' => 'فرمت لینک شبکه اجتماعی کوتاه و غیرقابل قبول می باشد', 
    			
    		]);
 
 
$updatee = \DB::table('social')->where('id', '=', $id)  ->update(['soc_name' => $request->soc_name , 'soc_link' => $request->soc_link  ]); 
  
$nametr = Session::flash('statust', 'شبکه اجتماعی باموفقیت ویرایش شد.');
$nametrt = Session::flash('sessurl', 'managesocial');
return view('superadmin.success');
}	else{ return redirect('superadmin/sign-in'); }
}
	
	
	
	
	
	
	


	public function editmanagesocial($id){
if (Session::has('signsuperadmin')){ 
	Session::put('idimg', $id);
$admins = \DB::table('social')->where('id', '=', $id)  ->orderBy('id', 'desc')->first();
return view('superadmin.editmanagesocial', ['admins' => $admins]); }	
else{ return redirect('superadmin/sign-in'); }
				}



 

public function storeusersocial(Request $request)
    {
        $image = $request->file('file');
        $imageName = time().$image->getClientOriginalName();
        $image->move(public_path('images'),$imageName);        
$updatee = \DB::table('social')->where('id', '=', Session::get('idimg'))  ->update(['soc_img' => $imageName   ]);
        return response()->json(['success'=>$imageName]);
    }
		 



		
	public function manageemail(){
		if (Session::has('signsuperadmin')){
			$admins = \DB::table('social') ->where('id', '<>', '0')  ->orderBy('id', 'desc')->get();
return view('superadmin.manageemail', ['admins' => $admins]);}	
else{ return redirect('superadmin/sign-in'); }
 
				}
				
				
				
				 	public function manageemailpost( Request $request ){
if (Session::has('signsuperadmin')){  
$myCheckboxes = $request->input('field_name');
 

if($myCheckboxes != NULL)  {
$updatee = \DB::table('social')->where('id', '<>', 0)  ->update(['soc_email' => '0'   ]);  	
foreach($myCheckboxes as $quan) {		 
$updatee = \DB::table('social')->where('id', '=', $quan)  ->update(['soc_email' => '1'   ]);  	
} 
} else { 
$updatee = \DB::table('social')->where('id', '<>', 0)  ->update(['soc_email' => '0'   ]);  
} 
			 $nametr = Session::flash('statust', ' مدیریت نمایش ایمیل باموفقیت انجام شد .');
		  	$nametrt = Session::flash('sessurl', 'manageemail');		  	 
 return view('superadmin.success'); 
}	
else{ return redirect('superadmin/sign-in'); }
				}
		
				
				
				
	public function managesocialindex(){
		if (Session::has('signsuperadmin')){
			$admins = \DB::table('social') ->where('id', '<>', '0')  ->orderBy('id', 'desc')->get();
return view('superadmin.managesocialindex', ['admins' => $admins]);}	
else{ return redirect('superadmin/sign-in'); } 
				}
				
				
				
				 	public function managesocialindexpost( Request $request ){
if (Session::has('signsuperadmin')){  
$myCheckboxes = $request->input('field_name');
 

if($myCheckboxes != NULL)  {
$updatee = \DB::table('social')->where('id', '<>', 0)  ->update(['soc_index' => '0'   ]);  	
foreach($myCheckboxes as $quan) {		 
$updatee = \DB::table('social')->where('id', '=', $quan)  ->update(['soc_index' => '1'   ]);  	
} 
} else { 
$updatee = \DB::table('social')->where('id', '<>', 0)  ->update(['soc_index' => '0'   ]);  
} 
			 $nametr = Session::flash('statust', ' مدیریت نمایش صفحات اجتماعی در صفحه اصلی باموفقیت ویرایش شد  ');
		  	$nametrt = Session::flash('sessurl', 'managesocialindex');		  	 
 return view('superadmin.success'); 
}	
else{ return redirect('superadmin/sign-in'); }
				}
				
		

	public function addproduct(){
if (Session::has('signsuperadmin')){
$admins = \DB::table('groupcat') ->orderBy('group_id', 'desc')->get();
return view('superadmin.addproductsu', ['admins' => $admins]); 
	 }	
else{ return redirect('superadmin/sign-in'); }
				}



	 
public function addproductpost(Request $request){
if (Session::has('signsuperadmin')){    	    	
    	$this->validate($request,[
    	    	'name' => 'required|min:3', 
    			'groupid' => 'required',
    			'kh' => 'required',
    			'price' => 'required|numeric',
    			'commission' => 'required|numeric',
    			'des' => 'required|min:5',
    		],[
    			'name.required' => 'لطفا نام محصول را وارد نمایید',
    			'name.min' => 'نام محصول کوتاه است', 
    			'groupid.required' => 'لطفا گروه محصول را انتخاب نمایید',
    			'kh.required' => 'لطفا خلاصه توضیحات محصول را به درستی وارد نمایید',
    			'price.required' => 'لطفا قیمت محصول را به درستی وارد نمایید',
    			'price.numeric' => 'لطفا فرمت قیمت محصول را فقط به صورت عددی وارد نمایید',
    			'commission.required' => 'لطفا پورسانت محصول را وارد نمایید',
    			'commission.numeric' => 'لطفا پورسانت محصول را به صورت عددی وارد نمایید',
    			'des.required' => 'لطفا توضیحات محصول را وارد نمایید',
    			'des.min' => 'توضیح محصول کوتاه است',
    			
    		]);   
   if(Session::get('imgupload')==NULL ) {
 DB::table('mahsolat')->insert([
    ['mah_name' => $request->name , 'mah_groupid' => $request->groupid , 'mah_des' => $request->des , 'mah_price' => $request->price  , 'mah_commission' => $request->commission  , 'mah_kh' => $request->kh , 'mah_active' => '1' ,   'mah_createdatdate' =>  date('Y-m-d H:i:s')   , 'mah_desmahsolcont' => $request->desmahsolcont       ]
]);   	
   }			
else    if(Session::get('imgupload')!=NULL ) {
 DB::table('mahsolat')->insert([
    ['mah_name' => $request->name , 'mah_groupid' => $request->groupid , 'mah_des' => $request->des , 'mah_price' => $request->price   , 'mah_commission' => $request->commission , 'mah_kh' => $request->kh , 'mah_active' => '1' ,   'mah_createdatdate' =>  date('Y-m-d H:i:s')  ,   'mah_img' => Session::get('imgupload') , 'mah_desmahsolcont' => $request->desmahsolcont    ]
]);   	
   }			


$mahsolats=\DB::table('mahsolat')  ->where('mah_id' , '<>' , '0')->orderBy('mah_id' , 'desc')->first();
$mah_id=$mahsolats->mah_id;


		  	$admins = \DB::table('image')->where('img_mahid', '=', $mah_id)->delete();
 
	Session::forget('imgupload');	

$nametr = Session::flash('statust', 'محصول با موفقیت ثبت شد.');
$nametrt = Session::flash('sessurl', 'viewsproducts');
		  return view('superadmin.success'); 	    	 }	
else{ return redirect('superadmin/sign-in'); }    	  
}
	





public function dropzoneStoresturnpro(Request $request)
    {
        $image = $request->file('file');
        $imageName = time().$image->getClientOriginalName();
        $image->move(public_path('images'),$imageName);    
 
             $nametr = Session::flash('imgupload', $imageName);


$mahsolats=\DB::table('mahsolat')  ->where('mah_active' , '<>' , '2')->orderBy('mah_id' , 'desc')->first();
$idmahsol=$mahsolats->mah_id;  $idmahsol=$idmahsol+1;
		
DB::table('image')->insert([
    ['img_name' => $imageName , 'img_mahid' => $idmahsol , 'img_createdatdate' => date('Y-m-d H:i:s')  ]
]);

        return response()->json(['success'=>$imageName]);
    }
		
		

		
	public function viewsproducts(){
if (Session::has('signsuperadmin')){ 
$admins = \DB::table('mahsolat') ->orderBy('mah_id', 'desc')->get();
return view('superadmin.viewsproducts', ['admins' => $admins]);
}	
else{ return redirect('superadmin/sign-in'); }
}




	public function editproducts($id){
if (Session::has('signsuperadmin')){ 
	Session::put('idimg', $id);
$admins = \DB::table('mahsolat')
->join('groupcat', 'mahsolat.mah_groupid', '=', 'groupcat.group_id') 
 ->where('mah_id', '=', $id)  ->orderBy('mah_id', 'desc')->get();
 
 
$groupcats = \DB::table('groupcat') -> orderBy('group_id', 'desc')->get();
$images = \DB::table('image')  ->where('img_mahid', '=', $id)  -> orderBy('img_id', 'desc')->get();
 
return view('superadmin.editproducts', ['admins' => $admins , 'groupcats' => $groupcats , 'images' => $images]); }	
else{ return redirect('superadmin/sign-in'); }
}




		
	public function deletimage($id , $imgid){
		if (Session::has('signsuperadmin')){ 
		
		
$mahsols = \DB::table('mahsolat')->where('mah_id', '=', $id)  ->orderBy('mah_id', 'desc')->first();
$imgaes = \DB::table('image')->where('img_id', '=', $imgid)  ->orderBy('img_id', 'desc')->first();

if($mahsols->mah_img==$imgaes->img_name){ 
$updatee = \DB::table('mahsolat')->where('mah_id', '=', $id)  ->update(['mah_img' => ""   ]);
} 
		
		  	$admins = \DB::table('image')->where('img_id', '=', $imgid)->delete();  

		  	$nametr = Session::flash('statust', 'تصویر محصول با موفقیت حذف شد.');
		  	$nametrt = Session::flash('sessurl', 'viewsproducts/editproducts/'.$id);
		  	
	return view('superadmin.success', ['admins' => $admins]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}				
		
		
		
		
	public function editproductsadminphoto($id  , Request $request ){
if (Session::has('signsuperadmin')){ 
 
$updatee = \DB::table('mahsolat')->where('mah_id', '=', $id)  ->update(['mah_img' => $request->photo     ]); 
$nametr = Session::flash('statust', 'تصویر اصلی محصول باموفقیت عوض شد.');
$nametrt = Session::flash('sessurl', 'viewsproducts/editproducts/'.$id.'');
return view('superadmin.success');
}	
else{ return redirect('superadmin/sign-in'); }
}







	public function editproductspost($id  , Request $request ){
if (Session::has('signsuperadmin')){ 

    	$this->validate($request,[
    	    	'name' => 'required|min:3',
    			'groupid' => 'required',
    			'kh' => 'required',
    			'price' => 'required|numeric',
    			'commission' => 'required|numeric',
    			'des' => 'required|min:5',
    		],[
    			'name.required' => 'لطفا نام محصول را وارد نمایید',
    			'name.min' => 'نام محصول کوتاه است',
    			'groupid.required' => 'لطفا گروه محصول را انتخاب نمایید',
    			'kh.required' => 'لطفا خلاصه توضیحات محصول را به درستی وارد نمایید',
    			'price.required' => 'لطفا قیمت محصول را به درستی وارد نمایید',
    			'price.numeric' => 'لطفا فرمت قیمت محصول را فقط به صورت عددی وارد نمایید',
    			'commission.required' => 'لطفا پورسانت محصول را وارد نمایید',
    			'commission.numeric' => 'لطفا پورسانت محصول را به صورت عددی وارد نمایید',
    			'des.required' => 'لطفا توضیحات محصول را وارد نمایید',
    			'des.min' => 'توضیح محصول کوتاه است',
    			
    		]);     
    		  
$updatee = \DB::table('mahsolat')->where('mah_id', '=', $id)  ->update(['mah_name' => $request->name  , 'mah_groupid' => $request->groupid , 'mah_des' => $request->des , 'mah_kh' => $request->kh  , 'mah_price' => $request->price  , 'mah_commission' => $request->commission , 'mah_desmahsolcont' => $request->desmahsolcont     ]); 
$admins = \DB::table('mahsolat')->where('mah_id', '=', $id)  ->orderBy('mah_id', 'desc')->get();

$nametr = Session::flash('statust', 'محصول با موفقیت ویرایش شد.');
$nametrt = Session::flash('sessurl', 'viewsproducts/editproducts/'.$id.'');
return view('superadmin.success');
}	else{ return redirect('superadmin/sign-in'); }
}






public function dropzoneStoreprod(Request $request)
    {
        $image = $request->file('file');
        $imageName = time().$image->getClientOriginalName();
        $image->move(public_path('images'),$imageName); 
        
		
DB::table('image')->insert([
    ['img_name' => $imageName , 'img_mahid' => Session::get('idimg') , 'img_createdatdate' => date('Y-m-d H:i:s')  ]
]);      


$admins = \DB::table('mahsolat')->where('mah_id', '=', Session::get('idimg'))  ->orderBy('mah_id', 'desc')->first();

if($admins->mah_img==""){
$updatee = \DB::table('mahsolat')->where('mah_id', '=', Session::get('idimg'))  ->update(['mah_img' => $imageName   ]);} 


        return response()->json(['success'=>$imageName]);
    }
		

		

		
	public function accprod($id){
		if (Session::has('signsuperadmin')){ 				
$updatee = \DB::table('mahsolat')->where('mah_id', '=', $id)  ->update(['mah_active' => 1   ]); 
		  	$admins = \ DB::table('mahsolat')->where('mah_id', $id)->get();				
		  	$nametr = Session::flash('statust', 'محصول باموفقیت فعال شد.');
		  	$nametrt = Session::flash('sessurl', 'viewsproducts/editproducts/'.$id.'');		  	
	return view('superadmin.success', ['admins' => $admins]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}
				

	public function rejprod($id){
		if (Session::has('signsuperadmin')){ 				
$updatee = \DB::table('mahsolat')->where('mah_id', '=', $id)  ->update(['mah_active' => 0   ]); 
		  	$admins = \ DB::table('mahsolat')->where('mah_id', $id)->get();				
		  	$nametr = Session::flash('statust', 'محصول باموفقیت غیرفعال شد.');
		  	$nametrt = Session::flash('sessurl', 'viewsproducts/editproducts/'.$id.'');		  	
	return view('superadmin.success', ['admins' => $admins]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}
				

	
	public function deletprod($id){
		if (Session::has('signsuperadmin')){ 
		  	$admins = \DB::table('mahsolat')->where('mah_id', '=', $id)->delete();  

		  	$nametr = Session::flash('statust', 'محصول باموفقیت حذف شد.');
		  	$nametrt = Session::flash('sessurl', 'viewsproducts');
		  	
	return view('superadmin.success', ['admins' => $admins]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}				
		


	public function addroperty($id){
if (Session::has('signsuperadmin')){ 
	Session::put('idimg', $id);
	
$admins = \DB::table('mahsolat')->where('mah_id', '=', $id)  ->orderBy('mah_id', 'desc')->first(); 
$propertys = \DB::table('property')->where('property_idmah', '=', $id)  ->orderBy('property_id', 'desc')->get();
return view('superadmin.addroperty', ['admins' => $admins ,'propertys' => $propertys   ]); }	
else{ return redirect('superadmin/sign-in'); }
				}




	public function addropertypost($id  , Request $request ){
if (Session::has('signsuperadmin')){ 

    	$this->validate($request,[
    			'field_name.*' => 'required', 
    		],[
    			'field_name.*required' => 'لطفا ویژگی را وارد نمایید ', 
    		]);
 



$myCheckboxes = $request->input('field_name');



if($myCheckboxes != NULL)  {
foreach($myCheckboxes as $quan) {
	
echo $quan.'</br>';


DB::table('property')->insert([
    ['property_idmah' => $id , 'property_name' => $quan , 'property_active' => '1'  ]
]);


}
}
 

 return redirect('superadmin/viewsproducts/addroperty/'.$id);


}	else{ return redirect('superadmin/sign-in'); }
}
	





	public function accperty($id){
if (Session::has('signsuperadmin')){  
$property = \ DB::table('property')->where('property_id', $id)->first();
$idmah=$property->property_idmah;
$updatee = \DB::table('property')->where('property_id', '=', $id)  ->update(['property_active' => '1'  ]); 
return redirect('superadmin/viewsproducts/addroperty/'.$idmah);
 }	
else{ return redirect('superadmin/sign-in'); }
				}





	public function rejperty($id){
if (Session::has('signsuperadmin')){  
$property = \ DB::table('property')->where('property_id', $id)->first();
$idmah=$property->property_idmah;
$updatee = \DB::table('property')->where('property_id', '=', $id)  ->update(['property_active' => '0'  ]); 
return redirect('superadmin/viewsproducts/addroperty/'.$idmah);
 }	
else{ return redirect('superadmin/sign-in'); }
				}




	
	
	
	
	public function deletperty($id){
		if (Session::has('signsuperadmin')){ 
		  	$property = \ DB::table('property')->where('property_id', $id)->first();
		  	$idmah=$property->property_idmah;
		  	$admins = \DB::table('property')->where('property_id', '=', $id)->delete(); 
		  	$nametr = Session::flash('statust', 'حذف ویژگی باموفقیت انجام شد.');
		  	$nametrt = Session::flash('sessurl', 'viewsproducts/addroperty/'.$idmah);

 return redirect('superadmin/viewsproducts/addroperty/'.$idmah);	
	//return view('superadmin.success', ['admins' => $admins]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}
		
	

	
	

	public function mngvalue($id){
if (Session::has('signsuperadmin')){ 
	Session::put('idimg', $id);
	
$propertys = \DB::table('property')->where('property_idmah', '=', $id)  ->orderBy('property_id', 'desc')->get(); 


$contentf = \DB::table('mahsolat') 
->join('property', 'mahsolat.mah_id', '=', 'property.property_idmah')  
->where([
    ['mahsolat.mah_id', '<>', '0'],
    ['property.property_id', '=', $id],  ])
    ->orderBy('property.property_id', 'desc')->first();
    
    

$contents = \DB::table('mahsolat') 
->join('property', 'mahsolat.mah_id', '=', 'property.property_idmah') 
->join('content', 'property.property_id', '=', 'content.content_idproperty') 
->where([
    ['mahsolat.mah_id', '<>', '0'],
    ['property.property_id', '=', $id],  ])
    ->orderBy('content.content_id', 'desc')->get();
    
    


return view('superadmin.mngvalue', ['contentf' => $contentf ,'propertys' => $propertys ,'contents' => $contents   ]); }	
else{ return redirect('superadmin/sign-in'); }
				}



	


	public function mngvaluepost($id  , Request $request ){
if (Session::has('signsuperadmin')){ 

    	$this->validate($request,[
    			'obser' => 'required', 
    			'field_name.*' => 'required', 
    		],[
    			'obser.required' => 'لطفا مقدارهای ویژگی را وارد نمایید ', 
    			'field_name.*required' => 'لطفا ویژگی را وارد نمایید ', 
    		]);
 

$propertys = \DB::table('property')->where('property_id', '=', $id)  ->orderBy('property_id', 'desc')->first(); 


$updatee = \DB::table('property')->where('property_id', '=', $id)  ->update(['property_obser' => $request->obser ]); 




$myCheckboxes = $request->input('field_name');


if($myCheckboxes != NULL)  {
foreach($myCheckboxes as $quan) {
	
echo $quan.'</br>';


DB::table('content')->insert([
    ['content_idproperty' => $id , 'content_name' => $quan  , 'content_active' => '1'   ]
]);


}
}
 

 return redirect('superadmin/viewsproducts/addroperty/mngvalue/'.$propertys->property_id);


}	else{ return redirect('superadmin/sign-in'); }
}
	

	

	public function acccont($id){
if (Session::has('signsuperadmin')){  
$content = \ DB::table('content')->where('content_id', $id)->first();
$idproperty=$content->content_idproperty;
$updatee = \DB::table('content')->where('content_id', '=', $id)  ->update(['content_active' => '1'  ]); 
return redirect('superadmin/viewsproducts/addroperty/mngvalue/'.$idproperty);
 }	
else{ return redirect('superadmin/sign-in'); }
				}



	
	
	
	
	public function rejcont($id){
if (Session::has('signsuperadmin')){  
$content = \ DB::table('content')->where('content_id', $id)->first();
$idproperty=$content->content_idproperty;
$updatee = \DB::table('content')->where('content_id', '=', $id)  ->update(['content_active' => '0'  ]); 
return redirect('superadmin/viewsproducts/addroperty/mngvalue/'.$idproperty);
 }	
else{ return redirect('superadmin/sign-in'); }
				}



	
	
	public function deletcont($id){
		if (Session::has('signsuperadmin')){ 

$content = \ DB::table('content')->where('content_id', $id)->first();
$idproperty=$content->content_idproperty;
		  	$admins = \DB::table('content')->where('content_id', '=', $id)->delete(); 
		  	$nametr = Session::flash('statust', 'حذف مقدار ویژگی باموفقیت انجام شد.');
		  	$nametrt = Session::flash('sessurl', 'viewsproducts/addroperty/mngvalue/'.$idproperty);
return redirect('superadmin/viewsproducts/addroperty/mngvalue/'.$idproperty);	
	//return view('superadmin.success', ['admins' => $admins]);
	}	
else{ return redirect('superadmin/sign-in'); }
				}
		
	


	public function mngvaluenumberpost($id  , Request $request ){
if (Session::has('signsuperadmin')){ 

 
 
 
$contents = \DB::table('mahsolat') 
->join('property', 'mahsolat.mah_id', '=', 'property.property_idmah') 
->join('content', 'property.property_id', '=', 'content.content_idproperty') 
->where([
    ['mahsolat.mah_id', '<>', '0'],
    ['property.property_id', '=', $id],  ])
    ->orderBy('content.content_id', 'desc')->get();
     
$upcontent_numbersd=0;
foreach($contents as $content){
	
$mah_id=$content->mah_id;
$mah_number=$content->mah_number;

$myCheckboxes =  $request->input('number'.$content->content_id.'x');;


if($myCheckboxes != NULL)  {
foreach($myCheckboxes as $quan) {
	
	if($quan==NULL){ $quan=0; }
echo $quan.'</br>';

$upcontent_number =  $content->content_number+$quan ;
$upcontent_numbersd=$upcontent_numbersd+$quan; 
 
$updatee = \DB::table('content')
->where([['content_id', '=', $content->content_id],['content_idproperty', '=', $id], ])  ->
 update(['content_number' => $upcontent_number   ]); 
 


}
}

}

  

$updatee = \DB::table('mahsolat')->where('mah_id', '=',  $mah_id)  ->update(['mah_number' => $mah_number+$upcontent_numbersd   ]); 

 return redirect('superadmin/viewsproducts/addroperty/mngvalue/'.$id);
 
 
	}	
else{ return redirect('superadmin/sign-in'); }
				}
		
	

				
		 


	 	
		
	public function viewsstoreshop(){
if (Session::has('signsuperadmin')){ 
$admins = \DB::table('mahsolat') ->orderBy('mah_id', 'desc')->get();
return view('superadmin.viewsstoreshop', ['admins' => $admins]);
}	
else{ return redirect('superadmin/sign-in'); }
}


		
	
		
	public function viewsshopsabad(){
if (Session::has('signsuperadmin')){  
$admins = \DB::table('user') 
->join('buy', 'user.id', '=', 'buy.buy_iduser') 
->join('mahsolat', 'buy.buy_idmah', '=', 'mahsolat.mah_id')  
->where([
    ['user.id', '<>', '0'],
    ['buy.buy_id', '<>', '0'],
    ['buy.buy_status', '=', '0'] ,])
    ->orderBy('buy.buy_id', 'desc')->get();

return view('superadmin.viewsshopsabad', ['admins' => $admins]);
}	
else{ return redirect('superadmin/sign-in'); }
}
	 


		
	public function viewsshoping(){
if (Session::has('signsuperadmin')){  
$admins = \DB::table('user') 
->join('payment', 'user.id', '=', 'payment.iduser')   
->where([
    ['user.id', '<>', '0'],
    ['payment.id', '<>', '0'],
    ['payment.rnd', '<>', '0'] , 
    ['payment.status', '<>', '0'] ,])
    ->orderBy('payment.id', 'desc')->get();
 
return view('superadmin.viewsshoping', ['admins' => $admins   ]);
}	
else{ return redirect('superadmin/sign-in'); }
}


		
	public function viewsshopbuy(){
if (Session::has('signsuperadmin')){  
$admins = \DB::table('user') 
->join('payment', 'user.id', '=', 'payment.iduser')   
->where([
    ['user.id', '<>', '0'],
    ['payment.id', '<>', '0'],
    ['payment.rnd', '<>', '0'] , 
    ['payment.status', '=', '1'] ,])
    ->orderBy('payment.id', 'desc')->get();

    $status='1';
return view('superadmin.viewsshopbuy', ['admins' => $admins  ,'status' => $status]);
}	
else{ return redirect('superadmin/sign-in'); }
}


	
		
	public function buysend($id){
if (Session::has('signsuperadmin')){   

$sabads = \DB::table('mahsolat')
->join('buy', 'mahsolat.mah_id', '=', 'buy.buy_idmah')
->join('finicals', 'buy.buy_idfinical', '=', 'finicals.id') 
->join('user', 'finicals.finical_iduser', '=', 'user.id') 
->where([['finicals.finical_iduser', '<>', '0' ],['finicals.finical_arou', '=', '4'],['buy.buy_status', '<>', '0'],['finicals.finical_payment', '=', '1'],['finicals.rnd', '=', $id], ]) ->orderBy('buy.buy_id', 'desc')->first();

$admins = \DB::table('mahsolat')
->join('buy', 'mahsolat.mah_id', '=', 'buy.buy_idmah')
->join('finicals', 'buy.buy_idfinical', '=', 'finicals.id') 
->join('user', 'finicals.finical_iduser', '=', 'user.id') 
->where([['finicals.finical_iduser', '<>', '0' ],['finicals.finical_arou', '=', '4'],['buy.buy_status', '<>', '0'],['finicals.finical_payment', '=', '1'],['finicals.rnd', '=', $id], ]) ->orderBy('buy.buy_id', 'desc')->get();
 
$countsabad=0;
$sumpricefinic=0;
 foreach($admins as $saba){ 
 $sumpricefinic=$saba->finical_pay+$sumpricefinic;  $countsabad++;
  }
    
    
    
$mngindex=  DB::table('mngindex')  ->where('id' , '=' , 1)->orderBy('id')->first(); 
    
return view('superadmin.buysend', ['sabads' => $sabads , 'admins' => $admins , 'countsabad' => $countsabad , 'sumpricefinic' => $sumpricefinic , 'mngindex' => $mngindex]);
}	
else{ return redirect('superadmin/sign-in'); }
}





		
	public function buysendpost($id  , Request $request){
if (Session::has('signsuperadmin')){   

$this->validate($request,[
    			'numbermarsole' => 'required|min:3|max:222',  
    		],[
    			'numbermarsole.required' => 'لطفا شماره پیگیری مرسوله پستی را وارد نمایید',
    			'numbermarsole.min' => 'شماره پیگیری کوتاه است',
    			'nnumbermarsoleame.max' => 'شماره پیگیری غیرقابل قبول است', 
    			

    		]);

$updatee =\DB::table('mahsolat')
->join('buy', 'mahsolat.mah_id', '=', 'buy.buy_idmah')
->join('finicals', 'buy.buy_idfinical', '=', 'finicals.id') 
->join('user', 'finicals.finical_iduser', '=', 'user.id') ->where('finicals.rnd', '=', $id)  ->update(['buy_sendtoadresdate' =>  date('Y-m-d H:i:s')   ,  'buy_nummarsole' => $request->numbermarsole ,  'buy_status' => '2' ]); 


$updatee =\DB::table('payment') ->where('rnd', '=', $id)  ->update(['sendtoadresdate' =>  date('Y-m-d H:i:s')   , 'status' => '2' ]); 
		
    			
    			

			 $nametr = Session::flash('statust', 'شماره پیگیری مرسوله پستی ثبت گردید و مرسوله با موفقیت به سمت آدرس پستی کاربر ارسال شد.');
		  	$nametrt = Session::flash('sessurl', 'viewsshopsend');		  	

 return view('superadmin.success');
 



}	
else{ return redirect('superadmin/sign-in'); }
}


	
		
	public function viewsshopsend(){
if (Session::has('signsuperadmin')){  
$admins = \DB::table('user') 
->join('payment', 'user.id', '=', 'payment.iduser')   
->where([
    ['user.id', '<>', '0'],
    ['payment.id', '<>', '0'],
    ['payment.rnd', '<>', '0'] , 
    ['payment.status', '=', '2'] ,])
    ->orderBy('payment.id', 'desc')->get();

    
    $status='2';

return view('superadmin.viewsshopbuy', ['admins' => $admins ,'status' => $status]);
}	
else{ return redirect('superadmin/sign-in'); }
}


		
	public function buysendtoadresacc($id){
if (Session::has('signsuperadmin')){   


$updatee =\DB::table('mahsolat')
->join('buy', 'mahsolat.mah_id', '=', 'buy.buy_idmah')
->join('finicals', 'buy.buy_idfinical', '=', 'finicals.id') 
->join('user', 'finicals.finical_iduser', '=', 'user.id') ->where('finicals.rnd', '=', $id)  ->update(['buy_recvdate' =>  date('Y-m-d H:i:s')   ,   'buy_status' => '3' ]); 
		
    			
    
$updatee =\DB::table('payment') ->where('rnd', '=', $id)  ->update(['recvdate' =>  date('Y-m-d H:i:s')   , 'status' => '3' ]); 
		
    				

			 $nametr = Session::flash('statust', 'مرسوله باموفقیت تحویل کاربر شد.');
		  	$nametrt = Session::flash('sessurl', 'viewsshoprecv');		  	

 return view('superadmin.success');
 
}	
else{ return redirect('superadmin/sign-in'); }
}




		
	public function viewsshoprecv(){
if (Session::has('signsuperadmin')){  
$admins = \DB::table('user') 
->join('payment', 'user.id', '=', 'payment.iduser')   
->where([
    ['user.id', '<>', '0'],
    ['payment.id', '<>', '0'],
    ['payment.rnd', '<>', '0'] , 
    ['payment.status', '=', '3'] ,])
    ->orderBy('payment.id', 'desc')->get();
    
    $status='3';

return view('superadmin.viewsshopbuy', ['admins' => $admins ,'status' => $status]);
}	
else{ return redirect('superadmin/sign-in'); }
}





	public function costsendtoadres(){
		if (Session::has('signsuperadmin')){ 
$admins = \DB::table('mngindex') ->where('id', '=', '2')->orderBy('id', 'desc')->first();
return view('superadmin.costsendtoadres', ['admins' => $admins]);  
}	else{ return redirect('superadmin/sign-in'); }
}


	public function costsendtoadrespost(Request $request){
		if (Session::has('signsuperadmin')){ 
    	$this->validate($request,[  
    			'ind_costsendtoadres' => 'required', 
    		],[ 
    			'ind_costsendtoadres.required' => 'هزینه ارسال را به درستی وارد نمایید',
    			
    		]);
    
$updatee = \DB::table('mngindex')->where('id', '=', '2')  ->update([ 'ind_costsendtoadres' => $request->ind_costsendtoadres     ]); 	

			 $nametr = Session::flash('statust', 'هزینه ارسال مرسوله به سمت آدرس پستی با موفقیت ویرایش شد.');
		  	$nametrt = Session::flash('sessurl', 'costsendtoadres');		  	

 return view('superadmin.success');

}	else{ return redirect('superadmin/sign-in'); }
}


	



		
	public function manageindex(){
		if (Session::has('signsuperadmin')){
			$admins = \DB::table('mngindex') ->where('id', '=', '1')  ->orderBy('id', 'desc')->get();
return view('superadmin.manageindex', ['admins' => $admins]);}	
else{ return redirect('superadmin/sign-in'); }
 
				}
 
		
	public function manageindexpost( Request $request ){
if (Session::has('signsuperadmin')){ 
$updatee = \DB::table('mngindex')->where('id', '=', '1')  ->update([ 'ind_hregus' => $request->ind_hregus , 'ind_hlogus' => $request->ind_hlogus , 'ind_hfaq' => $request->ind_hfaq ,   'ind_hpage' => $request->ind_hpage ,   'ind_hnew' => $request->ind_hnew  ,    'ind_freg' => $request->ind_freg ,'ind_flog' => $request->ind_flog , 'ind_fnew' => $request->ind_fnew ,   'ind_fpage' => $request->ind_fpage  ,    'ind_ffaq' => $request->ind_ffaq  ,   'ind_createdatdate' =>  date('Y-m-d H:i:s')   ]); 
 

			 $nametr = Session::flash('statust', ' مدیریت صفحه اصلی با موفقیت ویرایش شد .');
		  	$nametrt = Session::flash('sessurl', 'manageindex');		  	

 return view('superadmin.success');

}	
else{ return redirect('superadmin/sign-in'); }
				}
		



	public function mngindexaffiliates(){
if (Session::has('signsuperadmin')){ 
$admins = \DB::table('affiliates') ->where('id', '=', '1')->orderBy('id', 'desc')->get();
return view('superadmin.mngindexaffiliates', ['admins' => $admins]); }	
else{ return redirect('superadmin/sign-in'); }
}
 


	public function mngindexaffiliatespost(Request $request){
if (Session::has('signsuperadmin')){ 

    
$updatee = \DB::table('affiliates')->where('id', '=', '1')  ->update(['aff_tit' => $request->aff_tit ,'aff_header1' => $request->aff_header1 ,'aff_header2' => $request->aff_header2 ,'aff_header3' => $request->aff_header3  ,'aff_body' => $request->aff_body  ,'aff_body1' => $request->aff_body1  ,'aff_body2' => $request->aff_body2  ,'aff_body3' => $request->aff_body3 ,'aff_body4' => $request->aff_body4  ,'aff_des1' => $request->aff_des1  ,'aff_des2' => $request->aff_des2  ,'aff_des3' => $request->aff_des3  ,'aff_des4' => $request->aff_des4  ,'aff_des5' => $request->aff_des5  ,'aff_des6' => $request->aff_des6   ,'aff_box1' => $request->aff_box1 ,'aff_box2' => $request->aff_box2 ,'aff_box3' => $request->aff_box3 ,'aff_box4' => $request->aff_box4 ,'aff_end1' => $request->aff_end1  ,'aff_end2' => $request->aff_end2  ,'aff_end3' => $request->aff_end3 ,'aff_footer' => $request->aff_footer , 'aff_createdatdate' =>  date('Y-m-d H:i:s')   ]); 	

			 $nametr = Session::flash('statust', ' جزییات صفحه همکاری در فروش باموفقیت ویرایش شد .');
		  	$nametrt = Session::flash('sessurl', 'mngindexaffiliates');		  	

 return view('superadmin.success');

}	
else{ return redirect('superadmin/sign-in'); }
}
 



	public function mngindexedit(){
if (Session::has('signsuperadmin')){ 
$admins = \DB::table('mngindex') ->where('id', '=', '1')->orderBy('id', 'desc')->get();
return view('superadmin.mngindexedit', ['admins' => $admins]); }	
else{ return redirect('superadmin/sign-in'); }
}
 

	public function editadres(){
if (Session::has('signsuperadmin')){ 
$admins = \DB::table('adresturkey') ->where('id', '=', '1')->orderBy('id', 'desc')->first();
return view('superadmin.editadres', ['admins' => $admins]); }	
else{ return redirect('superadmin/sign-in'); }
}
 


	public function editrate(){
if (Session::has('signsuperadmin')){ 
$admins = \DB::table('mngindex') ->where('id', '=', '1')->orderBy('id', 'desc')->first();
return view('superadmin.editrate', ['admins' => $admins]); }	
else{ return redirect('superadmin/sign-in'); }
}
 
 
 
 


	public function editratepost( Request $request ){
if (Session::has('signsuperadmin')){ 


	$this->validate($request,[ 
    			'name' => 'required|numeric', 
    			'lyrcha' => 'required|numeric', 
    		],[ 
    			'name.required' => 'لطفا قیمت لیر را به درستی وارد نمایید',
    			'name.numeric' => 'لطفا فیلد قیمت را بصورت عددی وارد نمایید', 
    			'lyrcha.required' => 'لطفا قیمت لیر را به درستی وارد نمایید',
    			'lyrcha.numeric' => 'لطفا فیلد قیمت را بصورت عددی وارد نمایید', 
    			
    		]);

 
$updatee = \DB::table('mngindex')->where('id', '=', '1')  ->update([       'ind_ratelyr' => $request->name  ,    'ind_ratelyrch' => $request->lyrcha      ]); 
 

			 $nametr = Session::flash('statust', 'قیمت لیر باموفقیت آپدیت شد.');
		  	$nametrt = Session::flash('sessurl', 'editrate');		  	

 return view('superadmin.success');

}	
else{ return redirect('superadmin/sign-in'); }
				}
		






	public function editadrespost( Request $request ){
if (Session::has('signsuperadmin')){ 


	$this->validate($request,[
    			'tit' => 'required',
    			'name' => 'required',
    			'family' => 'required',
    			'tell' => 'required',
    			'adres1' => 'required',
    			'codp' => 'required',
    		],[
    			'tit.required' => 'لطفا عنوان آدرس را وارد نمایید',
    			'name.required' => 'لطفا نام را وارد نمایید',
    			'family.required' => 'لطفا نام خانوادگی را وارد نمایید',
    			'tell.required' => 'لطفا شماره تلفن را وارد نمایید',
    			'adres1.required' => 'لطفا آدرس پستی اول را وارد نمایید',
    			'codp.required' => 'لطفا کدپستی را وارد نمایید',
    			
    		]);


$updatee = \DB::table('adresturkey')->where('id', '=', '1')  ->update([    'adr_tit' => $request->tit ,   'adr_name' => $request->name  ,   'adr_family' => $request->family  ,   'adr_tell' => $request->tell  ,   'adr_adres1' => $request->adres1  ,   'adr_adres2' => $request->adres2  ,   'adr_codposti' => $request->codp     ]); 
 

			 $nametr = Session::flash('statust', ' فرم آدرس پستی ترکیه با موفقیت اصلاح شد .');
		  	$nametrt = Session::flash('sessurl', 'editadres');		  	

 return view('superadmin.success');

}	
else{ return redirect('superadmin/sign-in'); }
				}
		














	public function mngindexeditpost(Request $request){
if (Session::has('signsuperadmin')){ 
	
    	$this->validate($request,[
    			'tit' => 'required|min:4|max:999',
    			'cont' => 'required|min:1|max:999',
    			'key' => 'required',
    			'des' => 'required|min:1|max:999',
    			'fcopy' => 'required|min:1|max:999',  
    		],[
    			'tit.required' => 'لطفا عنوان سایت را وارد نمایید',
    			'tit.min' => 'عنوان وارد شده کوتاه است',
    			'tit.max' => 'عنوان وارد شده طولانی است',
    			'cont.required' => 'لطفا توضیحات سایت را وارد نمایید',
    			'cont.min' => 'توضیحات سایت کوتاه است',
    			'cont.max' => 'توضیحات طولانی است',
    			'key.required' => 'لطفا کلمات کلیدی را وارد نمایید',
    			'des.required' => 'اطلاعیه صفحه اصلی را وارد نمایید',
    			'des.min' => 'اطلاعیه صفحه اصلی   کوتاه است ',
    			'des.max' => 'اطلاعیه صفحه اصلی طولانی است',
    			'fcopy.required' => 'متن زیر فوتر را وارد نمایید',
    			'fcopy.min' => 'متن زیر فوتر کوتاه است',
    			'fcopy.max' => 'متن زیر فوتر طولانی است',  
    			
    		]);
    
$updatee = \DB::table('mngindex')->where('id', '=', '1')  ->update(['ind_ftitile' => $request->tit ,'ind_key' => $request->key ,'ind_cont' => $request->cont  ,'ind_mnumberdes' => $request->des    , 'ind_fcopy' => $request->fcopy   , 'ind_createdatdate' =>  date('Y-m-d H:i:s')   ]); 	

			 $nametr = Session::flash('statust', ' جزییات صفحه اصلی با موفقیت ویرایش شد .');
		  	$nametrt = Session::flash('sessurl', 'mngindexedit');		  	

 return view('superadmin.success');

}	else{ return redirect('superadmin/sign-in'); }
}
 



public function dropzonelogo(Request $request)
    {
        $image = $request->file('file');
        $imageName = time().$image->getClientOriginalName();
        $image->move(public_path('images'),$imageName);        
$updatee = \DB::table('mngindex')->where('id', '=',1)  ->update(['ind_himglog' => $imageName   ]); 
        return response()->json(['success'=>$imageName]);
    }
		
	


public function dropzonelogtme(Request $request)
    {
        $image = $request->file('file');
        $imageName = time().$image->getClientOriginalName();
        $image->move(public_path('images'),$imageName);        
$updatee = \DB::table('mngindex')->where('id', '=',1)  ->update(['ind_logtme' => $imageName   ]); 
        return response()->json(['success'=>$imageName]);
    }
		
	

public function dropzoneloginst(Request $request)
    {
        $image = $request->file('file');
        $imageName = time().$image->getClientOriginalName();
        $image->move(public_path('images'),$imageName);        
$updatee = \DB::table('mngindex')->where('id', '=',1)  ->update(['ind_loginst' => $imageName   ]); 
        return response()->json(['success'=>$imageName]);
    }
		
	


public function dropzonecomd( Request $request)
    {
        $image = $request->file('file');
        $imageName = time().$image->getClientOriginalName();
        $image->move(public_path('images'),$imageName);        
$updatee = \DB::table('comodid')->where('id', '=', Session::get('idimg'))  ->update(['comod_img' => $imageName   ]); 
        return response()->json(['success'=>$imageName]);
    }
		
	

	
		
	public function viewsstatics(){
		if (Session::has('signsuperadmin')){ 

$admins = \DB::table('statics') ->orderBy('id', 'desc')->limit(200)->get();
return view('superadmin.viewsstatics', ['admins' => $admins]);
}	else{ return redirect('superadmin/sign-in'); }
}

	

	
		
	public function editinsorder(){
		if (Session::has('signsuperadmin')){ 
$admins = \DB::table('mngindex') ->where('id', '=', '1')->orderBy('id', 'desc')->first();
return view('superadmin.editinsorder', ['admins' => $admins]);  
}	else{ return redirect('superadmin/sign-in'); }
}

	
		
	public function editinsorderpost(Request $request){
		if (Session::has('signsuperadmin')){ 


    	$this->validate($request,[  
    			'desorder' => 'required', 
    		],[ 
    			'desorder.required' => 'توضیحات مراحل سفارش را وارد نمایید', 
    			
    		]);
    
$updatee = \DB::table('mngindex')->where('id', '=', '1')  ->update([ 'ind_desorder' => $request->desorder     ]); 	

			 $nametr = Session::flash('statust', ' توضیحات مراحل سفارش با موفقیت ویرایش شد .');
		  	$nametrt = Session::flash('sessurl', 'editinsorder');		  	

 return view('superadmin.success');

}	else{ return redirect('superadmin/sign-in'); }
}






	
		
	public function editcred(){
		if (Session::has('signsuperadmin')){ 
$admins = \DB::table('mngindex') ->where('id', '=', '1')->orderBy('id', 'desc')->first();
return view('superadmin.editcred', ['admins' => $admins]);  
}	else{ return redirect('superadmin/sign-in'); }
}

	

		
	public function editcredpost(Request $request){
		if (Session::has('signsuperadmin')){ 


    	$this->validate($request,[  
    			'credcard' => 'required', 
    		],[ 
    			'credcard.required' => 'توضیحات خرید کردیت بانک را وارد نمایید ',
    			
    		]);
    
$updatee = \DB::table('mngindex')->where('id', '=', '1')  ->update([ 'ind_credcard' => $request->credcard     ]); 	

			 $nametr = Session::flash('statust', '  توضیحات خرید کردیت بانک با موفقیت ویرایش شد.');
		  	$nametrt = Session::flash('sessurl', 'editcred');		  	

 return view('superadmin.success');

}	else{ return redirect('superadmin/sign-in'); }
}



	
		
	public function editbar(){
		if (Session::has('signsuperadmin')){ 
$admins = \DB::table('mngindex') ->where('id', '=', '1')->orderBy('id', 'desc')->first();
return view('superadmin.editbar', ['admins' => $admins]);  
}	else{ return redirect('superadmin/sign-in'); }
}

	


		
	public function editbarpost(Request $request){
		if (Session::has('signsuperadmin')){ 


    	$this->validate($request,[  
    			'barbari' => 'required', 
    		],[ 
    			'barbari.required' => 'توضیحات باربری را وارد نمایید',
    			
    		]);
    
$updatee = \DB::table('mngindex')->where('id', '=', '1')  ->update([ 'ind_barbari' => $request->barbari     ]); 	

			 $nametr = Session::flash('statust', '  توضیحات باربری با موفقیت ویرایش شد.');
		  	$nametrt = Session::flash('sessurl', 'editbar');		  	

 return view('superadmin.success');

}	else{ return redirect('superadmin/sign-in'); }
}


	public function editbis(){
		if (Session::has('signsuperadmin')){ 
$admins = \DB::table('mngindex') ->where('id', '=', '1')->orderBy('id', 'desc')->first();
return view('superadmin.editbis', ['admins' => $admins]);  
}	else{ return redirect('superadmin/sign-in'); }
}

	


		
	public function editbispost(Request $request){
		if (Session::has('signsuperadmin')){ 


    	$this->validate($request,[  
    			'bisin' => 'required', 
    		],[ 
    			'bisin.required' => 'توضیحات بازاریابی را وارد نمایید',
    			
    		]);
    
$updatee = \DB::table('mngindex')->where('id', '=', '1')  ->update([ 'ind_bisin' => $request->bisin     ]); 	

			 $nametr = Session::flash('statust', '  توضیحات بازاریابی با موفقیت ویرایش شد.');
		  	$nametrt = Session::flash('sessurl', 'editbis');		  	

 return view('superadmin.success');

}	else{ return redirect('superadmin/sign-in'); }
}





	
		
	public function deletstatics(){
		if (Session::has('signsuperadmin')){ 


		  	$admins = \DB::table('statics')->where('id', '<>', 0)->delete();
			 $nametr = Session::flash('statust', ' تمامی آمار با موفقیت حذف شد .');
		  	$nametrt = Session::flash('sessurl', 'statics');		  	

 return view('superadmin.success');
}	else{ return redirect('superadmin/sign-in'); }
}




		
	public function manageindexshop(){
		if (Session::has('signsuperadmin')){
			$admins = \DB::table('mngindex') ->where('id', '=', '2')  ->orderBy('id', 'desc')->get();
return view('superadmin.manageindex', ['admins' => $admins]);}	
else{ return redirect('superadmin/sign-in'); }
 
				}
 	public function manageindexshoppost( Request $request ){
if (Session::has('signsuperadmin')){ 
$updatee = \DB::table('mngindex')->where('id', '=', '2')  ->update([ 'ind_hregus' => $request->ind_hregus , 'ind_hlogus' => $request->ind_hlogus , 'ind_hfaq' => $request->ind_hfaq ,   'ind_hpage' => $request->ind_hpage , 'ind_hquiz' => $request->ind_hquiz ,   'ind_hnew' => $request->ind_hnew  ,    'ind_freg' => $request->ind_freg ,'ind_flog' => $request->ind_flog , 'ind_fnew' => $request->ind_fnew ,   'ind_fpage' => $request->ind_fpage  ,    'ind_ffaq' => $request->ind_ffaq , 'ind_fquiz' => $request->ind_fquiz ,     'ind_createdatdate' =>  date('Y-m-d H:i:s')   ]); 
 

			 $nametr = Session::flash('statust', ' مدیریت صفحه فروشگاه با موفقیت انجام شد .');
		  	$nametrt = Session::flash('sessurl', 'manageindexshop');		  	

 return view('superadmin.success');

}	
else{ return redirect('superadmin/sign-in'); }
				}
		


	public function mngindexeditshop(){
if (Session::has('signsuperadmin')){ 
$admins = \DB::table('mngindex') ->where('id', '=', '2')->orderBy('id', 'desc')->get();
return view('superadmin.mngindexedit', ['admins' => $admins]); }	
else{ return redirect('superadmin/sign-in'); }
}
 



	public function mngindexeditshoppost(Request $request){
if (Session::has('signsuperadmin')){ 
	
    	$this->validate($request,[
    			'tit' => 'required|min:4|max:999',
    			'cont' => 'required|min:1|max:999',
    			'key' => 'required',
    			'des' => 'required|min:1|max:999',
    			'fcopy' => 'required|min:1|max:999',  
    		],[
    			'tit.required' => 'لطفا عنوان سایت را وارد نمایید',
    			'tit.min' => 'عنوان وارد شده کوتاه است',
    			'tit.max' => 'عنوان وارد شده طولانی است',
    			'cont.required' => 'لطفا توضیحات سایت را وارد نمایید',
    			'cont.min' => 'توضیحات سایت کوتاه است',
    			'cont.max' => 'توضیحات طولانی است',
    			'key.required' => 'لطفا کلمات کلیدی را وارد نمایید',
    			'des.required' => 'اطلاعیه صفحه اصلی را وارد نمایید',
    			'des.min' => 'اطلاعیه صفحه اصلی   کوتاه است ',
    			'des.max' => 'اطلاعیه صفحه اصلی طولانی است',
    			'fcopy.required' => 'متن زیر فوتر را وارد نمایید',
    			'fcopy.min' => 'متن زیر فوتر کوتاه است',
    			'fcopy.max' => 'متن زیر فوتر طولانی است',  
    			
    		]);
    
$updatee = \DB::table('mngindex')->where('id', '=', '2')  ->update(['ind_ftitile' => $request->tit ,'ind_key' => $request->key ,'ind_cont' => $request->cont  ,'ind_mnumberdes' => $request->des    , 'ind_fcopy' => $request->fcopy   , 'ind_createdatdate' =>  date('Y-m-d H:i:s')   ]); 	

			 $nametr = Session::flash('statust', ' جزییات صفحه فروشگاه با موفقیت ویرایش شد .');
		  	$nametrt = Session::flash('sessurl', 'mngindexeditshop');		  	

 return view('superadmin.success');

}	else{ return redirect('superadmin/sign-in'); }
}
 

   		

public function dropzonelogoshop(Request $request)
    {
        $image = $request->file('file');
        $imageName = time().$image->getClientOriginalName();
        $image->move(public_path('images'),$imageName);        
$updatee = \DB::table('mngindex')->where('id', '=','2')  ->update(['ind_himglog' => $imageName   ]); 
        return response()->json(['success'=>$imageName]);
    }
		
		

	
	
}
