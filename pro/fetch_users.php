<?php
// Include database connection file
include_once "config.php";

// Fetch users from database
$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>".$row['stud_deptno']."</td>";
    echo "<td>".$row['email']."</td>";
    echo "<td>".$row['stud_name']."</td>";
    echo "<td>".$row['dept_name']."</td>";
    echo "<td>".$row['phone']."</td>";
    echo "<td>".$row['dob']."</td>";
    echo "<td>".$row['location']."</td>";
    echo "<td>".$row['gender']."</td>";
    echo "<td>".$row['group_id']."</td>";
    echo "<td><a href='edit_user.php?id=".$row['stud_deptno']."'>Edit</a>  <a href='delete_user.php?id=".$row['stud_deptno']."'>Delete</a></td>";
    echo "</tr>";
}

// Close connection
mysqli_close($conn);
?>
