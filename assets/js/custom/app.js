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

  applyAnimationsByDirection = function (containerSelector, direction) {
    // Selecciona todos los elementos que coinciden con el selector
    let targets = document.querySelectorAll(containerSelector);
    if (!targets.length) {
      return;
    }

    // Configuración del IntersectionObserver con threshold y rootMargin
    const observerOptions = {
      threshold: 0.01,                 // Detecta cuando el 1% del elemento es visible
      rootMargin: "-500px 0px 0px 0px" // Comienza a detectar 500px antes de que el elemento entre en el viewport
    };

    // Crea el Intersection Observer con las opciones configuradas
    const observer = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          // Agrega la clase de animación
          entry.target.classList.add(`animation__slide--${direction}`);

          // Escucha el fin de la animación antes de quitar la clase
          entry.target.addEventListener('animationend', function () {
            entry.target.classList.remove(`animation__slide--${direction}`);
          }, { once: true });  // `once: true` asegura que el listener se ejecute solo una vez

          // Deja de observar el elemento para que la animación solo se ejecute una vez
          observer.unobserve(entry.target);
        }
      });
    }, observerOptions);  // Usa las opciones en el observer

    // Observa cada elemento seleccionado
    targets.forEach(target => observer.observe(target));
  };

 initAnimationLeftRight = function (containerSelector) {
		const container = document.querySelector(containerSelector);

		if (!container) return;

		// Verificar si ya se han aplicado animaciones al contenedor
		if (container.classList.contains('animations-applied')) return;

		// Seleccionar todos los elementos .banner-wrapper dentro del contenedor
		const bannerWrappers = container.querySelectorAll('.banner-wrapper');

		// Función para aplicar animación a cada elemento
		const applyAnimation = (element, index) => {
			// Aplica animación desde la izquierda o derecha dependiendo del índice
			if (index % 2 === 0) {
				element.classList.add('animation__slide--left');
			} else {
				element.classList.add('animation__slide--right');
			}
		};

		// Crear un Intersection Observer para detectar cuando el elemento entra en el viewport
		const observer = new IntersectionObserver(entries => {
			entries.forEach(entry => {
				if (entry.isIntersecting) {
					const index = Array.from(bannerWrappers).indexOf(entry.target);
					applyAnimation(entry.target, index); // Aplica la animación

					// Mostrar el log cuando se detecta el elemento
					console.log(`Elemento ${entry.target} detectado. Índice: ${index}`);

					// Marcar el elemento como animado para evitar reanimaciones
					entry.target.classList.add('animation-applied');
					// Dejar de observar este elemento después de la animación
					observer.unobserve(entry.target);
				}
			});
		}, {
			threshold: 0.01, // Detectar cuando solo una pequeña parte (1%) del elemento es visible
			rootMargin: "-500px 0px 0px 0px" // Detectar el elemento 500px antes de que entre en el viewport
		});

		// Aplicar el observador a cada .banner-wrapper
		bannerWrappers.forEach(wrapper => {
			observer.observe(wrapper);
		});

		// Marcar el contenedor como con animaciones aplicadas para evitar duplicados
		container.classList.add('animations-applied');
	};

  // Método customApp
  customApp() {
    this.avatarVistaPrevia();
    this.mostrarCiudades();
    this.mostrarPassword();
    this.autoHideAlert();
    this.select2();

    // Menu Desplegable en version Movil para el Panel Administrativo
    let abierto = false;

    $('.panel-admin__menu-desplegable').click(function () {
      if (abierto) {
        $('.panel-admin__menu').animate({ left: '-300px' }, 300);
      } else {
        $('.panel-admin__menu').animate({ left: '0' }, 300);
      }
      abierto = !abierto;
    });

    // Animaciones para items Individuales
    this.applyAnimationsByDirection('.animation__left', 'left');
		this.applyAnimationsByDirection('.animation__right', 'right');
		this.applyAnimationsByDirection('.animation__fade-in-upscale', 'fade-in-upscale');
		this.applyAnimationsByDirection('.animation__up', 'up');
		this.applyAnimationsByDirection('.animation__down', 'down');

    // Animacion Left y Rigth en secuencia
		this.initAnimationLeftRight('.animation__left-right');

  }

  // Iniciar aplicación
  init() {
    this.onReady();
  }
}

// Instanciamos e iniciamos
const app = new App();
app.init();