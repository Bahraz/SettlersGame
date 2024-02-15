<?php
include("../controllers/PlayerController.php");
$playerController = new PlayerController($databaseConnection);

//TODO: add routers for register

//check routers method

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($_POST['action'] === 'loginPlayer') {
        $playerController->loginPlayer($_POST['login'], $_POST['password'], $_POST['action']);

    } else if ($_POST['action'] === 'logoutPlayer') {
        $playerController->logoutPlayer();
        
    }
}
