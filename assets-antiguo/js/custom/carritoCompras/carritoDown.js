function carritoDown(idProductoDown) {
  $.ajax({
    type: "POST",
    url: baseUrl + "CarritoCompras/mostrar",
    data: "&idDown=" + idProductoDown,
  }).done(function (response) {
    $("#respuestaPhpMostrarCarritoCompras").html(response);
  });
}
