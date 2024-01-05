<?php 
 $username='zaban724_lab'; 
 $password='9384762155';		 
 $database='zaban724_lab';	
  $_link=mysql_connect("localhost",$username,$password);
     mysql_select_db($database,$_link);
	  mysql_query("SET NAMES utf8");
    mysql_query("SET CHARACTER SET utf8");
	 mysql_set_charset('utf8');	
?>