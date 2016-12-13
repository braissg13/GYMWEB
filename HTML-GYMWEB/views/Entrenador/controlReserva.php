<?php
require_once("../../controller/defaultController.php");

if(!isset($_SESSION)) session_start();
 $idUsuario=$_SESSION['idUsuario'];
 if ($_SESSION['tipoUsuario'] =='Entrenador'){
  $idActividad = $_GET['id'];
  $row = ActividadController::getUsuariosEntrenador($idActividad);
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
     <link href="../../css/controlReserva.css" rel="stylesheet">
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

      <h1>Usuarios</h1>


      <div class="row" style="margin-top: 20px; margin-bottom: 10px;">


        <!-- COMIENZO DIV TABLA -->
        <div class="table-responsive col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <table class="table table-striped">

           <thead>

              <tr>
                <th>Nombre Usuario</th>
                <th >Apellidos</th>
              </tr>

            </thead>

            <tbody>
              <?php
              if ($row!=NULL) {
                foreach ($row as $usuario) {
                  ?>
              <tr>
                <td><?php echo $usuario['nombre']; ?></td>
                <td><?php echo $usuario['apellidos']; ?></td>

              </tr>
              
              <?php
                }
              }
              ?>

            </tbody>

          </table>

        </div>

        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            <a href="consultarActividades.php?id=<?php echo $idActividad;?>"><button type="button" class="btn btn-default">Atr&aacutes</button></a>
        </div>

    </div><!-- FIN ROW -->



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