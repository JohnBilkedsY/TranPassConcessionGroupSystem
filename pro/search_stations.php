<?php
// Include the database configuration file
require_once 'config.php';

// Check if the search term is set
if (isset($_GET['search'])) {
    // Get the search term from the AJAX request
    $searchTerm = $_GET['search'];

    // SQL query to search for stations with names similar to the search term
    $sql = "SELECT * FROM station WHERE station_name LIKE '%$searchTerm%'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        echo '<tbody>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row["station_id"] . '</td>';
            echo '<td>' . $row["station_name"] . '</td>';
            echo '<td>' . $row["direction"] . '</td>';
            echo '<td>';
            echo "<td><a href='edit_station.php?id=".$row['station_id']."'>Edit</a> | <a href='delete_station.php?id=".$row['station_id']."'>Delete</a></td>";
            
            echo '</td>';
            echo '</tr>';
        }
        echo '</tbody>';
    } else {
        echo '<tbody><tr><td colspan="4">No results found</td></tr></tbody>';
    }

    // Close the database connection
    $conn->close();
} else {
    echo 'Invalid request';
}
?>
