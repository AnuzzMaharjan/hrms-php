<?php
session_start();
require('connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response = array();

    if ($connection) {
        $role = 'user';

        $query = mysqli_prepare($connection, "SELECT * FROM login_info WHERE role = ?");
        mysqli_stmt_bind_param($query, 's', $role);
        mysqli_stmt_execute($query);
        $result = mysqli_stmt_get_result($query);

        try {
            if ($result) {
                if ($result->num_rows > 0) {
                    $data = array();
                    while ($row = $result->fetch_assoc()) {
                        $data[] = $row;
                    }
                    $response['success'] = true;
                    $response['data'] = $data;
                } else {
                    $response['success'] = false;
                    $response['error'] = 'No Records found';
                }
            } else {
                $response['success'] = false;
                $response['error'] = 'Error fetching data';
            }
        } catch (Exception $e) {
            $response['success'] = false;
            $response['error'] = 'Error: ' . $e->getMessage();
        }
    } else {
        $response['success'] = false;
        $response['error'] = 'Database connection error';
    }

    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
}
