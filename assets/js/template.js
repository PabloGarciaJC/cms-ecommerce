class Template {

  onReady() {
    this.customTemplate();
  }

  templateCustom() {

    /*  	<!-- popup modal (for location)--> */
    $(document).ready(function () {
      $('.popup-with-zoom-anim').magnificPopup({
        type: 'inline',
        fixedContentPos: false,
        fixedBgPos: true,
        overflowY: 'auto',
        closeBtnInside: true,
        preloader: false,
        midClick: true,
        removalDelay: 300,
        mainClass: 'my-mfp-zoom-in'
      });

    });

    /*  <!-- cart-js --> */
    paypals.minicarts.render(); //use only unique class names other than paypals.minicarts.Also Replace same class name in css and minicart.min.js

    paypals.minicarts.cart.on('checkout', function (evt) {
      var items = this.items(),
        len = items.length,
        total = 0,
        i;

      // Count the number of each item in the cart
      for (i = 0; i < len; i++) {
        total += items[i].get('quantity');
      }

    });

    $(document).ready(function () {
      $('.close').on('click', function () {
        // Busca la fila más cercana al botón clickeado y la desvanece
        $(this).closest('tr').fadeOut('slow', function () {
          $(this).remove(); // Elimina la fila del DOM después de que desaparezca
        });
      });
    });

    $('.value-plus').on('click', function () {
      var divUpd = $(this).parent().find('.value'),
        newVal = parseInt(divUpd.text(), 10) + 1;
      divUpd.text(newVal);
    });

    $('.value-minus').on('click', function () {
      var divUpd = $(this).parent().find('.value'),
        newVal = parseInt(divUpd.text(), 10) - 1;
      if (newVal >= 1) divUpd.text(newVal);
    });

    // Can also be used with $(document).ready() // par Ficha Producto
    $(window).load(function () {
      $('.flexslider').flexslider({
        animation: "slide",
        controlNav: "thumbnails"
      });
    });

    /*    <!-- start-smooth-scrolling --> */
    jQuery(document).ready(function ($) {
      $(".scroll").click(function (event) {
        event.preventDefault();

        $('html,body').animate({
          scrollTop: $(this.hash).offset().top
        }, 1000);
      });
    });

    /*  <!-- smooth-scrolling-of-move-up --> */
    $(document).ready(function () {
      $().UItoTop({
        easingType: 'easeOutQuart'
      });

    });
  }

  // Método customTemplate
  customTemplate() {
    this.templateCustom();
    /* Admin */
    // Detectar clic en los enlaces principales
    $(".panel-admin__menu-list > .panel-admin__menu-item > .panel-admin__menu-link").click(function (e) {
      e.preventDefault(); // Prevenir comportamiento predeterminado
      // Alternar submenú y flecha
      $(this).next(".panel-admin__submenu").slideToggle(); // Desplegar/ocultar el submenú
      $(this).find(".fa-chevron-right").toggleClass("rotate"); // Rotar flecha
      // Cerrar otros submenús y reiniciar flechas
      $(".panel-admin__submenu").not($(this).next(".panel-admin__submenu")).slideUp(); // Cerrar otros submenús
      $(".fa-chevron-right").not($(this).find(".fa-chevron-right")).removeClass("rotate"); // Reiniciar flechas
    });
  }

  // Iniciar aplicación
  init() {
    this.onReady();

    /* Carrtio de Compras */
    document.addEventListener('click', function (event) {
      // Aumentar cantidad
      if (event.target.classList.contains('quantity-increment')) {
        const idx = event.target.getAttribute('data-minicarts-idx');
        const input = document.querySelector(`input[data-minicarts-idx="${idx}"]`);
        input.value = parseInt(input.value || 0, 10) + 1; // Incrementar el valor
      }

      // Disminuir cantidad
      if (event.target.classList.contains('quantity-decrement')) {
        const idx = event.target.getAttribute('data-minicarts-idx');
        const input = document.querySelector(`input[data-minicarts-idx="${idx}"]`);
        input.value = Math.max(1, parseInt(input.value || 1, 10) - 1); // Reducir el valor pero mantener mínimo 1
      }
    });

  }
}

const appTemplate = new Template();
appTemplate.init();