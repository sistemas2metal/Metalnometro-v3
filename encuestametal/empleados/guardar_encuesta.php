<?php
  require '../conexion.php';
  // Verificar si se envió el formulario
  if ($_SERVER["REQUEST_METHOD"] === "POST") {
      if (isset($_POST['satisfaccion'])) {
        $valorSatisfaccion = $_POST['satisfaccion'];

      // Consulta SQL
      $sql = "INSERT INTO encuesta_empleados (valoracion, fecha_hora) VALUES ('$valorSatisfaccion', NOW())";

      if ($conexion->query($sql) === TRUE) {
        header("Location: fin.html");
      } else {
        echo "Error al guardar la valoración: " . $conn->error;
      }

      $conexion->close();
    } else {
      echo "Error: No se recibió ninguna opción de satisfacción.";
    }
  }
?>