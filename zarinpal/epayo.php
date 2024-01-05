 <?php
   ob_start();
session_start();		
include '../bmt/lib/config_accont.php';	 	?>

<?php
$id=(int)$_GET['id'];

$posts_sql="select *  FROM finicals WHERE finical_number != 0 && `finical_number`='".$id."' ORDER BY id DESC LIMIT 1";
 $posts_result = mysql_query($posts_sql); $j=0; 
 while($posts_row = mysql_fetch_assoc($posts_result)){ $j++;
 $finical_iduser=$posts_row['finical_iduser'];  $finical_pay=$posts_row['finical_pay'];   $_SESSION['jam']=$finical_pay;    $finical_payment=$posts_row['finical_payment'];  $finicalid=$posts_row['id'];  $_SESSION['finicalid']=$finicalid; }
 
$posts_sql="select *  FROM students WHERE id != 0 && `id`='".$finicalid."' ORDER BY id DESC LIMIT 1";
 $posts_result = mysql_query($posts_sql); 
 while($posts_row = mysql_fetch_assoc($posts_result)){  
 $student_name=$posts_row['student_name'];  $student_email=$posts_row['student_email'];    $student_tell=$posts_row['student_tell'];   $student_adres=$posts_row['student_adres'];    
  $_SESSION['name']=$student_name; 
  $_SESSION['email']=$student_email; 
  $_SESSION['tell']=$student_tell; 
  $_SESSION['adres']=$student_adres;   }
 
 
if($j=='0'){
 header("location:../student/errorfinical"); 	
} else if($j!='0') {
	
header("location:request.php");
}


 ?>


 