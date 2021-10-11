<?php
require_once 'model/usuario.php';
require_once 'model/paises.php';

class HomeController
{
    public function index()
    {
        //El Objeto Usuario Esta  Disponible en toda la Pagina
        if (isset($_SESSION['usuarioRegistrado']->Id)) {
            $obtenertodos = new usuario;
            $obtenertodos->setId($_SESSION['usuarioRegistrado']->Id);
            $usuario = $obtenertodos->obtenerTodosPorId();
        }
        require_once 'views/layout/header.php';
        require_once 'views/layout/banner.php';
        require_once 'views/layout/nav.php';
        require_once 'views/layout/search.php';
        require_once 'views/home/slider.php';
        require_once 'views/home/contentIndex.php';
        require_once 'views/layout/footer.php';
    }

    public function electronica()
    {
        //El Objeto Usuario Esta  Disponible en toda la Pagina
        if (isset($_SESSION['usuarioRegistrado']->Id)) {
            $obtenertodos = new usuario;
            $obtenertodos->setId($_SESSION['usuarioRegistrado']->Id);
            $usuario = $obtenertodos->obtenerTodosPorId();
        }
        require_once 'views/layout/header.php';
        require_once 'views/layout/banner.php';
        require_once 'views/layout/nav.php';
        require_once 'views/layout/search.php';
        require_once 'views/home/contentElectronics.php';
        require_once 'views/layout/footer.php';
    }

    public function accesorios()
    {
        //El Objeto Usuario Esta  Disponible en toda la Pagina
        if (isset($_SESSION['usuarioRegistrado']->Id)) {
            $obtenertodos = new usuario;
            $obtenertodos->setId($_SESSION['usuarioRegistrado']->Id);
            $usuario = $obtenertodos->obtenerTodosPorId();
        }
        require_once 'views/layout/header.php';
        require_once 'views/layout/banner.php';
        require_once 'views/layout/nav.php';
        require_once 'views/layout/search.php';
        require_once 'views/home/contentAppliances.php';
        require_once 'views/layout/footer.php';
    }

    public function sobreNosotros()
    {
        //El Objeto Usuario Esta  Disponible en toda la Pagina
        if (isset($_SESSION['usuarioRegistrado']->Id)) {
            $obtenertodos = new usuario;
            $obtenertodos->setId($_SESSION['usuarioRegistrado']->Id);
            $usuario = $obtenertodos->obtenerTodosPorId();
        }
        require_once 'views/layout/header.php';
        require_once 'views/layout/banner.php';
        require_once 'views/layout/nav.php';
        require_once 'views/layout/search.php';
        require_once 'views/home/aboutUs.php';
        require_once 'views/layout/footer.php';
    }

    public function contactanos()
    {
        //El Objeto Usuario Esta  Disponible en toda la Pagina
        if (isset($_SESSION['usuarioRegistrado']->Id)) {
            $obtenertodos = new usuario;
            $obtenertodos->setId($_SESSION['usuarioRegistrado']->Id);
            $usuario = $obtenertodos->obtenerTodosPorId();
        }
        require_once 'views/layout/header.php';
        require_once 'views/layout/banner.php';
        require_once 'views/layout/nav.php';
        require_once 'views/layout/search.php';
        require_once 'views/home/contactUs.php';
        require_once 'views/layout/footer.php';
    }
}
