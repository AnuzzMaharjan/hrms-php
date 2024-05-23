function fetchRecords(userId) {

    fetch('admin-attendance-search.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'userId=' + encodeURIComponent(userId)
    })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                document.getElementById('attendanceTable').innerHTML = '<p>Error: ' + data.error + '</p>';
            } else if (data.data && data.data.length > 0) {
                let html = '<table class="attendance-table">';
                html += '<tr><th>User_id</th><th>Date</th><th>Time</th><th>Status</th></tr>';

                data.data.forEach(row => {
                    html += '<tr>';
                    html += '<td>' + row.User_id + '</td>';
                    html += '<td>' + row.Date + '</td>';
                    html += '<td>' + row.Time + '</td>';
                    html += '<td>' + row.Status + '</td>';
                    html += '<td class=deleteRecord>[X]</td>';
                    html += '</tr>';
                });

                html += '</table>';
                document.getElementById('attendanceTable').innerHTML = html;
            } else {
                document.getElementById('attendanceTable').innerHTML = '<p>No data found</p>';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('attendanceTable').innerHTML = '<p>Error fetching data</p>';
        });
}

function fetchSearchRecord() {
    document.getElementById('search').addEventListener('submit', function (event) {
        event.preventDefault();
        var userId = document.querySelector('input[name="userId"]').value;
        fetchRecords(userId);
        deleteRecord(userId);
    })
}
window.onload = function () {
    fetchRecords(0);
    fetchSearchRecord();
    deleteRecord();
}
const deleteRecord = () => {
    var table = document.getElementById('attendanceTable');
    table.addEventListener('click', function (event) {
        var clickedElement = event.target;

        if (clickedElement.classList.contains('deleteRecord')) {
            var row = clickedElement.closest('tr');
            var siblings = clickedElement.parentNode.childNodes;

            const popupContainer = document.getElementById('popupContainer');
            popupContainer.style.display = 'block';

            var userId = siblings[0].textContent;
            var date = siblings[1].textContent;
            var time = siblings[2].textContent;
            var status = siblings[3].textContent;
            const data = {
                'userId': userId,
                'date': date,
                'time': time,
                'status': status
            };
            fetch('admin-attendance-delete.php', {
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
                        row.remove();
                        fetchRecords(userId);
                    }
                    document.getElementById('popupButton').style.display = 'none';
                    document.getElementById('subject-popup').innerHTML = '';
                    document.getElementById('description-popup').innerHTML = result.message;
                }).catch(error => console.log('Error: ', error));
        }
    })
}
