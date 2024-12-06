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
  private $pais;
  private $idEstado;
  private $ciudad;
  private $imagen;
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

  public function getPais()
  {
    return $this->pais;
  }

  public function getidEstado()
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

  public function setPais($pais)
  {
    $this->pais = $pais;
  }

  public function setidEstado($idEstado)
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

  public function setUrl_Documento($url_Documento)
  {
    $this->url_Documento = $url_Documento;
  }

  // Consultas

  public function crear()
  {
    $result = false;

    $sql = "INSERT INTO usuarios (Usuario,
                                  Password,
                                  Email)";

    $sql .= "VALUES ('{$this->usuario}',
                    '{$this->getPassword()}',    
                    '{$this->email}')";

    $save = $this->db->query($sql);
    
    return $result;
  }

  public function iniciarSesion()
  {
    $resultado = false;
    $sql = "SELECT * FROM usuarios where Email ='{$this->getEmail()}'";
    $login = $this->db->query($sql);
    //verificacion que existe ese email en la base de datos 
    if ($login && $login->num_rows == 1) {
      $usuario = $login->fetch_object();
      $vericacion = password_verify($this->password, $usuario->Password);
      // if ($vericacion == 1) {
      //   return $usuario;
      // } 

      return $usuario;
    }
    return $resultado;
  }

  public function repetidosUsuario()
  {
    $resultado = false;
    $sql = "SELECT Usuario FROM usuarios where Usuario ='{$this->getUsuario()}'";
    $repetidos = $this->db->query($sql);
    if ($repetidos) {
      $resultado = true;
    }
    return $repetidos;
  }

  public function repetidosEmail()
  {
      $resultado = false;
      // Asegurarse de que estamos excluyendo al usuario actual al hacer la consulta
      $sql = "SELECT Email FROM usuarios WHERE Email = '{$this->getEmail()}' AND id != '{$this->getId()}'";
      $repetidos = $this->db->query($sql);
  
      // Si existe algún resultado, significa que el email está en uso por otro usuario
      if ($repetidos && $repetidos->num_rows > 0) {
          $resultado = true;
      }
  
      return $repetidos;
  }
  
  
  public function subirImagen()
  {
    $resultado = false;    
    $sql = "UPDATE usuarios SET imagen = '{$this->getImagen()}' WHERE Id = {$this->getId()};";
    $imagenSubida = $this->db->query($sql);
    if ($imagenSubida) {
      $resultado = true;
    }
    return $resultado;
  }


  public function actualizar()
  {
    $resultado = false;    
    $sql = "UPDATE usuarios SET Usuario = '{$this->getUsuario()}', Password = '{$this->getPassword()}', NumeroDocumento = '{$this->getNumeroDocumento()}', Nombres = '{$this->getNombres()}', Apellidos = '{$this->getApellidos()}', NroTelefono = '{$this->getNroTelefono()}', Direccion = '{$this->getDireccion()}', Pais = '{$this->getPais()}', Ciudad = '{$this->getCiudad()}', CodigoPostal = '{$this->getCodigoPostal()}' WHERE Id = {$this->getId()};";
    $actualizar = $this->db->query($sql);
    if ($actualizar) {
      $resultado = true;
    }
    return $resultado;
  }

  public function obtenerTodosPorId()
  {
    $resultado = false;
    $sql = "SELECT * FROM usuarios WHERE Id = {$this->getId()};";
    $obtenerTodos = $this->db->query($sql);
    if ($obtenerTodos) {
      $resultado = true;
    } 
    return $obtenerTodos->fetch_object();
  }

}
