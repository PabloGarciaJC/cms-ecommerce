function eliminarDatosProducto(idProducto, nombreProductoBd) {
  console.log(idProducto);
  Swal.fire({
    title: "Estas Seguro ?",
    text: "Se borrará de forma permanente : " + nombreProductoBd,
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
    confirmButtonText: "Si, Eliminar!",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "POST",
        url: baseUrl + "Producto/eliminar",
        data: { id: idProducto },
      }).done(function (response) {
        if (response == 1) {
          Swal.fire(
            "Eliminado!",
            "Su Producto ha sido eliminado.",
            "success"
          ).then(function () {
            window.location = baseUrl + "Producto/listar";
          });
        } else {
          Swal.fire({
            icon: "error",
            title: "¡IMPORTANTE!",
            text:
              "Error, no se pueden Eliminar Los Productos que Tengan Pedidos Pendiente.....",
          });
        }
      });
    }
  });
}
