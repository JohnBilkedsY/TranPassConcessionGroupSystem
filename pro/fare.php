<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Fare Management</title>
<link rel="stylesheet" href="./style/dash.css">
<link rel="stylesheet" href="./style/stylesMs.css">

</head>
<body>
<h1><center>FARE FRIENDLY STUDENT PASS ORGANISER</center></h1>
<div class="topnav">
    
    <a href="admindashboard.php">Home</a>
    

    <a href="adminlog.php" class="right">logout</a>
    
  </div>
<div class="container">
    <h1>Fare Management</h1>
    <table>
        <thead>
            <tr>
                <th>fare_id</th>
                <th>Fare</th>
                <th>No of Stations</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php include 'fetch_fares.php'; ?>
        </tbody>
    </table>
    <form action="insert_fare.php" method="POST">
        <!-- Input fields for inserting new fare data -->
        <input type="text" name="fare_id" placeholder="fare_id" required>
        <input type="text" name="fare" placeholder="Fare" required>
        <input type="text" name="no_of_stations" placeholder="No of Stations" required>
        <button type="submit">Add Fare</button>
    </form>
</div>
</body>
</html>
