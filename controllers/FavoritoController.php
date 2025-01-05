<?php
require_once 'model/favorito.php';
require_once 'model/usuario.php';
require_once 'controllers/LanguageController.php';

class FavoritoController
{
    private $languageController;

    public function __construct()
    {
        $this->languageController = new LanguageController();
    }

    /**
     * Función común para cargar la configuración del idioma
     */
    private function cargarConfiguracionIdioma()
    {
        $idiomas = new Idiomas();
        $getIdiomas = $idiomas->obtenerTodos();
        if (isset($_POST['lenguaje'])) {
            $this->languageController->setIdioma($_POST['lenguaje']);
        }
        $this->languageController->cargarTextos();
        return $getIdiomas;
    }

    /**
     * Función común para obtener los datos del usuario y el ID del producto
     */
    private function obtenerDatosComunes()
    {
        // Obtener el usuario desde la sesión
        $usuario = isset($_SESSION['usuarioRegistrado']) ? $_SESSION['usuarioRegistrado'] : false;
        $productoId = isset($_POST['producto_id']) ? (int)$_POST['producto_id'] : 0;
        return ['usuario' => $usuario, 'productoId' => $productoId];
    }

    /**
     * Guarda un producto en los favoritos del usuario.
     */
    public function guardar()
    {
        $getIdiomas = $this->cargarConfiguracionIdioma();
        $datos = $this->obtenerDatosComunes();
        $usuario = $datos['usuario'];
        $productoId = $datos['productoId'];

        if (!$usuario || $productoId <= 0) {
            echo json_encode([
                'success' => false,
                'favorito' => false,
                'message' => TEXT_NOT_LOGGED_IN . TEXT_NOT_REGISTER_IN
            ]);
            return;
        }

        $favorito = new Favorito();
        $favorito->setUsuarioId($usuario->Id);
        $favorito->setProductoId($productoId);

        $existe = $favorito->existe();

        if ($existe) {
            echo json_encode([
                'success' => true,
                'favorito' => true,
                'message' => TEXT_PRODUCT_ALREADY_FAVORITE
            ]);
            return;
        }

        $resultado = $favorito->agregar();

        if ($resultado) {
            echo json_encode([
                'success' => true,
                'favorito' => true,
                'message' => TEXT_PRODUCT_ADDED_FAVORITE
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'favorito' => false,
                'message' => TEXT_ERROR_ADD_FAVORITE
            ]);
        }
    }

    /**
     * Elimina un producto de los favoritos del usuario.
     */
    public function eliminar()
    {
        $getIdiomas = $this->cargarConfiguracionIdioma();

        $datos = $this->obtenerDatosComunes();
        $usuario = $datos['usuario'];
        $productoId = $datos['productoId'];

        if (!$usuario || $productoId <= 0) {
            echo json_encode([
                'success' => false,
                'favorito' => false,
                'message' => TEXT_ERROR_NOT_REGISTERED_OR_INVALID_PRODUCT
            ]);
            return;
        }

        $favorito = new Favorito();
        $favorito->setUsuarioId($usuario->Id);
        $favorito->setProductoId($productoId);
        $existe = $favorito->existe();

        if (!$existe) {
            echo json_encode([
                'success' => false,
                'favorito' => false,
                'message' => TEXT_NOT_FAVORITE
            ]);
            return;
        }

        $resultado = $favorito->eliminar();

        if ($resultado) {
            echo json_encode([
                'success' => true,
                'favorito' => false,
                'message' => TEXT_PRODUCT_REMOVED_FAVORITE
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'favorito' => false,
                'message' => TEXT_ERROR_REMOVE_FAVORITE
            ]);
        }
    }
}


