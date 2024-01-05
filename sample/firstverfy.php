<?php
//coded by payamsalami.ir
 
$idorder=$_GET['id']; 


include 'connect.php';	
 
 
 
 $stmt = $pdo->query("SELECT * FROM myrequest  WHERE req_rnd != 0 && `req_rnd`='".$idorder."' ORDER BY  req_rnd DESC LIMIT 1");
while ($row = $stmt->fetch()) {
 
 $req_rnd=$row['req_rnd'];    
 
    
echo $req_rnd;
}



 
 
         
 //header("location:../user/fetch/$idorder");
   
    
    
      