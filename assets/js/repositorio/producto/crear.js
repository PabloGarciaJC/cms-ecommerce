let formularioProducto = document.getElementById('formularioProducto');

formularioProducto.addEventListener('submit', (e) => {
  e.preventDefault(); // Freno Submit o Envío;

  //valores Capturados
  let nombreProducto = $('#nombreProducto').val();
  let idProducto = $('#idProducto').val();
  let categoria = document.getElementById('categoria').value;
  let precioProducto = $('#precioProducto').val();
  let stockProducto = $('#stockProducto').val();
  let ofertaProducto = $('#ofertaProducto').val();
  let marcaProducto = $('#marcaProducto').val();
  let memoriaRamProducto = $('#memoriaRamProducto').val();
  let descripcionProducto = $('#descripcionProducto').val();
  let guardarImagenProducto = document.getElementById('archivoImagenProducto').value;

  // instacio
  let datosFormularioProducto = new FormData();

  //Capturo Propiedades File
  let imagenPropiedadesProducto = $('#archivoImagenProducto')[0].files[0];

  //Setear el Objeto
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

  // Validacion
  if (nombreProducto == null || nombreProducto == '') {
    mostrarMensajeError('errorNombreProducto', 'Ingrese Nombre del Producto');
  } else {
    mostrarMensajeError('errorNombreProducto', '');
  }

  if (precioProducto == null || precioProducto == '') {
    mostrarMensajeError('errorPrecioProducto', 'Ingrese el Precio');
  } else if (isNaN(precioProducto)) {
    mostrarMensajeError('errorPrecioProducto', 'Precio No es Válido');
  } else {
    mostrarMensajeError('errorPrecioProducto', '');
  }

  if (stockProducto == null || stockProducto == '') {
    mostrarMensajeError('errorStockProducto', 'Ingrese el Stock');
  } else if (isNaN(stockProducto)) {
    mostrarMensajeError('errorStockProducto', 'Stock No es Válido');
  } else {
    mostrarMensajeError('errorStockProducto', '');
  }

  if (ofertaProducto == null || ofertaProducto == '') {
    mostrarMensajeError('errorOfertaProducto', 'Ingrese la Oferta');
  } else {
    mostrarMensajeError('errorOfertaProducto', '');
  }

  if (marcaProducto == null || marcaProducto == '') {
    mostrarMensajeError('errorMarcaProducto', 'Ingrese la Marca');
  } else {
    mostrarMensajeError('errorMarcaProducto', '');
  }

  if (memoriaRamProducto == null || memoriaRamProducto == '') {
    mostrarMensajeError('errorMemoriaRamProducto', 'Ingrese Memoria Ram');
  } else {
    mostrarMensajeError('errorMemoriaRamProducto', '');
  }

  if (descripcionProducto == null || descripcionProducto == '') {
    mostrarMensajeError('errorDescripcionProducto', 'Ingrese Descripción');
  } else {
    mostrarMensajeError('errorDescripcionProducto', '');
  }

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