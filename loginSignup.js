function signup() {
    document.getElementById('signup-form').addEventListener('submit', function (event) {
        event.preventDefault();

        const popupContainer = document.getElementById('popupContainer');
        var username = document.getElementById('username-input').value;
        var email = document.getElementById('email-input').value;
        var password = document.getElementById('password-input').value;
        popupContainer.style.display = 'block';

        const data = {
            username: username,
            email: email,
            password: password
        }
        fetch('signup.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        }).then(response => response.json())
            .then(result => {
                if (result.success) {
                    document.getElementById('subject-popup').innerHTML = '';
                    document.getElementById('description-popup').innerHTML = result.message;
                } else {
                    document.getElementById('subject-popup').innerHTML = '';
                    document.getElementById('description-popup').innerHTML = result.message;
                    document.getElementById('popupButton').innerHTML = 'Try again';

                }
            })
            .catch(error => {
                console.error('Error during fetch: ', error.message);
            })
    })
}


window.onload = function () {
    signup();
}