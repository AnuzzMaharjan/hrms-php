function fetchUsers() {
    fetch('admin-user-fetch.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        }
    })
        .then(response => response.json())
        .then(result => {
            if (result.error) {
                document.getElementById('user-details').innerHTML = '<p> ' + result.error + '</p>';
            } else if (result.data && result.data.length > 0) {
                let html = "<table class='user-table'>";
                html += '<tr><th>User_id</th><th>Username</th><th>email</th></tr>';

                result.data.forEach(row => {
                    html += '<tr>';
                    html += '<td>' + row.User_id + '</td>';
                    html += '<td>' + row.Username + '</td>';
                    html += '<td>' + row.Email + '</td>';
                    html += '<td class=deleteUser>[X]</td>';
                    html += '</tr>';
                })
                html += '</table>';
                document.getElementById('user-details').innerHTML = html;
            } else {
                document.getElementById('user-details').innerHTML = '<p>No data found</p>';
            }
        })
}

window.onload = function () {
    fetchUsers();
    deleteUser();
}

const deleteUser = () => {
    var table = document.getElementById('user-details');
    table.addEventListener('click', function (event) {
        var userElement = event.target;
        var row = userElement.closest('tr');
        var userId = userElement.parentNode.childNodes[0].textContent;
        const popupContainer = document.getElementById('popupContainer');
        popupContainer.style.display = 'block';

        const data = {
            'userId': userId
        }
        fetch('admin-user-delete.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    row.remove();
                    fetchUsers();
                }
                document.getElementById('popupButton').style.display = 'none';
                document.getElementById('subject-popup').innerHTML = '';
                document.getElementById('description-popup').innerHTML = result.message;
            }).catch(error => console.log("Error: ", error));
    })
}