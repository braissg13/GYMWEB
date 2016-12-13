<?php
require_once(__DIR__."/../conexion/bdConexion.php");
require_once(__DIR__."/../model/ReservaMapper.php");
class Reserva {
  protected $idReserva;
  protected $fecha;

  /*
    Constructor de reserva
  */
  public function __construct($idReserva=NULL,$fecha=NULL) {
    $this->idReserva = $idReserva;
    $this->fecha = $fecha;

  }

  public function getIdReserva() {
    return $this->idReserva;
  }
  public function setIdReserva($idReserva) {
    $this->$idReserva = $idReserva;
  }
  public function getFecha() {
    return $this->password;
  }
  public function setFecha($fecha) {
    $this->fecha = $fecha;
  }


  public static function delete($idReserva){
     ReservaMapper::delete($idRserva);
 }

}
