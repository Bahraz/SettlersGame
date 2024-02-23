<?php

// if (! class_exists('DatabaseConnection')) {
//     include('../controllers/connection.php');
// }
namespace Bahraz\SettlersOnline\app\models;

use PDO;
use Bahraz\SettlersOnline\app\controllers\DatabaseConnection;

class VillageModel
{
    private $connection;

    public function __construct(DatabaseConnection $databaseConnection)
    {
        $this->connection = $databaseConnection->getConnection();
    }
    public function checkPlayerHasVillage($idPlayer)
    {
        $checkPlayerHasVillage = $this->connection->prepare('SELECT * FROM village WHERE id_player = :pdo_idplayer');
        $checkPlayerHasVillage->bindParam(':pdo_idplayer', $idPlayer, PDO::PARAM_STR);
        $checkPlayerHasVillage->execute();
        $num_rows = $checkPlayerHasVillage->rowCount();
        return $num_rows;
    }

    public function checkVillageCoordinates($coordX, $coordY)
    {
        //checking village with coord X&Y exist
        $checkVillageCoordinates = $this->connection->prepare('SELECT * FROM village WHERE village_x = ' . $coordX . ' AND village_y = ' . $coordY . '');
        $checkVillageCoordinates->execute();
        $num_rows = $checkVillageCoordinates->rowCount();

        if ($num_rows != 0) {
            return false;
        } else {
            return true;
        }

    }

    public function createVillage($coordX, $coordY, $idPlayer)
    {
        $createVillage = $this->connection->prepare("INSERT INTO village (`id_player`, `village_x`, `village_y`, `village_name`, `village_points`, `castle_lv`, `claypit_lv`, `ironmine_lv`, `sawmill_lv`, `warehouse_lv`, `farms_lv`, `smithy_lv`, `barracks_lv`, `walls_lv`, `commandstaff_lv`, `knightchamber_lv`) VALUES (:idPlayer, :coordX, :coordY, 'Village', 46, 2, 1, 1, 1, 2, 2, 0, 0, 0, 0, 0)");

        $createVillage->bindParam(':idPlayer', $idPlayer, PDO::PARAM_INT);
        $createVillage->bindParam(':coordX', $coordX, PDO::PARAM_INT);
        $createVillage->bindParam(':coordY', $coordY, PDO::PARAM_INT);
        $createVillage->execute();
    }

}

