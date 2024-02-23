<?php

namespace Bahraz\SettlersOnline;

use Bahraz\SettlersOnline\app\controllers\PlayerController;



$playerController = new PlayerController($databaseConnection);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //     if (isset($_POST['action'])) {
    //         $action = $_POST['action'];
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        //         switch ($action) {
        //             case 'loginPlayer':
        //                 if (isset($_POST['login']) && isset($_POST['password'])) {
        //                     $login = htmlspecialchars($_POST['login']);
        //                     $password = $_POST['password'];
        //                     $playerController->loginPlayer($login, $password);
        //                 }
        //                 break;
        switch ($action) {
            case 'loginPlayer':
                if (isset($_POST['login']) && isset($_POST['password'])) {
                    // $playerController = new PlayerController($databaseConnection);
                    $login = htmlspecialchars($_POST['login']);
                    $password = $_POST['password'];
                    $playerController->loginPlayer($login, $password);
                }
                break;

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
// $request_uri = $_SERVER['REQUEST_URI'];
// echo $request_uri;
// TODO: add routers for register some change

// check routers method

