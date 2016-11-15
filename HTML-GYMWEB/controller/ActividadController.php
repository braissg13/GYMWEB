<?php

	class ActividadController{


    		/*Obtenemos todos las ACTIVIDADES*/
    		public static function getAll(){
    			if(!isset($_SESSION)) session_start();
    			$actividades = new Actividad();
    			return $actividades->getAllActividades();
    		}

        /*CREAR ACTIVIDAD*/
        public static function crearActividad(){
          if(!isset($_SESSION)) session_start();

          if($_SESSION['usuario']->getTipoUsuario()=="Administrador" ){
            $nombre = $_POST['nomAct'];
            $plazas = $_POST['numPl'];
            $fecha= $_POST['dateAct'];
            $descrip = $_POST['descAct'];
            $idAct = "NULL";

            //Comprobamos el tipo de la Imagen, SI es correcto, obtenemos los datos de la ruta y de la imagen
            if($_FILES['imagen']['type']=="image/jpeg" || $_FILES['imagen']['type']=="image/png" || $_FILES['imagen']['type']=="image/jpg"){
                //Comprobamos si no existe la actividad para poder guardarla
                if(!ActividadMapper::existeActividad($nombre)){
                  //Comprobamos si los datosintroducidos son Correctos
                  if(Actividad::registroValido($nombre,$plazas,$fecha,$descrip)){
                    //Creamos ruta donde guardamos la imagen yle damos nombre
                    $ruta = "../img/actividades";
                    $archivo = $_FILES['imagen']['tmp-name'];
                    $nombreArchivo = $_FILES['imagen']['name'];
                    move_uploaded_file($archivo, $ruta."/".$nombreArchivo);
                    //Creamos la Actividad
                    $actividad = new Actividad();

                    $actividad->setIdActividad($idAct);
                    $actividad->setNomActividad($nombre);
                    $actividad->setDescripActividad($descrip);
                    $actividad->setPlazas($plazas);
                    $actividad->setFecha($fecha);
                    $actividad>setImagenActividad($nombreArchivo);

                      $actividad->guardarActividad($actividad);
                      if ($_SESSION['usuario']->getTipoUsuario()=="Administrador") {
                    header("Location: ../views/Admin/gestionActividades.php");
                    }

                  }else{
                    ob_start();
                      if ($_SESSION['usuario']->getTipoUsuario()=="Administrador") {
                    header("refresh: 3; url = ../views/Admin/gestionActividades.php");
                    }

                    $errors = array();
                    $errors["general"] = "ERROR.El formulario no fue bien completado.";
                    echo $errors["general"];
                    ob_end_flush();
                  }
                }else{
                  ob_start();
                    if ($_SESSION['usuario']->getTipoUsuario()=="Administrador") {
                  header("refresh: 3; url = ../views/Admin/gestionActividades.php");
                  }

                  $errors = array();
                  $errors["general"] = "ERROR.La actividad ya existe.";
                  echo $errors["general"];
                  ob_end_flush();
                }
              }else{
                ob_start();
                if ($_SESSION['usuario']->getTipoUsuario()=="Administrador") {
                  header("refresh: 3; url = ../views/Admin/gestionActividades.php");
                }}

                $errors = array();
                $errors["general"] = "ERROR. Formato de imagen no válido.";
                echo $errors["general"];
                ob_end_flush();
              }
          /*  }else{
              ob_start();
                header("refresh: 3; url = ../views/Deportista/principal.php");
              $errors = array();
              $errors["general"] = "No tiene permiso para crear una Actividad";
              echo $errors["general"];
              ob_end_flush();
            }*/
          } //FIN CREAR ACTIVIDAD

          public static function getActividad($idActividad){
            if(!isset($_SESSION)) session_start();

            $actividad = NULL;
            $actividad = Actividad::obtenerDatos($idActividad);
            if ($actividad == NULL){
              ob_start();
                if ($_SESSION['usuario']->getTipoUsuario()=="Administrador") {
                header("refresh: 3; url = ../views/Admin/gestionActividades.php");
              }
              $errors = array();
              $errors["general"] = "El formulario no fue completado.";
              echo $errors["general"];
              ob_end_flush();
            }else{
              return $actividad;
            }
          } // FIN GET ACTIVIDAD


          public static function modificarActividad(){
            if(!isset($_SESSION)) session_start();
              if($_SESSION['usuario']->getTipoUsuario()=="Administrador" ){
                  $idActividad = $_POST['idActividad'];
                  $nombre = $_POST['nomAct'];
                  $plazas = $_POST['numPl'];
                  $fecha= $_POST['dateAct'];
                  $descrip = $_POST['descAct'];
                //Comprobamos el tipo de la Imagen, SI es correcto, obtenemos los datos de la ruta y de la imagen
                if($_FILES['imagen']['type']=="image/jpeg" || $_FILES['imagen']['type']=="image/png" || $_FILES['imagen']['type']=="image/jpg"){
                  //Comprobamos si los datosintroducidos son Correctos
                  if(Ejercicio::registroValido($nombre,$plazas,$fecha,$descrip)){
                    //Creamos ruta donde guardamos la imagen yle damos nombre
                    $ruta = "../img/actividades";
                    $archivo = $_FILES['imagen']['tmp-name'];
                    $nombreArchivo = $_FILES['imagen']['name'];
                    move_uploaded_file($archivo, $ruta."/".$nombreArchivo);

                    //Lamamos a la funcion que modifica la Actividad
                    Actividad::update($idActividad,$nombre,$plazas,$fecha,$descrip,$nombreArchivo);
                    //Redireccionamos la vista al Usuario que modifico la Actividad
                    if ($_SESSION['usuario']->getTipoUsuario()=="Administrador") {
                    header("Location: ../views/Admin/consultarActividades.php?id=$idActividad");
                    }
                  }else{
                    ob_start();
                      if ($_SESSION['usuario']->getTipoUsuario()=="Administrador") {
                    header("refresh: 3; url = ../views/Admin/modificarActividad.php?id=$idActividad");
                    }
                    $errors = array();
                    $errors["general"] = "ERROR.El formulario no fue bien completado.";
                    echo $errors["general"];
                    ob_end_flush();
                  }
                }else{
                  ob_start();
                  if ($_SESSION['usuario']->getTipoUsuario()=="Administrador") {
                    header("refresh: 3; url = ../views/Admin/modificarActividad.php?id=$idActividad");
                  }

                  $errors = array();
                  $errors["general"] = "ERROR. Formato de imagen no válido.";
                  echo $errors["general"];
                  ob_end_flush();
                }
              }

          } //FIN MODIFICAR ACTIVIDAD

          public static function borrarActividad(){
            if(!isset($_SESSION)) session_start();
              if($_SESSION['usuario']->getTipoUsuario()=="Administrador" ){
                  $idActividad = $_POST['idActividad'];
                  $nombre = $_POST['nomAct'];
                  //Comprobamos si existe la actividado para poder borrarlo
                  if(ActividadMapper::existeActividad($nombre)){
                    //Lamamos a la funcion que elimina la Actividad
                    Actividad::delete($idActividad);
                    //Redireccionamos a vista al usuario que modifico la Actividad
                    if ($_SESSION['usuario']->getTipoUsuario()=="Administrador") {
                    header("Location: ../views/Admin/gestionActividades.php");
                    }

                  }else{
                    ob_start();
                      if ($_SESSION['usuario']->getTipoUsuario()=="Administrador") {
                    header("refresh: 3; url = ../views/Admin/gestionActividades.php");
                    }
                    $errors = array();
                    $errors["general"] = "ERROR.La actividad ya existe.";
                    echo $errors["general"];
                    ob_end_flush();
                  }
              }else{
                ob_start();
                  header("refresh: 3; url = ../views/Deportista/principal.php");
                $errors = array();
                $errors["general"] = "No tiene permiso para modificar una Actividad";
                echo $errors["general"];
                ob_end_flush();
              }
          }
      }
    ?>
