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
      $deletestmt = $conn->query("DELETE FROM users WHERE u_id='$delete_id'");
      
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include 'include/header.php'; ?>
</head>
<body class="hold-transition sidebar-fixed layout-navbar-fixed ">
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
            <h1 class="m-0">ข้อมูลผู้ใช้งานระบบ</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">หน้าหลัก</a></li>
              <li class="breadcrumb-item active">ข้อมูลผู้ใช้งานระบบ</li>
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
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr class="text-center">
                            <th>#</th>
                            <th>รหัสนักศึกษา</th>
                            <th>ชื่อ - นามสกุล</th>
                            <th>อีเมล</th>
                            <th>ไอดีไลน์</th>
                            <th>เป็นสมาชิกเมื่อ</th>
                            <th>สถานะ</th>
                            <th>ดำเนินการ</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                                $stmt=$conn->query("SELECT * FROM users  ORDER BY u_id DESC");
                                $stmt->execute();
                                $rows = $stmt->fetchAll();

                                if (!$rows) {
                                    echo "<tr><td colspan='8' class='text-center'>ไม่มีข้อมูลในระบบ</td></tr>";
                                } else {
                                    foreach ($rows as $row) {
                            
                            ?>
                        <tr>
                            <td width="3%"><div align="center"><?= $row['u_id'];?></td>
                            <td width="12%"><div align="center"><?= $row['u_code'];?></td>
                            <td><?= $row['firstname'] ." ". $row['lastname'];?></td>
                            <td width="12%"><?= $row['email'];?></td>
                            <td width="10%"><?= $row['idline'];?></td>
                            <td width="15%"><?= DateTimeThai($row['creat_at']);?></td>
                            <td width="6%"><?= $row['urole'];?></td>
                            <td  width="5%">
                              <a href="updateform_member.php?u_id=<?=$row['u_id'];?>"><i class="fas fa-edit"></i></a>
                              <a href="?delete=<?= $row['u_id']; ?>" class="del-btn" data-id="<?= $row['u_id'];?>"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php } } ?>
                        </tbody>
                        </table>
                    </div>
                <!-- /.card-body -->
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
                                url: 'tb_member.php',
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
