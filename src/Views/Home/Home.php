<?php


// echo (new \Bahraz\SettlersGame\Views\Components\ShowHeader)->displayHeader();

echo (new \Bahraz\SettlersGame\Views\Auth\ShowLoginForm)->displayLoginForm();

// echo (new \Bahraz\SettlersGame\Views\Components\ShowFooter)->displayFooter();


// $url = isset($_SERVER['PATH_INFO']) ? explode('/', ltrim($_SERVER['PATH_INFO'], '/')) : [];
echo '<br/><br/><br/>';


print_r($_SERVER['REQUEST_URI']);

