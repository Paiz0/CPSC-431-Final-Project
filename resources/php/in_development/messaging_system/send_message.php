<?php

// Note that this file requires the JavaScript to harvest
// the email of the person we intend to send messages to in
// order to work.

session_start();

require_once '../class_message_handler.php';

// Get the message we're sending
$message = $_GET["message"];

// Get the email that was provided by the JavaScript
$email = $_GET["email"];

// Create a new database instance
$db = new Database(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);

// Establish the database connection
$db->establishConnection();

// Create an object for performing queries
$message_handler = new QueryMessageHandler($db);

// Convert the email to an ID
$id = $message_handler->getIDFromEmail($email)[0]["userID"];

// Send the message to the person with $id
$message_handler->sendMessage($_SESSION["userID"], $id, $message);

// Close the database connection, because it's no longer needed
$db->closeConnection();

// Send data as JSON
header('Content-Type: application/json');
// echo json_encode($result);

// echo var_dump($_SESSION);
// // echo $email;
// echo var_dump($id);
// // echo gettype($email);

?>