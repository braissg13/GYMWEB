<?php

	class TablaController{

		/*Obtenemos todos las TABLAS DE EJERCICIOS*/
		public static function getAll(){
			if(!isset($_SESSION)) session_start();
			$tablas = new Tabla();
			return $tablas->getAllTablas();
		}

		/* Obtenemos los datos deuna Tabla determinada*/
        public static function getTabla($idTablaEjercicios){
	        if(!isset($_SESSION)) session_start();

	        $tabla = NULL;
	        $tabla = Tabla::obtenerDatos($idTablaEjercicios);
	        if ($tabla == NULL){
	          ob_start(); 
	          header("refresh: 3; url = ../views/Entrenador/gestionTablas.php"); 
	          $errors = array();
	          $errors["general"] = "La tabla no existe.";
	          echo $errors["general"]; 
	          ob_end_flush();
	        }else{
	          return $tabla;
	        }
	     } // FIN GET TABLA

	    /*Obtenemos a un array de Ejercicios que pertenecen a una Tabla*/
        public static function getEjercicios($idTablaEjercicios){
          if(!isset($_SESSION)) session_start();
          $ejerciciosTabla = Tabla::getEjersTabla($idTablaEjercicios);
          return $ejerciciosTabla;
        }

        /*Obtenemos a un array de Usuarios que pertenecen a una Tabla*/
        public static function getDeportistasAsignados($idTablaEjercicios){
          if(!isset($_SESSION)) session_start();
          $deportistasTabla = Tabla::getDeportistasTabla($idTablaEjercicios);
          return $deportistasTabla;
        }

        /*Asignamos un DeportistaTDU a una Tabla*/
        public static function asignarDeportistaTDU(){
          if(!isset($_SESSION)) session_start();
          $deportista = $_POST['idUsuario'];
          $idTabla = $_POST['idTabla'];
          //asignamos deportista a Tabla
          $deportistaAsignado = Tabla::asignarDeportistaTabla($idTabla,$deportista);
          //redireccionamos a vista
          header("Location: ../views/Entrenador/asignarTabla.php?id=$idTabla");
        }

         /*Borramos la asignacion de un deportistaTDU a una Tabla*/
        public static function deleteAsignarDeportistaTDU(){
          if(!isset($_SESSION)) session_start();
          $deportista = $_POST['idUsuario'];
          $idTabla = $_POST['idTabla'];
          //asignamos deportista a Tabla
          $eliminarDeportistaAsignado = Tabla::borrarDeportistaAsignadoTabla($idTabla,$deportista);
          //redireccionamos a vista
          header("Location: ../views/Entrenador/asignarTabla.php?id=$idTabla");
        }

        /*Asignamos un DeportistaPEF a una Tabla*/
        public static function asignarDeportistaPEF(){
          if(!isset($_SESSION)) session_start();
          $deportista = $_POST['idUsuario'];
          $idTabla = $_POST['idTabla'];
          //asignamos deportista a Tabla
          $deportistaAsignado = Tabla::asignarDeportistaTabla($idTabla,$deportista);
          //redireccionamos a vista
          header("Location: ../views/Entrenador/asignarTablaPEF.php?id=$idTabla");
        }

         /*Borramos la asignacion de un deportistaPEF a una Tabla*/
        public static function deleteAsignarDeportistaPEF(){
          if(!isset($_SESSION)) session_start();
          $deportista = $_POST['idUsuario'];
          $idTabla = $_POST['idTabla'];
          //asignamos deportista a Tabla
          $eliminarDeportistaAsignado = Tabla::borrarDeportistaAsignadoTabla($idTabla,$deportista);
          //redireccionamos a vista
          header("Location: ../views/Entrenador/asignarTablaPEF.php?id=$idTabla");
        }

		public static function crearTabla(){
	  		if(!isset($_SESSION)) session_start();
	  		if($_SESSION["usuario"]->getTipoUsuario() == 'Entrenador'){
	  			/*Si lo invoca un entrenador, cogemos las variables que nos pasa el submit por post*/
	  			$nomTabla = $_POST["NomTabla"];
	  			$ejersSeleccionados = $_POST["ejerSeleccionado"];
	  			$tipoTabla = $_POST["TipoTabla"];
	  			$idTabla = "NULL";
	  			/*Comprobamos que el nombre de la Tabla no existe para seguir con el registro*/
	  			if(!TablaMapper::existeTabla($nomTabla)){
		  			/*Comprobamos si es valido el registro, para despues darlo de alta*/
		  			if(Tabla::registroValido($nomTabla)){
		  				/*Si es valido lo Guardamos en la BD, Creamos un objerto Usuario para pasarlo almétodo*/
		  				$tabla = new Tabla();
		  				/*Meto un ID USUARIO NULL porque lo necesito parael constructor, despues no seutiliza para nada.*/
		  				$tabla->setIdTabla($idTabla);
		  				$tabla->setNomTabla($nomTabla);
		  				$tabla->setTipoTabla($tipoTabla);
		  				$tabla->guardarTabla($tabla);

		  				//recogemos los datos de la Tabla guardada para asignar los ejercicios
                  		$tab = Tabla::datosTabla($nomTabla);
                  		$idTab = $tab->getIdTabla();
                  		//En el foreach guardamos ne la tabla ejercicio_tablaejercicios los ejercicios y tabla seleccionados
		  				foreach ($ejersSeleccionados as $ejercicio) {
		  					$asignarEjer = Tabla::asignarEjers($ejercicio,$idTab);
		  				}
		  				
		  				header("Location: ../views/Entrenador/gestionTablas.php");
		  			}else{
		  				/*Si no le decimos cual es el error*/
		  				ob_start();
		  				header("refresh: 5; url = ../views/Entrenador/crearTablas.php");
						$errors = array();
						$errors["general"] = "La tabla no pudo ser creada.";
						echo $errors["general"];
						ob_end_flush();
		  			}
	  		  	}else{
	  		  			ob_start();
		  				header("refresh: 5; url = ../views/Entrenador/crearTablas.php");
						$errors = array();
						$errors["general"] = "ERROR. El Nombre de Tabla ya existe.";
						echo $errors["general"];
						ob_end_flush();
	  		  	}
	  		}else{
	  			ob_start();
	  			if($_SESSION["usuario"]->getTipoUsuario() == 'DeportistaTDU' || $_SESSION["usuario"]->getTipoUsuario() == 'DeportistaPEF') {
		  				header("refresh: 3; url = ../views/Deportista/principal.php"); 
		  			}else{
		  				header("refresh: 3; url = ../views/Admin/principal.php"); 
		  			}
				$errors = array();
				$errors["general"] = "No tiene permiso para crear una Tabla de Ejercicios";
				echo $errors["general"]; 
				ob_end_flush();
	  		}
	  	}//FIN CREAR TABLA

	  	public static function modificarTabla(){
			if(!isset($_SESSION)) session_start();
			if($_SESSION['usuario']->getTipoUsuario()=="Entrenador"){
				/*Si lo invoca un entrenador, cogemos las variables que nos pasa el submit por post*/
	  			$idTabla = $_POST["idTabla"];
	  			$nomTabla = $_POST["NomTabla"];
	  			$ejersSeleccionados = $_POST["ejerSeleccionado"];
	  			$tipoTabla = $_POST["TipoTabla"];
				//Comprobamos si los datos introducidos son Correctos
					if(Tabla::registroValido($nomTabla)){
						//Lamamos a la funcion que modifica la Tabla
						Tabla::update($idTabla,$nomTabla,$tipoTabla);
						//Para modificar los Ejercicios que corresponden a la tabla primero tenemosque elimar los que esaban asignados y despues los asignamos.
						Tabla::deleteEjersTabla($idTabla);
						//En el foreach creamos la asignacion de los ejercicios a la Tabla en ejercicio_tablaejercicios
		  				foreach ($ejersSeleccionados as $ejercicio) {
		  					$asignarEjer = Tabla::asignarEjers($ejercicio,$idTabla);
		  				}
						//Redireccionamos a vista
						header("Location: ../views/Entrenador/consultarTabla.php?id=$idTabla");
					}else{
						ob_start();
						header("refresh: 3; url = ../views/Entrenador/modificarTabla.php?id=$idTabla");
						$errors = array();
						$errors["general"] = "ERROR.El formulario no fue bien completado.";
						echo $errors["general"];
						ob_end_flush();
							}
				}else{
					ob_start();
					 if ($_SESSION['usuario']->getTipoUsuario()=="DeportistaPEF" || $_SESSION['usuario']->getTipoUsuario()=="DeportistaTDU") {
							header("refresh: 3; url = ../views/Deportista/principal.php");
						}
						else{
							header("refresh: 3; url = ../views/Admin/principal.php");
						}
					$errors = array();
					$errors["general"] = "No tiene permiso para modificar una Tabla";
					echo $errors["general"];
					ob_end_flush();
				}
		} //FIN MODIFICAR TABLA

		/* BORRAR TABLA*/
        public static function borrarTabla(){
          if(!isset($_SESSION)) session_start();
            if($_SESSION['usuario']->getTipoUsuario()=="Entrenador"){
                $idTabla = $_POST['idTabla'];
                $nombre = $_POST['nomTabla'];
                //Comprobamos si existe la actividad para poder borrarlo
                if(TablaMapper::existeTabla($nombre)){
                  //Lamamos a la funcion que elimina la Relacion Ejercicio-Tabla
                  Tabla::deleteEjersTabla($idTabla);
                  //Llamamos a funcion que elimina la Relacion DeportistaAsignado-Tabla
                  Tabla::deleteDeportistaTabla($idTabla);
                  //Llamamos a la funcion que elimina la relacion Deportista-Comentario
				  Tabla::deleteComentarioTabla($idTabla);
                  //Lamamos a la funcion que elimina la Tabla
                  Tabla::delete($idTabla);
                  //Redireccionamos a vista
                  header("Location: ../views/Entrenador/gestionTablas.php"); 
                }else{
                  ob_start();  
                  header("refresh: 3; url = ../views/Entrenador/gestionTablas.php");   
                  $errors = array();
                  $errors["general"] = "ERROR.La Tabla no existe.";
                  echo $errors["general"]; 
                  ob_end_flush();
                }
            }else{
              ob_start(); 
              if ($_SESSION['usuario']->getTipoUsuario()=="DeportistaPEF" || $_SESSION['usuario']->getTipoUsuario()=="DeportistaTDU") {
                header("refresh: 3; url = ../views/Deportista/principal.php"); 
              }
              else{
                header("refresh: 3; url = ../views/Admin/principal.php"); 
              }  
              $errors = array();
              $errors["general"] = "No tiene permiso para modificar una Tabla";
              echo $errors["general"]; 
              ob_end_flush();
            }
        }//FIN BORRAR TABLA

	}
?>