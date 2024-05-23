function recruitFetch() {
    fetch('user-recruitment-fetch.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        }
    }).then(response => response.json())
        .then(result => {
            if (result.error) {
                document.getElementById('recruitment-details').innerHTML = 'Error: ' + result.error;
            } else if (result.data && result.data.length > 0) {
                let html = '';
                result.data.forEach(block => {
                    html += '<div class="box">';
                    html += `<div>Valid till:&nbsp<span id="valid">${block.Validity}</span></div>`;
                    html += `<div>Position:&nbsp<span id="pos">${block.Position}</span></div>`;
                    html += `<div>Contact:&nbsp<span id="cont">${block.Contact_Address}</span></div>`;
                    html += '</div>';
                    html += '</div>';
                })
                document.getElementById('recruitment-details').innerHTML = html;
            } else {
                document.getElementById('recruitment-details').innerHTML = '<p>No data found</p>';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('recruitment-details').innerHTML = '<p>Error fetching data</p>';
        })
} window.onload = function () {
    recruitFetch();
}