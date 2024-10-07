<?php
include_once "config.php";

$station_id = $_POST['station_id'];
$station_name = $_POST['station_name'];
$direction = $_POST['direction'];

$query = "INSERT INTO station (station_id, station_name, direction) 
VALUES ('$station_id', '$station_name', '$direction')";

if (mysqli_query($conn, $query)) {
    header("Location: station.php");
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
