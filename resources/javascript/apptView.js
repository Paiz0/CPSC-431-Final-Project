// TODOS:

// Upon the window loading, make an AJAX request to a php file
// that will retrieve the list of "Incoming Appointments" and 
// "Outgoing Appointments" stored as a dictionary.
// Here's the layout of the dictionary to be returned:
//
//  {"incoming": {
//    "pending": {{<Appointment info>}, ...},
//    "accepted": {{<Appointment info>}, ...},
//    "rejected": {{<Appointment info>}, ...}
//   },
//  {"outgoing": {
//    "pending": {{<Appointment info>}, ...},
//    "accepted": {{<Appointment info>}, ...},
//    "rejected": {{<Appointment info>}, ...}
//   }
//  }
//
// Here's the conditions for displaying:
//
// if incoming:
//   if pending:
//      <display and setup Accept/Deny buttons>
//   if accepted:
//      <display green checkmark>
//   if rejected:
//      <display red "X">
// if outgoing:
//   if pending:
//      <display minus symbol in yellow for pending>
//   if accepted:
//      <display green checkmark>
//   if rejected:
//      <display red "X">

// Note that if an incoming appointment is accepted,
// the database will change the status to accepted
// and the javascript will remove the buttons and
// place a green checkmark in their place.
// If an incoming appointment is denied, the database
// will change the appointment status to rejected and
// a red "X" will be put in the place of the two buttons
// for that appointment.

var data = [];

// This is the function that gets called when the user
// clicks the "Accept" button. It updates the database.
// Note that "apptID" is the unique ID of the appointment so
// that the database can know which appointment to delete
// from the database.
function acceptButtonUpdate(apptID)
{
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Stuff can go here if there's a return value
            // from the php file
        }
    }

    xhr.open("GET", "resources/php/in_development/update_appointment_status.php?accepted=1&apptID=" + encodeURIComponent(apptID), true);
    xhr.send();
}

// This is the function that gets called when the user
// clicks the "Deny" button. It updates the database.
// Note that "apptID" is the unique ID of the appointment so
// that the database can know which appointment to delete
// from the database.
function denyButtonUpdate(apptID)
{
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Stuff can go here if there's a return value
            // from the php file
        }
    }

    xhr.open("GET", "resources/php/in_development/update_appointment_status.php?accepted=0&apptID=" + encodeURIComponent(apptID), true);
    xhr.send();
}

window.onload = function() {

    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {

            var data = JSON.parse(this.responseText);

            console.log(data);

            // Setup the incoming appointments in the html\

            // Setup the pending appointments in the html
            for (let appt in data["incoming"]["pending"])
            {
                // Create all necessary html elements
                var parentDiv = document.getElementById("incoming");
                var boundingDiv = document.createElement("div");
                var apptDiv = document.createElement("div");
                var nameDiv = document.createElement("div");
                var nameText = document.createTextNode("Full name");
                var nameP = document.createElement("p");
                var fromDiv = document.createElement("div");
                var fromText = document.createTextNode("From Email");
                var fromP = document.createElement("p");
                var zipcodeDiv = document.createElement("div");
                var zipcodeText = document.createTextNode("Zipcode");
                var zipcodeP = document.createElement("p");
                var datetimeDiv = document.createElement("div");
                var datetimeText = document.createTextNode("Datetime");
                var datetimeP = document.createElement("p");
                var optionsDiv = document.createElement("div");
                var acceptButton = document.createElement("button");
                var denyButton = document.createElement("button");
                var notesDiv = document.createElement("div");
                var notesText = document.createTextNode("Notes");
                var notesP = document.createElement("p");

                // Set the properties of the html elements for the first div
                apptDiv.className = "appts";
                nameP.textContent = data["incoming"]["pending"][appt]["name"];
                nameDiv.className = "result";
                nameDiv.appendChild(nameText);
                nameDiv.appendChild(nameP);
                fromP.textContent = data["incoming"]["pending"][appt]["email"];
                fromDiv.className = "result";
                fromDiv.appendChild(fromText);
                fromDiv.appendChild(fromP);
                zipcodeP.textContent = data["incoming"]["pending"][appt]["zipcode"];
                zipcodeDiv.className = "result";
                zipcodeDiv.appendChild(zipcodeText);
                zipcodeDiv.appendChild(zipcodeP);
                datetimeP.textContent = data["incoming"]["pending"][appt]["apptDate"];
                datetimeDiv.className = "result";
                datetimeDiv.appendChild(datetimeText);
                datetimeDiv.appendChild(datetimeP);
                acceptButton.className = "accept";
                acceptButton.textContent = "Accept";
                denyButton.className = "deny";
                denyButton.textContent = "Deny";

                // Construct all elements together for the first div
                apptDiv.appendChild(nameDiv);
                apptDiv.appendChild(fromDiv);
                apptDiv.appendChild(zipcodeDiv);
                apptDiv.appendChild(datetimeDiv);
                optionsDiv.appendChild(acceptButton);
                optionsDiv.appendChild(denyButton);
                apptDiv.appendChild(optionsDiv);

                // Set the properties of the html elements for the notes section
                notesP.textContent = data["incoming"]["pending"][appt]["apptDetails"];
                notesDiv.className = "result-notes";
                notesDiv.appendChild(notesText);
                notesDiv.appendChild(notesP);

                // Append all of the divs to the bounding div
                boundingDiv.appendChild(apptDiv);
                boundingDiv.appendChild(notesDiv);

                // Append the bounding div to its parent div
                parentDiv.appendChild(boundingDiv);

                // Set the events for the buttons
                acceptButton.addEventListener("click", function() {
                    // Get the parent node
                    var parent = this.parentNode;

                    // Remove the buttons
                    this.nextElementSibling.remove();
                    this.remove();
                    // denyButton.remove();

                    // Create the status element
                    var status = document.createElement("i");

                    // Change the status style
                    status.className = "fa-solid fa-check fa-2xl";
                    status.style = "color: #00c760;";

                    // Append the status to the options div
                    parent.appendChild(status);

                    // Call the function to update the database
                    acceptButtonUpdate(data["incoming"]["pending"][appt]["apptID"]);
                })

                denyButton.addEventListener("click", function() {

                    // NOTE: Uncomment this line and comment out the other
                    //       lines if you want the remove button to remove
                    //       the appointment from the screen ratherh than
                    //       just displaying an X in the upper right corner
                    // denyButton.parentNode.parentNode.parentNode.remove();

                    // Get the parent node
                    var parent = this.parentNode;

                    // Remove the buttons
                    this.previousSibling.remove();
                    this.remove();

                    // Create the status element
                    var status = document.createElement("i");

                    // Change the status style
                    status.className = "fa-solid fa-xmark fa-2xl";
                    status.style = "color: #FE0000";

                    // Append the status to the options div
                    parent.appendChild(status);

                    // Call the function to update the database
                    denyButtonUpdate(data["incoming"]["pending"][appt]["apptID"]);
                })

                console.log(data["incoming"]["pending"][appt]);
            }

            // Setup the accepted appointments in the html
            for (let appt in data["incoming"]["accepted"])
            {
                // Create all necessary html elements
                var parentDiv = document.getElementById("incoming");
                var boundingDiv = document.createElement("div");
                var apptDiv = document.createElement("div");
                var nameDiv = document.createElement("div");
                var nameText = document.createTextNode("Full name");
                var nameP = document.createElement("p");
                var fromDiv = document.createElement("div");
                var fromText = document.createTextNode("From Email");
                var fromP = document.createElement("p");
                var zipcodeDiv = document.createElement("div");
                var zipcodeText = document.createTextNode("Zipcode");
                var zipcodeP = document.createElement("p");
                var datetimeDiv = document.createElement("div");
                var datetimeText = document.createTextNode("Datetime");
                var datetimeP = document.createElement("p");
                var optionsDiv = document.createElement("div");
                var notesDiv = document.createElement("div");
                var notesText = document.createTextNode("Notes");
                var notesP = document.createElement("p");
                var status = document.createElement("i");

                // Set the properties of the html elements for the first div
                apptDiv.className = "appts";
                nameP.textContent = data["incoming"]["accepted"][appt]["name"];
                nameDiv.className = "result";
                nameDiv.appendChild(nameText);
                nameDiv.appendChild(nameP);
                fromP.textContent = data["incoming"]["accepted"][appt]["email"];
                fromDiv.className = "result";
                fromDiv.appendChild(fromText);
                fromDiv.appendChild(fromP);
                zipcodeP.textContent = data["incoming"]["accepted"][appt]["zipcode"];
                zipcodeDiv.className = "result";
                zipcodeDiv.appendChild(zipcodeText);
                zipcodeDiv.appendChild(zipcodeP);
                datetimeP.textContent = data["incoming"]["accepted"][appt]["apptDate"];
                datetimeDiv.className = "result";
                datetimeDiv.appendChild(datetimeText);
                datetimeDiv.appendChild(datetimeP);
                status.className = "fa-solid fa-check fa-2xl";
                status.style = "color: #00c760;";

                // Construct all elements together for the first div
                apptDiv.appendChild(nameDiv);
                apptDiv.appendChild(fromDiv);
                apptDiv.appendChild(zipcodeDiv);
                apptDiv.appendChild(datetimeDiv);
                optionsDiv.appendChild(status);
                apptDiv.appendChild(optionsDiv);

                // Set the properties of the html elements for the notes section
                notesP.textContent = data["incoming"]["accepted"][appt]["apptDetails"];
                notesDiv.className = "result-notes";
                notesDiv.appendChild(notesText);
                notesDiv.appendChild(notesP);

                // Append all of the divs to the bounding div
                boundingDiv.appendChild(apptDiv);
                boundingDiv.appendChild(notesDiv);

                // Append the bounding div to its parent div
                parentDiv.appendChild(boundingDiv);


                console.log(data["incoming"]["accepted"][appt]);
            }

            // Setup the rejected appointments in the html
            for (let appt in data["incoming"]["rejected"])
            {
                // Create all necessary html elements
                var parentDiv = document.getElementById("incoming");
                var boundingDiv = document.createElement("div");
                var apptDiv = document.createElement("div");
                var nameDiv = document.createElement("div");
                var nameText = document.createTextNode("Full name");
                var nameP = document.createElement("p");
                var fromDiv = document.createElement("div");
                var fromText = document.createTextNode("From Email");
                var fromP = document.createElement("p");
                var zipcodeDiv = document.createElement("div");
                var zipcodeText = document.createTextNode("Zipcode");
                var zipcodeP = document.createElement("p");
                var datetimeDiv = document.createElement("div");
                var datetimeText = document.createTextNode("Datetime");
                var datetimeP = document.createElement("p");
                var optionsDiv = document.createElement("div");
                var notesDiv = document.createElement("div");
                var notesText = document.createTextNode("Notes");
                var notesP = document.createElement("p");
                var status = document.createElement("i");

                // Set the properties of the html elements for the first div
                apptDiv.className = "appts";
                nameP.textContent = data["incoming"]["rejected"][appt]["name"];
                nameDiv.className = "result";
                nameDiv.appendChild(nameText);
                nameDiv.appendChild(nameP);
                fromP.textContent = data["incoming"]["rejected"][appt]["email"];
                fromDiv.className = "result";
                fromDiv.appendChild(fromText);
                fromDiv.appendChild(fromP);
                zipcodeP.textContent = data["incoming"]["rejected"][appt]["zipcode"];
                zipcodeDiv.className = "result";
                zipcodeDiv.appendChild(zipcodeText);
                zipcodeDiv.appendChild(zipcodeP);
                datetimeP.textContent = data["incoming"]["rejected"][appt]["apptDate"];
                datetimeDiv.className = "result";
                datetimeDiv.appendChild(datetimeText);
                datetimeDiv.appendChild(datetimeP);
                status.className = "fa-solid fa-xmark fa-2xl";
                status.style = "color: #FE0000";

                // Construct all elements together for the first div
                apptDiv.appendChild(nameDiv);
                apptDiv.appendChild(fromDiv);
                apptDiv.appendChild(zipcodeDiv);
                apptDiv.appendChild(datetimeDiv);
                optionsDiv.appendChild(status);
                apptDiv.appendChild(optionsDiv);

                // Set the properties of the html elements for the notes section
                notesP.textContent = data["incoming"]["rejected"][appt]["apptDetails"];
                notesDiv.className = "result-notes";
                notesDiv.appendChild(notesText);
                notesDiv.appendChild(notesP);

                // Append all of the divs to the bounding div
                boundingDiv.appendChild(apptDiv);
                boundingDiv.appendChild(notesDiv);

                // Append the bounding div to its parent div
                parentDiv.appendChild(boundingDiv);


                console.log(data["incoming"]["rejected"][appt]);
            }

            // Setup the outgoing appointments in the html

            // Setup the pending appointments in the html
            for (let appt in data["outgoing"]["pending"])
            {
                // Create all necessary html elements
                var parentDiv = document.getElementById("outgoing");
                var boundingDiv = document.createElement("div");
                var apptDiv = document.createElement("div");
                var nameDiv = document.createElement("div");
                var nameText = document.createTextNode("Full name");
                var nameP = document.createElement("p");
                var fromDiv = document.createElement("div");
                var fromText = document.createTextNode("To Email");
                var fromP = document.createElement("p");
                var zipcodeDiv = document.createElement("div");
                var zipcodeText = document.createTextNode("Zipcode");
                var zipcodeP = document.createElement("p");
                var datetimeDiv = document.createElement("div");
                var datetimeText = document.createTextNode("Datetime");
                var datetimeP = document.createElement("p");
                var optionsDiv = document.createElement("div");
                var status = document.createElement("i");
                
                var notesDiv = document.createElement("div");
                var notesText = document.createTextNode("Notes");
                var notesP = document.createElement("p");

                // Set the properties of the html elements for the first div
                apptDiv.className = "appts";
                nameP.textContent = data["outgoing"]["pending"][appt]["name"];
                nameDiv.className = "result";
                nameDiv.appendChild(nameText);
                nameDiv.appendChild(nameP);
                fromP.textContent = data["outgoing"]["pending"][appt]["email"];
                fromDiv.className = "result";
                fromDiv.appendChild(fromText);
                fromDiv.appendChild(fromP);
                zipcodeP.textContent = data["outgoing"]["pending"][appt]["zipcode"];
                zipcodeDiv.className = "result";
                zipcodeDiv.appendChild(zipcodeText);
                zipcodeDiv.appendChild(zipcodeP);
                datetimeP.textContent = data["outgoing"]["pending"][appt]["apptDate"];
                datetimeDiv.className = "result";
                datetimeDiv.appendChild(datetimeText);
                datetimeDiv.appendChild(datetimeP);
                status.className = "fa-solid fa-minus fa-2xl";
                status.style = "color: #F6C332";

                // Construct all elements together for the first div
                apptDiv.appendChild(nameDiv);
                apptDiv.appendChild(fromDiv);
                apptDiv.appendChild(zipcodeDiv);
                apptDiv.appendChild(datetimeDiv);
                optionsDiv.appendChild(status);
                apptDiv.appendChild(optionsDiv);

                // Set the properties of the html elements for the notes section
                notesP.textContent = data["outgoing"]["pending"][appt]["apptDetails"];
                notesDiv.className = "result-notes";
                notesDiv.appendChild(notesText);
                notesDiv.appendChild(notesP);

                // Append all of the divs to the bounding div
                boundingDiv.appendChild(apptDiv);
                boundingDiv.appendChild(notesDiv);

                // Append the bounding div to its parent div
                parentDiv.appendChild(boundingDiv);


                console.log(data["outgoing"]["pending"][appt]);
            }

            // Setup the accepted appointments in the html
            for (let appt in data["outgoing"]["accepted"])
            {
                // Create all necessary html elements
                var parentDiv = document.getElementById("outgoing");
                var boundingDiv = document.createElement("div");
                var apptDiv = document.createElement("div");
                var nameDiv = document.createElement("div");
                var nameText = document.createTextNode("Full name");
                var nameP = document.createElement("p");
                var fromDiv = document.createElement("div");
                var fromText = document.createTextNode("To Email");
                var fromP = document.createElement("p");
                var zipcodeDiv = document.createElement("div");
                var zipcodeText = document.createTextNode("Zipcode");
                var zipcodeP = document.createElement("p");
                var datetimeDiv = document.createElement("div");
                var datetimeText = document.createTextNode("Datetime");
                var datetimeP = document.createElement("p");
                var optionsDiv = document.createElement("div");
                var status = document.createElement("i");
                
                var notesDiv = document.createElement("div");
                var notesText = document.createTextNode("Notes");
                var notesP = document.createElement("p");

                // Set the properties of the html elements for the first div
                apptDiv.className = "appts";
                nameP.textContent = data["outgoing"]["accepted"][appt]["name"];
                nameDiv.className = "result";
                nameDiv.appendChild(nameText);
                nameDiv.appendChild(nameP);
                fromP.textContent = data["outgoing"]["accepted"][appt]["email"];
                fromDiv.className = "result";
                fromDiv.appendChild(fromText);
                fromDiv.appendChild(fromP);
                zipcodeP.textContent = data["outgoing"]["accepted"][appt]["zipcode"];
                zipcodeDiv.className = "result";
                zipcodeDiv.appendChild(zipcodeText);
                zipcodeDiv.appendChild(zipcodeP);
                datetimeP.textContent = data["outgoing"]["accepted"][appt]["apptDate"];
                datetimeDiv.className = "result";
                datetimeDiv.appendChild(datetimeText);
                datetimeDiv.appendChild(datetimeP);
                status.className = "fa-solid fa-check fa-2xl";
                status.style = "color: #00c760;";

                // Construct all elements together for the first div
                apptDiv.appendChild(nameDiv);
                apptDiv.appendChild(fromDiv);
                apptDiv.appendChild(zipcodeDiv);
                apptDiv.appendChild(datetimeDiv);
                optionsDiv.appendChild(status);
                apptDiv.appendChild(optionsDiv);

                // Set the properties of the html elements for the notes section
                notesP.textContent = data["outgoing"]["accepted"][appt]["apptDetails"];
                notesDiv.className = "result-notes";
                notesDiv.appendChild(notesText);
                notesDiv.appendChild(notesP);

                // Append all of the divs to the bounding div
                boundingDiv.appendChild(apptDiv);
                boundingDiv.appendChild(notesDiv);

                // Append the bounding div to its parent div
                parentDiv.appendChild(boundingDiv);


                console.log(data["outgoing"]["accepted"][appt]);
            }

            // Setup the rejected appointments in the html
            for (let appt in data["outgoing"]["rejected"])
            {
                // Create all necessary html elements
                var parentDiv = document.getElementById("outgoing");
                var boundingDiv = document.createElement("div");
                var apptDiv = document.createElement("div");
                var nameDiv = document.createElement("div");
                var nameText = document.createTextNode("Full name");
                var nameP = document.createElement("p");
                var fromDiv = document.createElement("div");
                var fromText = document.createTextNode("To Email");
                var fromP = document.createElement("p");
                var zipcodeDiv = document.createElement("div");
                var zipcodeText = document.createTextNode("Zipcode");
                var zipcodeP = document.createElement("p");
                var datetimeDiv = document.createElement("div");
                var datetimeText = document.createTextNode("Datetime");
                var datetimeP = document.createElement("p");
                var optionsDiv = document.createElement("div");
                var status = document.createElement("i");
                
                var notesDiv = document.createElement("div");
                var notesText = document.createTextNode("Notes");
                var notesP = document.createElement("p");

                // Set the properties of the html elements for the first div
                apptDiv.className = "appts";
                nameP.textContent = data["outgoing"]["rejected"][appt]["name"];
                nameDiv.className = "result";
                nameDiv.appendChild(nameText);
                nameDiv.appendChild(nameP);
                fromP.textContent = data["outgoing"]["rejected"][appt]["email"];
                fromDiv.className = "result";
                fromDiv.appendChild(fromText);
                fromDiv.appendChild(fromP);
                zipcodeP.textContent = data["outgoing"]["rejected"][appt]["zipcode"];
                zipcodeDiv.className = "result";
                zipcodeDiv.appendChild(zipcodeText);
                zipcodeDiv.appendChild(zipcodeP);
                datetimeP.textContent = data["outgoing"]["rejected"][appt]["apptDate"];
                datetimeDiv.className = "result";
                datetimeDiv.appendChild(datetimeText);
                datetimeDiv.appendChild(datetimeP);
                status.className = "fa-solid fa-xmark fa-2xl";
                status.style = "color: #FE0000";

                // Construct all elements together for the first div
                apptDiv.appendChild(nameDiv);
                apptDiv.appendChild(fromDiv);
                apptDiv.appendChild(zipcodeDiv);
                apptDiv.appendChild(datetimeDiv);
                optionsDiv.appendChild(status);
                apptDiv.appendChild(optionsDiv);

                // Set the properties of the html elements for the notes section
                notesP.textContent = data["outgoing"]["rejected"][appt]["apptDetails"];
                notesDiv.className = "result-notes";
                notesDiv.appendChild(notesText);
                notesDiv.appendChild(notesP);

                // Append all of the divs to the bounding div
                boundingDiv.appendChild(apptDiv);
                boundingDiv.appendChild(notesDiv);

                // Append the bounding div to its parent div
                parentDiv.appendChild(boundingDiv);


                console.log(data["outgoing"]["rejected"][appt]);
            }
        }
    }

    xhr.open("GET", "resources/php/in_development/get_appointments.php?", true);
    xhr.send();
}