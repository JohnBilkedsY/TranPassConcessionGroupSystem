<?php
include_once "config.php";

$query = "SELECT * FROM station";
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>".$row['station_id']."</td>";
    echo "<td>".$row['station_name']."</td>";
    echo "<td>".$row['direction']."</td>";

    echo "<td><a href='edit_station.php?id=".$row['station_id']."'>Edit</a> | <a href='delete_station.php?id=".$row['station_id']."'>Delete</a></td>";
    echo "</tr>";
}

mysqli_close($conn);
?>
