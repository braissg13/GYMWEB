<?php
require_once(__DIR__."/../conexion/bdConexion.php");
require_once(__DIR__."/../model/ReservaMapper.php");
class Reserva {
  protected $idReserva;
  protected $fecha;
  protected $Usuario_idUsuario;
  protected $Actividad_idActividad;

  /*
    Constructor de reserva
  */
  public function __construct($idReserva=NULL,$fecha=NULL,$Usuario_idUsuario=NULL,$Actividad_idActividad=NULL) {
    $this->idReserva = $idReserva;
    $this->fecha = $fecha;
    $this->Usuario_idUsuario = $Usuario_idUsuario;
    $this->Actividad_idActividad = $Actividad_idActividad;
  }

  public function getIdReserva() {
    return $this->idReserva;
  }
  public function setIdReserva($idReserva) {
    $this->idReserva = $idReserva;
  }
  public function getFecha() {
    return $this->fecha;
  }
  public function setFecha($fecha) {
    $this->fecha = $fecha;
  }

  public function getIdUsuario($Usuario_idUsuario){
    return $this->Usuario_idUsuario;
  }

  public function setIdUsuario($Usuario_idUsuario) {
    $this->Usuario_idUsuario = $Usuario_idUsuario;
  }

  public function getIdActividad($Actividad_idActividad){
    return $this->Actividad_idActividad;
  }

  public function setIdActividad($Actividad_idActividad) {
    $this->Actividad_idActividad = $Actividad_idActividad;
  }

  public static function guardarReserva($reserva){
    ReservaMapper::guardarReserva($reserva);
  }

  public static function delete($Usuario_idUsuario,$Actividad_idActividad){
     ReservaMapper::delete($Usuario_idUsuario,$Actividad_idActividad);
  }

}