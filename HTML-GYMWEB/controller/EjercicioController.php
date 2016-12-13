<?php
require_once(__DIR__."/../conexion/bdConexion.php");
require_once(__DIR__."/../model/EjercicioMapper.php");
require_once(__DIR__."/../model/Ejercicio.php");

	class EjercicioController{

		/*Obtenemos todos los EJERCICIOS*/
		public static function getAll(){
			if(!isset($_SESSION)) session_start();
			$ejercicios = new Ejercicio();
			return $ejercicios->getAllEjercicios();
		}

		public static function crearEjercicio(){
			if(!isset($_SESSION)) session_start();

			if($_SESSION['tipoUsuario']=="Administrador" || $_SESSION['tipoUsuario'] =="Entrenador" ){
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
								$nombreArchivo = $_FILES['imagen']['name'];
								move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta."/".$nombreArchivo);
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
	  							if ($_SESSION['tipoUsuario']=="Administrador") {
								header("Location: ../views/Admin/gestionEjercicios.php"); 
								}
								else{
								header("Location: ../views/Entrenador/gestionEjercicios.php"); 
								} 
							}else{
								$error = "ERROR.El formulario no fue bien completado.";
								header("Location: ../views/error.php?error=$error");
							}
						}else{
							$error = "ERROR.El ejercicio ya existe.";
							header("Location: ../views/error.php?error=$error");
						}
					}else{
						$error = "ERROR. Formato de imagen no válido.";
						header("Location: ../views/error.php?error=$error");
					}
				}else{
					$error = "No tiene permiso para crear un Ejercicio";
					header("Location: ../views/error.php?error=$error"); 
				}
			} //FIN CREAR EJERCICIO

			public static function getEjercicio($idEjercicio){
				if(!isset($_SESSION)) session_start();

				$ejercicio = NULL;
				$ejercicio = Ejercicio::obtenerDatos($idEjercicio);
				if ($ejercicio == NULL){
					$error = "El ejercicio no existe";
					header("Location: ../views/error.php?error=$error");
				}else{
					return $ejercicio;
				}
			} // FIN GET EJERCICIO

			public static function modificarEjercicio(){
				if(!isset($_SESSION)) session_start();
					if($_SESSION['tipoUsuario']=="Administrador" || $_SESSION['tipoUsuario']=="Entrenador" ){
							$idEjercicio = $_POST['idEjercicio'];
							 //Utilizamos el ejercicio sin modificar por si no nos pasan unos argumentos, asignarle los que ya tenía
							$ejercSinModificar = Ejercicio::obtenerDatos($idEjercicio);
							//Si no pasan nombre, cogemos el nombre que ya tenia
							if ($_POST['NomEjercicio']!= null) {
					           $nombre = $_POST['NomEjercicio'];
					        }else{
					           $nombre = $ejercSinModificar->getNomEjercicio();
					        }
					        //Si no pasan descrip, cogemos la descrip que ya tenia
					        if ($_POST['DescripEjerc']!= null) {
					           $descripcion = $_POST['DescripEjerc'];
					        }else{
					           $descripcion = $ejercSinModificar->getDescripEjercicio();
					        }
					        //Si no pasan tipoEjercicio, cogemos el tipoEjercicio que ya tenia
					        if ($_POST['TipoEjerc']!= null) {
					           $tipo = $_POST['TipoEjerc'];
					        }else{
					           $tipo = $ejercSinModificar->getTipoEjercicio();
					        }
					        //Si no pasan repeticiones, cogemos las repeticiones que ya tenia
					        if ($_POST['Repeticiones']!= null) {
					           $repeticiones = $_POST['Repeticiones'];
					        }else{
					           $repeticiones = $ejercSinModificar->getRepeticiones();
					        }
					        //Si no pasan carga, cogemos la carga que ya tenia
					        if ($_POST['carga']!= null) {
					           $carga = $_POST['carga'];
					        }else{
					           $carga = $ejercSinModificar->getCarga();
					        }
					         //Si no pasan imagen, cogemos la imagen que ya tenia
        					if ($_FILES['imagen']['name'] != null) {
						//Comprobamos el tipo de la Imagen, SI es correcto, obtenemos los datos de la ruta y de la imagen
						if($_FILES['imagen']['type']=="image/jpeg" || $_FILES['imagen']['type']=="image/png" || $_FILES['imagen']['type']=="image/jpg"){
							//Comprobamos si los datosintroducidos son Correctos
							if(Ejercicio::registroValido($nombre,$descripcion,$repeticiones)){
								//Creamos ruta donde guardamos la imagen yle damos nombre 
								$ruta = "../img/ejercicios";
								$nombreArchivo = $_FILES['imagen']['name'];
								move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta."/".$nombreArchivo);

								//Lamamos a la funcion que modifica el Ejercicio
								Ejercicio::update($idEjercicio,$nombre,$descripcion,$tipo,$repeticiones,$carga,$nombreArchivo);
								//Redireccionamos a vista dependiendo del Usuario que modifico el Ejercicio
								if ($_SESSION['tipoUsuario']=="Administrador") {
								header("Location: ../views/Admin/consultarEjercicios.php?id=$idEjercicio"); 
								}
								else{
								header("Location: ../views/Entrenador/consultarEjercicios.php?id=$idEjercicio"); 
								} 
							}else{
								$error = "ERROR.El formulario no fue bien completado.";
								header("Location: ../views/error.php?error=$error");
							}
						}else{
							$error = "ERROR. Formato de imagen no válido.";
							header("Location: ../views/error.php?error=$error");
						}
					  }else{
					  	$nombreArchivo = $ejercSinModificar->getImagenEjercicio();
					  	//Comprobamos si los datosintroducidos son Correctos
						if(Ejercicio::registroValido($nombre,$descripcion,$repeticiones)){
						  	//Lamamos a la funcion que modifica el Ejercicio
							Ejercicio::update($idEjercicio,$nombre,$descripcion,$tipo,$repeticiones,$carga,$nombreArchivo);
							//Redireccionamos a vista dependiendo del Usuario que modifico el Ejercicio
							if ($_SESSION['tipoUsuario']=="Administrador") {
							header("Location: ../views/Admin/consultarEjercicios.php?id=$idEjercicio"); 
							}
							else{
							header("Location: ../views/Entrenador/consultarEjercicios.php?id=$idEjercicio"); 
							}
						}else{
							$error = "ERROR.El formulario no fue bien completado.";
							header("Location: ../views/error.php?error=$error");
						}
					  }
					}else{
						$error= "No tiene permiso para modificar un Ejercicio";
						header("Location: ../views/error.php?error=$error");
					}

			} //FIN MODIFICAR EJERCICIO

			public static function borrarEjercicio(){
				if(!isset($_SESSION)) session_start();
					if($_SESSION['tipoUsuario']=="Administrador" || $_SESSION['tipoUsuario']=="Entrenador" ){
							$idEjercicio = $_POST['idEjercicio'];
							$nombre = $_POST['NomEjercicio'];
							//Comprobamos si existe el ejercicio para poder borrarlo
							if(EjercicioMapper::existeEjercicio($nombre)){
								//Llamamos a la funcion que elimina la relacion Ejercicio-Tabla
								Ejercicio::deleteEjercicioTabla($idEjercicio);
								//LLamamos a la funcion que elimina el Ejercicio
								Ejercicio::delete($idEjercicio);
								//Redireccionamos a vista dependiendo del Usuario que modifico el Ejercicio
								if ($_SESSION['tipoUsuario']=="Administrador") {
								header("Location: ../views/Admin/gestionEjercicios.php"); 
								}
								else{
								header("Location: ../views/Entrenador/gestionEjercicios.php"); 
								} 
							}else{
								$error = "ERROR.El ejercicio no existe.";
								header("Location: ../views/error.php?error=$error");
							}
					}else{
						$error = "No tiene permiso para modificar un Ejercicio";
						header("Location: ../views/error.php?error=$error");
					}
			}//FIN BORRAR EJERCICIO
	}
?>