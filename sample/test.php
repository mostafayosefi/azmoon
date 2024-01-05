<?php
//coded by payamsalami.ir
 	 

$idorder=$_GET['id'];
 



$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://azmoonpte.com/servicepay/user/fetch/".$idorder."");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 5);
    curl_setopt($ch, CURLOPT_TIMEOUT, 59); 
$resultb = curl_exec($ch);
 //echo $resultb;
 
 
$date = explode("status=", $resultb);    
$token=$date['0'];   
$date = explode("status=", $resultb);   
$status=$date['1'];   
  
 echo $token.'<br>';
 echo $status.'<br>';
 
 
 
 $posts_sql="select *  FROM myrequest WHERE req_rnd != 0 && `req_rnd`='".$idorder."' ORDER BY  req_rnd DESC LIMIT 1";
 $posts_result = mysql_query($posts_sql); $j=0; 
 while($posts_row = mysql_fetch_assoc($posts_result)){ $j++;
 $req_rnd=$posts_row['req_rnd'];   }
 
 
  
  echo $req_rnd.'<br>';
 