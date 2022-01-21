$(document).ready(function () {

  let formularioProducto = document.getElementById('formularioProducto');

  formularioProducto.addEventListener('submit', (e) => {
    e.preventDefault(); // Freno Submit o Envío;

    // Valores Capturados
    let nombreProducto = $('#nombreProducto').val();
    let idProducto = $('#idProducto').val();
    let categoria = document.getElementById('categoria').value;
    let precioProducto = $('#precioProducto').val();
    let stockProducto = $('#stockProducto').val();
    let ofertaProducto = document.getElementById('ofertaProducto').value;
    let marcaProducto = $('#marcaProducto').val();
    let memoriaRamProducto = $('#memoriaRamProducto').val();
    let descripcionProducto = $('#descripcionProducto').val();
    let guardarImagenProducto = document.getElementById('archivoImagenProducto').value;
    let extensionesArchivo = /(\.jpg|\.jpeg|\.png)$/i;

    // Instacio
    let datosFormularioProducto = new FormData();

    // Capturo Propiedades File
    let imagenPropiedadesProducto = $('#archivoImagenProducto')[0].files[0];

    // Setear el Objeto
    datosFormularioProducto.append('nombreProducto', nombreProducto);
    datosFormularioProducto.append('idProducto', idProducto);
    datosFormularioProducto.append('categoria', categoria);
    datosFormularioProducto.append('precioProducto', precioProducto);
    datosFormularioProducto.append('stockProducto', stockProducto);
    datosFormularioProducto.append('ofertaProducto', ofertaProducto);
    datosFormularioProducto.append('marcaProducto', marcaProducto);
    datosFormularioProducto.append('memoriaRamProducto', memoriaRamProducto);
    datosFormularioProducto.append('descripcionProducto', descripcionProducto);
    datosFormularioProducto.append('guardarImagenProducto', imagenPropiedadesProducto); 
    // datosFormularioProducto.append('idHTML', valor capturado en Javascript);

    // // Validacion
    if (nombreProducto == null || nombreProducto == '') {
      mostrarMensajeError('errorNombreProducto', '<strong>Error</strong>, Ingrese Nombre');
    } else {
      mostrarMensajeError('errorNombreProducto', '');
    }

    if (precioProducto == null || precioProducto == '') {
      mostrarMensajeError('errorPrecioProducto', '<strong>Error</strong>, Ingrese Precio');
    } else if (isNaN(precioProducto)) {
      mostrarMensajeError('errorPrecioProducto', '<strong>Error</strong>, Precio No es Válido');
    } else {
      mostrarMensajeError('errorPrecioProducto', '');
    }

    if (stockProducto == null || stockProducto == '') {
      mostrarMensajeError('errorStockProducto', '<strong>Error</strong>, Ingrese Stock');
    } else if (isNaN(stockProducto)) {
      mostrarMensajeError('errorStockProducto', '<strong>Error</strong>, Stock No es Válido');
    } else {
      mostrarMensajeError('errorStockProducto', '');
    }

    if (marcaProducto == null || marcaProducto == '') {
      mostrarMensajeError('errorMarcaProducto', '<strong>Error</strong>, Ingrese Marca');
    } else {
      mostrarMensajeError('errorMarcaProducto', '');
    }

    if (memoriaRamProducto == null || memoriaRamProducto == '') {
      mostrarMensajeError('errorMemoriaRamProducto', '<strong>Error</strong>, Ingrese Capacidad');
    } else if (isNaN(memoriaRamProducto)) {
      mostrarMensajeError('errorMemoriaRamProducto', '<strong>Error</strong>, Capacidad No es Válido');
    } else {
      mostrarMensajeError('errorMemoriaRamProducto', '');
    }

    // if (guardarImagenProducto == '') {
    //   mostrarMensajeError('errorFileProducto', '<strong>Error</strong>, Ingrese Imagen');
    // } else if (!extensionesArchivo.exec(guardarImagenProducto)) {
    //   mostrarMensajeError('errorFileProducto', '<strong>Error</strong>, Formatos Inválido, Recomendados : JPG, JPEG, PNG');
    //   return false;
    // } else {
    //   mostrarMensajeError('errorFileProducto', '');
    // }

    // Funcion para Mostrar y Borrar los Mensajes:
    function mostrarMensajeError(claseInput, mensaje) {
      let elemento = document.querySelector(`.${claseInput}`);
      elemento.lastElementChild.innerHTML = mensaje;
    }

    // Ajax Vista Previa 
    $.ajax({
      type: 'POST',
      url: baseUrl + 'Producto/guardar',
      data: datosFormularioProducto,
      contentType: false,
      processData: false,
    })
      .done(function (respuestaPhpGuardar) {
        $("#respuestaPhpGuardar").html(respuestaPhpGuardar);
        if (respuestaPhpGuardar == 1) {
          Swal.fire({
            title: 'Completado',
            icon: 'success'
          }).then(function () {
            window.location = baseUrl + "producto/listar";
          });
        }
      })
      .fail(function () {
        console.log("error");
      })
      .always(function () {
        console.log("completo");
      });
  });

}); // Fin del Documento Ready