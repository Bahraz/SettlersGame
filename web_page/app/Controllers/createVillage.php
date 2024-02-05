<?php
include("./connection.php");

if (session_status() == PHP_SESSION_NONE) {
    // Start the session
    session_start();


function CreateVillage($coord_x, $coord_y)
{

}

//TODO: połączenie do bazy danych i przeszukanie coord_x czy występuje, jeśli nie to go idziemy dalej, jeśli tak to dalej.
try {
    // Tworzenie nowego połączenia PDO
    $pdo_connection = new PDO("mysql:host=$servername;dbname=$database", $db_username, $db_password);

    // Ustawienie opcji PDO, aby wyrzucało wyjątki w przypadku błędów
    $pdo_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $coord_x = rand(0, 50);
    $coord_y = rand(0, 50);

    echo $coord_x;
    echo ",";
    echo $coord_y;

    // Tworzenie zapytania sprawdzającego istinienie wioski
    $check_coordinates = $pdo_connection->prepare("SELECT * FROM village WHERE id_player = :pdo_idplayer OR village_x = $coord_x AND village_y = $coord_y");

    // Przypisanie parametrów i wykonanie polecenia
    $check_coordinates->bindParam(':pdo_idplayer', $_SESSION['player'], PDO::PARAM_STR);
    $check_coordinates->execute();

    // Pobranie wyników
    $num_rows = $check_coordinates->rowCount();
    // Sprawdzenie, czy użytkownik istnieje
    if ($num_rows > 0) {

        //Powtórz losowanie.

    } else {

        //TODO: sprawdź czy gracz posiada już wioskę.
        // Tworzenie zapytania generującego wioskę.
        $create_village = $pdo_connection->prepare("INSERT INTO village (`id_player`, `id_village`, `village_x`, `village_y`, `village_name`, `village_points`, `castle_lv`, `claypit_lv`, `ironmine_lv`, `sawmill_lv`, `warehouse_lv`, `farms_lv`, `smithy_lv`, `barracks_lv`, `walls_lv`, `commandstaff_lv`, `knightchamber_lv`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]','[value-6]','[value-7]','[value-8]','[value-9]','[value-10]','[value-11]','[value-12]','[value-13]','[value-14]','[value-15]','[value-16]','[value-17]')");


        $create_village->execute();


        $pdo_connection = null;
}

        //TODO: Create first village in game and go to game page

        $_SESSION['id_player'] = $user_data['id_player'];
        $_SESSION['login'] = $user_data['login'];
        session_write_close();

       // header('Location: ../../index.php');

        exit();
    }

} catch (PDOException $e) {
    //TODO: Dodanie skryptu, który dodaje informacje do logów serwera.
    echo "Błąd połączenia z bazą danych: " . $e->getMessage();
} finally {
    $pdo_connection = null;
}