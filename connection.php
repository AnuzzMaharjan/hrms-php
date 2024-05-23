<?php
$serverName = "localhost";
$userName = "root";
$password = "root";
$database = "hrm";

$connection = new mysqli($serverName, $userName, $password, $database);

if ($connection->connect_error) {
    die("Failed to connect!: " . $connection->connect_error);
}
