<?php
require_once 'model/usuario.php';

class HomeController
{
    public function index()

    {
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
