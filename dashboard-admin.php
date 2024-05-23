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
    <title>HRM-Admin</title>
    <link rel="stylesheet" href="style/dashboardAdmin.css">
    <script src="admin-user-details.js"></script>

</head>

<body>
    <div class="user-div">
        <section>
            <div id="user-details">

            </div>
        </section>
    </div>
</body>

</html>