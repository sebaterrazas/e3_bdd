<?php
    require ("config/conexion.php");

    $query = "DROP TABLE usuarios;";
    $result = $db2 -> prepare($query);
    $result -> execute();

    $query = "CREATE TABLE usuarios (id_usuario INT GENERATED ALWAYS AS IDENTITY, nombre_usuario VARCHAR (90) NOT NULL, contraseña VARCHAR (30) NOT NULL, tipo VARCHAR (20) NOT NULL);";
    $result = $db2 -> prepare($query);
    $result -> execute();

    header('Location: ' . 'usuarios.php', true, 303);
    die();
?>
<?php include('templates/footer.html');   ?>
