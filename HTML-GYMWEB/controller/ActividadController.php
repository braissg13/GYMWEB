<?php

	class ActividadController{


    		/*Obtenemos todos las ACTIVIDADES*/
    		public static function getAll(){
    			if(!isset($_SESSION)) session_start();
    			$actividades = new Actividad();
    			return $actividades->getAllActividades();
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

        /*CREAR ACTIVIDAD*/
        public static function crearActividad(){
        if(!isset($_SESSION)) session_start();

        if($_SESSION['usuario']->getTipoUsuario()=="Administrador"){
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
                  $archivo = $_FILES['imagen']['tmp-name'];
                  $nombreArchivo = $_FILES['imagen']['name'];
                  move_uploaded_file($archivo, $ruta."/".$nombreArchivo);
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
                  ob_start(); 
                  header("refresh: 3; url = ../views/Admin/gestionActividades.php"); 
                  $errors = array();
                  $errors["general"] = "ERROR.El formulario no fue bien completado.";
                  echo $errors["general"]; 
                  ob_end_flush();
                }
            }else{
              ob_start(); 
              header("refresh: 3; url = ../views/Admin/gestionActividades.php"); 
              $errors = array();
              $errors["general"] = "ERROR. Formato de imagen no válido.";
              echo $errors["general"]; 
              ob_end_flush();
            }
          }else{
            ob_start(); 
             if ($_SESSION['usuario']->getTipoUsuario()=="DeportistaPEF" || $_SESSION['usuario']->getTipoUsuario()=="DeportistaTDU") {
                header("refresh: 3; url = ../views/Deportista/principal.php"); 
              }
              else{
                header("refresh: 3; url = ../views/Entrenador/principal.php"); 
              } 
            $errors = array();
            $errors["general"] = "No tiene permiso para crear una Actividad";
            echo $errors["general"]; 
            ob_end_flush();
          }
        } //FIN CREAR Actividad

        /* GET ACTIVIDAD*/
        public static function getActividad($idActividad){
        if(!isset($_SESSION)) session_start();

        $actividad = NULL;
        $actividad = Actividad::obtenerDatos($idActividad);
        if ($actividad == NULL){
          ob_start(); 
          header("refresh: 3; url = ../views/Admin/gestionEjercicios.php"); 
          $errors = array();
          $errors["general"] = "No existe la actividad";
          echo $errors["general"]; 
          ob_end_flush();
        }else{
          return $actividad;
        }
      } // FIN GET Actividad

      /*MODIFICAR ACTIVIDAD*/
        public static function modificarActividad(){
        if(!isset($_SESSION)) session_start();

        if($_SESSION['usuario']->getTipoUsuario()=="Administrador"){
          $idAct = $_POST['idAct'];
          $nombre = $_POST['nomAct'];
          $totalPlazas = $_POST['numPl'];
          $descripcion = $_POST['descrAct'];
          //Cogemos fecha y hora.
          $date = $_POST['fecha'];
          $tiempo = $_POST['hora'];
          //Juntamos Fecha y Hora en $fecha y el :00 es para añadirle los segundos
          $fecha= "$date $tiempo:00";
          $plazasOcupadas=$_POST['plazasOc'];

          // Recogemos el ID del entrenador a asignar
          $entrenador = $_POST['entrenador'];

          //Comprobamos el tipo de la Imagen, SI es correcto, obtenemos los datos de la ruta y de la imagen
          if($_FILES['imagen']['type']=="image/jpeg" || $_FILES['imagen']['type']=="image/png" || $_FILES['imagen']['type']=="image/jpg"){
                //Comprobamos si los datosintroducidos son Correctos
                if(Actividad::registroValido($nombre,$descripcion)){
                  //Creamos ruta donde guardamos la imagen yle damos nombre 
                  $ruta = "../img/actividades";
                  $archivo = $_FILES['imagen']['tmp-name'];
                  $nombreArchivo = $_FILES['imagen']['name'];
                  move_uploaded_file($archivo, $ruta."/".$nombreArchivo);
                  
                  //Llamamos a la funcion que modifica la Actividad
                  $actividad = Actividad::update($idAct,$nombre,$totalPlazas,$descripcion,$fecha,$plazasOcupadas,$nombreArchivo);
                  //Llamamos a la funcion que modifica Al entrenador Asignado
                   $asignarEntr = Actividad::updateAsignarEntrenador($entrenador,$idAct);
                  //Redireccionamos a vista 
                  header("Location: ../views/Admin/consultarActividades.php?id=$idAct"); 
                
                  }else{
                  ob_start(); 
                  header("refresh: 3; url = ../views/Admin/modificarActividad.php?id=$idAct"); 
                  $errors = array();
                  $errors["general"] = "ERROR.El formulario no fue bien completado.";
                  echo $errors["general"]; 
                  ob_end_flush();
                }
            }else{
              ob_start(); 
              header("refresh: 3; url = ../views/Admin/modificarActividad.php?id=$idAct"); 
              $errors = array();
              $errors["general"] = "ERROR. Formato de imagen no válido.";
              echo $errors["general"]; 
              ob_end_flush();
            }
          }else{
            ob_start(); 
             if ($_SESSION['usuario']->getTipoUsuario()=="DeportistaPEF" || $_SESSION['usuario']->getTipoUsuario()=="DeportistaTDU") {
                header("refresh: 3; url = ../views/Deportista/principal.php"); 
              }
              else{
                header("refresh: 3; url = ../views/Entrenador/principal.php"); 
              } 
            $errors = array();
            $errors["general"] = "No tiene permiso para modificar una Actividad";
            echo $errors["general"]; 
            ob_end_flush();
          }
        } //FIN MODIFICAR Actividad

        /* BORRAR ACTIVIDAD*/
        public static function borrarActividad(){
          if(!isset($_SESSION)) session_start();
            if($_SESSION['usuario']->getTipoUsuario()=="Administrador"){
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
                  ob_start();  
                  header("refresh: 3; url = ../views/Admin/gestionActividades.php");   
                  $errors = array();
                  $errors["general"] = "ERROR.La Actividad no existe.";
                  echo $errors["general"]; 
                  ob_end_flush();
                }
            }else{
              ob_start(); 
              if ($_SESSION['usuario']->getTipoUsuario()=="DeportistaPEF" || $_SESSION['usuario']->getTipoUsuario()=="DeportistaTDU") {
                header("refresh: 3; url = ../views/Deportista/principal.php"); 
              }
              else{
                header("refresh: 3; url = ../views/Entrenador/principal.php"); 
              }  
              $errors = array();
              $errors["general"] = "No tiene permiso para modificar un Ejercicio";
              echo $errors["general"]; 
              ob_end_flush();
            }
        }//FIN BORRAR ACTIVIDAD

  }  
?>
