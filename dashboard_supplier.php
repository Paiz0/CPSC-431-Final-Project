<?php

session_start();

require_once 'resources\php\in_development\config.php';

// Check if the user isn't logged in
if (empty($_SESSION['loggedin'])) {
  header('Location: ./login.html');
  exit;
}

// Make sure the user isn't pretending to be a doctor
else if ($_SESSION['type'] != SUPPLIER_TYPE)
{
  header('Location: ./dashboard_doctor.php');
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./resources/css/style_dashboard.css">
    <title>My Dashboard</title>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <nav class="navbar">
          <h1>MD Unite</h1>
          <ul>
            <li>
              <a href="./landing.php">Home</a>
              <a href="./resources/php/logout.php">Logout</a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
    <header>
      <h1>My Dashboard</h1>
    </header>
    <div class="btn-body">
        <div class="button-container">
            <button class="button" onclick="window.location.href='./edit_profile.html'">Edit Profile</button>
            <hr>
            <button class="button" onclick="window.location.href='./filter_doctors.html'">Find Doctors</button>
            <hr>
            <button class="button" onclick="window.location.href='./conversations.html'">Messaging</button>
          </div>
    </div>
  </body>
</html>