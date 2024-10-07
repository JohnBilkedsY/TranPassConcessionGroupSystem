<?php
include_once "config.php";

// Check if form data is submitted
if(isset($_POST['station_id']) && isset($_POST['station_name']) && isset($_POST['direction'])) {
    // Collect data from form submission
    $station_id = $_POST['station_id'];
    $station_name = $_POST['station_name'];
    $direction = $_POST['direction'];

    // Update station details in the database
    $query = "UPDATE station SET station_name='$station_name', direction='$direction' WHERE station_id='$station_id'";

    if (mysqli_query($conn, $query)) {
        // Redirect to the index page after successful update
        header("Location: station.php");
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
} else {
    // Redirect if form data is not submitted
    header("Location: station.php");
}

mysqli_close($conn);
?>
