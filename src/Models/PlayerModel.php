<?php

namespace Bahraz\SettlersGame\Models;

use Bahraz\SettlersGame\Controllers\DatabaseConnection;
use PDO;

class PlayerModel
{
    private $connection;

    public function __construct(DatabaseConnection $databaseConnection)
    {
        $this->connection = $databaseConnection->getConnection();
    }

}