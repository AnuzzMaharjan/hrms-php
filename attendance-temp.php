<?php
session_start();
require('./connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (empty($_POST["userId"]) || $_POST["userId"] == 0) {
        if ($connection) {
            try {
                $query = "SELECT * FROM attendance";
                $result = $connection->query($query);


                if ($result->num_rows > 0) {
                    echo '<table border=1 class="attendance-table">';
                    echo '<tr>';
                    echo  '<th>User_id</th>';
                    echo  '<th>Date</th>';
                    echo  '<th>Time</th>';
                    echo  '<th>Status</th>';
                    echo '</tr>';
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $row['User_id'] . '</td>';
                        echo '<td>' . $row['Date'] . '</td>';
                        echo '<td>' . $row['Time'] . '</td>';
                        echo '<td>' . $row['Status'] . '</td>';
                        echo '</tr>';
                    }
                    echo '</table>';
                } else {
                    echo '<table class="attendance-table">';
                    echo '<tr>';
                    echo  '<th>User_id</th>';
                    echo  '<th>Date</th>';
                    echo  '<th>Time</th>';
                    echo  '<th>Status</th>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td colspan=3 rowspan=2>No record found!</td>';
                    echo '</tr>';
                    echo '</table>';
                }
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    } else {
        $userId = $_POST['userId'];

        if ($connection) {
            try {
                $query = "SELECT * FROM attendance WHERE User_id = $userId";
                $result = $connection->query($query);


                if ($result->num_rows > 0) {
                    echo '<table border=1 class="attendance-table">';
                    echo '<tr>';
                    echo  '<th>User_id</th>';
                    echo  '<th>Date</th>';
                    echo  '<th>Time</th>';
                    echo  '<th>Status</th>';
                    echo '</tr>';
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $row['User_id'] . '</td>';
                        echo '<td>' . $row['Date'] . '</td>';
                        echo '<td>' . $row['Time'] . '</td>';
                        echo '<td>' . $row['Status'] . '</td>';
                        echo '</tr>';
                    }
                    echo '</table>';
                } else {
                    echo '<table class="attendance-table">';
                    echo '<tr>';
                    echo  '<th>User_id</th>';
                    echo  '<th>Date</th>';
                    echo  '<th>Time</th>';
                    echo  '<th>Status</th>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td colspan=3 rowspan=2>No user record found!</td>';
                    echo '</tr>';
                    echo '</table>';
                }
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }
}
