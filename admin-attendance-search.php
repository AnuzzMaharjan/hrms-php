<?php
session_start();
require('./connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response = array(); // Initialize an array for the response data

    // Fetch all records if userId is null or 0
    if (isset($_POST['userId']) && !empty($_POST['userId'] && $_POST['userId'] != 0)) {
        $userId = $_POST['userId'];
        $query = "SELECT * FROM attendance WHERE User_id = $userId";
    } else {
        $query = "SELECT * FROM attendance";
    }

    if ($connection) {
        try {
            $result = $connection->query($query);

            if ($result->num_rows > 0) {
                $data = array(); // Initialize an array for the fetched data

                while ($row = $result->fetch_assoc()) {
                    $data[] = $row; // Add each row to the data array
                }

                $response['data'] = $data; // Set the data array in the response
            } else {
                $response['error'] = 'No records found';
            }
        } catch (Exception $e) {
            $response['error'] = 'Error: ' . $e->getMessage();
        }
    } else {
        $response['error'] = 'Database connection error';
    }

    // Return the response as JSON
    header('Content-Type: application/json');
    echo json_encode($response);
    exit(); // Terminate script after sending JSON response
}
