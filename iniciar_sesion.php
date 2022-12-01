<?php
    require ("config/conexion.php");

    $query = "SELECT * FROM usuarios;";
    $result = $db1 -> prepare($query);
    $result -> execute();
    $productoras = $result -> fetchAll();
    

    header('Location: ' . 'index.php', true, 303);
    die();
?>