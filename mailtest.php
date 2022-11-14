<?php
    $servername = "localhost";
    $username = "id19560374_admin";
    $password = "}gKqjRl}nUXU#jG1";
    $dbname = "id19560374_db_eq";

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
// $row = $result->fetch_assoc();


 while($row = mysqli_fetch_array($result)) {
date_default_timezone_set('Asia/Bangkok');
$nt = time();   // มันจะดึงเวลาปัจุบันมาเอง
$ct = strtotime($row['lent_end']);  // ใส่เวลาที่คุณต้องการ อาจจะมาจากดาต้าเบสก็ได้ดึงค่ามาใส่
$distance = $ct-$nt; //หักลบวันเพื่อใช้คำนวณ
$days = floor($distance / (60 * 60 * 24));
$hours = floor(($distance % (60 * 60 * 24)) / (60 * 60));
$minutes = floor($distance % (60 * 60)/60);
$seconds = floor($distance % 60);

echo $nt;
echo "<br>";
echo $ct;
echo "<br>";
echo $distance;
echo "<br>";
echo $days;
echo "<br>";
if ($distance >= 0) {
  $keep = $days." Days- ".$hours." H.- ".$minutes." M.- ".$seconds."S.";  
} else {
  $keep = "";
}
echo $keep;
echo "<br>";
echo  $row["email"];
echo "<br>";
echo  $row["lent_end"];
echo "<br>";
    
  
  }
?>