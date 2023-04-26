<?php
// Connect to the database
$host = "localhost";
$username = "root";
$password = "";
$dbname = "mdunite";
$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

// Retrieve data based on search query
$search = $_GET["search"];
$sql = "SELECT * FROM Users WHERE name LIKE '%$search%'";
$result = $conn->query($sql);
$data = array();
if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		$data[] = $row;
	}
}

// Send data as JSON
header('Content-Type: application/json');
echo json_encode($data);

// Close the database connection
$conn->close();
?>
