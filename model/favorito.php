<?php

class Favorito
{
    private $id;
    private $usuarioId;
    private $productoId;
    private $grupoId;
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

    // Métodos para interactuar con la base de datos

    /**
     * Añadir un producto a los favoritos del usuario.
     */
    public function agregar()
    {
        $sql = "INSERT INTO favoritos (usuario_id, grupo_id) 
                VALUES ('{$this->usuarioId}', '{$this->grupoId}') ";
        $result = $this->db->query($sql);
        return $result ? true : false;
    }

    /**
     * Eliminar un producto de los favoritos del usuario.
     */
    public function eliminar()
    {
        $sql = "DELETE FROM favoritos 
                WHERE usuario_id = '{$this->usuarioId}' 
                AND grupo_id = '{$this->grupoId}'";
        $result = $this->db->query($sql);
        return $result ? true : false;
    }

    /**
     * Verificar si un producto ya está en favoritos del usuario.
     */
    public function existe()
    {
        $sql = "SELECT * FROM favoritos 
                WHERE usuario_id = '{$this->usuarioId}' 
                AND grupo_id = '{$this->grupoId}'";     
        $result = $this->db->query($sql);
        return $result && $result->num_rows > 0;
    }

    /**
     * Listar todos los productos favoritos de un usuario.
     */
    public function listarFavoritos()
    {
        $sql = "SELECT p.* 
                FROM productos p 
                INNER JOIN favoritos f ON p.id = f.producto_id 
                WHERE f.usuario_id = '{$this->usuarioId}'";
        $result = $this->db->query($sql);

        $favoritos = [];
        while ($row = $result->fetch_object()) {
            $favoritos[] = $row;
        }

        return $favoritos;
    }
}
