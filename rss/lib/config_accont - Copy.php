<?php
//=======================================================================
//                     تنظیمات اتصال سایت                               |
//                                                                      |
//----------------------------------------------------------------------|
/**/error_reporting(0);									  		    /*|
//           نام کاربری سایت خود را وارد کنید                  		  /*|
/**/$username='gds724m_turk724';												  /*|
//            کلمه عبور سایت خود را وارد کنید                 		  /*|
/**/$password='CURcUYnEO';													  /*|
//=======================================================================
//                     تنظیمات اتصال سرور بانک ملت                      |
//                                                                      |
//----------------------------------------------------------------------|
//         نام بانک اطلاعاتی سایت خود را وارد کنید 					  /*|
/**/$database='gds724m_iran724';										   


  $_link=mysql_connect("localhost",$username,$password);
     mysql_select_db($database,$_link);
	  mysql_query("SET NAMES utf8");
    mysql_query("SET CHARACTER SET utf8");
	 mysql_set_charset('utf8');	




//						 ترمینال ID									  /*|
/**/$terminalId = '699700';												 /*|
//				 نام کاربری درگاه اینترنتی							  /*|
/**/$userName = 'atinegar';												   /*|
// 					رمز عبور درگاه اینترنتی							  /*|
/**/$userPassword = '80661';													/*|
//			آدرس فایل پس از پرداخت پول از بانک ملت به هاست شما 		  /*|
/**/$CallBack = 'http://gds724.com/bmt/callback.php';/*|
//                                                		                |
//=======================================================================
/**/function connect($username,$password,$database){				  /*|
/**/$connection=mysql_connect('localhost',$username,$password);	    /*|
/**/$database_select=mysql_select_db($database,$connection);		   /*|
/**/}																 /*|
//=======================================================================
*/



?>