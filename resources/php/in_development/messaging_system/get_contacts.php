<?php

// Connect to the database
// $host = "localhost";
// $username = "root";
// $password = "";
// $dbname = "mdunite";
// $conn = new mysqli($host, $username, $password, $dbname);
// if ($conn->connect_error) {
// 	die("Connection failed: " . $conn->connect_error);
// }

session_start();

require_once '../class_message_handler.php';

if (isset($_SESSION["userID"]))
{
    // Retrieve the session data for the
    // currently logged in user.
    $userID = $_SESSION["userID"];
}

else
{
    header('Content-Type: application/json');
    echo json_encode([]);
}

// Create a new database instance
$db = new Database(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);

// Establish the database connection
$db->establishConnection();

// Create an object for performing queries related to filtering
// users.
$msg_handler = new QueryMessageHandler($db);

// Get the results after performing the query that filters suppliers
// by name, zipcode and provisions that were entered earlier
$results = $msg_handler->findContacts($userID);


// $sql = "SELECT * FROM Users WHERE zipcode = $zipcode";
// $result = $conn->query($sql);

// $data = array();
// if (count($results) > 0)
// {
//     $i = 0;
// 	while ($i < count($results))
//     {
// 		$data[] = $results[$i];
// 	}
// }

// Close the database connection, because it's no longer needed
$db->closeConnection();

// Send data as JSON
header('Content-Type: application/json');
echo json_encode($results);
// echo json_encode($data);

// Close the database connection
// $conn->close();







// echo $_GET['zipcode']."<br>";

// echo $_GET['titles']."<br>";

// $data = "entry1: value1, entry2: value2";


// header('Content-Type: application/json');
// echo json_encode($data);

?>