class Favorito {
  onReady() {
    this.customFavorito();
  }

  guardarYborrarFavoritosFronted() {
    $('.item-btn-favorito').on('click', function (e) {
      e.preventDefault();
      let grupoId = $(this).data('grupo-id');
      let botonFavorito = $(this);
      let yaEsFavorito = botonFavorito.hasClass('favorito-activado');
      $.ajax({
        type: "POST",
        url: baseUrl + "Favorito/" + (yaEsFavorito ? "eliminar" : "guardar"),
        data: {grupo_id: grupoId},
        success: function (response) {
          let data = JSON.parse(response);
          if (data.success) {
            if (data.favorito) {
              botonFavorito.addClass('favorito-activado');
            } else {
              botonFavorito.removeClass('favorito-activado');
            }
            Swal.fire({
              title: data.message,
              icon: "success",
              showConfirmButton: false,
              confirmButtonText: 'Aceptar',
              timer: 1000
            });
          } else {
            Swal.fire({
              title: data.message,
              icon: "info",
              showConfirmButton: true,
              confirmButtonText: 'Aceptar',
            });
            $('.swal2-title').on('click', function (e) {
              Swal.close();
            });
          }
        },
      });
    });
  }

  borrarFavoritosAdmin() {
    $('.borrar-favorito').on('click', function (e) {
      e.preventDefault();
      let $btn = $(this);
      let url = $btn.attr('href');
      $.ajax({
        type: "GET",
        url: url,
        success: function (response) {
          let data = JSON.parse(response);
          if (data.success) {
            Swal.fire({
              title: data.message,
              icon: "success",
              showConfirmButton: false,
              timer: 1000
            });
            $btn.closest('tr').fadeOut(function () {
              $(this).remove();
              if ($('.table__favoritos tbody tr').length === 0) {
                $('.table__favoritos tbody').html('<tr><td colspan="6">No tienes productos en favoritos.</td></tr>');
              }
            });
          } else {
            Swal.fire({
              title: 'Error',
              text: data.message || 'Hubo un error al intentar eliminar el favorito.',
              icon: "error",
              showConfirmButton: true
            });
          }
        },
        error: function () {
          Swal.fire({
            title: 'Error',
            text: 'Hubo un problema al procesar la solicitud.',
            icon: "error",
            showConfirmButton: true
          });
        }
      });
    });
  }

  customFavorito() {
    this.guardarYborrarFavoritosFronted();
    this.borrarFavoritosAdmin();
  }

  init() {
    this.onReady();
  }
}

const appFavorito = new Favorito();
appFavorito.init();
