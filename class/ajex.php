<?php
    require_once '../config/conn.php';

    $sql = "SELECT * FROM item_a WHERE a_type ={$_GET['t_id']}";
    $query = mysqli_query($conn, $sql);
    
   $json = array();
    while($result = mysqli_fetch_assoc($query)) { 
        if($result['a_value'] > 0){
        
            $json[] = $result;
        }
        
        // array_push($json,$result);
    }
    echo json_encode($json);
?>