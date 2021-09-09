<?php

class HomeController
{
    public function index()

    {
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
        require_once 'views/layout/header.php';
        require_once 'views/layout/banner.php';
        require_once 'views/layout/nav.php';
        require_once 'views/layout/search.php';
        require_once 'views/home/contentElectronics.php';
        require_once 'views/layout/footer.php';
    }

    public function accesorios()
    {
        require_once 'views/layout/header.php';
        require_once 'views/layout/banner.php';
        require_once 'views/layout/nav.php';
        require_once 'views/layout/search.php';
        require_once 'views/home/contentAppliances.php';
        require_once 'views/layout/footer.php';
    }

    public function sobreNosotros()
    {
        require_once 'views/layout/header.php';
        require_once 'views/layout/banner.php';
        require_once 'views/layout/nav.php';
        require_once 'views/layout/search.php';
        require_once 'views/home/aboutUs.php';
        require_once 'views/layout/footer.php';
    }

    public function contactanos()
    {
        require_once 'views/layout/header.php';
        require_once 'views/layout/banner.php';
        require_once 'views/layout/nav.php';
        require_once 'views/layout/search.php';
        require_once 'views/home/contactUs.php';
        require_once 'views/layout/footer.php';
    }
}
