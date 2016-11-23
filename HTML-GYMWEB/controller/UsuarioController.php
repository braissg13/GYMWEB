<?php
require_once(__DIR__."/../conexion/bdConexion.php");
require_once(__DIR__."/../model/UsuarioMapper.php");
require_once(__DIR__."/../model/Usuario.php");

class UsuarioController{
	/*Obtenemos todos los Usuarios*/
	public static function getAll(){
		if(!isset($_SESSION)) session_start();
		$usuarios = new Usuario();
		return $usuarios->getAllUsuarios();
	}

	/*Obtenemos todos los Entrenadores*/
	public static function getAllEntrenadores(){
		if(!isset($_SESSION)) session_start();
		$entrenador = new Usuario();
		return $entrenador->getAllEntrenadores();
	}

	/*Obtenemos todos los Deportistas TDU*/
	public static function getAllDeportistasTDU(){
		if(!isset($_SESSION)) session_start();
		$deportista = new Usuario();
		return $deportista->getAllDeportistasTDU();
	}

	/*Obtenemos todos los Deportistas PEF*/
	public static function getAllDeportistasPEF(){
		if(!isset($_SESSION)) session_start();
		$deportista = new Usuario();
		return $deportista->getAllDeportistasPEF();
	}

	/*Obtenemos todos las Actividades que Pertenecen a un entrenador*/
	public static function getActividadesEntrenador($idUsuario){
		if(!isset($_SESSION)) session_start();
         $actividad = Usuario::getActividadesAsignadas($idUsuario);
         return $actividad;
	}

	/*Obtenemos todos las Tablas que Pertenecen a un Deportista*/
	public static function getTablasDeportista($idUsuario){
		if(!isset($_SESSION)) session_start();
				$tablaejercicios = Usuario::getTablasEntrenamientos($idUsuario);
				return $tablaejercicios;
	}

	/*Añadimos un Comentario*/
	public static function addComentarioTabla(){
		if(!isset($_SESSION)) session_start();
		if($_SESSION['tipoUsuario'] =="DeportistaTDU" || $_SESSION['tipoUsuario']=="DeportistaPEF"){
			$idTabla = $_POST['idTabla'];
			$idUsuario = $_POST['idUsuario'];
			$completado = $_POST['completado'];
			$comentario = $_POST['comentario'];
			//Obtenemos fecha segun se pulsa el submit de addComentario
			$date = getdate();
			$fecha= $date['year']."-".$date['mon']."-".$date['mday']." ".$date['hours'].":".$date['minutes'].":00";
			//Llamamos a la funcion que crea el comentario
			Usuario::addComentario($comentario,$fecha,$completado,$idTabla,$idUsuario);
			//Redireccionamos a la vista
			header("Location:../views/Deportista/consultarTabla.php?id=$idTabla");
		}else{
			ob_start();
			 if ($_SESSION['tipoUsuario']=="Administrador"){
					header("refresh: 3; url = ../views/Admin/principal.php");
				}
				else{
					header("refresh: 3; url = ../views/Entrenador/principal.php");
				}
			$errors = array();
			$errors["general"] = "No tiene permiso para añadir un Comentario";
			echo $errors["general"];
			ob_end_flush();
		}
	}

	/*OBTENEMOS TODOS LOS COMENTARIOS DE UN USUARIO EN UNA DETERMINA TABLA*/
	public static function getComentarios($idTablaEjercicios,$idUsuario){
		if(!isset($_SESSION)) session_start();
        $comentarioTablaUsuario = Usuario::getComentariosTabla($idTablaEjercicios,$idUsuario);
        return $comentarioTablaUsuario;
	}

	/* GET USUARIO*/
	public static function getUsuario($idUsuario){
	if(!isset($_SESSION)) session_start();
	$usuario = NULL;
	$usuario = Usuario::devolverDatos($idUsuario);
	if ($usuario == NULL){
		ob_start();
		header("refresh: 3; url = ../views/Admin/gestionUsuarios.php");
		$errors = array();
		$errors["general"] = "El Usuario no puede ser recuperado.";
		echo $errors["general"];
		ob_end_flush();
	}else{
		return $usuario;
	}
} // FIN GET USUARIO
	public static function login() {
		/*Comprobamos si nos pasan un Usuario por metodo POST*/
		if(!isset($_SESSION)) session_start();
	    if (isset($_POST["username"]) && isset($_POST["password"])){
	    	if($_POST["username"] && $_POST["password"]){
	    		$usuario = Usuario::obtenerDatos($_POST["username"], md5($_POST["password"]));
				//User no existe
				if ($usuario==NULL) {
					ob_start();
  					header("refresh: 3; url = ../index.php");
					$errors = array();
					$errors["general"] = "Nombre de Usuario no valido.";
					echo $errors["general"];
					ob_end_flush();
				}else{
					$_SESSION["idUsuario"] = $usuario->getIdUsuario();
					$_SESSION["tipoUsuario"] = $usuario->getTipoUsuario();
				// Si login correcto direcionamos a una vista
				if($usuario->getTipoUsuario() =="Administrador"){
					header("Location:../views/Admin/principal.php");
				}
				else{
					if($usuario->getTipoUsuario()=="Entrenador"){
						header("Location:../views/Entrenador/principal.php");
					}else{
						header("Location:../views/Deportista/principal.php");
					}
				}
			  }
	      	}else{
	      		$error = array();
				$error= "Nombre de Usuario no valido";
				print_r($error);
				header("refresh: 3; url = ../index.php");
				/*ob_start();
  				header("refresh: 5; url = index.php");
				$errors = array();
				$errors["general"] = "Nombre de Usuario no valido.";
				echo $errors["general"];
				ob_end_flush();  */
	      	}
	    }
	}
	public static function logout() {
		if(!isset($_SESSION)) session_start();
		session_unset();
		session_destroy();
		// redireccionamos
		header("Location:../index.php");
		die();
  	}
		/*MODIFICAR Usuario*/
	public static function modificarUsuario(){
	if(!isset($_SESSION)) session_start();
	if($_SESSION['tipoUsuario'] =="Administrador"){
		$idUsu = $_POST['idUsu'];
		$nomUsuario = $_POST['nomUsuario'];
		$password = $_POST['password'];
		$nombre = $_POST['nombre'];
		$apellidos = $_POST['apellidos'];
		$email = $_POST['email'];
		$tipoUsuario = $_POST['tipoUsuario'];
				//Comprobamos si los datosintroducidos son Correctos
			if(Usuario::registroValido($nomUsuario,$password,$email,$nombre,$apellidos)){
				if(!UsuarioMapper::usuarioValido($nomUsuario)){
				//Lamamos a la funcion que modifica al Usuario
				Usuario::update($idUsu,$nomUsuario,$password,$email,$tipoUsuario,$nombre,$apellidos);
				//Redireccionamos a vista
				header("Location: ../views/Admin/consultarUsuarios.php?id=$idUsu");
			    }else{
			    	ob_start();
					header("refresh: 3; url = ../views/Admin/modificarUsuario.php?id=$idUsu");
					$errors = array();
					$errors["general"] = "ERROR.El nombre de Usuario ya existe.";
					echo $errors["general"];
					ob_end_flush();
			    }
			}else{
				ob_start();
				header("refresh: 3; url = ../views/Admin/modificarUsuario.php?id=$idUsu");
				$errors = array();
				$errors["general"] = "ERROR.El formulario no fue bien completado.";
				echo $errors["general"];
				ob_end_flush();
					}
		}else{
			ob_start();
			 if ($_SESSION['tipoUsuario'] =="DeportistaPEF" || $_SESSION['tipoUsuario']=="DeportistaTDU") {
					header("refresh: 3; url = ../views/Deportista/principal.php");
				}
				else{
					header("refresh: 3; url = ../views/Entrenador/principal.php");
				}
			$errors = array();
			$errors["general"] = "No tiene permiso para modificar una Usuario";
			echo $errors["general"];
			ob_end_flush();
		}
	} //FIN MODIFICAR Usuario

	/* BORRAR Usuario*/
	public static function borrarUsuario(){
		if(!isset($_SESSION)) session_start();
			if($_SESSION['tipoUsuario'] =="Administrador"){
					$idUsuario = $_POST['idUsuario'];
					$nomUsuario = $_POST['nomUsuario'];
					$tipoUsuario = $_POST['tipoUsuario'];
					//Comprobamos si existe el usuario para poder borrarlo
					if(UsuarioMapper::existeUsuario($nomUsuario)){
						//Comprobamos que tipo de Usuario es para eliminar las relaciones de este
						if($tipoUsuario=="Entrenador"){
							//Si es entrenador hay que eliminar las siguientes relaciones
							//Llamamos a la funcion que elimina la relacion Entrenador-Actividad
							Usuario::deleteEntrenadorActividad($idUsuario);
							//Lamamos a la funcion que elimina el Usuario
							Usuario::delete($idUsuario);
						}
						if($tipoUsuario=="DeportistaTDU" || $tipoUsuario=="DeportistaPEF"){
							//Si es Deportista hay que eliminar las siguientes relaciones
							//Llamamos a la funcion que elimina la relacion Deportista-Comentario
							Usuario::deleteDeportistaComentario($idUsuario);
							//Llamamos a la funcion que elimina la relacion Deportista-Reserva
							Usuario::deleteDeportistaReserva($idUsuario);
							//Llamamos a la funcion que elimina la relacion Deportista-Tabla
							Usuario::deleteDeportistaTabla($idUsuario);
							//Lamamos a la funcion que elimina el Usuario
							Usuario::delete($idUsuario);
						}
						//Redireccionamos a vista
						header("Location: ../views/Admin/gestionUsuarios.php");
					}else{
						ob_start();
						header("refresh: 3; url = ../views/Admin/gestionUsuarios.php");
						$errors = array();
						$errors["general"] = "ERROR.El usuario no existe.";
						echo $errors["general"];
						ob_end_flush();
					}
			}else{
				ob_start();
				if ($_SESSION['tipoUsuario'] =="DeportistaPEF" || $_SESSION['tipoUsuario']=="DeportistaTDU") {
					header("refresh: 3; url = ../views/Deportista/principal.php");
				}
				else{
					header("refresh: 3; url = ../views/Entrenador/principal.php");
				}
				$errors = array();
				$errors["general"] = "No tiene permiso para modificar un usuario";
				echo $errors["general"];
				ob_end_flush();
			}
	}//FIN BORRAR USUARIO
  	public static function crearUsuario(){
  		if(!isset($_SESSION)) session_start();
  		if($_SESSION["tipoUsuario"] == 'Administrador'){
  			/*Si lo invoca un admin, cogemos las variables que nos pasa el submit por post*/
  			$nomUser = $_POST["nomUsuario"];
  			$pass = $_POST["password"];
  			$nombre = $_POST["nombre"];
  			$apellidos = $_POST["apellidos"];
  			$email = $_POST["email"];
  			$tipoUser = $_POST["tipoUsuario"];
  			$idUser = "NULL";
  			/*Comprobamos que el nombre de Usuario no existe para seguir con el registro*/
  			if(!UsuarioMapper::existeUsuario($nomUser)){
	  			/*Comprobamos si es valido el registro, para despues darlo de alta*/
	  			if(Usuario::registroValido($nomUser,$pass,$email,$nombre,$apellidos)){
	  				/*Si es valido lo Guardamos en la BD, Creamos un objerto Usuario para pasarlo almétodo*/
	  				$user = new Usuario();
	  				/*Meto un ID USUARIO NULL porque lo necesito parael constructor, despues no seutiliza para nada.*/
	  				$user->setIdUsuario($idUser);
	  				$user->setNomUsuario($nomUser);
	  				$user->setPassword($pass);
	  				$user->setEmail($email);
	  				$user->setTipoUsuario($tipoUser);
	  				$user->setNombre($nombre);
	  				$user->setApellidos($apellidos);
	  				$user->guardarUsuario($user);
	  				header("Location: ../views/Admin/gestionUsuarios.php");
	  			}else{
	  				/*Si no le decimos cual es el error*/
	  				ob_start();
	  				header("refresh: 5; url = ../views/Admin/crearUsuario.php");
					$errors = array();
					$errors["general"] = "El usuario no pudo ser creado.";
					echo $errors["general"];
					ob_end_flush();
	  			}
  		  	}else{
  		  			ob_start();
	  				header("refresh: 5; url = ../views/Admin/crearUsuario.php");
					$errors = array();
					$errors["general"] = "ERROR. El Nombre de Usuario ya existe.";
					echo $errors["general"];
					ob_end_flush();
  		  	}
  		}else{
  			ob_start();
  			if($_SESSION["tipoUsuario"]->getTipoUsuario() == 'DeportistaTDU' || $_SESSION["tipoUsuario"]->getTipoUsuario() == 'DeportistaPEF') {
	  				header("refresh: 3; url = ../views/Deportista/principal.php"); 
	  			}else{
	  				header("refresh: 3; url = ../views/Entrenador/principal.php"); 
	  			}
			$errors = array();
			$errors["general"] = "No tiene permiso para crear un Usuario";
			echo $errors["general"]; 
			ob_end_flush();
  		}
  	}
}
?>