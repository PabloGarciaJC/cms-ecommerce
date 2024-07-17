  
// Autocompleto el Buscador
function autocompletado(jsonBuscador) {
   var items = jsonBuscador;
  $("#buscadorGlobal").autocomplete({
    source: items,    
  })

}




