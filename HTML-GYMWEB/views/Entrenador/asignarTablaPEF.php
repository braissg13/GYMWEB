<?php
	include_once __DIR__."/../../model/model.php";
  include_once __DIR__."/../../controller/defaultController.php";

if(!isset($_SESSION)) session_start();
 $user=$_SESSION["usuario"];
 if ($_SESSION["usuario"]->getTipoUsuario() =='Entrenador'){
  $idTabla = $_GET['id'];
  $row = TablaController::getDeportistasAsignados($idTabla);
  $row2 = UsuarioController::getAllDeportistasPEF();
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
    <link href="../../css/asignarTabla.css" rel="stylesheet">
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
		 
    <div class="row" style="margin-top: 20px; margin-bottom: 10px;">

        <!-- COMIENZO DIV TABLA -->
        <div class="table-responsive col-xs-12 col-sm-12 col-md-12 col-lg-12">
         <h3>Deportistas Asignados</h3>
          <table class="table table-striped">
           
           <thead>

              <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Apellidos</th>
              </tr>

            </thead>

            <tbody>
              <?php 
              if($row!=null){
                foreach ($row as $usuario) {
               ?>
              <tr>
                <td><?php echo $usuario['idUsuario']; ?></td>
                <td><?php echo $usuario['nombre']; ?></td>
                <td><?php echo $usuario['apellidos']; ?></td>
                
              </tr>
              <?php
                }
              }
              ?>

            </tbody>

          </table>
      </div><!-- FIN TABLE -->

      <!-- DIV FORMULARIO -->
      <div id="container-formulario" class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
        <form action="../../controller/defaultController.php?controlador=tabla&accion=asignarDeportistaPEF" method="POST" style="margin:10px;">
          <!-- DIV TIPO EJER -->
          <h3>Asignar Deportistas</h3>
          <div class="form-group">
                  <select class="form-control" name="idUsuario">
                  <?php
                  if($row2!=null){
                    foreach ($row2 as $usuario2) {

                  ?>
                    <option value="<?php echo $usuario2['idUsuario'];?>"><?php echo $usuario2['nombre'];?>, <?php echo $usuario2['apellidos'];?></option>
                  <?php
                    }
                  }
                  ?>
                  </select>
          </div> 
          <input type="hidden" name="idTabla" value="<?php echo $idTabla;?>">
          <p style="text-align:center">
          <button type="submit" class="btn btn-default1" style="margin-right: 10px;">
            <span class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></span>
          </button>
        </form>
      </div> <!-- FIN FORMULARIO ASIGNAR -->

      <!-- DIV FORMULARIO 2 -->
      <div id="container-formulario" class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
        <form action="../../controller/defaultController.php?controlador=tabla&accion=deleteAsignarDeportistaPEF" method="POST" style="margin:10px;">
          <!-- DIV TIPO EJER -->
          <h3>Eliminar Deportista Asignado</h3>
          <div class="form-group">
                  <select class="form-control" name="idUsuario">
                  <?php
                  if($row!=null){
                    foreach ($row as $usuario3) {

                  ?>
                    <option value="<?php echo $usuario3['idUsuario'];?>"><?php echo $usuario3['nombre'];?>, <?php echo $usuario3['apellidos'];?></option>
                  <?php
                    }
                  }
                  ?>
                  </select>
          </div> 
          <input type="hidden" name="idTabla" value="<?php echo $idTabla;?>">
          <p style="text-align:center">
          <button type="submit" class="btn btn-default2" style="margin-right: 10px;">
            <span class="glyphicon glyphicon-floppy-remove" aria-hidden="true"></span>
          </button>
        </form>
      </div> <!-- FIN FORMULARIO ELIMINAR ASIGNAR -->

      <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" style="visibility: hidden;"></div>
      <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
        <a href="gestionTablas.php"><button type="button" class="btn btn-default3">Atr&aacutes</button></a>
      </div>

    </div><!-- FIN ROW -->


	</div><!-- FIN CONTAINER -->




    <?php include("../footer.php");  /*Cargamos el footer*/ ?>

  </body>
</html>

<?php
  }else{
        ob_start(); 
         if (($_SESSION["usuario"]->getTipoUsuario()=='DeportistaPEF') || ($_SESSION["usuario"]->getTipoUsuario()=='DeportistaTDU')){
            header("refresh: 1; url = ../Deportista/principal.php");  
          }else{
             if($_SESSION["usuario"]->getTipoUsuario()=='Administrador'){
                  header("Location: ../Admin/principal.php");  
             }else{
                header("Location: = /../index.php"); 
             }
          }
          
        ob_end_flush();  
  }
?>
