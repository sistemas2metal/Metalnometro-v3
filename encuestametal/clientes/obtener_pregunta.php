<?php
include '../conexion.php';

$id_cuestionario = 2;

$sql = "SELECT id_pregunta_cliente, pregunta_cliente FROM preguntas_clientes WHERE id_cuestionario = $id_cuestionario";
$result = $conexion->query($sql);

$preguntas = array();
while ($row = $result->fetch_assoc()) {
    $preguntas[] = $row;
}

?>
