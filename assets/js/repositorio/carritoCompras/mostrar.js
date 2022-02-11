let idProductoCarritoCompras = $('#idProductoCarritoCompras').val();

// let idProductoUp = $('#idProductoUp').val();



  $.ajax({
    type: 'POST',
    url: baseUrl + 'CarritoCompras/mostrar',
    // data: 'id=' + idProductoCarritoCompras + '&idUp=' + idProductoUp,
    data: 'id=' + idProductoCarritoCompras,
  })
    .done(function (respuestaPhpMostrarCarritoCompras) {
      $("#respuestaPhpMostrarCarritoCompras").html(respuestaPhpMostrarCarritoCompras);
    })
    .fail(function () {
      console.log("error");
    })
    .always(function () {
      console.log("completo");
    });


// Obtengo IdCategoria


