   // modal iniciar sesion
   function mdFormularioIniciarSesion() {

    let mdFormularioIniciarSesion = document.getElementById('mdFormularioIniciarSesion');
    mdFormularioIniciarSesion.addEventListener('submit', (e) => {
      e.preventDefault();

      let emailPhpIniciarSesion = $('#mdEmailPhpIniciarSesion').val();
      let passwordPhpIniciarSesion = $('#mdPasswordPhpIniciarSesion').val();

      $.ajax({
          type: 'POST',
          url: baseUrl + 'Usuario/iniciarSesion',
          data: 'email=' + emailPhpIniciarSesion + '&password=' + passwordPhpIniciarSesion,
        })
        .done(function(respuestaPhpIniciarSesion) {
          $('#mdErrorEmailPhpIniciarSesion').html('');
          $('#mdErrorPasswordPhpIniciarSesion').html('');
          $("#idIniciarSesionCompletado").html(respuestaPhpIniciarSesion);
          if (respuestaPhpIniciarSesion == 1) {
            $('#idIniciarSesionCompletado').html('<div class="alert alert-success" role="alert"><strong>Iniciar Sesion</strong>, Completado </div>');
            $('#mdFormularioIniciarSesion').trigger('reset');
          } else {
            $('#idIniciarSesionCompletado').html('');
          }
        })
        .fail(function() {
          console.log("error");
        })
        .always(function() {
          console.log("completo");
        });
    });
  }



  