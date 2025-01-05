<?php
require_once 'model/comentario.php';

class ComentarioController
{
    public function guardar()
    {
        $comentarioTexto = isset($_POST['comentario']) ? trim($_POST['comentario']) : '';
        $calificacion = isset($_POST['calificacion']) ? (int)$_POST['calificacion'] : 0;
        $producto_id = isset($_POST['producto_id']) ? (int)$_POST['producto_id'] : 0;
        $usuario_id = isset($_POST['usuario_id']) ? (int)$_POST['usuario_id'] : 0;

        $errores = [];

        // Validaciones de datos
        if (empty($usuario_id)) {
            $errores[] = 'Debes estar registrado para poder comentar.';
        }
        if (empty($comentarioTexto)) {
            $errores[] = 'El comentario es obligatorio.';
        }
        if ($calificacion <= 0 || $calificacion > 5) {
            $errores[] = 'La calificación es obligatoria';
        }
        if ($producto_id <= 0) {
            $errores[] = 'El producto seleccionado no es válido.';
        }

        if (count($errores) > 0) {
            echo json_encode([
                'success' => false,
                'errors' => $errores,
            ]);
            return;
        }
        $comentario = new Comentario();
        $comentario->setComentario($comentarioTexto);
        $comentario->setCalificacion($calificacion);
        $comentario->setProducto_id($producto_id);
        $comentario->setUsuario_id($usuario_id);

        if ($comentario->guardar()) {
            echo json_encode([
                'success' => true,
                'message' => 'Comentario enviado con éxito.',
            ]);
        }
    }
}
