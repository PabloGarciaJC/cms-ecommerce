
function eliminarDatoss(idCategoriaBd, nombreCategoriaBd) {
  Swal.fire({
    title: 'Estas Seguro?' ,
    text: 'Se borrará de forma permanente : ' + nombreCategoriaBd,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#d33',    
    cancelButtonColor: '#3085d6',
    confirmButtonText: 'Si, Eliminar!'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: 'POST',
        url: baseUrl + 'Categoria/eliminar',
        data: { id: idCategoriaBd },
      })
        .done(function (response) {
          if (response == 1) {
            Swal.fire(
              'Eliminado!',
              'Su categoria ha sido eliminado.',              
              'success'
            ).then(function () {
              window.location = baseUrl + "Categoria/gestionarCategorias";
            });
          }else{
            Swal.fire({
              icon: 'error',
              title: '¡IMPORTANTE!',
              text: 'Error, no se pueden Eliminar Categorias que tengan productos Incluidos.....',           
            })
          }
        })
    }
  })
}
 
