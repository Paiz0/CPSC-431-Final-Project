<?php

# Include the abstract class that defines all query classes
require_once 'class_abstract_query.php';

// QueryMessageHandler is a class that filters users based on
// various criteria
class QueryMessageHandler extends Query
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
        # This sql statement gets all messages sent by
        # $sender_id and received by $receiver_id
        $sql = "SELECT msgID, userIDSender, msgContent FROM Messages WHERE userIDReceiver = :receiver_id AND userIDSender = :sender_id";

        # Store the parameters to be plugged into the sql statement above
        $params = ["receiver_id" => $receiver_id, "sender_id" => $sender_id];

        // Execute the query and save the result
        $result = parent::executeQuery($sql, $params);

        return $result;
    }

    // This function queries the database for the id and email
    // of all people who have sent/received a message to/from
    // the recipient
    // TODO: Change the query to get the names and titles
    //       of all people who have sent a message to the
    //       recipient. Note that this will require a
    //       redesign of the Conversation page.
    public function findContacts($user)
    {
        # This sql statement gets the email and id of
        # all people who have ever sent/received a message
        # to/from $user.
        $sql = "SELECT DISTINCT U.email, U.userID FROM Users AS U, Messages AS M WHERE (U.userID = M.userIDSender AND M.userIDReceiver = :user) OR (U.userID = M.userIDReceiver AND M.userIDSender = :user)";
        
        # Store the parameters to be plugged into the sql statement above
        $params = ["user" => $user];

        // Execute the query and save the result
        $result = parent::executeQuery($sql, $params);

        return $result;
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