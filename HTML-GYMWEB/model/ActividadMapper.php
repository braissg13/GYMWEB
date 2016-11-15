<?php
include_once __DIR__."/../conexion/bdConexion.php";

class ActividadMapper{

    /*Buscamos todos las Actividades*/
    public static function findAll()
    {
        global $connect;
        $resultado = mysqli_query($connect, 'SELECT * FROM actividad');
        return $resultado;
    }

    /*Buscamos si existe una Actividad por su Nombre, devolvemos true si existe*/
    public static function existeActividad($nomActividad) {
        global $connect;
        $resultado = mysqli_query($connect, "SELECT * FROM actividad WHERE nomActividad=\"$nomActividad\"");
        $busqueda = mysqli_num_rows($resultado);
        if( $busqueda > 0) {
            return true;
        }
    }

      /* Guardamos una Actividad en la BD*/
    public static function guardarActividad($actividad){
      global $connect;
      $resultado = false;

        $sqlcrear= "INSERT INTO actividad (idActividad, nomActividad,totalPlazas,descripAct,fecha, plazasOcupadas, imagenAct) VALUES ('";
      $sqlcrear = $sqlcrear.$actividad->getNomActividad()."','".$actividad->getTotalPlazas()."','".$actividad->getDescripActividad()."','".$actividad->getFecha()."','".$actividad->getPlazasOcupadas()."','".$actividad->getImagenActividad()."')";

        $resultado = mysqli_query($connect, $sqlcrear);

       return $resultado;
    }
    /*Cogemos todos los datos de una Actividad buscandolo por su ID y devolvemos un objeto Actividad*/
    public static function findByIdActividad($idActividad){
        global $connect;
        $resultado = mysqli_query($connect, 'SELECT * FROM actividad WHERE idActividad ="'.$idActividad.'"');
        if (mysqli_num_rows($resultado) > 0) {
            $row = mysqli_fetch_assoc($resultado);

            $actividad= new Actividad($row['idActividad'],$row['nomActividad'],$row['totalPlazas'],$row['descripAct'],$row['fecha'],$row['plazasOcupadas'],$row['imagenAct']);

            return $actividad;
        } else {
            return NULL;
        }
    }

     /*Mira si la Actividad es valido y devuelve true.*/
    public static function esValidoActividad($idActividad) {
        global $connect;
        $resultado = mysqli_query($connect, "SELECT * FROM actividad WHERE idActividad=\"$idActividad\"");
        $busqueda = mysqli_num_rows($resultado);
        if( $busqueda > 0) {
            return true;
        }
    }


    public static function update($idActividad,$nomActividad,$totalPlazas,$descripAct, $fecha, $plazasOcupadas, $imagenAct)
    {
        global $connect;

        $resultado = mysqli_query($connect, "UPDATE actividad SET nomActividad=\"$nomActividad\", totalPlazas =\"$totalPlazas\", descripAct =\"$descripAct\",fecha=\"$fecha\", plazasOcupadas= \"$plazasOcupadas\", imagen=\"$imagenAct\" WHERE idActividad=\"$idActividad\"");
           return $resultado;

    }

    public static function delete($idActividad){
        global $connect;

        $resultado = mysqli_query($connect, "DELETE FROM actividad WHERE idActividad=\"$idActividad\"");
        return $resultado;
    }

}
?>
