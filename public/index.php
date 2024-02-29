<?php

require_once __DIR__ . '/../vendor/autoload.php';

// include('../src/views/home/index.php');

// include('../src/routes.php');

// include('../src/views/home/index.php');
// use Bahraz\SettlersGame\views\components\HeaderViews;

// $test = new HeaderViews;

// $test->displayHeader();
include("../src/routes.php");
//
// <!DOCTYPE html>
// <html lang="pl">

// <head>
//     <meta charset="UTF-8">
//     <meta name="viewport" content="width=device-width, initial-scale=1.0">
//     <title>Document</title>
// </head>

// <body>
//     <?php
//     print_r(get_declared_classes());
//     
// </body>

// </html>

// Na powyższym przykładzie do zmiennej $cls1 potrzebujesz klasy \Bahraz\Controller\User\IndexController();
// więc autoloader bierze sobie tablicę autoload wpis psr-4 i sprawdza zdeklarowane namespace i gdy w tam masz np. Bahraz\\
// no to patrzy mam taki wpis i pobiera wpisaną tam ścieżkę,
// następnie dodaje do niej pełną nazwę klasy i
// ten sposób dostajesz pełną ścieżkę do pliku gdzie jest klasa
// i inkluduje sobię ją i możesz z niej korzystać i taka ścieżka wygląda wtedy mniejwięcej tak:

// /home/Bahraz/project/src/Controller/User/IndexController.php. w

// Przykładzie drugim zadziała podobnie tylko tutaj weźmie sobie `use` dodaj do Admin\IndexController i wtedy klasa wygląda
// tak \Bahraz\Controller\Admin\IndexController 