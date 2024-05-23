<?php
session_start();
if (!isset($_SESSION['userid'])) {
    echo "<script type='text/javascript'>alert('Please Login first!!');window.location='loginSignup.php';</script>";
}

require('connection.php');
require('navbar.php');
require('sidebar.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance</title>
    <link rel="stylesheet" href="./style/attendance.css">
</head>

<body>
    <div class="container">
        <section class="attendance">
            <?php
            $userId = $_SESSION['userid'];
            try {
                $query = mysqli_prepare($connection, "SELECT Date,Time,Status FROM attendance WHERE User_id = ?");
                mysqli_stmt_bind_param($query, "s", $userId);
                mysqli_stmt_execute($query);
                $result = mysqli_stmt_get_result($query);

                if (mysqli_num_rows($result) > 0) {
                    echo '<table border=1 class="attendance-table">';
                    echo '<tr>';
                    echo  '<th>Date</th>';
                    echo  '<th>Time</th>';
                    echo  '<th>Status</th>';
                    echo '</tr>';
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td>' . $row['Date'] . '</td>';
                        echo '<td>' . $row['Time'] . '</td>';
                        echo '<td>' . $row['Status'] . '</td>';
                        echo '</tr>';
                    }
                    echo '</table>';
                } else {
                    echo '<table class="attendance-table">';
                    echo '<tr>';
                    echo  '<th>Date</th>';
                    echo  '<th>Time</th>';
                    echo  '<th>Status</th>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td colspan=3 rowspan=2>No record found!</td>';
                    echo '</tr>';
                    echo '</table>';
                }
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
            ?>
        </section>
    </div>
</body>

</html>