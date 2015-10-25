<?php
include('../include/enum.php');
$mysqli = new mysqli($dbIp, $dbUser, $dbPass, $dbDb);
if ($mysqli->connect_errno){
  echo "Error connecting to database";
  echo $mysqli->connect_error;
  exit;
}

$sql = "SELECT * FROM `resteraunts`";
$return_arr = array();

$result = $mysqli->query($sql); 

while ($row = $result->fetch_assoc()) {
  $temp = "<a href='/admin/viewlocation.php?id=" . $row['id']  . "'>";
      $row_array['id'] = $row['id'];
      $row_array['name'] = $temp . $row['name'] . "</a>";
      $row_array['description'] = $row['description'];
      $row_array['city'] = $row['city'];
      $row_array['state'] = $row['state'];

      array_push($return_arr,$row_array);
}

echo json_encode($return_arr);
?>
