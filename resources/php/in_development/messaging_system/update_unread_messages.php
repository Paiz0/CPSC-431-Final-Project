<?php

// Note that this file requires the JavaScript to harvest
// the email of the person we intend to send messages to in
// order to work.

session_start();

require_once '../class_message_handler.php';

if (isset($_SESSION["userID"]))
{
    $to_id = $_SESSION["userID"];
}

else
{
    // Send an empty array back to the js file
    header('Content-Type: application/json');
    echo json_encode([]);
}

// Get the email that was provided by the JavaScript
$email = $_GET["email"];

// Create a new database instance
$db = new Database(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);

// Establish the database connection
$db->establishConnection();

// Create an object for performing queries
$message_handler = new QueryMessageHandler($db);

// Convert the email to an ID
$from_id = $message_handler->getIDFromEmail($email)[0]["userID"];

// Update all messages sent by the other user to us as being "read"
$message_handler->updateStatusMessages($from_id, $to_id);

// Close the database connection, because it's no longer needed
$db->closeConnection();

// Send data as JSON
header('Content-Type: application/json');
echo json_encode([]);

?>