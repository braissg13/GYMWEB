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
    <link href="../../css/crearEjercicios.css" rel="stylesheet">
    
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
		 
		 <h1>Crear Ejercicio: </h1>

  		 <!-- DIV FORMULARIO -->
		 <div id="container-ejercicios" style="background:#0275d8; border: solid;border-radius:5px; border-color: black;">
		 		<form action="#" method="post" style="margin:10px;">
		 		<!-- COMIENZO ROW-->	
		 		<div class="row">	
		 			<!-- DIV NOMBRE EJER -->
					<div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-4">
					    <label for="nomEjer">Nombre Ejercicio: </label>
					    <input type="text" class="form-control" id="NomEjercicio" name="NomEjercicio" maxlength="30" placeholder="Nombre ejercicio">
					</div>
					<!-- DIV DESCRIP EJER -->
					<div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-8">
					    <label for="descEjer">Descripci&oacuten Ejercicio: </label>
					    <textarea class="form-control" name="DescripEjerc" rows="4" maxlength="500"></textarea>
					</div>
					<!-- DIV TIPO EJER -->
                   	<div class="form-group">
                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                            <select class="form-control" id="TipoEjerc" name="TipoEjerc">
                            	<option value="Brazos">Brazos</option>
							    <option value="Espalda">Espalda</option>
							    <option value="Pecho">Pecho</option>
							    <option value="Piernas">Piernas</option>
                            </select>
                        </div>
                    </div> 
					<!-- DIV REPETICIONES -->
					<div class="form-group col-xs-12 col-sm-4 col-md-4 col-lg-4">
					    <label for="Repeticiones">Repeticiones: </label>
					    <input type="text" class="form-control" id="Repeticiones" name="Repeticiones" maxlength="15" placeholder="xx-xx-xx-xx">
					</div>
					<!-- DIV CARGA -->
					<div class="form-group col-xs-12 col-sm-4 col-md-4 col-lg-4">
					    <label for="Carga">Peso: </label>
					    <input type="number" min="0" class="form-control" name="carga" id="carga">
					</div>
					<!-- DIV IMAGEN-->
					<div class="form-group col-xs-12 col-sm-4 col-md-4 col-lg-4" style="margin-top:30px;">
					    <label for="imgEjer">Subir Imagen: </label>
					    <input type="file" id="imagen" name="imagen">
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