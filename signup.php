<?php
require('connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    $userName = isset($data['username']) ? $data['username'] : '';
    $email = isset($data['email']) ? $data['email'] : '';

    if ($connection) {
        if ($userName && $email && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            //prepared statements
            $check_query_userName = mysqli_prepare($connection, "SELECT Username FROM login_info WHERE Username = ?");
            mysqli_stmt_bind_param($check_query_userName, "s", $userName);
            mysqli_stmt_execute($check_query_userName);
            mysqli_stmt_store_result($check_query_userName);

            $check_query_email = mysqli_prepare($connection, "SELECT Email FROM login_info WHERE Email = ?");
            mysqli_stmt_bind_param($check_query_email, "s", $email);
            mysqli_stmt_execute($check_query_email);
            mysqli_stmt_store_result($check_query_email);
            //check number of rows returned
            if (mysqli_stmt_num_rows($check_query_userName) > 0) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Username already exists'
                ]);
                exit;
            }
            if (mysqli_stmt_num_rows($check_query_email) > 0) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Email already exists'
                ]);
                exit;
            } else {
                $password = password_hash(isset($data['password']) ? $data['password'] : '', PASSWORD_DEFAULT);
                $role = "user";


                $insertQuery = mysqli_prepare($connection, "INSERT INTO login_info (Username,Email,Password,role) VALUES (?,?,?,?)");
                mysqli_stmt_bind_param($insertQuery, "ssss", $userName, $email, $password, $role);
                mysqli_stmt_execute($insertQuery);

                if (mysqli_stmt_affected_rows($insertQuery) > 0) {
                    echo json_encode([
                        'success' => true,
                        'message' => 'Registration Successfull'
                    ]);
                    exit;
                } else {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Registration failed'
                    ]);
                    exit;
                }
            }

            mysqli_stmt_close($check_query_userName);
            mysqli_stmt_close($check_query_email);
            mysqli_stmt_close($insertQuery);
            mysqli_close($connection);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Empty Username or email'
            ]);
        }
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Database connection error'
        ]);
    }
}
