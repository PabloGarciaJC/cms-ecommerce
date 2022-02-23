$(document).ready(function () {

  let idProductoCarritoCompras = $('#idProductoCarritoCompras').val();
  
  $.ajax({
    type: 'POST',
    url: baseUrl + 'CarritoCompras/mostrar',
    data: 'id=' + idProductoCarritoCompras,
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
});


