<?php include('templates/header.html');?>

<style>
<?php include 'mystyles.css'; ?>
</style>

<?php
    require ("config/conexion.php");

    $query = "SELECT * FROM usuarios;";
    $result = $db2 -> prepare($query);
    $result -> execute();
    $usuarios = $result -> fetchAll();
?>

<h2 class="white-text" align="center">Usuarios(<?php echo count($usuarios);?>)</h2>
<table align="center">
<tr>
    <th>ID</th>
    <th>Nombre</th>
    <th>Contraseña</th>
    <th>Tipo</th>
</tr>
<?php
foreach ($usuarios as $u) {
echo "<tr> <td>$u[0]</td> <td>$u[1]</td> <td>$u[2]</td> <td>$u[3]</td> </tr>";
}
?>
</table>

<?php include('templates/footer.html');   ?>