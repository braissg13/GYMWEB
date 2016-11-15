<?php


include_once __DIR__."/../conexion/bdConexion.php";
include_once __DIR__."/../model/ActividadMapper.php";

class Actividad {

  protected $idActividad;

  protected $nomActividad;

  protected $totalPlazas;

  protected $descripAct;

  protected $fecha;

  protected $plazasOcupadas;

  protected $imagenAct;

  /*
    Constructor de la Actividad
  */
  public function __construct($idActividad=NULL,$nomActividad=NULL, $totalPlazas=NULL, $descripAct=NULL, $fecha=NULL,$plazasOcupadas=NULL, $imagenAct=NULL) {
    $this->idActividad = $idActividad;
    $this->nomActividad = $nomActividad;
    $this->totalPlazas = $totalPlazas;
    $this->descripAct = $descripAct;
    $this->fecha = $fecha;
    $this->plazasOcupadas = $plazasOcupadas;
    $this->imagenAct = $imagenAct;
  }

  public function getIdActividad() {
    return $this->idActividad;
  }

  public function setIdActividad($idActividad) {
    $this->$idActividad = $idActividad;
  }

  public function getNomActividad() {
    return $this->nomActividad;
  }

  public function setNomActividad($nomActividad) {
    $this->nomAct = $nomActividad;
  }

  public function getTotalPlazas() {
    return $this->totalPlazas;
  }

  public function setTotalPlazas($totalPlazas) {
    $this->numPl = $totalPlazas;
  }

  public function getDescripActividad() {
    return $this->descripAct;
  }

  public function setDescripActividad($descAct) {
    $this->descAct = $descripAct;
  }


  public function getFecha() {
    return $this->fecha;
  }

  public function setFecha($fecha) {
    $this->dateAct = $fecha;
  }

  public function getPlazasOcupadas() {
    return $this->plazasOcupadas;
  }

  public function setPlazasOcupadas($plazasOcupadas) {
    $this->dateAct = $plazasOcupadas;
  }

  public function getImagenActividad() {
    return $this->imagenAct;
  }

  public function setImagenActividad($imagenAct) {
    $this->imagen = $imagenAct;
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
 public static function registroValido($nomActividad,$totalPlazas,$descripAct,  $plazasOcupadas){
      $error = array();
      if (strlen($nomActividad) < 3 || strlen($nomActividad) > 30) {
	     $error["nomActividad"] = "El nombre de la Actividad debe tener entre 3 y 30 caracteres.";
      }
      if (strlen($totalPlazas) < 1 || strlen($totalPlazas) > 2) {
       $error["totalPlazas"] = "El numero total de plazas de la Actividad debe tener entre 1 y 2 digitos.";

      if (strlen($descripAct) < 5 || strlen($descripAct) > 300) {
	     $error["descripAct"] = "La descripcion de la Actividad debe tener entre 5 y 300 caracteres.";
      }
      if (strlen($plazasOcupadas) < 1 || strlen($plazasOcupadas) > 2) {
       $error["numPl"] = "El numero de plazas ocupadas de la Actividad debe tener entre 1 y 2 digitos.";
      }
      if (sizeof($error)>0){
	     echo "No se puede resgistrar la Actividad por los siguientes motivos: ";
       print_r(array_values($error));

      }
      if (sizeof($error)==0){
       return true;
      }

  }

  public static function update($idActividad, $nomActividad, $totalPlazas, $descripAct, $fecha, $plazasOcupadas, $imagenAct){
      ActividadMapper::update($idActividad, $nomActividad,$totalPlazas,$descripAct,$fecha, $plazasOcupadas, $imagenAct);
  }

  public static function delete($idActividad){
      ActividadMapper::delete($idActividad);
  }

}
?>
