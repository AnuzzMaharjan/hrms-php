<?php
session_start();
if (!isset($_SESSION['userid'])) {
    echo "<script type='text/javascript'>alert('Please Login first!!');window.location='loginSignup.php';</script>";
}

require('navbar.php');
require('sidebar.php');
require('popup.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Management</title>
    <link rel="stylesheet" href="./style/leavemanagement.css">
</head>

<body>
    <div class="container">
        <section class="leaveManagement">
            <div class="leaveForm">
                <form action="leave-controller.php" method="POST" id="leaveForm">
                    <label for="subject">Subject:</label><br>
                    <input type="text" name="subject" id="subject"><br>
                    <label for="description">Description:</label><br>
                    <textarea name="description" id="description"></textarea><br>
                    <input type="submit">
                    <script>
                        var leaveForm = document.getElementById('leaveForm');
                        leaveForm.addEventListener("submit", function(event) {
                            event.preventDefault();

                            var dateTime = new Date();
                            var formData = new FormData(this);

                            var date = dateTime.toLocaleDateString();
                            var time = dateTime.toLocaleTimeString();
                            var subjectInput = document.getElementById('subject');
                            var subject = subjectInput.value;
                            var descriptionInput = document.getElementById('description');
                            var description = descriptionInput.value;
                            const popupContainer = document.getElementById('popupContainer');
                            popupContainer.style.display = 'block';

                            if (subject == '' || description == '') {
                                alert('Please fill all the fields!!');
                            } else {
                                const data = {
                                    Date: date,
                                    Time: time,
                                    Subject: formData.get('subject'),
                                    Description: formData.get('description')
                                }
                                fetch('leave-controller.php', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json'
                                        },
                                        body: JSON.stringify(data)
                                    }).then(response => response.json())
                                    .then(result => {
                                        document.getElementById('popupButton').style.display = 'none';
                                        document.getElementById('subject-popup').innerHTML = '';
                                        document.getElementById('description-popup').innerHTML = result.message;
                                        subjectInput.value = '';
                                        descriptionInput.value = '';
                                    }).catch(error => console.log("Error: ", error));
                            }
                        })
                    </script>
                </form>
            </div>
        </section>
    </div>
</body>

</html>