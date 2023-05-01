window.onload = function() {

	// Get the id of the extra-info field,
	// so we know whether to load specialties
	// or titles into the dropdown list.
	var dropdown_title = document.getElementById("extra-info");

	var xhr = new XMLHttpRequest();

	xhr.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			// Note that extra_info_type is so we can know
			// what the key is for the returned data.
			var extra_info = JSON.parse(this.responseText);
			var extra_info_type = null;

			// console.log(extra_info);

			// If the extra-info field contains
			// specialties, then load all specialties
			// from the database into a list
			if (dropdown_title.textContent === "Specialty:")
			{
				extra_info = extra_info["specialties"];
				extra_info_type = "title";
			}

			// Otherwise, if the extra-info field contains
			// provisions, then load all provisions
			// from the database into
			else if (dropdown_title.textContent === "Provision:")
			{
				extra_info = extra_info["provisions"];
				extra_info_type = "provision";
			}

			// console.log(extra_info);

			// Get the id of the "select" tag
			var dropdown_container = document.getElementById("title");

			// For every element in the returned list,
			// create a new "option" element with its
			// value being the value of the element and
			// append it to the "select" element.
			extra_info.forEach((dropdown_content) => {
				// Create the element that we're going to append to
				// the dropdown_container
				var dropdown_element = document.createElement("option");

				// Set the properties of the element
				dropdown_element.value = dropdown_content[extra_info_type];
				dropdown_element.textContent = dropdown_content[extra_info_type];

				// Append the element to the dropdown_container
				dropdown_container.appendChild(dropdown_element);
			});
		}
	};

	xhr.open("GET", "../get_specialties_provisions.php", true);
	xhr.send();

}


// JavaScript for adding titles to list
function addTitle()
{
    var title = document.getElementById("title").value;
    var list = document.getElementById("titleList");

    // Check if title is already in the list
    var titles = list.getElementsByTagName("li");
    for (var i = 0; i < titles.length; i++)
    {
        if (titles[i].textContent === title)
        {
            alert("Title already added to list!");
            return;
        }
    }

    var entry = document.createElement("li");
    entry.appendChild(document.createTextNode(title));
    list.appendChild(entry);

    // Update hidden input field with title list contents
    var titleListInput = document.getElementById("titleListInput");
    titleListInput.value = list.innerHTML;
}

function clearTitles()
{
	document.getElementById("titleList").innerHTML = "";
}


// JavaScript for showing titles in results list
// function showTitles()
// {
//     var titleList = document.getElementById("titleList");
//     var titles = titleList.getElementsByTagName("li");
//     var resultsList = document.getElementById("resultsList");
//     resultsList.innerHTML = "";

//     for (var i = 0; i < titles.length; i++)
//     {
//         var title = titles[i].textContent;
//         var entry = document.createElement("li");
//         entry.appendChild(document.createTextNode(title));
//         resultsList.appendChild(entry);
//     }
// }

function searchData()
{
	// Get the value of the search input (trim remove extra whitespaces
	// that are before or after the main string)
    var name = document.getElementById("name").value.trim();
	var zipcode = document.getElementById("zipcode").value.trim();
    var list = document.getElementById("titleList");
    var titles = list.getElementsByTagName("li");

    // Create a list to store all titles
    var titleValues = [];

    // Iterate through each title list element
    for (var i = 0; i < titles.length; i++)
    {
        // Add the title to the end of the list
        titleValues.push(titles[i].textContent);
    }

    // Create a comma separated string with all titles
    var titleQueryString = titleValues.join(",");

	// Create an AJAX request to send the search query to the server
	var xhr = new XMLHttpRequest();

	xhr.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			// When the response is received, update the table with the search results
			// Note: this.responseText is the XML data that was returned from the php
			// file. When we do JSON.parse() we're converting the data into a
			// JavaScript object. This allows us to access the query results in a
			// dictionary-like manner.
            console.log(this.responseText);
			var data = JSON.parse(this.responseText);
			var table = document.getElementById("data-table");
			var tbody = table.getElementsByTagName("tbody")[0];
			tbody.innerHTML = "";

			// Iterate over each row of data and append it to the table
			for (var i = 0; i < data.length; i++)
            {
				var row = data[i];
				var tr = document.createElement("tr");
				var name = document.createElement("td");
				name.textContent = row.name;
				var zipcode = document.createElement("td");
				zipcode.textContent = row.zipcode;
                var title = document.createElement("td");
				title.textContent = row.title;
				// var phone = document.createElement("td");
				// phone.textContent = row.phone;
				tr.appendChild(name);
                tr.appendChild(zipcode);
				// tr.appendChild(email);
                tr.appendChild(title);
				// tr.appendChild(phone);
				tbody.appendChild(tr);
			}
		}
	};

	// We use getData.php?search= because we're making a GET request to the php file.
	// Since we aren't submitting a form in the typical fashion (i.e. through the html
	// directly) then we need to find another way to provide parameters to the php file.
	// This is why we use a GET request, because we can specify the parameters in the
	// URL which we hand-craft ourselves with "getData.php?search=".
	xhr.open("GET", "test.php?name=" + encodeURIComponent(name) + "&zipcode=" + encodeURIComponent(zipcode) + "&titles=" + encodeURIComponent(titleQueryString), true);
	xhr.send();
}