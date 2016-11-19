<?php
include_once __DIR__."/../../model/model.php";
include_once __DIR__."/../../controller/defaultController.php";

if(!isset($_SESSION)) session_start();
 $user=$_SESSION["usuario"];
 if ($_SESSION["usuario"]->getTipoUsuario() =='Administrador'){

  $row = ActividadController::getAll();
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
            <?php
            if($row!=null){ 
              foreach ($row as $actividad) {
                //La fecha que nos devuleve la BD es de forma Año-Mes-Dia Hora:Min:Seg
                //Entonces hay cambiarla a Dia-Mes-Año Hora:Min y lo hacemos de 
                //La siguiente manera: $format especificamos la manera en la que viene
                //La fecha de la bd, createfromformat() crea un Objeto de tipo DateTime 
                //con elformato anterior y nuestra fecha de la bd.
                // $dateobj->format("d-m-Y H:i") Convierte la Fecha en el formato que queremos.
                // Este ultimo lo pondermos solo donde queremos mostrarlo que es en la tabla.
                $fecha = $actividad['fecha'];
                $format = "Y-m-d H:i:s";
                $dateobj = DateTime::createFromFormat($format, $fecha);

            ?>
            <tr>
              <td><?php echo $actividad['idActividad']; ?></td>
              <td><a href="consultarActividades.php?id=<?php echo $actividad['idActividad']; ?>" style="text-decoration: none;"><?php echo $actividad['nomActividad']; ?></a></td>
              <td><?php   echo $dateobj->format("d-m-Y H:i");?></td>
              <td><a href="modificarActividad.php?id=<?php echo $actividad['idActividad']; ?>" style="text-decoration: none;"><button type="button" class="btn btn-default3" id="botonModificar">Modificar Actividad</button></a></td>
                <td><a href="consultarActividades.php?id=<?php echo $actividad['idActividad']; ?>" style="text-decoration: none;"><button type="button" class="btn btn-default2" id="botonEliminar">Eliminar Actividad</button></a></td>
            </tr>
            <?php 
              }
            }
            ?>

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
    </div>
   <?php include("../footer.php");  /*Cargamos el footer*/ ?>

  </body>
</html>
<?php
  }else{
        ob_start(); 
         if (($_SESSION["usuario"]->getTipoUsuario()=='DeportistaPEF') || ($_SESSION["usuario"]->getTipoUsuario()=='DeportistaTDU')){
            header("refresh: 1; url = ../Deportista/principal.php");  
          }else{
             if($_SESSION["usuario"]->getTipoUsuario()=='Entrenador'){
                  header("Location: ../Entrenador/principal.php");  
             }else{
                header("Location: = /../index.php"); 
             }
          }
          
        ob_end_flush();  
  }
?>
