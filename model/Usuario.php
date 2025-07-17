<?php

namespace model;

use config\Database;

class Usuario
{
  private $id;
  private $usuario;
  private $password;
  private $numeroDocumento;
  private $nombres;
  private $apellidos;
  private $email;
  private $nroTelefono;
  private $direccion;
  private $codigoPostal;
  private $pais;
  private $idEstado;
  private $ciudad;
  private $imagen;
  private $url_Documento;
  private $rol;
  private $status;
  private $db;

  public function __construct()
  {
    $this->db = Database::connect();
  }

  //// GETTER //// 

  public function getId()
  {
    return $this->id;
  }

  public function getUsuario()
  {
    return $this->usuario;
  }

  public function getPassword()
  {
    return password_hash($this->db->real_escape_string($this->password), PASSWORD_BCRYPT, ['cost' => 4]);
  }

  public function getNumeroDocumento()
  {
    return $this->numeroDocumento;
  }

  public function getNombres()
  {
    return $this->nombres;
  }

  public function getApellidos()
  {
    return $this->apellidos;
  }

  public function getEmail()
  {
    return $this->email;
  }

  public function getNroTelefono()
  {
    return $this->nroTelefono;
  }

  public function getDireccion()
  {
    return $this->direccion;
  }

  public function getCodigoPostal()
  {
    return $this->codigoPostal;
  }

  public function getPais()
  {
    return $this->pais;
  }

  public function getIdEstado()
  {
    return $this->idEstado;
  }

  public function getCiudad()
  {
    return $this->ciudad;
  }

  public function getImagen()
  {
    return $this->imagen;
  }

  public function getUrlDocumento()
  {
    return $this->url_Documento;
  }

  public function getRol()
  {
    return $this->rol;
  }

  public function getStatus()
  {
    return $this->status;
  }

  //// SETTER //// 

  public function setId($id)
  {
    $this->id = $id;
  }

  public function setUsuario($usuario)
  {
    $this->usuario = $usuario;
  }

  public function setPassword($password)
  {
    $this->password = $password;
  }

  public function setNumeroDocumento($numeroDocumento)
  {
    $this->numeroDocumento = $numeroDocumento;
  }

  public function setNombres($nombres)
  {
    $this->nombres = $nombres;
  }

  public function setApellidos($apellidos)
  {
    $this->apellidos = $apellidos;
  }

  public function setEmail($email)
  {
    $this->email = $email;
  }

  public function setNroTelefono($nroTelefono)
  {
    $this->nroTelefono = $nroTelefono;
  }

  public function setDireccion($direccion)
  {
    $this->direccion = $direccion;
  }

  public function setCodigoPostal($codigoPostal)
  {
    $this->codigoPostal = $codigoPostal;
  }

  public function setPais($pais)
  {
    $this->pais = $pais;
  }

  public function setIdEstado($idEstado)
  {
    $this->idEstado = $idEstado;
  }

  public function setCiudad($ciudad)
  {
    $this->ciudad = $ciudad;
  }

  public function setImagen($imagen)
  {
    $this->imagen = $imagen;
  }

  public function setUrlDocumento($url_Documento)
  {
    $this->url_Documento = $url_Documento;
  }

  public function setRol($rol)
  {
    $this->rol = $rol;
  }

  public function setStatus($status)
  {
    $this->status = $this->db->real_escape_string($status);
  }

  //// CONSULTAS ////

  public function crear()
  {
    $result = false;
    $sql = "INSERT INTO usuarios (Usuario, Password, Email, Rol)";
    $sql .= "VALUES ('{$this->usuario}', '{$this->getPassword()}', '{$this->email}', {$this->getRol()})";
    $result = $this->db->query($sql);
    if ($result) {
      $this->id = $this->db->insert_id;
    }

    return $result;
  }

  public function iniciarSesion()
  {
    $usuario = false;
    $email = $this->getEmail() ?? "";
    $escapedEmail = $this->db->real_escape_string($email);
    $sql = "SELECT u.*, r.nombre AS rol_nombre FROM usuarios u INNER JOIN roles r ON u.Rol = r.id WHERE u.Email = '$escapedEmail'";
    $login = $this->db->query($sql);

    if ($login && $login->num_rows == 1) {
      $usuario = $login->fetch_object();

      $roleId = $usuario->Rol;
      $sqlPermisos = "SELECT permission FROM permissions WHERE role_id = $roleId";
      $resultPermisos = $this->db->query($sqlPermisos);

      $permissions = [];
      if ($resultPermisos) {
        while ($perm = $resultPermisos->fetch_assoc()) {
          $permissions[] = $perm['permission'];
        }
      }

      $usuario->permissions = $permissions;
    }

    return $usuario;
  }

  public function repetidosUsuario()
  {
    $resultado = false;
    $sql = "SELECT Usuario FROM usuarios WHERE Usuario = '{$this->usuario}'";
    $repetidos = $this->db->query($sql);
    if ($repetidos && $repetidos->num_rows > 0) {
      $resultado = true;
    }
    return $resultado;
  }

  public function repetidosEmail()
  {
    $resultado = false;
    $sql = "SELECT Email FROM usuarios WHERE Email = '{$this->email}'";
    $repetidos = $this->db->query($sql);
    if ($repetidos && $repetidos->num_rows > 0) {
      $resultado = true;
    }
    return $resultado;
  }

  public function subirImagen()
  {
    $resultado = false;
    $sql = "UPDATE usuarios SET imagen = '{$this->imagen}' WHERE Id = {$this->id}";
    $imagenSubida = $this->db->query($sql);
    if ($imagenSubida) {
      $resultado = true;
    }
    return $resultado;
  }

  public function actualizar()
  {
    $resultado = false;
    $sql = "UPDATE usuarios SET Usuario = '{$this->usuario}', NumeroDocumento = '{$this->numeroDocumento}', Nombres = '{$this->nombres}',  Apellidos = '{$this->apellidos}', NroTelefono = '{$this->nroTelefono}', Direccion = '{$this->direccion}', Pais = '{$this->pais}',  Ciudad = '{$this->ciudad}', CodigoPostal = '{$this->codigoPostal}' WHERE Id = {$this->id}";
    $actualizar = $this->db->query($sql);
    if ($actualizar) {
      $resultado = true;
    }
    return $resultado;
  }

  public function obtenerTodosPorId()
  {
    $sql = "SELECT u.*, r.nombre AS rol_nombre, r.descripcion AS rol_descripcion FROM usuarios u INNER JOIN roles r ON u.Rol = r.id WHERE u.Id = {$this->id}";
    $obtenerTodos = $this->db->query($sql);
    return $obtenerTodos->fetch_object();
  }

  public function actualizarPassword()
  {
    $sql = "UPDATE usuarios SET Password = '{$this->password}' WHERE Id = {$this->id}";
    $resultado = $this->db->query($sql);
    return $resultado;
  }

  public function actualizarRol()
  {
    $sql = "UPDATE usuarios SET Rol = '{$this->rol}' WHERE Id = {$this->id}";
    $resultado = $this->db->query($sql);
    return $resultado;
  }

  public function obtenerTodosLosUsuarios()
  {
    $sql = "SELECT u.Id AS usuario_id, u.Usuario AS usuario_alias, u.NumeroDocumento AS usuario_numero_documento, u.Nombres AS usuario_nombres, u.Apellidos AS usuario_apellidos, u.Email AS usuario_email, u.NroTelefono AS usuario_telefono, u.Direccion AS usuario_direccion, u.Pais AS usuario_pais, u.Ciudad AS usuario_ciudad, u.CodigoPostal AS usuario_codigo_postal, u.Rol AS usuario_rol, u.status AS usuario_status, u.imagen AS usuario_imagen, r.id AS rol_id, r.nombre AS rol_nombre FROM usuarios u INNER JOIN roles r ON u.Rol = r.id";
    return $this->db->query($sql);
  }

  public function existeUsuarioConRolAdmin()
  {
    $sql = "SELECT COUNT(*) AS count FROM usuarios WHERE Rol = 2";
    $result = $this->db->query($sql);
    $data = $result->fetch_object();
    return $data->count > 0;
  }

  public function esRolActualAdmin($id)
  {
    $sql = "SELECT Rol FROM usuarios WHERE Id = {$id}";
    $result = $this->db->query($sql);
    $data = $result->fetch_object();
    return isset($data->Rol) && $data->Rol == 2;
  }

  public function actualizarRolYStatus()
  {
    $sql = "UPDATE usuarios SET Rol = '{$this->rol}', status = '{$this->status}' WHERE Id = {$this->id}";
    return $this->db->query($sql);
  }

  public function obtenerTotalClientes()
  {
    $sql = "SELECT COUNT(*) AS total_clientes FROM usuarios";
    $query = $this->db->query($sql);

    if ($query && $row = $query->fetch_object()) {
      return $row->total_clientes;
    }

    return 0;
  }
}
