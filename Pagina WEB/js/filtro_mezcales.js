$(document).ready(function() {
    // Asegúrate de que se ejecuta al hacer clic
    $('#botones-productos button').click(function() {
      var tipo = $(this).attr('dato-tipo');  // Correcto uso del atributo
      console.log("Tipo seleccionado: " + tipo); // Esto mostrará en consola el tipo al hacer clic
  
      $.ajax({
        url: 'productos.php',  // Asegúrate de que esta ruta es correcta
        type: 'GET',
        data: {tipo: tipo},
        success: function(response) {
          $('.contenedor-productos').html(response);
          console.log("Datos recibidos: " + response); // Esto ayudará a ver lo que se devuelve
        },
        error: function() {
          console.log("Error en la petición AJAX"); // Esto indicará si hay un error en la petición
        }
      });
    });
  });
  