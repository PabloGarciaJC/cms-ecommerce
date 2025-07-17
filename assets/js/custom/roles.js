class Roles {

  onReady() {
    this.customRoles();
  }

  cambiarRol() {
    $('.btn-rol-change').on('click', function (e) {
      e.preventDefault();

      let btn = $(this);
      let dataUrl = btn.data('url');
      let userId = btn.data('user-id');
      let row = btn.closest('tr');
      let newRole = row.find('.custom-select-roles').val();
      let newStatus = row.find('.custom-select-status').val();

      if (!newRole || !newStatus) {
        Swal.fire({
          icon: 'warning',
          title: 'Campos incompletos',
          text: 'Debe seleccionar un rol y un estado.',
        });
        return;
      }

      $.ajax({
        url: dataUrl,
        type: 'POST',
        data: JSON.stringify({
          id: userId,
          rol: newRole,
          status: newStatus
        }),
        contentType: 'application/json',
        dataType: 'json',
        success: function (response) {
          if (response.success) {
            Swal.fire({
              title: "Completado",
              text: "El rol y estado se han actualizado correctamente.",
              icon: "success",
              timer: 2000,
              showConfirmButton: false
            });
          } else {
            Swal.fire({
              icon: "error",
              title: "Error",
              text: response.message || "Hubo un problema al actualizar el rol o estado.",
            });
          }
        },
        error: function (xhr, status, error) {
          console.error(error);
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Hubo un error en la solicitud AJAX.',
          });
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

let appRoles = new Roles();
appRoles.init();