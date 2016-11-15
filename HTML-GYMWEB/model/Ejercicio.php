<?php


include_once __DIR__."/../conexion/bdConexion.php";
include_once __DIR__."/../model/EjercicioMapper.php";

class Ejercicio {
 
  protected $idEjercicio;

  protected $nomEjercicio;
 
  protected $descripEjerc;

  protected $tipoEjerc;

  protected $repeticiones;

  protected $carga;

  protected $imagen;
  
  /*
    Constructor del Ejercicio
  */
  public function __construct($idEjercicio=NULL,$nomEjercicio=NULL, $descripEjerc=NULL, $tipoEjerc=NULL, $repeticiones=NULL, $carga=NULL, $imagen=NULL) {
    $this->idEjercicio = $idEjercicio;
    $this->nomEjercicio = $nomEjercicio;
    $this->descripEjerc = $descripEjerc;
    $this->tipoEjerc = $tipoEjerc; 
    $this->repeticiones = $repeticiones;
    $this->carga = $carga;
    $this->imagen = $imagen;   
  }
  
  public function getIdEjercicio() {
    return $this->idEjercicio;
  }

  public function setIdEjercicio($idEjercicio) {
    $this->$idEjercicio = $idEjercicio;
  }

  public function getNomEjercicio() {
    return $this->nomEjercicio;
  }  
       
  public function setNomEjercicio($nomEjercicio) {
    $this->nomEjercicio = $nomEjercicio;
  }
    
  public function getDescripEjercicio() {
    return $this->descripEjerc;
  }  
       
  public function setDescripEjercicio($descripEjerc) {
    $this->descripEjerc = $descripEjerc;
  }

  public function getTipoEjercicio() {
    return $this->tipoEjerc;
  }  
       
  public function setTipoEjercicio($tipoEjerc) {
    $this->tipoEjerc = $tipoEjerc;
  }

  public function getRepeticiones() {
    return $this->repeticiones;
  }  
       
  public function setRepeticiones($repeticiones) {
    $this->repeticiones = $repeticiones;
  }

  public function getCarga() {
    return $this->carga;
  }

  public function setCarga($carga) {
    $this->carga = $carga;
  } 

  public function getImagenEjercicio() {
    return $this->imagen;
  } 
       
  public function setImagenEjercicio($imagen) {
    $this->imagen = $imagen;
  }

  /*Obtener todos los Ejercicios*/
  public static function getAllEjercicios()
    {
        return $resultado = EjercicioMapper::findAll();
    }

    /* Guardamos un Ejercicio en la BD*/
  public static function guardarEjercicio($ejercicio){  
    return EjercicioMapper::guardarEjercicio($ejercicio);
  }

  /*Comprobacion existe EJERCICIO... Si existe ejercicio devuelve Objeto Ejercicio*/
  public static function obtenerDatos($idEjercicio) {
    if ($idEjercicio) {
        if ($res = EjercicioMapper::esValidoEjercicio($idEjercicio)) {
                return EjercicioMapper::findByIdEjercicio($idEjercicio);
        } else {
                echo "ERROR: El ejercicio no existe.";
            }
        } else {
            return "ERROR, no existe el Ejercicio";
        }
  }

 

  /*Comprobamos si se puede registrar el Ejercicio. Si se puede retornamos un TRUE*/  
 public static function registroValido($nomEjercicio,$descripEjerc,$repeticiones){
      $error = array();
      if (strlen($nomEjercicio) < 3 || strlen($nomEjercicio) > 30) {
	     $error["nomEjercicio"] = "El nombre de Ejercicio debe tener entre 3 y 30 caracteres.";
      }
      if (strlen($descripEjerc) < 5 || strlen($descripEjerc) > 500) {
	     $error["descripEjerc"] = "La descripcion del Ejercicio debe tener entre 5 y 500 caracteres.";	
      }
      if (strlen($repeticiones) < 1 || strlen($repeticiones) > 15) {
       $error["repeticiones"] = "La repeticion del Ejercicio debe tener entre 5 y 15 caracteres.";  
      }
      if (sizeof($error)>0){
	     echo "No se puede resgistrar el Ejercicio por los siguientes motivos: ";
       print_r(array_values($error));

      }
      if (sizeof($error)==0){
       return true;
      }
      
  }

  public static function update($idEjercicio,$nomEjercicio,$descripEjerc,$tipoEjerc, $repeticiones, $carga, $imagen){
      EjercicioMapper::update($idEjercicio,$nomEjercicio,$descripEjerc,$tipoEjerc, $repeticiones, $carga, $imagen);
  } 

  public static function delete($idEjercicio){
      EjercicioMapper::delete($idEjercicio);
  }

}
?>