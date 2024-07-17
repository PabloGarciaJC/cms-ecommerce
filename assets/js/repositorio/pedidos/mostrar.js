$(document).ready(function () {
  $.ajax({
    type: 'POST',
    url: baseUrl + 'Pedidos/mostrar',
  })
    .done(function (response) {
      $("#respuestaPhpMostrarPedidos").html(response);
    })
});