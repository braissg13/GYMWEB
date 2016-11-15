<?php
 include_once "/../../model/model.php";
	include_once "/../../controller/defaultController.php";

	if(!isset($_SESSION)) session_start();
 		$user=$_SESSION["usuario"];
 	if ($_SESSION["usuario"]->getTipoUsuario() =='Administrador'){

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
    <link href="../../css/consultarEjercicios.css" rel="stylesheet">
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
		 
		 <h1>Ejercicio: <?php echo $ejercicio->getNomEjercicio();?></h1>

  		 <!-- DIV MUESTRA EJERCICIO -->
		 <div id="container-ejercicios">

			<div class="row">
  				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" style="border-style: solid;border-color: black;margin-bottom: 20px;"><img alt="AperMancuernas" src="../../img/ejercicios/<?php echo $ejercicio->getImagenEjercicio(); ?>" style="max-width: 100%;max-height: 100%;"></div>
  				<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
  					<pre style="background-color: transparent; border-color: black;">
<?php echo $ejercicio->getDescripEjercicio(); ?>
					</pre>	

  				</div>
  				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"><p><b>Peso (Kg): <?php echo $ejercicio->getCarga(); ?></b></p></div>
  				<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8"><p><b>Repeticiones: <?php echo $ejercicio->getRepeticiones(); ?></b></p></div>
  				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
  					<!-- PRINCIPIO MODAL ELMINAR EJERCICIO -->
		  			<div class="form-group">
			      		<button type="button" class="btn btn-default1" data-toggle="modal" data-target=".bs-example-modal-sm">Eliminar</button>
			      		<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
		  					<div class="modal-dialog modal-sm" role="document">
		    					<div class="modal-content" id="modalLogin">
		      						<div class="text-center" style="padding:50px 0">
												
									<h3><b>&iquest Desea eliminar este ejercicio?</b></h3>
                  <form action="../../controller/defaultController.php?controlador=ejercicio&accion=borrarEjercicio" method="POST">
                      <input type="hidden" name="idEjercicio" value="<?php echo $ejercicio->getIdEjercicio();?>">
                      <input type="hidden" name="NomEjercicio" value="<?php echo $ejercicio->getNomEjercicio();?>">
									   <button type="submit" class="btn btn-default2">
										  <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
									   </button>
                  
									<a href="gestionEjercicios.php"><button type="button" class="btn btn-default3">Atr&aacutes</button></a></form>	
								
									</div> 
									
		    					</div>
		  					</div>
			      		</div>
			      	</div>	<!-- FIN MODAL -->

  				</div>
  				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
			      	<a href="modificarEjercicios.php?id=<?php echo $idEjer ;?>" style="text-decoration: none;"><button type="button" class="btn btn-default4" id="botonModificar">Modificar</button></a>
			    </div>

          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
              <a href="gestionEjercicios.php"><button type="button" class="btn btn-default3">Atr&aacutes</button></a>
          </div>

			</div><!-- FIN ROW -->

		 </div> <!-- FIN CONTAINER EJERCICIOS -->

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