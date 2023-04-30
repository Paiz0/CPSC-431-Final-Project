const emailInput = document.getElementById("email-input");
const addButton = document.getElementById("add-button");
const emailList = document.getElementById("email-list");

addButton.addEventListener("click", function()
{
    const email = emailInput.value.trim();
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
                window.location.href = "../../../../messaging.html?email=" + encodeURIComponent(email);
                // alert(email);
            });
            removeButton.addEventListener("click", function()
            {
                emailList.removeChild(li);
            });
        }
    }
});