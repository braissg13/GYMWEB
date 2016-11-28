<?php
require_once("../../controller/defaultController.php");

if(!isset($_SESSION)) session_start();
 $idUsuario=$_SESSION['idUsuario'];
 if ($_SESSION['tipoUsuario'] =='Entrenador'){

  $row = EjercicioController::getAll();

  $filtro = $_GET['filtrado'];
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
            <li><a href="gestionEjerciciosFiltrado.php?filtrado=Brazos">Brazos</a></li>
      			<li><a href="gestionEjerciciosFiltrado.php?filtrado=Espalda">Espalda</a></li>
      			<li><a href="gestionEjerciciosFiltrado.php?filtrado=Pecho">Pecho</a></li>
      			<li><a href="gestionEjerciciosFiltrado.php?filtrado=Piernas">Piernas</a></li>
    		</ul>
  		 </div>

  		 <div class="btn-group col-xs-6 col-sm-3 col-md-3 col-lg-3" role="group" style="margin-top: 10px;">
    		<a href="crearEjercicios.php" style="text-decoration: none;"><button type="button" class="btn btn-default1" id="botonCrear">Crear Ejercicio</button></a>
    	 </div>

    	 <div class="btn-group col-xs-6 col-sm-3 col-md-3 col-lg-3" role="group" style="margin-top: 10px;">
    		<?php echo "<a href=\"gestionEjerciciosFiltrado.php?filtrado=$filtro\" style=\"text-decoration: none;\"><button type=\"button\" class=\"btn btn-default2\" id=\"botonEliminar\">Eliminar Ejercicio</button></a>"; ?>
    	 </div>

    	 <div class="btn-group col-xs-6 col-sm-3 col-md-3 col-lg-3" role="group" style="margin-top: 10px;">
    		<?php echo "<a href=\"gestionEjerciciosFiltrado.php?filtrado=$filtro\" style=\"text-decoration: none;\"><button type=\"button\" class=\"btn btn-default3\" id=\"botonModificar\">Modificar Ejercicio</button></a>";?>
    	 </div>

  		 </div><!-- FIN BOTONES -->

  		 <!-- DIV CONTENEDOR DE LOS EJERCICIOS -->
		 <div id="container-ejercicios" style="background:#0275d8; border: solid;border-radius:5px; border-color: black;">

			<div class="row" style="margin-top: 20px;">
          <?php 
          if($row!=null){
           foreach ($row as $ejercicio) {
              if ($filtro == $ejercicio['tipoEjerc']) {
          ?>
  				<div class="col-xs-6 col-sm-4 col-md-4 col-lg-4"><a href="consultarEjercicios.php?id=<?php echo $ejercicio['idEjercicio']; ?>"><?php echo "<img alt=\"Imagen\" src=\""."../../img/ejercicios/".$ejercicio['imagen']."\" style=\"max-width: 100%;\">";?></a></div>
          <?php
              }
            }
          }
          ?>

			</div>

		 </div>

	</div>
   
   <?php include("../footer.php");  /*Cargamos el footer*/ ?>

  </body>
</html>

<?php
  }else{
        ob_start(); 
         if (($_SESSION['tipoUsuario']=='DeportistaPEF') || ($_SESSION['tipoUsuario']=='DeportistaTDU')){
            header("refresh: 1; url = ../Deportista/principal.php");  
          }else{
             if($_SESSION['tipoUsuario']=='Administrador'){
                  header("Location: ../Admin/principal.php");  
             }else{
                header("Location: = /../index.php"); 
             }
          }
          
        ob_end_flush();  
  }
?>
