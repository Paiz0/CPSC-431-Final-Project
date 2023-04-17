<?php

##############################################################################

# TODO: Figure out if you need to leave "status" as serialized
#       or just serialize its components. Also, decide if you
#       need to keep the Database class or only the establishConnection()
#       function.

##############################################################################

require_once './in_development/class_query_user_status.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

echo "Testing!";
echo $_SESSION['loggedin'];
// $status = unserialize($_SESSION['status']);
// echo $status->test();
// echo $_SESSION['email'];

if (!empty($_SESSION['loggedin'])) {
    //Code that will get current value of submit button clicked
    echo "You're logged in!";
    // exit;
}

echo "<a href = './logout.php'> Logout </a>";

// require 'database_modularized_gpt.php';

// $myVar = new Test();

// echo "<a href='../../login.html'>You may login</a>";

?>