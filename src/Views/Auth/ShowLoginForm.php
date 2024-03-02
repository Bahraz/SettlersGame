<?php

namespace Bahraz\SettlersGame\Views\Auth;


class ShowLoginForm
{
    public function displayLoginForm()
    {

        echo <<<END
        <form action='../src/routes.php' method='POST' id='loginForm'>
        Login:<br/><input type='text' name='login' />
        END;
        if (isset($_SESSION['eLogin'])) {
            echo '<div class="error" style="color:red">' . $_SESSION['eLogin'] . '</div>';
            unset($_SESSION['eLogin']);
            session_write_close();
        }
        echo <<<END
        <br/>
        Hasło:<br/><input type='password' name='password'/><br/>,<br/>
        <button class='g-recaptcha' data-sitekey='6LcermUpAAAAAHdYa8XSBdhzfCe_vXmWjnUtQ3O9' data-callback='onSubmit'
        type='submit' data-action='submit'>Zaloguj</button>
        </form>
        <br/>
        Nie masz konta? <a href='#'>Zarejetruj się!</a>
        END;
    }

    public function displayFooter()
    {
        echo <<<END
        <footer>
        Copyright © Bahraz
        </footer>
        </body>
        END;
    }

}