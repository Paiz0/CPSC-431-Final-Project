<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MD Unite</title>
    <link rel="stylesheet" href="./resources/css/style_landing.css">
</head>
<body>
    <?php
        require("resources/php/in_development/create_db.php");
    ?>
    <div class="container">
        <div class="row">
            <nav class="navbar">
                <h1>MD Unite</h1>
                <ul>
                    <li>
                        <a href="./landing.php">Home</a>
                        <a href="./profile.html">Profile</a>
                        <a href="./login.html">Login</a>
                    </li>
                </ul>
            </nav>
            <div class="content">
                <h1>Start Building Your Medical Network Today!</h1>
                <p>With MD Unite, it's easier than ever to start connecting your medical business with suppliers and other medical professionals than ever.</p>
                <a href="./register.html">Join MD Unite Now</a>
            </div>
        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="./resources/javascript/main.js"></script>
</body>
</html>