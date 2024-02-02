

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settlers Online Game</title>
</head>

<body>
    <h1>Settlers Game Online</h1>
    <form action="../app/Controllers/login.php" method="POST">
    Login: <br/><input type="text" name="login" /><br/>
    Hasło: <br/><input type="password" name="password" /><br/><br/>
    <input type="submit" value="Zaloguj"/>
    </form>
    <br/>
    Nie masz konta? Zarejestruj się<br/><br/>
    <a href="./registration.php"><input type="submit" value="Rejestracja"/></a>


</html>