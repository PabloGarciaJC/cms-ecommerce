<?php

require_once 'model/productos.php';
require_once 'model/categorias.php';
require_once 'model/pedidos.php';
require_once 'model/lineaPedidos.php';
require_once 'model/paises.php';
require_once 'model/comentario.php';
require_once 'controllers/LanguageController.php';

class ProductoController
{
    private $languageController;

    public function __construct()
    {
        $this->languageController = new LanguageController();
    }

    private function cargarDatosComunes()
    {
        $usuario = Utils::obtenerUsuario();
        $categorias = new Categorias();

        // Obtener todos los idiomas disponibles
        $idiomas = new Idiomas();
        $getIdiomas = $idiomas->obtenerTodos();

        // Establecer el idioma
        if (isset($_POST['lenguaje'])) {
            $this->languageController->setIdioma($_POST['lenguaje']);
        }

        // Cargar los textos según el idioma seleccionado
        $this->languageController->cargarTextos();

        // Establecer el idioma a utilizar en Categorias
        $categorias->setIdioma($this->languageController->getIdiomaId());

        // Obtener las categorías y productos
        $categoriasConSubcategoriasYProductos = $categorias->obtenerCategoriasYProductos();

        return compact('usuario', 'categoriasConSubcategoriasYProductos', 'getIdiomas');
    }

    public function ficha()
    {
        extract($this->cargarDatosComunes());

        $producto = new Productos();
        $idProducto = isset($_GET['parent_id']) ? $_GET['parent_id'] : false;
        $id = isset($_GET['id']) ? $_GET['id'] : false;

        // Establecer el idioma para el producto
        $producto->setIdioma($this->languageController->getIdiomaId());

        // Ficha de producto
        $producto->setParentId($idProducto);
        $producto->setId($id);
        $productoFicha = $producto->obtenerProductosPorId();

        // Comentarios del producto
        $comentarios = new Comentario();
        $comentariosValorados = $comentarios->obtenerComentariosValorados($productoFicha->id);
        $obtenerComentariosMenorCalificacion = $comentarios->obtenerComentariosMenorCalificacion($productoFicha->id);
        $promedioCalificacion = $comentarios->obtenerPromedioCalificacion($productoFicha->id);

        require_once 'views/layout/head.php';
        require_once 'views/layout/header.php';
        require_once 'views/producto/ficha.php';
        require_once 'views/layout/footer.php';
    }

    public function checkout()
    {
        extract($this->cargarDatosComunes());

        $paises = new Paises();
        $paisesTodos = $paises->obtenerTodosPaises();

        // Inicializar la sesión con un valor predeterminado si no existe
        if (!isset($_SESSION['productoLista'])) {
            $_SESSION['productoLista'] = [];
        }

        $items = [];
        $totalAmount = 0;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Recorremos todos los índices de los productos que se han enviado en el carrito
            foreach ($_POST as $key => $value) {
                if (strpos($key, 'item_name_') === 0) {
                    $idx = substr($key, 10); // Extraemos el índice del producto
                    $itemName = $_POST["item_name_$idx"];
                    $itemNumber = isset($_POST["item_number_$idx"]) ? $_POST["item_number_$idx"] : '';
                    $quantity = isset($_POST["quantity_$idx"]) ? $_POST["quantity_$idx"] : 0;
                    $price = isset($_POST["amount_$idx"]) ? $_POST["amount_$idx"] : 0;
                    $shipping = isset($_POST["shipping_$idx"]) ? $_POST["shipping_$idx"] : 0;
                    $shipping2 = isset($_POST["shipping2_$idx"]) ? $_POST["shipping2_$idx"] : 0;
                    $discount = isset($_POST["discount_amount_$idx"]) ? $_POST["discount_amount_$idx"] : 0;
                    $image = isset($_POST["image_$idx"]) ? $_POST["image_$idx"] : '';
                    $href = isset($_POST["href_$idx"]) ? $_POST["href_$idx"] : '';
                    $producto_id = $_POST["producto_id_$idx"];

                    // Almacenar cada artículo en el arreglo
                    $items[] = [
                        'name' => $itemName,
                        'number' => $itemNumber,
                        'quantity' => $quantity,
                        'price' => $price,
                        'shipping' => $shipping,
                        'shipping2' => $shipping2,
                        'discount' => $discount,
                        'image' => $image,
                        'href' => $href,
                        'producto_id' => $producto_id,
                    ];
                    // Actualizar la sesión con los nuevos artículos
                    $_SESSION['productoLista'] = $items;

                    // Sumar el total
                    $totalAmount += $price * $quantity;
                }
            }

            // Limpiar posibles errores o datos previos en el formulario
            unset($_SESSION['errores']);
            unset($_SESSION['form']);
            unset($_SESSION['exito']);
        }

        require_once 'views/layout/head.php';
        require_once 'views/layout/header.php';
        require_once 'views/producto/checkout.php';
        require_once 'views/layout/footer.php';
    }

    public function checkoutGuardar()
    {
        // $usuario = Utils::obtenerUsuario();
        $categorias = new Categorias();

        // Obtener todos los idiomas disponibles
        $idiomas = new Idiomas();
        $getIdiomas = $idiomas->obtenerTodos();

        // Establecer el idioma
        if (isset($_POST['lenguaje'])) {
            $this->languageController->setIdioma($_POST['lenguaje']);
        }

        // Cargar los textos según el idioma seleccionado
        $this->languageController->cargarTextos();

        // Establecer el idioma a utilizar en Categorias
        $categorias->setIdioma($this->languageController->getIdiomaId());

        // Verificar si hay productos en el carrito
        $productos = $_SESSION['productoLista'] ?? [];

        // Calcular el coste total
        $total = 0;
        foreach ($productos as $producto) {
            $total += $producto['price'] * $producto['quantity'];
        }

        $usuarioId = isset($_POST['usuario_id']) ? trim($_POST['usuario_id']) : false;
        $direccion = isset($_POST['direccion']) ? trim($_POST['direccion']) : false;
        $pais = isset($_POST['pais']) ? trim($_POST['pais']) : false;
        $ciudad = isset($_POST['ciudad']) ? trim($_POST['ciudad']) : false;
        $codigoPostal = isset($_POST['codigoPostal']) ? trim($_POST['codigoPostal']) : false;

        // Crear una instancia del modelo Pedidos
        $pedido = new Pedidos();
        $pedido->setUsuario_id($usuarioId);
        $pedido->setDireccion($direccion);
        $pedido->setPais($pais);
        $pedido->setCiudad($ciudad);
        $pedido->setCodigoPostal($codigoPostal);
        $pedido->setCoste($total);
        $pedido->setEstado('Pendiente');

        $errores = [];

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

        if (count($errores) > 0) {
            $_SESSION['errores'] = $errores;
            $_SESSION['form'] = $_POST;
            header("Location: " . BASE_URL . "Producto/checkout");
            exit;
        } else {
            // Guardar el pedido y obtener el ID generado
            $resultado = $pedido->guardar();

            // Guardar las líneas de pedido
            foreach ($productos as $producto) {
                $lineaPedido = new LineaPedidos();
                $lineaPedido->setPedido_id($pedido->getId());
                $lineaPedido->setProducto_id($producto['producto_id']);
                $lineaPedido->setCantidad($producto['quantity']);
                $lineaPedido->setPrecio($producto['price']);
                $lineaPedido->guardar();
            }

            // Cerrar la sesión de productoLista (vaciar el carrito)
            unset($_SESSION['productoLista']);

            // Mensaje de éxito y redirección
            $_SESSION['exito'] = 'El Pedido se realizó correctamente.';
            $_SESSION['messageClass'] = 'alert-primary';

            // Limpiar posibles errores o datos previos en el formulario
            unset($_SESSION['errores']);
            unset($_SESSION['form']);
            header("Location: " . BASE_URL . "Admin/listaPedidos");
            exit;
        }
    }

    public function moviles()
    {
        $producto = new Productos();

        // Establecer el idioma para el producto
        $producto->setIdioma($this->languageController->getIdiomaId());

        $productos = $producto->movil();
        require 'views/producto/lista.php';
    }

    public function tvAudios()
    {
        $producto = new Productos();

        // Establecer el idioma para el producto
        $producto->setIdioma($this->languageController->getIdiomaId());

        $productos = $producto->tvAudios();
        require 'views/producto/lista.php';
    }

    public function electrodomesticos()
    {
        $producto = new Productos();

        // Establecer el idioma para el producto
        $producto->setIdioma($this->languageController->getIdiomaId());

        $productos = $producto->electrodomesticos();
        require 'views/producto/lista.php';
    }
}
