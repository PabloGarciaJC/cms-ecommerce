
function carritoDown(idProductoDown) {

  $.ajax({
    type: 'POST',
    url: baseUrl + 'CarritoCompras/mostrar',    
    data: '&idDown=' + idProductoDown,

  })
    .done(function (respuestaPhpMostrarCarritoCompras) {
      $("#respuestaPhpMostrarCarritoCompras").html(respuestaPhpMostrarCarritoCompras);
    })
    .fail(function () {
      console.log("error");
    })
    .always(function () {
      console.log("completo");
    });

}