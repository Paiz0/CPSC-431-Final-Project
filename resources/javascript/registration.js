// Get the user type div
const userType = document.getElementById("user-type");
// Get all radio buttons under the user type div
const radioButtons = userType.querySelectorAll('input[type="radio"]');
// Here are the specialties and provisions (eventually
// these need to be moved over to the database)

// const specialties = [
// 'Allergy and Immunology',
// 'Anesthesiology',
// 'Cardiology',
// 'Dermatology',
// 'Emergency Medicine',
// 'Endocrinology',
// 'Family Medicine',
// 'Gastroenterology',
// 'Geriatrics',
// 'Hematology',
// 'Infectious Disease',
// 'Internal Medicine',
// 'Nephrology',
// 'Neurology',
// 'Obstetrics and Gynecology',
// 'Oncology',
// 'Ophthalmology',
// 'Orthopedics',
// 'Otolaryngology',
// 'Pediatrics'
// ];
// const provisions = [
//     'Ultrasound machines',
//     'CT scanners',
//     'MRI machines',
//     'X-ray machines',
//     'Mammography machines',
//     'Nuclear medicine equipment',
//     'Radiography equipment',
//     'Endoscopy equipment',
//     'Ophthalmic equipment',
//     'Dental equipment',
//     'Patient monitoring systems',
//     'Ventilators',
//     'Defibrillators',
//     'Pulse oximeters',
//     'Anesthesia machines',
//     'ECG machines',
//     'Blood glucose monitors',
//     'Infusion pumps',
//     'Robotic surgery equipment',
//     'Surgical lasers'
// ];

var specialties = [];
var provisions = [];

// Get all of the element details pertaining to the particular user,
// so we know which fields to update
var user_doctor_details = ["specialties", specialties, "specialty"];
var user_supplier_details = ["provisions", provisions, "provision"];

// Get the div elements that host all doctor/supplier data
// const doctor_div = document.getElementById("doctor");
// const supplier_div = document.getElementById("supplier");

// Get the input fields of the doctor/supplier
// const doctor_input = doctor_div.querySelector("#specialty");
// const supplier_input = supplier_div.querySelector("#provision");

radioButtons.forEach((radioButton) => {
    radioButton.addEventListener('change', () => {
        if (radioButton.checked && radioButton.value == "Doctor")
        {
            unsetState(user_doctor_details[2]);
            document.getElementById("doctor").hidden = false;
            document.getElementById("specialty").required = true;
            document.getElementById("supplier").hidden = true;
            document.getElementById("provision").required = false;
            updateDropdown(user_doctor_details);
        }
        else if (radioButton.checked && radioButton.value == "Supplier")
        {
            unsetState(user_supplier_details[2]);
            document.getElementById("doctor").hidden = true;
            document.getElementById("specialty").required = false;
            document.getElementById("supplier").hidden = false;
            document.getElementById("provision").required = true;
            updateDropdown(user_supplier_details);
        }
    })

})

// This function gets run immediately upon the webpage loading
window.onload = function() {

    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function() {

        if (this.readyState == 4 && this.status == 200)
        {
            console.log(this.responseText);
            var data = JSON.parse(this.responseText);
            var specialties_data = data["specialties"];
            var provisions_data = data["provisions"];

            console.log(data);

            // Iterate through all specialties and append
            // each of them to our list
            for (var i = 0; i < specialties_data.length; i++)
            {
                var row = specialties_data[i];

                // TODO: Update these push functions
                // to contain the key of what the php
                // file specified
                specialties.push(row["title"]);
            }

            // Iterate through all provisions and append
            // each of them to our list
            for (var i = 0; i < provisions_data.length; i++)
            {
                var row = provisions_data[i];

                // TODO: Update these push functions
                // to contain the key of what the php
                // file specified
                provisions.push(row["provision"]);
            }

            // Adjust the list stored in the doctor/supplier details
            user_doctor_details[1] = specialties;
            user_supplier_details[1] = provisions;

            // Call the updateDropdown() function since we need to
            // initially set the dropdown menu from the information
            // we retrieved
            updateDropdown(user_doctor_details);
        }
    }

    xhr.open("GET", "resources/php/in_development/get_specialties_provisions.php", true);
    xhr.send();
}

// This function updates the dropdown list
function updateDropdown(user_details)
{
    var dropdown_content = document.getElementById(user_details[0]);

    // Reset the inner html of the dropdown list to erase previous listings
    dropdown_content.innerHTML = '';

    for(let i = 0; i < user_details[1].length; i++)
    {
        var childState = document.createElement("div");

        // childState.style = "border: none; background-color: white;";
        // childState.style = "border: 1px solid #ccc; background-color: #f7f7f7; padding: 5px; cursor: pointer;";
        childState.innerHTML = user_details[1][i];
        // childState.onclick = "alert('Hello!')";
        childState.onclick = (function(text, user_type) {
            return function() {
                setState(text, user_type);
            }
        })(user_details[1][i], user_details[2]);

        dropdown_content.appendChild(childState);
    }
}

function setState(text, user_type_details)
{
    var type_details = document.getElementById(user_type_details);

    // var titles = document.getElementById("titles");
    // var curr_title = document.getElementById("curr_title");

    // titles.disabled = "false";
    // titles.value = text;

    type_details.value = text;

    // curr_type_details.style.cssText = 'top: -5px; color: #2691d9;';
}

function unsetState(user_type_details)
{
    document.getElementById(user_type_details).value = '';
    // document.getElementById(curr_user_type_details).style.cssText = '';
}