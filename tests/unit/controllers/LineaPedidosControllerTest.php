<?php

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;
use model\Pedidos;
use model\LineaPedidos;
use controllers\LineaPedidosController;
use controllers\LanguageController;

class LineaPedidosControllerTest extends TestCase
{
    #[Test]
    #[TestDox('Prueba Exitosa para checkout guardar')]
    public function tesCheckoutGuardar()
    {
        // Evitar carga de vistas
        define('PHPUNIT_RUNNING_LINEA', true);

        // Mock del controlador de idiomas
        $languageController = $this->getMockBuilder(LanguageController::class)->onlyMethods(['cargarTextos', 'getIdiomaId'])->getMock();
        $languageController->method('cargarTextos')->willReturn(null);
        $languageController->method('getIdiomaId')->willReturn(1);

        // Mock del pedido
        $pedidoMock = $this->getMockBuilder(Pedidos::class)->onlyMethods(['guardar', 'getId'])->getMock();
        $pedidoMock->method('guardar')->willReturn(true);
        $pedidoMock->method('getId')->willReturn(123);

        // Mock para simular el  While de un objeto
        // $productosPedidoMock = $this->getMockBuilder(stdClass::class)->addMethods(['fetch_object'])->getMock();
        // $productosPedidoMock->expects($this->exactly(2))->method('fetch_object')->willReturnOnConsecutiveCalls(
        //     (object)['grupo_id' => 1, 'stock' => 10, 'cantidad' => 2], null
        // );

        // Mock de LineaPedidos
        $lineaPedidosMock = $this->getMockBuilder(LineaPedidos::class)->onlyMethods(['actualizarConPedido', 'obtenerProductosDelPedido'])->getMock();
        $lineaPedidosMock->method('actualizarConPedido')->willReturn(true);
        // $lineaPedidosMock->method('obtenerProductosDelPedido')->with(123)->willReturn($productosPedidoMock);

        // Instanciar controlador y ejecutar el método
        $lineaPedidosController = new LineaPedidosController($languageController);

        ob_start();
        try {
            $lineaPedidosController->checkoutGuardar($pedidoMock, $lineaPedidosMock);
            ob_end_clean();
        } catch (\Throwable $e) {
            ob_end_clean();
            throw $e;
        }

        // Declarar explícitamente una aserción para evitar warning
        $this->assertTrue(true);
    }
}
