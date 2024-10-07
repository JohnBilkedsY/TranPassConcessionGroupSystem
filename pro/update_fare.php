<?php
include_once "config.php";

$fare_id = $_POST['fare_id'];
$fare = $_POST['fare'];
$no_of_stations = $_POST['no_of_stations'];

$query = "UPDATE fare SET fare='$fare', no_of_stations='$no_of_stations' WHERE fare_id='$fare_id'";

if (mysqli_query($conn, $query)) {
    header("Location: fare.php");
} else {
    echo "Error updating record: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
