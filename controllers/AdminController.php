<?php
require_once 'model/usuario.php';
require_once 'model/categorias.php';
require_once 'model/paises.php';
require_once 'model/subcategorias.php';

class AdminController
{
    public function dashboard()
    {
        Utils::accesoUsuarioRegistrado();
        require_once 'views/layout/head.php';
        require_once 'views/admin/dashboard/index.php';
        require_once 'views/layout/script-footer.php';
    }

    public function perfilGuardar()
    {
        //Acceso Usuario Registrado a esta Pagina
        Utils::accesoUsuarioRegistrado();

        // Recibimos los datos desde el formulario
        $id = isset($_POST['id']) ? $_POST['id'] : false;
        $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : false;
        $password = isset($_POST['password']) ? $_POST['password'] : false;
        $documentacion = isset($_POST['documentacion']) ? $_POST['documentacion'] : false;
        $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : false;
        $apellido = isset($_POST['apellido']) ? trim($_POST['apellido']) : false;
        $email = isset($_POST['email']) ? trim($_POST['email']) : false;
        $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : false;
        $direccion = isset($_POST['direccion']) ? trim($_POST['direccion']) : false;
        $pais = isset($_POST['pais']) ? trim($_POST['pais']) : false;
        $ciudad = isset($_POST['ciudad']) ? trim($_POST['ciudad']) : false;
        $codigoPostal = isset($_POST['codigoPostal']) ? trim($_POST['codigoPostal']) : false;

        $usuarios = new Usuario();
        $usuarios->setId($id);
        $usuarios->setUsuario($usuario);
        $usuarios->setPassword($password);
        $usuarios->setNumeroDocumento($documentacion);
        $usuarios->setNroTelefono($telefono);
        $usuarios->setNombres($nombre);
        $usuarios->setApellidos($apellido);
        $usuarios->setEmail($email);
        $usuarios->setDireccion($direccion);
        $usuarios->setPais($pais);
        $usuarios->setCiudad($ciudad);
        $usuarios->setCodigoPostal($codigoPostal);

        // Array para almacenar los errores
        $errores = [];

        // Validación de los campos
        if (empty($usuario)) {
            $errores['usuario'] = "El alias es obligatorio.";
        } elseif (strlen($usuario) > 12) {
            $errores['usuario'] = "El alias no puede tener más de 12 caracteres.";
        }

        if (empty($documentacion)) {
            $errores['documentacion'] = "El número de documento es obligatorio.";
        }

        if (empty($telefono)) {
            $errores['telefono'] = "El número de teléfono es obligatorio.";
        }

        if (empty($nombre)) {
            $errores['nombre'] = "El nombre es obligatorio.";
        } elseif (strlen($nombre) > 50) {
            $errores['nombre'] = "El nombre no puede tener más de 50 caracteres.";
        }

        if (empty($apellido)) {
            $errores['apellido'] = "El apellido es obligatorio.";
        } elseif (strlen($apellido) > 50) {
            $errores['apellido'] = "El apellido no puede tener más de 50 caracteres.";
        }

        if (empty($direccion)) {
            $errores['direccion'] = "La dirección es obligatoria.";
        }

        if (empty($pais)) {
            $errores['pais'] = "La pais es obligatoria.";
        }

        if (empty($ciudad)) {
            $errores['ciudad'] = "La ciudad es obligatoria.";
        }

        if (empty($codigoPostal)) {
            $errores['codigoPostal'] = "El código postal es obligatorio.";
        } elseif (!is_numeric($codigoPostal)) {
            $errores['codigoPostal'] = "El código postal debe ser numérico.";
        }

        // Si hay errores, no continuar con el proceso y redirigir con los errores
        if (count($errores) > 0) {
            $_SESSION['errores'] = $errores;
        } else {
            // Lógica de manejo del avatar
            $nombreArchivo = isset($_FILES['avatar']['name']) ? $_FILES['avatar']['name'] : false;
            $rutaTemporal = isset($_FILES['avatar']['tmp_name']) ? $_FILES['avatar']['tmp_name'] : false;
            if ($rutaTemporal) {
                $directorioDestino = 'uploads/images/avatar/';
                if (!is_dir($directorioDestino)) {
                    mkdir($directorioDestino, 0777, true);
                }
                $nombreArchivoUnico = time() . '_' . basename($nombreArchivo);
                $subirImagen = new Usuario();
                $subirImagen->setId($id);
                $subirImagen->setimagen($nombreArchivoUnico);
                $obtenerUsuario = $subirImagen->obtenerTodosPorId();
                $ruta = $directorioDestino . $obtenerUsuario->imagen;

                if (move_uploaded_file($rutaTemporal, $directorioDestino . $nombreArchivoUnico)) {
                    if ($obtenerUsuario->imagen && is_file($ruta)) {
                        unlink($ruta); // Elimina la imagen anterior
                    }
                    $subirImagen->subirImagen();
                } else {
                    echo "Error al mover la imagen al directorio de destino.";
                    return;
                }
            }
            // Actualizamos la información en la base de datos
            $usuarios->actualizar();
            // Limpiar los errores y los datos del formulario después de procesar
            unset($_SESSION['errores']);
            // Guardar el mensaje de éxito en la sesión
            $_SESSION['exito'] = 'La información se actualizó correctamente.';
        }
        // Redirigir a la página de información general
        header("Location: " . BASE_URL . "Admin/perfil");
        exit;
    }

    public function perfil()
    {
        Utils::accesoUsuarioRegistrado();
        $usuario = Utils::obtenerUsuarioSinModelo();
        $paises = new Paises();
        $paisesTodos = $paises->obtenerTodosPaises();
        require_once 'views/layout/head.php';
        require_once 'views/admin/user/perfil.php';
        require_once 'views/layout/script-footer.php';
    }

    public function categorias()
    {
        Utils::accesoUsuarioRegistrado();
        $categorias = new Categorias();
        $getCategorias = $categorias->obtenerCategorias();
        if (isset($_GET['id'])) {
            $categorias->setId($_GET['id']);
            $getCategoriasId = $categorias->obtenerCategoriaPorId();
        }
        require_once 'views/layout/head.php';
        require_once 'views/admin/ecommerce/crear.php';
        require_once 'views/layout/script-footer.php';
    }

    public function guardarCategorias()
    {
        // Acceso del usuario registrado
        Utils::accesoUsuarioRegistrado();

        // Obtener los valores del formulario
        $name = isset($_POST['name']) ? $_POST['name'] : false;
        $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
        $categoria_id = isset($_POST['subcategoria']) ? $_POST['subcategoria'] : false;

        $categorias = new Categorias();
        $subCategorias = new Subcategorias();

        // Array para almacenar errores
        $errores = [];

        // Validaciones
        if (empty($name)) {
            $errores['name'] = "El nombre es obligatorio.";
        }

        if (empty($descripcion)) {
            $errores['descripcion'] = "La descripción es obligatoria.";
        }

        // Si no es subcategoría, crear una categoría principal
        if (empty($categoria_id)) {
            // Crear categoría principal
            $categorias->setNombre($name);
            $categorias->setDescripcion($descripcion);
            $resultado = $categorias->crearCategoria();
        } else {

            $subCategorias->setNombre($name);
            $subCategorias->setDescripcion($descripcion);
            $subCategorias->setCategoriaId($categoria_id);
            $resultado = $subCategorias->crearSubcategoria();
        }

        // Si existen errores, los guardamos en la sesión y redirigimos
        if (count($errores) > 0) {
            $_SESSION['errores'] = $errores;
            header("Location: " . BASE_URL . "Admin/categorias");
            exit;
        }

        // Si la operación fue exitosa, mostrar mensaje
        if ($resultado) {
            $_SESSION['exito'] = 'La información se guardó correctamente.';
        }

        // Limpiar los errores después de procesar
        unset($_SESSION['errores']);

        // Redirigir al listado de categorías
        header("Location: " . BASE_URL . "Admin/categorias");
        exit;
    }

    public function ecommerce()
    {
        Utils::accesoUsuarioRegistrado();
        $categoriasModel = new Categorias();
        $categorias = $categoriasModel->obtenerCategoriasConSubcategorias();
        require_once 'views/layout/head.php';
        require_once 'views/admin/ecommerce/lista.php';
        require_once 'views/layout/script-footer.php';
    }

    public function editarGuardarCategoria()
    {
        echo 'editar';
    }

    public function eliminarGuardarCategoria()
    {
        echo 'eliminar';
    }





    public function productos()
    {
        Utils::accesoUsuarioRegistrado();
        require_once 'views/layout/head.php';
        require_once 'views/admin/productos/crear.php';
        require_once 'views/layout/script-footer.php';
    }

    public function listaProductos()
    {
        Utils::accesoUsuarioRegistrado();
        require_once 'views/layout/head.php';
        require_once 'views/admin/productos/lista.php';
        require_once 'views/layout/script-footer.php';
    }

    public function listaPedidos()
    {
        Utils::accesoUsuarioRegistrado();
        require_once 'views/layout/head.php';
        require_once 'views/admin/pedidos/lista.php';
        require_once 'views/layout/script-footer.php';
    }

    public function cerrarSesion()
    {
        if (isset($_SESSION['usuarioRegistrado'])) {
            unset($_SESSION['usuarioRegistrado']);
            unset($_SESSION['Admin']);
            unset($_SESSION['carrito']);
            header("Location: /");
        }
    }

    public function cambioPassword()
    {
        require_once 'views/layout/head.php';
        require_once 'views/layout/header.php';
        require_once 'views/admin/dashboard/index.php';
        require_once 'views/usuario/cambioPassword.php';
        require_once 'views/layout/footer.php';
    }
}
