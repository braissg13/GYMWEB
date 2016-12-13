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
	/*Obtenemos todos las Actividades que reservo un deportista*/
	public static function getActividadesDeportista($idUsuario){
		if(!isset($_SESSION)) session_start();
				 $actividad = Usuario::getActividadesReservadas($idUsuario);
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
			$error = "No tiene permiso para añadir un Comentario";
			header("Location: ../views/error.php?error=$error");
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
		$error = "El Usuario no puede ser recuperado.";
		header("Location: ../views/error.php?error=$error");
	}else{
		return $usuario;
	}
} // FIN GET USUARIO
	public static function login() {
		/*Comprobamos si nos pasan un Usuario por metodo POST*/
		if(!isset($_SESSION)) session_start();
	    if (isset($_POST["username"]) && isset($_POST["password"])){
	    		$usuario = Usuario::obtenerDatos($_POST["username"], md5($_POST["password"]));
				//User no existe
				if ($usuario==NULL) {
					$_SESSION["idUsuario"] = null;
					$_SESSION["tipoUsuario"] = null;
					$error = "Nombre de Usuario y/o Password no validos.";
					header("Location: ../views/error.php?error=$error");
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
	    		$_SESSION["idUsuario"] = null;
				$_SESSION["tipoUsuario"] = null;
				$error= "Nombre de Usuario y/o Password no validos";
				header("Location: ../views/error.php?error=$error");
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
		//Utilizamos el usuario sin modificar por si no nos pasan unos argumentos, asignarle los que ya tenía
        $usuarioSinModificar = Usuario::devolverDatos($idUsu);
        //Si no pasan nombreUsuario, cogemos el nombre que ya tenia
        if ($_POST['nomUsuario']!= null) {
          $nomUsuario = $_POST['nomUsuario'];
        }else{
            $nomUsuario = $usuarioSinModificar->getNomUsuario();
        }
        //Si no pasan nombre, cogemos el nombre que ya tenia
        if ($_POST['nombre']!= null) {
          $nombre = $_POST['nombre'];
        }else{
          $nombre = $usuarioSinModificar->getNombre();
        }
        //Si no pasan apellidos, cogemos los apellidos que ya tenia
        if ($_POST['apellidos']!= null) {
          $apellidos = $_POST['apellidos'];
        }else{
          $apellidos = $usuarioSinModificar->getApellidos();
        }
        //Si no pasan email, cogemos el email que ya tenia
        if ($_POST['email']!= null) {
          $email = $_POST['email'];
        }else{
          $email = $usuarioSinModificar->getEmail();
        }
        //Si no pasan tipoUsuario, cogemos el tipoUsuario que ya tenia
        if ($_POST['tipoUsuario']!= null) {
          $tipoUsuario = $_POST['tipoUsuario'];
        }else{
            $tipoUsuario = $usuarioSinModificar->getTipoUsuario();
        }
        //Si no pasan contraseña hacemos un update sin hacerle el md5. En caso contrario tambien modificaremos la contraseña
        if ($_POST['password'] == null) {
				//Lamamos a la funcion que modifica al Usuario
				Usuario::updateSinPass($idUsu,$nomUsuario,$email,$tipoUsuario,$nombre,$apellidos);
				//Redireccionamos a vista
				header("Location: ../views/Admin/consultarUsuarios.php?id=$idUsu");
        }else{
          $password = $_POST['password'];
			//Comprobamos si los datosintroducidos son Correctos
			if(Usuario::registroValido($nomUsuario,$password,$email,$nombre,$apellidos)){
				//Lamamos a la funcion que modifica al Usuario
				Usuario::update($idUsu,$nomUsuario,$password,$email,$tipoUsuario,$nombre,$apellidos);
				//Redireccionamos a vista
				header("Location: ../views/Admin/consultarUsuarios.php?id=$idUsu");
			}else{
				$error = "ERROR.El formulario no fue bien completado.";
				header("Location: ../views/error.php?error=$error");
			}
		  }
		}else{
			$error = "No tiene permiso para modificar una Usuario";
			header("Location: ../views/error.php?error=$error");
		}
	} //FIN MODIFICAR Usuario

	/*MODIFICAR PERFIL*/
	public static function modificarPerfil(){
	if(!isset($_SESSION)) session_start();
		$idUsu = $_POST['idUsu'];
		print_r($_FILES['imagen']);
		//Utilizamos el usuario sin modificar por si no nos pasan unos argumentos, asignarle los que ya tenía
        $usuarioSinModificar = Usuario::devolverDatos($idUsu);
        //Si no pasan nombreUsuario, cogemos el nombre que ya tenia
        if ($_POST['nomUsuario']!= null) {
          $nomUsuario = $_POST['nomUsuario'];
        }else{
            $nomUsuario = $usuarioSinModificar->getNomUsuario();
        }
        //Si no pasan nombre, cogemos el nombre que ya tenia
        if ($_POST['nombre']!= null) {
          $nombre = $_POST['nombre'];
        }else{
          $nombre = $usuarioSinModificar->getNombre();
        }
        //Si no pasan apellidos, cogemos los apellidos que ya tenia
        if ($_POST['apellidos']!= null) {
          $apellidos = $_POST['apellidos'];
        }else{
          $apellidos = $usuarioSinModificar->getApellidos();
        }
        //Si no pasan email, cogemos el email que ya tenia
        if ($_POST['email']!= null) {
          $email = $_POST['email'];
        }else{
          $email = $usuarioSinModificar->getEmail();
        }
        //Si no pasan tipoUsuario, cogemos el tipoUsuario que ya tenia
        if ($_POST['tipoUsuario']!= null) {
          $tipoUsuario = $_POST['tipoUsuario'];
        }else{
            $tipoUsuario = $usuarioSinModificar->getTipoUsuario();
        }
        //Si no pasan imagen, cogemos la imagen que ya tenia
        if ($_FILES['imagen']['name'] != null) {
          if($_FILES['imagen']['type']=="image/jpeg" || $_FILES['imagen']['type']=="image/png" || $_FILES['imagen']['type']=="image/jpg"){
          	//Creamos ruta donde guardamos la imagen yle damos nombre
			$ruta = "../img/usuarios";
			$nombreArchivo = $_FILES['imagen']['name'];
			move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta."/".$nombreArchivo);
		  }else{
			$error = "ERROR. Formato de imagen no válido.";
			header("Location: ../error.php?error=$error");
			//echo $errors["general"];
		  }
        }else{
            $nombreArchivo = $usuarioSinModificar->getImagenPerfil();
        }
        //Si no pasan contraseña hacemos un update sin hacerle el md5. En caso contrario tambien modificaremos la contraseña
        if ($_POST['password'] == null) {
				//Lamamos a la funcion que modifica al Usuario
				Usuario::updatePerfilSinPass($idUsu,$nomUsuario,$email,$tipoUsuario,$nombre,$apellidos,$nombreArchivo);
				//Redireccionamos a vista
				if ($_SESSION['tipoUsuario'] =="Administrador"){
					header("Location: ../views/Admin/verPerfil.php");
				}
				if ($_SESSION['tipoUsuario'] =="Entrenador"){
					header("Location: ../views/Entrenador/verPerfil.php");
				}
				if ($_SESSION['tipoUsuario'] =="DeportistaTDU" || $_SESSION['tipoUsuario'] =="DeportistaPEF"){
					header("Location: ../views/Deportista/verPerfil.php");
				}
        }else{
          		$password = $_POST['password'];
				//Lamamos a la funcion que modifica al Usuario
				Usuario::updatePerfil($idUsu,$nomUsuario,$password,$email,$tipoUsuario,$nombre,$apellidos,$nombreArchivo);
				//Redireccionamos a vista
				if ($_SESSION['tipoUsuario'] =="Administrador"){
					header("Location: ../views/Admin/verPerfil.php");
				}
				if ($_SESSION['tipoUsuario'] =="Entrenador"){
					header("Location: ../views/Entrenador/verPerfil.php");
				}
				if ($_SESSION['tipoUsuario'] =="DeportistaTDU" || $_SESSION['tipoUsuario'] =="DeportistaPEF"){
					header("Location: ../views/Deportista/verPerfil.php");
				}
		  }
	} //FIN MODIFICAR PERFIL

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
						$error= "ERROR.El usuario no existe.";
						header("Location: ../views/error.php?error=$error");
					}
			}else{
				$error = "No tiene permiso para modificar un usuario";
				header("Location: ../views/error.php?error=$error");
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
  			$imagen= null;

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
	  				$user->setImagenPerfil($imagen);
	  				$user->guardarUsuario($user);
	  				header("Location: ../views/Admin/gestionUsuarios.php");
	  			}else{
	  				/*Si no le decimos cual es el error*/
					$error = "El usuario no pudo ser creado.";
					header("Location: ../views/error.php?error=$error");
	  			}
  		  	}else{
					$error = "ERROR. El Nombre de Usuario ya existe.";
					header("Location: ../views/error.php?error=$error");
  		  	}
  		}else{
			$error = "No tiene permiso para crear un Usuario";
			header("Location: ../views/error.php?error=$error");
  		}
  	}
}
?>
