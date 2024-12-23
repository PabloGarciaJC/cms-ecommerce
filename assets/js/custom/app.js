class App {

  onReady() {
    this.customApp();
  }

  mostrarCiudades() {
    function mostrarCodigoPaises() {
      $("#pais").change(function () {
        let pais = $("#pais").val();
        $.ajax({
          type: "POST",
          url: baseUrl + "ciudad/obtenerTodos",
          data: "pais=" + pais,
        })
          .done(function (response) {
            $("#ciudad").attr("disabled", false);
            $("#ciudad").html(response);
          })
      });
    }
    mostrarCodigoPaises();
  }

  avatarVistaPrevia() {

    function changeIndividual() {
      $('#avatar').on('change', function (event) {
        const file = event.target.files[0]; // Obtén el archivo seleccionado
        const $preview = $('#avatarPreview'); // El elemento de la vista previa de la imagen

        if (file) {
          const reader = new FileReader(); // Usamos FileReader para leer el archivo
          reader.onload = function (e) {
            $preview.attr('src', e.target.result).show(); // Actualiza el src de la vista previa y la muestra
          };
          reader.readAsDataURL(file); // Lee el archivo como una URL de datos
        } else {
          $preview.attr('src', '').hide(); // Si no hay archivo, oculta la vista previa
        }
      });

    }

    function changeMulti() {
      let imageFiles = [];

      // Función para manejar el cambio de imágenes y la vista previa
      function handleImageChange(inputSelector) {
        $(inputSelector).on('change', function (event) {
          const files = event.target.files;
          const $previewContainer = $('#imagePreview');
          $previewContainer.empty();  // Limpiar las vistas previas existentes

          // Limpiar el arreglo de archivos
          imageFiles = [];

          // Mostrar todas las imágenes seleccionadas
          $.each(files, function (i, file) {
            const reader = new FileReader();

            reader.onload = function (e) {
              const $imgContainer = $('<div>').addClass('panel-admin__image-container');
              const $imgElement = $('<img>')
                .attr('src', e.target.result)
                .addClass('panel-admin__image-thumbnail');

              // Añadir archivo al arreglo de archivos para gestión posterior
              imageFiles.push(file);

              // Añadir la imagen al contenedor
              $imgContainer.append($imgElement);
              $previewContainer.append($imgContainer);
            };

            reader.readAsDataURL(file);
          });
        });
      }

      // Llamamos a la función `handleImageChange` para cada selector
      handleImageChange('#productImages');
      handleImageChange('#categoriaImages');
    }


    changeIndividual();
    changeMulti();
  }

  mostrarPassword() {
    // Escuchar el clic en los botones de toggle-password
    $('.toggle-password').on('click', function () {
      // Obtener el campo de entrada que se desea cambiar
      const input = $($(this).data('target'));  // Usamos data-target para seleccionar el campo de contraseña correspondiente
      const type = input.attr('type') === 'password' ? 'text' : 'password';  // Cambiar entre tipo 'password' y 'text'
      input.attr('type', type);  // Actualizar el tipo de input

      // Cambiar el ícono del ojo según el estado
      $(this).html(type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>');
    });
  }

  autoHideAlert() {
    setTimeout(function () {
      $('.alert').fadeOut('slow', function () {
        $(this).remove();
      });
    }, 2000);
  }

  select2() {
    $('#subcategoria').select2({
      placeholder: "Seleccione...",
      allowClear: true
    });
  }

  // Método customApp
  customApp() {
    this.avatarVistaPrevia();
    this.mostrarCiudades();
    this.mostrarPassword();
    this.autoHideAlert();
    this.select2();

    let abierto = false;

    $('.panel-admin__menu-desplegable').click(function () {
      if (abierto) {
        $('.panel-admin__menu').animate({ left: '-300px' }, 300);
      } else {
        $('.panel-admin__menu').animate({ left: '0' }, 300);
      }
      abierto = !abierto;
    });

  }

  // Iniciar aplicación
  init() {
    this.onReady();
  }
}

// Instanciamos e iniciamos
const app = new App();
app.init();