<?php
include '../conexion.php';
include 'obtener_idcliente.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $json = file_get_contents('php://input');
    $respuestasUltimas = json_decode($json, true);

    // Verificar si hay respuestas en el objeto respuestasUltimas
    if (!empty($respuestasUltimas)) {
        foreach ($respuestasUltimas as $id_pregunta => $valoracion) {
            // Obtener la fecha y hora actual
            $fecha_hora = date('Y-m-d H:i:s');
            
            // Obtener el ID del cliente
            $id_cliente = $_SESSION['nro_cliente'];

            // Insertar el nuevo registro en la tabla encuesta
            $sql = "INSERT INTO encuesta (valoracion, fecha_hora, id_pregunta, id_cliente) VALUES ('$valoracion', '$fecha_hora', $id_pregunta, $id_cliente)";

            if ($conexion->query($sql) === TRUE) {
                echo "Registro insertado correctamente.";
            } else {
                echo "Error al insertar el registro: " . $conexion->error;
            }
        }
    } else {
        header("Location: fin.html");
    }

    $conexion->close();
} else {
    echo "Error: Acceso no permitido.";
}
?>