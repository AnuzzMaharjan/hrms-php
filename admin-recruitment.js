function recruitSubmit() {
    document.getElementById('recruitForm').addEventListener('submit', function (event) {
        event.preventDefault();

        var validity = document.getElementById('validity').value;
        var position = document.getElementById('position').value;
        var contact = document.getElementById('contact').value;
        const popupContainer = document.getElementById('popupContainer');
        popupContainer.style.display = 'block';

        if (!validity || !position || !contact) {
            alert('Please fill all the fields!');
        }
        else {

            const data = {
                validity: validity,
                position: position,
                contact: contact
            }

            fetch('admin-recruitment-control.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            }).then(response => response.json())
                .then(result => {
                    recruitExtract();
                    document.getElementById('popupButton').style.display = 'none';
                    document.getElementById('subject-popup').innerHTML = '';
                    document.getElementById('description-popup').innerHTML = result.message;
                })
                .catch(error => console.log("Error: ", error));
        }
    })
}
function recruitExtract() {
    fetch('admin-recruitment-view.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        }
    }).then(response => response.json())
        .then(result => {
            if (result.error) {
                document.getElementById('recruitBoard').innerHTML = 'Error: ' + result.error;
            } else if (result.data && result.data.length > 0) {
                let html = '';
                result.data.forEach(block => {
                    html += '<div class="box">';
                    html += `<div>Valid till:&nbsp<span id="valid">${block.Validity}</span></div>`;
                    html += `<div>Position:&nbsp<span id="pos">${block.Position}</span></div>`;
                    html += `<div>Contact:&nbsp<span id="cont">${block.Contact_Address}</span></div>`;
                    html += '<div class="removeRecruit">[X]</div>'
                    html += '</div>';
                    html += '</div>';
                })
                document.getElementById('recruitBoard').innerHTML = html;
                recruitDelete();
            } else {
                document.getElementById('recruitBoard').innerHTML = '<p>No data found</p>';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('recruitBoard').innerHTML = '<p>Error fetching data</p>';
        })
}

function recruitDelete() {
    document.querySelectorAll('.removeRecruit').forEach(x => {
        x.addEventListener('click', function (event) {
            let validity = document.getElementById('valid').textContent;
            let position = document.getElementById('pos').textContent;
            let contact = document.getElementById('cont').textContent;
            const popupContainer = document.getElementById('popupContainer');
            popupContainer.style.display = 'block';

            const jsonData = {
                validity: validity,
                position: position,
                contact: contact
            }

            fetch('admin-recruitment-delete.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(jsonData)
            }).then(response => response.json())
                .then(res => {
                    recruitExtract();
                    document.getElementById('popupButton').style.display = 'none';
                    document.getElementById('subject-popup').innerHTML = '';
                    document.getElementById('description-popup').innerHTML = res.message;
                })
        })
    })
}
window.onload = function () {
    recruitSubmit();
    recruitExtract();
}