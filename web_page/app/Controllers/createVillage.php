<?php
include("./connection.php");

if (session_status() == PHP_SESSION_NONE) {
    // Start the session
    session_start();
}


function CreateVillage($x, $y, $id, $conn)
{
    // Tworzenie zapytania generującego wioskę.
    $create_village = $conn->prepare("INSERT INTO village (`id_player`, `village_x`, `village_y`, `village_name`, `village_points`, `castle_lv`, `claypit_lv`, `ironmine_lv`, `sawmill_lv`, `warehouse_lv`, `farms_lv`, `smithy_lv`, `barracks_lv`, `walls_lv`, `commandstaff_lv`, `knightchamber_lv`) VALUES ('$id', $x,$y,'Village',46,2,1,1,1,2,2,0,0,0,0,0)");


    $create_village->execute();
}

function CheckVillage($x,$y,$id,$conn){
            // Tworzenie zapytania sprawdzającego istinienie wioski w danym miejscu oraz czy gracz ten posiada już wioskę.
            $check_coordinates = $conn->prepare("SELECT * FROM village WHERE id_player = :pdo_idplayer OR village_x = $x AND village_y = $y");

            // Przypisanie parametrów i wykonanie polecenia
            $check_coordinates->bindParam(':pdo_idplayer', $id, PDO::PARAM_STR);
            $check_coordinates->execute();
            $num_rows = $check_coordinates->rowCount();
            return $num_rows;
}

function RandCoord(){
    $coord_x = rand(0, 10);
    $coord_y = rand(0, 10);
    return array($coord_x,$coord_y);
}


    try {

        $pdo_connection = new PDO("mysql:host=$servername;dbname=$database", $db_username, $db_password);

        $pdo_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $coord_x= 0;
        $coord_y= 0;

        $num_rows=CheckVillage($coord_x,$coord_y,$_SESSION['id_player'],$pdo_connection);


    if($num_rows>0){

        
        header('Location: ../View/pages/game.php');
        session_write_close();
        exit();
    }else{
        do{
            $coordinates=RandCoord();
            $coord_x=$coordinates[0];
            $coord_y=$coordinates[1];  

            $num_rows=CheckVillage($coord_x,$coord_y,$_SESSION['id_player'],$pdo_connection);

        }while($num_rows!=0);


    }
//TODO: połączenie do bazy danych i przeszukanie coord_x czy występuje, jeśli nie to go idziemy dalej, jeśli tak to dalej.
    CreateVillage($coord_x, $coord_y, $_SESSION['id_player'], $pdo_connection);
    header('Location: ../View/pages/game.php');

    exit();
} catch (PDOException $e) {
    //TODO: Dodanie skryptu, który dodaje informacje do logów serwera.
    echo "Błąd połączenia z bazą danych: " . $e->getMessage();
} finally {
    $pdo_connection = null;
}