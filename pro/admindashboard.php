<?php 
require_once("config.php");

session_start();
    if(isset($_SESSION['admin_id'])) {
        $userId = $_SESSION['admin_id'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="./style/dash.css">
    <style>
      .dashboard-stat{
        Display:inline-block;
        margin-left : 15px;
        margin-top:5px;
        
      }
     
      .admincontainer{
        background-color: #CADCFC;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px #00246B;
        width: 60%;
        margin: 10px auto;
        
      }
      .admincontainer2{
        background-color: #CADCFC;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px #00246B;
        width: 60%;
        margin: 10px auto;
        
      }
    </style>
</head>
<body>
  <h1><center>FARE FRIENDLY STUDENT PASS ORGANIZER</center></h1>
  <div class="topnav">
    <a href="admindashboard.php" class="active">Home</a>
    <a href="apdis.php">Approval</a>
    <a href="user.php">User Management</a>
    <a href="group.php">Group Management</a>
    <a href="fare.php">Fare Management</a>
    <a href="station.php">Station Management</a>
    <a href="adminlog.php" class="right">Logout</a>
    
  </div>

  <div class="admincontainer">
    <h2>Welcome to Admin Dashboard</h2>
      <div class="dashboard-stat">
        <h3>Total Groups</h3>
        <p><?php echo mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS count FROM group_table"))['count']; ?></p>
      </div>
      <div class="dashboard-stat">
        <h3>Total Users</h3>
        <p><?php echo mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS count FROM users"))['count']; ?></p>
      </div>
      <div class="dashboard-stat">
        <h3>Approved Groups</h3>
        <p><?php echo mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS count FROM group_table WHERE status = 'approved'"))['count']; ?></p>
      </div>
      <div class="dashboard-stat">
        <h3>Pending Groups</h3>
        <p><?php echo mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS count FROM group_table WHERE status = 'pending'"))['count']; ?></p>
      </div>
      <div class="dashboard-stat">
        <h3>User without Group</h3>
        <p><?php echo mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS count FROM users WHERE group_id IS NULL"))['count']; ?></p>
      </div>
      <div class="dashboard-stat">
      <h3>User With Group</h3>
        <p><?php echo mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS count FROM users WHERE group_id IS NOT NULL"))['count']; ?></p>

    </div>
    </div>
    <div class="admincontainer2">
    <h4>Manage Users</h4>
    <p>View, edit, or delete user accounts as needed. .</p>

    <h4>Manage Groups</h4>
    <p>View, approve, or delete groups created by users. </p>


    <h4>Manage Fares</h4>
    <p>Add, update, or remove fare information for student passes.</p>

    <h4>Manage Stations</h4>
    <p>Add, edit, or remove station information for student pass routes. </p>

    <h4>Pending Approvals</h4>
    <p>Review and approve pending group requests. </p>


      
      </div>
</body>
</html>
