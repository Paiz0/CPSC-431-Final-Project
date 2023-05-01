<?php

# Include the abstract class that defines all query classes
require_once 'class_abstract_query.php';

// QueryFilterUser is a class that filters users based on
// various criteria
class QueryFilterUser extends Query
{
    // Call the Query constructor and passes the parameters
    public function __construct(Database $db, $statement = '')
    {
        parent::__construct($db, $statement);
    }

    // This query is performed by doctors who are looking for suppliers
    // Note: $provisions must be an array of strings containing the provisions
    public function FilterSuppliers($name, $zipcode, $provisions)
    {
        // Here's the first portion of the query (not including $provisions)
        // Note: We only want to select the name, email and provisions of
        //       each user that's returned. The name and provisions will be
        //       displayed, while the email will be set as a session variable
        //       so we know which profile to access.
        $sql_one = "SELECT U.name, U.zipcode, P.provision FROM Users AS U, Suppliers AS S, Provisions AS P WHERE U.userID = S.userID AND S.userID = P.userID AND S.supplierID = P.supplierID";

        $params = [];

        if ($name != "")
        {
            $sql_one = $sql_one . " AND U.name = :name";
            $params["name"] = $name;
        }

        if ($zipcode != "")
        {
            $sql_one = $sql_one . " AND U.zipcode = :zipcode";
            $params["zipcode"] = $zipcode;
        }

        if (trim($provisions[0]) != "")
        {
            $sql_two = " AND (";

            for ($i = 0; $i < count($provisions); $i++)
            {
                if ($i + 1 == count($provisions))
                {
                    $sql_two = $sql_two . " P.provision = :provision" . ($i + 1) . " )";
                }
                else
                {
                    $sql_two = $sql_two . " P.provision = :provision" . ($i + 1) . " OR ";
                }

                // Append a new bind parameter to the $params array so that
                // the SQL statement can be interpreted with PDO
                $params["provision" . ($i + 1)] = $provisions[$i];
            }

            // Combine the two query parts
            $sql = $sql_one . $sql_two;
        }

        else
        {
            $sql = $sql_one;
        }

        // $sql = "SELECT password FROM Users WHERE email = :email";
        // $params = ["email" => $email];

        // Execute the query and save the result
        $result = parent::executeQuery($sql, $params);

        return $result;
    }

    // This query is performed by doctors who are looking for suppliers
    // Note: $provisions must be an array of strings containing the provisions
    public function FilterDoctors($name, $zipcode, $titles)
    {
        // Here's the first portion of the query (not including $provisions)
        // Note: We only want to select the name, email and provisions of
        //       each user that's returned. The name and provisions will be
        //       displayed, while the email will be set as a session variable
        //       so we know which profile to access.
        // $sql_one = "SELECT U.name, U.zipcode, T.title FROM Users AS U, Doctors AS D, Titles AS T WHERE U.userID = D.userID AND D.userID = T.userID AND D.doctorID = T.doctorID AND U.name = :name AND U.zipcode = :zipcode AND ";
        $sql_one = "SELECT U.name, U.zipcode, T.title FROM Users AS U, Doctors AS D, Titles AS T WHERE U.userID = D.userID AND D.userID = T.userID AND D.doctorID = T.doctorID";

        $params = [];

        if ($name != "")
        {
            $sql_one = $sql_one . " AND U.name = :name";
            $params["name"] = $name;
        }

        if ($zipcode != "")
        {
            $sql_one = $sql_one . " AND U.zipcode = :zipcode";
            $params["zipcode"] = $zipcode;
        }

        if (trim($titles[0]) != "")
        {
            $sql_two = " AND (";

            // $params = ["name" => $name, "zipcode" => $zipcode];

            for ($i = 0; $i < count($titles); $i++)
            {
                if ($i + 1 == count($titles))
                {
                    $sql_two = $sql_two . " T.title = :title" . ($i + 1) . " )";
                }
                else
                {
                    $sql_two = $sql_two . " T.title = :title" . ($i + 1) . " OR ";
                }

                // Append a new bind parameter to the $params array so that
                // the SQL statement can be interpreted with PDO
                $params["title" . ($i + 1)] = $titles[$i];
            }

            // Combine the two query parts
            $sql = $sql_one . $sql_two;
        }

        else
        {
            $sql = $sql_one;
        }

        // $sql = "SELECT password FROM Users WHERE email = :email";
        // $params = ["email" => $email];

        // Execute the query and save the result
        $result = parent::executeQuery($sql, $params);

        return $result;

        // Return the result

        // Check whether the number of rows equals exactly one
        // if (count($result) == 1)
        // {
        //     // Check whether the password matches the hashed password
        //     $row = $result[0];
        //     $hashedPassword = $row['password'];

        //     // Check if the provided password matches the hashed password
        //     if (password_verify($password, $hashedPassword))
        //     {
        //         return $row;
        //     }

        //     // Otherwise the passwords don't match
        //     else
        //     {
        //         return null;
        //     }
        // }

        // else if (count($result) > 1)
        // {
        //     echo "There are multiple instances of the same user in the database!<br>";
        //     echo "This means a uniqueness constraint failed on the email column!";
        // }

        // return null;
    }

    // Create a new database instance
    // $db = new Database(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);

    // // Establish the database connection
    // $db->establishConnection();

    // $obj = new QueryFilterUser($db);

    // // Get the results after performing the query that filters suppliers
    // // by name, zipcode and provisions that were entered earlier
    // $results = $obj->FilterDoctors("John Doe", 12345, ['MD']);
}

// // Create a new database instance
// $db = new Database(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);

// // Establish the database connection
// $db->establishConnection();

// $obj = new QueryFilterUser($db);

// $results = $obj->FilterDoctors("John Doe", "12345", ["Dr."]);

// echo var_dump($results);

?>