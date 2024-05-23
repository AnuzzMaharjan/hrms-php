<?php
// admin@hrm.com
//admin123

require('connection.php');

$email  = $_POST["email"];
$password = $_POST["password"];

//prevent sql injection using prepared statements
//select email
$query = mysqli_prepare($connection, "SELECT User_id,Username,Email,Password,role FROM login_info WHERE Email = ?");
mysqli_stmt_bind_param($query, "s", $email);
mysqli_stmt_execute($query);
$result = mysqli_stmt_get_result($query);

//verifying email 
if (mysqli_num_rows($result) == 1) {

    $row = mysqli_fetch_assoc($result);
    $db_Userid = $row['User_id'];
    $db_username = $row['Username'];
    $db_email = $row['Email'];
    $db_password = $row['Password'];
    $db_role = $row['role'];


    //verify input password against hashed password 
    if (password_verify($password, $db_password)) {

        session_start();
        $_SESSION['userid'] = $db_Userid;
        $_SESSION['email'] = $db_email;
        $_SESSION['role'] = $db_role;

        session_regenerate_id(true);

        if ($_SESSION['role'] == 'user') {
            $_SESSION['user_username'] = $db_username;
            header("Location:dashboard.php");
            exit;
        } else if ($_SESSION['role'] == 'admin') {
            $_SESSION['admin_username'] = $db_username;
            header("Location:dashboard-admin.php");
            exit;
        } else {
            echo "<script type='text/javascript'>alert('Something went wrong. Please contact the administrator!!');window.location = 'loginSignup.php';</script>";
            exit;
        }
    } else {
        //password incorrect
        mysqli_stmt_close($query);
        mysqli_close($connection);

        echo "<script type='text/javascript'>alert('Incorrect Email or password ');window.location = 'loginSignup.php';</script>";
        exit;
    }
    //no else because there will be password for every email    
} else {
    //user not found in database
    echo "<script type='text/javascript'>alert('Incorrect Email or password');window.location='loginSignup.php';</script>";
    exit;
}
mysqli_stmt_close($query);
mysqli_close($connection);
