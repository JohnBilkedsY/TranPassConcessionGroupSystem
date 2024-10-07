<?php
include 'config.php';

// Check if the search term is set
if (isset($_GET['searchTerm'])) {
    // Get the search term from the AJAX request
    $searchTerm = $_GET['searchTerm'];

    // SQL query to search for groups with group_name similar to the search term
    $sql = "SELECT g.*, s1.station_name AS source_name, s2.station_name AS destination_name, f.fare
            FROM group_table g
            INNER JOIN station s1 ON g.source_id = s1.station_id
            INNER JOIN station s2 ON g.destination_id = s2.station_id
            INNER JOIN fare f ON g.fare_id = f.fare_id
            WHERE g.Group_name LIKE '%$searchTerm%'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        echo '<tbody>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row["group_id"] . '</td>';
            echo '<td>' . $row["group_name"] . '</td>';
            echo '<td>' . $row["no_of_members"] . '</td>';
            echo '<td>' . $row["source_name"] . '</td>';
            echo '<td>' . $row["destination_name"] . '</td>';
            echo '<td>' . $row["fare"] . '</td>';
            echo '<td>' . $row["createddate"] . '</td>';
            echo '<td>' . $row["approveddate"] . '</td>';
            echo '<td>' . $row["status"] . '</td>';
            echo '<td><a href="edit_group.php?id=' . $row["group_id"] . '">Edit</a> | <a href="delete_group.php?id=' . $row["group_id"] . '">Delete</a></td>';
            echo '</tr>';
        }
        echo '</tbody>';
    } else {
        echo '<tbody><tr><td colspan="10">No results found</td></tr></tbody>';
    }

    // Close the database connection
    $conn->close();
} else {
    echo 'Invalid request';
}
?>
