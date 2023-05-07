<?php

session_start();

require_once 'class_appointment_handler.php';

if (isset($_GET["apptID"]))
{
    $apptID = $_GET["apptID"];
}

else
{
    header('Content-Type: application/json');
    echo json_encode([]);
}

if (!isset($_GET["accepted"]))
{
    header('Content-Type: application/json');
    echo json_encode([]);
}

// Create a new database instance
$db = new Database(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);

// Establish the database connection
$db->establishConnection();

// Create an appointment handler instance so that we can
// retrieve appointment information
$appt_handler = new QueryAppointmentHandler($db);

// Check if the accepted or denied button were pressed
if ($_GET["accepted"] == "1")
{
    $appt_handler->acceptAppointment($apptID);
}

else
{
    $appt_handler->denyAppointment($apptID);
}

// Close the database connection, because it's no longer needed
$db->closeConnection();

// Send data as JSON
header('Content-Type: application/json');
echo json_encode([]);

// header('Content-Type: application/json');
// echo json_encode($incoming_pending);

?>