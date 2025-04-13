<?php

// Incluye el autoload de Composer para que las clases sean cargadas automáticamente
require_once __DIR__ . '/../../vendor/autoload.php'; 

use PHPUnit\Framework\TestCase;
use controllers\UsuarioController; // Esto debería coincidir con el namespace de UsuarioController

class UsuarioControllersTest extends TestCase
{
    public function testSaludar()
    {
        $controller = new UsuarioController();
        $this->assertEquals("Hola, Juan", $controller->saludar("Juan"));
    }
}
