<?php
// LanguageController.php
require_once 'model/idiomas.php';

class LanguageController
{
    private $idiomas;

    public function __construct()
    {
        $this->idiomas = new Idiomas();
    }

    // Establece el idioma en la sesión
    public function setIdioma($codigo)
    {
        $_SESSION['lang'] = $codigo;
    }

    // Obtiene el idioma actual de la sesión
    public function getIdioma()
    {
        return isset($_SESSION['lang']) ? $_SESSION['lang'] : 'es';
    }

    // Obtiene el id del idioma actual
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

    // Carga los textos del idioma seleccionado
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
?>
