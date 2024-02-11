<?php

class VillageModel
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    function RandCoordVillage(){
        $coordX = rand(0, 10);
        $coordY = rand(0, 10);
        return array($coordX,$coordY);
    }

    function CheckVillage($coordX,$coordY,$idPlayer){
        // Tworzenie zapytania sprawdzającego istinienie wioski w danym miejscu oraz czy gracz ten posiada już wioskę.
        $checkCoordinates = $this->pdo->prepare("SELECT * FROM village WHERE id_player = :pdo_idplayer OR village_x = $coordX AND village_y = $coordY");

        // Przypisanie parametrów i wykonanie polecenia
        $checkCoordinates->bindParam(':pdo_idplayer', $idPlayer, PDO::PARAM_STR);
        $checkCoordinates->execute();
        $num_rows = $checkCoordinates->rowCount();
        return $num_rows;
}

    public function CreateVillage($coordX,$coordY,$idPlayer){
        $createVillage = $this->pdo->prepare("INSERT INTO village (`id_player`, `village_x`, `village_y`, `village_name`, `village_points`, `castle_lv`, `claypit_lv`, `ironmine_lv`, `sawmill_lv`, `warehouse_lv`, `farms_lv`, `smithy_lv`, `barracks_lv`, `walls_lv`, `commandstaff_lv`, `knightchamber_lv`) VALUES ('$idPlayer', $coordX,$coordY,'Village',46,2,1,1,1,2,2,0,0,0,0,0");

        $createVillage->execute();
    }

}
