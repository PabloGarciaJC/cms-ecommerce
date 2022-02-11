
let idUpCarrito = $('#idProductoCarritoCompras').val();

function carritoUp(idProductoUp) {

  $.ajax({
    type: 'POST',
    url: baseUrl + 'CarritoCompras/mostrar',
    data: 'id=' + idUpCarrito + '&idUp=' + idProductoUp,

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