<?php
require('connection.php');

$jsonData = file_get_contents("php://input");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode($jsonData, true);

    if ($data) {
        $formId = isset($data['formId']) ? $data['formId'] : '';

        $query = mysqli_prepare($connection, "DELETE FROM leave_form WHERE SN= ? ");
        mysqli_stmt_bind_param($query, 'i', $formId);

        if (mysqli_stmt_execute($query)) {
            $response = [
                'success' => true,
                'message' => 'record deleted successfully'
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'record deletion failed'
            ];
        }
    } else {
        $response = [
            'success' => false,
            'message' => 'Error parsing JSON data'
        ];
    }
    header('Content-Type:application/json');
    echo json_encode($response);
    exit();
}
