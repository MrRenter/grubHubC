<?php
    
    $mapsKey = 'AIzaSyAajKffYs0dt0gpNTMXxZYdsDItvpYI1sQ';
    $jsonAddress = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($_GET['address']) . '&key=' . $mapsKey);
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
?>
