<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php   
session_start();
require_once '../config/db.php';

if(isset($_POST['submit'])){

    $a_key = $_POST['a_key'];
    $a_name = $_POST['a_name'];
    $a_value = $_POST['a_value'];
    $a_unit = $_POST['a_unit'];
    $a_type = $_POST['a_type'];
    $a_status = $_POST['a_status'];

    $stmt=$conn->prepare("INSERT INTO item_a(a_key,a_name,a_value,a_type,a_unit,a_status)VALUES(?,?,?,?,?,?)");
    $stmt->bindParam(1, $a_key);
    $stmt->bindParam(2, $a_name);
    $stmt->bindParam(3, $a_value);
    $stmt->bindParam(4, $a_type);
    $stmt->bindParam(5, $a_unit);
    $stmt->bindParam(6, $a_status);
    $result = $stmt->execute();

    if ($result) {
        $_SESSION['success'] = "ข้อมูลถูกบันทึกเรียบร้อย";
        echo "<script>
            $(document).ready(function() {
                Swal.fire({
                    title: 'สำเร็จ',
                    text: 'ข้อมูลถูกบันทึกเรียบร้อย!',
                    icon: 'success',
                    timer: 5000,
                    showConfirmButton: false
                });
            })
        </script>";
        header("refresh:2; url=../form_item.php");
    } else {
        $_SESSION['error'] = "ข้อมูลบันทึกไม่สำเร็จ!";
        echo "<script>
            $(document).ready(function() {
                Swal.fire({
                    title: 'ไม่สำเร็จ',
                    text: 'ข้อมูลบันทึกไม่สำเร็จ !',
                    icon: 'success',
                    timer: 5000,
                    showConfirmButton: false
                });
            })
        </script>";
        header("refresh:2; url=../form_item.php");
    }
}

?>