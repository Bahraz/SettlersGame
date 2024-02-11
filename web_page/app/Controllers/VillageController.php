<?php

include("../Controllers/connection.php");
include("../Models/VillageModel.php");

class VillageController
{
    private $villageModel;

    public function __construct($pdo)
    {
        $this->villageModel = new VillageModel($pdo);
    }

}

$VillageController = new VillageController($databaseConnection->getConnection());
