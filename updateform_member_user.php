<?php 

    session_start();
    require_once 'config/db.php';
    require_once 'class/date.php';
    if (!isset($_SESSION['user_login'])) {
        $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
        header('location: loginpage.php');

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include 'include_user/header.php'; ?>
</head>
<body class="hold-transition layout-navbar-fixed ">
<div class="wrapper">

  <!-- Preloader -->
  <!-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/CLOCK_LT.png" alt="CLOCK_LT.png" height="150" width="100">
  </div> -->

  <?php include 'include_user/navbar.php'; ?>

  <?php include 'include_user/sidebar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">แก้ไขข้อมูลของฉัน</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index_user.php">หน้าหลัก</a></li>
              <li class="breadcrumb-item active">แก้ไขข้อมูลของฉัน</li>
            </ol> 
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <form action="sql/update_member_user.php" method="POST">
                              <?php 
                                  if (isset($_GET['u_id'])) {
                                      $id = $_GET['u_id'];
                                      $stmt = $conn->query("SELECT * FROM users WHERE u_id = '$id'");
                                      $stmt->execute();
                                      $row = $stmt->fetch();
                                  }
                              ?>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">รหัสนักศึกษา</label>
                                <div class="col-sm-4">
                                <input type="text" class="form-control" name="u_code" value="<?=$row['u_code'];?>">
                                <input type="text" class="form-control" name="u_id" hidden value="<?=$row['u_id'];?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">ชื่อ</label>
                                <div class="col-sm-4">
                                <input type="text" class="form-control " name="firstname" value="<?=$row['firstname'];?>">
                                </div>
                                <label for="inputEmail3" class="col-sm-2 col-form-label">นามสกุล</label>
                                <div class="col-sm-4">
                                <input type="text" class="form-control" name="lastname" value="<?=$row['lastname'];?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">อีเมล</label>
                                <div class="col-sm-10">
                                <input type="email" class="form-control" name="email" value="<?=$row['email'];?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">รหัสผ่าน</label>
                                <div class="col-sm-4">
                                <input type="password" class="form-control" name="password" >
                                </div>
                                <label for="inputEmail3" class="col-sm-2 col-form-label">ยืนยันรหัสผ่าน</label>
                                <div class="col-sm-4">
                                <input type="password" class="form-control" name="c_password" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">ไอดีไลน์</label>
                                <div class="col-sm-4">
                                <input type="text" class="form-control" name="idline" value="<?=$row['idline'];?>">
                                </div>
                                <label for="inputEmail3" class="col-sm-2 col-form-label">เบอร์โทร</label>
                                <div class="col-sm-4">
                                <input type="tel" class="form-control" name="phone" value="<?=$row['phone'];?>">
                                </div>
                            </div>
                            <div class="form-group justify-content-end  mt-4">
                                <div class="col-4">
                                  <button name="update" type="submit" id="btnadditem" class="btn btn-outline-primary ">ตกลง</button>
                                  <button type="reset" id="btnreitem" class="btn btn-outline-danger ">ยกเลิก</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
          </div>
      </div>
    </section>
  </div>
  <?php include 'include_user/footer.php'; ?>
</div>
  <?php include 'include_user/footer_script.php'; ?>

  <script>
      let imgInput = document.getElementById('imgInput');
      let previewImg = document.getElementById('previewImg');

      imgInput.onchange = evt => {
          const [file] = imgInput.files;
              if (file) {
                  previewImg.src = URL.createObjectURL(file)
          }
      }

  </script>

</body>
</html>
