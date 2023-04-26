function searchData() {
	// Get the value of the search input (trim remove extra whitespaces
	// that are before or after the main string)
	var search = document.getElementById("search").value.trim();

	// Create an AJAX request to send the search query to the server
	var xhr = new XMLHttpRequest();

	xhr.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			// When the response is received, update the table with the search results
			// Note: this.responseText is the XML data that was returned from the php
			// file. When we do JSON.parse() we're converting the data into a
			// JavaScript object. This allows us to access the query results in a
			// dictionary-like manner.
			var data = JSON.parse(this.responseText);
			var table = document.getElementById("data-table");
			var tbody = table.getElementsByTagName("tbody")[0];
			tbody.innerHTML = "";

			// Iterate over each row of data and append it to the table
			for (var i = 0; i < data.length; i++) {
				var row = data[i];
				var tr = document.createElement("tr");
				var name = document.createElement("td");
				name.textContent = row.name;
				var email = document.createElement("td");
				email.textContent = row.email;
				var phone = document.createElement("td");
				phone.textContent = row.phone;
				tr.appendChild(name);
				tr.appendChild(email);
				tr.appendChild(phone);
				tbody.appendChild(tr);
			}
		}
	};
	// We use getData.php?search= because we're making a GET request to the php file.
	// Since we aren't submitting a form in the typical fashion (i.e. through the html
	// directly) then we need to find another way to provide parameters to the php file.
	// This is why we use a GET request, because we can specify the parameters in the
	// URL which we hand-craft ourselves with "getData.php?search=".
	xhr.open("GET", "getData.php?search=" + search, true);
	xhr.send();
}
