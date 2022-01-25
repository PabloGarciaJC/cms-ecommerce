
let informacionPublica = document.getElementById('informacionPublica');

if (informacionPublica) {

  informacionPublica.addEventListener('submit', (e) => {
    e.preventDefault(); // Freno Submit o Envío;

    let id = $('#id').val();
    let usuario = $('#usuario').val();
    let documentacion = $('#documentacion').val();
    let telefono = $('#telefono').val();

    // Validacion
    if (usuario == null || usuario == '') {
      mostrarMensajeError('errorUsuario', 'Ingrese Alias');
    } else {
      mostrarMensajeError('errorUsuario', '');
    }

    if (documentacion == null || documentacion == '') {
      mostrarMensajeError('errorDocumentacion', 'Ingrese Documentacíon');
    } else {
      mostrarMensajeError('errorDocumentacion', '');
    }

    if (telefono == null || telefono == '') {
      mostrarMensajeError('errorTelefono', 'Ingrese Teléfono');
    } else {
      mostrarMensajeError('errorTelefono', '');
    }

    // Funcion para Mostrar y Borrar los Mensajes:
    function mostrarMensajeError(claseInput, mensaje) {
      let elemento = document.querySelector(`.${claseInput}`);
      elemento.lastElementChild.innerHTML = mensaje;
    }

    // Informacion Publica Ajax
    $.ajax({
      type: 'POST',
      url: baseUrl + 'Usuario/informacionPublica',
      data: 'id=' + id + '&usuario=' + usuario + '&documentacion=' + documentacion + '&telefono=' + telefono,
    })
      .done(function (respuestaPhpInformacionPublica) {
        $("#respuestaPhpInformacionPublica").html(respuestaPhpInformacionPublica);
        if (respuestaPhpInformacionPublica == 1) {
          Swal.fire({
            title: 'Completado',
            icon: 'success'
          })
        }
      })
      .fail(function () {
        console.log("error");
      })
      .always(function () {
        console.log("completo");
      });
  });


}