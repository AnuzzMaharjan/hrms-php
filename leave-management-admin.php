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
    <title>Leave Management - Admin</title>
    <link rel="stylesheet" href="./style/adminLeaveManagement.css">
    <script src="admin-leave-form.js"></script>
</head>

<body>
    <div class="leave-form-div">
        <section>
            <div id="leaveForm">


            </div>
        </section>
    </div>
</body>

</html>