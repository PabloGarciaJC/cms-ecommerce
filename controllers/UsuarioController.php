<?php
require_once 'model/usuario.php';

class UsuarioController
{
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
            $mensaje = 1;
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
        }
        header("location:" . base_url);
    }

    public function InformacionPublica()
    {
        $id = isset($_POST['id']) ? $_POST['id'] : false;
        $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : false;
        $documentacion = isset($_POST['nroDocumentacion']) ? $_POST['nroDocumentacion'] : false;
        $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : false;
        $sizeArchivoMax = "1048576"; // 1 MB expresado en bytes //1048576

        //Capturo las Propiedades de FILES.
        $nombrePropiedades = $_FILES['avatarSelecionado'];
        $nombreArchivo = $_FILES['avatarSelecionado']['name'];
        $tipoArchivo = $_FILES['avatarSelecionado']['type'];
        $rutaTemporal = $_FILES['avatarSelecionado']['tmp_name'];
        $pesoArchivo = $_FILES['avatarSelecionado']['size'];

        //Repoblar Campos
        $repoblarInputs = array();
        $repoblarInputs['id'] = $id;
        $repoblarInputs['usuario'] = $usuario;
        $repoblarInputs['documentacion'] = $documentacion;
        $repoblarInputs['telefono'] = $telefono;

        //Instancio
        $subirImagen = new Usuario();
        $subirImagen->setId($id);
        $subirImagen->setUsuario($usuario);
        $subirImagen->setNumeroDocumento($documentacion);
        $subirImagen->setNroTelefono($telefono);
        $subirImagen->setUrl_Avatar($nombreArchivo);

        //valido los files
        $errores = array();

        if (empty($usuario)) {
            $errores['alias'] = Utils::erroresValidacion('Error', 'Ingrese Alias');
        } elseif (strlen($usuario) > 12) {
            $errores['alias'] = Utils::erroresValidacion('Error', 'El Alias debe de Tener Max. 12 Caracteres');
        }

        if (empty($documentacion)) {
            $errores['documentacion'] = Utils::erroresValidacion('Error', 'Ingrese Documentacion');
        }

        if (empty($telefono)) {
            $errores['telefono'] = Utils::erroresValidacion('Error', 'Ingrese Teléfono');
        }

        if ($pesoArchivo > $sizeArchivoMax) {
            $errores['pesoMaxAvatar'] = Utils::erroresValidacion('Error', 'la imagen NO debe pesar mas de un 1MB');
        }

        if (count($errores) == 0) {

            // Guardo la Nueva Url en la base de datos.
            $subirImagen->actualizarInformacionPublica();

            //Creo el Directorio en el caso de que no exista.
            if (!is_dir('uploads/images/avatar/')) {
                mkdir('uploads/images/avatar/', 0777, true);
            }

            // Guardo la Nueva Url en la base de datos.
            $subirImagen->actualizarInformacionPublica();

            //Seleciono Imagen que Existe
            $urlAvatar = $subirImagen->obtenerTodosPorId();
            $ruta = 'uploads/images/avatar/' . $urlAvatar->Url_Avatar;  //url que existe en la base de datos actualmente.

            //Para Guardar solo un Avatar por usuario, el cual no se repita.
            if ($urlAvatar->Url_Avatar != $nombreArchivo) {
                // Borra la imagen anterior.
                unlink($ruta);

                // Guardo en el Fichero del Proyecto o en su defecto en el servidor
                move_uploaded_file($_FILES['avatarSelecionado']['tmp_name'], 'uploads/images/avatar/' . $nombreArchivo);
            }
        } else {
            $_SESSION['errores'] = $errores;
            $_SESSION['repoblar'] = $repoblarInputs;
        }
        header("Location:" . base_url . "usuario/panelAdministrativo");
    }


    public function panelAdministrativo()
    {
        Utils::accesoUsuarioRegistrado();

        if (isset($_SESSION['usuarioRegistrado']->Id)) {
            $obtenertodos = new usuario;
            $obtenertodos->setId($_SESSION['usuarioRegistrado']->Id);
            $usuario = $obtenertodos->obtenerTodosPorId();
        }
        require_once 'views/layout/header.php';
        require_once 'views/layout/banner.php';
        require_once 'views/layout/nav.php';
        require_once 'views/layout/search.php';
        require_once 'views/layout/sidebarAdministrativo.php';
        require_once 'views/usuario/formPublicaPrivada.php';
        require_once 'views/layout/footer.php';
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
