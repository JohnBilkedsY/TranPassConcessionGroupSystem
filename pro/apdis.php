<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Group Approval/Rejection</title>
    <link rel="stylesheet" href="./style/appdisap.css">
    <link rel="stylesheet" href="./style/dash.css">
</head>
<body>
    <h1><center>FARE FRIENDLY STUDENT PASS ORGANIZER</center></h1>
    <div class="topnav">
        <a href="admindashboard.php">Home</a>
        <a href="adminlog.php" class="right">Logout</a>
    </div>
    
    <div class="container">
        <h2>Group Approval/Rejection</h2>

        <!-- Filter by Status -->
        <form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="statusFilter">Filter by Status:</label>
            <select name="statusFilter" id="statusFilter">
                <option value="all">All</option>
                <option value="pending" <?php echo isset($_GET['statusFilter']) && $_GET['statusFilter'] == 'pending' ? 'selected' : ''; ?>>Pending</option>
                <option value="approved" <?php echo isset($_GET['statusFilter']) && $_GET['statusFilter'] == 'approved' ? 'selected' : ''; ?>>Approved</option>
                <option value="rejected" <?php echo isset($_GET['statusFilter']) && $_GET['statusFilter'] == 'rejected' ? 'selected' : ''; ?>>Rejected</option>
            </select>
            <button type="submit">Apply Filter</button>
        </form>

        <!-- Display Groups -->
        <?php
        require_once "config.php";
        session_start();
        
        // Process approval of group
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['approveGroup'])) {
            $groupId = $_POST['groupId'];
            $approvedDate = date("Y-m-d");
            $approveGroupQuery = "UPDATE group_table SET status = 'Approved', approveddate = '$approvedDate' WHERE group_id = $groupId";
            if ($conn->query($approveGroupQuery)) {
                echo "<script>alert('Group has been approved.')</script>";
            } else {
                echo "Error approving group: " . $conn->error;
            }
        }

        // Process rejection of group
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['rejectGroup'])) {
            $groupId = $_POST['groupId'];
            $rejectGroupQuery = "UPDATE group_table SET status = 'Rejected' WHERE group_id = $groupId";
            if ($conn->query($rejectGroupQuery)) {
                echo "<script>alert('Group has been rejected.')</script>";
            } else {
                echo "Error rejecting group: " . $conn->error;
            }
        }

        // Retrieve details of all groups based on status filter
        $statusFilter = isset($_GET['statusFilter']) ? $_GET['statusFilter'] : 'all';
        $statusCondition = $statusFilter != 'all' ? " WHERE status = '$statusFilter'" : '';
        $allGroupsQuery = "SELECT g.group_id, g.group_name, g.no_of_members, g.status, s1.station_name AS source_name, s2.station_name AS destination_name, f.fare
                           FROM group_table g
                           JOIN station s1 ON g.source_id = s1.station_id
                           JOIN station s2 ON g.destination_id = s2.station_id
                           JOIN fare f ON g.fare_id = f.fare_id
                           $statusCondition
                           ORDER BY g.no_of_members desc";
        $allGroupsResult = $conn->query($allGroupsQuery);

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
                if ($row['status'] == 'pending') {
                    echo "<button type='submit' name='approveGroup'>Approve</button>";
                    echo "<button type='submit' id='x' name='rejectGroup'>Reject</button>";
                } else {
                    echo "<p>Status: " . $row['status'] . "</p>";
                }
                echo "</form>";

                $groupMembersQuery = "SELECT u.stud_deptno, u.email, u.stud_name, u.dept_name, u.phone, u.dob, u.location, u.gender 
                                      FROM users u 
                                      WHERE u.group_id = " . $row['group_id'];
                $groupMembersResult = $conn->query($groupMembersQuery);
                if ($groupMembersResult && $groupMembersResult->num_rows > 0) {
                    echo "<table>";
                    echo "<tr><th>Student ID</th><th>Email</th><th>Name</th><th>Department</th><th>Phone</th><th>DOB</th><th>Location</th><th>Gender</th></tr>";
                    while ($memberRow = $groupMembersResult->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $memberRow['stud_deptno'] . "</td>";
                        echo "<td>" . $memberRow['email'] . "</td>";
                        echo "<td>" . $memberRow['stud_name'] . "</td>";
                        echo "<td>" . $memberRow['dept_name'] . "</td>";
                        echo "<td>" . $memberRow['phone'] . "</td>";
                        echo "<td>" . $memberRow['dob'] . "</td>";
                        echo "<td>" . $memberRow['location'] . "</td>";
                        echo "<td>" . $memberRow['gender'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<p>No members in this group.</p>";
                }

                echo "</div>";
            }
        } else {
            echo "No groups found.";
        }
        ?>
    </div>
</body>
</html>
