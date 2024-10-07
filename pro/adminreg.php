<?php
require_once "config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $registerEmail = $_POST['registerEmail'];
    $registerPassword = $_POST['registerPassword'];
    $cpassword = $_POST['confirmPassword'];
    // Check if the admin ID is already registered
    $checkSql = "SELECT * FROM adminlogin WHERE Email = '$registerEmail'";
    $checkResult = $conn->query($checkSql);

    if ($checkResult->num_rows > 0) {
        echo "<script>alert('Admin ID already exists.')</script>";
    } 
    elseif ( $registerPassword == $cpassword){
        // Hash the password
        
        $hashedPassword = password_hash($registerPassword, PASSWORD_DEFAULT);

        // Insert admin data into the database
        $insertSql = "INSERT INTO adminlogin (Email, password) VALUES ('$registerEmail', '$hashedPassword')";
        if ($conn->query($insertSql) === TRUE) {
            echo "<script>alert('Registration successful.')</script>";
        } else {
            echo "<script>alert('Error: " . $conn->error . "')</script>";
        }
    }
    else{
        echo "<script>alert('password mismatched')</script>";
    }    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/logreg.css">
    <script src="script.js"></script>
    <title>Admin Registration</title>
</head>
<body>
    <div class="container">
        <div id="registrationContainer">
            <form id="registrationForm" action="#" method="post" onsubmit="return validateRegistrationForm()">
                <h2>Admin Registration</h2>
                <label for="registerEmail">Admin Email:</label>
                <input type="text" id="registerEmail" name="registerEmail" required>
                <label for="registerPassword">Password:</label>
                <input type="password" id="registerPassword" name="registerPassword" required>
                <label for="confirmPassword">Confirm Password:</label>
                <input type="password" id="confirmPassword" name="confirmPassword" required>
                <button type="submit" name="register">Register</button>
                <h5><center>Already have an account?<a href="admin.php" >Sign In</a></center></h5>
                <h5><center><a href="homepage.php" >Back to Home</a></center></h5>
            </form>
        </div>
    </div>
</body>
</html>