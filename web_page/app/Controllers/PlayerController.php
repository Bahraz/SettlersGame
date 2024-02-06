<?php
include("../Controllers/connection.php");
include("../Models/PlayerModel.php");

class PlayerModel
{
    private $player;

    public function __construct($pdo_connection)
    {
        $this->player = new PlayerModel($pdo_connection);
        $this->connection = $pdo_connection;
    }



    public function registerAccount($login, $password, $email, $regulations)
    {
        $result = $this->registerAccount($login, $password, $email, $regulations);
        if ($result === true) {
            return "Konto zostało pomyślnie utworzone";
        } else {
            return $result;
        }
    }

    public function loginAccount($login, $password)
    {
        $result = $this->loginAccount($login, $password);
        if ($result === true) {
            return "Zalogowano pomyślnie";
        } else {
            return $result;
        }
    }
}


