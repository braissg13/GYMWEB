<?php

//Incluimos todos los controladores
	include_once("UsuarioController.php");
	include_once("EjercicioController.php");
	include_once("ActividadController.php");
	include_once("TablaController.php");
	include_once("ReservaController.php");
	include_once("BuscarController.php");
//Llamamos alcontrolador y su accion
	if(isset($_GET["controlador"]) && isset($_GET["accion"])){
		$targetController = ucfirst($_GET["controlador"])."Controller";
		$action = $_GET["accion"];

		//Inicializamos la funcion del controlador
		$targetController::$action();
	}
	?>
