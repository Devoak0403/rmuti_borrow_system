<?php 

    session_start();
    require_once 'config/db.php';
    require_once 'class/date.php';
    $Date_Add = date('Y-m-d H:i:s');
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
<body class="hold-transition sidebar-fixed layout-navbar-fixed ">
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
          <div class="col-lg-10 mt-4">
            <h1 class="">ระบบเบิก-จ่ายวัสดุสิ้นเปลืองและครุภัณฑ์</h1>
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
                  <div class="card-header">
                    <h3 class="card-title">กรอกข้อมูลการยืม</h3>
                  </div>
                    <div class="card-body">
                        <form action="sql/insert_lent_item2.php" method="POST">
                                <input  class="form-control" type="text" name="u_id" value="<?=$row['u_id']?>" hidden>
                              <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">รหัสนักศึกษา</label>
                                <div class="col-sm-4">
                                <input type="text" class="form-control" name="u_code" value="<?=$row['u_code'];?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">ชื่อ </label>
                                <div class="col-sm-4">
                                <input type="text" class="form-control" name="firstname" value="<?=$row['firstname'];?>" readonly>
                                </div>
                                <label for="inputEmail3" class="col-sm-2 col-form-label">นามสกุล</label>
                                <div class="col-sm-4">
                                <input type="text" class="form-control" name="lastname" value="<?=$row['lastname'];?>" readonly>
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
                                <!-- <label for="inputEmail3" class="col-sm-2 col-form-label">วัสดุและครุภัณฑ์</label>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <select class="custom-select rounded-0" name="item_id" id="showtype">
                                      </select>
                                    </div>   
                                </div> -->
                                <label for="inputEmail3" class="col-sm-2 col-form-label">เบิก - จ่ายเมื่อ</label>
                                <div class="col-sm-4">
                                <input type="datetime-local" class="form-control"  name="lent_start" value="<?= $Date_Add;?>">
                                </div>
                                
                                  <span id="error"></span>
                                  <table class="table table-bordered" id="item_table">
                                    <tr>
                                      <th>เลือกวัสดุและครุภัณฑ์</th>
                                      <th>จำนวน</th>
                                      <th><button type="button" name="add" class="btn btn-outline-success btn-sm add"><i class="fas fa-plus"></i></button></th>
                                    </tr>
                                  </table>
                                  <!-- <div align="center">
                                    <input type="submit" name="submit" id="submit_button" class="btn btn-primary" value="Insert" />
                                  </div> -->
                                </div> 
                            <!-- <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">ระบบุจำนวน </label>
                                <div class="col-sm-4">
                                <input type="text" class="form-control" name="h_value">
                                </div>
                                <label for="inputEmail3" class="col-sm-2 col-form-label">เบิก - จ่ายเมื่อ</label>
                                <div class="col-sm-4">
                                <input type="datetime-local" class="form-control"  name="lent_start" value="<?= $Date_Add;?>">
                                </div>
                            </div> -->
                            
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
                              $checkvalue = $rowlist['a_value'];
                              $unitname = $rowlist['name'];
                              if($rowlist['a_value'] <= 0){
                                $status = "<span class='badge badge-danger  text-md'>หมด</span>";
                              }else{
                                $status = "<span class='badge badge-primary text-md'>$checkvalue "." $unitname</span>";
                              }
                    
                    ?>
                    <li class="nav-item">
                      <div class="nav-link">
                        <?= $rowlist['a_key'];?> : <?= $rowlist['a_name'];?> <span class="float-right text-md"><?= $status;?> </span>
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
                            foreach ($rows as $rowlist2) {
                              $checkvalue = $rowlist2['a_value'];
                              $unitname = $rowlist2['name'];
                              if($rowlist2['a_value'] <= 0){
                                $status = "<span class='badge badge-danger  text-md'>หมด</span>";
                              }else{
                                $status = "<span class='badge badge-primary text-md'>$checkvalue "." $unitname</span>";
                              }
                              
                    
                    ?>
                    <li class="nav-item">
                      <div class="nav-link">
                        <?= $rowlist2['a_key'];?> : <?= $rowlist2['a_name'];?> <span class="float-right text-md"><?= $status;?> </span>
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
  <?php include 'include_user/footer.php'; ?>
</div>
  <?php include 'include_user/footer_script.php'; ?>
  
  <?php include 'class/autoselect.php' ;?> 

  <?php include 'class/insertdata.php'; ?>

</body>
</html>
