class User {

  // Método onReady
  onReady() {
    this.customUser();
  }

  // Método registro
  registro() {
    let mdFormularioRegistro = document.getElementById('mdFormularioRegistro');
    mdFormularioRegistro.addEventListener('submit', (e) => {
      e.preventDefault();
      let mdUsuarioR = $('#mdUsuarioRegistro').val();
      let mdEmailR = $('#mdEmailRegistro').val();
      let mdPasswordR = $('#mdPasswordRegistro').val();
      let mdConfirmarPasswordR = $('#mdConfirmarPasswordRegistro').val();
      let mdCheckedR = document.getElementById('mdCheckedRegistro').checked;
      // Registro Usuario Ajax
      $.ajax({
        type: 'POST',
        url: baseUrl + 'Usuario/registro',
        data: 'usuario=' + mdUsuarioR + '&email=' + mdEmailR + '&password=' + mdPasswordR + '&confirmarPassword=' + mdConfirmarPasswordR + '&checked=' + mdCheckedR,
      })
        .done(function (response) {
          $('#mdErrorUsuarioPhp').html('');
          $('#mdErrorEmailPhp').html('');
          $('#mdErrorPasswordPhp').html('');
          $('#mdErrorConfirmarPasswordPhp').html('');
          $('#mdErrorChekedPhp').html('');
          $("#respuestaPhpRegistro").html(response);
          if (response == 1) {
            Swal.fire({
              title: "Completado",
              icon: "success",
              timer: 500,
              showConfirmButton: false
            }).then(function () {
              window.location = baseUrl + "usuario/informacionGeneral";
            });
            $('#mdFormularioRegistro').trigger('reset');
          } else {
            $('#respuestaPhpRegistro').html('');
          }
        })
    });
  }

  iniciarSesion() {
    $("#mdFormularioIniciarSesion").on("submit", function (e) {
      e.preventDefault(); // Freno Submit o Envío

      let mdEmailI = $("#mdEmailIniciarSesion").val();
      let mdPasswordI = $("#mdPasswordIniciarSesion").val();

      // Validación básica
      if (!mdEmailI || !mdPasswordI) {
        $("#respuestaPhpIniciarSesion").html("Por favor completa todos los campos.");
        return;
      }

      // Iniciar Sesion Usuario Ajax
      $.ajax({
        type: "POST",
        url: baseUrl + "Usuario/IniciarSesion",
        data: {
          email: mdEmailI,
          password: mdPasswordI,
        },
        success: function (response) {
          $("#mdErrorEmailIniciarSesionPhp").html("");
          $("#mdErrorPasswordIniciarSesionPhp").html("");
          $("#respuestaPhpIniciarSesion").html(response);

          if (response == 1) {
            Swal.fire({
              title: "Completado",
              icon: "success",
              timer: 500,
              showConfirmButton: false,
            }).then(function () {
              window.location = baseUrl + "usuario/informacionGeneral";
            });
            $("#mdFormularioIniciarSesion").trigger("reset");
          } else {
            $("#respuestaPhpIniciarSesion").html("Error al iniciar sesión. Verifica tus credenciales.");
          }
        },
        error: function (xhr, status, error) {
          console.error("Error en la solicitud AJAX:", status, error);
          $("#respuestaPhpIniciarSesion").html("Ocurrió un error. Inténtalo nuevamente.");
        },
      });
    });
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
          $('#previe').attr('src', e.target.result);
        };
        // Lee el archivo como una URL de datos
        reader.readAsDataURL(file);
      }
    });
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

  // Método customUser
  customUser() {
    this.registro();
    this.iniciarSesion();
    this.avatarVistaPrevia();
    this.mostrarCiudades();
  }

  // Iniciar aplicación
  init() {
    this.onReady();
  }
}

// Instanciamos e iniciamos
const app = new User();
app.init();