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

    function randomPassword() {
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);
    }
    
    foreach ($productoras as $p) {
        $password = randomPassword();
        $username = strtolower(str_replace(" ", "_", $p[1]));
        
        $query = "SELECT 1 FROM usuarios WHERE nombre_usuario=$username;";
        $result = $db2 -> prepare($query);
        $result -> execute();
        $existe = $result -> fetchAll();
        if (len($existe)) {
            continue;
        }
        // id se asigna automáticamente
        $query = "INSERT INTO usuarios (nombre_usuario, contraseña, tipo) VALUES ($username, $password, 'productora');";
        $result = $db2 -> prepare($query);
        $result -> execute();
    }

    foreach ($artistas as $a) {
        $password = randomPassword();
        $username = strtolower(str_replace(" ", "_", $a[1]));

        $query = "SELECT 1 FROM usuarios WHERE nombre_usuario=$username;";
        $result = $db2 -> prepare($query);
        $result -> execute();
        $existe = $result -> fetchAll();
        if (len($existe)) {
            continue;
        }
        // id se asigna automáticamente
        $query = "INSERT INTO users (nombre_usuario, contraseña, tipo) VALUES ($username, $password, 'artista');";
        $result = $db2 -> prepare($query);
        $result -> execute();
    }

    header('Location: ' . 'index.php', true, 303);
    die();
?>



















