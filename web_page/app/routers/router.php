<?php

$requestUri = $_SERVER["REQUEST_URI"];
// echo $requestUri;

if (strpos($requestUri, "index.php") !== false) {
} else {
    // echo $requestUri;
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $playerControllerPath = "../controllers/PlayerController.php";
        include($playerControllerPath);
        $playerController = new PlayerController($databaseConnection);

        if (strpos($requestUri, "/login") !== false) {

            if (isset($_POST['login']) && isset($_POST['password'])) {
                $login = htmlspecialchars($_POST['login']);
                $password = $_POST['password'];
                $playerController->loginPlayer($login, $password);
            }
            // if (isset($_POST['action'])) {
            //     $action = $_POST['action'];

            //     // switch ($action) {
            //     //     case 'loginPlayer':
            //     //         if (isset($_POST['login']) && isset($_POST['password'])) {
            //     //             $login = htmlspecialchars($_POST['login']);
            //     //             $password = $_POST['password'];
            //     //             $playerController->loginPlayer($login, $password);
            //     //         }
            //     //         break;

            //     //     case 'registerPlayer':

            //     //         if (isset($_POST['login']) && isset($_POST['password']) && isset($_POST['email']) && isset($_POST['regulations'])) {

            //     //             $login = htmlspecialchars($_POST['login']);
            //     //             $password = $_POST['password'];
            //     //             $email = $_POST['email'];
            //     //             $regulations = isset($_POST['regulations']);
            //     //             $verifiedEmail = false;
            //     //             $creationDate = date('Ymd');

            //     //             $playerController->registerPlayer($login, $password, $email, $regulations, $verifiedEmail, $creationDate);
            //     //         }
            //     //         break;

            //     //     case 'logoutPlayer':
            //     //         $playerController->logoutPlayer();
            //     //         break;
            //     // }
            // }
        } else if (strpos($requestUri, '/register') !== false) {
            if (isset($_POST['login']) && isset($_POST['password']) && isset($_POST['email']) && isset($_POST['regulations'])) {

                $login = htmlspecialchars($_POST['login']);
                $password = $_POST['password'];
                $email = $_POST['email'];
                $regulations = isset($_POST['regulations']);
                $verifiedEmail = false;
                $creationDate = date('Ymd');

                $playerController->registerPlayer($login, $password, $email, $regulations, $verifiedEmail, $creationDate);
            }
        } else if (strpos($requestUri, '/logout') !== false) {
            $playerController->logoutPlayer();

        }
    }
}
// $request_uri = $_SERVER['REQUEST_URI'];
// echo $request_uri;
// TODO: add routers for register some change

// check routers method
