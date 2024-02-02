<?php
    session_start();
    if(!isset($_SESSION['id_player'] ))
    {
        session_write_close();
        header('Location: ./index.php');
        exit();
    }
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
    echo "<p>Witaj ".$_SESSION['id_player'].$_SESSION['login']."!<br/><br/>"
?>
    <form action="../app/Controllers/logout.php" method="POST">
        <input type="submit" value="Wyloguj"/></a>
    </form>

    


</html>