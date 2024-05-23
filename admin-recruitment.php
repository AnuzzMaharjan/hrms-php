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
    <title>Recruitment-Admin</title>
    <link rel="stylesheet" href="./style/adminRecruitment.css">
    <script src="admin-recruitment.js"></script>
</head>

<body>
    <div class="recruit-div">
        <section>
            <div id="recruitment-body">
                <form action="admin-recruitment-control.php" method="post" enctype="multipart/form-data" id="recruitForm">
                    <label for="validity">Valid till:</label>
                    <input type="date" name="validity" id="validity"><br>
                    <label for="position">Position:</label>
                    <input type="text" name="position" id="position"><br>
                    <label for="contact">Contact address:</label>
                    <input type="text" name="contact" id="contact"><br>
                    <input type="submit" value="Publish">
                </form>
            </div>
        </section>
        <section>
            <div class="recruit-board" id="recruitBoard">

            </div>
        </section>
    </div>
</body>

</html>