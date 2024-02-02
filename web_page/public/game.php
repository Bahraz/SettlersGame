<?php
    session_start();
    ?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settlers Online Game</title>
</head>

<body>
    <h1>Witaj w grze!</h1>
    <?php
    echo "<p>Witaj ".$_SESSION['id'].$_SESSION['login']."!";
    ?>
    
</html>