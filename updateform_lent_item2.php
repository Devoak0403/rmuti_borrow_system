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

  <!-- <div class="preloader flex-column justify-content-center align-items-center">

    <img class="animation__shake" src="dist/img/CLOCK_LT.png" alt="CLOCK_LT.png" height="150" width="100">

  </div> -->



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

              <li class="breadcrumb-item"><a href="tb_lent_item2.php">ข้อมูลการยืม</a></li>

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

                        <form action="sql/update_lent_item2.php" method="POST">

                              <?php 

                                  if (isset($_GET['h_id'])) {

                                      $id = $_GET['h_id'];

                                      // $stmt = $conn->query("SELECT * FROM history INNER JOIN item_a ON history.item_id=item_a.a_key WHERE history.h_id ='$id'");

                                      // $stmt->execute();

                                      // $row = $stmt->fetch();

                                      $stmt1 = $conn->query("SELECT * FROM history LEFT JOIN item_a ON history.item_id=item_a.a_key LEFT JOIN file_up ON history.h_id=file_up.h_id WHERE history.h_id ='$id'");

                                      $stmt1->execute();

                                      $row1 = $stmt1->fetch();

                                  }

                              ?>

                                <!-- <input type="text" name="u_id" value="<?=$row1['id']?>" hidden> -->

                              <div class="form-group row">

                                <!-- <label for="inputEmail3" class="col-sm-2 col-form-label">#</label> -->

                                <div class="col-sm-4">

                                <!-- <input type="text" class="form-control" name="h_id" value="<?=$row1['h_id'];?>" readonly> -->

                                </div>

                              </div>

                              <div class="form-group row">

                                <label for="inputEmail3" class="col-sm-2 col-form-label">ชื่อผู้ยืม</label>

                                <div class="col-sm-4">

                                  <input type="text" class="form-control" name="u_name" value="<?=$row1['u_name'];?>" readonly>

                                </div>

                                <label for="inputEmail3" class="col-sm-2 col-form-label">รหัสนักศึกษา</label>

                                <div class="col-sm-4">

                                  <input type="text" class="form-control" name="u_id" value="<?=$row1['u_code'];?>" readonly>

                                </div>

                              </div>

                              <div class="form-group row">

                                <label for="inputEmail3" class="col-sm-2 col-form-label">รหัสวัสดุ</label>

                                <div class="col-sm-4">

                                <input type="text" class="form-control" name="item_id" value="<?=$row1['item_id'];?>" readonly>

                              </div>

                                <label for="inputEmail3" class="col-sm-2 col-form-label">ชื่อวัสดุ</label>

                                <div class="col-sm-4">

                                  <input type="text" class="form-control" name="u_id" value="<?=$row1['a_name'];?>" readonly>

                                </div>

                              </div>    

                              <div class="form-group row">

                                <label for="inputEmail3" class="col-sm-2 col-form-label">จำนวน </label>

                                <div class="col-sm-4">

                                  <input type="text" class="form-control" name="h_value" value="<?=$row1['h_value'];?>" readonly>

                                </div>

                                <label for="inputEmail3" class="col-sm-2 col-form-label">สถานะปัจจุบัน</label>

                                <div class="col-sm-4">

                                  <select class="custom-select rounded-0" name="status_id" >

                                    <option value="1" <?php if($row1['status_id'] == 1) echo 'selected'; ?>>ยืม</option>

                                    <option value="2" <?php if($row1['status_id'] == 2) echo 'selected'; ?>>คืน</option>

                                    <option value="3" <?php if($row1['status_id'] == 3) echo 'selected'; ?>>เกินกำหนด</option>

                                  </select>

                                </div>

                              </div>

                              <div class="form-group row">

                                <label for="inputEmail3" class="col-sm-2 col-form-label">ยืมเมื่อ</label>

                                <div class="col-sm-4">

                                  <input type="text" class="form-control"  name="lent_start" value="<?=DateTimeThai($row1['lent_start']);?>" readonly>

                                </div>

                                <label for="inputEmail3" class="col-sm-2 col-form-label">กำหนดคืน</label>

                                <div class="col-sm-4">

                                <input type="text" class="form-control"  name="lent_end" value="<?=DateTimeThai($row1['lent_end']);?>" readonly>

                                </div>

                                <!-- <small class="mt-2"><i class="text-danger mt-2">* หากเกินกำหนด กรุณาเลือกสถานะเกินกำหนด</i></small> -->

                              </div>  

                              <div class="form-group row">

                                <label for="inputEmail3" class="col-sm-2 col-form-label">ไฟล์แนบการคืน</label>

                                <div class="col-sm-4">

                                <?php

                                if($row1['f_id'] > 0){
                                  echo ' <a href="upload/'.$row1['file'].'" target="_blank">

                                  <img src="upload/'.$row1['file'].'" width="400px" height="400px" class="img-fluid">

                                </a>';
                                }
                                else{
                                  echo 'ยังไม่ทำรายการคืน';
                                }

                                  ?>

                                  

                                </div>

                              </div>

                                

                                <!-- <div class="form-group justify-content-end  mt-4">

                                  <div class="col-4">

                                    <button name="update" type="submit" class="btn btn-outline-primary ">ตกลง</button>

                                    <button type="reset" class="btn btn-outline-danger ">ยกเลิก</button>

                                  </div> -->

                            </div>

                          </form>

                        </div>

                      </div>

                    </div>

                    <!-- <div class="col-lg-7">

                      <div class="card">

                        <div class="card-header">

                          วัสดุสิ้นเปลือง

                </div>

                <div class="card-body">

                  <table class="table table-bordered table-striped" >

                    <thead>

                      <tr class="text-center">

                        <th> #</th>

                        <th width="8%"> รหัสวัสดุ</th>

                        <th> ชื่อวัสดุ</th>

                        <th> จำนวนต่อหน่วย</th>

                        <th> เพิ่มเข้าระบบเมื่อ</th>

                        <th> สถานะ</th>

                        <th> FIX </th>

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

                                ORDER BY a_id ASC");

                                

                                $stmt->execute();

                                $rows = $stmt->fetchAll();



                                if (!$rows) {

                                    echo "<tr><td colspan='8' class='text-center'>ไม่มีข้อมูลในระบบ</td></tr>";

                                } else {

                                    foreach ($rows as $row2) {

                            

                            ?>

                        <tr>

                            <td width="5%"><div align="center"><?= $row2['a_id'];?></td>

                            <td width="8%"><?= $row2['a_key'];?></td>

                            <td width="20%"><?= $row2['a_name'];?></td>

                            <td width="10%"><?= $row2['a_value'] ." / ". $row2['name'];?></td>

                            <td width="15%"><?=DBThaiShortDate($row2['dateCreate']);?></td>

                            <td width="8%"><div align="center">

                              <?php

                              if($row2['a_status'] =='1'){

                                echo "<span class='badge badge-success'>พร้อมใช้งาน</span>";

                              }

                              ?>

                            </td>

                            <td  width="5%">

                              <a href="" ><i class="fas fa-edit"></i></a>

                              <a href="?delete=<?= $row2['a_id']; ?>" class="delitem1-btn" data-id="<?= $row2['a_id'];?>"><i class="fas fa-trash"></i></a>

                            </td>

                        </tr>

                        <?php } } ?>

                    <tbody>

                    </tbody>

                  </table>

                </div>

              </div>

              <div class="card">

                <div class="card-header">

                  ครุภัณฑ์

                </div>

                <div class="card-body">

                  <table class="table table-bordered table-striped" >

                    <thead>

                      <tr class="text-center">

                        <th> #</th>

                        <th width="8%"> รหัสวัสดุ</th>

                        <th> ชื่อวัสดุ</th>

                        <th> จำนวนต่อหน่วย</th>

                        <th> เพิ่มเข้าระบบเมื่อ</th>

                        <th> สถานะ</th>

                        <th> FIX </th>

                      </tr>

                    </thead>



                      <?php

                                $stmt=$conn->query("SELECT

                                item_a.*,

                                unit.* 

                              FROM

                                item_a

                                INNER JOIN unit ON item_a.a_unit = unit.id 

                                AND item_a.a_type = '2' 

                                ORDER BY a_id ASC");

                                $stmt->execute();

                                $rows = $stmt->fetchAll();



                                if (!$rows) {

                                    echo "<tr><td colspan='8' class='text-center'>ไม่มีข้อมูลในระบบ</td></tr>";

                                } else {

                                    foreach ($rows as $row) {

                            

                            ?>

                        <tr>

                            <td width="5%"><div align="center"><?= $row['a_id'];?></td>

                            <td width="8%"><?= $row['a_key'];?></td>

                            <td width="20%"><?= $row['a_name'];?></td>

                            <td width="10%"><?= $row['a_value'] ." / ". $row['name'];?></td>

                            <td width="15%"><?=DBThaiShortDate($row['dateCreate']);?></td>

                            <td width="8%"><div align="center">

                              <?php

                              if($row['a_status'] =='1'){

                                echo "<span class='badge badge-success'>พร้อมใช้งาน</span>";

                              }

                              ?>

                            </td>

                            <td  width="5%">

                              <a href=""><i class="fas fa-edit"></i></a>

                              <a href="?delete2=<?= $row['a_id']; ?>" class="delitem2-btn" data-id="<?= $row['a_id'];?>"><i class="fas fa-trash"></i></a>

                            </td>

                        </tr>

                        <?php } } ?>

                    <tbody>

                    </tbody>

                  </table>

                </div>

              </div>

            </div> -->

        </div>

      </div>

    </section>

  </div>

  <?php include 'include/footer.php'; ?>

</div>

  <?php include 'include/footer_script.php'; ?>

</body>

</html>

