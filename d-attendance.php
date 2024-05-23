<?php
session_start();
require('connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['date'], $data['time'])) {

        $userid = $_SESSION['userid'];
        $date = DateTime::createFromFormat('m/d/Y', $data['date']);
        $formattedDate = $date->format('Y/m/d');
        $time = date('H:i', strtotime($data['time']));
        $status = $data['status'];

        $checkQuery = mysqli_prepare($connection, "SELECT * FROM attendance WHERE User_id = ? AND Date = ? AND Status = ?");
        mysqli_stmt_bind_param($checkQuery, 'iss', $userid, $formattedDate, $status);
        mysqli_stmt_execute($checkQuery);
        mysqli_stmt_store_result($checkQuery);

        if (mysqli_stmt_num_rows($checkQuery) > 0) {
            echo json_encode([
                'success' => false,
                'message' => 'Attendance cannot be done twice in a day!!'
            ]);
        } else {
            $insert_query = mysqli_prepare($connection, "INSERT INTO attendance (User_id,date,time,status) VALUES (?,?,?,?)");
            mysqli_stmt_bind_param($insert_query, "ssss", $userid, $formattedDate, $time, $status);
            mysqli_stmt_execute($insert_query);

            if (mysqli_stmt_affected_rows($insert_query) > 0) {
                echo json_encode([
                    "success" => true,
                    "message" => "Recorded Successfully!!"
                ]);
            } else {
                echo json_encode(array("success" => false, "message" => "Failed to record attendance."));
            }
        }
    } else {
        echo json_encode(array("success" => false, "message" => "Missing date or time!"));
    }
} else {
    echo json_encode(array("success" => false, "message" => "Invalid request method!"));
}
