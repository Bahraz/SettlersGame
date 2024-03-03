<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/Router.php';

use Bahraz\SettlersGame\Router;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../');
$dotenv->load();

$router = new Router();
$match=$router->match($_SERVER['REQUEST_URI'],$_SERVER['REQUEST_METHOD']);

include('../src/Views/Home/Home.php');
