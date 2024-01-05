 <?php
   ob_start();
session_start();		
include 'lib/config_accont.php';	?>

<?php
$id=(int)$_GET['id'];

$posts_sql="select   belit.bel_cur , currency.id , currency.cur_rateajency , currency.cur_rateuser   FROM belit
inner JOIN currency ON belit.bel_cur=currency.id
 WHERE    `bel_codrezerv`='".$id."' ORDER BY id DESC LIMIT 1";
 $posts_result = mysql_query($posts_sql); $j=0; 
 while($posts_row = mysql_fetch_assoc($posts_result)){ $j++;
 $cur_rateajency=$posts_row['cur_rateajency']; $cur_rateuser=$posts_row['cur_rateuser']; }
 
 
 
 
 
$posts_sql="select *  FROM finicals WHERE   finical_number != 0 && `finical_codrezerv`='".$id."' ORDER BY id DESC LIMIT 1";
 $posts_result = mysql_query($posts_sql); $j=0; 
 while($posts_row = mysql_fetch_assoc($posts_result)){ $j++;
 $finical_iduser=$posts_row['finical_iduser'];  $finical_pay=$posts_row['finical_pay'];        $finical_payment=$posts_row['finical_payment'];  $finicalid=$posts_row['id'];  $_SESSION['finicalid']=$finicalid;  $finicalarou=$posts_row['finical_arou'];  $_SESSION['finical_arou']=$finicalarou; }

if($finicalarou=='4'){
	
$posts_sql="select *  FROM user WHERE id != 0 && `id`='".$finical_iduser."' ORDER BY id DESC LIMIT 1";
 $posts_result = mysql_query($posts_sql); 
 while($posts_row = mysql_fetch_assoc($posts_result)){  
 $user_name=$posts_row['user_name'];  $user_email=$posts_row['user_email'];    $user_tell=$posts_row['user_tell'];   $user_adres=$posts_row['user_adres'];    
  $_SESSION['name']=$user_name; 
  $_SESSION['email']=$user_email; 
  $_SESSION['tell']=$user_tell; 
  $_SESSION['adres']=$user_adres;   }
} 


if($finicalarou=='3'){
$posts_sql="select *  FROM ajency WHERE id != 0 && `id`='".$finical_iduser."' ORDER BY id DESC LIMIT 1";
 $posts_result = mysql_query($posts_sql); 
 while($posts_row = mysql_fetch_assoc($posts_result)){  
 $user_name=$posts_row['ajency_name'];  $user_email=$posts_row['ajency_email'];    $user_tell=$posts_row['ajency_tell'];   $user_adres=$posts_row['ajency_adres'];    
  $_SESSION['name']=$user_name; 
  $_SESSION['email']=$user_email; 
  $_SESSION['tell']=$user_tell; 
  $_SESSION['adres']=$user_adres;   }	
	}

  
  
$_SESSION['codrezerv']=$id;  
 
if($j=='0'){
	
if($finicalarou=='4'){	
 header("location:../user/errorfinical"); 	 }
 if($finicalarou=='3'){
 header("location:../agency/errorfinical"); 	 }
} else if($j!='0') {


if($finicalarou=='4'){	
 $_SESSION['jam']=$finical_pay*$cur_rateuser;  }
 if($finicalarou=='3'){
 $_SESSION['jam']=$finical_pay*$cur_rateajency;  }

	
header("location:epay.php?id=$id");
}


 ?>


 