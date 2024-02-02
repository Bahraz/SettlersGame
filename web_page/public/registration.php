<?php
session_start();
if(isset($_SESSION['id_player'] ))
{
    session_write_close();
    header('Location: ../../game.php');
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
    <h1>Settlers Game Online - Register</h1>
    <form action="../app/Controllers/register.php" method="POST">
    Login: <br/><input type="text" name="login" /><br/>
    Hasło: <br/><input type="password" name="password" /><br/>
    Email: <br/><input type="text" name="email" /><br/><br/>
    <input type="submit" value="Rejestracja"/>
    </form>


</html>