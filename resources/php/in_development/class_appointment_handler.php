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

    public function createAppointment($sender_id, $receiver_id, $datetime, $description)
    {
        $sql = "INSERT INTO Appointments (userIDSender, userIDReceiver, apptDetails, apptDate, apptStatus) VALUES (:sender_id, :receiver_id, :description, :datetime, :appt_status)";

        $params = ["sender_id" => $sender_id, "receiver_id" => $receiver_id, "description" => $description, "datetime" => $datetime, "appt_status" => PENDING_APPOINTMENT];

        // Execute the query
        $result = parent::executeQuery($sql, $params);
    }

    // This function modifies the appointment that has $apptID
    // so that apptStatus is accepted
    public function acceptAppointment($apptID)
    {
        $sql = "UPDATE Appointments SET apptStatus = :new_status WHERE apptID = :apptID";

        $params = ["new_status" => ACCEPTED_APPOINTMENT, "apptID" => $apptID];

        $result = parent::executeQuery($sql, $params);
    }

    // This function modifies the appointment that has $apptID
    // so that apptStatus is denied
    public function denyAppointment($apptID)
    {
        echo $apptID . "<br>" . REJECTED_APPOINTMENT;
        $sql = "UPDATE Appointments SET apptStatus = :new_status WHERE apptID = :apptID";

        $params = ["new_status" => REJECTED_APPOINTMENT, "apptID" => $apptID];

        $result = parent::executeQuery($sql, $params);
    }

    public function getRejectedAppointments($userID, $incoming=true)
    {
        // If the appointment is incoming, then the userIDReceiver
        // should match $userID
        if ($incoming)
        {
            $sql = "SELECT * FROM Appointments WHERE userIDReceiver = :userID AND apptStatus = :rejected";

            $params = ["userID" => $userID, "rejected" => REJECTED_APPOINTMENT];

            $result = parent::executeQuery($sql, $params);

            return $result;
        }

        // If the appointment is outgoing, then the userIDSender
        // should match $userID
        else
        {
            $sql = "SELECT * FROM Appointments WHERE userIDSender = :userID AND apptStatus = :rejected";

            $params = ["userID" => $userID, "rejected" => REJECTED_APPOINTMENT];

            $result = parent::executeQuery($sql, $params);

            return $result;
        }
    }

    public function getPendingAppointments($userID, $incoming=true)
    {
        // If the appointment is incoming, then the userIDReceiver
        // should match $userID
        if ($incoming)
        {
            $sql = "SELECT * FROM Appointments WHERE userIDReceiver = :userID AND apptStatus = :pending";

            $params = ["userID" => $userID, "pending" => PENDING_APPOINTMENT];

            $result = parent::executeQuery($sql, $params);

            return $result;
        }

        // If the appointment is outgoing, then the userIDSender
        // should match $userID
        else
        {
            $sql = "SELECT * FROM Appointments WHERE userIDSender = :userID AND apptStatus = :pending";

            $params = ["userID" => $userID, "pending" => PENDING_APPOINTMENT];

            $result = parent::executeQuery($sql, $params);

            return $result;
        }
    }

    public function getAcceptedAppointments($userID, $incoming=true)
    {
        // If the appointment is incoming, then the userIDReceiver
        // should match $userID
        if ($incoming)
        {
            $sql = "SELECT * FROM Appointments WHERE userIDReceiver = :userID AND apptStatus = :accepted";

            $params = ["userID" => $userID, "accepted" => ACCEPTED_APPOINTMENT];

            $result = parent::executeQuery($sql, $params);

            return $result;
        }

        // If the appointment is outgoing, then the userIDSender
        // should match $userID
        else
        {
            $sql = "SELECT * FROM Appointments WHERE userIDSender = :userID AND apptStatus = :accepted";

            $params = ["userID" => $userID, "accepted" => ACCEPTED_APPOINTMENT];

            $result = parent::executeQuery($sql, $params);

            return $result;
        }
    }
}

?>