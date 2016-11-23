<?php
require_once(__DIR__."/../conexion/bdConexion.php");
require_once(__DIR__."/../model/TablaMapper.php");

class Tabla {
  protected $idTablaEjercicios;
  protected $nomTabla;
  protected $tipoTabla;
  /*
    Constructor del usuario
  */
  public function __construct($idTablaEjercicios=NULL,$nomTabla=NULL, $tipoTabla=NULL) {
    $this->idTablaEjercicios = $idTablaEjercicios;
    $this->nomTabla = $nomTabla;
    $this->tipoTabla = $tipoTabla;
  }
  public function getIdTabla() {
    return $this->idTablaEjercicios;
  }
  public function setIdTabla($idTablaEjercicios) {
    $this->$idTablaEjercicios = $idTablaEjercicios;
  }
   public function getNomTabla() {
    return $this->nomTabla;
  }
  public function setNomTabla($nomTabla) {
    $this->nomTabla = $nomTabla;
  }
  public function getTipoTabla() {
    return $this->tipoTabla;
  }
  public function setTipoTabla($tipoTabla) {
    $this->tipoTabla = $tipoTabla;
  }

  /*Obtener todas las Tablas de Ejercicios*/
  public static function getAllTablas()
  {
    return $resultado = TablaMapper::findAll();
  }

  /*Comprobamos si se puede registrar la Tabla. Si se puede retornamos un TRUE*/
 public static function registroValido($nomTabla){
      $error = array();
      if (strlen($nomTabla) < 3 || strlen($nomTabla) > 30) {
       $error["nomTabla"] = "El nombre de la Tabla debe tener entre 3 y 30 caracteres.";
      }
      if (sizeof($error)>0){
       echo "No se puede resgistrar el Usuario por los siguientes motivos: ";
       print_r(array_values($error));
      }
      if (sizeof($error)==0){
       return true;
      }
  }

   /* Guardamos una Tabla en la BD*/
  public static function guardarTabla($tabla){
    return TablaMapper::guardarTabla($tabla);
  }

  /*Obtenemos datos de la Tabla por su nombre*/
  public static function datosTabla($nomTabla) {
    if ($nomTabla) {
            return TablaMapper::findByNomTabla($nomTabla);
        } else {
            return "ERROR, no existe la tabla";
        }
  }

  public static function asignarEjers($idEjercicio,$idTablaEjercicios){
    return TablaMapper::asignarEjers($idEjercicio,$idTablaEjercicios);
  }

   /*Comprobacion existe Tabla... Si existe tabla devuelve Objeto TABLA*/
  public static function obtenerDatos($idTablaEjercicios) {
    if ($idTablaEjercicios) {
        if ($res = TablaMapper::esValidoTabla($idTablaEjercicios)) {
                return TablaMapper::findByIdTabla($idTablaEjercicios);
        } else {
                echo "ERROR: La tabla no existe.";
            }
        } else {
            return "ERROR, no existe la tabla";
        }
  }

  public static function getEjersTabla($idTablaEjercicios){
     return TablaMapper::getEjersTabla($idTablaEjercicios);
  }

  public static function getDeportistasTabla($idTablaEjercicios){
     return TablaMapper::getDeportistasTabla($idTablaEjercicios);
  }

  public static function update($idTablaEjercicios,$nomTabla,$tipoTabla)
  {
      TablaMapper::update($idTablaEjercicios,$nomTabla,$tipoTabla);
  }

  public static function deleteEjersTabla($idTablaEjercicios){
      TablaMapper::deleteEjersTabla($idTablaEjercicios);
  }

  public static function deleteDeportistaTabla($idTablaEjercicios){
      TablaMapper::deleteDeportistaTabla($idTablaEjercicios);
  }

  public static function deleteComentarioTabla($idTablaEjercicios){
      TablaMapper::deleteComentarioTabla($idTablaEjercicios);
  }

  public static function delete($idTablaEjercicios){
      TablaMapper::delete($idTablaEjercicios);
  }

  public static function asignarDeportistaTabla($idTablaEjercicios,$idUsuario){
      TablaMapper::asignarDeportistaTabla($idTablaEjercicios,$idUsuario);
  }

  public static function borrarDeportistaAsignadoTabla($idTablaEjercicios,$idUsuario){
    TablaMapper::borrarDeportistaAsignadoTabla($idTablaEjercicios,$idUsuario);
  }

  public function borrarComentarioDeportistaTabla($idTablaEjercicios,$idUsuario){
    TablaMapper::borrarComentarioDeportistaTabla($idTablaEjercicios,$idUsuario);
  }

}
?>
