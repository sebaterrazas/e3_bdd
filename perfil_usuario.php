<?php include('templates/header.html');   
session_start();
$username = $_SESSION['username'];
$tipo = $_SESSION['tipo'];
echo "<h1>$tipo </h1>";
echo "<h2>$tipo </h2>";

?>

<?php include('templates/footer.html');   ?>