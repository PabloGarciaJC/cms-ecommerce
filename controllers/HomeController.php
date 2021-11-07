<?php

class HomeController
{
    public function index()
    {
        //Obtengo Ususario en el Banner
        $usuario = Utils::obtenerUsuario();
        //Obtengo Categorias en la Barra de Navegacion
        $categoriaBarraNavegacion = Utils::listaCategorias();
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
        //Obtengo Ususario en el Banner
        $usuario = Utils::obtenerUsuario();
        //Obtengo Categorias en la Barra de Navegacion
        $categoriaBarraNavegacion = Utils::listaCategorias();
        require_once 'views/layout/header.php';
        require_once 'views/layout/banner.php';
        require_once 'views/layout/nav.php';
        require_once 'views/layout/search.php';
        require_once 'views/home/contentElectronics.php';
        require_once 'views/layout/footer.php';
    }

    public function accesorios()
    {
        //Obtengo Ususario en el Banner
        $usuario = Utils::obtenerUsuario();
        //Obtengo Categorias en la Barra de Navegacion
        $categoriaBarraNavegacion = Utils::listaCategorias();
        require_once 'views/layout/header.php';
        require_once 'views/layout/banner.php';
        require_once 'views/layout/nav.php';
        require_once 'views/layout/search.php';
        require_once 'views/home/contentAppliances.php';
        require_once 'views/layout/footer.php';
    }

    public function sobreNosotros()
    {
        //Obtengo Ususario en el Banner
        $usuario = Utils::obtenerUsuario();
        //Obtengo Categorias en la Barra de Navegacion
        $categoriaBarraNavegacion = Utils::listaCategorias();
        require_once 'views/layout/header.php';
        require_once 'views/layout/banner.php';
        require_once 'views/layout/nav.php';
        require_once 'views/layout/search.php';
        require_once 'views/home/aboutUs.php';
        require_once 'views/layout/footer.php';
    }

    public function contactanos()
    {
        //Obtengo Ususario en el Banner
        $usuario = Utils::obtenerUsuario();
        //Obtengo Categorias en la Barra de Navegacion
        $categoriaBarraNavegacion = Utils::listaCategorias();
        require_once 'views/layout/header.php';
        require_once 'views/layout/banner.php';
        require_once 'views/layout/nav.php';
        require_once 'views/layout/search.php';
        require_once 'views/home/contactUs.php';
        require_once 'views/layout/footer.php';
    }
}
