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

require_once '../class_query_filter_user.php';

// Retrieve the data that was inputted into the search
// parameters
$name = $_GET["name"];
$zipcode = $_GET["zipcode"];
// $titles = $_GET["titles"];

// Create a new database instance
$db = new Database(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);

// Establish the database connection
$db->establishConnection();

// Create an object for performing queries related to filtering
// users.
$filter_user = new QueryFilterUser($db);

if (isset($_GET["specialties"]))
{
    $extra_info = $_GET["specialties"];

    // Convert the "extra_info" string into an array
    $extra_info = explode(",", $extra_info);

    // Get the results after performing the query that filters suppliers
    // by name, zipcode and provisions that were entered earlier
    $results = $filter_user->FilterDoctors($name, $zipcode, $extra_info);
}

else if (isset($_GET["provisions"]))
{
    $extra_info = $_GET["provisions"];

    // Convert the "extra_info" string into an array
    $extra_info = explode(",", $extra_info);

    // Get the results after performing the query that filters suppliers
    // by name, zipcode and provisions that were entered earlier
    $results = $filter_user->FilterSuppliers($name, $zipcode, $extra_info);
}

// // Convert the "extra_info" string into an array
// $extra_info = explode(",", $extra_info);

// // Get the results after performing the query that filters suppliers
// // by name, zipcode and provisions that were entered earlier
// $results = $filter_user->FilterDoctors($name, $zipcode, $extra_info);


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