<?php
include_once "config.php";

if(isset($_GET['id'])) {
    $fare_id = $_GET['id'];

    $query = "SELECT * FROM fare WHERE fare_id='$fare_id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
} else {
    header("Location: fare.php");
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Fare</title>
<link rel="stylesheet" href="./style/styles.css">
<link rel="stylesheet" href="./style/dash.css">
</head>
<body>
<h1><center>FARE FRIENDLY STUDENT PASS ORGANISER</center></h1>
  <div class="topnav">
    <a href="admindashboard.php">Home</a>
    <a href="adminlog.php" class="right">logout</a> 
  </div>
<div class="container">
    <h1>Edit Fare</h1>
    <form action="update_fare.php" method="POST">
        <input type="hidden" name="fare_id" value="<?php echo $row['fare_id']; ?>">
        <input type="text" name="fare" value="<?php echo $row['fare']; ?>" required>
        <input type="text" name="no_of_stations" value="<?php echo $row['no_of_stations']; ?>" required>
        <button type="submit">Update Fare</button>
    </form>
</div>
</body>
</html>
