<?php

require_once __DIR__ . '/../vendor/autoload.php';

// use Bahraz\SettlersGame\views\components\HeaderViews;

// $test = new HeaderViews;

// $test->displayHeader();
echo (new \Bahraz\SettlersGame\Views\Components\HeaderViews)->displayHeader();

print_r(get_declared_classes());