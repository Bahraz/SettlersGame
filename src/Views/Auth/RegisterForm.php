<?php

namespace Bahraz\SettlersGame\Views\Auth;

class RegisterForm
{
    public function displayRegisterForm()
    {

        echo <<<END
                <form name='register' action='/register' method='POST' id='recap_form'>
                Login: <br /><input type='text' name='login' />
            END;
        if (isset($_SESSION['ErrLogin'])) {
            echo '<div class="error" style="color:red">' . $_SESSION['Errlogin'] . '</div>';
            unset($_SESSION['Errlogin']);
            session_write_close();
        }
        echo <<<END
                <br />
                Hasło: <br /><input type='password' name='password' />
            END;
        if (isset($_SESSION['ErrPass'])) {
            echo '<div class="error" style="color:red">' . $_SESSION['ErrPass'] . '</div>';
            unset($_SESSION['ErrPass']);
            session_write_close();
        }
        echo <<<END
                <br />
                Email: <br /><input type='text' name='email' />
            END;
        if (isset($_SESSION['ErrEmail'])) {
            echo '<div class="error" style="color:red">' . $_SESSION['ErrEmail'] . '</div>';
            unset($_SESSION['ErrEmail']);
            session_write_close();
        }
        echo <<<END
                <br/>
                <label>
                <input type='checkbox' name='regulations' /> Akceptuje <a href=''>regulamin</a>
            END;
        if (isset($_SESSION['ErrRegulations'])) {
            echo '<div class="error" style="color:red">' . $_SESSION['ErrRegulations'] . '</div>';
            unset($_SESSION['ErrRegulations']);
            session_write_close();
        }
        echo '<br/><br/></label>';
        if (isset($_SESSION['ErrBot'])) {
            echo '<div class="error" style="color:red">' . $_SESSION['ErrBot'] . '</div>';
            unset($_SESSION['ErrBot']);
            session_write_close();
        }
        echo <<<END
                <input type='hidden' name='action' value='registerPlayer'>
                <button class='g-recaptcha' data-sitekey='6LcermUpAAAAAHdYa8XSBdhzfCe_vXmWjnUtQ3O9' data-callback='onSubmit' type='submit' data-action='submit'>Rejestracja</button>
                </form>
                <br />
                Masz już konto? <a href='index.php?action=login'>Zaloguj się!</a>
            END;
    }

}