<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/navbar.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script>
        function destroy() {
            window.location.href = 'destroySession.php'
        }
    </script>
</head>

<body>

</body>
<nav class="sticky">
    <div>
        <a href="dashboard.php">
            <p class="disableCaret">Human Resource Management</p>
        </a>
        <div class="logout" onclick="destroy()">
            <span>Log Out</span>
            <i class='bx bx-log-out'></i>
        </div>
    </div>

</nav>
</body>

</html>