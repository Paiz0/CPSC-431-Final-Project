
<?php
$servername = "localhost";
$database = "mdunite";
$username = "root";
$password = "";

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Check the connection
if (!$conn) {
     die("Connection failed: " . mysqli_connect_error());
}


$mpFullName = $_POST["full_name"];
$mpEmail = $_POST["email"];
$mpPassword = $_POST["password"];
$mpzip = $_POST["zip"];
$mpTitle = $_POST["title"];
$radioVal = $_POST["MyRadio"];

// echo $mpFullName;
// echo $mpEmail;
// echo $mpPassword;
// echo $mpzip;
// echo $mpTitle;
if($radioVal == "First")
{
    //echo("You choose Yes");
    $radioVal = 1;
}
else if ($radioVal == "Second")
{
     $radioVal = 0;
    //echo("You choose No");
}

$sql = "INSERT INTO medicalProfessional(mpTitle, mpEmail, mpPassword, mpLocation, mpContact, mpFullName) VALUES ('$mpTitle','$mpEmail','$mpPassword','$mpzip ','$radioVal','$mpFullName')";


if (mysqli_query($conn, $sql)) {
     echo "Account creation successfull";
     echo "<a href='../../login.php'>You may login</a>";
   } else {
     echo "Error: " . $sql . "<br>" . mysqli_error($conn);
   }




mysqli_close($conn);
?>