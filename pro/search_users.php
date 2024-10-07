<?php
// Include the database configuration file
require_once 'config.php';

// Check if the search term is set
if (isset($_GET['searchTerm'])) {
    // Get the search term from the AJAX request
    $searchTerm = $_GET['searchTerm'];

    // SQL query to search for users with stud_deptno similar to the search term
    $sql = "SELECT * FROM users WHERE stud_deptno LIKE '%$searchTerm%'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        echo '<tbody>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row["stud_deptno"] . '</td>';
            echo '<td>' . $row["email"] . '</td>';
            echo '<td>' . $row["stud_name"] . '</td>';
            echo '<td>' . $row["dept_name"] . '</td>';
            echo '<td>' . $row["phone"] . '</td>';
            echo '<td>' . $row["dob"] . '</td>';
            echo '<td>' . $row["location"] . '</td>';
            echo '<td>' . $row["gender"] . '</td>';
            echo '<td>' . $row["group_id"] . '</td>';
            echo '<td>';
            echo "<td><a href='edit_user.php?id=".$row['stud_deptno']."'>Edit</a>  <a href='delete_user.php?id=".$row['stud_deptno']."'>Delete</a></td>";
            echo '</td>';
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
