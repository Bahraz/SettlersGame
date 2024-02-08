<?php

class PlayerModel
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function registerAccount($login, $password, $email, $regulations, $registerDate)
    {

        if (! isset($regulations) === "on") {
            return "Nie zaakceptowano regulaminu";
        }

        // password validation
        if ((strlen($password) < 8) || (strlen($password) > 32)) {
            return "Hasło musi mieć od 8 do 32 znaków długości!";
        }
        if (! preg_match('/[a-z]/', $password) || ! preg_match('/[A-Z]/', $password) || ! preg_match('/\d/', $password) || ! preg_match('/[^a-zA-Z\d]/', $password) || (strlen($password) < 8) || (strlen($password) > 32)) {
            return "Hasło musi się składać z przynajmniej jednej dużej litery, małej litery oraz znaku specjalnego i cyfry";
        }

        //email validation
        if ((filter_var($email, FILTER_VALIDATE_EMAIL) == false) || ($email != $_POST['email'])) {
            return "Podano nieprawidłowy adres email!";
        }


        $stmt = $this->pdo->prepare("SELECT * FROM players WHERE login = :pdo_login OR email = :pdo_email");
        $stmt->bindParam(':pdo_login', $login, PDO::PARAM_STR);
        $stmt->bindParam(':pdo_email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $numRows = $stmt->rowCount();

        if ($numRows > 0) {
            return "Podany login lub email jest już zajęty!";
        } else {
            $stmt = $this->pdo->prepare("INSERT INTO players (login, password, email, create_date) VALUES (:pdo_login, :pdo_hashpassword, :pdo_email, :pdo_register_date)");
            $hashPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt->bindParam(':pdo_login', $login, PDO::PARAM_STR);
            $stmt->bindParam(':pdo_hashpassword', $hashPassword, PDO::PARAM_STR);
            $stmt->bindParam(':pdo_email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':pdo_register_date', $registerDate, PDO::PARAM_STR);
            $stmt->execute();

            //TODO: Utworzenie automatycznego logowania gracza po rejestracji.

            return "Konto zostało utworzone pomyślnie.";
        }
    }
    public function loginAccount($login, $password)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM players WHERE login = :pdo_login");
        $stmt->bindParam(':pdo_login', $login, PDO::PARAM_STR);
        $stmt->execute();

        $playerInfoArray = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($playerInfoArray && password_verify($password, $playerInfoArray['password'])) {
            if (session_status() == PHP_SESSION_NONE) {
                // Start the session
                session_start();
            }

            $_SESSION['id_player'] = $playerInfoArray['id_player'];
            $_SESSION['login'] = $playerInfoArray['login'];

            session_write_close();
            return "Logowanie powiodło się";
        } else {
            return "Błędne dane logowania.";
        }


    }
}
