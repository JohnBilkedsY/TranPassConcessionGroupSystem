<?php
require_once "config.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
// Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
    $email = $_POST['registerEmail'];
    $password = password_hash($_POST['registerPassword'],PASSWORD_DEFAULT);
   
    // Validate if the email is unique
    $checkEmailQuery = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($checkEmailQuery);
    
    if ($result->num_rows > 0) {
        echo "<script>alert('Email already exists. Please choose another email.')</script>";
    } elseif($_POST['registerPassword']==$_POST['confirmPassword']) {
        $stud_deptno = $_POST['stud_deptno'];
        $stud_name = $_POST['stud_name'];
        $dept_name = $_POST['dept_name'];
        $phone = $_POST['phone'];
        $location = $_POST['location'];
        $gender = $_POST['gender'];
        $dob = $_POST['dob'];
        
    
        // Insert into personal table
        $insertQuery = "INSERT INTO users (stud_deptno, email,password, stud_name, dept_name, phone, location, gender, dob)
        VALUES ('$stud_deptno', '$email', '$password','$stud_name', '$dept_name', '$phone', '$location', '$gender', '$dob')";
        if ($conn->query($insertQuery) === TRUE) {
            echo "<script>alert('Registration successful!')</script>";
            header("Location: login.php");
            exit();
        } else {
            echo "Error: " . $insertQuery . "<br>" . $conn->error;
        }
        }
        else{
            echo "<script>alert('password mismatched')</script>";
        } 
    
// Close connection
$conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="./style/logreg.css">
    </head>
    <body>
    <div class="container">
      
            <form id="registerForm" action="#" method="post" onsubmit="return validateRegistrationForm()">
                <h2>Register</h2>
                <label for="stud_deptno">Student Dept No:</label>
                <input type="text" id="stud_deptno" name="stud_deptno" required>
                <label for="stud_name">Student Name:</label>
                <input type="text" id="stud_name" name="stud_name"required>
                <label for="dept_name">Department Name:</label>
                <!-- Dropdown for Department name -->
                <select id="dept_name" name="dept_name" required>
                    <option value="Adv Zoo & Biotech">Adv Zoo & Biotech</option>
                    <option value="B.Com (Accounting & Finance)">B.Com (Accounting & Finance)</option>
                    <option value="B.Com (Computer Applications)">B.Com (Computer Applications)</option>
                    <option value="B Com (CS)">B Com (CS)</option>
                    <option value="B Com (Honours)">B Com (Honours)</option>
                    <option value="B B A">B B A</option>
                    <option value="Chemistry">Chemistry</option>
                    <option value="Commerce">Commerce</option>
                    <option value="Computer Science">Computer Science</option>
                    <option value="Computer Applications">Computer Applications</option>
                    <option value="Data Science">Data Science</option>
                    <option value="Economics">Economics</option>
                    <option value="English">English</option>
                    <option value="French">French</option>
                    <option value="Hindi">Hindi</option>
                    <option value="History">History</option>
                    <option value="Mathematics">Mathematics</option>
                    <option value="Physics">Physics</option>
                    <option value="Plant Biology & Biotechnology">Plant Biology & Biotechnology</option>
                    <option value="Psychology">Psychology</option>
                    <option value="Sociology">Sociology</option>
                    <option value="Statistics">Statistics</option>
                    <option value="Tamil">Tamil</option>
                    <option value="Visual Communication">Visual Communication</option>
                </select>
                
                <label for="phone">Phone:</label>
                <input type="text" id="phone" name="phone">
                <label for="dob">Date of Birth:</label>
                <input type="date" id="dob" name="dob"  min="1999-01-01" max="2005-12-31" required>
                <label for="location">Location:</label>
                <input type="text" id="location" name="location" required>
                <label for="gender">Gender:</label>
                <select id="gender" name="gender" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Others">Others</option>
                    
                </select>
                <label for="registerEmail">Email:</label>
                <input type="email" id="registerEmail" name="registerEmail" required>
                <label for="registerPassword">Password:</label>
                <input type="password" id="registerPassword" name="registerPassword" required>
                <label for="confirmPassword">Confirm Password:</label>
                <input type="password" id="confirmPassword" name="confirmPassword" required>
                <button type="submit" name="register">Register</button>
            </form>
            <h5><center>already have an account?<a href="login.php" >Sign Up</a><center></h5>
            <h5><center><a href="homepage.php" >Back to Home</a></center></h5>
        </div>
  
    <script src="script.js"> </script>
</body>
</html>