<!-- This functionality is primarily for the "Find Doctors" page -->

<!DOCTYPE html>
<html>
<head>
	<title>Text Box Entry</title>
	<style>
		.item {
			display: flex;
			align-items: center;
			justify-content: space-between;
			padding: 10px;
			margin-bottom: 10px;
			background-color: #f9f9f9;
			border: 1px solid #ddd;
			border-radius: 5px;
			box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.1);
			font-size: 18px;
            margin: 0 auto;
		}

		.item span {
			margin-right: 10px;
		}

		.item button {
			background-color: #d9534f;
			color: #fff;
			border: none;
			border-radius: 50%;
			width: 25px;
			height: 25px;
			cursor: pointer;
			font-size: 14px;
			line-height: 1;
		}
	</style>
</head>
<body>
	<h1>Text Box Entry</h1>
	<form>
		<label for="item">Add Item:</label>
		<input type="text" id="item" name="item">
		<button type="button" onclick="addItem()">Add</button>
	</form>
	<div id="list"></div>

	<script>
		function addItem() {
			// Get the input value
			var item = document.getElementById("item").value;

			// Create a new item element
			var newItem = document.createElement("div");
			newItem.className = "item";

			// Add the item text
			var itemText = document.createElement("span");
			itemText.textContent = item;
			newItem.appendChild(itemText);

			// Add the delete button
			var deleteButton = document.createElement("button");
			deleteButton.textContent = "X";
			deleteButton.addEventListener("click", function() {
				newItem.remove();
			});
			newItem.appendChild(deleteButton);

			// Add the item to the list
			document.getElementById("list").appendChild(newItem);

			// Clear the input
			document.getElementById("item").value = "";
		}
	</script>
</body>
</html>
