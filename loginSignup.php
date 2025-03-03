<?php
require('popup.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="style/loginSignup.css">
    <script src="loginSignup.js"></script>
</head>

<body>
    <section class="login-section">
        <h1 class="disableCaret">Human Resource Management</h1>
        <div class="loginSignupContainer">
            <div class="loginContainer">
                <div class="login disableCaret" id="loginDiv">
                    <h3>Login</h3>
                    <form action="login.php" method="post" enctype="multipart/form-data">
                        <label for="email" class=" disableCaret">Email:</label><br>
                        <input type="email" name="email" class="email-input" placeholder="example@gmail.com" required><br>
                        <label for="password" class=" disableCaret">Password:</label><br>
                        <input type="password" name="password" class="password-input" placeholder="********" autocomplete><br>
                        <input type="submit" class="submit-btn primary">
                        <p id="register" class="disableCaret" style="cursor: pointer;">Register?</p>
                        <script>
                            document.getElementById('register').addEventListener("click", () => {
                                document.getElementById('loginDiv').style.transform = "translateX(-600px)";
                                document.getElementById('signUpDiv').style.transform = "translateX(-600px)";
                            });
                        </script>
                    </form>

                </div>
                <div class="signUp disableCaret" id="signUpDiv">
                    <h3 class="disableCaret">SignUp</h3>
                    <form id="signup-form">
                        <label for="userName" class="disableCaret">UserName:</label>
                        <input type="text" name="userName" placeholder="abc123" id="username-input" required>
                        <label for="email" class=" disableCaret">Email:</label><br>
                        <input type="email" name="email" id="email-input" placeholder="example@gmail.com" required><br>
                        <label for="password" class="disableCaret">Password:</label><br>
                        <input type="password" name="password" id="password-input" placeholder="********" autocomplete required><br>
                        <input type="submit" class="submit-btn primary">
                    </form>
                    <p id="login" class="disableCaret" style="cursor: pointer;">Login?</p>
                    <script>
                        document.getElementById('login').addEventListener("click", () => {
                            document.getElementById('signUpDiv').style.transform = "translateX(0px)";
                            document.getElementById('loginDiv').style.transform = "translateX(0px)";
                        });
                    </script>
                </div>
            </div>
        </div>
    </section>
</body>

</html>                                                                                                                 