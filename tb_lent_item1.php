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
      $deletestmt = $conn->query("DELETE FROM history WHERE h_id='$delete_id'");
      
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
            <h1 class="m-0">ข้อมูลการจ่ายวัสดุสิ้นเปลือง</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index_admin.php">หน้าหลัก</a></li>
              <li class="breadcrumb-item active">ข้อมูลการจ่ายวัสดุสิ้นเปลือง</li>
            </ol> 
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content ">
      <div class="container-fluid ">
        <div class="row justify-content-center">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped" >
                    <thead>
                      <tr class="text-center">
                        <th> #</th>
                        <th width="8%"> รหัสวัสดุ</th>
                        <th> ชื่อวัสดุ</th>
                        <th> ชื่อผู้เบิก</th>
                        <th> รหัสนักศึกษา</th>
                        <th> จำนวน</th>
                        <th> เบิก - จ่ายเมื่อ</th>
                        <!-- <th> สถานะ</th> -->
                        <th> ดำเนินการ </th>
                      </tr>
                    </thead>

                      <?php
                                $stmt1=$conn->query("SELECT
                                * FROM item_a
                                INNER JOIN history ON item_a.a_key = history.item_id WHERE history.h_type = '1' ORDER BY history.h_id DESC");
                                $stmt1->execute();
                                $rowtb = $stmt1->fetchAll();

                                if (!$rowtb) {
                                    echo "<tr><td colspan='8' class='text-center'>ไม่มีข้อมูลในระบบ</td></tr>";
                                } else {
                                    foreach ($rowtb as $row2) {
                            
                            ?>
                        <tr>
                            <td width="5%"><div align="center"><?= $row2['h_id'];?></td>
                            <td width="8%"><?= $row2['item_id'];?></td>
                            <td width="15%"><?= $row2['a_name'];?></td>
                            <td width="20%"><?= $row2['u_name'];?></td>
                            <td width="15%"><?= $row2['u_code'];?></td>
                            <td width="5%"><div align="center"><?= $row2['h_value'];?></td>
                            <td width="15%"><?=DateTimeThai($row2['lent_start']);?></td>
                            <!-- <td width="8%"><div align="center">
                              <?php
                              if($row2['status_id'] =='1'){
                                echo "<span class='badge badge-success'>ยืม</span>";
                              } else if($row2['status_id'] =='2'){
                                echo "<span class='badge badge-warning'>คืน</span>";
                              } else if($row2['status_id'] =='3'){
                                echo "<span class='badge badge-danger'>ยกเลิก</span>";
                              }
                              ?>
                            </td> -->
                            <td  width="5%">
                              <a href="updateform_lent_item1.php?h_id=<?= $row2['h_id']; ?>" ><i class="fas fa-edit"></i></a>
                              <a href="?delete=<?= $row2['h_id']; ?>" class="del-btn" data-id="<?= $row2['h_id'];?>"><i class="fas fa-trash"></i></a>
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
        $(".del-btn").click(function(e) {
            var ID = $(this).data('id');
            e.preventDefault();
            deletefileConfirm(ID);
        })
        
        function deletefileConfirm(ID) {
            Swal.fire({
                title: 'คุณแน่ใจไหม ? ',
                text: "ข้อมูลจะถูกลบอย่างถาวร !",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ใช่ ฉันต้องการลบ!',
                cancelButtonText: 'ยกเลิก!',
                showLoaderOnConfirm: true,
                preConfirm: function() {
                    return new Promise(function(resolve) {
                        $.ajax({
                                url: 'tb_lent_item1.php',
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
</body>
</html>
