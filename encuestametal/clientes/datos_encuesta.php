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
    $sql = "SELECT id_cliente AS ID_Cliente,
            MAX(CASE WHEN id_pregunta = 2 THEN valoracion END) AS Valoracion_Ventas,
            MAX(CASE WHEN id_pregunta = 3 THEN valoracion END) AS Valoracion_Caja,
            MAX(CASE WHEN id_pregunta = 4 THEN valoracion END) AS Valoracion_Logistica,
            MAX(fecha_hora) AS Fecha_Hora
            FROM encuesta 
            WHERE fecha_hora BETWEEN '$fechaInicio $horaInicio' AND '$fechaFin $horaFin'
            GROUP BY id_cliente";
            
    $result = $conexion->query($sql);
    ?>
    <div class="tabla-filtrada">
        <h4>Datos de la Encuesta</h4>
        <table border="1">
            <tr>
                <th>Ventas</th>
                <th>Caja</th>
                <th>Logistica</th>
                <th>Fecha y Hora</th>
            </tr>
            <?php
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['Valoracion_Ventas'] . "</td>";
                echo "<td>" . $row['Valoracion_Caja'] . "</td>";
                echo "<td>" . $row['Valoracion_Logistica'] . "</td>";
                echo "<td>" . $row['Fecha_Hora'] . "</td>";
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
    <button onclick="location.href='menu_clientes.html'" class="bt-menu">Menú</button>
</body>
</html>
