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
            <h1 class="m-0">แก้ไขข้อมูลวัสดุสิ้นเปลือง</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index_admin.php">หน้าหลัก</a></li>
              <li class="breadcrumb-item"><a href="form_item.php">ข้อมูลวัสดุสิ้นเปลือง</a></li>
              <li class="breadcrumb-item active">แก้ไขข้อมูลวัสดุสิ้นเปลือง</li>
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
                        <form action="sql/update_item1.php" method="POST">
                              <?php 
                                  if (isset($_GET['a_id'])) {
                                      $id = $_GET['a_id'];
                                      $stmt = $conn->query("SELECT
                                      * FROM item_a,unit WHERE item_a.a_unit = unit.id AND item_a.a_id = '$id'");
                                      $stmt->execute();
                                      $row = $stmt->fetch();
                                  }
                              ?>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">#</label>
                                <div class="col-sm-4">
                                <input type="text" class="form-control" name="a_id" value="<?=$row['a_id'];?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">รหัสวัสดุ</label>
                                <div class="col-sm-4">
                                <input type="text" class="form-control" name="a_key" value="<?=$row['a_key'];?>" readonly>
                                </div>
                                <label for="inputEmail3" class="col-sm-2 col-form-label">ชื่อวัสดุ</label>
                                <div class="col-sm-4">
                                <input type="text" class="form-control" name="a_name" value="<?=$row['a_name'];?>" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">จำนวนคงเหลือ</label>
                                <div class="col-sm-4">
                                <input type="text" class="form-control" name="a_value" value="<?=$row['a_value'];?>" readonly>
                                </div>
                                <label for="inputEmail3" class="col-sm-2 col-form-label">จำนวนเพิ่ม</label>
                                <div class="col-sm-4">
                                <input type="text" class="form-control" name="a_value_new" value="" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">หน่วย</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                      <select class="custom-select rounded-0" name="a_unit">
                                        <option value="<?=$row['a_unit'];?>">--- ค่าปัจจุบัน : <?=$row['name'];?> ---</option>
                                        <?php
                                          $stmt = $conn->query("SELECT * FROM unit");
                                          $stmt->execute();
                                          $rows = $stmt->fetchAll();
                                          foreach ($rows as $row) {
                                        ?>
                                        <option value="<?=$row['id'];?>"><?=$row['name'];?></option>
                                            <?php } ?>
                                      </select>
                                    </div>   
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">หมวด</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                      <select class="custom-select rounded-0" name="a_type">
                                        <option value="1">วัสดุสิ้นเปลือง</option>
                                        <option value="2">ครุภัณฑ์</option>
                                      </select>
                                    </div>   
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">สถานะ</label>
                                <div class="col-sm-10">
                                  <select class="custom-select rounded-0" name="a_status">
                                        <option value="1">พร้อมใช้งาน</option>
                                        <option value="2">ไม่พร้อมใช้งาน</option>
                                  </select>
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
  <?php include 'include/footer.php'; ?>
</div>
  <?php include 'include/footer_script.php'; ?>

  <script>
        $(".delitem1-btn").click(function(e) {
            var ID = $(this).data('id');
            e.preventDefault();
            deletefileConfirm(ID);
        })
        
        function deletefileConfirm(ID) {
            Swal.fire({
                title: 'คุณแน่ใจไหม ? ',
                text: "ข้อมูลจะถูกลบอย่างถาวร *รวมถึงไฟล์ที่จัดเก็บในฐานข้อมูลด้วย!",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ใช่ ฉันต้องการลบ!',
                cancelButtonText: 'ยกเลิก!',
                showLoaderOnConfirm: true,
                preConfirm: function() {
                    return new Promise(function(resolve) {
                        $.ajax({
                                url: 'form_item.php',
                                type: 'GET',
                                data: 'delete=' + ID,
                            })
                            .done(function() {
                                Swal.fire({
                                    title: 'สำเร็จ',
                                    text: 'ข้อมูลถูกลบสำเร็จ!',
                                    icon: 'success',
                                }).then(() => {
                                    window.location.reload();
                                })
                            })
                            .fail(function() {
                                Swal.fire('มีบางอย่างผิดพลาด!', 'error')
                                window.location.reload();
                            });
                    });
                },
            });
        }
    </script>
    
    <script>
        $(".delitem2-btn").click(function(e) {
            var ID = $(this).data('id');
            e.preventDefault();
            deletefileConfirm(ID);
        })
        
        function deletefileConfirm(ID) {
            Swal.fire({
                title: 'คุณแน่ใจไหม ? ',
                text: "ข้อมูลจะถูกลบอย่างถาวร *รวมถึงไฟล์ที่จัดเก็บในฐานข้อมูลด้วย!",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ใช่ ฉันต้องการลบ!',
                cancelButtonText: 'ยกเลิก!',
                showLoaderOnConfirm: true,
                preConfirm: function() {
                    return new Promise(function(resolve) {
                        $.ajax({
                                url: 'form_item.php',
                                type: 'GET',
                                data: 'delete2=' + ID,
                            })
                            .done(function() {
                                Swal.fire({
                                    title: 'สำเร็จ',
                                    text: 'ข้อมูลถูกลบสำเร็จ!',
                                    icon: 'success',
                                }).then(() => {
                                    window.location.reload();
                                })
                            })
                            .fail(function() {
                                Swal.fire('มีบางอย่างผิดพลาด!', 'error')
                                window.location.reload();
                            });
                    });
                },
            });
        }
    </script> 
</body>
</html>
