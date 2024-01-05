<?php
 
 
 $username='azmoonpt_melat';												   
 $password='!Mehdi1241368';	 
 $database='azmoonpt_servicepay'; 
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
  
  
      