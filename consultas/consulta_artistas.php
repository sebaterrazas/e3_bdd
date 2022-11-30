<?php include('../templates/header.html');   ?>

<body>

  <?php
  require("../config/conexion.php"); #Llama a conexión, crea el objeto PDO y obtiene la variable $db

  $query = "SELECT * FROM artistas;";
  $nombre_artista = $_POST["nombre_artista"];
  if ($nombre_artista!=""){ #Si el usuario ingresó un nombre, se agrega la cláusula WHERE a la consulta
    $query = "SELECT * FROM artistas WHERE upper(nombre_artista) LIKE upper('%$nombre_artista%');";
  }

  $result = $db -> prepare($query);
  $result -> execute();
  $dataCollected = $result -> fetchAll(); #Obtiene todos los resultados de la consulta en forma de un arreglo
  ?>

  <form align="center" action="consulta_artistas.php" method="post">
    Nombre:
    <?php
    echo "<input type='text' name='nombre_artista' value='$nombre_artista'>"
    ?>
    <br/><br/>
    <input type="submit" value="Buscar">
  </form>

  <table>
    <tr>
      <th>Nombre</th>
      <th>N° Teléfono</th>
    </tr>
  <?php
  foreach ($dataCollected as $p) {
    echo "<tr> <td><a href='perfil_artista.php?nombre_artista=$p[1]'>$p[1]</a></td> <td>$p[3]</td> </tr>";
  }
  ?>
  </table>
</body>

<?php include('../templates/footer.html'); ?>