

let formBuscadorGlobal = document.getElementById('formBuscadorGlobal');

if (formBuscadorGlobal) {
  formBuscadorGlobal.addEventListener('submit', (e) => {

    e.preventDefault(); // Freno Submit o Envío;

    // Capturo id Buscador
    let valorBuscador = $('#buscadorGlobal').val();

    // Repueblo buscador del Envio
    $('#buscadorMostrarProducto').val(valorBuscador);

    // Envio a Mostrar Productos
    ajaxBuscadorGeneral(valorBuscador);

    // Redireciono a Mostrar Productos
    $('html,body').animate({
      scrollTop: $('#solicita-informacion').offset().top
    }, 1500);

  });
}

// Capturo Valores del Buscador a tiempo real y repueblo el otro Buscador
buscadorGlobal.addEventListener('keyup', (event) => {

  valorBuscador = event.path[0].value;

  $('#buscadorMostrarProducto').val(valorBuscador);

});

// Valido de si el Input esta Vacio, haga una consulta
$('#formBuscadorGlobal').on('keyup', function () {

  inputBuscar = $('#buscadorGlobal').val();

  if (inputBuscar.length == 0) {

    valorBuscador = '';

    // Envio a Mostrar Productos
    ajaxBuscadorGeneral(valorBuscador);
  }
})

// Ajax Buscador general
function ajaxBuscadorGeneral(valorBuscador) {

  $.ajax({
    type: 'POST',
    url: baseUrl + 'Producto/mostrarTodos',
    data: { arrayMarca: JSON.stringify(arrayCheckMarca), productoByIdCategoria: productoIdCategoriaMarca, arrayMemoriaRam: JSON.stringify(arrayCheckMemoriaRam), arrayPrecio: JSON.stringify(arrayCheckedPrecio), arrayOfertas: JSON.stringify(arrayCheckedOfertas), buscadorProducto: valorBuscador },
  })
    .done(function (respuestaPhpMostrarProductos) {
      $("#respuestaPhpMostrarProductos").html(respuestaPhpMostrarProductos);
    })
    .fail(function () {
      console.log("error");
    })
    .always(function () {
      console.log("completo");
    });


}


