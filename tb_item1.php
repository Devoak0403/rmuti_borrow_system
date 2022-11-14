<?php 

    session_start();
    require_once 'config/db.php';
    require_once 'class/date.php';
    if (!isset($_SESSION['admin_login'])) {
        $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
        header('location: loginpage.php');

    }

    if (isset($_GET['delete'])) {
      $delete_id = $_GET['delete'];
      $deletestmt = $conn->query("DELETE FROM item_a WHERE  a_id='$delete_id'");
      
    }
    if (isset($_GET['delete2'])){
      $delete_id = $_GET['delete2'];
      $deletestmt = $conn->query("DELETE FROM item_a WHERE  a_id='$delete_id'");
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
            <h1 class="m-0">ข้อมูลวัสดุสิ้นเปลือง</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index_admin.php">หน้าหลัก</a></li>
              <li class="breadcrumb-item active">ข้อมูลวัสดุสิ้นเปลือง</li>
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
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <table id="example1"class="table table-bordered table-striped" >
                    <thead>
                      <tr class="text-center">
                        <th> #</th>
                        <th width="8%"> รหัสวัสดุ</th>
                        <th> ชื่อวัสดุ</th>
                        <th> จำนวนต่อหน่วย</th>
                        <th> เพิ่มเข้าระบบเมื่อ</th>
                        <th> สถานะ</th>
                        <th> ดำเนินการ </th>
                      </tr>
                    </thead>

                      <?php
                                $stmt=$conn->query("SELECT
                                item_a.*,
                                unit.* 
                              FROM
                                item_a
                                INNER JOIN unit ON item_a.a_unit = unit.id 
                                AND item_a.a_type = '1' 
                                ORDER BY a_key ASC");
                                
                                $stmt->execute();
                                $rows = $stmt->fetchAll();

                                if (!$rows) {
                                    echo "<tr><td colspan='8' class='text-center'>ไม่มีข้อมูลในระบบ</td></tr>";
                                } else {
                                    foreach ($rows as $row2) {
                                    
                                    $qty = $row2['a_value'];
                                    $unit = $row2['name'];

                            
                            ?>
                        <tr>
                            <td width="5%"><div align="center"><?= $row2['a_id'];?></td>
                            <td width="8%"><?= $row2['a_key'];?></td>
                            <td width="20%"><?= $row2['a_name'];?></td>
                            <td width="13%">
                              <?php 
                              if($qty < 5 ){
                                echo "$qty / $unit <span class='badge badge-danger'> ควรเติม</span>";
                              } else {
                                echo "$qty / $unit";
                              }
                              ?>
                            </td>
                            <!-- <td width="10%"><?= $row2['a_value'] ." / ". $row2['name'];?></td> -->
                            <td width="15%"><?=DBThaiShortDate($row2['dateCreate']);?></td>
                            <td width="8%"><div align="center">
                              <?php
                              if($row2['a_status'] =='1'){
                                echo "<span class='badge badge-success'>พร้อมใช้งาน</span>";
                              }
                              ?>
                            </td>
                            <td  width="5%">
                              <a href="updateform_item1.php?a_id=<?=$row2['a_id'];?>" ><i class="fas fa-edit"></i></a>
                              <a href="?delete=<?= $row2['a_id']; ?>" class="delitem1-btn" data-id="<?= $row2['a_id'];?>"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php } } ?>
                    <tbody>
                    </tbody>
                  </table>
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
