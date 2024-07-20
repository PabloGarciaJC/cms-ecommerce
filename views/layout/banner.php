<body>

  <!-- top-header -->
  <div class="agile-main-top">
    <div class="container-fluid">
      <div class="row main-top-w3l py-2">
        <div class="col-lg-4 header-most-top">
          <p class="text-white text-lg-left text-center">Las Mejores Ofertas y Descuentos en Verano
            <i class="fas fa-shopping-cart ml-1"></i>
          </p>
        </div>
        <div class="col-lg-8 header-right mt-lg-0 mt-2">
          <!-- header lists -->
          <ul>
            <li class="text-center border-right text-white">
              <a class="play-icon popup-with-zoom-anim text-white" href="#small-dialog1">
            </li>
            <li class="text-center border-right text-white">
              <a href="#" data-toggle="modal" data-target="#exampleModal" class="text-white"></a>
            </li>
            <li class="text-center border-right text-white">
              <i class="fas fa-phone mr-2"></i> 001 234 5678
            </li>

            <li class="text-center border-right text-white">
              <a href="#" data-toggle="modal" data-target="#exampleModal" class="text-white">

                <?php if (isset($_SESSION['usuarioRegistrado'])) : ?>
                  <a href="<?= BASE_URL ?>usuario/informacionGeneral" class="estilosSesionRegistro">Hola, <?= $usuario->Usuario ?></a>
                <?php else : ?>
                  <i class="fas fa-sign-in-alt mr-2"></i> Hola, Identificate </a>
            <?php endif; ?>

            </li>
            <li class="text-center text-white">
              <a href="#" data-toggle="modal" data-target="#exampleModal2" class="text-white">
                <i class="fas fa-sign-out-alt mr-2"></i>Registro </a>
            </li>
          </ul>
          <!-- //header lists -->
        </div>
      </div>
    </div>
  </div>

  <!-- Button trigger modal(select-location) -->

  <!-- //shop locator (popup) -->
  <!-- modals -->
  <!-- log in -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center">Inicia sesión</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="" id="mdFormularioIniciarSesion" method="POST">
            <!-- respuesta ajax php -->
            <div id="respuestaPhpIniciarSesion" style="text-align: center; display: none"></div>

            <div class="form-group">
              <label class="col-form-label">Dirección de e-mail</label>
              <input type="text" id="mdEmailIniciarSesion" class="form-control" name="Name">
              <div id="mdErrorEmailIniciarSesionPhp" style="color: red;"></div>
            </div>
            <div class="form-group">
              <label class="col-form-label">Contraseña</label>
              <input type="password" id="mdPasswordIniciarSesion" class="form-control" name="Password">
              <div id="mdErrorPasswordIniciarSesionPhp" style="color: red;"></div>
            </div>
            <div class="right-w3l">
              <input type="submit" class="form-control" value="Continuar">
            </div>
            <p class="text-center dont-do mt-3">¿No tienes una cuenta?
              <a href="#" data-toggle="modal" data-target="#exampleModal2">
                Regístrate ahora</a>
            </p>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- register -->
  <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Registro</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <form action="" method="POST" id="mdFormularioRegistro">

            <!-- respuesta ajax php -->
            <div id="respuestaPhpRegistro" style="text-align: center; display: none"></div>

            <div class="form-group cErrorUsuario">
              <label class="col-form-label ">Alias</label>
              <input type="text" class="form-control" id="mdUsuarioRegistro" name="usuario">
              <div id="mdErrorUsuarioPhp" style="color: red;"></div>
            </div>

            <div class="form-group cErrorEmail">
              <label class="col-form-label">Email</label>
              <input type="text" class="form-control" id="mdEmailRegistro" name="email">
              <div id="mdErrorEmailPhp" style="color: red;"></div>
            </div>

            <div class="form-group cErrorPassword">
              <label class="col-form-label ">Contraseña</label>
              <input type="password" class="form-control" id="mdPasswordRegistro" name="password">
              <div id="mdErrorPasswordPhp" style="color: red;"></div>
            </div>

            <div class="form-group cErrorConfirmarPassword">
              <label class="col-form-label ">Confirma Contraseña</label>
              <input type="password" class="form-control" id="mdConfirmarPasswordRegistro" name="confirmarPassword">
              <div id="mdErrorConfirmarPasswordPhp" style="color: red;"></div>
            </div>

            <div class="sub-w3l cErrorChecked">
              <div class="custom-control custom-checkbox mr-sm-2 ">
                <input type="checkbox" class="custom-control-input" id="mdCheckedRegistro" name="checked">
                <label class="custom-control-label" for="mdCheckedRegistro">Acepto los Términos y Condiciones</label>
              </div>
              <div id="mdErrorChekedPhp" style="color: red;"></div>
            </div>

            <div class="right-w3l">
              <input type="submit" class="form-control" value="Aceptar">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- //modal -->
  <!-- //top-header -->