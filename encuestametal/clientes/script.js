document.addEventListener('DOMContentLoaded', function() {
  const botonesRespuesta = document.querySelectorAll('.contenedor button');

  // Objeto para almacenar las respuestas más recientes
  const respuestasUltimas = {};

  // Inicializar el objeto con valores por defecto
  const preguntas = document.querySelectorAll('.contenedor button');
  preguntas.forEach(function(pregunta) {
      const idPregunta = pregunta.dataset.preguntaId;
      respuestasUltimas[idPregunta] = 'No Respondido'; // Valor por defecto
  });

  botonesRespuesta.forEach(function(boton) {
      boton.addEventListener('click', function() {
          const respuesta = this.value;
          const idPregunta = this.dataset.preguntaId;

          console.log(`Pregunta ID: ${idPregunta}, Respuesta: ${respuesta}`);

          // Actualizar la respuesta más reciente para esta pregunta
          respuestasUltimas[idPregunta] = respuesta;

          // Habilitar todos los botones en el contenedor actual
          this.parentNode.querySelectorAll('button').forEach(function(b) {
              b.disabled = false;
              b.classList.remove('seleccionado');
          });

          // Deshabilitar el botón seleccionado
          this.disabled = true;
          this.classList.add('seleccionado');

          // Verificar si al menos una pregunta ha sido respondida
          const respondidaAlgunaPregunta = Object.values(respuestasUltimas).some(respuesta => respuesta !== 'No Respondido');

          // Habilitar o deshabilitar el botón "Calificar" según corresponda
          botonCalificar.disabled = !respondidaAlgunaPregunta;
      });
  });

  // Evento para procesar respuestas al hacer clic en "CALIFICAR"
  const botonCalificar = document.querySelector('.bt-calificar');
  botonCalificar.disabled = true; // Deshabilitar el botón al inicio

  botonCalificar.addEventListener('click', function() {
      // Verificar si al menos una pregunta ha sido respondida
      const respondidaAlgunaPregunta = Object.values(respuestasUltimas).some(respuesta => respuesta !== 'No Respondido');

      if (respondidaAlgunaPregunta) {
          const xhr = new XMLHttpRequest();
          const url = 'guardar_encuesta.php';
          const respuestasJSON = JSON.stringify(respuestasUltimas);

          xhr.open('POST', url, true);
          xhr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');

          xhr.onload = function() {
              if (xhr.status >= 200 && xhr.status < 400) {
                  console.log(xhr.responseText);
              } else {
                  console.error('Error al procesar respuestas');
              }
          };

          xhr.onerror = function() {
              console.error('Error de red');
          };

          xhr.send(respuestasJSON);
      } else {
          // Mostrar mensaje de error temporal
          const mensajeError = document.createElement('div');
          mensajeError.textContent = 'Debes responder al menos una pregunta para calificar.';
          document.body.appendChild(mensajeError);

          setTimeout(function() {
              mensajeError.remove();
          }, 3000);
      }
  });
});
