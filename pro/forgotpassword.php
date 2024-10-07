<?php
require_once("config.php");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if the email and DOB match in the database
    $sql = "SELECT * FROM users WHERE email = '$email' AND dob = '$dob'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Email and DOB match, now update the password
        if ($new_password === $confirm_password) {
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $update_sql = "UPDATE users SET password = '$hashed_password' WHERE email = '$email'";
            if ($conn->query($update_sql) === TRUE) {
                echo "Password updated successfully.";
            } else {
                echo "Error updating password: " . $conn->error;
            }
        } else {
            echo "New password and confirm password do not match.";
        }
    } else {
        echo "Invalid email or date of birth.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <link rel="stylesheet" href="./style/dash.css">
    <style>
       
        #fp {
            margin: 0 auto; /* Center the form horizontally */
            text-align: left; /* Align the form contents to the left */
        }
        
        /* Style labels */
        label {
            display: block; /* Make labels block-level elements */
            width: 300px; /* Set a width for the form */
            margin-bottom: 5px; /* Add some space between labels and inputs */
            margin-top: 5px;
        }
        
        /* Style inputs */
        input[type="email"],
        input[type="date"],
        input[type="password"],
        input[type="submit"] {
            margin-top: 3px;
            padding: 4px;
            border: 1px solid #1d1c1c;
            border-radius: 4px;
            width: 300px;
        }
        
        input[type="submit"] {
            width: auto; /* Allow submit button to be its default width */
            background-color:blue;
            color: white;
        }

       
    </style>
</head>
<body>
<h1><center>FARE FRIENDLY STUDENT PASS ORGANISER</center></h1>
  <div class="topnav">
    
    <a href="homepage.php">Home</a>
    <a href="login.php">Login</a>
    <a href="register.php">Register</a>
    
</div>
    <form id="fp" method="post" action="#">
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>
        <label for="dob">Date of Birth:</label>
        <input type="date" id="dob" name="dob" required><br>
        <label for="new_password">New Password:</label>
        <input type="password" id="new_password" name="new_password" required><br>
        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>


<?php
// Close database connection
$conn->close();
?>
