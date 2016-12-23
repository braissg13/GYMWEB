<?php
require_once(__DIR__."/../conexion/bdConexion.php");
require_once(__DIR__."/../model/BuscadorMapper.php");


class Buscador {
  protected $idActividad;
  protected $nomActividad;
  protected $totalPlazas;
  protected $descripAct;
  protected $fecha;
  protected $plazasOcupadas;
  protected $imagenAct;
  protected $busq;
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

  public static function actividadesBuscadas($busq) {
    if ($busq) {
            return BuscadorMapper::findActBySearch($busq);
        } else {
            return "ERROR, no existe la actividad";
        }
  }

}
?>
