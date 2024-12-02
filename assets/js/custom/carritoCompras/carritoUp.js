function carritoUp(idProductoUp) {
  $.ajax({
    type: "POST",
    url: baseUrl + "CarritoCompras/mostrar",
    data: "idUp=" + idProductoUp,
  }).done(function (response) {
    $("#respuestaPhpMostrarCarritoCompras").html(response);
  });
}
