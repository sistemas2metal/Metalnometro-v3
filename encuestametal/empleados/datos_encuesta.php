<!DOCTYPE html>
<html lang="en">
<head>
    <title>Informes</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
<?php
    require '../conexion.php';

    // Obtener valores de filtro
    $fechaInicio = $_GET['fecha_inicio'];
    $fechaFin = $_GET['fecha_fin'];
    $horaInicio = $_GET['hora_inicio'];
    $horaFin = $_GET['hora_fin'];

    // Construir consulta SQL con filtros
    $sql = "SELECT valoracion, fecha_hora FROM encuesta_empleados WHERE fecha_hora BETWEEN '$fechaInicio $horaInicio' AND '$fechaFin $horaFin'";
    $result = $conexion->query($sql);
    ?>
    <div class="tabla-filtrada">
        <h4>Datos de la Encuesta</h4>
        <table border="1">
            <tr>
                <th>Valoración</th>
                <th>Fecha y Hora</th>
            </tr>
            <?php
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['valoracion'] . "</td>";
                echo "<td>" . $row['fecha_hora'] . "</td>";
                echo "</tr>";
            }
?>
        </table>    
    </div>
    <!-- Botón para exportar a Excel -->
    <form action="exportar_excel.php" method="post">
        <input type="hidden" name="fecha_inicio" value="<?php echo $fechaInicio; ?>">
        <input type="hidden" name="fecha_fin" value="<?php echo $fechaFin; ?>">
        <input type="hidden" name="hora_inicio" value="<?php echo $horaInicio; ?>">
        <input type="hidden" name="hora_fin" value="<?php echo $horaFin; ?>">
        <br>
        <button type="submit" name="exportar_excel" class="bt-exportar">Exportar a Excel</button>
    </form>
    <button onclick="location.href='menu_empleados.html'" class="bt-menu">Menú</button>
</body>
</html>
