<?php
require('connection.php');

$jsonData = file_get_contents('php://input');

$data = json_decode($jsonData, true);

if ($data) {
    $userId = isset($data['userId']) ? $data['userId'] : '';
    $date = isset($data['date']) ? $data['date'] : '';
    $time = isset($data['time']) ? $data['time'] : '';
    $status = isset($data['status']) ? $data['status'] : '';

    $query = mysqli_prepare($connection, "DELETE FROM attendance WHERE User_id = ? AND Date = ? AND Time = ? AND Status = ?");
    mysqli_stmt_bind_param($query, 'isss', $userId, $date, $time, $status);
    if (mysqli_stmt_execute($query)) {
        echo json_encode([
            'success' => true,
            'message' => 'Record deleted successfully'
        ]);
    } else {
        echo json_encode([
            'message' => 'Record failed to delete'
        ]);
    }
} else {
    echo json_encode([
        'Error' => 'Error parsing JSON data'
    ]);
}
