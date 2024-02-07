<form name="register" action="../../Controllers/register.php" method="POST" id="recap_form">
    Login: <br /><input type="text" name="login" />
    <?php
    if (isset($_SESSION['e_login'])) {
        echo '<div class="error" style="color:red">' . $_SESSION['e_login'] . '</div>';
        unset($_SESSION['e_login']);
        session_write_close();
    }
    ?><br />
    Hasło: <br /><input type="password" name="password" />
    <?php
    if (isset($_SESSION['e_password'])) {
        echo '<div class="error" style="color:red">' . $_SESSION['e_password'] . '</div>';
        unset($_SESSION['e_password']);
        session_write_close();
    }
    ?><br />
    Email: <br /><input type="text" name="email" />
    <?php
    if (isset($_SESSION['e_email'])) {
        echo '<div class="error" style="color:red">' . $_SESSION['e_email'] . '</div>';
        unset($_SESSION['e_email']);
        session_write_close();
    }
    ?><br />

    <label>
        <input type="checkbox" name="regulations" /> Akceptuje <a href="">regulamin</a>
        <?php
        if (isset($_SESSION['e_regulations'])) {
            echo '<div class="error" style="color:red">' . $_SESSION['e_regulations'] . '</div>';
            unset($_SESSION['e_regulations']);
            session_write_close();
        }
        ?>
        <br /><br />
    </label>

    <?php
    if (isset($_SESSION['e_bot'])) {
        echo '<div class="error" style="color:red">' . $_SESSION['e_bot'] . '</div>';
        unset($_SESSION['e_bot']);
        session_write_close();
    }
    ?>

    <input type = "hidden" name = "action" value="registerAccount">


    <button class="g-recaptcha" data-sitekey="6LcermUpAAAAAHdYa8XSBdhzfCe_vXmWjnUtQ3O9" data-callback='onSubmit'
        type="submit" data-action='submit'>Rejestracja</button>
</form>
<br />
Masz już konto? Zaloguj się!<br /><br />
<a href="../../../index.php"><input type="submit" value="Login" /></a>