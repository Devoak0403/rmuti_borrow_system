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
            <h1 class="m-0">ฟอร์มกรอกข้อมูลการยืม</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index_user.php">หน้าหลัก</a></li>
              <li class="breadcrumb-item active">ฟอร์มกรอกข้อมูลการยืม</li>
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
                        <form action="sql/update_lent_user.php" method="POST" enctype="multipart/form-data">
                              <?php 
                                  if (isset($_GET['h_id'])) {
                                      $id = $_GET['h_id'];
                                      $stmt = $conn->query("SELECT
                                      * FROM item_a
                                      INNER JOIN history ON item_a.a_key = history.item_id INNER JOIN users ON history.u_id = users.u_id
                                      WHERE history.h_id = $id");
                                      $stmt->execute();
                                      $row = $stmt->fetch();
                                  }
                              ?>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label"># <?=$row['h_id'];?></label>
                                <div class="col-sm-4">
                                <input type="text" class="form-control" name="h_id" value="<?=$row['h_id'];?>" hidden>
                                <input type="text" class="form-control" name="u_id" value="<?=$row['u_id'];?>" hidden>
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
                              <label for="inputEmail3" class="col-sm-2 col-form-label">จำนวน </label>
                              <div class="col-sm-4">
                                <input type="text" class="form-control" name="h_value" value="<?=$row['h_value'];?>" readonly>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-2 col-form-label">ยืมเมื่อ</label>
                              <div class="col-sm-4">
                                <input type="text" class="form-control" value="<?=DBThaiShortDate($row['lent_start']);?>" name="lent_start" readonly>
                              </div>
                              <label for="inputEmail3" class="col-sm-2 col-form-label">กำหนดคืน </label>
                              <div class="col-sm-4">
                                <input type="text" class="form-control" value="<?=DBThaiShortDate($row['lent_end']);?>" name="lent_end" readonly>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-2 col-form-label">สถานะ</label>
                              <div class="col-sm-4">
                                <?php if($row['status_id'] == '1'){ 
                                    echo '<span class="badge badge-success text-lg pl-3 pr-3" >ยืม</span>';
                                  }else if($row['status_id'] == '2'){
                                    echo '<span class="badge badge-info text-lg pl-3 pr-3" >คืน</span>';
                                  }else if($row['status_id'] == '3'){
                                    echo '<span class="badge badge-danger text-lg pl-3 pr-3" >เกินกำหนด</span>';
                                  }
                                  ?>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-2 col-form-label">แนบหลักฐาน</label>
                              <div class="col-sm-4 ">
                                <input type="file" id="imgInput" class="form-control" name="file" >
                              </div>
                              <div class="col-sm-6 ">
                                <img loading="lazy" width="100%" id="previewImg" alt="">
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
