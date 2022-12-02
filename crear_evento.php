<?php
    require ("config/conexion.php");

    $evento = $_POST['event_name'];
    $recinto = $_POST['place_name'];
    $ciudad = $_POST['city'];
    $pais = $_POST['country'];
    $fecha = $_POST['date'];
    $productor = $_SESSION['producer'];

    echo $evento;
    echo "---";
    echo $recinto;
    echo "---";
    echo $ciudad;
    echo "---";
    echo $pais;
    echo "---";
    echo $fecha;
    echo "---";
    echo $productor;

    $query = "SELECT MAX(id_evento) FROM eventos;";
    $result = $db2 -> prepare($query);
    $result -> execute();
    $id = $result -> fetchAll();
    $id = $id[0][0] + 1;

    $query = "INSERT INTO eventos (id_evento, nombre_evento, nombre_recinto, nombre_artista, ciudad_recinto, pais_recinto, fecha_evento, nombre_productora, estado) VALUES ($id, '$evento'::varchar, '$recinto'::varchar, '$ciudad'::varchar, '$pais'::varchar, '$fecha'::varchar, '$productor'::varchar, 'En espera');";
    $result = $db2 -> prepare($query);
    $result -> execute();
    /* header("Location: perfil_usuario.php");
    die(); */
?>