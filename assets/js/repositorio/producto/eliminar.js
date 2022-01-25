
function eliminarDatosProducto(idProducto, nombreProductoBd) {

  Swal.fire({
    title: 'Estas Seguro ?' ,
    text: 'Se borrará de forma permanente : ' + nombreProductoBd,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#d33',    
    cancelButtonColor: '#3085d6',
    confirmButtonText: 'Si, Eliminar!'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: 'POST',
        url: baseUrl + 'Producto/eliminar',
        data: { id: idProducto },
      })
        .done(function (respuestaPhpEliminarProducto) {
          // $("#respuestaPhpEliminarProducto").html(respuestaPhpEliminarProducto);
          if (respuestaPhpEliminarProducto == 1) {
            Swal.fire(
              'Eliminado!',
              'Su Producto ha sido eliminado.',              
              'success'
            ).then(function () {
              window.location = baseUrl + "Producto/listar";
            });
          }
        })
        .fail(function () {
          console.log("error");
        })
        .always(function () {
          console.log("completo");
        });
    }
  })
}
 