<?php
require_once 'model/pedidos.php';
require_once 'model/idiomas.php';
require_once 'controllers/LanguageController.php';

class PedidosController
{
    private $languageController;

    public function __construct()
    {
        $this->languageController = new LanguageController();
    }

    private function cargarTextoIdiomas()
    {
        $idiomas = new Idiomas();
        if (isset($_POST['lenguaje'])) {
            $this->languageController->setIdioma($_POST['lenguaje']);
        }
        return $this->languageController->cargarTextos();
    }

    public function crear()
    {

        var_dump($_POST);
    }

}
?>