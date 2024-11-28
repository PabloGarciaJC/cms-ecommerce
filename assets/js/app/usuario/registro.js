
// let mdFormularioRegistro = document.getElementById('mdFormularioRegistro');
// mdFormularioRegistro.addEventListener('submit', (e) => {
//   e.preventDefault();
//   let mdUsuarioR = $('#mdUsuarioRegistro').val();
//   let mdEmailR = $('#mdEmailRegistro').val();
//   let mdPasswordR = $('#mdPasswordRegistro').val();
//   let mdConfirmarPasswordR = $('#mdConfirmarPasswordRegistro').val();
//   let mdCheckedR = document.getElementById('mdCheckedRegistro').checked;
//   // Registro Usuario Ajax
//   $.ajax({
//     type: 'POST',
//     url: baseUrl + 'Usuario/registro',
//     data: 'usuario=' + mdUsuarioR + '&email=' + mdEmailR + '&password=' + mdPasswordR + '&confirmarPassword=' + mdConfirmarPasswordR + '&checked=' + mdCheckedR,
//   })
//     .done(function (response) {
//       $('#mdErrorUsuarioPhp').html('');
//       $('#mdErrorEmailPhp').html('');
//       $('#mdErrorPasswordPhp').html('');
//       $('#mdErrorConfirmarPasswordPhp').html('');
//       $('#mdErrorChekedPhp').html('');      
//       $("#respuestaPhpRegistro").html(response);
//       if (response == 1) {
//           Swal.fire({
//             title: "Completado",
//             icon: "success",
//             timer: 500,
//             showConfirmButton: false
//           }).then(function () {
//             window.location = baseUrl + "usuario/informacionGeneral";
//           });
//           $('#mdFormularioRegistro').trigger('reset');
//         } else {
//           $('#respuestaPhpRegistro').html('');
//         }
//       })
// });