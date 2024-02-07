<?php

class PlayerModel
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function registerAccount($login, $password, $email, $regulations)
    {

        $pdo_login = isset($_POST['login']) ? htmlspecialchars($_POST['login']) : '';
        $pdo_password = isset($_POST['password']) ? $_POST['password'] : '';
        $pdo_email = isset($_POST['email']) ? filter_var($_POST['email'], FILTER_SANITIZE_EMAIL) : '';
        $regulations = isset($_POST['regulations']);
        $register_date = date("Ymd");

        if (! isset($regulations) == "on") {
            return "Nie zaakceptowano regulaminu";
        }

        // password validation
        if ((strlen($pdo_password) < 8) || (strlen($pdo_password) > 32)) {
            return "Hasło musi mieć od 8 do 32 znaków długości!";
        }
        if (! preg_match('/[a-z]/', $pdo_password) || ! preg_match('/[A-Z]/', $pdo_password) || ! preg_match('/\d/', $pdo_password) || ! preg_match('/[^a-zA-Z\d]/', $pdo_password) || (strlen($pdo_password) < 8) || (strlen($pdo_password) > 32)) {
            return "Hasło musi się składać z przynajmniej jednej dużej litery, małej litery oraz znaku specjalnego i cyfry";
        }

        //email validation
        if ((filter_var($pdo_email, FILTER_VALIDATE_EMAIL) == false) || ($pdo_email != $_POST['email'])) {
            return "Podano nieprawidłowy adres email!";
        }

        $stmt = $this->pdo->prepare("SELECT * FROM players WHERE login = :pdo_login OR email = :pdo_email");
        $stmt->bindParam(':pdo_login', $pdo_login, PDO::PARAM_STR);
        $stmt->bindParam(':pdo_email', $pdo_email, PDO::PARAM_STR);
        $stmt->execute();

        $numRows = $stmt->rowCount();

        if ($numRows > 0) {
            return "Podany login lub email jest już zajęty!";
        } else {
            $stmt = $this->pdo->prepare("INSERT INTO players (login, password, email, create_date) VALUES (:pdo_login, :pdo_hashpassword, :pdo_email, :pdo_register_date)");
            $stmt->bindParam(':pdo_login', $pdo_login, PDO::PARAM_STR);
            $stmt->bindParam(':pdo_hashpassword', password_hash($pdo_password, PASSWORD_DEFAULT), PDO::PARAM_STR);
            $stmt->bindParam(':pdo_email', $pdo_email, PDO::PARAM_STR);
            $stmt->bindParam(':pdo_register_date', $register_date, PDO::PARAM_STR);
            $stmt->execute();

            return "Konto zostało utworzone pomyślnie.";
        }
    }
}
// public function registerAccount($login, $password, $email, $regulations,$connection)
// {
//     $validateResult = $this->validateRegisterAccount($login, $password, $email, $regulations);

//     if ($validateResult !== true) {
//         return $validateResult;
//     }

//     //TODO: rejestracja konta

//     //$registerAccountQuery = $pdo_connection->prepare("SELECT * FROM players WHERE login = :pdo_login OR email = :pdo_email");
// }
// private function validateRegisterAccount($login, $password, $email, $regulations)
// {
//     if (empty($login) || empty($password) || empty($email) || empty($regulations)) {
//         return "Wprowadź wszystkie dane do formularza oraz zatwierdź regulamin.";
//     }

//     //login validation
//     if (strlen($login) < 3 || strlen($login) > 28 || ctype_alnum($login) == false) {
//         return "Login powinien składać się tylko z liter i cyfr oraz zawierać 3 do 28 znaków";
//     }

//     //password validation
//     if (strlen($password) < 8 || strlen($password) > 32) {
//         return "Hasło musi mieć od 8 do 32 znaków.";
//     }

//     if (! preg_match('/[a-z]/', $password) || ! preg_match('/[A-Z]/', $password) || ! preg_match('/\d/', $password) || ! preg_match('/[^a-zA-Z\d]/', $password)) {
//         return "Hasło musi się składać z przynajmniej jednej: dużej litery, małej litery, znaku specjalnego oraz cyfry.";

//     }

//     //email validation
//     if ((filter_var($email, FILTER_VALIDATE_EMAIL) == false) || ($email != $_POST['email'])) {
//         return "Podano nieprawidłowy adres email.";
//     }

//     //regulations
//     if (! isset($_POST['regulations']) == "on") {
//         return "Nie zaakceptowano regulaminu";
//     }

//     return true;
// }

