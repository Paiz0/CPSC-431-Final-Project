<?php

##############################################################################

# TODO: Uncomment the lines where $db and $status are serialized (if needed)

##############################################################################

// The goal of this file is to take information filled out in the login.html form,
// open up a database connection and pass the email/password fields off for
// processing in the QueryUserStatus class. If the user information is correct,
// we redirect them to the dashboard page.

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// This file needs access to the database and necessary query files
require_once 'class_query_user_status.php';

// Redirect the user to the new page if they're logged in
if (!empty($_SESSION['loggedin']))
{
    header("Location: ../test.php");
    // header('Cache-Control: no cache');
    // header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    // header("Cache-Control: post-check=0, pre-check=0", false);
    // header("Pragma: no-cache");
    // session_cache_limiter('private_no_expire');
    // session_start();
}

// If the session exists, then check if the user is logged in and if not then continue
// (This is still a TODO)
// else
// {
//     // Redirect the user to the dashboard since they're logged in
//     // header("Location: ../test.php");
//     // echo "Make sure to add some verification so that we know whether the user is logged in<br>";
//     // echo "For example, you may need to add something to the session like \$_SESSION['loggedin']<br>";
//     // echo "< Replace this line with 'header('Location: dashboard.php')' when you're done testing >";
//     // die("Make sure to implement your design here!");
// }

// Store the form information from login.html
$email = $_POST['email'];
$password = $_POST['password'];

// Create a connection to the database if it hasn't been made yet
if (empty($_SESSION['db']))
{
    // Create an object that connects to the database
    $db = new Database(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);

    $_SESSION['db'] = serialize($db);
}

else
{
    $db = unserialize($_SESSION['db']);
}

// header("Location: ../test.php");
// exit();

// Create a QueryUserStatus object for checking if the user exists or not
if (empty($_SESSION['status']))
{
    // Create an object for querying about the user's status
    $user_status = new QueryUserStatus($db);

    $_SESSION['status'] = serialize($user_status);
}

else
{
    $user_status = unserialize($_SESSION['status']);
}

// Pass the email and password to the UserExists() function to see if the
// user with the provided form information exists or not
if ($user_status->UserExists($email, $password))
{
    $_SESSION['loggedin'] = true;
    header("Location: ../test.php");
    // echo "The user exists!<br>";
    // echo "TODO: Redirect the user to the dashboard";
}

else
{
    header("Location: ../../../login.html");
    // echo "The user doesn't exist!<br>";
    // echo "TODO: Redirect the user back to the login page";
}

// echo "<a href='../logout.php'>Logout</a>";
// echo "Session: " . $_SESSION['loggedin'];

?>