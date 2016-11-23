<?php
require_once(__DIR__."/../conexion/bdConexion.php");

class TablaMapper{
    /*Buscamos todos las Actividades*/
    public static function findAll()
    {
        global $connect;
        $resultado = mysqli_query($connect, 'SELECT * FROM tablaejercicios');
        return $resultado;
    }
   
   /*Buscamos si existe una Tabla por su Nombre de Tabla, devolvemos true si existe*/
    public static function existeTabla($nomTabla) {
        global $connect;
        $resultado = mysqli_query($connect, "SELECT * FROM tablaejercicios WHERE nomTabla=\"$nomTabla\"");
        $busqueda = mysqli_num_rows($resultado);
        if( $busqueda > 0) {
            return true;
        }
    }

    /* Guardamos una Tabla en la BD*/
    public static function guardarTabla($tabla){
      global $connect;
      $resultado = false;
     $sqlcrear= "INSERT INTO tablaejercicios (nomTabla,tipoTabla) VALUES ('";
      $sqlcrear = $sqlcrear.$tabla->getNomTabla()."','".$tabla->getTipoTabla()."')";
        $resultado = mysqli_query($connect, $sqlcrear);
       return $resultado;
    }

    /* Modificamos tabla*/
    public static function update($idTablaEjercicios,$nomTabla,$tipoTabla){
        global $connect;
        
        $result = mysqli_query($connect, "UPDATE tablaejercicios SET nomTabla=\"$nomTabla\", tipoTabla =\"$tipoTabla\" WHERE idTablaEjercicios=\"$idTablaEjercicios\"");
        return $result;
    }

    /*Cogemos todos los datos de una Tabla buscandola por su ID y devolvemos un objeto Tabla*/
    public static function findByIdTabla($idTablaEjercicios){
        global $connect;
        $resultado = mysqli_query($connect, 'SELECT * FROM tablaejercicios WHERE idTablaEjercicios ="'.$idTablaEjercicios.'"');
        if (mysqli_num_rows($resultado) > 0) {
            $row = mysqli_fetch_assoc($resultado);
            $actividad= new Tabla($row['idTablaEjercicios'],$row['nomTabla'],$row['tipoTabla']);
            return $actividad;
        } else {
            return NULL;
        }
    }

    /*Cogemos todos los datos de una Tabla buscandolo por su Nombre y devolvemos un objeto Tabla*/
    public static function findByNomTabla($nomTabla){
        global $connect;
        $resultado = mysqli_query($connect, 'SELECT * FROM tablaejercicios WHERE nomTabla ="'.$nomTabla.'"');
        if (mysqli_num_rows($resultado) > 0) {
            $row = mysqli_fetch_assoc($resultado);
            $tabla= new Tabla($row['idTablaEjercicios'],$row['nomTabla'],$row['tipoTabla']);
            return $tabla;
        } else {
            return NULL;
        }
    }

    public static function asignarEjers($idEjercicio,$idTablaEjercicios){
        global $connect;
        $resultado = false;
        $sqlcrear= "INSERT INTO ejercicio_tablaejercicios (Ejercicio_idEjercicio,TablaEjercicios_idTablaEjercicios)VALUES ('";
        $sqlcrear = $sqlcrear.$idEjercicio."','".$idTablaEjercicios."')";
        $resultado = mysqli_query($connect, $sqlcrear);
       return $resultado;
    }

    /*Mira si la Tabla es valida y devuelve true.*/
    public static function esValidoTabla($idTablaEjercicios) {
        global $connect;
        $resultado = mysqli_query($connect, "SELECT * FROM tablaejercicios WHERE idTablaEjercicios=\"$idTablaEjercicios\"");
        $busqueda = mysqli_num_rows($resultado);
        if( $busqueda > 0) {
            return true;
        }
    }

    public static function getEjersTabla($idTablaEjercicios){
        global $connect;
        $resultado = mysqli_query($connect, 'SELECT * FROM ejercicio E, ejercicio_tablaejercicios T WHERE T.TablaEjercicios_idTablaEjercicios="'.$idTablaEjercicios.'"  AND E.idEjercicio = T.Ejercicio_idEjercicio');
        if (mysqli_num_rows($resultado) > 0) {
            return $resultado;
        } else {
            return NULL;
        }
    }

    public static function getDeportistasTabla($idTablaEjercicios){
        global $connect;
        $resultado = mysqli_query($connect, 'SELECT * FROM usuario U, tablaejercicios_has_usuario T WHERE T.TablaEjercicios_idTablaEjercicios="'.$idTablaEjercicios.'"  AND U.idUsuario = T.Usuario_idUsuario ORDER BY U.apellidos');
        if (mysqli_num_rows($resultado) > 0) {
            return $resultado;
        } else {
            return NULL;
        }
    }

    public static function deleteEjersTabla($idTablaEjercicios){
        global $connect;
        $resultado = mysqli_query($connect, "DELETE FROM ejercicio_tablaejercicios WHERE TablaEjercicios_idTablaEjercicios=\"$idTablaEjercicios\"");
        return $resultado;
    }

    public static function deleteDeportistaTabla($idTablaEjercicios){
        global $connect;
        $resultado = mysqli_query($connect, "DELETE FROM tablaejercicios_has_usuario WHERE TablaEjercicios_idTablaEjercicios=\"$idTablaEjercicios\"");
        return $resultado;
    }

    public static function deleteComentarioTabla($idTablaEjercicios){
        global $connect;
        $resultado = mysqli_query($connect, "DELETE FROM comentario WHERE TablaEjercicios_has_Usuario_TablaEjercicios_idTablaEjercicios=\"$idTablaEjercicios\"");
        return $resultado;
    }

    public static function delete($idTablaEjercicios){
        global $connect;
        $resultado = mysqli_query($connect, "DELETE FROM tablaejercicios WHERE idTablaEjercicios=\"$idTablaEjercicios\"");
        return $resultado;
    }

    public static function asignarDeportistaTabla($idTablaEjercicios,$idUsuario){
        global $connect;
        $resultado = false;
        $sqlcrear= "INSERT INTO tablaejercicios_has_usuario (TablaEjercicios_idTablaEjercicios,Usuario_idUsuario) VALUES ('";
        $sqlcrear = $sqlcrear.$idTablaEjercicios."','".$idUsuario."')";
        $resultado = mysqli_query($connect, $sqlcrear);
       return $resultado;
    }

    public static function borrarDeportistaAsignadoTabla($idTablaEjercicios,$idUsuario){
        global $connect;
        $resultado = mysqli_query($connect, "DELETE FROM tablaejercicios_has_usuario WHERE TablaEjercicios_idTablaEjercicios=\"$idTablaEjercicios\" AND Usuario_idUsuario=\"$idUsuario\"");
        return $resultado;
    }

    public function borrarComentarioDeportistaTabla($idTablaEjercicios,$idUsuario){
        global $connect;
        $resultado = mysqli_query($connect, "DELETE FROM comentario WHERE TablaEjercicios_has_Usuario_TablaEjercicios_idTablaEjercicios=\"$idTablaEjercicios\" AND TablaEjercicios_has_Usuario_Usuario_idUsuario=\"$idUsuario\"");
        return $resultado;
    }
}
?>
