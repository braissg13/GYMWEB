<?php
require_once("../../controller/defaultController.php");

  if(!isset($_SESSION)) session_start();
    $idUsuario=$_SESSION['idUsuario'];
    $tipo=$_SESSION['tipoUsuario'];
  if (($tipo=='DeportistaPEF') || ($tipo=='DeportistaTDU')){
    $row = UsuarioController::getTablasDeportista($idUsuario);
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

     <h1>Tablas de Ejercicios</h1>
     <!-- Actividades creadas y botones para crear/borrar/modificar-->

     <div class="row" style="margin-top: 20px; margin-bottom: 10px;">




      <!-- COMIENZO DIV TABLA -->
      <div class="table-responsive col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <table class="table table-striped">

         <thead>

            <tr>
              <th>Nombre Tabla</th>
            </tr>

          </thead>

          <tbody>
            <?php
            if($row!=NULL){
              foreach ($row as $tablaejercicios) {
            ?>
            <tr>
              <td><a href="consultarTabla.php?id=<?php echo $tablaejercicios['idTablaEjercicios']; ?>" style="text-decoration: none;"><?php echo $tablaejercicios['nomTabla']; ?></a></td>


            </tr>
            <?php
                }
              }
            ?>

          </tbody>

        </table>


	      </div>

	  </div><!-- FIN ROW -->
  </div><!-- FIN CONTAINER -->
   <?php include("../footer.php");  /*Cargamos el footer*/ ?>

  </body>
</html>
<?php
  }else{
        ob_start(); 
         if (($_SESSION['tipoUsuario']=='Administrador')){
            header("Location: ../Admin/principal.php");  
          }else{
             if($_SESSION['tipoUsuario']=='Entrenador'){
                  header("Location: ../Entrenador/principal.php");  
             }else{
                header("Location: = /../index.php"); 
             }
          }
          
        ob_end_flush();  
  }
?>
