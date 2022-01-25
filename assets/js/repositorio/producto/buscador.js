
// Obtengo Valor de Buscador 
let buscadorAdministrativo = document.getElementById('buscadorAdministrativo');

if (buscadorAdministrativo) {

  // Inicia en Vacio
  let valorBuscadorAdministrativo = '';

  // Inicia en Vacio
  let paginaActual = 1;

  // Carga Primero
  AjaxBuscadorListar(paginaActual, valorBuscadorAdministrativo);

  // Obtener Tiempo Real Datos Buscador
  buscadorAdministrativo.addEventListener('keyup', (event) => {
    valorBuscadorAdministrativo = event.path[0].value;
    AjaxBuscadorListar(paginaActual, valorBuscadorAdministrativo);
  });

  // Function  Ajax
  function AjaxBuscadorListar(paginaActual, valorBuscadorAdministrativo) {

    $.ajax({
      type: 'POST',
      url: baseUrl + 'Producto/buscardor',
      data: { paginaActual: paginaActual, buscadorAdmin: valorBuscadorAdministrativo },
    })
      .done(function (respuestaPhpBuscadorAdmin) {
        $("#respuestaPhpBuscadorAdmin").html(respuestaPhpBuscadorAdmin);
      })
      .fail(function () {
        console.log("error");
      })
      .always(function () {
        console.log("completo");
      });

  } // Fin Funcion Ajax

}

