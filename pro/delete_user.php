<?php
include_once "config.php";

$stud_deptno = $_GET['id'];

// Check if the user is a member of any group
$check_group_query = "SELECT * FROM users WHERE group_id IN (SELECT group_id FROM users WHERE stud_deptno='$stud_deptno')";
$check_group_result = mysqli_query($conn, $check_group_query);

if (mysqli_num_rows($check_group_result) > 0) {
    // If user is a member of a group, reduce the number of members in the group by 1
    $update_group_query = "UPDATE group_table SET no_of_members = no_of_members - 1 WHERE group_id IN (SELECT group_id FROM users WHERE stud_deptno='$stud_deptno')";
    if (!mysqli_query($conn, $update_group_query)) {
        echo "Error updating group members count: " . mysqli_error($conn);
        exit(); // Stop further execution
    }
}

// Proceed to delete the user
$delete_user_query = "DELETE FROM users WHERE stud_deptno='$stud_deptno'";
if (mysqli_query($conn, $delete_user_query)) {
    header("Location: user.php");
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
