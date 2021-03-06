<?php
require_once("../../controller/defaultController.php");

if(!isset($_SESSION)) session_start();
 $idUsuario=$_SESSION['idUsuario'];
 if ($_SESSION['tipoUsuario'] =='Entrenador'){

  $row = TablaController::getAll();
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
    <link href="../../css/gestionTablas.css" rel="stylesheet">
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

    <div class="row" style="margin-top: 20px; margin-bottom: 10px;">


      <div class="btn-group col-xs-6 col-sm-4 col-md-4 col-lg-2" role="group" style="margin-bottom: 10px;">
       <a href="crearTablas.php" style="text-decoration: none;"><button type="button" class="btn btn-default1" id="botonCrear">Crear Tabla</button></a>
      </div>

      <!-- COMIENZO DIV TABLA -->
      <div class="table-responsive col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <table class="table table-striped">
         
         <thead>

            <tr>
              <th>Nombre Tabla</th>
              <th>Tipo Tabla</th>
            </tr>

          </thead>

          <tbody>
            <?php 
            if ($row!=null) {
              foreach ($row as $tabla) {
             ?>
            <tr>
              <td><a href="consultarTabla.php?id=<?php echo $tabla['idTablaEjercicios']; ?>" style="text-decoration: none;"><?php echo $tabla['nomTabla']; ?></a></td>
              <td><?php echo $tabla['tipoTabla']; ?></td>
              <td><a href="modificarTabla.php?id=<?php echo $tabla['idTablaEjercicios']; ?>" style="text-decoration: none;"><button type="button" class="btn btn-default3" id="botonModificar">Modificar Tabla</button></a></td>
               <?php if ($tabla['tipoTabla'] == "TablaGeneral" ) {
                
              ?>
              <td><a href="asignarTabla.php?id=<?php echo $tabla['idTablaEjercicios']; ?>" style="text-decoration: none;"><button type="button" class="btn btn-default4" id="botonAsignar">Asignar Deportista</button></a></td>
              <?php 
                }
              ?>
              <?php if ($tabla['tipoTabla'] == "TablaPEF" ) {
                
              ?>
              <td><a href="asignarTablaPEF.php?id=<?php echo $tabla['idTablaEjercicios']; ?>" style="text-decoration: none;"><button type="button" class="btn btn-default4" id="botonAsignar">Asignar DeportistaPEF</button></a></td>
              <?php 
                }
              ?>  
              <td><a href="consultarTabla.php?id=<?php echo $tabla['idTablaEjercicios']; ?>" style="text-decoration: none;"><button type="button" class="btn btn-default2" id="botonEliminar">Eliminar Tabla</button></a></td>
            </tr>
            <?php
              }
            }
            ?>

          </tbody>

        </table>
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