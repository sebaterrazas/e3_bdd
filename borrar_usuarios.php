<?php
    require ("config/conexion.php");

    $query = "DROP TABLE usuarios;";
    $result = $db2 -> prepare($query);
    $result -> execute();
    header('Location: ' . 'usuarios.php', true, 303);
    die();
?>
<?php include('templates/footer.html');   ?>
