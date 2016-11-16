<?php

	class EjercicioController{

		/*Obtenemos todos los EJERCICIOS*/
		public static function getAll(){
			if(!isset($_SESSION)) session_start();
			$ejercicios = new Ejercicio();
			return $ejercicios->getAllEjercicios();
		}

		public static function crearEjercicio(){
			if(!isset($_SESSION)) session_start();

			if($_SESSION['usuario']->getTipoUsuario()=="Administrador" || $_SESSION['usuario']->getTipoUsuario()=="Entrenador" ){
				$nombre = $_POST['NomEjercicio'];
				$descripcion = $_POST['DescripEjerc'];
				$tipo = $_POST['TipoEjerc'];
				$repeticiones = $_POST['Repeticiones'];
				$carga = $_POST['carga'];
				$idEjer = "NULL";

				//Comprobamos el tipo de la Imagen, SI es correcto, obtenemos los datos de la ruta y de la imagen
				if($_FILES['imagen']['type']=="image/jpeg" || $_FILES['imagen']['type']=="image/png" || $_FILES['imagen']['type']=="image/jpg"){
						//Comprobamos si no existe el ejercicio para poder guardarlo
						if(!EjercicioMapper::existeEjercicio($nombre)){
							//Comprobamos si los datosintroducidos son Correctos
							if(Ejercicio::registroValido($nombre,$descripcion,$repeticiones)){
								//Creamos ruta donde guardamos la imagen yle damos nombre 
								$ruta = "../img/ejercicios";
								$archivo = $_FILES['imagen']['tmp-name'];
								$nombreArchivo = $_FILES['imagen']['name'];
								move_uploaded_file($archivo, $ruta."/".$nombreArchivo);
								//Creamos el Ejercicio
								$ejercicio = new Ejercicio();

								$ejercicio->setIdEjercicio($idEjer);
								$ejercicio->setNomEjercicio($nombre);
								$ejercicio->setDescripEjercicio($descripcion);
								$ejercicio->setTipoEjercicio($tipo);
								$ejercicio->setRepeticiones($repeticiones);
								$ejercicio->setCarga($carga);
								$ejercicio->setImagenEjercicio($nombreArchivo);

	  							$ejercicio->guardarEjercicio($ejercicio);
	  							if ($_SESSION['usuario']->getTipoUsuario()=="Administrador") {
								header("Location: ../views/Admin/gestionEjercicios.php"); 
								}
								else{
								header("Location: ../views/Entrenador/gestionEjercicios.php"); 
								} 
							}else{
								ob_start(); 
	  							if ($_SESSION['usuario']->getTipoUsuario()=="Administrador") {
								header("refresh: 3; url = ../views/Admin/gestionEjercicios.php"); 
								}
								else{
								header("refresh: 3; url = ../views/Entrenador/gestionEjercicios.php"); 
								} 
								$errors = array();
								$errors["general"] = "ERROR.El formulario no fue bien completado.";
								echo $errors["general"]; 
								ob_end_flush();
							}
						}else{
							ob_start(); 
	  						if ($_SESSION['usuario']->getTipoUsuario()=="Administrador") {
							header("refresh: 3; url = ../views/Admin/gestionEjercicios.php"); 
							}
							else{
							header("refresh: 3; url = ../views/Entrenador/gestionEjercicios.php"); 
							} 
							$errors = array();
							$errors["general"] = "ERROR.El ejercicio ya existe.";
							echo $errors["general"]; 
							ob_end_flush();
						}
					}else{
						ob_start(); 
						if ($_SESSION['usuario']->getTipoUsuario()=="Administrador") {
							header("refresh: 3; url = ../views/Admin/gestionEjercicios.php"); 
						}
						else{
							header("refresh: 3; url = ../views/Entrenador/gestionEjercicios.php"); 
						}
	  					
						$errors = array();
						$errors["general"] = "ERROR. Formato de imagen no válido.";
						echo $errors["general"]; 
						ob_end_flush();
					}
				}else{
					ob_start(); 
	  				header("refresh: 3; url = ../views/Deportista/principal.php"); 
					$errors = array();
					$errors["general"] = "No tiene permiso para crear un Ejercicio";
					echo $errors["general"]; 
					ob_end_flush();
				}
			} //FIN CREAR EJERCICIO

			public static function getEjercicio($idEjercicio){
				if(!isset($_SESSION)) session_start();

				$ejercicio = NULL;
				$ejercicio = Ejercicio::obtenerDatos($idEjercicio);
				if ($ejercicio == NULL){
					ob_start(); 
	  				if ($_SESSION['usuario']->getTipoUsuario()=="Administrador") {
						header("refresh: 3; url = ../views/Admin/gestionEjercicios.php"); 
					}
					else{
						header("refresh: 3; url = ../views/Entrenador/gestionEjercicios.php"); 
					} 
					$errors = array();
					$errors["general"] = "El formulario no fue completado.";
					echo $errors["general"]; 
					ob_end_flush();
				}else{
					return $ejercicio;
				}
			} // FIN GET EJERCICIO

			public static function modificarEjercicio(){
				if(!isset($_SESSION)) session_start();
					if($_SESSION['usuario']->getTipoUsuario()=="Administrador" || $_SESSION['usuario']->getTipoUsuario()=="Entrenador" ){
							$idEjercicio = $_POST['idEjercicio'];
							$nombre = $_POST['NomEjercicio'];
							$descripcion = $_POST['DescripEjerc'];
							$tipo = $_POST['TipoEjerc'];
							$repeticiones = $_POST['Repeticiones'];
							$carga = $_POST['carga'];
						//Comprobamos el tipo de la Imagen, SI es correcto, obtenemos los datos de la ruta y de la imagen
						if($_FILES['imagen']['type']=="image/jpeg" || $_FILES['imagen']['type']=="image/png" || $_FILES['imagen']['type']=="image/jpg"){
							//Comprobamos si los datosintroducidos son Correctos
							if(Ejercicio::registroValido($nombre,$descripcion,$repeticiones)){
								//Creamos ruta donde guardamos la imagen yle damos nombre 
								$ruta = "../img/ejercicios";
								$archivo = $_FILES['imagen']['tmp-name'];
								$nombreArchivo = $_FILES['imagen']['name'];
								move_uploaded_file($archivo, $ruta."/".$nombreArchivo);

								//Lamamos a la funcion que modifica el Ejercicio
								Ejercicio::update($idEjercicio,$nombre,$descripcion,$tipo,$repeticiones,$carga,$nombreArchivo);
								//Redireccionamos a vista dependiendo del Usuario que modifico el Ejercicio
								if ($_SESSION['usuario']->getTipoUsuario()=="Administrador") {
								header("Location: ../views/Admin/consultarEjercicios.php?id=$idEjercicio"); 
								}
								else{
								header("Location: ../views/Entrenador/consultarEjercicios.php?id=$idEjercicio"); 
								} 
							}else{
								ob_start(); 
	  							if ($_SESSION['usuario']->getTipoUsuario()=="Administrador") {
								header("refresh: 3; url = ../views/Admin/modificarEjercicios.php?id=$idEjercicio"); 
								}
								else{
								header("refresh: 3; url = ../views/Entrenador/modificarEjercicios.php?id=$idEjercicio"); 
								} 
								$errors = array();
								$errors["general"] = "ERROR.El formulario no fue bien completado.";
								echo $errors["general"]; 
								ob_end_flush();
							}
						}else{
							ob_start(); 
							if ($_SESSION['usuario']->getTipoUsuario()=="Administrador") {
								header("refresh: 3; url = ../views/Admin/modificarEjercicios.php?id=$idEjercicio"); 
							}
							else{
								header("refresh: 3; url = ../views/Entrenador/modificarEjercicios.php?id=$idEjercicio"); 
							}
		  					
							$errors = array();
							$errors["general"] = "ERROR. Formato de imagen no válido.";
							echo $errors["general"]; 
							ob_end_flush();
						}
					}else{
						ob_start(); 
		  				header("refresh: 3; url = ../views/Deportista/principal.php"); 
						$errors = array();
						$errors["general"] = "No tiene permiso para modificar un Ejercicio";
						echo $errors["general"]; 
						ob_end_flush();
					}

			} //FIN MODIFICAR EJERCICIO

			public static function borrarEjercicio(){
				if(!isset($_SESSION)) session_start();
					if($_SESSION['usuario']->getTipoUsuario()=="Administrador" || $_SESSION['usuario']->getTipoUsuario()=="Entrenador" ){
							$idEjercicio = $_POST['idEjercicio'];
							$nombre = $_POST['NomEjercicio'];
							//Comprobamos si existe el ejercicio para poder borrarlo
							if(EjercicioMapper::existeEjercicio($nombre)){
								//Lamamos a la funcion que elimina el Ejercicio
								Ejercicio::delete($idEjercicio);
								//Redireccionamos a vista dependiendo del Usuario que modifico el Ejercicio
								if ($_SESSION['usuario']->getTipoUsuario()=="Administrador") {
								header("Location: ../views/Admin/gestionEjercicios.php"); 
								}
								else{
								header("Location: ../views/Entrenador/gestionEjercicios.php"); 
								} 
							}else{
								ob_start(); 
		  						if ($_SESSION['usuario']->getTipoUsuario()=="Administrador") {
								header("refresh: 3; url = ../views/Admin/gestionEjercicios.php"); 
								}
								else{
								header("refresh: 3; url = ../views/Entrenador/gestionEjercicios.php"); 
								} 
								$errors = array();
								$errors["general"] = "ERROR.El ejercicio no existe.";
								echo $errors["general"]; 
								ob_end_flush();
							}
					}else{
						ob_start(); 
		  				header("refresh: 3; url = ../views/Deportista/principal.php"); 
						$errors = array();
						$errors["general"] = "No tiene permiso para modificar un Ejercicio";
						echo $errors["general"]; 
						ob_end_flush();
					}
			}//FIN BORRAR EJERCICIO
	}
?>