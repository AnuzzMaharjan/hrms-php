function fetchLeaveForm() {
    fetch('admin-leaveForm-fetch.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        }
    })
        .then(response => response.json())
        .then(result => {
            if (result.error) {
                document.getElementById('leaveForm').innerHTML = '<p> ' + result.error + '</p>';
            } else if (result.data && result.data.length > 0) {
                let html = "<table class='form-table'>";
                html += '<tr><th>Form_id</th><th>User_id</th><th>Date</th><th>Time</th></tr>';

                result.data.forEach(row => {
                    html += '<tr>';
                    html += '<td>' + row.SN + '</td>';
                    html += '<td>' + row.User_id + '</td>';
                    html += '<td>' + row.Date + '</td>';
                    html += '<td>' + row.Time + '</td>';
                    html += '<td class=deleteForm id=deleteForm>[X]</td>';
                    html += '<td class=viewForm >View</td>';
                    html += '</tr>';
                })
                html += '</table>';
                document.getElementById('leaveForm').innerHTML = html;
                deleteLeaveForm();
                viewLeaveForm();

            } else {
                document.getElementById('leaveForm').innerHTML = '<p>No data found</p>';
            }
        })
}

window.onload = function () {
    fetchLeaveForm();
}

const deleteLeaveForm = () => {
    var del = document.querySelectorAll('.deleteForm');
    const popupContainer = document.getElementById('popupContainer');

    del.forEach(x => {
        x.addEventListener('click', function (event) {
            var formElement = event.target;
            var row = formElement.closest('tr');
            var formId = formElement.parentNode.childNodes[0].textContent;

            const data = {
                'formId': formId
            }
            fetch('admin-leaveForm-delete.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
                .then(response => response.json())
                .then(result => {
                    console.log("Response: ", result);
                    if (result.success) {
                        popupContainer.style.display = 'block';
                        row.remove()
                        fetchLeaveForm();
                    }
                    document.getElementById('subject-popup').innerHTML = '';
                    document.getElementById('description-popup').innerHTML = result.message;
                    document.getElementById('popupButton').style.display = 'none';
                }).catch(error => console.log("Error: ", error));
        })
    })
}

const viewLeaveForm = () => {
    var viewForm = document.querySelectorAll('.viewForm');
    const popupContainer = document.getElementById('popupContainer');

    viewForm.forEach(x => {
        x.addEventListener('click', function (event) {
            var formElement = event.target;
            var formId = formElement.parentNode.childNodes[0].textContent;

            const data = {
                'formId': formId
            }
            fetch('admin-leaveForm-view.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
                .then(response => response.json())
                .then(result => {
                    popupContainer.style.display = 'block';
                    document.getElementById('subject-popup').innerHTML = result.subject;
                    document.getElementById('description-popup').innerHTML = result.description;
                    document.getElementById('popupButton').style.display = 'none';
                }).catch(error => console.log("Error: ", error));
        })
    })
}