// const buttonDeny = document.getElementById("1");

// document.getElementById.addEventListener('click', function(event){removeEntry(this.id)});


// function removeEntry(id) {
//     const deniedApt = document.getElementById(id);
//     while (deniedApt.firstChild) {
//         deniedApt.removeChild(deniedApt.lastChild);
//     }
// }

const deny = document.querySelector(".deny");
deny.onclick = e=()=>{
    const denyDiv = document.getElementById("1");
    denyDiv.innerHTML = '';
    console.log(denyDiv);
}

const accept = document.querySelector(".accept");
accept.onclick = ()=> {
    const oldName = document.querySelector(".name");
    const oldEmail = document.querySelector(".email");
    const oldDate = document.querySelector(".date");
    const oldTime = document.querySelector(".time");
    const oldNotes = document.querySelector(".notes");

    const newName = document.querySelector(".nameA");
    const newEmail = document.querySelector(".emailA");
    const newDate = document.querySelector(".dateA");
    const newTime = document.querySelector(".timeA");
    const newNotes = document.querySelector(".notesA");

    if(document.getElementById("1A").firstChild){
        newName.innerHTML = oldName.innerHTML;
        newEmail.innerHTML = oldEmail.innerHTML;
        newDate.innerHTML = oldDate.innerHTML;
        newTime.innerHTML = oldTime.innerHTML;
        newNotes.innerHTML = oldNotes.innerHTML;
        e();
    }
    else{
        const newDiv = document.createElement("div");
        const newP = document.createElement("p");
        const newI = document.createElement("i");

        newDiv.className = "appts";
        document.getElementById("1A").appendChild(newDiv);
        newDiv.className = "result-notes"
        document.getElementById("1A").appendChild(newDiv);
        newP.className = "notesA";
        document.querySelector(".result-notes").appendChild(newP);

        newDiv.className = "result"
        newP.className = "nameA";
        document.querySelector(".appts").appendChild(newDiv).appendChild(newP);
        

        newDiv.className = "result";
        newP.className = "emailA";
        document.querySelector(".appts").appendChild(newDiv).appendChild(newP);

        newDiv.className = "result";
        newP.className = "dateA";
        document.querySelector(".appts").appendChild(newDiv).appendChild(newP);

        newDiv.className = "result";
        newP.className = "timeA";
        document.querySelector(".appts").appendChild(newDiv).appendChild(newP);

        console.log(document.getElementById("1A"));

        newName.innerHTML = oldName.innerHTML;
        newEmail.innerHTML = oldEmail.innerHTML;
        newDate.innerHTML = oldDate.innerHTML;
        newTime.innerHTML = oldTime.innerHTML;
        newNotes.innerHTML = oldNotes.innerHTML;

        newDiv.className = "checkmark";
        newI.className = "fa-solid fa-check fa-2xl";
        newI.style = "color: #00c760;";
        document.querySelector(".appts").appendChild(newDiv).appendChild(newI);

    }

 

}