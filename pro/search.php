<?php
require_once "config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['searchStation'])) {
    $stationName = $_POST['stationName'];

    // Check if the station exists
    $checkStationQuery = "SELECT station_id FROM station WHERE station_name LIKE '%$stationName%'";
    $checkStationResult = $conn->query($checkStationQuery);

    if ($checkStationResult->num_rows > 0) {
        // Station found, retrieve its ID
        $station = $checkStationResult->fetch_assoc();
        $stationId = $station['station_id'];

        // Retrieve all groups related to the station
        $relatedGroupsQuery = "SELECT g.group_id, g.group_name, g.no_of_members, s1.station_name AS source_name, s2.station_name AS destination_name, f.fare
                               FROM group_table g
                               JOIN station s1 ON g.source_id = s1.station_id
                               JOIN station s2 ON g.destination_id = s2.station_id
                               JOIN fare f ON g.fare_id = f.fare_id
                               WHERE g.destination_id = $stationId";
        $relatedGroupsResult = $conn->query($relatedGroupsQuery);

        if ($relatedGroupsResult->num_rows > 0) {
            // Output the group details
            while ($group = $relatedGroupsResult->fetch_assoc()) {
                echo "<div class='group'>";
                echo "<h3>Group Name: " . $group['group_name'] . "</h3>";
                echo "<p>Source: " . $group['source_name'] . "|";
                echo "Destination: " . $group['destination_name'] . "|";
                echo "Fare: $" . $group['fare'] . "|";
                echo "Members: " . $group['no_of_members'] . "/5";
                echo "<form method='post' action='joingrouppage.php'>";
                echo "<input type='hidden' name='groupId' value='" . $group['group_id'] . "'>";
                echo "<button type='submit' name='joinGroup'>Join Group</button>";
                echo "</form>";
                echo "</div>";
            }
        } else {
            echo "No groups found for the station.";
        }
    } else {
        echo "Station not found.";
    }
}
?>
