<?php
include_once "config.php";

if(isset($_GET['id'])) {
    $stud_deptno = $_GET['id'];

    $query = "SELECT * FROM users WHERE stud_deptno='$stud_deptno'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
} else {
    header("Location: user.php");
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit User</title>
<link rel="stylesheet" href="./style/stylesMs.css">
<link rel="stylesheet" href="./style/dash.css">
</head>
<body>
<h1><center>FARE FRIENDLY STUDENT PASS ORGANISER</center></h1>
<div class="topnav">
    
    <a href="admindashboard.php">Home</a>
    

    <a href="adminlog.php" class="right">logout</a>
    
  </div>
<div class="container">
    <h1>Edit User</h1>
    <form action="update_user.php" method="POST">
        <input type="text" name="stud_deptno" value="<?php echo $row['stud_deptno']; ?>" readonly>
        <input type="email" name="email" value="<?php echo $row['email']; ?>" required>
        <input type="hidden" name="password" value="<?php echo $row['password']; ?>" required>
        <input type="text" name="stud_name" value="<?php echo $row['stud_name']; ?>" required>
        <input type="text" name="dept_name" value="<?php echo $row['dept_name']; ?>" required>
        <input type="text" name="phone" value="<?php echo $row['phone']; ?>" required>
        <input type="date" name="dob" value="<?php echo $row['dob']; ?>" required>
        <input type="text" name="location" value="<?php echo $row['location']; ?>" required>
        <input type="text" name="groupid" value="<?php echo $row['group_id']; ?>" required>
        <select name="gender" required>
            <option value="Male" <?php if($row['gender'] == 'Male') echo 'selected'; ?>>Male</option>
            <option value="Female" <?php if($row['gender'] == 'Female') echo 'selected'; ?>>Female</option>
            <option value="Other" <?php if($row['gender'] == 'Other') echo 'selected'; ?>>Other</option>
        </select>
        <button type="submit">Update User</button>
    </form>
</div>
</body>
</html>
