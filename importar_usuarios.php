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

        /* $query = "SELECT importar_productora('$username'::varchar, '$password'::varchar);";
        $result = $db2 -> prepare($query);
        $result -> execute();
        $result -> fetchAll(); */

        $query = "SELECT * FROM usuarios WHERE nombre_usuario = '$username';";
        $result = $db2 -> prepare($query);
        $result -> execute();
        $usuarios = $result -> fetchAll();

        if (count($usuarios)) {
            continue;
        }

        $query = "INSERT INTO usuarios (nombre_usuario, contraseña, tipo) VALUES ('$username'::varchar, '$password'::varchar, 'productora');";
        $result = $db2 -> prepare($query);
        $result -> execute();
    }

    foreach ($artistas as $a) {
        $password = randomPassword();
        $username = strtolower(str_replace(" ", "_", $a[1]));

        /* $query = "SELECT importar_artista('$username'::varchar, '$password'::varchar);";
        $result = $db2 -> prepare($query);
        $result -> execute();
        $result -> fetchAll(); */

        /* $query = "IF $username NOT IN (SELECT nombre_usuario FROM usuarios) THEN INSERT INTO usuarios (nombre_usuario, contraseña, tipo) VALUES ('$username'::varchar, '$password'::varchar, 'artista');"; */

        $query = "SELECT * FROM usuarios WHERE nombre_usuario='$username';";
        $result = $db2 -> prepare($query);
        $result -> execute();
        $usuarios = $result -> fetchAll();

        if (count($usuarios)) {
            continue;
        }

        $query = "INSERT INTO usuarios (nombre_usuario, contraseña, tipo) VALUES ('$username'::varchar, '$password'::varchar, 'artista');";
        $result = $db2 -> prepare($query);
        $result -> execute();
    }
    header('Location: ' . 'usuarios.php', true, 303);
    die();
?>
<?php include('templates/footer.html');   ?>
