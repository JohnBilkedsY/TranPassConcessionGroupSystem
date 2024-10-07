<?php
include_once "config.php";

$query = "SELECT * FROM fare";
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>".$row['fare_id']."</td>";
    echo "<td>".$row['fare']."</td>";
    echo "<td>".$row['no_of_stations']."</td>";
    echo "<td><a href='edit_fare.php?id=".$row['fare_id']."'>Edit</a>  |  <a href='delete_fare.php?id=".$row['fare_id']."'>Delete</a></td>";
    echo "</tr>";
}

mysqli_close($conn);
?>
