  
// Autocompleto el Buscador
function autocompletado(jsonBuscador) {

   var items = jsonBuscador;

  $("#buscadorGlobal").autocomplete({

    source: items,    

  })

}

// Capturo Valores del Buscador a tiempo real y repueblo el otro Buscador
buscadorGlobal.addEventListener('keyup', (event) => {

  valorBuscador = event.path[0].value;

  $('#buscadorMostrarProducto').val(valorBuscador);

});


