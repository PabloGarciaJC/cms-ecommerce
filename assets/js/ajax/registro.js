
let mdFormularioRegistro = document.getElementById('mdFormularioRegistro');
mdFormularioRegistro.addEventListener('submit', (e) => {
  e.preventDefault(); // Freno Submit o Envío;

  let mdUsuarioR = $('#mdUsuarioRegistro').val();
  let mdEmailR = $('#mdEmailRegistro').val();
  let mdPasswordR = $('#mdPasswordRegistro').val();
  let mdConfirmarPasswordR = $('#mdConfirmarPasswordRegistro').val();
  let mdCheckedR = document.getElementById('mdCheckedRegistro').checked;

  // Registro Usuario Ajax
  $.ajax({
    type: 'POST',
    url: baseUrl + 'Usuario/registro',
    data: 'usuario=' + mdUsuarioR + '&email=' + mdEmailR + '&password=' + mdPasswordR + '&confirmarPassword=' + mdConfirmarPasswordR + '&checked=' + mdCheckedR,
  })
    .done(function (respuestaPhpRegistro) {
      $('#mdErrorUsuarioPhp').html('');
      $('#mdErrorEmailPhp').html('');
      $('#mdErrorPasswordPhp').html('');
      $('#mdErrorConfirmarPasswordPhp').html('');
      $('#mdErrorChekedPhp').html('');      
      $("#respuestaPhpRegistro").html(respuestaPhpRegistro);
      if (respuestaPhpRegistro == 1) {
        // $('#respuestaPhpRegistro').html('<div class="alert alert-success" role="alert"><strong>Registro</strong>, Completado </div>');
          Swal.fire({
            title: 'Registro Completo',
            icon: 'success'
          }).then(function () {
            window.location = baseUrl;
          });
          $('#mdFormularioRegistro').trigger('reset');
        } else {
          $('#respuestaPhpRegistro').html('');
        }
      })
    .fail(function () {
      console.log("error");
    })
    .always(function () {
      console.log("completo");
    });
});