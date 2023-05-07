<?php

session_start();

require_once './config.php';

// Check if the user isn't logged in and redirect them
// back to the login page if they aren't logged in
if (empty($_SESSION['loggedin'])) {
  header('Location: ../../../login.html');
  exit;
}

// Make sure the user isn't pretending to be a supplier
else if ($_SESSION['type'] != DOCTOR_TYPE)
{
  header('Location: ./dashboard_supplier.php');
  exit;
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <style>
      /* CSS code here */
      body {
        font-family: Arial, sans-serif;
        background-color: #FFA726;
      }
      
      .button-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-top: 50px;
      }
      
      .button {
        background-color: #4CAF50;
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
        border-radius: 8px;
      }
      
      .button:hover {
        background-color: #3e8e41;
      }
      
      .logout-button {
        background-color: #802525;
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 40px 2px;
        cursor: pointer;
        border-radius: 8px;
      }
      
      .logout-button:hover {
        background-color: #875656;
      }
      
      h1 {
        color: #800020;
        text-align: center;
        margin-top: 50px;
      }
    </style>
  </head>
  <body>
    <h1>Dashboard</h1>
    <div class="button-container">
      <button class="button" onclick="window.location.href='../../../edit_profile.html'">Edit Profile</button>
      <button class="button" onclick="window.location.href='./dynamic_form_passing/filter_suppliers.html'">Find Suppliers</button>
      <button class="button" onclick="window.location.href='./messaging_system/landing.html'">Messaging</button>
      <form method="post" action="../logout.php">
        <button type="submit" class="logout-button">Log Out</button>
      </form>
    </div>
  </body>
</html>
