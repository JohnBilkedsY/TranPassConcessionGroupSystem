<?php 
require_once 'config.php';
session_start();

// Array to store validation messages
$validationMessages = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $loginUsername = $_POST['loginUsername'];
    $loginPassword = $_POST['loginPassword'];

    $sql = "SELECT * FROM users WHERE stud_deptno = '$loginUsername'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($loginPassword, $row['password'])) {
            $_SESSION['user_id'] = $row['stud_deptno'];
            header("Location: userdashboard.php");
            exit();
        } else {
            echo "<script>alert('incorrect password')</script>";
        }
    } else {
        echo "<script>alert('user not found')</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/logreg.css">
    
    <title>Login and Registration</title>
</head>
<body>
<div class="container">
    <form id="loginForm" action="#" method="post" >
        <h2>Login</h2>
        <?php if (!empty($validationMessages)): ?>
            <div class="validation-summary">
                <?php foreach ($validationMessages as $message): ?>
                    <p><?php echo $message; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <label for="loginUsername">Your ID (Dept.No.):</label>
        <input type="text" id="loginUsername" name="loginUsername" required>
        <label for="loginPassword">Password:</label>
        <input type="password" id="loginPassword" name="loginPassword" required>
        <h6><a href="forgotpassword.php">Forgot Password?</a></h6>
        <button type="submit" name="login">Login</button>
    </form>
    <h5><center>Don't have an account? <a href="register.php" >Sign In</a></center></h5>
    <h5><center><a href="homepage.php" >Back to Home</a></center></h5> 
</div>
</body>
</html>
