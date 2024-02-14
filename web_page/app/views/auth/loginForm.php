<form action="../../app/routers/router.php" method="POST" id="recap_form">
    Login: <br/><input type="text" name="login" />
    <?php
        if (isset($_SESSION['e_login'])) {
            echo '<div class="error" style="color:red">' . $_SESSION['e_login'] . '</div>';
            unset($_SESSION['e_login']);
            session_write_close();
        }
        ?><br/>
    Hasło: <br/><input type="password" name="password" /><br/><br/>
    <input type = "hidden" name = "action" value="loginPlayer">
    <button class="g-recaptcha" 
        data-sitekey="6LcermUpAAAAAHdYa8XSBdhzfCe_vXmWjnUtQ3O9" 
        data-callback='onSubmit' 
        type="submit" 
        data-action='submit'>Zaloguj</button>
    </form>
    <br/>
    Nie masz konta? Zarejestruj się!<br/><br/>
    <a href="../app/views/pages/registration.php"><input type="submit" value="Rejestracja"/></a>