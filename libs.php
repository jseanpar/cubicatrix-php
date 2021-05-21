<?php 
session_start();
$logged = $_SESSION['loggedin'];
$name = $_SESSION['name'];
$rut = $_SESSION['rut'];

if(!$logged){
    header("Location: index.php");
}
?>