<?php
require_once('../app/Controllers/recaptacha.php');

    session_start();
    if(isset($_SESSION['id_player'] ))
    {
        session_write_close();
        header('Location: ./game.php');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="pl">

<head>
<script src="https://www.google.com/recaptcha/api.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settlers Online Game</title>
</head>

<body>
    <h1>Settlers Game Online</h1>
    <form action="../app/Controllers/login.php" method="POST" id="recap_form">
    Login: <br/><input type="text" name="login" /><br/>
    Hasło: <br/><input type="password" name="password" /><br/><br/>
    <button class="g-recaptcha" 
        data-sitekey="6LcermUpAAAAAHdYa8XSBdhzfCe_vXmWjnUtQ3O9" 
        data-callback='onSubmit' 
        type="submit" 
        data-action='submit'>Zaloguj</button>
    </form>
    <br/>
    Nie masz konta? Zarejestruj się<br/><br/>
    <a href="./registration.php"><input type="submit" value="Rejestracja"/></a>

    <script>
  function onSubmit(token) {
    document.getElementById("recap_form").submit();
  }
</script>
</html>