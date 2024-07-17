function mostrarCodigoPaises() {
  //Capturo los Codigo de los Paises
  let pais = $("#pais").val();

  // Informacion Privada Ajax
  $.ajax({
    type: "POST",
    url: baseUrl + "Ciudad/obtenerTodos",
    data: "pais=" + pais,
  })
    .done(function (respuestaPhpCiudad) {
      $("#ciudad").attr("disabled", false);
      $("#ciudad").html(respuestaPhpCiudad);
    })
    .fail(function () {
      console.log("error");
    })
    .always(function () {
      console.log("completo");
    });
}
