<?php
include_once "config.php";

// Collect data from form submission and insert into database
$stud_deptno = $_POST['stud_deptno'];
$email = $_POST['email'];
$password =  password_hash($_POST['password'], PASSWORD_DEFAULT);
$stud_name = $_POST['stud_name'];
$dept_name = $_POST['dept_name'];
$phone = $_POST['phone'];
$dob = $_POST['dob'];
$location = $_POST['location'];
$gender = $_POST['gender'];

$query = "INSERT INTO users (stud_deptno, email, password, stud_name, dept_name, phone, dob, location, gender) 
VALUES ('$stud_deptno', '$email', '$password', '$stud_name', '$dept_name', '$phone', '$dob', '$location', '$gender')";

if (mysqli_query($conn, $query)) {
    header("Location: user.php");
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
