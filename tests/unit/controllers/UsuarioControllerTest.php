<?php

use PHPUnit\Framework\TestCase;
use controllers\UsuarioController;
use model\Usuario;


class UsuarioControllerTest extends TestCase
{
    public function testRegistroExitoso()
    {
        $_POST = [
            'usuario' => 'usuarioPrueba',
            'email' => 'correo@prueba.com',
            'password' => '123456',
            'confirmarPassword' => '123456',
            'checked' => 'on'
        ];
    
        $_SESSION = [];
    
        // Crear el mock de Usuario
        $usuarioMock = $this->getMockBuilder(Usuario::class)
            ->onlyMethods(['repetidosUsuario', 'repetidosEmail', 'crear', 'iniciarSesion'])
            ->getMock();
    
        // Definir los comportamientos del mock
        $usuarioMock->method('repetidosUsuario')->willReturn(false);
        $usuarioMock->method('repetidosEmail')->willReturn(false);
        $usuarioMock->expects($this->once())->method('crear');
        $usuarioMock->method('iniciarSesion')->willReturn((object)['id' => 1, 'usuario' => 'usuarioPrueba']);
    
        // Crear el controlador
        $controller = new UsuarioController();
    
        // Capturar la salida del echo en el buffer
        ob_start();
        $controller->registro($usuarioMock);
        $output = ob_get_clean();
    
        // Convertir la salida a un array (JSON)
        $response = json_decode($output, true);
    
        // Verificar que la respuesta sea correcta
        $this->assertEquals(TEXT_REGISTRATION_SUCCESS_TITLE, $response['titulo']);
        $this->assertTrue($response['success']);
        $this->assertArrayHasKey('usuarioRegistrado', $_SESSION);
        $this->assertArrayHasKey('boton', $response);
    }
    
    
}
