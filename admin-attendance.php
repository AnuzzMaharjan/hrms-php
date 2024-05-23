<?php
session_start();
if (!isset($_SESSION['admin_username'])) {
    echo "<script type='text/javascript'>alert('Please Login first!!');window.location='loginSignup.php';</script>";
}
require('navbar-admin.php');
require('admin-sidebar.php');
require('popup.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance - Admin</title>
    <link rel="stylesheet" href="./style/attendanceAdmin.css">
    <link rel="stylesheet" href="./style/attendance.css">
    <script src="admin-attendance-record.js"></script>
</head>

<body>
    <div class="admin-attendance">
        <section class="searchBar">
            <form action="admin-attendance-search.php" method="POST" enctype="multipart/form-data" id="search">
                <input type="number" placeholder="Search User_id" name="userId">
                <input type="submit" value="Search">
            </form>
        </section>
        <hr>
        <section>

            <div class="active" id="attendanceTable">

            </div>
        </section>
    </div>
</body>

</html>