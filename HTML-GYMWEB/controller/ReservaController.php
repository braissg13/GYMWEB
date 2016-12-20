<?php
require_once(__DIR__."/../conexion/bdConexion.php");
require_once(__DIR__."/../model/ReservaMapper.php");
require_once(__DIR__."/../model/Reserva.php");

class ReservaController{

  /* BORRAR reserva*/
  public static function borrarReserva(){
    if(!isset($_SESSION)) session_start();
    $idUsuario= $_POST['idUsuario'];
    $idActividad= $_POST['idActividad'];
    $plazasOcupadas = $_POST['plazasOcup'];
    if( ($_SESSION['tipoUsuario']=="DeportistaTDU") || ($_SESSION['tipoUsuario']=="DeportistaPEF")){
      //Borramos Reserva
      Reserva::delete($idUsuario,$idActividad);
      //Quitamos una plazaOcupada de la Actividad
      Actividad::eliminarPlaza($idActividad,$plazasOcupadas);
      //Redireccionamos a vista
      header("Location: ../views/Deportista/consultarActividades.php?id=$idActividad"); 
    }else{
       $error = "ERROR. No tiene permiso para eliminar la Reserva";
       header("Location: ../views/error.php?error=$error");
    }

  }//FIN BORRAR reserva

  /*CREAR Reserva*/
  public static function crearReserva(){
    if(!isset($_SESSION)) session_start();
    $idUsuario= $_POST['idUsuario'];
    $idActividad= $_POST['idActividad'];
    $plazasOcupadas = $_POST['plazasOcup'];
    $fecha = $_POST['fecha'];
    $totalPlazas = $_POST['totalPlazas'];
    $idRes="NULL";

    $fech = getdate();
    $dia = $fech['mday'];
    $mes = $fech['mon'];
    $anho = $fech['year'];
    $hora = $fech['hours'];
    if ($hora == "0" || $hora == "1" || $hora == "2" || $hora == "3" || $hora == "4" || $hora == "5" || $hora == "6" || $hora == "7" || $hora == "8" || $hora == "9") {
      $hora = "0$hora";
    }
    $min = $fech['minutes'];

    $hoy = "$anho-$mes-$dia $hora:$min:00";


    if( ($_SESSION['tipoUsuario']=="DeportistaTDU") || ($_SESSION['tipoUsuario']=="DeportistaPEF")){
      $fecha_actual = strtotime(date("d-m-Y H:i:00",time()));
      $fecha_entrada = strtotime($fecha);
      if($fecha_actual > $fecha_entrada){
        $error = "ERROR. La fecha para reservar ya ha pasado.";
        header("Location: ../views/error.php?error=$error");
      }else{
        if ($plazasOcupadas<$totalPlazas) {
        //Creamos Reserva
        $reserva = new Reserva();

        $reserva->setIdReserva($idRes);
        $reserva->setFecha($hoy);
        $reserva->setIdUsuario($idUsuario);
        $reserva->setIdActividad($idActividad);
        Reserva::guardarReserva($reserva);
        //Sumamos una plazaOcupada de la Actividad
        Actividad::sumarPlaza($idActividad,$plazasOcupadas);
        //Redireccionamos a vista
        header("Location: ../views/Deportista/consultarActividades.php?id=$idActividad"); 
        }else{
          $error = "ERROR. Las plazas ya estan Ocupadas";
          header("Location: ../views/error.php?error=$error");
        }
      }
    }else{
       $error = "ERROR. No tiene permiso para eliminar la Reserva";
       header("Location: ../views/error.php?error=$error");
    }
  }//FIN CREAR reserva

}