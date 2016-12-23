<?php
require_once(__DIR__."/../conexion/bdConexion.php");


class ActividadMapper{
    /*Buscamos todos las Actividades*/
    public static function findAll()
    {
        global $connect;
        $resultado = mysqli_query($connect, 'SELECT * FROM actividad ORDER BY fecha DESC');
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
        $sqlcrear= "INSERT INTO actividad (nomActividad,totalPlazas,descripAct,fecha, plazasOcupadas, imagenAct)VALUES ('";
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
    /*Cogemos todos los datos de una Actividad buscandolo por su Nombre y devolvemos un objeto Actividad*/
    public static function findByNomActividad($nomActividad,$fecha){
        global $connect;
        $resultado = mysqli_query($connect, 'SELECT * FROM actividad WHERE nomActividad ="'.$nomActividad.'" AND fecha ="'.$fecha.'"');
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
    public static function update($idActividad,$nomActividad,$totalPlazas,$descripAct,$fecha,$plazasOcupadas,$imagenAct)
    {
        global $connect;
        $resultado = mysqli_query($connect, "UPDATE actividad SET nomActividad=\"$nomActividad\", totalPlazas =\"$totalPlazas\", descripAct =\"$descripAct\",fecha=\"$fecha\", plazasOcupadas= \"$plazasOcupadas\", imagenAct=\"$imagenAct\" WHERE idActividad=\"$idActividad\"");
           return $resultado;
    }
    public static function delete($idActividad){
        global $connect;
        $resultado = mysqli_query($connect, "DELETE FROM actividad WHERE idActividad=\"$idActividad\"");
        return $resultado;
    }
    public static function asignarEntrenador($idUsuario,$idActividad){
        global $connect;
        $resultado = false;
        $sqlcrear= "INSERT INTO usuario_actividad (Usuario_idUsuario,Actividad_idActividad)VALUES ('";
        $sqlcrear = $sqlcrear.$idUsuario."','".$idActividad."')";
        $resultado = mysqli_query($connect, $sqlcrear);
       return $resultado;
    }

    public static function getEntrenadorAsignado($idActividad){
        global $connect;
        $resultado = mysqli_query($connect, 'SELECT * FROM usuario_actividad WHERE Actividad_idActividad ="'.$idActividad.'"');
        if (mysqli_num_rows($resultado) > 0) {
            $row = mysqli_fetch_assoc($resultado);
            $resultado2 = mysqli_query($connect, 'SELECT nomUsuario FROM usuario WHERE idUsuario ="'.$row['Usuario_idUsuario'].'"');
            return $resultado2;
        } else {
            return NULL;
        }
    }

    public static function deleteEntrenadorActividad($idActividad){
        global $connect;
        $resultado = mysqli_query($connect, "DELETE FROM usuario_actividad WHERE Actividad_idActividad=\"$idActividad\"");
        return $resultado;
    }

    public static function deleteReservaActividad($idActividad){
        global $connect;
        $resultado = mysqli_query($connect, "DELETE FROM reserva WHERE Actividad_idActividad=\"$idActividad\"");
        return $resultado;
    }

    public static function updateAsignarEntrenador($idUsuario,$idActividad){
        global $connect;
        $resultado = mysqli_query($connect, "UPDATE usuario_actividad SET Usuario_idUsuario=\"$idUsuario\" WHERE Actividad_idActividad=\"$idActividad\"");
        return $resultado;
    }

    public static function eliminarPlaza($idActividad,$plazasOcupadas){
         global $connect;
         $plazasOc = $plazasOcupadas - 1;
        $resultado = mysqli_query($connect, "UPDATE actividad SET plazasOcupadas=\"$plazasOc\" WHERE idActividad=\"$idActividad\"");
        return $resultado;
    }

    public static function sumarPlaza($idActividad,$plazasOcupadas){
         global $connect;
         $plazasOc = $plazasOcupadas + 1;
        $resultado = mysqli_query($connect, "UPDATE actividad SET plazasOcupadas=\"$plazasOc\" WHERE idActividad=\"$idActividad\"");
        return $resultado;
    }

    public static function existeReserva($idActividad,$idUsuario){
        global $connect;
        $resultado = mysqli_query($connect, 'SELECT * FROM reserva WHERE Actividad_idActividad ="'.$idActividad.'" AND Usuario_idUsuario ="'.$idUsuario.'"');
        if (mysqli_num_rows($resultado) > 0) {
            return true;
        } else {
            return false;
        }
    }

     /*devolver los usuarios que han hecho una reserva a una actividad*/
    public static function getUsuariosAsignados($idActividad){
      global $connect;
        $resultado = mysqli_query($connect, 'SELECT * FROM usuario U, reserva R WHERE R.Actividad_idActividad="'.$idActividad.'"  AND U.idUsuario = R.Usuario_idUsuario ');
        if (mysqli_num_rows($resultado) > 0) {
            return $resultado;
        } else {
            return NULL;
        }
    }

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
?>
