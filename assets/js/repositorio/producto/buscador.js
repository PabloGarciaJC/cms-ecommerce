
// Obtengo Valor de Buscador 
let buscadorProductos = document.getElementById('buscadorProductos');

if (buscadorProductos) {

  // Inicia en Vacio
  let valorBuscadorProductos = '';

  // Inicia en Vacio
  let paginaActualBuscadorProductos = 1;

  // Carga Primero
  ajaxBuscadorProductos(paginaActualBuscadorProductos, valorBuscadorProductos);

  // Obtener Tiempo Real Datos Buscador
  buscadorProductos.addEventListener('keyup', (event) => {
    valorBuscadorProductos = event.path[0].value;
    ajaxBuscadorProductos(paginaActualBuscadorProductos, valorBuscadorProductos);
  });

  // Function  Ajax
  function ajaxBuscadorProductos(paginaActualBuscadorProductos, valorBuscadorProductos) {

    $.ajax({
      type: 'POST',
      url: baseUrl + 'Producto/buscador',
      data: { paginaActualBuscadorProductos: paginaActualBuscadorProductos, buscadorProductos: valorBuscadorProductos },
    })
      .done(function (respuestaPhpBuscadorProductos) {
        $("#respuestaPhpBuscadorProductos").html(respuestaPhpBuscadorProductos);
      })
      .fail(function () {
        console.log("error");
      })
      .always(function () {
        console.log("completo");
      });

  } // Fin Funcion Ajax

}

