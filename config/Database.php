<?php
namespace config;

use Dotenv\Dotenv;

## ---------------------------------------------------------
## Mostrar todos los errores para depuración
## ---------------------------------------------------------

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

## ---------------------------------------------------------
## Clase para la Conexión a la base de datos
## ---------------------------------------------------------

class Database {
    static public function connect() {


       // Cargar las variables desde .env (si no están ya cargadas)
        if (!getenv('DB_SERVER_NAME')) {
            $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
            $dotenv->load();
        }
        
        // Conexión a la base de datos usando mysqli
        $db = new \mysqli($_ENV['DB_SERVER_NAME'], $_ENV['MYSQL_USER'], $_ENV['MYSQL_PASSWORD'], $_ENV['DB_DATABASE'], $_ENV['MYSQL_PORT']);  

        if ($db->connect_error) {
            die("Error de conexión: " . $db->connect_error);
        }

        $db->set_charset("utf8");

        return $db;
    }
}


// Solo se debe ejecutar la conexión cuando lo necesites, no en el archivo de la clase.
// Database::connect();

?>



