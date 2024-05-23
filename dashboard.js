function request(data) {
    const popupContainer = document.getElementById('popupContainer');
    popupContainer.style.display = 'block';
    try {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'd-attendance.php', true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let response = JSON.parse(xhr.responseText);
                document.getElementById('popupButton').style.display = 'none';
                document.getElementById('subject-popup').innerHTML = '';
                document.getElementById('description-popup').innerHTML = response.message;
            }
        };
        xhr.send(JSON.stringify(data));
    } catch (e) {
        alert('Something went wrong!');
    }
    toggleButton();

}

function attend_out() {
    var dateNow = new Date();
    var data_out = {
        date: dateNow.toLocaleDateString(),
        time: dateNow.toLocaleTimeString(),
        status: 'status-out'
    }
    request(data_out)
}

function attend_in() {
    var dateNow = new Date();
    var data_in = {
        date: dateNow.toLocaleDateString(),
        time: dateNow.toLocaleTimeString(),
        status: 'status-in'
    }
    request(data_in);
}

function toggleButton(state) {
    var buttons = document.querySelectorAll('.attend_button');
    buttons.forEach(x => {
        if (x.classList.contains('active')) {
            x.classList.add('passive');
            x.classList.remove('active');
        } else {
            x.classList.add('active');
            x.classList.remove('passive');
        }
    })

}