<?php

require('connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jsondata = json_decode(file_get_contents('php://input'), true);

    if ($jsondata !== null) {
        $validity = $jsondata['validity'];
        $position = $jsondata['position'];
        $contact = $jsondata['contact'];

        if ($connection) {
            try {
                $query = mysqli_prepare($connection, "DELETE FROM recruitment WHERE Validity = ? AND Position = ? AND Contact_Address = ?");
                mysqli_stmt_bind_param($query, 'sss', $validity, $position, $contact);
                if (mysqli_stmt_execute($query)) {
                    echo json_encode([
                        'success' => true,
                        'message' => 'Recruit notice removed successfully!!'
                    ]);
                } else {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Query Execution failed!!'
                    ]);
                }
            } catch (Exception $e) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Error: ' . $e->getMessage()
                ]);
            }
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Database connection error'
            ]);
        }
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Invalid JSON data'
        ]);
    }
}
