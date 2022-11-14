
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php   
session_start();
require_once '../config/db.php';
require_once '../class/date.php';

if(isset($_POST['update'])){

    $h_id = $_POST['h_id'];
    $h_value = $_POST['h_value'];
    $item_id = $_POST['item_id'];
    $status_id = $_POST['status_id'];

    $stmt1 = $conn->query("SELECT a_value,a_key FROM item_a WHERE a_key = '$item_id' LIMIT 1");
    $stmt1->execute();
    $rows = $stmt1->fetch(PDO::FETCH_ASSOC);
    $item_old = $rows['a_value'];
    $a_key = $rows['a_key'];
    $amount = $item_old+$h_value;
        
    $stmt2=$conn->prepare("UPDATE history SET h_id = :h_id ,status_id = :status_id WHERE h_id = :h_id");
    $stmt2->bindParam(":h_id",$h_id);
    $stmt2->bindParam(":status_id",$status_id);
    $result2 = $stmt2->execute();

    $stmt3=$conn->prepare("UPDATE item_a SET a_key=:item_id,a_value='$amount' WHERE a_key=:item_id");
    $stmt3->bindParam(":item_id", $a_key);
    $stmt3->bindParam(":amount", $a_value);
    $result3 = $stmt3->execute();

        if ($result2 && $result3) {
            echo "<script>
                $(document).ready(function() {
                    Swal.fire({
                        title: 'สำเร็จ',
                        text: 'ข้อมูลบันทึกสำเร็จ',
                        icon: 'success',
                        timer: 6000,
                        showConfirmButton: false
                    });
                })
            </script>";
            header("refresh:4; url=../tb_lent_item2.php");
        } else {
            echo "<script>
                $(document).ready(function() {
                    Swal.fire({
                        title: 'ไม่สำเร็จ',
                        text: 'ข้อมูลบันทึกไม่สำเร็จ !',
                        icon: 'error',
                        timer: 5000,
                        showConfirmButton: false
                    });
                })
            </script>";
            header("refresh:2; url=../tb_lent_item2.php");
        }
    }


?>