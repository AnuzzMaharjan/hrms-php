<?php
session_start();
session_destroy();

header("Cache-Control: no-cache, must-revalidate"); // HTTP 1.1
header("Pragma: no-cache"); // HTTP 1.0
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

echo "<script>window.location='loginSignup.php';</script>";
exit;
