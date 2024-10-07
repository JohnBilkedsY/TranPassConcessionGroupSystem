<?php
include 'config.php';

// Check if group ID is set in the URL
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // First, update users who are members of this group to set their group_id to null
    $update_users_sql = "UPDATE users SET group_id = NULL WHERE group_id = $id";
    if ($conn->query($update_users_sql) !== TRUE) {
        echo "Error updating users: " . $conn->error;
        exit;
    }

    // Now, delete the group
    $delete_group_sql = "DELETE FROM group_table WHERE group_id = $id";
    if ($conn->query($delete_group_sql) === TRUE) {
        echo "Group deleted successfully";
    } else {
        echo "Error deleting group: " . $conn->error;
    }
} else {
    echo "Group ID not provided";
}

$conn->close();
?>
