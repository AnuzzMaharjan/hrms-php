<?php
require('connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($connection) {
        $response = array();

        $query = "SELECT * FROM recruitment";
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
                    $response['error'] = 'No record found';
                }
            } else {
                $respond['success'] = false;
                $respond['error'] = 'Error fetching data';
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
