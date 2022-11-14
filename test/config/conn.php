<?php 

$host = "localhost";
$user = "rmutiltb_borrow";
$pass = "IbyP5+HeC!";
$db = "rmutiltb_borrow";

$conn = mysqli_connect($host, $user, $pass, $db);

date_default_timezone_set("Asia/Bangkok");
header('Content-Type: text/html; charset=UTF-8');

if (!$conn) {
    die("เชื่อมต่อไม่สำเร็จ : " . mysqli_connect_error());
} 

    
?>