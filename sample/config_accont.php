<?php
//=======================================================================
//                     تنظیمات اتصال سایت                               |
//                                                                      |
//----------------------------------------------------------------------|
/**/error_reporting(0);									  		    /*|
//           نام کاربری سایت خود را وارد کنید                  		  /*|
/**/$username='azmoonpt_melat';												  /*|
//            کلمه عبور سایت خود را وارد کنید                 		  /*|
/**/$password='!Mehdi1241368';													  /*|
//=======================================================================
//                     تنظیمات اتصال سرور بانک ملت                      |
//                                                                      |
//----------------------------------------------------------------------|
//         نام بانک اطلاعاتی سایت خود را وارد کنید 					  /*|
/**/$database='azmoonpt_servicepay';										   


  $_link=mysql_connect("localhost",$username,$password);
     mysql_select_db($database,$_link);
	  mysql_query("SET NAMES utf8");
    mysql_query("SET CHARACTER SET utf8");
	 mysql_set_charset('utf8');	



 													/*|
//			آدرس فایل پس از پرداخت پول از بانک ملت به هاست شما 		  /*|
/**/$CallBack = 'https://azmoonpte.com/servicepay/sample/verify.php';/*|
//                                                		                |
//=======================================================================
/**/function connect($username,$password,$database){				  /*|
/**/$connection=mysql_connect('localhost',$username,$password);	    /*|
/**/$database_select=mysql_select_db($database,$connection);		   /*|
/**/}																 /*|
//=======================================================================
*/

$servername = "localhost";  
$dbname = $database;  

  
$user = $username;
$pass = $password;
$charset = 'utf8';
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$dsn = "mysql:host=$servername;dbname=$dbname;charset=$charset";
try {
     $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

?>