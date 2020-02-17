<?php
$mysqli = new mysqli("127.0.0.1", "rene", "rene", "registro");

if ($mysqli->connect_errno) {
    printf("Falló la conexión: %s\n", $mysqli->connect_error);
    exit();
}   
?>
