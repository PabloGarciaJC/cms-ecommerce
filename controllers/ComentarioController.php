<?php
require_once 'model/comentario.php';
require_once 'model/idiomas.php';
require_once 'controllers/LanguageController.php';

class ComentarioController
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

    public function guardar()
    {
        $usuario = Utils::obtenerUsuario();
        $getIdiomas = $this->cargarConfiguracionIdioma();
        
        $comentarioTexto = isset($_POST['comentario']) ? trim($_POST['comentario']) : '';
        $calificacion = isset($_POST['calificacion']) ? (int)$_POST['calificacion'] : 0;
        $producto_id = isset($_POST['producto_id']) ? (int)$_POST['producto_id'] : 0;
        $parentId = isset($_POST['parentid']) ? (int)$_POST['parentid'] : 0;

        $comentario = new Comentario();
        $comentario->setComentario($comentarioTexto);
        $comentario->setCalificacion($calificacion);
        $comentario->setProducto_id($producto_id);
        $comentario->setUsuario_id($usuario->Id);
        $comentario->setParentId($parentId);

        $errores = [];

        if (empty($usuario)) {
            $errores[] = TEXT_COMMENT_NOT_REGISTERED;
        }

        if (empty($comentarioTexto)) {
            $errores[] = TEXT_COMMENT_REQUIRED;
        }

        if ($calificacion <= 0 || $calificacion > 5) {
            $errores[] = TEXT_RATING_REQUIRED;
        }

        if ($producto_id <= 0) {
            $errores[] = TEXT_INVALID_PRODUCT;
        }

        if (count($errores) > 0) {
            echo json_encode([
                'titulo' => TEXT_COMMENT_ERRORS_TITLE,
                'success' => false,
                'message' => $errores,
                'boton' => TEXT_ACCEPT_BUTTON
            ]);
            return;
        } else {
            if ($comentario->guardar()) {
                echo json_encode([
                    'titulo' => TEXT_COMMENT_SAVE_SUCCESS,
                    'success' => true,
                    'boton' => TEXT_REVIEW_BUTTON
                ]);
            }
        }
    }
}
