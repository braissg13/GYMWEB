<?php

//Incluimos todos los controladores
	include_once __DIR__."/UsuarioController.php";
	include_once __DIR__."/EjercicioController.php";
	include_once __DIR__."/ActividadController.php";
//Incluir todos los modelos de nuestro sistema
	include_once __DIR__."/../model/model.php";
//Llamamos alcontrolador y su accion
	if(isset($_GET["controlador"]) && isset($_GET["accion"])){
		$targetController = ucfirst($_GET["controlador"])."Controller";
		$action = $_GET["accion"];

		//Inicializamos la funcion del controlador
		$targetController::$action();
	}
	?>
