$(document).ready(function () {
  $.ajax({
    type: 'POST',
    url: baseUrl + 'Pedidos/mostrar',
    // data: 'listarCategoria=' + listarCategoria + '&listarSubcategoria=' + listarSubcategoria,
  })
    .done(function (respuestaPhpMostrarPedidos) {
      $("#respuestaPhpMostrarPedidos").html(respuestaPhpMostrarPedidos);
    })
    .fail(function () {
      console.log("error");
    })
    .always(function () {
      console.log("completo");
    });
});