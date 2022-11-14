<?php 

    session_start();
    require_once 'config/db.php';
    require_once 'class/date.php';
    if (!isset($_SESSION['admin_login'])) {
        $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
        header('location: loginpage.php');
    // } else{
    //   $url1=$_SERVER['REQUEST_URI'];
    //   header("Refresh: 30; URL=$url1");

    //   $date_now = date('Y-m-d');
      
    //   $stmtexp = $conn->prepare("SELECT lent_end FROM history ");
    //   $stmtexp->execute();
    //   $result = $stmtexp->fetchAll();
      
    //   foreach ($result as $key => $value) {
    //       $lent_exp = $value['lent_end'];
    //       if ($date_now > $lent_exp) {
               
    //       }
    
    //   }
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
            <h1 class="m-0">หน้าหลัก</h1>
            <!-- <?php 
            $e = explode("-", $date_now);
            $e2 = explode("-", $lent_exp);

            $new_e = implode($e);
            $new_e2 = implode($e2);

            $new_date = Date("Y-m-d", strtotime("$lent_exp -3 Day"));

            if($new_date < $date_now){
              echo "<div class='alert alert-danger' role='alert'>
              การยืมหนังสือที่หมดอายุแล้วจะถูกยกเลิกหลังจาก 3 วัน
              </div>";

              $name=addslashes($user_name);
              $email=addslashes($mail);

              $sub = "ยืนยันการสมัครสมาชิก";
              $mes = "สวัสดีคุณ $name คุณได้ทำการสมัครสมาชิกเรียบร้อยแล้ว กรุณาตรวจสอบอีเมล์ของคุณเพื่อยืนยันการสมัครสมาชิก";

              $sj=addslashes($sub);
              $msg=addslashes($mes);
              $to=$email;
              $subject=$sj;
              $message=$msg;

              $header="From:".$email."\r\n";
              $header.="MIME-Version:1.0\r\n";
              $header.="Content-type:text/html\r\n";
              $retval=mail($to,$subject,$message,$header);

            }

            echo 'ตอนนี้' .$new_e;
            echo'<br>';
            echo 'กำหนด' .$new_e2; 
            echo'<br>';
            echo 'คำนวน' .$new_date;
            
            ?> -->
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- <div class="row">
          <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                <?php

                  $stmt=$conn->query("SELECT *,COUNT(*)As c_1 FROM item_a WHERE a_type ='1'");
                  $stmt->execute();
                  $rows = $stmt->fetchAll();
                  foreach ($rows as $row){

                  
                ?>
                <p>จำนวนวัสดุสิ้นเปลือง</p>
                <h3><?=$row['c_1'];?></h3>
                 <?php } ?>
                
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="form_item.php" class="small-box-footer">เพิ่มเติม <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-primary">
              <div class="inner">
                  <?php

                  $stmt=$conn->query("SELECT *,COUNT(*)As c_2 FROM item_a WHERE a_type ='2'");
                  $stmt->execute();
                  $rows = $stmt->fetchAll();
                  foreach ($rows as $row){


                  ?>
                  <p>จำนวนครุภัณฑ์</p>
                  <h3><?=$row['c_2'];?></h3>
                  <?php } ?>

                
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="form_item.php" class="small-box-footer">เพิ่มเติม <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div> -->
        <div class="row">
          <div class="col-md-3 col-sm-6 col-12">
              <a href="tb_item1.php">
              <div class="info-box">
                <span class="info-box-icon bg-primary "><i class="fas fa-wrench"></i></span>
                <div class="info-box-content">
                    <?php

                    $stmt=$conn->query("SELECT *,COUNT(*)As c_1 FROM item_a WHERE a_type ='1'");
                    $stmt->execute();
                    $rows = $stmt->fetchAll();
                    foreach ($rows as $row){


                    ?>
                  <span class="info-box-text text-dark">จำนวนวัสดุสิ้นเปลือง</span>
                    <span class="info-box-number"><h3><?=$row['c_1'];?> รายการ</h3>
                    
                    <?php } ?></span>
                </div>
              </div>
            </a>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
            <a href="tb_item2.php">
              <div class="info-box">
                <span class="info-box-icon bg-warning"><i class="fas fa-pen"></i></span>

                <div class="info-box-content">
                    <?php

                    $stmt=$conn->query("SELECT *,COUNT(*)As c_2 FROM item_a WHERE a_type ='2'");
                    $stmt->execute();
                    $rows = $stmt->fetchAll();
                    foreach ($rows as $row){


                    ?>
                    <span class="info-box-text text-dark">จำนวนครุภัณฑ์</span>
                    <span class="info-box-number"><h3><?=$row['c_2'];?> รายการ</h3>
                    <?php } ?></span>
                </div>
                <!-- /.info-box-content -->
              </div>
              </a>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
              <a href="tb_item1.php">
              <div class="info-box">
                <span class="info-box-icon bg-danger"><i class="fas fa-cart-arrow-down"></i></span>

                <div class="info-box-content">
                    <?php

                    $stmt=$conn->query("SELECT *,COUNT(*)As low_item FROM item_a WHERE a_type ='1' AND a_value < 5");
                    $stmt->execute();
                    $rows = $stmt->fetchAll();
                    foreach ($rows as $row){


                    ?>
                  <span class="info-box-text text-dark">วัสดุใกล้หมด</span>
                    <span class="info-box-number"><h3><?=$row['low_item'];?> รายการ</h3>
                    <?php } ?></span>
                </div>
                <!-- /.info-box-content -->
              </div>
              </a>
              <!-- /.info-box -->
            </div>
            <div class="col-md-3 col-sm-6 col-12">
              <div class="info-box">
                <span class="info-box-icon bg-indigo"><i class="fas fa-hand-holding"></i></span>

                <div class="info-box-content">
                    <?php

                    $stmt=$conn->query("SELECT *,COUNT(*)As c_3 FROM history ");
                    $stmt->execute();
                    $rows = $stmt->fetchAll();
                    foreach ($rows as $row){


                    ?>
                  <span class="info-box-text">จำนวนการทำรายเบิก-จ่ายทั้งหมด</span>
                    <span class="info-box-number"><h3><?=$row['c_3'];?> รายการ</h3>
                    <?php } ?></span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <div class="col-md-3 col-sm-6 col-12">
              <div class="info-box">
                <span class="info-box-icon bg-teal"><i class="fas fa-users"></i></span>

                <div class="info-box-content">
                  <?php

                  $stmt=$conn->query("SELECT *,COUNT(*)As c_4 FROM users ");
                  $stmt->execute();
                  $rows = $stmt->fetchAll();
                  foreach ($rows as $row){


                  ?>
                  <span class="info-box-text">จำนวนสมาชิกในระบบ</span>
                  <span class="info-box-number"><h3><?=$row['c_4'];?> บัญชี</h3>
                  <?php } ?></span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header bg-info">
                <h3 class="card-title">ข้อมูลการเบิกวัสดุ <span class="badge bg-danger "> NEW</span></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr class="text-center">
                      <th>รหัสนักศึกษา</th>
                      <th>ชื่อวัสดุ</th>
                      <th>จำนวน</th>
                      <th>เบิกเมื่อ</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $stmt=$conn->query("SELECT * FROM history INNER JOIN item_a ON history.item_id = item_a.a_key WHERE history.h_type = 1  ORDER BY history.lent_start DESC LIMIT 5" );
                    $stmt->execute();
                    $rows = $stmt->fetchAll();
                    if (!$rows) {
                      echo "<tr><td colspan='10' class='text-center'>ไม่มีรายการของคุณ</td></tr>";
                    } else {
                      foreach ($rows as $row) {
                    ?>
                    <tr class="text-center">
                      <td hidden><?=$row['h_id'];?></td>
                      <td><?=$row['u_code'];?></td>
                      <td><?=$row['a_name'];?></td>
                      <td><?=$row['h_value'];?></td>
                      <td><?=DateTimeThai($row['lent_start']);?></td>
                    </tr>
                  </tbody>
                  <?php } }  ?>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <div class="col-md-6">
            <div class="card">
              <div class="card-header bg-success">
                <h3 class="card-title">ข้อมูลการยืมครุภัณฑ์ล่าสุด <span class="badge bg-danger "> NEW</span></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr class="text-center">
                      <th>รหัสนักศึกษา</th>
                      <th>ชื่อครุภัณฑ์</th>
                      <th>จำนวน</th>
                      <th>วันที่ยืม</th>
                      <th>สถานะ</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $stmt=$conn->query("SELECT * FROM history INNER JOIN item_a ON history.item_id = item_a.a_key WHERE history.h_type = 2 AND history.status_id = 1 ORDER BY history.lent_start DESC LIMIT 10" );
                    $stmt->execute();
                    $rows = $stmt->fetchAll();
                    if (!$rows) {
                      echo "<tr><td colspan='10' class='text-center'>ไม่มีรายการของคุณ</td></tr>";
                    } else {
                      foreach ($rows as $row) {
                    ?>
                    <tr class="text-center">
                      <td hidden><?=$row['h_id'];?></td>
                      <td><?=$row['u_code'];?></td>
                      <td><?=$row['a_name'];?></td>
                      <td><?=$row['h_value'];?></td>
                      <td><?=DateTimeThai($row['lent_start']);?></td>
                      <td><?php 
                        if($row['status_id']=='1'){
                          echo '<span class="badge badge-success text-md p-2">ยืม</span>';
                        } else if($row['status_id']=='2'){
                          echo '<span class="badge badge-info text-md p-2">คืน</span>';
                        } else if($row['status_id']=='3'){
                          echo '<span class="badge badge-danger text-md p-2">เกินกำหนด</span>';
                        }
                        ?>
                        </td>
                        <td >
                          <a href="updateform_lent_item2.php?h_id=<?=$row['h_id'];?>" ><i class="fas fa-edit"></i></a>
                        </td>
                    </tr>
                  </tbody>
                  <?php } }  ?>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </section>
  </div>
  <?php include 'include/footer.php'; ?>
</div>
  <?php include 'include/footer_script.php'; ?>
</body>
</html>
