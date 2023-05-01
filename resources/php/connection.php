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
}else{
    echo "connection successfull";
}

// $conn = new mysqli($servername, $username, $password);
// if ($conn->connect_error) {
//   die("Connection failed: " . $conn->connect_error);
// }elseif (!mysqli_select_db($conn,$dbname)) {
//   $sql = "CREATE DATABASE " . $dbname;
//   $newconn = new mysqli($servername, $username, $password, $dbname);
//   $sqlfile = file_get_contents("mdunite_2.sql");
//   $newconn->multi_query(($sqlfile));
//   if ($conn->query($sql) === TRUE) {
//       echo "Database created successfully";
//   }else {
//       echo "Error creating database: " . $conn->error;
//   }
// }

?>