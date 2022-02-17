
function carritoUp(idProductoUp) {

  $.ajax({
    type: 'POST',
    url: baseUrl + 'CarritoCompras/mostrar',
    data: 'idUp=' + idProductoUp,
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