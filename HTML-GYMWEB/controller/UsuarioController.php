<?php
class UsuarioController{
	/*Obtenemos todos los Usuarios*/
	public static function getAll(){
		if(!isset($_SESSION)) session_start();
		$usuarios = new Usuario();
		return $usuarios->getAllUsuarios();
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
					$_SESSION["usuario"] = $usuario;
					header("Location: ../views/Admin/gestionEjercicios.php");
				// Si login correcto direcionamos a una vista
				/*if($this->Usuario->getTipoUsuario()=="Administrador"){
					header("Location:../views/Admin/principal.php'");
				}
				else{
					if($this->Usuario->getTipoUsuario()=="Entrenador"){
						header("Location:../views/Entrenador/principal.php'");
					}else{
						header("Location:../views/Deportista/principal.php'");
					}
				}*/
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
	if($_SESSION['usuario']->getTipoUsuario()=="Administrador"){
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
			 if ($_SESSION['usuario']->getTipoUsuario()=="DeportistaPEF" || $_SESSION['usuario']->getTipoUsuario()=="DeportistaTDU") {
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
  	public static function crearUsuario(){
  		if(!isset($_SESSION)) session_start();
  		if($_SESSION["usuario"]->getTipoUsuario() == 'Administrador'){
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
  		}
  	}
}
?>