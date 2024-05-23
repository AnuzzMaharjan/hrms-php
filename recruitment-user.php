<?php
session_start();
if (!isset($_SESSION['userid'])) {
    echo "<script type='text/javascript'>alert('Please Login first!!');window.location='loginSignup.php';</script>";
}

require('navbar.php');
require('sidebar.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Management</title>
    <link rel="stylesheet" href="./style/recruitment.css">
    <script src="recruitment-user.js"></script>
</head>

<body>
    <div class="recruitment-div">
        <section>
            <div id="recruitment-details">

            </div>
        </section>
    </div>
</body>