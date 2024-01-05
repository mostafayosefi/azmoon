<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use Auth;
use Session;
use DB;
use Crypt;
use Rule;
use Mail;

use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{


public function testsms($MobileNumbers,$rnd){


        $postData = array(
            'UserApiKey' => '72f9c543d655faf535dd156',
            'SecretKey' => '!Mehdi1241368',
            'System' => 'php_rest_v_2_0'
        );


        $urll='https://ws.sms.ir/';
        $postString = json_encode($postData);


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://RestfulSms.com/api/Token");
        curl_setopt(
            $ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json'
            )
        );
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);

        $result = curl_exec($ch);
        curl_close($ch);

        $response = json_decode($result);

        $resp = false;
        $IsSuccessful = '';
        $TokenKey = '';
        if (is_object($response)) {
            $IsSuccessful = $response->IsSuccessful;
            if ($IsSuccessful == true) {
                $TokenKey = $response->TokenKey;
                $resp = $TokenKey;
            } else {
                $resp = false;
            }
        }
        //return $resp;


$token=$resp;




 $postData=array(
        "ParameterArray" => array(
            array(
                "Parameter" => "VerificationCode",
                "ParameterValue" => $rnd
            ),
        ),
        "Mobile" => $MobileNumbers,
        "TemplateId" => "27889"
    );




        $urll='http://RestfulSms.com/api/UltraFastSend';
        $postString = json_encode($postData);


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $urll);


        curl_setopt(
            $ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'x-sms-ir-secure-token: '.$token
            )
        );
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);

        $result = curl_exec($ch);
        curl_close($ch);

       // echo '<br>aaa<br>'. $result;





	}

public function userlogin(Request $request){

    $mngindexs = \DB::table('mngindex') ->where('id', '=', '1')->orderBy('id', 'desc')->first();
    Session::set('ind_himglog', $mngindexs->ind_himglog);
    Session::set('ind_himglogmini', $mngindexs->ind_himglogmini);
        Session::set('idlang', '3');


    DB::table('statics')->insert([
        ['static_ip' => $request->ip() ,  'static_url' => $request->url() ,    'static_name' => "ورود" ,   'static_createdatdate' =>  date('Y-m-d H:i:s') ]
    ]);



    $setting = DB::table('setting')->where('id' , 1)->orderBy('id', 'desc')->orderBy('id', 'desc')->first();
    if($setting->login=='sms'){
        return view('user.logintell' );
    }elseif($setting->login=='pas'){
        return view('user.login_pas' );
    }

     }













     public function forgetpaswordpost(Request $request){


        $this->validate($request,[
            'email' => 'required|email',
        ],[
            'email.required' => 'لطفا ایمیل را وارد نمایید',
            'email.email' => 'لطفا ایمیل را به فرمت صحیح وارد نمایید',
        ]);




$user = \DB::table('user')
->where([
    ['id', '<>', 0],
    ['user_email', '=', $request->email], ])
    ->orderBy('id', 'desc')->first();

    if($user){

        $rnd=rand(1, 99999999);
        $encryptedPassword = \Crypt::encrypt($rnd);



$updatee = \DB::table('user')->where([
    ['id', '<>', 0],
    ['user_email', '=', $request->email], ])
    ->update(['user_password' => $encryptedPassword ]);


    $decryptedPassword = \Crypt::decrypt($user->user_password);
    $emaill=$user->user_email;
     $usernamee = $user->user_name;
     $titmes= 'رمز شما با موفقیت تغییر کرد.';
     $mestt= 'رمز جدید';
     $mesnot = $rnd;

  Mail::send('superadmin.mail', ['user' => $user , 'usernamee' => $usernamee, 'mesnot' => $mesnot, 'titmes' => $titmes , 'mestt' => $mestt], function($message)  use ($user)
{
    $message->from('admini@servicepay.azmoonpte.com',  'رمزعبور جدید'  );
    $message->to($user->user_email, $user->user_email)->subject('رمزعبور جدید');
});

$nametr = Session::flash('success',  'رمزعبور شما با موفقیت به ایمیل شما ارسال شد' );
return redirect('user/sign-in');

}else{


$nametr = Session::flash('statust',  'متاسفانه ایمیل وارد شده در سیستم وجود ندارد' );
return redirect('user/sign-in');
}



        }



public function forgetpasword(Request $request){

    $mngindexs = \DB::table('mngindex') ->where('id', '=', '1')->orderBy('id', 'desc')->first();
    Session::set('ind_himglog', $mngindexs->ind_himglog);
    Session::set('ind_himglogmini', $mngindexs->ind_himglogmini);
        Session::set('idlang', '3');


    DB::table('statics')->insert([
        ['static_ip' => $request->ip() ,  'static_url' => $request->url() ,    'static_name' => "فراموشی رمزعبور" ,   'static_createdatdate' =>  date('Y-m-d H:i:s') ]
    ]);


        return view('user.forgetpasword' );




     }





public function showupdatealertuser($typ,$link,$req){


$updatee = \DB::table('alert')
->join('user', 'alert.iduser', '=', 'user.id')  ->where([
    ['user.id', '=',  Session::get('iduser')],
    ['alert.type', '=', $typ],
    ['alert.link', '=', $link],
    ['alert.req', '=', $req],
    ['alert.alert_id', '<>', 0], ])  ->update(['show' => 1   ]);


$h = new UserController();
$h->viewalertnotuser();

}


public function viewalertnotuser(){

$admins  = \DB::table('alert')
->join('user', 'alert.iduser', '=', 'user.id')  ->where([
    ['user.id', '<>',  0],
    ['user.id', '=',  Session::get('iduser')],
    ['alert.show', '=',  0], 
    ['alert.type', '=',  15],   ])
    ->orderBy('alert_id', 'desc')->limit(5)->get();


$countalert  = \DB::table('alert')
->join('user', 'alert.iduser', '=', 'user.id')  ->where([
    ['user.id', '<>',  0],
    ['user.id', '=',  Session::get('iduser')],
    ['alert.show', '=',  0],  
    ['alert.type', '=',  15], ])
    ->orderBy('alert_id', 'desc')->count();

 Session::set('countalertuser', $countalert);
 Session::set('alertnotfuser', $admins);

 }



public function alertnotif($typ,$link,$req){

/*
$typ==11  buy pte mak apeuni
$typ==12  rezerv mak hozori
$typ==13  payment
$typ==14  tiket user


*/

DB::table('alert')->insert([
    [ 'iduser' =>  Session::get('iduser') , 'type' =>  $typ , 'show' =>  0  ,   'date' =>  date('Y-m-d H:i:s') , 'link' =>  $link, 'req' =>  $req ]
]);


}





public function verfylogin(Request $request){

DB::table('statics')->insert([
    ['static_ip' => $request->ip() ,  'static_url' => $request->url() ,    'static_name' => "ورود" ,   'static_createdatdate' =>  date('Y-m-d H:i:s') ]
]);


 $tell=Session::get('verfytelle');

if(Session::get('statususer')=='1'){
 $admins = DB::table('user')->where([
    ['user_tell', '=' , $tell],
])->orderBy('id', 'desc')->orderBy('id', 'desc')->first();
} elseif(Session::get('statususer')=='2'){
 $admins = DB::table('userex')->where([
    ['user_tell', '=' , $tell],
])->orderBy('id', 'desc')->orderBy('id', 'desc')->first();
	}


 return view('user/verfylogin'  , [  'tell' => $tell , 'admins' => $admins    ]);

 }



    public function userloginpost(Request $request)
    {


    	$this->validate($request,[
    			'tell' => 'required|numeric|regex:/^09[0-9]{9}$/',
    		],[
    			'tell.required' => 'شماره تلفن همراه را وارد نمایید',
    			'tell.numeric' => 'شماره تلفن وارد شده معتبر نمی باشد',
    			'tell.regex' => 'لطفا شماره را با کد 09 و مربوط به اپراتورهای ایران انتخاب نمایید.',

    		]);

 $rnd=rand(1, 99999);


$now = strtotime("now") ;

$admins = DB::table('user')->where([
    ['user_tell',  $request->tell],
])->first();
if($admins){


 /*
	$APIKey = "72f9c543d655faf535dd156";
	$SecretKey = "!Mehdi1241368";
	$LineNumber = "30004747479829";
	$MobileNumbers = array($request->tell);
	$Messages = array('کد تایید شما : '.$rnd.'
ملت پرداخت همراه شما در پرداخت های بین المللی'  );
include(app_path().'/../testsms/SendMessage.php');
 */



	$MobileNumbers = $request->tell;


$h = new UserController();
$h->testsms($MobileNumbers,$rnd);


$updatee = \DB::table('user')->where('user_tell', '=', $request->tell)  ->update(['user_verfylogin' => $rnd , 'user_timeverfy'=> $now ]);

 $tell=$request->tell;
 Session::set('verfytelle', $tell);
 Session::set('statususer', 1);
 return redirect('user/verfylogin');


		} else  {
				 $nametr = Session::flash('statust',  'متاسفانه شماره همراه شما در سیستم وجود ندارد!');
				 return redirect('user/sign-in');
		}


}



public function login_paspost(Request $request)
{


    $this->validate($request,[
        'email' => 'required|email',
        'userpassword' => 'required',
        ],[
            'email.required' => '   لطفا ایمیل را وارد نمایید',
            'email.email' => ' لطفا فرمت ایمیل را به صورت صحیح وارد نمایید',
            'userpassword.required' => '   لطفا رمزعبور را وارد نمایید',

        ]);



        $encryptedPassword = \Crypt::encrypt($request->userpassword);
        $decryptedPassword = \Crypt::decrypt($encryptedPassword);
        $rnd=rand(1, 99999999);


$admins = DB::table('user')->where([
    ['user_email',  $request->email],
])->first();
if($admins){

$password_db= $admins->user_password;
$decryptedPassword =  Crypt::decrypt($password_db);
$userscou = DB::table('user')->where([
    ['user_email',  $request->email],
])->count();
$name_db= $admins->user_name;
$id_db= $admins->id;
$activeadmin= $admins->user_active;
$username_db= $admins->user_email;
$password_db= $admins->user_password;
$username_log = $request->email;
if(($username_log == $username_db)&&( $decryptedPassword == $request->userpassword)){

    $name_db= $admins->user_name;
    $id_db= $admins->id;
    $activeadmin= $admins->user_active;
    $username_db= $admins->user_email;
    $password_db= $admins->user_password;
    Session::set('fullname', $name_db);
    Session::set('iduser', $id_db);
    Session::set('signuser', $username_db);
    Session::set('activeuser', $activeadmin);
    $logindatepas=$admins->user_loginatdate;
    $admimg=$admins->user_img;
    if(empty($admimg)){$admimg='user2x.png';}
    Session::set('logindatepasus', $logindatepas);
    Session::set('usimg', $admimg);
    $updatee = \DB::table('user')->where('id', '=', Session::get('iduser'))  ->update(['user_loginatdate' => date('Y-m-d H:i:s') ,    'user_ip' => $request->ip()  ]);
    return redirect('user/panel');

} else
			 $nametr = Session::flash('statust',  'متاسفانه مشکلی در ورود به سیستم وجود دارد' );
				return redirect('user/sign-in');

}
		else if(empty($admins)) {
			 $nametr = Session::flash('statust',  'متاسفانه مشکلی در ورود به سیستم وجود دارد');
				return redirect('user/sign-in');
		}
















    }



    public function repeatverify(Request $request)
    {
  $lngmenus= \DB::table('language') ->where([['id', '<>',  '0'],['lng_active', '=',  '1'],])->orderBy('id', 'desc')->get();
$lngmenu=\DB::table('language') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first();


    	$this->validate($request,[
    			'tell' => 'required|numeric|regex:/^09[0-9]{9}$/',
    		],[
    			'tell.required' => 'شماره تلفن همراه را وارد نمایید',
    			'tell.numeric' => 'شماره تلفن وارد شده معتبر نمی باشد',
    			'tell.regex' => 'لطفا شماره را با کد 09 و مربوط به اپراتورهای ایران انتخاب نمایید.',

    		]);

 $rnd=rand(1, 99999);


$now = strtotime("now") ;

$admins = DB::table('user')->where([
    ['user_tell',  $request->tell],
])->first();


 $tell=$request->tell;

if(Session::get('statususer')=='1'){
 $admins = DB::table('user')->where([
    ['user_tell', '=' , $tell],
])->orderBy('id', 'desc')->orderBy('id', 'desc')->first();
} elseif(Session::get('statususer')=='2'){
 $admins = DB::table('userex')->where([
    ['user_tell', '=' , $tell],
])->orderBy('id', 'desc')->orderBy('id', 'desc')->first();
	}



if($admins){


/*
	$APIKey = "72f9c543d655faf535dd156";
	$SecretKey = "!Mehdi1241368";
	$LineNumber = "30004747479829";
	$MobileNumbers = array($request->tell);
	$Messages = array('کد تایید شما : '.$rnd.'
ملت پرداخت همراه شما در پرداخت های بین المللی'  );
include(app_path().'/../testsms/SendMessage.php');
 */




	$MobileNumbers = $request->tell;


$h = new UserController();
$h->testsms($MobileNumbers,$rnd);



$updatee = \DB::table('user')->where('user_tell', '=', $request->tell)  ->update(['user_verfylogin' => $rnd , 'user_timeverfy'=> $now ]);



if(Session::get('statususer')=='1'){
$updatee = \DB::table('user')->where('user_tell', '=', $request->tell)  ->update(['user_verfylogin' => $rnd , 'user_timeverfy'=> $now ]);
} elseif(Session::get('statususer')=='2'){
$updatee = \DB::table('userex')->where('user_tell', '=', $request->tell)  ->update(['user_verfylogin' => $rnd , 'user_timeverfy'=> $now ]);
	}

 $tell=$request->tell;
 Session::set('verfytelle', $tell);
 return redirect('user/verfylogin');

		} else  {
				 $nametr = Session::flash('statust',  'متاسفانه شماره همراه شما در سیستم وجود ندارد!');
				 return redirect('user/sign-in');
		}


}





    public function verfyloginpost(Request $request)
    {
  $lngmenus= \DB::table('language') ->where([['id', '<>',  '0'],['lng_active', '=',  '1'],])->orderBy('id', 'desc')->get();
$lngmenu=\DB::table('language') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first();

    	$this->validate($request,[
    			'verfy' => 'required|numeric',
    		],[
    			'verfy.required' => 'لطفا کداعتبارسنجی را وارد نمایید',
    			'verfy.numeric' => 'کداعتبار سنجی معتبر نمی باشد',

    		]);

$tell=Session::get('verfytelle');
$now = strtotime("now")-60 ;



		if(Session::get('statususer')=='1'){
$admins = DB::table('user')->where([
    ['user_tell', '=' ,   $tell],
    ['user_verfylogin', '=' ,   $request->verfy],
    ['user_timeverfy', '>' ,   $now],
])->orderBy('id', 'desc')->first();
} elseif(Session::get('statususer')=='2'){
$admins = DB::table('userex')->where([
    ['user_tell', '=' ,   $tell],
    ['user_verfylogin', '=' ,   $request->verfy],
    ['user_timeverfy', '>' ,   $now],
])->orderBy('id', 'desc')->first();
}

/*
$countadmins = DB::table('user')->where([
    ['user_tell', '=' ,   $tell],
    ['user_verfylogin', '=' ,   $request->verfy],
    ['user_timeverfy', '>' ,   $now],
])->count();
 */

if($admins!='0'){


 if(Session::get('statususer')=='2'){
DB::table('user')->insert([
    ['user_username' => $admins->user_email ,'user_email' => $admins->user_email ,'user_name' => $admins->user_name ,'user_tell' => $admins->user_tell  ,   'user_createdatdate' =>  date('Y-m-d H:i:s') , 'user_active' => 0 , 'user_img' => $admins->user_img  , 'user_verfylogin' => $admins->user_verfylogin  , 'user_timeverfy' => $admins->user_timeverfy  , 'user_password' => $admins->user_password  , 'user_ip' => $request->ip() , 'user_loginatdate' => date('Y-m-d H:i:s')    ]
]);
	}

$admins = DB::table('user')->where([
    ['user_tell', '=' ,   $tell],
    ['user_verfylogin', '=' ,   $request->verfy],
    ['user_timeverfy', '>' ,   $now],
])->orderBy('id', 'desc')->first();

if($admins){

    $name_db= $admins->user_name;
    $id_db= $admins->id;
    $activeadmin= $admins->user_active;
    $username_db= $admins->user_email;
    $password_db= $admins->user_password;
        Session::set('fullname', $name_db);
        Session::set('iduser', $id_db);
        Session::set('signuser', $username_db);
        Session::set('activeuser', $activeadmin);
    $logindatepas=$admins->user_loginatdate;
    $admimg=$admins->user_img;
    if(empty($admimg)){$admimg='user2x.png';}
        Session::set('logindatepasus', $logindatepas);
        Session::set('usimg', $admimg);



    $updatee = \DB::table('user')->where('id', '=', Session::get('iduser'))  ->update(['user_loginatdate' => date('Y-m-d H:i:s') ,    'user_ip' => $request->ip()  ]);


                return redirect('user/panel');

$name_db= $admins->user_name;
$id_db= $admins->id;
$activeadmin= $admins->user_active;
$username_db= $admins->user_email;
$password_db= $admins->user_password;
	Session::set('fullname', $name_db);
	Session::set('iduser', $id_db);
	Session::set('signuser', $username_db);
	Session::set('activeuser', $activeadmin);
$logindatepas=$admins->user_loginatdate;
$admimg=$admins->user_img;
if(empty($admimg)){$admimg='user2x.png';}
	Session::set('logindatepasus', $logindatepas);
	Session::set('usimg', $admimg);



$updatee = \DB::table('user')->where('id', '=', Session::get('iduser'))  ->update(['user_loginatdate' => date('Y-m-d H:i:s') ,    'user_ip' => $request->ip()  ]);


			return redirect('user/panel');

}else{

    $nametr = Session::flash('statust',  'کد اعتبارسنجی معتبر نمی باشد');
    return redirect('user/verfylogin');
}
	} else {
				 $nametr = Session::flash('statust',  'کد اعتبارسنجی معتبر نمی باشد');
				 return redirect('user/verfylogin');
	}



  }



public function paneluser(){
	if (Session::has('signuser')){


$h = new UserController();
$h->viewalertnotuser();



Session::set('nav', 'paneluser');

	Session::set('idlang', '3');


$updatee = \DB::table('user')->where('id', '=', Session::get('iduser'))  ->update(['user_active' => 1   ]);

	$admins = DB::table('user')->where([
    ['id',  Session::get('iduser')],
])->first();
$activeadmin= $admins->user_active;
Session::set('activeuser', $activeadmin);


Session::set('verfyemail', $admins->user_emailactive);
Session::set('verfytell', $admins->user_tellactive);
Session::set('verfydoc', $admins->user_autactive);

$mngindexs = \DB::table('mngindex') ->where('id', '=', '1')->orderBy('id', 'desc')->first();
Session::set('ind_himglog', $mngindexs->ind_himglog);
Session::set('ind_himglogmini', $mngindexs->ind_himglogmini);
		if (Session::get('activeuser')==1){



$laycurs = \DB::table('currencytransfer')->where([
    ['currencytransfer.ctrf_id', '<>', 0],
    ['currencytransfer.ctrf_active', '=', 1],
    ['currencytransfer.ctrf_type', '=', 1], ])
    ->orderBy('ctrf_id', 'desc')->get();


$laycursservice = \DB::table('currencytransfer')->where([
    ['currencytransfer.ctrf_id', '<>', 0],
    ['currencytransfer.ctrf_active', '=', 1],
    ['currencytransfer.ctrf_type', '=', 2], ])
    ->orderBy('ctrf_id', 'desc')->get();


	Session::set('laycurs', $laycurs);
	Session::set('laycursservice', $laycursservice);

//mycharge
$charges = \DB::table('user')
->join('charge', 'user.id', '=', 'charge.charge_iduser')
->join('finicals', 'charge.charge_finical', '=', 'finicals.id')
->where([
    ['charge.charge_arou', '=', 4],
    ['charge.charge_iduser', '=', Session::get('iduser')],
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
    ['charge.charge_iduser', '=', Session::get('iduser')],
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
    ['charge.charge_iduser', '=', Session::get('iduser')],
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
    ['charge.charge_iduser', '=', Session::get('iduser')],
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
    ['charge.charge_iduser', '=', Session::get('iduser')],
    ['finicals.finical_payment', '=', 1],
    ['finicals.finical_inc', '=', 8],])
    ->orderBy('charge.charge_id', 'desc')->get();
$chargepaybisi=0;
foreach($charges as $charge){ $chargepaybisi=$charge->charge_pay+$chargepaybisi; }


//jamkol
$chargepay= ($chargepaysup +  $chargepaymy  + $chargepaybisi ) -  ($chargepaypar + $chargepayodat) ;




$chargeac=$chargepay;




$finicalscount  = \DB::table('currencytransfer')
->join('currency', 'currencytransfer.ctrf_cur', '=', 'currency.id')
->join('productcurtrans', 'currencytransfer.ctrf_id', '=', 'productcurtrans.prcrtr_idcrtrf') ->where([
    ['productcurtrans.prcrtr_iduser', '=',  Session::get('iduser')],
    ['currencytransfer.ctrf_id', '<>', 0],   ])
    ->orderBy('prcrtr_id', 'desc')->count();

$finicalsactivecount  = \DB::table('currencytransfer')
->join('currency', 'currencytransfer.ctrf_cur', '=', 'currency.id')
->join('productcurtrans', 'currencytransfer.ctrf_id', '=', 'productcurtrans.prcrtr_idcrtrf') ->where([
    ['productcurtrans.prcrtr_iduser', '=',  Session::get('iduser')],
    ['currencytransfer.ctrf_id', '<>', 0],
    ['productcurtrans.prcrtr_payment', '<>', 0],   ])
    ->orderBy('prcrtr_id', 'desc')->count();


$tickread = DB::table('user')
->join('ticket', 'user.id', '=', 'ticket.tik_fromid')->where([
    ['ticket.tik_fromarou', '=', 4],
    ['ticket.tik_toarou', '=', 2],
    ['ticket.tik_fromid', '=', Session::get('iduser')],
    ['ticket.tik_fromsh', '=', 1],
    ['ticket.tik_fromread', '=', 0],])
    ->orderBy('ticket.id', 'desc')->count();
	Session::set('tickreaduser', $tickread);


$elanread = DB::table('user')
->join('ticket', 'user.id', '=', 'ticket.tik_toid')->where([
    ['ticket.tik_fromarou', '=', 1],
    ['ticket.tik_toarou', '=', 4],
    ['ticket.tik_toid', '=', Session::get('iduser')],
    ['ticket.tik_tosh', '=', 1],
    ['ticket.tik_toread', '=', 0],])
    ->orderBy('ticket.id', 'desc')->count();

	Session::set('elanreaduser', $elanread);



$forms  = \DB::table('form')  ->where([
    ['form_active', '<>', 0],   ])
    ->orderBy('form_cat', 'desc')->get();


$cats  = \DB::table('catform') ->where([
    ['catf_id', '<>', 0],   ])
    ->orderBy('catf_id', 'desc')->get();


$servicecounts  = \DB::table('currencytransfer')
->join('currency', 'currencytransfer.ctrf_cur', '=', 'currency.id')
->join('productcurtrans', 'currencytransfer.ctrf_id', '=', 'productcurtrans.prcrtr_idcrtrf') ->where([
    ['productcurtrans.prcrtr_iduser', '=',  Session::get('iduser')],
    ['currencytransfer.ctrf_id', '<>', 0],
    ['currencytransfer.ctrf_type', '=', 2],   ])
    ->orderBy('prcrtr_id', 'desc')->count();

$servicepaycounts  = \DB::table('currencytransfer')
->join('currency', 'currencytransfer.ctrf_cur', '=', 'currency.id')
->join('productcurtrans', 'currencytransfer.ctrf_id', '=', 'productcurtrans.prcrtr_idcrtrf') ->where([
    ['productcurtrans.prcrtr_iduser', '=',  Session::get('iduser')],
    ['currencytransfer.ctrf_id', '<>', 0],
    ['currencytransfer.ctrf_type', '=', 2],
    ['productcurtrans.prcrtr_payment', '=', 1],   ])
    ->orderBy('prcrtr_id', 'desc')->count();


$curfcount  = \DB::table('currencytransfer')
->join('currency', 'currencytransfer.ctrf_cur', '=', 'currency.id')
->join('productcurtrans', 'currencytransfer.ctrf_id', '=', 'productcurtrans.prcrtr_idcrtrf') ->where([
    ['productcurtrans.prcrtr_iduser', '=',  Session::get('iduser')],
    ['currencytransfer.ctrf_id', '<>', 0],
    ['currencytransfer.ctrf_type', '=', 1],   ])
    ->orderBy('prcrtr_id', 'desc')->count();

$curfpaycount  = \DB::table('currencytransfer')
->join('currency', 'currencytransfer.ctrf_cur', '=', 'currency.id')
->join('productcurtrans', 'currencytransfer.ctrf_id', '=', 'productcurtrans.prcrtr_idcrtrf') ->where([
    ['productcurtrans.prcrtr_iduser', '=',  Session::get('iduser')],
    ['currencytransfer.ctrf_id', '<>', 0],
    ['currencytransfer.ctrf_type', '=', 1],
    ['productcurtrans.prcrtr_payment', '=', 1],    ])
    ->orderBy('prcrtr_id', 'desc')->count();


$currencys = \DB::table('currency') ->orderBy('id', 'desc')->get();

 return view('cust/demopanel'  , [  'admins' => $admins   ,'chargeac' => $chargeac     ,'finicalscount' => $finicalscount     ,'finicalsactivecount' => $finicalsactivecount  ,'forms' => $forms  ,'cats' => $cats  ,'servicecounts' => $servicecounts   ,'servicepaycounts' => $servicepaycounts  ,'curfcount' => $curfcount  ,'curfpaycount' => $curfpaycount  , 'currencys' => $currencys   ]);


			}
else if (Session::get('activeuser')==0){    return redirect('user/activition'); }
else if (empty(Session::has('signuser'))){   return redirect('user/sign-in'); }
}
	}






	public function adduserfruser(Request $request){

$mngindexs = \DB::table('mngindex') ->where('id', '=', '1')->orderBy('id', 'desc')->first();
Session::set('ind_himglog', $mngindexs->ind_himglog);
Session::set('ind_himglogmini', $mngindexs->ind_himglogmini);


$setting = DB::table('setting')->where('id' , 1)->orderBy('id', 'desc')->orderBy('id', 'desc')->first();
if($setting->login=='sms'){
    return view('user.register'  );
}elseif($setting->login=='pas'){
    return view('user.register_pas'  );
}


				}






                public function registeruser_paspost(Request $request)
                {


                      $this->validate($request,[
                            'name' => 'required',
                            'tell' => 'required|numeric|unique:user,user_tell,$request->tell|regex:/^09[0-9]{9}$/',
                            'email' => 'required|email|unique:user,user_email,$request->email',
                            'userpassword' => 'required|min:5|max:35|confirmed'
                        ],[
                            'name.required' => 'لطفا نام و نام خانوادگی را وارد نمایید',
                            'tell.required' => 'شماره تلفن همراه را وارد نمایید',
                            'tell.numeric' => 'شماره تلفن وارد شده معتبر نمی باشد',
                            'tell.regex' => 'لطفا شماره را با کد 09 و مربوط به اپراتورهای ایران انتخاب نمایید.',
                            'tell.unique' => 'این شماره قبلا در سیستم ثبت شده است',
                            'email.required' => 'لطفا ایمیل را وارد نمایید',
                            'email.email' => 'لطفا ایمیل را به فرمت صحیح وارد نمایید',
                            'email.unique' => 'این ایمیل قبلا در سیستم ثبت شده است',
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
                            [ 'user_password' => $encryptedPassword ,   'user_createdatdate' =>  date('Y-m-d H:i:s') , 'user_active' => 0 , 'user_moaref' => $rnd   ,
                            'user_username' => $request->email  , 'user_email' => $request->email   , 'user_tell' => $request->tell   , 'user_name' => $request->name       ]
                        ]);





$admins = DB::table('user')->where([
    ['user_email', '=' ,   $request->email],
    ['user_tell', '=' ,   $request->tell],
    ['user_password', '=' ,   $encryptedPassword],
])->orderBy('id', 'desc')->first();



$name_db= $admins->user_name;



$id_db= $admins->id;
$activeadmin= $admins->user_active;
$username_db= $admins->user_email;
$password_db= $admins->user_password;
	Session::set('fullname', $name_db);
	Session::set('iduser', $id_db);
	Session::set('signuser', $username_db);
	Session::set('activeuser', $activeadmin);
$logindatepas=$admins->user_loginatdate;
$admimg=$admins->user_img;
if(empty($admimg)){$admimg='user2x.png';}
	Session::set('logindatepasus', $logindatepas);
	Session::set('usimg', $admimg);

$updatee = \DB::table('user')->where('id', '=', Session::get('iduser'))  ->update(['user_loginatdate' => date('Y-m-d H:i:s') ,    'user_ip' => $request->ip()  ]);

			return redirect('user/panel');





                    }




public function adduserfruserPost(Request $request)
    {


    	$this->validate($request,[
    			'name' => 'required',
    			'username' => 'required|email|unique:user,user_email,$request->username',
    			'tell' => 'required|numeric|unique:user,user_tell,$request->tell|regex:/^09[0-9]{9}$/',
    		],[
    			'name.required' => 'لطفا نام و نام خانوادگی را وارد نمایید',
    			'username.required' => 'لطفا ایمیل را وارد نمایید',
    			'username.email' => 'لطفا ایمیل را به فرمت صحیح وارد نمایید',
    			'username.unique' => 'این ایمیل قبلا در سیستم ثبت شده است',
    			'tell.required' => 'شماره تلفن همراه را وارد نمایید',
    			'tell.numeric' => 'شماره تلفن وارد شده معتبر نمی باشد',
    			'tell.regex' => 'لطفا شماره را با کد 09 و مربوط به اپراتورهای ایران انتخاب نمایید.',
    			'tell.unique' => 'این شماره قبلا در سیستم ثبت شده است',
    		]);
 $img='demowhite.jpg';
 $now = strtotime("now") ;
 $rnd=rand(1, 99999);


$encryptedPassword =  Crypt::encrypt('123456');
$decryptedPassword =  Crypt::decrypt($encryptedPassword);


 /*
	$APIKey = "72f9c543d655faf535dd156";
	$SecretKey = "!Mehdi1241368";
	$LineNumber = "30004747479829";
	$MobileNumbers = array($request->tell);
	$Messages = array('کد تایید شما : '.$rnd.'
ملت پرداخت همراه شما در پرداخت های بین المللی'  );
include(app_path().'/../testsms/SendMessage.php');
 */


	$MobileNumbers = $request->tell;


$h = new UserController();
$h->testsms($MobileNumbers,$rnd);



DB::table('userex')->insert([
    ['user_email' => $request->username ,'user_name' => $request->name ,'user_tell' => $request->tell  , 'user_img' => $img  , 'user_verfylogin' => $rnd  , 'user_timeverfy' => $now  , 'user_password' => $encryptedPassword   ]
]);


 $tell=$request->tell;
 Session::set('verfytelle', $tell);
 Session::set('statususer', 2);
 return redirect('user/verfylogin');


   }




public function paneluserid($id){
if (Session::has('signuser')){
$lngmenu=\DB::table('language') ->where([['id', '=',  $id],['lng_active', '=',  '1'],])->orderBy('id', 'desc')->first();
	Session::set('idlang', $id);
return redirect('user/panel');}
else{ return redirect('user/sign-in'); }
}





	public function usersignout(){
	Session::forget('iduser');
	Session::forget('signuser');
	Session::forget('signname');
	Session::forget('logindatepasus');
	Session::forget('usimg');
	Session::forget('activeuser');
	Session::forget('idimg');
	Session::forget('tickreaduser');

		return redirect('user/sign-in');
		}


	public function editprofileuser(){
if (Session::has('signuser')){

Session::set('nav', 'paneluser');
$admins = \DB::table('user')->where('id', '=', Session::get('iduser'))  ->orderBy('id', 'desc')->get();
$user = \DB::table('user')->where('id', '=', Session::get('iduser'))  ->orderBy('id', 'desc')->first();
$admimg=$user->user_img;
if(empty($admimg)){$admimg='user2x.png';}
	Session::set('usimg', $admimg);
	Session::set('activeuser', $user->user_active);



return view('cust.myprofile', ['admins' => $admins    ]); }
else{ return redirect('user/sign-in'); }
				}




	public function editprofiledetcharge($id){
if (Session::has('signuser')){




$admins = \DB::table('user')
->join('marsole', 'user.user_ncode', '=', 'marsole.mar_codmoshtari')
->join('finicals', 'marsole.id', '=', 'finicals.finical_marid')
->where([
    ['finicals.id', '=', $id] ,
    ['finicals.finical_iduser', '=', Session::get('iduser')],
    ['finicals.finical_payment', '=', 1],
    ['finicals.finical_arou', '=', '4'] , ])
    ->orderBy('finicals.id', 'desc')->get();




$getwaypays=\DB::table('getwaypay')->where('getway_active', '=', 1)   ->orderBy('id' )->get();

 return view('user.detcharge' , [ 'admins' => $admins  , 'getwaypays' => $getwaypays     ]);



} else{ return redirect('user/sign-in'); }
				}




	public function editprofileusercharge(){
if (Session::has('signuser')){



//mycharge
$charges = \DB::table('user')
->join('charge', 'user.id', '=', 'charge.charge_iduser')
->join('finicals', 'charge.charge_finical', '=', 'finicals.id')
->where([
    ['charge.charge_arou', '=', 4],
    ['charge.charge_iduser', '=', Session::get('iduser')],
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
    ['charge.charge_iduser', '=', Session::get('iduser')],
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
    ['charge.charge_iduser', '=', Session::get('iduser')],
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
    ['charge.charge_iduser', '=', Session::get('iduser')],
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
    ['charge.charge_iduser', '=', Session::get('iduser')],
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
    ['charge.charge_iduser', '=', Session::get('iduser')],
    ['finicals.finical_payment', '=', 1],
    ['finicals.finical_inc', '<>', 0],])
    ->orderBy('charge.charge_id', 'desc')->get();



return view('user.viewscharge', [  'chargesas' => $chargesas  ,'chargeac' => $chargeac ]);






		 }
else{ return redirect('user/sign-in'); }
				}



	public function inccharge(){
if (Session::has('signuser')){

$getwaypays=\DB::table('getwaypay') ->where([['getway_active', '=',  1 ],['id', '<',  10 ], ])->orderBy('id', 'desc' )->get();

return view('user.inccharge', ['getwaypays' => $getwaypays   ]);
		 }
else{ return redirect('user/sign-in'); }
				}


	public function incchargepost(Request $request){
if (Session::has('signuser')){


    	$this->validate($request,[
    			'tit' => 'required|numeric',
    			'getwaypay' => 'required'
    		],[
    			'tit.required' => 'لطفا مبلغ شارژ را وارد نمایید',
    			'tit.numeric' => 'مبلغ شارژ نامعتبر است',
    			'getwaypay.required' => 'لطفا درگاه پرداخت را انتخاب نمایید',
    		]);

$getwaypayid=$request->getwaypay;

    	if ($request->tit < 1000){

  return redirect('user/inccharge');
		}

DB::table('finicals')->insert([
    ['finical_pay' => $request->tit ,     'finical_createdatdate' =>  date('Y-m-d H:i:s') , 'finical_inc' => 5 , 'finical_payment' => 0 ,  'finical_arou' => 4 ,  'finical_iduser' => Session::get('iduser')  ]
]);

$chargefinical=\DB::table('finicals') ->where([['finical_inc', '=',  5 ],['finical_arou', '=',  4 ],['finical_iduser', '=',  Session::get('iduser')],])->orderBy('id', 'desc')->first();

DB::table('charge')->insert([
    ['charge_pay' => $request->tit ,     'charge_createdatdate' =>  date('Y-m-d H:i:s') , 'charge_arou' => 4 ,  'charge_iduser' => Session::get('iduser') ,  'charge_finical' => $chargefinical->id  ]
]);



if ($getwaypayid == 2){
  return redirect('zarinpal/epayo.php?id='.$chargefinical->id.'');

  } else
if ($getwaypayid == 3){
  return redirect('nextpay/token.php?id='.$chargefinical->id.'');
 }


		 }
else{ return redirect('user/sign-in'); }
				}





	public function editprofileuserPost( Request $request ){
if (Session::has('signuser')){



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



$user = \DB::table('user')->where('id', '=', Session::get('iduser'))  ->orderBy('id', 'desc')->first();

 		if ( $request->email ==  $user->user_email   ){  $activeemail =  $user->user_emailactive ; }
 else   if ( $request->email !=  $user->user_email   ){  $activeemail ='0';}

 		if ( $request->tell ==  $user->user_tell   ){  $activetell =  $user->user_tellactive ; }
 else   if ( $request->tell !=  $user->user_tell   ){  $activetell ='0';}


$updatee = \DB::table('user')->where('id', '=', Session::get('iduser'))  ->update(['user_name' => $request->name   ,  'user_tell' => $request->tell ,  'user_email' => $request->email ,  'user_adres' => $request->adres,  'user_emailactive' => $activeemail ,  'user_tellactive' => $activetell ]);

$user = \DB::table('user')->where('id', '=', Session::get('iduser'))  ->orderBy('id', 'desc')->first();
if ( ($user->user_emailactive == 1) &&  ($user->user_tellactive == 1)   ){  $active=1;}
if ( ($user->user_emailactive == 0) ||  ($user->user_tellactive == 0)   ){  $active=0;}
$updatee = \DB::table('user')->where('id', '=', Session::get('iduser'))  ->update(['user_active' => $active   ]);

$admins = \DB::table('user')->where('id', '=', Session::get('iduser'))  ->orderBy('id', 'desc')->get();
$nametr = Session::flash('statust', 'ویرایش اطلاعات پروفایل با موفقیت انجام شد.');
$nametrt = Session::flash('sessurl', 'myprofile/edit');

    	 	return redirect('user/myprofile/edit');
}	else{ return redirect('user/sign-in'); }
}




public function dropzoneStoreuserprofile(Request $request)
    {
        $image = $request->file('file');
        $imageName = time().$image->getClientOriginalName();
        $image->move(public_path('images'),$imageName);
$updatee = \DB::table('user')->where('id', '=', Session::get('iduser'))  ->update(['user_img' => $imageName   ]);
        return response()->json(['success'=>$imageName]);
    }




	public function securityuserprofile( Request $request ){
if (Session::has('signuser')){


$nametr = Session::flash('err', '2');
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

$updatee = \DB::table('user')->where('id', '=', Session::get('iduser'))  ->update(['user_password' => $encryptedPassword   ]);

$admins = \DB::table('user')->where('id', '=',  Session::get('iduser'))  ->orderBy('id', 'desc')->first();

			 $nametr = Session::flash('statust', 'رمز شما با موفقیت تغییر کرد.');
$nametrt = Session::flash('sessurl', 'myprofile/edit');

$user = \DB::table('user')->where('id', '=', Session::get('iduser'))  ->orderBy('id', 'desc')->first();

$superadminselanats =  DB::table('superadminselanats')  ->orderBy('id', 'desc')->first();

 if($superadminselanats->supelan_emailuser == '1'){
 	if ( $user->user_email != '')  {
 	 $usernamee = $user->user_username;
 $titmes= 'رمز شما با موفقیت تغییر کرد.';
 $mestt= 'رمز جدید';
 $mesnot = Crypt::decrypt($user->user_password);
   Mail::send('superadmin.mail', ['user' => $user , 'usernamee' => $usernamee, 'mesnot' => $mesnot, 'titmes' => $titmes , 'mestt' => $mestt], function ($m) use ($user) {
$decryptedPassword =  Crypt::decrypt($user->user_password);
            $m->from('info@melatpay.com',  'New Password'  );
            $m->to($user->user_email, $user->user_email)->subject('New Password');
        });
 } }


 if($superadminselanats->supelan_smsuser == '1'){
 	if ( $user->user_tell != '')  {

 $admins =  \DB::table('user')->where('id', '=', Session::get('iduser'))  ->orderBy('id', 'desc')->first();
$panelsms = \DB::table('panelsms')->where('id', '=',  1)  ->orderBy('id', 'desc')->first();
include(app_path().'/../sms/api_send_sms.php');
$message='با سلام '.' '.$admins->user_name.' '.'رمز شما با موفقیت تغییر کرد.' .' . '. 'رمز جدید' .' : '.$decryptedPassword.' ';
$result = Send_SMS($panelsms->sms_username, $panelsms->sms_password, $panelsms->sms_fromnumber, $admins->user_tell, $message , 0, false) ;

 		} }

 return redirect('user/myprofile/edit');


}
else{ return redirect('user/sign-in'); }
				}




	public function webservicemyuser(){
	if (Session::has('signuser')){
		if (Session::get('activeuser')==1){
$lngmenus= \DB::table('language') ->where([['id', '<>',  '0'],['lng_active', '=',  '1'],])->orderBy('id', 'desc')->get();
$lngmenu=\DB::table('language') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first();


$adminss = \DB::table('mngindex') ->where('id', '=', '1')->orderBy('id', 'desc')->get();
$admins = \DB::table('user')->where('id', '=', Session::get('iduser'))  ->orderBy('id', 'desc')->get();

return view('user.webserviceuser', ['admins' => $admins , 'adminss' => $adminss ,  'lngmenus' => $lngmenus , 'lngmenu' => $lngmenu ]);


}	else if (Session::get('activeuser')==0){    return redirect('user/activition'); }
else if (empty(Session::has('signstudent'))){   return redirect('user/sign-in'); } }
}




	public function webservicemyuserpost(){
	if (Session::has('signuser')){
		if (Session::get('activeuser')==1){
$lngmenus= \DB::table('language') ->where([['id', '<>',  '0'],['lng_active', '=',  '1'],])->orderBy('id', 'desc')->get();
$lngmenu=\DB::table('language') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first();


$characters_on_image = 24;
$possible_letters = '1234567890abcdefghigklmnopqrstuvwxyz';
$code = '';
$i = 0;
while ($i < $characters_on_image) {
$code .= substr($possible_letters, mt_rand(0, strlen($possible_letters)-1), 1);
$i++;
}

$updatee = \DB::table('user')->where('id', '=', Session::get('iduser') )  ->update(['user_api' => $code   ]);
$nametr = Session::flash('statust',  $lngmenu->lng_wsuccess);
$nametrt = Session::flash('sessurl', 'myprofile/webservice');
 return view('user.success', ['lngmenus' => $lngmenus , 'lngmenu' => $lngmenu ]);

}	else if (Session::get('activeuser')==0){    return redirect('user/activition'); }
else if (empty(Session::has('signstudent'))){   return redirect('user/sign-in'); } }
}




	public function verificationdoc(){
if (Session::has('signuser')){
  $lngmenus= \DB::table('language') ->where([['id', '<>',  '0'],['lng_active', '=',  '1'],])->orderBy('id', 'desc')->get();
$lngmenu=\DB::table('language') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first();
Session::set('nav', 'paneluser');
$admins = \DB::table('user')->where('id', '=', Session::get('iduser'))  ->orderBy('id', 'desc')->get();
$user = \DB::table('user')->where('id', '=', Session::get('iduser'))  ->orderBy('id', 'desc')->first();
$admimg=$user->user_img;
if(empty($admimg)){$admimg='user2x.png';}
	Session::set('usimg', $admimg);
	Session::set('activeuser', $user->user_active);


Session::set('verfyemail', $user->user_emailactive);
Session::set('verfytell', $user->user_tellactive);
Session::set('verfydoc', $user->user_autactive);



return view('user.verificationdoc', ['admins' => $admins    ]); }
else{ return redirect('user/sign-in'); }
				}



	public function verificationdocimgpost( Request $request ){
if (Session::has('signuser')){
$nametr = Session::flash('filecard',  '1');



    	$this->validate($request,[
    			'file'  => 'required|max:1000',
    		],[

    			'file.required' => 'لطفا نسبت به آپلود آیکن اقدام نمایید',
    			'file.max' => 'حجم فایل آپلود شده بیشتر از حد مجاز می باشد. (حدمجاز 1مگابایت یا کمتر از این مقدار باید باشد)',
    		]);


 if( $request->hasFile('file')){
        $image = $request->file('file');
        $imageName = time().$image->getClientOriginalName();
        $image->move(public_path('images'),$imageName);

    }


    $updatee = \DB::table('user')->where('id', '=', Session::get('iduser'))  ->update(['user_uploadpassport' => $imageName, 'user_autactive' => '0'    ]);

    $nametr = Session::flash('statust',  'آپلود تصویر کارت ملی باموفقیت انجام شد');
$nametrt = Session::flash('sessurl', 'verificationdoc');
 return view('user.success');

} else{ return redirect('user/sign-in'); }
				}



	public function verificationdocpost( Request $request ){
if (Session::has('signuser')){

$lngmenus= \DB::table('language') ->where([['id', '<>',  '0'],['lng_active', '=',  '1'],])->orderBy('id', 'desc')->get();
$lngmenu=\DB::table('language') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first();

$this->validate($request,[
    			'tell' => 'required|numeric',
    			'email' => 'required|email',
    		],[
    			'tell.required' => $lngmenu->lng_wtell.' ! '.$lngmenu->lng_wnotelq,
    			'tell.numeric' => $lngmenu->lng_wtell.' ! '.$lngmenu->lng_wnotelq,
    			'email.required' => $lngmenu->lng_wemail.' ! '.$lngmenu->lng_wnotelq,
    			'email.email' => $lngmenu->lng_wemail.' ! '.$lngmenu->lng_wnotelq,

    		]);




$user = \DB::table('user')->where('id', '=', Session::get('iduser'))  ->orderBy('id', 'desc')->first();

 		if ( $request->email ==  $user->user_email   ){  $activeemail =  $user->user_emailactive ; }
 else   if ( $request->email !=  $user->user_email   ){  $activeemail ='0';}

 		if ( $request->tell ==  $user->user_tell   ){  $activetell =  $user->user_tellactive ; }
 else   if ( $request->tell !=  $user->user_tell   ){  $activetell ='0';}


$updatee = \DB::table('user')->where('id', '=', Session::get('iduser'))  ->update([  'user_tell' => $request->tell ,  'user_email' => $request->email  ,  'user_emailactive' => $activeemail ,  'user_tellactive' => $activetell ]);

$user = \DB::table('user')->where('id', '=', Session::get('iduser'))  ->orderBy('id', 'desc')->first();
if ( ($user->user_emailactive == 1) &&  ($user->user_tellactive == 1)   ){  $active=1;}
if ( ($user->user_emailactive == 0) ||  ($user->user_tellactive == 0)   ){  $active=0;}
$updatee = \DB::table('user')->where('id', '=', Session::get('iduser'))  ->update(['user_active' => $active   ]);

$admins = \DB::table('user')->where('id', '=', Session::get('iduser'))  ->orderBy('id', 'desc')->get();
$nametr = Session::flash('statust',  $lngmenu->lng_wsuccess);
$nametrt = Session::flash('sessurl', 'verificationdoc');
 return view('user.success', ['lngmenus' => $lngmenus , 'lngmenu' => $lngmenu ]);
}	else{ return redirect('user/sign-in'); }
}




public function dropzoneStoreusercardmel(Request $request)
    {

                $image = $request->file('file');
        $imageName = time().$image->getClientOriginalName();
        $image->move(public_path('images'),$imageName);
$updatee = \DB::table('user')->where('id', '=', Session::get('iduser'))  ->update(['user_uploadpassport' => $imageName, 'user_autactive' => '0'    ]);
        return response()->json(['success'=>$imageName]);


    }





public function activitionuser(){
if (Session::has('signuser')){
$lngmenus= \DB::table('language') ->where([['id', '<>',  '0'],['lng_active', '=',  '1'],])->orderBy('id', 'desc')->get();
$lngmenu=\DB::table('language') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first();

$admins = \DB::table('user') ->where('id', '=', Session::get('iduser'))   ->orderBy('id', 'desc')->get();
return view('user.activition', [ 'admins' => $admins , 'lngmenus' => $lngmenus , 'lngmenu' => $lngmenu  ]);
}	 else{ return redirect('user/sign-in'); }
}






	public function emailuseractivitionverfy( Request $request ){
if (Session::has('signuser')){
 $lngmenus= \DB::table('language') ->where([['id', '<>',  '0'],['lng_active', '=',  '1'],])->orderBy('id', 'desc')->get();
$lngmenu=\DB::table('language') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first();
$slngmenu=\DB::table('languages') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first();
    	$this->validate($request,[
    			'email' => 'required',
    		],[
    			'email.required' => $lngmenu->lng_wemail.' ! '.$lngmenu->lng_wnotelq,
    		]);
 $rnd=rand(1, 99999);
$updatee = \DB::table('user')->where('id', '=', Session::get('iduser'))  ->update(['user_emailverfy' => $rnd   ]);
$admins = \DB::table('user')->where('id', '=',  Session::get('iduser'))  ->orderBy('id', 'desc')->first();
			$nametr = Session::flash('statust', $slngmenu->lng_wsendverfyemailsuc);
		  	$nametrt = Session::flash('sessurl', 'verificationdoc');
$user = \DB::table('user')->where('id', '=', Session::get('iduser'))  ->orderBy('id', 'desc')->first();
 	 $usernamee = $user->user_username;
 $titmes = 'لطفا کد زیر را در سایت ثبت کنید';
 $mestt = $lngmenu->lng_wcodeactive;
 $mesnot =  $user->user_emailverfy ;
   Mail::send('superadmin.mail', ['user' => $user , 'usernamee' => $usernamee, 'mesnot' => $mesnot, 'titmes' => $titmes , 'mestt' => $mestt], function ($m) use ($user) {
         $m->from('info@melatpay.com', 'Email activation code');
            $m->to($user->user_email, $user->user_email)->subject('Email activation code');
        });
return view('user.success', [  'lngmenus' => $lngmenus , 'lngmenu' => $lngmenu , 'slngmenu' => $slngmenu  ]);
}
else{ return redirect('user/sign-in'); }
}



	public function emailuseractivition( Request $request ){
if (Session::has('signuser')){

 $lngmenus= \DB::table('language') ->where([['id', '<>',  '0'],['lng_active', '=',  '1'],])->orderBy('id', 'desc')->get();
$lngmenu=\DB::table('language') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first();
$slngmenu=\DB::table('languages') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first();
    	$this->validate($request,[
    			'codemail' => 'required',
    		],[
    			'codemail.required' => $lngmenu->lng_wcodeactive.' ! '.$lngmenu->lng_wnotelq,
    		]);
$user = \DB::table('user')->where('id', '=', Session::get('iduser'))  ->orderBy('id', 'desc')->first();
if ( $request->codemail ==  $user->user_emailverfy   ){
$updatee = \DB::table('user')->where('id', '=', Session::get('iduser'))  ->update(['user_emailactive' => 1   ]);

$user = \DB::table('user')->where('id', '=', Session::get('iduser'))  ->orderBy('id', 'desc')->first();
if ( ($user->user_emailactive == 1) &&  ($user->user_tellactive == 1)   ){  $active=1;


$superadminselanats =  DB::table('superadminselanats')  ->orderBy('id', 'desc')->first();
 if($superadminselanats->supelan_emailaccuser == '1'){
 $usernamee = $user->user_username;
 $titmes=$lngmenu->lng_wactivedon;
 $mestt=$lngmenu->lng_wpassword;
 $mesnot = Crypt::decrypt($user->user_password);
   Mail::send('superadmin.mail', ['user' => $user , 'usernamee' => $usernamee, 'mesnot' => $mesnot, 'titmes' => $titmes , 'mestt' => $mestt], function ($m) use ($user) {

$decryptedPassword =  Crypt::decrypt($user->user_password);

            $m->from('info@melatpay.com', 'payment');

            $m->to($user->user_email, $user->user_email)->subject('Account activation');
        });
 }


 if($superadminselanats->supelan_smsaccuser == '1'){

$admins = \DB::table('user')->where('id', '=',  Session::get('iduser'))  ->orderBy('id', 'desc')->first();
$panelsms = \DB::table('panelsms')->where('id', '=',  1)  ->orderBy('id', 'desc')->first();
include(app_path().'/../sms/api_send_sms.php');
$message=$lngmenu->lng_whi.' '.$admins->user_name.' '.$lngmenu->lng_wactivedon  .' ';
$result = Send_SMS($panelsms->sms_username, $panelsms->sms_password, $panelsms->sms_fromnumber, $admins->user_tell, $message , 0, false) ; }

}
if ( ($user->user_emailactive == 0) ||  ($user->user_tellactive == 0)   ){  $active=0;}
$updatee = \DB::table('user')->where('id', '=', Session::get('iduser'))  ->update(['user_active' => $active   ]);
Session::set('activeuser', $active);


$admins = \DB::table('user')->where('id', '=',  Session::get('iduser'))  ->orderBy('id', 'desc')->first();
$nametr = Session::flash('statust', $slngmenu->lng_wactiveemailsuc );
$nametrt = Session::flash('sessurl', 'verificationdoc');
$user = \DB::table('user')->where('id', '=', Session::get('iduser'))  ->orderBy('id', 'desc')->first();
$usernamee = $user->user_username;
 $titmes=$slngmenu->lng_wactiveemailsuc ;
 $mestt=' ';
 $mesnot = ' ';
   Mail::send('superadmin.mail', ['user' => $user , 'usernamee' => $usernamee, 'mesnot' => $mesnot, 'titmes' => $titmes , 'mestt' => $mestt], function ($m) use ($user) {
$m->from('info@melatpay.com', 'payment');
$m->to($user->user_email, $user->user_email)->subject('Email activation');
});
return view('user.success', [  'lngmenus' => $lngmenus , 'lngmenu' => $lngmenu , 'slngmenu' => $slngmenu ]);
}
 else   if ( $request->codemail !=  $user->user_emailverfy   ){
$nametr = Session::flash('statust',   $slngmenu->lng_wcodeactiveerror );
$nametrt = Session::flash('sessurl', 'verificationdoc');
return view('user.error', [  'lngmenus' => $lngmenus , 'lngmenu' => $lngmenu , 'slngmenu' => $slngmenu   ]);
 }
else if (empty(Session::has('signuser'))){ return redirect('user/sign-in'); }
}
}





	public function telluseractivitionverfy( Request $request ){
if (Session::has('signuser')){
 $lngmenus= \DB::table('language') ->where([['id', '<>',  '0'],['lng_active', '=',  '1'],])->orderBy('id', 'desc')->get();
$lngmenu=\DB::table('language') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first();
$slngmenu=\DB::table('languages') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first();
    	$this->validate($request,[
    			'tell' => 'required',
    		],[
    			'tell.required' => $lngmenu->lng_wtell.' ! '.$lngmenu->lng_wnotelq,
    		]);
 $rnd=rand(1, 99999);
$updatee = \DB::table('user')->where('id', '=', Session::get('iduser'))  ->update(['user_tellverfy' => $rnd   ]);
$admins = \DB::table('user')->where('id', '=',  Session::get('iduser'))  ->orderBy('id', 'desc')->first();


$panelsms = \DB::table('panelsms')->where('id', '=',  1)  ->orderBy('id', 'desc')->first();


$message='با سلام'.' '.$admins->user_name.' '.' کدفعالسازی شما '.':'.$rnd.'';




	$APIKey = "72f9c543d655faf535dd156";
	$SecretKey = "!Mehdi1241368";
	$LineNumber = "30004747479829";
	$MobileNumbers = array($admins->user_tell );
	$Messages = array($message );

include(app_path().'/../testsms/SendMessage.php');


			 $nametr = Session::flash('statust', $slngmenu->lng_wsendverfytellsuc);
		  	$nametrt = Session::flash('sessurl', 'verificationdoc');
		  	return view('user.success', [  'lngmenus' => $lngmenus , 'lngmenu' => $lngmenu , 'slngmenu' => $slngmenu  ]);


}
else{ return redirect('user/sign-in'); }
}



	public function telluseractivition( Request $request ){
if (Session::has('signuser')){
 $lngmenus= \DB::table('language') ->where([['id', '<>',  '0'],['lng_active', '=',  '1'],])->orderBy('id', 'desc')->get();
$lngmenu=\DB::table('language') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first();
$slngmenu=\DB::table('languages') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first();

    	$this->validate($request,[
    			'codtell' => 'required',
    		],[
    			'codtell.required' => $lngmenu->lng_wtell.' ! '.$lngmenu->lng_wnotelq,
    		]);
$user = \DB::table('user')->where('id', '=', Session::get('iduser'))  ->orderBy('id', 'desc')->first();
if ( $request->codtell ==  $user->user_tellverfy   ){
$updatee = \DB::table('user')->where('id', '=', Session::get('iduser'))  ->update(['user_tellactive' => 1   ]);
$user = \DB::table('user')->where('id', '=', Session::get('iduser'))  ->orderBy('id', 'desc')->first();
if ( ($user->user_emailactive == 1) &&  ($user->user_tellactive == 1)   ){  $active=1;



$superadminselanats =  DB::table('superadminselanats')  ->orderBy('id', 'desc')->first();
 if($superadminselanats->supelan_emailaccuser == '1'){
 $usernamee = $user->user_username;
 $titmes=$lngmenu->lng_wactivedon;
 $mestt=$lngmenu->lng_wpassword;
 $mesnot = Crypt::decrypt($user->user_password);
   Mail::send('superadmin.mail', ['user' => $user , 'usernamee' => $usernamee, 'mesnot' => $mesnot, 'titmes' => $titmes , 'mestt' => $mestt], function ($m) use ($user) {

$decryptedPassword =  Crypt::decrypt($user->user_password);

            $m->from('info@melatpay.com', 'Account activation');

            $m->to($user->user_email, $user->user_email)->subject('Account activation');
        });
 }


 if($superadminselanats->supelan_smsaccuser == '1'){

$admins = \DB::table('user')->where('id', '=',  Session::get('iduser'))  ->orderBy('id', 'desc')->first();
$panelsms = \DB::table('panelsms')->where('id', '=',  1)  ->orderBy('id', 'desc')->first();
include(app_path().'/../sms/api_send_sms.php');
$message=$lngmenu->lng_whi.' '.$admins->user_name.' '.$lngmenu->lng_wactivedon  .' ';
$result = Send_SMS($panelsms->sms_username, $panelsms->sms_password, $panelsms->sms_fromnumber, $admins->user_tell, $message , 0, false) ; }


}
if ( ($user->user_emailactive == 0) ||  ($user->user_tellactive == 0)   ){  $active=0;}
$updatee = \DB::table('user')->where('id', '=', Session::get('iduser'))  ->update(['user_active' => $active   ]);
Session::set('activeuser', $active);
$admins = \DB::table('user')->where('id', '=',  Session::get('iduser'))  ->orderBy('id', 'desc')->first();
$nametr = Session::flash('statust', $slngmenu->lng_wactivetellsuc );
$nametrt = Session::flash('sessurl', 'verificationdoc');
$user = \DB::table('user')->where('id', '=', Session::get('iduser'))  ->orderBy('id', 'desc')->first();
$usernamee = $user->user_username;
 $titmes=$slngmenu->lng_wactivetellsuc;
 $mestt=' ';
 $mesnot = ' ';



 /*
   Mail::send('superadmin.mail', ['user' => $user , 'usernamee' => $usernamee, 'mesnot' => $mesnot, 'titmes' => $titmes , 'mestt' => $mestt], function ($m) use ($user) {
$m->from('info@melatpay.com', 'فعالسازی ایمیل');
$m->to($user->admin_email, $user->admin_email)->subject('ایمیل فعال شد');
});
*/




	return view('user.success', [  'lngmenus' => $lngmenus , 'lngmenu' => $lngmenu  , 'slngmenu' => $slngmenu ]);
}
 else   if ( $request->codtell !=  $user->user_tellverfy   ){
$nametr = Session::flash('statust',   $slngmenu->lng_wcodeactiveerror );
$nametrt = Session::flash('sessurl', 'verificationdoc');
	return view('user.error', [  'lngmenus' => $lngmenus , 'lngmenu' => $lngmenu  , 'slngmenu' => $slngmenu ]);
 }
else if (empty(Session::has('signuser'))){ return redirect('user/sign-in'); }
}
}



public function prodcurrencytransferid($id){
	if (Session::has('signuser')){
		if (Session::get('activeuser')==1){

 Session::set('nav', 'prodcurrencytransferid');

$admin  = \DB::table('currencytransfer')
->join('currency', 'currencytransfer.ctrf_cur', '=', 'currency.id') ->where([
    ['currencytransfer.ctrf_id', '<>', 0],
    ['currencytransfer.ctrf_type', '=', 1],
    ['currencytransfer.ctrf_id', '=', $id], ])
    ->orderBy('ctrf_id', 'desc')->first();



$countrys = \DB::table('apps_countries')->where('id', '<>', 0)  ->orderBy('id', 'asc')->get();
$currency = \DB::table('currency')->where('id', '=', 1)  ->orderBy('id', 'desc')->first();

	return view('user.currencytransfer', [  'admin' => $admin ,   'countrys' => $countrys,   'currency' => $currency   ]);

			}
else if (Session::get('activeuser')==0){    return redirect('user/activition'); }
else if (empty(Session::has('signuser'))){   return redirect('user/sign-in'); }
}
	}




public function prodcurrencytransferidpost ($id , Request $request ){
	if (Session::has('signuser')){
		if (Session::get('activeuser')==1){

    	$this->validate($request,[
    			'namelastname' => 'required',
    			'pay' => 'required|numeric',
    			'country' => 'required',
    			'des' => 'required',
    		],[
    			'namelastname.required' => 'لطفا نام و نام خانوادگی گیرنده را وارد نمایید',
    			'pay.required' => 'لطفا مبلغ حواله را به دلار وارد نمایید',
    			'pay.numeric' => 'مبلغ حواله نامعتبر می باشد',
    			'country.required' => 'لطفا کشور مقصد را انتخاب نمایید',
    			'des.required' => 'لطفا توضیحات را وارد نمایید',
    		]);


$admin  = \DB::table('currencytransfer')
->join('currency', 'currencytransfer.ctrf_cur', '=', 'currency.id') ->where([
    ['currencytransfer.ctrf_id', '<>', 0],
    ['currencytransfer.ctrf_type', '=', 1],
    ['currencytransfer.ctrf_id', '=', $id], ])
    ->orderBy('ctrf_id', 'desc')->first();


$fixfee=$admin->ctrf_fixfee ;
$varebfee = $request->pay*($admin->ctrf_varebfee/100);
$finalfee=($fixfee+$varebfee)*$admin->cur_gh;
$payservirr=$request->pay*$admin->cur_gh;
$payfinalirr=($request->pay+$fixfee+$varebfee)*$admin->cur_gh ;

DB::table('productcurtrans')->insert([
    [ 'prcrtr_namerecv' =>  $request->namelastname , 'prcrtr_country' =>  $request->country , 'prcrtr_idcrtrf' =>  $id  , 'prcrtr_des' =>  $request->des , 'prcrtr_iduser' =>   Session::get('iduser'),   'prcrtr_createdatdate' =>  date('Y-m-d H:i:s') , 'prcrtr_type' => 1  , 'prcrtr_fixfee' =>  $fixfee , 'prcrtr_varebfee' =>  $varebfee , 'prcrtr_finalfee' =>  $finalfee , 'prcrtr_pay' =>  $payservirr , 'prcrtr_payfinalirr' =>  $payfinalirr  , 'prcrtr_paycur' => $request->pay   ]
]);



$productcurtrans = \DB::table('productcurtrans')->where('prcrtr_iduser', '=', Session::get('iduser'))  ->orderBy('prcrtr_id', 'desc')->first();

    		 DB::table('finicals')->insert([
    ['finical_marid' => $productcurtrans->prcrtr_id ,  'finical_pay' => $payfinalirr ,    'finical_createdatdate' => date('Y-m-d H:i:s') ,   'finical_inc' =>  '3' ,   'finical_iduser' =>   Session::get('iduser') ,   'finical_arou' =>  '4' ,   'finical_marpay' =>  '5' ,   'finical_payment' =>  0     ]
]);



$nametr = Session::flash('statust', 'سفارش حواله ارزی شما باموفقیت پرداخت شد.');
$nametrt = Session::flash('sessurl', 'viewsprodbuy');
		  return view('user.success');

			}
else if (Session::get('activeuser')==0){    return redirect('user/activition'); }
else if (empty(Session::has('signuser'))){   return redirect('user/sign-in'); }
}
	}




public function prodserviceid($id){
	if (Session::has('signuser')){
		if (Session::get('activeuser')==1){

 Session::set('nav', 'prodserviceid');


$admin = \DB::table('currencytransfer')
->join('currency', 'currencytransfer.ctrf_cur', '=', 'currency.id') ->where([
    ['currencytransfer.ctrf_id', '<>', 0],
    ['currencytransfer.ctrf_type', '=', 2],
    ['currencytransfer.ctrf_id', '=', $id], ])
    ->orderBy('ctrf_id', 'desc')->first();

//$admin = \DB::table('currencytransfer')->where('ctrf_id', '=', $id)  ->orderBy('ctrf_id', 'desc')->first();
$user =  \DB::table('user')->where('id', '=', Session::get('iduser'))  ->orderBy('id', 'desc')->first();
$currency = \DB::table('currency')->where('id', '=', 1)  ->orderBy('id', 'desc')->first();

	return view('user.service', [  'admin' => $admin ,   'user' => $user,   'currency' => $currency   ]);

			}
else if (Session::get('activeuser')==0){    return redirect('user/activition'); }
else if (empty(Session::has('signuser'))){   return redirect('user/sign-in'); }
}
	}



public function viewsprodbuy(){
	if (Session::has('signuser')){
		if (Session::get('activeuser')==1){

 Session::set('nav', 'viewsprodbuy');

$admins  = \DB::table('currencytransfer')
->join('currency', 'currencytransfer.ctrf_cur', '=', 'currency.id')
->join('productcurtrans', 'currencytransfer.ctrf_id', '=', 'productcurtrans.prcrtr_idcrtrf') ->where([
    ['productcurtrans.prcrtr_iduser', '=',  Session::get('iduser')],
    ['currencytransfer.ctrf_id', '<>', 0],
    ['currencytransfer.ctrf_type', '=', 1],   ])
    ->orderBy('prcrtr_id', 'desc')->get();

return view('user.viewsprodbuy', ['admins' => $admins]);

			}
else if (Session::get('activeuser')==0){    return redirect('user/activition'); }
else if (empty(Session::has('signuser'))){   return redirect('user/sign-in'); }
}
	}


public function viewsprodservice(){
	if (Session::has('signuser')){
		if (Session::get('activeuser')==1){

 Session::set('nav', 'viewsprodservice');

$admins  = \DB::table('currencytransfer')
->join('currency', 'currencytransfer.ctrf_cur', '=', 'currency.id')
->join('productcurtrans', 'currencytransfer.ctrf_id', '=', 'productcurtrans.prcrtr_idcrtrf') ->where([
    ['productcurtrans.prcrtr_iduser', '=',  Session::get('iduser')],
    ['currencytransfer.ctrf_id', '<>', 0],
    ['currencytransfer.ctrf_type', '=', 2],   ])
    ->orderBy('prcrtr_id', 'desc')->get();


return view('user.viewsprodservice', ['admins' => $admins]);

			}
else if (Session::get('activeuser')==0){    return redirect('user/activition'); }
else if (empty(Session::has('signuser'))){   return redirect('user/sign-in'); }
}
	}



public function viewsfinicals(){
	if (Session::has('signuser')){
		if (Session::get('activeuser')==1){

 Session::set('nav', 'mali');

$admins  = \DB::table('currencytransfer')
->join('currency', 'currencytransfer.ctrf_cur', '=', 'currency.id')
->join('productcurtrans', 'currencytransfer.ctrf_id', '=', 'productcurtrans.prcrtr_idcrtrf') ->where([
    ['productcurtrans.prcrtr_iduser', '=',  Session::get('iduser')],
    ['currencytransfer.ctrf_id', '<>', 0],
    ['currencytransfer.ctrf_type', '<>', 0],   ])
    ->orderBy('prcrtr_id', 'desc')->get();


return view('user.viewsfinicals', ['admins' => $admins]);

			}
else if (Session::get('activeuser')==0){    return redirect('user/activition'); }
else if (empty(Session::has('signuser'))){   return redirect('user/sign-in'); }
}
	}



public function trakings(){
	if (Session::has('signuser')){
		if (Session::get('activeuser')==1){

 Session::set('nav', 'trakings');



$user = \DB::table('user')->where('id', '=', Session::get('iduser'))  ->orderBy('id', 'desc')->first();

$id=$user->id;

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




return view('user.trakings', ['chargesas' => $chargesas , 'chargeac' => $chargeac]);

			}
else if (Session::get('activeuser')==0){    return redirect('user/activition'); }
else if (empty(Session::has('signuser'))){   return redirect('user/sign-in'); }
}
	}



public function dateyearmonthuser($year,$month){
	if (Session::has('signuser')){
		if (Session::get('activeuser')==1){



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

return redirect('user/rezervmak/addrezerv/1');

			}
else if (Session::get('activeuser')==0){    return redirect('user/activition'); }
else if (empty(Session::has('signuser'))){   return redirect('user/sign-in'); }
}
	}




public function rezervdpost(  Request $request){
	if (Session::has('signuser')){
		if (Session::get('activeuser')==1){

		 if($request->cal_pesover > 0 ){



 DB::table('listrezerv')->insert([
    ['list_iduser' => Session::get('iduser') , 'list_idcl' => $request->idcl  ,   'list_createdatdate' =>  date('Y-m-d H:i:s')    ]
]);




$nametr = Session::flash('statust', 'زمان آزمون باموفقیت ایجاد شد.');
$nametrt = Session::flash('sessurl', 'success');

return redirect('user/rezervmak/addrezerv/2');



		 }else{




$nametr = Session::flash('statust', 'متاسفانه ظرفیت این آزمون تکمیل شده است.');

$nametrt = Session::flash('sessurl', 'error');

return redirect('user/rezervmak/addrezerv/1');


		 }





			}
else if (Session::get('activeuser')==0){    return redirect('user/activition'); }
else if (empty(Session::has('signuser'))){   return redirect('user/sign-in'); }
}
	}




















public function rezervmakpers(  Request $request){
	if (Session::has('signuser')){
		if (Session::get('activeuser')==1){




 $superadmins =  \DB::table('superadmins')->where([['id', '=', 1],])->orderBy('id', 'desc')->first();
  $superadmin_rezerv=$superadmins->superadmin_rezerv;

 if($request->makp=='1'){
 	 $mak=0;

     $mak_price=$superadmins->superadmin_rezerv;
   } else {
 	$mak=$request->mak;

 $makcenters =  \DB::table('makcenter')->where([['mak_id', '=', $mak],])->orderBy('mak_id', 'desc')->first();
  $mak_price=$makcenters->mak_price+$superadmin_rezerv;
 }



$listdiscounts = \DB::table('listdiscount')
->join('discount', 'listdiscount.listdis_iddisc', '=', 'discount.discount_id')   ->where([
    ['listdiscount.listdis_idform', '=', '909090'],
    ['discount.discount_code', '=', $request->disccodereq],
    ['discount.discount_active', '=', 1],  ])
 ->orderBy('discount_id', 'desc')->first();




 if($listdiscounts){
	$mak_price = $mak_price - $request->discprice ;
}else{
	$mak_price=$mak_price;
}




 $rnd=rand(1, 99999999);

$updatee = \DB::table('listrezerv')->where([
    ['listrezerv.list_iduser', '=',  Session::get('iduser')],
    ['listrezerv.list_id', '=', $request->list_id],   ])
    ->update(['list_mak' => $mak , 'list_price' => $mak_price, 'list_pricerezerv' => $superadmin_rezerv, 'list_rnd' => $rnd ]);




$link=$request->list_id;
$req=3;
$typ='12';
$h = new UserController();
$h->alertnotif($typ,$link,$req);




$nametr = Session::flash('statust', 'نوع سرویس باموفقیت ایجاد شد.');
$nametrt = Session::flash('sessurl', 'rezervmak/3');
$nametrt = Session::flash('sessurl', 'error');


return redirect('user/rezervmak/addrezerv/3');

			}
else if (Session::get('activeuser')==0){    return redirect('user/activition'); }
else if (empty(Session::has('signuser'))){   return redirect('user/sign-in'); }
}
	}




	public function rezervdmak(){
	if (Session::has('signuser')){
		if (Session::get('activeuser')==1){


 Session::set('nav', 'rezervmak');

 $todayshamsi=  \DB::table('dateshamsi')  ->where([ ['id', '=',  1],   ])->orderBy('id', 'desc')->first();


	Session::set('year', $todayshamsi->year);
	Session::set('month', $todayshamsi->month);

 return redirect('user/rezervmak/addrezerv/1');

			}
else if (Session::get('activeuser')==0){    return redirect('user/activition'); }
else if (empty(Session::has('signuser'))){   return redirect('user/sign-in'); }
}
	}


public function rezervmakid($idrezerv , $id){
	if (Session::has('signuser')){
		if (Session::get('activeuser')==1){

 Session::set('nav', 'rezervmak');



$listdiscounts = \DB::table('listdiscount')
->join('discount', 'listdiscount.listdis_iddisc', '=', 'discount.discount_id')   ->where([
    ['discount.discount_active', '=', 1],
    ['listdiscount.listdis_idform', '=', '909090'], ])
 ->orderBy('discount_id', 'desc')->first();


if($id=='3'){

 $rnd=rand(1, 99999999);


$updatee = \DB::table('listrezerv')->where([
    ['listrezerv.list_iduser', '=',  Session::get('iduser')],
    ['listrezerv.list_id', '=', $idrezerv],   ])
    ->update(['list_rnd' => $rnd ]);

}


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
->where([
    ['calendarrezerv.cal_id', '<>', 0],
    ['listrezerv.list_iduser', '=', Session::get('iduser')], ])
    ->orderBy('listrezerv.list_id', 'desc')->first();

}else{

$listrezerv = \DB::table('listrezerv')
->join('calendarrezerv', 'listrezerv.list_idcl', '=', 'calendarrezerv.cal_id')
->where([
    ['calendarrezerv.cal_id', '<>', 0],
    ['listrezerv.list_id', '=', $idrezerv],
    ['listrezerv.list_iduser', '=', Session::get('iduser')], ])
    ->orderBy('listrezerv.list_id', 'desc')->first();
}


$makcenters = \DB::table('makcenter')
->where([
    ['makcenter.mak_id', '<>', 0], ])
    ->orderBy('makcenter.mak_id', 'asc')->get();

	return view('cust.rezervmak', ['month' => $month , 'todayshamsi' => $todayshamsi , 'calendarrezervs' => $calendarrezervs , 'id' => $id  , 'listrezerv' => $listrezerv  , 'makcenters' => $makcenters  ,  'idrezerv' => $idrezerv , 'listdiscounts' => $listdiscounts ]);


			}
else if (Session::get('activeuser')==0){    return redirect('user/activition'); }
else if (empty(Session::has('signuser'))){   return redirect('user/sign-in'); }
}
	}



public function viewsrezervmaks(){
	if (Session::has('signuser')){
		if (Session::get('activeuser')==1){

 Session::set('nav', 'viewsrezervmaks');

$admins  = \DB::table('listrezerv')
->join('calendarrezerv', 'listrezerv.list_idcl', '=', 'calendarrezerv.cal_id')
->join('user', 'listrezerv.list_iduser', '=', 'user.id')
->leftJoin('makcenter', 'listrezerv.list_mak', '=', 'makcenter.mak_id')
->where([
    ['calendarrezerv.cal_id', '<>', 0],
    ['listrezerv.list_iduser', '=', Session::get('iduser')], ])
    ->orderBy('listrezerv.list_id', 'desc')->get();


return view('cust.viewsrezervmaks', ['admins' => $admins]);

			}
else if (Session::get('activeuser')==0){    return redirect('user/activition'); }
else if (empty(Session::has('signuser'))){   return redirect('user/sign-in'); }
}
	}


public function onlineshops(){
	if (Session::has('signuser')){
		if (Session::get('activeuser')==1){

 Session::set('nav', 'onlineshops');

$admins  = \DB::table('form') ->where([
    ['form_active', '<>', 0],   ])
    ->orderBy('form_id', 'desc')->get();


return view('user.onlineshops', ['admins' => $admins]);

			}
else if (Session::get('activeuser')==0){    return redirect('user/activition'); }
else if (empty(Session::has('signuser'))){   return redirect('user/sign-in'); }
}
	}


public function onlineshopsid($id){
	if (Session::has('signuser')){
		if (Session::get('activeuser')==1){



 Session::set('nav', 'onlineshops');


$form = \DB::table('form')
->where([
    ['form.form_rnd', '=', $id], ])
    ->orderBy('form.form_id', 'asc')->first();



$listdiscounts = \DB::table('listdiscount')
->join('discount', 'listdiscount.listdis_iddisc', '=', 'discount.discount_id')
->join('form', 'listdiscount.listdis_idform', '=', 'form.form_rnd')  ->where([
    ['form.form_rnd', '=', $id],
    ['discount.discount_active', '=', 1], ])
 ->orderBy('discount_id', 'desc')->first();


    if($form->form_linkname=='pteturkey'){  Session::set('nav', 'pteturkey');  }
    if($form->form_linkname=='pteaz'){  Session::set('nav', 'pteaz');  }
    if($form->form_linkname=='pteem'){  Session::set('nav', 'pteem');  }
    if($form->form_linkname=='pteirqs'){  Session::set('nav', 'pteirqs');  }

$admins = \DB::table('form')
->join('list', 'form.form_rnd', '=', 'list.list_rnd')
->where([
    ['list.list_aro', '=', 0],
    ['form.form_rnd', '=', $id], ])
    ->orderBy('list.list_chk', 'asc')->get();




$formselects=0;
$formchecks=0;

 foreach($admins as $admin){



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






$currency  = \DB::table('currency') ->where([
    ['currency.id', '=', 1], ])
    ->orderBy('id', 'desc')->first();






return view('cust.shopformm', ['admins' => $admins ,'form' => $form  ,'formselects' => $formselects ,'formchecks' => $formchecks  , 'listdiscounts' => $listdiscounts   , 'currency' => $currency   ]);

			}
else if (Session::get('activeuser')==0){    return redirect('user/activition'); }
else if (empty(Session::has('signuser'))){   return redirect('user/sign-in'); }
}
	}





public function onlineshopsidpost ($id , Request $request ){
	if (Session::has('signuser')){
		if (Session::get('activeuser')==1){



 $rnd=rand(1, 99999999);



$currency  = \DB::table('currency') ->where([
    ['currency.id', '=', 1], ])
    ->orderBy('id', 'desc')->first();


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


DB::table('myrequest')->insert([
    [ 'req_name' => $form->form_name ,   'req_date' =>  date('Y-m-d H:i:s') , 'req_rndform' => $id    , 'req_userid' => Session::get('iduser') , 'req_rnd' => $rnd       ]
]);



$myrequest = \DB::table('myrequest')
->where([
    ['myrequest.req_rndform', '=', $id],
    ['myrequest.req_userid', '=', Session::get('iduser')], ])
    ->orderBy('myrequest.req_id', 'desc')->first();


$i=0;


$price=0;

    foreach($admins as $admin){

    	$req='name'; $reqname=$req.$admin->list_id;

      $postdate=$request->$reqname;



if(($admin->list_typ=='1')&&($admin->list_price=='1')){


$listdiscounts = \DB::table('listdiscount')
->join('discount', 'listdiscount.listdis_iddisc', '=', 'discount.discount_id')
->join('form', 'listdiscount.listdis_idform', '=', 'form.form_rnd')  ->where([
    ['form.form_rnd', '=', $id],
    ['discount.discount_code', '=', $request->disccodereq],
    ['discount.discount_active', '=', 1],  ])
 ->orderBy('discount_id', 'desc')->first();

if($listdiscounts){
	$postdate = $form->form_price - $request->discprice ;
}else{
	$postdate=$form->form_price;


}





	}

if($admin->list_typ=='4'){

	 if( $request->hasFile($reqname)){
        $image = $request->file($reqname);
        $imageName = time().$image->getClientOriginalName();
        $image->move(public_path('images'),$imageName);
	 $postdate=$imageName;
    }   else {
		$postdate='';
	}

}





if($admin->list_typ=='9'){ $postdate='';   }



if($admin->list_price=='1'){  $price=$postdate;




if(($form->form_linkname=='hotelscom')||($form->form_linkname=='airbnb')){



$prices = \DB::table('form')
->join('list', 'form.form_rnd', '=', 'list.list_rnd')
->where([
    ['list.list_aro', '=', 0],
    ['form.form_rnd', '=', $id],
    ['list.list_price', '=', 1], ])
    ->orderBy('list.list_id', 'asc')->first();

   // echo $prices->list_id.'<br>';
    $m='name'.$prices->list_id;

    $n=$request->$m;
    $price=$currency->cur_gh*$n;

    //echo $price;

}

}


DB::table('list')->insert([
    [ 'list_rnd' => $id ,   'list_date' =>  date('Y-m-d H:i:s') , 'list_aro' => 1 , 'list_typ' => $admin->list_typ   , 'list_chk' => $admin->list_chk  , 'list_name' => $postdate   , 'list_userid' => Session::get('iduser') , 'list_myreqid' => $myrequest->req_id   , 'list_n' => $i      ]
]);





if($admin->list_typ=='9'){


$list = \DB::table('list')
->where([
    ['list.list_myreqid', '=', $myrequest->req_id],
    ['list.list_typ', '=', 9], ])
    ->orderBy('list.list_id', 'desc')->first();

$myCheckboxes = $request->input('field_chck'.$admin->list_id);

		$postdate='';
$i=0;
if($myCheckboxes != NULL)  {
foreach($myCheckboxes as $quan) {

DB::table('reqcheck')->insert([
    ['rchk_rndform' => $id ,  'rchk_reqid' => $myrequest->req_id   , 'rchk_formchkid' =>  $quan , 'rchk_listid' => $list->list_id    ]
]);
	}
	}



	}



 $i++;
}








$updatee = \DB::table('myrequest')->where([
    ['myrequest.req_userid', '=',  Session::get('iduser')],
    ['myrequest.req_id', '=', $myrequest->req_id],   ])
    ->update(['req_price' => $price ]);






DB::table('finicals')->insert([
    ['finical_marid' => $myrequest->req_id ,  'finical_pay' => $price ,    'finical_createdatdate' => date('Y-m-d H:i:s') ,   'finical_inc' =>  '3' ,   'finical_iduser' =>   Session::get('iduser') ,   'finical_arou' =>  '4' ,   'finical_marpay' =>  '7' ,   'finical_payment' =>  0     ]
]);





$link=$myrequest->req_rndform;
$req=$myrequest->req_id;
$typ='11';
$h = new UserController();
$h->alertnotif($typ,$link,$req);



$nametr = Session::flash('statust',  'درخواست شما باموفقیت ایجاد شد');
$nametrt = Session::flash('sessurl', 'viewsonlineshops');




 
//  return redirect('sample/request.php?id='.$myrequest->req_rnd.'&&price='.$price.'');


$myuser = DB::table('user')->where([
    ['id',  Session::get('iduser')],
])->first();

$setting = DB::table('setting')->where('id' , 1)->orderBy('id', 'desc')->orderBy('id', 'desc')->first();
$getway_payment = $setting->getway_payment;
if($myuser->user_email=='mustafa1390@gmail.com'){
    $price='506';
    $getway_payment = 'payping';
}


    if($getway_payment=='zarinpal'){
        
//  start zarinpal
 

$data = array("merchant_id" => "f373affa-e1bd-11e8-bcb5-005056a205be",
"amount" => $price,
"callback_url" => "https://azmoonpte.com/servicepay/user/verify_buy.php?req_rnd=".$myrequest->req_rnd,
"description" => $myuser->user_name,
"metadata" => [ "email" => $myuser->user_email,"mobile"=>$myuser->user_tell],
);
$jsonData = json_encode($data);
$ch = curl_init('https://api.zarinpal.com/pg/v4/payment/request.json');
curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v1');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Content-Type: application/json',
'Content-Length: ' . strlen($jsonData)
));

$result = curl_exec($ch);
$err = curl_error($ch);
$result = json_decode($result, true, JSON_PRETTY_PRINT);
curl_close($ch);



if ($err) {
echo "cURL Error #:" . $err;
} else {
if (empty($result['errors'])) {
    if ($result['data']['code'] == 100) {
        // header('Location: https://www.zarinpal.com/pg/StartPay/' . $result['data']["authority"]);
        $url ='https://www.zarinpal.com/pg/StartPay/' . $result['data']["authority"];
        // header('Location: https://www.zarinpal.com/pg/StartPay/' . $result['data']["authority"]);
        // return Redirect::to($url);
        return redirect()->away($url);
    }
} else {
     echo'Error Code: ' . $result['errors']['code'];
     echo'message: ' .  $result['errors']['message'];

}
}


//  end zarinpal

    }

    if($getway_payment=='payping'){

         
                    $token = "PJ__XCI8AR-pL5c4GCOQc3auTQzk2wPPKJ7hgYKq3U0";
                    $args = array(
                        "amount" => $price,
                        "payerIdentity" => $myuser->user_email,
                        "payerName" => $myuser->user_name ,
                        "description" => $myuser->user_tell ,
                        "returnUrl" => 'https://azmoonpte.com/servicepay/user/callback/payping/' . $myrequest->req_rnd,
                        "clientRefId" => "$myrequest->req_rnd"
                    );

                    try {
                        $curl = curl_init();
                        curl_setopt_array($curl, array(
                                CURLOPT_URL => "https://api.payping.ir/v2/pay",
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_POSTFIELDS => json_encode($args),
                                CURLOPT_HTTPHEADER => array(
                                    "accept: application/json",
                                    "authorization: Bearer " . $token,
                                    "cache-control: no-cache",
                                    "content-type: application/json"
                                ),
                            )
                        );
                        $result = curl_exec($curl);
                        curl_close($curl);
                        $transaction_info = json_decode($result, true);
                        // dd($result);
                        if ($transaction_info['code']) {
                            // $order->transactionId = $transaction_info['code'];
                            // $order->save();
                            // session_start();
                            if (isset($_SESSION['refresh2'])) unset($_SESSION['refresh2']);
                            if (isset($_SESSION['refresh'])) unset($_SESSION['refresh']);
                            return redirect('https://api.payping.ir/v2/pay/gotoipg/' . $transaction_info['code']);
                        } else throw new \Exception("مشکلی در پرداخت وجود دارد");

                    } catch (\Exception $e) {
                        echo $e->getMessage();

                    }


    }




  			}
else if (Session::get('activeuser')==0){    return redirect('user/activition'); }
else if (empty(Session::has('signuser'))){   return redirect('user/sign-in'); }
}
	}

// jjj

    
public function callback_payping ($id ){
	if (Session::has('signuser')){
		if (Session::get('activeuser')==1){


            
            
$req_rnd = $id;
$myrequest = \DB::table('myrequest')
->where([
    ['myrequest.req_rnd', '=', $req_rnd],
    ['myrequest.req_userid', '=', Session::get('iduser')], ])
    ->orderBy('myrequest.req_id', 'desc')->first();

$myuser = DB::table('user')->where([
    ['id',  Session::get('iduser')],
])->first();

$price = $myrequest->req_price;

if($myuser->user_email=='mustafa1390@gmail.com'){$price='5060';}






                $refid; 

                if (isset($_POST['refid'])) $refid = $_POST['refid'];
                else $refid = 0;
 
  
                $token = "PJ__XCI8AR-pL5c4GCOQc3auTQzk2wPPKJ7hgYKq3U0"; 

                $args = array(
                    'amount' => $price,
                    'refId' => $refid
                );
                try {
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                            CURLOPT_URL => "https://api.payping.ir/v2/pay/verify",
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_POSTFIELDS => json_encode($args),
                            CURLOPT_HTTPHEADER => array(
                                "accept: application/json",
                                "authorization: Bearer " . $token,
                                "cache-control: no-cache",
                                "content-type: application/json"
                            ),
                        )
                    );
                    $result = curl_exec($curl);
                    $header = curl_getinfo($curl);
                    curl_close($curl);
                    $callback_info = json_decode($result, true);

                    dd($callback_info);

                    if ($callback_info['cardNumber']) { }
                }catch (\Exception $e) {
                    //      dd([$e]);
                   
                }





    // return  redirect('user/error/'.$req_rnd);
    // return  redirect('user/success/'.$req_rnd);








  			}
else if (Session::get('activeuser')==0){    return redirect('user/activition'); }
else if (empty(Session::has('signuser'))){   return redirect('user/sign-in'); }
}
	}





	public function addticketuser(){
		if (Session::has('signuser')){

 Session::set('nav', 'addticket');
 return view('cust.addticket'); }
else{ return redirect('user/sign-in'); }
		}



public function addticketuserPost(Request $request){
if (Session::has('signuser')){

    	$this->validate($request,[
    			'tit' => 'required',
    			'des' => 'required'
    		],[
    			'tit.required' => 'لطفا موضوع تیکت را وارد نمایید',
    			'des.required' => 'لطفا متن تیکت را وارد نمایید',
    		]);

DB::table('ticket')->insert([
    ['tik_tit' => $request->tit ,     'tik_createdatdate' =>  date('Y-m-d H:i:s') ,     'tik_date' =>  date('Y-m-d H:i:s') , 'tik_fromarou' => 4 , 'tik_toarou' => 2 , 'tik_fromid' => Session::get('iduser') ,  'tik_fromsh' => 1 , 'tik_tosh' => 1 , 'tik_active' => 1 , 'tik_fromread' => 1 , 'tik_toread' => 0]
]);

$users = DB::table('ticket')->where('tik_tit', $request->tit)->orderBy('id', 'desc')->first();

$idtik= $users->id;

DB::table('message')->insert([
    ['mes_ticket' => $idtik ,  'mes_des' => $request->des   , 'mes_createdatdate' =>  date('Y-m-d H:i:s') , 'mes_flg' =>  1    ]
]);




$link=$idtik;
$req=0;
$typ='14';
$h = new UserController();
$h->alertnotif($typ,$link,$req);





			 $nametr = Session::flash('statust', 'تیکت باموفقیت ثبت شد');
		  	$nametrt = Session::flash('sessurl', 'viewstickets');
		  	return redirect('user/viewstickets');
		  	  }
else{ return redirect('user/sign-in'); }
 }





	public function viewsticketsuser(){
		if (Session::has('signuser')){



$h = new UserController();
$h->viewalertnotuser();



 Session::set('nav', 'viewstickets');

$admins = \DB::table('user')
->join('ticket', 'user.id', '=', 'ticket.tik_fromid')
->where([
    ['ticket.tik_fromarou', '=', 4],
    ['ticket.tik_toarou', '=', 2],
    ['ticket.tik_fromid', '=', Session::get('iduser')],
    ['ticket.tik_fromsh', '=', 1],])
    ->orderBy('ticket.tik_date', 'desc')->get();


$tickread = DB::table('user')
->join('ticket', 'user.id', '=', 'ticket.tik_fromid')->where([
    ['ticket.tik_fromarou', '=', 4],
    ['ticket.tik_toarou', '=', 2],
    ['ticket.tik_fromid', '=', Session::get('iduser')],
    ['ticket.tik_fromsh', '=', 1],
    ['ticket.tik_fromread', '=', 0],])
    ->orderBy('ticket.id', 'desc')->count();

	Session::set('tickreaduser', $tickread);


return view('cust.viewstickets', ['admins' => $admins  ]);
}	else{ return redirect('user/sign-in'); }
}






	public function ticketuser($id){
if (Session::has('signuser')){

	Session::put('idimg', $id);
$tickets = \DB::table('user')
->join('ticket', 'user.id', '=', 'ticket.tik_fromid')->where([
    ['ticket.id', '=', $id],
    ['tik_fromarou', '=', 4],
    ['tik_toarou', '=', 2],
    ['tik_fromid', '=', Session::get('iduser')],
    ['tik_fromsh', '=', 1],])  ->orderBy('ticket.id', 'desc')->get();
$messages = \DB::table('message')->where('mes_ticket', '=', $id)  ->orderBy('id')->get();

$updatee = \DB::table('user')
->join('ticket', 'user.id', '=', 'ticket.tik_fromid')->where([
    ['ticket.id', '=', $id],
    ['tik_fromarou', '=', 4],
    ['tik_toarou', '=', 2],
    ['tik_fromid', '=', Session::get('iduser')],
    ['tik_fromsh', '=', 1],])  ->update(['tik_fromread' => 1   ]);

$tickread = DB::table('user')
->join('ticket', 'user.id', '=', 'ticket.tik_fromid')->where([
    ['ticket.tik_fromarou', '=', 4],
    ['ticket.tik_toarou', '=', 2],
    ['ticket.tik_fromid', '=', Session::get('iduser')],
    ['ticket.tik_fromsh', '=', 1],
    ['ticket.tik_fromread', '=', 0],])
    ->orderBy('ticket.id', 'desc')->count();

	Session::set('tickreaduser', $tickread);



$typ='15';
$link=$id;
$req=0;
$h = new UserController();
$h->showupdatealertuser($typ,$link,$req);


return view('cust.ticket', ['tickets' => $tickets  ,  'messages' => $messages  ]); }
else{ return redirect('user/sign-in'); }
				}





	public function ticketuserPost($id  , Request $request ){
if (Session::has('signuser')){

$this->validate($request,[
    			'des' => 'required|min:2|max:666',
    		],[
    			'des.required' => 'لطفا پیام خود را وارد نمایید',
    			'des.min' => 'پیام شما نا معتبر است',
    			'des.max' => 'پیام شما نا معتبر است',

    		]);


    DB::table('message')->insert([
    ['mes_ticket' => $id ,  'mes_des' => $request->des   , 'mes_createdatdate' =>  date('Y-m-d H:i:s') , 'mes_flg' =>  1    ]
]);

 $updatee = \DB::table('user')
->join('ticket', 'user.id', '=', 'ticket.tik_fromid')->where([
    ['ticket.id', '=', $id],
    ['tik_fromarou', '=', 4],
    ['tik_toarou', '=', 2],
    ['tik_fromid', '=', Session::get('iduser')],
    ['tik_fromsh', '=', 1],])  ->update(['tik_toread' => 0  , 'tik_active' => 1 ,     'tik_date' =>  date('Y-m-d H:i:s')   ]);



$link=$id;
$req=0;
$typ='14';
// $h = new UserController();
// $h->alertnotif($typ,$link,$req);



$nametr = Session::flash('statust', 'پیام شما با موفقیت ارسال شد.');
$nametrt = Session::flash('sessurl', 'viewstickets/ticket/'.$id.'');
  return redirect('user/viewstickets/ticket/'.$id.'');
}	else{ return redirect('user/sign-in'); }
}








	public function deletticketuser($id){
if (Session::has('signuser')){

 Session::set('nav', 'viewstickets');
 $updatee = \DB::table('user')
->join('ticket', 'user.id', '=', 'ticket.tik_fromid')->where([
    ['ticket.id', '=', $id],
    ['tik_fromarou', '=', 4],
    ['tik_toarou', '=', 2],
    ['tik_fromid', '=', Session::get('iduser')],
    ['tik_fromsh', '=', 1],])  ->update(['tik_fromsh' => 0   ]);

$nametr = Session::flash('statust', 'تیکت باموفقیت حذف شد');
$nametrt = Session::flash('sessurl', 'viewstickets');
	return redirect('user/viewstickets');

 }	else{ return redirect('user/sign-in'); }
				}





	public function viewselanatsuser(){
		if (Session::has('signuser')){


 Session::set('nav', 'viewselanatsuser');

$admins = \DB::table('user')
->join('ticket', 'user.id', '=', 'ticket.tik_toid')
->where([
    ['ticket.tik_fromarou', '=', 1],
    ['ticket.tik_toarou', '=', 4],
    ['ticket.tik_toid', '=', Session::get('iduser')],
    ['ticket.tik_tosh', '=', 1],])
    ->orderBy('ticket.id', 'desc')->get();


$elanread = DB::table('user')
->join('ticket', 'user.id', '=', 'ticket.tik_toid')->where([
    ['ticket.tik_fromarou', '=', 1],
    ['ticket.tik_toarou', '=', 4],
    ['ticket.tik_toid', '=', Session::get('iduser')],
    ['ticket.tik_tosh', '=', 1],
    ['ticket.tik_toread', '=', 0],])
    ->orderBy('ticket.id', 'desc')->count();

	Session::set('elanreaduser', $elanread);


return view('user.viewselanats', ['admins' => $admins ]);
}	else{ return redirect('user/sign-in'); }
}





	public function elanatuser($id){
if (Session::has('signuser')){
$lngmenus= \DB::table('language') ->where([['id', '<>',  '0'],['lng_active', '=',  '1'],])->orderBy('id', 'desc')->get();
$lngmenu=\DB::table('language') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first();

	Session::put('idimg', $id);
$tickets = \DB::table('user')
->join('ticket', 'user.id', '=', 'ticket.tik_toid')->where([
    ['ticket.id', '=', $id],
    ['tik_fromarou', '=', 1],
    ['tik_toarou', '=', 4],
    ['tik_toid', '=', Session::get('iduser')],
    ['tik_tosh', '=', 1],])  ->orderBy('ticket.id', 'desc')->get();
$messages = \DB::table('message')->where('mes_ticket', '=', $id)  ->orderBy('id')->get();

$updatee = \DB::table('user')
->join('ticket', 'user.id', '=', 'ticket.tik_toid')->where([
    ['ticket.id', '=', $id],
    ['tik_fromarou', '=', 1],
    ['tik_toarou', '=', 4],
    ['tik_toid', '=', Session::get('iduser')],
    ['tik_tosh', '=', 1],])  ->update(['tik_toread' => 1 , 'tik_active' => 2   ]);

$elanread = DB::table('user')
->join('ticket', 'user.id', '=', 'ticket.tik_toid')->where([
    ['ticket.tik_fromarou', '=', 1],
    ['ticket.tik_toarou', '=', 4],
    ['ticket.tik_toid', '=', Session::get('iduser')],
    ['ticket.tik_tosh', '=', 1],
    ['ticket.tik_toread', '=', 0],])
    ->orderBy('ticket.id', 'desc')->count();

	Session::set('elanreaduser', $elanread);

return view('user.elanat', ['tickets' => $tickets , 'messages' => $messages ,'lngmenus' => $lngmenus , 'lngmenu' => $lngmenu ]); }
else{ return redirect('user/sign-in'); }
				}



public function errorid($id){
	if (Session::has('signuser')){
		if (Session::get('activeuser')==1){

$updatee = \DB::table('myrequest') ->where([
    ['myrequest.req_userid', '=',  Session::get('iduser')],
    ['myrequest.req_rnd', '=',  $id],   ])
    ->update(['req_flg' => 0 ]);

$myrequest = \DB::table('myrequest')
 ->where([
    ['myrequest.req_userid', '=',  Session::get('iduser')],
    ['myrequest.req_rnd', '=',  $id],   ])
    ->orderBy('myrequest.req_rnd', 'desc')->first();

			 $nametr = Session::flash('status', 'error');
			 $nametr = Session::flash('statust', 'متاسفانه پرداخت آنلاین باموفقیت انجام نشد!.');
		  	$nametrt = Session::flash('sessurl', 'viewsonlineshops');


    return redirect('user/viewsonlineshops/'.$myrequest->req_rndform.'/'.$myrequest->req_id.'');
     //return redirect('user/viewsonlineshops');


	}
else if (Session::get('activeuser')==0){    return redirect('user/activition'); }
else if (empty(Session::has('signuser'))){   return redirect('user/sign-in'); }
}
	}




public function errormakid($id){
	if (Session::has('signuser')){
		if (Session::get('activeuser')==1){

$updatee = \DB::table('listrezerv') ->where([
    ['listrezerv.list_iduser', '=',  Session::get('iduser')],
    ['listrezerv.list_rnd', '=',  $id],   ])
    ->update(['list_flg' => 0 ]);

$myrequest = \DB::table('listrezerv')
 ->where([
    ['listrezerv.list_iduser', '=',  Session::get('iduser')],
    ['listrezerv.list_rnd', '=',  $id],   ])
    ->orderBy('listrezerv.list_rnd', 'desc')->first();

			 $nametr = Session::flash('status', 'error');
			 $nametr = Session::flash('statust', 'متاسفانه پرداخت آنلاین باموفقیت انجام نشد!.');
		  	$nametrt = Session::flash('sessurl', 'viewsonlineshops');

$nametrt = Session::flash('sessurl', 'error');


    return redirect('user/rezervmak/'.$myrequest->list_id.'/4');


     //return redirect('user/viewsonlineshops');


	}
else if (Session::get('activeuser')==0){    return redirect('user/activition'); }
else if (empty(Session::has('signuser'))){   return redirect('user/sign-in'); }
}
	}



public function successid($id){
	if (Session::has('signuser')){
		if (Session::get('activeuser')==1){

$updatee = \DB::table('myrequest') ->where([
    ['myrequest.req_userid', '=',  Session::get('iduser')],
    ['myrequest.req_rnd', '=',  $id],   ])
    ->update(['req_flg' => 1 ]);

$myrequest = \DB::table('myrequest')
 ->where([
    ['myrequest.req_userid', '=',  Session::get('iduser')],
    ['myrequest.req_rnd', '=',  $id],   ])
    ->orderBy('myrequest.req_rnd', 'desc')->first();

			 $nametr = Session::flash('status', 'success');
			 $nametr = Session::flash('statust', ' پرداخت آنلاین باموفقیت انجام شد.');
		  	$nametrt = Session::flash('sessurl', 'viewsonlineshops');


    return redirect('user/viewsonlineshops/'.$myrequest->req_rndform.'/'.$myrequest->req_id.'');
     //return redirect('user/viewsonlineshops');


	}
else if (Session::get('activeuser')==0){    return redirect('user/activition'); }
else if (empty(Session::has('signuser'))){   return redirect('user/sign-in'); }
}
	}




public function successmakid($id){
	if (Session::has('signuser')){
		if (Session::get('activeuser')==1){



$updatee = \DB::table('listrezerv') ->where([
    ['listrezerv.list_iduser', '=',  Session::get('iduser')],
    ['listrezerv.list_rnd', '=',  $id],   ])
    ->update(['list_flg' => 1 ]);




$myrequest = \DB::table('listrezerv')
 ->where([
    ['listrezerv.list_iduser', '=',  Session::get('iduser')],
    ['listrezerv.list_rnd', '=',  $id],   ])
    ->orderBy('listrezerv.list_rnd', 'desc')->first();







  $countlistrezerv = \DB::table('listrezerv')
->join('calendarrezerv', 'listrezerv.list_idcl', '=', 'calendarrezerv.cal_id')
->where([
    ['calendarrezerv.cal_id', '=', $myrequest->list_idcl],
    ['calendarrezerv.cal_id', '<>', 0],
    ['listrezerv.list_flg', '=', 1], ])
    ->orderBy('listrezerv.list_id', 'desc')->count();


$updatee = \DB::table('calendarrezerv')->where([
    ['cal_id', '=', $myrequest->list_idcl],   ])
    ->update(['cal_pesreg' => $countlistrezerv ]);





$link=$myrequest->list_id;
$req=4;
$typ='13';
$h = new UserController();
$h->alertnotif($typ,$link,$req);



			 $nametr = Session::flash('status', 'success');
			 $nametr = Session::flash('statust', ' پرداخت آنلاین باموفقیت انجام شد.');
		  	$nametrt = Session::flash('sessurl', 'viewsonlineshops');

			 $nametr = Session::flash('sessurl', 'success');


    return redirect('user/rezervmak/'.$myrequest->list_id.'/4');

     //return redirect('user/viewsonlineshops');


	}
else if (Session::get('activeuser')==0){    return redirect('user/activition'); }
else if (empty(Session::has('signuser'))){   return redirect('user/sign-in'); }
}
	}



public function viewsonlineshopsuser(){
	if (Session::has('signuser')){
		if (Session::get('activeuser')==1){

 Session::set('nav', 'viewsonlineshops');

$admins  = \DB::table('myrequest')
->join('user', 'myrequest.req_userid', '=', 'user.id')  ->where([
    ['user.id', '=',  Session::get('iduser')],  ])
    ->orderBy('req_id', 'desc')->get();


return view('cust.viewsonlineshops', ['admins' => $admins]);

			}
else if (Session::get('activeuser')==0){    return redirect('user/activition'); }
else if (empty(Session::has('signuser'))){   return redirect('user/sign-in'); }
}
	}







public function regordid($id){
	if (Session::has('signuser')){
		if (Session::get('activeuser')==1){

 Session::set('nav', 'viewsonlineshops');


$form = \DB::table('form')
->where([
    ['form.form_linkname', '=', $id], ])
    ->orderBy('form.form_id', 'asc')->first();

 $form_rnd = $form->form_rnd;
  return redirect('user/onlineshops/'.$form_rnd.'');

			}
else if (Session::get('activeuser')==0){    return redirect('user/activition'); }
else if (empty(Session::has('signuser'))){   return redirect('user/sign-in'); }
}
	}

public function testcurlid($id , $token , $status){
   //echo $id;

$updatee = \DB::table('myrequest') ->where([
    ['myrequest.req_rnd', '=',  $id],  ])
    ->update(['req_token' => $token ,'req_status' => $status   ]);


 return redirect('https://pec.shaparak.ir/NewIPG/?Token='.$token);
	}

public function makcurlid($id , $token , $status){
   //echo $id;

$updatee = \DB::table('listrezerv') ->where([
    ['listrezerv.list_rnd', '=',  $id],  ])
    ->update(['list_token' => $token ,'list_status' => $status   ]);

 return redirect('https://pec.shaparak.ir/NewIPG/?Token='.$token);

	}

public function testfetchid($id ){

$myrequest = \DB::table('myrequest')
 ->where([
    ['myrequest.req_rnd', '=',  $id],  ])
    ->orderBy('myrequest.req_rnd', 'desc')->first();
    /*
     echo  $myrequest->req_token.'status='.$myrequest->req_status; */
    $token=$myrequest->req_token;
    $status=$myrequest->req_status;

 //return redirect('https://servicepay.azmoonpte.com/sample/verify.php?token='.$token.'&&status='.$status.'&&id='.$id);

	}





public function shaparakid($id){

$myrequest = \DB::table('myrequest')
 ->where([
    ['myrequest.req_rnd', '=',  $id],  ])
    ->orderBy('myrequest.req_rnd', 'desc')->first();
    /*
     echo  $myrequest->req_token.'status='.$myrequest->req_status; */
    $token=$myrequest->req_token;
    $status=$myrequest->req_status;

 return redirect('https://azmoonpte.com/servicepay/sample/verify.php?id='.$token.'&&status='.$status.'&&id='.$id);



	}




public function fetchmak($id){

$myrequest = \DB::table('listrezerv')
 ->where([
    ['listrezerv.list_rnd', '=',  $id],  ])
    ->orderBy('listrezerv.list_rnd', 'desc')->first();

    echo  $myrequest->list_token.'status='.$myrequest->list_status;

	}



public function viewsonlineshopsuserid($id , $req_id){
	if (Session::has('signuser')){
		if (Session::get('activeuser')==1){


 $rnd=rand(1, 99999999);


$updatee = \DB::table('myrequest') ->where([
    ['myrequest.req_userid', '=',  Session::get('iduser')],
    ['myrequest.req_rndform', '=',  $id],
    ['myrequest.req_id', '=',  $req_id],  ])
    ->update(['req_rnd' => $rnd ]);

 Session::set('nav', 'viewsonlineshops');

$myrequest  = \DB::table('myrequest')
->join('user', 'myrequest.req_userid', '=', 'user.id')  ->where([
    ['user.id', '=',  Session::get('iduser')],
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
    ['list.list_userid', '=', Session::get('iduser')],
    ['myrequest.req_id', '=',  $req_id],  ])
    ->orderBy('list.list_chk', 'asc')->get();


$reqs = \DB::table('form')
->join('list', 'form.form_rnd', '=', 'list.list_rnd')
->join('myrequest', 'list.list_myreqid', '=', 'myrequest.req_id')
->where([
    ['form.form_rnd', '=', $id],
    ['list.list_userid', '=', Session::get('iduser')],
    ['myrequest.req_id', '=',  $req_id],  ])
    ->orderBy('list.list_id', 'asc')->first();








//mycharge
$charges = \DB::table('user')
->join('charge', 'user.id', '=', 'charge.charge_iduser')
->join('finicals', 'charge.charge_finical', '=', 'finicals.id')
->where([
    ['charge.charge_arou', '=', 4],
    ['charge.charge_iduser', '=', Session::get('iduser')],
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
    ['charge.charge_iduser', '=', Session::get('iduser')],
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
    ['charge.charge_iduser', '=', Session::get('iduser')],
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
    ['charge.charge_iduser', '=', Session::get('iduser')],
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
    ['charge.charge_iduser', '=', Session::get('iduser')],
    ['finicals.finical_payment', '=', 1],
    ['finicals.finical_inc', '=', 8],])
    ->orderBy('charge.charge_id', 'desc')->get();
$chargepaybisi=0;
foreach($charges as $charge){ $chargepaybisi=$charge->charge_pay+$chargepaybisi; }


//jamkol
$chargepay= ($chargepaysup +  $chargepaymy  + $chargepaybisi ) -  ($chargepaypar + $chargepayodat) ;



$chargeac=$chargepay;



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







return view('cust.onlineshopsid', ['admins' => $admins ,'form' => $form ,'myrequest' => $myrequest ,'lists' => $lists ,'reqs' => $reqs  ,'chargeac' => $chargeac  ,'formselects' => $formselects  ,'formchecks' => $formchecks   ,'reqchecks' => $reqchecks  ]);


			}
else if (Session::get('activeuser')==0){    return redirect('user/activition'); }
else if (empty(Session::has('signuser'))){   return redirect('user/sign-in'); }
}
	}






public function viewsonlineshopsuseridpost($id ,$req_id , Request $request){
	if (Session::has('signuser')){
		if (Session::get('activeuser')==1){




$reqs = \DB::table('form')
->join('list', 'form.form_rnd', '=', 'list.list_rnd')
->join('myrequest', 'list.list_myreqid', '=', 'myrequest.req_id')
->where([
    ['form.form_rnd', '=', $id],
    ['list.list_userid', '=', Session::get('iduser')],
    ['myrequest.req_id', '=',  $req_id],  ])
    ->orderBy('list.list_id', 'asc')->first();

    $costdes='هزینه '.$reqs->req_name;

if($request->jamekol < $reqs->req_price) {
	$nametr = Session::flash('statust',  'متاسفانه مبلغ فاکتور بیشتر از موجودی حساب شما می باشد');
$nametrt = Session::flash('sessurl', 'viewsprodservice');
 return view('user.error');
}  else {

$updatee = \DB::table('myrequest')->where([
    ['myrequest.req_rndform', '=', $id],
    ['myrequest.req_userid', '=', Session::get('iduser')],
    ['myrequest.req_id', '=',  $req_id],  ])
    ->update(['req_flg' => '1' ,   'req_paymentdate' =>  date('Y-m-d H:i:s') ]);



$updatee = \DB::table('finicals')
->where([
    ['finicals.finical_iduser', '=', Session::get('iduser')] ,
    ['finicals.finical_arou', '=', '4'] ,
    ['finicals.finical_marpay', '=', '7'] ,
    ['finicals.finical_marid', '=', $req_id ] ,])
    ->update(['finical_payment' => '1'   ,  'finical_inc' => '3'  , 'finical_paymentdate' => date('Y-m-d H:i:s')  , 'finical_shenasepardakht' => $costdes]);


$chargefinical=\DB::table('finicals') ->where([['finical_inc', '=',  3 ],['finical_marid', '=',  $req_id ],['finical_arou', '=',  4 ],['finical_iduser', '=',  Session::get('iduser')],])->orderBy('id', 'desc')->first();

$chargecount=\DB::table('charge') ->where([['charge_pay', '=',  $chargefinical->finical_pay ],['charge_finical', '=',  $chargefinical->id  ] ,])->orderBy('charge_id', 'desc')->count();


if ($chargecount<1)
		    	{

DB::table('charge')->insert([
    ['charge_pay' => $chargefinical->finical_pay ,     'charge_createdatdate' =>  date('Y-m-d H:i:s') , 'charge_arou' => 4 ,  'charge_iduser' => Session::get('iduser') ,  'charge_finical' => $chargefinical->id  ]
]);
}



$nametr = Session::flash('statust',  'سفارش باموفقیت پرداخت شد');
$nametrt = Session::flash('sessurl', 'viewsonlineshops');
 return view('user.success');

}

			}
else if (Session::get('activeuser')==0){    return redirect('user/activition'); }
else if (empty(Session::has('signuser'))){   return redirect('user/sign-in'); }
}
	}













public function viewsprodserviceid($id){
	if (Session::has('signuser')){
		if (Session::get('activeuser')==1){







//mycharge
$charges = \DB::table('user')
->join('charge', 'user.id', '=', 'charge.charge_iduser')
->join('finicals', 'charge.charge_finical', '=', 'finicals.id')
->where([
    ['charge.charge_arou', '=', 4],
    ['charge.charge_iduser', '=', Session::get('iduser')],
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
    ['charge.charge_iduser', '=', Session::get('iduser')],
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
    ['charge.charge_iduser', '=', Session::get('iduser')],
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
    ['charge.charge_iduser', '=', Session::get('iduser')],
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
    ['charge.charge_iduser', '=', Session::get('iduser')],
    ['finicals.finical_payment', '=', 1],
    ['finicals.finical_inc', '=', 8],])
    ->orderBy('charge.charge_id', 'desc')->get();
$chargepaybisi=0;
foreach($charges as $charge){ $chargepaybisi=$charge->charge_pay+$chargepaybisi; }


//jamkol
$chargepay= ($chargepaysup +  $chargepaymy  + $chargepaybisi ) -  ($chargepaypar + $chargepayodat) ;



$chargeac=$chargepay;





$admin  = \DB::table('currencytransfer')
->join('currency', 'currencytransfer.ctrf_cur', '=', 'currency.id')
->join('productcurtrans', 'currencytransfer.ctrf_id', '=', 'productcurtrans.prcrtr_idcrtrf') ->where([
    ['productcurtrans.prcrtr_iduser', '=',  Session::get('iduser')],
    ['currencytransfer.ctrf_id', '<>', 0],
    ['productcurtrans.prcrtr_id', '=', $id],   ])
    ->orderBy('prcrtr_id', 'desc')->first();


$user = \DB::table('user') ->where('id', '=', Session::get('iduser'))   ->orderBy('id', 'desc')->first();

     if($admin->ctrf_type=='1'){
 Session::set('nav', 'viewsprodbuy');
 return view('user.currencybuyid', ['admin' => $admin , 'chargeac' => $chargeac , 'user' => $user ]); }
else if($admin->ctrf_type=='2'){
 Session::set('nav', 'viewsprodservice');
 return view('user.currencytransferid', ['admin' => $admin , 'chargeac' => $chargeac , 'user' => $user  ]); }



			}
else if (Session::get('activeuser')==0){    return redirect('user/activition'); }
else if (empty(Session::has('signuser'))){   return redirect('user/sign-in'); }
}
	}






public function viewsprodserviceidacc($id , Request $request){
	if (Session::has('signuser')){
		if (Session::get('activeuser')==1){


$admin  = \DB::table('currencytransfer')
->join('currency', 'currencytransfer.ctrf_cur', '=', 'currency.id')
->join('productcurtrans', 'currencytransfer.ctrf_id', '=', 'productcurtrans.prcrtr_idcrtrf') ->where([
    ['productcurtrans.prcrtr_iduser', '=',  Session::get('iduser')],
    ['currencytransfer.ctrf_id', '<>', 0],
    ['productcurtrans.prcrtr_id', '=', $id],   ])
    ->orderBy('prcrtr_id', 'desc')->first();

    $costdes='هزینه '.$admin->ctrf_name;



if($request->jamekol < $admin->prcrtr_pay) {
	$nametr = Session::flash('statust',  'متاسفانه مبلغ فاکتور بیشتر از موجودی حساب شما می باشد');
$nametrt = Session::flash('sessurl', 'viewsprodservice');
 return view('user.error');
}  else {





$updatee = \DB::table('productcurtrans')->where([
    ['productcurtrans.prcrtr_iduser', '=',  Session::get('iduser')],
    ['productcurtrans.prcrtr_id', '=', $id],   ])
    ->update(['prcrtr_payment' => '1' ,   'prcrtr_paymentdate' =>  date('Y-m-d H:i:s') ]);



$updatee = \DB::table('finicals')
->where([
    ['finicals.finical_iduser', '=', Session::get('iduser')] ,
    ['finicals.finical_arou', '=', '4'] ,
    ['finicals.finical_marpay', '=', '5'] ,
    ['finicals.finical_marid', '=', $id ] ,])
    ->update(['finical_payment' => '1'   ,  'finical_inc' => '3'  , 'finical_paymentdate' => date('Y-m-d H:i:s')  , 'finical_shenasepardakht' => $costdes]);


$chargefinical=\DB::table('finicals') ->where([['finical_inc', '=',  3 ],['finical_marid', '=',  $id ],['finical_arou', '=',  4 ],['finical_iduser', '=',  Session::get('iduser')],])->orderBy('id', 'desc')->first();

$chargecount=\DB::table('charge') ->where([['charge_pay', '=',  $chargefinical->finical_pay ],['charge_finical', '=',  $chargefinical->id  ] ,])->orderBy('charge_id', 'desc')->count();


if ($chargecount<1)
		    	{

DB::table('charge')->insert([
    ['charge_pay' => $chargefinical->finical_pay ,     'charge_createdatdate' =>  date('Y-m-d H:i:s') , 'charge_arou' => 4 ,  'charge_iduser' => Session::get('iduser') ,  'charge_finical' => $chargefinical->id  ]
]);
}



$nametr = Session::flash('statust',  'سفارش باموفقیت پرداخت شد');
$nametrt = Session::flash('sessurl', 'viewsprodservice/'.$admin->prcrtr_id);
 return view('user.success');

}

			}
else if (Session::get('activeuser')==0){    return redirect('user/activition'); }
else if (empty(Session::has('signuser'))){   return redirect('user/sign-in'); }
}
	}





public function viewsprodserviceiddel($id){
	if (Session::has('signuser')){
		if (Session::get('activeuser')==1){

 $admins = \DB::table('productcurtrans')->where([
    ['productcurtrans.prcrtr_iduser', '=',  Session::get('iduser')],
    ['productcurtrans.prcrtr_payment', '=', 0],
    ['productcurtrans.prcrtr_id', '=', $id],   ])
    ->delete();

$nametr = Session::flash('statust',  'سفارش باموفقیت حذف شد');
$nametrt = Session::flash('sessurl', 'viewsprodservice');
 return view('user.success');

			}
else if (Session::get('activeuser')==0){    return redirect('user/activition'); }
else if (empty(Session::has('signuser'))){   return redirect('user/sign-in'); }
}
	}



public function zarinpal_pay($req_rnd){
	if (Session::has('signuser')){
		if (Session::get('activeuser')==1){


            $myrequest = \DB::table('myrequest')
            ->where([
                ['myrequest.req_rnd', '=', $req_rnd],
                ['myrequest.req_userid', '=', Session::get('iduser')], ])
                ->orderBy('myrequest.req_id', 'desc')->first();
            
//  start zarinpal

$myuser = DB::table('user')->where([
    ['id',  Session::get('iduser')],
])->first();

$price = $myrequest->req_price;
if($myuser->user_email=='mustafa1390@gmail.com'){$price='5060';}

$data = array("merchant_id" => "f373affa-e1bd-11e8-bcb5-005056a205be",
"amount" => $price,
"callback_url" => "https://azmoonpte.com/servicepay/user/verify_buy.php?req_rnd=".$req_rnd,
"description" => $myuser->user_name,
"metadata" => [ "email" => $myuser->user_email,"mobile"=>$myuser->user_tell],
);
$jsonData = json_encode($data);
$ch = curl_init('https://api.zarinpal.com/pg/v4/payment/request.json');
curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v1');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Content-Type: application/json',
'Content-Length: ' . strlen($jsonData)
));

$result = curl_exec($ch);
$err = curl_error($ch);
$result = json_decode($result, true, JSON_PRETTY_PRINT);
curl_close($ch);



if ($err) {
echo "cURL Error #:" . $err;
} else {
if (empty($result['errors'])) {
    if ($result['data']['code'] == 100) {
        // dd($result['data']["authority"]);
        $url ='https://www.zarinpal.com/pg/StartPay/' . $result['data']["authority"];
        // header('Location: https://www.zarinpal.com/pg/StartPay/' . $result['data']["authority"]);
        // return Redirect::to($url);
        return redirect()->away($url);

    }
} else {
     echo'Error Code: ' . $result['errors']['code'];
     echo'message: ' .  $result['errors']['message'];

}
}


//  end zarinpal



        }
        else if (Session::get('activeuser')==0){    return redirect('user/activition'); }
        else if (empty(Session::has('signuser'))){   return redirect('user/sign-in'); }
        }
            }
        
        

public function verify_buy(){
	if (Session::has('signuser')){
		if (Session::get('activeuser')==1){


            
$req_rnd = $_GET['req_rnd'];



$myrequest = \DB::table('myrequest')
->where([
    ['myrequest.req_rnd', '=', $req_rnd],
    ['myrequest.req_userid', '=', Session::get('iduser')], ])
    ->orderBy('myrequest.req_id', 'desc')->first();

    
$myuser = DB::table('user')->where([
    ['id',  Session::get('iduser')],
])->first();

$price = $myrequest->req_price;

if($myuser->user_email=='mustafa1390@gmail.com'){$price='5060';}

$Authority = $_GET['Authority'];
$data = array("merchant_id" => "f373affa-e1bd-11e8-bcb5-005056a205be", "authority" => $Authority, "amount" => $price);
$jsonData = json_encode($data);
$ch = curl_init('https://api.zarinpal.com/pg/v4/payment/verify.json');
curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v4');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($jsonData)
));

$result = curl_exec($ch);
curl_close($ch);
$result = json_decode($result, true);
 

     if ($result['errors']!=null) { 
        
        // echo'req_rnd: ' . $req_rnd;
        // echo'code: ' . $result['errors']['code'];
        // echo'message: ' .  $result['errors']['message'];
       return  redirect('user/error/'.$req_rnd);

    }



    if($result['data']!=null){

        if ($result['data']['code'] == 100) {
            // echo 'Transation success. RefID:' . $result['data']['ref_id'];
            return  redirect('user/success/'.$req_rnd);
        } 
        
    }
 
            







			}
else if (Session::get('activeuser')==0){    return redirect('user/activition'); }
else if (empty(Session::has('signuser'))){   return redirect('user/sign-in'); }
}
	}


    
public function test_zarinpal(){

    $myuser = DB::table('user')->where([
        ['id',  Session::get('iduser')],
    ])->first();
$data = array("merchant_id" => "f373affa-e1bd-11e8-bcb5-005056a205be",
"amount" => 1000,
"callback_url" => "https://azmoonpte.com/servicepay/user/verify_buy.php?req_rnd=22",
"description" => $myuser->user_name,
"metadata" => [ "email" => $myuser->user_email,"mobile"=>$myuser->user_tell],
);
$jsonData = json_encode($data);
$ch = curl_init('https://api.zarinpal.com/pg/v4/payment/request.json');
curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v1');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Content-Type: application/json',
'Content-Length: ' . strlen($jsonData)
));

$result = curl_exec($ch);
$err = curl_error($ch);
$result = json_decode($result, true, JSON_PRETTY_PRINT);
curl_close($ch);



if ($err) {
echo "cURL Error #:" . $err;
} else {
if (empty($result['errors'])) {
    if ($result['data']['code'] == 100) {
        // header('Location: https://www.zarinpal.com/pg/StartPay/' . $result['data']["authority"]);
        $url ='https://www.zarinpal.com/pg/StartPay/' . $result['data']["authority"];
        // header('Location: https://www.zarinpal.com/pg/StartPay/' . $result['data']["authority"]);
        // return Redirect::to($url);
        return redirect()->away($url);
    }
} else {
     echo'Error Code: ' . $result['errors']['code'];
     echo'message: ' .  $result['errors']['message'];

}
}



}




public function prodserviceidpost ($id , Request $request ){
	if (Session::has('signuser')){
		if (Session::get('activeuser')==1){

    	$this->validate($request,[
    			'des' => 'required',
    		],[
    			'des.required' => 'لطفا توضیحات را وارد نمایید',
    		]);

$currency = \DB::table('currency')->where('id', '=', 1)  ->orderBy('id', 'desc')->first();

$admin = \DB::table('currencytransfer')
->join('currency', 'currencytransfer.ctrf_cur', '=', 'currency.id') ->where([
    ['currencytransfer.ctrf_id', '<>', 0],
    ['currencytransfer.ctrf_type', '=', 2],
    ['currencytransfer.ctrf_id', '=', $id], ])
    ->orderBy('ctrf_id', 'desc')->first();
$payrial=$admin->ctrf_pay*$admin->cur_gh;

DB::table('productcurtrans')->insert([
    [ 'prcrtr_idcrtrf' =>  $id , 'prcrtr_pay' =>  $payrial , 'prcrtr_payfinalirr' =>  $payrial , 'prcrtr_des' =>  $request->des , 'prcrtr_iduser' =>   Session::get('iduser'),   'prcrtr_createdatdate' =>  date('Y-m-d H:i:s') , 'prcrtr_type' => 2      ]
]);


$productcurtrans = \DB::table('productcurtrans')->where('prcrtr_iduser', '=', Session::get('iduser'))  ->orderBy('prcrtr_id', 'desc')->first();

DB::table('finicals')->insert([
    ['finical_marid' => $productcurtrans->prcrtr_id ,  'finical_pay' => $payrial ,    'finical_createdatdate' => date('Y-m-d H:i:s') ,   'finical_inc' =>  '3' ,   'finical_iduser' =>   Session::get('iduser') ,   'finical_arou' =>  '4' ,   'finical_marpay' =>  '5' ,   'finical_payment' =>  0     ]
]);





$nametr = Session::flash('statust', 'سفارش سرویس شما باموفقیت پرداخت شد.');
$nametrt = Session::flash('sessurl', 'viewsprodservice');
		  return view('user.success');

			}
else if (Session::get('activeuser')==0){    return redirect('user/activition'); }
else if (empty(Session::has('signuser'))){   return redirect('user/sign-in'); }
}
	}








	}
