<?php
require_once 'model/usuario.php';

class CategoriaController
{
  public function Crear()
  {
    //Acceso Usuario Registrado
    Utils::accesoUsuarioRegistrado();

    //El Objeto Usuario Esta Disponible en toda la Pagina
    if (isset($_SESSION['usuarioRegistrado']->Id)) {
      if (isset($_SESSION['usuarioRegistrado']->Id)) {
        $obtenertodos = new usuario;
        $obtenertodos->setId($_SESSION['usuarioRegistrado']->Id);
        $usuario = $obtenertodos->obtenerTodosPorId();
      }
    }
    require_once 'views/layout/header.php';
    require_once 'views/layout/banner.php';
    require_once 'views/layout/nav.php';
    require_once 'views/layout/search.php';
    require_once 'views/layout/sidebarAdministrativo.php';

    require_once 'views/categoria/crear.php';

    require_once 'views/layout/footer.php';
  }
}
