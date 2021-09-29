<?php
require_once 'model/usuario.php';

class UsuarioController
{
    public function crear()
    {
        $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : false;
        $email = isset($_POST['email']) ? $_POST['email'] : false;
        $password = isset($_POST['password']) ? $_POST['password'] : false;
        $confirmarPassword = isset($_POST['confirmarPassword']) ? $_POST['confirmarPassword'] : false;
        $checked = isset($_POST['checked']) ? $_POST['checked'] : false;
        $errores = null;
        // Instancio 
        $crear = new Usuario();
        $crear->setUsuario($usuario);
        $crear->setEmail($email);
        $crear->setPassword($confirmarPassword);
        $comprobarUsuario = $crear->repetidosUsuario();
        $comprobandoEmail = $crear->repetidosEmail();
        //validacion
        if (empty(trim($usuario))) {
            $errores =  "<script>document.getElementById('mdErrorUsuarioPhp').innerHTML='<strong>Error</strong>, Ingrese Alias';</script>";
        } elseif (strlen($usuario) > 12) {
            $errores =  "<script>document.getElementById('mdErrorUsuarioPhp').innerHTML='<strong>Error</strong>, El Alias debe de Tener Max. 12 Caracteres';</script>";
        } elseif ($comprobarUsuario->num_rows > 0) {
            $errores =  "<script>document.getElementById('mdErrorUsuarioPhp').innerHTML='<strong>Error</strong>, Alias Repetido';</script>";
        } else if (empty(trim($email))) {
            $errores =  "<script>document.getElementById('mdErrorEmailPhp').innerHTML='<strong>Error</strong>, Ingrese email';</script>";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errores =  "<script>document.getElementById('mdErrorEmailPhp').innerHTML='<strong>Error</strong>, Ingrese Email Valido';</script>";
        } elseif ($comprobandoEmail->num_rows > 0) {
            $errores =  "<script>document.getElementById('mdErrorEmailPhp').innerHTML='<strong>Error</strong>, Email Repetido';</script>";
        } else  if (empty(trim($password))) {
            $errores =  "<script>document.getElementById('mdErrorPasswordPhp').innerHTML='<strong>Error</strong>, Ingrese Contraseña';</script>";
        } else if (empty(trim($confirmarPassword)) || $confirmarPassword != $password) {
            $errores =  "<script>document.getElementById('mdErrorConfirmarPasswordPhp').innerHTML='<strong>Error</strong>, Las Contraseñas deben de coincidir';</script>";
        } else  if ($checked == 'false') {
            $errores =  "<script>document.getElementById('mdErrorChekedPhp').innerHTML='<strong>Error</strong>, checked no selecionado';</script>";
        } else {
            $crear->crear();
            $errores = 1;
        }
        echo $errores;
    }

    public function actualizar()
    {
        $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : 'null';
        $documentacion = isset($_POST['documentacion']) ? $_POST['documentacion'] : 'null';
        $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : 'null';

        //Capturo el FILES (Avatar).
        $nombreAvatar = $_FILES['avatar']['name'];
        $archivoAvatar = $_FILES['avatar']['tmp_name'];

        //Busco las Ruta en mi fichero del proyecto donde se guarda.
        $ruta = "uploads/imagenes";
        $ruta = $ruta . "/" . $nombreAvatar;
        move_uploaded_file($archivoAvatar, $ruta);

        // Inserto en la Base de Datos la Rutas.
        var_dump($_POST);
    }

    public function panelAdministrativo()
    {
        require_once 'views/layout/header.php';
        require_once 'views/layout/banner.php';
        require_once 'views/layout/nav.php';
        require_once 'views/layout/search.php';
        require_once 'views/layout/sidebarAdministrativo.php';
        require_once 'views/usuario/perfil.php';
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
