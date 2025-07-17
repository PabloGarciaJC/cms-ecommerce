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

          let data = typeof response === "string" ? JSON.parse(response) : response;

          if (data.success) {
            const perms = data.permissions || [];
            const onlyRead = perms.length === 1 && perms.includes('write');
            if (onlyRead) {
              Swal.fire({
                icon: "info",
                title: data.protectionTitle,
                html: `
                  <p class="contact-message">${data.protectionMessage}</p>
                  <div class="social-links">
                    <a href="https://www.facebook.com/PabloGarciaJC" target="_blank" title="Facebook"><i class="emoji-48"></i></a>
                    <a href="https://www.instagram.com/pablogarciajc" target="_blank" title="Instagram"><i class="emoji-49"></i></a>
                    <a href="https://www.linkedin.com/in/pablogarciajc" target="_blank" title="LinkedIn"><i class="emoji-50"></i></a>
                    <a href="https://www.youtube.com/channel/UC5I4oY7BeNwT4gBu1ZKsEhw" target="_blank" title="YouTube"><i class="emoji-52"></i></a>
                  </div>
                `,
                confirmButtonText: data.protectionBtnText,
              });
              return;
            }

            Swal.fire({
              title: data.titulo,
              icon: "success",
              showConfirmButton: false,
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