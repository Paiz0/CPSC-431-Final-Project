<?php

require_once 'config.php';

// We need a php session to be established
// for the purposes of $obj.

// Start the session if it doesn't exist
// if (session_status() === PHP_SESSION_NONE)
// {
//     session_start();
// }

// // Hash the password
// $hashed_password = password_hash($plain_text_password, PASSWORD_DEFAULT);

// // Check if the plain-text password matches the hashed password
// if (password_verify($plain_text_password, $hashed_password)) {
//     // Password is correct
// } else {
//     // Password is incorrect
// }


// create a class to handle database connections
class Database
{
    // This is the PDO connection instance
    private $pdo;

    // The idea behind a static variable is that it's
    // accessible without the class needing to be declared.
    // We use this to detect if an instance of ourselves has been
    // created or not so that we don't connect to the same
    // database every time a database connection is needed.

    // private static $instance = false;

    // Connection information
    private $host;
    private $db_name;
    private $username;
    private $password;

    public function __construct($host, $db_name, $username, $password)
    {
        // Store all connection details
        $this->host = $host;
        $this->db_name = $db_name;
        $this->username = $username;
        $this->password = $password;

        // Now an instance of the class has been made
        // self::$instance = true;
    }

    // Make sure that the function is accessible without the class needing
    // to be instantiated with the "static" keyword
    // public static function getInstance()
    // {
    //     // Return whether an instance of this class has been made
    //     // yet or not
    //     return self::$instance;
    // }

    public function establishConnection()
    {
        // DSN = Data Source Name
        $dsn = "mysql:host=$this->host;dbname=$this->db_name";

        // Try to establish a connection to the database
        try
        {
            $this->pdo = new PDO($dsn, $this->username, $this->password);
            // The following line ensures that if PDO experiences an error
            // it'll throw a PDOException error.
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        // Die if you can't connect to the database
        catch (PDOException $exception)
        {
            die("Failed to connect to the database: " . $exception->getMessage());
            // throw new MyDatabaseException($exception->getMessage(), $exception->getCode());
        }
    }

    public function closeConnection()
    {
        // Since $pdo is a ptr, set it to point to null
        $pdo = null;
    }

    // Establish all get methods (no need for set methods unless we allow the user
    // to change their information spontaneously)
    public function connection()
    {
        return $this->pdo;
    }

    public function host()
    {
        return $this->host;
    }

    public function db_name()
    {
        return $this->db_name;
    }

    public function username()
    {
        return $this->username;
    }

    public function password()
    {
        return $this->password;
    }

}

// Create a Database object if one hasn't been created yet
// if (!Database::getInstance())
// {
//     // Create an instance of the database
//     $obj = new Database(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);

//     $_SESSION['db'] = $obj;
// }

// else
// {
//     $obj = $_SESSION['db'];
// }

// Create $obj if the session doesn't exist
// if (!isset($_SESSION['db']))
// {
//     $obj = new Database(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);

//     $_SESSION['db'] = $obj;
// }

// else
// {
//     $obj = $_SESSION['db'];
// }

?>