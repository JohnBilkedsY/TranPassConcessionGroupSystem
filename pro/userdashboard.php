<?php
require_once("config.php");
  session_start();
  
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style/dash.css"> 
    <style>
     
      .usercontainer{
        background-color: #CADCFC;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px #00246B;
        width: 60%;
        margin: 10px auto;
        margin-top:40px ;
      }
      
      
    </style>
</head>
<body>
   
  <H1><center>FARE FRIENDLY STUDENT PASS ORGANISER</center></H1>
  <div class="topnav">
    
    <a href="userdashboard.php">Home</a>
    <a href="creategrouppage.php">Create Group</a>
    <a href="joingrouppage.php">Join Group</a>
    <a href="view_members.php">View Group</a>
    <a href="logout.php" class="right">logout</a>
  </div>
  
  <div class="usercontainer">
     <h2>Welcome to User Dashboard</h2> 
  <?php

// Fetch user data from the database based on the user's session ID
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE stud_deptno = '$user_id'";
$result = mysqli_query($conn, $query);


// Check if any rows were returned
if (mysqli_num_rows($result) > 0) {
  // Start table
  echo "<h2>User Profile</h2>";
  
  // Loop through each row and display user data in table rows
  while ($row = mysqli_fetch_assoc($result)) {
    echo "<p><strong>Department Number:</strong> " . $row['stud_deptno'] . "</p>";
    echo "<p><strong>Name:</strong> " . $row['stud_name'] . "</p>";
    echo "<p><strong>Email:</strong> " . $row['email'] . "</p>";
    echo "<p><strong>Phone:</strong> " . $row['phone'] . "</p>";
    echo "<p><strong>Gender:</strong> " . $row['gender'] . "</p>";
    echo "<p><strong>Location:</strong> " . $row['location'] . "</p>";
  }
  // End table
  echo "</table>";
} 
 else {
    echo "No user data found.";
}

// Close the database connection
mysqli_close($conn);
?>
</div>

</body>
</html>