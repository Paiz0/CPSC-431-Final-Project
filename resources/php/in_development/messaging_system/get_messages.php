<?php

// Note that this file requires the JavaScript to harvest
// the email of the person we intend to send messages to in
// order to work.

session_start();

require_once '../class_message_handler.php';

// Get the email that was provided by the JavaScript
$email = $_GET["email"];

// Create a new database instance
$db = new Database(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);

// Establish the database connection
$db->establishConnection();

// Create an object for performing queries
$message_handler = new QueryMessageHandler($db);

# Convert the email to an ID
$id = $message_handler->getIDFromEmail($email)[0]["userID"];

// This gets the associative array of messages sent by
// the logged in user
$from_user = $message_handler->readMessages($_SESSION["userID"], $id);

// This gets the associative array of messages sent to
// the logged in user
$to_user = $message_handler->readMessages($id, $_SESSION["userID"]);

// Get all messages sent/received by the logged in user
$results = array_merge($from_user, $to_user);

// Get the list of sorted values
$sorted_result = array();
foreach ($results as $item)
{
    // Our end goal is to sort $results by msgID in
    // an increasing order so we can properly display
    // all messages in accordanence with time.
    $sorted_result[] = $item["msgID"];
}

// Sort the $results associative array by the values in $sorted_result
array_multisort($sorted_result, SORT_ASC, $results);

// Close the database connection, because it's no longer needed
$db->closeConnection();

// Send data as JSON
header('Content-Type: application/json');
echo json_encode($results);

// echo var_dump($_SESSION);
// // echo $email;
// echo var_dump($id);
// // echo gettype($email);

?>