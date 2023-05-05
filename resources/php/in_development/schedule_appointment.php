<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

require_once 'class_appointment_handler.php';

if (!isset($_SESSION["userID"]))
{
    // Send data as JSON
    header('Content-Type: application/json');
    echo json_encode([]);
}

// Get the time, date and description parameters
$userID = $_GET["userID"];
$datetime = $_GET["datetime"];
// $date = $_GET["date"];
$description = $_GET["description"];

// Create a new database instance
$db = new Database(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);

// Establish the database connection
$db->establishConnection();

// Create an object for performing queries related to filtering
// users.
$appt_handler = new QueryAppointmentHandler($db);

// Get the results after performing the query that filters suppliers
// by name, zipcode and provisions that were entered earlier
$appt_handler->createAppointment($_SESSION["userID"], $userID, $datetime, $description);

// Close the database connection, because it's no longer needed
$db->closeConnection();

// Send data as JSON
header('Content-Type: application/json');
echo json_encode([$userID, $datetime, $description]);
?>