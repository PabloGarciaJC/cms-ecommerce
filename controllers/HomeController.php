<?php

class HomeController
{
    public function index()
    {        
        $usuario = Utils::obtenerUsuario();
        //Obtengo Categorias en la Barra de Navegacion
        $categorianBarraNavegacion = Utils::obtenerCategoriasTodasNav();       
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
        $usuario = Utils::obtenerUsuario();
        //Obtengo Categorias en la Barra de Navegacion
        $categorianBarraNavegacion = Utils::obtenerCategoriasTodasNav();
        require_once 'views/layout/header.php';
        require_once 'views/layout/banner.php';
        require_once 'views/layout/nav.php';
        require_once 'views/layout/search.php';
        require_once 'views/home/contentElectronics.php';
        require_once 'views/layout/footer.php';
    }

    public function accesorios()
    {        
        $usuario = Utils::obtenerUsuario();
        //Obtengo Categorias en la Barra de Navegacion
        $categorianBarraNavegacion = Utils::obtenerCategoriasTodasNav();  
        require_once 'views/layout/header.php';
        require_once 'views/layout/banner.php';
        require_once 'views/layout/nav.php';
        require_once 'views/layout/search.php';
        require_once 'views/home/contentAppliances.php';
        require_once 'views/layout/footer.php';
    }

    public function sobreNosotros()
    {        
        $usuario = Utils::obtenerUsuario();
        //Obtengo Categorias en la Barra de Navegacion
        $categorianBarraNavegacion = Utils::obtenerCategoriasTodasNav();
        require_once 'views/layout/header.php';
        require_once 'views/layout/banner.php';
        require_once 'views/layout/nav.php';
        require_once 'views/layout/search.php';
        require_once 'views/home/aboutUs.php';
        require_once 'views/layout/footer.php';
    }

    public function contactanos()
    {        
        $usuario = Utils::obtenerUsuario();
        //Obtengo Categorias en la Barra de Navegacion
        $categorianBarraNavegacion = Utils::obtenerCategoriasTodasNav();  
        require_once 'views/layout/header.php';
        require_once 'views/layout/banner.php';
        require_once 'views/layout/nav.php';
        require_once 'views/layout/search.php';
        require_once 'views/home/contactUs.php';
        require_once 'views/layout/footer.php';
    }
}
