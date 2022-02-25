  <!-- footer -->
  <footer>
    <div class="footer-top-first">
      <div class="container py-md-5 py-sm-4 py-3">
        <!-- footer second section -->
        <div class="row w3l-grids-footer border-top border-bottom py-sm-4 py-3">
          <div class="col-md-4 offer-footer">
            <div class="row">
              <div class="col-4 icon-fot">
                <i class="fas fa-dolly"></i>
              </div>
              <div class="col-8 text-form-footer">
                <h3>Envío gratis</h3>
                <p>en pedidos superiores a $ 100</p>
              </div>
            </div>
          </div>
          <div class="col-md-4 offer-footer my-md-0 my-4">
            <div class="row">
              <div class="col-4 icon-fot">
                <i class="fas fa-shipping-fast"></i>
              </div>
              <div class="col-8 text-form-footer">
                <h3>Entrega rápida</h3>
                <p>Mundial</p>
              </div>
            </div>
          </div>
          <div class="col-md-4 offer-footer">
            <div class="row">
              <div class="col-4 icon-fot">
                <i class="far fa-thumbs-up"></i>
              </div>
              <div class="col-8 text-form-footer">
                <h3>Gran Elección</h3>
                <p>de productos</p>
              </div>
            </div>
          </div>
        </div>
        <!-- //footer second section -->
      </div>
    </div>
    <!-- footer third section -->
    <div class="w3l-middlefooter-sec">
      <div class="container py-md-5 py-sm-4 py-3">
        <div class="row footer-info w3-agileits-info">
          <!-- footer categories -->
          <div class="col-md-3 col-sm-6 footer-grids">
            <h3 class="text-white font-weight-bold mb-3">Categories</h3>
            <ul>
              <li class="mb-3">
                <a href="product.html">Mobiles </a>
              </li>
              <li class="mb-3">
                <a href="product.html">Computers</a>
              </li>
              <li class="mb-3">
                <a href="product.html">TV, Audio</a>
              </li>
              <li class="mb-3">
                <a href="product2.html">Smartphones</a>
              </li>
              <li class="mb-3">
                <a href="product.html">Washing Machines</a>
              </li>
              <li>
                <a href="product2.html">Refrigerators</a>
              </li>
            </ul>
          </div>
          <!-- //footer categories -->
          <!-- quick links -->
          <div class="col-md-3 col-sm-6 footer-grids mt-sm-0 mt-4">
            <h3 class="text-white font-weight-bold mb-3">Quick Links</h3>
            <ul>
              <li class="mb-3">
                <a href="about.html">About Us</a>
              </li>
              <li class="mb-3">
                <a href="contact.html">Contact Us</a>
              </li>
              <li class="mb-3">
                <a href="help.html">Help</a>
              </li>
              <li class="mb-3">
                <a href="faqs.html">Faqs</a>
              </li>
              <li class="mb-3">
                <a href="terms.html">Terms of use</a>
              </li>
              <li>
                <a href="privacy.html">Privacy Policy</a>
              </li>
            </ul>
          </div>
          <div class="col-md-3 col-sm-6 footer-grids mt-md-0 mt-4">
            <h3 class="text-white font-weight-bold mb-3">Get in Touch</h3>
            <ul>
              <li class="mb-3">
                <i class="fas fa-map-marker"></i> 123 Sebastian, USA.
              </li>
              <li class="mb-3">
                <i class="fas fa-mobile"></i> 333 222 3333
              </li>
              <li class="mb-3">
                <i class="fas fa-phone"></i> +222 11 4444
              </li>
              <li class="mb-3">
                <i class="fas fa-envelope-open"></i>
                <a href="mailto:example@mail.com"> mail 1@example.com</a>
              </li>
              <li>
                <i class="fas fa-envelope-open"></i>
                <a href="mailto:example@mail.com"> mail 2@example.com</a>
              </li>
            </ul>
          </div>
          <div class="col-md-3 col-sm-6 footer-grids w3l-agileits mt-md-0 mt-4">
            <!-- newsletter -->
            <h3 class="text-white font-weight-bold mb-3">Newsletter</h3>
            <p class="mb-3">Free Delivery on your first order!</p>
            <form action="#" method="post">
              <div class="form-group">
                <input type="email" class="form-control" placeholder="Email" name="email" required="">
                <input type="submit" value="Go">
              </div>
            </form>
            <!-- //newsletter -->
            <!-- social icons -->
            <div class="footer-grids  w3l-socialmk mt-3">
              <h3 class="text-white font-weight-bold mb-3">Follow Us on</h3>
              <div class="social">
                <ul>
                  <li>
                    <a class="icon fb" href="#">
                      <i class="fab fa-facebook-f"></i>
                    </a>
                  </li>
                  <li>
                    <a class="icon tw" href="#">
                      <i class="fab fa-twitter"></i>
                    </a>
                  </li>
                  <li>
                    <a class="icon gp" href="#">
                      <i class="fab fa-google-plus-g"></i>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
            <!-- //social icons -->
          </div>
        </div>
        <!-- //quick links -->
      </div>
    </div>
    <!-- //footer third section -->
  </footer>
  <!-- //footer -->
  <!-- copyright -->
  <div class="copy-right py-3">
    <div class="container">
      <p class="text-center text-white"> Desarrollado por © <strong>Pablo Garcia JC</strong></p>
    </div>
  </div>
  <!-- //copyright -->

  <!-- js-files -->
  <!-- jquery -->
  <script src="<?= base_url ?>assets/js/librerias/jquery-2.2.3.min.js"></script>
  <!-- //jquery -->
  <!-- nav smooth scroll -->
  <script>
    $(document).ready(function() {
      $(".dropdown").hover(
        function() {
          $('.dropdown-menu', this).stop(true, true).slideDown("fast");
          $(this).toggleClass('open');
        },
        function() {
          $('.dropdown-menu', this).stop(true, true).slideUp("fast");
          $(this).toggleClass('open');
        }
      );
    });
  </script>
  <!-- //nav smooth scroll -->

  <!-- popup modal (for location)-->
  <script src="<?= base_url ?>assets/js/librerias/jquery.magnific-popup.js"></script>
  <script>
    $(document).ready(function() {
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
  </script>
  <!-- //popup modal (for location)-->

  <!-- cart-js -->
  <script src="<?= base_url ?>assets/js/librerias/minicart.js"></script>

  <!-- Descripcion -->

  <!-- flexslider -->
  <link rel="stylesheet" href="<?= base_url ?>assets/css/flexslider.css" type="text/css" media="screen" />
  <script src="<?= base_url ?>assets/js/librerias/jquery.flexslider.js"></script>
  <script>
    // Can also be used with $(document).ready()
    $(window).load(function() {
      $('.flexslider').flexslider({
        animation: "slide",
        controlNav: "thumbnails"
      });
    });
  </script>
  <!-- //FlexSlider-->
  <!-- //Descripcion -->

  <!-- smoothscroll -->
  <script src="<?= base_url ?>assets/js/librerias/SmoothScroll.min.js"></script>
  <!-- //smoothscroll -->

  <!-- start-smooth-scrolling -->
  <script src="<?= base_url ?>assets/js/librerias/move-top.js"></script>
  <script src="<?= base_url ?>assets/js/librerias/easing.js"></script>
  <script>
    jQuery(document).ready(function($) {
      $(".scroll").click(function(event) {
        event.preventDefault();

        $('html,body').animate({
          scrollTop: $(this.hash).offset().top
        }, 1000);
      });
    });
  </script>
  <!-- //end-smooth-scrolling -->

  <!-- smooth-scrolling-of-move-up -->
  <script>
    $(document).ready(function() {

      var defaults = {
        containerID: 'toTop', // fading element id
        containerHoverID: 'toTopHover', // fading element hover id
        scrollSpeed: 1200,
        easingType: 'linear'
      };

      $().UItoTop({
        easingType: 'easeOutQuart'
      });

    });
  </script>
  <!-- //smooth-scrolling-of-move-up -->
  <!-- for bootstrap working -->
  <script src="<?= base_url ?>assets/js/librerias/bootstrap.js"></script>
  <!-- //for bootstrap working -->

  <!-- libreria de alert sweetAlert2-->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- //libreria de sweetAlert2 -->

  <!-- Iniciar Sesion y Registro AJAX y Validaciones con PHP -->
  <script src="<?= base_url ?>assets/js/config/parameters.js"></script>
  <script src="<?= base_url ?>assets/js/repositorio/usuario/registro.js"></script>
  <script src="<?= base_url ?>assets/js/repositorio/usuario/iniciarSesion.js"></script>

  <!-- Usuario -->
  <script src="<?= base_url ?>assets/js/repositorio/usuario/avatarVistaPrevia.js"></script>
  <script src="<?= base_url ?>assets/js/repositorio/usuario/informacionPublica.js"></script>
  <script src="<?= base_url ?>assets/js/repositorio/usuario/informacionPrivada.js"></script>
  <script src="<?= base_url ?>assets/js/repositorio/usuario/ciudad.js"></script>

  <!-- Categoria -->
  <script src="<?= base_url ?>assets/js/repositorio/categoria/obtenerDatosEditar.js"></script>
  <script src="<?= base_url ?>assets/js/repositorio/categoria/editar.js"></script>
  <script src="<?= base_url ?>assets/js/repositorio/categoria/eliminar.js"></script>
  <script src="<?= base_url ?>assets/js/repositorio/categoria/listar.js"></script>

  <!-- Producto -->
  <script src="<?= base_url ?>assets/js/repositorio/producto/crear.js"></script>
  <script src="<?= base_url ?>assets/js/repositorio/producto/eliminar.js"></script>
  <script src="<?= base_url ?>assets/js/repositorio/producto/mostrarTodos.js"></script>
  <script src="<?= base_url ?>assets/js/repositorio/producto/buscador.js"></script>
  <script src="<?= base_url ?>assets/js/repositorio/producto/imagen.js"></script>

  <!-- Carrito Compras -->
  <script src="<?= base_url ?>assets/js/repositorio/carritoCompras/borrar.js"></script>
  <script src="<?= base_url ?>assets/js/repositorio/carritoCompras/mostrar.js"></script>
  <script src="<?= base_url ?>assets/js/repositorio/carritoCompras/carritoUp.js"></script>
  <script src="<?= base_url ?>assets/js/repositorio/carritoCompras/carritoDown.js"></script>
  <script src="<?= base_url ?>assets/js/repositorio/carritoCompras/confimarPedido.js"></script>

  <!-- Pedidos -->
  <script src="<?= base_url ?>assets/js/repositorio/pedidos/editarPedidos.js"></script>
  <script src="<?= base_url ?>assets/js/repositorio/pedidos/mostrar.js"></script>

  <!-- Autocompletado Buscador General-->
  <script src="<?= base_url ?>assets/js/librerias/jquery-ui.js"></script>
  <script src="<?= base_url ?>assets/js/repositorio/autocompletado/autocompletado.js"></script>
  <script src="<?= base_url ?>assets/js/repositorio/autocompletado/mostrar.js"></script>
  <script>
    autocompletado(<?= isset($jsonMostrar) ? $jsonMostrar :false ?>);
  </script>

  </html>