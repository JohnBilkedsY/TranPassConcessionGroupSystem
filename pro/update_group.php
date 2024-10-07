<?php
include 'config.php';

        // Prepare data for update
        $id = $_POST['id'];
        $group_name = $_POST['group_name'];
        $no_of_members = $_POST['no_of_members'];
        $source = $_POST['source'];
        $destination = $_POST['destination'];
        $fare = $_POST['fare'];
        $created_date = $_POST['created_date'];
        $approved_date = $_POST['approved_date'];
        $status = $_POST['status'];

        // Update the group record in the database
        $sql = "UPDATE group_table 
                SET Group_name='$group_name', no_of_members='$no_of_members', source_id='$source', destination_id='$destination', fare_id='$fare', createddate='$created_date', approveddate='$approved_date', status='$status' 
                WHERE group_id=$id";

        if ($conn->query($sql) === TRUE) {
           
            header("Location: group.php");
        }  else {
            echo "Error updating record: " . mysqli_error($conn);
        }

$conn->close();
?>
