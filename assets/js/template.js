class Template {

  onReady() {
    this.customTemplate();
  }

  tes() {

    /*  	<!-- nav smooth scroll --> */
    $(document).ready(function () {
      $(".dropdown").hover(
        function () {
          $('.dropdown-menu', this).stop(true, true).slideDown("fast");
          $(this).toggleClass('open');
        },
        function () {
          $('.dropdown-menu', this).stop(true, true).slideUp("fast");
          $(this).toggleClass('open');
        }
      );
    });

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

      if (total < 3) {
        alert('The minimum order quantity is 3. Please add more to your shopping cart before checking out');
        evt.preventDefault();
      }
    });

    /*  <!-- password-script --> */
    // window.onload = function () {
    //   document.getElementById("password1").onchange = validatePassword;
    //   document.getElementById("password2").onchange = validatePassword;
    // }

    // function validatePassword() {
    //   var pass2 = document.getElementById("password2").value;
    //   var pass1 = document.getElementById("password1").value;
    //   if (pass1 != pass2)
    //     document.getElementById("password2").setCustomValidity("Passwords Don't Match");
    //   else
    //     document.getElementById("password2").setCustomValidity('');
    //   //empty string means no validation error
    // }
    // Can also be used with $(document).ready()

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
      /*
      var defaults = {
        containerID: 'toTop', // fading element id
        containerHoverID: 'toTopHover', // fading element hover id
        scrollSpeed: 1200,
        easingType: 'linear' 
      };
      */
      $().UItoTop({
        easingType: 'easeOutQuart'
      });

    });
  }

  // Método customTemplate
  customTemplate() {
    this.tes();



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



    /* Tes */
 




  }

  // Iniciar aplicación
  init() {
    this.onReady();
  }
}

const appTemplate = new Template();
appTemplate.init();