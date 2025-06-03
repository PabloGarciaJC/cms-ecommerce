<?php

namespace model;
use config\Database;

class Permission
{
    private $id;
    private $role_id;
    private $permission;
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

    public function getRoleId()
    {
        return $this->role_id;
    }

    public function getPermission()
    {
        return $this->permission;
    }

    //// SETTERS ////

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setRoleId($role_id)
    {
        $this->role_id = $role_id;
    }

    public function setPermission($permission)
    {
        $this->permission = $this->db->real_escape_string($permission);
    }

    //// MÉTODOS ////

    // Obtener todos los permisos
    public function getAll()
    {
        $sql = "SELECT * FROM permissions";
        return $this->db->query($sql);
    }

    // Obtener permisos por role_id
    public function getByRoleId()
    {
        $sql = "SELECT * FROM permissions WHERE role_id = {$this->getRoleId()}";
        return $this->db->query($sql);
    }

    // Crear nuevo permiso
    public function create()
    {
        $sql = "INSERT INTO permissions (role_id, permission) VALUES (
            {$this->getRoleId()},
            '{$this->getPermission()}'
        )";

        return $this->db->query($sql);
    }

    // Borrar permiso por id
    public function delete()
    {
        $sql = "DELETE FROM permissions WHERE id = {$this->getId()}";
        return $this->db->query($sql);
    }

    // Borrar todos los permisos de un role
    public function deleteByRole()
    {
        $sql = "DELETE FROM permissions WHERE role_id = {$this->getRoleId()}";
        return $this->db->query($sql);
    }

    // Verificar si existe un permiso específico para un role
    public function exists()
    {
        $sql = "SELECT 1 FROM permissions WHERE role_id = {$this->getRoleId()} AND permission = '{$this->getPermission()}' LIMIT 1";
        $result = $this->db->query($sql);
        return $result->num_rows > 0;
    }
}
