<?php
require_once(__DIR__."/../conexion/bdConexion.php");
require_once(__DIR__."/../model/ReservaMapper.php");
require_once(__DIR__."/../model/Reserva.php");

class ReservaController{

  /* BORRAR reserva*/
  public static function borrarReserva(){
    if(!isset($_SESSION)) session_start();
    $idReserva= $_POST['idReserva'];

            if($tipoUsuario=="DeportistaTDU" || $tipoUsuario=="DeportistaPEF"){
              Reserva::delete($idReserva);
            }
            //Redireccionamos a vista
            header("Location: ../views/Deportista/misActividades.php");

  }//FIN BORRAR reserva

}
