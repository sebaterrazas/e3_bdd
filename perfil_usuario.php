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


if ($tipo == 'productora') {
    // Hacer en html lo que se quiere hacer abajo con los divs
    echo "<div align='center' class = 'flex-container'>";
    echo "<h3>Estas en la pagina de productora, estos son tus eventos:</h3>";
    echo "<h4>Eventos en espera de aprobacion:</h4>";
    echo "<h4>Eventos aprobados por los artistas:</h4>";
    echo "<h4>Eventos rechazados:</h4>";
    echo "</div>";

    $query = "SELECT * FROM eventos WHERE upper(nombre_productora) LIKE upper('%$username%');";
    $result = $db2 -> prepare($query);
    $result -> execute();
    $eventos = $result -> fetchAll();

    //Hacer esto mismo de abajo pero en html
    echo "<div align='center' class = 'flex-container'>";
    echo "<h4>Eventos programados:</h4>";
    echo "<table>";
    echo "<tr><th>Nombre</th><th>Fecha</th><th>Recinto</th><th>Artista</th><th>Ciudad</th><th>País</th><th>Fecha</th><th>Productora</th></tr>";
    foreach ($eventos as $e) {
        echo "<tr><td>$e[1]</td> <td>$e[2]</td> <td>$e[3]</td> <td>$e[4]</td> <td>$e[5]</td> <td>$e[6]</td> <td>$e[7]</td> </tr>";
    }
    echo "</table>";
    echo "</div>";
    
} else {
    echo "<p>Estas en la pagina de artista, estos son tus eventos programados:</p>";
    $query = "SELECT * FROM eventos WHERE upper(nombre_artista) LIKE upper('%$username%');";
    $result = $db2 -> prepare($query);
    $result -> execute();
    $eventos = $result -> fetchAll();

    echo "<div align='center' class = 'flex-container'>";
    echo "<h4>Eventos programados:</h4>";
    echo "<table>";
    echo "<tr><th>Nombre</th><th>Fecha</th><th>Recinto</th><th>Artistas</th><th>Tour</th><th>Hospedaje</th><th>Traslado</th><th>Entradas</th></tr>";
    foreach ($eventos as $e) {
        echo "<tr><td>$e[1]</td> <td>$e[2]</td> <td>$e[3]</td> <td>$e[4]</td> <td>$e[5]</td> <td>$e[6]</td> <td>$e[7]</td> </tr>";
    }
    echo "</table>";
    echo "</div>";
}
die();


?>




<?php include('templates/footer.html');   ?>