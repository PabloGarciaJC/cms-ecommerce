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
              title: data.titulo,
              icon: "success",
              showConfirmButton: false,
              confirmButtonText: data.boton,
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
              title: data.titulo,
              icon: "error",
              html: errorMessage,
              confirmButtonText: data.boton
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
              title: data.titulo,
              icon: "success",
              showConfirmButton: false,
              confirmButtonText: data.boton,
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
              title: data.titulo,
              icon: "error",
              html: errorMessage,
              confirmButtonText: data.boton
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

    // Script para llenar los campos con usuarios de prueba 
    let userCards = $('.user-card');
    let emailInput = $('[name="email"]');
    let passwordInput = $('[name="password"]');

    // Recorre las tarjetas y añade funcionalidad de clic
    userCards.on('click', function () {

      // Remueve la clase activa de todas las tarjetas
      userCards.removeClass('active');

      // Añade la clase activa a la tarjeta seleccionada
      $(this).addClass('active');

      let email = $(this).data('email');
      let password = $(this).data('password');

      let protectionLayer = $('#protection-layer').text().trim();
      if (protectionLayer === '1' && email === 'admin@pablogarciajc.com') {
        if (email === 'admin@pablogarciajc.com') {
          Swal.fire({
            icon: 'warning',
            title: 'Acceso Restringido',
            html: `Para ingresar al panel administrativo, Puede contactarme fácilmente a través de este enlace: `,
            showCancelButton: true,
            confirmButtonText: 'Contactar en LinkedIn',
            cancelButtonText: 'Cerrar',
            reverseButtons: true,
          }).then((result) => {
            if (result.isConfirmed) {
              window.open('https://www.linkedin.com/in/pablogarciajc/', '_blank');
            }
          });
          return;
        }
      }

      // Rellena los campos del formulario
      emailInput.val(email);
      passwordInput.val(password);

      setTimeout(function () {
        $('.formulario-iniciar-sesion').submit();
      }, 300);
    });

    if (!localStorage.getItem('modalShown')) {
      $('#exampleModal').modal('show');
      localStorage.setItem('modalShown', 'true');
    }
  }

  init() {
    this.onReady();
  }
}

const appUser = new User();
appUser.init();