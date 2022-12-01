<?php include('templates/header.html');   ?>
<style>
<?php include 'mystyles.css'; ?>
</style>

<div class = "flex-container">
    <div class = "flex-item">
        <h1>Importar Usuarios</h1>
        <form action="importar_usuarios.php" method="post">
            <input type="submit" value="Importar Usuarios">
        </form>
    </div>

    <div class = "flex-item">
        <h1>Iniciar Sesion</h1>
        <form action="iniciar_sesion.php" method="post">
            <input type="text" name="username" placeholder="Username">
            <input type="password" name="password" placeholder="Password">
            <br>
            <input type="submit" value="Iniciar Sesion">
        </form>
    </div>

    <div class = "flex-item">
        <h1>Iniciar Sesion</h1>
        <form action="iniciar_sesion.php" method="post">
            <input type="text" name="username" placeholder="Username">
            <input type="password" name="password" placeholder="Password">
            <br>
            <input type="submit" value="Iniciar Sesion">
        </form>
    </div>
</div>

<?php echo "<a href='usuarioss.php'>Ver todos los usuarios</a>" ?>


