<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mdunite";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$userEmail = $_POST['email'];
$userPassword = $_POST['password'];

echo $userEmail;
echo $userPassword;

$sql = "SELECT * FROM medicalProfessional WHERE mpEmail = '$userEmail' and mpPassword = '$userPassword' ";
$result = $conn->query($sql);

$userPassword = '';

// Check if the user exists
if ($result->num_rows > 0) {
  session_start();
  $_SESSION['loggedin'] = TRUE;

  while($row = $result->fetch_assoc()) {
    $_SESSION['currentUser'] = $row["mpID"];
  }
  header("Location: dashboard.php");
  exit();
} else {
  header("Location: login.php");
}
$conn->close();
?>