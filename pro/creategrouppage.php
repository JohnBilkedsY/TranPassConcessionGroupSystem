<?php
require_once "config.php";
session_start();
$userId = $_SESSION['user_id']; // Assuming you store user ID in the session

// Process group creation form
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['createGroup'])) {
    $groupName = $_POST['groupName'];
    $sourceId = $_POST['sourceId'];
    $destinationId = $_POST['destinationId'];

    // Calculate the number of stations between source and destination
    $numStationsQuery = "SELECT COUNT(station_id) AS num_stations 
                         FROM station 
                         WHERE station_id IN (
                             SELECT station_id 
                             FROM station 
                             WHERE direction = (
                                 SELECT direction 
                                 FROM station 
                                 WHERE station_id = $destinationId
                             ) AND station_id BETWEEN LEAST($sourceId, $destinationId) AND GREATEST($sourceId, $destinationId)
                         )";
    $numStationsResult = $conn->query($numStationsQuery);

    if ($numStationsResult && $numStationsResult->num_rows > 0) {
        $row = $numStationsResult->fetch_assoc();
        $numStations = $row['num_stations'];

        // Determine fare based on the number of stations
        $fareQuery = "SELECT fare_id FROM fare WHERE no_of_stations >= $numStations ORDER BY no_of_stations ASC LIMIT 1";
        $fareResult = $conn->query($fareQuery);

        if ($fareResult && $fareResult->num_rows > 0) {
            $fareRow = $fareResult->fetch_assoc();
            $fareId = $fareRow['fare_id'];

            // Check if the user is already associated with a group
            $checkUserGroupQuery = "SELECT group_id FROM users WHERE stud_deptno ='$userId'";
            $checkUserGroupResult = $conn->query($checkUserGroupQuery);

            if ($checkUserGroupResult->num_rows > 0) {
                $row = $checkUserGroupResult->fetch_assoc();
                if ($row['group_id'] !== NULL) {
                    echo "<script>alert('You are already associated with a group. You cannot create another group.')</script>";
                } else {
                    // Insert into group table
                    $insertGroupQuery = "INSERT INTO group_table (Group_name, no_of_members, source_id, destination_id, fare_id) 
                                         VALUES ('$groupName', 1, $sourceId, $destinationId, $fareId)";
                    if ($conn->query($insertGroupQuery)) {
                        $groupId = $conn->insert_id; // Get the ID of the inserted group

                        // Update the user's group_id in the personal table
                        $updateUserGroupQuery = "UPDATE users SET group_id = $groupId WHERE stud_deptno = '$userId'";
                        if ($conn->query($updateUserGroupQuery)) {
                            echo "<script>alert('Group created successfully and you have been associated with it!')</script>";
                        } else {
                            echo "Error updating group_id in personal table: " . $conn->error;
                        }
                    } else {
                        echo "Error creating group: " . $conn->error;
                    }
                }
            } else {
                echo "Error checking user's group association: " . $conn->error;
            }
        } else {
            echo "Error determining fare: No fare found for the calculated number of stations.";
        }
    } else {
        echo "Error calculating number of stations.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Group Creation</title>
<link rel="stylesheet" href="./style/group.css">
<link rel="stylesheet" href="./style/dash.css">
</head>
<body>
<H1><center>FARE FRIENDLY STUDENT PASS ORGANISER</center></H1>
  <div class="topnav">
    
    <a href="userdashboard.php">Home</a>
    <a href="joingrouppage.php">Join Group</a>
    <a href="view_members.php">View </a>
    <a href="logout.php" class="right">logout</a>
    
  </div>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"  onsubmit="return validateGroupCreationForm()">
<label for="groupName">Group Name:</label>
<input type="text" id="groupName" name="groupName" required>
<label for="sourceId">Source Station:</label>
<select id="sourceId" name="sourceId" required>
<?php

$sourceQuery = "SELECT station_id, station_name FROM station where station_id= 1";
$sourceResult = $conn->query($sourceQuery);
if ($sourceResult->num_rows > 0) {
    while ($row = $sourceResult->fetch_assoc()) {
    echo "<option value='" . $row['station_id'] . "'>". $row['station_name'] . "</option>";
    }
}
?>
</select>
    <label for="direction">Direction:</label>
    <select id="direction" name="direction"onchange="this.form.submit()" required>
        <option value="-1" selected >select</option>
        <option value="east" >East</option>
        <option value="west">West</option>
        <option value="north">North</option>
    </select>
    <label for="destinationId">Destination Station:</label>
<select id="destinationId" name="destinationId" required>

<?php
if (isset($_POST['direction'])) {
    $selectedDirection = $_POST['direction'];
    if ($selectedDirection == 'north' || $selectedDirection == 'east') {
        $destinationQuery = "SELECT station_id, station_name FROM station WHERE direction IN ('$selectedDirection','common')";
        }    
        else {
        $destinationQuery = "SELECT station_id, station_name FROM station WHERE direction = '$selectedDirection'";
        }
    $destinationResult = $conn->query($destinationQuery);
    if ($destinationResult->num_rows > 0) {
        while ($row = $destinationResult->fetch_assoc()) {
        echo "<option value='" . $row['station_id'] ."'>" . $row['station_name'] . "</option>";
        }
    } 
    else {
        echo "<option value=''>No stations found for the selected direction</option>";
    }
}
?>
</select>
<button type="submit" name="createGroup">Create Group</button>
</form>
</body>
</html>