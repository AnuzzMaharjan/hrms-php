<?php
require('connection.php');

$jsonData = file_get_contents("php://input");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode($jsonData, true);

    if ($data) {
        $formId = isset($data['formId']) ? $data['formId'] : '';

        $query = mysqli_prepare($connection, "SELECT Subject,Description FROM leave_form WHERE SN=?");
        mysqli_stmt_bind_param($query, 'i', $formId);

        if (mysqli_stmt_execute($query)) {
            mysqli_stmt_bind_result($query, $subject, $description);

            mysqli_stmt_fetch($query);

            if ($formId) {
                echo json_encode([
                    'subject' => $subject,
                    'description' => $description
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'form deletion failed'
                ]);
            }
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Error parsing JSON data'
            ]);
        }
    }
}
