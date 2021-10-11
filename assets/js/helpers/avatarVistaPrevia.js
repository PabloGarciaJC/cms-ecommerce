
function vista_preliminar(event) {

  // Visualizo la Imagen Previa 
  let leer_img = new FileReader();
  let id_img = document.getElementById('previe');
  leer_img.onload = () => {
    if (leer_img.readyState == 2) {
      id_img.src = leer_img.result;
    }
  }
  leer_img.readAsDataURL(event.target.files[0]);

  //Validacion
  var imagen = document.getElementById('file').value;

  var extensiones = /(\.jpg|\.jpeg|\.png)$/i;

  if (!extensiones.exec(imagen)) {
    mostrarMensajeError('errorFile', '<strong>Error</strong>, Solo son Aceptables Formatos: JPG, JPEG, PNG');
    return false;
  }else{
    mostrarMensajeError('errorFile', '');
  } 

  // Funcion para Mostrar y Borrar los Mensajes:
  function mostrarMensajeError(claseInput, mensaje) {
    let elemento = document.querySelector(`.${claseInput}`);
    elemento.lastElementChild.innerHTML = mensaje;
  }

  // Ajax Vista Previa 
  let datosFormulario = new FormData();

  //Capturo
  let imagenPropiedades = $('#file')[0].files[0];
  let idInformacionPublica = $('#idInformacionPublica').val();

  //Setear el Objeto
  datosFormulario.append('file', imagenPropiedades);
  datosFormulario.append('id', idInformacionPublica);

  $.ajax({
    type: 'POST',
    url: baseUrl + 'Usuario/subirImagen',
    data: datosFormulario,
    contentType: false,
    processData: false,
  })
    .done(function (respuestaPhpAvatarVistaPrevia) {
      $("#respuestaPhpAvatarVistaPrevia").html(respuestaPhpAvatarVistaPrevia);

    })
    .fail(function () {
      console.log("error");
    })
    .always(function () {
      console.log("completo");
    });

}

















  // let id = $('#id').val();
  //Capturo el Nombre de la Imagen:
  // let fileTipo = document.getElementById("file").files[0].type;
  // let fileNombre = document.getElementById("file").files[0].name;
  // var archivo = $("#file").prop("files")[0];


  // // Informacion Publica Ajax
  // $.ajax({
  //   type: 'POST',
  //   url: baseUrl + 'Usuario/subirImagen',
  //   data: 'archivo=' + archivo,
  // })
  //   .done(function (respuesta) {
  //     $("#respuesta").html(respuesta);
  //     // if (respuestaPhpInformacionPublica == 1) {
  //     //   Swal.fire({
  //     //     title: 'Completado',
  //     //     icon: 'success'
  //     //   })        
  //     // } 
  //   })
  //   .fail(function () {
  //     console.log("error");
  //   })
  //   .always(function () {
  //     console.log("completo");
  //   });






