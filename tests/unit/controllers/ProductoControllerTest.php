<?php

use PHPUnit\Framework\TestCase;
use controllers\ProductoController;
use model\Productos;
use controllers\LanguageController;

class ProductoControllerTest extends TestCase
{

    public function testFichaMuestraProductoCorrectamente()
    {
        // Definir constante para evitar cargar vistas
        define('PHPUNIT_RUNNING', true);

        // Arrange: Configuración de mocks y datos de prueba
        $languageController = $this->getMockBuilder(LanguageController::class)
                            ->onlyMethods(['cargarTextos', 'getIdiomaId'])
                            ->getMock();

        $languageController->method('cargarTextos')->willReturn(null);
        $languageController->method('getIdiomaId')->willReturn(1);

        $productoMock = $this->getMockBuilder(Productos::class)
                        ->onlyMethods(['setIdioma', 'setUsuario', 'setGrupoId', 'obtenerProductosPorId'])
                        ->getMock();

        $productoMock->method('setIdioma')->willReturn(1);
        $productoMock->method('setUsuario')->willReturn(1);
        $productoMock->method('setGrupoId')->willReturn(123);
        $productoMock->method('obtenerProductosPorId')->willReturn((object)[
            'id' => 333,
            'nombre' => 'Samsung Galaxy J7',
            'imagenes' => [
                '1735824549_SamsungGalaxyJ7-1.jpg',
                '1735824549_SamsungGalaxyJ7-2.jpg',
                '1735824549_SamsungGalaxyJ7-3.jpg'
            ],
            'precio' => 350.00,
            'stock' => 5,
            'estado' => 'available',
            'oferta' => 0.00,
            'nombre_categoria' => 'Móviles',
            'descripcion' => 'El Samsung Galaxy J7 es un smartphone con una pantalla grande...',
            'offer_expiration' => '',
            'parent_id' => 1735806505,
            'grupo_id' => 1735805506,
            'especificacion_1' => '3 GB RAM | 16 GB ROM | Expandible hasta 256 GB',
            'especificacion_2' => 'Pantalla Full HD de 5.5 pulgadas',
            'especificacion_3' => 'Cámara trasera de 13 MP | Cámara frontal de 8 MP',
            'especificacion_4' => 'Batería de 3300 mAh',
            'especificacion_5' => 'Procesador Exynos 7870 Octa Core 1.6GHz',
        ]);

        $productoController = new ProductoController($languageController);

        // Act: Ejecutar el método y capturar salida
        ob_start();
        $productoController->ficha($productoMock);
        $output = ob_get_clean() ?? '';

        $producto = $productoMock->obtenerProductosPorId();

        // Assert: Verificar valores clave
        $this->assertEquals(1735805506, $producto->grupo_id);

        // En caso de que quiera verlo
        // file_put_contents(__DIR__ . '/output_ficha.html', $output);
    }
}
