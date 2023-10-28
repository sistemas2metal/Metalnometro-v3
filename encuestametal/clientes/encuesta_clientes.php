<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Encuesta de Satisfacción</title>
  <link rel="stylesheet" href="styles2.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+HK:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>

<header class="cabecera">
  <div class="logo-cabecera">
    <img src="../assets/logo-metalnor.png" alt="METALNOMETRO Logo">
    <h1>METALNOMETRO</h1>
  </div>
  <img src="../assets/termometro.png" alt="termometro" class="termometro">
</header>

<?php
  include 'obtener_pregunta.php';
  include 'obtener_idcliente.php';
  include '../conexion.php';
?>

<script src="script.js"></script>

<?php
  // Verificar si hay preguntas
  if (count($preguntas) > 0) {
        echo '<form action="guardar_encuesta.php" method="POST">';
        foreach ($preguntas as $pregunta) {
            $id_pregunta_cliente = $pregunta['id_pregunta_cliente'];
            echo "<input type='hidden' name='pregunta_id' value='$id_pregunta_cliente'>";
            echo "<div class='pregunta'>";
            echo "<h4>{$pregunta['pregunta_cliente']}</h4>";
            echo '<div class="contenedor">';
            echo '<button type="button" name="respuesta" value="Muy Satisfecho" class="muy-satisfecho" data-pregunta-id="' . $id_pregunta_cliente . '"><img src="../assets/sonrisa3.png" alt="Muy Satisfecho"></button>';
            echo '<button type="button" name="respuesta" value="Satisfecho" class="satisfecho" data-pregunta-id="' . $id_pregunta_cliente . '"><img src="../assets/feliz2.png"alt="Satisfecho"></button>';
            echo '<button type="button" name="respuesta" value="Insatisfecho" class="insatisfecho" data-pregunta-id="' . $id_pregunta_cliente . '"><img src="../assets/enojado2.png" alt="Insatisfecho"></button>';
            echo '</div>';
            echo '</div>';
        }
        // Botón de enviar al final
        echo '<div class="postear">';
        echo '<button type="button" name="enviar" class="bt-calificar" onclick="window.location.href=\'fin.html\'">CALIFICAR</button>';
        echo '</div>';
        echo '</form>';
  } else {
      echo "No se encontraron preguntas.";
  }
?>

<div class="boton-redireccion">
  <button onclick="location.href='../clientes/menu_clientes.html'" class="bt-oculto"></button>
</div>

</body>
</html>
