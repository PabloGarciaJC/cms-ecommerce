<?php

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
  private $id_Pais;
  private $id_Estado;
  private $id_Ciudad;
  private $url_Avatar;
  private $url_Documento;
  private $db;

  ///CONSTRUCTOR///
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

  public function getId_Pais()
  {
    return $this->id_Pais;
  }

  public function getId_Estado()
  {
    return $this->id_Estado;
  }

  public function getId_Ciudad()
  {
    return $this->id_Ciudad;
  }

  public function getUrl_Avatar()
  {
    return $this->url_Avatar;
  }

  public function getUrl_Documento()
  {
    return $this->url_Documento;
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

  public function setId_Pais($id_Pais)
  {
    $this->id_Pais = $id_Pais;
  }

  public function setId_Estado($id_Estado)
  {
    $this->id_Estado = $id_Estado;
  }

  public function setId_Ciudad($id_Ciudad)
  {
    $this->id_Ciudad = $id_Ciudad;
  }

  public function setUrl_Avatar($url_Avatar)
  {
    $this->url_Avatar = $url_Avatar;
  }

  public function setUrl_Documento($url_Documento)
  {
    $this->url_Documento = $url_Documento;
  }

  // Consultas

  public function repetidosUsuario()
  {
    $sql = "SELECT Usuario FROM Usuarios where Usuario ='{$this->getUsuario()}'";
    $repetidos = $this->db->query($sql);

    if ($repetidos->num_rows == 1) {
      return true;
    }
    return false;
  }

  public function repetidosEmail()
  {
    $sql = "SELECT Email FROM Usuarios where Email ='{$this->getEmail()}'";
    $repetidos = $this->db->query($sql);
   
    if ($repetidos->num_rows == 1) {
      return true;
    }
    return false;
  }


  public function crear()
  {
    $idUsuario = 0;

    $sql = "INSERT INTO usuarios (Usuario,
                                  Password, 
                                  Email)";

    $sql .= "VALUES ('{$this->usuario}',
                    '{$this->getPassword()}',
                    '{$this->email}');";

    $saved = $this->db->query($sql);

    if ($saved) {
      $sql = "SELECT MAX(Id) as id FROM usuarios";
      $saved = $this->db->query($sql);
      $idUsuario = ($saved->fetch_object())->id;
    }

    return $idUsuario;
  }

  public function iniciarSesion()
  {
    $resultado = false;
    $sql = "SELECT Email FROM Usuarios where Email ='{$this->getEmail()}'";
    $login = $this->db->query($sql);

    if ($login && $login->num_rows == 1) {
      $usuario = $login->fetch_object();
      $vericacion = password_verify($this->getPassword, $usuario->Password);
    }
    // echo $sql;
    // echo "</br>";
    // echo $this->db->error;
    // die();

    if ($vericacion) {
      $resultado = true;
    }
    return $login;
  }
}
