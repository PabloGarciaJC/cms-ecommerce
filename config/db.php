<?php
class Database {

    static public function connect(){
        // Conexion a la base de datos usando Docker Compose
        $db = new mysqli('mysql', DB_USER, DB_PASSWORD, DB_DATABASE);   
        
        // Verificar conexion
        if ($db->connect_error) {
            die("Error de conexion: " . $db->connect_error);
        }
        
        $db->set_charset("utf8");

        return $db;
    }
}



