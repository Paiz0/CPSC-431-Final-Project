<?php

session_start();

require_once 'class_appointment_handler.php';
require_once 'class_query_user_status.php';

if (isset($_SESSION["userID"]))
{
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

// Create an appointment handler instance so that we can
// retrieve appointment information
$appt_handler = new QueryAppointmentHandler($db);

// Create an object for performing queries related to getting
// user information from a userID
$extra_info = new QueryUserStatus($db);

// Get the incoming appointments
$incoming_rejected = $appt_handler->getRejectedAppointments($userID, $incoming=true);
$incoming_pending = $appt_handler->getPendingAppointments($userID, $incoming=true);
$incoming_accepted = $appt_handler->getAcceptedAppointments($userID, $incoming=true);

// Consolidate the incoming appointments
$incoming_appts = ["incoming" => ["rejected" => $incoming_rejected, "pending" => $incoming_pending, "accepted" => $incoming_accepted]];

// Add additional info from the Users table to the incoming appointments
foreach ($incoming_appts["incoming"] as $apptStatus => $apptDetails)
{
    // Store the result of the profile info we retrieve from QueryUserStatus.
    $new_info = $extra_info->FindProfile($incoming_appts["incoming"][$apptStatus][0]["userIDSender"]);

    // Remove the userID from our incoming appointments (it's no longer needed after the
    // previous query was executed)
    // unset($incoming_appts["incoming"][$apptStatus]["userIDSender"]);

    // Merge the new info into the key/value pair involving $apptStatus
    // as the key and the value as being new_info + the old details
    if (!empty($incoming_appts["incoming"][$apptStatus]) && !empty($new_info))
    {
        $incoming_appts["incoming"][$apptStatus][0] = $incoming_appts["incoming"][$apptStatus][0] + $new_info;
    }
    else if (!empty($new_info))
    {
        $incoming_appts["incoming"][$apptStatus][0] = $new_info;
    }
}

// Get the outgoing appointments
$outgoing_rejected = $appt_handler->getRejectedAppointments($userID, $incoming=false);
$outgoing_pending = $appt_handler->getPendingAppointments($userID, $incoming=false);
$outgoing_accepted = $appt_handler->getAcceptedAppointments($userID, $incoming=false);

// Consolidate the outgoing appointments
$outgoing_appts = ["outgoing" => ["rejected" => $outgoing_rejected, "pending" => $outgoing_pending, "accepted" => $outgoing_accepted]];

// Add additional info from the Users table to the outgoing appointments
foreach ($outgoing_appts["outgoing"] as $apptStatus => $apptDetails)
{
    // Store the result of the profile info we retrieve from QueryUserStatus.
    $new_info = $extra_info->FindProfile($outgoing_appts["outgoing"][$apptStatus][0]["userIDReceiver"]);

    // Remove the userID from our outgoing appointments (it's no longer needed after the
    // previous query was executed)
    // unset($outgoing_appts["outgoing"][$apptStatus]["userIDReceiver"]);

    // Merge the new info into the key/value pair involving $apptStatus
    // as the key and the value as being new_info + the old details
    if (!empty($outgoing_appts["outgoing"][$apptStatus]) && !empty($new_info))
    {
        $outgoing_appts["outgoing"][$apptStatus][0] = $outgoing_appts["outgoing"][$apptStatus][0] + $new_info;
    }
    else if (!empty($new_info))
    {
        $outgoing_appts["outgoing"][$apptStatus][0] = $new_info;
    }
}

// Create the results list containing all provisions
// and all specialties
$results = array_merge($incoming_appts, $outgoing_appts);

// Close the database connection, because it's no longer needed
$db->closeConnection();

// Send data as JSON
header('Content-Type: application/json');
echo json_encode($results);

// header('Content-Type: application/json');
// echo json_encode($incoming_pending);

?>