
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php   
session_start();
require_once '../config/db.php';
require_once '../class/date.php';

if(isset($_POST['update'])){

    $h_id = $_POST['h_id'];
    $u_id = $_POST['u_id'];
    $item_id = $_POST['item_id'];
    $h_value = $_POST['h_value'];
    $file = $_FILES['file'];

    $allow = array('jpg', 'jpeg', 'png');
    $extension = explode('.', $file['name']);
    $fileActExt = strtolower(end($extension));
    $fileNew = rand() . "." . $fileActExt;  // rand function create the rand number 
    $filePath = '../upload/'.$fileNew;

    if (in_array($fileActExt, $allow)) {
        if ($file['size'] > 0 && $file['error'] == 0) {
            if (move_uploaded_file($file['tmp_name'], $filePath)) {
                $stmt1 = $conn->prepare("INSERT INTO file_up(h_id,u_id,file,filepath) VALUES(?,?,?,?)");
                $stmt1->bindParam(1, $h_id);
                $stmt1->bindParam(2, $u_id);
                $stmt1->bindParam(3, $fileNew);
                $stmt1->bindParam(4, $filePath);
                $result1 = $stmt1->execute();
            }
        }
    }
    
    $stmt2 = $conn->query("SELECT a_value,a_key FROM item_a WHERE a_key = '$item_id' LIMIT 1");
    $stmt2->execute();
    $rows = $stmt2->fetch(PDO::FETCH_ASSOC);
    $item_old = $rows['a_value'];
    $amount = ($item_old)+($h_value);

    $stmt3 = $conn->prepare("UPDATE item_a SET a_value = '$amount' WHERE a_key = '$item_id'");
    $result3 = $stmt3->execute();

    $stmt4 = $conn->prepare("UPDATE history SET status_id = 2 WHERE h_id = '$h_id'");
    $result4 = $stmt4->execute();

    if ($result1 && $result3 && $result4) {
        echo "<script>
            $(document).ready(function() {
                Swal.fire({
                    title: 'สำเร็จ',
                    text: 'บันทึกข้อมูลการคืนเรียบร้อย',
                    icon: 'success',
                    timer: 6000,
                    showConfirmButton: false
                });
            })
        </script>";
        header("refresh:2; url=../index_user.php");
    } else {
        echo "<script>
            $(document).ready(function() {
                Swal.fire({
                    title: 'ไม่สำเร็จ',
                    text: 'มีบางอย่างผิดพลาด !',
                    icon: 'error',
                    timer: 5000,
                    showConfirmButton: false
                });
            })
        </script>";
        header("refresh:2; url=../index_user.php");
    }
}


?>