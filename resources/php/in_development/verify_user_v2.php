<?php

session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

// This file needs access to the database and necessary query files
require_once 'class_query_user_status.php';

// If the user is logged in, redirect them to the dashboard
if (!empty($_SESSION['loggedin']))
{
    // Check if the user is a doctor
    if (!empty($_SESSION['type']) && $_SESSION['type'])
    {
        header("Location: ../../../dashboard_supplier.html");
    }

    else
    {
        header("Location: ../../../dashboard_doctor.html");
    }

    // header("Location: ../dashboard.php");
}

// Store the form information from login.html
$email = $_POST['email'];
$password = $_POST['password'];

// Create a new database instance
$db = new Database(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);

// Establish the database connection
$db->establishConnection();

// Create a new query object to check the user's status
$user_status = new QueryUserStatus($db);

// Find the user with the given email and password
$user = $user_status->FindUser($email, $password);

// Terminate the database connection
$db->closeConnection();

// Check to see if the user exists in the database and redirect
// them to the dashboard if they do exist
if ($user != null)
{
    $_SESSION['loggedin'] = true;
    $_SESSION['userID'] = $user['userID'];
    $_SESSION['name'] = $user['name'];
    $_SESSION['email'] = $email;
    $_SESSION['password'] = $password;
    $_SESSION['zipcode'] = $user['zipcode'];
    $_SESSION['type'] = $user['type'];

    // Check if the user is a supplier
    if ($user['type'])
    {
        header("Location: ../../../dashboard_supplier.php");
    }

    // Otherwise they're a doctor
    else
    {
        header("Location: ../../../dashboard_doctor.php");
    }

    // header("Location: ../dashboard.php");
}

// If they don't exist, redirect them back to the login page
else
{
    header("Location: ../../../login.html");
}

?>