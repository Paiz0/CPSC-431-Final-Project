<?php

# Include the abstract class that defines all query classes
require_once 'class_abstract_query.php';

// QueryMessageHandler is a class that filters users based on
// various criteria
class QueryAppointmentHandler extends Query
{
    // Call the Query constructor and passes the parameters
    public function __construct(Database $db, $statement = '')
    {
        parent::__construct($db, $statement);
    }
    

    // This function queries the database for all messages
    // that were sent from $sender_id to $receiver_id.
    // Note that it also returns userIDSender, since we
    // need to be able to reference who sent the message.
    public function readMessages($sender_id, $receiver_id)
    {
        // This sql statement gets all messages sent by
        // $sender_id and received by $receiver_id
        // $sql = "SELECT msgID, userIDSender, msgContent FROM Messages WHERE userIDReceiver = :receiver_id AND userIDSender = :sender_id";
        $sql = "SELECT msgID, Receiver.email AS receiverEmail, Sender.email AS senderEmail, msgContent FROM Messages, Users AS Receiver, Users AS Sender WHERE userIDReceiver = :receiver_id AND userIDSender = :sender_id AND Receiver.userID = userIDReceiver AND Sender.userID = userIDSender";

        // Store the parameters to be plugged into the sql statement above
        $params = ["receiver_id" => $receiver_id, "sender_id" => $sender_id];

        // Execute the query and save the result
        $result = parent::executeQuery($sql, $params);

        return $result;
    }

    public function createAppointment($sender_id, $receiver_id, $datetime, $description)
    {
        $sql = "INSERT INTO Appointments (userIDSender, userIDReceiver, apptDetails, apptDate) VALUES (:sender_id, :receiver_id, :description, :datetime)";

        $params = ["sender_id" => $sender_id, "receiver_id" => $receiver_id, "description" => $description, "datetime" => $datetime];

        // Execute the query
        $result = parent::executeQuery($sql, $params);
    }

    // // This function adds a new message to the database
    // // with userIDSender $sender_id, userIDReceiver $receiver_id
    // // and msgContent $message
    // public function sendMessage($sender_id, $receiver_id, $message)
    // {
    //     // This query inserts a message into the database
    //     // with the source coming from $sender_id and the
    //     // destination coming from $receiver_id and content
    //     // $message
    //     $sql = "INSERT INTO Messages (userIDSender, userIDReceiver, msgContent) VALUES (:sender_id, :receiver_id, :message)";

    //     // Store the parameters to be plugged into the sql statement above
    //     $params = ["sender_id" => $sender_id, "receiver_id" => $receiver_id, "message" => $message];

    //     // Execute the query and save the result
    //     $result = parent::executeQuery($sql, $params);
    // }

    // // This function returns all emails of users who have either
    // // sent or received a message from the user with $userID
    // public function findContacts($userID)
    // {
    //     $sql = "SELECT U.email FROM Users AS U, Messages AS M WHERE (M.userIDReceiver = :userID AND M.userIDSender = U.userID) OR (M.userIDSender = :userID AND M.userIDReceiver = U.userID)";

    //     $params = ["userID" => $userID];

    //     $result = parent::executeQuery($sql, $params);

    //     return $result;
    // }

    // Delete all conversations between two emails
    public function deleteContact($email, $curr_email)
    {
        $sql = "DELETE FROM Messages WHERE (userIDSender = :email AND userIDReceiver = :curr_email) OR (userIDSender = :curr_email AND userIDReceiver = :email)";

        $params = ["email" => $email, "curr_email" => $curr_email];

        $result = parent::executeQuery($sql, $params);
    }

    // Find the user's id who owns $email
    public function getIDFromEmail($email)
    {
        // This sql statement gets the id of the user
        // who owns $email
        $sql = "SELECT userID FROM Users WHERE email = :email";

        # Store the parameters to be plugged into the sql statement above
        $params = ["email" => $email];

        // Execute the query and save the result
        $result = parent::executeQuery($sql, $params);

        return $result;
    }
}

?>