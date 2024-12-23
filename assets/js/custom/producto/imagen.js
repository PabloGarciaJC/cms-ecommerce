
function vistaPreliminarImagenProducto(event) {

  let leerImagenProducto = new FileReader();
  let imagenProducto = document.getElementById('imagenProducto');
  var extensionesArchivo = /(\.jpg|\.jpeg|\.png)$/i;

  leerImagenProducto.onload = () => {
    if (leerImagenProducto.readyState == 2) {
      imagenProducto.src = leerImagenProducto.result;
    }
  }
  leerImagenProducto.readAsDataURL(event.target.files[0]);

  //validacion
  let archivoImagenProducto = document.getElementById('archivoImagenProducto').value;
  var extensionesArchivo = /(\.jpg|\.jpeg|\.png)$/i;

  if (archivoImagenProducto == '') {
    mostrarMensajeError('errorFileProducto', '<strong>Error</strong>, Ingrese Imagen del Producto');
  } else if (!extensionesArchivo.exec(archivoImagenProducto)) {
    mostrarMensajeError('errorFileProducto', '<strong>Error</strong>, Formatos Inválido, Recomendados : JPG, JPEG, PNG');
    return false;
  } else {
    mostrarMensajeError('errorFileProducto', '');
  }

  // Funcion para Mostrar y Borrar los Mensajes:
  function mostrarMensajeError(claseInput, mensaje) {
    let elemento = document.querySelector(`.${claseInput}`);
    elemento.lastElementChild.innerHTML = mensaje;
  }

}