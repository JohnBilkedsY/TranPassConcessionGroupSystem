<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Group Members</title>
    <link rel="stylesheet" href="./style/dash.css">
    <style>
    table {
        width: 50%;
        border-collapse: collapse;
    }
    
    table, th, td {
        border: 1px solid #ddd;
    }
    
    th, td {
        padding: 8px;
        text-align: left;
    }
    
    th {
        background-color: #f2f2f2;
    }
    </style>
</head>
<H1><center>FARE FRIENDLY STUDENT PASS ORGANISER</center></H1>
<body>
    <div class="topnav">
        <a href="userdashboard.php">Home</a>
        <a href="logout.php" class="right">Logout</a>
    </div>

    <?php
    require_once "config.php";
    session_start();

    // Check if user is logged in
    if(isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];

        // Fetch the group_id of the logged-in user from the database
        $fetchGroupIdQuery = "SELECT group_id FROM users WHERE stud_deptno = '$userId'";
        $groupResult = $conn->query($fetchGroupIdQuery);
        
        if ($groupResult->num_rows > 0) {
            $row = $groupResult->fetch_assoc();
            $groupId = $row['group_id'];
            if($groupId==NULL){
                header("Location: joingrouppage.php");
                exit();
            }
            // Fetch group details
            $groupDetailsQuery = "SELECT g.group_name, s1.station_name AS source_name, s2.station_name AS destination_name, f.fare
                                  FROM group_table g
                                  INNER JOIN station s1 ON g.source_id = s1.station_id
                                  INNER JOIN station s2 ON g.destination_id = s2.station_id
                                  INNER JOIN fare f ON g.fare_id = f.fare_id
                                  WHERE g.group_id = $groupId";
            $groupDetailsResult = $conn->query($groupDetailsQuery);

            // Display group details
            if ($groupDetailsResult->num_rows > 0) {
                $groupDetails = $groupDetailsResult->fetch_assoc();
                echo "<h2>Group Details:</h2>";
                echo "<p><strong>Group Name:</strong> " . $groupDetails["group_name"] . "</p>";
                echo "<p><strong>Source:</strong> " . $groupDetails["source_name"] . "</p>";
                echo "<p><strong>Destination:</strong> " . $groupDetails["destination_name"] . "</p>";
                echo "<p><strong>Fare: </strong> ₹" . $groupDetails["fare"] . "</p>";
            } else {
                echo "<p>Group details not found.</p>";
            }

            // Fetch members of the selected group from the database
            $fetchMembersQuery = "SELECT * FROM users WHERE group_id = $groupId";
            $result = $conn->query($fetchMembersQuery);

            // Display members of the group in a table
            if ($result->num_rows > 0) {
                echo "<h2>Members of Your Group:</h2>";
                echo "<table>";
                echo "<tr><th>Name</th><th>Department</th><th>Email</th><th>Location</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["stud_name"] . "</td>";
                    echo "<td>" . $row["dept_name"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["location"] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No members found in your group.</p>";
            }

            // Add a print button
            
            echo "<a href='pdf1.php?group_id=$groupId' target='_blank'>Print</a>";
        } else {
            echo "<p>Group ID not found for the logged-in user.</p>";
        }
    } else {
        // Redirect back to the join group page if user is not logged in
        header("Location: login.php");
        exit();
    }
    ?>
</body>
</html>
