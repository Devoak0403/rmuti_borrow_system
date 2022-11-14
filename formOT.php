<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <title>Basic Mutitple Insert PHP PDO by devbanban.com 2021</title>
  </head>
  <body>
    <div class="container">
      <div class="row">
         <div class="col-sm-1"></div>
        <div class="col-sm-11"> <br>
          <h4>
          PHP PDO : Multiple Insert Rows <br>
        ฟอร์มเพิ่มข้อมูลโอที *ไม่เกินวันละ 5 ชม.</h4>
          <form action="" method="post">


            <div class="row g-3 align-items-center mb-3">
              <div class="col-sm-1">
                <label  class="col-form-label">วันที่</label>
              </div>
              <div class="col-sm-4">
                <input type="date" name="workDate" class="form-control" required>
              </div>
              <div class="col-sm-1">
                <label  class="col-form-label">ชม.</label>
              </div>
            </div>


            <div class="row g-3 align-items-center mb-3">
              <div class="col-sm-1">
                <label  class="col-form-label">รหัสพนง.</label>
              </div>
              <div class="col-sm-1">
                <input type="number"  class="form-control" value="1" readonly>
              </div>
              <div class="col-sm-4">
                <input type="text"  class="form-control" value="นายเอ ทดสอบระบบ" readonly>
              </div>
              <div class="col-sm-1">
                <label  class="col-form-label">ชั่วโมง</label>
              </div>
              <div class="col-sm-1">
                <input name="empid[1]" type="number"  class="form-control"  min="1" max="5" required>
              </div>
              <div class="col-sm-1">
                <label  class="col-form-label">ชม.</label>
              </div>
            </div>

            <div class="row g-3 align-items-center mb-3">
              <div class="col-sm-1">
                <label  class="col-form-label">รหัสพนง.</label>
              </div>
              <div class="col-sm-1">
                <input type="number"  class="form-control" value="2" readonly>
              </div>
              <div class="col-sm-4">
                <input type="text"  class="form-control" value="นายบี ทดสอบระบบ" readonly>
              </div>
              <div class="col-sm-1">
                <label  class="col-form-label">ชั่วโมง</label>
              </div>
              <div class="col-sm-1">
                <input name="empid[2]" type="number"  class="form-control" min="1" max="5" required>
              </div>
              <div class="col-sm-1">
                <label  class="col-form-label">ชม.</label>
              </div>
            </div>
            <div class="row g-3 align-items-center mb-3">
              <div class="col-sm-1">
                <label  class="col-form-label">รหัสพนง.</label>
              </div>
              <div class="col-sm-1">
                <input type="number"  class="form-control" value="3" readonly>
              </div>
              <div class="col-sm-4">
                <input type="text"  class="form-control" value="นายซี ทดสอบระบบ" readonly>
              </div>
              <div class="col-sm-1">
                <label  class="col-form-label">ชั่วโมง</label>
              </div>
              <div class="col-sm-1">
                <input name="empid[3]" type="number"  class="form-control" min="1" max="5" required>
              </div>
              <div class="col-sm-1">
                <label  class="col-form-label">ชม.</label>
              </div>
            </div>
            
            <div class="row g-3 align-items-center mb-3">
              <div class="col-sm-1"> </div>
              <div class="col-sm-4">
                <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>


    <?php

  // echo '<pre>';
  // print_r($_POST); //ตรวจสอบมี input อะไรบ้าง และส่งอะไรมาบ้าง 
  // echo '</pre>';
    //exit();
 //ถ้ามีค่าส่งมาจากฟอร์ม
    if(isset($_POST['empid']) && isset($_POST['workDate']) ){


    // sweet alert 
    echo '
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

    //ไฟล์เชื่อมต่อฐานข้อมูล
    require_once 'connect.php';
    //ประกาศตัวแปรรับค่าจากฟอร์ม
    $workDate = $_POST['workDate'];
    
    //check duplicate
      $stmt = $conn->prepare("SELECT no FROM tbl_ot WHERE workDate = :workDate");
      $stmt->execute(array(':workDate' => $workDate));
      //ถ้าบันทึกซ้ำจากวันที่ โดนดีดออกไปหน้าฟอร์ม
      if($stmt->rowCount() > 0){
          echo '<script>
                       setTimeout(function() {
                        swal({
                            title: "บันทึกข้อมูลซ้ำ !! ",  
                            type: "warning"
                        }, function() {
                            window.location = "formAddOT.php"; //หน้าที่ต้องการให้กระโดดไป
                        });
                      }, 1000);
                </script>';
      }else{ //ไม่ซ้ำ เก็บข้อมูลลงตาราง

                  //sql insert
                  $stmt = $conn->prepare("INSERT INTO tbl_ot 
                    (empID, workHrs, workDate)
                    VALUES 
                    (:empID, :workHrs, :workDate)");

                  //แยก key & value ด้วย foreach
                foreach ($_POST['empid'] as $empID => $workHrs) {
                  $stmt->bindParam(':empID', $empID , PDO::PARAM_INT);
                  $stmt->bindParam(':workHrs', $workHrs , PDO::PARAM_INT);
                  $stmt->bindParam(':workDate', $workDate, PDO::PARAM_STR);
                  $result = $stmt->execute();


                //Dumps the information contained by a prepared statement directly on the output แปลเป็นชาวบ้านๆ คือ แสดง sql statment 
                  
                echo 'debugDumpParams <br>';  
                echo '<hr>';  
                $stmt->debugDumpParams();
               echo '</pre>';


                } //foreach



                  $conn = null; //close connect db

                   


                 exit();

                  if($result){
                      echo '<script>
                           setTimeout(function() {
                            swal({
                                title: "บันทึกข้อมูลสำเร็จ",
                                type: "success"
                            }, function() {
                                window.location = "formAddOT.php"; //หน้าที่ต้องการให้กระโดดไป
                            });
                          }, 1000);
                      </script>';
                  }else{
                     echo '<script>
                           setTimeout(function() {
                            swal({
                                title: "เกิดข้อผิดพลาด",
                                type: "error"
                            }, function() {
                                window.location = "formAddOT.php"; //หน้าที่ต้องการให้กระโดดไป
                            });
                          }, 1000);
                      </script>';
                  } //else result
                 
              
        } //else chk dup
    } //isset 
    //devbanban.com
    ?>