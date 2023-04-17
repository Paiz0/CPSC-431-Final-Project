<?php

// Need to include the Database class so we can pass
// a Database object to __construct.
require 'class_db.php';

// create a class to handle user queries
abstract class Query
{
    // A variable to store the database connection
    private $db;
    private $statement;

    // Once the user establishes the database connection,
    // the object should be passed to this constructor.
    public function __construct(Database $db, $statement = '')
    {
        $this->db = $db->connection();
        $this->statement = $statement;
    }

    // Executes an SQL query with parameters and returns the result
    final public function executeQuery($sql, $params)
    {
        # Execute the query in the database

        $statement = $this->db->prepare($sql);
        $statement->execute($params);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    // public function getByUsername($username) {
    //     $sql = "SELECT * FROM users WHERE username = ?";
    //     $params = [$username];
    //     $statement = $this->db->query($sql, $params);
    //     return $statement->fetch(PDO::FETCH_ASSOC);
    // }

    // public function getByEmail($email) {
    //     $sql = "SELECT * FROM users WHERE email = ?";
    //     $params = [$email];
    //     $statement = $this->db->query($sql, $params);
    //     return $statement->fetch(PDO::FETCH_ASSOC);
    // }

    // add other user-related queries here
}

?>