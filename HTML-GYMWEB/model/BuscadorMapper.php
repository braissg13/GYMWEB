<?php
require_once(__DIR__."/../conexion/bdConexion.php");


class BuscadorMapper{
    /*Buscamos todos las Actividades*/
    public static function findActBySearch($busq){
        global $connect;
        $resultado = mysqli_query($connect, 'SELECT * FROM actividad WHERE nomActividad like '%$busq%'');
        if (mysqli_num_rows($resultado) > 0) {
            $row = mysqli_fetch_assoc($resultado);
            $actividad= new Actividad($row['idActividad'],$row['nomActividad'],$row['totalPlazas'],$row['descripAct'],$row['fecha'],$row['plazasOcupadas'],$row['imagenAct']);
            return $actividad;
        } else {
            return NULL;
        }
    }
}
