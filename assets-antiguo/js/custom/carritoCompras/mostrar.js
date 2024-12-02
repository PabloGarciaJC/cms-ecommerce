$(document).ready(function () {
  let idProductoCarritoCompras = $("#idProductoCarritoCompras").val();

  $.ajax({
    type: "POST",
    url: baseUrl + "CarritoCompras/mostrar",
    data: "id=" + idProductoCarritoCompras,
  }).done(function (response) {
    $("#respuestaPhpMostrarCarritoCompras").html(response);
  });
});
