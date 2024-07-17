let idBorraCarrito = $("#idProductoCarritoCompras").val();

function eliminarCarritoProducto(idProductoBorrar, nombreProducto) {
  Swal.fire({
    title: "Estas Seguro?",
    text: "Se borrará del Carrito de Compras: " + nombreProducto,
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
    confirmButtonText: "Si, Eliminar!",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "POST",
        url: baseUrl + "CarritoCompras/mostrar",
        data: "id=" + idBorraCarrito + "&idBorrar=" + idProductoBorrar,
      }).done(function (response) {
        $("#respuestaPhpMostrarCarritoCompras").html(response);
        if (response) {
          Swal.fire("Eliminado!", "Su categoria ha sido eliminado.", "success");
        }
      });
    }
  });
}
