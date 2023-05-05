// Get the userID parameter from the URL
const urlParams = new URLSearchParams(window.location.search);
const userID = urlParams.get('userID');

// alert(userID);

var form = document.getElementById("form");

// Detect when the form is submitted
form.addEventListener("submit", function() {
    var datetime = document.getElementById("date").value + " " + document.getElementById("time").value + ":00";
    // var date = document.getElementById("date").value;
    var description = document.getElementById("note").value;

    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200)
        {
            // var data = JSON.parse(this.responseText);

            // console.log(data);
            // Do stuff here if you end up adding
            // a return value to the php file.
        }
    }

    xhr.open("GET", "resources/php/in_development/schedule_appointment.php?userID=" + encodeURIComponent(userID) + "&datetime=" + encodeURIComponent(datetime) + "&description=" + encodeURIComponent(description), true);
    xhr.send();

    // alert(time);
    // alert(date);
    // alert(description);
})