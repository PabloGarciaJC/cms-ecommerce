<?php

class Rol
{
    private $id;
    private $nombre;
    private $descripcion;
    private $created;
    private $updated;
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

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function getCreated()
    {
        return $this->created;
    }

    public function getUpdated()
    {
        return $this->updated;
    }

    //// SETTERS ////

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    public function setCreated($created)
    {
        $this->created = $created;
    }

    public function setUpdated($updated)
    {
        $this->updated = $updated;
    }

    //// MÉTODOS CRUD ////

    public function obtenerTodos()
    {
        $sql = "SELECT * FROM roles";
        $result = $this->db->query($sql);
        return $result;
    }

    public function obtenerPorId()
    {
        $sql = "SELECT * FROM roles WHERE id = {$this->getId()}";
        $result = $this->db->query($sql);
        return $result->fetch_object();
    }

    public function crear()
    {
        $sql = "INSERT INTO roles (nombre, descripcion, created, updated) VALUES (
            '{$this->getNombre()}', 
            '{$this->getDescripcion()}', 
            NOW(), 
            NOW()
        )";

        $result = $this->db->query($sql);
        return $result;
    }

    public function actualizar()
    {
        $sql = "UPDATE roles SET 
                nombre = '{$this->getNombre()}',  
                descripcion = '{$this->getDescripcion()}', 
                updated = NOW() 
                WHERE id = {$this->getId()}";

        $result = $this->db->query($sql);
        return $result;
    }

    public function eliminar()
    {
        $sql = "DELETE FROM roles WHERE id = {$this->getId()}";
        $result = $this->db->query($sql);
        return $result;
    }
}
?>
