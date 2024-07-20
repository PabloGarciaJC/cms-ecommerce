let infromacionPrivada = document.getElementById('informacionPrivada');

if (infromacionPrivada) {

  infromacionPrivada.addEventListener('submit', (e) => {
    e.preventDefault(); // Freno Submit o Envío;

    let id = $('#id').val();
    let nombre = $('#nombre').val();
    let apellido = $('#apellido').val();
    let email = $('#email').val();
    let direccion = $('#direccion').val();
    let ciudad = $('#ciudad').val();
    let codigoPostal = $('#codigoPostal').val();

    // Validacion
    if (nombre == null || nombre == '') {
      mostrarMensajeError('errorNombre', 'Ingrese Nombre');
    } else {
      mostrarMensajeError('errorNombre', '');
    }

    if (apellido == null || apellido == '') {
      mostrarMensajeError('errorApellido', 'Ingrese Apellidos');
    } else {
      mostrarMensajeError('errorApellido', '');
    }

    if (email == null || email == '') {
      mostrarMensajeError('errorEmail', 'Ingrese Email');
    } else {
      mostrarMensajeError('errorEmail', '');
    }

    if (direccion == null || direccion == '') {
      mostrarMensajeError('errorDireccion', 'Ingrese Dirección');
    } else {
      mostrarMensajeError('errorDireccion', '');
    }

    if (codigoPostal == null || codigoPostal == '') {
      mostrarMensajeError('errorCodigoPostal', 'Ingrese Codigo Postal');
    } else {
      mostrarMensajeError('errorCodigoPostal', '');
    }

    // Funcion para Mostrar y Borrar los Mensajes:
    function mostrarMensajeError(claseInput, mensaje) {
      let elemento = document.querySelector(`.${claseInput}`);
      elemento.lastElementChild.innerHTML = mensaje;
    }

    //Para obtener el texto del Select
    let paises = document.getElementById("pais");
    let pais = paises.options[paises.selectedIndex].text;

    //Informacion Privada Ajax
    $.ajax({
      type: 'POST',
      url: baseUrl + 'Usuario/informacionPrivada',
      data: 'id=' + id + '&nombre=' + nombre + '&apellido=' + apellido + '&email=' + email + '&direccion=' + direccion + '&pais=' + pais + '&ciudad=' + ciudad + '&codigoPostal=' + codigoPostal,
    })
      .done(function (response) {
        $("#respuestaPhpInformacionPrivada").html(response);
        if (response == 1) {
          Swal.fire({
            title: "Completado",
            icon: "success",
            timer: 500,
            showConfirmButton: false
          })
        }
      })
  });
}