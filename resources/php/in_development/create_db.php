<?php
// This file is invoked when the user visits the landing page

// Step 1: Create a database connection without specifying the database name
$servername = "localhost";
$username = "root";
$password = "";

$conn = mysqli_connect($servername, $username, $password);

// Step 2: Open the SQL file
$sql_file = fopen("resources/sql/431_SQL_v3.sql", "r");

// Step 3: Read the SQL file contents
$sql = fread($sql_file, filesize("resources/sql/431_SQL_v3.sql"));

// Step 4: Close the SQL file
fclose($sql_file);

// Step 5: Create the database using the SQL file
$result = mysqli_multi_query($conn, $sql);

// Step 6: Handle errors
if (!$result) {
    die("Error creating database: " . mysqli_error($conn));
}

// Step 7: Close the database connection without specifying the database name
mysqli_close($conn);
?>
