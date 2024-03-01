<?php


echo (new \Bahraz\SettlersGame\Views\Components\ShowHeader)->displayHeader();

// print_r(get_declared_classes());



// print_r($_ENV);


$zmiennaEnv = $_ENV['TEST_KEY'];
echo $zmiennaEnv;
