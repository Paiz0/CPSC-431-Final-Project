<?php

session_start();

require_once 'class_query_user_status.php';

// Create a new database instance
$db = new Database(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);

// Establish the database connection
$db->establishConnection();

// Create an object for performing queries related to filtering
// users.
$extra_info = new QueryUserStatus($db);

// Get the results after applying:
// 1) A search for all specialties
// 2) A search for all provisions
$specialties = $extra_info->GetSpecialities();
$provisions = $extra_info->GetProvisions();

// Create the results list containing all provisions
// and all specialties
$results = array("specialties" => $specialties, "provisions" => $provisions);

// Close the database connection, because it's no longer needed
$db->closeConnection();

// Send data as JSON
header('Content-Type: application/json');
echo json_encode($results);

?>