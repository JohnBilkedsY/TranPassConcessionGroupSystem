<?php
include_once "config.php";

$station_id = $_GET['id'];

$query = "DELETE FROM station WHERE station_id='$station_id'";

if (mysqli_query($conn, $query)) {
   
    header("Location: station.php");
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
