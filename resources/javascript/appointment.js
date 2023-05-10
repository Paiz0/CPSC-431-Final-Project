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
            // Let the user know they scheduled a meeting
            // successfully.
            alert("Appointment scheduled successfully!");

            // Reset all of the values for the appointment creation
            document.getElementById("date").value = "";
            document.getElementById("time").value = "";
            document.getElementById("note").value = "";
        }
    }

    xhr.open("GET", "resources/php/in_development/schedule_appointment.php?userID=" + encodeURIComponent(userID) + "&datetime=" + encodeURIComponent(datetime) + "&description=" + encodeURIComponent(description), true);
    xhr.send();

    // alert(time);
    // alert(date);
    // alert(description);
})