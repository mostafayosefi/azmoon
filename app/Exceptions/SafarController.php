<?php

namespace App\Http\Controllers\safar;

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

class SafarController extends Controller
{ 
 
     
     
	 

	public function asli(Request $request){ 
if (Session::has('idlang')){ } else {
$demolang=\DB::table('superadminselanats') ->where([['id', '=',  1],])->orderBy('id', 'desc')->first();		
Session::set('idlang', $demolang->supelan_demolang); }

$lngmenus= \DB::table('language') ->where([['id', '<>',  '0'],['lng_active', '=',  '1'],])->orderBy('id', 'desc')->get();
$lngmenu=\DB::table('language') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first();

DB::table('statics')->insert([
    ['static_ip' => $request->ip() ,  'static_url' => $request->url() ,    'static_name' => "$lngmenu->lng_whome" ,   'static_createdatdate' =>  date('Y-m-d H:i:s') ]
]);
/*
$token='388213422:AAEYny9Cw9llrpWs13n5ww58QEYDPOQaPlc';
$user_id='166451980';
$mesage= 'ip user: '.$request->ip().'      in_time     '.date('Y-m-d H:i:s').'   backlink:   '.url()->previous() ;
$request_parm = [ 'chat_id' => $user_id,
				  'text' => $mesage ];		  
$request_url = 'https://api.telegram.org/bot'.$token.'/sendmessage?'.http_build_query($request_parm);
file_get_contents($request_url);
*/





$citys = \DB::table('country')
->join('city', 'country.id', '=', 'city.cit_ctr')
->where([['city.cit_active', '=',  '1'],]
)->orderBy('city.cit_name')->get();


$mngindex=  DB::table('mngindex')  ->where('id' , '=' , 1)->orderBy('id')->first(); 
 
$pages= \DB::table('page') ->where([['id', '<>',  '0'],['page_active', '=',  '1'],['page_lng', '<>',  Session::get('idlang')],])->orderBy('id', 'desc')->get();

$slides= \DB::table('slide') ->where([['id', '<>',  '0'],['sli_active', '=',  '1'],])->orderBy('id', 'desc')->get();

$belitsearchts= \DB::table('belitsearch') ->where([['id', '<>',  '0'],['bls_remain', '<>',  '0'],])->orderBy('id', 'desc')->limit(4)->get();
$belitsearchs= \DB::table('belitsearch') ->where([['id', '<>',  '0'],['bls_remain', '<>',  '0'],])->orderBy('id', 'desc')->limit(8)->get();

  $news = \DB::table('news')
->where([['new_active', '=',  '1'],['new_lng', '=',  Session::get('idlang')],]
)->limit(3)->get();

$url='index';
return view('safar/index', [ 'lngmenus' => $lngmenus , 'lngmenu' => $lngmenu , 'mngindex' => $mngindex , 'pages' => $pages, 'citys' => $citys , 'slides' => $slides  , 'news' => $news , 'url' => $url  , 'belitsearchs' => $belitsearchs  , 'belitsearchts' => $belitsearchts  ]);
}	


		
	public function asliid($id){
		
$lngmenu=\DB::table('language') ->where([['id', '=',  $id],['lng_active', '=',  '1'],])->orderBy('id', 'desc')->first();
	Session::set('idlang', $id);
return redirect('/');
}




		public function faq(Request $request){ 	
$lngmenus= \DB::table('language') ->where([['id', '<>',  '0'],['lng_active', '=',  '1'],])->orderBy('id', 'desc')->get();
$lngmenu=\DB::table('language') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first();
 
  $citys = \DB::table('country')
->join('city', 'country.id', '=', 'city.cit_ctr')
->where([['city.cit_active', '=',  '1'],]
)->orderBy('city.cit_name')->get();


$qsts = \DB::table('question') ->where([['qst_lng', '=',  Session::get('idlang')],])->get();

$mngindex=  DB::table('mngindex')  ->where('id' , '=' , 1)->orderBy('id')->first();

$pages= \DB::table('page') ->where([['id', '<>',  '0'],['page_active', '=',  '1'],['page_lng', '<>',  Session::get('idlang')],])->orderBy('id', 'desc')->get();
$url='faq';

DB::table('statics')->insert([
    ['static_ip' => $request->ip() ,  'static_url' => $request->url() ,    'static_name' => "$lngmenu->lng_wqstandrep" ,   'static_createdatdate' =>  date('Y-m-d H:i:s') ]
]);


return view('safar/faq', [  'lngmenus' => $lngmenus , 'lngmenu' => $lngmenu , 'mngindex' => $mngindex , 'citys' => $citys , 'qsts' => $qsts  , 'pages' => $pages  , 'url' => $url  ]);
}	


	



		public function news(Request $request){ 	
$lngmenus= \DB::table('language') ->where([['id', '<>',  '0'],['lng_active', '=',  '1'],])->orderBy('id', 'desc')->get();
$lngmenu=\DB::table('language') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first();
 
 
  $citys = \DB::table('country')
->join('city', 'country.id', '=', 'city.cit_ctr')
->where([['city.cit_active', '=',  '1'],]
)->orderBy('city.cit_name')->get();


  $news = \DB::table('news')
->where([['new_active', '=',  '1'],['new_lng', '=',  Session::get('idlang')],]
)->orderBy('id')->get();

$mngindex=  DB::table('mngindex')  ->where('id' , '=' , 1)->orderBy('id')->first();

$pages= \DB::table('page') ->where([['id', '<>',  '0'],['page_active', '=',  '1'],['page_lng', '<>',  Session::get('idlang')],])->orderBy('id', 'desc')->get();
$url='new';
DB::table('statics')->insert([
    ['static_ip' => $request->ip() ,  'static_url' => $request->url() ,    'static_name' => "$lngmenu->lng_wnews" ,   'static_createdatdate' =>  date('Y-m-d H:i:s') ]
]);



return view('safar/news', [  'lngmenus' => $lngmenus , 'lngmenu' => $lngmenu , 'mngindex' => $mngindex , 'citys' => $citys  , 'news' => $news  , 'pages' => $pages  , 'url' => $url  ]);
}	


	


		public function newid($id , Request $request){ 	
$lngmenus= \DB::table('language') ->where([['id', '<>',  '0'],['lng_active', '=',  '1'],])->orderBy('id', 'desc')->get();
$lngmenu=\DB::table('language') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first();
 
 
  $citys = \DB::table('country')
->join('city', 'country.id', '=', 'city.cit_ctr')
->where([['city.cit_active', '=',  '1'],]
)->orderBy('city.cit_name')->get();



  $news = \DB::table('news')
->where([['new_active', '=',  '1'],['new_lng', '=',  Session::get('idlang')],]
)->orderBy('id')->get();


  $newids = \DB::table('news')
->where([['id', '=',  $id],['new_active', '=',  '1'],['new_lng', '=',  Session::get('idlang')],]
)->orderBy('id')->get();

$mngindex=  DB::table('mngindex')  ->where('id' , '=' , 1)->orderBy('id')->first();

$pages= \DB::table('page') ->where([['id', '<>',  '0'],['page_active', '=',  '1'],['page_lng', '<>',  Session::get('idlang')],])->orderBy('id', 'desc')->get();
$url='new';
DB::table('statics')->insert([
    ['static_ip' => $request->ip() ,  'static_url' => $request->url() ,    'static_name' => "$lngmenu->lng_wnews" ,   'static_createdatdate' =>  date('Y-m-d H:i:s') ]
]);



return view('safar/new', [ 'lngmenus' => $lngmenus , 'lngmenu' => $lngmenu , 'mngindex' => $mngindex , 'citys' => $citys  , 'news' => $news , 'newids' => $newids  , 'pages' => $pages  , 'url' => $url   ]);
}	



		public function pageid($id , Request $request){ 	
$lngmenus= \DB::table('language') ->where([['id', '<>',  '0'],['lng_active', '=',  '1'],])->orderBy('id', 'desc')->get();
$lngmenu=\DB::table('language') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first();
 
 
  $citys = \DB::table('country')
->join('city', 'country.id', '=', 'city.cit_ctr')
->where([['city.cit_active', '=',  '1'],]
)->orderBy('city.cit_name')->get();



  $news = \DB::table('news')
->where([['new_active', '=',  '1'],['new_lng', '=',  Session::get('idlang')],]
)->orderBy('id')->get();


  $pageids = \DB::table('page')
->where([['id', '=',  $id],['page_active', '=',  '1'],['page_lng', '<>',  Session::get('idlang')],]
)->orderBy('id')->get();

$mngindex=  DB::table('mngindex')  ->where('id' , '=' , 1)->orderBy('id')->first();

$pages= \DB::table('page') ->where([['id', '<>',  '0'],['page_active', '=',  '1'],['page_lng', '<>',  Session::get('idlang')],])->orderBy('id', 'desc')->get();
$url='new';
DB::table('statics')->insert([
    ['static_ip' => $request->ip() ,  'static_url' => $request->url() ,    'static_name' => "$lngmenu->lng_wpages" ,   'static_createdatdate' =>  date('Y-m-d H:i:s') ]
]);


return view('safar/page', [ 'lngmenus' => $lngmenus , 'lngmenu' => $lngmenu , 'mngindex' => $mngindex , 'citys' => $citys  , 'news' => $news , 'pageids' => $pageids  , 'pages' => $pages  , 'url' => $url   ]);
}	


		public function resultt(Request $request){ 	
$lngmenus= \DB::table('language') ->where([['id', '<>',  '0'],['lng_active', '=',  '1'],])->orderBy('id', 'desc')->get();
$lngmenu=\DB::table('language') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first();
$citys = \DB::table('country')
->join('city', 'country.id', '=', 'city.cit_ctr')
->where([['city.cit_active', '=',  '1'],]
)->orderBy('city.cit_name')->get();
$qsts = \DB::table('question') ->where([['qst_lng', '=',  Session::get('idlang')],])->get();
$mngindex=  DB::table('mngindex')  ->where('id' , '=' , 1)->orderBy('id')->first();
$pages= \DB::table('page') ->where([['id', '<>',  '0'],['page_active', '=',  '1'],['page_lng', '<>',  Session::get('idlang')],])->orderBy('id', 'desc')->get();
$url='result';

$admins = \DB::table('belitsearch')->where([['id', '<>',  '0'],['bls_active', '=',  '0'],['bls_origin', '=',  Session::get('origin')],['bls_desti', '=',  Session::get('desti')] ,['bls_datefly', '=',  Session::get('datefly')] ,])->orderBy('id', 'desc')->get();

DB::table('statics')->insert([
    ['static_ip' => $request->ip() ,  'static_url' => $request->url() ,    'static_name' => "$lngmenu->lng_wrezervbelit" ,   'static_createdatdate' =>  date('Y-m-d H:i:s') ]
]);

return view('safar/result', [  'lngmenus' => $lngmenus , 'lngmenu' => $lngmenu , 'mngindex' => $mngindex , 'citys' => $citys , 'qsts' => $qsts  , 'pages' => $pages  , 'url' => $url  , 'admins' => $admins    ]);
}	


		public function resulttpost(Request $request){ 	
$lngmenus= \DB::table('language') ->where([['id', '<>',  '0'],['lng_active', '=',  '1'],])->orderBy('id', 'desc')->get();
$lngmenu=\DB::table('language') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first();
$citys = \DB::table('country')
->join('city', 'country.id', '=', 'city.cit_ctr')
->where([['city.cit_active', '=',  '1'],]
)->orderBy('city.cit_name')->get();
$qsts = \DB::table('question') ->where([['qst_lng', '=',  Session::get('idlang')],])->get();
$mngindex=  DB::table('mngindex')  ->where('id' , '=' , 1)->orderBy('id')->first();
$pages= \DB::table('page') ->where([['id', '<>',  '0'],['page_active', '=',  '1'],['page_lng', '<>',  Session::get('idlang')],])->orderBy('id', 'desc')->get();
$url='result';

 if($request->origin == $request->desti ){
$nrepeatl = Session::flash('repeat', '2');
return redirect('result'); } 


    			 $this->validate($request,[
    			'origin' => 'required',
    			'desti' => 'required',
    			'datefly' => 'required',
    		],[
    			'origin.required' => $lngmenu->lng_worigin.' ! '.$lngmenu->lng_wnotelq,
    			'desti.required' => $lngmenu->lng_wdesti.' ! '.$lngmenu->lng_wnotelq,
    			'datefly.required' => $lngmenu->lng_wdatefly.' ! '.$lngmenu->lng_wnotelq,
    		 ]);  
 


$nrepeatl = Session::flash('origin', $request->origin);
$nrepeatl = Session::flash('desti', $request->desti);

$date=date('m/d/Y', strtotime($request->datefly));
$nrepeatl = Session::flash('datefly', $date);  

$admins = \DB::table('belitsearch')->where([['id', '<>',  '0'],['bls_active', '=',  '0'],['bls_origin', '=',  Session::get('origin')],['bls_desti', '=',  Session::get('desti')],])->orderBy('id', 'desc')->get();

$nrepeatl = Session::flash('repeat', '3');
return redirect('result');

 
 

return view('safar/result', [  'lngmenus' => $lngmenus , 'lngmenu' => $lngmenu , 'mngindex' => $mngindex , 'citys' => $citys , 'qsts' => $qsts  , 'pages' => $pages  , 'url' => $url    , 'admins' => $admins    ]);
}	



		public function tickettraking(Request $request){ 	
$lngmenus= \DB::table('language') ->where([['id', '<>',  '0'],['lng_active', '=',  '1'],])->orderBy('id', 'desc')->get();
$lngmenu=\DB::table('language') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first();
 
$qsts = \DB::table('question') ->where([['qst_lng', '=',  Session::get('idlang')],])->get();
$mngindex=  DB::table('mngindex')  ->where('id' , '=' , 1)->orderBy('id')->first();
$pages= \DB::table('page') ->where([['id', '<>',  '0'],['page_active', '=',  '1'],['page_lng', '<>',  Session::get('idlang')],])->orderBy('id', 'desc')->get();
$url='result';

$admins = \DB::table('belitsearch')
->join('belitrezerv', 'belitsearch.bls_codbelit', '=', 'belitrezerv.blr_codbelit')->where([['belitrezerv.id', '<>',  '0'],['belitsearch.bls_codfly', '=',  Session::get('codfly')],['belitrezerv.blr_codrezerv', '=',  Session::get('codrezerv')]  ,])->orderBy('belitrezerv.id', 'desc')->limit(1)->get();


DB::table('statics')->insert([
    ['static_ip' => $request->ip() ,  'static_url' => $request->url() ,    'static_name' => "$lngmenu->lng_wbelittraking" ,   'static_createdatdate' =>  date('Y-m-d H:i:s') ]
]);

return view('safar/ticket', [  'lngmenus' => $lngmenus , 'lngmenu' => $lngmenu , 'mngindex' => $mngindex , 'qsts' => $qsts  , 'pages' => $pages  , 'url' => $url  , 'admins' => $admins    ]);
}	




		public function tickettrakingpost(Request $request){ 	
$lngmenus= \DB::table('language') ->where([['id', '<>',  '0'],['lng_active', '=',  '1'],])->orderBy('id', 'desc')->get();
$lngmenu=\DB::table('language') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first();

 
$mngindex=  DB::table('mngindex')  ->where('id' , '=' , 1)->orderBy('id')->first();
$pages= \DB::table('page') ->where([['id', '<>',  '0'],['page_active', '=',  '1'],['page_lng', '<>',  Session::get('idlang')],])->orderBy('id', 'desc')->get();
$url='result';



    			 $this->validate($request,[
    			'codfly' => 'required',
    			'codrezerv' => 'required',
    		],[
    			'codfly.required' => $lngmenu->lng_wcodfly.' ! '.$lngmenu->lng_wnotelq,
    			'codrezerv.required' => $lngmenu->lng_wcodrezerv.' ! '.$lngmenu->lng_wnotelq,
    		 ]);  
 


$nrepeatl = Session::flash('codfly', $request->codfly);
$nrepeatl = Session::flash('codrezerv', $request->codrezerv);


$admins = \DB::table('belitsearch')
->join('belitrezerv', 'belitsearch.bls_codbelit', '=', 'belitrezerv.blr_codbelit')->where([['belitrezerv.id', '<>',  '0'],['belitsearch.bls_codfly', '=',  Session::get('codfly')],['belitrezerv.blr_codrezerv', '=',  Session::get('codrezerv')]  ,])->orderBy('belitrezerv.id', 'desc')->limit(1)->get();
 

return view('safar/ticket', [  'lngmenus' => $lngmenus , 'lngmenu' => $lngmenu , 'mngindex' => $mngindex  , 'pages' => $pages  , 'url' => $url    , 'admins' => $admins    ]);
}	







public function indexpost(Request $request){ 	
 return redirect('result');	
}	








		public function creatphp(Request $request){ 
$lngmenus= \DB::table('language') ->where([['id', '<>',  '0'],['lng_active', '=',  '1'],])->orderBy('id', 'desc')->get();
$lngmenu=\DB::table('language') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first();	
 

DB::table('statics')->insert([
    ['static_ip' => $request->ip() ,  'static_url' => $request->url() ,    'static_name' => "creating" ,   'static_createdatdate' =>  date('Y-m-d H:i:s') ]
]);

 

return view('safar/create', [  'lngmenus' => $lngmenus , 'lngmenu' => $lngmenu     ]);





}	






public function redirectindex(){ 	
return redirect('/'); 	
}




		public function indexxgdss(Request $request){ 
		
 	 return redirect('/');	
		
		}
		
		
			
		public function indexgds(Request $request){ 	
		
// $adminsc = \DB::table('comwbs')->where('comwbs_id', '<>', '0')->delete(); 
 //$adminsc = \DB::table('comwbsj')->where('comwbsj_id', '<>', '0')->delete(); 
 //$adminsc = \DB::table('comwbsk')->where('comwbsk_id', '<>', '0')->delete(); 

 
 $str = substr($request->url(), 0 , 18);
  
 if($str!='https://gds724.com'){
 	 return redirect('https://gds724.com/');	
 	}
 
 

 
if (Session::has('idlang')){  
	if (Session::get('idlang')==3) {  Session::set('curnem', 'RIAL');  } else if (Session::get('idlang')==7) {  Session::set('curnem', 'TL');  } else {  Session::set('curnem', 'USD');  } } else {
$demolang=\DB::table('superadminselanats') ->where([['id', '=',  1],])->orderBy('id', 'desc')->first();		
Session::set('idlang', $demolang->supelan_demolang); 
 Session::set('curnem', 'USD');  }

if (Session::has('signsuperadmin')){ Session::set('urlaro', 'superadmin'); } else { Session::set('urlaro', 'indexgds');  }
 
		
$lngmenus= \DB::table('language') ->where([['id', '<>',  '0'],['lng_active', '=',  '1'],])->orderBy('id', 'desc')->get();
$lngmenu=\DB::table('language') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first();
$slngmenu=\DB::table('languages') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first();	
 
$airports= \DB::table('airports') ->where([['code', '<>',  '0'],])->orderBy('obs' , 'desc')->get(); 
$mngindex =  DB::table('mngindex')  ->where('id' , '=' , 1)->orderBy('id')->first(); 
 

$mngindexgdss = \DB::table('mngindexgds') ->where('id', '<>', '0')->orderBy('id')->get();

 

  $pages = \DB::table('page')
->where([['id', '<>',  '0'],['page_active', '=',  '1'],['page_lng', '<>',  Session::get('idlang')],]
)->orderBy('id')->get();

if ($request->ip() != '63.143.42.253'){

DB::table('statics')->insert([
    ['static_ip' => $request->ip() , 'static_previous' => url()->previous() , 'static_url' => $request->url() ,    'static_name' => "$lngmenu->lng_whome" ,   'static_createdatdate' =>  date('Y-m-d H:i:s') ]
]);
	
}


 

/*
$user = \DB::table('user')->where('id', '=', 1)  ->orderBy('id', 'desc')->first();
 	 $usernamee = 'username'; 
 $titmes= 'Your ticket has been successfully purchased';
 $mestt= $lngmenu->lng_wnewpas;
 $mesnot = 'msnot'; 
 $email='mustafa1390@gmail.com';
   Mail::send('superadmin.mail', ['user' => $user , 'usernamee' => $usernamee, 'mesnot' => $mesnot, 'titmes' => $titmes , 'mestt' => $mestt], function ($m) use ($user) {       
$decryptedPassword = 'yyyyyyyy';
            $m->from('info@gds724.com',  'GDS724'  );
            $m->to($user->user_email, $user->user_email)->subject('New Password');
        }); 
*/

 


return view('indexgds/index', [  'lngmenus' => $lngmenus , 'lngmenu' => $lngmenu , 'slngmenu' => $slngmenu , 'airports' => $airports  , 'mngindex' => $mngindex    , 'mngindexgdss' => $mngindexgdss  ,   'pages' => $pages    ]);
}	




		public function pagecont( $id , Request $request){ 	

 /*
 $adminsc = \DB::table('comwbs')->where([['comwbs.comwbs_seq', '<>',  '999'],]
)->delete(); 
 $adminsc = \DB::table('comwbsj')->where([['comwbsj.comwbsj_seq', '<>',  '999'],]
)->delete(); 
 $adminsc = \DB::table('comwbsk')->where([['comwbsk.comwbsk_seq', '<>',  '999'],]
)->delete(); 
 $adminsc = \DB::table('wbs')->where([['wbs.id', '<>',  '999'],]
)->delete(); 
 $adminsc = \DB::table('comid')->where([['comid.show', '<>',  '999'],]
)->delete(); 
 */

	
		
if (Session::has('idlang')){ } else {
$demolang=\DB::table('superadminselanats') ->where([['id', '=',  1],])->orderBy('id', 'desc')->first();		
Session::set('idlang', $demolang->supelan_demolang);  }

if (Session::has('signsuperadmin')){ Session::set('urlaro', 'superadmin'); } else { Session::set('urlaro', 'indexgds');  }
		
$lngmenus= \DB::table('language') ->where([['id', '<>',  '0'],['lng_active', '=',  '1'],])->orderBy('id', 'desc')->get();
$lngmenu=\DB::table('language') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first();
$slngmenu=\DB::table('languages') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first();	
 
$airports= \DB::table('airports') ->where([['code', '<>',  '0'],])->orderBy('numAirports')->get(); 
$mngindex =  DB::table('mngindex')  ->where('id' , '=' , 1)->orderBy('id')->first(); 
 

$mngindexgdss = \DB::table('mngindexgds') ->where('id', '<>', '0')->orderBy('id')->get();

 


  $pageids = \DB::table('page')
->where([['id', '=',  $id],['page_active', '<>',  '0'],['page_lng', '<>',  Session::get('idlang')],]
)->orderBy('id')->get();


  $pages = \DB::table('page')
->where([['id', '<>',  '0'],['page_active', '=',  '1'],['page_lng', '<>',  Session::get('idlang')],]
)->orderBy('id')->get();


DB::table('statics')->insert([
    ['static_ip' => $request->ip() ,  'static_url' => $request->url() ,    'static_name' => "$lngmenu->lng_whome" ,   'static_createdatdate' =>  date('Y-m-d H:i:s') ]
]);


return view('indexgds/cont', [  'lngmenus' => $lngmenus , 'lngmenu' => $lngmenu , 'slngmenu' => $slngmenu , 'airports' => $airports  , 'mngindex' => $mngindex    , 'mngindexgdss' => $mngindexgdss    , 'pageids' => $pageids  , 'pages' => $pages    ]);
}	


 


		public function notfound(   Request $request){ 			
$lngmenus= \DB::table('language') ->where([['id', '<>',  '0'],['lng_active', '=',  '1'],])->orderBy('id', 'desc')->get();
$lngmenu=\DB::table('language') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first();
$slngmenu=\DB::table('languages') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first();	
 $mngindex =  DB::table('mngindex')  ->where('id' , '=' , 1)->orderBy('id')->first(); 

$mngindexgdss = \DB::table('mngindexgds') ->where('id', '<>', '0')->orderBy('id')->get();

  $pages = \DB::table('page')
->where([['id', '<>',  '0'],['page_active', '=',  '1'],['page_lng', '<>',  Session::get('idlang')],]
)->orderBy('id')->get();


DB::table('statics')->insert([
    ['static_ip' => $request->ip() ,  'static_url' => $request->url() ,    'static_name' => "$lngmenu->lng_whome" ,   'static_createdatdate' =>  date('Y-m-d H:i:s') ]
]);
  

return view('indexgds/notfound', [  'lngmenus' => $lngmenus , 'lngmenu' => $lngmenu , 'slngmenu' => $slngmenu , 'mngindex' => $mngindex    , 'mngindexgdss' => $mngindexgdss    , 'pages' => $pages      ]);
}	



		public function regtrackingpnr(   Request $request){ 			
$lngmenus= \DB::table('language') ->where([['id', '<>',  '0'],['lng_active', '=',  '1'],])->orderBy('id', 'desc')->get();
$lngmenu=\DB::table('language') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first();
$slngmenu=\DB::table('languages') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first();	
 $mngindex =  DB::table('mngindex')  ->where('id' , '=' , 1)->orderBy('id')->first(); 

$mngindexgdss = \DB::table('mngindexgds') ->where('id', '<>', '0')->orderBy('id')->get();

  $pages = \DB::table('page')
->where([['id', '<>',  '0'],['page_active', '=',  '1'],['page_lng', '<>',  Session::get('idlang')],]
)->orderBy('id')->get();


DB::table('statics')->insert([
    ['static_ip' => $request->ip() ,  'static_url' => $request->url() ,    'static_name' => "$lngmenu->lng_whome" ,   'static_createdatdate' =>  date('Y-m-d H:i:s') ]
]);
  

return view('indexgds/regtrackingpnr', [  'lngmenus' => $lngmenus , 'lngmenu' => $lngmenu , 'slngmenu' => $slngmenu , 'mngindex' => $mngindex    , 'mngindexgdss' => $mngindexgdss    , 'pages' => $pages      ]);
}	





		public function sortindex(   Request $request){ 			
$lngmenus= \DB::table('language') ->where([['id', '<>',  '0'],['lng_active', '=',  '1'],])->orderBy('id', 'desc')->get();
$lngmenu=\DB::table('language') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first();
$slngmenu=\DB::table('languages') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first();	
$mngindex =  DB::table('mngindex')  ->where('id' , '=' , 1)->orderBy('id')->first(); 

return view('indexgds/sortindex', [  'lngmenus' => $lngmenus , 'lngmenu' => $lngmenu , 'slngmenu' => $slngmenu , 'mngindex' => $mngindex     ]);
}	


		public function sortv(   Request $request){ 			
$lngmenus= \DB::table('language') ->where([['id', '<>',  '0'],['lng_active', '=',  '1'],])->orderBy('id', 'desc')->get();
$lngmenu=\DB::table('language') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first();
$slngmenu=\DB::table('languages') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first();	
$mngindex =  DB::table('mngindex')  ->where('id' , '=' , 1)->orderBy('id')->first(); 

return view('superadmin/sortv', [  'lngmenus' => $lngmenus , 'lngmenu' => $lngmenu , 'slngmenu' => $slngmenu , 'mngindex' => $mngindex     ]);
}	

 



		public function redirectsortvt(   Request $request){
			
			return redirect('sortvt'); 
			 
		
		}


		public function sortvt(   Request $request){ 			

$lngmenus= \DB::table('language') ->where([['id', '<>',  '0'],['lng_active', '=',  '1'],])->orderBy('id', 'desc')->get();
$lngmenu=\DB::table('language') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first();
 
$wbs=\DB::table('wbs') ->where([['wbs_uuses', '=', Session::get('wbs_uuses')] , ])->orderBy('id', 'desc')->first(); 
$wbsid=$wbs->id;
$wbssort=$wbs->wbs_sort; 
$wbsway=$wbs->wbs_way; 	
	    
 
 $departuredate=$wbs->wbs_departuredate;
 $departuredater=$wbs->wbs_departuredater; 

if($wbssort=='0'){
$datenew = explode(" ", $departuredate);   $monthh=$datenew['1']; $dayn=$datenew['2'];  $yearn=$datenew['3'];   
if($monthh=='Jan'){ $monthn='01';} else if($monthh=='Feb'){ $monthn='02';}  else if($monthh=='Mar'){ $monthn='03';}   else if($monthh=='Apr'){ $monthn='04';} else if($monthh=='May'){ $monthn='05';}  else if($monthh=='Jun'){ $monthn='06';}   else if($monthh=='Jul'){ $monthn='07';} else if($monthh=='Aug'){ $monthn='08';}  else if($monthh=='Sep'){ $monthn='09';}   else if($monthh=='Oct'){ $monthn='10';} else if($monthh=='Nov'){ $monthn='11';}  else if($monthh=='Dec'){ $monthn='12';} 
$year = $dayn.'.'.$monthn.'.'.$yearn.''; 

$updatee = \DB::table('wbs')->where([['id', '=',  $wbsid],])->update(['wbs_sort' => '1'   ]); 
 
}
else if($wbssort!='0'){ $year=$wbs->wbs_departuredate; }


if($wbsway=='1'){
$datenewr = explode(" ", $departuredater);   $monthr=$datenewr['1']; $dayr=$datenewr['2'];  $yearrn=$datenewr['3'];   
if($monthr=='Jan'){ $montrn='01';} else if($monthr=='Feb'){ $montrn='02';}  else if($monthr=='Mar'){ $montrn='03';}   else if($monthr=='Apr'){ $montrn='04';} else if($monthr=='May'){ $montrn='05';}  else if($monthr=='Jun'){ $montrn='06';}   else if($monthr=='Jul'){ $montrn='07';} else if($monthr=='Aug'){ $montrn='08';}  else if($monthr=='Sep'){ $montrn='09';}   else if($monthr=='Oct'){ $montrn='10';} else if($monthr=='Nov'){ $montrn='11';}  else if($monthr=='Dec'){ $montrn='12';} 
$yearr = $dayr.'.'.$montrn.'.'.$yearrn.''; 
}



 
 $arrival=$wbs->wbs_arrival; $departure=$wbs->wbs_departure;    $departuredater=$wbs->wbs_departuredater;  $adult=$wbs->wbs_adult;  $child=$wbs->wbs_child; $infant=$wbs->wbs_infant; $result=$wbs->result;  
$airports= \DB::table('airports') ->where([['code', '<>',  '0'],])->orderBy('obs')->get(); 
$currency=\DB::table('currency') ->where([['cur_nem', '=',  Session::get('curnem')],])->orderBy('id', 'desc')->first();   



$sortvs=\DB::table('sortv') ->where([['sortv_wbsid', '=', $wbsid]   , ['sortv_airlineflg', '=', '1']   , ])->orderBy('id')->get(); 

$sortcls=\DB::table('sortv') ->where([['sortv_wbsid', '=', $wbsid]   , ['sortv_clasflg', '=', '1']   , ])->orderBy('id')->get(); 
 

$sortindirs=\DB::table('sortv') ->where([['sortv_wbsid', '=', $wbsid]   , ['sortv_indirectflg', '=', '1']   , ])->orderBy('id')->get(); 
 
$sortprics=\DB::table('sortv') ->where([['sortv_wbsid', '=', $wbsid]   , ['sortv_priceflg', '=', '1']   , ])->orderBy('id')->get(); 


if(Session::get('sortsins')){ $sortsins=Session::get('sortsins'); } else { $sortsins='sort_price'; }

 //$sortsins='id';

$sorts=\DB::table('sort') ->where([['sort_wbsid', '=',  $wbsid],['sort_show', '=','1'],])->orderBy($sortsins)->get();  
  $sortcounts=\DB::table('sort') ->where([['sort_wbsid', '=',  $wbsid],['sort_show', '=',  '1'],])->orderBy('id')->count(); 

$mngindex =  DB::table('mngindex')  ->where('id' , '=' , 1)->orderBy('id')->first(); 
 

		 
 
if($wbs->wbs_way=='0'){	   
 return view('superadmin.sortm', ['result' => $result , 'lngmenus' => $lngmenus , 'lngmenu' => $lngmenu , 'arrival' => $arrival , 'departure' => $departure, 'year' => $year , 'departuredate' => $departuredate, 'adult' => $adult , 'child' => $child , 'infant' => $infant , 'airports' => $airports, 'wbs' => $wbs  , 'currency' => $currency  , 'sorts' => $sorts  , 'sortcounts' => $sortcounts  , 'sortvs' => $sortvs  , 'sortcls' => $sortcls  , 'sortindirs' => $sortindirs , 'sortprics' => $sortprics  , 'mngindex' => $mngindex    ]); 
}


if($wbs->wbs_way=='1'){	 

$updatee = \DB::table('comid')->where([['wbssearch', '=',$wbsid],])->update(['show' => '0' ,  'sort' => '0'    ]); 

$soco=0;
foreach($sorts as $sort){
$soco++;	
$updatee = \DB::table('comid')->where([['wbssearch', '=',$wbsid],['seq', '=', $sort->sort_seq],])->update(['show' => '1' ,  'sort' => $soco    ]); 	
}  
 $comids=  \DB::table('comid') ->where([['wbssearch', '=',  $wbsid],['show', '=',  '1'],])->orderBy('sort')->get(); 



 return view('superadmin.sortreturn', ['result' => $result , 'lngmenus' => $lngmenus , 'lngmenu' => $lngmenu , 'arrival' => $arrival , 'departure' => $departure  , 'departuredate' => $departuredate,'departuredater' => $departuredater , 'year' => $year ,'yearr' => $yearr, 'adult' => $adult , 'child' => $child , 'infant' => $infant , 'airports' => $airports, 'wbs' => $wbs  , 'currency' => $currency  , 'sorts' => $sorts  , 'sortcounts' => $sortcounts  , 'sortvs' => $sortvs  , 'sortcls' => $sortcls  , 'sortindirs' => $sortindirs , 'sortprics' => $sortprics , 'comids' => $comids   , 'mngindex' => $mngindex    ]); 

  }




}




 



		public function bysort(   Request $request){ 			
$lngmenus= \DB::table('language') ->where([['id', '<>',  '0'],['lng_active', '=',  '1'],])->orderBy('id', 'desc')->get();
$lngmenu=\DB::table('language') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first();
$slngmenu=\DB::table('languages') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first();	
 $mngindex =  DB::table('mngindex')  ->where('id' , '=' , 1)->orderBy('id')->first(); 

$mngindexgdss = \DB::table('mngindexgds') ->where('id', '<>', '0')->orderBy('id')->get();

  $pages = \DB::table('page')
->where([['id', '<>',  '0'],['page_active', '=',  '1'],['page_lng', '<>',  Session::get('idlang')],]
)->orderBy('id')->get();


DB::table('statics')->insert([
    ['static_ip' => $request->ip() ,  'static_url' => $request->url() ,    'static_name' => "$lngmenu->lng_whome" ,   'static_createdatdate' =>  date('Y-m-d H:i:s') ]
]);
  

return view('indexgds/bysort', [  'lngmenus' => $lngmenus , 'lngmenu' => $lngmenu , 'slngmenu' => $slngmenu , 'mngindex' => $mngindex    , 'mngindexgdss' => $mngindexgdss    , 'pages' => $pages      ]);
}	







public function searchpnrpost(Request $request){ 	


$lngmenus= \DB::table('language') ->where([['id', '<>',  '0'],['lng_active', '=',  '1'],])->orderBy('id', 'desc')->get();
$lngmenu=\DB::table('language') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first();
$slngmenu=\DB::table('languages') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first();	


 
    		$email = $request->emailp;
    		$pnr = $request->pnr;
    		 

 $belits=  \DB::table('belits')->where([['bel_email', '=',  $email ],['bel_pnr', '=',  $pnr],])->orderBy('bel_id', 'desc')->first();  
 $counts=  \DB::table('belits')->where([['bel_email', '=',  $email ],['bel_pnr', '=',  $pnr],])->orderBy('bel_id', 'desc')->count();   
 

 
 
 if($counts =='0'){
 return redirect('notfound'); 
  }  		 

  
 $mergey=$belits->bel_mergey;
 	 
$mngindex =  DB::table('mngindex')  ->where('id' , '=' , 1)->orderBy('id')->first(); 
$mngindexgdss = \DB::table('mngindexgds') ->where('id', '<>', '0')->orderBy('id')->get();
 
  $pages = \DB::table('page')
->where([['id', '<>',  '0'],['page_active', '=',  '1'],['page_lng', '<>',  Session::get('idlang')],]
)->orderBy('id')->get();

 

DB::table('statics')->insert([
    ['static_ip' => $request->ip() ,  'static_url' => $request->url() ,    'static_name' => "$lngmenu->lng_whome" ,   'static_createdatdate' =>  date('Y-m-d H:i:s') ]
]);






 $wents=  \DB::table('belits')
->join('direction', 'belits.bel_id', '=', 'direction.dir_idbelit') ->where([['bel_mergey', '=',  $mergey],['dir_dir', '=',  '0'],['bel_email', '=',  $email ],['bel_pnr', '=',  $pnr],])->orderBy('id')->get(); 



 $backc=  \DB::table('belits')
->join('direction', 'belits.bel_id', '=', 'direction.dir_idbelit') ->where([['bel_mergey', '=',  $mergey],['dir_dir', '=',  '1'],['bel_email', '=',  $email ],['bel_pnr', '=',  $pnr],])->orderBy('id')->count(); 

 $backs=  \DB::table('belits')
->join('direction', 'belits.bel_id', '=', 'direction.dir_idbelit') ->where([['bel_mergey', '=',  $mergey],['dir_dir', '=',  '1'],['bel_email', '=',  $email ],['bel_pnr', '=',  $pnr],])->orderBy('id')->get(); 


 $passangers=  \DB::table('belits')
->join('passanger', 'belits.bel_id', '=', 'passanger.pas_idbelit') ->where([['bel_mergey', '=',  $mergey],['bel_email', '=',  $email ],['bel_pnr', '=',  $pnr],])->orderBy('bel_id')->get(); 
 
 
$belits=\DB::table('belits') ->where([['bel_mergey', '=',  $mergey],['bel_email', '=',  $email ],['bel_pnr', '=',  $pnr],])->orderBy('bel_id', 'desc')->first(); 

 


return view('indexgds/pnr', [  'lngmenus' => $lngmenus , 'lngmenu' => $lngmenu , 'slngmenu' => $slngmenu   , 'mngindex' => $mngindex    , 'mngindexgdss' => $mngindexgdss    ,  'pages' => $pages  ,  'email' => $email    , 'wents' => $wents  , 'passangers' => $passangers , 'belits' => $belits  , 'backs' => $backs  , 'backc' => $backc      ]);


 
 }








 



public function indexgdspost(Request $request){ 	


$lngmenus= \DB::table('language') ->where([['id', '<>',  '0'],['lng_active', '=',  '1'],])->orderBy('id', 'desc')->get();
$lngmenu=\DB::table('language') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first();
 

 			 $this->validate($request,[
    			'departure' => 'required',
    			'arrival' => 'required',
    			'datepicker' => 'required',
    			'adult' => 'required',
    		],[
    			'departure.required' => $lngmenu->lng_worigin.' ! '.$lngmenu->lng_wnotelq,
    			'arrival.required' => $lngmenu->lng_wdesti.' ! '.$lngmenu->lng_wnotelq,
    			'datepicker.required' => $lngmenu->lng_wdatefly.' ! '.$lngmenu->lng_wnotelq,
    			'adult.required' => $lngmenu->lng_wdatefly.' ! '.$lngmenu->lng_wnotelq,
    		 ]);  

$stop=$request->stop;
$nonstop=$request->nonstop;


if($stop=='1' && $nonstop=='1'){$flgstop='1';} else 
if($stop=='0' && $nonstop=='0'){$flgstop='1';} else 
if($stop=='1' && $nonstop=='0'){$flgstop='2';} else 
if($stop=='0' && $nonstop=='1'){$flgstop='3';}  



$departures       = filter_var($request->departure, FILTER_SANITIZE_STRING);
$arrivals       = filter_var($request->arrival, FILTER_SANITIZE_STRING);


$departure       = filter_var($request->departure, FILTER_SANITIZE_STRING);
$arrival       = filter_var($request->arrival, FILTER_SANITIZE_STRING);
 
 
$allairprtdep=substr_count($departures, 'ALL AIRPRT IN');
$allairprtarr=substr_count($arrivals, 'ALL AIRPRT IN');  
 
 
$depm = explode("( ", $departure); $depm = explode(" )", $depm['1']); $departure=$depm['0'];  $departuref=$departure;
if($allairprtdep=='0'){
$departure=\DB::table('airports') ->where([['code', '=',  $departure],])->orderBy('code', 'desc')->first();
$departureo=\DB::table('airports') ->where([['code', '=',  $departuref],])->orderBy('code', 'desc')->first();
$departureob=$departureo->code; $departureobs=$departureo->obs;  $departureobs=$departureobs+1;
$depcountry=$departure->countryCode; $departure=$departure->code.$departure->countryCode;   
} 
if($allairprtdep!='0'){
$departure=\DB::table('airports') ->where([['code', '=',  $departure],])->orderBy('code', 'desc')->first();
$departureo=\DB::table('airports') ->where([['code', '=',  $departuref],])->orderBy('code', 'desc')->first();
$departureob=$departureo->code; $departureobs=$departureo->obs; $departureobs=$departureobs+1;
$depcountry=$departure->countryCode; $departure=$departure->code.'C'.$departure->countryCode;  
}

    
$updatee = \DB::table('airports')->where([['code', '=',  $departureob],])->update(['obs' => $departureobs   ]); 
  


$arrm = explode("( ", $arrival);  $arrm = explode(" )", $arrm['1']); $arrival=$arrm['0'];   $arrivalf=$arrival; 
if($allairprtarr=='0'){
$arrival=\DB::table('airports') ->where([['code', '=',  $arrival],])->orderBy('code', 'desc')->first();
$arrivalo=\DB::table('airports') ->where([['code', '=',  $arrivalf],])->orderBy('code', 'desc')->first();
$arrivalob=$arrivalo->code; $arrivalobs=$arrivalo->obs;  $arrivalobs=$arrivalobs+1;
$arrcountry=$arrival->countryCode;	 $arrival=$arrival->code.$arrival->countryCode; 
}
if($allairprtarr!='0'){
$arrival=\DB::table('airports') ->where([['code', '=',  $arrival],])->orderBy('code', 'desc')->first();
$arrivalo=\DB::table('airports') ->where([['code', '=',  $arrivalf],])->orderBy('code', 'desc')->first();
$arrivalob=$arrivalo->code; $arrivalobs=$arrivalo->obs;  $arrivalobs=$arrivalobs+1;
$arrcountry=$arrival->countryCode;	 $arrival=$arrival->code.'C'.$arrival->countryCode; 
}



$updatee = \DB::table('airports')->where([['code', '=',  $arrivalob],])->update(['obs' => $arrivalobs   ]); 



 	if($arrcountry==$depcountry){
		return redirect('/');
	}
 
 
    $departuredate       = filter_var($request->datepicker, FILTER_SANITIZE_STRING);
    $departuredater       = filter_var($request->datepickerr, FILTER_SANITIZE_STRING);
    $passengers       = filter_var($request->passengers, FILTER_SANITIZE_STRING);
    $adult = $request->input('adult'); 
    $child       = $request->input('child'); 
    $flightType       = $request->input('flightType'); 
    $infant       = filter_var($request->infant, FILTER_SANITIZE_STRING);

if($departuredater==''){
	$flightType='0';
} else {
	$flightType='1';
}




$sumpasg=$adult+$child+$infant;
if($sumpasg>7){
	return redirect('/');
} else if($sumpasg<=7){
	if($adult<$infant){
		return redirect('/');
	}
}


if($arrival==$departure){ return redirect('indexgds'); }

 
 
 
 if($flightType=='0'){ 
$datenew = explode(" ", $departuredate);   $monthh=$datenew['1']; $dayn=$datenew['2'];  $yearn=$datenew['3'];   
if($monthh=='Jan'){ $monthn='01';} else if($monthh=='Feb'){ $monthn='02';}  else if($monthh=='Mar'){ $monthn='03';}   else if($monthh=='Apr'){ $monthn='04';} else if($monthh=='May'){ $monthn='05';}  else if($monthh=='Jun'){ $monthn='06';}   else if($monthh=='Jul'){ $monthn='07';} else if($monthh=='Aug'){ $monthn='08';}  else if($monthh=='Sep'){ $monthn='09';}   else if($monthh=='Oct'){ $monthn='10';} else if($monthh=='Nov'){ $monthn='11';}  else if($monthh=='Dec'){ $monthn='12';} 
$year = $dayn.'.'.$monthn.'.'.$yearn.''; 
 
        $requestt = '{
            departure: "'.$departure.'",
            arrival: "'.$arrival.'",
            departuredate: "'.$year.'",
            adult: "'.$adult.'" ,
            child: "'.$child.'",
            infant: "'.$infant.'",
            onlydirect: false
        }';   
  }
 
 if($flightType=='1'){ 
    $departuredater       = filter_var($request->datepickerr, FILTER_SANITIZE_STRING);
     $departuredate = (string)$departuredate;
    $departuredater = (string)$departuredater;


    			 $this->validate($request,[
    			'departure' => 'required',
    			'arrival' => 'required',
    			'datepickerr' => 'required',
    			'adult' => 'required',
    		],[
    			'departure.required' => $lngmenu->lng_worigin.' ! '.$lngmenu->lng_wnotelq,
    			'arrival.required' => $lngmenu->lng_wdesti.' ! '.$lngmenu->lng_wnotelq,
    			'datepickerr.required' => $lngmenu->lng_wdatefly.' ! '.$lngmenu->lng_wnotelq,
    			'adult.required' => $lngmenu->lng_wdatefly.' ! '.$lngmenu->lng_wnotelq,
    		 ]);  

 
    
$datenew = explode(" ", $departuredate);   $monthh=$datenew['1']; $dayn=$datenew['2'];  $yearn=$datenew['3'];   
if($monthh=='Jan'){ $monthn='01';} else if($monthh=='Feb'){ $monthn='02';}  else if($monthh=='Mar'){ $monthn='03';}   else if($monthh=='Apr'){ $monthn='04';} else if($monthh=='May'){ $monthn='05';}  else if($monthh=='Jun'){ $monthn='06';}   else if($monthh=='Jul'){ $monthn='07';} else if($monthh=='Aug'){ $monthn='08';}  else if($monthh=='Sep'){ $monthn='09';}   else if($monthh=='Oct'){ $monthn='10';} else if($monthh=='Nov'){ $monthn='11';}  else if($monthh=='Dec'){ $monthn='12';} 
$year = $dayn.'.'.$monthn.'.'.$yearn.''; 


$datenewr = explode(" ", $departuredater);   $monthr=$datenewr['1']; $dayr=$datenewr['2'];  $yearrn=$datenewr['3'];   
if($monthr=='Jan'){ $montrn='01';} else if($monthr=='Feb'){ $montrn='02';}  else if($monthr=='Mar'){ $montrn='03';}   else if($monthr=='Apr'){ $montrn='04';} else if($monthr=='May'){ $montrn='05';}  else if($monthr=='Jun'){ $montrn='06';}   else if($monthr=='Jul'){ $montrn='07';} else if($monthr=='Aug'){ $montrn='08';}  else if($monthr=='Sep'){ $montrn='09';}   else if($monthr=='Oct'){ $montrn='10';} else if($monthr=='Nov'){ $montrn='11';}  else if($monthr=='Dec'){ $montrn='12';} 
$yearr = $dayr.'.'.$montrn.'.'.$yearrn.''; 
 
        $requestt = '{
            departure: "'.$departure.'",
            arrival: "'.$arrival.'",
            departuredate: "'.$year.'",
            returndate: "'.$yearr.'",
            adult: "'.$adult.'" ,
            child: "'.$child.'",
            infant: "'.$infant.'",
            onlydirect: false
        }';
        
    
  }
  
 
      
 if (empty($_SESSION['ProviderSessionId'])) {
     // echo 'empty';
      }
        
    $headers = array(
        'username:atin_user',
        'password:X4fVgT3a',
        'Content-Type:application/json',
        'request:'.$requestt
    );
        if (! empty($_SESSION['ProviderSessionId'])) {
        $headers['SetSession'] = $_SESSION['ProviderSessionId'];
    }

    		
     //http://88.250.178.229:4545/
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://ucuzauc.com/api/availability/4e53defd-7620-4ac1-b7e1-61c43f34bb76");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $requestt);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 5);
    curl_setopt($ch, CURLOPT_TIMEOUT, 59);
    curl_setopt($ch, CURLOPT_HEADER, 1);
$result = curl_exec($ch);

 

$wordChunks = explode("}]}]},", $result);
for($i = 0; $i < count($wordChunks); $i++){ }
if ( ! empty($_SESSION['ProviderSessionId'])) {
      $_SESSION['ProviderSessionId'] =  $wordChunks.uu_SessionId;
      }
 


 $airports=  \DB::table('countries') ->where([['id', '<>',  '0'],])->orderBy('id')->get(); 

  	 

$ori = explode("OriginDestinationOptionList,", $result );
$wordChunks = explode('{"Currency":"', $result);
$AirlineCode = explode('"ValidatingAirlineCode":"', $result);
$FlightNumber = explode('"FlightNumber":"', $result);
$ResBookDesigCode = explode('"ResBookDesigCode":"', $result);
$time = explode('"DepartureDateTime":"', $result);
$rezerve = explode('"ResBookDesigQuantity":"', $result);
$Havayolu = explode('"MarketingAirlineName":"', $result);
$TOTALEFARE = explode('"TotalFare":', $result);
$DepartureAirport = explode('"DepartureAirport":"', $result); 
$ArrivalAirport = explode('"ArrivalAirport":"', $result); 
$FlightSegment = explode('FlightSegment', $result); 
$SequenceNumber = explode('SequenceNumber":"', $result); 
$sessionid = explode('","sessionid":"', $result);
$sessionidD = explode('","', $sessionid['1']);
$uu_sessionid = explode('"uu_SessionId":"' , $result);
$uu_sessionidD = explode('","sessionid":"' , $uu_sessionid['1']);


	Session::set('wbs_uuses', $uu_sessionidD['0']); 
	
    DB::table('wbs')->insert([
    ['result' => $result  , 'wbs_uuses' => $uu_sessionidD['0']  ,'wbs_sesid' => $sessionidD['0']  , 'wbs_arrival' => $arrival , 'wbs_departure' => $departure , 'wbs_adult' => $adult , 'wbs_child' => $child , 'wbs_infant' => $infant  , 'wbs_departuredate' => $departuredate  , 'wbs_departuredater' => $departuredater   , 'wbs_way' => $flightType , 'wbs_ip' => $request->ip()   ,   'wbs_createdatdate' =>  date('Y-m-d H:i:s')       ]
]);   
 
$wbs=\DB::table('wbs') ->where([['wbs_uuses', '=', Session::get('wbs_uuses')] , ])->orderBy('id', 'desc')->first(); 
$result=$wbs->result; $wbssearch=$wbs->id;


$depnamenamecountry = substr($wbs->wbs_departure,0,3);  $arrnamenamecountry = substr($wbs->wbs_arrival,0,3);
$depairports = \DB::table('airports')  ->where([  ['airports.code', '=', $depnamenamecountry],])  ->orderBy('airports.code', 'desc')->get();  foreach($depairports as $depairport){   $depcityairport=$depairport->cityName;  $depnameairport=$depairport->name;  $depcountryname=$depairport->countryName;  $namefrom = $depcountryname .' _ '.$depcityairport.' _ '.$depnameairport;  }  
  
$arrairports = \DB::table('airports')  ->where([ ['airports.code', '=', $arrnamenamecountry] ,])  ->orderBy('airports.code', 'desc')->get();  foreach($arrairports as $arrairport){   $arrcityairport=$arrairport->cityName;  $arrnameairport=$arrairport->name;  $arrcountryname=$arrairport->countryName; $nameto = $arrcountryname .' _ '.$arrcityairport.' _ '.$arrnameairport; }
 


 
 
 
 	
    DB::table('wbslistsearch')->insert([
    ['id' => $wbs->id     , 'wbs_uuses' => $uu_sessionidD['0']  ,'wbs_sesid' => $sessionidD['0']  , 'wbs_arrival' => $arrival , 'wbs_departure' => $departure , 'wbs_adult' => $adult , 'wbs_child' => $child , 'wbs_infant' => $infant  , 'wbs_departuredate' => $departuredate  , 'wbs_departuredater' => $departuredater   , 'wbs_way' => $flightType , 'wbs_ip' => $request->ip()   ,   'wbs_createdatdate' =>  date('Y-m-d H:i:s') , 'wbs_namefrom' => $namefrom, 'wbs_nameto' => $nameto      ]
]);   
 
 
$wbs=\DB::table('wbs') ->where([['wbs_uuses', '=', Session::get('wbs_uuses')] , ])->orderBy('id', 'desc')->first(); 
$wbsid=$wbs->id;

   $sortcounts=\DB::table('sort') ->where([['sort_wbsid', '=', $wbsid] , ])->orderBy('id', 'desc')->count(); 



for($i = 1; $i < count($wordChunks); $i++){ 
$FlightNumberD = explode('","ResBookDesigCode"', $FlightNumber[$i]);
$ResBookDesigCodeD = explode('","ResBookDesigQuantity"', $ResBookDesigCode[$i]);
$timeD = explode('","ArrivalDateTime"', $time[$i]);
$AirlineCodeD = explode('","ForceETicket":"', $AirlineCode[$i]);
$rezerveD = explode('","DepartureAirport":"', $rezerve[$i]);
$HavayoluD = explode('","Equipment":"', $Havayolu[$i]);
$HavayoluDD = explode('","', $HavayoluD['0']);
$TOTALEFARED = explode(',"ServiceFare":', $TOTALEFARE[$i]);
$DepartureAirportD = explode('","ArrivalAirport":', $DepartureAirport[$i]);
$ArrivalAirportD = explode('","DepartureCityCountry":', $ArrivalAirport[$i]);
$FlightSegmentD = explode('},{"DepartureDateTime":"', $wordChunks[$i]);
$SequenceNumberD = explode('","OriginDestinationOptionList"', $SequenceNumber[$i]);
$flseg=substr_count($SequenceNumber[$i], 'FlightSegment'); 
$flRefNumber=substr_count($SequenceNumber[$i], 'RefNumber');  
$listseg  = explode('","OriginDestinationOptionList"', $wordChunks[$i]); 
$listsegD = explode('","OriginDestinationOptionList"', $listseg['1']);
$refnmD = explode('"RefNumber":"', $listseg['1']); 
$TotalFare = explode(',"TotalFare":', $wordChunks[$i]);
$TotalFareD = explode(',"ServiceFare":', $TotalFare['1']);
$listseg  = explode('","OriginDestinationOptionList"', $wordChunks[$i]); 
$listsegD = explode('","OriginDestinationOptionList"', $listseg['1']);

 $adttprice='0';  $adtbprice='0';  $adtsprice=$adttprice-$adtbprice ; 

if($adult != '0'){
$adtprice = explode('"PassengerType":"Yetişkin"', $wordChunks[$i]);
$adtpriceD = explode(',"TicketDesignators":', $adtprice['1']);	 

$adtbpriceD = explode(',"BaseFare":', $adtpriceD['0']);	
$adtbpriceDD = explode(',"MarkupFare":', $adtbpriceD['1']);	
$adtbprice=	$adtbpriceDD['0'];

$adttpriceD = explode('"TotalFare":', $adtpriceD['0']);	
$adttpriceDD = explode(',"ServiceFare":', $adttpriceD['1']);
$adttprice=	$adttpriceDD['0'];

 $adtsprice=$adttprice-$adtbprice ;

}


 $chdtprice=0; $chdbprice=0; $chdsprice=$chdtprice-$chdbprice ;

if($child != '0'){
$chdprice = explode('"PassengerType":"Çocuk"', $wordChunks[$i]);
$chdpriceD = explode(',"TicketDesignators":', $chdprice['1']);	

$chdbpriceD = explode(',"BaseFare":', $chdpriceD['0']);	
$chdbpriceDD = explode(',"MarkupFare":', $chdbpriceD['1']);	
$chdbprice=	$chdbpriceDD['0'];

$chdtpriceD = explode('"TotalFare":', $chdpriceD['0']);	
$chdtpriceDD = explode(',"ServiceFare":', $chdtpriceD['1']);
$chdtprice=	$chdtpriceDD['0'];

 $chdsprice=$chdtprice-$chdbprice ;

}

 $inftprice=0; $infbprice=0; $infsprice=$inftprice-$infbprice ;

if($infant != '0'){
$infprice = explode('"PassengerType":"Bebek"', $wordChunks[$i]);
$infpriceD = explode(',"TicketDesignators":', $infprice['1']);	

$infbpriceD = explode(',"BaseFare":', $infpriceD['0']);	
$infbpriceDD = explode(',"MarkupFare":', $infbpriceD['1']);	
$infbprice=$infbpriceDD['0'];

$inftpriceD = explode('"TotalFare":', $infpriceD['0']);	
$inftpriceDD = explode(',"ServiceFare":', $inftpriceD['1']);
$inftprice=$inftpriceDD['0'];	


 $infsprice=$inftprice-$infbprice ;

}




 DB::table('comwbs')->insert([[  'comwbs_wbsid' => $wbssearch ,  'comwbs_test' => $TotalFareD['0']  ,  'comwbs_seq' =>$SequenceNumberD['0']  ,  'comwbs_adtbprice' =>$adtbprice ,  'comwbs_chdbprice' =>$chdbprice,  'comwbs_infbprice' =>$infbprice ,  'comwbs_adtsprice' =>$adtsprice ,  'comwbs_chdsprice' =>$chdsprice,  'comwbs_infsprice' =>$infsprice ,  'comwbs_adttprice' =>$adttprice ,  'comwbs_chdtprice' =>$chdtprice,  'comwbs_inftprice' =>$inftprice  ]]); 




 if($flightType=='1'){ 
$CombinationIDNumbe=substr_count($SequenceNumber[$i], 'CombinationID'); 
$CombinationIDNumber=$CombinationIDNumbe-1; 
$CombinationList  = explode('OriginDestinationCombinationList', $wordChunks[$i]); 
$CombinationIDNumbeji=substr_count($CombinationList['1'], 'CombinationID'); 
$CombinationListD  = explode('"IndexList":"', $CombinationList['1']); 
for($c = 1; $c <  $CombinationIDNumber+2   ; $c++){   
$IndexList  = explode('","CombinationID":"', $CombinationListD[$c]); 
$comiid  = explode('","', $IndexList['1']); 
$IndexListwentD  = explode(';', $IndexList['0']);  
$IndexListwentD['0']; 
 DB::table('comid')->insert([['seq' => $i-1 ,'seqseq' => $SequenceNumberD['0'] , 'went' => $IndexListwentD['0'] , 'back' => $IndexListwentD['1'] ,    'wbssearch' => $wbssearch ,  'com' => $comiid['0']  ]]);  
}  
}


 for($j = 1; $j < $flseg+1; $j++){ 
$feldsq  = explode('FlightSegment":[{', $listsegD['0']); 
$refnmsD = explode('FlightSegment', $refnmD[$j]); 
$refnmsND = explode('","DirectionId":"', $refnmsD['0']); 
$DirectionIdflgD = explode('","', $refnmsND['1']);  
$ElapsedTime = explode('","ElapsedTime":"', $refnmsD['0']); 
$ElapsedTimeD = explode('","', $ElapsedTime['1']);   
$directsD = explode('","', $ElapsedTime['0']);   
$directsidD = explode('DirectionId":"', $directsD['1']);    
$rfse=substr_count($refnmsD['1'], 'DepartureAirport');   

$airlinemark  = explode('"OperatingAirlineName":"', $listsegD['0']);
$airlinemarkD  = explode('","', $airlinemark['1']);
$marketlog  = explode('"MarketingAirline":"', $listsegD['0']);
$marketlogD  = explode('","', $marketlog['1']);

$feldsqDk = explode(',"DepartureAirport":"', $feldsq[$j]);
$feldsqDkD = explode('(', $feldsqDk['1']);
$feldsqDkDD = explode(')', $feldsqDkD['1']);
$deptime = explode('"DepartureDateTime":"', $feldsq[$j]);
$deptimeD = explode('","ArrivalDateTime":"', $deptime['1']);
$originalDate = $deptimeD['0'];
$newDatedep = date("d F", strtotime($originalDate)); $newDatedept = date("H:i", strtotime($originalDate));  

 $string=$ElapsedTimeD['0']; $min = '';$h = '';
for ($index=0;$index<strlen($string);$index++) { if($index<2){ $h .= $string[$index]; } else { $min .= $string[$index]; }} 


$feldsqDkar = explode('","ArrivalAirport":"', $feldsq[$j]);
$feldsqDkarD = explode('(', $feldsqDkar[$rfse]);	
$feldsqDkarDD = explode(')', $feldsqDkarD['1']);	
$artime = explode('","ArrivalDateTime":"', $feldsq[$j]);
$artimeD = explode('","FlightNumber":"', $artime[$rfse]);	
$originalDatea = $artimeD['0'];
$newDatearr = date("d F", strtotime($originalDatea)); $newDatearrt = date("H:i", strtotime($originalDatea));

$luggage = explode('"Luggage":"', $feldsq[$j]);
$luggageD = explode('","', $luggage['1']);

   

$clasnk = explode('","ResBookDesigCode":"', $feldsq[$j]);
$clasnkD = explode('","ResBookDesigQuantity":"', $clasnk['1']);






   
 if($sortcounts=='0'){ 
 
$dirf=$rfse+1;
 if($flgstop=='1'){ $show='1'; } else 
      if($flgstop=='2'){ if($dirf=='2') {$show='0';} else if($dirf!='2') {$show='1';}  }
else  if($flgstop=='3'){ if($dirf=='2') {$show='1';} else if($dirf!='2') {$show='0';}   }   



 	
$sairlinest  = explode(" ", $airlinemarkD['0']); 	
$sairlinestD  = $sairlinest['0']; 
  DB::table('sort')->insert([['sort_seq' => $i-1 , 'sort_comb' => $j-1 ,'sort_price' => $TotalFareD['0'] , 'sort_wbsid' => $wbsid  , 'sort_duritfly' => $h.$min   , 'sort_deptime' => $originalDate , 'sort_artime' => $originalDatea ,  'sort_airline' => $airlinemarkD['0'] ,  'sort_indirect' => $rfse+1  ,  'sort_class' => $clasnkD['0'] ,  'sort_show' => $show ]]);  	
  
  
   $sortvcounts=\DB::table('sortv') ->where([['sortv_wbsid', '=', $wbsid] ,['sortv_price', '=', $TotalFareD['0']] , ])->orderBy('id')->count(); 
  
  
 if($sortvcounts=='0'){
 
   $sairlinest  = explode(" ", $airlinemarkD['0']); 	
  $sairlinestD  = $sairlinest['0']; 		
 	

$sortvaircounts=\DB::table('sortv') ->where([['sortv_wbsid', '=', $wbsid] ,['sortv_airline', '=', $airlinemarkD['0']],  ])->orderBy('id')->count(); 	
 if($sortvaircounts=='0'){ $flgairline=1; } else  if($sortvaircounts!='0'){ $flgairline=0; }
 	

$sortvclascounts=\DB::table('sortv') ->where([['sortv_wbsid', '=', $wbsid] ,['sortv_class', '=',$clasnkD['0'] ],  ])->orderBy('id')->count(); 	
 if($sortvclascounts=='0'){ $flgaclas=1; } else  if($sortvclascounts!='0') { $flgaclas=0; }

$sortvindirectcounts=\DB::table('sortv') ->where([['sortv_wbsid', '=', $wbsid] ,['sortv_indirect', '=',$rfse+1 ],  ])->orderBy('id')->count(); 	
 if($sortvindirectcounts=='0'){ $indirect=1; } else  if($sortvindirectcounts!='0') { $indirect=0; }
 	
 	
  DB::table('sortv')->insert([[  'sortv_price' => $TotalFareD['0'] , 'sortv_wbsid' => $wbsid  ,   'sortv_airline' => $airlinemarkD['0'] ,  'sortv_class' => $clasnkD['0']  ,  'sortv_indirect' => $rfse+1 ,  'sortv_airlineflg' => $flgairline ,  'sortv_clasflg' => $flgaclas ,  'sortv_indirectflg' => $indirect ,  'sortv_priceflg' => '1' ]]);  
  }	
  
  
  
  
 }  


 
$comwbs=\DB::table('comwbs') ->where([['comwbs_wbsid', '=', $wbssearch] , ])->orderBy('comwbs_id', 'desc')->first(); 
$indxcomwbs=$comwbs->comwbs_id;
 DB::table('comwbsj')->insert([[  'comwbsj_wbsid' => $wbssearch ,  'comwbsj_test' => $TotalFareD['0']  ,  'comwbsj_comwbsid' =>$SequenceNumberD['0'] ,  'comwbsj_seq' => $SequenceNumberD['0'] ,  'comwbsj_comb' => $refnmsND['0'] ,  'comwbsj_directflg' => $DirectionIdflgD['0'] ,  'comwbsj_price' => $TotalFareD['0'] ,  'comwbsj_deptime' => $originalDate ,  'comwbsj_artime' => $originalDatea ,  'comwbsj_durtfly' => $h.$min  ,  'comwbsj_indirect' => $rfse-1 ,  'comwbsj_class' => $clasnkD['0'],  'comwbsj_airline' => $airlinemarkD['0'],  'comwbsj_index' => $indxcomwbs  ]]); 
    




//k
 for($k = 1; $k <  $rfse+1   ; $k++){ 
$airlinemark  = explode('"OperatingAirlineName":"', $feldsq[$j]);
$airlinemarkD  = explode('","', $airlinemark[$k]);
$marketlog  = explode('"MarketingAirline":"', $feldsq[$j]);
$marketlogD  = explode('","', $marketlog[$k]); 
$flnk = explode('","FlightNumber":"', $feldsq[$j]);
$flnkD = explode('","ResBookDesigCode":"', $flnk[$k]);
$gole = explode('","OperatingAirline":"', $feldsq[$j]);
$goleD = explode('","MarketingAirline":"', $gole[$k]); 
$clasnk = explode('","ResBookDesigCode":"', $feldsq[$j]);
$clasnkD = explode('","ResBookDesigQuantity":"', $clasnk[$k]);

$citydep = explode(',"DepartureCityCountry":"', $feldsq[$j]);
$citydepD = explode(',', $citydep[$k]);	
$cityarriv = explode(',"ArrivaliCityCountry":"', $feldsq[$j]);
$cityarrivD = explode(',', $cityarriv[$k]);	
$feldsqDk = explode(',"DepartureAirport":"', $feldsq[$j]);
$feldsqDkD = explode('(', $feldsqDk[$k]); 
$feldsqDkDD = explode(')', $feldsqDkD['1']);
$feldsqDkar = explode('","ArrivalAirport":"', $feldsq[$j]);
$feldsqDkarD = explode('(', $feldsqDkar[$k]);	
$feldsqDkarDD = explode(')', $feldsqDkarD['1']);	
$deptime = explode('"DepartureDateTime":"', $feldsq[$j]);
$deptimeD = explode('","ArrivalDateTime":"', $deptime[$k]);
$artime = explode('","ArrivalDateTime":"', $feldsq[$j]);
$artimeD = explode('","FlightNumber":"', $artime[$k]);	
$originalDate = $deptimeD['0'];
$newDatedep = date("d F", strtotime($originalDate)); $newDatedept = date("H:i", strtotime($originalDate));
$originalDatea = $artimeD['0'];
$newDatearr = date("d F", strtotime($originalDatea)); $newDatearrt = date("H:i", strtotime($originalDatea)); 

$luggage = explode('"Luggage":"', $feldsq[$j]);
$luggageD = explode('","', $luggage[$k]); 

 $Quantity = explode('"ResBookDesigQuantity":"', $feldsq[$j]);
$QuantityD = explode('","', $Quantity['1']);

  
 
$depairports = \DB::table('airports') 
->where([
    ['airports.code', '=', $feldsqDkDD['0']],])
    ->orderBy('airports.code', 'desc')->get(); 
foreach($depairports as $depairport){   $depcityairport=$depairport->cityName;  $depnameairport=$depairport->name; }
 
 
$arrairports = \DB::table('airports') 
->where([
    ['airports.code', '=', $feldsqDkarDD['0']],])
    ->orderBy('airports.code', 'desc')->get(); 
foreach($arrairports as $arrairport){   $arrcityairport=$arrairport->cityName;  $arrnameairport=$arrairport->name; }
 

 


$comwbs=\DB::table('comwbsj') ->where([['comwbsj_wbsid', '=', $wbssearch] , ])->orderBy('comwbsj_id', 'desc')->first(); 
$indxcomwbs=$comwbs->comwbsj_id;

 DB::table('comwbsk')->insert([[  'comwbsk_wbsid' => $wbssearch ,  'comwbsk_marketairline' => $marketlogD['0'],  'comwbsk_flightnumber' => $flnkD['0'],  'comwbsk_clas' => $clasnkD['0'],  'comwbsk_operatorairline' => $goleD['0'],  'comwbsk_logoairline' => $goleD['0'],  'comwbsk_depdate' => $originalDate,  'comwbsk_depyata' => $feldsqDkDD['0'],  'comwbsk_depcity' => $depcityairport,  'comwbsk_depairport' => $depnameairport,  'comwbsk_ardate' => $originalDatea,  'comwbsk_aryata' => $feldsqDkarDD['0'],  'comwbsk_arcity' => $arrcityairport,  'comwbsk_arairport' => $arrnameairport ,  'comwbsk_bag' => $luggageD['0'] ,  'comwbsk_capt' => $QuantityD['0'] ,  'comwbsk_seq' => $SequenceNumberD['0'] ,  'comwbsk_comb' => $refnmsND['0'] ,  'comwbsk_index' => $indxcomwbs     ]]); 
    
     
     
 
 
 
 
 
 

 } } }

 $comids=  \DB::table('comid') ->where([['wbssearch', '=',  $wbssearch],])->orderBy('id')->get(); 

 
 
 
$currency=\DB::table('currency') ->where([['cur_nem', '=',  Session::get('curnem')],])->orderBy('id', 'desc')->first();   	

 
 
 

 
  if($flightType=='0'){
  	
  
  return redirect('sortvt');
}
  
 
  if($flightType=='1'){ 
  
  return redirect('sortvt');
  
  
  
  
  /*
  return view('superadmin.ucackreturn', ['result' => $result , 'lngmenus' => $lngmenus , 'lngmenu' => $lngmenu , 'arrival' => $arrival , 'departure' => $departure , 'departuredate' => $departuredate,'departuredater' => $departuredater , 'year' => $year ,'yearr' => $yearr, 'airports' => $airports , 'adult' => $adult , 'child' => $child, 'infant' => $infant , 'wbs' => $wbs  , 'comids' => $comids   , 'currency' => $currency  ]);
 */
    }
 
 
 
 
 
 
}	






	public function prevnextind(Request $request){
 
$lngmenus= \DB::table('language') ->where([['id', '<>',  '0'],['lng_active', '=',  '1'],])->orderBy('id', 'desc')->get();
$lngmenu=\DB::table('language') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first(); 


$flag = $request->input('flag');



$wbs=\DB::table('wbs') ->where([['wbs_uuses', '=', Session::get('wbs_uuses')],])->orderBy('id', 'desc')->first(); 
  
$arrival=$wbs->wbs_arrival;
$departure=$wbs->wbs_departure;
$adult=$wbs->wbs_adult;
$child=$wbs->wbs_child;
$infant=$wbs->wbs_infant;
$departuredate=$wbs->wbs_departuredate;

$airports= \DB::table('countries') ->where([['countries_id', '<>',  '0'],])->orderBy('countries_id')->get();
  
 
 
 if($flag=='prev'){ 
$perv_day_date = date('Y-m-d', strtotime('-1 day', strtotime($departuredate))) ;
$datee = explode("-", $perv_day_date); $year = $datee[2].'.'.$datee[1].'.'.$datee[0].''; 
$dateprevnext= $datee[1].'/'.$datee[2].'/'.$datee[0].''; 

  }
  
 
 if($flag=='next'){ 
$perv_day_date = date('Y-m-d', strtotime('+1 day', strtotime($departuredate))) ;
$datee = explode("-", $perv_day_date); $year = $datee[2].'.'.$datee[1].'.'.$datee[0].''; 
$dateprevnext= $datee[1].'/'.$datee[2].'/'.$datee[0].''; 

  }
  

  
	 $admins = \DB::table('wbs')->where([['wbs_uuses', '=', Session::get('wbs_uuses')],])->delete(); 
	 Session::forget('wbs_uuses');
	
	
 
 
 
     $request = '{
            departure: "'.$departure.'",
            arrival: "'.$arrival.'",
            departuredate: "'.$year.'",
            adult: "'.$adult.'" ,
            child: "'.$child.'",
            infant: "'.$infant.'",
            onlydirect: false
        }';  


 if (empty($_SESSION['ProviderSessionId'])) {
     // echo 'empty';
      }
        
    $headers = array(
        'username:atin_user',
        'password:X4fVgT3a',
        'Content-Type:application/json',
        'request:'.$request
    );
        if (! empty($_SESSION['ProviderSessionId'])) {
        $headers['SetSession'] = $_SESSION['ProviderSessionId'];
    }


		
  
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://ucuzauc.com/api/availability/4e53defd-7620-4ac1-b7e1-61c43f34bb76");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 5);
    curl_setopt($ch, CURLOPT_TIMEOUT, 59);
    curl_setopt($ch, CURLOPT_HEADER, 1);
$result = curl_exec($ch);



$wordChunks = explode("}]}]},", $result);
for($i = 0; $i < count($wordChunks); $i++){ }
if ( ! empty($_SESSION['ProviderSessionId'])) {
      $_SESSION['ProviderSessionId'] =  $wordChunks.uu_SessionId;
      }
 


$ori = explode("OriginDestinationOptionList,", $result );
$wordChunks = explode('{"Currency":"', $result);
$AirlineCode = explode('"ValidatingAirlineCode":"', $result);
$FlightNumber = explode('"FlightNumber":"', $result);
$ResBookDesigCode = explode('"ResBookDesigCode":"', $result);
$time = explode('"DepartureDateTime":"', $result);
$rezerve = explode('"ResBookDesigQuantity":"', $result);
$Havayolu = explode('"MarketingAirlineName":"', $result);
$TOTALEFARE = explode('"TotalFare":', $result);
$DepartureAirport = explode('"DepartureAirport":"', $result); 
$ArrivalAirport = explode('"ArrivalAirport":"', $result); 
$FlightSegment = explode('FlightSegment', $result); 
$SequenceNumber = explode('SequenceNumber":"', $result); 
$sessionid = explode('","sessionid":"', $result);
$sessionidD = explode('","', $sessionid['1']);
$uu_sessionid = explode('"uu_SessionId":"' , $result);
$uu_sessionidD = explode('","sessionid":"' , $uu_sessionid['1']);


    DB::table('wbs')->insert([
    ['result' => $result  , 'wbs_uuses' => $uu_sessionidD['0']  ,'wbs_sesid' => $sessionidD['0']  , 'wbs_arrival' => $arrival , 'wbs_departure' => $departure , 'wbs_adult' => $adult , 'wbs_child' => $child , 'wbs_infant' => $infant  , 'wbs_departuredate' => $dateprevnext  , 'wbs_way' => '0'  ,    'wbs_createdatdate' =>  date('Y-m-d H:i:s')             ]
]); 

 

Session::set('wbs_uuses', $uu_sessionidD['0']); 
$wbs=\DB::table('wbs') ->where([['wbs_uuses', '=', Session::get('wbs_uuses')] , ])->orderBy('id', 'desc')->first(); 
$wbsid=$wbs->id;
$wbssort=$wbs->wbs_sort;



$depnamenamecountry = substr($wbs->wbs_departure,0,3);  $arrnamenamecountry = substr($wbs->wbs_arrival,0,3);
$depairports = \DB::table('airports')  ->where([  ['airports.code', '=', $depnamenamecountry],])  ->orderBy('airports.code', 'desc')->get();  foreach($depairports as $depairport){   $depcityairport=$depairport->cityName;  $depnameairport=$depairport->name;  $depcountryname=$depairport->countryName;  $namefrom = $depcountryname .' _ '.$depcityairport.' _ '.$depnameairport;  }  
  
$arrairports = \DB::table('airports')  ->where([ ['airports.code', '=', $arrnamenamecountry] ,])  ->orderBy('airports.code', 'desc')->get();  foreach($arrairports as $arrairport){   $arrcityairport=$arrairport->cityName;  $arrnameairport=$arrairport->name;  $arrcountryname=$arrairport->countryName; $nameto = $arrcountryname .' _ '.$arrcityairport.' _ '.$arrnameairport; }
 


    DB::table('wbslistsearch')->insert([
    ['id' => $wbs->id    , 'wbs_uuses' => $uu_sessionidD['0']  ,'wbs_sesid' => $sessionidD['0']  , 'wbs_arrival' => $arrival , 'wbs_departure' => $departure , 'wbs_adult' => $adult , 'wbs_child' => $child , 'wbs_infant' => $infant  , 'wbs_departuredate' => $dateprevnext  , 'wbs_way' => '0'  ,    'wbs_createdatdate' =>  date('Y-m-d H:i:s')  , 'wbs_namefrom' => $namefrom, 'wbs_nameto' => $nameto             ]
]); 





 $sorts=\DB::table('sort') ->where([['sort_wbsid', '=', $wbsid] , ])->orderBy('id')->get(); 	
 $sortcounts=\DB::table('sort') ->where([['sort_wbsid', '=', $wbsid] , ])->orderBy('id')->count(); 	    

 


for($i = 1; $i < count($wordChunks); $i++){ 
$FlightNumberD = explode('","ResBookDesigCode"', $FlightNumber[$i]);
$ResBookDesigCodeD = explode('","ResBookDesigQuantity"', $ResBookDesigCode[$i]);
$timeD = explode('","ArrivalDateTime"', $time[$i]);
$AirlineCodeD = explode('","ForceETicket":"', $AirlineCode[$i]);
$rezerveD = explode('","DepartureAirport":"', $rezerve[$i]);
$HavayoluD = explode('","Equipment":"', $Havayolu[$i]);
$HavayoluDD = explode('","', $HavayoluD['0']);
$TOTALEFARED = explode(',"ServiceFare":', $TOTALEFARE[$i]);
$DepartureAirportD = explode('","ArrivalAirport":', $DepartureAirport[$i]);
$ArrivalAirportD = explode('","DepartureCityCountry":', $ArrivalAirport[$i]);
$FlightSegmentD = explode('},{"DepartureDateTime":"', $wordChunks[$i]);
$SequenceNumberD = explode('","OriginDestinationOptionList"', $SequenceNumber[$i]);
$flseg=substr_count($SequenceNumber[$i], 'FlightSegment'); 
$flRefNumber=substr_count($SequenceNumber[$i], 'RefNumber');  
$listseg  = explode('","OriginDestinationOptionList"', $wordChunks[$i]); 
$listsegD = explode('","OriginDestinationOptionList"', $listseg['1']);
$refnmD = explode('"RefNumber":"', $listseg['1']); 
$TotalFare = explode(',"TotalFare":', $wordChunks[$i]);
$TotalFareD = explode(',"ServiceFare":', $TotalFare['1']);
$listseg  = explode('","OriginDestinationOptionList"', $wordChunks[$i]); 
$listsegD = explode('","OriginDestinationOptionList"', $listseg['1']);

 


 for($j = 1; $j < $flseg+1; $j++){ 
$feldsq  = explode('FlightSegment":[{', $listsegD['0']); 
$refnmsD = explode('FlightSegment', $refnmD[$j]); 
$refnmsND = explode('","DirectionId":"', $refnmsD['0']); 
$ElapsedTime = explode('","ElapsedTime":"', $refnmsD['0']); 
$ElapsedTimeD = explode('","', $ElapsedTime['1']);   
$directsD = explode('","', $ElapsedTime['0']);   
$directsidD = explode('DirectionId":"', $directsD['1']);    
$rfse=substr_count($refnmsD['1'], 'DepartureAirport');   

$airlinemark  = explode('"OperatingAirlineName":"', $listsegD['0']);
$airlinemarkD  = explode('","', $airlinemark['1']);
$marketlog  = explode('"MarketingAirline":"', $listsegD['0']);
$marketlogD  = explode('","', $marketlog['1']);

$feldsqDk = explode(',"DepartureAirport":"', $feldsq[$j]);
$feldsqDkD = explode('(', $feldsqDk['1']);
$feldsqDkDD = explode(')', $feldsqDkD['1']);
$deptime = explode('"DepartureDateTime":"', $feldsq[$j]);
$deptimeD = explode('","ArrivalDateTime":"', $deptime['1']);
$originalDate = $deptimeD['0'];
$newDatedep = date("d F", strtotime($originalDate)); $newDatedept = date("H:i", strtotime($originalDate));  

 $string=$ElapsedTimeD['0']; $min = '';$h = '';
for ($index=0;$index<strlen($string);$index++) { if($index<2){ $h .= $string[$index]; } else { $min .= $string[$index]; }} 


$feldsqDkar = explode('","ArrivalAirport":"', $feldsq[$j]);
$feldsqDkarD = explode('(', $feldsqDkar[$rfse]);	
$feldsqDkarDD = explode(')', $feldsqDkarD['1']);	
$artime = explode('","ArrivalDateTime":"', $feldsq[$j]);
$artimeD = explode('","FlightNumber":"', $artime[$rfse]);	
$originalDatea = $artimeD['0'];
$newDatearr = date("d F", strtotime($originalDatea)); $newDatearrt = date("H:i", strtotime($originalDatea));

$luggage = explode('"Luggage":"', $feldsq[$j]);
$luggageD = explode('","', $luggage['1']);
 
  


$clasnk = explode('","ResBookDesigCode":"', $feldsq[$j]);
$clasnkD = explode('","ResBookDesigQuantity":"', $clasnk['1']);

 
  if($sortcounts=='0'){
 	
$sairlinest  = explode(" ", $airlinemarkD['0']); 	
$sairlinestD  = $sairlinest['0']; 
 
DB::table('sort')->insert([['sort_seq' => $i-1 , 'sort_comb' => $j-1 ,'sort_price' => $TotalFareD['0'] , 'sort_wbsid' => $wbsid  , 'sort_duritfly' => $h.$min   , 'sort_deptime' => $originalDate , 'sort_artime' => $originalDatea ,  'sort_airline' => $sairlinestD ,  'sort_indirect' => $rfse+1  ,  'sort_class' => $clasnkD['0'] ,  'sort_show' => '1' ]]);  	
  
  
$sortvcounts=\DB::table('sortv') ->where([['sortv_wbsid', '=', $wbsid] ,['sortv_price', '=', $TotalFareD['0']] , ])->orderBy('id')->count(); 
  
  
 if($sortvcounts=='0'){
 
   $sairlinest  = explode(" ", $airlinemarkD['0']); 	
  $sairlinestD  = $sairlinest['0']; 		
 	

$sortvaircounts=\DB::table('sortv') ->where([['sortv_wbsid', '=', $wbsid] ,['sortv_airline', '=', $sairlinestD],  ])->orderBy('id')->count(); 	
 if($sortvaircounts=='0'){ $flgairline=1; } else  if($sortvaircounts!='0'){ $flgairline=0; }
 	

$sortvclascounts=\DB::table('sortv') ->where([['sortv_wbsid', '=', $wbsid] ,['sortv_class', '=',$clasnkD['0'] ],  ])->orderBy('id')->count(); 	
 if($sortvclascounts=='0'){ $flgaclas=1; } else  if($sortvclascounts!='0') { $flgaclas=0; }

$sortvindirectcounts=\DB::table('sortv') ->where([['sortv_wbsid', '=', $wbsid] ,['sortv_indirect', '=',$rfse+1 ],  ])->orderBy('id')->count(); 	
 if($sortvindirectcounts=='0'){ $indirect=1; } else  if($sortvindirectcounts!='0') { $indirect=0; }
 	
 	
  DB::table('sortv')->insert([[  'sortv_price' => $TotalFareD['0'] , 'sortv_wbsid' => $wbsid  ,   'sortv_airline' => $sairlinestD ,  'sortv_class' => $clasnkD['0']  ,  'sortv_indirect' => $rfse+1 ,  'sortv_airlineflg' => $flgairline ,  'sortv_clasflg' => $flgaclas ,  'sortv_indirectflg' => $indirect ,  'sortv_priceflg' => '1' ]]);  
  }	
  }  
  

 
 
    




//k
 for($k = 1; $k <  $rfse+1   ; $k++){ 
$airlinemark  = explode('"OperatingAirlineName":"', $feldsq[$j]);
$airlinemarkD  = explode('","', $airlinemark[$k]);
$marketlog  = explode('"MarketingAirline":"', $feldsq[$j]);
$marketlogD  = explode('","', $marketlog[$k]); 
$flnk = explode('","FlightNumber":"', $feldsq[$j]);
$flnkD = explode('","ResBookDesigCode":"', $flnk[$k]);
$gole = explode('","OperatingAirline":"', $feldsq[$j]);
$goleD = explode('","MarketingAirline":"', $gole[$k]); 
$clasnk = explode('","ResBookDesigCode":"', $feldsq[$j]);
$clasnkD = explode('","ResBookDesigQuantity":"', $clasnk[$k]);

$citydep = explode(',"DepartureCityCountry":"', $feldsq[$j]);
$citydepD = explode(',', $citydep[$k]);	
$cityarriv = explode(',"ArrivaliCityCountry":"', $feldsq[$j]);
$cityarrivD = explode(',', $cityarriv[$k]);	
$feldsqDk = explode(',"DepartureAirport":"', $feldsq[$j]);
$feldsqDkD = explode('(', $feldsqDk[$k]); 
$feldsqDkar = explode('","ArrivalAirport":"', $feldsq[$j]);
$feldsqDkarD = explode('(', $feldsqDkar[$k]);	
$deptime = explode('"DepartureDateTime":"', $feldsq[$j]);
$deptimeD = explode('","ArrivalDateTime":"', $deptime[$k]);
$artime = explode('","ArrivalDateTime":"', $feldsq[$j]);
$artimeD = explode('","FlightNumber":"', $artime[$k]);	
$originalDate = $deptimeD['0'];
$newDatedep = date("d F", strtotime($originalDate)); $newDatedept = date("H:i", strtotime($originalDate));
$originalDatea = $artimeD['0'];
$newDatearr = date("d F", strtotime($originalDatea)); $newDatearrt = date("H:i", strtotime($originalDatea)); 

$luggage = explode('"Luggage":"', $feldsq[$j]);
$luggageD = explode('","', $luggage[$k]); 

//DB::table('wbss')->insert([['wbssearch' => $wbssearch]]);   

 } } }
 
 
 
 
$wbs=\DB::table('wbs') ->where([['wbs_uuses', '=', Session::get('wbs_uuses')],])->orderBy('id', 'desc')->first(); 

$currency=\DB::table('currency') ->where([['cur_nem', '=', Session::get('curnem')],])->orderBy('id', 'desc')->first();

 return redirect('testnext');
/*
  return view('superadmin.ucack', ['result' => $result , 'lngmenus' => $lngmenus , 'lngmenu' => $lngmenu , 'arrival' => $wbs->wbs_arrival , 'departure' => $wbs->wbs_departure , 'departuredate' => $wbs->wbs_departuredate , 'year' => $year ,  'airports' => $airports , 'adult' => $wbs->wbs_adult , 'child' => $wbs->wbs_child, 'infant' => $wbs->wbs_infant , 'wbs' => $wbs    , 'currency' => $currency  ]);
  */

 
}









public function buyticketyekind(Request $request){
 
$lngmenus= \DB::table('language') ->where([['id', '<>',  '0'],['lng_active', '=',  '1'],])->orderBy('id', 'desc')->get();
$lngmenu=\DB::table('language') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first();   	    

$adult = $request->input('adult'); 
$child = $request->input('child'); 
$infant = $request->input('infant'); 
$departure = $request->input('departure'); 
$arrival = $request->input('arrival'); 
$sessionidD = $request->input('sessionidD'); 
$uu_sessionidD = $request->input('uu_sessionidD');
$hisd = $request->input('hisd');   
 
if($hisd !=NULL){
$total = explode('/', $hisd );
 $seqd=$total['0'];
 $price=$total['1']; 
 $CombinationIDD=$total['2'];
}  

 
    $sess      = filter_var($request->uu_sessionidD, FILTER_SANITIZE_STRING);
    $sessionid      = filter_var($request->sessionidD, FILTER_SANITIZE_STRING);
    $RecommendationID       = $seqd; 
    $genel_toplam       = $price; 
  

$adultbp = $request->input('adultbp'); 
$childbp = $request->input('childbp'); 
$infantbp = $request->input('infantbp'); 

$adultsp = $request->input('adultsp'); 
$childsp = $request->input('childsp'); 
$infantsp = $request->input('infantsp'); 

$adulttp = $request->input('adulttp'); 
$childtp = $request->input('childtp'); 
$infanttp = $request->input('infanttp'); 
    
$updatee = \DB::table('wbs')->where('wbs_uuses', '=', Session::get('wbs_uuses'))  ->update(['wbs_seq' => $seqd , 'wbs_comb' => $CombinationIDD , 'wbs_price' => $price  , 'wbs_hisd' => $hisd  , 'wbs_adtbprice' => $adultbp  , 'wbs_adtsprice' => $adultsp  , 'wbs_adttprice' => $adulttp  , 'wbs_chdbprice' => $childbp  , 'wbs_chdsprice' => $childsp  , 'wbs_chdtprice' => $childtp , 'wbs_infbprice' => $infantbp  , 'wbs_infsprice' => $infantsp  , 'wbs_inftprice' => $infanttp  ]); 		  

 
 
return redirect('buytickets');

 
}




	public function buyticketsind(){
 
$lngmenus= \DB::table('language') ->where([['id', '<>',  '0'],['lng_active', '=',  '1'],])->orderBy('id', 'desc')->get();
$lngmenu=\DB::table('language') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first(); 
 

    
$wbs=\DB::table('wbs') ->where([['wbs_uuses', '=', Session::get('wbs_uuses')],])->orderBy('id', 'desc')->first(); 
$result=$wbs->result;
$wbsid=$wbs->id;

$airports= \DB::table('countries') ->where([['countries_id', '<>',  '0'],])->orderBy('countries_id')->get(); 




        $requestt = '{
            combination_id: "'.$wbs->wbs_comb.'",
            recommandationid: "'.$wbs->wbs_seq.'",
            passengertype: "ADT",
            sessionid: "'.$wbs->wbs_sesid.'",
            providercode: "AMA" 
        }';
        
    
        
    $headers = array(
        'username:atin_user',
        'password:X4fVgT3a',
        'Content-Type:application/json',
        'request:'.$requestt
    );
        //http://88.250.178.229:4545/
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://ucuzauc.com/api/getrules/4e53defd-7620-4ac1-b7e1-61c43f34bb76");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $requestt);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 5);
    curl_setopt($ch, CURLOPT_TIMEOUT, 59);
    curl_setopt($ch, CURLOPT_HEADER, 1);
$resultt = curl_exec($ch); 
  
    DB::table('rulls')->insert([
    [ 'rul_wbsid' => $wbsid , 'rul_rul' => $resultt     ]
]);   


 




$mngindex =  DB::table('mngindex')  ->where('id' , '=' , 1)->orderBy('id')->first(); 
  

$currency=\DB::table('currency') ->where([['cur_nem', '=',  Session::get('curnem')],])->orderBy('id', 'desc')->first();
 
 return view('superadmin.buyticket',['lngmenus' => $lngmenus , 'lngmenu' => $lngmenu, 'hisd' => $wbs->wbs_hisd , 'result' => $result , 'airports' => $airports , 'adult' => $wbs->wbs_adult , 'child' => $wbs->wbs_child , 'infant' => $wbs->wbs_infant , 'departure' => $wbs->wbs_departure , 'arrival' => $wbs->wbs_arrival , 'sessionidDt' => $wbs->wbs_sesid , 'uu_sessionidDt' => $wbs->wbs_uuses  , 'CombinationID' => $wbs->wbs_comb  , 'RecommendationID' => $wbs->wbs_seq  , 'priced' => $wbs->wbs_price , 'ruuls' => $resultt   , 'wbs' => $wbs , 'currency' => $currency , 'mngindex' => $mngindex    ]); 

 
}












 

















public function buyticketyektind(Request $request){
 
$lngmenus= \DB::table('language') ->where([['id', '<>',  '0'],['lng_active', '=',  '1'],])->orderBy('id', 'desc')->get();
$lngmenu=\DB::table('language') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first();   	   
if (Session::has('signsuperadmin')){ Session::set('urlaro', 'superadmin'); } else { Session::set('urlaro', 'indexgds');  }
$this->validate($request,[
    			'email' => 'required|email',
    			'tell' => 'required|min:3|max:33',
    		],[
    			'email.required' => $lngmenu->lng_wemail.' ! '.$lngmenu->lng_wnotelq,
    			'email.email' => $lngmenu->lng_wemail.' ! '.$lngmenu->lng_wnotelq,
    			'tell.required' => $lngmenu->lng_wtell.' ! '.$lngmenu->lng_wnotelq,
    			'tell.min' => $lngmenu->lng_wtell.' ! '.$lngmenu->lng_wnotelq,
    			'tell.max' => $lngmenu->lng_wemail.' ! '.$lngmenu->lng_wnotelq,
    			
    		]);
  

   


$email = $request->input('email'); 
$tell = $request->input('tell'); 
$adult = $request->input('adult'); 
$child = $request->input('child'); 
$infant = $request->input('infant'); 
$departure = $request->input('departure'); 
$arrival = $request->input('arrival'); 
$sessionidD = $request->input('sessionidD'); 
$uu_sessionidD = $request->input('uu_sessionidD');

$priced = $request->input('priced');
$CombinationID = $request->input('CombinationID');
$RecommendationID = $request->input('RecommendationID');
 
 $seqd=$RecommendationID;
 $price=$priced; 
 $CombinationIDD=$CombinationID; 



$genders = $request->input('gender'); 
$names = $request->input('name'); 
$familys = $request->input('family'); 
$days = $request->input('day'); 
$months = $request->input('month'); 
$years = $request->input('year'); 
$ages = $request->input('age');  
$nationals = $request->input('national'); 
$passportnumbers = $request->input('passportnumber');
 
 
$departuredate = $request->input('datepicker'); 

 


 
$wbs=\DB::table('wbs') ->where([['wbs_uuses', '=', Session::get('wbs_uuses')],])->orderBy('id', 'desc')->first(); 
$mngindex=\DB::table('mngindex') ->where([['id', '=', '1'],])->orderBy('id', 'desc')->first(); 
$currency=\DB::table('currency') ->where([['cur_nem', '=',  Session::get('curnem')],])->orderBy('id', 'desc')->first(); 
$paybelc = $currency->cur_rateajency * $price;
$tax=$currency->cur_rateajency * $mngindex->ind_taxp; 
$taxp=$wbs->wbs_adult+$wbs->wbs_child+$wbs->wbs_infant; $taxpc=$taxp*$tax;
$paybel= $taxpc + $paybelc   ;

$bel_sumpricetl=$price + ($taxp*$mngindex->ind_taxp);


$aro=0; $iduser=0;
 if (Session::get('signstudent')!= NULL){ $aro='4'; $iduser=Session::get('idstudent'); } 
 else if (Session::get('signajency')!= NULL) { $aro='3'; $iduser=Session::get('idajency');} 
 else if (Session::get('signsuperadmin')!= NULL) { $aro='1'; $iduser='1';}  

   

 DB::table('belits')->insert([
    ['bel_email'  =>  $email    , 'bel_tell'  => $tell   , 'bel_ses'  => Session::get('wbs_uuses')   ,'bel_basefare'  => $price ,'bel_pay'  => $paybel   , 'bel_sumpricetl'  => $bel_sumpricetl   , 'bel_createdatdate'  => date('Y-m-d H:i:s')  ,  'bel_cur'  => Session::get('curnem') , 'bel_aro'  => $aro   , 'bel_iduser'  => $iduser      ]
]); 


$belits=\DB::table('belits')->where([['bel_ses', '=', Session::get('wbs_uuses')],])->orderBy('bel_id', 'desc')->first();   
$belitid=$belits->bel_id;




    for ($i = 0; $i< count($ages); $i++){
 
 $this->validate($request,[
    			'name.*' => 'required',
    			'family.*' => 'required',
    			'national.*' => 'required',
    			'year.*' => 'required',
    			'month.*' => 'required',
    			'day.*' => 'required',
    			'gender.*' => 'required',
    			'passportnumber.*' => 'required',
    		],[
    			'name.*.required' => $lngmenu->lng_wname.' ! '.$lngmenu->lng_wnotelq,
    			'family.*.required' => 'family'.' ! '.$lngmenu->lng_wnotelq,
    			'national.*.required' => 'national'.' ! '.$lngmenu->lng_wnotelq,
    			'year.*.required' => 'year'.' ! '.$lngmenu->lng_wnotelq,
    			'month.*.required' => 'month'.' ! '.$lngmenu->lng_wnotelq,
    			'day.*.required' => 'day'.' ! '.$lngmenu->lng_wnotelq,
    			'gender.*.required' => 'gender'.' ! '.$lngmenu->lng_wnotelq,
    			'passportnumber.*.required' => 'passportnumber'.' ! '.$lngmenu->lng_wnotelq,
    		 ]);    
    		 
$departuredaten = $wbs->wbs_departuredate ;  
 
 

if($ages[$i]=='CHD'){
$birthchd=date("m/d/Y", strtotime($departuredate[$i]));
$maxchild = date('Y-m-d', strtotime('-12 year', strtotime($departuredaten))) ;
$childage = date('Y-m-d', strtotime('0 day', strtotime($birthchd))) ;
if($childage<$maxchild){ return redirect('buytickets'); }}

if($ages[$i]=='INF'){
$birth=date("m/d/Y", strtotime($departuredate[$i]));
$maxinfant = date('Y-m-d', strtotime('-2 year', strtotime($departuredaten))) ;
$infantage = date('Y-m-d', strtotime('0 day', strtotime($birth))) ;
if($infantage<$maxinfant){ return redirect('buytickets'); }}

$birthdate=date("d.m.Y", strtotime($departuredate[$i]));
$birthdateamr=date("m.d.Y", strtotime($departuredate[$i])); 
 
 
DB::table('passanger')->insert([
    ['pas_name'  =>  $names[$i] ,'pas_family'  => $familys[$i] ,'pas_national'  =>  $nationals[$i] ,'pas_birthdate'  => $birthdate  ,'pas_birthdateamr'  => $birthdateamr , 'pas_passportnumber'  =>  $passportnumbers[$i] ,  'pas_gender'  =>  $genders[$i] ,'pas_type'  => $ages[$i] , 'pas_idbelit'  => $belitid     ]
]); 
 

    
     }




 

$airports= \DB::table('countries') ->where([['countries_id', '<>',  '0'],])->orderBy('countries_id')->get();  
 
    $sess      = filter_var($request->uu_sessionidD, FILTER_SANITIZE_STRING);
    $sessionid      = filter_var($request->sessionidD, FILTER_SANITIZE_STRING);
    $RecommendationID       = $seqd; 
    $genel_toplam       = $price; 
 
 
$wbs=\DB::table('wbs') ->where([['wbs_uuses', '=', Session::get('wbs_uuses')],])->orderBy('id', 'desc')->first(); 
 $result=$wbs->result; $wbssearch=$wbs->id;




$ori = explode("OriginDestinationOptionList,", $result );
$wordChunks = explode('{"Currency":"', $result);
$AirlineCode = explode('"ValidatingAirlineCode":"', $result);
$FlightNumber = explode('"FlightNumber":"', $result);
$ResBookDesigCode = explode('"ResBookDesigCode":"', $result);
$time = explode('"DepartureDateTime":"', $result);
$rezerve = explode('"ResBookDesigQuantity":"', $result);
$Havayolu = explode('"MarketingAirlineName":"', $result);
$TOTALEFARE = explode('"TotalFare":', $result);
$DepartureAirport = explode('"DepartureAirport":"', $result); 
$ArrivalAirport = explode('"ArrivalAirport":"', $result); 
$FlightSegment = explode('FlightSegment', $result); 
$SequenceNumber = explode('SequenceNumber":"', $result); 
 

$hisd = $request->input('hisd');   
  $total = explode('/', $hisd ); 
  $ii=$total['3'];
//$i=$seqd+1;
$i=$ii;
$FlightNumberD = explode('","ResBookDesigCode"', $FlightNumber[$i]);
$ResBookDesigCodeD = explode('","ResBookDesigQuantity"', $ResBookDesigCode[$i]);
$timeD = explode('","ArrivalDateTime"', $time[$i]);
$AirlineCodeD = explode('","ForceETicket":"', $AirlineCode[$i]);
$rezerveD = explode('","DepartureAirport":"', $rezerve[$i]);
$HavayoluD = explode('","Equipment":"', $Havayolu[$i]);
$HavayoluDD = explode('","', $HavayoluD['0']);
$TOTALEFARED = explode(',"ServiceFare":', $TOTALEFARE[$i]);
$DepartureAirportD = explode('","ArrivalAirport":', $DepartureAirport[$i]);
$ArrivalAirportD = explode('","DepartureCityCountry":', $ArrivalAirport[$i]);
$FlightSegmentD = explode('},{"DepartureDateTime":"', $wordChunks[$i]);
$SequenceNumberD = explode('","OriginDestinationOptionList"', $SequenceNumber[$i]);
$flseg=substr_count($SequenceNumber[$i], 'FlightSegment'); 
$flRefNumber=substr_count($SequenceNumber[$i], 'RefNumber');  
$listseg  = explode('","OriginDestinationOptionList"', $wordChunks[$i]); 
$listsegD = explode('","OriginDestinationOptionList"', $listseg['1']);
$refnmD = explode('"RefNumber":"', $listseg['1']); 

$TotalFare = explode(',"TotalFare":', $wordChunks[$i]);
$TotalFareD = explode(',"ServiceFare":', $TotalFare['1']);

                      

$j=$CombinationIDD+1; 

$feldsq  = explode('FlightSegment":[{', $listsegD['0']); 

$refnmsD = explode('FlightSegment', $refnmD[$j]); 
$refnmsND = explode('","DirectionId":"', $refnmsD['0']); 
$ElapsedTime = explode('","ElapsedTime":"', $refnmsD['0']); 
$ElapsedTimeD = explode('","', $ElapsedTime['1']);   
$directsD = explode('","', $ElapsedTime['0']);   
$directsidD = explode('DirectionId":"', $directsD['1']);   


$rfse=substr_count($refnmsD['1'], 'DepartureAirport');   



for($k = 1; $k <  $rfse+1   ; $k++){ 

$airlinemark  = explode('"OperatingAirlineName":"', $refnmsD['1']);
$airlinemarkD  = explode('","', $airlinemark[$k]);

$marketlog  = explode('"MarketingAirline":"', $refnmsD['1']);
$marketlogD  = explode('","', $marketlog[$k]);
       
$airlinemark  = explode('"OperatingAirlineName":"', $refnmsD['1']);
$airlinemarkD  = explode('","', $airlinemark[$k]);

$marketlog  = explode('"MarketingAirline":"', $refnmsD['1']);
$marketlogD  = explode('","', $marketlog[$k]);
 

$flnk = explode('","FlightNumber":"', $refnmsD['1']);
$flnkD = explode('","ResBookDesigCode":"', $flnk[$k]);

    $gole = explode('","OperatingAirline":"', $refnmsD['1']);
$goleD = explode('","MarketingAirline":"', $gole[$k]);  

 
$clasnk = explode('","ResBookDesigCode":"', $refnmsD['1']);
$clasnkD = explode('","ResBookDesigQuantity":"', $clasnk[$k]);


$airlinemark  = explode('"OperatingAirlineName":"', $refnmsD['1']);
$airlinemarkD  = explode('","', $airlinemark[$k]);

$marketlog  = explode('"MarketingAirline":"', $refnmsD['1']);
$marketlogD  = explode('","', $marketlog[$k]);
 

$flnk = explode('","FlightNumber":"', $refnmsD['1']);
$flnkD = explode('","ResBookDesigCode":"', $flnk[$k]);

$gole = explode('","OperatingAirline":"', $refnmsD['1']);
$goleD = explode('","MarketingAirline":"', $gole[$k]); 

$clasnk = explode('","ResBookDesigCode":"', $refnmsD['1']);
$clasnkD = explode('","ResBookDesigQuantity":"', $clasnk[$k]);


$citydep = explode(',"DepartureCityCountry":"', $refnmsD['1']);
$citydepD = explode(',', $citydep[$k]);
if($citydepD['0']=='Tahran'){$citydepD['0']='Tehran';} 
	
$feldsqDk = explode(',"DepartureAirport":"', $refnmsD['1']);
$feldsqDkD = explode('(', $feldsqDk[$k]); 
$feldsqDkDD = explode(')', $feldsqDkD['1']);

$feldsqDkar = explode('","ArrivalAirport":"', $refnmsD['1']);
$feldsqDkarD = explode('(', $feldsqDkar[$k]);	

$deptime = explode('"DepartureDateTime":"', $refnmsD['1']);
$deptimeD = explode('","ArrivalDateTime":"', $deptime[$k]);

$artime = explode('","ArrivalDateTime":"', $refnmsD['1']);
$artimeD = explode('","FlightNumber":"', $artime[$k]);	

 $originalDate = $deptimeD['0'];
$newDatedep = date("d F", strtotime($originalDate)); $newDatedept = date("H:i", strtotime($originalDate)); 

 $originalDatea = $artimeD['0'];
$newDatearr = date("d F", strtotime($originalDatea)); $newDatearrt = date("H:i", strtotime($originalDatea));  


$dir_origindate = explode('T', $deptimeD['0']);
$dir_destdate = explode('T', $artimeD['0']);


$cityarriv = explode(',"ArrivaliCityCountry":"', $refnmsD['1']);
$cityarrivD = explode(',', $cityarriv[$k]); 
if($cityarrivD['0']=='Tahran'){$cityarrivD['0']='Tehran';}

$feldsqDk = explode(',"DepartureAirport":"', $refnmsD['1']);
$feldsqDkD = explode('(', $feldsqDk[$k]);

$feldsqDkar = explode('","ArrivalAirport":"', $refnmsD['1']);
$feldsqDkarD = explode('(', $feldsqDkar[$k]);
$feldsqDkDDa = explode(')', $feldsqDkarD['1']);	

$deptime = explode('"DepartureDateTime":"', $refnmsD['1']);
$deptimeD = explode('","ArrivalDateTime":"', $deptime[$k]);

$artime = explode('","ArrivalDateTime":"', $refnmsD['1']);
$artimeD = explode('","FlightNumber":"', $artime[$k]);	
 $originalDate = $deptimeD['0'];
$newDatedep = date("d F", strtotime($originalDate)); $newDatedept = date("H:i", strtotime($originalDate));   $originalDatea = $artimeD['0'];
$newDatearr = date("d F", strtotime($originalDatea)); $newDatearrt = date("H:i", strtotime($originalDatea));  

$luggage = explode('"Luggage":"', $refnmsD['1']);
$luggageD = explode('","', $luggage[$k]);
/*
$bagg=substr_count($luggageD['0'], 'k');    
if($bagg!='0'){  }
if($bagg=='0'){  $bag = explode('parça', $luggageD['0']);   }
if($bag['0']<9){  $dbbag = $bag['0'].' BAG';}
if($bag['0']>9){  $dbbag = $bag['0'].' KG';}
*/
$dbbag = $luggageD['0'];



 $string=$ElapsedTimeD['0']; $min = '';$h = '';
for ($index=0;$index<strlen($string);$index++) { if($index<2){ $h .= $string[$index]; } else { $min .= $string[$index]; }}

 DB::table('direction')->insert([
    ['dir_idbelit'  =>  $belitid ,'dir_airline'  =>  $airlinemarkD['0']    ,'dir_logo'  => $marketlogD['0']  ,'dir_class'  => $clasnkD['0']  ,'dir_numberflight'  =>  $flnkD['0']  ,  'dir_origin' => $citydepD['0']  , 'dir_origindate'  =>  $dir_origindate['0']  ,  'dir_origintime' => $newDatedept  ,  'dir_dest' => $cityarrivD['0']  , 'dir_destdate'  =>  $dir_destdate['0']  ,  'dir_desttime' => $newDatearrt  , 'dir_originairport'  =>  $feldsqDkD['0']  ,  'dir_originmairport' => $feldsqDkDD['0'] , 'dir_destairport'  =>  $feldsqDkarD['0']  ,  'dir_destmairport' => $feldsqDkDDa['0']  ,'dir_bag'  =>  $dbbag   ,    'dir_durit'  =>  $h.'Hours '.$min.'Minute' ,    'dir_dir'  =>  '0'  ,    ]
]); 




}






$wbs_departure=$wbs->wbs_departure;
$wbs_arrival=$wbs->wbs_arrival;

$countdep=strlen($wbs_departure);
$countarr=strlen($wbs_arrival);

if($countdep=='6'){ 
$codedep = explode('C', $wbs_departure);
$departurer=\DB::table('direction') ->where([['dir_idbelit', '=',  $belitid],['dir_dir', '=',  '0'],])->orderBy('id')->first();
$departure=$departurer->dir_originmairport.$codedep['1']; 
$updatee = \DB::table('wbs')->where('wbs_uuses', '=', Session::get('wbs_uuses'))  ->update([  'wbs_departure' => $departure    ]);  }

if($countarr=='6'){ 
$codearr = explode('C', $wbs_arrival);
$departurer=\DB::table('direction') ->where([['dir_idbelit', '=',  $belitid],['dir_dir', '=',  '0'],])->orderBy('id', 'desc')->first();
$arrival=$departurer->dir_destmairport.$codearr['1']; 
$updatee = \DB::table('wbs')->where('wbs_uuses', '=', Session::get('wbs_uuses'))  ->update(['wbs_arrival' => $arrival     ]); }
 

 








$wents=\DB::table('direction') ->where([['dir_idbelit', '=',  $belitid],['dir_dir', '=',  '0'],])->orderBy('id')->get(); 
$wentc=\DB::table('direction') ->where([['dir_idbelit', '=',  $belitid],['dir_dir', '=',  '0'],])->orderBy('id')->count();    
$belits=\DB::table('belits') ->where([['bel_id', '=',  $belitid],['bel_id', '<>',  '0'],])->orderBy('bel_id')->first();
$passangers=\DB::table('passanger') ->where([['pas_idbelit', '=',  $belitid],['id', '<>',  '0'],])->orderBy('id')->get();  


$wbs=\DB::table('wbs') ->where([['wbs_uuses', '=', Session::get('wbs_uuses')],])->orderBy('id', 'desc')->first(); 

$currency=\DB::table('currency') ->where([['cur_nem', '=',  Session::get('curnem')],])->orderBy('id', 'desc')->first();



$aro=0; $iduser=0;
 if (Session::get('signstudent')!= NULL){ $aro='4'; $iduser=Session::get('idstudent'); } 
 else if (Session::get('signajency')!= NULL) { $aro='3'; $iduser=Session::get('idajency');} 
 else if (Session::get('signsuperadmin')!= NULL) { $aro='1'; $iduser='1';}  


 



//mycharge 
$charges = \DB::table('ajency') 
->join('charge', 'ajency.id', '=', 'charge.charge_iduser') 
->join('finicals', 'charge.charge_finical', '=', 'finicals.id') 
->where([
    ['charge.charge_arou', '=', $aro],
    ['charge.charge_iduser', '=', $iduser],
    ['finicals.finical_payment', '=', 1],
    ['finicals.finical_inc', '=', 5],])
    ->orderBy('charge.charge_id', 'desc')->get();
$chargepaymy=0;
foreach($charges as $charge){ $chargepaymy=$charge->charge_pay+$chargepaymy; }




 //supcharge  
$charges = \DB::table('ajency') 
->join('charge', 'ajency.id', '=', 'charge.charge_iduser') 
->join('finicals', 'charge.charge_finical', '=', 'finicals.id') 
->where([
    ['charge.charge_arou', '=', $aro],
    ['charge.charge_iduser', '=', $iduser],
    ['finicals.finical_payment', '=', 1],
    ['finicals.finical_inc', '=', 6],])
    ->orderBy('charge.charge_id', 'desc')->get();
$chargepaysup=0;
foreach($charges as $charge){ $chargepaysup=$charge->charge_pay+$chargepaysup; }



 //odat  
$charges = \DB::table('ajency') 
->join('charge', 'ajency.id', '=', 'charge.charge_iduser') 
->join('finicals', 'charge.charge_finical', '=', 'finicals.id') 
->where([
    ['charge.charge_arou', '=', $aro],
    ['charge.charge_iduser', '=', $iduser],
    ['finicals.finical_payment', '=', 1],
    ['finicals.finical_inc', '=', 7],])
    ->orderBy('charge.charge_id', 'desc')->get();
$chargepayodat=0;
foreach($charges as $charge){ $chargepayodat=$charge->charge_pay+$chargepayodat; }




//pardakht 
$charges = \DB::table('ajency') 
->join('charge', 'ajency.id', '=', 'charge.charge_iduser') 
->join('finicals', 'charge.charge_finical', '=', 'finicals.id') 
->where([
    ['charge.charge_arou', '=', $aro],
    ['charge.charge_iduser', '=', $iduser],
    ['finicals.finical_payment', '=', 1],
    ['finicals.finical_inc', '=', 3],])
    ->orderBy('charge.charge_id', 'desc')->get();
$chargepaypar=0;
foreach($charges as $charge){ $chargepaypar=$charge->charge_pay+$chargepaypar; }


//jamkol
$chargepay= ($chargepaysup +  $chargepaymy + $chargepayodat ) -  $chargepaypar  ; 


$currencyrial=\DB::table('currency') ->where([['cur_nem', '=',  'RIAL'],])->orderBy('id', 'desc')->first();
$currencyusd=\DB::table('currency') ->where([['cur_nem', '=',  'USD'],])->orderBy('id', 'desc')->first();

   









return view('superadmin.buyticketok',['lngmenus' => $lngmenus , 'lngmenu' => $lngmenu,  'result' => $result   ,   'departure' => $departure , 'arrival' => $arrival , 'sessionidDt' => $sessionidD , 'uu_sessionidDt' => $uu_sessionidD  , 'CombinationID' => $CombinationIDD  , 'RecommendationID' => $seqd  , 'priced' => $price , 'wents' => $wents , 'wentc' => $wentc  ,  'belits' => $belits ,  'passangers' => $passangers ,  'wbs' => $wbs  ,  'mngindex' => $mngindex  , 'currency' => $currency , 'chargepay' => $chargepay 
  , 'currencyrial' => $currencyrial  , 'currencyusd' => $currencyusd      ]);
 


 

 
}






	public function viewsearchwentbackind(){
 
$lngmenus= \DB::table('language') ->where([['id', '<>',  '0'],['lng_active', '=',  '1'],])->orderBy('id', 'desc')->get();
$lngmenu=\DB::table('language') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first(); 
 
$wbs=\DB::table('wbs') ->where([['wbs_uuses', '=', Session::get('wbs_uuses')],])->orderBy('id', 'desc')->first(); 
$result=$wbs->result; $wbssearch=$wbs->id; 
$comids=  \DB::table('comid') ->where([['wbssearch', '=',  $wbssearch],])->orderBy('id')->get(); 

$airports= \DB::table('countries') ->where([['countries_id', '<>',  '0'],])->orderBy('countries_id')->get(); 
 
 

    
$datenew = explode(" ", $wbs->wbs_departuredate);   $monthh=$datenew['1']; $dayn=$datenew['2'];  $yearn=$datenew['3'];   
if($monthh=='Jan'){ $monthn='01';} else if($monthh=='Feb'){ $monthn='02';}  else if($monthh=='Mar'){ $monthn='03';}   else if($monthh=='Apr'){ $monthn='04';} else if($monthh=='May'){ $monthn='05';}  else if($monthh=='Jun'){ $monthn='06';}   else if($monthh=='Jul'){ $monthn='07';} else if($monthh=='Aug'){ $monthn='08';}  else if($monthh=='Sep'){ $monthn='09';}   else if($monthh=='Oct'){ $monthn='10';} else if($monthh=='Nov'){ $monthn='11';}  else if($monthh=='Dec'){ $monthn='12';} 
$year = $dayn.'.'.$monthn.'.'.$yearn.''; 


$datenewr = explode(" ", $wbs->wbs_departuredater);   $monthr=$datenewr['1']; $dayr=$datenewr['2'];  $yearrn=$datenewr['3'];   
if($monthr=='Jan'){ $montrn='01';} else if($monthr=='Feb'){ $montrn='02';}  else if($monthr=='Mar'){ $montrn='03';}   else if($monthr=='Apr'){ $montrn='04';} else if($monthr=='May'){ $montrn='05';}  else if($monthr=='Jun'){ $montrn='06';}   else if($monthr=='Jul'){ $montrn='07';} else if($monthr=='Aug'){ $montrn='08';}  else if($monthr=='Sep'){ $montrn='09';}   else if($monthr=='Oct'){ $montrn='10';} else if($monthr=='Nov'){ $montrn='11';}  else if($monthr=='Dec'){ $montrn='12';} 
$yearr = $dayr.'.'.$montrn.'.'.$yearrn.''; 

  
 

$currency=\DB::table('currency') ->where([['cur_nem', '=',  Session::get('curnem')],])->orderBy('id', 'desc')->first();
 
  return view('superadmin.ucackreturn', ['result' => $result , 'lngmenus' => $lngmenus , 'lngmenu' => $lngmenu , 'arrival' => $wbs->wbs_arrival , 'departure' => $wbs->wbs_departure , 'departuredate' => $wbs->wbs_departuredate,'departuredater' => $wbs->wbs_departuredater , 'year' => $year ,'yearr' => $yearr, 'airports' => $airports , 'adult' => $wbs->wbs_adult , 'child' => $wbs->wbs_child, 'infant' => $wbs->wbs_infant , 'wbs' => $wbs  , 'comids' => $comids  , 'currency' => $currency  ]);

 
}




public function buyticketyekreturnind(Request $request){
 
$lngmenus= \DB::table('language') ->where([['id', '<>',  '0'],['lng_active', '=',  '1'],])->orderBy('id', 'desc')->get();
$lngmenu=\DB::table('language') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first();   	    


$adult = $request->input('adult'); 
$child = $request->input('child'); 
$infant = $request->input('infant'); 
$departure = $request->input('departure'); 
$arrival = $request->input('arrival'); 
$sessionidD = $request->input('sessionidD'); 
$uu_sessionidD = $request->input('uu_sessionidD');
$hisd = $request->input('hisd');   
 
if($hisd !=NULL){
$total = explode('/', $hisd );
 $seqd=$total['0'];
 $price=$total['1']; 
 $CombinationIDD=$total['2'];
 $went=$total['3'];
 $back=$total['4'];
}  




 


    $sess      = filter_var($request->uu_sessionidD, FILTER_SANITIZE_STRING);
    $sessionid      = filter_var($request->sessionidD, FILTER_SANITIZE_STRING);
    $RecommendationID       = $seqd; 
    $genel_toplam       = $price; 


$adultbp = $request->input('adultbp'); 
$childbp = $request->input('childbp'); 
$infantbp = $request->input('infantbp'); 

$adultsp = $request->input('adultsp'); 
$childsp = $request->input('childsp'); 
$infantsp = $request->input('infantsp'); 

$adulttp = $request->input('adulttp'); 
$childtp = $request->input('childtp'); 
$infanttp = $request->input('infanttp'); 
    
$updatee = \DB::table('wbs')->where('wbs_uuses', '=', Session::get('wbs_uuses'))  ->update(['wbs_seq' => $seqd , 'wbs_comb' => $CombinationIDD , 'wbs_price' => $price  , 'wbs_hisd' => $hisd  , 'wbs_adtbprice' => $adultbp  , 'wbs_adtsprice' => $adultsp  , 'wbs_adttprice' => $adulttp  , 'wbs_chdbprice' => $childbp  , 'wbs_chdsprice' => $childsp  , 'wbs_chdtprice' => $childtp , 'wbs_infbprice' => $infantbp  , 'wbs_infsprice' => $infantsp  , 'wbs_inftprice' => $infanttp  ]); 		  


    
    

$airports= \DB::table('countries') ->where([['countries_id', '<>',  '0'],])->orderBy('countries_id')->get();  
 	  

return redirect('buyticketsreturn');    


 
}





	public function buyticketsyekreturnind(){
 
$lngmenus= \DB::table('language') ->where([['id', '<>',  '0'],['lng_active', '=',  '1'],])->orderBy('id', 'desc')->get();
$lngmenu=\DB::table('language') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first(); 
    
$wbs=\DB::table('wbs') ->where([['wbs_uuses', '=', Session::get('wbs_uuses')],])->orderBy('id', 'desc')->first(); 
$result=$wbs->result;

$airports= \DB::table('countries') ->where([['countries_id', '<>',  '0'],])->orderBy('countries_id')->get();  
 
 
        $requestt = '{
            combination_id: "'.$wbs->wbs_comb.'",
            recommandationid: "'.$wbs->wbs_seq.'",
            passengertype: "ADT",
            sessionid: "'.$wbs->wbs_sesid.'",
            providercode: "AMA" 
        }';
        
    
        
    $headers = array(
        'username:atin_user',
        'password:X4fVgT3a',
        'Content-Type:application/json',
        'request:'.$requestt
    );
        
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://ucuzauc.com/api/getrules/4e53defd-7620-4ac1-b7e1-61c43f34bb76");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $requestt);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 5);
    curl_setopt($ch, CURLOPT_TIMEOUT, 59);
    curl_setopt($ch, CURLOPT_HEADER, 1);
$resultt = curl_exec($ch); 



 





$mngindex =  DB::table('mngindex')  ->where('id' , '=' , 1)->orderBy('id')->first(); 
 

$currency=\DB::table('currency') ->where([['cur_nem', '=',  Session::get('curnem')],])->orderBy('id', 'desc')->first();

 
 return view('superadmin.buyticketreturn',['lngmenus' => $lngmenus , 'lngmenu' => $lngmenu, 'hisd' => $wbs->wbs_hisd , 'result' => $result , 'airports' => $airports , 'adult' => $wbs->wbs_adult , 'child' => $wbs->wbs_child , 'infant' => $wbs->wbs_infant , 'departure' => $wbs->wbs_departure , 'arrival' => $wbs->wbs_arrival , 'sessionidDt' => $wbs->wbs_sesid , 'uu_sessionidDt' => $wbs->wbs_uuses  , 'CombinationID' => $wbs->wbs_comb  , 'RecommendationID' => $wbs->wbs_seq  , 'priced' => $wbs->wbs_price  , 'ruuls' => $resultt  , 'wbs' => $wbs  , 'currency' => $currency, 'mngindex' => $mngindex   
   ]); 



 
}




public function buyticketyekpasngrtind(Request $request){
 
$lngmenus= \DB::table('language') ->where([['id', '<>',  '0'],['lng_active', '=',  '1'],])->orderBy('id', 'desc')->get();
$lngmenu=\DB::table('language') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first();   	    
if (Session::has('signsuperadmin')){ Session::set('urlaro', 'superadmin'); } else { Session::set('urlaro', 'indexgds');  }
$this->validate($request,[
    			'email' => 'required|email',
    			'tell' => 'required|min:3|max:33',
    		],[
    			'email.required' => $lngmenu->lng_wemail.' ! '.$lngmenu->lng_wnotelq,
    			'email.email' => $lngmenu->lng_wemail.' ! '.$lngmenu->lng_wnotelq,
    			'tell.required' => $lngmenu->lng_wtell.' ! '.$lngmenu->lng_wnotelq,
    			'tell.min' => $lngmenu->lng_wtell.' ! '.$lngmenu->lng_wnotelq,
    			'tell.max' => $lngmenu->lng_wemail.' ! '.$lngmenu->lng_wnotelq,
    			
    		]);
    


$email = $request->input('email'); 
$tell = $request->input('tell'); 
$adult = $request->input('adult'); 
$child = $request->input('child'); 
$infant = $request->input('infant'); 
$departure = $request->input('departure'); 
$arrival = $request->input('arrival'); 
$sessionidD = $request->input('sessionidD'); 
$uu_sessionidD = $request->input('uu_sessionidD');


$hisd = $request->input('hisd');   
 
if($hisd !=NULL){
$total = explode('/', $hisd );
 $seqd=$total['0'];
 $price=$total['1']; 
 $CombinationIDD=$total['2'];
 $went=$total['3'];
 $back=$total['4'];
 $ii=$total['5'];
}  




$genders = $request->input('gender'); 
$names = $request->input('name'); 
$familys = $request->input('family'); 
$days = $request->input('day'); 
$months = $request->input('month'); 
$years = $request->input('year'); 
$ages = $request->input('age');  
$nationals = $request->input('national'); 
$passportnumbers = $request->input('passportnumber');

$departuredate = $request->input('datepicker');




$wbs=\DB::table('wbs') ->where([['wbs_uuses', '=', Session::get('wbs_uuses')],])->orderBy('id', 'desc')->first(); 
$mngindex=\DB::table('mngindex') ->where([['id', '=', '1'],])->orderBy('id', 'desc')->first(); 
$currency=\DB::table('currency') ->where([['cur_nem', '=',  Session::get('curnem')],])->orderBy('id', 'desc')->first(); 
  

$paybelc = $currency->cur_rateajency * $price;
$tax=$currency->cur_rateajency * $mngindex->ind_taxp; 
$taxp=$wbs->wbs_adult+$wbs->wbs_child+$wbs->wbs_infant; $taxpc=$taxp*$tax;
$paybel=  $taxpc + $paybelc  ;

$bel_sumpricetl=$price + ($taxp*$mngindex->ind_taxp);

$aro=0; $iduser=0;
 if (Session::get('signstudent')!= NULL){ $aro='4'; $iduser=Session::get('idstudent'); } 
 else if (Session::get('signajency')!= NULL) { $aro='3'; $iduser=Session::get('idajency');} 
 else if (Session::get('signsuperadmin')!= NULL) { $aro='1'; $iduser='1';}  


 DB::table('belits')->insert([
    ['bel_email'  =>  $email    , 'bel_tell'  => $tell   , 'bel_ses'  => Session::get('wbs_uuses')   ,'bel_basefare'  => $price ,'bel_pay'  => $paybel, 'bel_sumpricetl'  => $bel_sumpricetl   , 'bel_createdatdate'  => date('Y-m-d H:i:s')  ,  'bel_cur'  => Session::get('curnem') , 'bel_aro'  => $aro   , 'bel_iduser'  => $iduser         ]
]); 


$belits=\DB::table('belits')->where([['bel_ses', '=', Session::get('wbs_uuses')],])->orderBy('bel_id', 'desc')->first();   
$belitid=$belits->bel_id;









    for ($i = 0; $i< count($ages); $i++){
 

 $this->validate($request,[
    			'name.*' => 'required',
    			'family.*' => 'required',
    			'national.*' => 'required',
    			'year.*' => 'required',
    			'month.*' => 'required',
    			'day.*' => 'required',
    			'gender.*' => 'required',
    			'passportnumber.*' => 'required',
    		],[
    			'name.*.required' => $lngmenu->lng_wname.' ! '.$lngmenu->lng_wnotelq,
    			'family.*.required' => 'family'.' ! '.$lngmenu->lng_wnotelq,
    			'national.*.required' => 'national'.' ! '.$lngmenu->lng_wnotelq,
    			'year.*.required' => 'year'.' ! '.$lngmenu->lng_wnotelq,
    			'month.*.required' => 'month'.' ! '.$lngmenu->lng_wnotelq,
    			'day.*.required' => 'day'.' ! '.$lngmenu->lng_wnotelq,
    			'gender.*.required' => 'gender'.' ! '.$lngmenu->lng_wnotelq,
    			'passportnumber.*.required' => 'passportnumber'.' ! '.$lngmenu->lng_wnotelq,
    		 ]);    
    		 
$departuredaten = $wbs->wbs_departuredate ;  
 
 

if($ages[$i]=='CHD'){
$birthchd=date("m/d/Y", strtotime($departuredate[$i]));
$maxchild = date('Y-m-d', strtotime('-12 year', strtotime($departuredaten))) ;
$childage = date('Y-m-d', strtotime('0 day', strtotime($birthchd))) ;
if($childage<$maxchild){ return redirect('buytickets'); }}

if($ages[$i]=='INF'){
$birth=date("m/d/Y", strtotime($departuredate[$i]));
$maxinfant = date('Y-m-d', strtotime('-2 year', strtotime($departuredaten))) ;
$infantage = date('Y-m-d', strtotime('0 day', strtotime($birth))) ;
if($infantage<$maxinfant){ return redirect('buytickets'); }}

$birthdate=date("d.m.Y", strtotime($departuredate[$i]));
$birthdateamr=date("m.d.Y", strtotime($departuredate[$i]));


DB::table('passanger')->insert([
    ['pas_name'  =>  $names[$i] ,'pas_family'  => $familys[$i] ,'pas_national'  =>  $nationals[$i] ,'pas_birthdate'  => $birthdate ,'pas_birthdate'  => $birthdate  ,'pas_birthdateamr', 'pas_passportnumber'  =>  $passportnumbers[$i] ,  'pas_gender'  =>  $genders[$i] ,'pas_type'  => $ages[$i] , 'pas_idbelit'  => $belitid     ]
]); 
 

    
     }




 

$airports= \DB::table('countries') ->where([['countries_id', '<>',  '0'],])->orderBy('countries_id')->get();  
 
    $sess      = filter_var($request->uu_sessionidD, FILTER_SANITIZE_STRING);
    $sessionid      = filter_var($request->sessionidD, FILTER_SANITIZE_STRING);
    $RecommendationID       = $seqd; 
    $genel_toplam       = $price; 
 
 
$wbs=\DB::table('wbs') ->where([['wbs_uuses', '=', Session::get('wbs_uuses')],])->orderBy('id', 'desc')->first();  
 $result=$wbs->result; $wbssearch=$wbs->id;


$ori = explode("OriginDestinationOptionList,", $result );
$wordChunks = explode('{"Currency":"', $result);
$SequenceNumber = explode('SequenceNumber":"', $result);
$sessionid = explode('","sessionid":"', $result);
$sessionidD = explode('","', $sessionid['1']);
$sessionidD = $sessionidD['0'];
$uu_sessionid = explode('"uu_SessionId":"' , $result);
$uu_sessionidD = explode('","sessionid":"' , $uu_sessionid['1']);
$uu_sessionidD = $uu_sessionidD['0'];

//$i=$seqd+1;
 $i=$ii+1;
 
$SequenceNumberD = explode('","OriginDestinationOptionList"', $SequenceNumber[$i]);
$listseg  = explode('","OriginDestinationOptionList"', $wordChunks[$i]); 
$listsegD = explode('","OriginDestinationOptionList"', $listseg['1']); 
$TotalFare = explode(',"TotalFare":', $wordChunks[$i]);
$TotalFareD = explode(',"ServiceFare":', $TotalFare['1']);


$refnmD = explode('"RefNumber":"'.$went.'","DirectionId":"0",', $listseg['1']); 

$feldsq  = explode('FlightSegment":[{', $listsegD['0']); 
$refnmsD = explode('FlightSegment', $refnmD['1']); 
$ElapsedTime = explode('ElapsedTime":"', $refnmsD['0']); 
$ElapsedTimeD = explode('","', $ElapsedTime['1']);   
$rfse=substr_count($refnmsD['1'], 'DepartureAirport');

$SequenceNumberD = explode('","OriginDestinationOptionList"', $SequenceNumber[$i]);
$listseg  = explode('","OriginDestinationOptionList"', $wordChunks[$i]); 
$listsegD = explode('","OriginDestinationOptionList"', $listseg['1']); 
$TotalFare = explode(',"TotalFare":', $wordChunks[$i]);
$TotalFareD = explode(',"ServiceFare":', $TotalFare['1']);

$refnmD = explode('"RefNumber":"'.$went.'","DirectionId":"0",', $listseg['1']); 


$feldsq  = explode('FlightSegment":[{', $listsegD['0']); 
$refnmsD = explode('FlightSegment', $refnmD['1']); 
$ElapsedTime = explode('ElapsedTime":"', $refnmsD['0']); 
$ElapsedTimeD = explode('","', $ElapsedTime['1']);   
$rfse=substr_count($refnmsD['1'], 'DepartureAirport');

for($k = 1; $k <  $rfse+1   ; $k++){ 

$airlinemark  = explode('"OperatingAirlineName":"', $refnmsD['1']);
$airlinemarkD  = explode('","', $airlinemark[$k]);

$marketlog  = explode('"MarketingAirline":"', $refnmsD['1']);
$marketlogD  = explode('","', $marketlog[$k]);
       
$airlinemark  = explode('"OperatingAirlineName":"', $refnmsD['1']);
$airlinemarkD  = explode('","', $airlinemark[$k]);

$marketlog  = explode('"MarketingAirline":"', $refnmsD['1']);
$marketlogD  = explode('","', $marketlog[$k]);
 

$flnk = explode('","FlightNumber":"', $refnmsD['1']);
$flnkD = explode('","ResBookDesigCode":"', $flnk[$k]);

    $gole = explode('","OperatingAirline":"', $refnmsD['1']);
$goleD = explode('","MarketingAirline":"', $gole[$k]);  

 
$clasnk = explode('","ResBookDesigCode":"', $refnmsD['1']);
$clasnkD = explode('","ResBookDesigQuantity":"', $clasnk[$k]);


$airlinemark  = explode('"OperatingAirlineName":"', $refnmsD['1']);
$airlinemarkD  = explode('","', $airlinemark[$k]);

$marketlog  = explode('"MarketingAirline":"', $refnmsD['1']);
$marketlogD  = explode('","', $marketlog[$k]);
 

$flnk = explode('","FlightNumber":"', $refnmsD['1']);
$flnkD = explode('","ResBookDesigCode":"', $flnk[$k]);

$gole = explode('","OperatingAirline":"', $refnmsD['1']);
$goleD = explode('","MarketingAirline":"', $gole[$k]); 

$clasnk = explode('","ResBookDesigCode":"', $refnmsD['1']);
$clasnkD = explode('","ResBookDesigQuantity":"', $clasnk[$k]);


$citydep = explode(',"DepartureCityCountry":"', $refnmsD['1']);
$citydepD = explode(',', $citydep[$k]);
if($citydepD['0']=='Tahran'){$citydepD['0']='Tehran';} 
	
$feldsqDk = explode(',"DepartureAirport":"', $refnmsD['1']);
$feldsqDkD = explode('(', $feldsqDk[$k]); 
$feldsqDkDD = explode(')', $feldsqDkD['1']);

$feldsqDkar = explode('","ArrivalAirport":"', $refnmsD['1']);
$feldsqDkarD = explode('(', $feldsqDkar[$k]);	

$deptime = explode('"DepartureDateTime":"', $refnmsD['1']);
$deptimeD = explode('","ArrivalDateTime":"', $deptime[$k]);

$artime = explode('","ArrivalDateTime":"', $refnmsD['1']);
$artimeD = explode('","FlightNumber":"', $artime[$k]);	

 $originalDate = $deptimeD['0'];
$newDatedep = date("d F", strtotime($originalDate)); $newDatedept = date("H:i", strtotime($originalDate)); 

 $originalDatea = $artimeD['0'];
$newDatearr = date("d F", strtotime($originalDatea)); $newDatearrt = date("H:i", strtotime($originalDatea));  


$dir_origindate = explode('T', $deptimeD['0']);
$dir_destdate = explode('T', $artimeD['0']);


$cityarriv = explode(',"ArrivaliCityCountry":"', $refnmsD['1']);
$cityarrivD = explode(',', $cityarriv[$k]); 
if($cityarrivD['0']=='Tahran'){$cityarrivD['0']='Tehran';}

$feldsqDk = explode(',"DepartureAirport":"', $refnmsD['1']);
$feldsqDkD = explode('(', $feldsqDk[$k]);

$feldsqDkar = explode('","ArrivalAirport":"', $refnmsD['1']);
$feldsqDkarD = explode('(', $feldsqDkar[$k]);
$feldsqDkDDa = explode(')', $feldsqDkarD['1']);	

$deptime = explode('"DepartureDateTime":"', $refnmsD['1']);
$deptimeD = explode('","ArrivalDateTime":"', $deptime[$k]);

$artime = explode('","ArrivalDateTime":"', $refnmsD['1']);
$artimeD = explode('","FlightNumber":"', $artime[$k]);	
 $originalDate = $deptimeD['0'];
$newDatedep = date("d F", strtotime($originalDate)); $newDatedept = date("H:i", strtotime($originalDate));   $originalDatea = $artimeD['0'];
$newDatearr = date("d F", strtotime($originalDatea)); $newDatearrt = date("H:i", strtotime($originalDatea));  

$luggage = explode('"Luggage":"', $refnmsD['1']);
$luggageD = explode('","', $luggage[$k]);
/*
$bagg=substr_count($luggageD['0'], 'k');    
if($bagg!='0'){  }
if($bagg=='0'){  $bag = explode('parça', $luggageD['0']);   }
if($bag['0']<9){  $dbbag = $bag['0'].' BAG';}
if($bag['0']>9){  $dbbag = $bag['0'].' KG';}
*/
$dbbag = $luggageD['0'];





 $string=$ElapsedTimeD['0']; $min = '';$h = '';
for ($index=0;$index<strlen($string);$index++) { if($index<2){ $h .= $string[$index]; } else { $min .= $string[$index]; }}

 DB::table('direction')->insert([
    ['dir_idbelit'  =>  $belitid ,'dir_airline'  =>  $airlinemarkD['0']    ,'dir_logo'  => $marketlogD['0']  ,'dir_class'  => $clasnkD['0']  ,'dir_numberflight'  =>  $flnkD['0']  ,  'dir_origin' => $citydepD['0']  , 'dir_origindate'  =>  $dir_origindate['0']  ,  'dir_origintime' => $newDatedept  ,  'dir_dest' => $cityarrivD['0']  , 'dir_destdate'  =>  $dir_destdate['0']  ,  'dir_desttime' => $newDatearrt  , 'dir_originairport'  =>  $feldsqDkD['0']  ,  'dir_originmairport' => $feldsqDkDD['0'] , 'dir_destairport'  =>  $feldsqDkarD['0']  ,  'dir_destmairport' => $feldsqDkDDa['0']  , 'dir_bag'  =>  $dbbag   ,    'dir_durit'  =>  $h.'Hours '.$min.'Minute' ,    'dir_dir'  =>  '0'  ,    ]
]); 

}




$wbs_departure=$wbs->wbs_departure;
$wbs_arrival=$wbs->wbs_arrival;

$countdep=strlen($wbs_departure);
$countarr=strlen($wbs_arrival);

if($countdep=='6'){ 
$codedep = explode('C', $wbs_departure);
$departurer=\DB::table('direction') ->where([['dir_idbelit', '=',  $belitid],['dir_dir', '=',  '0'],])->orderBy('id')->first();
$departure=$departurer->dir_originmairport.$codedep['1']; 
$updatee = \DB::table('wbs')->where('wbs_uuses', '=', Session::get('wbs_uuses'))  ->update([  'wbs_departure' => $departure    ]);  }

if($countarr=='6'){ 
$codearr = explode('C', $wbs_arrival);
$departurer=\DB::table('direction') ->where([['dir_idbelit', '=',  $belitid],['dir_dir', '=',  '0'],])->orderBy('id', 'desc')->first();
$arrival=$departurer->dir_destmairport.$codearr['1']; 
$updatee = \DB::table('wbs')->where('wbs_uuses', '=', Session::get('wbs_uuses'))  ->update(['wbs_arrival' => $arrival     ]); }
 

 










$refnmD = explode('"RefNumber":"'.$back.'","DirectionId":"1",', $listseg['1']); 

$feldsq  = explode('FlightSegment":[{', $listsegD['0']); 
$refnmsD = explode('FlightSegment', $refnmD['1']); 
$ElapsedTime = explode('ElapsedTime":"', $refnmsD['0']); 
$ElapsedTimeD = explode('","', $ElapsedTime['1']);   
$rfse=substr_count($refnmsD['1'], 'DepartureAirport');

$SequenceNumberD = explode('","OriginDestinationOptionList"', $SequenceNumber[$i]);
$listseg  = explode('","OriginDestinationOptionList"', $wordChunks[$i]); 
$listsegD = explode('","OriginDestinationOptionList"', $listseg['1']); 
$TotalFare = explode(',"TotalFare":', $wordChunks[$i]);
$TotalFareD = explode(',"ServiceFare":', $TotalFare['1']);

$refnmD = explode('"RefNumber":"'.$back.'","DirectionId":"1",', $listseg['1']); 


$feldsq  = explode('FlightSegment":[{', $listsegD['0']); 
$refnmsD = explode('FlightSegment', $refnmD['1']); 
$ElapsedTime = explode('ElapsedTime":"', $refnmsD['0']); 
$ElapsedTimeD = explode('","', $ElapsedTime['1']);   
$rfse=substr_count($refnmsD['1'], 'DepartureAirport');

for($k = 1; $k <  $rfse+1   ; $k++){ 

$airlinemark  = explode('"OperatingAirlineName":"', $refnmsD['1']);
$airlinemarkD  = explode('","', $airlinemark[$k]);

$marketlog  = explode('"MarketingAirline":"', $refnmsD['1']);
$marketlogD  = explode('","', $marketlog[$k]);
       
$airlinemark  = explode('"OperatingAirlineName":"', $refnmsD['1']);
$airlinemarkD  = explode('","', $airlinemark[$k]);

$marketlog  = explode('"MarketingAirline":"', $refnmsD['1']);
$marketlogD  = explode('","', $marketlog[$k]);
 

$flnk = explode('","FlightNumber":"', $refnmsD['1']);
$flnkD = explode('","ResBookDesigCode":"', $flnk[$k]);

    $gole = explode('","OperatingAirline":"', $refnmsD['1']);
$goleD = explode('","MarketingAirline":"', $gole[$k]);  

 
$clasnk = explode('","ResBookDesigCode":"', $refnmsD['1']);
$clasnkD = explode('","ResBookDesigQuantity":"', $clasnk[$k]);


$airlinemark  = explode('"OperatingAirlineName":"', $refnmsD['1']);
$airlinemarkD  = explode('","', $airlinemark[$k]);

$marketlog  = explode('"MarketingAirline":"', $refnmsD['1']);
$marketlogD  = explode('","', $marketlog[$k]);
 

$flnk = explode('","FlightNumber":"', $refnmsD['1']);
$flnkD = explode('","ResBookDesigCode":"', $flnk[$k]);

$gole = explode('","OperatingAirline":"', $refnmsD['1']);
$goleD = explode('","MarketingAirline":"', $gole[$k]); 

$clasnk = explode('","ResBookDesigCode":"', $refnmsD['1']);
$clasnkD = explode('","ResBookDesigQuantity":"', $clasnk[$k]);


$citydep = explode(',"DepartureCityCountry":"', $refnmsD['1']);
$citydepD = explode(',', $citydep[$k]);
if($citydepD['0']=='Tahran'){$citydepD['0']='Tehran';} 
	
$feldsqDk = explode(',"DepartureAirport":"', $refnmsD['1']);
$feldsqDkD = explode('(', $feldsqDk[$k]); 
$feldsqDkDD = explode(')', $feldsqDkD['1']);

$feldsqDkar = explode('","ArrivalAirport":"', $refnmsD['1']);
$feldsqDkarD = explode('(', $feldsqDkar[$k]);	

$deptime = explode('"DepartureDateTime":"', $refnmsD['1']);
$deptimeD = explode('","ArrivalDateTime":"', $deptime[$k]);

$artime = explode('","ArrivalDateTime":"', $refnmsD['1']);
$artimeD = explode('","FlightNumber":"', $artime[$k]);	

 $originalDate = $deptimeD['0'];
$newDatedep = date("d F", strtotime($originalDate)); $newDatedept = date("H:i", strtotime($originalDate)); 

 $originalDatea = $artimeD['0'];
$newDatearr = date("d F", strtotime($originalDatea)); $newDatearrt = date("H:i", strtotime($originalDatea));  


$dir_origindate = explode('T', $deptimeD['0']);
$dir_destdate = explode('T', $artimeD['0']);


$cityarriv = explode(',"ArrivaliCityCountry":"', $refnmsD['1']);
$cityarrivD = explode(',', $cityarriv[$k]); 
if($cityarrivD['0']=='Tahran'){$cityarrivD['0']='Tehran';}

$feldsqDk = explode(',"DepartureAirport":"', $refnmsD['1']);
$feldsqDkD = explode('(', $feldsqDk[$k]);

$feldsqDkar = explode('","ArrivalAirport":"', $refnmsD['1']);
$feldsqDkarD = explode('(', $feldsqDkar[$k]);
$feldsqDkDDa = explode(')', $feldsqDkarD['1']);	

$deptime = explode('"DepartureDateTime":"', $refnmsD['1']);
$deptimeD = explode('","ArrivalDateTime":"', $deptime[$k]);

$artime = explode('","ArrivalDateTime":"', $refnmsD['1']);
$artimeD = explode('","FlightNumber":"', $artime[$k]);	
 $originalDate = $deptimeD['0'];
$newDatedep = date("d F", strtotime($originalDate)); $newDatedept = date("H:i", strtotime($originalDate));   $originalDatea = $artimeD['0'];
$newDatearr = date("d F", strtotime($originalDatea)); $newDatearrt = date("H:i", strtotime($originalDatea));  

$luggage = explode('"Luggage":"', $refnmsD['1']);
$luggageD = explode('","', $luggage[$k]);
/*
$bagg=substr_count($luggageD['0'], 'k');    
if($bagg!='0'){  }
if($bagg=='0'){  $bag = explode('parça', $luggageD['0']);   }
if($bag['0']<9){  $dbbag = $bag['0'].' BAG';}
if($bag['0']>9){  $dbbag = $bag['0'].' KG';}
*/
$dbbag = $luggageD['0'];



 $string=$ElapsedTimeD['0']; $min = '';$h = '';
for ($index=0;$index<strlen($string);$index++) { if($index<2){ $h .= $string[$index]; } else { $min .= $string[$index]; }}

 DB::table('direction')->insert([
    ['dir_idbelit'  =>  $belitid ,'dir_airline'  =>  $airlinemarkD['0']    ,'dir_logo'  => $marketlogD['0']  ,'dir_class'  => $clasnkD['0']  ,'dir_numberflight'  =>  $flnkD['0']  ,  'dir_origin' => $citydepD['0']  , 'dir_origindate'  =>  $dir_origindate['0']  ,  'dir_origintime' => $newDatedept  ,  'dir_dest' => $cityarrivD['0']  , 'dir_destdate'  =>  $dir_destdate['0']  ,  'dir_desttime' => $newDatearrt  , 'dir_originairport'  =>  $feldsqDkD['0']  ,  'dir_originmairport' => $feldsqDkDD['0'] , 'dir_destairport'  =>  $feldsqDkarD['0']  ,  'dir_destmairport' => $feldsqDkDDa['0']  , 'dir_bag'  =>  $dbbag   ,    'dir_durit'  =>  $h.'Hours '.$min.'Minute' ,    'dir_dir'  =>  '1'  ,    ]
]); 

}



$wbs_departure=$wbs->wbs_departure;
$wbs_arrival=$wbs->wbs_arrival;

$countdep=strlen($wbs_departure);
$countarr=strlen($wbs_arrival);

if($countdep=='6'){ 
$codedep = explode('C', $wbs_departure);
$departurer=\DB::table('direction') ->where([['dir_idbelit', '=',  $belitid],['dir_dir', '=',  '1'],])->orderBy('id')->first();
$departure=$departurer->dir_originmairport.$codedep['1']; 
$updatee = \DB::table('wbs')->where('wbs_uuses', '=', Session::get('wbs_uuses'))  ->update([  'wbs_departure' => $departure    ]);  }

if($countarr=='6'){ 
$codearr = explode('C', $wbs_arrival);
$departurer=\DB::table('direction') ->where([['dir_idbelit', '=',  $belitid],['dir_dir', '=',  '1'],])->orderBy('id', 'desc')->first();
$arrival=$departurer->dir_destmairport.$codearr['1']; 
$updatee = \DB::table('wbs')->where('wbs_uuses', '=', Session::get('wbs_uuses'))  ->update(['wbs_arrival' => $arrival     ]); }
 

 




$wents=\DB::table('direction') ->where([['dir_idbelit', '=',  $belitid],['dir_dir', '=',  '0'],])->orderBy('id')->get(); 
$wentc=\DB::table('direction') ->where([['dir_idbelit', '=',  $belitid],['dir_dir', '=',  '0'],])->orderBy('id')->count();   
$backs=\DB::table('direction') ->where([['dir_idbelit', '=',  $belitid],['dir_dir', '=',  '1'],])->orderBy('id')->get(); 
$backc=\DB::table('direction') ->where([['dir_idbelit', '=',  $belitid],['dir_dir', '=',  '1'],])->orderBy('id')->count(); 

$belits=\DB::table('belits') ->where([['bel_id', '=',  $belitid],['bel_id', '<>',  '0'],])->orderBy('bel_id')->first();
$passangers=\DB::table('passanger') ->where([['pas_idbelit', '=',  $belitid],['id', '<>',  '0'],])->orderBy('id')->get();  

 

$aro=0; $iduser=0;
 if (Session::get('signstudent')!= NULL){ $aro='4'; $iduser=Session::get('idstudent'); } 
 else if (Session::get('signajency')!= NULL) { $aro='3'; $iduser=Session::get('idajency');} 
 else if (Session::get('signsuperadmin')!= NULL) { $aro='1'; $iduser='1';}  



 



//mycharge 
$charges = \DB::table('ajency') 
->join('charge', 'ajency.id', '=', 'charge.charge_iduser') 
->join('finicals', 'charge.charge_finical', '=', 'finicals.id') 
->where([
    ['charge.charge_arou', '=', $aro],
    ['charge.charge_iduser', '=', $iduser],
    ['finicals.finical_payment', '=', 1],
    ['finicals.finical_inc', '=', 5],])
    ->orderBy('charge.charge_id', 'desc')->get();
$chargepaymy=0;
foreach($charges as $charge){ $chargepaymy=$charge->charge_pay+$chargepaymy; }




 //supcharge  
$charges = \DB::table('ajency') 
->join('charge', 'ajency.id', '=', 'charge.charge_iduser') 
->join('finicals', 'charge.charge_finical', '=', 'finicals.id') 
->where([
    ['charge.charge_arou', '=', $aro],
    ['charge.charge_iduser', '=', $iduser],
    ['finicals.finical_payment', '=', 1],
    ['finicals.finical_inc', '=', 6],])
    ->orderBy('charge.charge_id', 'desc')->get();
$chargepaysup=0;
foreach($charges as $charge){ $chargepaysup=$charge->charge_pay+$chargepaysup; }



 //odat  
$charges = \DB::table('ajency') 
->join('charge', 'ajency.id', '=', 'charge.charge_iduser') 
->join('finicals', 'charge.charge_finical', '=', 'finicals.id') 
->where([
    ['charge.charge_arou', '=', $aro],
    ['charge.charge_iduser', '=', $iduser],
    ['finicals.finical_payment', '=', 1],
    ['finicals.finical_inc', '=', 7],])
    ->orderBy('charge.charge_id', 'desc')->get();
$chargepayodat=0;
foreach($charges as $charge){ $chargepayodat=$charge->charge_pay+$chargepayodat; }




//pardakht 
$charges = \DB::table('ajency') 
->join('charge', 'ajency.id', '=', 'charge.charge_iduser') 
->join('finicals', 'charge.charge_finical', '=', 'finicals.id') 
->where([
    ['charge.charge_arou', '=', $aro],
    ['charge.charge_iduser', '=', $iduser],
    ['finicals.finical_payment', '=', 1],
    ['finicals.finical_inc', '=', 3],])
    ->orderBy('charge.charge_id', 'desc')->get();
$chargepaypar=0;
foreach($charges as $charge){ $chargepaypar=$charge->charge_pay+$chargepaypar; }


//jamkol
$chargepay= ($chargepaysup +  $chargepaymy + $chargepayodat ) -  $chargepaypar  ; 


$currencyrial=\DB::table('currency') ->where([['cur_nem', '=',  'RIAL'],])->orderBy('id', 'desc')->first();
$currencyusd=\DB::table('currency') ->where([['cur_nem', '=',  'USD'],])->orderBy('id', 'desc')->first();

    
  

 
$currency=\DB::table('currency') ->where([['cur_nem', '=',  Session::get('curnem')],])->orderBy('id', 'desc')->first();   
    
return view('superadmin.buyticketreturnok',['lngmenus' => $lngmenus , 'lngmenu' => $lngmenu, 'hisd' => $hisd , 'result' => $result   ,   'departure' => $departure , 'arrival' => $arrival , 'sessionidDt' => $sessionidD , 'uu_sessionidDt' => $uu_sessionidD  , 'CombinationID' => $CombinationIDD  , 'RecommendationID' => $seqd  , 'priced' => $price , 'wents' => $wents , 'wentc' => $wentc , 'backs' => $backs ,  'backc' => $backc ,  'belits' => $belits ,  'passangers' => $passangers  , 'wbs' => $wbs   , 'mngindex' => $mngindex  , 'currency' => $currency  , 'chargepay' => $chargepay  , 'currencyrial' => $currencyrial  , 'currencyusd' => $currencyusd       ]);
 

 

 
}





public function buyticketyekpasngrind(Request $request){
 
$lngmenus= \DB::table('language') ->where([['id', '<>',  '0'],['lng_active', '=',  '1'],])->orderBy('id', 'desc')->get();
$lngmenu=\DB::table('language') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first();   	    
 
 
      
$CombinationID = $request->input('CombinationID');
$RecommendationID = $request->input('RecommendationID');
$priced = $request->input('priced');
$adult = $request->input('adult'); 
$child = $request->input('child'); 
$infant = $request->input('infant'); 
$sessionidD = $request->input('sessionidD'); 
$uu_sessionidD = $request->input('uu_sessionidD');
$hisd = $request->input('hisd');  
$bel_id = $request->input('bel_id');  


$genders = $request->input('gender'); 
$names = $request->input('name'); 
$familys = $request->input('family'); 
$days = $request->input('day'); 
$months = $request->input('month'); 
$years = $request->input('year'); 
$ages = $request->input('age');  
$nationals = $request->input('national'); 
$passportnumbers = $request->input('passportnumber');
 

$wbs=\DB::table('wbs') ->where([['wbs_uuses', '=', Session::get('wbs_uuses')],])->orderBy('id', 'desc')->first();  

 
$departure=$wbs->wbs_departure;
$arrival=$wbs->wbs_arrival;

    $cardname   = "kol aj hiol";
    $cardnumber = "4508034508034509";
    $cardmonth  = "12";
    $cardyear   = "2019";
    $cardcvv    = "000";



    $genel_toplam           = $priced;  
    $data = array(
        "clientid"       => "",
        "weborpanel"     => 0,
        "reselleruserid" => 0,
        "domainname"     => "",  
        "flighttype"     => "abroad", 
        "destination"    => "{$departure}",
        "arrival"        => "{$arrival}",
        "sessionid"      => "{$sessionidD}",   
        "passengerlist"  => array(),
        "CombinationID"     =>"{$CombinationID}", 
        "RecommendationID"   =>"{$RecommendationID}",
        "creditcard"         => array(
            "cardname"     => "{$cardname}",
            "cardnumber"   => "{$cardnumber}",
            "cardmonth"    => "{$cardmonth}",
            "cardyear"     => "{$cardyear}",
            "cardcvv"      => "{$cardcvv}",
            "baseprice"    => "{$genel_toplam}",
            "totalprice"   => "{$genel_toplam}", 
            "bankid"       => "64", 
            "installment"  => "0"
        ),
        


        "billing"                =>  null,
        "email"                  => "mustafa1390@gmail.com",
        "phone"                  => "00989384762155"

    );
 

$belits=\DB::table('belits') ->where([['bel_id', '=',  $bel_id],['bel_id', '<>',  '0'],])->orderBy('bel_id', 'desc')->first();
$passangers=\DB::table('passanger') ->where([['pas_idbelit', '=',  $bel_id],['id', '<>',  '0'],])->orderBy('id')->get();  


foreach($passangers as $passanger){

 
        $data['passengerlist'][] = array(
                                "gender"   => $passanger->pas_gender,
                                "type"     => $passanger->pas_type,
                                "name"     => $passanger->pas_name,
                                "surname"  => $passanger->pas_family,
                                "tckimlik" => "0",
                                "national"=> $passanger->pas_national,                
                                "passportnumber"=> $passanger->pas_passportnumber,      
                                "birthdate"=> $passanger->pas_birthdate 

                                );	
 

 
    
     }
  
 
 $data2 = json_encode($data);
  
 //echo $data2;
 
$updatee = \DB::table('belits')->where('bel_id', '=', $bel_id)  ->update(['bel_daterequest' => $data2     ]); 

 

$aro=0; $iduser=0;
 if (Session::get('signstudent')!= NULL){ $aro='4'; $iduser=Session::get('idstudent'); } 
 else if (Session::get('signajency')!= NULL) { $aro='3'; $iduser=Session::get('idajency');} 
 else if (Session::get('signsuperadmin')!= NULL) { $aro='1'; $iduser='1';}  




//mycharge 
$charges = \DB::table('ajency') 
->join('charge', 'ajency.id', '=', 'charge.charge_iduser') 
->join('finicals', 'charge.charge_finical', '=', 'finicals.id') 
->where([
    ['charge.charge_arou', '=', $aro],
    ['charge.charge_iduser', '=', $iduser],
    ['finicals.finical_payment', '=', 1],
    ['finicals.finical_inc', '=', 5],])
    ->orderBy('charge.charge_id', 'desc')->get();
$chargepaymy=0;
foreach($charges as $charge){ $chargepaymy=$charge->charge_pay+$chargepaymy; }




 //supcharge  
$charges = \DB::table('ajency') 
->join('charge', 'ajency.id', '=', 'charge.charge_iduser') 
->join('finicals', 'charge.charge_finical', '=', 'finicals.id') 
->where([
    ['charge.charge_arou', '=', $aro],
    ['charge.charge_iduser', '=', $iduser],
    ['finicals.finical_payment', '=', 1],
    ['finicals.finical_inc', '=', 6],])
    ->orderBy('charge.charge_id', 'desc')->get();
$chargepaysup=0;
foreach($charges as $charge){ $chargepaysup=$charge->charge_pay+$chargepaysup; }



 //odat  
$charges = \DB::table('ajency') 
->join('charge', 'ajency.id', '=', 'charge.charge_iduser') 
->join('finicals', 'charge.charge_finical', '=', 'finicals.id') 
->where([
    ['charge.charge_arou', '=', $aro],
    ['charge.charge_iduser', '=', $iduser],
    ['finicals.finical_payment', '=', 1],
    ['finicals.finical_inc', '=', 7],])
    ->orderBy('charge.charge_id', 'desc')->get();
$chargepayodat=0;
foreach($charges as $charge){ $chargepayodat=$charge->charge_pay+$chargepayodat; }




//pardakht 
$charges = \DB::table('ajency') 
->join('charge', 'ajency.id', '=', 'charge.charge_iduser') 
->join('finicals', 'charge.charge_finical', '=', 'finicals.id') 
->where([
    ['charge.charge_arou', '=', $aro],
    ['charge.charge_iduser', '=', $iduser],
    ['finicals.finical_payment', '=', 1],
    ['finicals.finical_inc', '=', 3],])
    ->orderBy('charge.charge_id', 'desc')->get();
$chargepaypar=0;
foreach($charges as $charge){ $chargepaypar=$charge->charge_pay+$chargepaypar; }


//jamkol
$chargepay= ($chargepaysup +  $chargepaymy + $chargepayodat ) -  $chargepaypar  ; 


$currencyrial=\DB::table('currency') ->where([['cur_nem', '=',  'RIAL'],])->orderBy('id', 'desc')->first();
$currencyusd=\DB::table('currency') ->where([['cur_nem', '=',  'USD'],])->orderBy('id', 'desc')->first();



 
$mngindex=\DB::table('mngindex') ->where([['id', '=', '1'],])->orderBy('id', 'desc')->first(); 
$currency=\DB::table('currency') ->where([['cur_nem', '=',  Session::get('curnem')],])->orderBy('id', 'desc')->first(); 
  

$paybelc = $currency->cur_rateajency * $belits->bel_basefare;
$tax=$currency->cur_rateajency * $mngindex->ind_taxp; 
$taxp=$wbs->wbs_adult+$wbs->wbs_child+$wbs->wbs_infant; $taxpc=$taxp*$tax;
$paybel=  $taxpc + $paybelc  ;
  
 $bel_pay=$paybel;

$bel_sumpricetl=$belits->bel_basefare + ($taxp*$mngindex->ind_taxp);

$bel_sumpricetll=$currencyrial->cur_rateajency * $bel_sumpricetl; 
    
 if(Session::get('curnem')=='RIAL'){ $roundchargepay=$chargepay;       }   
 elseif(Session::get('curnem')=='USD') {   $roundchargepay= ($chargepay/$currencyrial->cur_rateajency)/$currencyusd->cur_rateajency/10 ;    } 
 elseif(Session::get('curnem')=='TL'){$roundchargepay= $chargepay/$currencyrial->cur_rateajency ;    }
 
  
  $bel_sumpricetll = ceil ($bel_sumpricetll) ;  	
  $bel_pay = ceil ($bel_pay) ;  	
 
 
 	// echo $roundchargepay;  echo 'OK';  echo  $bel_pay; 
 

 if ($roundchargepay > $bel_pay ) {
 	
  
 	

DB::table('finicals')->insert([
    ['finical_pay' => $bel_sumpricetll ,     'finical_createdatdate' =>  date('Y-m-d H:i:s') , 'finical_inc' => 3 , 'finical_payment' => 1 ,  'finical_arou' => $aro ,  'finical_iduser' => $iduser ,  'finical_idbelit' => $bel_id  ]
]);

$chargefinical=\DB::table('finicals') ->where([['finical_inc', '=',  3 ],['finical_arou', '=',  $aro ],['finical_iduser', '=',  $iduser],])->orderBy('id', 'desc')->first();	
		    	
DB::table('charge')->insert([
    ['charge_pay' => $bel_sumpricetll ,     'charge_createdatdate' =>  date('Y-m-d H:i:s') , 'charge_arou' => $aro ,  'charge_iduser' => $iduser ,  'charge_finical' => $chargefinical->id  ]
]);	    	


if($aro=='3')		{  return redirect('agency/buyticketfinalycharge'); 	 } 
else  if($aro=='1') {  return redirect('/'); 	} else { return redirect('/'); 	 }

 
 
 	
 }
 

  else   {
  	
 

DB::table('finicals')->insert([
    ['finical_pay' => $bel_sumpricetll ,     'finical_createdatdate' =>  date('Y-m-d H:i:s') , 'finical_inc' => 4 , 'finical_payment' => 0 ,  'finical_arou' => $aro ,  'finical_iduser' => $iduser ,  'finical_idbelit' => $bel_id  ]
]);

$chargefinical=\DB::table('finicals') ->where([['finical_inc', '=',  4 ],['finical_arou', '=',  $aro ],['finical_iduser', '=',  $iduser],])->orderBy('id', 'desc')->first();	
		    	
DB::table('charge')->insert([
    ['charge_pay' => $bel_sumpricetll ,     'charge_createdatdate' =>  date('Y-m-d H:i:s') , 'charge_arou' => $aro ,  'charge_iduser' => $iduser ,  'charge_finical' => $chargefinical->id  ]
]);	    	

if($aro=='3'){
	$countrys = \DB::table('ajency')->where('id', '=', Session::get('idajency'))  ->orderBy('id', 'desc')->first();
$countrysname = $countrys->ajency_ctr;
if($countrysname =='Iran'){
require_Once(public_path('/../bmt/lib/nusoap.php'));
include_once(public_path('/../bmt/lib/class.payrequest.php'));	
return redirect('bmt/epayaj.php?id='.$chargefinical->id.''); }
else if($countrysname !='Iran'){
return redirect('page/1');
}
	

  
	
}






 }
 
  
 
 
 /*
 
    $url   = "https://ucuzauc.com/api/createticket/4e53defd-7620-4ac1-b7e1-61c43f34bb76"; 
  

     
   $kullanici='atin_user'; 
       $sifre='X4fVgT3a';  
       $sess=$uu_sessionidD;  
$data1 = array("request: {$data2}" , "username: $kullanici", "password: $sifre", "SetSession: $sess");
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $data1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, array());
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $result = curl_exec($ch);
   
 
 
$statu = explode('tatus":', $result );
$status = explode(',', $statu['1'] );

if($status['0']=='false'){ echo $status['0']; }
else if($status['0']=='true'){ 
$mergey = explode(',"mergekey":"', $result );
$eticketnumber = explode('eticketnumber":"', $result );
$pnrt = explode('"pnr":"', $result );
$mergeykey = explode('","', $mergey['1'] );
$teticketnumber = explode('","', $eticketnumber['1'] );
$pnr = explode('","', $pnrt['1'] ); 


 DB::table('belittest')->insert([ 'pnr' => $pnr['0'] ]); 




$updatee = \DB::table('belits')->where('bel_id', '=', $bel_id)  ->update(['bel_mergey' => $mergeykey['0']   ,  'bel_ticketnumber' => $teticketnumber['0']   , 'bel_pnr' => $pnr['0']  ,   'bel_ses' => Session::get('wbs_uuses')  ,  'bel_result' => $result  ]); 


 

 $mergeykey=$mergeykey['0'];



 
 $wents=  \DB::table('belits')
->join('direction', 'belits.bel_id', '=', 'direction.dir_idbelit') ->where([['bel_mergey', '=',  $mergeykey],['dir_dir', '=',  '0'],])->orderBy('bel_id')->get(); 



 $backc=  \DB::table('belits')
->join('direction', 'belits.bel_id', '=', 'direction.dir_idbelit') ->where([['bel_mergey', '=',  $mergeykey],['dir_dir', '=',  '1'],])->orderBy('bel_id')->count(); 

 $backs=  \DB::table('belits')
->join('direction', 'belits.bel_id', '=', 'direction.dir_idbelit') ->where([['bel_mergey', '=',  $mergeykey],['dir_dir', '=',  '1'],])->orderBy('bel_id')->get(); 


 $passangers=  \DB::table('belits')
->join('passanger', 'belits.bel_id', '=', 'passanger.pas_idbelit') ->where([['bel_mergey', '=',  $mergeykey],])->orderBy('bel_id')->get(); 
 
 
$belits=\DB::table('belits') ->where([['bel_mergey', '=',  $mergeykey],])->orderBy('bel_id', 'desc')->first(); 


 $user = \DB::table('belits') ->where([['bel_mergey', '=',  $mergeykey],])->orderBy('bel_id', 'desc')->first(); 
 $usernamee = 'successfully '; 
 $titmes= 'Your ticket has been successfully purchased';
 $mestt= 'PNR ';
 $mesnot = ' '. $user->bel_pnr . ' , Ticket Number: '. $user->bel_ticketnumber ; 
 $email='mustafa1390@gmail.com';
 Mail::send('superadmin.mail', ['user' => $user , 'usernamee' => $usernamee, 'mesnot' => $mesnot, 'titmes' => $titmes , 'mestt' => $mestt], function ($m) use ($user) {       
$decryptedPassword = 'yyyyyyyy';
            $m->from('info@gds724.com',  'GDS724'  );
            $m->to($user->bel_email, $user->bel_email)->subject('Ticket BUY');
        }); 



 
  
$rulmngindexs=\DB::table('mngindexgds') ->where([['id', '=',  '5'],])->orderBy('id', 'desc')->first(); 
 
  return view('superadmin.printticket', [  'lngmenus' => $lngmenus , 'lngmenu' => $lngmenu , 'wents' => $wents  , 'passangers' => $passangers , 'belits' => $belits  , 'backs' => $backs  , 'backc' => $backc , 'rulmngindexs' => $rulmngindexs ]);
  
 
  

  }
 
   */
  
 
}





	public function testaro(){


 $str = 'https://gds724.com';
 $str = substr($str, 0 , 5);
   
   echo $str; 



		}





	public function developersp(   ){
 

Session::set('idlang', '3');  
   
  
$lngmenus= \DB::table('language') ->where([['id', '<>',  '0'],['lng_active', '=',  '1'],])->orderBy('id', 'desc')->get();
$lngmenu=\DB::table('language') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first();
$slngmenu=\DB::table('languages') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first();	
return view('developers/panel' , [   'lngmenus' => $lngmenus, 'lngmenu' => $lngmenu]);  
	
	 
		
		}



	public function developers( $account  ){
 

Session::set('idlang', '3');   
  
$lngmenus= \DB::table('language') ->where([['id', '<>',  '0'],['lng_active', '=',  '1'],])->orderBy('id', 'desc')->get();
$lngmenu=\DB::table('language') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first();
$slngmenu=\DB::table('languages') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first();	
return view('developers/panelll' , [   'lngmenus' => $lngmenus, 'lngmenu' => $lngmenu]);   
		
		}



	public function developersturk( $account  ){
 

Session::set('idlang', '7');   
  
$lngmenus= \DB::table('language') ->where([['id', '<>',  '0'],['lng_active', '=',  '1'],])->orderBy('id', 'desc')->get();
$lngmenu=\DB::table('language') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first();
$slngmenu=\DB::table('languages') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first();	

$admins=\DB::table('developer') ->where([['dev_lng', '=',  Session::get('idlang')],])->orderBy('id')->get();

return view('developers/panellang' , ['lngmenus' => $lngmenus , 'lngmenu' => $lngmenu , 'admins' => $admins ]);   
		
		}
		
		

	public function developersrus( $account  ){
 

Session::set('idlang', '8');   
  
$lngmenus= \DB::table('language') ->where([['id', '<>',  '0'],['lng_active', '=',  '1'],])->orderBy('id', 'desc')->get();
$lngmenu=\DB::table('language') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first();
$slngmenu=\DB::table('languages') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first();	

$admins=\DB::table('developer') ->where([['dev_lng', '=',  Session::get('idlang')],])->orderBy('id')->get();

return view('developers/panellang' , ['lngmenus' => $lngmenus , 'lngmenu' => $lngmenu , 'admins' => $admins ]);   
		
		}

	public function developersindex( $account  ){

Session::set('idlang', '3');  
   
  
$lngmenus= \DB::table('language') ->where([['id', '<>',  '0'],['lng_active', '=',  '1'],])->orderBy('id', 'desc')->get();
$lngmenu=\DB::table('language') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first();
$slngmenu=\DB::table('languages') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first();	
return view('developers/panelll' , [   'lngmenus' => $lngmenus, 'lngmenu' => $lngmenu]);  
	 
		
		}




	public function testwebservice(){
		
$result='0';
/*
 $adminsc = \DB::table('comwbs')->where([['comwbs.comwbs_seq', '>',  '2'],]
)->delete(); 
 $adminsc = \DB::table('comwbsj')->where([['comwbsj.comwbsj_seq', '>',  '2'],]
)->delete(); 
 $adminsc = \DB::table('comwbsk')->where([['comwbsk.comwbsk_seq', '>',  '2'],]
)->delete(); 
*/
//echo $citys;


$citysk = \DB::table('comwbsk')
->where([['comwbsk.comwbsk_wbsid', '=',  '1072'],]
)->orderBy('comwbsk.comwbsk_id')->get();


$citysj = \DB::table('comwbsj') 
->where([['comwbsj.comwbsj_wbsid', '=',  '1072'],]
)->orderBy('comwbsj.comwbsj_id')->get();





$cityseqs = \DB::table('comwbs')
->where([['comwbs.comwbs_wbsid', '=',  '1072'],]
)->orderBy('comwbs.comwbs_id')->get();

$citys = \DB::table('comwbs')
->join('comwbsj', 'comwbsj.comwbsj_index', '=', 'comwbs.comwbs_id')
->join('comwbsk', 'comwbsk.comwbsk_index', '=', 'comwbsj.comwbsj_id')
->where([['comwbs.comwbs_wbsid', '=',  '1072'],]
)->orderBy('comwbsk.comwbsk_id')->get();

 

 return view('indexgds.testwbs', ['result' => $result  , 'citys' => $citys , 'cityseqs' => $cityseqs  , 'citysj' => $citysj  , 'citysk' => $citysk    ]); 


		}


	public function demowbs(){
		
  
  
	/*
$url=  'http://localhost/flight/demowbstest';
	
 $http = new GuzzleHttp\Client;

    $response = $http->post('http://localhost/flight/demowbstest', [
        'form_params' => [
            'grant_type' => 'authorization_code',
            'client_id' => 'client-id',
            'client_secret' => 'client-secret',
            'redirect_uri' => 'http://example.com/callback',
            'code' => $request->code,
        ],
    ]);

    return json_decode((string) $response->getBody(), true);
	if ($request->header('accept') === 'application/json') {
		
		}
	*/
	
	$resultt=0;
	
 return view('indexgds.demowbs', ['resultt' => $resultt     ]);
		
		}
		
		
		
		
	
	public function demowbstest(){
		 
		
 $resultt=0;
 
 return view('indexgds.demowbstest', ['resultt' => $resultt     ]); 

		
		}	
	
	
	
	
	
	
	
public function recv(Request $request){
//$date= date('Y.m.d'); 
$maxadt= date("Y.m.d", strtotime("-12 year"));
$maxinf= date("Y.m.d", strtotime("-2 year"));
$birthdate='24.10.2002';   $birthdate=date("Y.m.d" , strtotime($birthdate));
if($birthdate>$maxadt){
 if($birthdate>$maxinf){ echo 'INF';  } else  { echo 'CHD';  }  
} else { echo 'ADT'; }

echo '<br>';
$depairports = \DB::table('airports') 
->where([
    ['airports.code', '=', 'GYD'],])
    ->orderBy('airports.code', 'desc')->get(); 
foreach($depairports as $depairport){   $depcityairport=$depairport->cityName;  $depnameairport=$depairport->name; }
echo $depcityairport;

//require "safeCrypto.php"; 

echo '<br>';
// Do this once then store it somehow:
$key = random_bytes(SODIUM_CRYPTO_SECRETBOX_KEYBYTES);
$message = 'We are all living in a yellow submarine';

$ciphertext = safeEncrypt($message, $key);
$plaintext = safeDecrypt($ciphertext, $key);

var_dump($ciphertext);
var_dump($plaintext);




}
		
		
	
	public function recvpasenger(Request $request){

return redirect('http://localhost/wbs/send.php');
		
		}
		
		
	public function testrequest(Request $request){
		
		
$departure='IKA';$arrival='IKA';



  /*
  $request = '{
            departure: "'.$departure.'",
            arrival: "'.$arrival.'" 
        }';
        */
    
   
 
      
 
    $headers = array(
        'username:atin_user',
        'password:X4fVgT3a',
        'Content-Type:application/json',
        'request:'.$request
    );
        

    		
    		
    		/*
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://localhost/flight/testreq");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 5);
    curl_setopt($ch, CURLOPT_TIMEOUT, 59);
    curl_setopt($ch, CURLOPT_HEADER, 1);
$result = curl_exec($ch);

*/

//echo $result;
 

//$lines = file_get_contents('http://www.tutorialspoint.com/');
  // echo $lines;




if(isset($request->var_1) ){
    $country = $request->var_1; 
          
         
    echo "country : ".$country." vvvvvvv".$request->var_1;
    
    echo '<br>'; 
}



 



		}	
		
	
	
	
	
	
	
	
	
	
	
	public function webservicewent( Request $request , $token , $dep , $arr , $datewent, $adult, $child, $infant){
		echo $dep; echo '<br>'; 
		echo $arr; echo '<br>'; 
		echo $datewent; echo '<br>'; 


 
$numcounttoken=\DB::table('userwebservice') ->where([['usw_token', '=',  $token ],])->orderBy('id', 'desc')->count(); 
if($numcounttoken=='1'){
$mtoken=\DB::table('userwebservice') ->where([['usw_token', '=',  $token ],])->orderBy('id', 'desc')->first(); 
$mytoken=$mtoken->usw_token; $curency=$mtoken->usw_curency; 
$currencyrate=\DB::table('currency') ->where([['cur_nem', '=',  $curency],])->orderBy('id', 'desc')->first();  	
  }

 






 



//$year = $dayn.'.'.$monthn.'.'.$yearn.''; 


$departuredater='0';$flightType='0'; $departure =$dep; $departuredate=$datewent; $arrival=$arr;  $flgstop='1';

  
 
        $requestt = '{
            departure: "'.$dep.'",
            arrival: "'.$arr.'",
            departuredate: "'.$datewent.'",
            adult: "'.$adult.'" ,
            child: "'.$child.'",
            infant: "'.$infant.'",
            onlydirect: false
        }';   
 
  
  
 
      
 if (empty($_SESSION['ProviderSessionId'])) {
     // echo 'empty';
      }
        
    $headers = array(
        'username:atin_user',
        'password:X4fVgT3a',
        'Content-Type:application/json',
        'request:'.$requestt
    );
        if (! empty($_SESSION['ProviderSessionId'])) {
        $headers['SetSession'] = $_SESSION['ProviderSessionId'];
    }

    		
     //http://88.250.178.229:4545/
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://ucuzauc.com/api/availability/4e53defd-7620-4ac1-b7e1-61c43f34bb76");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $requestt);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 5);
    curl_setopt($ch, CURLOPT_TIMEOUT, 59);
    curl_setopt($ch, CURLOPT_HEADER, 1);
$result = curl_exec($ch);

//echo $result;

$wordChunks = explode("}]}]},", $result);
$statuswbs=count($wordChunks);

if(($statuswbs == '1')||($mytoken!=$token)){ echo 'NOT FOUND'; } else if(($statuswbs != '1')&&($mytoken==$token)) { 
	




$wordChunks = explode("}]}]},", $result);
for($i = 0; $i < count($wordChunks); $i++){ }
if ( ! empty($_SESSION['ProviderSessionId'])) {
      $_SESSION['ProviderSessionId'] =  $wordChunks.uu_SessionId;
      }
  

$ori = explode("OriginDestinationOptionList,", $result );
$wordChunks = explode('{"Currency":"', $result);
$AirlineCode = explode('"ValidatingAirlineCode":"', $result);
$FlightNumber = explode('"FlightNumber":"', $result);
$ResBookDesigCode = explode('"ResBookDesigCode":"', $result);
$time = explode('"DepartureDateTime":"', $result);
$rezerve = explode('"ResBookDesigQuantity":"', $result);
$Havayolu = explode('"MarketingAirlineName":"', $result);
$TOTALEFARE = explode('"TotalFare":', $result);
$DepartureAirport = explode('"DepartureAirport":"', $result); 
$ArrivalAirport = explode('"ArrivalAirport":"', $result); 
$FlightSegment = explode('FlightSegment', $result); 
$SequenceNumber = explode('SequenceNumber":"', $result); 
$sessionid = explode('","sessionid":"', $result);
$sessionidD = explode('","', $sessionid['1']);
$uu_sessionid = explode('"uu_SessionId":"' , $result);
$uu_sessionidD = explode('","sessionid":"' , $uu_sessionid['1']);


	Session::set('wbs_uuses', $uu_sessionidD['0']); 
	
    DB::table('wbs')->insert([
    ['result' => $result  , 'wbs_uuses' => $uu_sessionidD['0']  ,'wbs_sesid' => $sessionidD['0']  , 'wbs_arrival' => $arrival , 'wbs_departure' => $departure , 'wbs_adult' => $adult , 'wbs_child' => $child , 'wbs_infant' => $infant  , 'wbs_departuredate' => $departuredate  , 'wbs_departuredater' => $departuredater  , 'wbs_way' => $flightType , 'wbs_ip' => $request->ip()  ,   'wbs_createdatdate' =>  date('Y-m-d H:i:s') ,   'wbs_token' =>  $token      ]
]);   
 
$wbs=\DB::table('wbs') ->where([['wbs_uuses', '=', Session::get('wbs_uuses')] , ])->orderBy('id', 'desc')->first(); 
 $result=$wbs->result; $wbssearch=$wbs->id;



$depnamenamecountry = substr($wbs->wbs_departure,0,3);  $arrnamenamecountry = substr($wbs->wbs_arrival,0,3);
$depairports = \DB::table('airports')  ->where([  ['airports.code', '=', $depnamenamecountry],])  ->orderBy('airports.code', 'desc')->get();  foreach($depairports as $depairport){   $depcityairport=$depairport->cityName;  $depnameairport=$depairport->name;  $depcountryname=$depairport->countryName;  $namefrom = $depcountryname .' _ '.$depcityairport.' _ '.$depnameairport;  }  
  
$arrairports = \DB::table('airports')  ->where([ ['airports.code', '=', $arrnamenamecountry] ,])  ->orderBy('airports.code', 'desc')->get();  foreach($arrairports as $arrairport){   $arrcityairport=$arrairport->cityName;  $arrnameairport=$arrairport->name;  $arrcountryname=$arrairport->countryName; $nameto = $arrcountryname .' _ '.$arrcityairport.' _ '.$arrnameairport; }
 

    DB::table('wbslistsearch')->insert([
    ['id' => $wbs->id    , 'wbs_uuses' => $uu_sessionidD['0']  ,'wbs_sesid' => $sessionidD['0']  , 'wbs_arrival' => $arrival , 'wbs_departure' => $departure , 'wbs_adult' => $adult , 'wbs_child' => $child , 'wbs_infant' => $infant  , 'wbs_departuredate' => $departuredate  , 'wbs_departuredater' => $departuredater  , 'wbs_way' => $flightType , 'wbs_ip' => $request->ip()  ,   'wbs_createdatdate' =>  date('Y-m-d H:i:s') ,   'wbs_token' =>  $token  , 'wbs_namefrom' => $namefrom, 'wbs_nameto' => $nameto      ]
]);   
 
 
$wbs=\DB::table('wbs') ->where([['wbs_uuses', '=', Session::get('wbs_uuses')] , ])->orderBy('id', 'desc')->first(); 
$wbsid=$wbs->id;

   $sortcounts=\DB::table('sort') ->where([['sort_wbsid', '=', $wbsid] , ])->orderBy('id', 'desc')->count(); 



for($i = 1; $i < count($wordChunks); $i++){ 
$FlightNumberD = explode('","ResBookDesigCode"', $FlightNumber[$i]);
$ResBookDesigCodeD = explode('","ResBookDesigQuantity"', $ResBookDesigCode[$i]);
$timeD = explode('","ArrivalDateTime"', $time[$i]);
$AirlineCodeD = explode('","ForceETicket":"', $AirlineCode[$i]);
$rezerveD = explode('","DepartureAirport":"', $rezerve[$i]);
$HavayoluD = explode('","Equipment":"', $Havayolu[$i]);
$HavayoluDD = explode('","', $HavayoluD['0']);
$TOTALEFARED = explode(',"ServiceFare":', $TOTALEFARE[$i]);
$DepartureAirportD = explode('","ArrivalAirport":', $DepartureAirport[$i]);
$ArrivalAirportD = explode('","DepartureCityCountry":', $ArrivalAirport[$i]);
$FlightSegmentD = explode('},{"DepartureDateTime":"', $wordChunks[$i]);
$SequenceNumberD = explode('","OriginDestinationOptionList"', $SequenceNumber[$i]);
$flseg=substr_count($SequenceNumber[$i], 'FlightSegment'); 
$flRefNumber=substr_count($SequenceNumber[$i], 'RefNumber');  
$listseg  = explode('","OriginDestinationOptionList"', $wordChunks[$i]); 
$listsegD = explode('","OriginDestinationOptionList"', $listseg['1']);
$refnmD = explode('"RefNumber":"', $listseg['1']); 
$TotalFare = explode(',"TotalFare":', $wordChunks[$i]);
$TotalFareD = explode(',"ServiceFare":', $TotalFare['1']);
$listseg  = explode('","OriginDestinationOptionList"', $wordChunks[$i]); 
$listsegD = explode('","OriginDestinationOptionList"', $listseg['1']);


 $adttprice='0';  $adtbprice='0';  $adtsprice=$adttprice-$adtbprice ; 

if($adult != '0'){
$adtprice = explode('"PassengerType":"Yetişkin"', $wordChunks[$i]);
$adtpriceD = explode(',"TicketDesignators":', $adtprice['1']);	 

$adtbpriceD = explode(',"BaseFare":', $adtpriceD['0']);	
$adtbpriceDD = explode(',"MarkupFare":', $adtbpriceD['1']);	
$adtbprice=	$adtbpriceDD['0'];

$adttpriceD = explode('"TotalFare":', $adtpriceD['0']);	
$adttpriceDD = explode(',"ServiceFare":', $adttpriceD['1']);
$adttprice=	$adttpriceDD['0'];

 $adtsprice=$adttprice-$adtbprice ;

}


 $chdtprice=0; $chdbprice=0; $chdsprice=$chdtprice-$chdbprice ;

if($child != '0'){
$chdprice = explode('"PassengerType":"Çocuk"', $wordChunks[$i]);
$chdpriceD = explode(',"TicketDesignators":', $chdprice['1']);	

$chdbpriceD = explode(',"BaseFare":', $chdpriceD['0']);	
$chdbpriceDD = explode(',"MarkupFare":', $chdbpriceD['1']);	
$chdbprice=	$chdbpriceDD['0'];

$chdtpriceD = explode('"TotalFare":', $chdpriceD['0']);	
$chdtpriceDD = explode(',"ServiceFare":', $chdtpriceD['1']);
$chdtprice=	$chdtpriceDD['0'];

 $chdsprice=$chdtprice-$chdbprice ;

}

 $inftprice=0; $infbprice=0; $infsprice=$inftprice-$infbprice ;

if($infant != '0'){
$infprice = explode('"PassengerType":"Bebek"', $wordChunks[$i]);
$infpriceD = explode(',"TicketDesignators":', $infprice['1']);	

$infbpriceD = explode(',"BaseFare":', $infpriceD['0']);	
$infbpriceDD = explode(',"MarkupFare":', $infbpriceD['1']);	
$infbprice=$infbpriceDD['0'];

$inftpriceD = explode('"TotalFare":', $infpriceD['0']);	
$inftpriceDD = explode(',"ServiceFare":', $inftpriceD['1']);
$inftprice=$inftpriceDD['0'];	


 $infsprice=$inftprice-$infbprice ;

}




 DB::table('comwbs')->insert([[  'comwbs_wbsid' => $wbssearch ,  'comwbs_test' => $TotalFareD['0']  ,  'comwbs_seq' =>$SequenceNumberD['0']  ,  'comwbs_adtbprice' =>$adtbprice ,  'comwbs_chdbprice' =>$chdbprice,  'comwbs_infbprice' =>$infbprice ,  'comwbs_adtsprice' =>$adtsprice ,  'comwbs_chdsprice' =>$chdsprice,  'comwbs_infsprice' =>$infsprice ,  'comwbs_adttprice' =>$adttprice ,  'comwbs_chdtprice' =>$chdtprice,  'comwbs_inftprice' =>$inftprice  ]]); 


 




 if($flightType=='1'){ 
$CombinationIDNumbe=substr_count($SequenceNumber[$i], 'CombinationID'); 
$CombinationIDNumber=$CombinationIDNumbe-1; 
$CombinationList  = explode('OriginDestinationCombinationList', $wordChunks[$i]); 
$CombinationIDNumbeji=substr_count($CombinationList['1'], 'CombinationID'); 
$CombinationListD  = explode('"IndexList":"', $CombinationList['1']); 
for($c = 1; $c <  $CombinationIDNumber+2   ; $c++){   
$IndexList  = explode('","CombinationID":"', $CombinationListD[$c]); 
$comiid  = explode('","', $IndexList['1']); 
$IndexListwentD  = explode(';', $IndexList['0']);  
$IndexListwentD['0']; 
 DB::table('comid')->insert([['seq' => $i-1 ,'seqseq' => $SequenceNumberD['0'] , 'went' => $IndexListwentD['0'] , 'back' => $IndexListwentD['1'] ,    'wbssearch' => $wbssearch ,  'com' => $comiid['0']  ]]);
}  
}


 for($j = 1; $j < $flseg+1; $j++){ 
$feldsq  = explode('FlightSegment":[{', $listsegD['0']); 
$refnmsD = explode('FlightSegment', $refnmD[$j]); 
$refnmsND = explode('","DirectionId":"', $refnmsD['0']); 
$DirectionIdflgD = explode('","', $refnmsND['1']);  
$ElapsedTime = explode('","ElapsedTime":"', $refnmsD['0']); 
$ElapsedTimeD = explode('","', $ElapsedTime['1']);   
$directsD = explode('","', $ElapsedTime['0']);   
$directsidD = explode('DirectionId":"', $directsD['1']);    
$rfse=substr_count($refnmsD['1'], 'DepartureAirport');   

$airlinemark  = explode('"OperatingAirlineName":"', $listsegD['0']);
$airlinemarkD  = explode('","', $airlinemark['1']);
$marketlog  = explode('"MarketingAirline":"', $listsegD['0']);
$marketlogD  = explode('","', $marketlog['1']);

$feldsqDk = explode(',"DepartureAirport":"', $feldsq[$j]);
$feldsqDkD = explode('(', $feldsqDk['1']);
$feldsqDkDD = explode(')', $feldsqDkD['1']);
$deptime = explode('"DepartureDateTime":"', $feldsq[$j]);
$deptimeD = explode('","ArrivalDateTime":"', $deptime['1']);
$originalDate = $deptimeD['0'];
$newDatedep = date("d F", strtotime($originalDate)); $newDatedept = date("H:i", strtotime($originalDate));  

 $string=$ElapsedTimeD['0']; $min = '';$h = '';
for ($index=0;$index<strlen($string);$index++) { if($index<2){ $h .= $string[$index]; } else { $min .= $string[$index]; }} 


$feldsqDkar = explode('","ArrivalAirport":"', $feldsq[$j]);
$feldsqDkarD = explode('(', $feldsqDkar[$rfse]);	
$feldsqDkarDD = explode(')', $feldsqDkarD['1']);	
$artime = explode('","ArrivalDateTime":"', $feldsq[$j]);
$artimeD = explode('","FlightNumber":"', $artime[$rfse]);	
$originalDatea = $artimeD['0'];
$newDatearr = date("d F", strtotime($originalDatea)); $newDatearrt = date("H:i", strtotime($originalDatea));

$luggage = explode('"Luggage":"', $feldsq[$j]);
$luggageD = explode('","', $luggage['1']);

   

$clasnk = explode('","ResBookDesigCode":"', $feldsq[$j]);
$clasnkD = explode('","ResBookDesigQuantity":"', $clasnk['1']);






   
 if($sortcounts=='0'){ 
 
$dirf=$rfse+1;
 if($flgstop=='1'){ $show='1'; } else 
      if($flgstop=='2'){ if($dirf=='2') {$show='0';} else if($dirf!='2') {$show='1';}  }
else  if($flgstop=='3'){ if($dirf=='2') {$show='1';} else if($dirf!='2') {$show='0';}   }   



 	
$sairlinest  = explode(" ", $airlinemarkD['0']); 	
$sairlinestD  = $sairlinest['0']; 
  DB::table('sort')->insert([['sort_seq' => $i-1 , 'sort_comb' => $j-1 ,'sort_price' => $TotalFareD['0'] , 'sort_wbsid' => $wbsid  , 'sort_duritfly' => $h.$min   , 'sort_deptime' => $originalDate , 'sort_artime' => $originalDatea ,  'sort_airline' => $airlinemarkD['0'] ,  'sort_indirect' => $rfse+1  ,  'sort_class' => $clasnkD['0'] ,  'sort_show' => $show ]]);  	
  
  
   $sortvcounts=\DB::table('sortv') ->where([['sortv_wbsid', '=', $wbsid] ,['sortv_price', '=', $TotalFareD['0']] , ])->orderBy('id')->count(); 
  
  
 if($sortvcounts=='0'){
 
   $sairlinest  = explode(" ", $airlinemarkD['0']); 	
  $sairlinestD  = $sairlinest['0']; 		
 	

$sortvaircounts=\DB::table('sortv') ->where([['sortv_wbsid', '=', $wbsid] ,['sortv_airline', '=', $airlinemarkD['0']],  ])->orderBy('id')->count(); 	
 if($sortvaircounts=='0'){ $flgairline=1; } else  if($sortvaircounts!='0'){ $flgairline=0; }
 	

$sortvclascounts=\DB::table('sortv') ->where([['sortv_wbsid', '=', $wbsid] ,['sortv_class', '=',$clasnkD['0'] ],  ])->orderBy('id')->count(); 	
 if($sortvclascounts=='0'){ $flgaclas=1; } else  if($sortvclascounts!='0') { $flgaclas=0; }

$sortvindirectcounts=\DB::table('sortv') ->where([['sortv_wbsid', '=', $wbsid] ,['sortv_indirect', '=',$rfse+1 ],  ])->orderBy('id')->count(); 	
 if($sortvindirectcounts=='0'){ $indirect=1; } else  if($sortvindirectcounts!='0') { $indirect=0; }
 	
 	
  DB::table('sortv')->insert([[  'sortv_price' => $TotalFareD['0'] , 'sortv_wbsid' => $wbsid  ,   'sortv_airline' => $airlinemarkD['0'] ,  'sortv_class' => $clasnkD['0']  ,  'sortv_indirect' => $rfse+1 ,  'sortv_airlineflg' => $flgairline ,  'sortv_clasflg' => $flgaclas ,  'sortv_indirectflg' => $indirect ,  'sortv_priceflg' => '1' ]]);  
  }	
  
  
  
  
 }  


 
$comwbs=\DB::table('comwbs') ->where([['comwbs_wbsid', '=', $wbssearch] , ])->orderBy('comwbs_id', 'desc')->first(); 
$indxcomwbs=$comwbs->comwbs_id;
 DB::table('comwbsj')->insert([[  'comwbsj_wbsid' => $wbssearch ,  'comwbsj_test' => $TotalFareD['0']  ,  'comwbsj_comwbsid' =>$SequenceNumberD['0'] ,  'comwbsj_seq' => $SequenceNumberD['0'] ,  'comwbsj_comb' => $refnmsND['0'] ,  'comwbsj_directflg' => $DirectionIdflgD['0'] ,  'comwbsj_price' => $TotalFareD['0'] ,  'comwbsj_deptime' => $originalDate ,  'comwbsj_artime' => $originalDatea ,  'comwbsj_durtfly' => $h.$min  ,  'comwbsj_indirect' => $rfse-1 ,  'comwbsj_class' => $clasnkD['0'],  'comwbsj_airline' => $airlinemarkD['0'],  'comwbsj_index' => $indxcomwbs  ]]); 
    




//k
 for($k = 1; $k <  $rfse+1   ; $k++){ 
$airlinemark  = explode('"OperatingAirlineName":"', $feldsq[$j]);
$airlinemarkD  = explode('","', $airlinemark[$k]);
$marketlog  = explode('"MarketingAirline":"', $feldsq[$j]);
$marketlogD  = explode('","', $marketlog[$k]); 
$flnk = explode('","FlightNumber":"', $feldsq[$j]);
$flnkD = explode('","ResBookDesigCode":"', $flnk[$k]);
$gole = explode('","OperatingAirline":"', $feldsq[$j]);
$goleD = explode('","MarketingAirline":"', $gole[$k]); 
$clasnk = explode('","ResBookDesigCode":"', $feldsq[$j]);
$clasnkD = explode('","ResBookDesigQuantity":"', $clasnk[$k]);

$citydep = explode(',"DepartureCityCountry":"', $feldsq[$j]);
$citydepD = explode(',', $citydep[$k]);	
$cityarriv = explode(',"ArrivaliCityCountry":"', $feldsq[$j]);
$cityarrivD = explode(',', $cityarriv[$k]);	
$feldsqDk = explode(',"DepartureAirport":"', $feldsq[$j]);
$feldsqDkD = explode('(', $feldsqDk[$k]); 
$feldsqDkDD = explode(')', $feldsqDkD['1']);
$feldsqDkar = explode('","ArrivalAirport":"', $feldsq[$j]);
$feldsqDkarD = explode('(', $feldsqDkar[$k]);	
$feldsqDkarDD = explode(')', $feldsqDkarD['1']);	
$deptime = explode('"DepartureDateTime":"', $feldsq[$j]);
$deptimeD = explode('","ArrivalDateTime":"', $deptime[$k]);
$artime = explode('","ArrivalDateTime":"', $feldsq[$j]);
$artimeD = explode('","FlightNumber":"', $artime[$k]);	
$originalDate = $deptimeD['0'];
$newDatedep = date("d F", strtotime($originalDate)); $newDatedept = date("H:i", strtotime($originalDate));
$originalDatea = $artimeD['0'];
$newDatearr = date("d F", strtotime($originalDatea)); $newDatearrt = date("H:i", strtotime($originalDatea)); 

$luggage = explode('"Luggage":"', $feldsq[$j]);
$luggageD = explode('","', $luggage[$k]); 

 $Quantity = explode('"ResBookDesigQuantity":"', $feldsq[$j]);
$QuantityD = explode('","', $Quantity['1']);

 

 



 
$depairports = \DB::table('airports') 
->where([
    ['airports.code', '=', $feldsqDkDD['0']],])
    ->orderBy('airports.code', 'desc')->get(); 
foreach($depairports as $depairport){   $depcityairport=$depairport->cityName;  $depnameairport=$depairport->name; }
 
 
$arrairports = \DB::table('airports') 
->where([
    ['airports.code', '=', $feldsqDkarDD['0']],])
    ->orderBy('airports.code', 'desc')->get(); 
foreach($arrairports as $arrairport){   $arrcityairport=$arrairport->cityName;  $arrnameairport=$arrairport->name; }
 

 


$comwbs=\DB::table('comwbsj') ->where([['comwbsj_wbsid', '=', $wbssearch] , ])->orderBy('comwbsj_id', 'desc')->first(); 
$indxcomwbs=$comwbs->comwbsj_id;

 DB::table('comwbsk')->insert([[  'comwbsk_wbsid' => $wbssearch ,  'comwbsk_marketairline' => $marketlogD['0'],  'comwbsk_flightnumber' => $flnkD['0'],  'comwbsk_clas' => $clasnkD['0'],  'comwbsk_operatorairline' => $goleD['0'],  'comwbsk_logoairline' => $goleD['0'],  'comwbsk_depdate' => $originalDate,  'comwbsk_depyata' => $feldsqDkDD['0'],  'comwbsk_depcity' => $depcityairport,  'comwbsk_depairport' => $depnameairport,  'comwbsk_ardate' => $originalDatea,  'comwbsk_aryata' => $feldsqDkarDD['0'],  'comwbsk_arcity' => $arrcityairport,  'comwbsk_arairport' => $arrnameairport ,  'comwbsk_bag' => $luggageD['0'] ,  'comwbsk_capt' => $QuantityD['0'] ,  'comwbsk_seq' => $SequenceNumberD['0'] ,  'comwbsk_comb' => $refnmsND['0'] ,  'comwbsk_index' => $indxcomwbs     ]]); 
    
    
     
     
 
 
 
 
 
 

 } } }





$wbs=\DB::table('wbs') ->where([['wbs_ip', '=',  $request->ip() ] , ])->orderBy('id', 'desc')->first(); 
 $wbssearch=$wbs->id;
 
  
 /* 
 $wbssearch=$wbs->id;
 */
 
 
 $wbsmysession=$wbs->wbs_uuses;
// $wbssearch='1072';


 

$citys = \DB::table('comwbs')
->join('comwbsj', 'comwbsj.comwbsj_index', '=', 'comwbs.comwbs_id')
->join('comwbsk', 'comwbsk.comwbsk_index', '=', 'comwbsj.comwbsj_id')
->where([['comwbs.comwbs_wbsid', '=',  $wbssearch],]
)->orderBy('comwbsk.comwbsk_id')->get();

 

 return view('indexgds.demowbs', ['result' => $result  , 'citys' => $citys  , 'adult' => $adult  , 'child' => $child  , 'infant' => $infant , 'wbsmysession' => $wbsmysession , 'mtoken' => $mtoken , 'currencyrate' => $currencyrate     ]); 

 
}

		
		
		}
	
	
	
	
	
	public function webservicereturn( Request $request , $token , $dep , $arr , $datewent, $datereturn, $adult, $child, $infant){
		echo $dep; echo '<br>'; 
		echo $arr; echo '<br>'; 
		echo $datewent; echo '<br>'; 
		echo $datereturn; echo '<br>'; 





 
$numcounttoken=\DB::table('userwebservice') ->where([['usw_token', '=',  $token ],])->orderBy('id', 'desc')->count(); 
if($numcounttoken=='1'){
$mtoken=\DB::table('userwebservice') ->where([['usw_token', '=',  $token ],])->orderBy('id', 'desc')->first(); 
$mytoken=$mtoken->usw_token; $curency=$mtoken->usw_curency;  
$currencyrate=\DB::table('currency') ->where([['cur_nem', '=',  $curency],])->orderBy('id', 'desc')->first();   	 
}  



//$year = $dayn.'.'.$monthn.'.'.$yearn.''; 


$departuredater=$datereturn;$flightType='1'; $departure =$dep; $departuredate=$datewent; $arrival=$arr;  $flgstop='1';

  
  
 
        $requestt = '{
            departure: "'.$dep.'",
            arrival: "'.$arr.'",
            departuredate: "'.$datewent.'",
            returndate: "'.$datereturn.'",
            adult: "'.$adult.'" ,
            child: "'.$child.'",
            infant: "'.$infant.'",
            onlydirect: false
        }';
  
  
 
      
 if (empty($_SESSION['ProviderSessionId'])) {
     // echo 'empty';
      }
        
    $headers = array(
        'username:atin_user',
        'password:X4fVgT3a',
        'Content-Type:application/json',
        'request:'.$requestt
    );
        if (! empty($_SESSION['ProviderSessionId'])) {
        $headers['SetSession'] = $_SESSION['ProviderSessionId'];
    }

    		
     //http://88.250.178.229:4545/
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://ucuzauc.com/api/availability/4e53defd-7620-4ac1-b7e1-61c43f34bb76");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $requestt);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 5);
    curl_setopt($ch, CURLOPT_TIMEOUT, 59);
    curl_setopt($ch, CURLOPT_HEADER, 1);
$result = curl_exec($ch);

//echo $result;

$wordChunks = explode("}]}]},", $result);
$statuswbs=count($wordChunks);

if(($statuswbs == '1')||($mytoken!=$token)){ echo 'NOT FOUND'; } else if(($statuswbs != '1')&&($mytoken==$token)) { 
	




$wordChunks = explode("}]}]},", $result);
for($i = 0; $i < count($wordChunks); $i++){ }
if ( ! empty($_SESSION['ProviderSessionId'])) {
      $_SESSION['ProviderSessionId'] =  $wordChunks.uu_SessionId;
      }
  

$ori = explode("OriginDestinationOptionList,", $result );
$wordChunks = explode('{"Currency":"', $result);
$AirlineCode = explode('"ValidatingAirlineCode":"', $result);
$FlightNumber = explode('"FlightNumber":"', $result);
$ResBookDesigCode = explode('"ResBookDesigCode":"', $result);
$time = explode('"DepartureDateTime":"', $result);
$rezerve = explode('"ResBookDesigQuantity":"', $result);
$Havayolu = explode('"MarketingAirlineName":"', $result);
$TOTALEFARE = explode('"TotalFare":', $result);
$DepartureAirport = explode('"DepartureAirport":"', $result); 
$ArrivalAirport = explode('"ArrivalAirport":"', $result); 
$FlightSegment = explode('FlightSegment', $result); 
$SequenceNumber = explode('SequenceNumber":"', $result); 
$sessionid = explode('","sessionid":"', $result);
$sessionidD = explode('","', $sessionid['1']);
$uu_sessionid = explode('"uu_SessionId":"' , $result);
$uu_sessionidD = explode('","sessionid":"' , $uu_sessionid['1']);


	Session::set('wbs_uuses', $uu_sessionidD['0']); 
	
    DB::table('wbs')->insert([
    ['result' => $result  , 'wbs_uuses' => $uu_sessionidD['0']  ,'wbs_sesid' => $sessionidD['0']  , 'wbs_arrival' => $arrival , 'wbs_departure' => $departure , 'wbs_adult' => $adult , 'wbs_child' => $child , 'wbs_infant' => $infant  , 'wbs_departuredate' => $departuredate  , 'wbs_departuredater' => $departuredater  , 'wbs_way' => $flightType , 'wbs_ip' => $request->ip() ,   'wbs_createdatdate' =>  date('Y-m-d H:i:s') ,   'wbs_token' =>  $token        ]
]);   
 
$wbs=\DB::table('wbs') ->where([['wbs_uuses', '=', Session::get('wbs_uuses')] , ])->orderBy('id', 'desc')->first(); 
 $result=$wbs->result; $wbssearch=$wbs->id;



$depnamenamecountry = substr($wbs->wbs_departure,0,3);  $arrnamenamecountry = substr($wbs->wbs_arrival,0,3);
$depairports = \DB::table('airports')  ->where([  ['airports.code', '=', $depnamenamecountry],])  ->orderBy('airports.code', 'desc')->get();  foreach($depairports as $depairport){   $depcityairport=$depairport->cityName;  $depnameairport=$depairport->name;  $depcountryname=$depairport->countryName;  $namefrom = $depcountryname .' _ '.$depcityairport.' _ '.$depnameairport;  }  
  
$arrairports = \DB::table('airports')  ->where([ ['airports.code', '=', $arrnamenamecountry] ,])  ->orderBy('airports.code', 'desc')->get();  foreach($arrairports as $arrairport){   $arrcityairport=$arrairport->cityName;  $arrnameairport=$arrairport->name;  $arrcountryname=$arrairport->countryName; $nameto = $arrcountryname .' _ '.$arrcityairport.' _ '.$arrnameairport; }
 


    DB::table('wbslistsearch')->insert([
    ['id' => $wbs->id    , 'wbs_uuses' => $uu_sessionidD['0']  ,'wbs_sesid' => $sessionidD['0']  , 'wbs_arrival' => $arrival , 'wbs_departure' => $departure , 'wbs_adult' => $adult , 'wbs_child' => $child , 'wbs_infant' => $infant  , 'wbs_departuredate' => $departuredate  , 'wbs_departuredater' => $departuredater  , 'wbs_way' => $flightType , 'wbs_ip' => $request->ip() ,   'wbs_createdatdate' =>  date('Y-m-d H:i:s') ,   'wbs_token' =>  $token   , 'wbs_namefrom' => $namefrom, 'wbs_nameto' => $nameto       ]
]);   
 
 
$wbs=\DB::table('wbs') ->where([['wbs_uuses', '=', Session::get('wbs_uuses')] , ])->orderBy('id', 'desc')->first(); 
$wbsid=$wbs->id;

   $sortcounts=\DB::table('sort') ->where([['sort_wbsid', '=', $wbsid] , ])->orderBy('id', 'desc')->count(); 



for($i = 1; $i < count($wordChunks); $i++){ 
$FlightNumberD = explode('","ResBookDesigCode"', $FlightNumber[$i]);
$ResBookDesigCodeD = explode('","ResBookDesigQuantity"', $ResBookDesigCode[$i]);
$timeD = explode('","ArrivalDateTime"', $time[$i]);
$AirlineCodeD = explode('","ForceETicket":"', $AirlineCode[$i]);
$rezerveD = explode('","DepartureAirport":"', $rezerve[$i]);
$HavayoluD = explode('","Equipment":"', $Havayolu[$i]);
$HavayoluDD = explode('","', $HavayoluD['0']);
$TOTALEFARED = explode(',"ServiceFare":', $TOTALEFARE[$i]);
$DepartureAirportD = explode('","ArrivalAirport":', $DepartureAirport[$i]);
$ArrivalAirportD = explode('","DepartureCityCountry":', $ArrivalAirport[$i]);
$FlightSegmentD = explode('},{"DepartureDateTime":"', $wordChunks[$i]);
$SequenceNumberD = explode('","OriginDestinationOptionList"', $SequenceNumber[$i]);
$flseg=substr_count($SequenceNumber[$i], 'FlightSegment'); 
$flRefNumber=substr_count($SequenceNumber[$i], 'RefNumber');  
$listseg  = explode('","OriginDestinationOptionList"', $wordChunks[$i]); 
$listsegD = explode('","OriginDestinationOptionList"', $listseg['1']);
$refnmD = explode('"RefNumber":"', $listseg['1']); 
$TotalFare = explode(',"TotalFare":', $wordChunks[$i]);
$TotalFareD = explode(',"ServiceFare":', $TotalFare['1']);
$listseg  = explode('","OriginDestinationOptionList"', $wordChunks[$i]); 
$listsegD = explode('","OriginDestinationOptionList"', $listseg['1']);


 $adttprice='0';  $adtbprice='0';  $adtsprice=$adttprice-$adtbprice ; 

if($adult != '0'){
$adtprice = explode('"PassengerType":"Yetişkin"', $wordChunks[$i]);
$adtpriceD = explode(',"TicketDesignators":', $adtprice['1']);	 

$adtbpriceD = explode(',"BaseFare":', $adtpriceD['0']);	
$adtbpriceDD = explode(',"MarkupFare":', $adtbpriceD['1']);	
$adtbprice=	$adtbpriceDD['0'];

$adttpriceD = explode('"TotalFare":', $adtpriceD['0']);	
$adttpriceDD = explode(',"ServiceFare":', $adttpriceD['1']);
$adttprice=	$adttpriceDD['0'];

 $adtsprice=$adttprice-$adtbprice ;

}


 $chdtprice=0; $chdbprice=0; $chdsprice=$chdtprice-$chdbprice ;

if($child != '0'){
$chdprice = explode('"PassengerType":"Çocuk"', $wordChunks[$i]);
$chdpriceD = explode(',"TicketDesignators":', $chdprice['1']);	

$chdbpriceD = explode(',"BaseFare":', $chdpriceD['0']);	
$chdbpriceDD = explode(',"MarkupFare":', $chdbpriceD['1']);	
$chdbprice=	$chdbpriceDD['0'];

$chdtpriceD = explode('"TotalFare":', $chdpriceD['0']);	
$chdtpriceDD = explode(',"ServiceFare":', $chdtpriceD['1']);
$chdtprice=	$chdtpriceDD['0'];

 $chdsprice=$chdtprice-$chdbprice ;

}

 $inftprice=0; $infbprice=0; $infsprice=$inftprice-$infbprice ;

if($infant != '0'){
$infprice = explode('"PassengerType":"Bebek"', $wordChunks[$i]);
$infpriceD = explode(',"TicketDesignators":', $infprice['1']);	

$infbpriceD = explode(',"BaseFare":', $infpriceD['0']);	
$infbpriceDD = explode(',"MarkupFare":', $infbpriceD['1']);	
$infbprice=$infbpriceDD['0'];

$inftpriceD = explode('"TotalFare":', $infpriceD['0']);	
$inftpriceDD = explode(',"ServiceFare":', $inftpriceD['1']);
$inftprice=$inftpriceDD['0'];	


 $infsprice=$inftprice-$infbprice ;

}




 DB::table('comwbs')->insert([[  'comwbs_wbsid' => $wbssearch ,  'comwbs_test' => $TotalFareD['0']  ,  'comwbs_seq' =>$SequenceNumberD['0']  ,  'comwbs_adtbprice' =>$adtbprice ,  'comwbs_chdbprice' =>$chdbprice,  'comwbs_infbprice' =>$infbprice ,  'comwbs_adtsprice' =>$adtsprice ,  'comwbs_chdsprice' =>$chdsprice,  'comwbs_infsprice' =>$infsprice ,  'comwbs_adttprice' =>$adttprice ,  'comwbs_chdtprice' =>$chdtprice,  'comwbs_inftprice' =>$inftprice  ]]); 


 




 if($flightType=='1'){ 
$CombinationIDNumbe=substr_count($SequenceNumber[$i], 'CombinationID'); 
$CombinationIDNumber=$CombinationIDNumbe-1; 
$CombinationList  = explode('OriginDestinationCombinationList', $wordChunks[$i]); 
$CombinationIDNumbeji=substr_count($CombinationList['1'], 'CombinationID'); 
$CombinationListD  = explode('"IndexList":"', $CombinationList['1']); 
for($c = 1; $c <  $CombinationIDNumber+2   ; $c++){   
$IndexList  = explode('","CombinationID":"', $CombinationListD[$c]); 
$comiid  = explode('","', $IndexList['1']); 
$IndexListwentD  = explode(';', $IndexList['0']);  
$IndexListwentD['0']; 
 DB::table('comid')->insert([['seq' => $i-1 ,'seqseq' => $SequenceNumberD['0'] , 'went' => $IndexListwentD['0'] , 'back' => $IndexListwentD['1'] ,    'wbssearch' => $wbssearch ,  'com' => $comiid['0']  ]]);
}  
}


 for($j = 1; $j < $flseg+1; $j++){ 
$feldsq  = explode('FlightSegment":[{', $listsegD['0']); 
$refnmsD = explode('FlightSegment', $refnmD[$j]); 
$refnmsND = explode('","DirectionId":"', $refnmsD['0']); 
$DirectionIdflgD = explode('","', $refnmsND['1']);  
$ElapsedTime = explode('","ElapsedTime":"', $refnmsD['0']); 
$ElapsedTimeD = explode('","', $ElapsedTime['1']);   
$directsD = explode('","', $ElapsedTime['0']);   
$directsidD = explode('DirectionId":"', $directsD['1']);    
$rfse=substr_count($refnmsD['1'], 'DepartureAirport');   

$airlinemark  = explode('"OperatingAirlineName":"', $listsegD['0']);
$airlinemarkD  = explode('","', $airlinemark['1']);
$marketlog  = explode('"MarketingAirline":"', $listsegD['0']);
$marketlogD  = explode('","', $marketlog['1']);

$feldsqDk = explode(',"DepartureAirport":"', $feldsq[$j]);
$feldsqDkD = explode('(', $feldsqDk['1']);
$feldsqDkDD = explode(')', $feldsqDkD['1']);
$deptime = explode('"DepartureDateTime":"', $feldsq[$j]);
$deptimeD = explode('","ArrivalDateTime":"', $deptime['1']);
$originalDate = $deptimeD['0'];
$newDatedep = date("d F", strtotime($originalDate)); $newDatedept = date("H:i", strtotime($originalDate));  

 $string=$ElapsedTimeD['0']; $min = '';$h = '';
for ($index=0;$index<strlen($string);$index++) { if($index<2){ $h .= $string[$index]; } else { $min .= $string[$index]; }} 


$feldsqDkar = explode('","ArrivalAirport":"', $feldsq[$j]);
$feldsqDkarD = explode('(', $feldsqDkar[$rfse]);	
$feldsqDkarDD = explode(')', $feldsqDkarD['1']);	
$artime = explode('","ArrivalDateTime":"', $feldsq[$j]);
$artimeD = explode('","FlightNumber":"', $artime[$rfse]);	
$originalDatea = $artimeD['0'];
$newDatearr = date("d F", strtotime($originalDatea)); $newDatearrt = date("H:i", strtotime($originalDatea));

$luggage = explode('"Luggage":"', $feldsq[$j]);
$luggageD = explode('","', $luggage['1']);

   

$clasnk = explode('","ResBookDesigCode":"', $feldsq[$j]);
$clasnkD = explode('","ResBookDesigQuantity":"', $clasnk['1']);






   
 if($sortcounts=='0'){ 
 
$dirf=$rfse+1;
 if($flgstop=='1'){ $show='1'; } else 
      if($flgstop=='2'){ if($dirf=='2') {$show='0';} else if($dirf!='2') {$show='1';}  }
else  if($flgstop=='3'){ if($dirf=='2') {$show='1';} else if($dirf!='2') {$show='0';}   }   



 	
$sairlinest  = explode(" ", $airlinemarkD['0']); 	
$sairlinestD  = $sairlinest['0']; 
  DB::table('sort')->insert([['sort_seq' => $i-1 , 'sort_comb' => $j-1 ,'sort_price' => $TotalFareD['0'] , 'sort_wbsid' => $wbsid  , 'sort_duritfly' => $h.$min   , 'sort_deptime' => $originalDate , 'sort_artime' => $originalDatea ,  'sort_airline' => $airlinemarkD['0'] ,  'sort_indirect' => $rfse+1  ,  'sort_class' => $clasnkD['0'] ,  'sort_show' => $show ]]);  	
  
  
   $sortvcounts=\DB::table('sortv') ->where([['sortv_wbsid', '=', $wbsid] ,['sortv_price', '=', $TotalFareD['0']] , ])->orderBy('id')->count(); 
  
  
 if($sortvcounts=='0'){
 
   $sairlinest  = explode(" ", $airlinemarkD['0']); 	
  $sairlinestD  = $sairlinest['0']; 		
 	

$sortvaircounts=\DB::table('sortv') ->where([['sortv_wbsid', '=', $wbsid] ,['sortv_airline', '=', $airlinemarkD['0']],  ])->orderBy('id')->count(); 	
 if($sortvaircounts=='0'){ $flgairline=1; } else  if($sortvaircounts!='0'){ $flgairline=0; }
 	

$sortvclascounts=\DB::table('sortv') ->where([['sortv_wbsid', '=', $wbsid] ,['sortv_class', '=',$clasnkD['0'] ],  ])->orderBy('id')->count(); 	
 if($sortvclascounts=='0'){ $flgaclas=1; } else  if($sortvclascounts!='0') { $flgaclas=0; }

$sortvindirectcounts=\DB::table('sortv') ->where([['sortv_wbsid', '=', $wbsid] ,['sortv_indirect', '=',$rfse+1 ],  ])->orderBy('id')->count(); 	
 if($sortvindirectcounts=='0'){ $indirect=1; } else  if($sortvindirectcounts!='0') { $indirect=0; }
 	
 	
  DB::table('sortv')->insert([[  'sortv_price' => $TotalFareD['0'] , 'sortv_wbsid' => $wbsid  ,   'sortv_airline' => $airlinemarkD['0'] ,  'sortv_class' => $clasnkD['0']  ,  'sortv_indirect' => $rfse+1 ,  'sortv_airlineflg' => $flgairline ,  'sortv_clasflg' => $flgaclas ,  'sortv_indirectflg' => $indirect ,  'sortv_priceflg' => '1' ]]);  
  }	
  
  
  
  
 }  


 
$comwbs=\DB::table('comwbs') ->where([['comwbs_wbsid', '=', $wbssearch] , ])->orderBy('comwbs_id', 'desc')->first(); 
$indxcomwbs=$comwbs->comwbs_id;
 DB::table('comwbsj')->insert([[  'comwbsj_wbsid' => $wbssearch ,  'comwbsj_test' => $TotalFareD['0']  ,  'comwbsj_comwbsid' =>$SequenceNumberD['0'] ,  'comwbsj_seq' => $SequenceNumberD['0'] ,  'comwbsj_comb' => $refnmsND['0'] ,  'comwbsj_directflg' => $DirectionIdflgD['0'] ,  'comwbsj_price' => $TotalFareD['0'] ,  'comwbsj_deptime' => $originalDate ,  'comwbsj_artime' => $originalDatea ,  'comwbsj_durtfly' => $h.$min  ,  'comwbsj_indirect' => $rfse-1 ,  'comwbsj_class' => $clasnkD['0'],  'comwbsj_airline' => $airlinemarkD['0'],  'comwbsj_index' => $indxcomwbs  ]]); 
    




//k
 for($k = 1; $k <  $rfse+1   ; $k++){ 
$airlinemark  = explode('"OperatingAirlineName":"', $feldsq[$j]);
$airlinemarkD  = explode('","', $airlinemark[$k]);
$marketlog  = explode('"MarketingAirline":"', $feldsq[$j]);
$marketlogD  = explode('","', $marketlog[$k]); 
$flnk = explode('","FlightNumber":"', $feldsq[$j]);
$flnkD = explode('","ResBookDesigCode":"', $flnk[$k]);
$gole = explode('","OperatingAirline":"', $feldsq[$j]);
$goleD = explode('","MarketingAirline":"', $gole[$k]); 
$clasnk = explode('","ResBookDesigCode":"', $feldsq[$j]);
$clasnkD = explode('","ResBookDesigQuantity":"', $clasnk[$k]);

$citydep = explode(',"DepartureCityCountry":"', $feldsq[$j]);
$citydepD = explode(',', $citydep[$k]);	
$cityarriv = explode(',"ArrivaliCityCountry":"', $feldsq[$j]);
$cityarrivD = explode(',', $cityarriv[$k]);	
$feldsqDk = explode(',"DepartureAirport":"', $feldsq[$j]);
$feldsqDkD = explode('(', $feldsqDk[$k]); 
$feldsqDkDD = explode(')', $feldsqDkD['1']);
$feldsqDkar = explode('","ArrivalAirport":"', $feldsq[$j]);
$feldsqDkarD = explode('(', $feldsqDkar[$k]);	
$feldsqDkarDD = explode(')', $feldsqDkarD['1']);	
$deptime = explode('"DepartureDateTime":"', $feldsq[$j]);
$deptimeD = explode('","ArrivalDateTime":"', $deptime[$k]);
$artime = explode('","ArrivalDateTime":"', $feldsq[$j]);
$artimeD = explode('","FlightNumber":"', $artime[$k]);	
$originalDate = $deptimeD['0'];
$newDatedep = date("d F", strtotime($originalDate)); $newDatedept = date("H:i", strtotime($originalDate));
$originalDatea = $artimeD['0'];
$newDatearr = date("d F", strtotime($originalDatea)); $newDatearrt = date("H:i", strtotime($originalDatea)); 

$luggage = explode('"Luggage":"', $feldsq[$j]);
$luggageD = explode('","', $luggage[$k]); 

 $Quantity = explode('"ResBookDesigQuantity":"', $feldsq[$j]);
$QuantityD = explode('","', $Quantity['1']);

 

 



 
$depairports = \DB::table('airports') 
->where([
    ['airports.code', '=', $feldsqDkDD['0']],])
    ->orderBy('airports.code', 'desc')->get(); 
foreach($depairports as $depairport){   $depcityairport=$depairport->cityName;  $depnameairport=$depairport->name; }
 
 
$arrairports = \DB::table('airports') 
->where([
    ['airports.code', '=', $feldsqDkarDD['0']],])
    ->orderBy('airports.code', 'desc')->get(); 
foreach($arrairports as $arrairport){   $arrcityairport=$arrairport->cityName;  $arrnameairport=$arrairport->name; }
 

 


$comwbs=\DB::table('comwbsj') ->where([['comwbsj_wbsid', '=', $wbssearch] , ])->orderBy('comwbsj_id', 'desc')->first(); 
$indxcomwbs=$comwbs->comwbsj_id;

 DB::table('comwbsk')->insert([[  'comwbsk_wbsid' => $wbssearch ,  'comwbsk_marketairline' => $marketlogD['0'],  'comwbsk_flightnumber' => $flnkD['0'],  'comwbsk_clas' => $clasnkD['0'],  'comwbsk_operatorairline' => $goleD['0'],  'comwbsk_logoairline' => $goleD['0'],  'comwbsk_depdate' => $originalDate,  'comwbsk_depyata' => $feldsqDkDD['0'],  'comwbsk_depcity' => $depcityairport,  'comwbsk_depairport' => $depnameairport,  'comwbsk_ardate' => $originalDatea,  'comwbsk_aryata' => $feldsqDkarDD['0'],  'comwbsk_arcity' => $arrcityairport,  'comwbsk_arairport' => $arrnameairport ,  'comwbsk_bag' => $luggageD['0'] ,  'comwbsk_capt' => $QuantityD['0'] ,  'comwbsk_seq' => $SequenceNumberD['0'] ,  'comwbsk_comb' => $refnmsND['0'] ,  'comwbsk_index' => $indxcomwbs     ]]); 
    
    
     
     
 
 
 
 
 
 

 } } }





$wbs=\DB::table('wbs') ->where([['wbs_ip', '=',  $request->ip() ] , ])->orderBy('id', 'desc')->first(); 
 $wbssearch=$wbs->id;
 
  
 /* 
 $wbssearch=$wbs->id;
 */
 
 
 $wbsmysession=$wbs->wbs_uuses;
// $wbssearch='1072';


 

$citys = \DB::table('comwbs')
->join('comwbsj', 'comwbsj.comwbsj_index', '=', 'comwbs.comwbs_id')
->join('comwbsk', 'comwbsk.comwbsk_index', '=', 'comwbsj.comwbsj_id')
->where([['comwbs.comwbs_wbsid', '=',  $wbssearch],]
)->orderBy('comwbsk.comwbsk_id')->get();


$comids = \DB::table('comid')
->where([['comid.wbssearch', '=',  $wbssearch],]
)->orderBy('comid.id')->get();
 
 

 return view('indexgds.demowbsreturn', ['result' => $result  , 'citys' => $citys  , 'adult' => $adult  , 'child' => $child  , 'infant' => $infant , 'wbsmysession' => $wbsmysession , 'comids' => $comids  , 'mtoken' => $mtoken , 'currencyrate' => $currencyrate   ]); 

 
}

		
		
		}
	
	
	
	
	
	
	
	public function testreq(Request $request){
		  
	/*
	$country = 'PHP cURL'; 
$curl = curl_init('https://localhost/flight/testrequest'); 



    $headers = array(
        'username:atin_user',
        'password:X4fVgT3a',
        'Content-Type:application/json' 
    );
 

curl_setopt($curl, CURLOPT_POST, 1); 

$headers    = [];
$headers[]  = 'Content-Type: application/json';

    curl_setopt($curl, CURLOPT_HEADER, $headers);



curl_setopt($curl, CURLOPT_POSTFIELDS, 'var_1=content_1&var_2=content_2&var_3=content_3'); 
curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE); 
$result = curl_exec($curl); 
echo $result;
*/



$curl = curl_init('http://localhost/wbs/recv.php');

$arrayrequest=array(
        'seq' => 'test',
        'comb' => 'testy' ,
		 "passenger" => array() );
		  
$i=0;
while($i<1){		  
 $arrayrequest['passenger'][]=array(
 				  "name" => "male" ,
		  		  "family" => "yosefi",
		  		  "type" => "adult" );  
$i++; }

$request = json_encode($arrayrequest); 
 
$sd= array(
        'mytoken' => 'mytoken',
        'username' => 'username' ,
        'request' => $request   )  ;  
  
  
curl_setopt($curl, CURLOPT_POST, 1); 
curl_setopt($curl, CURLOPT_HEADER, 1);
//curl_setopt($curl, CURLOPT_POSTFIELDS, 'var_1=content_1&var_2=content_2&var_3=content_3');
curl_setopt($curl, CURLOPT_POSTFIELDS,     $sd );
curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
$result = curl_exec($curl);
echo $result;


		
		
		
		}	
		
		
		
		
		
		
		
		

	public function demowebservice(Request $request){
		
$result='0';
 


$wbs=\DB::table('wbs') ->where([['wbs_ip', '=',  $request->ip() ] , ])->orderBy('id', 'desc')->first();

 
 $wbssearch=$wbs->id;
 
   //$wbssearch='1118';
 
 
 $wbsmysession=$wbs->wbs_uuses;
 


 

$citys = \DB::table('comwbs')
->join('comwbsj', 'comwbsj.comwbsj_index', '=', 'comwbs.comwbs_id')
->join('comwbsk', 'comwbsk.comwbsk_index', '=', 'comwbsj.comwbsj_id')
->where([['comwbs.comwbs_wbsid', '=',  $wbssearch],]
)->orderBy('comwbsk.comwbsk_id')->get();
 
 
 $adult=1;
 $child=0;
 $infant=0;
 
  

 return view('indexgds.demowbs', ['result' => $result  , 'citys' => $citys  , 'adult' => $adult  , 'child' => $child  , 'infant' => $infant  ,  'wbsmysession' => $wbsmysession   ]); 


		}

	

	public function demowebservicereturn(Request $request){
		
$result='0';
 
 


$wbs=\DB::table('wbs') ->where([['wbs_ip', '=',  $request->ip() ] , ])->orderBy('id', 'desc')->first();

 
 $wbssearch=$wbs->id;
 
 
 
 $wbsmysession=$wbs->wbs_uuses;
 
   //$wbssearch='1117';

 

$citys = \DB::table('comwbs')
->join('comwbsj', 'comwbsj.comwbsj_index', '=', 'comwbs.comwbs_id')
->join('comwbsk', 'comwbsk.comwbsk_index', '=', 'comwbsj.comwbsj_id')
->where([['comwbs.comwbs_wbsid', '=',  $wbssearch],]
)->orderBy('comwbsk.comwbsk_id')->get();


$comids = \DB::table('comid')
->where([['comid.wbssearch', '=',  $wbssearch],]
)->orderBy('comid.id')->get();
 
 

 return view('indexgds.demowbsreturn', ['result' => $result  , 'citys' => $citys ,  'comids' => $comids     ]); 


		}


	public function testwebservicee(){
		

			 
$json = ' 
{"Status":"TRUE","Currency":"TL","sessionid":"bioecitxwrou4qwmawrh5mjp","Listtypepassenger":[{"adult":"1" , "child":"0" , "infant":"0"}],"Listpricepassenger":[{"adultbaseprice":"4026.64" , "adultserviceprice":"912.94" , "adulttotalprice":"4939.58" }],"Listpassenger":[{"type":"ADT" , "gender":"MR" , "name":"mostafa" , "family":"yosefi" , "national":"IR", "birthdate":"23.10.2000", "passportnumber":"123456" }],

"Seqment":[{"seq":0,"wbsid":1237,
"DIRECTS":[ { "cmbidwent":0,"cmbidreturn":0,"combitionid":0} ],

"combitaonid":[{"comb":0,"price":"4939.58","Directionid":"0","airline":"Siberia Airlines","durtfly":"","indirect":"2","flightsegment":[{"depyata":"DYU","depdate":"2018-07-14T16:05:00","depcity":"Dushanbe","depairport":"Dushanbe Arpt","aryata":"OVB","ardate":"2018-07-14T21:20:00","arcity":"Novosibirsk","arairport":"Tolmachevo Arpt","class":"V"} , {"depyata":"OVB","depdate":"2018-07-15T08:40:00","depcity":"Novosibirsk","depairport":"Tolmachevo Arpt","aryata":"DME","ardate":"2018-07-15T08:55:00","arcity":"Moscow","arairport":"Domodedovo Arpt","class":"S"} , {"depyata":"DME","depdate":"2018-07-15T18:05:00","depcity":"Moscow","depairport":"Domodedovo Arpt","aryata":"DXB","ardate":"2018-07-16T00:05:00","arcity":"Dubai","arairport":"Dubai Intl Arpt","class":"S"}]},{"comb":0,"price":"4939.58","Directionid":"1","airline":"Siberia Airlines","durtfly":"","indirect":"2","flightsegment":[{"depyata":"DXB","depdate":"2018-07-21T16:15:00","depcity":"Dubai","depairport":"Dubai Intl Arpt","aryata":"DME","ardate":"2018-07-21T20:30:00","arcity":"Moscow","arairport":"Domodedovo Arpt","class":"W"} , {"depyata":"DME","depdate":"2018-07-22T00:50:00","depcity":"Moscow","depairport":"Domodedovo Arpt","aryata":"SVX","ardate":"2018-07-22T05:10:00","arcity":"Ekaterinburg","arairport":"Koltsovo Arpt","class":"W"} , {"depyata":"SVX","depdate":"2018-07-22T23:55:00","depcity":"Ekaterinburg","depairport":"Koltsovo Arpt","aryata":"DYU","ardate":"2018-07-23T03:15:00","arcity":"Dushanbe","arairport":"Dushanbe Arpt","class":"L"}]},{"comb":1,"price":"4939.58","Directionid":"0","airline":"Siberia Airlines","durtfly":"","indirect":"2","flightsegment":[{"depyata":"DYU","depdate":"2018-07-14T16:05:00","depcity":"Dushanbe","depairport":"Dushanbe Arpt","aryata":"OVB","ardate":"2018-07-14T21:20:00","arcity":"Novosibirsk","arairport":"Tolmachevo Arpt","class":"V"} , {"depyata":"OVB","depdate":"2018-07-15T08:40:00","depcity":"Novosibirsk","depairport":"Tolmachevo Arpt","aryata":"DME","ardate":"2018-07-15T08:55:00","arcity":"Moscow","arairport":"Domodedovo Arpt","class":"S"} , {"depyata":"DME","depdate":"2018-07-15T23:50:00","depcity":"Moscow","depairport":"Domodedovo Arpt","aryata":"DXB","ardate":"2018-07-16T06:05:00","arcity":"Dubai","arairport":"Dubai Intl Arpt","class":"S"}]}]}]} ';



 $arr = json_decode($json, true);  
 echo $arr["Seqment"][0]["combitaonid"][0]["flightsegment"][0]["aryata"] . "<br>";  // Output: Harry Potter




		}



	public function tablewbs(){
		
 
$citys = \DB::table('comwbs')
->join('comwbsj', 'comwbsj.comwbsj_seq', '=', 'comwbs.comwbs_seq')
->where([['comwbs.comwbs_wbsid', '=',  '1056'],]
)->orderBy('comwbsj.comwbsj_id' , 'desc' )->get();


/*foreach($citys as $city){
	echo $city->comwbsj_seq;
	echo '<br>';
	}
*/


 return view('indexgds.tablewbs', ['citys' => $citys    ]); 


		}











public function curencyind( $curency , Request $request){ 	

$lngmenus= \DB::table('language') ->where([['id', '<>',  '0'],['lng_active', '=',  '1'],])->orderBy('id', 'desc')->get();
$lngmenu=\DB::table('language') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first();
return redirect('/');
 


}







public function sortt( $sort , Request $request){ 	

$lngmenus= \DB::table('language') ->where([['id', '<>',  '0'],['lng_active', '=',  '1'],])->orderBy('id', 'desc')->get();
$lngmenu=\DB::table('language') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first();


$wbs=\DB::table('wbs') ->where([['wbs_uuses', '=', Session::get('wbs_uuses')] , ])->orderBy('id', 'desc')->first(); 
$wbsid=$wbs->id;
$wbssort=$wbs->wbs_sort;

 
 

if($sort=='nonstop'){ 
$sorts=\DB::table('sort') ->where([['sort_wbsid', '=', $wbsid],['sort_indirect', '=', '2'] , ])->orderBy('sort_seq')->get(); 
$sortcounts=\DB::table('sort') ->where([['sort_wbsid', '=', $wbsid],['sort_indirect', '=', '2'] , ])->orderBy('sort_seq')->count(); 	} 
else if($sort=='stop'){ 
$sorts=\DB::table('sort') ->where([['sort_wbsid', '=', $wbsid],['sort_indirect', '!=', '2'] , ])->orderBy('sort_seq')->get(); 
$sortcounts=\DB::table('sort') ->where([['sort_wbsid', '=', $wbsid],['sort_indirect', '!=', '2'] , ])->orderBy('sort_seq')->count(); 	} 
else { 		$sorts=\DB::table('sort') ->where([['sort_wbsid', '=', $wbsid] , ])->orderBy($sort)->get(); 	
	   $sortcounts=\DB::table('sort') ->where([['sort_wbsid', '=', $wbsid] , ])->orderBy($sort)->count(); 	   }



 $departuredate=$wbs->wbs_departuredate;
 $departuredater=$wbs->wbs_departuredater; 

if($wbssort=='0'){
$datenew = explode(" ", $departuredate);   $monthh=$datenew['1']; $dayn=$datenew['2'];  $yearn=$datenew['3'];   
if($monthh=='Jan'){ $monthn='01';} else if($monthh=='Feb'){ $monthn='02';}  else if($monthh=='Mar'){ $monthn='03';}   else if($monthh=='Apr'){ $monthn='04';} else if($monthh=='May'){ $monthn='05';}  else if($monthh=='Jun'){ $monthn='06';}   else if($monthh=='Jul'){ $monthn='07';} else if($monthh=='Aug'){ $monthn='08';}  else if($monthh=='Sep'){ $monthn='09';}   else if($monthh=='Oct'){ $monthn='10';} else if($monthh=='Nov'){ $monthn='11';}  else if($monthh=='Dec'){ $monthn='12';} 
$year = $dayn.'.'.$monthn.'.'.$yearn.''; 

$updatee = \DB::table('wbs')->where([['id', '=',  $wbsid],])->update(['wbs_sort' => '1'   ]); 
}
else if($wbssort!='0'){ $year=$wbs->wbs_departuredate; }



 
 $arrival=$wbs->wbs_arrival; $departure=$wbs->wbs_departure;    $departuredater=$wbs->wbs_departuredater;  $adult=$wbs->wbs_adult;  $child=$wbs->wbs_child; $infant=$wbs->wbs_infant; $result=$wbs->result;  
$airports= \DB::table('airports') ->where([['code', '<>',  '0'],])->orderBy('obs')->get(); 
$currency=\DB::table('currency') ->where([['cur_nem', '=',  Session::get('curnem')],])->orderBy('id', 'desc')->first();   
	
if($wbs->wbs_way=='0'){	   
 return view('superadmin.sort', ['result' => $result , 'lngmenus' => $lngmenus , 'lngmenu' => $lngmenu , 'arrival' => $arrival , 'departure' => $departure, 'year' => $year , 'departuredate' => $departuredate, 'adult' => $adult , 'child' => $child , 'infant' => $infant , 'airports' => $airports, 'wbs' => $wbs  , 'currency' => $currency  , 'sorts' => $sorts  , 'sortcounts' => $sortcounts  ]); 
}

}












public function sort(Request $request){ 	
 

$lngmenus= \DB::table('language') ->where([['id', '<>',  '0'],['lng_active', '=',  '1'],])->orderBy('id', 'desc')->get();
$lngmenu=\DB::table('language') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first();
 
 
 $wbs=\DB::table('wbs') ->where([['id', '=', '1031'] , ])->orderBy('id', 'desc')->first(); 
$wbsid=$wbs->id;

$result = $wbs->result;
 
$admins = \DB::table('sort')->where([['sort_wbsid', '=',  $wbsid],])->delete(); 

$admins = \DB::table('sortv')->where([['sortv_wbsid', '=',  $wbsid],])->delete(); 

 $departuredate=$wbs->wbs_departuredate;
 $departuredater=$wbs->wbs_departuredater; 
$datenew = explode(" ", $departuredate);   $monthh=$datenew['1']; $dayn=$datenew['2'];  $yearn=$datenew['3'];   
if($monthh=='Jan'){ $monthn='01';} else if($monthh=='Feb'){ $monthn='02';}  else if($monthh=='Mar'){ $monthn='03';}   else if($monthh=='Apr'){ $monthn='04';} else if($monthh=='May'){ $monthn='05';}  else if($monthh=='Jun'){ $monthn='06';}   else if($monthh=='Jul'){ $monthn='07';} else if($monthh=='Aug'){ $monthn='08';}  else if($monthh=='Sep'){ $monthn='09';}   else if($monthh=='Oct'){ $monthn='10';} else if($monthh=='Nov'){ $monthn='11';}  else if($monthh=='Dec'){ $monthn='12';} 
$year = $dayn.'.'.$monthn.'.'.$yearn.''; 
 
 $arrival=$wbs->wbs_arrival; $departure=$wbs->wbs_departure;    $departuredater=$wbs->wbs_departuredater;  $adult=$wbs->wbs_adult;  $child=$wbs->wbs_child; $infant=$wbs->wbs_infant;  $result=$wbs->result; 
 
 
$airports= \DB::table('airports') ->where([['code', '<>',  '0'],])->orderBy('obs')->get(); 
  	 

$ori = explode("OriginDestinationOptionList,", $result );
$wordChunks = explode('{"Currency":"', $result);
$AirlineCode = explode('"ValidatingAirlineCode":"', $result);
$FlightNumber = explode('"FlightNumber":"', $result);
$ResBookDesigCode = explode('"ResBookDesigCode":"', $result);
$time = explode('"DepartureDateTime":"', $result);
$rezerve = explode('"ResBookDesigQuantity":"', $result);
$Havayolu = explode('"MarketingAirlineName":"', $result);
$TOTALEFARE = explode('"TotalFare":', $result);
$DepartureAirport = explode('"DepartureAirport":"', $result); 
$ArrivalAirport = explode('"ArrivalAirport":"', $result); 
$FlightSegment = explode('FlightSegment', $result); 
$SequenceNumber = explode('SequenceNumber":"', $result); 
$sessionid = explode('","sessionid":"', $result);
$sessionidD = explode('","', $sessionid['1']);
$uu_sessionid = explode('"uu_SessionId":"' , $result);
$uu_sessionidD = explode('","sessionid":"' , $uu_sessionid['1']);


	Session::set('wbs_uuses', $uu_sessionidD['0']); 
	 
   $sortcounts=\DB::table('sort') ->where([['sort_wbsid', '=', $wbsid] , ])->orderBy('id')->count(); 


for($i = 1; $i < count($wordChunks); $i++){ 
$FlightNumberD = explode('","ResBookDesigCode"', $FlightNumber[$i]);
$ResBookDesigCodeD = explode('","ResBookDesigQuantity"', $ResBookDesigCode[$i]);
$timeD = explode('","ArrivalDateTime"', $time[$i]);
$AirlineCodeD = explode('","ForceETicket":"', $AirlineCode[$i]);
$rezerveD = explode('","DepartureAirport":"', $rezerve[$i]);
$HavayoluD = explode('","Equipment":"', $Havayolu[$i]);
$HavayoluDD = explode('","', $HavayoluD['0']);
$TOTALEFARED = explode(',"ServiceFare":', $TOTALEFARE[$i]);
$DepartureAirportD = explode('","ArrivalAirport":', $DepartureAirport[$i]);
$ArrivalAirportD = explode('","DepartureCityCountry":', $ArrivalAirport[$i]);
$FlightSegmentD = explode('},{"DepartureDateTime":"', $wordChunks[$i]);
$SequenceNumberD = explode('","OriginDestinationOptionList"', $SequenceNumber[$i]);
$flseg=substr_count($SequenceNumber[$i], 'FlightSegment'); 
$flRefNumber=substr_count($SequenceNumber[$i], 'RefNumber');  
$listseg  = explode('","OriginDestinationOptionList"', $wordChunks[$i]); 
$listsegD = explode('","OriginDestinationOptionList"', $listseg['1']);
$refnmD = explode('"RefNumber":"', $listseg['1']); 
$TotalFare = explode(',"TotalFare":', $wordChunks[$i]);
$TotalFareD = explode(',"ServiceFare":', $TotalFare['1']);
$listseg  = explode('","OriginDestinationOptionList"', $wordChunks[$i]); 
$listsegD = explode('","OriginDestinationOptionList"', $listseg['1']);






 if($wbs->wbs_way=='1'){ 
$CombinationIDNumbe=substr_count($SequenceNumber[$i], 'CombinationID'); 
$CombinationIDNumber=$CombinationIDNumbe-1; 
$CombinationList  = explode('OriginDestinationCombinationList', $wordChunks[$i]); 
$CombinationIDNumbeji=substr_count($CombinationList['1'], 'CombinationID'); 
$CombinationListD  = explode('"IndexList":"', $CombinationList['1']); 
for($c = 1; $c <  $CombinationIDNumber+2   ; $c++){   
$IndexList  = explode('","CombinationID":"', $CombinationListD[$c]); 
$comiid  = explode('","', $IndexList['1']); 
$IndexListwentD  = explode(';', $IndexList['0']);  
$IndexListwentD['0']; 
 DB::table('comid')->insert([['seq' => $i-1 , 'went' => $IndexListwentD['0'] , 'back' => $IndexListwentD['1'] ,    'wbssearch' => $wbssearch ,  'com' => $comiid['0']  ]]);  
}  
}


 for($j = 1; $j < $flseg+1; $j++){ 
$feldsq  = explode('FlightSegment":[{', $listsegD['0']); 
$refnmsD = explode('FlightSegment', $refnmD[$j]); 
$refnmsND = explode('","DirectionId":"', $refnmsD['0']); 
$ElapsedTime = explode('","ElapsedTime":"', $refnmsD['0']); 
$ElapsedTimeD = explode('","', $ElapsedTime['1']);   
$directsD = explode('","', $ElapsedTime['0']);   
$directsidD = explode('DirectionId":"', $directsD['1']);    
$rfse=substr_count($refnmsD['1'], 'DepartureAirport');   

$airlinemark  = explode('"OperatingAirlineName":"', $listsegD['0']);
$airlinemarkD  = explode('","', $airlinemark['1']);
$marketlog  = explode('"MarketingAirline":"', $listsegD['0']);
$marketlogD  = explode('","', $marketlog['1']);

$feldsqDk = explode(',"DepartureAirport":"', $feldsq[$j]);
$feldsqDkD = explode('(', $feldsqDk['1']);
$feldsqDkDD = explode(')', $feldsqDkD['1']);
$deptime = explode('"DepartureDateTime":"', $feldsq[$j]);
$deptimeD = explode('","ArrivalDateTime":"', $deptime['1']);
$originalDate = $deptimeD['0'];
$newDatedep = date("d F", strtotime($originalDate)); $newDatedept = date("H:i", strtotime($originalDate));  

 $string=$ElapsedTimeD['0']; $min = '';$h = '';
for ($index=0;$index<strlen($string);$index++) { if($index<2){ $h .= $string[$index]; } else { $min .= $string[$index]; }} 

$feldsqDkar = explode('","ArrivalAirport":"', $feldsq[$j]);
$feldsqDkarD = explode('(', $feldsqDkar[$rfse]);	
$feldsqDkarDD = explode(')', $feldsqDkarD['1']);	
$artime = explode('","ArrivalDateTime":"', $feldsq[$j]);
$artimeD = explode('","FlightNumber":"', $artime[$rfse]);	
$originalDatea = $artimeD['0'];
$newDatearr = date("d F", strtotime($originalDatea)); $newDatearrt = date("H:i", strtotime($originalDatea));

$luggage = explode('"Luggage":"', $feldsq[$j]);
$luggageD = explode('","', $luggage['1']);

   

$clasnk = explode('","ResBookDesigCode":"', $feldsq[$j]);
$clasnkD = explode('","ResBookDesigQuantity":"', $clasnk['1']);



   
 if($sortcounts=='0'){ 	
$sairlinest  = explode(" ", $airlinemarkD['0']); 	
$sairlinestD  = $sairlinest['0']; 
  DB::table('sort')->insert([['sort_seq' => $i-1 , 'sort_comb' => $j-1 ,'sort_price' => $TotalFareD['0'] , 'sort_wbsid' => $wbsid  , 'sort_duritfly' => $h.$min   , 'sort_deptime' => $originalDate , 'sort_artime' => $originalDatea ,  'sort_airline' => $sairlinestD ,  'sort_indirect' => $rfse+1  ,  'sort_class' => $clasnkD['0'] ,  'sort_show' => '1' ]]);  	
  
  
   $sortvcounts=\DB::table('sortv') ->where([['sortv_wbsid', '=', $wbsid] ,['sortv_price', '=', $TotalFareD['0']] , ])->orderBy('id')->count(); 
  
  
 if($sortvcounts=='0'){
 
   $sairlinest  = explode(" ", $airlinemarkD['0']); 	
  $sairlinestD  = $sairlinest['0']; 		
 	

$sortvaircounts=\DB::table('sortv') ->where([['sortv_wbsid', '=', $wbsid] ,['sortv_airline', '=', $sairlinestD],  ])->orderBy('id')->count(); 	
 if($sortvaircounts=='0'){ $flgairline=1; } else  if($sortvaircounts!='0'){ $flgairline=0; }
 	

$sortvclascounts=\DB::table('sortv') ->where([['sortv_wbsid', '=', $wbsid] ,['sortv_class', '=',$clasnkD['0'] ],  ])->orderBy('id')->count(); 	
 if($sortvclascounts=='0'){ $flgaclas=1; } else  if($sortvclascounts!='0') { $flgaclas=0; }

$sortvindirectcounts=\DB::table('sortv') ->where([['sortv_wbsid', '=', $wbsid] ,['sortv_indirect', '=',$rfse+1 ],  ])->orderBy('id')->count(); 	
 if($sortvindirectcounts=='0'){ $indirect=1; } else  if($sortvindirectcounts!='0') { $indirect=0; }
 	
 	
  DB::table('sortv')->insert([[  'sortv_price' => $TotalFareD['0'] , 'sortv_wbsid' => $wbsid  ,   'sortv_airline' => $sairlinestD ,  'sortv_class' => $clasnkD['0']  ,  'sortv_indirect' => $rfse+1 ,  'sortv_airlineflg' => $flgairline ,  'sortv_clasflg' => $flgaclas ,  'sortv_indirectflg' => $indirect ,  'sortv_priceflg' => '1' ]]);  
  }	
  
  
  
  
 }  



//k
 for($k = 1; $k <  $rfse+1   ; $k++){ 
$airlinemark  = explode('"OperatingAirlineName":"', $feldsq[$j]);
$airlinemarkD  = explode('","', $airlinemark[$k]);
$marketlog  = explode('"MarketingAirline":"', $feldsq[$j]);
$marketlogD  = explode('","', $marketlog[$k]); 
$flnk = explode('","FlightNumber":"', $feldsq[$j]);
$flnkD = explode('","ResBookDesigCode":"', $flnk[$k]);
$gole = explode('","OperatingAirline":"', $feldsq[$j]);
$goleD = explode('","MarketingAirline":"', $gole[$k]); 
$clasnk = explode('","ResBookDesigCode":"', $feldsq[$j]);
$clasnkD = explode('","ResBookDesigQuantity":"', $clasnk[$k]);

$citydep = explode(',"DepartureCityCountry":"', $feldsq[$j]);
$citydepD = explode(',', $citydep[$k]);	
$cityarriv = explode(',"ArrivaliCityCountry":"', $feldsq[$j]);
$cityarrivD = explode(',', $cityarriv[$k]);	
$feldsqDk = explode(',"DepartureAirport":"', $feldsq[$j]);
$feldsqDkD = explode('(', $feldsqDk[$k]); 
$feldsqDkar = explode('","ArrivalAirport":"', $feldsq[$j]);
$feldsqDkarD = explode('(', $feldsqDkar[$k]);	
$deptime = explode('"DepartureDateTime":"', $feldsq[$j]);
$deptimeD = explode('","ArrivalDateTime":"', $deptime[$k]);
$artime = explode('","ArrivalDateTime":"', $feldsq[$j]);
$artimeD = explode('","FlightNumber":"', $artime[$k]);	
$originalDate = $deptimeD['0'];
$newDatedep = date("d F", strtotime($originalDate)); $newDatedept = date("H:i", strtotime($originalDate));
$originalDatea = $artimeD['0'];
$newDatearr = date("d F", strtotime($originalDatea)); $newDatearrt = date("H:i", strtotime($originalDatea)); 

$luggage = explode('"Luggage":"', $feldsq[$j]);
$luggageD = explode('","', $luggage[$k]); 

//DB::table('wbss')->insert([['wbssearch' => $wbssearch]]);   

 } } }



 
  
 
$currency=\DB::table('currency') ->where([['cur_nem', '=',  Session::get('curnem')],])->orderBy('id', 'desc')->first();   	
 
  if($wbs->wbs_way=='0'){
  	
 return redirect('sortvt'); 
  	  /* 
 return view('superadmin.sortjs', ['result' => $result , 'lngmenus' => $lngmenus , 'lngmenu' => $lngmenu , 'arrival' => $arrival , 'departure' => $departure, 'year' => $year , 'departuredate' => $departuredate, 'adult' => $adult , 'child' => $child , 'infant' => $infant , 'airports' => $airports, 'wbs' => $wbs  , 'currency' => $currency  ]); 
*/
  }
  
  
  if($wbs->wbs_way=='1'){ 
  
 $comids=  \DB::table('comid') ->where([['wbssearch', '=',  $wbssearch],])->orderBy('id')->get(); 
  
 // echo $result;
  return view('superadmin.ucackreturn', ['result' => $result , 'lngmenus' => $lngmenus , 'lngmenu' => $lngmenu , 'arrival' => $arrival , 'departure' => $departure , 'departuredate' => $departuredate,'departuredater' => $departuredater , 'year' => $year ,'yearr' => $yearr, 'airports' => $airports , 'adult' => $adult , 'child' => $child, 'infant' => $infant , 'wbs' => $wbs  , 'comids' => $comids   , 'currency' => $currency  ]);
   
    }
 
  
 
 
 
 
}	



		
	public function langindexid($id){

$lngmenu=\DB::table('language') ->where([['id', '=',  $id],['lng_active', '=',  '1'],])->orderBy('id', 'desc')->first();
	Session::set('idlang', $id);
if (Session::has('idlang')==3) {  Session::set('curnem', 'RIAL');  } else if   (Session::has('idlang')==7) {  Session::set('curnem', 'TL');  }else   {  Session::set('curnem', 'USD');  }
	
	//echo Session::get('curnem');
 return redirect('/'); 
}












		public function testjava(   Request $request){ 		
		
	$result=1;
	$departuredater=1;
  return view('superadmin.testjava', ['result' => $result , 'departuredater' => $departuredater    ]);		
}




		public function indexp(   Request $request){ 		
		
	$result=1;
	$departuredater=1;
  return view('indexgds.indexp', ['result' => $result , 'departuredater' => $departuredater    ]);		
}



		public function testjavaa(   Request $request){ 		
		
	$result=1;
	$departuredater=1;
  return view('superadmin.sortv', ['result' => $result , 'departuredater' => $departuredater    ]);		
}




public function testrander(   Request $request){ 		
	
/*	$result=1;
	$departuredater=1;
  return view('superadmin.testrander', ['result' => $result , 'departuredater' => $departuredater    ]);		*/


/*
$sortBy = 'id';
$users = DB::table('sortv')
                ->when($sortBy, function ($query) use ($sortBy) {
                    return $query->where([['sortv_airline' , '!=' , [  'Turkish'    ]    ] , ])->orderBy($sortBy);
                }, function ($query) {
                    return $query->orderBy('name');
                })
                ->get();
                dd($users); }

*/

$sortvss=\DB::table('sortv') ->where([['id', '!=', 0]   , ]) ->orderBy('id')->get(); 

foreach($sortvss as $sortvs){
	echo $sortvs->id;
	
	$bb= array($sortvs->id);
	 
	
	
}


dd($bb);

dd (Session::get('sort'));


}




public function testair(   Request $request){ 		
 
$sortvss=\DB::table('sortv')   -> Where('id', '=', '574')
  ->orderBy('id')->get(); 

$iff="    >  572 ";

  //return view('superadmin.testair', ['sortvss' => $sortvss  , 'iff' => $iff    ]);
   

}





public function sortheader( $sort , Request $request){ 	


$lngmenus= \DB::table('language') ->where([['id', '<>',  '0'],['lng_active', '=',  '1'],])->orderBy('id', 'desc')->get();
$lngmenu=\DB::table('language') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first();
 
   
Session::set('sortsins', $sort); 
  

  return redirect('sortvt'); 
 
 
 }



public function testnext(   Request $request){ 		


$lngmenus= \DB::table('language') ->where([['id', '<>',  '0'],['lng_active', '=',  '1'],])->orderBy('id', 'desc')->get();
$lngmenu=\DB::table('language') ->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first();
 
$wbs=\DB::table('wbs') ->where([['wbs_uuses', '=', Session::get('wbs_uuses')] , ])->orderBy('id', 'desc')->first(); 
$wbsid=$wbs->id;
$wbssort=$wbs->wbs_sort; 	
	    
 
 $departuredate=$wbs->wbs_departuredate;
 $departuredater=$wbs->wbs_departuredater; 


$updatee = \DB::table('wbs')->where([['id', '=',  $wbsid],])->update(['wbs_sort' => '1'   ]); 

$year=$wbs->wbs_departuredate; 

 
 $arrival=$wbs->wbs_arrival; $departure=$wbs->wbs_departure;    $departuredater=$wbs->wbs_departuredater;  $adult=$wbs->wbs_adult;  $child=$wbs->wbs_child; $infant=$wbs->wbs_infant; $result=$wbs->result;  
$airports= \DB::table('airports') ->where([['code', '<>',  '0'],])->orderBy('obs')->get(); 
$currency=\DB::table('currency') ->where([['cur_nem', '=',  Session::get('curnem')],])->orderBy('id', 'desc')->first();   



$sortvs=\DB::table('sortv') ->where([['sortv_wbsid', '=', $wbsid]   , ['sortv_airlineflg', '=', '1']   , ])->orderBy('id')->get(); 

$sortcls=\DB::table('sortv') ->where([['sortv_wbsid', '=', $wbsid]   , ['sortv_clasflg', '=', '1']   , ])->orderBy('id')->get(); 
 

$sortindirs=\DB::table('sortv') ->where([['sortv_wbsid', '=', $wbsid]   , ['sortv_indirectflg', '=', '1']   , ])->orderBy('id')->get(); 
 
$sortprics=\DB::table('sortv') ->where([['sortv_wbsid', '=', $wbsid]   , ['sortv_priceflg', '=', '1']   , ])->orderBy('id')->get(); 


if(Session::get('sortsins')){ $sortsins=Session::get('sortsins'); } else { $sortsins='sort_price'; }

 //$sortsins='id';

$sorts=\DB::table('sort') ->where([['sort_wbsid', '=',  $wbsid],['sort_show', '=','1'],])->orderBy($sortsins)->get();  
  $sortcounts=\DB::table('sort') ->where([['sort_wbsid', '=',  $wbsid],['sort_show', '=',  '1'],])->orderBy('id')->count(); 

$mngindex =  DB::table('mngindex')  ->where('id' , '=' , 1)->orderBy('id')->first(); 
 

		 
 
if($wbs->wbs_way=='0'){	   
 return view('superadmin.sortm', ['result' => $result , 'lngmenus' => $lngmenus , 'lngmenu' => $lngmenu , 'arrival' => $arrival , 'departure' => $departure, 'year' => $year , 'departuredate' => $departuredate, 'adult' => $adult , 'child' => $child , 'infant' => $infant , 'airports' => $airports, 'wbs' => $wbs  , 'currency' => $currency  , 'sorts' => $sorts  , 'sortcounts' => $sortcounts  , 'sortvs' => $sortvs  , 'sortcls' => $sortcls  , 'sortindirs' => $sortindirs , 'sortprics' => $sortprics  , 'mngindex' => $mngindex     ]); 
}



}





public function postairline(Request $request){ 	
$lngmenus= \DB::table('language') ->where([['id', '<>',  '0'],['lng_active', '=',  '1'],])->orderBy('id', 'desc')->get();
$lngmenu=\DB::table('language')->where([['id', '=',  Session::get('idlang')],])->orderBy('id', 'desc')->first();

$currency=\DB::table('currency') ->where([['cur_nem', '=',  Session::get('curnem')],])->orderBy('id', 'desc')->first(); 

$airlines = $request->input('airline'); 
$classes = $request->input('classe');  
$indires = $request->input('indire');  
$pricee = $request->input('pricee');
$fromprice = $request->input('fromprice');
$toprice = $request->input('toprice');
 




 
$wbs=\DB::table('wbs')->where([['wbs_uuses', '=', Session::get('wbs_uuses')],])->orderBy('id', 'desc')->first();
$wbsid=$wbs->id; 
 
$sortprics=\DB::table('sortv') ->where([['sortv_wbsid', '=', $wbsid]   , ['sortv_priceflg', '=', '1']  , ['id', '>=', $fromprice]    , ])->orderBy('sortv_price')->get();


 foreach($sortprics as $sortpric){
 
 if(   $sortpric->id  <=     $toprice       ){  $pricee[]=$sortpric->sortv_price;    }   
  }



$airlinesv=count($airlines); if($airlinesv!='0'){ $airlinesv='1';}
$classesv=count($classes);   if($classesv!='0'){ $classesv='1';}
$indiresv=count($indires);   if($indiresv!='0'){ $indiresv='1';}
$priceev=count($pricee);     if($priceev!='0'){ $priceev='1';}



 
  
$sortsins = $request->input('sorts');   
Session::set('sortsins', $sortsins); 

 $ck=$airlinesv+$classesv+$indiresv+$priceev;
 
 
 
if($ck==0){ $ck=0;  }
if(($ck!=0)&&($airlinesv!=0)){$ck=1; }
if(($ck!=0)&&($classesv!=0)){$ck=2; }
if(($ck!=0)&&($indiresv!=0)){$ck=3; }
if(($ck!=0)&&($priceev!=0)){$ck=4; }
if(($airlinesv!=0)&&($classesv!=0)&&($indiresv!=0)&&($priceev!=0)){$ck=5; }
 
$wbs=\DB::table('wbs')->where([['wbs_uuses', '=', Session::get('wbs_uuses')],])->orderBy('id', 'desc')->first();
$wbsid=$wbs->id; 
 
  
$sortvs=\DB::table('sortv') ->where([['sortv_wbsid', '=', $wbsid]   , ['sortv_airlineflg', '=', '1']   , ])->orderBy('id')->get(); 
if($airlinesv=='0'){
$j=0;
foreach($sortvs as $sortv){$airlines[$j]=$sortv->sortv_airline;  $j++;  }
}
 

$sortcls=\DB::table('sortv') ->where([['sortv_wbsid', '=', $wbsid]   , ['sortv_clasflg', '=', '1']   , ])->orderBy('id')->get();
 if($classesv=='0'){
$j=0;
foreach($sortcls as $sortcl){$classes[$j]=$sortcl->sortv_class;   $j++;  }
}
 
 
$sortindirs=\DB::table('sortv') ->where([['sortv_wbsid', '=', $wbsid]   , ['sortv_indirectflg', '=', '1']   , ])->orderBy('id')->get();
 if($indiresv=='0'){
$j=0;
foreach($sortindirs as $sortindir){$indires[$j]=$sortindir->sortv_indirect;   $j++;  }
}
 
 
$sortprics=\DB::table('sortv') ->where([['sortv_wbsid', '=', $wbsid]   , ['sortv_priceflg', '=', '1']   , ])->orderBy('id')->get();
 if($priceev=='0'){
$j=0;
foreach($sortindirs as $sortindir){$pricee[$j]=$sortindir->sortv_indirect;   $j++;  }
}
 
 
 
  
$updatee = \DB::table('sort')->where([['sort_wbsid', '=',  $wbsid],])->update(['sort_show' => '0'   ]); 




if($ck=='0'){ 

for ($i = 0; $i< count($airlines); $i++){
$updatee = \DB::table('sort')->where([['sort_wbsid', '=',$wbsid],['sort_airline', '=',  $airlines[$i]],])->update(['sort_show' => '1'   ]); 
}
 
for ($k = 0; $k< count($classes); $k++){ 
$updatee = \DB::table('sort')->where([['sort_wbsid', '=',  $wbsid],['sort_class', '=',  $classes[$k]],])->update(['sort_show' => '1'   ]);   
}
for ($l = 0; $l< count($indires); $l++){ 
$updatee = \DB::table('sort')->where([['sort_wbsid', '=',  $wbsid],['sort_indirect', '=',  $indires[$l]],])->update(['sort_show' => '1'   ]);   
}

for ($m = 0; $m< count($pricee); $m++){ 
$updatee = \DB::table('sort')->where([['sort_wbsid', '=',  $wbsid],['sort_price', '=',  $pricee[$m]],])->update(['sort_show' => '1'   ]);   
}
 

 
 }
 


if($ck=='1'){ 

for ($i = 0; $i< count($airlines); $i++){
$updatee = \DB::table('sort')->where([['sort_wbsid', '=',$wbsid],['sort_airline', '=',  $airlines[$i]],])->update(['sort_show' => '1'   ]); 
} 
 }
 
 
 
if($ck=='2'){ 

for ($k = 0; $k< count($classes); $k++){ 
$updatee = \DB::table('sort')->where([['sort_wbsid', '=',  $wbsid],['sort_class', '=',  $classes[$k]],])->update(['sort_show' => '1'   ]);   
}
 
 }
 
 
 
if($ck=='3'){ 

for ($l = 0; $l< count($indires); $l++){ 
$updatee = \DB::table('sort')->where([['sort_wbsid', '=',  $wbsid],['sort_indirect', '=',  $indires[$l]],])->update(['sort_show' => '1'   ]);   
}
 
 }
 
 
if($ck=='4'){ 

for ($m = 0; $m< count($pricee); $m++){ 
$updatee = \DB::table('sort')->where([['sort_wbsid', '=',  $wbsid],['sort_price', '=',  $pricee[$m]],])->update(['sort_show' => '1'   ]);   
}
 
 }
 
 
 

if($ck=='5'){ 

for ($i = 0; $i< count($airlines); $i++){
$updatee = \DB::table('sort')->where([['sort_wbsid', '=',$wbsid],['sort_airline', '=',  $airlines[$i]],])->update(['sort_show' => '1'   ]); 
}
 
for ($k = 0; $k< count($classes); $k++){ 
$updatee = \DB::table('sort')->where([['sort_wbsid', '=',  $wbsid],['sort_class', '=',  $classes[$k]],])->update(['sort_show' => '1'   ]);   
}

for ($l = 0; $l< count($indires); $l++){ 
$updatee = \DB::table('sort')->where([['sort_wbsid', '=',  $wbsid],['sort_indirect', '=',  $indires[$l]],])->update(['sort_show' => '1'   ]);   
}

for ($m = 0; $m< count($pricee); $m++){ 
$updatee = \DB::table('sort')->where([['sort_wbsid', '=',  $wbsid],['sort_price', '=',  $pricee[$m]],])->update(['sort_show' => '1'   ]);   
}
 
 
 }
 

 
 
 
 
  return redirect('sortvt');  

 

}






	


    
}
