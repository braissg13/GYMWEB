<?php
require_once(__DIR__."/../conexion/bdConexion.php");
require_once(__DIR__."/../model/UsuarioMapper.php");

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
  /*Obtener todos las Actividades*/
  public static function getAllUsuarios()
    {
        return $resultado = UsuarioMapper::findAll();
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
  /*Comprobacion existe Usuario...(utilizando usuarioValido(idUsuario)) Si existe usuario devuelve un Objeto Usuario*/
  public static function devolverDatos($idUsuario) {
  /*  if ($nomUsuario) {*/
        if ($res = UsuarioMapper::usuarioValidoId($idUsuario)) {
                return UsuarioMapper::findByUserId($idUsuario);
        } else {
                echo "ERROR: Usuario incorrecto.";
            }
      /*  } else {
            return "ERROR, no existe el Usuario";
        }*/
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

  public static function updateSinPass($idUsuario,$nomUsuario,$email, $tipoUsuario, $nombre, $apellidos)
  {
      UsuarioMapper::updateSinPass($idUsuario,$nomUsuario,$email, $tipoUsuario, $nombre, $apellidos);
  }

   public static function delete($idUsuario){
      UsuarioMapper::delete($idUsuario);
  }

  public static function getAllEntrenadores(){
    return $resultado = UsuarioMapper::findAllEntrenadores();
  }
  //Obtenemos los deportistas que son TDU
  public static function getAllDeportistasTDU(){
    return $resultado = UsuarioMapper::findAllDeportistasTDU();
  }

  //Obtenemos los deportistas que son PEF
  public static function getAllDeportistasPEF(){
    return $resultado = UsuarioMapper::findAllDeportistasPEF();
  }

  public static function getActividadesAsignadas($idUsuario){
    return $resultado = UsuarioMapper::getActividadesAsignadas($idUsuario);
  }

  public static function getTablasEntrenamientos($idUsuario){
    return $resultado = UsuarioMapper::getTablasEntrenamientos($idUsuario);
  }

  public static function deleteEntrenadorActividad($idUsuario){
    UsuarioMapper::deleteEntrenadorActividad($idUsuario);
  }

  public static function deleteDeportistaReserva($idUsuario){
    UsuarioMapper::deleteDeportistaReserva($idUsuario);
  }

  public static function deleteDeportistaTabla($idUsuario){
    UsuarioMapper::deleteDeportistaTabla($idUsuario);
  }

  public static function deleteDeportistaComentario($idUsuario){
    UsuarioMapper::deleteDeportistaComentario($idUsuario);
  }

  public static function addComentario($texto,$fecha,$completado,$idTablaEjercicios,$idUsuario){
    UsuarioMapper::addComentario($texto,$fecha,$completado,$idTablaEjercicios,$idUsuario);
  }

  public static function getComentariosTabla($idTablaEjercicios,$idUsuario){
    return UsuarioMapper::getComentariosTabla($idTablaEjercicios,$idUsuario);
  }
}
?>
