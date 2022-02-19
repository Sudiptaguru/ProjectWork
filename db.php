<?php
error_reporting(E_ALL);
ini_set('display_errors', False);
$conn = mysqli_connect("localhost", "root", "", "telecalling");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
 define("ADMIN_URL", "http://localhost/telecalling/");
// define("ADMIN_URL2", "http://localhost/");
define("PAGI_LIMIT", 30);
date_default_timezone_set("Asia/Kolkata");
date_default_timezone_get(); 
?>