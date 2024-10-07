<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Station Management</title>
<link rel="stylesheet" href="./style/stylesMs.css">
<link rel="stylesheet" href="./style/dash.css">
</head>
<body>
<h1><center>FARE FRIENDLY STUDENT PASS ORGANISER</center></h1>
  <div class="topnav">
    <a href="admindashboard.php">Home</a>
    <a href="adminlog.php" class="right">logout</a>
  </div>
<div class="container">
    <h1>Station Management</h1>
    <!-- Search bar -->
    <input type="text" id="searchInput" placeholder="Search by Station Name">
    <table id="stationTable">
        <thead>
            <tr>
                <th>Station ID</th>
                <th>Station Name</th>
                <th>Direction</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php include 'fetch_stations.php'; ?>
        </tbody>
    </table>
    <form action="insert_station.php" method="POST">
        <input type="text" name="station_id" placeholder="Station ID" required>
        <input type="text" name="station_name" placeholder="Station Name" required>
        <input type="text" name="direction" placeholder="Direction" required>
        <button type="submit">Add Station</button>
    </form>
</div>

<script>
// Function to handle search
function searchStations() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("stationTable");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[1]; // Index 1 is for station name
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}

// Event listener for search input
document.getElementById("searchInput").addEventListener("keyup", function() {
    var input = this.value.toUpperCase();
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            document.getElementById("stationTable").innerHTML = this.responseText;
        }
    };
    xhr.open("GET", "search_stations.php?search=" + input, true);
    xhr.send();
});
</script>

</body>
</html>
