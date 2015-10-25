<?php
  
  if (isset($_GET['id']) && is_numeric($_GET['id'])){
    include('../include/enum.php');
    $mysqli = new mysqli($dbIp, $dbUser, $dbPass, $dbDb);
    if ($mysqli->connect_errno){
      echo "Error connecting to database";
      echo $mysqli->connect_error;
      exit;
    }
    $name = '';
    $address = '';
    $description = '';
    $type = '';
    $city = '';
    $state = '';

    $sql = "SELECT * FROM resteraunts WHERE id={$_GET['id']}";
    $result = $mysqli->query($sql);
    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $name = $row['name'];
      $address = $row['address'];
      $description = $row['description'];
      $type = $row['type'];
      $city = $row['city'];
      $state = $row['state'];
    } else {
      header("Location: /admin/index.php");
    }
  } else {
    header("Location: /admin/index.php");
  }
  if (isset($type)){
    $sql = 'SELECT * FROM resType WHERE ID=' . $type;
    $result = $mysqli->query($sql);
    if ($result->num_rows > 0){
      $row = $result->fetch_assoc();
      $typeName = $row['type'];
    } else {
      $typeName = "None";
    }
  } else {
    $typeName = "None";
  }

  include('../include/header.php');
  include('../include/dashboardNavbar.php');
?>
<link href="/css/dashboard.css" rel="stylesheet">

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header">View Location</h1>
    <div class="col-xs-6 col-sm-6 placeholder">
        <h2 class="sub-header">Resteraunt Information</h2>
        <table style="table-layout: fixed;" width="100%">
         <tbody>
            <tr><td width="350px">
             <label for="name">Name:</label><br><?php echo $name?><br>
             <label for="address">Address:</label><br><?php echo $address?><br>
             <label for="description">Description:</label><br><?php echo $description?><br>
             <label for="type">Type:</label><br><?php echo $typeName?><br>
             <label for="city">City:</label><br><?php echo $city?><br>
             <label for="state">State:</label><br><?php echo $state?><br>
            </td><td width="600px">


<iframe
    width="600"
    height="450"
    frameborder="0" style="border:0"
    src="https://www.google.com/maps/embed/v1/place?key=<?php echo $mapsJavaKey;?>
    &q=<?php echo urlencode($address);?>">
  </iframe>
</td>
            </tr>
        </tbody>
      </table>
    </div>
</div>
<?php
  include('../include/footer.php');
?>
