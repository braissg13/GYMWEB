<?php


include_once __DIR__."/../conexion/bdConexion.php";
include_once __DIR__."/../model/UsuarioMapper.php";

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
        return $resultado = UsuarioMapper::findByUserName($nomUsuario);
    }

    /* Guardamos un Usuario en la BD*/
  public static function guardarUsuario($user){  
    return UsuarioMapper::guardarUsuario($user);
  }

  /*Comprobacion existe Usuario... Si existe usuario devuelve un Objeto Usuario*/
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
	     $error["nomUsuario"] = "El nombre de Usuario debe tener entre 3 y 30 caracteres.";
      }
      if (strlen($password) < 5 || strlen($password) > 15) {
	     $error["password"] = "La contraseña debe tener entre 5 y 15 caracteres.";	
      }
      if (strlen($email) < 5 || strlen($email) > 50) {
       $error["email"] = "El email debe tener entre 5 y 50 caracteres.";  
      }
      if (strlen($nombre) < 3 || strlen($nombre) > 20) {
        $error["nombre"] = "El Nombre debe tener entre 3 y 20 caracteres.";  
      }
      if (strlen($apellidos) < 3 || strlen($apellidos) > 40) {
        $error["apellidos"] = "EL apellido debe tener entre 3 y 40 caracteres.";  
      }
      if (sizeof($error)>0){
	     echo "No se puede resgistrar el Usuario por los siguientes motivos: ";
       print_r(array_values($error));

      }
      if (sizeof($error)==0){
       return true;
      }
      
  }

  public static function update($idUsuario,$nomUsuario,$password,$email, $tipoUsuario, $nombre, $apellidos)
  {
      UsuarioMapper::update($idUsuario,$nomUsuario,$password,$email, $tipoUsuario, $nombre, $apellidos);
  } 


}
?>