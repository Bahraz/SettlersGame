<?php

// if (! class_exists('DatabaseConnection')) {
//     include('../controllers/connection.php');
// }
namespace Bahraz\SettlersOnline\models;

use PDO;
use Bahraz\SettlersOnline\controllers\DatabaseConnection;

class PlayerModel
{
    private $connection;

    public function __construct(DatabaseConnection $databaseConnection)
    {
        $this->connection = $databaseConnection->getConnection();
    }

    public function playerExist(string $login, string $email)
    {
        $stmt = $this->connection->prepare("SELECT * FROM players WHERE login = :login OR email = :email");
        $stmt->bindParam(':login', $login, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return false;
        } else {
            return true;
        }
    }

    public function registerPlayer(string $login, string $hashPassword, string $email, bool $regulations, bool $verifiedEmail, string $creationDate)
    {
        $stmt = $this->connection->prepare("INSERT INTO players (login,password,email,regulations,verifiedEmail,creationDate) VALUES (:login, :hashPassword, :email, :regulations, :verifiedEmail, :creationDate)");
        $stmt->bindParam(':login', $login, PDO::PARAM_STR);
        $stmt->bindParam(':hashPassword', $hashPassword, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':regulations', $regulations, PDO::PARAM_BOOL);
        $stmt->bindParam(':verifiedEmail', $verifiedEmail, PDO::PARAM_BOOL);
        $stmt->bindParam(':creationDate', $creationDate, PDO::PARAM_INT);

        $stmt->execute();

        return true;
    }

    public function loginPlayer(string $login, string $checkPassword)
    {
        $stmt = $this->connection->prepare("SELECT * FROM players WHERE login = :login");
        $stmt->bindParam(':login', $login, PDO::PARAM_STR);
        $stmt->execute();

        $playerDataArray = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($playerDataArray && password_verify($checkPassword, $playerDataArray['password'])) {
            return true;
        } else {
            return false;
        }
    }

    public function getPlayerInfo(string $login)
    {
        $stmt = $this->connection->prepare("SELECT * FROM players WHERE login = :login");
        $stmt->bindParam(':login', $login, PDO::PARAM_STR);
        $stmt->execute();

        $playerDataArray = $stmt->fetch(PDO::FETCH_ASSOC);

        return $playerDataArray;
    }



}

