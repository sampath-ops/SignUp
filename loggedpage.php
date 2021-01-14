<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MySite</title>
    <style>
        p{
            text-align: center;
            font-size: 25px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <?php
    session_start();
    if(isset($_SESSION["email"])){
        session_unset();
        session_destroy();
    }
    else{
        echo "You don't have permission";
        die();
    }
    ?>
    <p>Congratulations You are Here :)</p>
</body>
</html>