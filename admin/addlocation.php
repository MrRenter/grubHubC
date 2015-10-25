<?php
  ini_set('display_errors', 1);  

  function clean($mysql, $toClean){
  return preg_replace('/[^ \w]+/', '', $mysql->real_escape_string($toClean));
  }

  if (isset($_POST['name']) && isset($_POST['address']) && isset($_POST['description']) && isset($_POST['type'])){
  //Connect to mysql
    $mysqli = new mysqli('127.0.0.1', 'root', 'root', 'grubhubc');
    if ($mysqli->connect_errno){
      echo "Error connecting to database";
      echo $mysqli->connect_error;
      exit;
    }

    $name = clean($mysqli, $_POST['name']);
    $address = clean($mysqli, $_POST['address']);
    $description = clean($mysqli, $_POST['description']);
    $type = clean($mysqli, $_POST['type']);

    $mapsKey = 'AIzaSyAajKffYs0dt0gpNTMXxZYdsDItvpYI1sQ';
    $jsonAddress = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($address) . '&key=' . $mapsKey);
    $objAddress = json_decode($jsonAddress, TRUE);
    $addressParts = $objAddress['results'][0]['address_components'];
    $geoParts['lat'] = $objAddress['results'][0]['geometry']['location']['lat'];
    $geoParts['lng'] = $objAddress['results'][0]['geometry']['location']['lng'];
    $addressState = '';
    $addressCity = '';
    foreach ($addressParts as $part){
        if ($part['types'][0] == 'administrative_area_level_1'){
            $addressState = $part['short_name'];
        } else if ($part['types'][0] == 'locality'){
            $addressCity = $part['long_name'];
        }
    }

  //Insert new location
  $sql = "INSERT INTO `resteraunts` (`id`, `name`, `address`, `description`, `type`, `lon`, `lat`, `city`, `state`) VALUES (NULL, '$name', '$address', '$description', '$type', '{$geoParts['lng']}', '{$geoParts['lat']}', '$addressCity', '$addressState');"; 
    $result = $mysqli->query($sql);
    echo $sql;
    exit;
  //Redirect to /admin/index.php
//  header('Location: /admin/index.php?added=location');
  }
  
  include('../include/header.php');
  include('../include/dashboardNavbar.php');
?>
<link href="/css/dashboard.css" rel="stylesheet">

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header">Add Location</h1>
    <div class="col-xs-6 col-sm-6 placeholder">
	<h2 class="sub-header">Resteraunt Information</h2>
        <form name="addlocation" action="addlocation.php" method="post">
	  <label for="">Name:</label>
	  <div class="input-group">
	    <input name="name" type="text" class="form-control" size="40">
	  </div>
	
	  <label for="">Address:</label>
	  <div class="input-group">
	    <input name="address" type="text" class="form-control" size="40">
	  </div>

	  <label for="">Description:</label>
	  <div class="input-group">
	    <input name="description" type="text" class="form-control" size="40">
	  </div>

	  <label for="">Picture:</label>
	  <div class="input-group">
	    <input name="picture" type="text" class="form-control" size="40">
	  </div>

	  <label for="">Type:</label>
	  <div class="input-group">
	    <select name="type" class="form-control" width="40">
	      <option value="0">Pizzaria</option>
	      <option value="1">Grill</option>
	      <option value="2">Deli</option>
	      <option value="3">Resteraunt</option>
	    </select>	
        </div>
	<br>	
        <button type="submit" class="btn btn-default">Submit</button>
        </form>
	</div>
</div>
</div>
<?php include('../include/footer.php');?>
