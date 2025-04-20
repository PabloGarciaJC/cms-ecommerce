<?php

namespace model;
use config\Database;

class Idiomas
{
    private $id;
    private $codigo;
    private $nombre;
    private $estado;
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

    public function getCodigo()
    {
        return $this->codigo;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    //// SETTERS ////

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    //// CONSULTAS //// 

    public function guardar()
    {
        $sql = "INSERT INTO idiomas (codigo, nombre, estado) VALUES ('$this->codigo', '$this->nombre', $this->estado)";
        $save = $this->db->query($sql);
        return $save;
    }

    public function obtenerTodos()
    {
        $sql = "SELECT * FROM idiomas";
        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function obtenerPorId($id)
    {
        $sql = "SELECT * FROM idiomas WHERE id = $id";
        $result = $this->db->query($sql);
        return $result->fetch_object();
    }

    public function actualizar()
    {
        $sql = "UPDATE idiomas SET codigo = '$this->codigo', nombre = '$this->nombre', estado = $this->estado WHERE id = $this->id";
        $update = $this->db->query($sql);
        return $update;
    }

    public function eliminar()
    {
        $sql = "DELETE FROM idiomas WHERE id = $this->id";
        $delete = $this->db->query($sql);
        return $delete;
    }
}
