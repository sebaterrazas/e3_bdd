<?php
    require ("config/conexion.php");

    $query = "SELECT * FROM usuarios;";
    $result = $db2 -> prepare($query);
    $result -> execute();
    $usuarios = $result -> fetchAll();
?>

<h2>Usuarios(<?php echo count($usuarios);?>)</h2>
<table>
<tr>
    <th>Nombre</th>
    <th>Contraseña</th>
    <th>Tipo</th>
</tr>
<?php
foreach ($usuarios as $u) {
echo "<tr> <td>$u[0]</td> <td>$u[1]</td> <td>$u[2]</td> </tr>";
}
?>
</table>

<?php include('templates/footer.html');   ?>