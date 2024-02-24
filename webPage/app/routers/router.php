<?php
// namespace Bahraz\SettlersOnline;

// require_once("../../vendor/autoload.php");

use Bahraz\SettlersOnline\controllers\DatabaseConnection;
use Bahraz\SettlersOnline\controllers\PlayerController;

// $databaseConnection = DatabaseConnection::connect();

// $databaseConnection = new Bahraz\SettlersOnline\controllers\DatabaseConnection($servername, $database, $dbUsername, $dbPassword);
$databaseConnection = new DatabaseConnection($servername, $database, $dbUsername, $dbPassword);

$playerController = new PlayerController($databaseConnection);

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {


//     if (isset($_POST['action'])) {
//         $action = $_POST['action'];

//         switch ($action) {
//             case 'loginPlayer':
//                 if (isset($_POST['login']) && isset($_POST['password'])) {
//                     // $playerController = new PlayerController($databaseConnection);
//                     global $playerController;
//                     $login = htmlspecialchars($_POST['login']);
//                     $password = $_POST['password'];
//                     $playerController->loginPlayer($login, $password);
//                 }
//                 break;
//             case 'registerPlayer':

//                 if (isset($_POST['login']) && isset($_POST['password']) && isset($_POST['email']) && isset($_POST['regulations'])) {

//                     $login = htmlspecialchars($_POST['login']);
//                     $password = $_POST['password'];
//                     $email = $_POST['email'];
//                     $regulations = isset($_POST['regulations']);
//                     $verifiedEmail = false;
//                     $creationDate = date('Ymd');

//                     $playerController->registerPlayer($login, $password, $email, $regulations, $verifiedEmail, $creationDate);
//                 }
//                 break;

//             case 'logoutPlayer':
//                 $playerController->logoutPlayer();
//                 break;
//         }
//     }
// }


