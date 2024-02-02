<?php
    session_start();
    if(isset($_SESSION['id_player'] ))
    {
        session_destroy();
        header('Location: ../../index.php');
        exit();
    }