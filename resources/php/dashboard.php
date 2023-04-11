<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (empty($_SESSION['loggedin'])) {
    //Code that will get current value of submit button clicked
    header('Location: ../../login.html');
    // exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $clickedButtonValue = $_POST['clickedButton'];
    // Do something with $clickedButtonValue
    echo "<script>console.log('Send message to User with ID " .  $clickedButtonValue. "' );</script>";
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    Welcome, your user ID is <?php echo $_SESSION['currentUser'] ?>
    <br>
    <a href = "./logout.php"> Logout </a>
    <?php 
    require './connection.php'; 
    $sql = "SELECT * FROM `medicalProfessional` WHERE mpContact = 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    // output data of each row
    ?>  
    <form method="post" action="<?php echo htmlspecialchars($_SERVER[" PHP_SELF "]);?>">
        <?php
        while($row = $result->fetch_assoc()) {
            $availableUserId = $row["mpID"];
            echo "<br><button type='submit' name='clickedButton' value='$availableUserId' onclick='jsapply($availableUserId)'>Send Message $availableUserId</button>";
        }
        ?>  
    </form>
    <?php
    } else {
        echo "0 results";
    }
    $conn->close();
    ?>

    <script>
        function jsapply(availableUserId){
            console.log(availableUserId);
        }
    </script>
</body>
</html>
