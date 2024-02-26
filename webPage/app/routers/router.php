<?php

namespace Bahraz\SettlersOnline\router;

require_once('../../vendor/autoload.php');

// require_once("../controllers/connection.php");

use Bahraz\SettlersOnline\controllers\DatabaseConnection;
use Bahraz\SettlersOnline\controllers\PlayerController;


$databaseConnection = new DatabaseConnection($servername, $database, $dbUsername, $dbPassword);

$player = new PlayerController($databaseConnection);

// class Router
// {
//     function __construct(){

//         if(isset($_GET['url'])){
//             echo $_GET['url'];
//         }
//         else{
//             echo "Parametr nie został podany";
//         }
//     }
 
//     function match($controller,$method){

//     }
// }
// $databaseConnection = DatabaseConnection::connect();

// $databaseConnection = new Bahraz\SettlersOnline\controllers\DatabaseConnection($servername, $database, $dbUsername, $dbPassword);

// $databaseConnection = new DatabaseConnection;



if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        switch ($action) {
            case 'loginPlayer':
                if (isset($_POST['login']) && isset($_POST['password'])) {
                    // $playerController = new PlayerController($databaseConnection);
                    global $playerController;
                    $login = htmlspecialchars($_POST['login']);
                    $password = $_POST['password'];
                    $playerController->loginPlayer($login, $password);
                }
                break;
            case 'registerPlayer':

                if (isset($_POST['login']) && isset($_POST['password']) && isset($_POST['email']) && isset($_POST['regulations'])) {

                    $login = htmlspecialchars($_POST['login']);
                    $password = $_POST['password'];
                    $email = $_POST['email'];
                    $regulations = isset($_POST['regulations']);
                    $verifiedEmail = false;
                    $creationDate = date('Ymd');

                    $playerController->registerPlayer($login, $password, $email, $regulations, $verifiedEmail, $creationDate);
                }
                break;

            case 'logoutPlayer':
                $playerController->logoutPlayer();
                break;
        }
    }
}


