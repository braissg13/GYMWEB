<?php
include_once __DIR__."/../../model/model.php";
include_once __DIR__."/../../controller/defaultController.php";

if(!isset($_SESSION)) session_start();
 $user=$_SESSION["usuario"];
 if ($_SESSION["usuario"]->getTipoUsuario() =='Entrenador'){

 	 $row = EjercicioController::getAll();
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
    <link href="../../css/crearTablas.css" rel="stylesheet">
    
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
		 
		 <h1>Crear Tabla de Ejercicios: </h1>

  		 <!-- DIV FORMULARIO -->
		 <div id="container-ejercicios" style="background:#0275d8; border: solid;border-radius:5px; border-color: black;">
		 		<form action="#" method="POST" style="margin:10px;" enctype="multipart/form-data">
		 		<!-- COMIENZO ROW-->	
		 		<div class="row">	
		 			<!-- DIV NOMBRE EJER -->
					<div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-4">
					    <label for="nomTabla">Nombre Tabla: </label>
					    <input type="text" class="form-control" name="NomEjercicio" maxlength="30" placeholder="Nombre Tabla" required="">
					</div>

					<!-- DIV SELECT EJERCICIO-->
					<div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-8">
						<label for="idEjers">Selecciona los Ejercicios deseados: </label>
					    <?php	foreach ($row as $ejercicio){
					    echo "<div class=\"radio col-xs-12 col-sm-4 col-md-4 col-lg-4\" style=\"margin-top:30px;\">";
					    	echo "<img alt=\"Imagen\" src=\""."../../img/ejercicios/".$ejercicio['imagen']."\" style=\"max-width: 100%;\">";
					    ?>
					    	<p style="text-align: center; margin-bottom: 40px;"><input type="checkbox" name="ejerSeleccionado[]"  value="<?php echo $ejercicio['id'];?>" aria-label="true"></p>
					    <?php 	echo "</div>";
							 }; 
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

					<p style="text-align:center">
					<button type="submit" class="btn btn-default1" style="margin-right: 10px;">
						<span class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></span>
					</button>

					<a href="gestionEjercicios.php"><button type="button" class="btn btn-default2">Atr&aacutes</button></a></p>
				</form>
		 </div> <!-- FIN FORMULARIO EJERCICIOS -->

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
             if($_SESSION["usuario"]->getTipoUsuario()=='Administrador'){
                  header("Location: ../Admin/principal.php");  
             }else{
                header("Location: = /../index.php"); 
             }
          }
          
        ob_end_flush();  
  }
?>