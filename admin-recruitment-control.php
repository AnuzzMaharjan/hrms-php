<?php
session_start();

require('connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    $validity = $data['validity'];
    $position = $data['position'];
    $contact = $data['contact'];

    $selectQuery = mysqli_prepare($connection, "SELECT * FROM recruitment WHERE Validity = ? AND Position = ? AND Contact_Address = ?");
    mysqli_stmt_bind_param($selectQuery, 'sss', $validity, $position, $contact);
    mysqli_stmt_execute($selectQuery);
    $result = mysqli_stmt_get_result($selectQuery);
    if (mysqli_num_rows($result) > 0) {
        echo json_encode([
            'success' => false,
            'message' => 'Recruitment already exists'
        ]);
    } else {
        $query = mysqli_prepare($connection, "INSERT INTO recruitment(Validity,Position,Contact_Address) VALUES (?,?,?)");
        mysqli_stmt_bind_param($query, 'sss', $validity, $position, $contact);
        if (mysqli_stmt_execute($query)) {
            echo json_encode([
                'success' => true,
                'message' => 'Recuitment published!!'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Query execution failed!'
            ]);
        }
    }
}
