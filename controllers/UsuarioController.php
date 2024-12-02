<?php
require_once 'model/usuario.php';

class UsuarioController
{
    public function informacionGeneral()
    {
        //Acceso Usuario Registrado a esta Pagina
        Utils::accesoUsuarioRegistrado();

        //Obtengo Ususario en el Banner sin Modelo
        $usuario = Utils::obtenerUsuarioSinModelo();

        //Obtengo Categorias en la Barra de Navegacion
        $categoriaBarraNavegacion = Utils::listaCategorias();

        //Obtengo Todos Los Paises y el Actual
        $paisesTodos = Utils::obtenerPaises();
        $paisesActual = Utils::obtenerPaisActual($usuario->Pais);
        
        require_once 'views/layout/header.php';
        require_once 'views/layout/banner.php';
        require_once 'views/layout/nav.php';
        require_once 'views/layout/sidebarAdministrativo.php';
        require_once 'views/usuario/informacionPublica.php';
        require_once 'views/layout/footer.php';
    }

    public function registro()
    {
        $mensaje = null;
        $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : false;
        $email = isset($_POST['email']) ? $_POST['email'] : false;
        $password = isset($_POST['password']) ? $_POST['password'] : false;
        $confirmarPassword = isset($_POST['confirmarPassword']) ? $_POST['confirmarPassword'] : false;
        $checked = isset($_POST['checked']) ? $_POST['checked'] : false;
        // Instancio 
        $registro = new Usuario();
        $registro->setUsuario($usuario);
        $registro->setEmail($email);
        $registro->setPassword($confirmarPassword);
        $comprobarUsuario = $registro->repetidosUsuario();
        $comprobandoEmail = $registro->repetidosEmail();

        //validacion
        if (empty(trim($usuario))) {
            $mensaje = utils::setearMensajeError('mdErrorUsuarioPhp', 'Ingrese Alias');
        } elseif (strlen($usuario) > 12) {
            $mensaje = utils::setearMensajeError('mdErrorUsuarioPhp', 'El Alias debe de Tener Max. 12 Caracteres');
        } elseif ($comprobarUsuario->num_rows > 0) {
            $mensaje = utils::setearMensajeError('mdErrorUsuarioPhp', 'Alias Repetido');
        } else if (empty(trim($email))) {
            $mensaje = utils::setearMensajeError('mdErrorEmailPhp', 'Ingrese email');
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $mensaje = utils::setearMensajeError('mdErrorEmailPhp', 'Ingrese Email Valido');
        } elseif ($comprobandoEmail->num_rows > 0) {
            $mensaje = utils::setearMensajeError('mdErrorEmailPhp', 'Email Repetido');
        } else  if (empty(trim($password))) {
            $mensaje = utils::setearMensajeError('mdErrorPasswordPhp', 'Ingrese Contraseña');
        } else if (empty(trim($confirmarPassword)) || $confirmarPassword != $password) {
            $mensaje = utils::setearMensajeError('mdErrorConfirmarPasswordPhp', 'Las Contraseñas deben de coincidir');
        } else  if ($checked == 'false') {
            $mensaje = utils::setearMensajeError('mdErrorChekedPhp', 'checked no selecionador');
        } else {
            $registro->crear();
            $sesionCompletado = $registro->iniciarSesion();
            if ($sesionCompletado && is_object($sesionCompletado)) {
                $_SESSION['usuarioRegistrado'] = $sesionCompletado;
                //Administro los Roles
                if ($_SESSION['usuarioRegistrado']->Rol == 'Admin') {
                    $_SESSION['Admin'] = true;
                    $mensaje = 1;
                }
                $mensaje = 1;
            }
        }
        echo $mensaje;
    }

    function iniciarSesion()
    {
        $mensaje = null;
        $email = isset($_POST['email']) ? $_POST['email'] : false;
        $password = isset($_POST['password']) ? $_POST['password'] : false;
        //instacio
        $iniciarSesion = new Usuario();
        $iniciarSesion->setEmail($email);
        $iniciarSesion->setPassword($password);
        $comprobandoEmail = $iniciarSesion->repetidosEmail();
        //validacion
        if (empty(trim($email))) {
            $mensaje = utils::setearMensajeError('mdErrorEmailIniciarSesionPhp', 'Ingrese email');
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $mensaje = utils::setearMensajeError('mdErrorEmailIniciarSesionPhp', 'Ingrese Email Valido');
        } elseif ($comprobandoEmail->num_rows == 0) {
            $mensaje = utils::setearMensajeError('mdErrorEmailIniciarSesionPhp', 'Email No esta Registrado');
        } elseif (empty(trim($password))) {
            $mensaje = utils::setearMensajeError('mdErrorPasswordIniciarSesionPhp', 'Ingrese Contraseña');
        } else {
            $sesionCompletado = $iniciarSesion->iniciarSesion();

            if ($sesionCompletado && is_object($sesionCompletado)) {

                $_SESSION['usuarioRegistrado'] = $sesionCompletado;

                //Administro los Roles
                if ($_SESSION['usuarioRegistrado']->Rol == 'Admin') {
                    $_SESSION['Admin'] = true;
                    $mensaje = 1;
                }
                $mensaje = 1;
            } else {
                $mensaje = utils::setearMensajeError('mdErrorPasswordIniciarSesionPhp', 'La Contraseña no es correcta');
            }
        }
        echo $mensaje;
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

    public function informacionPublica()
    {
        //Acceso Usuario Registrado a esta Pagina
        Utils::accesoUsuarioRegistrado();

        // Recibimos los datos desde el formulario
        $id = isset($_POST['id']) ? $_POST['id'] : false;
        $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : false;
        $documentacion = isset($_POST['documentacion']) ? $_POST['documentacion'] : false;
        $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : false;
        $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : false;
        $apellido = isset($_POST['apellido']) ? trim($_POST['apellido']) : false;
        $email = isset($_POST['email']) ? trim($_POST['email']) : false;
        $direccion = isset($_POST['direccion']) ? trim($_POST['direccion']) : false;
        $pais = isset($_POST['pais']) ? trim($_POST['pais']) : false;
        $ciudad = isset($_POST['ciudad']) ? trim($_POST['ciudad']) : false;
        $codigoPostal = isset($_POST['codigoPostal']) ? trim($_POST['codigoPostal']) : false;

        $actualizarInformacionPublica = new Usuario();
        $actualizarInformacionPublica->setId($id);
        $actualizarInformacionPublica->setUsuario($usuario);
        $actualizarInformacionPublica->setNumeroDocumento($documentacion);
        $actualizarInformacionPublica->setNroTelefono($telefono);
        $actualizarInformacionPublica->setNombres($nombre);
        $actualizarInformacionPublica->setApellidos($apellido);
        $actualizarInformacionPublica->setDireccion($direccion);
        $actualizarInformacionPublica->setPais($pais);
        $actualizarInformacionPublica->setCiudad($ciudad);
        $actualizarInformacionPublica->setCodigoPostal($codigoPostal);


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

        // Validación de los campos
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
            $nombreArchivo = isset($_FILES['avatarSelecionado']['name']) ? $_FILES['avatarSelecionado']['name'] : false;
            $rutaTemporal = isset($_FILES['avatarSelecionado']['tmp_name']) ? $_FILES['avatarSelecionado']['tmp_name'] : false;

            if ($rutaTemporal) {
                $directorioDestino = 'uploads/images/avatar/';
                if (!is_dir($directorioDestino)) {
                    mkdir($directorioDestino, 0777, true);
                }

                $nombreArchivoUnico = time() . '_' . basename($nombreArchivo);

                $subirImagen = new Usuario();
                $subirImagen->setId($id);
                $subirImagen->setUrl_Avatar($nombreArchivoUnico);

                $obtenerUsuario = $subirImagen->obtenerTodosPorId();
                $ruta = $directorioDestino . $obtenerUsuario->Url_Avatar;

                if (move_uploaded_file($rutaTemporal, $directorioDestino . $nombreArchivoUnico)) {
                    if ($obtenerUsuario->Url_Avatar && is_file($ruta)) {
                        unlink($ruta); // Elimina la imagen anterior
                    }
                    $subirImagen->subirImagen();
                } else {
                    echo "Error al mover la imagen al directorio de destino.";
                    return;
                }
            }

            // Actualizamos la información en la base de datos
            $actualizarInformacionPublica->actualizarInformacionPublica();

            // Limpiar los errores y los datos del formulario después de procesar
            unset($_SESSION['errores']);

            // Guardar el mensaje de éxito en la sesión
            $_SESSION['exito'] = 'La información se actualizó correctamente.';
        }

        // Redirigir a la página de información general
        header("Location: " . BASE_URL . "usuario/informacionGeneral");
        exit;
    }

    public function cambioPassword()
    {
        require_once 'views/layout/header.php';
        require_once 'views/layout/banner.php';
        require_once 'views/layout/nav.php';
        require_once 'views/layout/search.php';
        require_once 'views/layout/sidebarAdministrativo.php';
        require_once 'views/usuario/cambioPassword.php';
        require_once 'views/layout/footer.php';
    }
}
