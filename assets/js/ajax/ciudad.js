
function mostrarCodigoPaises() {

  //Capturo los Codigo de los Paises
  let pais = $('#pais').val();

  // Informacion Privada Ajax
  $.ajax({
    type: 'POST',
    url: baseUrl + 'Ciudad/obtenerTodos',
    data: 'pais=' + pais,
  })
    .done(function (respuestaPhpCiudad) {
      $('#ciudad').attr('disabled', false);      
      $('#ciudad').html(respuestaPhpCiudad);
    })
    .fail(function () {
      console.log("error");
    })
    .always(function () {
      console.log("completo");
    });
};











// let infromacionPrivada = document.getElementById('informacionPrivada');
// infromacionPrivada.addEventListener('submit', (e) => {
//   e.preventDefault(); // Freno Submit o Envío;

//   let id = $('#id').val();
//   let nombre = $('#nombre').val();
//   let apellido = $('#apellido').val();
//   let email = $('#email').val();
//   let direccion = $('#direccion').val();
//   let pais = $('#pais').val();
//   let ciudad = $('#ciudad').val();
//   let codigoPostal = $('#codigoPostal').val();

//   //Informacion Privada Ajax
//   $.ajax({
//     type: 'POST',
//     url: baseUrl + 'Pais/obtenerTodos',
//     data: 'id=' + id + '&nombre=' + nombre + '&apellido=' + apellido + '&email=' + email + '&direccion=' + direccion + '&pais=' + pais + '&ciudad=' + ciudad + '&codigoPostal=' + codigoPostal,
//   })
//     .done(function (respuestaPhpPais) {
//       $("#respuestaPhpPais").html(respuestaPhpPais);
//     })
//     .fail(function () {
//       console.log("error");
//     })
//     .always(function () {
//       console.log("completo");
//     });
// });