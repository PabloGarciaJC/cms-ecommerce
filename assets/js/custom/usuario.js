class User {

  onReady() {
    this.customUser();
  }

  registro() {
    $('.formulario-registro').on('submit', function (e) {
      e.preventDefault();
      let formData = $(this).serialize();
      $.ajax({
        type: 'POST',
        url: baseUrl + 'Usuario/registro',
        data: formData,
        success: function (response) {
          let data = JSON.parse(response);
          if (data.success) {
            Swal.fire({
              title: data.message,
              icon: "success",
              showConfirmButton: false,
              confirmButtonText: 'Aceptar',
              timer: 1000
            }).then(() => {
              window.location.reload();
            });
            $('.formulario-registro').trigger('reset');
          } else {
            let errorMessage = "";
            data.message.forEach(function (error) {
              errorMessage += `<p style="color: red;text-align: justify;"><i class="fa fa-times-circle"></i> ${error}</p>`;
            });
            Swal.fire({
              title: "Errores en el registro",
              icon: "error",
              html: errorMessage,
              confirmButtonText: "Revisar"
            });
          }
        },
        error: function (jqXHR, textStatus, errorThrown) {
          console.error(textStatus, errorThrown);
          $('#respuestaPhpRegistro').html('Ocurrió un error al enviar la solicitud.').show();
        }
      });
    });
  }

  iniciarSesion() {
    $(".formulario-iniciar-sesion").on("submit", function (e) {
      e.preventDefault();
      let formData = $(this).serialize();
      $.ajax({
        type: 'POST',
        url: baseUrl + 'Usuario/IniciarSesion',
        data: formData,
        success: function (response) {
          let data = JSON.parse(response);
          if (data.success) {
            Swal.fire({
              title: data.message,
              icon: "success",
              showConfirmButton: false,
              confirmButtonText: 'Aceptar',
              timer: 1000
            }).then(() => {
              window.location.reload();
            });
            $('.formulario-iniciar-sesion').trigger('reset');
          } else {
            let errorMessage = "";
            data.message.forEach(function (error) {
              errorMessage += `<p style="color: red;text-align: justify;"><i class="fa fa-times-circle"></i> ${error}</p>`;
            });
            Swal.fire({
              title: "Errores al iniciar sesión",
              icon: "error",
              html: errorMessage,
              confirmButtonText: "Revisar"
            });
          }
        },
        error: function (jqXHR, textStatus, errorThrown) {
          console.error(textStatus, errorThrown);
          $('#respuestaPhpRegistro').html('Ocurrió un error al enviar la solicitud.').show();
        }
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