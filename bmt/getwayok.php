 <?php
   ob_start();
session_start();		
?>

<?php



if($_SESSION['finical_arou']=='4'){	
 header("location:../user/viewsmybelit/mybelit/".$_SESSION['codrezerv'].""); 	}
 
if($_SESSION['finical_arou']=='3'){	
 header("location:../agency/viewsmybelit/mybelit/".$_SESSION['codrezerv'].""); 	}


 ?>


 