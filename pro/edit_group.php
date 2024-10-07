<?php
include 'config.php';

// Check if group ID is set in the URL
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Validate group ID
    if (!is_numeric($id)) {
        echo "Invalid group ID";
        exit;
    }

    // Fetch group details based on ID
    $sql = "SELECT * FROM group_table WHERE group_id=$id";
    $result = $conn->query($sql);

    // Check if group exists
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Fetch all stations and fares for dropdowns
        $station_sql = "SELECT * FROM station";
        $station_result = $conn->query($station_sql);

        $fare_sql = "SELECT * FROM fare";
        $fare_result = $conn->query($fare_sql);
    } else {
        echo "Group not found";
        exit;
    }
} else {
    echo "Group ID not provided";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Group</title>
</head>
<body>
    <h1>Edit Group</h1>
    <form action="update_group.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $row['group_id']; ?>">
        <label for="group_name">Group Name:</label>
        <input type="text" name="group_name" id="group_name" value="<?php echo $row['Group_name']; ?>"><br><br>
        <label for="no_of_members">No. of Members:</label>
        <input type="number" name="no_of_members" id="no_of_members" value="<?php echo $row['no_of_members']; ?>"><br><br>
        <label for="source">Source:</label>
        <select name="source" id="source">
            <?php
            if ($station_result->num_rows > 0) {
                while($station_row = $station_result->fetch_assoc()) {
                    $selected = ($station_row['station_id'] == $row['source_id']) ? 'selected' : '';
                    echo "<option value='".$station_row['station_id']."' $selected>".$station_row['station_name']."</option>";
                }
            }
            ?>
        </select><br><br>
        <label for="destination">Destination:</label>
        <select name="destination" id="destination">
            <?php
            if ($station_result->num_rows > 0) {
                $station_result->data_seek(0);
                while($station_row = $station_result->fetch_assoc()) {
                    $selected = ($station_row['station_id'] == $row['destination_id']) ? 'selected' : '';
                    echo "<option value='".$station_row['station_id']."' $selected>".$station_row['station_name']."</option>";
                }
            }
            ?>
        </select><br><br>
        <label for="fare">Fare:</label>
        <select name="fare" id="fare">
            <?php
            if ($fare_result->num_rows > 0) {
                while($fare_row = $fare_result->fetch_assoc()) {
                    $selected = ($fare_row['fare_id'] == $row['fare_id']) ? 'selected' : '';
                    echo "<option value='".$fare_row['fare_id']."' $selected>".$fare_row['fare']."</option>";
                }
            }
            ?>
        </select><br><br>
        <label for="created_date">Created Date:</label>
        <input type="date" name="created_date" id="created_date" value="<?php echo $row['createddate']; ?>"><br><br>
        <label for="approved_date">Approved Date:</label>
        <input type="date" name="approved_date" id="approved_date" value="<?php echo $row['approveddate']; ?>"><br><br>
        <label for="status">Status:</label>
        <input type="text" name="status" id="status" value="<?php echo $row['status']; ?>"><br><br>
        <input type="submit" value="Save">
    </form>
</body>
</html>
