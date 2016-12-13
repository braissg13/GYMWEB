<?php
require_once("../../controller/defaultController.php");

if(!isset($_SESSION)) session_start();
 $idUsuario=$_SESSION['idUsuario'];
 /*Aqui comprobamos que no intenten entrar otros Usuarios que no sean Administradores*/
 if ($_SESSION['tipoUsuario'] =='Administrador'){

 	$idEjer = $_GET['id'];
    $ejercicio = EjercicioController::getEjercicio($idEjer);
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
		 
		 <h1>Modificar Ejercicio: <?php echo $ejercicio->getNomEjercicio();?></h1>

  		 <!-- DIV MUESTRA EJERCICIO -->
		 <div id="container-ejercicios">
		 <!-- COMIENZO ROW -->
			<div class="row row1">
  				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" style="border-style: solid;border-color: black;margin-bottom: 20px;"><img alt="Ejercicio" src="../../img/ejercicios/<?php echo $ejercicio->getImagenEjercicio();?>" style="max-width: 100%;max-height: 100%;"></div>
  				<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
  					<pre style="background-color: transparent; border-color: black;">
<?php echo $ejercicio->getDescripEjercicio(); ?>
					</pre>	

  				</div>
  				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"><p><b>Peso (Kg): <?php echo $ejercicio->getCarga(); ?></b></p></div>
  				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"><p><b>Repeticiones: <?php echo $ejercicio->getRepeticiones(); ?></b></p></div>
  				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"><p><b>Tipo Ejercicio: <?php echo $ejercicio->getTipoEjercicio(); ?></b></p></div>

			</div><!-- FIN ROW -->

		 </div> <!-- FIN CONTAINER EJERCICIOS -->

		 <div id="container-formulario">
		 <h1>Modificar: </h1>

  		 <!-- DIV FORMULARIO -->
		 <div id="container-formulario2" style="background:#0275d8; border: solid;border-radius:5px; border-color: black;">
		 		<form action="../../controller/defaultController.php?controlador=ejercicio&accion=modificarEjercicio" method="POST" style="margin:10px;" enctype="multipart/form-data">
		 		<!-- COMIENZO ROW 2-->	
		 		<div class="row">	
		 			<!-- DIV NOMBRE EJER -->
					<div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-4">
					    <label for="nomEjer">Nombre Ejercicio: </label>
					    <input type="text"  class="form-control" name="NomEjercicio" maxlength="30" placeholder="Nombre ejercicio">
					</div>
					<!-- DIV DESCRIP EJER -->
					<div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-8">
					    <label for="descEjer">Descripci&oacuten Ejercicio: </label>
					    <textarea class="form-control" rows="4" name="DescripEjerc" maxlength="500"></textarea>
					</div>
					<!-- DIV TIPO EJER -->
                   	<div class="form-group">
                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                            <select class="form-control" name="TipoEjerc">
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
					    <input type="text" class="form-control" name="Repeticiones" maxlength="15" placeholder="xx-xx-xx-xx">
					</div>
					<!-- DIV CARGA -->
					<div class="form-group col-xs-12 col-sm-4 col-md-4 col-lg-4">
					    <label for="Carga">Peso: </label>
					    <input type="number" min="0" name="carga" class="form-control">
					</div>
					<!-- DIV IMAGEN-->
					<div class="form-group col-xs-12 col-sm-4 col-md-4 col-lg-4" style="margin-top:30px;">
					    <label for="imgEjer">Subir Imagen: </label>
					    <input type="file" name="imagen">
					</div>
					
					  
					</div> <!-- FIN ROW 2-->
					<input type="hidden" name="idEjercicio" value="<?php echo $ejercicio->getIdEjercicio();?>">
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
         if (($_SESSION['tipoUsuario']=='DeportistaPEF') || ($_SESSION['tipoUsuario'] =='DeportistaTDU')){
            header("refresh: 1; url = ../Deportista/principal.php");  
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
