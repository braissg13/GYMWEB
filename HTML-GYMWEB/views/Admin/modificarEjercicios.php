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
    <link href="../../css/modificarEjercicios.css" rel="stylesheet">
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
		 
		 <h1>Modificar Ejercicio: Aperturas Mancuernas</h1>

  		 <!-- DIV MUESTRA EJERCICIO -->
		 <div id="container-ejercicios">
		 <!-- COMIENZO ROW -->
			<div class="row row1">
  				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" style="border-style: solid;border-color: black;margin-bottom: 20px;"><img alt="AperMancuernas" src="../../img/ejercicios/aperturas-mancuernas.png" style="max-width: 100%;max-height: 100%;"></div>
  				<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8"><!-- <textarea readonly maxlength="300" rows="20" cols="40">Para comenzar el ejercicio debemos tumbarnos de espalda sobre un banco plano y estrecho para que durante el movimiento no nos moleste en los hombros. Con mancuernas en ambas manos, al inspirar dejaremos que .</textarea> -->
  					<pre style="background-color: transparent; border-color: black;">
Para comenzar el ejercicio debemos tumbarnos de espalda sobre un banco plano y estrecho
para que durante el movimiento no nos moleste en los hombros. Con mancuernas en ambas 
manos, al inspirar bajaremos los brazos de manera perpendicular al banco, llegando con
las mancuernas a la altura del pecho. Al espirar subiremos los brazos juntando las 
mancuernas debiendo quedar enfrentadas arriba del pecho como se observa en la imagen.
					</pre>	

  				</div>
  				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"><p><b>Peso: -</b></p></div>
  				<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8"><p><b>Repeticiones: 10-10-10-8</b></p></div>

			</div><!-- FIN ROW -->

		 </div> <!-- FIN CONTAINER EJERCICIOS -->

		 <div id="container-formulario">
		 <h1>Modificar: </h1>

  		 <!-- DIV FORMULARIO -->
		 <div id="container-formulario2" style="background:#0275d8; border: solid;border-radius:5px; border-color: black;">
		 		<form action="#" method="post" style="margin:10px;">
		 		<!-- COMIENZO ROW 2-->	
		 		<div class="row">	
		 			<!-- DIV NOMBRE EJER -->
					<div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-4">
					    <label for="nomEjer">Nombre Ejercicio: </label>
					    <input type="text" class="form-control" name="NomEjercicio" id="NomEjercicio" maxlength="30" placeholder="Nombre ejercicio">
					</div>
					<!-- DIV DESCRIP EJER -->
					<div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-8">
					    <label for="descEjer">Descripci&oacuten Ejercicio: </label>
					    <textarea class="form-control" rows="4" name="DescripEjerc" maxlength="500"></textarea>
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
					    <input type="number" min="0" name="carga" class="form-control" id="carga">
					</div>
					<!-- DIV IMAGEN-->
					<div class="form-group col-xs-12 col-sm-4 col-md-4 col-lg-4" style="margin-top:30px;">
					    <label for="imgEjer">Subir Imagen: </label>
					    <input type="file" id="imagen" name="imagen">
					</div>

					  
					</div> <!-- FIN ROW 2-->

					<p style="text-align:center">
					<button type="submit" class="btn btn-default1" style="margin-right: 10px;">
						<span class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></span>
					</button>

					<a href="gestionEjercicios.php"><button type="button" class="btn btn-default2">Atr&aacutes</button></a></p>
				</form>
		 	</div> <!-- FIN FORMULARIO EJERCICIOS -->
		 </div>

	</div><!-- FIN CONTAINER -->

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