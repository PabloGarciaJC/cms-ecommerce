<?php

class Favorito
{
    private $id;
    private $usuarioId;
    private $productoId;
    private $grupoId;
    private $idioma;
    private $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getUsuarioId()
    {
        return $this->usuarioId;
    }

    public function getProductoId()
    {
        return $this->productoId;
    }

    public function getGrupoId()
    {
        return $this->grupoId;
    }

    public function getIdioma()
    {
        return $this->idioma;
    }

    // Setters
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setUsuarioId($usuarioId)
    {
        $this->usuarioId = $usuarioId;
    }

    public function setProductoId($productoId)
    {
        $this->productoId = $productoId;
    }

    public function setGrupoId($grupoId)
    {
        $this->grupoId = $grupoId;
    }

    public function setIdioma($idioma)
    {
        $this->idioma = $idioma;
    }

    //// CONSULTAS //// 

    public function agregar()
    {
        $sql = "INSERT INTO favoritos (usuario_id, grupo_id) VALUES ('{$this->usuarioId}', '{$this->getGrupoId()}') ";
        $result = $this->db->query($sql);
        return $result ? true : false;
    }

    public function eliminar()
    {
        $sql = "DELETE FROM favoritos WHERE id = {$this->getId()} AND usuario_id = '{$this->getUsuarioId()}'";
        $result = $this->db->query($sql);
        return $result ? true : false;
    }

    public function eliminarFronted()
    {
        $sql = "DELETE FROM favoritos WHERE usuario_id = {$this->getUsuarioId()} AND grupo_id = {$this->getGrupoId()};";
        var_dump($sql);
        die();
        $result = $this->db->query($sql);
        return $result ? true : false;
    }

    public function existe()
    {
        $sql = "SELECT * FROM favoritos fv WHERE  fv.usuario_id = '{$this->getUsuarioId()}' AND  fv.grupo_id = '{$this->getGrupoId()}'";
        $result = $this->db->query($sql);
        return $result && $result->num_rows > 0;
    }

    public function listarFavoritos()
    {
        $idioma = empty($this->getIdioma()) ? 1 : $this->getIdioma();
        $sql = "SELECT fv.id, p.id as producto_id, p.parent_id, p.nombre, p.imagenes, p.stock, p.oferta FROM favoritos fv LEFT JOIN usuarios u ON fv.usuario_id = u.Id LEFT JOIN productos p ON p.grupo_id = fv.grupo_id WHERE p.idioma_id = $idioma";
        $result = $this->db->query($sql);
        $favoritos = [];
        while ($row = $result->fetch_object()) {
            $favoritos[] = $row;
        }
        return $favoritos;
    }
}
