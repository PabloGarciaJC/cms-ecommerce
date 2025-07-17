<?php

namespace controllers;

use model\Usuario;
use model\Idiomas;
use controllers\LanguageController;
use logger\LoggerWrapper;
use model\Permission;

class UsuarioController
{
    private $languageController;
    private $idiomas;

    public function __construct(?LanguageController $languageController = null, ?Idiomas $idiomas = null)
    {
        $this->languageController = $languageController ?? new LanguageController();
        $this->idiomas = $idiomas ?? new Idiomas();
    }

    // Configuración del idioma
    private function cargarConfiguracionIdioma()
    {
        $getIdiomas = $this->idiomas->obtenerTodos();

        if (isset($_POST['lenguaje'])) {
            $this->languageController->setIdioma($_POST['lenguaje']);
        }

        $this->languageController->cargarTextos();

        return $getIdiomas;
    }

    // Registro de usuario
    public function registro(?Usuario $ObjUsuario = null)
    {
        $this->cargarConfiguracionIdioma();
        $usuario = $_POST['usuario'] ?? false;
        $email = $_POST['email'] ?? false;
        $password = $_POST['password'] ?? false;
        $confirmarPassword = $_POST['confirmarPassword'] ?? false;
        $checked = $_POST['checked'] ?? false;
        $ObjUsuario = $ObjUsuario ?? new Usuario();
        $ObjUsuario->setUsuario($usuario);
        $ObjUsuario->setEmail($email);
        $ObjUsuario->setRol(1);

        $errores = [];

        if (empty($usuario)) $errores[] = ERROR_EMPTY_USERNAME;
        if (empty($email)) $errores[] = ERROR_EMPTY_EMAIL;
        if (empty($password)) $errores[] = ERROR_EMPTY_PASSWORD;
        if (empty($confirmarPassword)) $errores[] = ERROR_EMPTY_CONFIRM_PASSWORD;
        if ($password !== $confirmarPassword) $errores[] = ERROR_PASSWORD_MISMATCH;
        if (empty($checked)) $errores[] = ERROR_TERMS_NOT_ACCEPTED;
        if ($ObjUsuario->repetidosUsuario()) $errores[] = ERROR_USERNAME_EXISTS;
        if ($ObjUsuario->repetidosEmail()) $errores[] = ERROR_EMAIL_EXISTS;

        if (count($errores) > 0) {
            echo json_encode([
                'titulo' => TEXT_REGISTRATION_ERRORS_TITLE,
                'success' => false,
                'message' => $errores,
                'boton' => TEXT_ACCEPT_BUTTON
            ]);
            exit();
        } else {
            $ObjUsuario->setPassword($confirmarPassword);
            $ObjUsuario->crear();
            $sesionCompletado = $ObjUsuario->iniciarSesion();

            if ($sesionCompletado && is_object($sesionCompletado)) {
                $_SESSION['usuarioRegistrado'] = $sesionCompletado;
            }
            //  Log de éxito de registro
            $logger = LoggerWrapper::getInstance();
            if ($logger) {
                $logger->info('Usuario Registrado');
            }
            echo json_encode([
                'titulo' => TEXT_REGISTRATION_SUCCESS_TITLE,
                'success' => true,
                'boton' => TEXT_REVIEW_BUTTON
            ]);
        }
    }

    // Iniciar sesión de usuario
    public function iniciarSesion(?Usuario $registro = null)
    {
        $this->cargarConfiguracionIdioma();
        $email = $_POST['email'] ?? false;
        $password = $_POST['password'] ?? false;
        $usuario = $registro ?? new Usuario();
        $usuario->setEmail($email);
        $sesionCompletado = $usuario->iniciarSesion();

        $errores = [];

        if (empty($email)) $errores[] = ERROR_EMPTY_EMAIL;
        if (empty($password)) $errores[] = ERROR_EMPTY_PASSWORD;
        if (!$usuario->repetidosEmail()) $errores[] = TEXT_EMAIL_NOT_REGISTERED;
        if (!empty($sesionCompletado) && !password_verify($password, $sesionCompletado->Password)) {
            $errores[] = TEXT_INCORRECT_PASSWORD;
        }

        if (count($errores) > 0) {
            echo json_encode([
                'titulo' => TEXT_LOGIN_ERRORS_TITLE,
                'success' => false,
                'message' => $errores,
                'boton' => TEXT_ACCEPT_BUTTON
            ]);
            exit();
        }

        if ($sesionCompletado && is_object($sesionCompletado)) {
            $permissions = property_exists($sesionCompletado, 'permissions') ? $sesionCompletado->permissions : [];
            $onlyWrite = count($permissions) === 1 && in_array('write', $permissions);
            if ($sesionCompletado->status === 'active' && $onlyWrite) {
                echo json_encode([
                    'success' => true,
                    'status' => false,
                    'titulo' => PROTECTION_LAYER_TITLE,
                    'message' => PROTECTION_LAYER_MESSAGE,
                    'boton' => PROTECTION_LAYER_BTN
                ]);
                exit();
            } else {
                $_SESSION['usuarioRegistrado'] = $sesionCompletado;
                $logger = \logger\LoggerWrapper::getInstance();
                if ($logger) {
                    $logger->info('Usuario logeado con permisos de cliente');
                }
                echo json_encode([
                    'success' => true,
                    'status' => true,
                    'titulo' => TEXT_LOGIN_SUCCESS_TITLE,
                    'message' => LOGIN_SUCCESS,
                    'boton' => TEXT_REVIEW_BUTTON,
                ]);
            }
            exit();
        } else {
            echo json_encode([
                'success' => false,
                'message' => [TEXT_LOGIN_FAILURE]
            ]);
            exit();
        }
    }
}
