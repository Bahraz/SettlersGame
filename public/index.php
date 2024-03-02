<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/routes.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../');
$dotenv->load();

include('../src/Views/Home/Home.php');
