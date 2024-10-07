<?php
include_once "config.php";

$fare_id = $_POST['fare_id'];
$fare = $_POST['fare'];
$no_of_stations = $_POST['no_of_stations'];

$query = "INSERT INTO fare (fare_id, fare, no_of_stations) 
VALUES ('$fare_id', '$fare', '$no_of_stations')";

if (mysqli_query($conn, $query)) {
    header("Location: fare.php");
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
