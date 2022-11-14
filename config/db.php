<?php
    $servername = "localhost";
    $username = "rmutiltb_borrow";
    $password = "IbyP5+HeC!";

    
    try {
        $conn = new PDO("mysql:host=$servername;dbname=rmutiltb_borrow", $username, $password, 
        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "Connected successfully";
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
?>
