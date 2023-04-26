<?php

// ChatGPT created the following code. This is an excellent example regarding how to use PDO.
// Modify this code and use it to redesign what we currently have in our final project.

// specify database connection details
$host = 'localhost';
$dbname = 'my_database';
$username = 'my_username';
$password = 'my_password';

// create a PDO object for database connection
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Failed to connect to database: " . $e->getMessage());
}

// perform a SELECT query
$sql = "SELECT * FROM users WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => 123]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// perform an INSERT query
$sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
$stmt = $pdo->prepare($sql);
$stmt->execute(['name' => 'John Doe', 'email' => 'john.doe@example.com', 'password' => 'secret']);
// Return the AUTO_INCREMENT id of the last inserted element
$new_user_id = $pdo->lastInsertId();

// perform an UPDATE query
$sql = "UPDATE users SET name = :name WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['name' => 'Jane Doe', 'id' => 123]);

// perform a DELETE query
$sql = "DELETE FROM users WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => 123]);
?>