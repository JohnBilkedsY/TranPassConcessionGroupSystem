<?php
include 'config.php';

// Fetch groups from the database
$sql = "SELECT g.*, s1.station_name AS source_name, s2.station_name AS destination_name, f.fare
        FROM group_table g
        INNER JOIN station s1 ON g.source_id = s1.station_id
        INNER JOIN station s2 ON g.destination_id = s2.station_id
        INNER JOIN fare f ON g.fare_id = f.fare_id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Group Management</title>
    <link rel="stylesheet" href="./style/stylesum.css">
    <link rel="stylesheet" href="./style/dash.css">
</head>
<body>
<h1><center>FARE FRIENDLY STUDENT PASS ORGANIZER</center></h1>
<div class="topnav">
    <a href="admindashboard.php">Home</a>
    <a href="adminlog.php" class="right">logout</a>  
</div>
<div class="container">
    <h1>Group Management</h1>
    <input type="text" id="search" placeholder="Search by group name...">
    <div id="groupResults"></div>
    <table>
        <thead>
            <tr>
                <th>Group ID</th>
                <th>Group Name</th>
                <th>No. of Members</th>
                <th>Source</th>
                <th>Destination</th>
                <th>Fare</th>
                <th>Created Date</th>
                <th>Approved Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$row['group_id']."</td>";
                    echo "<td>".$row['Group_name']."</td>";
                    echo "<td>".$row['no_of_members']."</td>";
                    echo "<td>".$row['source_name']."</td>";
                    echo "<td>".$row['destination_name']."</td>";
                    echo "<td>".$row['fare']."</td>";
                    echo "<td>".$row['createddate']."</td>";
                    echo "<td>".$row['approveddate']."</td>";
                    echo "<td>".$row['status']."</td>";
                    echo "<td><a href='edit_group.php?id=".$row['group_id']."'>Edit</a> | <a href='delete_group.php?id=".$row['group_id']."'>Delete</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='10'>No groups found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<script>
    function searchGroups() {
        var searchTerm = document.getElementById('search').value;

        // AJAX request to search for groups based on the entered group name
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'search_groups.php?searchTerm=' + searchTerm, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                document.getElementById('groupResults').innerHTML = xhr.responseText;
            }
        };
        xhr.send();
    }
</script>
</body>
</html>
