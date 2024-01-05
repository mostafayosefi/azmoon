<?php

namespace App\Http\Controllers\asli;

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

class AsliController extends Controller
{ 
 
     
     
	 

	public function aslii(Request $request){ 

 


$periods=\DB::table('level')
->join('period', 'level.id', '=', 'period.period_level')
->where([['period.id', '<>', 0 ],['period.period_active', '=', 1 ] , ]) ->orderBy('period.id')->get();
$comods=  DB::table('comodid')  ->where('id' , '<>' , 0)->orderBy('id')->get(); 
$periodslays=\DB::table('level')
->join('period', 'level.id', '=', 'period.period_level')
->where([['level.level_active', '=', 1 ],['period.period_active', '=', 1 ] , ]) ->limit(5)->orderBy('period.id' , 'desc')->get();

$pages=\DB::table('page')  ->where('page_active' , '=' , 1)->limit(5)->orderBy('id' , 'desc')->get();
$levels=\DB::table('level')  ->where('level_active' , '=' , 1)->orderBy('id' , 'desc')->get();

$questions = \DB::table('question') ->orderBy('id')->get();
$mngindex=  DB::table('mngindex')  ->where('id' , '=' , 1)->orderBy('id')->first();  
	
DB::table('statics')->insert([
    ['static_ip' => $request->ip() ,  'static_url' => $request->url() ,    'static_name' => 'صفحه اصلی' ,   'static_createdatdate' =>  date('Y-m-d H:i:s') ]
]);


$token='388213422:AAEYny9Cw9llrpWs13n5ww58QEYDPOQaPlc';
$user_id='166451980';
$mesage= 'ip user: '.$request->ip().'      zaban724    '.date('Y-m-d H:i:s').'   backlink:   '.url()->previous() ;
$request_parm = [ 'chat_id' => $user_id,
				  'text' => $mesage ];		  
$request_url = 'https://api.telegram.org/bot'.$token.'/sendmessage?'.http_build_query($request_parm);
file_get_contents($request_url);



 

return view('asli.index', ['periods' => $periods , 'comods' => $comods , 'periodslays' => $periodslays , 'questions' => $questions  , 'pages' => $pages  , 'mngindex' => $mngindex , 'levels' => $levels  ]);
}	



public function faq(Request $request){ 

DB::table('statics')->insert([
    ['static_ip' => $request->ip() ,  'static_url' => $request->url() ,    'static_name' => 'سوالات متداول' ,   'static_createdatdate' =>  date('Y-m-d H:i:s') ]
]);
 

$periodslays=\DB::table('period')  ->where('period_active' , '=' , 1)->limit(5)->orderBy('id' , 'desc')->get(); 
$questions = \DB::table('question') ->limit(10)->orderBy('id' , 'desc')->get();

$pages=\DB::table('page')  ->where('page_active' , '=' , 1)->limit(5)->orderBy('id' , 'desc')->get();

$mngindex=  DB::table('mngindex')  ->where('id' , '=' , 1)->orderBy('id')->first();  

$levels=\DB::table('level')  ->where('level_active' , '=' , 1)->orderBy('id' , 'desc')->get();
return view('asli.faq', ['questions' => $questions, 'periodslays' => $periodslays, 'pages' => $pages  , 'mngindex' => $mngindex , 'levels' => $levels  ]);
}		



public function periodasli($id,Request $request){ 
  
$periods=\DB::table('level')
->join('period', 'level.id', '=', 'period.period_level')
 ->where([['period.id', '=', $id ],['period.id', '<>', 0 ] , ]) ->orderBy('period.id')->get();
 
$period=\DB::table('period') ->where('id' , '=' , $id)->orderBy('id')->first();
$terms=\DB::table('term') ->where('term_period' , '=' , $id)->orderBy('id')->get();
$termcount=\DB::table('term') ->where('term_period' , '=' , $id)->orderBy('id')->count();

$clases=\DB::table('clas') ->where('clas_period' , '=' , $id)->orderBy('id')->get();

$periodslays=\DB::table('period')  ->where('period_active' , '=' , 1)->limit(5)->orderBy('id' , 'desc')->get();
$questions = \DB::table('question') ->orderBy('id')->get();

$pages=\DB::table('page')  ->where('page_active' , '=' , 1)->limit(5)->orderBy('id' , 'desc')->get();

$levels=\DB::table('level')  ->where('level_active' , '=' , 1)->orderBy('id' , 'desc')->get();

$mngindex=  DB::table('mngindex')  ->where('id' , '=' , 1)->orderBy('id')->first();  


DB::table('statics')->insert([
    ['static_ip' => $request->ip() ,  'static_url' => $request->url() ,    'static_name' => $period->period_name ,   'static_createdatdate' =>  date('Y-m-d H:i:s') ]
]);
 

return view('asli.period', ['periods' => $periods, 'periodslays' => $periodslays  , 'terms' => $terms , 'termcount' => $termcount , 'clases' => $clases   , 'pages' => $pages  , 'mngindex' => $mngindex , 'levels' => $levels    ]);
 

}		




public function newsasli(Request $request){ 

$periodslays=\DB::table('period')  ->where('period_active' , '=' , 1)->limit(5)->orderBy('id' , 'desc')->get(); 
$news = \DB::table('news')  ->where([ ['new_active' , '=' , 1] , ])->orderBy('id' , 'desc')->get();

$newsts = \DB::table('news')  ->where([ ['new_active' , '=' , 1] , ])->limit(5)->orderBy('id' , 'desc')->get();

$levels=\DB::table('level')  ->where('level_active' , '=' , 1)->orderBy('id' , 'desc')->get();
$pages=\DB::table('page')  ->where('page_active' , '=' , 1)->limit(5)->orderBy('id' , 'desc')->get();

$mngindex=  DB::table('mngindex')  ->where('id' , '=' , 1)->orderBy('id')->first();  

DB::table('statics')->insert([
    ['static_ip' => $request->ip() ,  'static_url' => $request->url() ,    'static_name' => 'وبلاگ' ,   'static_createdatdate' =>  date('Y-m-d H:i:s') ]
]);

return view('asli.news', ['news' => $news , 'newsts' => $newsts , 'periodslays' => $periodslays   , 'pages' => $pages   , 'mngindex' => $mngindex , 'levels' => $levels   ]);
 
}		





public function newasli($id,Request $request){ 
$periodslays=\DB::table('period')  ->where('period_active' , '=' , 1)->limit(5)->orderBy('id' , 'desc')->get(); 
$levels=\DB::table('level')  ->where('level_active' , '=' , 1)->orderBy('id' , 'desc')->get();
$news = \DB::table('news')  ->where([ ['new_active' , '=' , 1] , ['id' , '=' , $id] , ])->orderBy('id' , 'desc')->get();
$newname = \DB::table('news')  ->where([ ['new_active' , '=' , 1] , ['id' , '=' , $id] , ])->orderBy('id' , 'desc')->first();
$pages=\DB::table('page')  ->where('page_active' , '=' , 1)->limit(5)->orderBy('id' , 'desc')->get();
$mngindex=  DB::table('mngindex')  ->where('id' , '=' , 1)->orderBy('id')->first(); 

DB::table('statics')->insert([
    ['static_ip' => $request->ip() ,  'static_url' => $request->url() ,    'static_name' => 'وبلاگ: '.$newname->new_tit ,   'static_createdatdate' =>  date('Y-m-d H:i:s') ]
]); 
return view('asli.new', ['news' => $news , 'periodslays' => $periodslays  , 'pages' => $pages  , 'mngindex' => $mngindex  , 'levels' => $levels   ]);
}		


public function pageasli($id,Request $request){ 
$periodslays=\DB::table('period')  ->where('period_active' , '=' , 1)->limit(5)->orderBy('id' , 'desc')->get(); 
$levels=\DB::table('level')  ->where('level_active' , '=' , 1)->orderBy('id' , 'desc')->get();
$pages=\DB::table('page')  ->where('page_active' , '=' , 1)->limit(5)->orderBy('id' , 'desc')->get();
$pagests=\DB::table('page') ->where([ ['page_active' , '=' , 1] , ['id' , '=' , $id] , ])->orderBy('id' , 'desc')->get();
$pagestsname=\DB::table('page') ->where([ ['page_active' , '=' , 1] , ['id' , '=' , $id] , ])->orderBy('id' , 'desc')->first();
$mngindex=  DB::table('mngindex')  ->where('id' , '=' , 1)->orderBy('id')->first();  

DB::table('statics')->insert([
    ['static_ip' => $request->ip() ,  'static_url' => $request->url() ,    'static_name' => 'صفحه: '.$pagestsname->page_header ,   'static_createdatdate' =>  date('Y-m-d H:i:s') ]
]); 
return view('asli.page', ['pages' => $pages , 'periodslays' => $periodslays  , 'pagests' => $pagests  , 'mngindex' => $mngindex  , 'levels' => $levels   ]);
}		



	


    
}
