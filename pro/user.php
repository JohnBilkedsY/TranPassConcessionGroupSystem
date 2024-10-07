<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Management</title>
<link rel="stylesheet" href="./style/stylesum.css">
<link rel="stylesheet" href="./style/dash.css">
</head>
<body>
<h1><center>FARE FRIENDLY STUDENT PASS ORGANIZER</center></h1>
  <div class="topnav">
    
    <a href="admindashboard.php">Home</a>
    <a href="admin.php" class="right">logout</a>
    
  </div>
<div class="container">
    <h1>User Management</h1>
    <input type="text" id="searchInput" placeholder="Search by stud_deptno...">
    <div id="userResults"></div>
    <table>
        <thead>
            <tr>
                <th>stud_deptno</th>
                <th>Email</th>
                <th>stud_name</th>
                <th>dept_name</th>
                <th>Phone</th>
                <th>DOB</th>
                <th>Location</th>
                <th>Gender</th>
                <th>Group</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php include 'fetch_users.php'; ?>
        </tbody>
    </table>
    <form action="insert_user.php" method="POST">
        <!-- Input fields for inserting new user data -->
        <input type="text" name="stud_deptno" placeholder="Dept_No" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="text" name="stud_name" placeholder="Student Name" required>
        <input type="text" name="dept_name" placeholder="Dept_Name" required>
        <input type="text" name="phone" placeholder="Phone" required>
        <input type="date" name="dob" required >
        <input type="text" name="location" placeholder="Location" required>
        <select name="gender" required>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select>
        <button type="submit">Add User</button>
    </form>
</div>
<script>
function searchUsers() {
    var searchTerm = document.getElementById('searchInput').value;

    // AJAX request to search for users based on the entered stud_deptno
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'search_users.php?searchTerm=' + searchTerm, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById('userResults').innerHTML = xhr.responseText;
        }
    };
    xhr.send();
}
</script>
</body>
</html>
