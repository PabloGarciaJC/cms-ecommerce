<?php

class Subcategoria
{
    private $id;
    private $categoriaId;
    private $nombre;
    private $descripcion;
    private $db;

    /// CONSTRUCTOR ///
    public function __construct()
    {
        $this->db = Database::connect();
    }

    //// GETTERS ////
    public function getId()
    {
        return $this->id;
    }

    public function getCategoriaId()
    {
        return $this->categoria_id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    //// SETTERS ////
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setCategoriaId($categoriaId)
    {
        $this->categoria_id = $categoriaId;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    //// CONSULTAS ////

    // Obtener todas las subcategorías
    public function obtenerSubcategorias()
    {
        $sql = "SELECT * FROM subcategorias";
        $listarSubcategorias = $this->db->query($sql);
        return $listarSubcategorias;
    }

    // Obtener una subcategoría por su ID
    public function obtenerSubcategoriaPorId()
    {
        $sql = "SELECT * FROM subcategorias";
        if ($this->getId() != '') {
            $sql .= " WHERE id = {$this->getId()}";
        }

        $listarSubcategoria = $this->db->query($sql);
        return $listarSubcategoria->fetch_object();
    }

    // Obtener subcategorías por categoría (categoria_id)
    public function obtenerSubcategoriasPorCategoria()
    {
        $sql = "SELECT * FROM subcategorias WHERE categoria_id = {$this->getCategoriaId()}";
        $listarSubcategorias = $this->db->query($sql);
        return $listarSubcategorias;
    }

    // Actualizar una subcategoría por su ID
    public function actualizarSubcategoriaPorId()
    {
        $sql = "UPDATE subcategorias 
                SET nombre = '{$this->getNombre()}', descripcion = '{$this->getDescripcion()}', categoria_id = {$this->getCategoriaId()} 
                WHERE id = {$this->getId()}";
        $subcategoria = $this->db->query($sql);
        return $subcategoria;
    }

    // Eliminar una subcategoría
    public function eliminar()
    {
        $result = false;
        $sql = "DELETE FROM subcategorias WHERE id = {$this->id}";
        $delete = $this->db->query($sql);
        if ($delete) {
            $result = true;
        }
        return $result;
    }

    // Crear una nueva subcategoría
    public function crearSubcategoria()
    {
        $sql = "INSERT INTO subcategorias (categoria_id, nombre, descripcion) 
                VALUES ({$this->getCategoriaId()}, '{$this->getNombre()}', '{$this->getDescripcion()}')";
        $crearSubcategoria = $this->db->query($sql);
        return $crearSubcategoria;
    }
}
?>
