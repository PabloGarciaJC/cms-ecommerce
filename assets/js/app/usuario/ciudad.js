function mostrarCodigoPaises() {
  //Capturo los Codigo de los Paises
  let pais = $("#pais").val();

  // Informacion Privada Ajax
  $.ajax({
    type: "POST",
    url: baseUrl + "ciudad/obtenerTodos",
    data: "pais=" + pais,
  })
    .done(function (response) {
      $("#ciudad").attr("disabled", false);
      $("#ciudad").html(response);
    })
}
