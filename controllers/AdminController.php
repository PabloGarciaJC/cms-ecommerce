<?php
require_once 'model/usuario.php';
require_once 'model/categorias.php';
require_once 'model/paises.php';
require_once 'model/productos.php';
require_once 'model/roles.php';
require_once 'model/pedidos.php';
require_once 'model/comentario.php';
require_once 'model/idiomas.php';

class AdminController
{

    private function cargarDatosComunes()
    {
        $idiomas = new Idiomas();
        $getIdiomas = $idiomas->obtenerTodos();
        return compact('getIdiomas');
    }

    public function dashboard()
    {
        Utils::accesoUsuarioRegistrado();
        $usuario = Utils::obtenerUsuario();
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
        $usuario = Utils::obtenerUsuario();
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
        $usuario = Utils::obtenerUsuario();
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
            $getCategorias = $categorias->obtenerSubcategorias();
        } else {
            $getCategorias = $categorias->obtenerCategorias();
        }
        require_once 'views/layout/head.php';
        require_once 'views/admin/catalogo/index.php';
        require_once 'views/layout/script-footer.php';
    }

    public function productos()
    {
        extract($this->cargarDatosComunes());
        Utils::accesoUsuarioRegistrado();
        $editId = isset($_GET['editid']) ? $_GET['editid'] : false;
        $deleteid = isset($_GET['deleteid']) ? $_GET['deleteid'] : false;
        $categoriaId = isset($_GET['categoriaId']) ? $_GET['categoriaId'] : false;
        $productos = new Productos();
        if ($editId || $deleteid) {
            $productos->setGrupoId($editId ?: $deleteid);
            $getProductosById = $productos->obtenerProductosPorGrupo();
        }
        require_once 'views/layout/head.php';
        require_once 'views/admin/productos/crear.php';
        require_once 'views/layout/script-footer.php';
    }

    public function guardarProductos()
    {
        Utils::accesoUsuarioRegistrado();

        $datos = [
            'nombres' => isset($_POST['nombre']) ? $_POST['nombre'] : [],
            'descripciones' => isset($_POST['descripcion']) ? $_POST['descripcion'] : [],
            'precios' => isset($_POST['precio']) ? $_POST['precio'] : [],
            'stock' => isset($_POST['stock']) ? $_POST['stock'] : [],
            'estado' => isset($_POST['estado']) ? $_POST['estado'] : [],
            'oferta' => isset($_POST['oferta']) ? $_POST['oferta'] : [],
            'offerStart' => isset($_POST['offerStart']) ? $_POST['offerStart'] : [],
            'offerExpiration' => isset($_POST['offerExpiration']) ? $_POST['offerExpiration'] : [],
            'id_idioma' => isset($_POST['id_idioma']) ? $_POST['id_idioma'] : [],
        ];

        $editId = isset($_POST['editid']) ? $_POST['editid'] : false;
        $deleteId = isset($_POST['deleteid']) ? $_POST['deleteid'] : false;
        $parentid = isset($_POST['parentid']) ? $_POST['parentid'] : false;
        $urlParentid = $parentid ? '?categoriaId=' . $parentid : '';

        $productos = new Productos();
        $registroCreado = false;

        // Generación de grupo_id único
        $grupo_id = substr(str_replace('.', '', microtime(true)), 0, 6) . str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
        $grupo_id = substr($grupo_id, 0, 10);

        // Manejo de imágenes
        $imagenesPorIdioma = [];

        if (isset($_FILES['productImages']) && is_array($_FILES['productImages']['tmp_name'])) {
            foreach ($_FILES['productImages']['tmp_name'] as $idiomaCodigo => $imagenes) {
                if (isset($imagenes) && !empty($imagenes[0]) && isset($_FILES['productImages']['error'][$idiomaCodigo][0])) {
                    if ($_FILES['productImages']['error'][$idiomaCodigo][0] === UPLOAD_ERR_OK) {
                        $imagenesIdioma = [];
                        foreach ($imagenes as $key => $rutaTemporal) {
                            $nombreArchivo = $_FILES['productImages']['name'][$idiomaCodigo][$key];
                            if (!empty($nombreArchivo) && is_string($nombreArchivo)) {
                                $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
                                $extensionesPermitidas = ['jpg', 'jpeg', 'png', 'gif'];

                                // Validar la extensión del archivo
                                if (!in_array(strtolower($extension), $extensionesPermitidas)) {
                                    $errores['imagenes'] = "El archivo {$nombreArchivo} tiene una extensión no permitida.";
                                    continue;
                                }

                                // Validar el tamaño del archivo
                                if ($_FILES['productImages']['size'][$idiomaCodigo][$key] > 5 * 1024 * 1024) {
                                    $errores['imagenes'] = "El archivo {$nombreArchivo} supera el tamaño máximo permitido (5MB).";
                                    continue;
                                }

                                // Generar nombre único y mover archivo
                                $nombreArchivoUnico = time() . '_' . basename($nombreArchivo);
                                $directorioDestino = 'uploads/images/productos/';
                                if (move_uploaded_file($rutaTemporal, $directorioDestino . $nombreArchivoUnico)) {
                                    $imagenesIdioma[] = $nombreArchivoUnico;
                                }
                            }
                        }
                        if (!empty($imagenesIdioma)) {
                            $imagenesPorIdioma[$idiomaCodigo] = json_encode($imagenesIdioma);
                        }
                    }
                }
            }
        }

        // Asignar valores a los productos y verificar validaciones
        foreach ($datos['nombres'] as $idioma => $nombre) {
            $descripcion = isset($datos['descripciones'][$idioma]) ? $datos['descripciones'][$idioma] : '';
            $precio = isset($datos['precios'][$idioma]) && is_numeric($datos['precios'][$idioma]) ? floatval($datos['precios'][$idioma]) : 0.0;
            $stock = isset($datos['stock'][$idioma]) && $datos['stock'][$idioma] !== '' ? intval($datos['stock'][$idioma]) : 0;
            $estado = isset($datos['estado'][$idioma]) ? $datos['estado'][$idioma] : '';
            $oferta = isset($datos['oferta'][$idioma]) && is_numeric($datos['oferta'][$idioma]) ? floatval($datos['oferta'][$idioma]) : 0.0;
            $offerStart = isset($datos['offerStart'][$idioma]) ? $datos['offerStart'][$idioma] : null;
            $offerExpiration = isset($datos['offerExpiration'][$idioma]) ? $datos['offerExpiration'][$idioma] : null;
            $idioma_id = array_search($idioma, array_keys($datos['nombres'])) + 1;

            // Asignación de datos a los productos
            $productos->setIdioma($idioma_id);
            $productos->setNombre($nombre);
            $productos->setDescripcion($descripcion);
            $productos->setPrecio($precio);
            $productos->setStock($stock);
            $productos->setEstado($estado);
            $productos->setOferta($oferta);
            $productos->setOfferStart($offerStart);
            $productos->setOfferExpiration($offerExpiration);
            $productos->setParentId($parentid);

            // Asignar las imágenes correspondientes
            $productos->setImagenes(isset($imagenesPorIdioma[$idioma]) ? $imagenesPorIdioma[$idioma] : '[]');

            // Acciones según el caso (crear, editar, eliminar)
            $messageClass = '';
            if ($editId) {
                $productos->setGrupoId($editId);
                $productos->actualizarProductoPorId();
                $_SESSION['exito'] = 'El producto se actualizó correctamente.';
                $messageClass = 'alert-warning';
            } elseif ($deleteId) {
                $productos->setGrupoId($deleteId);
                $productos->eliminarProducto();
                $_SESSION['exito'] = 'El producto se eliminó correctamente.';
                $messageClass = 'alert-danger';
            } else {
                $productos->setGrupoId($grupo_id);
                $productos->crearProducto();
                $_SESSION['exito'] = 'El producto se creó correctamente.';
                $messageClass = 'alert-primary';
            }

            $registroCreado = true;
        }
        $_SESSION['messageClass'] = $messageClass;
        unset($_SESSION['errores']);
        unset($_SESSION['form']);
        header("Location: " . BASE_URL . "Admin/catalogo" . $urlParentid);
        exit;
    }


    public function categorias()
    {
        extract($this->cargarDatosComunes());
        Utils::accesoUsuarioRegistrado();
        $editId = isset($_GET['editid']) ? $_GET['editid'] : false;
        $deleteid = isset($_GET['deleteid']) ? $_GET['deleteid'] : false;
        $categoriaId = isset($_GET['categoriaId']) ? $_GET['categoriaId'] : false;
        $categorias = new Categorias();
        if ($editId || $deleteid) {
            $categorias->setGrupoId($editId ?: $deleteid);
            $getCategoriasId = $categorias->obtenerCategoriaPorGrupo();
        }
        require_once 'views/layout/head.php';
        require_once 'views/admin/categoria/crear.php';
        require_once 'views/layout/script-footer.php';
    }

    public function guardarCategorias()
    {
        Utils::accesoUsuarioRegistrado();

        $datos = [
            'nombres' => isset($_POST['name']) ? $_POST['name'] : [],
            'descripciones' => isset($_POST['descripcion']) ? $_POST['descripcion'] : [],
            'id_idioma' => isset($_POST['id_idioma']) ? $_POST['id_idioma'] : [],
        ];

        $editId = isset($_POST['editid']) ? $_POST['editid'] : false;
        $deleteId = isset($_POST['deleteid']) ? $_POST['deleteid'] : false;
        $parentid = isset($_POST['parentid']) ? $_POST['parentid'] : false;
        $urlParentid = $parentid ? '?categoriaId=' . $parentid : '';
        $categorias = new Categorias();

        // Generar un único grupo_id para todos los registros
        $grupo_id = substr(str_replace('.', '', microtime(true)), 0, 6) . str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
        $grupo_id = substr($grupo_id, 0, 10);

        $registroCreado = false;

        // Manejo de imágenes subidas
        $imagenesPorIdioma = [];

        // Verificar si se ha enviado el formulario con archivos
        if (isset($_FILES['categoriaImages']) && is_array($_FILES['categoriaImages']['tmp_name'])) {
            foreach ($_FILES['categoriaImages']['tmp_name'] as $idiomaCodigo => $imagenes) {
                // Verificar que tmp_name y error estén definidos y no estén vacíos
                if (isset($imagenes) && !empty($imagenes[0]) && isset($_FILES['categoriaImages']['error'][$idiomaCodigo][0])) {
                    // Verificar si el archivo no tiene errores (error == UPLOAD_ERR_OK)
                    if ($_FILES['categoriaImages']['error'][$idiomaCodigo][0] === UPLOAD_ERR_OK) {
                        // Procesar las imágenes solo si están presentes y no tienen errores
                        $imagenesIdioma = [];
                        foreach ($imagenes as $key => $rutaTemporal) {
                            $nombreArchivo = $_FILES['categoriaImages']['name'][$idiomaCodigo][$key];

                            // Verificar que el nombre del archivo no esté vacío
                            if (!empty($nombreArchivo) && is_string($nombreArchivo)) {
                                $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
                                $extensionesPermitidas = ['jpg', 'jpeg', 'png', 'gif'];

                                // Validar la extensión del archivo
                                if (!in_array(strtolower($extension), $extensionesPermitidas)) {
                                    $errores['imagenes'] = "El archivo {$nombreArchivo} tiene una extensión no permitida.";
                                    continue;
                                }

                                // Validar el tamaño del archivo (máximo 5MB)
                                if ($_FILES['categoriaImages']['size'][$idiomaCodigo][$key] > 5 * 1024 * 1024) {
                                    $errores['imagenes'] = "El archivo {$nombreArchivo} supera el tamaño máximo permitido (5MB).";
                                    continue;
                                }

                                // Generar un nombre único para el archivo
                                $nombreArchivoUnico = time() . '_' . basename($nombreArchivo);

                                // Mover el archivo a su destino final
                                $directorioDestino = 'uploads/images/categorias/';
                                if (move_uploaded_file($rutaTemporal, $directorioDestino . $nombreArchivoUnico)) {
                                    $imagenesIdioma[] = $nombreArchivoUnico;
                                }
                            }
                        }
                        // Si se han subido imágenes, agregar al arreglo de imágenes por idioma
                        if (!empty($imagenesIdioma)) {
                            $imagenesPorIdioma[$idiomaCodigo] = json_encode($imagenesIdioma);
                        }
                    }
                }
            }
        }

        // Asignar las imágenes a las categorías
        foreach ($datos['nombres'] as $idioma => $nombre) {
            $descripcion = isset($datos['descripciones'][$idioma]) ? $datos['descripciones'][$idioma] : '';
            $idioma_id = array_search($idioma, array_keys($datos['nombres'])) + 1;

            // Crear la categoría con los valores correspondientes
            $categorias->setIdioma($idioma_id);
            $categorias->setNombre($nombre);
            $categorias->setDescripcion($descripcion);
            $categorias->setParentId($parentid);

            // Asignar las imágenes para este idioma
            $categorias->setImagenes(isset($imagenesPorIdioma[$idioma]) ? $imagenesPorIdioma[$idioma] : '[]');

            if ($editId) {
                $categorias->setGrupoId($editId);
                $categorias->actualizarCategoriaPorId();
                $_SESSION['exito'] = 'La categoría se actualizó correctamente.';
                $messageClass = 'alert-warning';
            } elseif ($deleteId) {
                $categorias->setGrupoId($deleteId);
                $categorias->eliminarCategoria();
                $_SESSION['exito'] = 'La categoría se eliminó correctamente.';
                $messageClass = 'alert-danger';
            } else {
                $categorias->setGrupoId($grupo_id);
                $categorias->crearCategoria();
                $_SESSION['exito'] = 'La categoría se creó correctamente.';
                $messageClass = 'alert-primary';
            }

            $registroCreado = true;
        }

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

    public function gestionarComentarios()
    {
        Utils::accesoUsuarioRegistrado();
        $comentario = new Comentario();
        $comentarios = $comentario->getComentarios();
        require_once 'views/layout/head.php';
        require_once 'views/admin/comentario/index.php';
        require_once 'views/layout/script-footer.php';
    }

    public function cambiarEstadoComentario()
    {
        // Verificar si el usuario tiene acceso registrado
        Utils::accesoUsuarioRegistrado();

        // Recibir los datos de la solicitud AJAX
        $comentario_id = isset($_POST['comentario_id']) ? $_POST['comentario_id'] : null;
        $estado = isset($_POST['estado']) ? $_POST['estado'] : null;

        // Verificar que los valores estén disponibles
        if ($comentario_id !== null && $estado !== null) {
            // Instanciar el modelo Comentario
            $comentario = new Comentario();

            // Establecer el ID y el nuevo estado
            $comentario->setId($comentario_id);
            $comentario->setEstado($estado);

            // Llamar al método para actualizar el estado del comentario
            $resultado = $comentario->cambiarEstadoComentario();

            // Verificar si la actualización fue exitosa
            if ($resultado) {
                // Respuesta exitosa
                echo json_encode(['success' => true, 'message' => 'Estado actualizado correctamente']);
            } else {
                // Respuesta de error
                echo json_encode(['success' => false, 'message' => 'Error al cambiar el estado del comentario']);
            }
        } else {
            // Si falta algún dato requerido
            echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
        }
    }

    public function documentacion()
    {
        Utils::accesoUsuarioRegistrado();
        require_once 'views/layout/head.php';
        require_once 'views/admin/layout/documentacion.php';
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
