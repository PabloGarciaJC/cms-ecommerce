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


        //Repoblar Formulario
        $form = array();
        $form["usuario"] = $usuario;
        $form["email"] = $email;
        $form["password"] = $password;
        $form["confirmarPassword"] = $confirmarPassword;
        //Reclutar Errores 
        $errores = array();

        //Validar los datos
        if (empty(trim($usuario)) || is_numeric($usuario) || preg_match("/[0-9]/", $usuario)) {
            $errores["usuario"] = "el formato de Usuario es incorrecto";
        }

        if (empty(trim($email)) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errores["email"] = "Error, el formato de Email es incorrecto";
        }

        if (empty(trim($password))) {
            $errores["password"] = "Error, el formato de Password es incorrecto";
        }

        if (empty(trim($confirmarPassword)) || $confirmarPassword != $password) {
            $errores["confirmarPassword"] = "Error, Las Contraseñas deben de Coincidir";
        }
        if ($checked == 'false') {
            $errores["checked"] = "Error, checked no selecionado";
        }

        // Instancio 
        $crear = new Usuario();
        $crear->setUsuario($usuario);
        $crear->setEmail($email);
        $crear->setPassword($confirmarPassword);

        if (count($errores) == 0) {
            $guardar = $crear->crear();
        } else {            
            if ($errores['usuario'] == 'el formato de Usuario es incorrecto') {
                echo $errores['usuario'];
            } else {
                echo $errores['email'];
            }
        }
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
