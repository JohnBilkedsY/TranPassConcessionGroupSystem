<?php
require_once "config.php";
session_start();
$userId = $_SESSION['user_id']; // Assuming you store user ID in the session

// Process group joining form
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['joinGroup'])) {
    $groupId = $_POST['groupId'];

    // Check if the user is already associated with a group
    $checkUserGroupQuery = "SELECT group_id FROM users WHERE stud_deptno ='$userId'";
    $checkUserGroupResult = $conn->query($checkUserGroupQuery);

    if ($checkUserGroupResult) {
        if ($checkUserGroupResult->num_rows > 0) {
            $row = $checkUserGroupResult->fetch_assoc();
            if ($row['group_id'] !== NULL) {
                echo "<script>alert('You are already associated with a group. You cannot join another group.')</script>";
            } else {
                // Check if the group has reached its maximum capacity
                $checkGroupCapacityQuery = "SELECT no_of_members FROM group_table WHERE group_id = $groupId";
                $checkGroupCapacityResult = $conn->query($checkGroupCapacityQuery);

                if ($checkGroupCapacityResult && $checkGroupCapacityResult->num_rows > 0) {
                    $row = $checkGroupCapacityResult->fetch_assoc();
                    $numMembers = $row['no_of_members'];

                    if ($numMembers >= 5) {
                        echo "<script>alert('Sorry, this group has reached its maximum capacity. Please select another group.')</script>";
                    } else {
                        // Update the user's group_id in the personal table
                        $updateUserGroupQuery = "UPDATE users SET group_id = $groupId WHERE stud_deptno = '$userId'";
                        if ($conn->query($updateUserGroupQuery)) {
                            // Update the number of members in the group
                            $updateGroupMembersQuery = "UPDATE group_table SET no_of_members = no_of_members + 1 WHERE group_id = $groupId";
                            if ($conn->query($updateGroupMembersQuery)) {
                                echo "<script>alert('You have successfully joined the group!')</script>";
                            } else {
                                echo "Error updating number of members in the group: " . $conn->error;
                            }
                        } else {
                            echo "Error updating group_id in personal table: " . $conn->error;
                        }
                    }
                } else {
                    echo "Error checking group capacity: " . $conn->error;
                }
            }
        } else {
            echo "No groups found for the user.";
        }
    } else {
        echo "Error checking user's group association: " . $conn->error;
    }
}

// Retrieve details of all groups
$allGroupsQuery = "SELECT g.group_id, g.group_name, g.no_of_members, s1.station_name AS source_name, s2.station_name AS destination_name, f.fare
                   FROM group_table g
                   JOIN station s1 ON g.source_id = s1.station_id
                   JOIN station s2 ON g.destination_id = s2.station_id
                   JOIN fare f ON g.fare_id = f.fare_id";
$allGroupsResult = $conn->query($allGroupsQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Group Joining</title>
    <link rel="stylesheet" href="./style/dash.css">
    <link rel="stylesheet" href="./style/stylesum.css">
    <style>
        button{
            background-color:blue;
            color: white;
        }
        input[type="text"]{
            border-radius: 15px;
            border:2px;
            height: 30px;
        }
    </style>
</head>
<body>
    <h1><center>FARE FRIENDLY STUDENT PASS ORGANIZER</center></h1>
    <div class="topnav">
        <a href="userdashboard.php">Home</a>
        <a href="view_members.php">View </a>
        <a href="logout.php" class="right">Logout</a>
    </div>
    <div class="container">
    <h2>Join a Group</h2>

    <!-- Search Bar -->
    <label for="stationName">Search Groups by Station:</label>
    <input type="text" id="stationName" name="stationName" placeholder= "Search"onkeyup="searchGroups()">
    <div id="groupResults">
        <?php
        if ($allGroupsResult && $allGroupsResult->num_rows > 0) {
            while ($row = $allGroupsResult->fetch_assoc()) {
                echo "<div class='group'>";
                echo "<h3>Group Name: " . $row['group_name'] . "</h3>";
                echo "<p>Source: " . $row['source_name'] . "|";
                echo "Destination: " . $row['destination_name'] . "|";
                echo "Fare: ₹" . $row['fare'] . "|";
                echo "Members: " . $row['no_of_members'] . "/5";
                echo "<form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>";
                echo "<input type='hidden' name='groupId' value='" . $row['group_id'] . "'>";
                echo "<button type='submit' name='joinGroup'>Join Group</button>";
                echo "</form>";
                echo "</div>";
            }
        } else {
            echo "No groups found.";
        }
        ?>
    </div>
    </div>
    <script>
        function searchGroups() {
            var stationName = document.getElementById('stationName').value;

            // AJAX request to search for groups related to the entered station
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'search.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    document.getElementById('groupResults').innerHTML = xhr.responseText;
                }
            };
            xhr.send('searchStation=1&stationName=' + stationName);
        }
    </script>
</body>
</html>
