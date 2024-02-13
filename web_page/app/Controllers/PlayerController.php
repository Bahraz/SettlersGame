<?php

include("../Models/PlayerModel.php");
//include("../Controllers/VillageController.php");

class PlayerController
{
    private $playerModel;

    public function __construct($playerModel)
    {
        $this->playerModel = new PlayerModel($playerModel);
    }

    public function validateLogin(string $login)
    {
        $pattern = '/^[a-zA-Z0-9]+$/';
        return preg_match($pattern, $login);
    }

    public function validatePassword(string $password)
    {
        $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^a-zA-Z\d]).{8,32}$/';
        return preg_match($pattern, $password);
    }

    public function validateEmail(string $email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public function regulationsIsSet(string $regulations)
    {
        if ($regulations == "on") {
            return true;
        } else {
            return false;
        }
    }

    public function getPlayerInfo(string $login)
    {
        $playerInfo = $this->playerModel->playerInfo($login);
        //TODO: need more info about player
        if ($playerInfo !== false) {
            session_start();
            $_SESSION["idPlayer"] = $playerInfo["idPlayer"];
            $_SESSION["login"] = $playerInfo["login"];
            session_write_close();
            return true;
        }
    }

    public function registerPlayer(string $login, string $password, string $email, string $regulations, string $creationDate)
    {

        $login = isset($_POST['login']) ? htmlspecialchars($_POST['login']) : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $email = isset($_POST['email']);
        $regulations = isset($_POST['regulations']);
        $creationDate = date("Ymd");

        $validationResult = $this->validateLogin($login);
        if ($validationResult == false) {
            return "Login powinien składać się tylko z małych i dużych liter oraz cyfr.";
        }

        $validationResult = $this->validatePassword($password);
        if ($validationResult == false) {
            return "Hasło musi mieć od 8 do 32 znaków długości i zawierać przynajmniej jedną dużą literę, jedną małą literę, jedną cyfrę i jeden znak specjalny.";
        }

        $validationResult = $this->validateEmail($email);
        if ($validationResult == false) {
            return "Podano nieprawidłowy adres email.";
        }

        $validationResult = $this->regulationsIsSet($regulations);
        if ($validationResult == false) {
            return "Nie zatwierdzono regulaminu.";
        }

        $playerExist = $this->playerModel->playerExist($login, $email);
        if ($playerExist == true) {

            $hashPassword = password_hash($password, PASSWORD_DEFAULT);

            $registerPlayer = $this->playerModel->registerPlayer($login, $hashPassword, $email, true, $creationDate);
            if ($registerPlayer == true) {
                $getInfo = $this->getPlayerInfo($login);
                if ($getInfo == true) {
                    header("Location: ../View/pages/game.php");
                    exit();
                }
                return "Błąd pobierania danych użytkownika.";
            } else {
                return "Konto nie zostało utworzone.";
            }
        } else {
            return "Wybrany login lub email jest już zajęty.";
        }
    }

    public function loginPlayer(string $login, string $password)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'loginPlayer') {
            $login = isset($_POST['login']) ? htmlspecialchars($_POST['login']) : '';
            $password = isset($_POST['password']) ? $_POST['password'] : '';

            $validationResult = $this->validateLogin($login);
            if ($validationResult == false) {
                return "Login powinien składać się tylko z małych i dużych liter oraz cyfr.";
            }

            $validationResult = $this->validatePassword($password);
            if ($validationResult == false) {
                return "Hasło musi mieć od 8 do 32 znaków długości i zawierać przynajmniej jedną dużą literę, jedną małą literę, jedną cyfrę i jeden znak specjalny.";
            }

            $tryLogin = $this->playerModel->loginPlayer($login, $password);

            if ($tryLogin === true) {
                $getInfo = $this->getPlayerInfo($login);
                if ($getInfo == true) {
                    header("Location: ../View/pages/game.php");
                    exit();
                }
                return "Błąd pobierania danych użytkownika.";
            } else {
                return "Błędne dane logowania.";
            }
        }
    }

    public function logoutPlayer()
    {
        session_start();
        $_SESSION = array();
        session_destroy();
    }

}


