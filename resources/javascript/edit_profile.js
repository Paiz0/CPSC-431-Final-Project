// // Get the userID parameter from the URL
// const urlParams = new URLSearchParams(window.location.search);
// const userID = urlParams.get('userID');

// Store the radio on status
const RADIO_ON = "1";
const RADIO_OFF = "0";

// Get the location of all document data
var name_field = document.getElementById("name");
var email_field = document.getElementById("email");
var zipcode_field = document.getElementById("zipcode");
var type_field = document.getElementById("type");
var yes_radio = document.getElementById("yes-radio");
var no_radio = document.getElementById("no-radio");

// Get the location of the submit button
var submitButton = document.getElementById("submit-button");

// // Adjust the href to the Appointment page to include the
// // userID from the Profile page
// document.getElementById("appt-page-redirect").href += "?userID=" + encodeURIComponent(userID);

window.onload = function() {

    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200)
        {
            var data = JSON.parse(this.responseText);

            console.log(data);

            // Get all of the data from the php response
            var name = data["name"];
            var email = data["email"];
            var zipcode = data["zipcode"];
            var type = data["type"];
            var contactable = data["contactable"];

            // Set all of the input fields
            name_field.value = name;
            email_field.textContent = email;
            zipcode_field.value = zipcode;
            type_field.textContent = type;

            // Check which button to check
            if (contactable == RADIO_ON)
            {
                yes_radio.checked = true;
                no_radio.checked = false;
            }
            else
            {
                no_radio.checked = true;
                yes_radio.checked = false;
            }
        }
    }

    xhr.open("GET", "resources/php/in_development/load_profile.php?", true);
    xhr.send();

}

// Create an event listener for the submit button
// so we can submit the form data
submitButton.addEventListener("click", function() {
    
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200)
        {
            // Put stuff here if a return value is later
            // provided in a future update
        }
    }

    if (yes_radio.checked)
    {
        xhr.open("GET", "resources/php/in_development/update_profile.php?name=" + encodeURIComponent(name_field.value) + "&zipcode=" + encodeURIComponent(zipcode_field.value) + "&contactable=" + encodeURIComponent(RADIO_ON), true);
    }
    else
    {
        xhr.open("GET", "resources/php/in_development/update_profile.php?name=" + encodeURIComponent(name_field.value) + "&zipcode=" + encodeURIComponent(zipcode_field.value) + "&contactable=" + encodeURIComponent(RADIO_OFF), true);
    }
    xhr.send();
})