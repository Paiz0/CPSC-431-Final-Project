const emailInput = document.getElementById("email-input");
const addButton = document.getElementById("add-button");
const emailList = document.getElementById("email-list");

window.onload = function() {

    // Get the emails of all people who
    // we've either sent a message to or
    // received a message from.

    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200)
        {
            var data = JSON.parse(this.responseText);

            var emails = [];

            for (let i = 0; i < data.length; i++)
            {
                emails.push(data[i]["email"]);
            }

            appendEmail(emails);
        }
    }

    xhr.open("GET", "resources/php/in_development/messaging_system/get_contacts.php?", true);
    xhr.send();

}

addButton.addEventListener("click", function()
{
    const email = [emailInput.value.trim()];

    appendEmail(email);
});

function appendEmail(emails)
{
    for (let email of emails)
    {
        if (email)
        {
            let emailExists = false;
            // check if email already exists in list
            emailList.querySelectorAll("li").forEach(function(li)
            {
                const span = li.querySelector("span");
                if (span.innerText.toLowerCase() === email.toLowerCase())
                {
                    emailExists = true;
                }
            });
            if (!emailExists)
            {
                const li = document.createElement("li");
                const span = document.createElement("span");
                span.innerText = email;
                const viewButton = document.createElement("button");
                viewButton.classList.add("view-button");
                viewButton.innerText = "View";
                const removeButton = document.createElement("button");
                removeButton.classList.add("remove-button");
                removeButton.innerText = "Remove";
                li.appendChild(span);
                li.appendChild(viewButton);
                li.appendChild(removeButton);
                emailList.appendChild(li);
                emailInput.value = "";
                viewButton.addEventListener("click", function()
                {
                    // CHANGE THE PATH HERE IF NEEDED!
                    window.location.href = "./messaging.html?email=" + encodeURIComponent(email);
                    // alert(email);
                });
                removeButton.addEventListener("click", function()
                {
                    // TODO: Send the span.innerText (i.e. the
                    // email of the person who's Conversation
                    // the current user wants to delete) to
                    // the database to remove all Messages
                    // sent to/from the userID in our php
                    // session involving the email listed
                    // in span.innerText.
                    console.log(span.innerText);

                    var xhr = new XMLHttpRequest();

                    xhr.onreadystatechange = function() {

                        // var data = JSON.parse(this.responseText);

                        // console.log(data);

                        // Do stuff with the returned data if a
                        // functionality down the road requires it

                    }

                    xhr.open("GET", "resources/php/in_development/messaging_system/remove_contact.php?email=" + encodeURIComponent(span.innerText), true);
                    xhr.send();

                    emailList.removeChild(li);
                });
            }
        }
    }
}