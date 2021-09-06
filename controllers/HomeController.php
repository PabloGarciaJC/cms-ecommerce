<?php


class HomeController{

    public function index(){

        require_once 'views/home/slider.php';
        require_once 'views/home/contentIndex.php';
    }

    public function electronica(){
        require_once 'views/home/contentElectronics.php';
    }

    public function accesorios(){
        require_once 'views/home/contentAppliances.php';
    }

    public function sobreNosotros(){
        require_once 'views/home/aboutUs.php';
    }

    public function contactanos(){
        require_once 'views/home/contactUs.php';
    }

    public function panelAdministrativo(){
        require_once 'views/home/panelAdministrativo.php';
    
    }

}
