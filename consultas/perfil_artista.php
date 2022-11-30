<?php include('../templates/header.html');   ?>

<body>

  <?php
    require("../config/conexion.php"); #Llama a conexión, crea el objeto PDO y obtiene la variable $db

    $nombre_artista = $_GET["nombre_artista"];
    $query = "SELECT * FROM artistas WHERE upper(nombre_artista) LIKE upper('%$nombre_artista%');";
    $result = $db -> prepare($query);
    $result -> execute();
    $artistas = $result -> fetchAll(); #Obtiene todos los resultados de la consulta en forma de un arreglo
    $artista = $artistas[0];

    $query = "SELECT entradascortesia.nombre_evento, entradascortesia.asiento_asignado FROM artistas, entradascortesia WHERE artistas.nombre_artista='$artista[1]' AND entradascortesia.nombre_artista='$artista[1]';";
    $result = $db -> prepare($query);
    $result -> execute();
    $entradas_de_cortesia = $result -> fetchAll(); #Obtiene todos los resultados de la consulta en forma de un arreglo
    $num_entradas = count($entradas_de_cortesia);

    $query = "SELECT tours.* FROM tours, eventos WHERE eventos.nombre_artista='$artista[1]' AND tours.nombre_tour=eventos.nombre_evento;";
    $result = $db -> prepare($query);
    $result -> execute();
    $tours = $result -> fetchAll(); #Obtiene todos los resultados de la consulta en forma de un arreglo
    $flipped_tours = array(); #Hacemos que la fecha de término sea el primer elemento de cada tupla
    foreach ($tours as $tour) {
        array_push($flipped_tours, array_reverse($tour));
    }
    if (count($flipped_tours) > 0) {
        $latest_tour = array_reverse(max($flipped_tours)); #El tour más reciente es el que tiene la fecha de término más reciente
    } else {
        $latest_tour = array();
    }
  ?>
    <div id="bio">
        <h1> <?php echo $artista[1]; ?> </h1> <br>
        <b>Fecha de inicio de su carrera:</b> <?php echo $artista[2]; ?> <br>
        <b>N° Teléfono:</b> <?php echo $artista[3]; ?> <br><br>
    </div>

    <div id="entradas_cortesia">
        <h2>Entradas de cortesía (<?php echo $num_entradas;?>)</h2>
        <table>
        <tr>
            <th>Evento</th>
            <th>Asiento</th>
        </tr>
        <?php
        foreach ($entradas_de_cortesia as $e) {
        echo "<tr> <td>$e[0]</td> <td>$e[1]</td> </tr>";
        }
        ?>
        </table>
    </div>

    <div id="tour_reciente">
        <?php
        if ($latest_tour) {
            echo "<h2>Último tour</h2>";
            echo "<b>Nombre:</b> $latest_tour[1]<br>";
            echo "<b>Fecha de inicio:</b> $latest_tour[2]<br>";
            echo "<b>Fecha de término:</b> $latest_tour[3]<br><br>";
        } else {
            echo "<h2>No tiene tours registrados </h2>";
        }
        ?>
    </div>

    <div id="hoteles">
        <h2>Hoteles</h2>
        <table>
        <tr>
            <th>Nombre</th>
            <th>Ubicación</th>
            <th>Veces visitado</th>
        </tr>
        <?php
        $query = "SELECT hotel, lugar, COUNT (hotel) FROM hospedajes_y_traslados WHERE nombre_artista='$artista[1]' GROUP BY hotel, lugar;";
        $result = $db -> prepare($query);
        $result -> execute();
        $hoteles = $result -> fetchAll(); #Obtiene todos los resultados de la consulta en forma de un arreglo
        
        foreach ($hoteles as $h) {
        echo "<tr> <td>$h[0]</td> <td>$h[1]</td> <td>$h[2]</td> </tr>";
        }
        ?>
        </table>

    <div id="productoras">
        <h2>Productoras</h2>
        <table>
        <tr>
            <th>Nombre</th>
            <th>País</th>
            <th>N° contacto</th>

        </tr>
        <?php
        $query = "SELECT productoras.* FROM artistas, productoras, eventos WHERE artistas.nombre_artista='$artista[1]' AND productoras.nombre_productora=eventos.nombre_productora AND artistas.nombre_artista=eventos.nombre_artista AND eventos.pais_recinto=productoras.pais_operante;";
        $result = $db -> prepare($query);
        $result -> execute();
        $productoras = $result -> fetchAll(); #Obtiene todos los resultados de la consulta en forma de un arreglo
        foreach ($productoras as $p) {
        echo "<tr> <td>$p[1]</td> <td>$p[2]</td> <td>$p[3]</td> </tr>";
        }
        ?>
        </table>
    </div>
</body>
<?php include('../templates/footer.html'); ?>