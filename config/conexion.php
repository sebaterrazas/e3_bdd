<?php
  try {
    $user = 'grupo66';
    $password = 'bdd66passwd';
    $databaseName = 'grupo66e3';
    $db1 = new PDO("pgsql:dbname=$databaseName;host=localhost;port=5432;user=$user;password=$password");
    $user2 = 'grupo77';
    $password2 = 'grupoXX';
    $databaseName2 = 'grupo77e3';
    $db2 = new PDO("pgsql:dbname=$databaseName2;host=localhost;port=5432;user=$user2;password=$password2");
  } catch (Exception $e) {
    echo "No se pudo conectar a la base de datos: $e";
  }
?>