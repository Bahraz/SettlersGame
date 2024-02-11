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
        if (! $regulations) {
            return "Nie zaakceptowano regulaminu";
        }

        if (! preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^a-zA-Z\d]).{8,32}$/', $password)) {
            return "Hasło musi mieć od 8 do 32 znaków długości i zawierać przynajmniej jedną dużą literę, jedną małą literę, jedną cyfrę i jeden znak specjalny!";
        }

        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Podano nieprawidłowy adres email!";
        }

        $stmt = $this->pdo->prepare("SELECT * FROM players WHERE login = :login OR email = :email");
        $stmt->bindParam(':login', $login, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return "Podany login lub email jest już zajęty!";
        }

        $hashPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("INSERT INTO players (login, password, email, create_date) VALUES (:login, :password, :email, :create_date)");
        $stmt->bindParam(':login', $login, PDO::PARAM_STR);
        $stmt->bindParam(':password', $hashPassword, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':create_date', $registerDate, PDO::PARAM_STR);
        $stmt->execute();

        $stmt = $this->pdo->prepare("SELECT * FROM players WHERE login = :login");
        $stmt->bindParam(':login', $login, PDO::PARAM_STR);
        $stmt->execute();
        $playerInfoArray = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($playerInfoArray && password_verify($password, $playerInfoArray['password'])) {
            session_start();
            $_SESSION['id_player'] = $playerInfoArray['id_player'];
            $_SESSION['login'] = $playerInfoArray['login'];
            session_write_close();
            return "Konto zostało utworzone pomyślnie.";
        }
    }

    public function loginAccount($login, $password)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM players WHERE login = :login");
        $stmt->bindParam(':login', $login, PDO::PARAM_STR);
        $stmt->execute();

        $playerInfoArray = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($playerInfoArray && password_verify($password, $playerInfoArray['password'])) {
            session_start();
            $_SESSION['id_player'] = $playerInfoArray['id_player'];
            $_SESSION['login'] = $playerInfoArray['login'];
            session_write_close();
            return "Logowanie powiodło się";
        } else {
            return "Błędne dane logowania.";
        }
    }

    public function logoutAccount()
    {
        session_start();

        $_SESSION = array();

        session_destroy();
    }
}