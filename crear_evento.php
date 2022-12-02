<?php
    require ("config/conexion.php");
    session_start();

    $evento = $_POST['event_name'];
    $recinto = $_POST['place_name'];
    $artista = $_POST['nombre_artista'];
    $ciudad = $_POST['city'];
    $pais = $_POST['country'];
    $fecha = $_POST['date'];
    $productor = $_SESSION['producer'];

    $query = "SELECT MAX(id_evento) FROM eventos;";
    $result = $db2 -> prepare($query);
    $result -> execute();
    $id = $result -> fetchAll();
    $id = $id[0][0] + 1;

    $query = "INSERT INTO eventos VALUES ($id::int, '$evento'::varchar, '$recinto'::varchar, '$artista'::varchar, '$ciudad'::varchar, '$pais'::varchar, $fecha, '$productor'::varchar, 'En espera');";
    $result = $db2 -> prepare($query);
    $result -> execute();
    header("Location: perfil_usuario.php");
    die();
?>