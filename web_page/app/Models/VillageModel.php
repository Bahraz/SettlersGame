<?php

class VillageModel
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    function RandCoordVillage()
    {
        $coordX = rand(0, 10);
        $coordY = rand(0, 10);
        return array($coordX, $coordY);
    }

    function CheckPlayerHasVillage($idPlayer)
    {
        // Tworzenie zapytania sprawdzającego istinienie wioski w danym miejscu oraz czy gracz ten posiada już wioskę.
        $checkPlayerHasVillage = $this->pdo->prepare("SELECT * FROM village WHERE id_player = :pdo_idplayer");

        // Przypisanie parametrów i wykonanie polecenia
        $checkPlayerHasVillage->bindParam(':pdo_idplayer', $idPlayer, PDO::PARAM_STR);
        $checkPlayerHasVillage->execute();
        $num_rows = $checkPlayerHasVillage->rowCount();
        return $num_rows;
    }

    public function CheckVillageExist($coordX, $coordY)
    {
        $checkVillageExist = $this->pdo->prepare("SELECT * FROM village WHERE village_x = $coordX AND village_y = $coordY");
        $checkVillageExist->execute();
        $num_rows = $checkVillageExist->rowCount();

        if ($num_rows != 0) {
            return false;
        } else {
            return true;
        }

    }

    public function CreateVillage($coordX, $coordY, $idPlayer)
    {
        $createVillage = $this->pdo->prepare("INSERT INTO village (`id_player`, `village_x`, `village_y`, `village_name`, `village_points`, `castle_lv`, `claypit_lv`, `ironmine_lv`, `sawmill_lv`, `warehouse_lv`, `farms_lv`, `smithy_lv`, `barracks_lv`, `walls_lv`, `commandstaff_lv`, `knightchamber_lv`) VALUES (:idPlayer, :coordX, :coordY, 'Village', 46, 2, 1, 1, 1, 2, 2, 0, 0, 0, 0, 0)");

        // Związanie parametrów
        $createVillage->bindParam(':idPlayer', $idPlayer, PDO::PARAM_INT);
        $createVillage->bindParam(':coordX', $coordX, PDO::PARAM_INT);
        $createVillage->bindParam(':coordY', $coordY, PDO::PARAM_INT);
        

        $createVillage->execute();
    }

}