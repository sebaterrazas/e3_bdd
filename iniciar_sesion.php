<?php
    require ("config/conexion.php");

    $username = $_POST['username'];
    $password = $_POST['password'];
    $tipo = $_POST['tipo'];

    $query = "SELECT * FROM usuarios WHERE nombre_usuario='$username' AND contraseña='$password';";
    $result = $db2 -> prepare($query);
    $result -> execute();
    $usuarios = $result -> fetchAll();

    if (count($usuarios)) {
        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['tipo'] = $tipo;

        header("Location: perfil_usuario.php?". SID);
    } else {
        header("Location: index.php");
    }
    die();
?>