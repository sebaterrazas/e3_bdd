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

        $query = "SELECT importar_productora($username, $password);";
        $result = $db2 -> prepare($query);
        $result -> execute();
        $result -> fetchAll();
    }

    foreach ($artistas as $a) {
        $password = randomPassword();
        $username = strtolower(str_replace(" ", "_", $a[1]));

        $query = "SELECT importar_artista($username, $password);";
        $result = $db2 -> prepare($query);
        $result -> execute();
        $result -> fetchAll();
    }
    INSERT INTO usuarios (nombre_usuario, contraseña, tipo) VALUES ('usuario', 'contraseña', 'artista');
    /* header('Location: ' . 'index.php', true, 303);
    die(); */
?>
<?php include('templates/footer.html');   ?>



















