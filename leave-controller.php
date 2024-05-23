<?php
session_start();

require("connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['Date']) && isset($data['Time']) && isset($data['Subject']) && isset($data['Description'])) {
        $userId = $_SESSION['userid'];
        $date = DateTime::createFromFormat('m/d/Y', $data['Date']);
        $formattedDate = $date ? $date->format('Y-m-d') : null;
        $time = date('H:i', strtotime($data['Time']));
        $subject = $data['Subject'];
        $description = $data['Description'];


        if ($formattedDate && $time) {
            $selectQuery = mysqli_prepare($connection, 'SELECT * FROM leave_form WHERE User_id = ? AND Date = ? AND Time = ? AND Subject=? AND Description=?');
            mysqli_stmt_bind_param($selectQuery, 'issss', $userId, $formattedDate, $time, $subject, $description);
            mysqli_stmt_execute($selectQuery);
            $result = mysqli_stmt_get_result($selectQuery);
            if (mysqli_num_rows($result) > 0) {
                $response = [
                    'success' => false,
                    'message' => 'Record already exists'
                ];
            } else {
                $query = mysqli_prepare($connection, 'INSERT INTO leave_form (User_id,Date,Time,Subject,Description) VALUES (?,?,?,?,?)');
                mysqli_stmt_bind_param($query, 'issss', $userId, $formattedDate, $time, $subject, $description);
                if (mysqli_stmt_execute($query)) {
                    $response = [
                        'success' => true,
                        'message' => 'Record inserted successfully!'
                    ];
                } else {
                    $error = mysqli_error($connection);
                    $response = [
                        'success' => false,
                        'message' => 'Error inserting record: ' . $error
                    ];
                }
            }
        } else {
            $response = [
                'success' => false,
                'message' => 'Invalid date or time format!'
            ];
        }
    } else {
        $response = [
            'success' => false,
            'message' => 'Incomplete JSON data'
        ];
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}
