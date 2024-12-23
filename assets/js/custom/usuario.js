class User {

  onReady() {
    this.customUser();
  }

  registro() {
    let mdFormularioRegistro = document.getElementById('mdFormularioRegistro');
    if (mdFormularioRegistro) {
      mdFormularioRegistro.addEventListener('submit', (e) => {
        e.preventDefault();
        let mdUsuarioR = $('#mdUsuarioRegistro').val();
        let mdEmailR = $('#mdEmailRegistro').val();
        let mdPasswordR = $('#mdPasswordRegistro').val();
        let mdConfirmarPasswordR = $('#mdConfirmarPasswordRegistro').val();
        let mdCheckedR = document.getElementById('mdCheckedRegistro').checked;
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
                window.location = baseUrl + "Admin/dashboard";
              });
              $('#mdFormularioRegistro').trigger('reset');
            } else {
              $('#respuestaPhpRegistro').html('');
            }
          })
      });
    }
  }

  iniciarSesion() {
    $("#mdFormularioIniciarSesion").on("submit", function (e) {
      e.preventDefault();
      let mdEmailI = $("#mdEmailIniciarSesion").val();
      let mdPasswordI = $("#mdPasswordIniciarSesion").val();
      if (!mdEmailI || !mdPasswordI) {
        $("#respuestaPhpIniciarSesion").html("Por favor completa todos los campos.");
        return;
      }
      $.ajax({
        type: "POST",
        url: baseUrl + "Usuario/IniciarSesion",
        data: {
          email: mdEmailI,
          password: mdPasswordI,
        },
        success: function (response) {
          if (response == 1) {
            Swal.fire({
              title: "Completado",
              icon: "success",
              timer: 500,
              showConfirmButton: false,
            }).then(function () {
              window.location = baseUrl + "Admin/dashboard";
            });
            $("#mdFormularioIniciarSesion").trigger("reset");
          } else {
            $("#respuestaPhpIniciarSesion").html("Error al iniciar sesión. Verifica tus credenciales.");
          }
          $("#mdErrorEmailIniciarSesionPhp").html("");
          $("#mdErrorPasswordIniciarSesionPhp").html("");
          $("#respuestaPhpIniciarSesion").html(response);
        },
        error: function (xhr, status, error) {
          console.error("Error en la solicitud AJAX:", status, error);
          $("#respuestaPhpIniciarSesion").html("Ocurrió un error. Inténtalo nuevamente.");
        },
      });
    });
  }

  customUser() {
    this.registro();
    this.iniciarSesion();
  }

  init() {
    this.onReady();
  }
}

const appUser = new User();
appUser.init();