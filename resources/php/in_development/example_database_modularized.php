<?php

// ChatGPT created this code. Use it as a template to make something
// similar for our final project. We're going to need to create more classes
// for each category of query we're planninng on making so that everything is
// modularized. A rule of thumb is to have one class for every unique php file
// that needs some degree of access to the database.

class Test {

    public function __construct() {

        echo "Hello!";

    }

}

// create a class to handle database connections
class Database {
    private $pdo;

    public function __construct($host, $db_name, $username, $password) {
        // DSN = Data Source Name
        $dsn = "mysql:host=$host;dbname=$db_name";
        $this->pdo = new PDO($dsn, $username, $password);
    }

    public function query($sql, $params = []) {
        $statement = $this->pdo->prepare($sql);
        $statement->execute($params);
        return $statement;
    }
}

// create a class to handle user queries
class UserQueries {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function getByUsername($username) {
        $sql = "SELECT * FROM users WHERE username = ?";
        $params = [$username];
        $statement = $this->db->query($sql, $params);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function getByEmail($email) {
        $sql = "SELECT * FROM users WHERE email = ?";
        $params = [$email];
        $statement = $this->db->query($sql, $params);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    // add other user-related queries here
}

// usage example
// $db = new Database('localhost', 'my_database', 'my_username', 'my_password');
// $user_queries = new UserQueries($db);
// $user = $user_queries->getByUsername('my_username');

?>