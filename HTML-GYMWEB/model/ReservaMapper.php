<?php
require_once(__DIR__."/../conexion/bdConexion.php");

class ReservaMapper{
	 /* Guardamos una Reserva en la BD*/
	public static function guardarReserva($reserva){  
	  global $connect;
	  $resultado = false;
	   
	    $sqlcrear= "INSERT INTO reserva (fecha,Usuario_idUsuario,Actividad_idActividad) VALUES ('";
	  $sqlcrear = $sqlcrear.$reserva->getFecha()."','".$reserva->getIdUsuario()."','".$reserva->getIdActividad()."')";

	    $resultado = mysqli_query($connect, $sqlcrear);
	   
	   return $resultado;
	}

	/* Eliminamos Reserva*/
	public static function delete($Usuario_idUsuario,$Actividad_idActividad){
	   global $connect;
	   $resultado = mysqli_query($connect, "DELETE FROM reserva WHERE Usuario_idUsuario=\"$Usuario_idUsuario\" AND Actividad_idActividad=\"$Actividad_idActividad\"");
	   return $resultado;
	}


}
