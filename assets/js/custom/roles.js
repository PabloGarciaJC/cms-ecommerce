class Roles {

  onReady() {
    this.customRoles();
  }

  cambiarRol() {
    $('.btn-rol-change').on('click', function (e) {

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