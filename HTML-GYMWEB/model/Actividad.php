<?php


include_once __DIR__."/../conexion/bdConexion.php";
include_once __DIR__."/../model/ActividadMapper.php";

class Actividad {

  protected $idActividad;

  protected $nomAct;

  protected $numPl;

  protected $dateAct;

  protected $descAct;

  protected $imagen;

  /*
    Constructor de la Actividad
  */
  public function __construct($idActividad=NULL,$nomAct=NULL, $numPl=NULL, $dateAct=NULL, $descAct=NULL, $imagen=NULL) {
    $this->idActividad = $idActividad;
    $this->nomAct = $nomAct;
    $this->numPl = $numPl;
    $this->dateAct = $dateAct;
    $this->descAct = $descAct;
    $this->imagen = $imagen;
  }

  public function getIdActividad() {
    return $this->idActividad;
  }

  public function setIdActividad($idActividad) {
    $this->$idActividad = $idActividad;
  }

  public function getNomActividad() {
    return $this->nomAct;
  }

  public function setNomActividad($nomAct) {
    $this->nomAct = $nomAct;
  }

  public function getDescActividad() {
    return $this->descActividad;
  }

  public function setDescActividad($descAct) {
    $this->descAct = $descAct;
  }

  public function getnumPlazas() {
    return $this->numPl;
  }

  public function setNumPlazas($numPl) {
    $this->numPl = $numPl;
  }

  public function getFecha() {
    return $this->dateAct;
  }

  public function setFecha($dateAct) {
    $this->dateAct = $dateAct;
  }

  public function getImagenActividad() {
    return $this->imagen;
  }

  public function setImagenActividad($imagen) {
    $this->imagen = $imagen;
  }

  /*Obtener todos las Actividades*/
  public static function getAllActividades()
    {
        return $resultado = ActividadMapper::findAll();
    }

    /* Guardamos una Actividad en la BD*/
  public static function guardarActividad($actividad){
    return ActividadMapper::guardarActividad($actividad);
  }

  /*Comprobacion existe Actividad... Si existe actividad devuelve Objeto Actividad*/
  public static function obtenerDatos($idActividad) {
    if ($idActividad) {
        if ($res = ActividadMapper::esValidoActividad($idActividad)) {
                return ActividadMapper::findByIdActividad($idActividad);
        } else {
                echo "ERROR: La actividad no existe.";
            }
        } else {
            return "ERROR, no existe la actividad";
        }
  }



  /*Comprobamos si se puede registrar la Actividad. Si se puede retornamos un TRUE*/
 public static function registroValido($nomAct,$numPl,$dateAct,$descAct){
      $error = array();
      if (strlen($nomAct) < 3 || strlen($nomAct) > 30) {
	     $error["nomAct"] = "El nombre de la Actividad debe tener entre 3 y 30 caracteres.";
      }
      if (strlen($descAct) < 5 || strlen($descAct) > 500) {
	     $error["descAct"] = "La descripcion de la Actividad debe tener entre 5 y 300 caracteres.";
      }
      if (strlen($numPl) < 1 || strlen($numPl) > 15) {
       $error["numPl"] = "El numero de plazas de la Actividad debe tener entre 1 y 2 digitos.";  
      }
      if (sizeof($error)>0){
	     echo "No se puede resgistrar la Actividad por los siguientes motivos: ";
       print_r(array_values($error));

      }
      if (sizeof($error)==0){
       return true;
      }

  }

  public static function update($idActividad,$nomAct,$numPl,$dateAct, $descAct, $imagen){
      ActividadMapper::update($idActividad,$nomAct,$numPl,$dateAct, $descAct, $imagen);
  }

  public static function delete($idActividad){
      ActividadMapper::delete($idActividad);
  }

}
?>
