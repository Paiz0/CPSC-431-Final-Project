<?php

# Include the abstract class that defines all query classes
require_once 'class_abstract_query.php';

class QueryUserStatus extends Query
{
    // Call the Query constructor and passes the parameters
    public function __construct(Database $db, $statement = '')
    {
        parent::__construct($db, $statement);
    }

    // Query whether a specified email & password exists in the database.
    // The return value is true if the user exists and false otherwise
    public function FindUser($email, $password)
    {
        $sql = "SELECT password FROM Users WHERE email = :email";
        $params = ["email" => $email];

        // Execute the query and save the result
        $result = parent::executeQuery($sql, $params);

        // Check whether the number of rows equals exactly one
        if (count($result) == 1)
        {
            // Check whether the password matches the hashed password
            $row = $result[0];
            $hashedPassword = $row['password'];

            // Check if the provided password matches the hashed password
            if (password_verify($password, $hashedPassword))
            {
                return $row;
            }

            // Otherwise the passwords don't match
            else
            {
                return null;
            }
        }

        else if (count($result) > 1)
        {
            echo "There are multiple instances of the same user in the database!<br>";
            echo "This means a uniqueness constraint failed on the email column!";
        }

        return null;
    }
}


?>