class Favorito {
  onReady() {
    this.customFavorito();
  }

  obtenerItems() {
    $('.item-btn-favorito').on('click', function (e) {
      e.preventDefault();
      let productoId = $(this).data('producto-id');
      let botonFavorito = $(this);
      let yaEsFavorito = botonFavorito.hasClass('favorito-activado');
      $.ajax({
        type: "POST",
        url: baseUrl + "Favorito/" + (yaEsFavorito ? "eliminar" : "guardar"),
        data: { producto_id: productoId },
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
              icon: "error",
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

  customFavorito() {
    this.obtenerItems();
  }

  init() {
    this.onReady();
  }
}

const appFavorito = new Favorito();
appFavorito.init();
