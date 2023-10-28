<!DOCTYPE html>
<html lang="en">
<head>
    <title>Filtrar Encuesta</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <div class="filtro">
        <h4>Seleccione un rango</h4>
        <form action="datos_encuesta.php" method="get">
            <label for="fecha_inicio">Inicio:</label>
            <input type="date" name="fecha_inicio" required>
            <label for="fecha_fin">Fin:</label>
            <input type="date" name="fecha_fin" required>
            <br>
            <br>
            <label for="hora_inicio">Inicio:</label>
            <input type="time" name="hora_inicio" required>
            <label for="hora_fin">Fin:</label>
            <input type="time" name="hora_fin" required>
            <br>
            <br>
            <br>
            <button type="submit" class="bt-filtro">Filtrar</button>
        </form>
    </div>
    <button onclick="location.href='menu_clientes.html'" class="bt-menu">Menú</button>        
</body>
</html>
