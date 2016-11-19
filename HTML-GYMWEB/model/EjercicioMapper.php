<?php
include_once __DIR__."/../conexion/bdConexion.php";

class EjercicioMapper{

    /*Buscamos todos los Ejercicios*/   
    public static function findAll()
    {
        global $connect;
        $resultado = mysqli_query($connect, 'SELECT * FROM ejercicio');
        return $resultado;
    }

    /*Buscamos si existe un Ejercicio por su Nombre, devolvemos true si existe*/
    public static function existeEjercicio($nomEjercicio) {
        global $connect;
        $resultado = mysqli_query($connect, "SELECT * FROM ejercicio WHERE nomEjercicio=\"$nomEjercicio\"");
        $busqueda = mysqli_num_rows($resultado);
        if( $busqueda > 0) {
            return true;
        }
    }

      /* Guardamos un Ejercicio en la BD*/
    public static function guardarEjercicio($ejercicio){  
      global $connect;
      $resultado = false;
       
        $sqlcrear= "INSERT INTO ejercicio (nomEjercicio,descripEjerc,tipoEjerc,repeticiones,carga, imagen) VALUES ('";
      $sqlcrear = $sqlcrear.$ejercicio->getNomEjercicio()."','".$ejercicio->getDescripEjercicio()."','".$ejercicio->getTipoEjercicio()."','".$ejercicio->getRepeticiones()."','".$ejercicio->getCarga()."','".$ejercicio->getImagenEjercicio()."')";

        $resultado = mysqli_query($connect, $sqlcrear);
       
       return $resultado;
    }
    /*Cogemos todos los datos de un Ejercicio buscandolo por su ID y devolvemos un objeto Ejercicio*/
    public static function findByIdEjercicio($idEjercicio){
        global $connect;
        $resultado = mysqli_query($connect, 'SELECT * FROM ejercicio WHERE idEjercicio ="'.$idEjercicio.'"');
        if (mysqli_num_rows($resultado) > 0) {
            $row = mysqli_fetch_assoc($resultado);
            
            $ejercicio= new Ejercicio($row['idEjercicio'],$row['nomEjercicio'],$row['descripEjerc'],$row['tipoEjerc'],$row['repeticiones'],$row['carga'],$row['imagen']);

            return $ejercicio;
        } else {
            return NULL;
        }
    }

     /*Mira si el Ejercicio es valido y devuelve true.*/
    public static function esValidoEjercicio($idEjercicio) {
        global $connect;
        $resultado = mysqli_query($connect, "SELECT * FROM ejercicio WHERE idEjercicio=\"$idEjercicio\"");
        $busqueda = mysqli_num_rows($resultado);
        if( $busqueda > 0) {
            return true;
        }
    }


    public static function update($idEjercicio,$nomEjercicio,$descripEjerc,$tipoEjerc, $repeticiones, $carga, $imagen)
    {
        global $connect;

        $resultado = mysqli_query($connect, "UPDATE ejercicio SET nomEjercicio=\"$nomEjercicio\", descripEjerc =\"$descripEjerc\", tipoEjerc =\"$tipoEjerc\", repeticiones= \"$repeticiones\",carga=\"$carga\", imagen=\"$imagen\" WHERE idEjercicio=\"$idEjercicio\"");
           return $resultado;
            
    }

    public static function delete($idEjercicio){
        global $connect;

        $resultado = mysqli_query($connect, "DELETE FROM ejercicio WHERE idEjercicio=\"$idEjercicio\"");
        return $resultado;
    }

    public static function deleteEjercicioTabla($idEjercicio){
        global $connect;
        $resultado = mysqli_query($connect, "DELETE FROM ejercicio_tablaejercicios WHERE Ejercicio_idEjercicio=\"$idEjercicio\"");
        return $resultado;
    }
    
}
?>