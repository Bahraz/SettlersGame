<?php

if (! class_exists('DatabaseConnection')) {
    include("../Controllers/connection.php");
}
include("../Models/PlayerModel.php");
include("../Controllers/VillageController.php");

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
$villageController = new VillageController($databaseConnection->getConnection());


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['action'] == 'registerAccount') {
        $login = isset($_POST['login']) ? htmlspecialchars($_POST['login']) : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $email = isset($_POST['email']) ? filter_var($_POST['email'], FILTER_SANITIZE_EMAIL) : '';
        $regulations = isset($_POST['regulations']);
        $registerDate = date("Ymd");

        $hashPassword = password_hash($password, PASSWORD_DEFAULT);

        if (! $regulations) {
            return "Nie zaakceptowano regulaminu";
        }

        if (! preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^a-zA-Z\d]).{8,32}$/', $password)) {
            return "Hasło musi mieć od 8 do 32 znaków długości i zawierać przynajmniej jedną dużą literę, jedną małą literę, jedną cyfrę i jeden znak specjalny!";
        }

        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Podano nieprawidłowy adres email!";
        }

        $playerController->registerAccount($login, $hashPassword, $email, $regulations, $registerDate);

        $idPlayer = $_SESSION['id_player'];

        $villageController->CreateNewVillage($idPlayer);


        header("Location: ../View/pages/game.php");
        $pdo = null;
        exit();
    } elseif ($_POST['action'] == 'loginAccount') {
        $login = isset($_POST['login']) ? htmlspecialchars($_POST['login']) : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $playerController->loginAccount($login, $password);

        header('Location: ../View/pages/game.php');
        $pdo = null;
        exit();
    } elseif ($_POST['action'] == 'logoutAccount') {
        $playerController->logoutAccount();
        header('Location: ../../index.php');
        $pdo = null;
        exit();
    }
}