<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/routes.php';

use Bahraz\SettlersGame\Routes;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../');
$dotenv->load();

$requesUri = $_SERVER['REQUEST_URI'];

// $urlParts=explode('?',$requestUri);
$path = isset($urlParts[0])?$urlParts[0]:'/';

$router = new Routes();


include('../src/Views/Home/Home.php');
