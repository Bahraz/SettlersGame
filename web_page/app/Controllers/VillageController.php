<?php

if (! class_exists('DatabaseConnection')) {
    include('../controllers/connection.php');
}
include('../models/VillageModel.php');
//TODO: add village controller {need change}
class VillageController
{
    private $VillageModel;

    public function __construct($pdo)
    {
        $this->VillageModel = new VillageModel($pdo);
    }

    public function RandCoordVillage()
    {
        return $this->VillageModel->RandCoordVillage();
    }

    public function CheckPlayerHasVillage($idPlayer)
    {
        return $this->VillageModel->CheckPlayerHasVillage($idPlayer);
    }
    public function CheckVillageExist($coordX, $coordY)
    {
        return $this->VillageModel->CheckVillageExist($coordX, $coordY);
    }

    public function CreateVillage($coordX, $coordY, $idPlayer)
    {
        return $this->VillageModel->CreateVillage($coordX, $coordY, $idPlayer);
    }

    public function CreateNewVillage($idPlayer)
    {
        $hasVillage = $this->CheckPlayerHasVillage($idPlayer);
        if (! $hasVillage) {
            do {
                $coordinates = $this->RandCoordVillage();
                $coordX = $coordinates[0];
                $coordY = $coordinates[1];
            } while ($this->CheckVillageExist($coordX, $coordY));

            $this->VillageModel->CreateVillage($coordX, $coordY, $idPlayer);

            return true;
        }
        return false;
    }
}


