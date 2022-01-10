
$(document).ready(function () {

  let buscadorMostrarProducto = document.getElementById('buscadorMostrarProducto');
  let productoIdCategoria = $('#productoIdCategoria').val();

  // mostrar Por CategoriaId los Productos
  $.ajax({
    type: 'POST',
    url: baseUrl + 'Producto/mostrarPorCategoriaId',
    data: 'productoIdCategoria=' + productoIdCategoria,
  })
    .done(function (respuestaPhpMostrarProductos) {
      $("#respuestaPhpMostrarProductos").html(respuestaPhpMostrarProductos);
    })
    .fail(function () {
      console.log("error");
    })
    .always(function () {
      console.log("completo");
    });

// Buscador
  buscadorMostrarProducto.addEventListener('submit', (e) => {
    e.preventDefault(); // Freno Submit o Envío;
    let buscadorProducto = $('#buscadorProducto').val();
      $.ajax({
        type: 'POST',
        url: baseUrl + 'Producto/mostrarPorCategoriaId',
        data: 'buscadorProducto=' + buscadorProducto + '&productoIdCategoria=' + productoIdCategoria,
      })
        .done(function (respuestaPhpMostrarProductos) {
          $("#respuestaPhpMostrarProductos").html(respuestaPhpMostrarProductos);

        })
        .fail(function () {
          console.log("error");
        })
        .always(function () {
          console.log("completo");
        });
    });
  });


