<?php include('templates/header.html');   
require ("config/conexion.php");

session_start();
$username = $_SESSION['username'];
$tipo = $_SESSION['tipo'];
echo "<h1>Tu nombre de usuario: $username <br/> Qué tipo de usuario eres: $tipo </h1>";

/* Dependiendo del tipo de usuario que realiz´o el login, se debe desplegar una p´agina distinta.
Productora
Al entrar deber´ıa ver varios listados con los eventos: Uno con los eventos programados,
otro con los eventos en espera de aprobaci´on (o rechazo), otro con los eventos aprobados por
los artistas, y otro con los eventos rechazados. Todos los eventos deben estar ordenados por
su fecha de inicio de forma creciente.
Adicionalmente, el usuario debe poder filtrar los eventos por fecha. Para esto debe haber
dos campos para ingresar las fechas junto con un bot´on que al ser apretado (y estando las
fechas ingresadas), filtra los eventos y muestra solamente los que est´an contenidos en el rango
ingresado.
Por ´ultimo debe haber un formulario (o un link a una vista con un formulario) para que
las productoras puedan crear propuestas de eventos para los artistas. Para eventos con varios
2
artistas, todos deben aprobarlo para que este quede programado. La forma de modelar esto
queda a criterio de cada grupo, pero se debe poder hacer mostrar toda la informaci´on que se
pide. Si un evento no tiene ciertos datos (como por ejemplo un evento propuesto y aprobado
puede no tener hospedaje ni traslados) solamente no se muestra esa informaci´on, pero las
vistas deben funcionar sin errores.
Artista
Estos usuarios deben poder ver los eventos que tienen programados junto con la informaci´on relevante del evento:
Fecha y recinto del evento.
Otros artistas que participan del evento si hay alg´un otro artista.
Tour al cual corresponde el evento si corresponde a alguno.
D´onde se van a quedar durante el evento y el tipo de traslado.
Entradas de cortes´ıa disponibles por categor´ıa.
Adem´as deben poder ver el listado de eventos que crearon las productoras y que necesitan
ser aprobados, y que el artista los pueda aprobar o rechazar. */

$nombre = str_replace("_", " ", $username);
if ($tipo == 'productora') {
    // Hacer en html lo que se quiere hacer abajo con los divs
    $query = "SELECT * FROM eventos WHERE upper(nombre_productora)=upper('$nombre') ORDER BY fecha_evento ;";
    $result = $db2 -> prepare($query);
    $result -> execute();
    $eventos = $result -> fetchAll();
    $_SESSION['producer'] = $eventos[0][7];
    echo "<div align='center' class = 'flex-container'>";
    echo "<h3>Estás en la página de productora, estos son tus eventos programados:</h3>";

    //Hacer esto mismo de abajo pero en html
    echo "<table>";
    echo "<tr><th>Id</th><th>Nombre</th><th>Recinto</th><th>Artista</th><th>Ciudad</th><th>País</th><th>Fecha</th></tr>";
    foreach ($eventos as $e) {
        echo "<tr><td>$e[0]</td> <td>$e[1]</td> <td>$e[2]</td> <td>$e[3]</td> <td>$e[4]</td> <td>$e[5]</td> <td>$e[6]</td> </tr>";
    }
    echo "</table>";


    echo "<h4>Eventos en espera de aprobacion:</h4>";
    //Hacer esto mismo de abajo pero en html
    echo "<table>";
    echo "<tr><th>Id</th><th>Nombre</th><th>Recinto</th><th>Artista</th><th>Ciudad</th><th>País</th><th>Fecha</th></tr>";
    foreach ($eventos as $e) {
        if ($e[8] == "En espera") {
            echo "<tr><td>$e[0]</td> <td>$e[1]</td> <td>$e[2]</td> <td>$e[3]</td> <td>$e[4]</td> <td>$e[5]</td> <td>$e[6]</td> </tr>";
        }
    }
    echo "</table>";

    echo "<h4>Eventos aprobados por los artistas:</h4>";
    echo "<table>";
    echo "<tr><th>Id</th><th>Nombre</th><th>Recinto</th><th>Artista</th><th>Ciudad</th><th>País</th><th>Fecha</th></tr>";
    foreach ($eventos as $e) {
        if ($e[8] == "Aprobado"){
            echo "<tr><td>$e[0]</td> <td>$e[1]</td> <td>$e[2]</td> <td>$e[3]</td> <td>$e[4]</td> <td>$e[5]</td> <td>$e[6]</td> </tr>";
        }
    }
    echo "</table>";


    echo "<h4>Eventos rechazados:</h4>";
    echo "<table>";
    echo "<tr><th>Id</th><th>Nombre</th><th>Recinto</th><th>Artista</th><th>Ciudad</th><th>País</th><th>Fecha</th></tr>";
    foreach ($eventos as $e) {
        if ($e[8] == "Rechazado"){
            echo "<tr><td>$e[0]</td> <td>$e[1]</td> <td>$e[2]</td> <td>$e[3]</td> <td>$e[4]</td> <td>$e[5]</td> <td>$e[6]</td> </tr>";
        }
    }
    echo "</table>";
    // echo "</div>";
    
} else {
    echo "<p>Estás en la página de artista, estos son tus eventos programados:</p>";
    $query = "SELECT * FROM eventos WHERE upper(nombre_artista)=upper('$nombre');";
    $result = $db2 -> prepare($query);
    $result -> execute();
    $eventos = $result -> fetchAll();

    echo "<div align='center' class = 'flex-container'>";
    echo "<h4>Eventos programados:</h4>";
    echo "<table>";
    echo "<tr><th>Nombre</th><th>Fecha</th><th>Recinto</th><th>Ciudad</th><th>País</th><th>Productora</th></tr>";
    foreach ($eventos as $e) {
        echo "<tr><td>$e[1]</td> <td>$e[6]</td> <td>$e[2]</td> <td>$e[4]</td> <td>$e[5]</td> <td>$e[7]</td> </tr>";
    }
    echo "</table>";
    echo "</div>";
    die();
}
?>

    <?php
    #Primero obtenemos todos los tipos de pokemones
    require("config/conexion.php");
    $result = $db2 -> prepare("SELECT DISTINCT nombre_artista FROM artistas;");
    $result -> execute();
    $dataCollected = $result -> fetchAll();
    ?>

    <div class = "flex-item">
        <h1>Crear Evento</h1>
        <form action="crear_evento.php" method="post">
            <input type="text" name="event_name" placeholder="Nombre Evento">
            <input type="text" name="place_name" placeholder="Recinto">
            <input type="text" name="city" placeholder="Ciudad">
            <input type="text" name="country" placeholder="País">
            <input type="date" name="date" placeholder="Fecha">
            <select name="nombre_artista">
            <?php
            foreach ($dataCollected as $d) {
                echo "<option value='$d[0]'>$d[0]</option>";
            }
            ?>
            </select>
            <input type="submit" value="Crear">
        </form>
    </div>
</div>




<?php include('templates/footer.html');   ?>