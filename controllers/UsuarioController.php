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
        $repositorioUsuario = new Usuario();
        $repositorioUsuario->setUsuario($usuario);
        $repositorioUsuario->setEmail($email);
        $repositorioUsuario->setPassword($confirmarPassword);

     
        //validacion
        if (empty(trim($usuario))) {
            $errores =  "mdErrorUsuarioPhp, Ingrese Alias";
        } elseif (strlen($usuario) > 12) {
            $errores =  "mdErrorUsuarioPhp, El Alias debe de Tener Max. 12 Caracteres";
        } elseif ($repositorioUsuario->repetidosUsuario()) {
            $errores =  "mdErrorUsuarioPhp, Alias Repetido";
        } else if (empty(trim($email))) {
            $errores =  "mdErrorEmailPhp, Ingrese email";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errores =  "mdErrorEmailPhp, Ingrese Email Valido";
        } elseif ($repositorioUsuario->repetidosEmail()) {
            $errores =  "mdErrorEmailPhp, Email Repetido";
        } else  if (empty(trim($password))) {
            $errores =  "mdErrorPasswordPhp, Ingrese Contraseña";
        } else if (empty(trim($confirmarPassword)) || $confirmarPassword != $password) {
            $errores =  "mdErrorConfirmarPasswordPhp, Las Contraseñas deben de coincidir";
        } else  if ($checked == 'false') {
            $errores =  "mdErrorChekedPhp, checked no selecionado";
        }

        if ($errores != "") {
            echo $errores;
            var_dump($errores);
        } else {
            $idUsuario = $repositorioUsuario->crear();
            echo $idUsuario;
        }
    }


    public function iniciarSesion()
    {
        $email = isset($_POST['email']) ? $_POST['email'] : false;
        $password = isset($_POST['password']) ? $_POST['password'] : false;

        $errores = null;

        //instacio
        $iniciarSesion = new Usuario();
        $iniciarSesion->setEmail($email);
        $iniciarSesion->setPassword($password);

        //validacion
        if (empty(trim($email))) {
            $errores = "<script>document.getElementById('mdErrorEmailPhpIniciarSesion').innerHTML='<strong>Error</strong>, Ingrese email';</script>";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errores =  "<script>document.getElementById('mdErrorEmailPhpIniciarSesion').innerHTML='<strong>Error</strong>, Ingrese Email Valido';</script>";
        } else  if (empty(trim($password))) {
            $errores = "<script>document.getElementById('mdErrorPasswordPhpIniciarSesion').innerHTML='<strong>Error</strong>, Ingrese Contraseña';</script>";
        } else {
            echo 'si';
            echo 1;



            // $tes = $iniciarSesion->iniciarSesion();

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
