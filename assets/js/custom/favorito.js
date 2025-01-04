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
            }else{
              botonFavorito.removeClass('favorito-activado');
            }
          } else {
            Swal.fire({
              title: response.message,
              icon: "error",
              timer: 1500,
              showConfirmButton: false,
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
