class App {

  onReady() {
    this.customApp();
  }

  mostrarCiudades() {
    function mostrarCodigoPaises() {
      $("#pais").change(function () {
        let pais = $("#pais").val();
        $.ajax({
          type: "POST",
          url: baseUrl + "ciudad/obtenerTodos",
          data: "pais=" + pais,
        })
          .done(function (response) {
            $("#ciudad").attr("disabled", false);
            $("#ciudad").html(response);
          })
      });
    }
    mostrarCodigoPaises();
  }
  
  avatarVistaPrevia() {
    $('.file-img').on('change', function () {
      // Obtén el archivo seleccionado
      let file = this.files[0];
      // Verifica si se ha seleccionado un archivo
      if (file) {
        let reader = new FileReader();
        // Define lo que sucederá cuando se cargue el archivo
        reader.onload = function (e) {
          // Establece la nueva imagen en el contenedor de previsualización
          $('.previe').attr('src', e.target.result);
        };
        // Lee el archivo como una URL de datos
        reader.readAsDataURL(file);
      }
    });
  }

  // Método customApp
  customApp() {
    this.avatarVistaPrevia();
    this.mostrarCiudades();
  }

  // Iniciar aplicación
  init() {
    this.onReady();
  }
}

// Instanciamos e iniciamos
const app = new App();
app.init();