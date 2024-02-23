<?php


namespace Bahraz\SettlersOnline\controllers;

// include('../models/VillageModel.php');

use Bahraz\SettlersOnline\models\VillageModel;

class VillageController
{
    private $villageModel;

    public function __construct($villageModel = null)
    {
        $this->villageModel = new VillageModel($villageModel);
    }

    public function villageCoordinateDraw()
    {
        $coordX = rand(0, 10);
        $coordY = rand(0, 10);
        return array($coordX, $coordY);
    }

    public function checkPlayerHasVillage($idPlayer)
    {
        return $this->villageModel->checkPlayerHasVillage($idPlayer);
    }
    public function checkVillageCoordinates($coordX, $coordY)
    {
        return $this->villageModel->checkVillageCoordinates($coordX, $coordY);
    }

    public function createVillage($coordX, $coordY, $idPlayer)
    {
        return $this->villageModel->createVillage($coordX, $coordY, $idPlayer);
    }

    public function createNewVillage($idPlayer)
    {

        $hasVillage = $this->checkPlayerHasVillage($idPlayer);
        if (! $hasVillage) {
            do {
                $coordinates = $this->villageCoordinateDraw();
                $coordX = $coordinates[0];
                $coordY = $coordinates[1];
            } while ($this->checkVillageCoordinates($coordX, $coordY));

            $this->villageModel->createVillage($coordX, $coordY, $idPlayer);

            return true;
        }
        return false;
    }

}


