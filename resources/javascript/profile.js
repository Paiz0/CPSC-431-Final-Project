// Get the userID parameter from the URL
const urlParams = new URLSearchParams(window.location.search);
const userID = urlParams.get('userID');

// Get the location of all document data
var name_field = document.getElementById("name");
var email_field = document.getElementById("email");
var zipcode_field = document.getElementById("zipcode");
var type_field = document.getElementById("type");

if (userID !== null)
{
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

                // Set all of the input fields
                name_field.textContent = name;
                email_field.textContent = email;
                zipcode_field.textContent = zipcode;
                type_field.textContent = type;

            }

        }

        xhr.open("GET", "resources/php/in_development/load_profile.php?userID=" + encodeURIComponent(userID), true);
        xhr.send();

    }
}