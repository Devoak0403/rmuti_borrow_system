<?php


      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "db_eq";

      // Create connection
      $conn = new mysqli($servername, $username, $password, $dbname);
      // Check connection
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
      $row = $result->fetch_assoc();
      $name = $row['firstname']. ' ' .$row['lastname'];
      $email = $row['email'];
      $originalDatestart = $row['lent_start'];$datestart = date('d-m-Y', strtotime($originalDatestart));
      $originalDateend = $row['lent_end'];$dateend = date('d-m-Y', strtotime($originalDateend));
      $hvalue = $row['h_value'];
      $itname = $row['a_name'];
      $unit = $row['name'];
?>


    
<?php $page = "'
<!DOCTYPE HTML PUBLIC '-//W3C//DTD XHTML 1.0 Transitional //EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml' xmlns:v='urn:schemas-microsoft-com:vml' xmlns:o='urn:schemas-microsoft-com:office:office'>
<head>
<a ></a>
  <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <meta name='x-apple-disable-message-reformatting'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <title></title>
  
  <link href='page.php' rel='stylesheet' type='text/css'>

</head>

<body>
  
  <table style='border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;min-width: 320px;Margin: 0 auto;background-color: #ffffff;width:100%' cellpadding='0' cellspacing='0'>
  <tbody>
  <tr style='vertical-align: top'>
    <td style='word-break: break-word;border-collapse: collapse !important;vertical-align: top'>
    
    

<div class='u-row-container' style='padding: 0px;background-color: #ffa73b'>
  <div class='u-row' style='Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;'>
    <div style='border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;'>
     
      

  <div style='height: 100%;width: 100% !important;'>
  <div style='height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;'>
  
<table style='font-family:'Montserrat',sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
  <tbody>
    <tr>
      <td class='v-container-padding-padding' style='overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:'Montserrat',sans-serif;' align='left'>
        
  <table height='0px' align='center' border='0' cellpadding='0' cellspacing='0' width='100%' style='border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 0px solid #BBBBBB;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%'>
    <tbody>
      <tr style='vertical-align: top'>
        <td style='word-break: break-word;border-collapse: collapse !important;vertical-align: top;font-size: 0px;line-height: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%'>
          <span>&#160;</span>
        </td>
      </tr>
    </tbody>
  </table>

      </td>
    </tr>
  </tbody>
</table>

<table style='font-family:'Montserrat',sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
  <tbody>
    <tr>
      <td class='v-container-padding-padding' style='overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:'Montserrat',sans-serif;' align='left'>
        
  <table height='0px' align='center' border='0' cellpadding='0' cellspacing='0' width='100%' style='border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 0px solid #BBBBBB;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%'>
    <tbody>
      <tr style='vertical-align: top'>
        <td style='word-break: break-word;border-collapse: collapse !important;vertical-align: top;font-size: 0px;line-height: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%'>
          <span>&#160;</span>
        </td>
      </tr>
    </tbody>
  </table>

      </td>
    </tr>
  </tbody>
</table>

<table style='font-family:'Montserrat',sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
  <tbody>
    <tr>
      <td class='v-container-padding-padding' style='overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:'Montserrat',sans-serif;' align='left'>
        
  <table height='0px' align='center' border='0' cellpadding='0' cellspacing='0' width='100%' style='border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 0px solid #BBBBBB;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%'>
    <tbody>
      <tr style='vertical-align: top'>
        <td style='word-break: break-word;border-collapse: collapse !important;vertical-align: top;font-size: 0px;line-height: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%'>
          <span>&#160;</span>
        </td>
      </tr>
    </tbody>
  </table>

      </td>
    </tr>
  </tbody>
</table>

<table style='font-family:'Montserrat',sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
  <tbody>
    <tr>
      <td class='v-container-padding-padding' style='overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:'Montserrat',sans-serif;' align='left'>
        
  <table height='0px' align='center' border='0' cellpadding='0' cellspacing='0' width='100%' style='border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 0px solid #BBBBBB;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%'>
    <tbody>
      <tr style='vertical-align: top'>
        <td style='word-break: break-word;border-collapse: collapse !important;vertical-align: top;font-size: 0px;line-height: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%'>
          <span>&#160;</span>
        </td>
      </tr>
    </tbody>
  </table>

      </td>
    </tr>
  </tbody>
</table>

<table style='font-family:'Montserrat',sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
  <tbody>
    <tr>
      <td class='v-container-padding-padding' style='overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:'Montserrat',sans-serif;' align='left'>
        
  <table height='0px' align='center' border='0' cellpadding='0' cellspacing='0' width='100%' style='border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 0px solid #BBBBBB;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%'>
    <tbody>
      <tr style='vertical-align: top'>
        <td style='word-break: break-word;border-collapse: collapse !important;vertical-align: top;font-size: 0px;line-height: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%'>
          <span>&#160;</span>
        </td>
      </tr>
    </tbody>
  </table>

      </td>
    </tr>
  </tbody>
</table>

<table style='font-family:'Montserrat',sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
  <tbody>
    <tr>
      <td class='v-container-padding-padding' style='overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:'Montserrat',sans-serif;' align='left'>
        
  <table height='0px' align='center' border='0' cellpadding='0' cellspacing='0' width='100%' style='border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 0px solid #BBBBBB;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%'>
    <tbody>
      <tr style='vertical-align: top'>
        <td style='word-break: break-word;border-collapse: collapse !important;vertical-align: top;font-size: 0px;line-height: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%'>
          <span>&#160;</span>
        </td>
      </tr>
    </tbody>
  </table>

      </td>
    </tr>
  </tbody>
</table>

 </div>
  </div>
</div>

      
    </div>
  </div>
</div>



<div class='u-row-container' style='padding: 0px;background-color: #ffa73b'>
  <div class='u-row' style='Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ffffff;'>
    <div style='border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;'>
      
      

<div class='u-col u-col-100' style='max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;'>
  <div style='background-color: #ffffff;height: 100%;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;'>
  <div style='height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;'>
  
<table style='font-family:'Montserrat',sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
  <tbody>
    <tr>
      <td class='v-container-padding-padding' style='overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:'Montserrat',sans-serif;' align='left'>
      <div style='color: #666666; line-height: 140%; text-align: left; word-wrap: break-word;'>
      <img src='https://blm.fbi.rmuti.ac.th/wp-content/uploads/2021/09/banner_1-300x75.png' alt='Girl in a jacket' width='350' height='90'>
      </div>    
  <div style='color: #666666; line-height: 140%; text-align: left; word-wrap: break-word;'>
    <p style='font-size: 14px; line-height: 140%;'><span style='font-size: 24px; line-height: 33.6px; font-family: Lato, sans-serif;'>ระบบเบิก-จ่ายวัสดุสิ้นเปลืองและครุภัณฑ์ในสาขาวิชาเทคโนโลยีโลจิสติกส์</span><br /></p>
  </div>

      </td>
    </tr>
  </tbody>
</table>

  
  </div>
</div>

    </div>
  </div>
</div>



<div class='u-row-container' style='padding: 0px;background-color: #f6f6f6'>
  <div class='u-row' style='Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;'>
    <div style='border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;'>
      
      

<div class='u-col u-col-100' style='max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;'>
  <div style='background-color: #ffffff;height: 100%;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;'>
  <div style='height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;'>
  
<table id='u_content_heading_1' style='font-family:'Montserrat',sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
  <tbody>
    <tr>
      <td class='v-container-padding-padding' style='overflow-wrap:break-word;word-break:break-word;padding:80px 10px 0px;font-family:'Montserrat',sans-serif;' align='left'>
        
  <h2 class='v-font-size' style='margin: 0px; color: #666666; line-height: 140%; text-align: center; word-wrap: break-word; font-weight: normal; font-family: 'Open Sans',sans-serif; font-size: 20px;'>
    แจ้งเตือนกำหนดการคืนครุภัณฑ์
  </h2>

      </td>
    </tr>
  </tbody>
</table>

<table style='font-family:'Montserrat',sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
  <tbody>
    <tr>
      <td class='v-container-padding-padding' style='overflow-wrap:break-word;word-break:break-word;padding:0px 10px 10px;font-family:'Montserrat',sans-serif;' align='left'>
        
  <div style='color: #666666; line-height: 140%; text-align: center; word-wrap: break-word;'>
    <p style='font-size: 14px; line-height: 140%; text-align: left;'><span style='font-size: 18px; line-height: 25.2px; font-family: Lato, sans-serif;'>เรียนคุณ: $name</span></p>
  </div>

      </td>
    </tr>
  </tbody>
</table>

<table id='u_content_text_15' style='font-family:'Montserrat',sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
  <tbody>
    <tr>
      <td class='v-container-padding-padding' style='overflow-wrap:break-word;word-break:break-word;padding:0px 60px 20px;font-family:'Montserrat',sans-serif;' align='left'>
        
  <div style='color: #666666; line-height: 140%; text-align: left; word-wrap: break-word;'>
    <p style='font-size: 14px; line-height: 140%;'><span style='font-size: 18px; line-height: 25.2px; font-family: Lato, sans-serif;'>รายการยืมของคุณ</span></p>
  </div>

      </td>
    </tr>
  </tbody>
</table>

<table id='u_content_text_15' style='font-family:'Montserrat',sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
  <tbody>
    <tr>
      <td class='v-container-padding-padding' style='overflow-wrap:break-word;word-break:break-word;padding:0px 60px 20px;font-family:'Montserrat',sans-serif;' align='left'>
        
  <div style='color: #666666; line-height: 140%; text-align: left; word-wrap: break-word;'>
    <p style='font-size: 14px; line-height: 140%;'><span style='font-size: 18px; line-height: 25.2px; font-family: Lato, sans-serif;'>- $itname &nbsp;&nbsp; จำนวน $hvalue $unit</span></p>
  </div>

      </td>
    </tr>
  </tbody>
</table>

<table style='font-family:'Montserrat',sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
  <tbody>
    <tr>
      <td class='v-container-padding-padding' style='overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:'Montserrat',sans-serif;' align='left'>
        
  <table height='0px' align='center' border='0' cellpadding='0' cellspacing='0' width='100%' style='border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 0px solid #BBBBBB;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%'>
    <tbody>
      <tr style='vertical-align: top'>
        <td style='word-break: break-word;border-collapse: collapse !important;vertical-align: top;font-size: 0px;line-height: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%'>
          <span>&#160;</span>
        </td>
      </tr>
    </tbody>
  </table>

      </td>
    </tr>
  </tbody>
</table>

<table style='font-family:'Montserrat',sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
  <tbody>
    <tr>
      <td class='v-container-padding-padding' style='overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:'Montserrat',sans-serif;' align='left'>
        
  <table height='0px' align='center' border='0' cellpadding='0' cellspacing='0' width='100%' style='border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 0px solid #BBBBBB;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%'>
    <tbody>
      <tr style='vertical-align: top'>
        <td style='word-break: break-word;border-collapse: collapse !important;vertical-align: top;font-size: 0px;line-height: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%'>
          <span>&#160;</span>
        </td>
      </tr>
    </tbody>
  </table>

      </td>
    </tr>
  </tbody>
</table>

<table id='u_content_text_15' style='font-family:'Montserrat',sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
  <tbody>
    <tr>
      <td class='v-container-padding-padding' style='overflow-wrap:break-word;word-break:break-word;padding:0px 60px 20px;font-family:'Montserrat',sans-serif;' align='left'>
        
  <div style='color: #666666; line-height: 140%; text-align: left; word-wrap: break-word;'>
    <p style='font-size: 14px; line-height: 140%;'><span style='font-size: 18px; line-height: 25.2px; font-family: Lato, sans-serif;'>ท่านมีการยืมครุภัณฑ์ไปในวันที่</span></p>
  </div>

      </td>
    </tr>
  </tbody>
</table>

<table id='u_content_text_16' style='font-family:'Montserrat',sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
  <tbody>
    <tr>
      <td class='v-container-padding-padding' style='overflow-wrap:break-word;word-break:break-word;padding:0px 60px 20px;font-family:'Montserrat',sans-serif;' align='left'>
        
  <div style='color: #ffa73b; line-height: 140%; text-align: left; word-wrap: break-word;'>
    <p style='font-size: 14px; line-height: 140%;'><span style='font-size: 16px; line-height: 22.4px; font-family: Lato, sans-serif;'><strong>$datestart</strong></span></p>
  </div>

      </td>
    </tr>
  </tbody>
</table>

<table id='u_content_text_17' style='font-family:'Montserrat',sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
  <tbody>
    <tr>
      <td class='v-container-padding-padding' style='overflow-wrap:break-word;word-break:break-word;padding:0px 60px 20px;font-family:'Montserrat',sans-serif;' align='left'>
        
  <div style='color: #666666; line-height: 140%; text-align: left; word-wrap: break-word;'>
    <p style='font-size: 14px; line-height: 140%;'><span style='font-size: 18px; line-height: 25.2px; font-family: Lato, sans-serif;'>ท่านมีกำหนดในการคืนครุภัณฑ์ในวันที่</span></p>
  </div>

      </td>
    </tr>
  </tbody>
</table>

<table id='u_content_text_14' style='font-family:'Montserrat',sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
  <tbody>
    <tr>
      <td class='v-container-padding-padding' style='overflow-wrap:break-word;word-break:break-word;padding:0px 60px 20px;font-family:'Montserrat',sans-serif;' align='left'>
        
  <div style='color: #ffa73b; line-height: 140%; text-align: left; word-wrap: break-word;'>
    <p style='font-size: 14px; line-height: 140%;'><span style='font-size: 16px; line-height: 22.4px; font-family: Lato, sans-serif;'><strong>$dateend</strong></span></p>
  </div>

      </td>
    </tr>
  </tbody>
</table>

<table id='u_content_text_13' style='font-family:'Montserrat',sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
  <tbody>
    <tr>
      <td class='v-container-padding-padding' style='overflow-wrap:break-word;word-break:break-word;padding:0px 60px 20px;font-family:'Montserrat',sans-serif;' align='left'>
        
  <div style='color: #666666; line-height: 140%; text-align: left; word-wrap: break-word;'>
    <p style='font-size: 14px; line-height: 140%;'><span style='font-size: 18px; line-height: 25.2px; font-family: Lato, sans-serif;'>ขอให้คุณ  นำครุภัณฑ์มาคืนในวันและเวลาที่แจ้ง</span></p>
  </div>

      </td>
    </tr>
  </tbody>
</table>

  
  </div>
</div>

    </div>
  </div>
</div>



<div class='u-row-container' style='padding: 0px;background-color: #f6f6f6'>
  <div class='u-row' style='Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;'>
    <div style='border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;'>
      
      

<div class='u-col u-col-100' style='max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;'>
  <div style='height: 100%;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;'>
  <div style='height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;'>
  
<table style='font-family:'Montserrat',sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
  <tbody>
    <tr>
      <td class='v-container-padding-padding' style='overflow-wrap:break-word;word-break:break-word;padding:10px 10px 80px;font-family:'Montserrat',sans-serif;' align='left'>
        
  

      </td>
    </tr>
  </tbody>
</table>

  </div>
  </div>
</div>

    </div>
  </div>
</div>


    
    </td>
  </tr>
  </tbody>
  </table>
  
</body>

</html>'";

$page2 = "
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
  font-family:'Noto Sans Thai', sans-serif;
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
			<tr style='height: 100px;'>
				<td align='center' style='border: none;
						padding-right: 20px;padding-left:20px'>

					<p style='font-weight: ;font-size: 30px;
							letter-spacing: 0.025em;
              margin-top: 10px;
							color:black;'>
              ระบบเบิก-จ่ายครุภัณฑ์ <br>
             สาขาวิชาเทคโนโลยีโลจิสติกส์
					</p>
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
";

echo $page2;
?>

