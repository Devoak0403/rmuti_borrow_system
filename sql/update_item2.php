<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php   
session_start();
require_once '../config/db.php';

if(isset($_POST['update'])){

    $a_id = $_POST['a_id'];
    $a_key = $_POST['a_key'];
    $a_name = $_POST['a_name'];
    $a_value = $_POST['a_value'];
    $a_unit = $_POST['a_unit'];
    $a_type = $_POST['a_type'];
    $a_status = $_POST['a_status'];
    $a_value_new = $_POST['a_value_new'];

    if($a_value_new !== ''){
        $amount = ($a_value)+($a_value_new);

        $stmt=$conn->prepare("UPDATE item_a SET a_id=:a_id,a_key=:a_key,a_name=:a_name,a_value=:amount,a_unit=:a_unit,a_type=:a_type,a_status=:a_status WHERE a_id=:a_id");
        $stmt->bindParam(":a_id", $a_id);
        $stmt->bindParam(":a_key", $a_key);
        $stmt->bindParam(":a_name", $a_name);
        $stmt->bindParam(":amount", $amount);
        $stmt->bindParam(":a_unit", $a_unit);
        $stmt->bindParam(":a_type", $a_type);
        $stmt->bindParam(":a_status", $a_status);
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
    } else {
        $stmt=$conn->prepare("UPDATE item_a SET a_id=:a_id,a_key=:a_key,a_name=:a_name,a_value=:a_value,a_unit=:a_unit,a_type=:a_type,a_status=:a_status WHERE a_id=:a_id");
        $stmt->bindParam(":a_id", $a_id);
        $stmt->bindParam(":a_key", $a_key);
        $stmt->bindParam(":a_name", $a_name);
        $stmt->bindParam(":a_value", $a_value);
        $stmt->bindParam(":a_unit", $a_unit);
        $stmt->bindParam(":a_type", $a_type);
        $stmt->bindParam(":a_status", $a_status);
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
    
}

?>