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
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
     <link href="../../css/gestionActividades.css" rel="stylesheet">
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

     <h1>Actividades</h1>
     <!-- Actividades creadas y botones para crear/borrar/modificar-->

     <div class="row" style="margin-top: 20px; margin-bottom: 10px;">


      <div class="btn-group col-xs-6 col-sm-4 col-md-4 col-lg-2" role="group" style="margin-bottom: 10px;">
       <a href="crearActividad.php" style="text-decoration: none;"><button type="button" class="btn btn-default1" id="botonCrear">Crear Actividad</button></a>
      </div>

      <!-- COMIENZO DIV TABLA -->
      <div class="table-responsive col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <table class="table table-striped">
         
         <thead>

            <tr>
              <th>#</th>
              <th>Nombre Actividad</th>
              <th >Fecha</th>
            </tr>

          </thead>

          <tbody>
            
            <tr>
              <td>1</td>
              <td><a href="consultarActividades.php" style="text-decoration: none;">Zumba</a></td>
              <td>15/11/2016 18:00</td>
              <td><a href="consultarActividades.php" style="text-decoration: none;"><button type="button" class="btn btn-default2" id="botonEliminar">Eliminar Actividad</button></a></td>
              <td><a href="modificarActividad.php" style="text-decoration: none;"><button type="button" class="btn btn-default3" id="botonModificar">Modificar Actividad</button></a></td>
            </tr>

            <tr>
              <td>2</td>
              <td><a href="#" style="text-decoration: none;">Aerobic</a></td>
              <td>15/11/2016 20:00</td>
              <td><a href="#" style="text-decoration: none;"><button type="button" class="btn btn-default2" id="botonEliminar">Eliminar Actividad</button></a></td>
              <td><a href="#" style="text-decoration: none;"><button type="button" class="btn btn-default3" id="botonModificar">Modificar Actividad</button></a></td>
            </tr>

            <tr>
              <td>3</td>
              <td><a href="#" style="text-decoration: none;">Spinning</a></td>
              <td>17/11/2016 18:00</td>
              <td><a href="#" style="text-decoration: none;"><button type="button" class="btn btn-default2" id="botonEliminar">Eliminar Actividad</button></a></td>
              <td><a href="#" style="text-decoration: none;"><button type="button" class="btn btn-default3" id="botonModificar">Modificar Actividad</button></a></td>
            </tr>

          </tbody>

        </table>

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

	  </div><!-- FIN ROW -->
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
