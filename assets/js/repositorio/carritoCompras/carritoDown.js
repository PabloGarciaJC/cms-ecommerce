
let idDownCarrito = $('#idProductoCarritoCompras').val();

function carritoDown(idProductoDown) {

  $.ajax({
    type: 'POST',
    url: baseUrl + 'CarritoCompras/mostrar',
    data: 'id=' + idDownCarrito + '&idDown=' + idProductoDown,

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