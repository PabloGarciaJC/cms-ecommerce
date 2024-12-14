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
        $iniciarSesion = new Usuario();
        $iniciarSesion->setEmail($email);
        $iniciarSesion->setPassword($password);
        $comprobandoEmail = $iniciarSesion->repetidosEmail();
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
}
