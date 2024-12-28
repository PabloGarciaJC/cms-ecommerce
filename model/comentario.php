<?php

class Comentario
{
    private $comentario;
    private $calificacion;
    private $producto_id;
    private $usuario_id;
    private $db;

    public function __construct()
    {
        // Conectamos a la base de datos
        $this->db = Database::connect();
    }

    // GETTERS y SETTERS
    public function getComentario()
    {
        return $this->comentario;
    }

    public function setComentario($comentario)
    {
        $this->comentario = $comentario;
    }

    public function getCalificacion()
    {
        return $this->calificacion;
    }

    public function setCalificacion($calificacion)
    {
        $this->calificacion = $calificacion;
    }

    public function getProducto_id()
    {
        return $this->producto_id;
    }

    public function setProducto_id($producto_id)
    {
        $this->producto_id = $producto_id;
    }

    public function getUsuario_id()
    {
        return $this->usuario_id;
    }

    public function setUsuario_id($usuario_id)
    {
        $this->usuario_id = $usuario_id;
    }

    // Método para guardar el comentario en la base de datos
    public function guardar()
    {
        // Creamos la consulta SQL de inserción, incluyendo el campo estatus con un valor predeterminado de 0
        $sql = "INSERT INTO comentarios (comentario, calificacion, producto_id, usuario_id, estatus) 
                VALUES ('{$this->getComentario()}', {$this->getCalificacion()}, {$this->getProducto_id()}, {$this->getUsuario_id()}, 0)";

        // Ejecutamos la consulta SQL
        $save = $this->db->query($sql);

        return $save;
    }

    // Obtener comentarios más recientes
    public function obtenerComentariosRecientes($idProducto)
    {
        $sql = "SELECT comentarios.*, usuarios.Usuario AS Usuario
            FROM comentarios
            INNER JOIN usuarios ON comentarios.usuario_id = usuarios.Id
            WHERE comentarios.producto_id = $idProducto
            ORDER BY comentarios.fecha DESC";
        $result = $this->db->query($sql);
        return $result;
    }

    // Obtener comentarios más valorados
    public function obtenerComentariosValorados($idProducto)
    {
        $sql = "SELECT comentarios.*, usuarios.Usuario AS Usuario
                FROM comentarios
                INNER JOIN usuarios ON comentarios.usuario_id = usuarios.Id
                WHERE comentarios.producto_id = $idProducto
                AND comentarios.calificacion = 5
                ORDER BY comentarios.calificacion DESC";
        $result = $this->db->query($sql);
        return $result;
    }
    

    // Obtener comentarios más antiguos
    public function obtenerComentariosAntiguos($idProducto)
    {
        $sql = "SELECT comentarios.*, usuarios.Usuario AS Usuario
            FROM comentarios
            INNER JOIN usuarios ON comentarios.usuario_id = usuarios.Id
            WHERE comentarios.producto_id = $idProducto
            ORDER BY comentarios.fecha ASC";
        $result = $this->db->query($sql);
        return $result;
    }
}
