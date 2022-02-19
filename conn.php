<?php //error_reporting(0); // Error Reporting Off
//error_reporting(2); // Error Reporting On
session_start();
error_reporting(E_ALL);
ini_set('display_errors', False);
$servername = "localhost";
$username = "root";
$password = "";
$db = "draniruddha_emr";  //EMR
$conn = new mysqli($servername, $username, $password, $db);
if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}
define("ADMIN_URL", "http://localhost/emr/templates/admin3/");
define("ADMIN_URL2", "http://localhost/");
define("PAGI_LIMIT", 30);
date_default_timezone_set("Asia/Kolkata");
date_default_timezone_get();
?>