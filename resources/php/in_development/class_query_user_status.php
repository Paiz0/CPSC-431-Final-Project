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

    public function CreateUser($name, $email, $password, $zipcode, $type, $contactable)
    {
        $sql = "INSERT INTO Users (name, email, password, zipcode, type, contactable) VALUES (:name, :email, :password, :zipcode, :type, :contactable)";

        $params = ["name" => $name, "email" => $email, "password" => $password, "zipcode" => $zipcode, "type" => $type, "contactable" => $contactable];

        parent::executeQuery($sql, $params);
    }

    public function UpdateUser($userID, $name, $zipcode, $contactable)
    {
        $sql = "UPDATE Users SET name = :name, zipcode = :zipcode, contactable = :contactable WHERE userID = :userID";

        $params = ["name" => $name, "zipcode" => $zipcode, "contactable" => $contactable, "userID" => $userID];

        parent::executeQuery($sql, $params);
    }

    public function CreateDoctor($userID)
    {
        $sql = "INSERT INTO Doctors (userID) VALUES (:userID)";

        $params = ["userID" => $userID];

        parent::executeQuery($sql, $params);
    }

    // Note that the table for "Titles" needs to be updated to "Specialties"
    public function CreateSpecialty($userID, $doctorID, $specialty)
    {
        $sql = "INSERT INTO Titles (userID, doctorID, title) VALUES (:userID, :doctorID, :specialty)";

        $params = ["userID" => $userID, "doctorID" => $doctorID, "specialty" => $specialty];

        parent::executeQuery($sql, $params);
    }

    public function CreateSupplier($userID)
    {
        $sql = "INSERT INTO Suppliers (userID) VALUES (:userID)";

        $params = ["userID" => $userID];

        parent::executeQuery($sql, $params);
    }

    public function CreateProvision($userID, $supplierID, $provision)
    {
        $sql = "INSERT INTO Provisions (userID, supplierID, provision) VALUES (:userID, :supplierID, :provision)";

        $params = ["userID" => $userID, "supplierID" => $supplierID, "provision" => $provision];

        parent::executeQuery($sql, $params);
    }

    public function GetSpecialities()
    {
        $sql = "SELECT DISTINCT title FROM Titles AS T, Users AS U WHERE T.userID = U.userID AND U.contactable = :contactable";

        $params = ["contactable" => RADIO_ON];

        return parent::executeQuery($sql, $params);
    }

    public function GetProvisions()
    {
        $sql = "SELECT DISTINCT provision FROM Provisions AS P, Users AS U WHERE P.userID = U.userID AND U.contactable = :contactable";

        $params = ["contactable" => RADIO_ON];

        return parent::executeQuery($sql, $params);
    }

    // Query whether a specified email & password exists in the database.
    // The return value is the row of user data or null if it doesn't exist.
    public function FindUser($email, $password)
    {
        $sql = "SELECT * FROM Users WHERE email = :email";
        $params = ["email" => $email];

        // Execute the query and save the result
        $result = parent::executeQuery($sql, $params);

        // Check whether the number of rows equals exactly one
        if (count($result) == 1)
        {
            // Check whether the password matches the hashed password
            $row = $result[0];
            $hashedPassword = $row['password'];

            // echo var_dump($row["userID"]);

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

    public function FindUserID($email)
    {
        $sql = "SELECT userID FROM Users WHERE email = :email";

        $params = ["email" => $email];

        $result = parent::executeQuery($sql, $params);

        return $result[0];
    }

    // This is very similar to FindUser above
    public function FindProfile($userID)
    {
        $sql = "SELECT name, email, zipcode, type, contactable FROM Users WHERE userID = :userID";

        $params = ["userID" => $userID];

        $result = parent::executeQuery($sql, $params);

        // Check whether the number of rows equals exactly one
        if (count($result) == 1)
        {
            return $result[0];
        }

        return null;
    }

    public function FindDoctor($userID)
    {
        $sql = "SELECT * FROM Doctors WHERE userID = :userID";

        $params = ["userID" => $userID];

        $result = parent::executeQuery($sql, $params);

        // Check whether the number of rows equals exactly one
        if (count($result) == 1)
        {
            return $result[0];
        }

        else if (count($result) > 1)
        {
            echo "There are multiple instances of the same doctor in the database!<br>";
            echo "This means a uniqueness constraint failed on the email column!";
        }

        return null;
    }

    public function FindSupplier($userID)
    {
        $sql = "SELECT * FROM Suppliers WHERE userID = :userID";

        $params = ["userID" => $userID];

        $result = parent::executeQuery($sql, $params);

        // Check whether the number of rows equals exactly one
        if (count($result) == 1)
        {
            return $result[0];
        }

        else if (count($result) > 1)
        {
            echo "There are multiple instances of the same supplier in the database!<br>";
            echo "This means a uniqueness constraint failed on the email column!";
        }

        return null;
    }
}

?>