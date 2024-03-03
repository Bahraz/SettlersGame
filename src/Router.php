<?php

namespace Bahraz\SettlersGame;


class Router{

    private $routes = [];

    public function addRoute($uri,$method,$callback){
        $this->routes[] = [
            'uri'=>$uri,
            'method'=>$method,
            'callback'=>$callback
        ];
    }

    public function match($uri,$method){
        foreach($this->routes as $route){
            if ($route['uri'] === $uri && $route['method']===$method){
                return $route['callback'];
            }
        }
        return null;
    }

}