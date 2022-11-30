<?php include('../templates/header.html');   ?>

<body>

  <?php
    require("../config/conexion.php"); #Llama a conexión, crea el objeto PDO y obtiene la variable $db

    $nombre_tour = $_POST["nombre_tour"];
    $query = "SELECT fecha_evento, ciudad_recinto, pais_recinto, nombre_evento, nombre_artista FROM tours, eventos WHERE nombre_tour='$nombre_tour' AND nombre_tour=nombre_evento ORDER BY fecha_evento ASC;";

    $result = $db -> prepare($query);
    $result -> execute();
    $eventos = $result -> fetchAll(); #Obtiene todos los resultados de la consulta en forma de un arreglo
  ?>
  <h1> <?php echo $eventos[0][3]; ?> </h1> <br>
  <b>Artista:</b> <?php echo $eventos[0][4]; ?> <br><br>
  <table>
    <tr>
      <th>Fecha</th>
      <th>Ciudad</th>
      <th>País</th>
    </tr>
  <?php
  foreach ($eventos as $e) {
    echo "<tr> <td>$e[0]</td> <td>$e[1]</td> <td>$e[2]</td></tr>";
  }
  ?>
  </table>
</body>

<?php include('../templates/footer.html'); ?>