<?php
include '../conexion.php';

$sql = "SELECT MAX(id_cliente) AS max_id FROM encuesta";
$result = $conexion->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nro_cliente = $row['max_id'] + 1;
} else {
    // Si no hay registros, establecer un valor inicial
    $nro_cliente = 1;
}
// Guardar el número de cliente en una variable de sesión solo si no está definido
if (!isset($_SESSION['nro_cliente'])) {
    $_SESSION['nro_cliente'] = $nro_cliente;
}

?>
