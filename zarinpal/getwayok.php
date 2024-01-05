 <?php
   ob_start();
session_start();		
?>

<?php

 header("location:../student/viewsfinicals/finical/".$_SESSION['finicalid'].""); 	


 ?>


 