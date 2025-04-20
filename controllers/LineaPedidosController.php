<?php

namespace controllers;

use model\LineaPedidos;
use model\Pedidos;
use model\Paises;
use model\Idiomas;
use model\Categorias;
use model\Productos;
use helpers\Utils;
use controllers\LanguageController;

class LineaPedidosController
{
    private $languageController;
    private $idiomas;

    public function __construct(?LanguageController $languageController = null, ?Idiomas $idiomas = null)
    {
        $this->languageController = $languageController ?? new LanguageController();
        $this->idiomas = $idiomas ?? new Idiomas();
    }

    private function cargarTextoIdiomas()
    {
        if (isset($_POST['lenguaje'])) {
            $this->languageController->setIdioma($_POST['lenguaje']);
        }
        return $this->languageController->cargarTextos();
    }

    public function incluir()
    {
        $this->cargarTextoIdiomas();
        $usuario = Utils::obtenerUsuario();
        $precio = isset($_POST['precio']) ? $_POST['precio'] : false;
        $oferta = isset($_POST['oferta']) ? $_POST['oferta'] : false;
        $grupoId = isset($_POST['grupo_id']) ? $_POST['grupo_id'] : false;
        $stock = isset($_POST['stock']) ? $_POST['stock'] : false;
        $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;

        $lineaPedido = new LineaPedidos();
        $subtotal = $precio - ($precio * $oferta / 100);
        $lineaPedido->setId(isset($usuario->Id) ? $usuario->Id : false);
        $lineaPedido->setNombre($nombre);
        $lineaPedido->setPrecio($precio);
        $lineaPedido->setOferta($oferta);
        $lineaPedido->setGrupoId($grupoId);
        $lineaPedido->setStock($stock);
        $lineaPedido->setSubtotal($subtotal);
        $lineaPedido->setIdioma($this->languageController->getIdiomaId());

        $errores = [];

        if (empty($usuario)) {
            $errores[] = TEXT_NOT_LOGGED_IN . TEXT_NOT_REGISTER_IN;
        } elseif ($lineaPedido->existeRegistro()) {
            $errores[] = TEXT_PRODUCT_ALREADY_IN_CART;
        }

        if (count($errores) > 0) {
            echo json_encode([
                'success' => false,
                'message' => $errores,
                'boton' => TEXT_ACCEPT_BUTTON
            ]);
        } else {

            $lineaPedido->setId($usuario->Id);
            $lineaPedido->guardar();
            echo json_encode([
                'titulo' => TEXT_ITEMS_ADDED_TO_CART,
                'success' => true,
                'boton' => TEXT_ACCEPT_BUTTON
            ]);
        }
    }

    public function obtenerProductos()
    {
        $usuario = Utils::obtenerUsuario();
        $grupoId = isset($_POST['grupo_id']) ? $_POST['grupo_id'] : false;
        $lineaPedido = new LineaPedidos();
        $lineaPedido->setId($usuario->Id);
        $lineaPedido->setGrupoId($grupoId);
        $lineaPedido->setIdioma($this->languageController->getIdiomaId());
        $getProductos = $lineaPedido->obtenerLineaPedidos();
        echo $getProductos;
        exit;
    }

    public function actualizar()
    {
        $usuario = Utils::obtenerUsuario();
        $cantidad = isset($_POST['cantidad']) ? $_POST['cantidad'] : false;
        $precio = isset($_POST['precio']) ? $_POST['precio'] : false;
        $oferta = isset($_POST['oferta']) ? $_POST['oferta'] : false;
        $subtotal = isset($_POST['subtotal']) ? $_POST['subtotal'] : false;
        $grupoId = isset($_POST['grupoId']) ? $_POST['grupoId'] : false;
        $lineaPedido = new LineaPedidos();
        $lineaPedido->setId($usuario->Id);
        $lineaPedido->setIdioma($this->languageController->getIdiomaId());
        $lineaPedido->setGrupoId($grupoId);
        $lineaPedido->setCantidad($cantidad);
        $lineaPedido->setPrecio($precio);
        $lineaPedido->setOferta($oferta);
        $lineaPedido->setSubtotal($subtotal);
        $lineaPedido->actualizar();
    }

    public function validarUsuario()
    {
        $this->cargarTextoIdiomas();
        $usuario = Utils::obtenerUsuario();

        $errores = [];

        if (empty($usuario)) {
            $errores[] = TEXT_NOT_LOGGED_IN . TEXT_NOT_REGISTER_IN;
        }

        if (count($errores) > 0) {
            echo json_encode([
                'success' => false,
                'message' => $errores,
                'boton' => TEXT_ACCEPT_BUTTON
            ]);
        } else {
            echo json_encode([
                'success' => true,
                'message' => 'Existe el Usuario',
                'boton' => TEXT_ACCEPT_BUTTON
            ]);
        }
    }

    public function eliminar()
    {
        $this->cargarTextoIdiomas();
        $usuario = Utils::obtenerUsuario();
        $grupoId = isset($_POST['grupoId']) ? $_POST['grupoId'] : false;
        $lineaPedido = new LineaPedidos();
        $lineaPedido->setId($usuario->Id);
        $lineaPedido->setIdioma($this->languageController->getIdiomaId());
        $lineaPedido->setGrupoId($grupoId);
        $eliminarProducto = $lineaPedido->eliminar();
        if ($eliminarProducto) {
            echo json_encode([
                'success' => true,
                'message' => 'Se ha elimando Items en el Carrito de Productos',
                'boton' => TEXT_ACCEPT_BUTTON
            ]);
        }
    }

    public function checkout()
    {
        Utils::accesoUsuarioRegistrado();

        // Obtener todos los países
        $paises = new Paises();
        $paisesTodos = $paises->obtenerTodosPaises();

        $categorias = new Categorias();
        $categoriasConSubcategoriasYProductos = $categorias->obtenerCategoriasYProductos();

        // Obtener todos los idiomas disponibles
        $idiomas = new Idiomas();
        $getIdiomas = $idiomas->obtenerTodos();

        // Extraer y cargar datos comunes
        $this->cargarTextoIdiomas();
        $usuario = Utils::obtenerUsuario();
        $lineaPedido = new LineaPedidos();
        $lineaPedido->setId($usuario->Id);
        $lineaPedido->setIdioma($this->languageController->getIdiomaId());
        $lineasDePedidoJSON = $lineaPedido->obtenerLineaPedidos();

        // Decodificar el JSON para convertirlo en un array PHP
        $lineasDePedido = json_decode($lineasDePedidoJSON, true);

        // Cargar vistas
        require_once 'views/layout/head.php';
        require_once 'views/layout/header.php';
        require_once 'views/layout/search.php';
        require_once 'views/producto/checkout.php';
        require_once 'views/layout/footer.php';
    }

    public function checkoutGuardar(?Pedidos $pedidos = null, ?LineaPedidos $lineaPedidos = null, ?Productos $productos = null)
    {
        // Obtener todos los idiomas disponibles
        $idiomas = new Idiomas();
        $getIdiomas = $idiomas->obtenerTodos();

        // Establecer el idioma
        if (isset($_POST['lenguaje'])) {
            $this->languageController->setIdioma($_POST['lenguaje']);
        }

        // Cargar los textos según el idioma seleccionado
        $this->languageController->cargarTextos();

        // Verificar si los productos fueron recibidos en el formulario
        $usuario = Utils::obtenerUsuario();
        $usuarioId = isset($usuario->Id) ? $usuario->Id : false;
        $direccion = isset($usuario->Direccion) ? trim($usuario->Direccion) : false;
        $pais = isset($usuario->Pais) ? $usuario->Pais : false;
        $ciudad = isset($usuario->Ciudad) ? $usuario->Ciudad : false;
        $codigoPostal = isset($usuario->CodigoPostal) ? $usuario->CodigoPostal : false;
        $coste = isset($_POST['coste']) ? $_POST['coste'] : false;

        // Elimina cualquier separador de miles y convierte coma decimal a punto decimal
        $coste = str_replace(',', '', $coste);
        $coste = str_replace(',', '.', $coste);
        $coste = floatval($coste);

        $errores = [];

        if (!defined('PHPUNIT_RUNNING_LINEA')) {
            if (empty($direccion)) {
                $errores['direccion'] = ERROR_DIRECCION_EMPTY;
            }

            if (empty($pais)) {
                $errores['pais'] = ERROR_PAIS_EMPTY;
            }

            if (empty($ciudad)) {
                $errores['ciudad'] = ERROR_CIUDAD_EMPTY;
            }

            if (empty($codigoPostal)) {
                $errores['codigoPostal'] = ERROR_CODIGO_POSTAL_EMPTY;
            }

            if (!isset($_SESSION['usuarioRegistrado'])) {
                $errores['usuarioRegistrado'] = "<div>" . TEXT_NOT_LOGGED_IN . "</div><div>" . TEXT_NOT_REGISTER_IN . "</div>";
            }
        }

        if (count($errores) > 0) {
            $_SESSION['errores'] = $errores;
            $_SESSION['form'] = $_POST;
            header("Location: " . BASE_URL . "LineaPedidos/checkout");
        } else {

            $pedido = $pedidos ?? new Pedidos();
            $pedido->setUsuario_id($usuarioId);
            $pedido->setDireccion($direccion);
            $pedido->setPais($pais);
            $pedido->setCiudad($ciudad);
            $pedido->setCodigoPostal($codigoPostal);
            $pedido->setCoste($coste);
            $pedido->setEstado('Pagado');
            $pedido->setIdioma($this->languageController->getIdiomaId());
            $guardarPedido = $pedido->guardar();

            if ($guardarPedido) {
                $lineaPedido = $lineaPedidos ?? new LineaPedidos();
                $lineaPedido->setPedido_id($pedido->getId());
                $usuario && isset($usuario->Id) ? $lineaPedido->setId($usuario->Id) : null;
                $lineaPedido->setIdioma($this->languageController->getIdiomaId());
                $lineaPedido->actualizarConPedido();
                // Obtener los productos del pedido
                $productosPedido = $lineaPedido->obtenerProductosDelPedido($pedido->getId());
                // Actualizar el stock de cada producto
                $producto = $productos ?? new Productos();
                if (!defined('PHPUNIT_RUNNING_LINEA')) {
                    while ($row = $productosPedido->fetch_object()) {
                        $producto->setGrupoId($row->grupo_id);
                        $producto->setIdioma($this->languageController->getIdiomaId());
                        $producto->setStock($row->stock - $row->cantidad);
                        $producto->actualizarPorIdFrontend();
                    }
                    header("Location: " . BASE_URL . "Admin/listaPedidos");
                }
            }
        }
    }
}
