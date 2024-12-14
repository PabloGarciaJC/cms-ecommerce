<?php
require_once 'model/usuario.php';
require_once 'model/categorias.php';
require_once 'model/paises.php';
require_once 'model/productos.php';
require_once 'model/roles.php';


class AdminController
{
    public function dashboard()
    {
        Utils::accesoUsuarioRegistrado();
        require_once 'views/layout/head.php';
        require_once 'views/admin/dashboard/index.php';
        require_once 'views/layout/script-footer.php';
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

    public function perfilGuardar()
    {
        Utils::accesoUsuarioRegistrado();
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

        $errores = [];

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

        if (count($errores) > 0) {
            $_SESSION['errores'] = $errores;
            header("Location: " . BASE_URL . "Admin/perfil");
            exit;
        } else {
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
                        unlink($ruta);
                    }
                    $subirImagen->subirImagen();
                } else {
                    echo "Error al mover la imagen al directorio de destino.";
                    return;
                }
            }
            $usuarios->actualizar();
            unset($_SESSION['errores']);
            $_SESSION['exito'] = 'La información se actualizó correctamente.';
            header("Location: " . BASE_URL . "Admin/perfil");
            exit;
        }
    }

    public function password()
    {
        Utils::accesoUsuarioRegistrado();
        $usuario = Utils::obtenerUsuarioSinModelo();
        require_once 'views/layout/head.php';
        require_once 'views/admin/user/password.php';
        require_once 'views/layout/script-footer.php';
    }

    public function cambioPassword()
    {
        $id = $_POST['id'];
        $newPassword = $_POST['new_password'];
        $confirmPassword = $_POST['confirm_password'];
        $usuarios = new Usuario();
        $usuarios->setId($id);

        $errores = [];

        if (empty($newPassword)) {
            $errores['password'] = 'La nueva contraseña no puede estar vacía';
        }

        if (empty($confirmPassword)) {
            $errores['confirmPassword'] = 'La confirmación de la contraseña no puede estar vacía';
        } elseif ($newPassword !== $confirmPassword) {
            $errores['password'] = 'Las contraseñas no coinciden';
        }

        if (count($errores) > 0) {
            $_SESSION['errores'] = $errores;
            header('Location: ' . BASE_URL . 'Admin/password');
            exit;
        } else {
            $hashed_password = password_hash($newPassword, PASSWORD_BCRYPT);
            $usuarios->setPassword($hashed_password);
            $usuarios->actualizarPassword();
            unset($_SESSION['errores']);
            $_SESSION['exito'] = 'Contraseña actualizada exitosamente';
            header("Location: " . BASE_URL . "Admin/password");
            exit;
        }
    }

    public function catalogo()
    {
        Utils::accesoUsuarioRegistrado();
        $categoriaId = isset($_GET['categoriaId']) ? $_GET['categoriaId'] : false;

        $categorias = new Categorias();
        $categorias->setId($categoriaId);
        $breadcrumbs = $categorias->getBreadcrumbs();
        if ($categoriaId) {
            $getCategorias = $categorias->otenerSubcategorias();
        } else {
            $getCategorias = $categorias->obtenerCategorias();
        }
        require_once 'views/layout/head.php';
        require_once 'views/admin/ecommerce/catalogo.php';
        require_once 'views/layout/script-footer.php';
    }

    public function productos()
    {
        Utils::accesoUsuarioRegistrado();
        $parentid = isset($_GET['categoriaId']) ? $_GET['categoriaId'] : false;
        $editId = isset($_GET['editid']) ? $_GET['editid'] : false;
        $deleteid = isset($_GET['deleteid']) ? $_GET['deleteid'] : false;

        $categorias = new Categorias();
        $categorias->setId($parentid);
        if ($parentid) {
            $getCategorias = $categorias->otenerSubcategorias();
        }

        $productos = new Productos();
        if ($editId || $deleteid) {
            $productos->setId($editId ?: $deleteid);
            $getProductosById = $productos->obtenerProductosPorId();
        }
        require_once 'views/layout/head.php';
        require_once 'views/admin/productos/crear.php';
        require_once 'views/layout/script-footer.php';
    }

    public function guardarProductos()
    {
        $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : false;
        $descripcion = isset($_POST['descripcion']) ? trim($_POST['descripcion']) : false;
        $precio = isset($_POST['precio']) ? floatval($_POST['precio']) : false;
        $stock = isset($_POST['stock']) ? intval($_POST['stock']) : false;
        $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : false;
        $estado = isset($_POST['estado']) ? trim($_POST['estado']) : false;
        $oferta = isset($_POST['oferta']) ? floatval($_POST['oferta']) : false;
        $offerExpiration = isset($_POST['offerExpiration']) ? trim($_POST['offerExpiration']) : false;
        $editId = isset($_POST['editid']) ? $_POST['editid'] : false;
        $deleteId = isset($_POST['deleteid']) ? $_POST['deleteid'] : false;
        $parentid = isset($_POST['parentid']) ? $_POST['parentid'] : false;
        $urlParentid = $parentid ? '?categoriaId=' . $parentid : false;

        $productos = new Productos();
        $productos->setNombre($nombre);
        $productos->setDescripcion($descripcion);
        $productos->setPrecio($precio);
        $productos->setStock($stock);
        $productos->setOferta($oferta);
        $productos->setParentId($categoria);
        $productos->setEstado($estado);
        $productos->setOfferExpiration($offerExpiration);

        $errores = [];

        if (empty($nombre)) {
            $errores['nombre'] = "El nombre es obligatorio.";
        }
        if (empty($descripcion)) {
            $errores['descripcion'] = "La descripción es obligatoria.";
        }
        if ($precio <= 0) {
            $errores['precio'] = "El precio debe ser mayor que 0.";
        }
        if ($stock < 0) {
            $errores['stock'] = "El stock no puede ser negativo.";
        }
        if (empty($estado)) {
            $errores['estado'] = "Debe seleccionar el estado del producto.";
        }

        if (count($errores) > 0) {
            $_SESSION['errores'] = $errores;
            $_SESSION['form'] = $_POST;
            header("Location: " . BASE_URL . "Admin/productos" . $urlParentid);
            exit;
        } else {
            // Manejar imágenes
            $imagenes = [];
            // Procesar nuevas imágenes cargadas
            if (isset($_FILES['productImages']) && is_array($_FILES['productImages']['tmp_name'])) {
                $directorioDestino = 'uploads/images/productos/';
                if (!is_dir($directorioDestino)) {
                    mkdir($directorioDestino, 0777, true);
                }
                foreach ($_FILES['productImages']['tmp_name'] as $key => $rutaTemporal) {
                    $nombreArchivo = $_FILES['productImages']['name'][$key];
                    $nombreArchivoUnico = time() . '_' . basename($nombreArchivo);
                    if (move_uploaded_file($rutaTemporal, $directorioDestino . $nombreArchivoUnico)) {
                        $imagenes[] = $nombreArchivoUnico;
                    } else {
                        $errores[] = "Error al guardar la imagen: $nombreArchivo";
                    }
                }
            }

            // Convertir el arreglo de imágenes a formato JSON
            if (!empty($imagenes)) {
                $imagenesJson = json_encode($imagenes);
            } else {
                $imagenesJson = null;
            }

            // Acciones según el caso: editar, eliminar o crear
            switch (true) {
                case $editId:
                    $productos->setId($editId);
                    $productos->setImagenes($imagenesJson);
                    $productos->actualizarProductosPorId();
                    break;
                case $deleteId:
                    $productos->setId($deleteId);
                    $productos->eliminarProductos();
                    break;
                default:
                    $productos->setImagenes($imagenesJson);
                    $productos->save();
                    break;
            }
            unset($_SESSION['errores']);
            unset($_SESSION['form']);
            header("Location: " . BASE_URL . "Admin/catalogo" . $urlParentid);
            exit;
        }
    }

    public function categorias()
    {
        Utils::accesoUsuarioRegistrado();
        $editId = isset($_GET['editid']) ? $_GET['editid'] : false;
        $deleteid = isset($_GET['deleteid']) ? $_GET['deleteid'] : false;
        $categoriaId = isset($_GET['categoriaId']) ? $_GET['categoriaId'] : false;

        $categorias = new Categorias();
        if ($editId || $deleteid) {
            $categorias->setId($editId ?: $deleteid);
            $getCategoriasId = $categorias->obtenerCategoriaPorId();
        }
        require_once 'views/layout/head.php';
        require_once 'views/admin/categoria/crear.php';
        require_once 'views/layout/script-footer.php';
    }

    public function guardarCategorias()
    {
        Utils::accesoUsuarioRegistrado();
        $name = isset($_POST['name']) ? $_POST['name'] : false;
        $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
        $editId = isset($_POST['editid']) ? $_POST['editid'] : false;
        $deleteId = isset($_POST['deleteid']) ? $_POST['deleteid'] : false;
        $parentid = isset($_POST['parentid']) ? $_POST['parentid']  : false;
        $urlParentid = $parentid ? '?categoriaId=' . $parentid : false;

        $categorias = new Categorias();
        $categorias->setNombre($name);
        $categorias->setDescripcion($descripcion);

        $errores = [];

        if (empty($name)) {
            $errores['name'] = "El nombre es obligatorio.";
        }
        if (empty($descripcion)) {
            $errores['descripcion'] = "La descripción es obligatoria.";
        }

        if (count($errores) > 0) {
            $_SESSION['errores'] = $errores;
            $_SESSION['form'] = $_POST;
            header("Location: " . BASE_URL . "Admin/categorias" . $urlParentid);
            exit;
        } else {
            switch (true) {
                case $editId:
                    $categorias->setId($editId);
                    $categorias->actualizarCategoriaPorId();
                    break;
                case $deleteId:
                    $categorias->setId($deleteId);
                    $categorias->eliminarCategoria();
                    break;
                default:
                    $categorias->setParentId($parentid);
                    $categorias->crearCategoria();
                    break;
            }
            unset($_SESSION['errores']);
            unset($_SESSION['form']);
            header("Location: " . BASE_URL . "Admin/catalogo" . $urlParentid);
            exit;
        }
    }

    public function roles()
    {
        Utils::accesoUsuarioRegistrado();
        $roles = new Rol();
        $obtenerRoles = $roles->obtenerTodos();
        $usuarios = new Usuario();
        $obtenerUsuarios = $usuarios->obtenerTodosLosUsuarios();
        require_once 'views/layout/head.php';
        require_once 'views/admin/roles/index.php';
        require_once 'views/layout/script-footer.php';
    }

    public function cambiarRol()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty(file_get_contents('php://input'))) {
            $datos = json_decode(file_get_contents('php://input'), true);

            $id = $datos['id'];
            $nuevoRol = $datos['rol'];

            // Validar los datos
            if (empty($id) || empty($nuevoRol)) {
                echo json_encode(['success' => false, 'message' => 'Datos inválidos']);
                return;
            }

            // Verificar si el rol es 1 y si ya existe un usuario con ese rol
            if ($nuevoRol == 1) {
                $usuario = new Usuario();
                if ($usuario->existeUsuarioConRol1()) {
                    echo json_encode(['success' => false, 'message' => 'Solo un usuario puede tener el rol 1.']);
                    return;
                }
            }

            // Actualizar el rol en la base de datos
            $usuario = new Usuario();
            $usuario->setId($id);
            $usuario->setRol($nuevoRol);

            if ($usuario->actualizarRol()) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'No se pudo actualizar el rol.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
        }
    }

    public function gestionar()
    {
        Utils::accesoUsuarioRegistrado();
        require_once 'views/layout/head.php';
        require_once 'views/admin/roles/gestionar.php';
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
        Utils::accesoUsuarioRegistrado();
        if (isset($_SESSION['usuarioRegistrado'])) {
            unset($_SESSION['usuarioRegistrado']);
            unset($_SESSION['Admin']);
            unset($_SESSION['carrito']);
            header("Location: /");
        }
    }
}
