<?php
session_start();
if (!isset($_SESSION['id_player'])) {
    session_write_close();
    header('Location: ../../../index.php');
    exit();
}
include('../layouts/header.php');
?>

<body>
    <h1>Witaj w grze!</h1>
    <?php
    echo "<p>Witaj " . $_SESSION['id_player'] . $_SESSION['login'] . "!<br/><br/>"
        ?>
    <form action="../../Controllers/logout.php" method="POST">
        <input type="submit" value="Wyloguj" /></a>
    </form>

</html>