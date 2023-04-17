<?php

session_start();
$_SESSION = array();
unset($_SESSION['loggedin']);
session_unset();
session_destroy();

// if (isset($_SESSION))
// {
//     echo "Session is in progress!";
// }

header('Location: ../../login.html');
?>