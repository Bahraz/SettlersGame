<?php

include('../models/PlayerModel.php');
include('../Controllers/VillageController.php');
include('../models/VillageModel.php');

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
        if (preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email)) {
            return filter_var($email, FILTER_VALIDATE_EMAIL);
        }
        return false;
    }

    public function regulationsIsSet(string $regulations)
    {
        if ($regulations == 'on') {
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

            $_SESSION['idPlayer'] = $playerInfo['idPlayer'];
            $_SESSION['login'] = $playerInfo['login'];
            session_write_close();
            return true;
        }
    }
    public function registerPlayer(string $login, string $password, string $email, bool $regulations, bool $verifiedEmail, string $creationDate)
    {

        $validationResult = $this->validateLogin($login);
        if ($validationResult == false) {
            return 'Login powinien składać się tylko z małych i dużych liter oraz cyfr.';
        }

        $validationResult = $this->validatePassword($password);
        if ($validationResult == false) {
            return 'Hasło musi mieć od 8 do 32 znaków długości i zawierać przynajmniej jedną dużą literę, jedną małą literę, jedną cyfrę i jeden znak specjalny.';
        }

        $validationResult = $this->validateEmail($email);
        if ($validationResult == false) {
            return 'Podano nieprawidłowy adres email.';
        }

        // $validationResult = $this->regulationsIsSet($regulations);
        // if ($validationResult == false) {
        //     return 'Nie zatwierdzono regulaminu.';
        // }

        $playerExist = $this->playerModel->playerExist($login, $email);
        if ($playerExist == true) {

            $hashPassword = password_hash($password, PASSWORD_DEFAULT);

            $registerPlayer = $this->playerModel->registerPlayer($login, $hashPassword, $email, $regulations, $verifiedEmail, $creationDate);
            if ($registerPlayer == true) {
                $getInfo = $this->getPlayerInfo($login);
                if ($getInfo == true) {

                    session_start();
                    $idPlayer = $_SESSION['idPlayer'];
                    session_write_close();

                    $villageModel = new VillageModel();
                    $villageController = new VillageController($villageModel);
                    $createVillage = $villageController->createNewVillage($idPlayer);
                    if ($createVillage == true) {

                        header('Location: ../views/pages/game.php');
                        exit();
                    } else {
                        return 'Błąd tworzenia wioski.';
                    }
                }
                return 'Błąd pobierania danych użytkownika.';
            } else {
                return 'Konto nie zostało utworzone.';
            }
        } else {
            return 'Wybrany login lub email jest już zajęty.';
        }
    }

    public function loginPlayer(string $login, string $password)
    {
        $validationResult = $this->validateLogin($login);
        if ($validationResult == false) {
            return 'Login powinien składać się tylko z małych i dużych liter oraz cyfr.';
        }

        //TODO: uncomment after change password in DB for test account
        // $validationResult = $this->validatePassword($password);
        // if ($validationResult == false) {
        //     return 'Hasło musi mieć od 8 do 32 znaków długości i zawierać przynajmniej jedną dużą literę, jedną małą literę, jedną cyfrę i jeden znak specjalny.';
        // }


        $tryLogin = $this->playerModel->loginPlayer($login, $password);
        if ($tryLogin === true) {
            $getInfo = $this->getPlayerInfo($login);

            if ($getInfo == true) {

                header('Location: ../views/pages/game.php');
                exit();
            }
            return 'Błąd pobierania danych użytkownika.';
        } else {
            return 'Błędne dane logowania.';
        }
    }


    public function logoutPlayer()
    {
        session_start();
        $_SESSION = array();
        session_destroy();
        header('Location: ../../index.php');
        exit();
    }

}


