function vista_preliminar(event) {
  // Visualizo la Imagen Previa
  let leer_img = new FileReader();
  let id_img = document.getElementById("previe");

  leer_img.onload = () => {
    if (leer_img.readyState == 2) {
      id_img.src = leer_img.result;
    }
  };
  leer_img.readAsDataURL(event.target.files[0]);

  //Validacion
  let imagen = document.getElementById("file").value;
  let extensiones = /(\.jpg|\.jpeg|\.png)$/i;

  if (!extensiones.exec(imagen)) {
    mostrarMensajeError(
      "errorFile",
      "<strong>Error</strong>, Solo son Aceptables Formatos: JPG, JPEG, PNG"
    );
    return false;
  } else {
    mostrarMensajeError("errorFile", "");
  }

  // Funcion para Mostrar y Borrar los Mensajes:
  function mostrarMensajeError(claseInput, mensaje) {
    let elemento = document.querySelector(`.${claseInput}`);
    elemento.lastElementChild.innerHTML = mensaje;
  }

  // Ajax Vista Previa
  let datosFormulario = new FormData();

  //Capturo Propiedades File y el Id del Usuario
  let imagenPropiedades = $("#file")[0].files[0];
  let idUsuarioRegistrado = $("#idUsuarioRegistrado").val();

  //Setear el Objeto
  datosFormulario.append("file", imagenPropiedades);
  datosFormulario.append("id", idUsuarioRegistrado);

  $.ajax({
    type: "POST",
    url: baseUrl + "usuario/subirImagen",
    data: datosFormulario,
    contentType: false,
    processData: false,
  }).done(function (response) {
    $("#respuestaPhpAvatarVistaPrevia").html(response);
  });
}
