<?php
require('connection.php');

$jsonData = file_get_contents("php://input");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode($jsonData, true);

    if ($data) {
        $userId = isset($data['userId']) ? $data['userId'] : '';

        $query = mysqli_prepare($connection, "DELETE FROM login_info WHERE User_id = ?");
        mysqli_stmt_bind_param($query, 'i', $userId);

        if (mysqli_stmt_execute($query)) {
            echo json_encode([
                'success' => true,
                'message' => 'User deleted successfully'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'User deletion failed'
            ]);
        }
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Error parsing JSON data'
        ]);
    }
}
