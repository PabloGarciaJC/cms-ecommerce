<?php
require_once 'model/usuario.php';
require_once 'model/categorias.php';
require_once 'model/paises.php';
require_once 'model/productos.php';
require_once 'model/roles.php';
require_once 'model/pedidos.php';

class AdminController
{
    public function dashboard()
    {
        Utils::accesoUsuarioRegistrado();
        $usuario = Utils::obtenerUsuarioSinModelo();
        $pedidosModel = new Pedidos();
        $pedidosPendientes = $pedidosModel->obtenerPedidosPendientes();
        $ingresosMensuales = $pedidosModel->obtenerIngresosMensuales();
        $pedidosCompletados = $pedidosModel->obtenerPedidosCompletados();
        $ventasTotales = $pedidosModel->obtenerVentasTotales();
        $productosModel = new Productos();
        $totalProductos = $productosModel->obtenerTotalProductos();
        $usuariosModel = new Usuario();
        $totalClientes = $usuariosModel->obtenerTotalClientes();
        $historialPedidos = $pedidosModel->obtenerHistorialPedidos();
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
            $errores['usuario'] = 'El nombre de usuario no puede estar vacío.';
        }

        if (empty($documentacion)) {
            $errores['documentacion'] = 'El número de documento no puede estar vacío.';
        }
        if (empty($nombre)) {
            $errores['nombre'] = 'El nombre no puede estar vacío.';
        }
        if (empty($apellido)) {
            $errores['apellido'] = 'El apellido no puede estar vacío.';
        }

        if (empty($telefono)) {
            $errores['telefono'] = 'El teléfono no puede estar vacío.';
        }
        if (empty($direccion)) {
            $errores['direccion'] = 'La dirección no puede estar vacía.';
        }
        if (empty($pais)) {
            $errores['pais'] = 'El país no puede estar vacío.';
        }
        if (empty($ciudad)) {
            $errores['ciudad'] = 'La ciudad no puede estar vacía.';
        }
        if (empty($codigoPostal)) {
            $errores['codigoPostal'] = 'El código postal no puede estar vacío.';
        }

        if (count($errores) > 0) {
            $_SESSION['errores'] = $errores;
            $_SESSION['form'] = $_POST;
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

                // Generar un nombre único para el archivo de imagen
                $nombreArchivoUnico = time() . '_' . basename($nombreArchivo);
                $subirImagen = new Usuario();
                $subirImagen->setId($id);
                $subirImagen->setimagen($nombreArchivoUnico);

                // Obtener la imagen actual del usuario para eliminarla si existe
                $obtenerUsuario = $subirImagen->obtenerTodosPorId();
                $ruta = $directorioDestino . $obtenerUsuario->imagen;

                if (move_uploaded_file($rutaTemporal, $directorioDestino . $nombreArchivoUnico)) {
                    // Eliminar la imagen anterior si existe
                    if ($obtenerUsuario->imagen && is_file($ruta)) {
                        unlink($ruta);
                    }

                    // Guardar la nueva imagen
                    $subirImagen->subirImagen();
                } else {
                    echo "Error al mover la imagen al directorio de destino.";
                    return;
                }
            }

            // Actualizar los datos del usuario
            $usuarios->actualizar();

            // Mensaje de éxito
            $_SESSION['exito'] = 'La información se actualizó correctamente.';
            $_SESSION['messageClass'] = 'alert-warning';
            unset($_SESSION['errores']);
            unset($_SESSION['form']);
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
            $_SESSION['exito'] = 'La Contraseña se actualizó correctamente.';
            $messageClass = 'alert-warning';
            $_SESSION['messageClass'] = $messageClass;
            unset($_SESSION['errores']);
            header('Location: ' . BASE_URL . 'Admin/password');
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
            $getCategorias = $categorias->obtenerSubcategorias('', '', '');
        } else {
            $getCategorias = $categorias->obtenerCategorias();
        }
        require_once 'views/layout/head.php';
        require_once 'views/admin/catalogo/index.php';
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
            $getCategorias = $categorias->obtenerSubcategorias('', '', '');
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
        $offerStart = isset($_POST['offerStart']) && !empty(trim($_POST['offerStart'])) ? trim($_POST['offerStart']) : null;
        $offerExpiration = isset($_POST['offerExpiration']) && !empty(trim($_POST['offerExpiration'])) ? trim($_POST['offerExpiration']) : null;
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
        $productos->setOfferStart($offerStart);
        $productos->setOfferExpiration($offerExpiration);

        $errores = [];

        // Validaciones de campos
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

            // Manejo de imágenes
            $imagenes = [];

            if (isset($_FILES['productImages']) && is_array($_FILES['productImages']['tmp_name'])) {

                $directorioDestino = 'uploads/images/productos/';

                if (!is_dir($directorioDestino)) {
                    mkdir($directorioDestino, 0777, true);
                }

                foreach ($_FILES['productImages']['tmp_name'] as $key => $rutaTemporal) {
                    $nombreArchivo = $_FILES['productImages']['name'][$key];
                    $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
                    $extensionesPermitidas = ['jpg', 'jpeg', 'png', 'gif'];


                    if (!in_array(strtolower($extension), $extensionesPermitidas)) {
                        $errores['imagenes'] = "El archivo {$nombreArchivo} tiene una extensión no permitida.";
                        continue;
                    }

                    if ($_FILES['productImages']['size'][$key] > 5 * 1024 * 1024) {
                        $errores['imagenes'] = "El archivo {$nombreArchivo} supera el tamaño máximo permitido (5MB).";
                        continue;
                    }

                    $nombreArchivoUnico = time() . '_' . basename($nombreArchivo);
                    if (move_uploaded_file($rutaTemporal, $directorioDestino . $nombreArchivoUnico)) {
                        $imagenes[] = $nombreArchivoUnico;
                    }
                }
            }

            // Convertir las imágenes a JSON
            $jsonImagenes = json_encode($imagenes, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            if (json_last_error() !== JSON_ERROR_NONE) {
                $_SESSION['errores']['json'] = "Error al procesar las imágenes como JSON.";
                header("Location: " . BASE_URL . "Admin/productos" . $urlParentid);
                exit;
            }

            // Acciones según el caso: editar, eliminar o crear
            $messageClass = '';
            switch (true) {
                case $editId:
                    $productos->setId($editId);
                    $productos->setImagenes($jsonImagenes);
                    $productos->actualizarProductosPorId();
                    $_SESSION['exito'] = 'El Producto se actualizó correctamente.';
                    $messageClass = 'alert-warning';
                    break;
                case $deleteId:
                    $productos->setId($deleteId);
                    $productos->eliminarProductos();
                    $_SESSION['exito'] = 'El Producto se eliminó correctamente.';
                    $messageClass = 'alert-danger';
                    break;
                default:
                    $productos->setImagenes($jsonImagenes);
                    $productos->save();
                    $_SESSION['exito'] = 'El Producto se creó correctamente.';
                    $messageClass = 'alert-primary';
                    break;
            }

            // Configurar mensajes de éxito o error y redirigir
            $_SESSION['messageClass'] = $messageClass;
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
            // Decodificar el JSON de las imágenes
            if (isset($getCategoriasId->imagenes)) {
                $imagenes = json_decode($getCategoriasId->imagenes, true);
                $getCategoriasId->imagenes = $imagenes;
            }
        }

        require_once 'views/layout/head.php';
        require_once 'views/admin/categoria/crear.php';
        require_once 'views/layout/script-footer.php';
    }

    public function guardarCategorias()
    {
        Utils::accesoUsuarioRegistrado();

        $name = isset($_POST['name']) ? trim($_POST['name']) : false;
        $descripcion = isset($_POST['descripcion']) ? trim($_POST['descripcion']) : false;
        $editId = isset($_POST['editid']) ? $_POST['editid'] : false;
        $deleteId = isset($_POST['deleteid']) ? $_POST['deleteid'] : false;
        $parentid = isset($_POST['parentid']) ? $_POST['parentid'] : false;
        $urlParentid = $parentid ? '?categoriaId=' . $parentid : '';

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
        }

        // Manejo de imágenes subidas
        $imagenes = [];

        if (isset($_FILES['categoriaImages']) && is_array($_FILES['categoriaImages']['tmp_name'])) {
            $directorioDestino = 'uploads/images/categorias/';

            if (!is_dir($directorioDestino)) {
                mkdir($directorioDestino, 0777, true);
            }

            foreach ($_FILES['categoriaImages']['tmp_name'] as $key => $rutaTemporal) {
                $nombreArchivo = $_FILES['categoriaImages']['name'][$key];
                $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
                $extensionesPermitidas = ['jpg', 'jpeg', 'png', 'gif'];

                if (!in_array(strtolower($extension), $extensionesPermitidas)) {
                    $errores['imagenes'] = "El archivo {$nombreArchivo} tiene una extensión no permitida.";
                    continue;
                }

                if ($_FILES['categoriaImages']['size'][$key] > 5 * 1024 * 1024) {
                    $errores['imagenes'] = "El archivo {$nombreArchivo} supera el tamaño máximo permitido (5MB).";
                    continue;
                }

                // Generar un nombre único y mover el archivo
                $nombreArchivoUnico = time() . '_' . basename($nombreArchivo);
                if (move_uploaded_file($rutaTemporal, $directorioDestino . $nombreArchivoUnico)) {
                    $imagenes[] = $nombreArchivoUnico;
                }
            }
        }

        // Convertir las imágenes a JSON
        $jsonImagenes = json_encode($imagenes, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        if (json_last_error() !== JSON_ERROR_NONE) {
            $_SESSION['errores']['json'] = "Error al procesar las imágenes como JSON.";
            header("Location: " . BASE_URL . "Admin/categorias" . $urlParentid);
            exit;
        }

        // Acciones según la operación (crear, editar, eliminar)
        $messageClass = '';
        if ($editId) {
            $categorias->setId($editId);
            $categorias->setImagenes($jsonImagenes);
            $categorias->actualizarCategoriaPorId();
            $_SESSION['exito'] = 'La categoría se actualizó correctamente.';
            $messageClass = 'alert-warning';
        } elseif ($deleteId) {
            $categorias->setId($deleteId);
            $categorias->eliminarCategoria();
            $_SESSION['exito'] = 'La categoría se eliminó correctamente.';
            $messageClass = 'alert-danger';
        } else {
            $categorias->setImagenes($jsonImagenes);
            $categorias->setParentId($parentid);
            $categorias->crearCategoria();
            $_SESSION['exito'] = 'La categoría se creó correctamente.';
            $messageClass = 'alert-primary';
        }

        // Configurar mensajes de éxito o error y redirigir
        $_SESSION['messageClass'] = $messageClass;
        unset($_SESSION['errores']);
        unset($_SESSION['form']);
        header("Location: " . BASE_URL . "Admin/catalogo" . $urlParentid);
        exit;
    }

    public function asignarRoles()
    {
        Utils::accesoUsuarioRegistrado();
        $roles = new Rol();
        $obtenerRoles = $roles->obtenerTodos();
        $usuarios = new Usuario();
        $obtenerUsuarios = $usuarios->obtenerTodosLosUsuarios();
        require_once 'views/layout/head.php';
        require_once 'views/admin/roles/asignarRoles.php';
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

            // Verificar si el nuevo rol es Admin (id = 22)
            if ($nuevoRol == 22) {
                $usuario = new Usuario();
                if ($usuario->existeUsuarioConRolAdmin() && !$usuario->esRolActualAdmin($id)) {
                    echo json_encode(['success' => false, 'message' => 'Solo un usuario puede tener el rol de Admin.']);
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

    public function roles()
    {
        Utils::accesoUsuarioRegistrado();
        $rol = new Rol();
        unset($_SESSION['errores']);
        unset($_SESSION['form']);
        unset($_SESSION['exito']);
        $obtenerRoles = $rol->obtenerTodos();
        require_once 'views/layout/head.php';
        require_once 'views/admin/roles/index.php';
        require_once 'views/layout/script-footer.php';
    }

    public function crearRoles()
    {
        $editId = isset($_GET['editid']) ? $_GET['editid'] : false;
        $deleteid = isset($_GET['deleteid']) ? $_GET['deleteid'] : false;
        $rol = new Rol();
        if ($editId || $deleteid) {
            $rol->setId($editId ?: $deleteid);
            $obtenerRoles = $rol->obtenerPorId();
        }
        require_once 'views/layout/head.php';
        require_once 'views/admin/roles/crear.php';
        require_once 'views/layout/script-footer.php';
    }

    public function guardarRoles()
    {
        Utils::accesoUsuarioRegistrado();
        $name = isset($_POST['name']) ? $_POST['name'] : false;
        $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
        $editId = isset($_POST['editid']) ? $_POST['editid'] : false;
        $deleteid = isset($_POST['deleteid']) ? $_POST['deleteid'] : false;
        $rol = new Rol();
        $rol->setNombre($name);
        $rol->setDescripcion($descripcion);

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
            header("Location: " . BASE_URL . "Admin/crearRoles");
            exit;
        } else {
            $messageClass = '';
            switch (true) {
                case $editId:
                    $rol->setId($editId);
                    $rol->actualizar();
                    $_SESSION['exito'] = 'La información se actualizó correctamente.';
                    $messageClass = 'alert-warning';
                    break;
                case $deleteid:
                    $rol->setId($deleteid);
                    $rol->eliminar();
                    $_SESSION['exito'] = 'La información se eliminó correctamente.';
                    $messageClass = 'alert-danger';
                    break;
                default:
                    $rol->crear();
                    $_SESSION['exito'] = 'La información se creó correctamente.';
                    $messageClass = 'alert-primary';
                    break;
            }
            $_SESSION['messageClass'] = $messageClass;
            unset($_SESSION['errores']);
            unset($_SESSION['form']);
            header("Location: " . BASE_URL . "Admin/roles");
            exit;
        }
    }

    public function listaPedidos()
    {
        Utils::accesoUsuarioRegistrado();
        $pedidos = new Pedidos();
        $estados = $pedidos->obtenerEstados();
        $listaPedidos = $pedidos->obtenerPedidosConProductos();
        require_once 'views/layout/head.php';
        require_once 'views/admin/pedidos/lista.php';
        require_once 'views/layout/script-footer.php';
    }

    public function detallePedido()
    {
        Utils::accesoUsuarioRegistrado();
        $id = isset($_GET['id']) ? $_GET['id'] : false;
        $pedido = new Pedidos();
        $pedidoDetails = $pedido->obtenerPorId($id);
        require_once 'views/layout/head.php';
        require_once 'views/admin/pedidos/detalle.php';
        require_once 'views/layout/script-footer.php';
    }

    public function actualizarPedidos()
    {
        // Verificamos si se han enviado los datos del formulario
        if (isset($_POST['pedido_id']) && isset($_POST['estado'])) {
            // Obtener el ID del pedido y el nuevo estado
            $pedido_id = $_POST['pedido_id'];
            $nuevoEstado = $_POST['estado'];

            // Crear una instancia del modelo
            $pedidoModel = new Pedidos();

            // Llamar al método para actualizar el estado
            $actualizado = $pedidoModel->actualizarEstado($pedido_id, $nuevoEstado);

            // Verificar si la actualización fue exitosa
            if ($actualizado) {
                $_SESSION['exito'] = 'Estado del pedido actualizado correctamente.';
            } else {
                $_SESSION['errores'] = 'Hubo un problema al actualizar el estado del pedido.';
            }

            // Redirigir a la página de lista de pedidos
            header("Location: " . BASE_URL . "Admin/listaPedidos");
            exit;
        } else {
            // Si no se reciben datos válidos, redirigir con un error
            $_SESSION['errores'] = 'No se han recibido datos válidos para actualizar el pedido.';
            header("Location: " . BASE_URL . "Admin/listaPedidos");
            exit;
        }
    }

    public function listaUsuario()
    {
        Utils::accesoUsuarioRegistrado();
        $usuario = new Usuario();
        $usuarios = $usuario->obtenerTodosLosUsuarios();
        require_once 'views/layout/head.php';
        require_once 'views/admin/user/lista.php';
        require_once 'views/layout/script-footer.php';
    }

    public function detalleUsuario()
    {
        Utils::accesoUsuarioRegistrado();
        $id = isset($_GET['id']) ? $_GET['id'] : false;
        $usuario = new Usuario();
        $usuario->setId($id);
        $usuarioDetails = $usuario->obtenerTodosPorId();
        require_once 'views/layout/head.php';
        require_once 'views/admin/user/detalle.php';
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
