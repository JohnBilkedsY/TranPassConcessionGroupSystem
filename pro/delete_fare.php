<?php
include_once "config.php";

$fare_id = $_GET['id'];

$query = "DELETE FROM fare WHERE fare_id='$fare_id'";

if (mysqli_query($conn, $query)) {
   
    header("Location: fare.php");
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
