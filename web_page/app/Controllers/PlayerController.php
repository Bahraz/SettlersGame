<?php

include("../Controllers/connection.php");
include("../Models/PlayerModel.php");

class PlayerController
{
    private $playerModel;

    public function __construct($databaseConnection)
    {
        $this->playerModel = new PlayerModel($databaseConnection);
    }

    public function registerAccount($login, $password, $email, $regulations, $connection)
    {
        $result = $this->playerModel->registerAccount($login, $password, $email, $regulations);
        return $result;
    }
}


$databaseConnection = new DatabaseConnection($servername, $database, $dbUsername, $dbPassword);
$playerController = new PlayerController($databaseConnection);

// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     $pdo_connection = new PDO("mysql:host=localhost;dbname=twoja_baza_danych", $db_username, $db_password);

//     $controller = new PlayerController($pdo_connection);

//     if ($_POST['action'] == 'registerAccount') {
//         $controller->registerAccount($_POST['login'], $_POST['password'], $_POST['email'], $_POST['regulations']);
//     } elseif ($_POST['action'] == 'loginAccount') {
//         $controller->loginAccount($_POST['login'], $_POST['password']);

//     }
// }


// public function loginAccount($login, $password)
// {
//     $result = $this->loginAccount($login, $password);
//     if ($result === true) {
//         return "Zalogowano pomyślnie";
//     } else {
//         return $result;
//     }
// }
