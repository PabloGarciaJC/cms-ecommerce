<?php

class Comentario
{

    private $id;
    private $estado;
    private $comentario;
    private $calificacion;
    private $producto_id;
    private $usuario_id;
    private $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    //// GETTERS ////

    public function getId()
    {
        return $this->id;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function getComentario()
    {
        return $this->comentario;
    }

    public function getCalificacion()
    {
        return $this->calificacion;
    }

    public function getProducto_id()
    {
        return $this->producto_id;
    }

    public function getUsuario_id()
    {
        return $this->usuario_id;
    }

    //// SETTERS ////

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    public function setComentario($comentario)
    {
        $this->comentario = $comentario;
    }

    public function setCalificacion($calificacion)
    {
        $this->calificacion = $calificacion;
    }

    public function setProducto_id($producto_id)
    {
        $this->producto_id = $producto_id;
    }

    public function setUsuario_id($usuario_id)
    {
        $this->usuario_id = $usuario_id;
    }

    //// CONSULTAS //// 

    public function guardar()
    {
        $sql = "INSERT INTO comentarios (comentario, calificacion, producto_id, usuario_id, estado) 
                VALUES ('{$this->getComentario()}', {$this->getCalificacion()}, {$this->getProducto_id()}, {$this->getUsuario_id()}, 0)";

        $save = $this->db->query($sql);

        return $save;
    }

    public function obtenerComentariosValorados($idProducto)
    {
        $sql = "SELECT comentarios.*, usuarios.Usuario AS Usuario
            FROM comentarios
            INNER JOIN usuarios ON comentarios.usuario_id = usuarios.Id
            WHERE comentarios.producto_id = $idProducto AND comentarios.estado = 1
            ORDER BY comentarios.calificacion DESC";
        $result = $this->db->query($sql);
        return $result;
    }

    public function obtenerComentariosMenorCalificacion($idProducto)
    {
        $sql = "SELECT comentarios.*, usuarios.Usuario AS Usuario
                FROM comentarios
                INNER JOIN usuarios ON comentarios.usuario_id = usuarios.Id
                WHERE comentarios.producto_id = $idProducto AND comentarios.estado = 1
                ORDER BY comentarios.calificacion ASC";
        $result = $this->db->query($sql);
        return $result;
    }

    public function cambiarEstadoComentario()
    {
        $estado = ($this->getEstado() === 'pendiente') ? 'aprobado' : 'pendiente';
        $sql = "UPDATE comentarios SET estado = '{$this->getEstado()}' WHERE id = {$this->getId()}";
        $result = $this->db->query($sql);
        return $result;
    }

    public function getComentarios()
    {
        $sql = "SELECT c.id, c.producto_id, c.usuario_id, c.comentario, c.calificacion, c.fecha, c.estado, u.Usuario, p.nombre AS producto_nombre
                FROM comentarios c
                JOIN usuarios u ON c.usuario_id = u.Id
                JOIN productos p ON c.producto_id = p.id";
    
        $result = $this->db->query($sql);
        return $result;
    }
    
    public function obtenerPromedioCalificacion($idProducto)
    {
        $sql = "SELECT AVG(calificacion) AS promedio FROM comentarios 
            WHERE producto_id = $idProducto AND estado = 1";
        $result = $this->db->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_object();
            return $row->promedio;
        }
        return 0;
    }
}
