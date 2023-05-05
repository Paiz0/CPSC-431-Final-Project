<?php

session_start();

require_once '../class_message_handler.php';
require_once '../class_query_user_status.php';

if (!isset($_SESSION["userID"]))
{
    // Send data as JSON
    header('Content-Type: application/json');
    echo json_encode([]);
}

// Get the email parameter from the URL
$email = $_GET["email"];

// Create a new database instance
$db = new Database(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);

// Establish the database connection
$db->establishConnection();

// Create an object for performing queries related to filtering
// users.
$msg_handler = new QueryMessageHandler($db);

$user_info = new QueryUserStatus($db);

// Get the userID associated with $email
$id = $user_info->FindUserID($email)["userID"];

// Get the results after performing the query that filters suppliers
// by name, zipcode and provisions that were entered earlier
$msg_handler->deleteContact($id, $_SESSION["userID"]);

// Close the database connection, because it's no longer needed
$db->closeConnection();

// Send data as JSON
header('Content-Type: application/json');
echo json_encode([$id, $_SESSION["userID"]]);
?>