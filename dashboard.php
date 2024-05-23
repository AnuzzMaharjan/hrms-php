<?php
session_start();
if (!isset($_SESSION['userid'])) {
    echo "<script type='text/javascript'>alert('Please Login first!!');window.location='loginSignup.php';</script>";
}

require('navbar.php');
require('sidebar.php');
require('popup.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HRM</title>
    <link rel="stylesheet" href="style/dashboard.css">
    <link rel="stylesheet" href="style/sidebar.css">
    <script src="dashboard.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    <div class="dashboard-section">
        <section class="hero">
            <div>
                <p>Welcome <?php echo $_SESSION['user_username'] ?></p>
            </div>
        </section>
        <section class="user-section">
            <div class="attendance">
                <div class="date-time">
                    <h4 id="date"></h4>
                    <h3 id="time"></h3>
                    <script>
                        $(document).ready(function() {
                            setInterval(function() {
                                const dateTime = new Date();
                                $('#date').text(dateTime.toLocaleDateString());
                                $('#time').text(dateTime.toLocaleTimeString());
                            }, 1000);
                        })
                    </script>
                </div>
                <button class="attend_button active" onclick="attend_in()">check-In</button>
                <button class="attend_button passive" onclick="attend_out()">check-Out</button>
            </div>
            <div class="schedule">
                <h5>Today's Schedule</h5>
                <div>
                    <div>
                        <?php
                        $file = fopen("./schedule/schedule.txt", "r");
                        if ($file) {
                            while (($line = fgets($file)) !== false) {
                                echo nl2br($line);
                            }
                            fclose($file);
                        } else {
                            echo "Unable to open file! Please contact the administrator!!";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </section>
    </div>

</body>

</html>