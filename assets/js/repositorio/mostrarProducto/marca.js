
// Capturo Todos los Valores del Checkbox a travez de la clases.

$(document).ready(function () {

  // Obtengo los Checked Selecionados 
  let checkedMarca = document.querySelectorAll('.checkedMarca');
  let checkedboxMemoriaRam = document.querySelectorAll('.checkedMemoriaRam');
  let checkedPrecio = document.querySelectorAll('.checkedPrecio');

  // Obtengo IdCategoria
  let productoIdCategoriaMarca = $('#productoIdCategoria').val();

  // Array Checkbox
  arrayCheckMarca = [];
  arrayCheckMemoriaRam = [];
  arrayCheckedPrecio = [];

   // Checkedbox Marca Selecionados
  for (var checkedTodosMarca of checkedMarca) {
    checkedTodosMarca.addEventListener('click', function () {

      if (this.checked) {
        // implemento valores al array
        arrayCheckMarca.push(this.value);
      } else {
        //Remuevo valores array
        arrayCheckMarca = arrayCheckMarca.filter(e => e !== this.value);
      }
      //Ajax 
      AjaxMarca(arrayCheckMarca, productoIdCategoriaMarca, arrayCheckMemoriaRam, arrayCheckedPrecio);
    }); //Fin del click
  }//Fin del for


  // Checkedbox Memoria Ram Selecionados
  for (var checkedboxTodosMemoriaRam of checkedboxMemoriaRam) {
    checkedboxTodosMemoriaRam.addEventListener('click', function () {

      if (this.checked) {
        // implemento valores al array
        arrayCheckMemoriaRam.push(this.value);

      } else {
        //Remuevo valores array
        arrayCheckMemoriaRam = arrayCheckMemoriaRam.filter(e => e !== this.value);
      }
      //Ajax 
      AjaxMarca(arrayCheckMarca, productoIdCategoriaMarca, arrayCheckMemoriaRam, arrayCheckedPrecio);
    }); //Fin del click
  }//Fin del for


  // Checkedbox Precio Selecionados
  for (var checkedTodosPrecio of checkedPrecio) {
    checkedTodosPrecio.addEventListener('click', function () {

      if (this.checked) {
        // implemento valores al array
        arrayCheckedPrecio.push(this.value);

      } else {
        //Remuevo valores array
        arrayCheckedPrecio = arrayCheckedPrecio.filter(e => e !== this.value);
      }
      //Ajax 
      AjaxMarca(arrayCheckMarca, productoIdCategoriaMarca, arrayCheckMemoriaRam, arrayCheckedPrecio);
    }); //Fin del click
  }//Fin del for



  // Function  Ajax
  function AjaxMarca(arrayCheckMarca, productoIdCategoriaMarca, arrayCheckMemoriaRam, arrayCheckedPrecio) {

    $.ajax({
      type: 'POST',
      url: baseUrl + 'Producto/marca',
      data: { arrayMarca: JSON.stringify(arrayCheckMarca), productoByIdCategoria: productoIdCategoriaMarca, arrayMemoriaRam: JSON.stringify(arrayCheckMemoriaRam), arrayPrecio: JSON.stringify(arrayCheckedPrecio) },
    })
      .done(function (respuestaPhpMostrarMarca) {
        $("#respuestaPhpMostrarMarca").html(respuestaPhpMostrarMarca);
      })
      .fail(function () {
        console.log("error");
      })
      .always(function () {
        console.log("completo");
      });

  }




  /* Prueba 1 */
  // buscadorMarca.addEventListener('submit', (e) => {
  //   e.preventDefault(); // Freno Submit o Envío;

  //   // Array de Checkbox
  //   let valoresCheck = [];

  //   // Obtengo los Checked Selecionados y los Subo al Array
  //   $('.checkedMarca').each(function () {
  //     if ($(this).is(":checked")) {
  //       valoresCheck.push($(this).val());
  //     }
  //   });

  //   // Ajax 
  //   $.ajax({
  //     type: 'POST',
  //     url: baseUrl + 'Producto/marca',
  //     data: { valoresChecked: JSON.stringify(valoresCheck) },
  //   })
  //     .done(function (respuestaPhpMostrarMarca) {
  //       $("#respuestaPhpMostrarMarca").html(respuestaPhpMostrarMarca);
  //     })
  //     .fail(function () {
  //       console.log("error");
  //     })
  //     .always(function () {
  //       console.log("completo");
  //     });
  // }); //Fin de Subtmit



}); // Fin del Documento Ready





