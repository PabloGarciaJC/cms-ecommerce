class Roles {

  onReady() {
    this.customRoles();
  }

  cambiarRol() {
    $('.btn-rol-change').on('click', function (e) {

      let protectionLayer = $('#protection-layer').text().trim();
      let protectionTitle = $('#protection-layer').data('title');
      let protectionMessage = $('#protection-layer').data('message');
      let protectionBtnText = $('#protection-layer').data('close');
      if (protectionLayer === '1') {
        e.preventDefault();
        Swal.fire({
          icon: "info",
          title: protectionTitle,
          html: `
              <p class="contact-message">${protectionMessage}</p>
              <div class="social-links">
                  <a href="https://www.facebook.com/PabloGarciaJC" target="_blank" title="Facebook"><i class="emoji-48"></i></a>
                  <a href="https://www.instagram.com/pablogarciajc" target="_blank" title="Instagram"><i class="emoji-49"></i></a>
                  <a href="https://www.linkedin.com/in/pablogarciajc" target="_blank" title="LinkedIn"><i class="emoji-50"></i></a>
                  <a href="https://www.youtube.com/channel/UC5I4oY7BeNwT4gBu1ZKsEhw" target="_blank" title="YouTube"><i class="emoji-52"></i></a>
              </div>`,

          confirmButtonText: protectionBtnText,
        });
        return;
      }

      let dataUrl = $(this).data('url');
      let userId = $(this).data('user-id');
      let newRole = $(this).closest('tr').find('.custom-select-roles').val();
      $.ajax({
        url: dataUrl,
        type: 'POST',
        data: JSON.stringify({
          id: userId,
          rol: newRole
        }),
        contentType: 'application/json',
        success: function (response) {
          const data = JSON.parse(response);
          if (data.success) {
            Swal.fire({
              title: "Completado",
              text: "El rol se ha actualizado correctamente.",
              icon: "success",
              timer: 2000,
              showConfirmButton: false
            })
          } else {
            Swal.fire({
              text: "Solo puede haber un ROL administrador en el sistema",
              icon: "error",
              showConfirmButton: true,  // Muestra el botón para cerrar
              confirmButtonText: 'Cerrar',  // Texto del botón
            });
          }
        },
        error: function () {
          alert('Hubo un error al realizar la solicitud.');
        }
      });
    });
  }

  // Método customRoles
  customRoles() {
    this.cambiarRol();
  }

  // Iniciar aplicación
  init() {
    this.onReady();
  }
}

const appRoles = new Roles();
appRoles.init();