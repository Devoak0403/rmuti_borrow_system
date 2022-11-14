<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php 

session_start();
require_once '../config/db.php';

    if (isset($_POST['submit'])) {

        $u_code = $_POST['u_code'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $c_password = $_POST['c_password'];
        $idline = $_POST['idline'];
        $phone = $_POST['phone'];
        $urole = $_POST['urole'];
        
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users(firstname, lastname, email, password, urole , u_id, idline ,phone) VALUES(?,?,?,?,?,?,?,?)");
        $stmt->bindParam( 1, $firstname);
        $stmt->bindParam( 2, $lastname);
        $stmt->bindParam( 3, $email);
        $stmt->bindParam( 4, $passwordHash);
        $stmt->bindParam( 5, $urole);
        $stmt->bindParam( 6, $u_id);
        $stmt->bindParam( 7, $idline);
        $stmt->bindParam( 8, $phone);
        $result = $stmt->execute();

        if ($result) {
        echo "<script>
        $(document).ready(function() {
            Swal.fire({
                title: 'สำเร็จ',
                text: 'เพิ่มสมาชิกเรียบร้อยแล้ว!',
                icon: 'success',
                timer: 5000,
                showConfirmButton: false
            });
        })
        </script>";
        header("refresh:2; url=../form_user.php");
    } else {
        echo "<script>
        $(document).ready(function() {
            Swal.fire({
                title: 'ผิดพลาด',
                text: 'มีบางอย่างผิดพลาด!',
                icon: 'error',
                timer: 5000,
                showConfirmButton: false
            });
        })
        </script>";
        header("refresh:2; url=../form_user.php");
    }

} 


?>