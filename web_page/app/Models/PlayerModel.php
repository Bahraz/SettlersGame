<?php

class PlayerModel
{
    public function registerAccount($login, $password, $email, $regulations)
    {
        $validateResult = $this->validateRegisterAccount($login, $password, $email, $regulations);

        if ($validateResult !== true) {
            return $validateResult;
        }

        //TODO: rejestracja konta
    }
    private function validateRegisterAccount($login, $password, $email, $regulations)
    {
        if (empty($login) || empty($password) || empty($email) || empty($regulations)) {
            return "Wprowadź wszystkie dane do formularza oraz zatwierdź regulamin.";
        }

        //login validation
        if (strlen($login) < 3 || strlen($login) > 28 || ctype_alnum($login) == false) {
            return "Login powinien składać się tylko z liter i cyfr oraz zawierać 3 do 28 znaków";
        }

        //password validation
        if (strlen($password) < 8 || strlen($password) > 32) {
            return "Hasło musi mieć od 8 do 32 znaków.";
        }

        if (! preg_match('/[a-z]/', $password) || ! preg_match('/[A-Z]/', $password) || ! preg_match('/\d/', $password) || ! preg_match('/[^a-zA-Z\d]/', $password)) {
            return "Hasło musi się składać z przynajmniej jednej: dużej litery, małej litery, znaku specjalnego oraz cyfry.";

        }

        //email validation
        if ((filter_var($email, FILTER_VALIDATE_EMAIL) == false) || ($email != $_POST['email'])) {
            return "Podano nieprawidłowy adres email.";
        }

        //regulations
        if (! isset($_POST['regulations']) == "on") {
            return "Nie zaakceptowano regulaminu";
        }

        return true;
    }
}