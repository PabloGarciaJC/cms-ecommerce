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
        let file = event.target.files[0];
        let $preview = $('#avatarPreview');

        if (file) {
          let reader = new FileReader();
          reader.onload = function (e) {
            $preview.attr('src', e.target.result).show();
          };
          reader.readAsDataURL(file);
        } else {
          $preview.attr('src', '').hide();
        }
      });
    }

    function changeMulti() {
      let imageFiles = [];

      // Función para manejar el cambio de imágenes y la vista previa
      function handleImageChange(inputSelector) {
        $('input[type="file"]').on('change', function (event) {
          var previewContainer = $('#imagePreview-' + this.id.split('-')[1]);
          previewContainer.empty();
          $.each(this.files, function (index, file) {
            var reader = new FileReader();
            reader.onload = function (e) {
              var img = $('<img>').attr('src', e.target.result).addClass('panel-admin__image-thumbnail');
              previewContainer.append(img);
            };
            reader.readAsDataURL(file);
          });
        });

      }

      handleImageChange('#productImages');
    }

    changeIndividual();
    changeMulti();
  }

  mostrarPassword() {
    // Escuchar el clic en los botones de toggle-password
    $('.toggle-password').on('click', function () {
      // Obtener el campo de entrada que se desea cambiar
      let input = $($(this).data('target'));  // Usamos data-target para seleccionar el campo de contraseña correspondiente
      let type = input.attr('type') === 'password' ? 'text' : 'password';  // Cambiar entre tipo 'password' y 'text'
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
    let observerOptions = {
      threshold: 0.01,                 // Detecta cuando el 1% del elemento es visible
      rootMargin: "-500px 0px 0px 0px" // Comienza a detectar 500px antes de que el elemento entre en el viewport
    };

    // Crea el Intersection Observer con las opciones configuradas
    let observer = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          // Agrega la clase de animación
          entry.target.classList.add(`animation__slide--${direction}`);

          // Escucha el fin de la animación antes de quitar la clase
          entry.target.addEventListener('animationend', function () {
            entry.target.classList.remove(`animation__slide--${direction}`);
          }, { once: true });  // `once: true` asegura que el listener se ejecute solo una vez

          // Deja de obserlet el elemento para que la animación solo se ejecute una vez
          observer.unobserve(entry.target);
        }
      });
    }, observerOptions);  // Usa las opciones en el observer

    // Observa cada elemento seleccionado
    targets.forEach(target => observer.observe(target));
  };

  initAnimationLeftRight = function (containerSelector) {
    let container = document.querySelector(containerSelector);

    if (!container) return;

    // Verificar si ya se han aplicado animaciones al contenedor
    if (container.classList.contains('animations-applied')) return;

    // Seleccionar todos los elementos .banner-wrapper dentro del contenedor
    let bannerWrappers = container.querySelectorAll('.banner-wrapper');

    // Función para aplicar animación a cada elemento
    let applyAnimation = (element, index) => {
      // Aplica animación desde la izquierda o derecha dependiendo del índice
      if (index % 2 === 0) {
        element.classList.add('animation__slide--left');
      } else {
        element.classList.add('animation__slide--right');
      }
    };

    // Crear un Intersection Observer para detectar cuando el elemento entra en el viewport
    let observer = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          let index = Array.from(bannerWrappers).indexOf(entry.target);
          applyAnimation(entry.target, index); // Aplica la animación

          // Marcar el elemento como animado para evitar reanimaciones
          entry.target.classList.add('animation-applied');
          // Dejar de obserlet este elemento después de la animación
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
    // this.select2();

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

    // Select de Idiomas
    let $selectSelected = $('.select-selected');
    let $selectItems = $('.select-items');
    let $selectedLanguageInput = $('#selected-language');
    let $languageForm = $('#language-form');
    let $selectArrow = $('.select-arrow');

    if ($selectSelected.length && $selectItems.length && $selectedLanguageInput.length && $languageForm.length && $selectArrow.length) {
      $selectSelected.on('click', function () {
        let isExpanded = $selectItems.hasClass('show');
        $selectItems.toggleClass('show', !isExpanded);
        $selectArrow.toggleClass('down', !isExpanded);
      });

      $selectItems.on('click', function (event) {
        let $selectedOption = $(event.target).closest('div');
        if ($selectedOption.length) {
          let value = $selectedOption.data('value');
          let imgSrc = $selectedOption.find('img').attr('src');
          let text = $selectedOption.text().trim();

          $selectSelected.html('<div><img src="' + imgSrc + '" alt="selected-language">' + text + '</div><div class="select-arrow">&#9662;</div>');
          $selectedLanguageInput.val(value);
          $languageForm.submit();
        }
      });

      $(document).on('click', function (event) {
        if (!$selectSelected.is(event.target) && !$selectItems.is(event.target) && !$selectSelected.has(event.target).length && !$selectItems.has(event.target).length) {
          $selectItems.removeClass('show');
          $selectArrow.removeClass('down');
        }
      });
    }

    // Cambiar de pestaña cuando se haga clic en los Tabs de Reseña, Ficha Producto
    document.querySelectorAll('.ficha-producto__tab').forEach(tab => {
      tab.addEventListener('click', function () {
        // Desactilet todas las pestañas
        document.querySelectorAll('.ficha-producto__tab').forEach(t => t.classList.remove('ficha-producto__tab--active'));
        document.querySelectorAll('.ficha-producto__tab-content').forEach(content => content.classList.remove('ficha-producto__tab-content--active'));
        // Actilet la pestaña seleccionada
        this.classList.add('ficha-producto__tab--active');
        document.getElementById(this.id.replace('-tab', '-content')).classList.add('ficha-producto__tab-content--active');
      });
    });

    // Campo de Pestaña Panel Administrativo
    $('#languageTabs a').on('click', function (e) {
      e.preventDefault();
      $(this).tab('show');
    });

    // Función para mostrar imágenes en vista previa
    $("#categoriaImages").on('change', function () {
      var files = $(this)[0].files;
      $('#imagePreview').empty();
      if (files.length > 0) {
        $.each(files, function (index, file) {
          var reader = new FileReader();
          reader.onload = function (e) {
            $('#imagePreview').append('<div class="panel-admin__image-container"><img src="' + e.target.result + '" class="panel-admin__image-thumbnail" /></div>');
          };
          reader.readAsDataURL(file);
        });
      }
    });

    // Carrito de Compras en Checkout 
    let buttonsIncrease = document.querySelectorAll('.btn-increase');
    let buttonsDecrease = document.querySelectorAll('.btn-decrease');
    let totalPriceElement = document.getElementById('total-price');

    // Actualizar el total
    function updateTotal() {
      let total = 0;
      document.querySelectorAll('.price-item').forEach(function (priceItem) {
        total += parseFloat(priceItem.textContent.replace('$', '').replace(',', ''));
      });
      totalPriceElement.textContent = '$' + total.toFixed(2);
    }

    // Incrementar cantidad
    buttonsIncrease.forEach(button => {
      button.addEventListener('click', function () {
        let index = this.getAttribute('data-index');
        let quantitySpan = document.querySelector('.quantity-value[data-index="' + index + '"]');
        let quantity = parseInt(quantitySpan.textContent);
        quantity++;
        quantitySpan.textContent = quantity;

        // Actualizar valor en el input hidden
        let hiddenQuantityInput = document.getElementById('quantity-' + index);
        hiddenQuantityInput.value = quantity;

        // Actualizar el precio por artículo
        let pricePerItem = document.querySelector('.price-per-item[data-index="' + index + '"]');
        let price = parseFloat(pricePerItem.value);
        let priceItemSpan = document.querySelector('.price-item[data-index="' + index + '"]');
        priceItemSpan.textContent = (price * quantity).toFixed(2);

        // Actualizar el total
        updateTotal();
      });
    });

    // Decrementar cantidad
    buttonsDecrease.forEach(button => {
      button.addEventListener('click', function () {
        let index = this.getAttribute('data-index');
        let quantitySpan = document.querySelector('.quantity-value[data-index="' + index + '"]');
        let quantity = parseInt(quantitySpan.textContent);
        if (quantity > 1) {
          quantity--;
          quantitySpan.textContent = quantity;

          // Actualizar valor en el input hidden
          let hiddenQuantityInput = document.getElementById('quantity-' + index);
          hiddenQuantityInput.value = quantity;

          // Actualizar el precio por artículo
          let pricePerItem = document.querySelector('.price-per-item[data-index="' + index + '"]');
          let price = parseFloat(pricePerItem.value);
          let priceItemSpan = document.querySelector('.price-item[data-index="' + index + '"]');
          priceItemSpan.textContent = (price * quantity).toFixed(2);

          // Actualizar el total
          updateTotal();
        }
      });
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