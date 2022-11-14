<?php
    require_once '../config/conn.php';

    $u_code = $_GET['u_code'];
    $sql = "SELECT u_code,firstname,lastname FROM users WHERE u_code = '$u_code' LIMIT 1 ";
    $query = mysqli_query($conn, $sql);

    $json = array();
    while($result = mysqli_fetch_assoc($query)) { 
        if($result['u_code'] > 0){

            $json[] = $result;
        }

    }
    echo json_encode($json);
?>