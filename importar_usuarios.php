<?php
    require ("config/conexion.php");

    $query = "SELECT * FROM productoras;";
    $result = $db1 -> prepare($query);
    $result -> execute();
    $productoras = $result -> fetchAll();

    $query = "SELECT * FROM artistas;";
    $result = $db2 -> prepare($query);
    $result -> execute();
    $artistas = $result -> fetchAll();

    $id = 0;

    function randomPassword() {
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);
    }
    
    foreach ($productoras as $p) {
        $password = randomPassword();
        $username = strtolower(str_replace(" ", "_", $p[1]));

        $query = "INSERT INTO users (id_usuario, nombre_usuario, contraseña, tipo) VALUES ($id, $username, $password, 'productora');";
        $result = $db2 -> prepare($query);
        $result -> execute();
        $id += 1;

    }

    foreach ($artistas as $a) {
        $password = randomPassword();
        $username = strtolower(str_replace(" ", "_", $a[1]));

        $query = "INSERT INTO users (id_usuario, nombre_usuario, contraseña, tipo) VALUES ($id, $username, $password, 'artista');";
        $result = $db2 -> prepare($query);
        $result -> execute();

        $id += 1;

    }

    echo $id
?>



















