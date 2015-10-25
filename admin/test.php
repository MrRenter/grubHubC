<?php
$maxDistance = 24140.2;
$mapsKey = 'AIzaSyAajKffYs0dt0gpNTMXxZYdsDItvpYI1sQ';
$origin = urlencode('300 Mauch Chunk Street Pottsville, PA 17901');
if (empty($_GET['address'])){
    echo '<h1>Field Cannot be empty</h1>';
} else {

    $conn = new mysqli('localhost', 'root', 'root', 'grubHubC');

    if ($conn->connect_error) {
        die('Could not connect: ' . $conn->connect_error);
    }

    $userCity = 0;
    $userState = 0;
    $jsonAddress = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($_GET['address']) . '&key=' . $mapsKey);
    $objAddress = json_decode($jsonAddress, TRUE);
    $addressParts = $objAddress['results'][0]['address_components'];
    $addressState = '';
    $addressCity = '';
    foreach ($addressParts as $part){
        if ($part['types'][0] == 'administrative_area_level_1'){
            $addressState = $part['short_name'];
        } else if ($part['types'][0] == 'locality'){
            $addressCity = $part['long_name'];
        }
    }

    $deliver = false;
    $sql = 'SELECT title, city, state FROM resteraunts';
    $result = $conn->query($sql);
    if ($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            if ($row['state'] === $addressState){
                if ($row['city'] === $addressCity){
                    $deliver = true;
                } else {
                    echo "<br>Polled google for distance";
                    $json = file_get_contents('https://maps.googleapis.com/maps/api/distancematrix/json?origins=' . urlencode($row['address']) . '&destinations=' . urlencode($_GET['address']) . '&units=imperial&key=' . $mapsKey);
                    $obj = json_decode($json, true);
                    $a = $obj['rows'];
                    if ($a[0]['elements'][0]['distance']['value'] <= $maxDistance) {
                        $deliver = true;
                    }
                }
            }
            if ($deliver){
                echo 'You can order from ' . $row['title'] . '<br>';
            }
        }
    }

    $conn->close();

}
?>

<html>
<form action="/admin/test.php" method="get">
    <input type="text" name="address">
    <button type="submit">Check Distance</button>
</form>

</form>
</html>
