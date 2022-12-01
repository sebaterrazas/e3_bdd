<?php include('templates/header.html');   
session_start();
$username = $_SESSION['username'] 
echo "<h1>$username </h1>";
?>

<?php include('templates/footer.html');   ?>