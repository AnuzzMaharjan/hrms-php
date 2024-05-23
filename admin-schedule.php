<?php
session_start();
if (!isset($_SESSION['admin_username'])) {
    echo "<script type='text/javascript'>alert('Please Login first!!');window.location='loginSignup.php';</script>";
}

require('navbar-admin.php');
require('admin-sidebar.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin-schedule</title>
    <link rel="stylesheet" href="style/scheduleAdmin.css">

</head>

<body>
    <div class="schedule-div">
        <section>
            <div id="schedule-details">
                <form id="schedule" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <label for="schedule">Create Schedule:</label><br>
                    <textarea name="schedule"></textarea><br>
                    <input type="submit" value="Publish">
                </form>
            </div>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $content = htmlspecialchars($_POST['schedule']);

                $filename = "./schedule/schedule.txt";
                $file = fopen($filename, "w") or die("Unable to open file");

                fwrite($file, $content);

                fclose($file);

                echo "<script type='text/javascript'>alert('Schedule updated');</script>";
            }
            ?>
        </section>
    </div>
</body>