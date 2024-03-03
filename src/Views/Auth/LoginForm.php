<?php

namespace Bahraz\SettlersGame\Views\Auth;


class LoginForm
{
    public function displayLoginForm()
    {

        echo <<<END
        <form action='/login' method='POST' id='loginForm'>
        Login:<br/><input type='text' name='login' />
        END;
        if (isset($_SESSION['eLogin'])) {
            echo '<div class="error" style="color:red">' . $_SESSION['eLogin'] . '</div>';
            unset($_SESSION['eLogin']);
            session_write_close();
        }
        echo <<<END
        <br/>
        Hasło:<br/><input type='password' name='password'/>
        END;
        if (isset($_SESSION['ePass'])) {
            echo '<div class="error" style="color:red">' . $_SESSION['ePass'] . '</div>';
            unset($_SESSION['ePass']);
            session_write_close();
        }
        echo <<<END
        <br/><br/>
        <button class='g-recaptcha' data-sitekey='6LcermUpAAAAAHdYa8XSBdhzfCe_vXmWjnUtQ3O9' data-callback='onSubmit'
        type='submit' data-action='submit'>Zaloguj</button>
        </form>
        <br/>
        END;
        echo "Nie masz konta? <a href='index.php?action=register'>Zarejetruj się!</a>";
    }
}