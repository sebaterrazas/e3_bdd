<?php include('templates/header.html');   ?>

<body>
  <h1 align="center">Biblioteca Musical</h1>
  <p style="text-align:center;">Aquí podrás encontrar información sobre artistas, conciertos, tours, etc.</p>

  <h3 align="center"> ¿Quieres buscar un listado del nombre y teléfono de todos los artista?</h3>

  <form align="center" action="consultas/consulta_artistas.php" method="post">
    <input type="hidden" name="nombre_artista" value="">
    <input type="submit" value="Artistas">
  </form>
  
  <br>
  <br>
  <br>

  <?php
  #Primero obtenemos todos los tipos de pokemones
  require("config/conexion.php");
  $result = $db -> prepare("SELECT DISTINCT nombre_artista FROM artistas;");
  $result -> execute();
  $dataCollected = $result -> fetchAll();
  ?>

  <h3 align="center"> Entradas de cortesía que ha entregado un artista</h3>

  <form align="center" action="consultas/perfil_artista.php" method="get">
    Nombre:
    <input type="text" name="nombre_artista">
    <br/><br/>
    <!-- Seleccinar un artista:
    <select name="nombre_artista">
      <?php
      #Para cada tipo agregamos el tag <option value=value_of_param> visible_value </option>
      foreach ($dataCollected as $d) {
        echo "<option value='$d[0]'>$d[0]</option>";
      }
      ?>
    </select> -->
    <br>
    <input type="submit" value="Buscar">
  </form>
  
  <br>
  <br>
  <br>

  <h3 align="center"> Último tour de un artista</h3>

  <form align="center" action="consultas/perfil_artista.php#tour_reciente" method="get">
    Nombre:
    <input type="text" name="nombre_artista">
    <br/><br/>
    <input type="submit" value="Buscar">
  </form>

  <br>
  <br>
  <br>

  <?php
  #Primero obtenemos todos los tipos de pokemones
  require("config/conexion.php");
  $result = $db -> prepare("SELECT DISTINCT nombre_tour FROM tours;");
  $result -> execute();
  $dataCollected = $result -> fetchAll();
  ?>

  <h3 align="center"> Países que serán visitados en un tour:</h3>

  <form align="center" action="consultas/consulta_paises_tour.php" method="post">
    Nombre tour:
    <select name="nombre_tour">
      <?php
      #Para cada tipo agregamos el tag <option value=value_of_param> visible_value </option>
      foreach ($dataCollected as $d) {
        echo "<option value=\"$d[0]\">$d[0]</option>";
      }
      ?>
    </select>
    <br><br/>
    <input type="submit" value="Buscar">
  </form>

  <br>
  <br>
  <br>

  <h3 align="center"> Lista de productoras que han trabajado con un artista:</h3>

  <form align="center" action="consultas/perfil_artista.php#productoras" method="get">
    Nombre:
    <input type="text" name="nombre_artista">
    <br/><br/>
    <input type="submit" value="Buscar">
  </form>
  
  <br>
  <br>
  <br>

  <h3 align="center"> Lista de hoteles hospedados de un artista:</h3>

  <form align="center" action="consultas/perfil_artista.php#hoteles" method="get">
    Nombre artista:
    <input type="text" name="nombre_artista">
    <br/><br/>
    <input type="submit" value="Buscar">
  </form>
  
  <br>
  <br>
  <br>

  <?php
    #Primero obtenemos todos los tipos de pokemones
    require("config/conexion.php");
    $query =  "SELECT nombre_artista FROM entradascortesia GROUP BY nombre_artista ORDER BY COUNT(nombre_artista) DESC LIMIT 1;";
    $result = $db -> prepare($query);
    $result -> execute();
    $dataCollected = $result -> fetchAll();
    $el_farkas = $dataCollected[0][0];
  ?>
  <h3 align="center"> Artista que ha entregado la mayor cantidad de entradas de cortesía:</h3>
  <?php echo "<a href='consultas/perfil_artista.php?nombre_artista=$el_farkas'>Ver</a>" ?>

</body>
</html>
