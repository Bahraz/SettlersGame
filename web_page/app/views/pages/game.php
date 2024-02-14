<?php
session_start();
if (!isset($_SESSION['idPlayer'])) {
    session_write_close();
    header('Location: ../../../index.php');
    exit();
}
include('../layouts/header.php');
?>

<body>
    <h1>Witaj w grze!</h1>
    <?php
    echo "<p>Witaj " . $_SESSION['idPlayer'] . $_SESSION['login'] . "!<br/><br/>";

    include('../auth/logout.php');
?>

</html>