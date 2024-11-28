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

        //Obtengo Todos Los Paises
        $paisesTodos = Utils::obtenerPaises();

        require_once 'views/layout/header.php';
        require_once 'views/layout/banner.php';
        require_once 'views/layout/nav.php';
        require_once 'views/layout/sidebarAdministrativo.php';
        require_once 'views/usuario/informacionPublica.php';
        require_once 'views/usuario/informacionPrivada.php';
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

    // public function subirImagen()
    // {
    //     $id = isset($_POST['id']) ? $_POST['id'] : false;
    //     $nombreArchivo = isset($_FILES['file']['name']) ? $_FILES['file']['name'] : false;
    //     $tipoArchivo = isset($_FILES['file']['type']) ? $_FILES['file']['type'] : false;
    //     $rutaTemporal = isset($_FILES['file']['tmp_name']) ? $_FILES['file']['tmp_name'] : false;
    //     $pesoArchivo = isset($_FILES['file']['size']) ? $_FILES['file']['size'] : false;
    //     $sizeArchivoMax = "1048576"; // 1 MB expresado en bytes //1048576
    //     if (!is_dir('uploads/images/avatar/')) {
    //         mkdir('uploads/images/avatar/', 0777, true);
    //     }
    //     //Instancio
    //     $subirImagen = new Usuario();
    //     $subirImagen->setId($id);
    //     $subirImagen->setUrl_Avatar($nombreArchivo);
    //     //Seleciono Imagen que Existe
    //     $obtenerUsuario = $subirImagen->obtenerTodosPorId();
    //     //url que existe en la base de datos actualmente.
    //     $ruta = 'uploads/images/avatar/' . $obtenerUsuario->Url_Avatar;
    //     if ($rutaTemporal) {
    //         //Guardo la Url en la base de datos
    //         $subirImagen->subirImagen();
    //         //Para Guardar solo un Avatar por usuario, el cual no se repita
    //         if ($obtenerUsuario->Url_Avatar == $nombreArchivo) {
    //             if (is_file($ruta)) {
    //                 //Borra la imagen anterior para que no quede Guardada en el Fichero
    //                 unlink($ruta);
    //             }
    //         }
    //         //Guardo en el Fichero del Proyecto o en su defecto en el servidor
    //         move_uploaded_file($rutaTemporal, 'uploads/images/avatar/' . $nombreArchivo);
    //     } else {
    //         //Seteo con la que Existe Actualmente 
    //         $subirImagen->setUrl_Avatar($obtenerUsuario->Url_Avatar);
    //         //Guardo la Url en la base de datos la url Nueva.
    //         $subirImagen->subirImagen();
    //     }
    // }

    public function informacionPublica()
    {
        //Acceso Usuario Registrado a esta Pagina
        Utils::accesoUsuarioRegistrado();

        // Recibimos los datos desde el formulario
        $id = isset($_POST['id']) ? $_POST['id'] : false;
        $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : false;
        $documentacion = isset($_POST['documentacion']) ? $_POST['documentacion'] : false;
        $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : false;

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

        // Si hay errores, no continuar con el proceso y redirigir con los errores
        if (count($errores) > 0) {
            $_SESSION['errores'] = $errores;
            $_SESSION['form_data'] = $_POST; // Guardamos los datos para volver a mostrar en el formulario
            // No hacer la redirección aquí, solo guardar los errores y datos del formulario
        } else {
            // Si no hay errores, procedemos con la actualización
            $actualizarInformacionPublica = new Usuario();
            $actualizarInformacionPublica->setId($id);
            $actualizarInformacionPublica->setUsuario($usuario);
            $actualizarInformacionPublica->setNumeroDocumento($documentacion);
            $actualizarInformacionPublica->setNroTelefono($telefono);

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
            unset($_SESSION['form_data']);

            // Guardar el mensaje de éxito en la sesión
            $_SESSION['exito'] = 'La información se actualizó correctamente.';
        }

        // Redirigir a la página de información general
        header("Location: " . BASE_URL . "usuario/informacionGeneral");
        exit; // Asegurarse de que no se ejecute nada más después de la redirección
    }





    public function informacionPrivada()
    {
        $id = isset($_POST['id']) ? $_POST['id'] : false;
        $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
        $apellido = isset($_POST['apellido']) ? $_POST['apellido'] : false;
        $email = isset($_POST['email']) ? $_POST['email'] : false;
        $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;
        $pais = isset($_POST['pais']) ? $_POST['pais'] : false;
        $ciudad = isset($_POST['ciudad']) ? $_POST['ciudad'] : false;
        $codigoPostal = isset($_POST['codigoPostal']) ? $_POST['codigoPostal'] : false;
        //Repoblar Campos
        $repoblarInputs = array();
        $repoblarInputs['id'] = $id;
        $repoblarInputs['nombre'] = $nombre;
        $repoblarInputs['apellido'] = $apellido;
        $repoblarInputs['email'] = $email;
        $repoblarInputs['direccion'] = $direccion;
        $repoblarInputs['pais'] = $pais;
        $repoblarInputs['ciudad'] = $ciudad;
        $repoblarInputs['codigoPostal'] = $codigoPostal;
        //instancio
        $usuario = new usuario();
        $usuario->setId($id);
        $usuario->setNombres($nombre);
        $usuario->setApellidos($apellido);
        $usuario->setEmail($email);
        $usuario->setDireccion($direccion);
        $usuario->setPais($pais);
        $usuario->setCiudad($ciudad);
        $usuario->setCodigoPostal($codigoPostal);
        //errores 
        $errores = array();
        if (empty(trim($nombre))) {
            $errores['documentacion'] = Utils::erroresValidacion('Error', 'Ingresé Nombre');
        }
        if (empty(trim($apellido))) {
            $errores['documentacion'] = Utils::erroresValidacion('Error', 'Ingresé Aplellidos');
        }
        if (empty(trim($email))) {
            $errores['documentacion'] = Utils::erroresValidacion('Error', 'Ingresé Email');
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errores['documentacion'] = Utils::erroresValidacion('Error', 'Email No Válido');
        }
        if (empty(trim($direccion))) {
            $errores['documentacion'] = Utils::erroresValidacion('Error', 'Ingresé Dirección');
        }
        if (empty(trim($pais))) {
            $errores['documentacion'] = Utils::erroresValidacion('Error', 'Ingresé País');
        }
        if (empty(trim($ciudad))) {
            $errores['documentacion'] = Utils::erroresValidacion('Error', 'Ingresé Ciudad');
        }
        if (empty(trim($codigoPostal))) {
            $errores['documentacion'] = Utils::erroresValidacion('Error', 'Ingrese Código Postal');
        }
        if (count($errores) == 0) {
            //consulta
            $usuario->actualizarInformacionPrivada();
            echo 1;
        }
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
