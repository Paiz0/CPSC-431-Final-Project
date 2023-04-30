<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);


session_start();

require_once './in_development/class_query_user_status.php';

// Get the form variables
$full_name = $_POST["full_name"];
$email = $_POST["email"];
$password = $_POST["password"];
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
$zipcode = $_POST["zip"];
$usertype_radio = $_POST["usertype-radio"];
$contactable_radio = $_POST["contactable-radio"];

echo "Contactable radio: " . $contactable_radio;
echo "Usertype radio: " . $usertype_radio;

// Note that the values we're choosing for the
// doctor/supplier is the opposite of what
// 431_SQL_v3.sql does when initializing
// default value
if ($usertype_radio == "Doctor")
{
    $is_doctor = DOCTOR_TYPE;
    $extra_info = $_POST["specialty"];
}

else if ($usertype_radio == "Supplier")
{
    $is_doctor = SUPPLIER_TYPE;
    $extra_info = $_POST["provision"];
}

else
{
    exit();
}

// Set the radio buttons depending on what
// value was chosen
if ($contactable_radio == "Yes")
{
    $contactable_radio = RADIO_ON;
}

else if ($contactable_radio == "No")
{
    $contactable_radio = RADIO_OFF;
}

// Create a new database instance
$db = new Database(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);

// Establish the database connection
$db->establishConnection();

// Create an object for performing queries related to querying
// user information
$new_user = new QueryUserStatus($db);

// Create the new user
$new_user->CreateUser($full_name, $email, $hashed_password, $zipcode, $is_doctor, $contactable_radio);

// Get the new user's information
$user_info = $new_user->FindUser($email, $password);

// echo var_dump($user_info["userID"]);

// echo "<br>" . $user_info;

if ($is_doctor)
{
    // Create a doctor with our new userID
    $new_user->CreateDoctor($user_info["userID"]);

    // Get the new user's doctor information
    $doctor_info = $new_user->FindDoctor($user_info["userID"]);

    // Insert our specialty into the table
    $new_user->CreateSpecialty($user_info["userID"], $doctor_info["doctorID"], $extra_info);
}

else
{
    // Create a supplier with our new userID
    $new_user->CreateSupplier($user_info["userID"]);

    // Get the new user's speciality information
    $supplier_info = $new_user->FindSupplier($user_info["userID"]);

    // Insert our provision into the table
    $new_user->CreateProvision($user_info["userID"], $supplier_info["supplierID"], $extra_info);
}

// Close the database connection, because it's no longer needed
$db->closeConnection();

header("Location: ../../login.html");

?>