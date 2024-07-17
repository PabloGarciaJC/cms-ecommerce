let confimarPedido = document.getElementById('confimarPedido');

if (confimarPedido) {

  confimarPedido.addEventListener('submit', (e) => {
    e.preventDefault(); // Freno Submit o Envío;

    let usuarioIdCarrito = $('#usuarioIdCarrito').val();
    let aliasCarrito = $('#aliasCarrito').val();
    let emailCarrito = $('#emailCarrito').val();
    let nombreCarrito = $('#nombreCarrito').val();
    let apellidosCarrito = $('#apellidosCarrito').val();
    let direccionCarrito = $('#direccionCarrito').val();
    let telefonoCarrito = $('#telefonoCarrito').val();
    let paisCarrito = $('#paisCarrito').val();
    let ciudadCarrito = $('#ciudadCarrito').val();
    let CodigoPostalCarrito = $('#CodigoPostalCarrito').val();
    let totalPagarCarrito = $('#totalPagarCarrito').val();
    let stockTotalesCarrito = $('#stockTotalesCarrito').val();

    // Ajax Confimar Pedido
    $.ajax({
      type: 'POST',
      url: baseUrl + 'Pedidos/guardar',
      data: 'usuarioId=' + usuarioIdCarrito + '&alias=' + aliasCarrito + '&email=' + emailCarrito + '&nombre=' + nombreCarrito + '&apellidos=' + apellidosCarrito + '&direccion=' + direccionCarrito + '&telefono=' + telefonoCarrito + '&pais=' + paisCarrito + '&ciudad=' + ciudadCarrito + '&CodigoPostal=' + CodigoPostalCarrito + '&totalPagar=' + totalPagarCarrito + '&stockTotales=' + stockTotalesCarrito,
    })
      .done(function (response) {
        $("#respuestaPhpConfimarPedido").html(response);
        if (response == 1) {
          Swal.fire({
            title: 'Completado',
            icon: 'success'
          }).then(function () {
            window.location = baseUrl + "Pedidos/listar";
          });
        }
      })
  });
}