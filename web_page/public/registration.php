<?php
require_once('../app/Controllers/recaptacha.php');

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
<script src="https://www.google.com/recaptcha/api.js"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settlers Online Game</title>
</head>

<body>
    <h1>Settlers Game Online - Register</h1>
    <form name="register" action="../app/Controllers/register.php" method="POST" id="recap_form">
    Login: <br/><input type="text" name="login" />
    <?php
    if(isset($_SESSION['e_login']))
    {
        echo '<div class="error" style="color:red">'.$_SESSION['e_login'].'</div>';
        unset($_SESSION['e_login']);
        session_write_close();
    }   
    ?><br/>
    Hasło: <br/><input type="password" name="password" /><br/>
    Email: <br/><input type="text" name="email" /><br/>
    <label>
    <input type="checkbox" name="regulations"/> Akceptuje <a href="">regulamin</a><br/><br/></label>

    <button class="g-recaptcha" 
        data-sitekey="6LcermUpAAAAAHdYa8XSBdhzfCe_vXmWjnUtQ3O9" 
        data-callback='onSubmit' 
        type="submit" 
        data-action='submit'>Rejestracja</button>

    <!-- <input type="submit"  value="Rejestracja" class="g-recaptcha" data-sitekey="6LcermUpAAAAAHdYa8XSBdhzfCe_vXmWjnUtQ3O9" data-callback='onSubmit' data-action='submit' />
    </form> -->


    <script>
  function onSubmit(token) {
    document.getElementById("recap_form").submit();
  }
</script>
</html>