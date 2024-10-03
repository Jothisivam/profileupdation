<?php 
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '0'); 

$host='localhost';
$dbb = 'profile';
$username = 'postgres';
$password = 'postgres';
$port ='5432';  
$dsn = "pgsql:host=$host;port=$port;dbname=$dbb;user=$username;password=$password";

try {
  $db = new PDO($dsn);

  $db->exec("SET client_encoding = 'UTF8'");

  if($db) {
     //  echo "<strong>database successfully!</strong>";
  }
} catch (PDOException $e) {
  echo $e->getMessage();
}
?>