<?php 



    session_start();

    require_once 'config/db.php';

    require_once 'class/date.php';

    $Date_Add = date('Y-m-d H:i:s');

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

    <img class="animation__shake" src="dist/img/CLOCK_LT.png" alt="CLOCK_LT.png" height="60" width="60">

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

            <h1 class="m-0">ฟอร์มกรอกข้อมูลการยืม</h1>

          </div><!-- /.col -->

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="index_admin.php">หน้าหลัก</a></li>

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

                        <form action="sql/insert_lent_item1.php" method="POST">

                                <input  class="form-control" type="text" name="u_id" value="<?=$row['u_id']?>" hidden>

                            <div class="form-group row">

                                <label for="inputEmail3" class="col-sm-2 col-form-label">ชื่อ - นามสกุล</label>

                                <div class="col-sm-4">

                                <input type="text" class="form-control" name="u_name">

                                </div>

                                <label for="inputEmail3" class="col-sm-2 col-form-label">รหัสนักศึกษา</label>

                                <div class="col-sm-4">

                                <input type="text" class="form-control" name="u_code">

                                </div>

                            </div>

                            <div class="form-group row">

                                <label for="inputEmail3" class="col-sm-2 col-form-label">เลือกหมวด</label>

                                <div class="col-sm-4">

                                    <div class="form-group">

                                        <select class="custom-select rounded-0" name="h_type" id="selecttype">

                                          <option>--- เลือกหมวด ---</option>

                                        <?php

                                          $stmt = $conn->query("SELECT * FROM typelist");

                                          $stmt->execute();

                                          $rows = $stmt->fetchAll();

                                          foreach ($rows as $row) {

                                        ?>

                                        <option value="<?=$row['t_id'];?>"><?=$row['t_name'];?></option>

                                            <?php } ?>

                                      </select>

                                    </div>   

                                </div>

                                <label for="inputEmail3" class="col-sm-2 col-form-label">วัสดุและครุภัณฑ์</label>

                                <div class="col-sm-4">

                                    <div class="form-group">

                                        <select class="custom-select rounded-0" name="item_id" id="showtype">

                                      </select>

                                    </div>   

                                </div>

                            </div>

                            <div class="form-group row">

                                <label for="inputEmail3" class="col-sm-2 col-form-label">ระบบุจำนวน </label>

                                <div class="col-sm-4">

                                <input type="text" class="form-control" name="h_value">

                                </div>

                                <label for="inputEmail3" class="col-sm-2 col-form-label">เบิก - จ่ายเมื่อ</label>

                                <div class="col-sm-4">

                                <input type="datetime-local" class="form-control"  name="lent_start" value="<?= $Date_Add;?>">

                                </div>

                            </div>

                            <div class="form-group row">

                                <label for="inputEmail3" class="col-sm-2 col-form-label">ระบบุจำนวนวัน </label>

                                <div class="col-sm-4">

                                <input type="text" class="form-control" name="num_lent" placeholder="ระบุจำนวนวันที่ให้ยืม">

                                <small id="emailHelp" class="form-text text-muted">ใส่เป็นเลข เช่น 5 , 10 , 20 , 30</small> 

                                </div>

                            </div>

                           

                            

                            <div class="form-group justify-content-end  mt-4">

                                <div class="col-4">

                                  <button name="submit" type="submit" id="btnadditem" class="btn btn-outline-primary ">ตกลง</button>

                                  <button type="reset" id="btnreitem" class="btn btn-outline-danger ">ยกเลิก</button>

                                </div>

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

          <div class="row">

            <div class="col-md-4">

              <div class="card card-widget widget-user-2">

                <div class="widget-user-header bg-info">

                  <h4>วัสดุสิ้นเปลือง จำนวนคงเหลือ</h4>

                </div>

                <div class="card-footer p-0">

                  <ul class="nav flex-column text-dark">

                  <?php

                        $stmt=$conn->query("SELECT * FROM item_a,unit WHERE item_a.a_unit = unit.id AND item_a.a_type = 1 ORDER BY a_key ASC");

                        $stmt->execute();

                        $rows = $stmt->fetchAll();



                        if (!$rows) {

                            echo "<tr><td colspan='8' class='text-center'>ไม่มีข้อมูลในระบบ</td></tr>";

                        } else {

                            foreach ($rows as $rowlist) {

                    

                    ?>

                    <li class="nav-item">

                      <div class="nav-link">

                        <?= $rowlist['a_key'];?> : <?= $rowlist['a_name'];?> <span class="float-right badge bg-primary text-md"><?= $rowlist['a_value'];?> <?= $rowlist['name'];?></span>

                      </div>

                    </li>

                    <?php } } ?>

                  </ul>

                </div>

              </div>

            </div>

            <div class="col-md-4">

              <div class="card card-widget widget-user-2">

                <div class="widget-user-header bg-success">

                  <h4>ครุภัณฑ์ จำนวนคงเหลือ</h4>

                </div>

                <div class="card-footer p-0">

                  <ul class="nav flex-column text-dark">

                  <?php

                        $stmt=$conn->query("SELECT * FROM item_a,unit WHERE item_a.a_unit = unit.id AND item_a.a_type = 2 ORDER BY a_key ASC");

                        $stmt->execute();

                        $rows = $stmt->fetchAll();



                        if (!$rows) {

                            echo "<tr><td colspan='8' class='text-center'>ไม่มีข้อมูลในระบบ</td></tr>";

                        } else {

                            foreach ($rows as $rowlist) {

                    

                    ?>

                    <li class="nav-item">

                      <div class="nav-link">

                        <?= $rowlist['a_key'];?> : <?= $rowlist['a_name'];?> <span class="float-right badge bg-primary text-md"><?= $rowlist['a_value'];?> <?= $rowlist['name'];?></span>

                      </div>

                    </li>

                    <?php } } ?>

                  </ul>

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

