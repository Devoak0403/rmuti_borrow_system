
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php   
session_start();
require_once '../config/db.php';
require_once '../class/date.php';

if(isset($_POST['update'])){

    $u_name = $_POST['u_name'];
    $u_id = $_POST['u_id'];
    $h_type = $_POST['h_type'];
    $h_value = $_POST['h_value'];
    $item_id = $_POST['item_id'];
    $status_id = $_POST['status_id'];

    $strStartDate = $_POST['lent_start'];
    $strNewDate = date ("Y-m-d H:i:s", strtotime("+10 day", strtotime($strStartDate)));
    $datethai = DBThaiShortDate($strNewDate);

    $stmt1 = $conn->query("SELECT a_value,a_key FROM item_a WHERE a_key = '$item_id' LIMIT 1");
    $stmt1->execute();
    $rows = $stmt1->fetch(PDO::FETCH_ASSOC);
    $item_old = $rows['a_value'];
    $amount = ($item_old)-($h_value);
    $a_key = $rows['a_key'];
        
    if($item_old < $h_value){
            echo "<script>
            $(document).ready(function() {
                Swal.fire({
                    title: 'เกิดข้อผิดพลาด',
                    text: 'จำนวนที่ยืมมากกว่าจำนวนที่มีอยู่ จำนวนคงเหลืออยุ่ที่ : $item_old ',
                    icon: 'error',
                    timer: 5000,
                    showConfirmButton: false
                });
            })
            </script>";
            header("refresh:4; url=../form_lent.php");
    } else{

        $stmt2=$conn->prepare("UPDATE history SET h_type = :h_type, h_value = :h_value, lent_start = :strStartDate, lent_end = :datethai, status_id = :status_id WHERE h_id = :h_id");
        $stmt2->bindParam(':h_type',$h_type);
        $stmt2->bindParam(':h_value',$h_value);
        $stmt2->bindParam(':strStartDate',$strStartDate);
        $stmt2->bindParam(':datethai',$datethai);
        $stmt2->bindParam(':status_id',$status_id);
        $stmt2->bindParam(':h_id',$u_id);
        $result2 = $stmt2->execute();

        $stmt3=$conn->prepare("UPDATE item_a SET a_key=:item_id,a_value='$amount' WHERE a_key=:item_id");
        $stmt3->bindParam(":item_id", $a_key);
        $stmt3->bindParam(":amount", $a_value);
        $result3 = $stmt3->execute();

        if ($result2 && $result3) {
            echo "<script>
                $(document).ready(function() {
                    Swal.fire({
                        title: 'บันทึกข้อมูลการยืมสำเร็จ',
                        text: 'กำหนดคืน : $datethai',
                        icon: 'success',
                        timer: 6000,
                        showConfirmButton: false
                    });
                })
            </script>";
            header("refresh:4; url=../tb_lent.php");
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
            header("refresh:2; url=../tb_lent.php");
        }
    }

}

?>