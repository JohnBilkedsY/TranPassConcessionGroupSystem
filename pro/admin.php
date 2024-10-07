<?php
require_once "config.php";
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $loginEmail = $_POST['loginEmail'];
    $loginPassword = $_POST['loginPassword'];
// Query to fetch admin data
$sql = "SELECT * FROM adminlogin WHERE Email = '$loginEmail'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($loginPassword, $row['password'])) {
        $_SESSION['admin_id'] = $row['admin_id']; // Store admin_id in session
        echo "<script>alert('Login Successful.')</script>";
        header("Location: admindashboard.php");
            exit();     
    }
} else {
    echo "<script>alert('Incorrect password.')</script>";
}
} else {
    echo "<script>alert('Admin not found.')</script>";
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./style/logreg.css">
        <script src="script.js"></script>
        <title>Admin Login</title>
    </head>
    <body>
        <div class="container">
            <div id="adminloginContainer">
                <form id="loginForm" action="#" method="post" onsubmit="return validateRegistrationForm()">
                    <h2>Admin Login</h2>
                    <label for="loginEmail">Admin Email:</label>
                    <input type="text" id="loginEmail" name="loginEmail" required>
                    <label for="loginPassword">Password:</label>
                    <input type="password" id="loginPassword" name="loginPassword" required>
                    <button type="submit" name="login">Login</button>
                    <h5><center>Don't have an account?<a href="adminreg.php" >Sign Up</a></center></h5>
                    <h5><center><a href="homepage.php" >Back to Home</a></center></h5>
                </form>
            </div>
        </div>
    </body>
    </html>