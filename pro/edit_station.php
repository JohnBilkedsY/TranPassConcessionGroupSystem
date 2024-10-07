<?php
include_once "config.php";

if(isset($_GET['id'])) {
    $station_id = $_GET['id'];

    // Fetch existing station details
    $query = "SELECT * FROM station WHERE station_id='$station_id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    // Display form for editing
    echo "<!DOCTYPE html>";
    echo "<html lang='en'>";
    echo "<head>";
    echo "<meta charset='UTF-8'>";
    echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
    echo "<title>Edit Station</title>";
    echo "<link rel='stylesheet' href='./style/dash.css'>";
    echo "<link rel='stylesheet' href='./style/stylesMs.css'>";
    echo "</head>";
    echo "<body>";
    echo '<h1><center>FARE FRIENDLY STUDENT PASS ORGANISER</center></h1>
    <div class="topnav">
        
        <a href="admindashboard.php">Home</a>
        <a href="adminlog.php" class="right">logout</a>
      </div>';
    echo "<div class='container'>";
    echo "<h1>Edit Station</h1>";
    echo "<form action='update_station.php' method='POST'>";
    // Hidden input field to carry station_id
    echo "<input type='hidden' name='station_id' value='".$row['station_id']."'>";
    // Input fields for editing station details
    echo "<input type='text' name='station_name' value='".$row['station_name']."' placeholder='Station Name' required>";
    echo "<input type='text' name='direction' value='".$row['direction']."' placeholder='Direction' required>";
    echo "<button type='submit'>Update Station</button>";
    echo "</form>";
    echo "</div>";
    echo "</body>";
    echo "</html>";

} else {
    // Redirect if station_id is not provided
    header("Location: station.php");
}

mysqli_close($conn);
?>
