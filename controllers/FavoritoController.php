<?php

namespace controllers;

use model\Favorito;
use model\Usuario;
use model\Idiomas;
use controllers\LanguageController;
use helpers\Utils;

class FavoritoController
{
    private $languageController;

    public function __construct()
    {
        $this->languageController = new LanguageController();
    }

    /**
     * Guarda un producto en los favoritos del usuario.
     */
    public function guardar()
    {
        $this->languageController->cargarTextos();
        $usuario = Utils::obtenerUsuario();
        $grupoId = isset($_POST['grupo_id']) ? $_POST['grupo_id'] : false;

        if (!$usuario) {

            echo json_encode([
                'success' => false,
                'favorito' => false,
                'message' => TEXT_NOT_LOGGED_IN . TEXT_NOT_REGISTER_IN
            ]);
            return;

        } else {

            $favorito = new Favorito();
            $favorito->setUsuarioId($usuario->Id);
            $favorito->setGrupoId($grupoId);
            $existe = $favorito->existe();

            if ($existe) {
                echo json_encode([
                    'success' => true,
                    'favorito' => true,
                    'message' => TEXT_PRODUCT_ALREADY_FAVORITE
                ]);
                return;
            }

            $resultado = $favorito->agregar();

            if ($resultado) {
                echo json_encode([
                    'success' => true,
                    'favorito' => true,
                    'message' => TEXT_PRODUCT_ADDED_FAVORITE
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'favorito' => false,
                    'message' => TEXT_ERROR_ADD_FAVORITE
                ]);
            }
        }
    }

    /**
     * Elimina un producto de los favoritos del usuario.
     */
    public function eliminar()
    {
        
        $this->languageController->cargarTextos();
        $usuario = Utils::obtenerUsuario();
        $grupoId = isset($_POST['grupo_id']) ? $_POST['grupo_id'] : false;

        if (!$usuario) {
            echo json_encode([
                'success' => false,
                'favorito' => false,
                'message' => TEXT_ERROR_NOT_REGISTERED_OR_INVALID_PRODUCT
            ]);
            return;
        }

        $favorito = new Favorito();
        $favorito->setUsuarioId($usuario->Id);
        $favorito->setGrupoId($grupoId);
        $existe = $favorito->existe();

        if (!$existe) {
            echo json_encode([
                'success' => true,
                'favorito' => true,
                'message' => TEXT_PRODUCT_ALREADY_FAVORITE
            ]);
            return;
        }

        $resultado = $favorito->eliminarFronted();

        if ($resultado) {
            echo json_encode([
                'success' => true,
                'favorito' => false,
                'message' => TEXT_PRODUCT_REMOVED_FAVORITE
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'favorito' => false,
                'message' => TEXT_ERROR_REMOVE_FAVORITE
            ]);
        }

    }
}
