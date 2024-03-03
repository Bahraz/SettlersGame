<?php


echo (new \Bahraz\SettlersGame\Views\Components\Header)->displayHeader();

if (isset($_GET['action'])){
    if($_GET['action']==='register'){
        echo (new \Bahraz\SettlersGame\Views\Auth\RegisterForm)->displayRegisterForm(); 
    } elseif ($_GET['action']==='login'){
        echo (new \Bahraz\SettlersGame\Views\Auth\LoginForm)->displayLoginForm();
    }
}else{
    echo (new \Bahraz\SettlersGame\Views\Auth\LoginForm)->displayLoginForm();
}


// $url = isset($_SERVER['PATH_INFO']) ? explode('/', ltrim($_SERVER['PATH_INFO'], '/')) : [];
echo '<br/><br/><br/>';


print_r($_SERVER['REQUEST_URI']);

