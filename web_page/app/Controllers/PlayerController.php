<?php

include("../Controllers/connection.php");
include("../Models/PlayerModel.php");

class PlayerController
{
    private $playerModel;

    public function __construct($databaseConnection)
    {
        $this->playerModel = new PlayerModel($databaseConnection->getConnection());
    }

    public function registerAccount($login, $password, $email, $regulations, $registerDate)
    {

        $result = $this->playerModel->registerAccount($login, $password, $email, $regulations, $registerDate);
        return $result;
    }

    public function loginAccount($login, $password)
    {
        $result = $this->playerModel->loginAccount($login, $password);
        return $result;

    }
}

global $databaseConnection;
$playerController = new PlayerController($databaseConnection);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['action'] == 'registerAccount') {

        $pdoLogin = isset($_POST['login']) ? htmlspecialchars($_POST['login']) : '';
        $pdoPassword = isset($_POST['password']) ? $_POST['password'] : '';
        $pdoEmail = isset($_POST['email']) ? filter_var($_POST['email'], FILTER_SANITIZE_EMAIL) : '';
        $pdoRegulations = isset($_POST['regulations']);
        $pdoRegisterDate = date("Ymd");

        $playerController->registerAccount($pdoLogin, $pdoPassword, $pdoEmail, $pdoRegulations, $pdoRegisterDate);

        header("Location: ../View/pages/game.php");
        $databaseConnection = null;
        exit();

    } else if ($_POST['action'] == 'loginAccount') {

        $pdoLogin = isset($_POST['login']) ? htmlspecialchars($_POST['login']) : '';
        $pdoPassword = isset($_POST['password']) ? $_POST['password'] : '';

        $playerController->loginAccount($pdoLogin, $pdoPassword);

        header('Location: ../View/pages/game.php');
        $databaseConnection = null;
        exit();

    }
}