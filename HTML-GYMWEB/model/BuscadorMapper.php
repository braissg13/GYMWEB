<?php
require_once(__DIR__."/../conexion/bdConexion.php");


class BuscadorMapper{
    /*Buscamos las Actividades con la cadena del buscador*/
    public static function findActBySearch($busq){
        global $connect;
        $resultado = mysqli_query($connect, 'SELECT * FROM actividad WHERE nomActividad like %$busq%');
        if ($resultado) {
            $row = mysqli_fetch_assoc($resultado);
            $actividad= new Actividad($row['idActividad'],$row['nomActividad'],$row['totalPlazas'],$row['descripAct'],$row['fecha'],$row['plazasOcupadas'],$row['imagenAct']);
            return $actividad;
        } else {
            return NULL;
        }
    }
}
