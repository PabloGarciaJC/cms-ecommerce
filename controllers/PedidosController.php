<?php

namespace controllers;

use model\Pedidos;
use model\Idiomas;
use controllers\LanguageController;

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

}
?>