<?php
session_start();
require('connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response = array();

    if ($connection) {

        $query =  "SELECT * FROM leave_form ";
        $result = mysqli_query($connection, $query);

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
