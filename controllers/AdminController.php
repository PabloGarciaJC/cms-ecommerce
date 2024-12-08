<?php
require_once 'model/usuario.php';
require_once 'model/categorias.php';
require_once 'model/paises.php';
require_once 'model/productos.php';


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
            header("Location: " . BASE_URL . "Admin/perfil");
            exit;
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

            // Redirigir a la página de información general
            header("Location: " . BASE_URL . "Admin/perfil");
            exit;
        }
    }

    public function ecommerce()
    {
        Utils::accesoUsuarioRegistrado();
        $categorias = new Categorias();
        $parentid = isset($_GET['parentid']) ? $_GET['parentid'] : false;
        $categorias->setParentId($parentid);
        $breadcrumbs = $categorias->getBreadcrumbs();

        if ($parentid) {
            $getCategorias = $categorias->otenerSubcategorias();
        } else {
            $getCategorias = $categorias->obtenerCategorias();
        }

        require_once 'views/layout/head.php';
        require_once 'views/admin/ecommerce/index.php';
        require_once 'views/layout/script-footer.php';
    }


    public function productos()
    {
        Utils::accesoUsuarioRegistrado();
        require_once 'views/layout/head.php';
        require_once 'views/admin/productos/crear.php';
        require_once 'views/layout/script-footer.php';
    }

    public function guardarProductos()
    {
        // Obtener los datos del formulario
        $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
        $descripcion = isset($_POST['descripcion']) ? trim($_POST['descripcion']) : '';
        $precio = isset($_POST['precio']) ? floatval($_POST['precio']) : 0;
        $stock = isset($_POST['stock']) ? intval($_POST['stock']) : 0;
        $categoria = isset($_POST['categoria']) ? intval($_POST['categoria']) : 0;
        $estado = isset($_POST['estado']) ? trim($_POST['estado']) : '';
        $oferta = isset($_POST['oferta']) ? floatval($_POST['oferta']) : 0;
        $offerExpiration = isset($_POST['offerExpiration']) ? trim($_POST['offerExpiration']) : '';

        // Inicializar el objeto Producto
        $productos = new Productos();

        // Asignar los valores al producto
        $productos->setNombre($nombre);
        $productos->setDescripcion($descripcion);
        $productos->setPrecio($precio);
        $productos->setStock($stock);
        $productos->setOferta($oferta);
        $productos->setIdCategoria($categoria);
        $productos->setEstado($estado);
        $productos->setOfferExpiration($offerExpiration);

        // Validar los campos obligatorios
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
        if ($categoria == 0) {
            $errores['categoria'] = "Debe seleccionar una categoría.";
        }
        if (empty($estado)) {
            $errores['estado'] = "Debe seleccionar el estado del producto.";
        }

        // Si hubo errores al subir las imágenes, los mostramos
        if (count($errores) > 0) {
            $_SESSION['errores'] = $errores;
            header("Location: " . BASE_URL . "Admin/productos");
            exit;
        } else {
            // Lógica de manejo del avatar (imagenes)
            $imagenes = [];
            if (isset($_FILES['productImages']['tmp_name']) && is_array($_FILES['productImages']['tmp_name'])) {
                $directorioDestino = 'uploads/images/productos/';
                if (!is_dir($directorioDestino)) {
                    mkdir($directorioDestino, 0777, true);
                }

                // Procesar cada archivo de imagen
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
            // Guardar las imágenes en el producto (si hay imágenes)
            if (!empty($imagenes)) {
                $productos->setImagenes(implode(',', $imagenes)); // Guardar las imágenes como una cadena separada por comas
            }
            // Guardar el producto en la base de datos
            $productos->save();
            // Limpiar los errores y los datos del formulario después de procesar
            unset($_SESSION['errores']);
            // Guardar el mensaje de éxito en la sesión
            $_SESSION['exito'] = 'La información se actualizó correctamente.';

            // Redirigir a la página de información general
            header("Location: " . BASE_URL . "Admin/ecommerce");
            exit;
        }
    }

    public function categorias()
    {
        Utils::accesoUsuarioRegistrado();
        $editId = isset($_GET['editid']) ? $_GET['editid'] : false;
        $deteleId = isset($_GET['deteleid']) ? $_GET['deteleid'] : false;
        $categorias = new Categorias();

        if ($editId || $deteleId) {
            $categorias->setId($editId ?: $deteleId);
            $getCategoriasId = $categorias->obtenerCategoriaPorId(); // Repueblo el Formulario Segun el id
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
        $deleteId = isset($_POST['deteleid']) ? $_POST['deteleid'] : false;
        $parentid = isset($_POST['parentid']) ? $_POST['parentid']  : false;
        $urlParentid = $parentid ? '&parentid=' . $parentid : false;

        // Instacio
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
            header("Location: " . BASE_URL . "Admin/categorias");
            exit;
        } else {
            switch (true) {
                case $editId:
                    $categorias->setId($editId);
                    $categorias->actualizarCategoriaPorId();
                    $_SESSION['exito'] = 'La categoría se actualizó correctamente.';
                    break;

                case $deleteId:
                    $categorias->setId($deleteId);
                    $categorias->eliminarCategoria();
                    $_SESSION['exito'] = 'La categoría se eliminó correctamente.';
                    break;

                default:
                    $categorias->setParentId($parentid);
                    $categorias->crearCategoria();
                    $_SESSION['exito'] = 'La categoría se creó correctamente.';
                    break;
            }
            unset($_SESSION['errores']);
            unset($_SESSION['form']);
            header("Location: " . BASE_URL . "Admin/ecommerce" . $urlParentid);
            exit;
        }
    }

    // public function listaProductos()
    // {
    //     Utils::accesoUsuarioRegistrado();
    //     require_once 'views/layout/head.php';
    //     require_once 'views/admin/productos/lista.php';
    //     require_once 'views/layout/script-footer.php';
    // }

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
