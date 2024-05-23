<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/popup.css">
    <script>
        function redirect() {
            window.location.href = 'loginSignup.php';
        }
    </script>
</head>

<body>
    <div id="popupContainer" class="popup">
        <div class="popup-content">
            <span class="close-btn" id="closePopupBtn" onclick="closePopup()">&times;</span>
            <h3 id="subject-popup"></h3>
            <p id="description-popup"></p>
            <div class="button-popup">
                <button id="popupButton" class="popupButton" onclick="redirect()">Login Now</button>
            </div>
        </div>
    </div>
    <script>
        const popupContainer = document.getElementById('popupContainer');

        function closePopup() {
            popupContainer.style.display = 'none';
        }
    </script>
</body>

</html>