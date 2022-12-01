<?php include('templates/header.html');   
session_start();
?>

<h1><?php $_SESSION['username'] ?></h1>

<?php include('templates/footer.html');   ?>