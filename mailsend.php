<?php


    $servername = "localhost";
    $username = "id19560374_admin";
    $password = "}gKqjRl}nUXU#jG1";
    $dbname = "id19560374_db_eq";
     $conn = new mysqli($servername, $username, $password, $dbname);
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }

      $sql = "SELECT
            h_id,
            typelist.t_name,
            item_a.a_name,
            h_value,
            unit.name,
            users.firstname,
            users.lastname,
            users.email,
            history.lent_start,
            history.lent_end 
            FROM
            history
            INNER JOIN users ON history.u_id = users.u_id
            INNER JOIN typelist ON history.h_type = typelist.t_id
            INNER JOIN item_a ON history.item_id = item_a.a_key
            INNER JOIN unit ON item_a.a_unit = unit.id 
            WHERE
            typelist.t_id = 2;";
            $result = $conn->query($sql);

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

      require 'phpmailer/src/Exception.php';
      require 'phpmailer/src/PHPMailer.php';
      require 'phpmailer/src/SMTP.php';

      while($row = mysqli_fetch_array($result)){
          date_default_timezone_set('Asia/Bangkok');
          $nt = time();   // มันจะดึงเวลาปัจุบันมาเอง
          $ct = strtotime($row['lent_end']);  // ใส่เวลาที่คุณต้องการ อาจจะมาจากดาต้าเบสก็ได้ดึงค่ามาใส่
          $distance = $ct-$nt; //หักลบวันเพื่อใช้คำนวณ
          $days = floor($distance / (60 * 60 * 24));
          $hours = floor(($distance % (60 * 60 * 24)) / (60 * 60));
          $minutes = floor($distance % (60 * 60)/60);
          $seconds = floor($distance % 60);
          $name = $row['firstname']. ' ' .$row['lastname'];
          $email = $row['email'];
          $originalDatestart = $row['lent_start'];$datestart = date('d-m-Y', strtotime($originalDatestart));
          $originalDateend = $row['lent_end'];$dateend = date('d-m-Y', strtotime($originalDateend));
          $hvalue = $row['h_value'];
          $itname = $row['a_name'];
          $unit = $row['name'];
      
            if($days == 3 or $days == -1 ){
                                            
              $mail = new PHPMailer(true);
              $mail->isSMTP();
              $mail->CharSet = "utf-8";
              $mail->Host = 'smtp.gmail.com';
              $mail->SMTPAuth = true;
              $mail->Username = 'logisticsrmuti22@gmail.com'; // 
              $mail->Password = 'hfkapfcqbqxqwgie'; // hfkapfcqbqxqwgie 
              $mail->SMTPSecure = 'ssl';
              $mail->Port = 465;
              $mail->setFrom('logisticsrmuti22@gmail.com'); // Your gmail
              // $mail->addAddress("oar.sumate@gmail.com");
              $mail->addAddress($row['email']);
              $mail->isHTML(true);
              $mail->Subject = "แจ้งกำหนดเวลาการคืนวัสดุสิ้นเปลืองและครุภัณฑ์";
              // $body = '';
              $mail->Body = "
              <!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
              <html>
              <head>
                  <meta http-equiv='Content-type' content='text/html; charset=utf-8' />
                  <title>Custom Fonts in HTML Emails</title>
                  <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'/>
                  <link href='https://fonts.googleapis.com/css?family=Heebo' rel='stylesheet'>
              
              
              <style type='text/css'>
              html {
                font-family: sans-serif;
                line-height: 1.15;
                -webkit-text-size-adjust: 100%;
                -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
              }
              
              article, aside, figcaption, figure, footer, header, hgroup, main, nav, section {
                display: block;
              }
              
              body {
                margin: 0;
                font-family:' sans-serif;
                font-size: 1rem;
                color: #000;
                line-height: 1.5;
                color: #212529;
                text-align: left;
                background-color: #fff;
              }
              
              
              h1, h2, h3, h4, h5, h6 {
                margin-top: 0;
                margin-bottom: 0.5rem;
              }
              
              p {
                margin-top: 0;
                margin-bottom: 1rem;
              }
              </style>
              </head>
              <body style='background-color:#F6F6F6;margin-top:100px;'>
                <table align='center' border='0' cellpadding='0' cellspacing='0'
                  width='550' bgcolor='white' >
                  <tbody>
                    <tr>
                      <td align='center'>
                        <table align='center' border='0' cellpadding='0'
                          cellspacing='0' class='col-550' width='550'>
                          <tbody>
                            <tr>
                              <td align='center' style='background-color: ##ffa73b;
                                  height: 150px;'>
                                  <img src='https://blm.fbi.rmuti.ac.th/wp-content/uploads/2021/09/banner_1-300x75.png' alt='Girl in a jacket' width='350' height='90'>
                                
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </td>
                    </tr>
              
                    <tr style='display: inline-block;'>
                      <td style='height: 150px;
                          padding: 20px;
                          border: none;
                          
                          background-color: white;'>
                        
                        <h2 style='text-align: left;
                            align-items: center;'>
                          แจ้งเตือนการยืมครุภัณฑ์
                      </h2>
                        <p class='data'
                        style='text-align: justify-all;
                            align-items: center;
                            font-size: 15px;
                            margin-left:50px;
                            padding-left:20px;'>
                          
                            <p style='padding-left:25px;'>- - - - - &nbsp;&nbsp; ชื่อผู้ยืม : ".$name." &nbsp;&nbsp; - - - - -</p>
                            <p style='padding-left:25px;'>- - - - - &nbsp;&nbsp; ชื่อครุภัณฑ์ : ".$itname." &nbsp;&nbsp; - - - - -</p>
                            <p style='padding-left:25px;'>- - - - - &nbsp;&nbsp; จำนวนที่ยืม : ".$hvalue." / ".$unit." &nbsp;&nbsp; - - - - -</p>
                            <p style='padding-left:25px;'>- - - - - &nbsp;&nbsp; วันที่ยืม : ".$datestart." &nbsp;&nbsp; - - - - -</p>
                            <p style='color:#fff;background-color:#782920;padding:10px;border-radius:10px;'>กำหนดคืนวันที่ : ".$dateend." </p>
              
                        </p>
                        <p>
                          
                        </p>
                      </td>
                    </tr>
                    <tr style='border: none;
                    background-color: #ffa73b;
                    color:#000;
                    height: 40px;
                    padding-bottom: 20px;
                    text-align: center;'>
                    <td height='40px' align='center'>
                      <p style='color:#000;
                      padding-top:10px;
                      line-height: 1.5em;'>
                      ระบบเบิก-จ่ายครุภัณฑ์ สาขาวิชาเทคโนโลยีโลจิสติกส์ <br>
                      มหาวิทยาลัยเทคโนโลยีราชมงคลอีสาน
                      </p>
                    </td>
                    </tr>
                    <tr>
                  </tbody>
                </table>
              </body>
              </html>";
    $mail->send();
    echo "Sent Successfully";
  }  
}
?>
