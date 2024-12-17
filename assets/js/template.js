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
    paypals.minicarts.render();

    paypals.minicarts.cart.on('checkout', function (evt) {
      var items = this.items(),
        len = items.length,
        total = 0,
        i;

      // Count the number of each item in the cart
      for (i = 0; i < len; i++) {
        total += items[i].get('quantity');
      }

      // if (total < 3) {
      //   alert('The minimum order quantity is 3. Please add more to your shopping cart before checking out');
      //   evt.preventDefault();
      // }
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
  }
}

const appTemplate = new Template();
appTemplate.init();