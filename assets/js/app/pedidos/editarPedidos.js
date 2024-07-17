function editarPedidos(idPedidos) {
  // Repueblo los Valores del Modal
  $("#idPedidos").val(idPedidos);

  let gestionarPedido = document.getElementById("gestionarPedido");

  // Valido Id Formulario
  if (gestionarPedido) {
    gestionarPedido.addEventListener("submit", (e) => {
      e.preventDefault(); // Freno Submit o Envío;

      // Valor por Defecto de Selected
      estadoPedido = document.getElementById("estadoPedido").value;
      ajax(idPedidos, estadoPedido);

      // Capturo el Valor del Select
      $("select#estadoPedido").on("change", function () {
        let estadoPedido = $(this).val();
        ajax(idPedidos, estadoPedido);
      });
    });
  }
}

// Ajax Pedido
function ajax(idPedidos, estadoPedido) {
  $.ajax({
    type: "POST",
    url: baseUrl + "Pedidos/editar",
    data: "idPedido=" + idPedidos + "&estadoPedido=" + estadoPedido,
    // data: 'estadoPedido=' + estadoPedido,
  }).done(function (response) {
    $("#respuestaPhpEditarPedidos").html(response);
    if (response == 1) {
      Swal.fire({
        title: "Completado",
        icon: "success",
      }).then(function () {
        window.location = baseUrl + "Pedidos/listar";
      });
    }
  });
}