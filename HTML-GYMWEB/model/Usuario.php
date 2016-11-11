<?php


require_once("/../conexion/bdConexion.php");
include_once("UsuarioMapper.php");

class Usuario {
 
  protected $idUsuario;

  protected $nomUsuario;
 
  protected $password;

  protected $email;

  protected $tipoUsuario;

  protected $nombre;

  protected $apellidos;
  
  /*
    Constructor del usuario
  */
  public function __construct($idUsuario=NULL,$nomUsuario=NULL, $password=NULL, $email=NULL, $tipoUsuario=NULL, $nombre=NULL, $apellidos=NULL) {
    $this->idUsuario = $idUsuario;
    $this->nomUsuario = $nomUsuario;
    $this->password = $password;
    $this->email = $email; 
    $this->tipoUsuario = $tipoUsuario;
    $this->nombre = $nombre;
    $this->apellidos = $apellidos;   
  }
  
  public function getIdUsuario() {
    return $this->idUsuario;
  }

  public function setIdUsuario($idUsuario) {
    $this->$idUsuario = $idUsuario;
  }
    
  public function getPassword() {
    return $this->password;
  }  
       
  public function setPassword($password) {
    $this->password = $password;
  }

   public function getNomUsuario() {
    return $this->nomUsuario;
  }  
       
  public function setNomUsuario($nomUsuario) {
    $this->nomUsuario = $nomUsuario;
  }

  public function getEmail() {
    return $this->email;
  }  
       
  public function setEmail($email) {
    $this->email = $email;
  }

   public function getTipoUsuario() {
    return $this->tipoUsuario;
  }  
       
  public function setTipoUsuario($tipoUsuario) {
    $this->tipoUsuario = $tipoUsuario;
  }

  public function getNombre() {
    return $this->nombre;
  }

  public function setNombre($nombre) {
    $this->nombre = $nombre;
  } 

  public function getApellidos() {
    return $this->apellidos;
  } 
       
  public function setApellidos($apellidos) {
    $this->apellidos = $apellidos;
  }

  /*Obtener Usuario por nombreUsuario*/
  public static function getByUserName($nomUsuario)
    {
        return $resultado = UserMapper::findByUserName($nomUsuario);
    }

    /* Guardamos un Usuario en la BD*/
  public static function guardarUsuario($user){  

      $sqlcrear= "INSERT INTO usuario (nomUsuario,password,email,tipoUsuario,nombre, apellidos) VALUES ('";
      $sqlcrear = $sqlcrear2.$user->getNomUsuario()."','".md5($user->getPassword())."','".$user->getEmail()."','".$user->getTipoUsuario()."','".$user->getNombre()."','".$user->getApellidos()."')";

      mysql_query($sqlcrear2);

      return "Usuario Creado";
  }

  /*Comprobacion existe Usuario... Si existe usuario devuelve true*/
  public static function obtenerDatos($nomUsuario, $password) {
    if ($nomUsuario && $password) {
        if ($res = UsuarioMapper::esValidoUsuario($nomUsuario, $password)) {
                return UsuarioMapper::findByUserName($nomUsuario);
        } else {
                echo "ERROR: Usuario o contrase&ntildea incorrectos.";
            }
        } else {
            return "ERROR, no existe el Ususario";
        }
  }

 

  /*Comprobamos si se puede registrar el Usuario. Si se puede retornamos un TRUE*/  
 public static function registroValido($nomUsuario,$password,$email,$nombre, $apellidos){
      $error = array();
      if (strlen($nomUsuario) < 3 || strlen($nomUsuario) > 30) {
	     $error["nomUsuario"] = "El nombre de Usuario debe tener entre 3 y 15 caracteres.";
	
      }
      if (strlen($password) < 5 || strlen($password) > 15) {
	     $error["password"] = "La contraseña debe tener entre 5 y 15 caracteres.";	
      }
      if (strlen($email) < 5 || strlen($email) > 50) {
       $error["password"] = "La contraseña debe tener entre 5 y 15 caracteres.";  
      }
      if (strlen($nombre) < 3 || strlen($nombre) > 20) {
        $error["nombre"] = "El Nombre debe tener entre 3 y 20 caracteres.";  
      }
      if (strlen($apellidos) < 3 || strlen($apellidos) > 40) {
        $error["password"] = "EL apellido debe tener entre 3 y 50 caracteres.";  
      }
      if (sizeof($error)>0){
	     throw new Exception("No se puede resgistrar el Usuario.");
      }
      if (sizeof($error)==0){
       return true;
      }
      
  }

  public static function update($nomUsuario,$password,$email, $tipoUsuario, $nombre, $apellidos)
  {
      UserMapper::update($nomUsuario,$password,$email, $tipoUsuario, $nombre, $apellidos);
  } 


}
?>