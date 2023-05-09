<?php

session_start();

require_once 'class_query_user_status.php';

// Check if the userID is provided (i.e. in the
// case of profile.js).
// If userID isn't provided, then we're loading
// information about the default user
if (isset($_SESSION["userID"]) && isset($_GET["name"]) && isset($_GET["zipcode"]) && isset($_GET["contactable"]))
{
    // Get the session variable for userID
    $userID = $_SESSION["userID"];

    // Get the URL parameters
    $name_updated = $_GET["name"];
    $zipcode_updated = $_GET["zipcode"];
    $contactable_updated = $_GET["contactable"];
}

// Otherwise nothing is set and we can't load
// anything
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
$user = new QueryUserStatus($db);

// Search for the user's profile based on the userID from the
// URL
$user->UpdateUser($userID, $name_updated, $zipcode_updated, $contactable_updated);

// Close the database connection, because it's no longer needed
$db->closeConnection();

// Send data as JSON
header('Content-Type: application/json');
echo json_encode([]);

?>