<?php
$servername = "localhost";
$username = "adminhierros";
$password = "hierrosr26km2";
$dbname = "encuestametal";

$conexion = new mysqli($servername, $username, $password, $dbname);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>
