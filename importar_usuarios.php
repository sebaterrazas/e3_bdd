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
        echo "<h5>prod: $p[1]<h5>";
        $password = randomPassword();
        $username = strtolower(str_replace(" ", "_", $p[1]));

        /* $query = "SELECT importar_productora('$username'::varchar, '$password'::varchar);";
        $result = $db2 -> prepare($query);
        $result -> execute();
        $result -> fetchAll(); */

        $query = "IF $username NOT IN (SELECT nombre_usuario FROM usuarios) THEN INSERT INTO usuarios (nombre_usuario, contraseña, tipo) VALUES ($username, $password, 'artista');";
        $result = $db1 -> prepare($query);
        $result -> execute();
    }

    foreach ($artistas as $a) {
        echo "<h5>art: $a[1]<h5>";
        $password = randomPassword();
        $username = strtolower(str_replace(" ", "_", $a[1]));

        /* $query = "SELECT importar_artista('$username'::varchar, '$password'::varchar);";
        $result = $db2 -> prepare($query);
        $result -> execute();
        $result -> fetchAll(); */

        $query = "IF $username NOT IN (SELECT nombre_usuario FROM usuarios) THEN INSERT INTO usuarios (nombre_usuario, contraseña, tipo) VALUES ($username, $password, 'artista');";
        $result = $db2 -> prepare($query);
        $result -> execute();
    }

    $query = "INSERT INTO usuarios (nombre_usuario, contraseña, tipo) VALUES ('usuario', 'contraseña', 'artista');";
    $result = $db2 -> prepare($query);
    $result -> execute();
    /* header('Location: ' . 'usuarios.php', true, 303);
    die(); */
?>
<?php include('templates/footer.html');   ?>
