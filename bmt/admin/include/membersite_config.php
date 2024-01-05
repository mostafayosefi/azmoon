<?PHP
require_once("./include/fg_membersite.php");
/**/$site_name='www.hassas-computer.com';										  /*|
//								نام کاربری سایت خود را وارد کنید					|
/**/$local='localhost';															/*|
/**/include('../include/config_accont.php');								    /*|
//								نام بانک اطلاعات عمومی نرم افزار خود را وارد کنید			|
/**/$general_database='hassasco_hassas-computer-database';						   	  /*|
//										نام جدول کاربران اصلی سایت را وارد کنید		|
/**/$dbTable='administrator';													  /*|
//----------------------------------------------------------------------------------|
//																   				  /*|*/
$fgmembersite = new FGMembersite();
$fgmembersite->SetWebsiteName('hassas-computer.com');
$fgmembersite->SetAdminEmail('admin@hassas-computer.com.com');
$fgmembersite->InitDB(/*hostname*/''.$local.'',
                      /*username*/''.$username.'',
                      /*password*/''.$password.'',
                      /*database name*/''.$general_database.'',
                      /*table name*/''.$dbTable.'');
//For better security. Get a random string from this link: http://tinyurl.com/randstr
// and put it here
$fgmembersite->SetRandomKey('qSRcVS6DrTzrPvr');
//===================================================================================
//					   اطلاعات اتصال به بانک عمومی نرم افزار 	       				  /*|
/**/error_reporting(0);									  						/*|
/**/function general_connection($username,$password,$general_database){		   /*|
/**/$general_con=mysql_connect($local,$username,$password);						/*|
/**/$db_select_general=mysql_select_db($general_database,$general_con);		   /*|
/**/}																			 /*|
//===================================================================================
/**/
?>