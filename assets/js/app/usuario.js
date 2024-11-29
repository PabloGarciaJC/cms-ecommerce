class User {

  // Método onReady
  onReady() {
    this.customUser();
  }

  // Método registro
  registro() {
    let mdFormularioRegistro = document.getElementById('mdFormularioRegistro');
    mdFormularioRegistro.addEventListener('submit', (e) => {
      e.preventDefault();
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
        .done(function (response) {
          $('#mdErrorUsuarioPhp').html('');
          $('#mdErrorEmailPhp').html('');
          $('#mdErrorPasswordPhp').html('');
          $('#mdErrorConfirmarPasswordPhp').html('');
          $('#mdErrorChekedPhp').html('');
          $("#respuestaPhpRegistro").html(response);
          if (response == 1) {
            Swal.fire({
              title: "Completado",
              icon: "success",
              timer: 500,
              showConfirmButton: false
            }).then(function () {
              window.location = baseUrl + "usuario/informacionGeneral";
            });
            $('#mdFormularioRegistro').trigger('reset');
          } else {
            $('#respuestaPhpRegistro').html('');
          }
        })
    });
  }

  iniciarSesion() {
    $("#mdFormularioIniciarSesion").on("submit", function (e) {
      e.preventDefault(); // Freno Submit o Envío

      let mdEmailI = $("#mdEmailIniciarSesion").val();
      let mdPasswordI = $("#mdPasswordIniciarSesion").val();

      // Validación básica
      if (!mdEmailI || !mdPasswordI) {
        $("#respuestaPhpIniciarSesion").html("Por favor completa todos los campos.");
        return;
      }

      // Iniciar Sesion Usuario Ajax
      $.ajax({
        type: "POST",
        url: baseUrl + "Usuario/IniciarSesion",
        data: {
          email: mdEmailI,
          password: mdPasswordI,
        },
        success: function (response) {
          $("#mdErrorEmailIniciarSesionPhp").html("");
          $("#mdErrorPasswordIniciarSesionPhp").html("");
          $("#respuestaPhpIniciarSesion").html(response);

          if (response == 1) {
            Swal.fire({
              title: "Completado",
              icon: "success",
              timer: 500,
              showConfirmButton: false,
            }).then(function () {
              window.location = baseUrl + "usuario/informacionGeneral";
            });
            $("#mdFormularioIniciarSesion").trigger("reset");
          } else {
            $("#respuestaPhpIniciarSesion").html("Error al iniciar sesión. Verifica tus credenciales.");
          }
        },
        error: function (xhr, status, error) {
          console.error("Error en la solicitud AJAX:", status, error);
          $("#respuestaPhpIniciarSesion").html("Ocurrió un error. Inténtalo nuevamente.");
        },
      });
    });
  }

  informacionPublica() {
    // Verifica si existe el formulario antes de proceder
    if ($('#informacionPublica').length) {
      $('#informacionPublica').on('submit', function (e) {
        e.preventDefault(); // Prevenir el envío del formulario

        // Obtener valores de los campos
        let id = $('#id').val();
        let usuario = $('#usuario').val();
        let documentacion = $('#documentacion').val();
        let telefono = $('#telefono').val();

        // Validaciones
        let valid = true;

        if (!usuario) {
          mostrarMensajeError('errorUsuario', 'Ingrese Alias');
          valid = false;
        } else {
          mostrarMensajeError('errorUsuario', '');
        }

        if (!documentacion) {
          mostrarMensajeError('errorDocumentacion', 'Ingrese Documentacíon');
          valid = false;
        } else {
          mostrarMensajeError('errorDocumentacion', '');
        }

        if (!telefono) {
          mostrarMensajeError('errorTelefono', 'Ingrese Teléfono');
          valid = false;
        } else {
          mostrarMensajeError('errorTelefono', '');
        }
        // Si no pasa la validación, detener el proceso
        if (!valid) return;
        // Ajax para enviar información al servidor
        $.ajax({
          type: 'POST',
          url: baseUrl + 'Usuario/informacionPublica',
          data: {
            id: id,
            usuario: usuario,
            documentacion: documentacion,
            telefono: telefono
          },
          success: function (response) {
            $("#respuestaPhpInformacionPublica").html(response);
            if (response == 1) {
              Swal.fire({
                title: "Completado",
                icon: "success",
                timer: 500,
                showConfirmButton: false
              });
            }
          },
          error: function (xhr, status, error) {
            console.error("Error en la solicitud:", status, error);
            $("#respuestaPhpInformacionPublica").html("Ocurrió un error. Por favor, intente de nuevo.");
          }
        });
      });
      // Función para mostrar mensajes de error
      function mostrarMensajeError(claseInput, mensaje) {
        $(`.${claseInput} span`).html(mensaje);
      }
    }
  }

  avatarVistaPrevia() {
    $('.file-img').on('change', function () {
      // Obtén el archivo seleccionado
      let file = this.files[0];
      // Verifica si se ha seleccionado un archivo
      if (file) {
        let reader = new FileReader();
        // Define lo que sucederá cuando se cargue el archivo
        reader.onload = function (e) {
          // Establece la nueva imagen en el contenedor de previsualización
          $('#previe').attr('src', e.target.result);
        };
        // Lee el archivo como una URL de datos
        reader.readAsDataURL(file);
      }
    });
  }

  informacionPrivada() {

    // // Verificar si el formulario existe antes de agregar el evento
    // let $informacionPrivada = $('#informacionPrivada');

    // if ($informacionPrivada.length) {
    //   $informacionPrivada.on('submit', function (e) {
    //     e.preventDefault(); // Freno Submit o Envío

    //     // Obtener valores de los campos
    //     let id = $('#id').val();
    //     let nombre = $('#nombre').val();
    //     let apellido = $('#apellido').val();
    //     let email = $('#email').val();
    //     let direccion = $('#direccion').val();
    //     let ciudad = $('#ciudad').val();
    //     let codigoPostal = $('#codigoPostal').val();
    //     let pais = $('#pais').find('option:selected').text(); // Obtener el texto del select

    //     // Validación
    //     let valid = true;

    //     // Función para mostrar los mensajes de error
    //     function mostrarMensajeError(claseInput, mensaje) {
    //       $(`.${claseInput} span`).html(mensaje);
    //     }

    //     // Realizamos la validación de los campos
    //     if (!nombre) {
    //       mostrarMensajeError('errorNombre', 'Ingrese Nombre');
    //       valid = false;
    //     } else {
    //       mostrarMensajeError('errorNombre', '');
    //     }

    //     if (!apellido) {
    //       mostrarMensajeError('errorApellido', 'Ingrese Apellidos');
    //       valid = false;
    //     } else {
    //       mostrarMensajeError('errorApellido', '');
    //     }

    //     if (!email) {
    //       mostrarMensajeError('errorEmail', 'Ingrese Email');
    //       valid = false;
    //     } else {
    //       mostrarMensajeError('errorEmail', '');
    //     }

    //     if (!direccion) {
    //       mostrarMensajeError('errorDireccion', 'Ingrese Dirección');
    //       valid = false;
    //     } else {
    //       mostrarMensajeError('errorDireccion', '');
    //     }

    //     if (!codigoPostal) {
    //       mostrarMensajeError('errorCodigoPostal', 'Ingrese Codigo Postal');
    //       valid = false;
    //     } else {
    //       mostrarMensajeError('errorCodigoPostal', '');
    //     }

    //     // Si alguna validación falla, se detiene el proceso
    //     if (!valid) return;

    //     // Realizar el envío del formulario mediante AJAX
    //     $.ajax({
    //       type: 'POST',
    //       url: baseUrl + 'Usuario/informacionPrivada',
    //       data: {
    //         id: id,
    //         nombre: nombre,
    //         apellido: apellido,
    //         email: email,
    //         direccion: direccion,
    //         pais: pais,
    //         ciudad: ciudad,
    //         codigoPostal: codigoPostal
    //       },
    //       success: function (response) {
    //         $("#respuestaPhpInformacionPrivada").html(response);
    //         if (response == 1) {
    //           Swal.fire({
    //             title: "Completado",
    //             icon: "success",
    //             timer: 500,
    //             showConfirmButton: false
    //           });
    //         }
    //       },
    //       error: function (xhr, status, error) {
    //         console.error("Error en la solicitud AJAX:", status, error);
    //         $("#respuestaPhpInformacionPrivada").html("Ocurrió un error al procesar la solicitud.");
    //       }
    //     });
    //   });
    // }
  }

  codidoPaises() {
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

    mostrarCodigoPaises();
  }

  // Método customUser
  customUser() {
    this.registro();
    this.iniciarSesion();
    // this.informacionPublica();
    this.avatarVistaPrevia(); // Problema
    // this.informacionPrivada(); // Problema
    // this.codidoPaises(); // Problema
  }

  // Iniciar aplicación
  init() {
    this.onReady();
  }
}

// Instanciamos e iniciamos
const app = new User();
app.init();