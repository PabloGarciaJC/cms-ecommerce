<?php

namespace controllers;

use model\Idiomas;

class LanguageController
{
    private $idiomas;

    public function __construct($idiomas = null)
    {
        $this->setIdiomas($idiomas ? $idiomas : self::getIdioma());
    }

    public function setIdiomas($idiomas)
    {
        $this->idiomas = $idiomas;
    }

    public function setIdioma($codigo)
    {
        $_SESSION['lang'] = $codigo;
    }

    public function setIdiomaSession($codigo)
    {
        $this->setIdioma($codigo);
    }

    public function getIdiomas()
    {
        return $this->idiomas;
    }

    public function getIdioma()
    {
        return isset($_SESSION['lang']) ? $_SESSION['lang'] : 'es';
    }

    public function getIdiomaId()
    {
        $idioma = $this->getIdioma();

        switch ($idioma) {
            case 'en':
                return 2;
            case 'fr':
                return 3;
            default:
                return 1;
        }
    }

    public function cargarTextos()
    {
        $idioma = $this->getIdioma();

        switch ($idioma) {
            case 'en':
                require_once 'lenguajes/ingles.php';
                break;
            case 'fr':
                require_once 'lenguajes/frances.php';
                break;
            default:
                require_once 'lenguajes/espanol.php';
        }
    }
}
