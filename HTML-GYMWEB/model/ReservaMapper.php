<?php
require_once(__DIR__."/../conexion/bdConexion.php");

class ReservaMapper{
  /* Guardamos un Usuario en la BD*/
public static function guardarUsuario($user){
  global $connect;
  $resultado = false;
 $sqlcrear= "INSERT INTO reserva (fecha) VALUES ('";
  $sqlcrear = $sqlcrear.$user->getFecha()."')";
    $resultado = mysqli_query($connect, $sqlcrear);
   return $resultado;
}
public static function delete($idReserva){
   global $connect;
   $resultado = mysqli_query($connect, "DELETE FROM reserva WHERE idReserva=\"$idReserva\"");
   return $resultado;
}



}
