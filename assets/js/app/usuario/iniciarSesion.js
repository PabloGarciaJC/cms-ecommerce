let mdFormularioIniciarSesion = document.getElementById(
  "mdFormularioIniciarSesion"
);
mdFormularioIniciarSesion.addEventListener("submit", (e) => {
  e.preventDefault(); // Freno Submit o Envío;

  let mdEmailI = $("#mdEmailIniciarSesion").val();
  let mdPasswordI = $("#mdPasswordIniciarSesion").val();

  // Iniciar Sesion Usuario Ajax
  $.ajax({
    type: "POST",
    url: baseUrl + "Usuario/IniciarSesion",
    data: "email=" + mdEmailI + "&password=" + mdPasswordI,
  }).done(function (response) {
    $("#mdErrorEmailIniciarSesionPhp").html("");
    $("#mdErrorPasswordIniciarSesionPhp").html("");
    $("#respuestaPhpIniciarSesion").html(response);
    if (response == 1) {
      Swal.fire({
        title: "Completado",
        icon: "success",
        timer: 500,
        showConfirmButton: false
      }).then(function () {
        window.location = baseUrl + "usuario/informacionGeneral";
      });
      $("#mdFormularioIniciarSesion").trigger("reset");
    } else {
      $("#respuestaPhpIniciarSesion").html();
    }
  });
});
