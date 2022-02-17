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

  public function setUrl_Avatar($url_Avatar)
  {
    $this->url_Avatar = $url_Avatar;
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
    
    // echo $sql;
    // echo "</br>";
    // echo $this->db->error;
    // die();
    // if ($save) {
    //   $result = true;
    // }
    return $result;
  }

  public function iniciarSesion()
  {
    $resultado = false;
    $sql = "SELECT * FROM Usuarios where Email ='{$this->getEmail()}'";
    $login = $this->db->query($sql);

    //verificacion que existe ese email en la base de datos 
    if ($login && $login->num_rows == 1) {
      $usuario = $login->fetch_object();

      // verifcacion que la password coincidan 
      //($this->password: lo que Obtengo sin cifrar por POST, $usuario->Password: lo que Tengo en la base de datos);
      $vericacion = password_verify($this->password, $usuario->Password);

      if ($vericacion == 1) {
        return $usuario;
        // echo 'Existe la Verificacion del usuario';
      } else {
        // echo 'No Existe la Verificacion de Password';
      }
    } else {
      // echo 'No Existe la Verificacion de Email';
    }

    return $resultado;
  }

  public function repetidosUsuario()
  {
    $resultado = false;
    $sql = "SELECT Usuario FROM Usuarios where Usuario ='{$this->getUsuario()}'";
    $repetidos = $this->db->query($sql);
    if ($repetidos) {
      $resultado = true;
    }
    return $repetidos;
  }

  public function repetidosEmail()
  {
    $resultado = false;
    $sql = "SELECT Email FROM Usuarios where Email ='{$this->getEmail()}'";
    $repetidos = $this->db->query($sql);
    if ($repetidos) {
      $resultado = true;
    }
    return $repetidos;
  }

  public function subirImagen()
  {
    $resultado = false;    
    $sql = "UPDATE Usuarios SET Url_Avatar = '{$this->getUrl_Avatar()}' WHERE Id = {$this->getId()};";
    $imagenSubida = $this->db->query($sql);
    if ($imagenSubida) {
      $resultado = true;
    }
    return $imagenSubida;
  }


  public function actualizarInformacionPublica()
  {
    $resultado = false;    
    $sql = "UPDATE Usuarios SET Usuario = '{$this->getUsuario()}', NumeroDocumento = '{$this->getNumeroDocumento()}', NroTelefono = '{$this->getNroTelefono()}' WHERE Id = {$this->getId()};";

    $actualizar = $this->db->query($sql);
    if ($actualizar) {
      $resultado = true;
    }
    return $actualizar;
  }

  
  public function actualizarInformacionPrivada()
  {
    $resultado = false;    
    $sql = "UPDATE Usuarios SET Nombres = '{$this->getNombres()}', Apellidos = '{$this->getApellidos()}', Email = '{$this->getEmail()}', Direccion = '{$this->getDireccion()}', Pais = '{$this->getPais()}', Ciudad = '{$this->getCiudad()}', CodigoPostal = '{$this->getCodigoPostal()}'  WHERE Id = {$this->getId()};";

    $actualizarInformacionPrivada = $this->db->query($sql);
    if ($actualizarInformacionPrivada) {
      $resultado = true;
    }
    return $actualizarInformacionPrivada;
  }



  public function obtenerTodosPorId()
  {
    $resultado = false;
    $sql = "SELECT * FROM Usuarios WHERE Id = {$this->getId()};";
    $obtenerTodos = $this->db->query($sql);
    if ($obtenerTodos) {
      $resultado = true;
    }
    return $obtenerTodos->fetch_object();
  }


}
