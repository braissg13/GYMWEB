<?php
require_once("../../controller/defaultController.php");

if(!isset($_SESSION)) session_start();
 $idUsuario=$_SESSION['idUsuario'];
 if ($_SESSION['tipoUsuario'] =='Entrenador'){

    $idTabla = $_GET['id'];

    $tabla = TablaController::getTabla($idTabla);
    $row = TablaController::getEjercicios($idTabla);
    $row2 = EjercicioController::getAll();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>GYMWEB</title>

    <!-- Bootstrap -->
    <link href="../../css/navbar.css" rel="stylesheet">
    <link href="../../css/modificarTabla.css" rel="stylesheet">
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
		 
		 <h1>Tabla: <?php echo $tabla->getNomTabla();?></h1>

  		 <!-- DIV MUESTRA Tabla -->
		 <div id="container-ejercicios">

			<div class="row row1">
        <?php 
        if($row!=null){
          foreach ($row as $ejercicio) {
        ?>
  				<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3" style="border-style: solid;border-color: black;margin-bottom: 20px; margin-right: 10px;"><img alt="imgEjer" src="../../img/ejercicios/<?php echo $ejercicio['imagen']; ?>" style="max-width: 100%;max-height: 100%;">
            <p><b>Peso (Kg): <?php echo $ejercicio['carga']; ?></b></p>
            <p><b>Repeticiones: <?php echo $ejercicio['repeticiones']; ?></b></p>
          </div>
        <?php 
          }
        }
        ?>
  		</div><!-- FIN ROW -->

     </div> <!-- FIN CONTAINER TABLA -->	

    <div id="container-formulario">
      <h1>Modificar: </h1>

             <!-- DIV FORMULARIO -->
         <div id="container-ejercicios" style="background:#0275d8; border: solid;border-radius:5px; border-color: black;">
            <form action="../../controller/defaultController.php?controlador=tabla&accion=modificarTabla" method="POST" style="margin:10px;">
            <!-- COMIENZO ROW-->  
            <div class="row" style="margin-bottom: 10px;">  
              <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" style="visibility: hidden; margin-bottom: 10px;"></div>
              <!-- DIV NOMBRE EJER -->
              <div class="form-group col-xs-12 col-sm-4 col-md-4 col-lg-4">
                  <label for="nomTabla">Nombre Tabla: </label>
                  <input type="text" class="form-control" name="NomTabla" maxlength="30" placeholder="Nombre Tabla" required="">
              </div>

              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="visibility: hidden; margin-bottom: 10px;"></div>

              <!-- DIV SELECT EJERCICIO-->
              <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <label for="idEjers">Selecciona los Ejercicios deseados: </label>
                  <?php 
                  if($row2!=null){
                     foreach ($row2 as $ejercicio2){
                  echo "<div class=\"radio col-xs-12 col-sm-4 col-md-4 col-lg-4\" style=\"margin-top:30px;\">";
                    echo "<img alt=\"Imagen\" src=\""."../../img/ejercicios/".$ejercicio2['imagen']."\" style=\"max-width: 100%;\">";
                  ?>
                    <p style="text-align: center; margin-bottom: 40px;"><input type="checkbox" name="ejerSeleccionado[]"  value="<?php echo $ejercicio2['idEjercicio'];?>" aria-label="true"></p>
                  <?php   echo "</div>";
                   }
                  } 
                ?>
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

                
              </div> <!-- FIN ROW -->
              <input type="hidden" name="idTabla" value="<?php echo $tabla->getIdTabla(); ?>">
              <input type="hidden" name="TipoTabla" value="<?php echo $tabla->getTipoTabla(); ?>">
              <p style="text-align:center">
              <button type="submit" class="btn btn-default1" style="margin-right: 10px;">
                <span class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></span>
              </button>

              <a href="gestionTablas.php"><button type="button" class="btn btn-default2">Atr&aacutes</button></a></p>
            </form>
         </div> <!-- FIN FORMULARIO EJERCICIOS -->

	   </div><!-- FIN CONTAINER -->
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