// modal registro 
function mdFormularioRegistro() {
  let mdFormularioRegistro = document.getElementById('mdFormularioRegistro');
  mdFormularioRegistro.addEventListener('submit', (e) => {
    e.preventDefault(); // Freno Submit o Envío;

    let mdUsuarioR = $('#mdUsuarioRegistro').val();
    let mdEmailR = $('#mdEmailRegistro').val();
    let mdPasswordR = $('#mdPasswordRegistro').val();
    let mdConfirmarPasswordR = $('#mdConfirmarPasswordRegistro').val();
    let mdCheckedR = document.getElementById('mdCheckedRegistro').checked;

    // Crear Usuario Ajax
    $.ajax({
      type: 'POST',
      url: baseUrl + 'Usuario/crear',
      data: 'usuario=' + mdUsuarioR + '&email=' + mdEmailR + '&password=' + mdPasswordR + '&confirmarPassword=' + mdConfirmarPasswordR + '&checked=' + mdCheckedR,
    })
      .done(function (respuesta) {

        borrarMensajesErrorModal();



        $("#idRegistroCompletado").html(respuesta);
      

        if (!isNaN(respuesta) && respuesta != 0) {
          $('#idRegistroCompletado').html('<div class="alert alert-success" role="alert"><strong>Registro</strong>, Completado </div>');
          $('#mdFormularioRegistro').trigger('reset');
        } else {
          $('#idRegistroCompletado').html('');
          let arrayResp = respuesta.split(",", 2);
          setearMensajeError(arrayResp[0], arrayResp[1]);
        }
      })
      .fail(function () {
        console.log("error");
      })
      .always(function () {
        console.log("completo");
      });
  });
}

function borrarMensajesErrorModal() {
  $('#mdErrorUsuarioPhp').html('');
  $('#mdErrorEmailPhp').html('');
  $('#mdErrorPasswordPhp').html('');
  $('#mdErrorConfirmarPasswordPhp').html('');
  $('#mdErrorChekedPhp').html('');
}

function setearMensajeError(idMensaje, mensaje) {
  document.getElementById(idMensaje).innerHTML = '<strong>Error</strong>,' + mensaje;
}