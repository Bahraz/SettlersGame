<?php

namespace Bahraz\SettlersGame;

class Routes{
    public function dispatch($path){
        switch ($path){
            case '/test':
                $homeRoute = new HomeRoute();
                $homeRoute->showHome();
        }
    }
}

class HomeRoute{
    public function showHome()
    {
        echo "TEST";
    }
}

    