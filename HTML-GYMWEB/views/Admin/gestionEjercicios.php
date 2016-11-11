<?php
include_once "/../../model/model.php";
include_once "/../../controller/defaultController.php";

if(!isset($_SESSION)) session_start();
 $user=$_SESSION["usuario"];
 if ($_SESSION["usuario"]->getTipoUsuario() =='Administrador'){
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>GYMWEB</title>

    <!-- Bootstrap -->
    <link href="../../css/navbar.css" rel="stylesheet">
    <link href="../../css/gestionEjercicios.css" rel="stylesheet">
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../../js/bootstrap.min.js"></script>

  </head>
  <body>
  <header>
  	<?php include("../navbar.php");  /*Cargamos la barra de navegación*/ ?>
  </header>

  	<div class="container">
		 
		 <h1>Ejercicios</h1>
		 <!-- BOTON MOSTRAR EJERCICIOS CREAR EJERCICIOS ELIMINAR EJERCICIOS-->
		 <div class="row" style="margin-top: 20px; margin-bottom: 10px;">
		 	<div class="btn-group col-xs-6 col-sm-3 col-md-3 col-lg-3" role="group" style="margin-top: 10px;">
    		<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      			<span class="glyphicon glyphicon-list" aria-hidden="true";></span>
    		</button>
    		<ul class="dropdown-menu">
    			<li class="dropdown-header">Mostrar Ejercicios de:</li>
      			<li><a href="gestionEjercicios.php">Todos</a></li>
            <li><a href="gestionEjercicios.php">Brazos</a></li>
      			<li><a href="gestionEjercicios.php">Espalda</a></li>
      			<li><a href="gestionEjercicios.php">Pecho</a></li>
      			<li><a href="gestionEjercicios.php">Piernas</a></li>
    		</ul>
  		 </div>

  		 <div class="btn-group col-xs-6 col-sm-3 col-md-3 col-lg-3" role="group" style="margin-top: 10px;">
    		<a href="crearEjercicios.php" style="text-decoration: none;"><button type="button" class="btn btn-default1" id="botonCrear">Crear Ejercicio</button></a>
    	 </div>

    	 <div class="btn-group col-xs-6 col-sm-3 col-md-3 col-lg-3" role="group" style="margin-top: 10px;">
    		<a href="gestionEjercicios.php" style="text-decoration: none;"><button type="button" class="btn btn-default2" id="botonEliminar">Eliminar Ejercicio</button></a>
    	 </div>

    	 <div class="btn-group col-xs-6 col-sm-3 col-md-3 col-lg-3" role="group" style="margin-top: 10px;">
    		<a href="gestionEjercicios.php" style="text-decoration: none;"><button type="button" class="btn btn-default3" id="botonModificar">Modificar Ejercicio</button></a>
    	 </div>

  		 </div><!-- FIN BOTONES -->

  		 <!-- DIV CONTENEDOR DE LOS EJERCICIOS -->
		 <div id="container-ejercicios" style="background:#0275d8; border: solid;border-radius:5px; border-color: black;">

			<div class="row" style="margin-top: 20px;">
  				<div class="col-xs-6 col-sm-4 col-md-4 col-lg-4"><a href="consultarEjercicios.php"><img alt="AperMancuernas" src="../../img/ejercicios/aperturas-mancuernas.png" style="max-width: 100%;"></a></div>
  				<div class="col-xs-6 col-sm-4 col-md-4 col-lg-4"><a href="#"><img alt="BicepsCruz" src="../../img/ejercicios/biceps-brazos-cruz.png" style="max-width: 100%;"></a></div>
  				<div class="col-xs-6 col-sm-4 col-md-4 col-lg-4"><a href="#"><img alt="CurlConcentrado" src="../../img/ejercicios/curl-concentrado.png" style="max-width: 100%;"></a></div>
			</div>
		 		
			<div class="row" style="margin-top: 20px;">
  				<div class="col-xs-6 col-sm-4 col-md-4 col-lg-4"><a href="#"><img alt="Dippings" src="../../img/ejercicios/dippings.png" style="max-width: 100%;"></a></div>
  				<div class="col-xs-6 col-sm-4 col-md-4 col-lg-4"><a href="#"><img alt="DipsBarra" src="../../img/ejercicios/dips-barra.png" style="max-width: 100%;"></a></div>
  				<div class="col-xs-6 col-sm-4 col-md-4 col-lg-4"><a href="#"><img alt="Dominadas" src="../../img/ejercicios/dominadas.png" style="max-width: 100%;"></a></div>
			</div>

			<div class="row" style="margin-top: 20px;">
  				<div class="col-xs-6 col-sm-4 col-md-4 col-lg-4"><a href="#"><img alt="Flexiones" src="../../img/ejercicios/flexiones.png" style="max-width: 100%;"></a></div>
  				<div class="col-xs-6 col-sm-4 col-md-4 col-lg-4"><a href="#"><img alt="Martillo" src="../../img/ejercicios/martillo.png" style="max-width: 100%;"></a></div>
  				<div class="col-xs-6 col-sm-4 col-md-4 col-lg-4"><a href="#"><img alt="PredicadorBarra" src="../../img/ejercicios/predicador-con-barra.png" style="max-width: 100%;"></a></div>
			</div>
			<!--  PAGINACION NO VISIBLE XS -->
			<div id= "paginacion">
				<ul class="pagination">
				  <li><a href="#">«</a></li>
				  <li><a href="#">1</a></li>
				  <li><a href="#">2</a></li>
				  <li><a href="#">3</a></li>
				  <li><a href="#">»</a></li>
				</ul>
			</div>

		 </div>

	</div>
   
   <?php include("../footer.php");  /*Cargamos el footer*/ ?>

  </body>
</html>

<?php
  }else{
        ob_start(); 
         if (($_SESSION["usuario"]->getTipoUsuario()=='DeportistaPEF') || ($_SESSION["usuario"]->getTipoUsuario()=='DeportistaTDU')){
            header("refresh: 1; url = ../Deportista/plantilla-por-defecto.php");  
          }else{
             if($_SESSION["usuario"]->getTipoUsuario()=='Entrenador'){
                  header("Location: ../Entrenador/gestionEjercicios.php");  
             }else{
                header("Location: = /../index.php"); 
             }
          }
          
        ob_end_flush();  
  }
?>