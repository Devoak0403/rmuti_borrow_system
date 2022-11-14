

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



<?php   

session_start();

require_once '../config/db.php';

require_once '../class/date.php';



if(isset($_POST['submit'])){

    for($count = 0; $count < count($_POST["item_name"]); $count++)
	{
		
			array(
				 ':item_name'	=>	$_POST["item_name"][$count],
				 ':item_quantity'=>	$_POST["item_quantity"][$count],
                 
            );


    $u_name = $_POST['u_name'];

    $u_code = $_POST['u_code'];

    $u_id = $_POST['u_id'];

    $h_type = $_POST['h_type'];

    $h_value = $_POST["item_quantity"][$count];

    $item_id = $_POST["item_name"][$count];



    $status_id = '1';



    $strStartDate = $_POST['lent_start'];

    $strNewDate = date ("Y-m-d H:i:s", strtotime("+10 day", strtotime($strStartDate)));

    $datethai = DBThaiShortDate($strNewDate);



    $stmt1 = $conn->query("SELECT*, a_value,a_key FROM item_a WHERE a_key = '$item_id' LIMIT 1");

    $stmt1->execute();

    $rows = $stmt1->fetch(PDO::FETCH_ASSOC);

    $item_old = $rows['a_value'];

    $amount = ($item_old)-($h_value);

    $a_key = $rows['a_key'];

    // ----------14/10/22

    $datethail = DateTimeThai($strStartDate);
    $dateend = DateTimeThai($strNewDate);

    $stmtl = $conn->query("SELECT * FROM item_a INNER JOIN unit ON item_a.a_unit=unit.id INNER JOIN typelist ON item_a.a_type=typelist.t_id WHERE a_key = '$item_id'");

    $stmtl->execute();

    $rowl = $stmtl->fetch(PDO::FETCH_ASSOC);

    $stmtlu = $conn->query("SELECT * FROM users  WHERE u_id = '$u_id'");

    $stmtlu->execute();

    $rowlu = $stmtlu->fetch(PDO::FETCH_ASSOC);
    
    
// ------------------



    if($h_type == 1){

        if($item_old >= $h_value){

        $stmt2=$conn->prepare("INSERT INTO history(u_name,u_id,h_type,h_value,lent_start,status_id,item_id,u_code)VALUES(?,?,?,?,?,?,?,?)");

        $stmt2->bindParam(1, $u_name);

        $stmt2->bindParam(2, $u_id);

        $stmt2->bindParam(3, $h_type);

        $stmt2->bindParam(4, $h_value);

        $stmt2->bindParam(5, $strStartDate);

        $stmt2->bindParam(6, $status_id);

        $stmt2->bindParam(7, $item_id);

        $stmt2->bindParam(8, $u_code);

        $result2 = $stmt2->execute();



        $stmt3=$conn->prepare("UPDATE item_a SET a_key=:item_id,a_value='$amount' WHERE a_key=:item_id");

        $stmt3->bindParam(":item_id", $a_key);

        $stmt3->bindParam(":amount", $a_value);

        $result3 = $stmt3->execute();



            if($result2 && $result3){

                ini_set('display_errors', 1);
                ini_set('display_startup_errors', 1);
                error_reporting(E_ALL);
                date_default_timezone_set("Asia/Bangkok");

                $sToken = "ih5XivgJVCtrKi8Gfz5WLgq9o5grsClS3HQ8KaexjrD";
                $sMessage = "✍มีการเพิ่มข้อมูลการเบิก-จ่ายโดยผู้ดูแลระบบ " . " \n";
                $sMessage .= "ผู้ทำรายการ : " . $rowlu['firstname'] .' '.$rowlu['lastname']. " \n";
                $sMessage .= "ผู้ขอยืม : " . $u_name . " \n";
                $sMessage .= "วันที่ : " . $datethail . " \n";
                $sMessage .= "หมวด : " . $rowl['t_name'] . " \n";
                $sMessage .= "รายการที่เบิก : " . $rows['a_name'] . " \n";
                $sMessage .= "จำนวน : " . $h_value .' '.$rowl['name'];
                // $sticker_package_id = '446'; 
                // $sticker_id = '2004'; 


                $data  = array(
                    'message' => $sMessage
                    // 'stickerPackageId' => $sticker_package_id,
                    // 'stickerId' => $sticker_id
                );


                $chOne = curl_init(); 
                curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
                curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
                curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
                curl_setopt( $chOne, CURLOPT_POST, 1); 
                curl_setopt( $chOne, CURLOPT_POSTFIELDS, $data); 
                $headers = array( 'Content-type: multipart/form-data', 'Authorization: Bearer '.$sToken.'', );
                curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
                curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
                $result = curl_exec( $chOne );

                echo "<script>

                $(document).ready(function() {

                    Swal.fire({

                        title: 'สำเร็จ',

                        text: 'ข้อมูลบันทึกสำเร็จ',

                        icon: 'success',

                        timer: 6000,

                        showConfirmButton: false

                    });

                })

            </script>";

            header("refresh:2; url=../tb_lent_item1.php");

            }else{

                echo "<script>

                $(document).ready(function() {

                    Swal.fire({

                        title: 'ไม่สำเร็จ',

                        text: 'ข้อมูลบันทึกไม่สำเร็จ !',

                        icon: 'error',

                        timer: 5000,

                        showConfirmButton: false

                    });

                })

            </script>";

            header("refresh:2; url=../form_lent_mtl.php");

            }

        }else{

            echo "<script>

                $(document).ready(function() {

                    Swal.fire({

                        title: 'ไม่สำเร็จ',

                        text: 'จำนวนที่ยืมเกินจำนวนที่มี !',

                        icon: 'error',

                        timer: 5000,

                        showConfirmButton: false

                    });

                })

            </script>";

            header("refresh:2; url=../form_lent_mtl.php");

        }



    }

    else{



        if($item_old < $h_value){

                echo "<script>

                $(document).ready(function() {

                    Swal.fire({

                        title: 'เกิดข้อผิดพลาด',

                        text: 'จำนวนที่ยืมมากกว่าจำนวนที่มีอยู่ จำนวนคงเหลืออยุ่ที่ : $item_old ',

                        icon: 'error',

                        timer: 5000,

                        showConfirmButton: false

                    });

                })

                </script>";

                header("refresh:4; url=../form_lent_mtl.php");

        }
        else{

            $stmt4=$conn->prepare("INSERT INTO history(u_name,u_id,h_type,h_value,lent_start,lent_end,status_id,item_id,u_code)VALUES(?,?,?,?,?,?,?,?,?)");

            $stmt4->bindParam(1, $u_name);

            $stmt4->bindParam(2, $u_id);

            $stmt4->bindParam(3, $h_type);

            $stmt4->bindParam(4, $h_value);

            $stmt4->bindParam(5, $strStartDate);

            $stmt4->bindParam(6, $strNewDate);

            $stmt4->bindParam(7, $status_id);

            $stmt4->bindParam(8, $item_id);

            $stmt4->bindParam(9, $u_code);

            $result4 = $stmt4->execute();

        

            $stmt5=$conn->prepare("UPDATE item_a SET a_key=:item_id,a_value='$amount' WHERE a_key=:item_id");

            $stmt5->bindParam(":item_id", $a_key);

            $stmt5->bindParam(":amount", $a_value);

            $result5 = $stmt5->execute();

        

            if ($result4 && $result5) {

                ini_set('display_errors', 1);
                ini_set('display_startup_errors', 1);
                error_reporting(E_ALL);
                date_default_timezone_set("Asia/Bangkok");

                $sToken = "ih5XivgJVCtrKi8Gfz5WLgq9o5grsClS3HQ8KaexjrD";
                $sMessage = "✍มีการเพิ่มข้อมูลการเบิก-จ่ายโดยผู้ดูแลระบบ " . " \n";
                $sMessage .= "ผู้ทำรายการ : " . $rowlu['firstname'] .' '.$rowlu['lastname']. " \n";
                $sMessage .= "ผู้ขอยืม : " . $u_name . " \n";
                $sMessage .= "วันที่ : " . $datethail . " \n";
                $sMessage .= "หมวด : " . $rowl['t_name'] . " \n";
                $sMessage .= "รายการที่เบิก : " . $rows['a_name'] . " \n";
                $sMessage .= "จำนวน : " . $h_value .' '.$rowl['name']."\n";
                $sMessage .= "ครบกำหนดวันที่ : " . $dateend . " \n";
                // $sticker_package_id = '446'; 
                // $sticker_id = '2004'; 


                $data  = array(
                    'message' => $sMessage
                    // 'stickerPackageId' => $sticker_package_id,
                    // 'stickerId' => $sticker_id
                );


                $chOne = curl_init(); 
                curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
                curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
                curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
                curl_setopt( $chOne, CURLOPT_POST, 1); 
                curl_setopt( $chOne, CURLOPT_POSTFIELDS, $data); 
                $headers = array( 'Content-type: multipart/form-data', 'Authorization: Bearer '.$sToken.'', );
                curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
                curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
                $result = curl_exec( $chOne );

                echo "<script>

                    $(document).ready(function() {

                        Swal.fire({

                            title: 'บันทึกข้อมูลการยืมสำเร็จ',

                            text: 'กำหนดคืน : $datethai',

                            icon: 'success',

                            timer: 6000,

                            showConfirmButton: false

                        });

                    })

                </script>";

                header("refresh:4; url=../tb_lent_item2.php");

            } else {

                echo "<script>

                    $(document).ready(function() {

                        Swal.fire({

                            title: 'ไม่สำเร็จ',

                            text: 'ข้อมูลบันทึกไม่สำเร็จ !',

                            icon: 'error',

                            timer: 5000,

                            showConfirmButton: false

                        });

                    })

                </script>";

                header("refresh:2; url=../form_lent_krp.php");

            }

        }



    }

    }

}



?>