<?php
    require ("config/conexion.php");

    $query = "SELECT * FROM productoras;";
    $result = $db1 -> prepare($query);
    $result -> execute();
    $productoras = $result -> fetchAll();
    echo $productoras[0][0];

    $query = "SELECT * FROM artistas;";
    $result = $db2 -> prepare($query);
    $result -> execute();
    $artistas = $result -> fetchAll();
    echo $artistas[0][0];

    $ids = 0;

    function randomPassword() {
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);
    }
    
    foreach ($productoras as $p) {
        $password = randomPassword();
        $username = strtolower(str_replace(" ", "_", $p[1]));

        $query = "SELECT id FROM productoras WHERE $p[1] = nombre;";
        $result = $db2 -> prepare($query);
        $result -> execute();
        $productora = $result -> fetchAll();
        echo $prod;
        foreach ($productora as $prod) {
            $id_impar = $prod[0];
        }

        $query = "SELECT importar_productora($ids, $username, $password, $p[0], $id_impar);";
        $result = $db2 -> prepare($query);
        $result -> execute();
        $result -> fetchAll();

        $ids += 1;

    }

    foreach ($artistas as $a) {
        $password = randomPassword();
        $username = strtolower(str_replace(" ", "_", $a[1]));

        $query = "SELECT id FROM artistas WHERE $a[1] = nombre;";
        $result = $db2 -> prepare($query);
        $result -> execute();
        $artista = $result -> fetchAll();

        foreach ($artista as $art) {
            $id_impar = $art[0];
        }

        $query = "SELECT importar_artista($ids, $username, $password, $a[0], $id_impar);";
        $result = $db2 -> prepare($query);
        $result -> execute();
        $result -> fetchAll();

        $ids += 1;

    }
?>



















