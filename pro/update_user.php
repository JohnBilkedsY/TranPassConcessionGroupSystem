<?php
include_once "config.php";

$stud_deptno = $_POST['stud_deptno'];
$email = $_POST['email'];
$password = $_POST['password'];
$stud_name = $_POST['stud_name'];
$dept_name = $_POST['dept_name'];
$phone = $_POST['phone'];
$dob = $_POST['dob'];
$location = $_POST['location'];
$gender = $_POST['gender'];

$query = "UPDATE users SET email='$email', password='$password', stud_name='$stud_name', dept_name='$dept_name', phone='$phone', dob='$dob', location='$location', gender='$gender' WHERE stud_deptno='$stud_deptno'";

if (mysqli_query($conn, $query)) {
    header("Location: user.php");
} else {
    echo "Error updating record: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
