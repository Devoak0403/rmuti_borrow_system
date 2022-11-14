<?php 

    session_start();
    require_once 'config/db.php';
    require_once 'class/date.php';
    if (!isset($_SESSION['admin_login'])) {
        $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
        header('location: loginpage.php');

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include 'include/header.php'; ?>
</head>
<body class="hold-transition layout-navbar-fixed ">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/CLOCK_LT.png" alt="CLOCK_LT.png" height="150" width="100">
  </div>

  <?php include 'include/navbar.php'; ?>

  <?php include 'include/sidebar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">แก้ไขข้อมูลการยืม</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index_admin.php">หน้าหลัก</a></li>
              <li class="breadcrumb-item"><a href="tb_lent.php">ข้อมูลการยืม</a></li>
              <li class="breadcrumb-item active">แก้ไขข้อมูลการยืม</li>
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
                        <form action="sql/update_lent.php" method="POST">
                              <?php 
                                  if (isset($_GET['h_id'])) {
                                      $id = $_GET['h_id'];
                                      $stmt = $conn->query("SELECT
                                      * FROM item_a
                                      INNER JOIN history ON item_a.a_key = history.item_id
                                      WHERE history.h_id = $id" );
                                      $stmt->execute();
                                      $row = $stmt->fetch();
                                  }
                              ?>
                                <!-- <input type="text" name="u_id" value="<?=$row['id']?>" hidden> -->
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">#</label>
                                <div class="col-sm-4">
                                <input type="text" class="form-control" name="h_id" value="<?=$row['h_id'];?>" readonly>
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">รหัสวัสดุ</label>
                                <div class="col-sm-4">
                                <input type="text" class="form-control" name="item_id" value="<?=$row['item_id'];?>" readonly>
                                </div>
                                <label for="inputEmail3" class="col-sm-2 col-form-label">ชื่อวัสดุ</label>
                                <div class="col-sm-4">
                                <input type="text" class="form-control" name="a_name" value="<?=$row['a_name'];?>" readonly>
                                </div>
                            </div>    
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">ชื่อ - นามสกุล</label>
                                <div class="col-sm-4">
                                <input type="text" class="form-control" name="u_name" value="<?=$row['u_name'];?>" readonly>
                                </div>
                                <label for="inputEmail3" class="col-sm-2 col-form-label">รหัสนักศึกษา</label>
                                <div class="col-sm-4">
                                <input type="text" class="form-control" name="u_code" value="<?=$row['u_code'];?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-2 col-form-label">จำนวน </label>
                              <div class="col-sm-4">
                                <input type="text" class="form-control" name="h_value" value="<?=$row['h_value'];?>" readonly>
                              </div>
                              <label for="inputEmail3" class="col-sm-2 col-form-label">เบิกเมื่อ</label readonly>
                              <div class="col-sm-4">
                                <input type="datetime-local" class="form-control"  value="<?=$row['lent_start'];?>" name="lent_start" readonly >
                              </div>
                            </div>
                            
                            <div class="form-group justify-content-end  mt-4">
                                <div class="col-4">
                                  
                                  <a href="tb_lent_item1.php" class="btn btn-outline-warning">ย้อนกลับ</a>
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
  <?php include 'include/footer.php'; ?>
</div>
  <?php include 'include/footer_script.php'; ?>
  <?php include 'class/autoselect.php' ;?> 
</body>
</html>
