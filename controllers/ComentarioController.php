<?php
require_once 'model/comentario.php';

class ComentarioController
{
    public function guardar()
    {
        // Comprobamos que los datos del formulario se han enviado
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Recogemos los valores del formulario
            $comentarioTexto = isset($_POST['comentario']) ? trim($_POST['comentario']) : '';
            $calificacion = isset($_POST['calificacion']) ? (int)$_POST['calificacion'] : 0;
            $producto_id = isset($_POST['producto_id']) ? (int)$_POST['producto_id'] : 0;
            $usuario_id = isset($_POST['usuario_id']) ? (int)$_POST['usuario_id'] : 0;

            // Inicializamos el arreglo de errores
            $errores = [];

            // Validaciones de datos
            if (empty($usuario_id)) {
                $errores['usuario_id'] = 'Debes estar registrado en el sistema para poder comentar.';
            }
            if (empty($comentarioTexto)) {
                $errores['comentarioTexto'] = 'El comentario es obligatorio.';
            }
            if ($calificacion <= 0 || $calificacion > 5) {
                $errores['calificacion'] = 'La calificación es obligatoria y debe ser un valor entre 1 y 5.';
            }
            if ($producto_id <= 0) {
                $errores['producto_id'] = 'El producto seleccionado no es válido.';
            }

            // Guardamos los errores y los datos enviados en caso de fallo
            if (count($errores) > 0) {
                $_SESSION['errores'] = $errores;
                $_SESSION['form'] = $_POST;
                $_SESSION['messageClass'] = 'alert-danger';
            }

            // Creamos una instancia del modelo Comentario y asignamos valores
            $comentario = new Comentario();
            $comentario->setComentario($comentarioTexto);
            $comentario->setCalificacion($calificacion);
            $comentario->setProducto_id($producto_id);
            $comentario->setUsuario_id($usuario_id);

            // Intentamos guardar el comentario
            if (count($errores) > 0) {
                $_SESSION['errores'] = $errores;
                $_SESSION['form'] = $_POST;
            } else {
                $comentario->guardar();
                $_SESSION['exito'] = "Comentario enviado con éxito.";
                $_SESSION['messageClass'] = "alert-success";
            }


            // Redirigimos a la página del producto después de guardar
            header("Location: " . BASE_URL . "Producto/ficha?id={$producto_id}");
        }
    }
}
