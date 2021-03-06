<?php

require_once(__DIR__."/../conexion/bdConexion.php");
require_once(__DIR__."/../model/ActividadMapper.php");
require_once(__DIR__."/../model/Actividad.php");


	class ActividadController{


        /*Obtenemos todos las ACTIVIDADES*/
        public static function getAll(){
          if(!isset($_SESSION)) session_start();
          $actividades = new Actividad();
          return $actividades->getAllActividades();
        }

        //Al buscar hacemos una redireccion a la pagina con la busqueda que solicita el usuario
        public static function buscar(){
          if(!isset($_SESSION)) session_start();
          $actBuscada = $_POST['nomActividad'];
          if(ActividadMapper::existeActividad($actBuscada)){
              header("Location: ../views/Deportista/buscarActividades.php?act=$actBuscada"); 
          }else{
            $error = "No existe la Actividad buscada \"$actBuscada\".";
            header("Location: ../views/error.php?error=$error");
          }
        }

        //Obtener busqueda realizada.
        public static function getResultadosBusqueda($nomActividad){
          if(!isset($_SESSION)) session_start();
         $busq = Actividad::actividadesBuscadas($nomActividad);
         return $busq;
        }

        /*Obtenemos a un Entrenador determinado*/
        public static function getEntrenador($idActividad){
          if(!isset($_SESSION)) session_start();
          $entrenadorActividad = Actividad::getEntrenadorAsignado($idActividad);
          return $entrenadorActividad;
        }

        /*Obtenemos todos los usuarios que Pertenecen a una Reserva en concreto*/
        public static function getUsuariosEntrenador($idActividad){
          if(!isset($_SESSION)) session_start();
         $usuario = Actividad::getUsuariosAsignados($idActividad);
         return $usuario;
        }

        public static function existeReserva($idActividad,$idUsuario){
           if(!isset($_SESSION)) session_start();
           $existe = Actividad::existeReserva($idActividad,$idUsuario);
           return $existe;
        }

        /*CREAR ACTIVIDAD*/
        public static function crearActividad(){
        if(!isset($_SESSION)) session_start();

        if($_SESSION['tipoUsuario']=="Administrador"){
          $nombre = $_POST['nomAct'];
          $totalPlazas = $_POST['numPl'];
          $descripcion = $_POST['descrAct'];
          //Cogemos fecha y hora.
          $date = $_POST['fecha'];
          $tiempo = $_POST['hora'];
          //Juntamos Fecha y Hora en $fecha y el :00 es para añadirle los segundos
          $fecha= "$date $tiempo:00";
          $plazasOcupadas="0";
          $idAct = "NULL";
          // Recogemos el ID del entrenador a asignar
          $entrenador = $_POST['entrenador'];
          /*$format = "Y-m-d H:i:s";
          $dateobj = DateTime::createFromFormat($format, $fecha);*/

          //Comprobamos el tipo de la Imagen, SI es correcto, obtenemos los datos de la ruta y de la imagen
          if($_FILES['imagen']['type']=="image/jpeg" || $_FILES['imagen']['type']=="image/png" || $_FILES['imagen']['type']=="image/jpg"){
                //Comprobamos si los datosintroducidos son Correctos
                if(Actividad::registroValido($nombre,$descripcion)){
                  //Creamos ruta donde guardamos la imagen yle damos nombre 
                $ruta = "../img/actividades";
                $nombreArchivo = $_FILES['imagen']['name'];
                move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta."/".$nombreArchivo);
                  //Creamos el Ejercicio
                  $actividad = new Actividad();

                  $actividad->setIdActividad($idAct);
                  $actividad->setNomActividad($nombre);
                  $actividad->setTotalPlazas($totalPlazas);
                  $actividad->setDescripActividad($descripcion);
                  $actividad->setFecha($fecha);
                  $actividad->setPlazasOcupadas($plazasOcupadas);
                  $actividad->setImagenActividad($nombreArchivo);

                  $actividad->guardarActividad($actividad);
                  //recogemos los datos de la actividad guardada para asignar el entrenador
                  $act = Actividad::datosActividad($nombre,$fecha);
                  $idActividad = $act->getIdActividad();
                  $asignarEntr = Actividad::asignarEntrenador($entrenador,$idActividad);
                  header("Location: ../views/Admin/gestionActividades.php"); 
                
                  }else{
                  $error = "ERROR.El formulario no fue bien completado.";
                  header("Location: ../views/error.php?error=$error");
                }
            }else{
              $error = "ERROR. Formato de imagen no válido.";
              header("Location: ../views/error.php?error=$error");
            }
          }else{
            $error = "No tiene permiso para crear una Actividad";
            header("Location: ../views/error.php?error=$error");
          }
        } //FIN CREAR Actividad

        /* GET ACTIVIDAD*/
        public static function getActividad($idActividad){
        if(!isset($_SESSION)) session_start();

        $actividad = NULL;
        $actividad = Actividad::obtenerDatos($idActividad);
        if ($actividad == NULL){
          $error = "No existe la actividad";
          header("Location: ../views/error.php?error=$error");
        }else{
          return $actividad;
        }
      } // FIN GET Actividad

      /*MODIFICAR ACTIVIDAD*/
        public static function modificarActividad(){
        if(!isset($_SESSION)) session_start();

        if($_SESSION['tipoUsuario'] =="Administrador"){
          $idAct = $_POST['idAct'];
          $plazasOcupadas=$_POST['plazasOc'];
          //Utilizamos la actividad sin modificar por si no nos pasan unos argumentos, asignarle los que ya tenía
          $actividadSinModificar = Actividad::obtenerDatos($idAct);
          //Si no pasan nombre, cogemos el nombre que ya tenia
          if ($_POST['nomAct']!= null) {
            $nombre = $_POST['nomAct'];
          }else{
            $nombre = $actividadSinModificar->getNomActividad();
          }
          //Si no pasan numero Total de Plazas, cogemos el numero Total de Plazas que ya tenia
          if ($_POST['numPl']!= null) {
            $totalPlazas = $_POST['numPl'];
          }else{
            $totalPlazas = $actividadSinModificar->getTotalPlazas();
          }
          //Si no pasan descrip, cogemos la descrip que ya tenia
          if ($_POST['descrAct']!= null) {
            $descripcion = $_POST['descrAct'];
          }else{
            $descripcion = $actividadSinModificar->getDescripActividad();
          }
          //Cogemos fecha y hora.
          $date = $_POST['fecha'];
          $tiempo = $_POST['hora'];
          //Juntamos Fecha y Hora en $fecha y el :00 es para añadirle los segundos
          $fecha= "$date $tiempo:00";

          // Recogemos el ID del entrenador a asignar
          $entrenador = $_POST['entrenador'];

          //Si no pasan imagen, cogemos la imagen que ya tenia
          if ($_FILES['imagen']['name'] != null) {
            //Comprobamos el tipo de la Imagen, SI es correcto, obtenemos los datos de la ruta y de la imagen
            if($_FILES['imagen']['type']=="image/jpeg" || $_FILES['imagen']['type']=="image/png" || $_FILES['imagen']['type']=="image/jpg"){
                  //Comprobamos si los datosintroducidos son Correctos
                  if(Actividad::registroValido($nombre,$descripcion)){
                   //Creamos ruta donde guardamos la imagen yle damos nombre 
                  $ruta = "../img/actividades";
                  $nombreArchivo = $_FILES['imagen']['name'];
                  move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta."/".$nombreArchivo);
                    
                    //Llamamos a la funcion que modifica la Actividad
                    $actividad = Actividad::update($idAct,$nombre,$totalPlazas,$descripcion,$fecha,$plazasOcupadas,$nombreArchivo);
                    //Llamamos a la funcion que modifica Al entrenador Asignado
                     $asignarEntr = Actividad::updateAsignarEntrenador($entrenador,$idAct);
                    //Redireccionamos a vista 
                    header("Location: ../views/Admin/consultarActividades.php?id=$idAct"); 
                  
                    }else{
                    $error = "ERROR.El formulario no fue bien completado.";
                    header("Location: ../views/error.php?error=$error");
                  }
              }else{
                $error = "ERROR. Formato de imagen no válido.";
                header("Location: ../views/error.php?error=$error");
              }
            }else{
                $nombreArchivo = $actividadSinModificar->getImagenActividad();
                //Comprobamos si los datosintroducidos son Correctos
              if(Actividad::registroValido($nombre,$descripcion)){
                  //Llamamos a la funcion que modifica la Actividad
                  $actividad = Actividad::update($idAct,$nombre,$totalPlazas,$descripcion,$fecha,$plazasOcupadas,$nombreArchivo);
                    //Llamamos a la funcion que modifica Al entrenador Asignado
                    $asignarEntr = Actividad::updateAsignarEntrenador($entrenador,$idAct);
                    //Redireccionamos a vista 
                    header("Location: ../views/Admin/consultarActividades.php?id=$idAct"); 
              }else{
                $error = "ERROR.El formulario no fue bien completado.";
                header("Location: ../views/error.php?error=$error");
              }
            }  

          }else{
            $error = "No tiene permiso para modificar una Actividad";
            header("Location: ../views/error.php?error=$error");
          }
        } //FIN MODIFICAR Actividad

        /* BORRAR ACTIVIDAD*/
        public static function borrarActividad(){
          if(!isset($_SESSION)) session_start();
            if($_SESSION['tipoUsuario']=="Administrador"){
                $idActividad = $_POST['idActividad'];
                $nombre = $_POST['NomActividad'];
                //Comprobamos si existe la actividad para poder borrarlo
                if(ActividadMapper::existeActividad($nombre)){
                  //Lamamos a la funcion que elimina la Relacion Entrenador-Actividad
                  Actividad::deleteEntrenadorActividad($idActividad);
                  //Lamamos a la funcion que elimina la Relacion Reserva-Actividad
                  Actividad::deleteReservaActividad($idActividad);
                  //Lamamos a la funcion que elimina la Actividad
                  Actividad::delete($idActividad);
                  //Redireccionamos a vista
                  header("Location: ../views/Admin/gestionActividades.php"); 
                }else{
                  $error = "ERROR.La Actividad no existe.";
                  header("Location: ../views/error.php?error=$error");
                }
            }else{
              $error = "No tiene permiso para modificar un Ejercicio";
              header("Location: ../views/error.php?error=$error");
            }
        }//FIN BORRAR ACTIVIDAD

  }  
?>
