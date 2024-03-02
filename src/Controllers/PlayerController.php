<?php

namespace Bahraz\SettlersGame\Controllers;

use Bahraz\SettlersGame\Models\PlayerModel;

class PlayerController
{
    private $playerModel;

    public function __construct($playerModel)
    {
        $this->playerModel = new PlayerModel($playerModel);
    }

    public function login(){
        echo "udało się zalogować";
    }

}