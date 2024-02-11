<?php

include("../Controllers/connection.php");
include("../Models/PlayerModel.php");

class PlayerController
{
    private $playerModel;

    public function __construct($pdo)
    {
        $this->playerModel = new PlayerModel($pdo);
    }

    public function registerAccount($login, $password, $email, $regulations, $registerDate)
    {
        return $this->playerModel->registerAccount($login, $password, $email, $regulations, $registerDate);
    }

    public function loginAccount($login, $password)
    {
        return $this->playerModel->loginAccount($login, $password);
    }

    public function logoutAccount()
    {
        return $this->playerModel->logoutAccount();
    }
}

$playerController = new PlayerController($databaseConnection->getConnection());

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['action'] == 'registerAccount') {
        $login = isset($_POST['login']) ? htmlspecialchars($_POST['login']) : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $email = isset($_POST['email']) ? filter_var($_POST['email'], FILTER_SANITIZE_EMAIL) : '';
        $regulations = isset($_POST['regulations']);
        $registerDate = date("Ymd");

        $playerController->registerAccount($login, $password, $email, $regulations, $registerDate);

        header("Location: ../View/pages/game.php");
        exit();
    } elseif ($_POST['action'] == 'loginAccount') {
        $login = isset($_POST['login']) ? htmlspecialchars($_POST['login']) : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $playerController->loginAccount($login, $password);

        header('Location: ../View/pages/game.php');
        exit();
    } elseif ($_POST['action'] == 'logoutAccount') {
        $playerController->logoutAccount();
        header('Location: ../../index.php');
        exit();
    }
}