<?php
$mysqli = new mysqli("localhost", "root", "", "cubicatrix");
if ($mysqli->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
// echo $mysqli->host_info . "\n";
?>