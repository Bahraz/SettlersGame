<?php

// Inkludowanie pliku kontrolera i modelu
include("../../Controllers/PlayerController.php");
include("../../Models/PlayerModel.php");

// Tworzenie obiektu kontrolera
$playerController = new PlayerController(new PlayerModel($pdo));

// Wywołanie funkcji logowania
$playerController->loginPlayer($_POST['login'], $_POST['password']);